/**
 * Theme Toggle Manager
 * Handles dark/light mode with system preference detection
 */

class ThemeManager {
  constructor() {
    this.storageKey = 'shan-hair-theme';
    this.themes = ['light', 'dark', 'auto'];
    this.currentTheme = this.getStoredTheme() || 'auto';
    this.mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
    
    this.init();
  }

  init() {
    this.createThemeToggle();
    this.applyTheme(this.currentTheme);
    this.setupEventListeners();
    this.observeSystemPreference();
  }

  createThemeToggle() {
    // Check if toggle already exists
    if (document.querySelector('.theme-toggle')) return;

    const toggle = document.createElement('button');
    toggle.className = 'theme-toggle';
    toggle.setAttribute('aria-label', 'Toggle theme');
    toggle.setAttribute('data-tooltip', this.getTooltipText());

    toggle.innerHTML = `
      <svg class="icon sun-icon" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path>
      </svg>
      <svg class="icon moon-icon" fill="currentColor" viewBox="0 0 20 20">
        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
      </svg>
      <div class="theme-toggle-tooltip">${this.getTooltipText()}</div>
    `;

    toggle.addEventListener('click', () => this.toggleTheme());
    
    document.body.appendChild(toggle);
    this.toggleElement = toggle;
  }

  setupEventListeners() {
    // Listen for keyboard shortcuts
    document.addEventListener('keydown', (e) => {
      if (e.ctrlKey && e.shiftKey && e.key === 'T') {
        e.preventDefault();
        this.toggleTheme();
      }
    });

    // Listen for storage changes from other tabs
    window.addEventListener('storage', (e) => {
      if (e.key === this.storageKey) {
        this.currentTheme = e.newValue || 'auto';
        this.applyTheme(this.currentTheme);
        this.updateToggleUI();
      }
    });
  }

  observeSystemPreference() {
    this.mediaQuery.addEventListener('change', () => {
      if (this.currentTheme === 'auto') {
        this.applyTheme('auto');
      }
    });
  }

  toggleTheme() {
    const currentIndex = this.themes.indexOf(this.currentTheme);
    const nextIndex = (currentIndex + 1) % this.themes.length;
    this.currentTheme = this.themes[nextIndex];
    
    this.applyTheme(this.currentTheme);
    this.storeTheme(this.currentTheme);
    this.updateToggleUI();
    this.showThemeNotification();
  }

  applyTheme(theme) {
    const root = document.documentElement;
    root.setAttribute('data-theme', theme);
    
    // Update meta theme-color for mobile browsers
    this.updateMetaThemeColor(theme);
    
    // Trigger custom event for other scripts
    window.dispatchEvent(new CustomEvent('themeChange', {
      detail: { theme: theme, actualTheme: this.getActualTheme(theme) }
    }));
  }

  getActualTheme(theme) {
    if (theme === 'auto') {
      return this.mediaQuery.matches ? 'dark' : 'light';
    }
    return theme;
  }

  updateMetaThemeColor(theme) {
    const actualTheme = this.getActualTheme(theme);
    const color = actualTheme === 'dark' ? '#0f172a' : '#ffffff';
    
    let metaTheme = document.querySelector('meta[name="theme-color"]');
    if (!metaTheme) {
      metaTheme = document.createElement('meta');
      metaTheme.name = 'theme-color';
      document.head.appendChild(metaTheme);
    }
    metaTheme.content = color;
  }

  updateToggleUI() {
    if (!this.toggleElement) return;

    const sunIcon = this.toggleElement.querySelector('.sun-icon');
    const moonIcon = this.toggleElement.querySelector('.moon-icon');
    const tooltip = this.toggleElement.querySelector('.theme-toggle-tooltip');
    
    // Reset classes
    sunIcon.classList.remove('active');
    moonIcon.classList.remove('active');
    this.toggleElement.classList.remove('system-mode');
    
    // Update based on current theme
    const actualTheme = this.getActualTheme(this.currentTheme);
    
    if (actualTheme === 'light') {
      sunIcon.classList.add('active');
    } else {
      moonIcon.classList.add('active');
    }
    
    if (this.currentTheme === 'auto') {
      this.toggleElement.classList.add('system-mode');
    }
    
    // Update tooltip
    tooltip.textContent = this.getTooltipText();
    this.toggleElement.setAttribute('data-tooltip', this.getTooltipText());
  }

