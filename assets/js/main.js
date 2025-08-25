
/**
 * Shan Hair - Premium Salon Website
 * Enhanced JavaScript functionality
 */

// Enhanced mobile navigation
class Navigation {
  constructor() {
    this.toggle = document.querySelector('.nav-toggle');
    this.nav = document.querySelector('.site-nav');
    this.header = document.querySelector('.site-header');
    this.init();
  }

  init() {
    if (this.toggle) {
      this.toggle.addEventListener('click', () => this.toggleNav());
    }
    
    // Close nav when clicking outside
    document.addEventListener('click', (e) => {
      if (!this.nav.contains(e.target) && !this.toggle.contains(e.target)) {
        this.closeNav();
      }
    });

    // Add scroll effect to header
    window.addEventListener('scroll', () => this.handleScroll());
    
    // Smooth scroll for internal anchors
    this.setupSmoothScroll();
  }

  toggleNav() {
    this.nav.classList.toggle('open');
    this.toggle.classList.toggle('active');
    this.toggle.setAttribute('aria-expanded', 
      this.nav.classList.contains('open') ? 'true' : 'false'
    );
  }

  closeNav() {
    this.nav.classList.remove('open');
    this.toggle.classList.remove('active');
    this.toggle.setAttribute('aria-expanded', 'false');
  }

  handleScroll() {
    if (window.scrollY > 100) {
      this.header.classList.add('scrolled');
    } else {
      this.header.classList.remove('scrolled');
    }
  }

  setupSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', (e) => {
        const id = anchor.getAttribute('href').slice(1);
        const target = document.getElementById(id);
        
        if (target) {
          e.preventDefault();
          const offsetTop = target.offsetTop - 80;
          
          window.scrollTo({
            top: offsetTop,
            behavior: 'smooth'
          });
          
          this.closeNav();
        }
      });
    });
  }
}

// Enhanced scroll reveal with Intersection Observer
class ScrollReveal {
  constructor() {
    this.observerOptions = {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    };
    this.init();
  }

  init() {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry, index) => {
        if (entry.isIntersecting) {
          setTimeout(() => {
            entry.target.classList.add('in-view');
          }, index * 100); // Stagger animation
        }
      });
    }, this.observerOptions);

    document.querySelectorAll('.reveal').forEach(el => {
      observer.observe(el);
    });
  }
}

// Gallery filtering and lightbox
class Gallery {
  constructor() {
    this.filterButtons = document.querySelectorAll('.filter-btn');
    this.galleryItems = document.querySelectorAll('.masonry-item');
    this.lightbox = document.getElementById('lightbox');
    this.lightboxImg = this.lightbox?.querySelector('.lightbox-content');
    this.lightboxClose = this.lightbox?.querySelector('.lightbox-close');
    this.loadMoreBtn = document.getElementById('load-more-gallery');
    
    this.init();
  }

  init() {
    // Filter functionality
    this.filterButtons.forEach(btn => {
      btn.addEventListener('click', () => this.handleFilter(btn));
    });

    // Lightbox functionality
    this.galleryItems.forEach(item => {
      item.addEventListener('click', () => this.openLightbox(item));
    });

    if (this.lightboxClose) {
      this.lightboxClose.addEventListener('click', () => this.closeLightbox());
    }

    if (this.lightbox) {
      this.lightbox.addEventListener('click', (e) => {
        if (e.target === this.lightbox) this.closeLightbox();
      });
    }

    // Keyboard navigation for lightbox
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') this.closeLightbox();
    });

    // Load more functionality
    if (this.loadMoreBtn) {
      this.loadMoreBtn.addEventListener('click', () => this.loadMoreImages());
    }
  }

  handleFilter(activeBtn) {
    // Update active button
    this.filterButtons.forEach(btn => btn.classList.remove('active'));
    activeBtn.classList.add('active');

    const filter = activeBtn.getAttribute('data-filter');

    this.galleryItems.forEach(item => {
      const category = item.getAttribute('data-category');
      
      if (filter === 'all' || category.includes(filter)) {
        item.classList.remove('hidden');
        item.style.animation = 'fadeIn 0.5s ease forwards';
      } else {
        item.classList.add('hidden');
      }
    });
  }

  openLightbox(item) {
    const img = item.querySelector('img');
    if (this.lightbox && this.lightboxImg && img) {
      this.lightboxImg.src = img.src;
      this.lightboxImg.alt = img.alt;
      this.lightbox.classList.add('show');
      document.body.style.overflow = 'hidden';
    }
  }

  closeLightbox() {
    if (this.lightbox) {
      this.lightbox.classList.remove('show');
      document.body.style.overflow = '';
    }
  }

  loadMoreImages() {
    // Simulate loading more images
    this.loadMoreBtn.innerHTML = '<span class="loading-spinner"></span> Loading...';
    
    setTimeout(() => {
      this.loadMoreBtn.innerHTML = 'View More Work';
      // Add animation or notification that more images loaded
    }, 1500);
  }
}

