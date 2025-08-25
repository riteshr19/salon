
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

  }
}

// Counter Animation Class
class CounterAnimations {
  constructor() {
    this.init();
  }

  init() {
    this.setupIntersectionObserver();
  }

  setupIntersectionObserver() {
    if (!window.IntersectionObserver) return;

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting && !entry.target.classList.contains('counted')) {
          this.animateCounter(entry.target);
          entry.target.classList.add('counted');
          observer.unobserve(entry.target);
        }
      });
    }, {
      threshold: 0.5
    });

    document.querySelectorAll('.counter').forEach(counter => {
      observer.observe(counter);
    });
  }

  animateCounter(element) {
    const target = parseFloat(element.getAttribute('data-target'));
    const isDecimal = target % 1 !== 0;
    const duration = 2000;
    const stepTime = 50;
    const steps = duration / stepTime;
    const stepValue = target / steps;
    let current = 0;

    const timer = setInterval(() => {
      current += stepValue;
      if (current >= target) {
        current = target;
        clearInterval(timer);
      }
      
      if (isDecimal) {
        element.textContent = current.toFixed(1) + '★';
      } else {
        element.textContent = Math.floor(current) + '+';
      }
    }, stepTime);
  }
}

// Enhanced interactions class
class EnhancedInteractions {
  constructor() {
    this.init();
  }

  init() {
    this.setupCTATracking();
    this.setupServiceBookingPreselection();
    this.setupUrgencyBanner();
    this.setupScrollAnimations();
  }

  setupCTATracking() {
    document.querySelectorAll('[data-cta]').forEach(cta => {
      cta.addEventListener('click', (e) => {
        const ctaType = e.currentTarget.getAttribute('data-cta');
        console.log(`CTA clicked: ${ctaType}`);
        
        // Add analytics tracking here if needed
        if (typeof gtag !== 'undefined') {
          gtag('event', 'cta_click', {
            'cta_type': ctaType,
            'page_location': window.location.href
          });
        }
      });
    });
  }

  setupServiceBookingPreselection() {
    document.querySelectorAll('.book-service').forEach(btn => {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        const service = e.currentTarget.getAttribute('data-service');
        
        // Scroll to booking form
        document.getElementById('contact').scrollIntoView({
          behavior: 'smooth'
        });
        
        // Pre-select the service in the booking form after scroll
        setTimeout(() => {
          this.preselectService(service);
        }, 1000);
      });
    });
  }

  preselectService(serviceName) {
    const serviceCheckboxes = document.querySelectorAll('input[name="services"]');
    serviceCheckboxes.forEach(checkbox => {
      const label = checkbox.closest('label');
      const serviceTitle = label.querySelector('h5');
      if (serviceTitle && serviceTitle.textContent.includes(serviceName.split(' ')[0])) {
        checkbox.checked = true;
        checkbox.dispatchEvent(new Event('change'));
      }
    });
  }

  setupUrgencyBanner() {
    const urgencyBanner = document.querySelector('.urgency-banner');
    if (urgencyBanner) {
      // Simulate dynamic slot availability
      setInterval(() => {
        const slots = Math.floor(Math.random() * 5) + 1;
        const urgencyText = urgencyBanner.querySelector('.urgency-text');
        urgencyText.textContent = `Only ${slots} slots left this week!`;
      }, 30000); // Update every 30 seconds
    }
  }

}

// Enhanced Gallery Class
class EnhancedGallery {
  constructor() {
    this.currentTab = 'portfolio';
    this.currentImageIndex = 0;
    this.images = [];
    this.init();
  }

  init() {
    this.setupTabs();
    this.setupBeforeAfterSliders();
    this.setupLightbox();
    this.setupFilters();
  }

  setupTabs() {
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    tabBtns.forEach(btn => {
      btn.addEventListener('click', (e) => {
        const tabId = e.target.getAttribute('data-tab');
        
        // Remove active class from all tabs and contents
        tabBtns.forEach(b => b.classList.remove('active'));
        tabContents.forEach(c => c.classList.remove('active'));
        
        // Add active class to clicked tab and corresponding content
        e.target.classList.add('active');
        document.querySelector(`[data-tab="${tabId}"]`).classList.add('active');
        
        this.currentTab = tabId;
      });
    });
  }

