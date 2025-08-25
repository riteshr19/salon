<?php
/**
 * Shan Hair WordPress Theme Functions
 * WordPress-ready salon website functionality
 */

// Theme setup
function shan_hair_setup() {
    // Add theme support
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'shan-hair'),
        'footer' => __('Footer Menu', 'shan-hair'),
    ));
}
add_action('after_setup_theme', 'shan_hair_setup');

// Enqueue styles and scripts
function shan_hair_scripts() {
    // Styles
    wp_enqueue_style('shan-hair-style', get_template_directory_uri() . '/assets/css/style.css', array(), '1.0.0');
    wp_enqueue_style('shan-hair-theme-toggle', get_template_directory_uri() . '/assets/css/theme-toggle.css', array(), '1.0.0');
    wp_enqueue_style('shan-hair-modern-components', get_template_directory_uri() . '/assets/css/modern-components.css', array(), '1.0.0');
    wp_enqueue_style('shan-hair-animations', get_template_directory_uri() . '/assets/css/animations.css', array(), '1.0.0');
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Montserrat:wght@300;400;500;600;700;800&display=swap', array(), null);
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css', array(), '6.0.0');
    
    // Scripts
    wp_enqueue_script('shan-hair-theme-manager', get_template_directory_uri() . '/assets/js/theme-manager.js', array(), '1.0.0', true);
    wp_enqueue_script('shan-hair-main', get_template_directory_uri() . '/assets/js/main.js', array('shan-hair-theme-manager'), '1.0.0', true);
    
    // Page-specific scripts
    if (is_page_template('about-us.php') || is_page('about-us')) {
        wp_enqueue_script('shan-hair-about', get_template_directory_uri() . '/assets/js/about.js', array('shan-hair-main'), '1.0.0', true);
    }
    
    if (is_page_template('services.php') || is_page('services')) {
        wp_enqueue_script('shan-hair-services', get_template_directory_uri() . '/assets/js/services.js', array('shan-hair-main'), '1.0.0', true);
    }
    
    // Localize script for AJAX
    wp_localize_script('shan-hair-main', 'shan_hair_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('shan_hair_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'shan_hair_scripts');

// Salon contact information functions
function get_salon_phone() {
    return '(617) 375-0673';
}

function get_salon_email() {
    return 'reception@shanhair.com';
}

function get_salon_address() {
    return '169 Amory St. Brookline MA, 02446';
}

function get_salon_booking_url() {
    return 'https://www.vagaro.com/shk2pn';
}

function get_salon_hours() {
    return array(
        'monday' => 'Closed',
        'tuesday' => '10:00 AM - 7:00 PM',
        'wednesday' => '9:00 AM - 6:00 PM',
        'thursday' => '9:00 AM - 7:00 PM',
        'friday' => '9:00 AM - 6:00 PM',
        'saturday' => '9:00 AM - 4:00 PM',
        'sunday' => 'Closed'
    );
}

// Social media and business links
function get_salon_social_links() {
    return array(
        'instagram' => 'https://www.instagram.com/shanhairboston/',
        'facebook' => 'https://www.facebook.com/shanhairboston',
        'yelp' => 'https://www.yelp.com/biz/shan-hair-brookline'
    );
}

// Theme customization setup
function shan_hair_customize_register($wp_customize) {
    // Add sections for customization
    $wp_customize->add_section('salon_info', array(
        'title' => 'Salon Information',
        'priority' => 30,
    ));
    
    // Salon description
    $wp_customize->add_setting('site_description', array(
        'default' => 'Expert curly hair cutting, coloring, and styling in Brookline. DevaCurl certified stylists with 30+ years experience.',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('site_description', array(
        'label' => 'Site Description',
        'section' => 'salon_info',
        'type' => 'textarea',
    ));
    
    // Social media settings
    $social_links = get_salon_social_links();
    foreach ($social_links as $platform => $url) {
        $wp_customize->add_setting($platform . '_url', array(
            'default' => $url,
            'sanitize_callback' => 'esc_url_raw',
        ));
        
        $wp_customize->add_control($platform . '_url', array(
            'label' => ucfirst($platform) . ' URL',
            'section' => 'salon_info',
            'type' => 'url',
        ));
    }

    // Theme Appearance Section
    $wp_customize->add_section('theme_appearance', array(
        'title' => 'Theme Appearance',
        'priority' => 31,
        'description' => 'Customize the visual appearance of your salon website.',
    ));

    // Primary color
    $wp_customize->add_setting('primary_color', array(
        'default' => '#d06b1f',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_color', array(
        'label' => 'Primary Color (Orange)',
        'section' => 'theme_appearance',
        'description' => 'This color is used for buttons, links, and accents.',
    )));

    // Secondary color
    $wp_customize->add_setting('secondary_color', array(
        'default' => '#1b2a38',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'secondary_color', array(
        'label' => 'Secondary Color (Navy)',
        'section' => 'theme_appearance',
        'description' => 'Used for dark backgrounds and text.',
    )));

    // Default theme mode
    $wp_customize->add_setting('default_theme_mode', array(
        'default' => 'auto',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('default_theme_mode', array(
        'label' => 'Default Theme Mode',
        'section' => 'theme_appearance',
        'type' => 'select',
        'choices' => array(
            'auto' => 'Auto (Follow System)',
            'light' => 'Light Mode',
            'dark' => 'Dark Mode',
        ),
        'description' => 'Choose the default color scheme for new visitors.',
    ));

    // Hero Section
    $wp_customize->add_section('hero_section', array(
        'title' => 'Hero Section',
        'priority' => 32,
        'description' => 'Customize the main hero section on your homepage.',
    ));

    // Hero title
    $wp_customize->add_setting('hero_title', array(
        'default' => 'Welcome to Shan Hair',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('hero_title', array(
        'label' => 'Hero Title',
        'section' => 'hero_section',
        'type' => 'text',
    ));

    // Hero subtitle
    $wp_customize->add_setting('hero_subtitle', array(
        'default' => 'Brookline\'s curl experts since 2011! With 30 years of experience, Shan and our talented team specialize in bringing out the best in curls (and all hair types), offering expert cuts, color, and more in a fun, friendly, and professional atmosphere.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('hero_subtitle', array(
        'label' => 'Hero Subtitle',
        'section' => 'hero_section',
        'type' => 'textarea',
    ));

    // Hero button text
    $wp_customize->add_setting('hero_button_text', array(
        'default' => 'Book Appointment',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('hero_button_text', array(
        'label' => 'Hero Button Text',
        'section' => 'hero_section',
        'type' => 'text',
    ));

    // Hero button link
    $wp_customize->add_setting('hero_button_link', array(
        'default' => '#contact',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('hero_button_link', array(
        'label' => 'Hero Button Link',
        'section' => 'hero_section',
        'type' => 'url',
        'description' => 'Where the main hero button should link to.',
    ));

    // Services Section
    $wp_customize->add_section('services_section', array(
        'title' => 'Services Section',
        'priority' => 33,
        'description' => 'Customize the services section content.',
    ));

    // Services title
    $wp_customize->add_setting('services_title', array(
        'default' => 'Our Premium Services',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('services_title', array(
        'label' => 'Services Section Title',
        'section' => 'services_section',
        'type' => 'text',
    ));

    // Services description
    $wp_customize->add_setting('services_description', array(
        'default' => 'Expert services tailored to enhance your natural beauty and personal style.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('services_description', array(
        'label' => 'Services Description',
        'section' => 'services_section',
        'type' => 'textarea',
    ));

    // Contact Section
    $wp_customize->add_section('contact_section', array(
        'title' => 'Contact & Booking',
        'priority' => 34,
        'description' => 'Customize contact information and booking settings.',
    ));

    // Booking form title
    $wp_customize->add_setting('booking_form_title', array(
        'default' => 'Book Your Appointment',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('booking_form_title', array(
        'label' => 'Booking Form Title',
        'section' => 'contact_section',
        'type' => 'text',
    ));

    // Booking form description
    $wp_customize->add_setting('booking_form_description', array(
        'default' => 'Ready to transform your hair? Book your appointment today and let our expert stylists create the perfect look for you.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('booking_form_description', array(
        'label' => 'Booking Form Description',
        'section' => 'contact_section',
        'type' => 'textarea',
    ));

    // Business hours
    $wp_customize->add_setting('business_hours', array(
        'default' => "Monday: 9:00 AM - 7:00 PM\nTuesday: 9:00 AM - 7:00 PM\nWednesday: 9:00 AM - 6:00 PM\nThursday: 9:00 AM - 7:00 PM\nFriday: 9:00 AM - 6:00 PM\nSaturday: 9:00 AM - 4:00 PM\nSunday: Closed",
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('business_hours', array(
        'label' => 'Business Hours',
        'section' => 'contact_section',
        'type' => 'textarea',
        'description' => 'Enter your business hours, one day per line.',
    ));

    // Footer Section
    $wp_customize->add_section('footer_section', array(
        'title' => 'Footer Content',
        'priority' => 35,
        'description' => 'Customize footer information and copyright text.',
    ));

    // Footer description
    $wp_customize->add_setting('footer_description', array(
        'default' => 'Premium hair salon specializing in curly hair, cutting-edge techniques, and personalized service.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('footer_description', array(
        'label' => 'Footer Description',
        'section' => 'footer_section',
        'type' => 'textarea',
    ));

    // Copyright text
    $wp_customize->add_setting('footer_copyright', array(
        'default' => 'All rights reserved.',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('footer_copyright', array(
        'label' => 'Copyright Text',
        'section' => 'footer_section',
        'type' => 'text',
        'description' => 'Additional copyright text (year and site name are added automatically).',
    ));
}
add_action('customize_register', 'shan_hair_customize_register');

// Custom Post Types
function shan_hair_custom_post_types() {
    // Stylists
    register_post_type('stylist', array(
        'labels' => array(
            'name' => 'Stylists',
            'singular_name' => 'Stylist',
            'add_new_item' => 'Add New Stylist',
            'edit_item' => 'Edit Stylist',
            'new_item' => 'New Stylist',
            'view_item' => 'View Stylist',
            'search_items' => 'Search Stylists',
            'not_found' => 'No stylists found',
            'not_found_in_trash' => 'No stylists found in trash'
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'stylists'),
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-admin-users',
        'show_in_rest' => true,
    ));
    
    // Services
    register_post_type('service', array(
        'labels' => array(
            'name' => 'Services',
            'singular_name' => 'Service',
            'add_new_item' => 'Add New Service',
            'edit_item' => 'Edit Service',
            'new_item' => 'New Service',
            'view_item' => 'View Service',
            'search_items' => 'Search Services',
            'not_found' => 'No services found',
            'not_found_in_trash' => 'No services found in trash'
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'services'),
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-scissors',
        'show_in_rest' => true,
    ));
    
    // Gallery
    register_post_type('gallery_item', array(
        'labels' => array(
            'name' => 'Gallery Items',
            'singular_name' => 'Gallery Item',
            'add_new_item' => 'Add New Gallery Item',
            'edit_item' => 'Edit Gallery Item',
            'new_item' => 'New Gallery Item',
            'view_item' => 'View Gallery Item',
            'search_items' => 'Search Gallery',
            'not_found' => 'No gallery items found',
            'not_found_in_trash' => 'No gallery items found in trash'
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'gallery'),
        'supports' => array('title', 'thumbnail'),
        'menu_icon' => 'dashicons-format-gallery',
        'show_in_rest' => true,
    ));
}
add_action('init', 'shan_hair_custom_post_types');

// Service Categories Taxonomy
function shan_hair_taxonomies() {
    register_taxonomy('service_category', 'service', array(
        'hierarchical' => true,
        'labels' => array(
            'name' => 'Service Categories',
            'singular_name' => 'Service Category',
            'search_items' => 'Search Service Categories',
            'all_items' => 'All Service Categories',
            'parent_item' => 'Parent Service Category',
            'parent_item_colon' => 'Parent Service Category:',
            'edit_item' => 'Edit Service Category',
            'update_item' => 'Update Service Category',
            'add_new_item' => 'Add New Service Category',
            'new_item_name' => 'New Service Category Name',
            'menu_name' => 'Service Categories',
        ),
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'service-category'),
        'show_in_rest' => true,
    ));
}
add_action('init', 'shan_hair_taxonomies');

// Custom Fields for Services (Price ranges, duration, etc.)
function shan_hair_add_service_meta_boxes() {
    add_meta_box(
        'service_details',
        'Service Details',
        'shan_hair_service_details_callback',
        'service',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'shan_hair_add_service_meta_boxes');

function shan_hair_service_details_callback($post) {
    wp_nonce_field('shan_hair_save_service_details', 'shan_hair_service_details_nonce');
    
    $price_min = get_post_meta($post->ID, '_service_price_min', true);
    $price_max = get_post_meta($post->ID, '_service_price_max', true);
    $duration = get_post_meta($post->ID, '_service_duration', true);
    $features = get_post_meta($post->ID, '_service_features', true);
    
    echo '<table class="form-table">';
    echo '<tr>';
    echo '<th><label for="service_price_min">Price Range (Min)</label></th>';
    echo '<td><input type="number" id="service_price_min" name="service_price_min" value="' . esc_attr($price_min) . '" step="5" /></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th><label for="service_price_max">Price Range (Max)</label></th>';
    echo '<td><input type="number" id="service_price_max" name="service_price_max" value="' . esc_attr($price_max) . '" step="5" /></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th><label for="service_duration">Duration (minutes)</label></th>';
    echo '<td><input type="number" id="service_duration" name="service_duration" value="' . esc_attr($duration) . '" step="15" /></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th><label for="service_features">Features (one per line)</label></th>';
    echo '<td><textarea id="service_features" name="service_features" rows="4" cols="50">' . esc_textarea($features) . '</textarea></td>';
    echo '</tr>';
    echo '</table>';
}

function shan_hair_save_service_details($post_id) {
    if (!isset($_POST['shan_hair_service_details_nonce']) || 
        !wp_verify_nonce($_POST['shan_hair_service_details_nonce'], 'shan_hair_save_service_details')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (isset($_POST['service_price_min'])) {
        update_post_meta($post_id, '_service_price_min', sanitize_text_field($_POST['service_price_min']));
    }
    
    if (isset($_POST['service_price_max'])) {
        update_post_meta($post_id, '_service_price_max', sanitize_text_field($_POST['service_price_max']));
    }
    
    if (isset($_POST['service_duration'])) {
        update_post_meta($post_id, '_service_duration', sanitize_text_field($_POST['service_duration']));
    }
    
    if (isset($_POST['service_features'])) {
        update_post_meta($post_id, '_service_features', sanitize_textarea_field($_POST['service_features']));
    }
}
add_action('save_post', 'shan_hair_save_service_details');

// Booking Form Handler
function shan_hair_handle_booking() {
    check_ajax_referer('shan_hair_nonce', 'nonce');
    
    $booking_data = array(
        'first_name' => sanitize_text_field($_POST['firstName']),
        'last_name' => sanitize_text_field($_POST['lastName']),
        'email' => sanitize_email($_POST['email']),
        'phone' => sanitize_text_field($_POST['phone']),
        'service' => sanitize_text_field($_POST['service']),
        'stylist' => sanitize_text_field($_POST['stylist']),
        'preferred_date' => sanitize_text_field($_POST['date']),
        'preferred_time' => sanitize_text_field($_POST['time']),
        'notes' => sanitize_textarea_field($_POST['notes']),
        'booking_date' => current_time('mysql')
    );
    
    // Save to database
    global $wpdb;
    $table_name = $wpdb->prefix . 'shan_hair_bookings';
    
    $result = $wpdb->insert($table_name, $booking_data);
    
    if ($result) {
        // Send email notifications
        shan_hair_send_booking_emails($booking_data);
        wp_send_json_success('Booking submitted successfully');
    } else {
        wp_send_json_error('Failed to submit booking');
    }
}
add_action('wp_ajax_shan_hair_booking', 'shan_hair_handle_booking');
add_action('wp_ajax_nopriv_shan_hair_booking', 'shan_hair_handle_booking');

// Create booking table on activation
function shan_hair_create_booking_table() {
    global $wpdb;
    
    $table_name = $wpdb->prefix . 'shan_hair_bookings';
    
    $charset_collate = $wpdb->get_charset_collate();
    
    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        first_name tinytext NOT NULL,
        last_name tinytext NOT NULL,
        email varchar(100) NOT NULL,
        phone varchar(20) NOT NULL,
        service text NOT NULL,
        stylist varchar(50),
        preferred_date date,
        preferred_time time,
        notes text,
        booking_date datetime DEFAULT CURRENT_TIMESTAMP,
        status varchar(20) DEFAULT 'pending',
        PRIMARY KEY (id)
    ) $charset_collate;";
    
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
register_activation_hook(__FILE__, 'shan_hair_create_booking_table');

// Email notifications
function shan_hair_send_booking_emails($booking_data) {
    $to = get_option('admin_email');
    $subject = 'New Booking Request - ' . $booking_data['service'];
    
    $message = "New booking request received:\n\n";
    $message .= "Name: {$booking_data['first_name']} {$booking_data['last_name']}\n";
    $message .= "Email: {$booking_data['email']}\n";
    $message .= "Phone: {$booking_data['phone']}\n";
    $message .= "Service: {$booking_data['service']}\n";
    $message .= "Preferred Stylist: " . ($booking_data['stylist'] ?: 'No preference') . "\n";
    $message .= "Preferred Date: " . ($booking_data['preferred_date'] ?: 'Flexible') . "\n";
    $message .= "Preferred Time: " . ($booking_data['preferred_time'] ?: 'Flexible') . "\n";
    $message .= "Notes: " . ($booking_data['notes'] ?: 'None') . "\n";
    
    wp_mail($to, $subject, $message);
    
    // Send confirmation to customer
    $customer_subject = 'Booking Request Received - Shan Hair Salon';
    $customer_message = "Hi {$booking_data['first_name']},\n\n";
    $customer_message .= "Thank you for your booking request! We'll contact you within 24 hours to confirm your appointment.\n\n";
    $customer_message .= "Requested Service: {$booking_data['service']}\n\n";
    $customer_message .= "Best regards,\nShan Hair Salon Team\n(617) 375-0673";
    
    wp_mail($booking_data['email'], $customer_subject, $customer_message);
}

// Shortcodes
function shan_hair_booking_form_shortcode($atts) {
    $atts = shortcode_atts(array(
        'service' => '',
        'stylist' => ''
    ), $atts);
    
    ob_start();
    include get_template_directory() . '/template-parts/booking-form.php';
    return ob_get_clean();
}
add_shortcode('shan_hair_booking_form', 'shan_hair_booking_form_shortcode');

// Admin menu for bookings
function shan_hair_admin_menu() {
    add_menu_page(
        'Bookings',
        'Bookings',
        'manage_options',
        'shan-hair-bookings',
        'shan_hair_bookings_page',
        'dashicons-calendar-alt',
        30
    );
}
add_action('admin_menu', 'shan_hair_admin_menu');

function shan_hair_bookings_page() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'shan_hair_bookings';
    $bookings = $wpdb->get_results("SELECT * FROM $table_name ORDER BY booking_date DESC");
    
    echo '<div class="wrap">';
    echo '<h1>Booking Requests</h1>';
    
    if ($bookings) {
        echo '<table class="wp-list-table widefat fixed striped">';
        echo '<thead><tr><th>Date</th><th>Name</th><th>Service</th><th>Contact</th><th>Preferred Date/Time</th><th>Status</th></tr></thead>';
        echo '<tbody>';
        
        foreach ($bookings as $booking) {
            echo '<tr>';
            echo '<td>' . date('M j, Y g:i A', strtotime($booking->booking_date)) . '</td>';
            echo '<td>' . esc_html($booking->first_name . ' ' . $booking->last_name) . '</td>';
            echo '<td>' . esc_html($booking->service) . '</td>';
            echo '<td>' . esc_html($booking->email) . '<br>' . esc_html($booking->phone) . '</td>';
            echo '<td>' . ($booking->preferred_date ? date('M j, Y', strtotime($booking->preferred_date)) : 'Flexible') . '<br>' . ($booking->preferred_time ?: 'Flexible') . '</td>';
            echo '<td><span class="booking-status-' . $booking->status . '">' . ucfirst($booking->status) . '</span></td>';
            echo '</tr>';
        }
        
        echo '</tbody></table>';
    } else {
        echo '<p>No booking requests yet.</p>';
    }
    
    echo '</div>';
}

// Theme customizer
function shan_hair_customize_register($wp_customize) {
    // Salon Information Section
    $wp_customize->add_section('salon_info', array(
        'title' => 'Salon Information',
        'priority' => 30,
    ));
    
    // Phone Number
    $wp_customize->add_setting('salon_phone', array(
        'default' => '(617) 375-0673',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('salon_phone', array(
        'label' => 'Phone Number',
        'section' => 'salon_info',
        'type' => 'text',
    ));
    
    // Email
    $wp_customize->add_setting('salon_email', array(
        'default' => 'info@shanhair.com',
        'sanitize_callback' => 'sanitize_email',
    ));
    $wp_customize->add_control('salon_email', array(
        'label' => 'Email Address',
        'section' => 'salon_info',
        'type' => 'email',
    ));
    
    // Address
    $wp_customize->add_setting('salon_address', array(
        'default' => 'Boston, MA',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('salon_address', array(
        'label' => 'Address',
        'section' => 'salon_info',
        'type' => 'text',
    ));
}
add_action('customize_register', 'shan_hair_customize_register');

// Helper functions for templates
function get_salon_phone() {
    return get_theme_mod('salon_phone', '(617) 375-0673');
}

function get_salon_email() {
    return get_theme_mod('salon_email', 'info@shanhair.com');
}

function get_salon_address() {
    return get_theme_mod('salon_address', 'Boston, MA');
}

// Helper functions for new customizer options
function get_primary_color() {
    return get_theme_mod('primary_color', '#d06b1f');
}

function get_secondary_color() {
    return get_theme_mod('secondary_color', '#1b2a38');
}

function get_default_theme_mode() {
    return get_theme_mod('default_theme_mode', 'auto');
}

function get_hero_title() {
    return get_theme_mod('hero_title', 'Welcome to Shan Hair');
}

function get_hero_subtitle() {
    return get_theme_mod('hero_subtitle', 'Brookline\'s curl experts since 2011! With 30 years of experience, Shan and our talented team specialize in bringing out the best in curls (and all hair types), offering expert cuts, color, and more in a fun, friendly, and professional atmosphere.');
}

function get_hero_button_text() {
    return get_theme_mod('hero_button_text', 'Book Appointment');
}

function get_hero_button_link() {
    return get_theme_mod('hero_button_link', '#contact');
}

function get_services_title() {
    return get_theme_mod('services_title', 'Our Premium Services');
}

function get_services_description() {
    return get_theme_mod('services_description', 'Expert services tailored to enhance your natural beauty and personal style.');
}

function get_booking_form_title() {
    return get_theme_mod('booking_form_title', 'Book Your Appointment');
}

function get_booking_form_description() {
    return get_theme_mod('booking_form_description', 'Ready to transform your hair? Book your appointment today and let our expert stylists create the perfect look for you.');
}

function get_business_hours() {
    return get_theme_mod('business_hours', "Monday: 9:00 AM - 7:00 PM\nTuesday: 9:00 AM - 7:00 PM\nWednesday: 9:00 AM - 6:00 PM\nThursday: 9:00 AM - 7:00 PM\nFriday: 9:00 AM - 6:00 PM\nSaturday: 9:00 AM - 4:00 PM\nSunday: Closed");
}

function get_footer_description() {
    return get_theme_mod('footer_description', 'Premium hair salon specializing in curly hair, cutting-edge techniques, and personalized service.');
}

function get_footer_copyright() {
    return get_theme_mod('footer_copyright', 'All rights reserved.');
}

// Output dynamic CSS for customizer colors
function shan_hair_customizer_css() {
    $primary_color = get_primary_color();
    $secondary_color = get_secondary_color();
    
    if ($primary_color !== '#d06b1f' || $secondary_color !== '#1b2a38') {
        echo '<style type="text/css">';
        echo ':root {';
        if ($primary_color !== '#d06b1f') {
            echo '--orange: ' . esc_attr($primary_color) . ';';
            echo '--orange-light: ' . esc_attr($primary_color) . 'dd;';
            echo '--orange-gradient: linear-gradient(135deg, ' . esc_attr($primary_color) . ', ' . esc_attr($primary_color) . 'dd);';
        }
        if ($secondary_color !== '#1b2a38') {
            echo '--navy: ' . esc_attr($secondary_color) . ';';
            echo '--navy-light: ' . esc_attr($secondary_color) . 'dd;';
        }
        echo '}';
        echo '</style>';
    }
}
add_action('wp_head', 'shan_hair_customizer_css');

// Add theme data attribute to body for default theme mode
function shan_hair_body_theme_data($classes) {
    $default_mode = get_default_theme_mode();
    return $classes;
}
add_filter('body_class', 'shan_hair_body_theme_data');

// Add theme mode data attribute to body tag
function shan_hair_body_theme_attribute() {
    $default_mode = get_default_theme_mode();
    echo ' data-default-theme="' . esc_attr($default_mode) . '"';
}
add_action('wp_body_open', function() {
    echo '<script>document.body.setAttribute("data-theme", localStorage.getItem("shan-hair-theme") || "' . esc_js(get_default_theme_mode()) . '");</script>';
});
?>
