<?php
/**
 * Template Name: Home Page
 * 
 * The main template file for Shan Hair Salon
 */

get_header(); ?>

    <!-- Hero Section -->
    <section class="hero" id="home" role="main">
        <div class="hero-background">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/hero.jpg" alt="Professional hair styling" loading="lazy">
            <div class="hero-overlay"></div>
        </div>
        
        <div class="floating-circles">
            <div class="circle circle-1"></div>
            <div class="circle circle-2"></div>
            <div class="circle circle-3"></div>
        </div>
        
        <div class="container">
            <div class="hero-content reveal animate-fade-in-up">
                <div class="hero-text">
                    <h1 class="scroll-reveal"><?php echo get_hero_title(); ?></h1>
                    <p class="hero-subtitle scroll-reveal"><?php echo get_hero_subtitle(); ?></p>
                    
                    <div class="hero-announcement scroll-reveal">
                        <h3>Announcement!</h3>
                        <p><strong>Kiki & Caitlyn accepting new clients. Shan is scheduling for existing clients.</strong></p>
                        <p class="note">NOTE: that Schedulicity is now VAGARO.</p>
                    </div>
                    
                    <div class="trust-indicators stagger-animation">
                        <div class="trust-item hover-lift">
                            <i class="fas fa-award"></i>
                            <span>30+ Years Experience</span>
                        </div>
                        <div class="trust-item hover-lift">
                            <i class="fas fa-certificate"></i>
                            <span>DevaCurl Certified</span>
                        </div>
                        <div class="trust-item hover-lift">
                            <i class="fas fa-star"></i>
                            <span>5-Star Rated</span>
                        </div>
                    </div>
                    
                    <div class="cta-buttons scroll-reveal">
                        <a href="<?php echo get_hero_button_link(); ?>" class="btn btn-primary btn-lg hover-shine btn-ripple" target="_blank" rel="noopener">
                            <i class="fas fa-calendar-alt"></i>
                            <?php echo get_hero_button_text(); ?>
                        </a>
                        <a href="<?php echo home_url('/services'); ?>" class="btn btn-outline btn-lg hover-lift">
                            <i class="fas fa-cut"></i>
                            View Services & Pricing
                        </a>
                    </div>
                </div>
                
                <div class="hero-features stagger-animation">
                    <div class="feature-card card hover-lift reveal-scale" data-delay="100">
                        <i class="fas fa-scissors"></i>
                        <h3>Expert Cutting</h3>
                        <p>Precision cuts tailored to your unique curl pattern and lifestyle</p>
                    </div>
                    <div class="feature-card card hover-lift reveal-scale" data-delay="200">
                        <i class="fas fa-palette"></i>
                        <h3>Color Mastery</h3>
                        <p>Goldwell certified colorists creating stunning, healthy transformations</p>
                    </div>
                    <div class="feature-card card hover-lift reveal-scale" data-delay="300">
                        <i class="fas fa-spa"></i>
                        <h3>Luxury Treatments</h3>
                        <p>Restorative treatments to enhance your hair's natural beauty</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="scroll-indicator">
            <div class="scroll-arrow"></div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about section" id="about">
        <div class="container">
            <div class="section-header text-center reveal">
                <span class="section-badge">About Us</span>
                <h2>Why Choose Shan Hair?</h2>
                <p>Discover the difference that expertise, passion, and personalized care can make for your hair.</p>
            </div>
            
            <div class="about-content">
                <div class="about-text reveal">
                    <div class="about-stats">
                        <div class="stat">
                            <div class="stat-number">30+</div>
                            <div class="stat-label">Years Experience</div>
                        </div>
                        <div class="stat">
                            <div class="stat-number">1000+</div>
                            <div class="stat-label">Happy Clients</div>
                        </div>
                        <div class="stat">
                            <div class="stat-number">3</div>
                            <div class="stat-label">Expert Stylists</div>
                        </div>
                    </div>
                    
                    <h3>OUR Salon</h3>
                    <p>Welcome to Shan Hair, Brookline's curl experts since 2011! With 30 years of experience, Shan and our talented team specialize in bringing out the best in curls (and all hair types), offering expert cuts, color, and more in a fun, friendly, and professional atmosphere. See why our clients love walking out confident and fabulous!</p>
                    
                    <div class="features-list">
                        <div class="feature-item">
                            <i class="fas fa-check-circle"></i>
                            <span>DevaCurl certified stylists with advanced training</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check-circle"></i>
                            <span>Pintura Highlighting specialists</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check-circle"></i>
                            <span>Personalized consultations and aftercare</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check-circle"></i>
                            <span>Innersense Organic Beauty products</span>
                        </div>
                    </div>
                    
                    <a href="<?php echo home_url('/about-us'); ?>" class="btn btn-secondary">More about us</a>
                </div>
                            <span>Premium products and cutting-edge techniques</span>
                        </div>
                    </div>
                    
                    <a href="<?php echo home_url('/about-us'); ?>" class="btn btn-secondary">Meet Our Team</a>
                </div>
                
                <div class="about-image reveal">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/about.jpg" alt="Professional hair salon interior" loading="lazy">
                    <div class="experience-badge">
                        <span class="badge-number">29+</span>
                        <span class="badge-text">Years of Excellence</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services section" id="services">
        <div class="container">
            <div class="section-header text-center reveal">
                <span class="section-badge">Our Services</span>
                <h2>Premium Hair Services</h2>
                <p>From precision cuts to stunning color transformations, we offer comprehensive hair services tailored to your needs.</p>
            </div>
            
            <div class="card-grid services-preview">
                <?php
                $services = new WP_Query(array(
                    'post_type' => 'service',
                    'posts_per_page' => 6,
                    'meta_key' => '_service_featured',
                    'meta_value' => 'yes'
                ));
                
                if ($services->have_posts()) :
                    while ($services->have_posts()) : $services->the_post();
                        $price_min = get_post_meta(get_the_ID(), '_service_price_min', true);
                        $price_max = get_post_meta(get_the_ID(), '_service_price_max', true);
                        $duration = get_post_meta(get_the_ID(), '_service_duration', true);
                ?>
                <div class="service-card card reveal">
                    <div class="card-icon">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('thumbnail'); ?>
                        <?php else : ?>
                            <i class="fas fa-cut"></i>
                        <?php endif; ?>
                    </div>
                    <h3><?php the_title(); ?></h3>
                    <p><?php echo wp_trim_words(get_the_content(), 15); ?></p>
                    
                    <?php if ($price_min && $price_max) : ?>
                    <div class="service-price">$<?php echo $price_min; ?> - $<?php echo $price_max; ?></div>
                    <?php endif; ?>
                    
                    <?php if ($duration) : ?>
                    <div class="service-duration">
                        <i class="fas fa-clock"></i>
                        <?php echo $duration; ?> minutes
                    </div>
                    <?php endif; ?>
                    
                    <a href="#contact" class="btn btn-outline service-book-btn" data-service="<?php the_title(); ?>">Book Service</a>
                </div>
                <?php 
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
            
            <div class="text-center reveal">
                <a href="<?php echo home_url('/services'); ?>" class="btn btn-primary btn-lg">View All Services & Pricing</a>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="products section" id="products">
        <div class="container">
            <div class="section-header text-center reveal">
                <span class="section-badge">Our Products</span>
                <h2>Clean. Pure. beautiful</h2>
                <h3>Innersense Organic Beauty</h3>
                <p>Check out our Innersense Organic products we use and recommend to our customers.</p>
            </div>
            
            <div class="products-content">
                <div class="product-hero reveal">
                    <div class="product-text">
                        <h3>Hand crafted products available here</h3>
                        <p>Want to order Innersense products directly from their site and still support us? Just click the link below—we'll get credit for your purchase!</p>
                        <p><strong>You can also shop with us in-salon or online anytime. Thanks for supporting Shan Hair!</strong></p>
                        
                        <div class="product-buttons">
                            <a href="https://shan-hair-retail.square.site/" target="_blank" rel="noopener" class="btn btn-primary">
                                <i class="fas fa-shopping-cart"></i>
                                Buy Now
                            </a>
                            <a href="https://shareasale.com/r.cfm?b=1131957&u=3493079&m=72573&urllink=&afftrack" target="_blank" rel="noopener" class="btn btn-outline">
                                <i class="fas fa-external-link-alt"></i>
                                Shop Innersense Direct
                            </a>
                        </div>
                    </div>
                    
                    <div class="product-image reveal">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/innersense-products.jpg" alt="Innersense Organic Beauty Products" loading="lazy">
                    </div>
                </div>
                
                <div class="product-features reveal">
                    <div class="feature-grid">
                        <div class="feature-item">
                            <i class="fas fa-leaf"></i>
                            <h4>Organic Ingredients</h4>
                            <p>Made with pure, organic ingredients for healthy hair</p>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-recycle"></i>
                            <h4>Eco-Friendly</h4>
                            <p>Sustainable packaging and environmentally conscious</p>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-heart"></i>
                            <h4>Salon Recommended</h4>
                            <p>Professional products we trust and use in our salon</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="gallery section" id="gallery">
        <div class="container">
            <div class="section-header text-center reveal">
                <span class="section-badge">Our Work</span>
                <h2>Hair Transformation Gallery</h2>
                <p>See the stunning results we create for our clients every day.</p>
            </div>
            
            <div class="gallery-filters reveal">
                <button class="filter-btn active" data-filter="all">All Work</button>
                <button class="filter-btn" data-filter="cutting">Cutting</button>
                <button class="filter-btn" data-filter="coloring">Coloring</button>
                <button class="filter-btn" data-filter="styling">Styling</button>
                <button class="filter-btn" data-filter="treatments">Treatments</button>
            </div>
            
            <div class="gallery-grid masonry-grid">
                <?php
                $gallery_items = new WP_Query(array(
                    'post_type' => 'gallery_item',
                    'posts_per_page' => 12
                ));
                
                if ($gallery_items->have_posts()) :
                    $counter = 1;
                    while ($gallery_items->have_posts()) : $gallery_items->the_post();
                        $categories = get_the_terms(get_the_ID(), 'gallery_category');
                        $category_classes = $categories ? implode(' ', wp_list_pluck($categories, 'slug')) : 'general';
                ?>
                <div class="masonry-item reveal" data-category="<?php echo esc_attr($category_classes); ?>">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('large', array('loading' => 'lazy', 'alt' => get_the_title())); ?>
                    <?php else : ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/gallery-<?php echo $counter; ?>.jpg" alt="<?php the_title(); ?>" loading="lazy">
                    <?php endif; ?>
                    
                    <div class="gallery-overlay">
                        <div class="overlay-content">
                            <h4><?php the_title(); ?></h4>
                            <p><?php echo get_the_excerpt(); ?></p>
                        </div>
                    </div>
                </div>
                <?php 
                        $counter++;
                        if ($counter > 8) $counter = 1;
                    endwhile;
                    wp_reset_postdata();
                else :
                    // Fallback to static images if no gallery items exist
                    for ($i = 1; $i <= 8; $i++) :
                ?>
                <div class="masonry-item reveal" data-category="cutting coloring">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/gallery-<?php echo $i; ?>.jpg" alt="Hair transformation <?php echo $i; ?>" loading="lazy">
                    <div class="gallery-overlay">
                        <div class="overlay-content">
                            <h4>Hair Transformation</h4>
                            <p>Professional styling and color work</p>
                        </div>
                    </div>
                </div>
                <?php 
                    endfor;
                endif;
                ?>
            </div>
            
            <div class="text-center reveal">
                <button id="load-more-gallery" class="btn btn-outline btn-lg">View More Work</button>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials section">
        <div class="container">
            <div class="section-header text-center reveal">
                <span class="section-badge">Client Reviews</span>
                <h2>What Our Clients Say</h2>
                <p>Real experiences from real people who trust us with their hair.</p>
            </div>
            
            <div class="testimonials-grid">
                <?php
                $testimonials = get_theme_mod('testimonials', array(
                    array(
                        'name' => 'Richelle N.',
                        'text' => 'He works so hard at his craft, pays attention to every detail and is a real gentleman. I enjoy going in and the hair services for curly hair, as everyone has already said, are unparalleled. Go! You will be so glad you did.',
                        'rating' => 5,
                        'service' => 'Customer'
                    ),
                    array(
                        'name' => 'Sarah M.',
                        'text' => 'Shan and his team are absolutely amazing! My curls have never looked better. The Pintura highlighting technique is exactly what my hair needed.',
                        'rating' => 5,
                        'service' => 'Pintura Highlighting'
                    ),
                    array(
                        'name' => 'Jennifer K.',
                        'text' => 'Best salon experience I\'ve ever had. Kiki really understood my hair type and gave me the perfect cut. I get compliments everywhere I go!',
                        'rating' => 5,
                        'service' => 'Signature Dry Cut'
                    )
                ));
                
                foreach ($testimonials as $testimonial) :
                ?>
                <div class="testi reveal">
                    <div class="testi-content">
                        <div class="stars">
                            <?php for ($i = 1; $i <= 5; $i++) : ?>
                                <i class="fas fa-star<?php echo $i <= $testimonial['rating'] ? '' : ' star-empty'; ?>"></i>
                            <?php endfor; ?>
                        </div>
                        <p>"<?php echo esc_html($testimonial['text']); ?>"</p>
                    </div>
                    <div class="testi-author">
                        <div class="author-info">
                            <h4><?php echo esc_html($testimonial['name']); ?></h4>
                            <span><?php echo esc_html($testimonial['service']); ?></span>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                
                <div class="yelp-reviews-link text-center reveal">
                    <p><strong>Want to read more reviews?</strong></p>
                    <a href="https://www.yelp.com/biz/shan-hair-brookline" target="_blank" rel="noopener" class="btn btn-outline">
                        <i class="fab fa-yelp"></i>
                        Click Here for Our Yelp Reviews
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact section" id="contact">
        <div class="container">
            <div class="section-header text-center reveal">
                <span class="section-badge">Book Now</span>
                <h2>Ready for Your Hair Transformation?</h2>
                <p>Book your appointment today and discover why our clients keep coming back.</p>
            </div>
            
            <div class="contact-content">
                <div class="contact-info reveal">
                    <h3>Visit Our Salon</h3>
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <h4>Location</h4>
                            <p><?php echo get_salon_address(); ?></p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <div>
                            <h4>Phone</h4>
                            <p><a href="tel:<?php echo str_replace(array('(', ')', ' ', '-'), '', get_salon_phone()); ?>"><?php echo get_salon_phone(); ?></a></p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <div>
                            <h4>Email</h4>
                            <p><a href="mailto:<?php echo get_salon_email(); ?>"><?php echo get_salon_email(); ?></a></p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <i class="fas fa-clock"></i>
                        <div>
                            <h4>Hours</h4>
                            <div class="hours-list">
                                <p><strong>Tuesday:</strong> 10:00 AM to 7:00 PM</p>
                                <p><strong>Wednesday:</strong> 9:00 AM to 6:00 PM</p>
                                <p><strong>Thursday:</strong> 9:00 AM to 7:00 PM</p>
                                <p><strong>Friday:</strong> 9:00 AM to 6:00 PM</p>
                                <p><strong>Saturday:</strong> 9:00 AM to 4:00 PM</p>
                                <p><strong>Sunday & Monday:</strong> Closed</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="social-links">
                        <h4>Follow Us</h4>
                        <div class="social-icons">
                            <?php $social_links = get_salon_social_links(); ?>
                            <a href="<?php echo esc_url($social_links['facebook']); ?>" aria-label="Facebook" target="_blank" rel="noopener"><i class="fab fa-facebook"></i></a>
                            <a href="<?php echo esc_url($social_links['instagram']); ?>" aria-label="Instagram" target="_blank" rel="noopener"><i class="fab fa-instagram"></i></a>
                            <a href="<?php echo esc_url($social_links['yelp']); ?>" aria-label="Yelp" target="_blank" rel="noopener"><i class="fab fa-yelp"></i></a>
                        </div>
                        <p class="social-handle">@shanhairboston</p>
                        <p><strong>follow us</strong></p>
                    </div>
                </div>
                
                <!-- WordPress Booking Form -->
                <div class="booking-form-container reveal">
                    <?php echo do_shortcode('[shan_hair_booking_form]'); ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Success Message -->
    <div id="success-message" class="success-message">
        <div class="success-content">
            <i class="fas fa-check-circle"></i>
            <h3>Booking Request Sent!</h3>
            <p>Thank you for your interest! We'll contact you within 24 hours to confirm your appointment.</p>
        </div>
    </div>

    <!-- Lightbox -->
    <div id="lightbox" class="lightbox">
        <button class="lightbox-close" aria-label="Close lightbox">&times;</button>
        <img class="lightbox-content" src="" alt="">
    </div>

<?php get_footer(); ?>
