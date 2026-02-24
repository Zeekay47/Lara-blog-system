<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\EmailVerification;
use App\Mail\EmailVerificationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Show the registration form.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'terms' => ['required', 'accepted'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Check if email already exists in email_verifications table
        $existingVerification = EmailVerification::where('email', $request->email)->first();
        
        if ($existingVerification) {
            // Delete old verification record
            $existingVerification->delete();
        }

        // Generate 5-digit verification code
        $verificationCode = str_pad(random_int(0, 99999), 5, '0', STR_PAD_LEFT);

        // Store verification data
        $verification = EmailVerification::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'verification_code' => $verificationCode,
            'expires_at' => now()->addMinutes(10),
        ]);

        // Send verification email
        try {
            Mail::to($request->email)->send(new EmailVerificationMail($request->name, $verificationCode, $request->email));
        } catch (\Exception $e) {
            $verification->delete();
            return redirect()->back()
                ->withErrors(['email' => 'Failed to send verification email. Please try again.'])
                ->withInput();
        }

        // Store email in session for verification page
        session(['verification_email' => $request->email]);

        // Redirect to verification page
        return redirect()->route('register.verify.show')
            ->with('success', 'We have sent a 5-digit verification code to your email address.');
    }

    /**
     * Show the verification form.
     */
    public function showVerificationForm(Request $request)
    {
        $email = $request->query('email'); // Get email from URL query parameter

        // If email is provided in URL, validate it
        if ($email) {
            $verification = EmailVerification::where('email', $email)->first();

            if (!$verification) {
                return redirect()->route('register')
                    ->withErrors(['email' => 'No verification pending for this email. Please register again.']);
            }

            if ($verification->isExpired()) {
                $verification->delete();
                return redirect()->route('register')
                    ->withErrors(['email' => 'Verification code expired. Please register again.']);
            }

            // Store email in session for this device
            session(['verification_email' => $email]);

            // Store the actual expiration timestamp in session
            session(['verification_expires_at' => $verification->expires_at->timestamp]);
        }

        // Check if email exists in session (for users who were redirected after registration)
        if (!session()->has('verification_email')) {
            return redirect()->route('register');
        }

        // If we don't have expiration time in session, try to get it from database
        if (!session()->has('verification_expires_at')) {
            $verification = EmailVerification::where('email', session('verification_email'))->first();
            if ($verification) {
                session(['verification_expires_at' => $verification->expires_at->timestamp]);
            } else {
                // If no verification found, redirect to register
                return redirect()->route('register')
                    ->withErrors(['email' => 'Verification record not found. Please register again.']);
            }
        }

        return view('auth.verify-email', [
            'expiresAt' => session('verification_expires_at')
        ]);
    }

    /**
     * Verify the email code and create user.
     */
    public function verifyCode(Request $request)
    {
        $request->validate([
            'verification_code' => ['required', 'string', 'size:5'],
        ]);

        $email = session('verification_email');

        if (!$email) {
            return redirect()->route('register')
                ->withErrors(['email' => 'Verification session expired. Please register again.']);
        }

        // Find verification record
        $verification = EmailVerification::where('email', $email)
            ->where('verification_code', $request->verification_code)
            ->first();

        if (!$verification) {
            return redirect()->back()
                ->withErrors(['verification_code' => 'Invalid verification code.'])
                ->withInput();
        }

        // Check if code is expired
        if ($verification->isExpired()) {
            $verification->delete();
            session()->forget('verification_email');
            
            return redirect()->route('register')
                ->withErrors(['email' => 'Verification code expired. Please register again.']);
        }

        // Create the user
        $user = User::create([
            'name' => $verification->name,
            'email' => $verification->email,
            'password' => $verification->password,
            'email_verified_at' => now(),
        ]);

        // Delete verification record
        $verification->delete();

        // Clear session
        session()->forget('verification_email');

        // Trigger registered event
        event(new Registered($user));

        // Log the user in
        auth()->login($user);

        // Redirect to dashboard
        return redirect()->route('dashboard');
    }

    /**
     * Resend verification code.
     */
    public function resendCode(Request $request)
    {
        $email = session('verification_email');

        if (!$email) {
            return redirect()->route('register')
                ->withErrors(['email' => 'Verification session expired. Please register again.']);
        }

        $verification = EmailVerification::where('email', $email)->first();

        if (!$verification) {
            return redirect()->route('register')
                ->withErrors(['email' => 'Verification record not found. Please register again.']);
        }

        // Generate new code
        $newCode = str_pad(random_int(0, 99999), 5, '0', STR_PAD_LEFT);

        // Update verification record
        $verification->update([
            'verification_code' => $newCode,
            'expires_at' => now()->addMinutes(10),
        ]);

        // Update the session with new expiration time
        session(['verification_expires_at' => $verification->expires_at->timestamp]);

        // Send new code with email parameter
        try {
            Mail::to($email)->send(new EmailVerificationMail(
                $verification->name, 
                $newCode,
                $email
            ));
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['resend' => 'Failed to resend verification code. Please try again.']);
        }

        return redirect()->back()
            ->with('success', 'A new verification code has been sent to your email.');
    }
}