/**
 * Main Premium JavaScript
 * Core functionality for the Shan Hair salon website
 * Enhanced with performance optimizations, accessibility, and premium UX
 */

(function() {
    'use strict';
    
    // Global variables
    let isLoaded = false;
    let scrollPosition = 0;
    
    // Initialize everything when DOM is ready
    document.addEventListener('DOMContentLoaded', initializeApp);
    
    /**
     * Main initialization function
     */
    function initializeApp() {
        initScrollAnimations();
        initSmoothScrolling();
        initMobileMenu();
        initContactForm();
        initLazyLoading();
        initPerformanceOptimizations();
        initAccessibility();
        
        // Mark as loaded
        isLoaded = true;
        document.body.classList.add('app-initialized');
    }
    
    /**
     * Initialize scroll-based animations
     */
    function initScrollAnimations() {
        if (!window.IntersectionObserver) return;
        
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, observerOptions);
        
        // Observe all elements with reveal class
        document.querySelectorAll('.reveal').forEach(element => {
            revealObserver.observe(element);
        });
        
        // Counter animations for statistics
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    counterObserver.unobserve(entry.target);
                }
            });
        }, observerOptions);
        
        document.querySelectorAll('.counter').forEach(element => {
            counterObserver.observe(element);
        });
    }
    
    /**
     * Animate counter numbers
     */
    function animateCounter(element) {
        const target = parseInt(element.getAttribute('data-target'));
        const duration = parseInt(element.getAttribute('data-duration')) || 2000;
        const step = target / (duration / 16); // 60 FPS
        let current = 0;
        
        const timer = setInterval(() => {
            current += step;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            element.textContent = Math.floor(current);
        }, 16);
    }
    
    /**
     * Initialize smooth scrolling for anchor links
     */
    function initSmoothScrolling() {
        document.querySelectorAll('a[href^="#"]').forEach(link => {
            link.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if (!targetElement) return;
                
                e.preventDefault();
                
                // Calculate offset for fixed header
                const headerHeight = document.querySelector('.site-header')?.offsetHeight || 0;
                const targetPosition = targetElement.offsetTop - headerHeight;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
                
                // Update URL without jumping
                if (history.pushState) {
                    history.pushState(null, null, targetId);
                }
            });
        });
    }
    
    /**
     * Initialize mobile menu functionality
     */
    function initMobileMenu() {
        const mobileToggle = document.querySelector('.mobile-menu-toggle');
        const mobileMenu = document.querySelector('.mobile-menu');
        const menuOverlay = document.querySelector('.menu-overlay');
        
        if (!mobileToggle || !mobileMenu) return;
        
        // Toggle mobile menu
        mobileToggle.addEventListener('click', function() {
            const isOpen = mobileMenu.classList.contains('active');
            
            if (isOpen) {
                closeMobileMenu();
            } else {
                openMobileMenu();
            }
        });
        
        // Close on overlay click
        if (menuOverlay) {
            menuOverlay.addEventListener('click', closeMobileMenu);
        }
        
        // Close on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && mobileMenu.classList.contains('active')) {
                closeMobileMenu();
            }
        });
        
        // Close mobile menu when clicking on menu links
        mobileMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                setTimeout(closeMobileMenu, 300); // Small delay for UX
            });
        });
        
        function openMobileMenu() {
            mobileMenu.classList.add('active');
            mobileToggle.classList.add('active');
            document.body.classList.add('menu-open');
            
            // Set focus to first menu item for accessibility
            const firstMenuItem = mobileMenu.querySelector('a');
            if (firstMenuItem) {
                firstMenuItem.focus();
            }
        }
        
        function closeMobileMenu() {
            mobileMenu.classList.remove('active');
            mobileToggle.classList.remove('active');
            document.body.classList.remove('menu-open');
        }
    }
    
    /**
     * Initialize contact form functionality
     */
    function initContactForm() {
        const contactForm = document.getElementById('contact-form');
        if (!contactForm) return;
        
        const submitButton = contactForm.querySelector('button[type="submit"]');
        const messageContainer = document.getElementById('form-message');
        
        contactForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            if (!validateForm(contactForm)) return;
            
            // Show loading state
            if (submitButton) {
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
            }
            
            try {
                const formData = new FormData(contactForm);
                
                // Simulate form submission (replace with actual endpoint)
                await new Promise(resolve => setTimeout(resolve, 1500));
                
                showMessage('Thank you for your message! We\'ll get back to you soon.', 'success');
                contactForm.reset();
                
                // Track form submission
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'form_submit', {
                        'form_name': 'contact_form',
                        'event_category': 'conversion'
                    });
                }
                
            } catch (error) {
                showMessage('Sorry, there was an error sending your message. Please try again.', 'error');
                console.error('Form submission error:', error);
            } finally {
                // Reset button state
                if (submitButton) {
                    submitButton.disabled = false;
                    submitButton.innerHTML = 'Send Message';
                }
            }
        });
        
        function validateForm(form) {
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    showFieldError(field, 'This field is required');
                    isValid = false;
                } else {
                    clearFieldError(field);
                }
            });
            
            // Email validation
            const emailField = form.querySelector('input[type="email"]');
            if (emailField && emailField.value) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(emailField.value)) {
                    showFieldError(emailField, 'Please enter a valid email address');
                    isValid = false;
                }
            }
            
            return isValid;
        }
        
        function showFieldError(field, message) {
            clearFieldError(field);
            
            const errorElement = document.createElement('div');
            errorElement.className = 'field-error';
            errorElement.textContent = message;
            
            field.classList.add('error');
            field.parentNode.appendChild(errorElement);
        }
        
        function clearFieldError(field) {
            field.classList.remove('error');
            const errorElement = field.parentNode.querySelector('.field-error');
            if (errorElement) {
                errorElement.remove();
            }
        }
        
        function showMessage(message, type) {
            if (!messageContainer) return;
            
            messageContainer.textContent = message;
            messageContainer.className = `form-message ${type}`;
            messageContainer.style.display = 'block';
            
            // Hide after 5 seconds
            setTimeout(() => {
                messageContainer.style.display = 'none';
            }, 5000);
        }
    }
    
    /**
     * Initialize lazy loading for images
     */
    function initLazyLoading() {
        if (!window.IntersectionObserver) return;
        
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                    }
                    
                    if (img.dataset.srcset) {
                        img.srcset = img.dataset.srcset;
                        img.removeAttribute('data-srcset');
                    }
                    
                    img.classList.remove('lazy');
                    img.classList.add('lazy-loaded');
                    
                    imageObserver.unobserve(img);
                }
            });
        });
        
        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }
    
    /**
     * Initialize performance optimizations
     */
    function initPerformanceOptimizations() {
        // Preload critical resources
        preloadCriticalResources();
        
        // Optimize scroll performance
        optimizeScrollPerformance();
        
        // Initialize service worker if available
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/sw.js').catch(() => {
                // Service worker registration failed, but continue
            });
        }
    }
    
    function preloadCriticalResources() {
        // Preload hero image
        const heroImage = document.querySelector('.hero img');
        if (heroImage && heroImage.src) {
            const link = document.createElement('link');
            link.rel = 'preload';
            link.as = 'image';
            link.href = heroImage.src;
            document.head.appendChild(link);
        }
    }
    
    function optimizeScrollPerformance() {
        let ticking = false;
        
        function updateScrollPosition() {
            scrollPosition = window.pageYOffset;
            
            // Update header on scroll
            const header = document.querySelector('.site-header');
            if (header) {
                if (scrollPosition > 100) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            }
            
            ticking = false;
        }
        
        function requestTick() {
            if (!ticking) {
                requestAnimationFrame(updateScrollPosition);
                ticking = true;
            }
        }
        
        window.addEventListener('scroll', requestTick, { passive: true });
    }
    
    /**
     * Initialize accessibility features
     */
    function initAccessibility() {
        // Skip to content link
        initSkipToContent();
        
        // Focus management for modals
        initFocusManagement();
        
        // Keyboard navigation
        initKeyboardNavigation();
        
        // ARIA live regions
        initAriaLiveRegions();
    }
    
    function initSkipToContent() {
        const skipLink = document.querySelector('.skip-to-content');
        if (!skipLink) return;
        
        skipLink.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector('#main');
            if (target) {
                target.focus();
                target.scrollIntoView();
            }
        });
    }
    
    function initFocusManagement() {
        // Store focus before opening modals
        let lastFocusedElement = null;
        
        document.addEventListener('modal:open', function() {
            lastFocusedElement = document.activeElement;
        });
        
        document.addEventListener('modal:close', function() {
            if (lastFocusedElement) {
                lastFocusedElement.focus();
                lastFocusedElement = null;
            }
        });
    }
    
    function initKeyboardNavigation() {
        // Trap focus in modals
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Tab') {
                const modal = document.querySelector('.modal.active');
                if (modal) {
                    trapFocus(modal, e);
                }
            }
        });
        
        function trapFocus(container, event) {
            const focusableElements = container.querySelectorAll(
                'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
            );
            
            const firstElement = focusableElements[0];
            const lastElement = focusableElements[focusableElements.length - 1];
            
            if (event.shiftKey) {
                if (document.activeElement === firstElement) {
                    event.preventDefault();
                    lastElement.focus();
                }
            } else {
                if (document.activeElement === lastElement) {
                    event.preventDefault();
                    firstElement.focus();
                }
            }
        }
    }
    
    function initAriaLiveRegions() {
        // Create live region for dynamic announcements
        const liveRegion = document.createElement('div');
        liveRegion.setAttribute('aria-live', 'polite');
        liveRegion.setAttribute('aria-atomic', 'true');
        liveRegion.className = 'sr-only';
        document.body.appendChild(liveRegion);
        
        // Global function to announce messages
        window.announceToScreenReader = function(message) {
            liveRegion.textContent = message;
            setTimeout(() => {
                liveRegion.textContent = '';
            }, 1000);
        };
    }
    
    // Utility functions
    window.ShanHairUtils = {
        /**
         * Debounce function for performance
         */
        debounce: function(func, wait, immediate) {
            let timeout;
            return function executedFunction() {
                const context = this;
                const args = arguments;
                const later = function() {
                    timeout = null;
                    if (!immediate) func.apply(context, args);
                };
                const callNow = immediate && !timeout;
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
                if (callNow) func.apply(context, args);
            };
        },
        
        /**
         * Throttle function for scroll events
         */
        throttle: function(func, limit) {
            let inThrottle;
            return function() {
                const args = arguments;
                const context = this;
                if (!inThrottle) {
                    func.apply(context, args);
                    inThrottle = true;
                    setTimeout(() => inThrottle = false, limit);
                }
            };
        },
        
        /**
         * Check if element is in viewport
         */
        isInViewport: function(element) {
            const rect = element.getBoundingClientRect();
            return (
                rect.top >= 0 &&
                rect.left >= 0 &&
                rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
                rect.right <= (window.innerWidth || document.documentElement.clientWidth)
            );
        }
    };
    
})();
