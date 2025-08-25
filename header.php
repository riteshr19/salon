<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?php if (is_home() || is_front_page()) : ?>
        <title><?php echo get_theme_mod('site_title', 'Shan Hair Salon - Premium Curly Hair Specialists in Boston'); ?></title>
        <meta name="description" content="<?php echo get_theme_mod('site_description', 'Expert curly hair cutting, coloring, and styling in Boston. DevaCurl certified stylists with 29+ years experience. Book your transformation today.'); ?>">
    <?php endif; ?>
    
    <!-- Open Graph -->
    <meta property="og:title" content="<?php wp_title('|', true, 'right'); bloginfo('name'); ?>">
    <meta property="og:description" content="<?php echo get_theme_mod('site_description', 'Expert curly hair specialists in Boston'); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo home_url(); ?>">
    <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/assets/img/hero.jpg">
    
    <!-- Schema.org markup -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "HairSalon",
        "name": "Shan Hair",
        "description": "Premium hair salon specializing in curly hair cutting, coloring, and styling in Brookline, Boston area",
        "url": "<?php echo home_url(); ?>",
        "telephone": "(617) 375-0673",
        "email": "reception@shanhair.com",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "169 Amory St",
            "addressLocality": "Brookline",
            "addressRegion": "MA",
            "postalCode": "02446",
            "addressCountry": "US"
        },
        "priceRange": "$75-$250",
        "openingHoursSpecification": [
            {
                "@type": "OpeningHoursSpecification",
                "dayOfWeek": "Tuesday",
                "opens": "10:00",
                "closes": "19:00"
            },
            {
                "@type": "OpeningHoursSpecification",
                "dayOfWeek": "Wednesday",
                "opens": "09:00",
                "closes": "18:00"
            },
            {
                "@type": "OpeningHoursSpecification",
                "dayOfWeek": "Thursday",
                "opens": "09:00",
                "closes": "19:00"
            },
            {
                "@type": "OpeningHoursSpecification",
                "dayOfWeek": "Friday",
                "opens": "09:00",
                "closes": "18:00"
            },
            {
                "@type": "OpeningHoursSpecification",
                "dayOfWeek": "Saturday",
                "opens": "09:00",
                "closes": "16:00"
            }
        ],
        "sameAs": [
            "https://www.instagram.com/shanhairboston/",
            "https://www.yelp.com/biz/shan-hair-brookline"
        ]
    }
    </script>
    
    <!-- PWA -->
    <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/manifest.json">
    <meta name="theme-color" content="#d4af37">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="Shan Hair">
    
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="<?php echo get_template_directory_uri(); ?>/assets/img/logo.svg">
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/assets/img/logo.svg">
    
    <!-- Preconnect to external resources -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    
    <!-- Skip to main content for accessibility -->
    <a class="skip-link screen-reader-text" href="#main">Skip to main content</a>
    
    <!-- Header -->
    <header class="site-header" role="banner">
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <?php if (has_custom_logo()) : ?>
                        <?php the_custom_logo(); ?>
                    <?php else : ?>
                        <a href="<?php echo home_url(); ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.svg" alt="<?php bloginfo('name'); ?>" width="120" height="40">
                        </a>
                    <?php endif; ?>
                </div>
                
                <nav class="site-nav" role="navigation" aria-label="Main Navigation">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_class' => 'nav-list',
                        'container' => false,
                        'fallback_cb' => 'shan_hair_fallback_menu'
                    ));
                    ?>
                </nav>
                
                <button class="nav-toggle" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="hamburger"></span>
                </button>
            </div>
        </div>
    </header>

<?php
// Fallback menu if no menu is set
function shan_hair_fallback_menu() {
    echo '<ul class="nav-list">';
    echo '<li><a href="' . home_url() . '">Home</a></li>';
    echo '<li><a href="' . home_url('/about-us') . '">About Us</a></li>';
    echo '<li><a href="' . home_url('/services') . '">Services</a></li>';
    echo '<li><a href="' . home_url() . '#gallery">Gallery</a></li>';
    echo '<li><a href="' . home_url() . '#contact" class="btn btn-secondary">Book Now</a></li>';
    echo '</ul>';
}
?>
