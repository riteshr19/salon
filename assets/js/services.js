/**
 * Services Page Premium JavaScript
 * Enhanced functionality for service tabs, pricing displays, and booking interactions
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // Initialize all services page functionality
    initServiceTabs();
    initScrollAnimations();
    initServiceCards();
    initBookingButtons();
    initPoliciesAccordion();
    
    /**
     * Initialize service tab functionality
     */
    function initServiceTabs() {
        const tabButtons = document.querySelectorAll('.tab-btn');
        const tabContents = document.querySelectorAll('.tab-content');
        
        tabButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                
                const targetTab = this.getAttribute('data-tab');
                
                // Remove active class from all tabs and contents
                tabButtons.forEach(btn => btn.classList.remove('active'));
                tabContents.forEach(content => content.classList.remove('active'));
                
                // Add active class to clicked tab and corresponding content
                this.classList.add('active');
                const targetContent = document.getElementById(targetTab + '-tab');
                if (targetContent) {
                    targetContent.classList.add('active');
                    
                    // Trigger animation for service cards in the new tab
                    const serviceCards = targetContent.querySelectorAll('.service-card');
                    serviceCards.forEach((card, index) => {
                        setTimeout(() => {
                            card.classList.add('animate-in');
                        }, index * 100);
                    });
                }
                
                // Track tab changes for analytics
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'tab_change', {
                        'tab_name': targetTab,
                        'event_category': 'engagement'
                    });
                }
            });
        });
    }
    
    /**
     * Initialize service card interactions
     */
    function initServiceCards() {
        const serviceCards = document.querySelectorAll('.service-card');
        
        serviceCards.forEach(card => {
            // Add hover effects
            card.addEventListener('mouseenter', function() {
                this.classList.add('hovered');
                
                // Add subtle animation to price
                const price = this.querySelector('.service-price');
                if (price) {
                    price.classList.add('pulse');
                }
            });
            
            card.addEventListener('mouseleave', function() {
                this.classList.remove('hovered');
                
                // Remove price animation
                const price = this.querySelector('.service-price');
                if (price) {
                    price.classList.remove('pulse');
                }
            });
            
            // Handle card click for mobile
            card.addEventListener('click', function(e) {
                if (e.target.closest('.btn')) return; // Don't trigger on button clicks
                
                // Toggle expanded state on mobile
                if (window.innerWidth <= 768) {
                    this.classList.toggle('expanded');
                }
            });
        });
    }
    
    /**
     * Initialize booking button interactions
     */
    function initBookingButtons() {
        const bookingButtons = document.querySelectorAll('.btn[href*="vagaro"], .btn[href*="tel:"]');
        
        bookingButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                // Add click animation
                this.classList.add('clicked');
                
                setTimeout(() => {
                    this.classList.remove('clicked');
                }, 300);
                
                // Track booking button clicks
                const serviceName = this.closest('.service-card')?.querySelector('h3')?.textContent || 'unknown';
                const isPhone = this.href.includes('tel:');
                
                if (typeof gtag !== 'undefined') {
                    gtag('event', isPhone ? 'phone_booking' : 'online_booking', {
                        'service_name': serviceName,
                        'event_category': 'conversion'
                    });
                }
            });
            
            // Add loading state for external links
            if (button.href.includes('vagaro')) {
                button.addEventListener('click', function() {
                    const originalText = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
                    this.classList.add('loading');
                    
                    // Reset after a delay (in case user comes back)
                    setTimeout(() => {
                        this.innerHTML = originalText;
                        this.classList.remove('loading');
                    }, 3000);
                });
            }
        });
    }
    
    /**
     * Initialize scroll animations
     */
    function initScrollAnimations() {
        const revealElements = document.querySelectorAll('.reveal');
        
        const revealObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });
        
        revealElements.forEach(element => {
            revealObserver.observe(element);
        });
    }
    
    /**
     * Initialize policies accordion
     */
    function initPoliciesAccordion() {
        const policyCards = document.querySelectorAll('.policy-card');
        
        policyCards.forEach(card => {
            const header = card.querySelector('.policy-header');
            
            if (header) {
                header.addEventListener('click', function() {
                    const isExpanded = card.classList.contains('expanded');
                    
                    // Close all other policy cards
                    policyCards.forEach(otherCard => {
                        if (otherCard !== card) {
                            otherCard.classList.remove('expanded');
                        }
                    });
                    
                    // Toggle current card
                    card.classList.toggle('expanded', !isExpanded);
                });
            }
        });
    }
    
    // Loading animation
    window.addEventListener('load', function() {
        document.body.classList.add('loaded');
    });
});
