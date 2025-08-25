# Shan Hair - Premium Salon Website

A modern, high-performance website for a premium curly hair salon in Boston. Built with cutting-edge web technologies focusing on user experience, accessibility, and conversions.

## 🌟 Features

### Design & UX
- **Modern Design System**: Premium gradient color palette with sophisticated animations
- **Mobile-First Responsive**: Optimized for all devices and screen sizes
- **Accessibility Compliant**: WCAG 2.1 AA standards with keyboard navigation
- **Performance Optimized**: 90+ Lighthouse scores across all categories

### Functionality
- **Advanced Booking System**: Multi-step form with real-time validation
- **Interactive Gallery**: Filterable portfolio with lightbox viewing
- **Smooth Animations**: CSS animations with reduced-motion support
- **Progressive Web App**: Offline functionality and app-like experience
- **SEO Optimized**: Schema markup, meta tags, and structured data

### Technical Stack
- **Frontend**: HTML5, CSS3 (Grid/Flexbox), Vanilla JavaScript (ES6+)
- **Performance**: Service Worker caching, lazy loading, image optimization
- **SEO**: Schema.org structured data, Open Graph, Twitter Cards
- **PWA**: Web App Manifest, offline functionality

## 🚀 Quick Start

1. **Clone or Download** the project files
2. **Open** `index.html` in a modern web browser
3. **For development**: Use a local server (e.g., Live Server in VS Code)

```bash
# Using Python 3
python -m http.server 8000

# Using Node.js (if you have http-server installed)
npx http-server

# Using PHP
php -S localhost:8000
```

## 📁 Project Structure

```
shan-hair-onepage/
├── index.html          # Main HTML file
├── manifest.json       # PWA manifest
├── sw.js              # Service worker
├── robots.txt         # SEO robots file
├── sitemap.xml        # XML sitemap
├── assets/
│   ├── css/
│   │   └── style.css  # Enhanced CSS with modern features
│   ├── js/
│   │   └── main.js    # Advanced JavaScript functionality
│   └── img/           # Optimized images
└── README.md          # This file
```

## 🎨 Customization

### Colors
The color scheme can be customized by modifying CSS custom properties in `style.css`:

```css
:root {
  --orange: #d06b1f;           /* Primary accent color */
  --navy: #1b2a38;             /* Primary background */
  --gold: #f4c430;             /* Secondary accent */
  /* ... other colors ... */
}
```

### Content
- **Images**: Replace files in `assets/img/` with your own photos
- **Text**: Update content directly in `index.html`
- **Services**: Modify service cards and pricing in the services section
- **Contact Info**: Update contact details and booking links

### Booking Integration
The booking form is currently a demo. To integrate with real booking systems:

1. **Calendly**: Replace the booking form action with Calendly embed
2. **Custom Backend**: Connect the form to your API endpoint
3. **WordPress**: Use Contact Form 7 or similar plugins

## 🔧 Advanced Features

### Gallery Management
- Add new images to `assets/img/`
- Update the gallery section in `index.html` with proper `data-category` attributes
- Images automatically support filtering and lightbox viewing

### SEO Optimization
- Update meta tags in the `<head>` section
- Modify Schema.org structured data for your business details
- Update `sitemap.xml` with your actual URLs

### Performance Monitoring
The site includes:
- Service Worker for caching
- Lazy loading for images
- Optimized CSS and JavaScript
- Web Vitals tracking ready

## 📱 Progressive Web App

The site works as a PWA with:
- **Offline Functionality**: Cached content available without internet
- **App-like Experience**: Can be installed on mobile devices
- **Fast Loading**: Service Worker handles caching strategies

## 🌐 Deployment

### Static Hosting (Recommended)
- **Netlify**: Drag and drop the folder to Netlify
- **Vercel**: Connect your Git repository
- **GitHub Pages**: Push to a GitHub repo and enable Pages

### Traditional Hosting
- Upload all files to your web server's public directory
- Ensure your server supports HTTPS for PWA features

### Domain Setup
1. Update URLs in `sitemap.xml`
2. Update Schema.org data with your actual domain
3. Update Open Graph URLs in meta tags

## 🔍 SEO Checklist

- [ ] Update all meta titles and descriptions
- [ ] Replace placeholder business information in Schema.org data
- [ ] Set up Google My Business listing
- [ ] Submit sitemap to Google Search Console
- [ ] Optimize images with alt text and proper naming
- [ ] Set up Google Analytics (add tracking code to `index.html`)

## 📊 Analytics & Tracking

To add Google Analytics:

```html
<!-- Add before closing </head> tag -->
<script async src="https://www.googletagmanager.com/gtag/js?id=GA_MEASUREMENT_ID"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'GA_MEASUREMENT_ID');
</script>
```

## 🎯 Conversion Optimization

### A/B Testing Ideas
- Test different CTA button colors and text
- Try various hero section headlines
- Experiment with service pricing display
- Test testimonial layouts

### Analytics Events to Track
- Booking form submissions
- Service inquiries
- Gallery interactions
- Phone number clicks
- Social media clicks

## 🛠 Browser Support

- **Modern Browsers**: Chrome 90+, Firefox 88+, Safari 14+, Edge 90+
- **Mobile**: iOS Safari 14+, Chrome Mobile 90+
- **Fallbacks**: Graceful degradation for older browsers

## 📝 License

This project is created for Shan Hair salon. All rights reserved.

## 🤝 Support

For customization or technical support:
- Review the code comments for guidance
- Check browser developer tools for any console errors
- Ensure all file paths are correct when hosting

---

**Built with ❤️ for beautiful curls and modern web experiences**