  getTooltipText() {
    const tooltips = {
      'light': 'Switch to dark mode',
      'dark': 'Switch to auto mode',
      'auto': 'Switch to light mode'
    };
    return tooltips[this.currentTheme] || 'Toggle theme';
  }

  showThemeNotification() {
    const notifications = {
      'light': '☀️ Light mode',
      'dark': '🌙 Dark mode',
      'auto': '🔄 Auto mode (follows system)'
    };
    
    this.showNotification(notifications[this.currentTheme]);
  }

  showNotification(message) {
    // Remove existing notification
    const existing = document.querySelector('.theme-notification');
    if (existing) {
      existing.remove();
    }

    const notification = document.createElement('div');
    notification.className = 'theme-notification notification-enter';
    notification.style.cssText = `
      position: fixed;
      top: 20px;
      right: 20px;
      background: var(--card-bg);
      color: var(--text-primary);
      padding: 12px 16px;
      border-radius: 8px;
      font-size: 14px;
      font-weight: 500;
      box-shadow: var(--shadow);
      border: 1px solid var(--border);
      z-index: 10000;
      backdrop-filter: blur(10px);
    `;
    notification.textContent = message;

    document.body.appendChild(notification);

    // Auto remove after 3 seconds
    setTimeout(() => {
      notification.classList.remove('notification-enter');
      notification.classList.add('notification-exit');
      setTimeout(() => notification.remove(), 300);
    }, 2000);
  }

  storeTheme(theme) {
    try {
      localStorage.setItem(this.storageKey, theme);
    } catch (e) {
      console.warn('Could not save theme preference:', e);
    }
  }

  getStoredTheme() {
    try {
      return localStorage.getItem(this.storageKey);
    } catch (e) {
      console.warn('Could not retrieve theme preference:', e);
      return null;
    }
  }

  // Public API
  setTheme(theme) {
    if (this.themes.includes(theme)) {
      this.currentTheme = theme;
      this.applyTheme(theme);
      this.storeTheme(theme);
      this.updateToggleUI();
    }
  }

  getTheme() {
    return this.currentTheme;
  }

  getActualCurrentTheme() {
    return this.getActualTheme(this.currentTheme);
  }
}

/**
 * Enhanced Scroll Animations Manager
 */
class ScrollAnimationManager {
  constructor() {
    this.observerOptions = {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    };
    this.init();
  }

  init() {
    if (!window.IntersectionObserver) return;
    
    this.setupScrollObserver();
    this.setupStaggeredAnimations();
  }

  setupScrollObserver() {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('revealed', 'in-view');
          
          // Trigger staggered animations
          if (entry.target.classList.contains('stagger-animation')) {
            entry.target.classList.add('animate');
          }
          
          observer.unobserve(entry.target);
        }
      });
    }, this.observerOptions);

    // Observe all reveal elements
    document.querySelectorAll('.reveal, .reveal-scale, .reveal-rotate, .scroll-reveal').forEach(el => {
      observer.observe(el);
    });

    // Observe staggered animation containers
    document.querySelectorAll('.stagger-animation').forEach(el => {
      observer.observe(el);
    });
  }

  setupStaggeredAnimations() {
    // Automatically detect and setup staggered animations
    document.querySelectorAll('[data-stagger]').forEach(container => {
      container.classList.add('stagger-animation');
      const children = container.children;
      
      Array.from(children).forEach((child, index) => {
        child.style.animationDelay = `${(index + 1) * 0.1}s`;
      });
    });
  }
}

/**
 * Enhanced Form Handler
 */
class FormEnhancer {
  constructor() {
    this.init();
  }

  init() {
    this.enhanceAllForms();
    this.setupFormValidation();
  }

  enhanceAllForms() {
    document.querySelectorAll('form').forEach(form => {
      this.enhanceForm(form);
    });
  }

  enhanceForm(form) {
    // Add modern form styling
    form.classList.add('enhanced-form');
    
    // Enhance inputs
    form.querySelectorAll('input, textarea, select').forEach(input => {
      this.enhanceInput(input);
    });

    // Enhance buttons
    form.querySelectorAll('button[type="submit"]').forEach(button => {
      this.enhanceSubmitButton(button);
    });
  }

