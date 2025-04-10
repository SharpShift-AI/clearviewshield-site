# WordPress Theme Installation Guide for ClearViewShield

This guide provides detailed instructions for installing and configuring the ClearViewShield WordPress theme on your NameCheap Stellar hosting plan. Follow these steps to set up your complete mobile windshield repair website.

## Table of Contents
1. [WordPress Installation](#wordpress-installation)
2. [Theme Installation](#theme-installation)
3. [Plugin Installation](#plugin-installation)
4. [Theme Configuration](#theme-configuration)
5. [Booking System Setup](#booking-system-setup)
6. [Twilio SMS Integration](#twilio-sms-integration)
7. [Performance Optimization](#performance-optimization)
8. [Security Configuration](#security-configuration)
9. [Local SEO Setup](#local-seo-setup)
10. [Troubleshooting](#troubleshooting)

## WordPress Installation

### Step 1: Access cPanel
1. Log in to your NameCheap account
2. Go to your domain management page
3. Click on "Manage" next to your domain
4. Select "cPanel" from the left sidebar
5. Log in to cPanel using your hosting credentials

### Step 2: Install WordPress
1. In cPanel, scroll down to the "Web Applications" section
2. Click on "WordPress"
3. Click "Install"
4. Configure the following settings:
   - Protocol: Choose HTTPS
   - Domain: Select your domain (clearviewshield.com)
   - Directory: Leave blank for installation in the root directory
   - Site Name: ClearViewShield
   - Site Description: Mobile Windshield Repair in Cedar Rapids, Iowa
   - Admin Username: Create a secure username (not "admin")
   - Admin Password: Create a strong password
   - Admin Email: Enter your email address
5. Click "Install" and wait for the installation to complete

### Step 3: Access WordPress Admin
1. After installation, you'll receive a confirmation with your admin URL
2. Navigate to yourdomain.com/wp-admin
3. Log in with your admin username and password

## Theme Installation

### Step 1: Install Astra Theme (Parent Theme)
1. In WordPress admin, go to Appearance > Themes
2. Click "Add New"
3. Search for "Astra"
4. Click "Install" on the Astra theme
5. After installation, click "Activate"

### Step 2: Install ClearViewShield Theme (Child Theme)
1. In WordPress admin, go to Appearance > Themes
2. Click "Add New"
3. Click "Upload Theme"
4. Click "Choose File" and select the `clearviewshield_wordpress_theme.zip` file
5. Click "Install Now"
6. After installation, click "Activate"

## Plugin Installation

### Step 1: Install Required Plugins
1. In WordPress admin, go to Plugins > Add New
2. Install and activate the following plugins:
   - Elementor (Free version)
   - Elementor Pro (Upload the provided zip file)
   - Yoast SEO
   - WPForms Lite
   - Bookly (Free version)
   - Bookly Pro (Upload the provided zip file)
   - WP Rocket (Upload the provided zip file)
   - Wordfence Security

### Step 2: Activate Plugin Licenses
1. Elementor Pro:
   - Go to Elementor > License
   - Enter your license key and activate
2. Bookly Pro:
   - Go to Bookly > License
   - Enter your license key and activate
3. WP Rocket:
   - Go to WP Rocket > License
   - Enter your license key and activate

## Theme Configuration

### Step 1: Import Elementor Templates
1. Go to Templates > Elementor Templates
2. Click "Import Templates"
3. Upload the provided template files:
   - `homepage-template.json`
   - `booking-template.json`

### Step 2: Create Pages
1. Go to Pages > Add New
2. Create the following pages:
   - Home
   - Services
   - About
   - Booking
   - Contact
   - FAQ
   - Terms of Service
   - Privacy Policy
3. For each page, select the appropriate template from the "Page Attributes" section

### Step 3: Configure Menus
1. Go to Appearance > Menus
2. Create a new menu called "Primary Menu"
3. Add the following pages to the menu:
   - Home
   - Services
   - About
   - Contact
   - FAQ
   - Book Now (Booking page with CSS class "menu-button")
4. Set the display location to "Primary Menu"
5. Create a second menu called "Footer Menu"
6. Add relevant pages to the footer menu
7. Set the display location to "Footer Menu"

### Step 4: Configure Homepage
1. Go to Settings > Reading
2. Set "Your homepage displays" to "A static page"
3. Select "Home" as your homepage
4. Click "Save Changes"

## Booking System Setup

### Step 1: Configure Bookly
1. Go to Bookly > Settings
2. General Settings:
   - Company Name: ClearViewShield
   - Company Logo: Upload your logo
   - Company Address: Your business address
   - Company Phone: (319) 775-0717
   - Company Website: Your website URL
   - Time Slot Length: 15 min
3. Calendar Settings:
   - Set your business hours for each day
   - Set your time zone to "America/Chicago"
4. Payments:
   - Enable "Local" payment method
   - Set the price to $75

### Step 2: Create Services
1. Go to Bookly > Services
2. Add a new service:
   - Name: Windshield Chip Repair
   - Price: $75
   - Duration: 45 min
   - Description: Professional repair for rock chips, star breaks, and bull's-eyes
3. Add another service:
   - Name: Windshield Crack Repair
   - Price: $75
   - Duration: 45 min
   - Description: Professional repair for cracks up to 6 inches

### Step 3: Create Staff Member
1. Go to Bookly > Staff Members
2. Add a new staff member:
   - Name: Your name or technician's name
   - Email: Your email
   - Phone: (319) 775-0717
   - Assign all services to this staff member
   - Set working hours to match your business hours

### Step 4: Add Custom Fields
1. Go to Bookly > Custom Fields
2. Add the following custom fields:
   - Vehicle Make (Text field, Required)
   - Vehicle Model (Text field, Required)
   - Vehicle Year (Text field, Required)
   - Damage Description (Textarea, Required)

## Twilio SMS Integration

### Step 1: Create Twilio Account
1. Go to [Twilio.com](https://www.twilio.com/) and sign up for an account
2. Purchase a phone number with SMS capabilities
3. Note your Account SID and Auth Token

### Step 2: Configure Bookly SMS Notifications
1. Go to Bookly > SMS Notifications
2. Enter your Twilio Account SID and Auth Token
3. Enter your Twilio phone number in the format +13197750717
4. Test the connection

### Step 3: Set Up Notification Templates
1. Configure the following notification templates:
   - Appointment Confirmation (Client)
   - Appointment Reminder (Client, 24h before)
   - Appointment Follow-up (Client, 1 day after)
   - New Booking (Staff)
2. Use the provided template text for each notification

## Performance Optimization

### Step 1: Configure WP Rocket
1. Go to WP Rocket > Dashboard
2. Enable the following options:
   - Cache
   - File Optimization (minify CSS/JS)
   - Media (LazyLoad)
   - Preload
3. Go to WP Rocket > Advanced Rules
4. Add "/booking/" to the "Never Cache URLs" section

### Step 2: Configure Image Optimization
1. Go to Media > Settings
2. Enable "Organize uploads into month- and year-based folders"
3. Set maximum image dimensions to 2000px width and height

### Step 3: Configure Browser Caching
1. Go to WP Rocket > Advanced
2. Enable "Expires Headers"
3. Set expiration time to 1 year

## Security Configuration

### Step 1: Configure Wordfence
1. Go to Wordfence > All Options
2. Enable the following options:
   - Scan Schedule (Daily)
   - Email Alerts
   - Brute Force Protection
3. Set login security options:
   - Enable reCAPTCHA
   - Limit login attempts
   - Enforce strong passwords

### Step 2: Configure SSL
1. Go to Settings > General
2. Ensure both WordPress Address and Site Address use https://
3. Go to WP Rocket > Advanced
4. Enable "Force HTTPS"

### Step 3: Configure Backup
1. Go to Wordfence > Tools > Backup
2. Schedule daily backups
3. Set backup retention to 7 days

## Local SEO Setup

### Step 1: Configure Yoast SEO
1. Go to SEO > General
2. Complete the Configuration Wizard
3. Enter your company information:
   - Company Name: ClearViewShield
   - Company Type: Local Business
   - Logo: Upload your logo

### Step 2: Configure Local SEO
1. Go to SEO > Search Appearance > Content Types
2. Set title and meta description templates for pages and posts
3. Go to SEO > Social
4. Configure social profiles
5. Go to SEO > Local
6. Enter your business information:
   - Business Name: ClearViewShield
   - Business Type: Automotive Repair Service
   - Address: Your business address
   - Phone: (319) 775-0717
   - Email: Your email
   - Opening Hours: Your business hours

### Step 3: Add Schema Markup
1. Go to SEO > Schema
2. Select "Local Business" as your schema type
3. Fill in all required fields:
   - Business Name
   - Logo
   - Address
   - Phone
   - Price Range: $75
   - Service Area: Cedar Rapids, Marion, Hiawatha, and Linn County

## Troubleshooting

### Common Issues and Solutions

#### Theme Not Displaying Correctly
1. Go to Appearance > Customize
2. Check that the ClearViewShield theme is active
3. Clear your browser cache and WP Rocket cache
4. Check for JavaScript errors in the browser console

#### Booking System Not Working
1. Check that Bookly and Bookly Pro are both activated
2. Verify that services and staff members are set up correctly
3. Check for conflicts with other plugins
4. Verify that the booking form shortcode is correctly placed

#### SMS Notifications Not Sending
1. Verify your Twilio credentials
2. Check that your Twilio phone number has SMS capabilities
3. Ensure the phone number format is correct (+13197750717)
4. Check Twilio logs for error messages

#### Performance Issues
1. Run a performance test using GTmetrix or PageSpeed Insights
2. Check WP Rocket settings
3. Optimize images using an image compression plugin
4. Disable unnecessary plugins

For additional support, please contact us at support@clearviewshield.com or call (319) 775-0717.
