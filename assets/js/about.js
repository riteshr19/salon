/**
 * About Page Premium JavaScript
 * Enhanced functionality for stylist interactions, modal displays, and animations
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // Initialize all about page functionality
    initStylistCards();
    initStylistModal();
    initScrollAnimations();
    initBeforeAfterGallery();
    initSmoothScrolling();
    
    /**
     * Initialize stylist card interactions
     */
    function initStylistCards() {
        const stylistCards = document.querySelectorAll('.stylist-card');
        
        stylistCards.forEach(card => {
            const viewDetailsBtn = card.querySelector('.view-details-btn');
            
            // Add hover effects
            card.addEventListener('mouseenter', function() {
                this.classList.add('hovered');
            });
            
            card.addEventListener('mouseleave', function() {
                this.classList.remove('hovered');
            });
            
            // Handle view details button click
            if (viewDetailsBtn) {
                viewDetailsBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    const stylistId = this.getAttribute('data-stylist');
                    showStylistDetails(stylistId);
                });
            }
            
            // Handle card click
            card.addEventListener('click', function(e) {
                if (!e.target.closest('.btn') && !e.target.closest('a')) {
                    const stylistId = this.getAttribute('data-stylist');
                    showStylistDetails(stylistId);
                }
            });
        });
    }
    
    /**
     * Show stylist details in modal
     */
    function showStylistDetails(stylistId) {
        const modal = document.getElementById('stylist-modal');
        const modalBody = document.getElementById('stylist-details');
        
        if (!modal || !modalBody) return;
        
        // Get stylist details template
        const detailsTemplate = document.getElementById(stylistId + '-details');
        
        if (detailsTemplate) {
            // Clear previous content
            modalBody.innerHTML = '';
            
            // Clone template content
            const templateContent = detailsTemplate.content || detailsTemplate;
            const clonedContent = templateContent.cloneNode ? 
                templateContent.cloneNode(true) : 
                document.createElement('div');
            
            if (!templateContent.cloneNode) {
                clonedContent.innerHTML = templateContent.innerHTML;
            }
            
            modalBody.appendChild(clonedContent);
            
            // Show modal with animation
            modal.classList.add('active');
            document.body.classList.add('modal-open');
            
            // Add entrance animation
            setTimeout(() => {
                modal.classList.add('animate-in');
            }, 10);
            
            // Track analytics
            if (typeof gtag !== 'undefined') {
                gtag('event', 'view_stylist_details', {
                    'stylist_name': stylistId.replace('-', ' '),
                    'event_category': 'engagement'
                });
            }
        }
    }
    
    /**
     * Initialize stylist modal functionality
     */
    function initStylistModal() {
        const modal = document.getElementById('stylist-modal');
        if (!modal) return;
        
        const modalClose = modal.querySelector('.modal-close');
        const modalContent = modal.querySelector('.modal-content');
        
        // Close modal on close button click
        if (modalClose) {
            modalClose.addEventListener('click', closeStylistModal);
        }
        
        // Close modal on overlay click
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeStylistModal();
            }
        });
        
        // Prevent modal content clicks from closing modal
        if (modalContent) {
            modalContent.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        }
        
        // Close modal on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modal.classList.contains('active')) {
                closeStylistModal();
            }
        });
    }
    
    /**
     * Close stylist modal
     */
    function closeStylistModal() {
        const modal = document.getElementById('stylist-modal');
        if (!modal) return;
        
        modal.classList.remove('animate-in');
        
        setTimeout(() => {
            modal.classList.remove('active');
            document.body.classList.remove('modal-open');
        }, 300);
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
     * Initialize before/after gallery
     */
    function initBeforeAfterGallery() {
        const beforeAfterItems = document.querySelectorAll('.before-after-item');
        
        beforeAfterItems.forEach(item => {
            item.addEventListener('click', function() {
                this.classList.toggle('flipped');
            });
            
            // Add touch support for mobile
            let touchStartX = 0;
            let touchEndX = 0;
            
            item.addEventListener('touchstart', function(e) {
                touchStartX = e.changedTouches[0].screenX;
            });
            
            item.addEventListener('touchend', function(e) {
                touchEndX = e.changedTouches[0].screenX;
                
                if (Math.abs(touchEndX - touchStartX) > 50) {
                    this.classList.toggle('flipped');
                }
            });
        });
    }
    
    /**
     * Smooth scrolling for CTA buttons
     */
    function initSmoothScrolling() {
        const ctaButtons = document.querySelectorAll('a[href^="#"]');
        
        ctaButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                
                if (targetElement) {
                    e.preventDefault();
                    
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    }
    
    // Loading animation
    window.addEventListener('load', function() {
        document.body.classList.add('loaded');
    });
    
    // Performance optimization: Lazy load images
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src || img.src;
                    img.classList.remove('lazy');
                    observer.unobserve(img);
                }
            });
        });
        
        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }
});

// Utility functions
const StylistUtils = {
    
    /**
     * Format phone number for display
     */
    formatPhone: function(phone) {
        const cleaned = phone.replace(/\D/g, '');
        const match = cleaned.match(/^(\d{3})(\d{3})(\d{4})$/);
        return match ? `(${match[1]}) ${match[2]}-${match[3]}` : phone;
    },
    
    /**
     * Validate email format
     */
    isValidEmail: function(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    },
    
    /**
     * Track user interactions for analytics
     */
    trackEvent: function(action, category = 'engagement', label = '') {
        if (typeof gtag !== 'undefined') {
            gtag('event', action, {
                'event_category': category,
                'event_label': label
            });
        }
    }
};
