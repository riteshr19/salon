<?php
/**
 * Default Stylists Template Part
 * Fallback content for stylists section
 */
?>

<!-- Shan Casey - Owner & Stylist -->
<div class="stylist-card reveal" data-stylist="shan-casey">
    <div class="stylist-image">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/avatar-1.jpg" alt="Shan Casey" loading="lazy">
        <div class="stylist-overlay">
            <button class="view-details-btn" data-stylist="shan-casey">View Details</button>
        </div>
    </div>
    <div class="stylist-info">
        <h3>Shan</h3>
        <p class="stylist-title">Stylist and Owner</p>
        <p class="experience">29 Years Experience</p>
        
        <div class="specialties">
            <span class="specialty">DevaCurl Certified</span>
            <span class="specialty">Goldwell Master</span>
            <span class="specialty">Dry Cutting Expert</span>
        </div>
        
        <div class="stylist-contact-info">
            <a href="mailto:info@shanhair.com" class="email-link">
                <i class="fas fa-envelope"></i> info@shanhair.com
            </a>
            <a href="https://www.vagaro.com/shk2pn" target="_blank" class="book-btn btn btn-primary btn-sm">Book with Shan</a>
        </div>
    </div>
</div>

<!-- Kiki Carter - Stylist -->
<div class="stylist-card reveal" data-stylist="kiki-carter">
    <div class="stylist-image">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/avatar-2.jpg" alt="Kiki Carter" loading="lazy">
        <div class="stylist-overlay">
            <button class="view-details-btn" data-stylist="kiki-carter">View Details</button>
        </div>
    </div>
    <div class="stylist-info">
        <h3>Kiki</h3>
        <p class="stylist-title">Advanced Stylist</p>
        <p class="experience">20+ Years Experience</p>
        
        <div class="specialties">
            <span class="specialty">DevaCurl Certified</span>
            <span class="specialty">Goldwell Master Colorist</span>
            <span class="specialty">RËZO Certified</span>
        </div>
        
        <div class="stylist-contact-info">
            <a href="mailto:kikic@shanhair.com" class="email-link">
                <i class="fas fa-envelope"></i> kikic@shanhair.com
            </a>
            <a href="https://www.vagaro.com/shk2pn" target="_blank" class="book-btn btn btn-primary btn-sm">Book with Kiki</a>
        </div>
    </div>
</div>

<!-- Caitlyn Roney - Stylist/Colorist -->
<div class="stylist-card reveal" data-stylist="caitlyn-roney">
    <div class="stylist-image">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/avatar-3.jpg" alt="Caitlyn Roney" loading="lazy">
        <div class="stylist-overlay">
            <button class="view-details-btn" data-stylist="caitlyn-roney">View Details</button>
        </div>
    </div>
    <div class="stylist-info">
        <h3>Caitlyn</h3>
        <p class="stylist-title">Stylist</p>
        <p class="experience">Toni & Guy Graduate</p>
        
        <div class="specialties">
            <span class="specialty">All Hair Textures</span>
            <span class="specialty">Cutting & Coloring</span>
            <span class="specialty">Curly Hair Specialist</span>
        </div>
        
        <div class="stylist-contact-info">
            <a href="mailto:Caitlyn@shanhair.com" class="email-link">
                <i class="fas fa-envelope"></i> Caitlyn@shanhair.com
            </a>
            <a href="https://www.vagaro.com/shk2pn" target="_blank" class="book-btn btn btn-primary btn-sm">Book with Caitlyn</a>
        </div>
    </div>
</div>

<!-- Stylist Detail Templates -->
<script type="text/template" id="shan-casey-details">
    <div class="stylist-detail-header">
        <div class="stylist-detail-image">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/avatar-1.jpg" alt="Shan Casey">
        </div>
        <div class="stylist-detail-info">
            <h2>Shan Casey</h2>
            <p class="title">Stylist & Owner</p>
            <div class="contact-buttons">
                <a href="mailto:info@shanhair.com" class="btn btn-outline">
                    <i class="fas fa-envelope"></i> Email Shan
                </a>
                <a href="https://www.vagaro.com/shk2pn" target="_blank" class="btn btn-primary">
                    <i class="fas fa-calendar"></i> Schedule Appointment
                </a>
            </div>
        </div>
    </div>
    
    <div class="stylist-detail-content">
        <div class="intro-text">
            <p>You've probably seen him around town on his vintage motorcycle, or maybe you've walked by the salon and heard him singing a David Bowie song. Or perhaps you found him on Yelp and read what a master stylist he is. Regardless of how you found Shan, you won't need another stylist. Ever.</p>
        </div>
        
        <div class="biography">
            <p>Meet Shan, the vibrant owner and stylist of Shan Hair! With a natural perfectionist attitude and an eye for detail, Shan views hair as a sculptural art form. In the salon, Shan follows a dry-cutting philosophy, giving each curl the individual attention it deserves. With 29 years of experience in the industry, Shan has honed his skills as a DevaCurl Educator for seven years, and he's excited to share his expertise with you.</p>
            
            <p>Shan's passion for hair extends beyond creating beautiful styles; he teaches you how to care for and gently embrace your curls. With Shan's creativity and dedication, you'll leave the salon feeling confident and beautiful.</p>
            
            <p>Even with over thirty years of experience, Shan continues his education and expands his technical ability through advanced Goldwell color training, creative cutting classes, or advanced curly hair training. He is committed to staying current with the industry's latest trends, styles, fashion, and design.</p>
        </div>
        
        <div class="specialties-detailed">
            <h3>Specialties</h3>
            <ul>
                <li>DevaCurl Educator (7 years)</li>
                <li>Goldwell Advanced Color Training</li>
                <li>Dry Cutting Philosophy</li>
                <li>Curly Hair Specialist</li>
                <li>Creative Cutting</li>
                <li>Hair Sculpture & Art</li>
            </ul>
        </div>
    </div>
