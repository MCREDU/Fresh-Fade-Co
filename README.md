# Fresh Fade Co. Barbershop

A modern, responsive barbershop website with online appointment booking system and admin panel.

## Features

### Customer Features
- Online Appointment Booking - Easy-to-use booking system with service selection
- Service Catalog - Browse haircuts, beard trims, shaves, and more
- Employee Selection - Choose your preferred barber
- Real-time Calendar - View available time slots
- Responsive Design - Works perfectly on all devices
- Contact Form - Get in touch with the team

### Admin Features
- Employee Management - Add, edit, and manage barbers
- Service Management - Configure services and pricing
- Appointment Management - View and manage all bookings
- Customer Database - Track customer information
- Schedule Management - Set employee availability

## Technology Stack

- Frontend: HTML5, CSS3, JavaScript, Bootstrap 4
- Backend: PHP 7.4+
- Database: MySQL
- Email: PHPMailer with SMTP support
- Icons: Font Awesome, Custom Barber Icons

## Project Structure

```
barbershop/
├── Design/
│   ├── css/           # Stylesheets
│   ├── js/            # JavaScript files
│   ├── fonts/         # Font files and icons
│   └── images/        # Website images
├── Includes/
│   ├── functions/     # PHP functions
│   ├── php-files-ajax/ # AJAX handlers
│   └── templates/     # Header, footer, navbar
├── barber-admin/      # Admin panel
├── vendor/            # Composer dependencies
├── index.php          # Homepage
├── appointment.php    # Booking system
├── calendar.php       # Calendar functionality
└── connect.php        # Database connection
```

## Quick Start

### Prerequisites
- XAMPP/WAMP/MAMP (PHP 7.4+)
- MySQL 5.7+
- Web browser

### Installation
1. Clone/Download the project to your web server directory
2. Database Setup:
   - Create a MySQL database
   - Import `barbershop_db.sql`
   - Update `connect.php` with your database credentials
3. Email Configuration:
   - Update SMTP settings in `smtp.php`
   - Configure PHPMailer settings
4. Access the Website:
   - Main site: `http://localhost/barbershop/`
   - Admin panel: `http://localhost/barbershop/barber-admin/`

## Customization

### Colors
- Primary: #9e8a78 (Taupe)
- Secondary: #222227 (Dark Gray)
- Background: #faf9f5 (Off-White)
- Accent: #f4c150 (Gold for ratings)

### Fonts
- Headings: Prata (Serif)
- Body: Roboto (Sans-serif)
- UI: Work Sans (Sans-serif)

## Responsive Design

The website is fully responsive and optimized for:
- Desktop (1200px+)
- Tablet (768px - 1199px)
- Mobile (320px - 767px)

## Configuration Files

- `connect.php` - Database connection settings
- `smtp.php` - Email configuration
- `composer.json` - PHP dependencies

## Contact & Support

- Email: Freshfade@gmail.com
- Phone: +27 (011) 058 4889
- Address: 198 West 21th Street, Suite 721, Noordvyk, Midrand 1687

## License

This project is proprietary software developed for Fresh Fade Co. Barbershop.

## Recent Updates

- Replaced overlapping about section images with single full-width image
- Converted reviews carousel to static grid layout
- Updated color scheme to warm off-white (#faf9f5)
- Reduced homepage slider height for better proportions
- Cleaned up unused image files
- Enhanced responsive design

## Development Notes

- Built with modern web standards
- SEO-friendly structure
- Cross-browser compatible
- Mobile-first responsive design
- Clean, maintainable code structure

---

**Fresh Fade Co.** - Where Style Meets Precision
