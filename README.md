# BlogSpace - A Modern Laravel Blog Platform

![BlogSpace Logo](https://via.placeholder.com/200x50/f53003/ffffff?text=BlogSpace)

BlogSpace is a feature-rich, modern blog platform built with Laravel. It provides a clean, intuitive interface for writers to create, manage, and share their blog posts with the world. The platform features a beautiful dark mode, responsive design, and comprehensive user authentication.

## 📋 Features

### Core Features
- **User Authentication**: Secure registration, login, and profile management using Laravel Breeze
- **Blog Management**: Create, read, update, and delete blog posts
- **User-specific Content**: Users can view all posts or filter to see only their own posts
- **Search Functionality**: Search through blog posts by title and content
- **Dashboard Analytics**: Personal dashboard showing post statistics and recent activity
- **Responsive Design**: Fully responsive layout that works on desktop, tablet, and mobile

### UI/UX Features
- **Dark Mode Support**: Toggle between light and dark themes
- **Mobile-friendly Navigation**: Hamburger menu for smaller screens
- **Interactive Sidebar**: Collapsible sidebar with navigation links
- **User Avatars**: Profile pictures with fallback initials
- **Rich Visual Feedback**: Success messages, error handling, and confirmation dialogs
- **Activity Feed**: Recent activity tracking on dashboard

## 🚀 Technology Stack

- **Backend**: Laravel 10.x
- **Frontend**: Blade Templates, TailwindCSS, Alpine.js
- **Database**: MySQL/PostgreSQL/SQLite
- **Authentication**: Laravel Breeze
- **Icons**: Heroicons
- **Fonts**: Instrument Sans (via Bunny Fonts)

## 📦 Installation

### Prerequisites
- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL/PostgreSQL/SQLite

### Step-by-step Installation

1. **Clone the repository**
```bash
git clone https://github.com/yourusername/blogspace.git
cd blogspace
```

2. **Install PHP dependencies**
```bash
composer install
```

3. **Install JavaScript dependencies**
```bash
npm install
```

4. **Environment setup**
```bash
cp .env.example .env
php artisan key:generate
```

5. **Configure database**
Edit the `.env` file with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blogspace
DB_USERNAME=root
DB_PASSWORD=
```

6. **Run migrations**
```bash
php artisan migrate
```

7. **Build assets**
```bash
npm run build
```

8. **Start the development server**
```bash
php artisan serve
```

Visit `http://localhost:8000` to see the application.

## 🎨 Project Structure

```
blogspace/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── PostController.php    # Blog post management
│   │   │   └── ProfileController.php # User profile management
│   │   └── Requests/                  # Form requests
│   ├── Models/
│   │   ├── User.php                   # User model
│   │   └── Post.php                    # Blog post model
│   └── View/                           # View components
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   ├── app.blade.php          # Main app layout
│   │   │   ├── guest.blade.php        # Guest layout
│   │   │   └── navigation.blade.php   # Navigation bar
│   │   ├── components/
│   │   │   └── dashboard-navbar.blade.php # Sidebar component
│   │   ├── posts/
│   │   │   ├── index.blade.php         # All blogs listing
│   │   │   ├── my.blade.php            # User's blogs
│   │   │   ├── create.blade.php        # Create blog
│   │   │   ├── edit.blade.php          # Edit blog
│   │   │   └── show.blade.php          # Single blog view
│   │   ├── auth/                        # Authentication views
│   │   ├── profile/                      # Profile management
│   │   └── welcome.blade.php             # Landing page
│   └── css/                               # Stylesheets
├── routes/
│   └── web.php                            # Web routes
└── public/                                 # Public assets
```

## 🔧 Configuration

### Search Functionality
The search feature is implemented in `PostController.php`:

```php
public function index(Request $request)
{
    $query = Post::with('user')->latest();
    
    if ($request->has('search') && !empty($request->search)) {
        $searchTerm = $request->search;
        $query->where(function($q) use ($searchTerm) {
            $q->where('title', 'LIKE', "%{$searchTerm}%")
              ->orWhere('content', 'LIKE', "%{$searchTerm}%");
        });
    }
    
    $posts = $query->paginate(9)->withQueryString();
    return view('posts.index', compact('posts'));
}
```

### Dashboard Statistics
The dashboard calculates:
- Total posts by user
- Latest post with timestamp
- Account age
- Recent activity feed

## 🎯 Usage Guide

### For Visitors
- Browse all blog posts on the homepage
- Read individual blog posts
- Search for specific content
- Register for an account

### For Registered Users
- **Dashboard**: View personal statistics and recent activity
- **My Blogs**: Manage your own blog posts
- **Create Blog**: Write and publish new content
- **Edit/Delete**: Modify or remove your existing posts
- **Profile**: Update personal information and profile picture

## 📱 Mobile Responsiveness

The application is fully responsive with:
- Collapsible sidebar on mobile devices
- Hamburger menu for navigation
- Stacked cards on smaller screens
- Touch-friendly buttons and interactions
- Optimized tables with horizontal scroll

## 🌙 Dark Mode

BlogSpace supports system-wide dark mode preferences:
- Automatically adapts to user's OS preference
- Maintains readability with appropriate contrast
- Consistent color scheme throughout the application

## 🔒 Security Features

- CSRF Protection
- Authentication using Laravel Breeze
- Authorization checks for post ownership
- XSS prevention through Blade escaping
- Secure password hashing
- Session management

## 🚦 Routes

| Method | URI | Action | Name |
|--------|-----|--------|------|
| GET | / | Welcome page | welcome |
| GET | /dashboard | User dashboard | dashboard |
| GET | /posts | List all posts | posts.index |
| GET | /posts/my | User's posts | posts.my |
| GET | /posts/create | Create post | posts.create |
| POST | /posts | Store post | posts.store |
| GET | /posts/{id} | Show post | posts.show |
| GET | /posts/{id}/edit | Edit post | posts.edit |
| PUT | /posts/{id} | Update post | posts.update |
| DELETE | /posts/{id} | Delete post | posts.destroy |

## 🎨 Color Scheme

```css
Primary Brand Color: #f53003
Text Primary: #1b1b18
Text Secondary: #706f6c
Background Light: #FDFDFC
Background Dark: #0a0a0a
Success: Green-500
Error: #f53003
Border Light: #e3e3e0
Border Dark: #3E3E3A
```

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📝 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 👏 Credits

- **Laravel** - The PHP framework for web artisans
- **TailwindCSS** - Utility-first CSS framework
- **Alpine.js** - Lightweight JavaScript framework
- **Heroicons** - Beautiful SVG icons
- **Bunny Fonts** - Privacy-focused font delivery

## 📧 Contact

For questions or feedback:
- Email: zahid.khan.evil@gmail.com
- GitHub: [Zeekay47](https://github.com/Zeekay47)

## 🐛 Known Issues

- Search pagination needs to preserve query parameters (fixed with `withQueryString()`)
- Profile photo upload requires additional configuration in production
- Categories feature is currently placeholder (coming soon)

## 🗓️ Changelog

### Version 1.0.0 (February 2026)
- Initial release
- Basic blog CRUD operations
- User authentication
- Dashboard with statistics
- Dark mode support
- Mobile-responsive design
- Search functionality

---

**Made with ❤️ using Laravel**