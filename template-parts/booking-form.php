<?php
/**
 * Booking Form Template Part
 * WordPress-integrated booking system
 */
?>

<div class="booking-form-wrapper">
    <div class="booking-form-header">
        <h3>Book Your Appointment</h3>
        <p>Fill out the form below and we'll contact you within 24 hours to confirm your appointment.</p>
    </div>

    <form id="booking-form" class="booking-form" method="POST" action="">
        <?php wp_nonce_field('shan_hair_booking', 'booking_nonce'); ?>
        
        <div class="form-row">
            <div class="form-group">
                <label for="firstName">First Name *</label>
                <input type="text" id="firstName" name="firstName" required>
            </div>
            <div class="form-group">
                <label for="lastName">Last Name *</label>
                <input type="text" id="lastName" name="lastName" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="email">Email Address *</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number *</label>
                <input type="tel" id="phone" name="phone" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="service-select">Preferred Service *</label>
                <select id="service-select" name="service" required>
                    <option value="">Select a Service</option>
                    <optgroup label="Cutting">
                        <option value="Express Dry Cut">Express Dry Cut ($75-$90)</option>
                        <option value="Signature Dry Haircut">Signature Dry Haircut ($85-$125)</option>
                        <option value="Multi/Long Dry Haircut">Multi/Long Dry Haircut ($100-$145)</option>
                        <option value="Straight Wet Haircut">Straight Wet Haircut ($75-$110)</option>
                        <option value="Short Haircut">Short Haircut ($75-$85)</option>
                        <option value="Bang Trim">Bang Trim ($20-$25)</option>
                    </optgroup>
                    <optgroup label="Styling">
                        <option value="Blow Dry">Blow Dry ($50-$60)</option>
                        <option value="Natural Curl Styling">Natural Curl Styling ($40-$50)</option>
                        <option value="Special Occasion Style">Special Occasion Style ($80-$110)</option>
                        <option value="Natural Hair Styling">Natural Hair Styling (Starting @ $90)</option>
                    </optgroup>
                    <optgroup label="Coloring">
                        <option value="All Over Color">All Over Color ($90-$130)</option>
                        <option value="Regrowth Only">Regrowth Only ($80-$100)</option>
                        <option value="Pintura Partial">Pintura Highlighting Partial (Starting @ $145)</option>
                        <option value="Pintura Full">Pintura Highlighting Full (Starting @ $205)</option>
                        <option value="Fashion Coloring">Fashion Coloring (Starting @ $155)</option>
                        <option value="Foil Highlighting">Foil Highlighting (Starting @ $135)</option>
                    </optgroup>
                    <optgroup label="Treatments">
                        <option value="Steam Treatment">Conditioning Steam Treatment ($60)</option>
                        <option value="Deep Conditioning">Deep Conditioning Treatment ($45-$55)</option>
                    </optgroup>
                </select>
            </div>
            <div class="form-group">
                <label for="stylist-select">Preferred Stylist</label>
                <select id="stylist-select" name="stylist">
                    <option value="">No Preference</option>
                    <option value="Shan">Shan (Owner & Stylist)</option>
                    <option value="Kiki">Kiki (Advanced Stylist)</option>
                    <option value="Caitlyn">Caitlyn (Stylist)</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="preferred-date">Preferred Date</label>
                <input type="date" id="preferred-date" name="date" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
            </div>
            <div class="form-group">
                <label for="preferred-time">Preferred Time</label>
                <select id="preferred-time" name="time">
                    <option value="">Flexible</option>
                    <option value="9:00 AM">9:00 AM</option>
                    <option value="9:30 AM">9:30 AM</option>
                    <option value="10:00 AM">10:00 AM</option>
                    <option value="10:30 AM">10:30 AM</option>
                    <option value="11:00 AM">11:00 AM</option>
                    <option value="11:30 AM">11:30 AM</option>
                    <option value="12:00 PM">12:00 PM</option>
                    <option value="12:30 PM">12:30 PM</option>
                    <option value="1:00 PM">1:00 PM</option>
                    <option value="1:30 PM">1:30 PM</option>
                    <option value="2:00 PM">2:00 PM</option>
                    <option value="2:30 PM">2:30 PM</option>
                    <option value="3:00 PM">3:00 PM</option>
                    <option value="3:30 PM">3:30 PM</option>
                    <option value="4:00 PM">4:00 PM</option>
                    <option value="4:30 PM">4:30 PM</option>
                    <option value="5:00 PM">5:00 PM</option>
                    <option value="5:30 PM">5:30 PM</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="notes">Special Requests or Notes</label>
            <textarea id="notes" name="notes" rows="4" placeholder="Any special requests, concerns, or additional information..."></textarea>
        </div>

        <div class="form-group consent-group">
            <div class="checkbox-wrapper">
                <input type="checkbox" id="consent" name="consent" required>
                <label for="consent">I understand the <a href="#" class="policy-link">cancellation policy</a> and preparation requirements for curly hair services. *</label>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary btn-lg submit-booking">
                <i class="fas fa-calendar-check"></i>
                Submit Booking Request
            </button>
            
            <div class="alternative-booking">
                <p>Or book directly online:</p>
                <a href="<?php echo get_booking_url(); ?>" target="_blank" class="btn btn-outline btn-lg" rel="noopener">
                    <i class="fas fa-external-link-alt"></i>
                    Book on Vagaro
                </a>
            </div>
        </div>
    </form>

    <!-- Important Information -->
    <div class="booking-important-info">
        <div class="info-card">
            <div class="info-icon">
                <i class="fas fa-info-circle"></i>
            </div>
            <div class="info-content">
                <h4>Important for Curly Hair Customers:</h4>
                <p>Please arrive with your curls dry, detangled, and worn down in their natural state. Avoid buns, ponytails, or clips. This helps us give you the best dry cut possible!</p>
            </div>
        </div>
        
        <div class="contact-alternatives">
            <h4>Prefer to Call?</h4>
            <p>
                <a href="tel:<?php echo str_replace(array('(', ')', ' ', '-'), '', get_salon_phone()); ?>" class="phone-link">
                    <i class="fas fa-phone"></i>
                    <?php echo get_salon_phone(); ?>
                </a>
            </p>
            <p>
                <a href="mailto:<?php echo get_salon_email(); ?>" class="email-link">
                    <i class="fas fa-envelope"></i>
                    <?php echo get_salon_email(); ?>
                </a>
            </p>
        </div>
    </div>
