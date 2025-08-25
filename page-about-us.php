<?php
/**
 * Template Name: About Us
 * 
 * About Us page template with stylist information
 */

get_header(); ?>

<main id="main" class="site-main">
    <!-- Breadcrumb -->
    <section class="breadcrumb-section">
        <div class="container">
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <a href="<?php echo home_url(); ?>">Home</a>
                <span class="separator">/</span>
                <span class="current">About Our Team</span>
            </nav>
        </div>
    </section>

    <!-- Hero Section -->
    <section class="about-hero">
        <div class="container">
            <div class="hero-content reveal">
                <h1>Our Stylists</h1>
                <p class="hero-subtitle">Meet the talented team behind Shan Hair's exceptional service and artistry.</p>
            </div>
        </div>
    </section>

    <!-- Our Team Section -->
    <section class="our-team">
        <div class="container">
            <div class="section-header text-center reveal">
                <h2>Our Expert Team</h2>
                <p>Brookline's curl experts with over 30 years of combined experience in curly hair cutting, coloring, and styling.</p>
            </div>

            <div class="stylists-grid">
                <?php
                $stylists = new WP_Query(array(
                    'post_type' => 'stylist',
                    'posts_per_page' => -1,
                    'meta_key' => '_stylist_order',
                    'orderby' => 'meta_value_num',
                    'order' => 'ASC'
                ));
                
                if ($stylists->have_posts()) :
                    while ($stylists->have_posts()) : $stylists->the_post();
                        $experience = get_post_meta(get_the_ID(), '_stylist_experience', true);
                        $specialties = get_post_meta(get_the_ID(), '_stylist_specialties', true);
                        $email = get_post_meta(get_the_ID(), '_stylist_email', true);
                        $phone = get_post_meta(get_the_ID(), '_stylist_phone', true);
                ?>
                <!-- Stylist Card -->
                <div class="stylist-card reveal" data-stylist="<?php echo sanitize_title(get_the_title()); ?>">
                    <div class="stylist-image">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('large', array('loading' => 'lazy', 'alt' => get_the_title())); ?>
                        <?php else : ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/avatar-1.jpg" alt="<?php the_title(); ?>" loading="lazy">
                        <?php endif; ?>
                        <div class="stylist-overlay">
                            <button class="view-details-btn" data-stylist="<?php echo sanitize_title(get_the_title()); ?>">View Details</button>
                        </div>
                    </div>
                    <div class="stylist-info">
                        <h3><?php the_title(); ?></h3>
                        <p class="stylist-title"><?php echo get_post_meta(get_the_ID(), '_stylist_title', true); ?></p>
                        <?php if ($experience) : ?>
                        <p class="experience"><?php echo esc_html($experience); ?></p>
                        <?php endif; ?>
                        
                        <?php if ($specialties) : ?>
                        <div class="specialties">
                            <?php foreach (explode(',', $specialties) as $specialty) : ?>
                                <span class="specialty"><?php echo trim(esc_html($specialty)); ?></span>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                        
                        <div class="stylist-contact-info">
                            <?php if ($email) : ?>
                            <a href="mailto:<?php echo esc_attr($email); ?>" class="email-link">
                                <i class="fas fa-envelope"></i> <?php echo esc_html($email); ?>
                            </a>
                            <?php endif; ?>
                            <a href="<?php echo get_salon_booking_url(); ?>" target="_blank" rel="noopener" class="book-btn btn btn-primary btn-sm">Book with <?php echo get_the_title(); ?></a>
                        </div>
                    </div>
                </div>
                <?php 
                    endwhile;
                    wp_reset_postdata();
                else :
                    // Fallback static content if no stylists are added
                    include get_template_directory() . '/template-parts/default-stylists.php';
                endif;
                ?>
            </div>
        </div>
    </section>

    <!-- Before & After Gallery -->
    <section class="before-after-section">
        <div class="container">
            <div class="section-header text-center reveal">
                <h2>Befores and Afters</h2>
                <p>See the incredible transformations our stylists create every day.</p>
            </div>
            
            <div class="before-after-gallery">
                <?php
                $before_after = new WP_Query(array(
                    'post_type' => 'gallery_item',
                    'meta_key' => '_gallery_type',
                    'meta_value' => 'before_after',
                    'posts_per_page' => 6
                ));
                
                if ($before_after->have_posts()) :
                    while ($before_after->have_posts()) : $before_after->the_post();
                        $before_image = get_post_meta(get_the_ID(), '_before_image', true);
                        $after_image = get_post_meta(get_the_ID(), '_after_image', true);
                ?>
                <div class="before-after-item reveal">
                    <div class="before-after-images">
                        <div class="before-image">
                            <?php if ($before_image) : ?>
                                <img src="<?php echo esc_url($before_image); ?>" alt="Before transformation" loading="lazy">
                            <?php else : ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/gallery-1.jpg" alt="Before transformation" loading="lazy">
                            <?php endif; ?>
                            <span class="image-label">Before</span>
                        </div>
                        <div class="after-image">
                            <?php if ($after_image) : ?>
                                <img src="<?php echo esc_url($after_image); ?>" alt="After transformation" loading="lazy">
                            <?php elseif (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('medium', array('loading' => 'lazy', 'alt' => 'After transformation')); ?>
                            <?php else : ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/gallery-2.jpg" alt="After transformation" loading="lazy">
                            <?php endif; ?>
                            <span class="image-label">After</span>
                        </div>
                    </div>
                </div>
                <?php 
                    endwhile;
                    wp_reset_postdata();
                else :
                    // Fallback static content
                    for ($i = 1; $i <= 3; $i++) :
                ?>
                <div class="before-after-item reveal">
                    <div class="before-after-images">
                        <div class="before-image">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/gallery-<?php echo $i; ?>.jpg" alt="Before transformation" loading="lazy">
                            <span class="image-label">Before</span>
                        </div>
                        <div class="after-image">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/gallery-<?php echo $i + 3; ?>.jpg" alt="After transformation" loading="lazy">
                            <span class="image-label">After</span>
                        </div>
                    </div>
                </div>
                <?php 
                    endfor;
                endif;
                ?>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content text-center reveal">
                <h2>Ready to Transform Your Hair?</h2>
                <p>Book an appointment with one of our expert stylists today and experience the Shan Hair difference.</p>
                <div class="cta-buttons">
                    <a href="<?php echo home_url(); ?>#contact" class="btn btn-primary btn-lg">Schedule Appointment</a>
                    <a href="<?php echo home_url('/services'); ?>" class="btn btn-outline btn-lg">View Services</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Stylist Detail Modals -->
    <div class="modal" id="stylist-modal">
        <div class="modal-content">
            <button class="modal-close" aria-label="Close modal">&times;</button>
            <div class="modal-body" id="stylist-details"></div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