// Enhanced booking form with validation
class BookingForm {
  constructor() {
    this.form = document.getElementById('booking-form');
    this.successMessage = document.getElementById('success-message');
    
    if (this.form) {
      this.init();
    }
  }

  init() {
    this.form.addEventListener('submit', (e) => this.handleSubmit(e));
    
    // Real-time validation
    const inputs = this.form.querySelectorAll('input, textarea, select');
    inputs.forEach(input => {
      input.addEventListener('blur', () => this.validateField(input));
      input.addEventListener('input', () => this.clearErrors(input));
    });

    // Service selection handling
    const serviceOptions = this.form.querySelectorAll('.service-option input[type="checkbox"]');
    serviceOptions.forEach(option => {
      option.addEventListener('change', (e) => {
        const label = e.target.closest('.service-option');
        if (e.target.checked) {
          label.classList.add('selected');
        } else {
          label.classList.remove('selected');
        }
      });
    });

    // Set minimum date to today
    const dateInput = this.form.querySelector('#preferredDate');
    if (dateInput) {
      const today = new Date().toISOString().split('T')[0];
      dateInput.setAttribute('min', today);
    }
  }

  async handleSubmit(e) {
    e.preventDefault();
    
    if (!this.validateForm()) {
      return;
    }

    const submitBtn = this.form.querySelector('button[type="submit"]');
    const btnText = submitBtn.querySelector('.btn-text');
    const spinner = submitBtn.querySelector('.loading-spinner');

    // Show loading state
    btnText.style.display = 'none';
    spinner.style.display = 'inline-block';
    submitBtn.disabled = true;

    try {
      // Simulate form submission
      await this.simulateSubmission();
      
      this.showSuccess();
      this.form.reset();
      
    } catch (error) {
      console.error('Form submission error:', error);
      this.showError('Something went wrong. Please try again or call us directly.');
    } finally {
      // Reset button state
      btnText.style.display = 'inline';
      spinner.style.display = 'none';
      submitBtn.disabled = false;
    }
  }

  validateForm() {
    let isValid = true;
    
    // Required fields
    const requiredFields = ['firstName', 'lastName', 'email', 'phone'];
    requiredFields.forEach(fieldName => {
      const field = this.form.querySelector(`[name="${fieldName}"]`);
      if (!this.validateField(field)) {
        isValid = false;
      }
    });

    // At least one service must be selected
    const services = this.form.querySelectorAll('input[name="services"]:checked');
    if (services.length === 0) {
      const servicesGroup = this.form.querySelector('.service-options').closest('.form-group');
      this.showFieldError(servicesGroup, 'Please select at least one service');
      isValid = false;
    }

    return isValid;
  }