</div>

<style>
.booking-form-wrapper {
    max-width: 600px;
    margin: 0 auto;
    padding: 2rem;
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.booking-form-header {
    text-align: center;
    margin-bottom: 2rem;
}

.booking-form-header h3 {
    color: #2c3e50;
    margin-bottom: 0.5rem;
    font-size: 1.5rem;
}

.booking-form-header p {
    color: #7f8c8d;
    font-size: 0.95rem;
}

.booking-form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
    }
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group label {
    margin-bottom: 0.5rem;
    font-weight: 600;
    color: #2c3e50;
    font-size: 0.9rem;
}

.form-group input,
.form-group select,
.form-group textarea {
    padding: 0.75rem;
    border: 2px solid #e9ecef;
    border-radius: 6px;
    font-size: 1rem;
    transition: border-color 0.3s ease;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #3498db;
    box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
}

.form-group input.valid {
    border-color: #27ae60;
}

.form-group input.invalid {
    border-color: #e74c3c;
}

.validation-error {
    color: #e74c3c;
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

.consent-group {
    margin: 1rem 0;
}

.checkbox-wrapper {
    display: flex;
    align-items: flex-start;
    gap: 0.5rem;
}

.checkbox-wrapper input[type="checkbox"] {
    margin-top: 0.25rem;
}

.checkbox-wrapper label {
    margin-bottom: 0;
    font-size: 0.9rem;
    line-height: 1.4;
}

.policy-link {
    color: #3498db;
    text-decoration: none;
}

.policy-link:hover {
    text-decoration: underline;
}

.form-actions {
    margin-top: 1rem;
    text-align: center;
}

.submit-booking {
    width: 100%;
    margin-bottom: 1rem;
}

.alternative-booking {
    padding-top: 1rem;
    border-top: 1px solid #e9ecef;
}

.alternative-booking p {
    margin-bottom: 0.5rem;
    color: #7f8c8d;
    font-size: 0.9rem;
}

.booking-important-info {
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid #e9ecef;
}

.info-card {
    display: flex;
    gap: 1rem;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 8px;
    margin-bottom: 1.5rem;
}

.info-icon {
    color: #3498db;
    font-size: 1.2rem;
    margin-top: 0.2rem;
}

.info-content h4 {
    margin-bottom: 0.5rem;
    color: #2c3e50;
    font-size: 1rem;
}

.info-content p {
    color: #7f8c8d;
    font-size: 0.9rem;
    line-height: 1.4;
}

.contact-alternatives {
    text-align: center;
}

.contact-alternatives h4 {
    margin-bottom: 0.75rem;
    color: #2c3e50;
}

.phone-link,
.email-link {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: #3498db;
    text-decoration: none;
    font-weight: 500;
    margin: 0 1rem;
}

.phone-link:hover,
.email-link:hover {
    color: #2980b9;
}

.form-message {
    padding: 1rem;
    border-radius: 6px;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.form-message.error {
    background: #fee;
    color: #c33;
    border: 1px solid #fcc;
}

.form-message.info {
    background: #e3f2fd;
    color: #1565c0;
    border: 1px solid #bbdefb;
}
</style>