  setupBeforeAfterSliders() {
    const sliders = document.querySelectorAll('.before-after-slider');
    
    sliders.forEach(slider => {
      const afterImage = slider.querySelector('.after-image');
      const handle = slider.querySelector('.slider-handle');
      let isDragging = false;

      const updateSlider = (e) => {
        const rect = slider.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const percentage = Math.max(0, Math.min(100, (x / rect.width) * 100));
        
        afterImage.style.clipPath = `inset(0 ${100 - percentage}% 0 0)`;
        handle.style.left = `${percentage}%`;
      };

      slider.addEventListener('mousedown', (e) => {
        isDragging = true;
        updateSlider(e);
      });

      document.addEventListener('mousemove', (e) => {
        if (isDragging) {
          updateSlider(e);
        }
      });

      document.addEventListener('mouseup', () => {
        isDragging = false;
      });

      // Touch events for mobile
      slider.addEventListener('touchstart', (e) => {
        isDragging = true;
        updateSlider(e.touches[0]);
      });

      document.addEventListener('touchmove', (e) => {
        if (isDragging) {
          e.preventDefault();
          updateSlider(e.touches[0]);
        }
      });

      document.addEventListener('touchend', () => {
        isDragging = false;
      });
    });
  }

  setupLightbox() {
    const lightbox = document.getElementById('lightbox');
    const lightboxContent = lightbox.querySelector('.lightbox-content');
    const lightboxTitle = lightbox.querySelector('.lightbox-title');
    const lightboxDescription = lightbox.querySelector('.lightbox-description');
    const closeBtn = lightbox.querySelector('.lightbox-close');
    const prevBtn = lightbox.querySelector('.lightbox-prev');
    const nextBtn = lightbox.querySelector('.lightbox-next');

    // Collect all gallery images
    this.images = Array.from(document.querySelectorAll('.masonry-item img')).map(img => ({
      src: img.src,
      alt: img.alt,
      title: img.closest('.masonry-item').querySelector('.gallery-info h4')?.textContent || img.alt,
      description: img.closest('.masonry-item').querySelector('.gallery-info p')?.textContent || ''
    }));

    // Open lightbox
    document.querySelectorAll('.masonry-item').forEach((item, index) => {
      item.addEventListener('click', () => {
        this.currentImageIndex = index;
        this.showLightboxImage();
        lightbox.classList.add('show');
        document.body.style.overflow = 'hidden';
      });
    });

    // Close lightbox
    const closeLightbox = () => {
      lightbox.classList.remove('show');
      document.body.style.overflow = '';
    };

    closeBtn.addEventListener('click', closeLightbox);
    lightbox.addEventListener('click', (e) => {
      if (e.target === lightbox) {
        closeLightbox();
      }
    });

    // Navigation
    prevBtn.addEventListener('click', () => {
      this.currentImageIndex = (this.currentImageIndex - 1 + this.images.length) % this.images.length;
      this.showLightboxImage();
    });

    nextBtn.addEventListener('click', () => {
      this.currentImageIndex = (this.currentImageIndex + 1) % this.images.length;
      this.showLightboxImage();
    });

    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
      if (lightbox.classList.contains('show')) {
        switch (e.key) {
          case 'Escape':
            closeLightbox();
            break;
          case 'ArrowLeft':
            prevBtn.click();
            break;
          case 'ArrowRight':
            nextBtn.click();
            break;
        }
      }
    });
  }

  showLightboxImage() {
    const lightbox = document.getElementById('lightbox');
    const lightboxContent = lightbox.querySelector('.lightbox-content');
    const lightboxTitle = lightbox.querySelector('.lightbox-title');
    const lightboxDescription = lightbox.querySelector('.lightbox-description');
    
    const currentImage = this.images[this.currentImageIndex];
    
    lightboxContent.src = currentImage.src;
    lightboxContent.alt = currentImage.alt;
    lightboxTitle.textContent = currentImage.title;
    lightboxDescription.textContent = currentImage.description;
  }

  setupFilters() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const galleryItems = document.querySelectorAll('.masonry-item');

    filterBtns.forEach(btn => {
      btn.addEventListener('click', (e) => {
        const filter = e.target.getAttribute('data-filter');
        
        // Update active button
        filterBtns.forEach(b => b.classList.remove('active'));
        e.target.classList.add('active');
        
        // Filter items
        galleryItems.forEach(item => {
          if (filter === 'all' || item.getAttribute('data-category').includes(filter)) {
            item.style.display = 'block';
            item.classList.add('reveal');
          } else {
            item.style.display = 'none';
            item.classList.remove('reveal');
          }
        });
        
        // Re-trigger scroll reveal for visible items
        if (window.salonComponents && window.salonComponents.scrollReveal) {
          window.salonComponents.scrollReveal.observeElements();
        }
      });
    });
  }
}

