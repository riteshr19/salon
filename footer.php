    <!-- Footer -->
    <footer class="site-footer" role="contentinfo">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <div class="logo">
                        <?php if (has_custom_logo()) : ?>
                            <?php the_custom_logo(); ?>
                        <?php else : ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.svg" alt="<?php bloginfo('name'); ?>" width="120" height="40">
                        <?php endif; ?>
                    </div>
                    <p><?php echo get_theme_mod('footer_description', 'Premium hair salon specializing in curly hair, cutting-edge techniques, and personalized service.'); ?></p>
                    <div class="social-links">
                        <?php $social_links = get_salon_social_links(); ?>
                        <a href="<?php echo esc_url($social_links['facebook']); ?>" aria-label="Facebook" target="_blank" rel="noopener"><i class="fab fa-facebook"></i></a>
                        <a href="<?php echo esc_url($social_links['instagram']); ?>" aria-label="Instagram" target="_blank" rel="noopener"><i class="fab fa-instagram"></i></a>
                        <a href="<?php echo esc_url($social_links['yelp']); ?>" aria-label="Yelp" target="_blank" rel="noopener"><i class="fab fa-yelp"></i></a>
                    </div>
                </div>
                
                <div class="footer-section">
                    <h4>Quick Links</h4>
                    <ul class="footer-links">
                        <li><a href="<?php echo home_url(); ?>">Home</a></li>
                        <li><a href="<?php echo home_url('/about-us'); ?>">About Us</a></li>
                        <li><a href="<?php echo home_url('/services'); ?>">Services</a></li>
                        <li><a href="<?php echo home_url(); ?>#gallery">Gallery</a></li>
                        <li><a href="<?php echo home_url(); ?>#contact">Contact</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h4>Services</h4>
                    <ul class="footer-links">
                        <?php
                        $service_terms = get_terms(array(
                            'taxonomy' => 'service_category',
                            'hide_empty' => false,
                            'number' => 4
                        ));
                        
                        if (!empty($service_terms) && !is_wp_error($service_terms)) :
                            foreach ($service_terms as $term) :
                        ?>
                            <li><a href="<?php echo get_term_link($term); ?>"><?php echo esc_html($term->name); ?></a></li>
                        <?php 
                            endforeach;
                        else :
                        ?>
                            <li><a href="<?php echo home_url('/services'); ?>#cutting">Cutting</a></li>
                            <li><a href="<?php echo home_url('/services'); ?>#styling">Styling</a></li>
                            <li><a href="<?php echo home_url('/services'); ?>#coloring">Coloring</a></li>
                            <li><a href="<?php echo home_url('/services'); ?>#treatments">Treatments</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h4>Contact Info</h4>
                    <div class="contact-info">
                        <p><i class="fas fa-phone"></i> <a href="tel:<?php echo str_replace(array('(', ')', ' ', '-'), '', get_salon_phone()); ?>"><?php echo get_salon_phone(); ?></a></p>
                        <p><i class="fas fa-envelope"></i> <a href="mailto:<?php echo get_salon_email(); ?>"><?php echo get_salon_email(); ?></a></p>
                        <p><i class="fas fa-map-marker-alt"></i> <?php echo get_salon_address(); ?></p>
                        <?php if (get_theme_mod('salon_hours')) : ?>
                        <p><i class="fas fa-clock"></i> <?php echo wp_kses_post(get_theme_mod('salon_hours')); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved. | <a href="<?php echo home_url('/privacy-policy'); ?>">Privacy Policy</a> | <a href="<?php echo home_url('/terms'); ?>">Terms of Service</a></p>
                <?php if (current_user_can('edit_theme_options')) : ?>
                <p class="admin-notice">WordPress Admin: <a href="<?php echo admin_url(); ?>">Dashboard</a> | <a href="<?php echo admin_url('customize.php'); ?>">Customize</a></p>
                <?php endif; ?>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button id="back-to-top" class="back-to-top" aria-label="Back to top">
        <i class="fas fa-arrow-up"></i>
    </button>

    <?php wp_footer(); ?>
    
    <!-- WordPress Admin Bar Compatibility -->
    <?php if (is_admin_bar_showing()) : ?>
    <style>
        .site-header { margin-top: 32px; }
        @media screen and (max-width: 782px) {
            .site-header { margin-top: 46px; }
        }
    </style>
    <?php endif; ?>
</body>
</html>