  enhanceInput(input) {
    if (!input.classList.contains('form-input')) {
      input.classList.add('form-input');
    }

    // Add focus ring
    input.classList.add('focus-ring');

    // Add floating label effect
    if (input.placeholder && !input.closest('.form-group')?.querySelector('.form-label')) {
      this.addFloatingLabel(input);
    }

    // Real-time validation
    input.addEventListener('blur', () => this.validateInput(input));
    input.addEventListener('input', () => this.clearInputError(input));
  }

  addFloatingLabel(input) {
    const wrapper = document.createElement('div');
    wrapper.className = 'floating-label-wrapper';
    
    const label = document.createElement('label');
    label.className = 'floating-label';
    label.textContent = input.placeholder;
    label.setAttribute('for', input.id || '');
    
    input.parentNode.insertBefore(wrapper, input);
    wrapper.appendChild(label);
    wrapper.appendChild(input);
    
    input.placeholder = '';
    
    // Handle focus/blur
    const updateLabel = () => {
      if (input.value || input === document.activeElement) {
        wrapper.classList.add('has-value');
      } else {
        wrapper.classList.remove('has-value');
      }
    };
    
    input.addEventListener('focus', updateLabel);
    input.addEventListener('blur', updateLabel);
    input.addEventListener('input', updateLabel);
    
    updateLabel();
  }

  enhanceSubmitButton(button) {
    button.classList.add('btn', 'btn-primary', 'btn-ripple');
    
    // Add loading state functionality
    button.addEventListener('click', (e) => {
      if (button.classList.contains('btn-loading')) {
        e.preventDefault();
        return;
      }
    });
  }

  validateInput(input) {
    this.clearInputError(input);
    
    const value = input.value.trim();
    const type = input.type;
    
    let isValid = true;
    let errorMessage = '';
    
    // Required validation
    if (input.required && !value) {
      isValid = false;
      errorMessage = 'This field is required';
    }
    
    // Email validation
    else if (type === 'email' && value) {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(value)) {
        isValid = false;
        errorMessage = 'Please enter a valid email address';
      }
    }
    
    // Phone validation
    else if (type === 'tel' && value) {
      const phoneRegex = /^[\+]?[1-9][\d]{0,15}$/;
      if (!phoneRegex.test(value.replace(/\s/g, ''))) {
        isValid = false;
        errorMessage = 'Please enter a valid phone number';
      }
    }
    
    // Min length validation
    else if (input.minLength && value.length < input.minLength) {
      isValid = false;
      errorMessage = `Minimum ${input.minLength} characters required`;
    }
    
    if (!isValid) {
      this.showInputError(input, errorMessage);
    } else {
      this.showInputSuccess(input);
    }
    
    return isValid;
  }

  showInputError(input, message) {
    input.classList.add('error');
    input.classList.remove('success');
    
    let errorEl = input.parentNode.querySelector('.form-error');
    if (!errorEl) {
      errorEl = document.createElement('div');
      errorEl.className = 'form-error';
      input.parentNode.appendChild(errorEl);
    }
    
    errorEl.innerHTML = `
      <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
      </svg>
      ${message}
    `;
  }

  showInputSuccess(input) {
    input.classList.add('success');
    input.classList.remove('error');
    
    const errorEl = input.parentNode.querySelector('.form-error');
    if (errorEl) {
      errorEl.remove();
    }
  }

  clearInputError(input) {
    input.classList.remove('error', 'success');
    
    const errorEl = input.parentNode.querySelector('.form-error');
    if (errorEl) {
      errorEl.remove();
    }
  }

  setupFormValidation() {
    document.addEventListener('submit', (e) => {
      const form = e.target;
      if (!form.matches('form')) return;
      
      const inputs = form.querySelectorAll('input, textarea, select');
      let isFormValid = true;
      
      inputs.forEach(input => {
        if (!this.validateInput(input)) {
          isFormValid = false;
        }
      });
      
      if (!isFormValid) {
        e.preventDefault();
        form.classList.add('animate-shake');
        setTimeout(() => form.classList.remove('animate-shake'), 500);
      }
    });
  }
}

// Initialize everything when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
  window.themeManager = new ThemeManager();
  window.scrollAnimationManager = new ScrollAnimationManager();
  window.formEnhancer = new FormEnhancer();
  
  console.log('🎨 Enhanced theme system loaded');
});

// Export for global access
window.ShanHairEnhancements = {
  ThemeManager,
  ScrollAnimationManager,
  FormEnhancer
};