// Service Calculator Class
class ServiceCalculator {
  constructor() {
    this.services = [];
    this.packages = {
      'complete-makeover': {
        services: ['signature-cut', 'color-highlights', 'scalp-treatment', 'styling-education'],
        discount: 80,
        name: 'Complete Curl Makeover'
      },
      'refresh-revive': {
        services: ['signature-cut', 'gloss-treatment', 'styling-education'],
        discount: 30,
        name: 'Refresh & Revive'
      }
    };
    this.init();
  }

  init() {
    this.setupEventListeners();
    this.updateSummary();
  }

  setupEventListeners() {
    // Service checkboxes
    document.querySelectorAll('.calculator-service-item input[type="checkbox"]').forEach(checkbox => {
      checkbox.addEventListener('change', (e) => {
        this.handleServiceChange(e);
      });
    });

    // Clear button
    const clearBtn = document.getElementById('calculator-clear-btn');
    if (clearBtn) {
      clearBtn.addEventListener('click', () => {
        this.clearAll();
      });
    }

    // Book button
    const bookBtn = document.getElementById('calculator-book-btn');
    if (bookBtn) {
      bookBtn.addEventListener('click', () => {
        this.bookSelectedServices();
      });
    }
  }

  handleServiceChange(e) {
    const serviceData = {
      id: e.target.getAttribute('data-service'),
      price: parseInt(e.target.getAttribute('data-price')),
      duration: parseInt(e.target.getAttribute('data-duration')),
      name: e.target.closest('.calculator-service-item').querySelector('.service-name').textContent
    };

    if (e.target.checked) {
      this.services.push(serviceData);
    } else {
      this.services = this.services.filter(service => service.id !== serviceData.id);
    }

    this.updateSummary();
    this.updateBookButton();
  }

  updateSummary() {
    const selectedServicesEl = document.getElementById('selected-services');
    const subtotalEl = document.getElementById('calc-subtotal');
    const discountEl = document.getElementById('calc-discount');
    const totalEl = document.getElementById('calc-total');
    const durationEl = document.getElementById('calc-duration');
    const discountLineEl = document.getElementById('discount-line');
    const savingsIndicatorEl = document.getElementById('savings-indicator');
    const savingsAmountEl = document.getElementById('savings-amount');

    if (this.services.length === 0) {
      selectedServicesEl.innerHTML = '<p class="empty-state">Select services to see your estimate</p>';
      subtotalEl.textContent = '$0';
      discountEl.textContent = '-$0';
      totalEl.textContent = '$0';
      durationEl.textContent = '0 min';
      discountLineEl.style.display = 'none';
      savingsIndicatorEl.style.display = 'none';
      return;
    }

    // Update selected services list
    const servicesHTML = this.services.map(service => `
      <div class="selected-service-item">
        <span class="selected-service-name">${service.name}</span>
        <span class="selected-service-price">$${service.price}</span>
      </div>
    `).join('');
    selectedServicesEl.innerHTML = servicesHTML;

    // Calculate totals
    const subtotal = this.services.reduce((sum, service) => sum + service.price, 0);
    const totalDuration = this.services.reduce((sum, service) => sum + service.duration, 0);
    
    // Check for package discounts
    const discount = this.calculatePackageDiscount();
    const total = subtotal - discount;

    // Update display
    subtotalEl.textContent = `$${subtotal}`;
    totalEl.textContent = `$${total}`;
    
    // Format duration
    const hours = Math.floor(totalDuration / 60);
    const minutes = totalDuration % 60;
    const durationText = hours > 0 ? `${hours}h ${minutes}m` : `${minutes} min`;
    durationEl.textContent = durationText;

    // Show/hide discount
    if (discount > 0) {
      discountEl.textContent = `-$${discount}`;
      discountLineEl.style.display = 'flex';
      savingsAmountEl.textContent = `$${discount}`;
      savingsIndicatorEl.style.display = 'block';
    } else {
      discountLineEl.style.display = 'none';
      savingsIndicatorEl.style.display = 'none';
    }
  }

