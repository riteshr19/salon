<?php
/**
 * Template Name: Services
 *
 * Services page template with pricing
 */

get_header(); ?>

<main id="main" class="site-main">
    <!-- Breadcrumb -->
    <section class="breadcrumb-section">
        <div class="container">
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <a href="<?php echo home_url(); ?>">Home</a>
                <span class="separator">/</span>
                <span class="current">Services & Pricing</span>
            </nav>
        </div>
    </section>

    <!-- Hero Section -->
    <section class="services-hero">
        <div class="container">
            <div class="hero-content reveal">
                <h1><?php echo get_theme_mod('services_hero_title', 'Our Services & Pricing'); ?></h1>
                <p class="hero-subtitle"><?php echo get_theme_mod('services_hero_subtitle', 'Professional hair services tailored to enhance your natural beauty and personal style.'); ?></p>
            </div>
        </div>
    </section>

    <!-- Important Note -->
    <section class="important-note">
        <div class="container">
            <div class="note-content reveal">
                <div class="note-icon">
                    <i class="fas fa-info-circle"></i>
                </div>
                <div class="note-text">
                    <h3><?php echo get_theme_mod('important_note_title', 'Important: Dry Cut Preparation'); ?></h3>
                    <p><?php echo get_theme_mod('important_note_text', 'We start with a dry cut. You must arrive with your curls down and dry. Avoid hairstyles that pull your hair up, like buns or ponytails. You can use hair products as long as the hair is NOT sticky or oily. Breaking these rules might lead to rescheduling or a fee. Let\'s keep it hassle-free!'); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Navigation -->
    <section class="services-nav">
        <div class="container">
            <div class="services-tabs reveal">
                <?php
                $service_categories = get_terms(array(
                    'taxonomy' => 'service_category',
                    'hide_empty' => false,
                    'orderby' => 'menu_order',
                    'order' => 'ASC'
                ));

                if (!empty($service_categories) && !is_wp_error($service_categories)) {
                    $first = true;
                    foreach ($service_categories as $category) {
                        $icon = get_term_meta($category->term_id, '_category_icon', true) ?: 'fas fa-cut';
                ?>
                <button class="tab-btn<?php echo $first ? ' active' : ''; ?>" data-tab="<?php echo esc_attr($category->slug); ?>">
                    <i class="<?php echo esc_attr($icon); ?>"></i>
                    <span><?php echo esc_html($category->name); ?></span>
                </button>
                <?php
                        $first = false;
                    }
                } else {
                    // Default categories if none exist
                ?>
                <button class="tab-btn active" data-tab="cutting">
                    <i class="fas fa-cut"></i>
                    <span>Cutting</span>
                </button>
                <button class="tab-btn" data-tab="styling">
                    <i class="fas fa-magic"></i>
                    <span>Styling</span>
                </button>
                <button class="tab-btn" data-tab="coloring">
                    <i class="fas fa-palette"></i>
                    <span>Coloring</span>
                </button>
                <button class="tab-btn" data-tab="treatments">
                    <i class="fas fa-spa"></i>
                    <span>Treatments</span>
                </button>
                <?php } ?>
            </div>
        </div>
    </section>

    <!-- Services Content -->
    <section class="services-content">
        <div class="container">
            <?php
            if (!empty($service_categories) && !is_wp_error($service_categories)) :
                $first_category = true;
                foreach ($service_categories as $category) :
            ?>
            <!-- Service Category -->
            <div class="service-category<?php echo $first_category ? ' active' : ''; ?>" id="<?php echo esc_attr($category->slug); ?>">
                <div class="section-header text-center reveal">
                    <span class="section-badge"><?php echo esc_html($category->name); ?></span>
                    <h2><?php echo esc_html($category->name); ?></h2>
                    <?php if ($category->description) : ?>
                    <p><?php echo esc_html($category->description); ?></p>
                    <?php endif; ?>
                </div>
                
                <div class="services-grid">
                    <?php
                    $services = new WP_Query(array(
                        'post_type' => 'service',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'service_category',
                                'field' => 'term_id',
                                'terms' => $category->term_id,
                            ),
                        ),
                        'posts_per_page' => -1,
                        'meta_key' => '_service_order',
                        'orderby' => 'meta_value_num',
                        'order' => 'ASC'
                    ));
                    
                    if ($services->have_posts()) :
                        while ($services->have_posts()) : $services->the_post();
                            $price_min = get_post_meta(get_the_ID(), '_service_price_min', true);
                            $price_max = get_post_meta(get_the_ID(), '_service_price_max', true);
                            $features = get_post_meta(get_the_ID(), '_service_features', true);
                            $is_featured = get_post_meta(get_the_ID(), '_service_featured', true);
                            $duration = get_post_meta(get_the_ID(), '_service_duration', true);
                    ?>
                    <div class="service-card card<?php echo $is_featured ? ' featured' : ''; ?> reveal" data-service="<?php echo esc_attr(get_the_title()); ?>">
                        <?php if ($is_featured) : ?>
                        <div class="featured-badge"><?php echo get_post_meta(get_the_ID(), '_featured_badge_text', true) ?: 'Most Popular'; ?></div>
                        <?php endif; ?>
                        
                        <div class="service-header">
                            <div class="card-icon"><i class="fas fa-dot-circle"></i></div>
                            <h3><?php the_title(); ?></h3>
                            <?php if ($price_min && $price_max) : ?>
                            <div class="price-range wp-editable" contenteditable="<?php echo current_user_can('edit_posts') ? 'true' : 'false'; ?>">
                                $<?php echo $price_min; ?> – $<?php echo $price_max; ?>
                            </div>
                            <?php elseif ($price_min) : ?>
                            <div class="price-range wp-editable" contenteditable="<?php echo current_user_can('edit_posts') ? 'true' : 'false'; ?>">
                                Starting @ $<?php echo $price_min; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        
                        <p class="service-description"><?php echo wp_trim_words(get_the_content(), 25); ?></p>
                        
                        <?php if ($features) : ?>
                        <div class="service-features">
                            <?php foreach (explode("\n", $features) as $feature) : ?>
                                <?php if (trim($feature)) : ?>
                                <span class="feature"><i class="fas fa-check"></i> <?php echo esc_html(trim($feature)); ?></span>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>

                        <?php if ($duration) : ?>
                        <div class="service-duration">
                            <i class="fas fa-clock"></i> <?php echo $duration; ?> minutes
                        </div>
                        <?php endif; ?>
                        
                        <button class="book-service-btn btn btn-primary" data-service="<?php echo esc_attr(get_the_title()); ?>">
                            Book This Service
                        </button>
                    </div>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
            </div>
            <?php
                    $first_category = false;
                endforeach;
            else :
                // Fallback static content
                get_template_part('template-parts/default-services');
            endif;
            ?>
        </div>
    </section>

    <!-- Contact & Policy Section -->
    <section class="contact-policy-section">
        <div class="container">
            <div class="contact-policy-grid">
                <div class="contact-info reveal">
                    <h3>Questions About Our Services?</h3>
                    <p>If you have any questions about our services or pricing, please feel free to reach out to us.</p>
                    <div class="contact-methods">
                        <a href="mailto:<?php echo get_salon_email(); ?>" class="contact-method">
                            <i class="fas fa-envelope"></i>
                            <span><?php echo get_salon_email(); ?></span>
                        </a>
                        <a href="tel:<?php echo str_replace(array('(', ')', ' ', '-'), '', get_salon_phone()); ?>" class="contact-method">
                            <i class="fas fa-phone"></i>
                            <span><?php echo get_salon_phone(); ?></span>
                        </a>
                    </div>
                </div>
                
                <div class="policy-info reveal">
                    <h3>Cancellation Policy</h3>
                    <p>We understand that sometimes plans change. Please review our cancellation policy to ensure a smooth booking experience.</p>
                    <?php if (get_page_by_path('cancellation-policy')) : ?>
                    <a href="<?php echo home_url('/cancellation-policy'); ?>" class="policy-link btn btn-outline">Read Cancellation Policy</a>
                    <?php else : ?>
                    <a href="#" class="policy-link btn btn-outline">Read Cancellation Policy</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content text-center reveal">
                <h2>Ready to Book Your Service?</h2>
                <p>Choose from our wide range of professional hair services and experience the Shan Hair difference.</p>
                <div class="cta-buttons">
                    <a href="<?php echo get_salon_booking_url(); ?>" target="_blank" rel="noopener" class="btn btn-primary btn-lg">Schedule an Appointment</a>
                    <a href="<?php echo home_url('/about-us'); ?>" class="btn btn-outline btn-lg">Meet Our Team</a>
                </div>
            </div>
        </div>
    </section>

    <!-- WordPress-Enabled Booking Modal -->
    <div class="modal" id="booking-modal">
        <div class="modal-content">
            <button class="modal-close" aria-label="Close modal">&times;</button>
            <div class="modal-body">
                <?php echo do_shortcode('[shan_hair_booking_form]'); ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