  validateField(field) {
    const value = field.value.trim();
    const fieldGroup = field.closest('.form-group');
    
    if (field.hasAttribute('required') && !value) {
      this.showFieldError(fieldGroup, `${field.previousElementSibling.textContent} is required`);
      return false;
    }

    if (field.type === 'email' && value) {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(value)) {
        this.showFieldError(fieldGroup, 'Please enter a valid email address');
        return false;
      }
    }

    if (field.type === 'tel' && value) {
      const phoneRegex = /^[+]?[(]?[\d\s-()]{10,}$/;
      if (!phoneRegex.test(value)) {
        this.showFieldError(fieldGroup, 'Please enter a valid phone number');
        return false;
      }
    }

    this.clearFieldError(fieldGroup);
    return true;
  }

  showFieldError(fieldGroup, message) {
    fieldGroup.classList.add('error');
    const errorMsg = fieldGroup.querySelector('.error-message');
    if (errorMsg) {
      errorMsg.textContent = message;
    }
  }

  clearFieldError(fieldGroup) {
    fieldGroup.classList.remove('error');
  }

  clearErrors(field) {
    const fieldGroup = field.closest('.form-group');
    this.clearFieldError(fieldGroup);
  }

  showSuccess() {
    this.successMessage.classList.add('show');
    this.successMessage.scrollIntoView({ behavior: 'smooth', block: 'center' });
    
    setTimeout(() => {
      this.successMessage.classList.remove('show');
    }, 5000);
  }

  showError(message) {
    alert(message); // In a real app, you'd show a proper error notification
  }

  async simulateSubmission() {
    // Simulate API call delay
    return new Promise(resolve => setTimeout(resolve, 2000));
  }
}

// Performance optimization - lazy loading images
class LazyLoader {
  constructor() {
    this.init();
  }

  init() {
    if ('IntersectionObserver' in window) {
      const imageObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            const img = entry.target;
            img.src = img.dataset.src || img.src;
            img.classList.remove('lazy');
            imageObserver.unobserve(img);
          }
        });
      });

      document.querySelectorAll('img[loading="lazy"]').forEach(img => {
        imageObserver.observe(img);
      });
    }
  }
}

// Accessibility enhancements
class AccessibilityManager {
  constructor() {
    this.init();
  }

  init() {
    // Focus management for modal
    document.addEventListener('keydown', this.handleKeyDown.bind(this));
    
    // Reduce motion for users who prefer it
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
      document.documentElement.style.setProperty('--transition', 'none');
    }
  }

  handleKeyDown(e) {
    // Tab trapping in modals
    if (e.key === 'Tab') {
      const lightbox = document.querySelector('.lightbox.show');
      if (lightbox) {
        this.trapFocus(e, lightbox);
      }
    }
  }

  trapFocus(e, container) {
    const focusableElements = container.querySelectorAll(
      'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
    );
    const firstElement = focusableElements[0];
    const lastElement = focusableElements[focusableElements.length - 1];

    if (e.shiftKey) {
      if (document.activeElement === firstElement) {
        lastElement.focus();
        e.preventDefault();
      }
    } else if (document.activeElement === lastElement) {
      firstElement.focus();
      e.preventDefault();
    }
  }
}

// Initialize everything when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
  const navigation = new Navigation();
  const scrollReveal = new ScrollReveal();
  const gallery = new Gallery();
  const bookingForm = new BookingForm();
  const lazyLoader = new LazyLoader();
  const accessibilityManager = new AccessibilityManager();
  
  // Store references to prevent garbage collection
  window.salonComponents = {
    navigation,
    scrollReveal,
    gallery,
    bookingForm,
    lazyLoader,
    accessibilityManager
  };
  
  // Console message for developers
  console.log('🌟 Shan Hair website loaded successfully!');
  console.log('Built with modern web standards and accessibility in mind.');
});

// Service Worker for offline functionality (optional)
if ('serviceWorker' in navigator) {
  window.addEventListener('load', () => {
    navigator.serviceWorker.register('/sw.js')
      .catch(() => {
        // Service worker registration failed, but that's okay
      });
  });
}