  calculatePackageDiscount() {
    const selectedServiceIds = this.services.map(s => s.id);
    
    for (const [packageId, packageData] of Object.entries(this.packages)) {
      const hasAllServices = packageData.services.every(serviceId => 
        selectedServiceIds.includes(serviceId)
      );
      
      if (hasAllServices && selectedServiceIds.length === packageData.services.length) {
        return packageData.discount;
      }
    }
    
    return 0;
  }

  updateBookButton() {
    const bookBtn = document.getElementById('calculator-book-btn');
    if (bookBtn) {
      bookBtn.disabled = this.services.length === 0;
      
      if (this.services.length > 0) {
        const total = this.services.reduce((sum, service) => sum + service.price, 0) - this.calculatePackageDiscount();
        bookBtn.textContent = `Book These Services ($${total})`;
      } else {
        bookBtn.textContent = 'Book These Services';
      }
    }
  }

  clearAll() {
    // Uncheck all checkboxes
    document.querySelectorAll('.calculator-service-item input[type="checkbox"]').forEach(checkbox => {
      checkbox.checked = false;
    });
    
    // Clear services array
    this.services = [];
    
    // Update display
    this.updateSummary();
    this.updateBookButton();
  }

  bookSelectedServices() {
    if (this.services.length === 0) return;

    // Scroll to booking form
    document.getElementById('contact').scrollIntoView({
      behavior: 'smooth'
    });

    // Pre-select services in booking form after scroll
    setTimeout(() => {
      this.preselectServicesInBookingForm();
    }, 1000);

    // Track analytics
    if (typeof gtag !== 'undefined') {
      gtag('event', 'service_calculator_booking', {
        'services': this.services.map(s => s.id).join(','),
        'total_value': this.services.reduce((sum, service) => sum + service.price, 0),
        'discount_applied': this.calculatePackageDiscount()
      });
    }
  }

  preselectServicesInBookingForm() {
    const serviceMapping = {
      'signature-cut': 'signature-cut',
      'color-highlights': 'color-highlights',
      'gloss-treatment': 'gloss-treatment',
      'scalp-treatment': 'scalp-treatment',
      'styling-education': 'styling-education'
    };

    this.services.forEach(calculatorService => {
      const bookingServiceValue = serviceMapping[calculatorService.id];
      if (bookingServiceValue) {
        const checkbox = document.querySelector(`input[name="services"][value="${bookingServiceValue}"]`);
        if (checkbox) {
          checkbox.checked = true;
          checkbox.dispatchEvent(new Event('change'));
        }
      }
    });
  }
}

// Initialize everything when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
  const navigation = new Navigation();
  const scrollReveal = new ScrollReveal();
  const gallery = new Gallery();
  const enhancedGallery = new EnhancedGallery();
  const bookingForm = new BookingForm();
  const lazyLoader = new LazyLoader();
  const accessibilityManager = new AccessibilityManager();
  const counterAnimations = new CounterAnimations();
  const enhancedInteractions = new EnhancedInteractions();
  const serviceCalculator = new ServiceCalculator();
  
  // Store references to prevent garbage collection
  window.salonComponents = {
    navigation,
    scrollReveal,
    gallery,
    enhancedGallery,
    bookingForm,
    lazyLoader,
    accessibilityManager,
    counterAnimations,
    enhancedInteractions,
    serviceCalculator
  };
  
  // Console message for developers
  console.log('🌟 Shan Hair website loaded successfully!');
  console.log('Built with modern web standards and accessibility in mind.');
  
  // Initialize enhanced booking form
  initializeEnhancedBookingForm();
});

