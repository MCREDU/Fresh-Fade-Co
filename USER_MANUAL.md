# Fresh Fade Co. Barbershop - User Manual

## Table of Contents
1. [System Overview](#system-overview)
2. [Customer Guide](#customer-guide)
3. [Admin Panel Guide](#admin-panel-guide)
4. [Installation & Setup](#installation--setup)
5. [Troubleshooting](#troubleshooting)

---

System Overview

**Fresh Fade Co. Barbershop** is a modern, responsive web application that provides an online appointment booking system for a barbershop. The system consists of two main components:

- **Customer Website**: Public-facing website for booking appointments
- **Admin Panel**: Backend management system for barbershop staff

### Key Features
- Online appointment booking with real-time availability
- Service catalog with pricing
- Employee selection and scheduling
- Customer database management
- Email notifications
- Responsive design for all devices

---

## Customer Guide

### 1. Accessing the Website
- Open your web browser
- Navigate to: `http://localhost/barbershop/` (or your domain)
- The homepage displays services, about section, and booking form

### 2. Making an Appointment

#### Step 1: Navigate to Booking
- Click the "Make an appointment" button on the homepage
- Or scroll to the booking section at the bottom of the page

#### Step 2: Fill Out the Booking Form
The booking form requires the following information:

**Personal Information:**
- First Name (required)
- Last Name (required)
- Phone Number (required)
- Email Address (required)

**Appointment Details:**
- Select Services: Choose from available services (haircut, beard trim, shave, etc.)
- Select Employee: Choose your preferred barber
- Select Date & Time: Pick from available time slots

**Customer Type:**
- New Customer: Check this if you're booking for the first time
- Existing Customer: Check this if you've booked before (only email required)

#### Step 3: Submit Booking
- Review all information
- Click "Book Appointment"
- You'll receive a confirmation email

### 3. Available Services
- **Haircut Styles**: Various haircut options
- **Beard Trimming**: Precision beard grooming
- **Smooth Shave**: Clean shave services
- **Face Masking**: Facial treatments

### 4. Contact Information
- **Email**: Freshfade@gmail.com
- **Phone**: +27 (011) 058 4889
- **Address**: 198 West 21th Street, Suite 721, Noordvyk, Midrand 1687

---

## Admin Panel Guide

### 1. Accessing the Admin Panel
- Navigate to: `http://localhost/barbershop/barber-admin/`
- Login with admin credentials:
  - Username: `admin`
  - Password: `admin` (default)

### 2. Dashboard Overview
The dashboard displays key metrics:
- Total Clients
- Total Services
- Employees
- Appointments

### 3. Managing Employees

#### Adding a New Employee
1. Navigate to **Employees** in the sidebar
2. Click **Add New Employee**
3. Fill in employee details:
   - First Name
   - Last Name
   - Phone Number
   - Email
   - Position
4. Click **Add Employee**

#### Editing Employee Information
1. Go to **Employees** page
2. Click the **Edit** button next to the employee
3. Modify the information
4. Click **Update Employee**

#### Managing Employee Schedules
1. Navigate to **Employees Schedule**
2. Select an employee
3. Set their working hours and availability
4. Save the schedule

### 4. Managing Services

#### Adding a New Service
1. Go to **Services** page
2. Click **Add New Service**
3. Enter service details:
   - Service Name
   - Service Category
   - Price
   - Duration
   - Description
4. Click **Add Service**

#### Service Categories
1. Navigate to **Service Categories**
2. Add or edit service categories (e.g., Haircuts, Beard Services, etc.)

### 5. Managing Appointments

#### Viewing Appointments
1. Go to **Appointments** page
2. View all scheduled appointments
3. Filter by date, employee, or status

#### Managing Appointments
- **View Details**: Click on appointment to see full details
- **Edit Appointment**: Modify date, time, or services
- **Cancel Appointment**: Mark appointment as cancelled with reason

### 6. Customer Management

#### Viewing Customers
1. Navigate to **Clients** page
2. View all registered customers
3. Search by name or email

#### Customer Information
- Customer ID
- First and Last Name
- Phone Number
- Email Address
- Booking History

### 7. System Settings

#### Email Configuration
- Update SMTP settings in `smtp.php`
- Configure email notifications for appointments

#### Database Management
- Backup database regularly
- Monitor database performance

---

## Installation & Setup

### Prerequisites
- XAMPP/WAMP/MAMP (PHP 7.4+)
- MySQL 5.7+
- Web browser
- Composer (for PHP dependencies)

### Step-by-Step Installation

#### 1. Server Setup
1. Install XAMPP/WAMP/MAMP
2. Start Apache and MySQL services
3. Ensure PHP 7.4+ is installed

#### 2. Project Setup
1. Download/clone the project to your web server directory
2. Navigate to the project folder in your terminal
3. Run: `composer install` (to install PHP dependencies)

#### 3. Database Setup
1. Open phpMyAdmin: `http://localhost/phpmyadmin`
2. Create a new database named `barbershop`
3. Import the `barbershop_db.sql` file
4. The database will be created with sample data

#### 4. Configuration
1. Edit `connect.php`:
   ```php
   $host = "localhost";
   $username = "root"; // or your MySQL username
   $password = ""; // or your MySQL password
   $database = "barbershop";
   ```

2. Configure email settings in `smtp.php`:
   ```php
   $mail->Host = "smtp.gmail.com";
   $mail->Username = "your-email@gmail.com";
   $mail->Password = "your-app-password";
   ```

#### 5. Access the System
- Main website: `http://localhost/barbershop/`
- Admin panel: `http://localhost/barbershop/barber-admin/`
- Default admin login: username `admin`, password `admin`

### File Structure
```
barbershop/
├── Design/              # CSS, JS, images, fonts
├── Includes/            # PHP functions and templates
├── barber-admin/        # Admin panel files
├── vendor/              # Composer dependencies
├── index.php            # Homepage
├── appointment.php      # Booking system
├── calendar.php         # Calendar functionality
├── connect.php          # Database connection
├── smtp.php            # Email configuration
└── barbershop_db.sql   # Database structure
```

---

## Troubleshooting

### Common Issues

#### 1. Database Connection Error
**Problem**: "Could not connect to database"
**Solution**:
- Check if MySQL service is running
- Verify database credentials in `connect.php`
- Ensure database `barbershop` exists

#### 2. Email Not Sending
**Problem**: Appointment confirmations not received
**Solution**:
- Check SMTP settings in `smtp.php`
- Verify Gmail app password is correct
- Ensure port 587 is not blocked by firewall

#### 3. Admin Login Issues
**Problem**: Cannot access admin panel
**Solution**:
- Verify admin credentials in database
- Check if session is working properly
- Clear browser cache and cookies

#### 4. Booking Form Not Working
**Problem**: Appointment booking fails
**Solution**:
- Check if all required fields are filled
- Verify JavaScript is enabled
- Check browser console for errors

#### 5. Responsive Design Issues
**Problem**: Website doesn't look good on mobile
**Solution**:
- Clear browser cache
- Test on different devices
- Check CSS media queries

### Error Logs
- Check Apache error logs for PHP errors
- Monitor MySQL error logs for database issues
- Review browser console for JavaScript errors

### Performance Optimization
- Enable PHP OPcache
- Optimize database queries
- Compress CSS and JavaScript files
- Use CDN for external libraries

---

## Security Best Practices

### For Administrators
1. **Change Default Passwords**: Update admin credentials immediately
2. **Regular Backups**: Backup database and files regularly
3. **Update Dependencies**: Keep PHP and libraries updated
4. **Secure Email**: Use app passwords for Gmail SMTP
5. **File Permissions**: Set appropriate file permissions

### For Customers
1. **Secure Information**: Never share login credentials
2. **Valid Email**: Use real email address for confirmations
3. **Contact Support**: Report any suspicious activity

---

## Support & Contact

### Technical Support
- **Email**: Freshfade@gmail.com
- **Phone**: +27 (011) 058 4889
- **Address**: 198 West 21th Street, Suite 721, Noordvyk, Midrand 1687

### System Requirements
- **Server**: Apache/Nginx with PHP 7.4+
- **Database**: MySQL 5.7+
- **Browser**: Chrome, Firefox, Safari, Edge (latest versions)
- **Mobile**: iOS Safari, Chrome Mobile, Samsung Internet

---

**Fresh Fade Co.** - Where Style Meets Precision

*This user manual covers the complete functionality of the Fresh Fade Co. Barbershop system. For additional support or feature requests, please contact the development team.*