</script>

<script type="text/template" id="kiki-carter-details">
    <div class="stylist-detail-header">
        <div class="stylist-detail-image">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/avatar-2.jpg" alt="Kiki Carter">
        </div>
        <div class="stylist-detail-info">
            <h2>Kiki Carter</h2>
            <p class="title">Stylist</p>
            <div class="contact-buttons">
                <a href="mailto:kikic@shanhair.com" class="btn btn-outline">
                    <i class="fas fa-envelope"></i> Email Kiki
                </a>
                <a href="https://www.vagaro.com/shk2pn" target="_blank" class="btn btn-primary">
                    <i class="fas fa-calendar"></i> Book with Kiki
                </a>
            </div>
        </div>
    </div>
    
    <div class="stylist-detail-content">
        <div class="biography">
            <p>Meet Kiki, our seasoned stylist who has provided exceptional beauty services to her clients for over 20 years. Kiki is passionate about bringing out the best in her clients, offering a listening ear and personalized service to each person she works with.</p>
            
            <p>With extensive training under Shan in curly hair techniques and dozens of color and cut classes outside the salon, Kiki is a true expert in her field. She is certified in DevaCurl cutting, a Goldwell Master Colorist, and in RËZO cutting and RËZO Lights.</p>
            
            <p>Kiki loves working with natural hair, offering healthy hair care solutions, and creating trendy and stylish looks for her clients.</p>
        </div>
        
        <div class="specialties-detailed">
            <h3>Certifications & Specialties</h3>
            <ul>
                <li>DevaCurl Cutting Certified</li>
                <li>Goldwell Master Colorist</li>
                <li>RËZO Cutting & RËZO Lights Certified</li>
                <li>Natural Hair Specialist</li>
                <li>Healthy Hair Care Solutions</li>
                <li>Curly Hair Techniques</li>
            </ul>
        </div>
        
        <div class="reviews-section">
            <h3>What Clients Say</h3>
            <p><em>"Kiki is amazing! She really listens to what you want and delivers beyond expectations. My curls have never looked better!"</em></p>
        </div>
    </div>
</script>

<script type="text/template" id="caitlyn-roney-details">
    <div class="stylist-detail-header">
        <div class="stylist-detail-image">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/avatar-3.jpg" alt="Caitlyn Roney">
        </div>
        <div class="stylist-detail-info">
            <h2>Caitlyn Roney</h2>
            <p class="title">Stylist/Colorist</p>
            <div class="contact-buttons">
                <a href="mailto:Caitlyn@shanhair.com" class="btn btn-outline">
                    <i class="fas fa-envelope"></i> Email Caitlyn
                </a>
                <a href="https://www.vagaro.com/shk2pn" target="_blank" class="btn btn-primary">
                    <i class="fas fa-calendar"></i> Schedule with Caitlyn
                </a>
            </div>
        </div>
    </div>
    
    <div class="stylist-detail-content">
        <div class="biography">
            <p>We're thrilled to welcome Caitlyn Roney to the Shan Hair team! Formerly of en.Salon, Caitlyn brings amazing talent in cutting and coloring, with a strong foundation in working with all hair textures.</p>
            
            <p>A Toni & Guy graduate and Massachusetts native, she's now excited to expand her skills even further in curly and textured hair. Her vibrant energy and passion for the craft make her a perfect addition to our salon family!</p>
        </div>
        
        <div class="specialties-detailed">
            <h3>Background & Specialties</h3>
            <ul>
                <li>Toni & Guy Graduate</li>
                <li>Expert in All Hair Textures</li>
                <li>Cutting & Coloring Specialist</li>
                <li>Curly & Textured Hair</li>
                <li>Vibrant Energy & Passion</li>
                <li>en.Salon Experience</li>
            </ul>
        </div>
    </div>
</script>