// Enhanced Multi-Step Booking Form
function initializeEnhancedBookingForm() {
  const form = document.getElementById('enhanced-booking-form');
  if (!form) return;
  
  let currentStep = 1;
  const totalSteps = 3;
  
  // Service pricing data
  const servicePrices = {
    'signature-cut': 95,
    'color-highlights': 150,
    'gloss-treatment': 75,
    'scalp-treatment': 65
  };
  
  const serviceDurations = {
    'signature-cut': 90,
    'color-highlights': 150,
    'gloss-treatment': 45,
    'scalp-treatment': 60
  };
  
  // Initialize form
  setupStepNavigation();
  setupServiceSelection();
  setupFormValidation();
  
  function setupStepNavigation() {
    // Next step buttons
    document.querySelectorAll('.next-step').forEach(btn => {
      btn.addEventListener('click', () => {
        if (validateCurrentStep()) {
          nextStep();
        }
      });
    });
    
    // Previous step buttons
    document.querySelectorAll('.prev-step').forEach(btn => {
      btn.addEventListener('click', prevStep);
    });
    
    // Form submission
    form.addEventListener('submit', handleFormSubmission);
  }
  
  function setupServiceSelection() {
    const serviceOptions = document.querySelectorAll('input[name="services"]');
    const nextButton = document.querySelector('.next-step');
    const priceEstimate = document.getElementById('price-estimate');
    
    serviceOptions.forEach(option => {
      option.addEventListener('change', updatePriceEstimate);
    });
    
    function updatePriceEstimate() {
      const selectedServices = Array.from(serviceOptions)
        .filter(option => option.checked)
        .map(option => option.value);
      
      if (selectedServices.length === 0) {
        priceEstimate.textContent = 'Select services';
        nextButton.disabled = true;
        return;
      }
      
      const totalPrice = selectedServices.reduce((total, service) => {
        return total + servicePrices[service];
      }, 0);
      
      priceEstimate.textContent = `$${totalPrice}+`;
      nextButton.disabled = false;
    }
  }
  
  function setupFormValidation() {
    // Real-time validation for required fields
    const requiredFields = form.querySelectorAll('input[required], select[required]');
    
    requiredFields.forEach(field => {
      field.addEventListener('blur', () => validateField(field));
      field.addEventListener('input', () => clearFieldError(field));
    });
  }
  
  function validateField(field) {
    const formGroup = field.closest('.form-group');
    const errorMessage = formGroup.querySelector('.error-message');
    
    if (!field.value.trim()) {
      formGroup.classList.add('error');
      return false;
    }
    
    if (field.type === 'email' && !isValidEmail(field.value)) {
      formGroup.classList.add('error');
      return false;
    }
    
    formGroup.classList.remove('error');
    return true;
  }
  
  function clearFieldError(field) {
    const formGroup = field.closest('.form-group');
    formGroup.classList.remove('error');
  }
  
  function isValidEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
  }
  
  function validateCurrentStep() {
    const currentStepElement = document.querySelector(`.form-step[data-step="${currentStep}"]`);
    
    if (currentStep === 1) {
      // Validate service selection
      const selectedServices = document.querySelectorAll('input[name="services"]:checked');
      return selectedServices.length > 0;
    }
    
    if (currentStep === 2) {
      // Validate personal details
      const requiredFields = currentStepElement.querySelectorAll('input[required]');
      return Array.from(requiredFields).every(field => validateField(field));
    }
    
    if (currentStep === 3) {
      // Validate scheduling
      const dateField = document.getElementById('preferredDate');
      const timeField = document.getElementById('preferredTime');
      return validateField(dateField) && validateField(timeField);
    }
    
    return true;
  }
  
  function nextStep() {
    if (currentStep < totalSteps) {
      updateStep(currentStep + 1);
    }
  }
  
  function prevStep() {
    if (currentStep > 1) {
      updateStep(currentStep - 1);
    }
  }
  
  function updateStep(step) {
    // Hide current step
    document.querySelector(`.form-step[data-step="${currentStep}"]`).classList.remove('active');
    document.querySelector(`.progress-step[data-step="${currentStep}"]`).classList.remove('active');
    
    // Mark previous steps as completed
    if (step > currentStep) {
      document.querySelector(`.progress-step[data-step="${currentStep}"]`).classList.add('completed');
    } else {
      document.querySelector(`.progress-step[data-step="${step}"]`).classList.remove('completed');
    }
    
    // Show new step
    currentStep = step;
    document.querySelector(`.form-step[data-step="${currentStep}"]`).classList.add('active');
    document.querySelector(`.progress-step[data-step="${currentStep}"]`).classList.add('active');
    
    // Update booking summary for final step
    if (currentStep === 3) {
      updateBookingSummary();
    }
    
    // Scroll to top of form
    document.querySelector('.booking-container').scrollIntoView({ 
      behavior: 'smooth', 
      block: 'start' 
    });
  }
  
  function updateBookingSummary() {
    const selectedServices = Array.from(document.querySelectorAll('input[name="services"]:checked'));
    const summaryServices = document.getElementById('summary-services');
    const summaryPrice = document.getElementById('summary-price');
    const summaryDuration = document.getElementById('summary-duration');
    
    if (selectedServices.length === 0) return;
    
    // Update services list
    const serviceNames = selectedServices.map(service => {
      const card = service.closest('.service-card-option');
      return card.querySelector('h5').textContent;
    });
    summaryServices.innerHTML = `<span>Services:</span><span>${serviceNames.join(', ')}</span>`;
    
    // Update total price
    const totalPrice = selectedServices.reduce((total, service) => {
      return total + servicePrices[service.value];
    }, 0);
    summaryPrice.innerHTML = `<span>Estimated Total:</span><span>$${totalPrice}+</span>`;
    
    // Update total duration
    const totalDuration = selectedServices.reduce((total, service) => {
      return total + serviceDurations[service.value];
    }, 0);
    summaryDuration.innerHTML = `<span>Duration:</span><span>${Math.floor(totalDuration / 60)}h ${totalDuration % 60}min</span>`;
  }
  
  function handleFormSubmission(e) {
    e.preventDefault();
    
    if (!validateCurrentStep()) return;
    
    // Show loading state
    const submitButton = form.querySelector('button[type="submit"]');
    const buttonText = submitButton.querySelector('.btn-text');
    const spinner = submitButton.querySelector('.loading-spinner');
    
    buttonText.style.display = 'none';
    spinner.classList.remove('hidden');
    submitButton.disabled = true;
    
    // Simulate form submission
    setTimeout(() => {
      // Hide form and show success message
      form.style.display = 'none';
      document.getElementById('booking-success').classList.remove('hidden');
      
      // Track conversion event (if analytics is setup)
      if (typeof gtag !== 'undefined') {
        gtag('event', 'booking_submission', {
          event_category: 'conversion',
          event_label: 'enhanced_booking_form'
        });
      }
    }, 2000);
  }
}

// Global function to reset booking form
function resetBookingForm() {
  const form = document.getElementById('enhanced-booking-form');
  const successMessage = document.getElementById('booking-success');
  
  if (form && successMessage) {
    form.reset();
    form.style.display = 'block';
    successMessage.classList.add('hidden');
    
    // Reset to first step
    document.querySelectorAll('.form-step').forEach(step => step.classList.remove('active'));
    document.querySelectorAll('.progress-step').forEach(step => {
      step.classList.remove('active', 'completed');
    });
    
    document.querySelector('.form-step[data-step="1"]').classList.add('active');
    document.querySelector('.progress-step[data-step="1"]').classList.add('active');
    
    // Reset price estimate
    document.getElementById('price-estimate').textContent = 'Select services';
    document.querySelector('.next-step').disabled = true;
  }
}

// Service Worker for offline functionality (optional)
if ('serviceWorker' in navigator) {
  window.addEventListener('load', () => {
    navigator.serviceWorker.register('/sw.js')
      .catch(() => {
        // Service worker registration failed, but that's okay
      });
  });
}
