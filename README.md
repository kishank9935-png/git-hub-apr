# APR GROUP OF COMPANY — Real Estate & Residential Plotting Website

[![Website](https://img.shields.io/badge/Website-APR%20Group-173B65.svg)](https://maps.app.goo.gl/oc3artJE4YjWZAFA8)
[![WordPress](https://img.shields.io/badge/WordPress-Theme%20Ready-2467C5.svg)](https://wordpress.org)
[![Elementor](https://img.shields.io/badge/Elementor-Compatible-159568.svg)](https://elementor.com)
[![Location](https://img.shields.io/badge/Location-Bhadohi%2C%20UP-173B65.svg)](https://maps.app.goo.gl/oc3artJE4YjWZAFA8)

Official website and custom WordPress/Elementor theme for **APR GROUP OF COMPANY**, a premier residential plotting and land development firm in Bhadohi, Uttar Pradesh, India.

---

## 🏢 Company Profile

* **Company Name:** APR GROUP OF COMPANY
* **Industry:** Real Estate & Residential Plotting
* **Head Office:** Siddhi Vinayak Colony, Rajpura Phase 1, Bhadohi, Uttar Pradesh 221401, India
* **Phone / WhatsApp:** +91 63921 99296
* **Tagline:** *Find the Right Plot for Your Future.*
* **Google Maps Direction:** [View on Google Maps](https://maps.app.goo.gl/xPQswscYuLeQw1Kb9)
* **Google Business Profile Review Link:** [Write a Review on Google](https://g.page/r/CUNndIdTFafPEBM/review)

---

## 🎨 Strict 3-Colour Brand Identity

This website follows a strict, disciplined three-colour brand palette derived from the company logo:

| Brand Colour | Hex Code | Purpose |
| :--- | :--- | :--- |
| **Brand Navy Blue** | `#173B65` | Header, footers, dark backgrounds, high-contrast typography, trust badges |
| **Brand Blue** | `#2467C5` | Primary buttons, call actions, link accents, key highlights |
| **Brand Green** | `#159568` | WhatsApp triggers, price figures, verified badges, rating stars |

---

## 📂 Repository Structure

```text
├── index.html                           # Homepage with hero carousel & reviews
├── about.html                           # Company history, mission & direct guidance
├── projects.html                        # All 6 projects directory & rate table
├── rajpura-phase-1.html                 # Project 1: Flagship head office site (₹2,500/sq.ft)
├── ugapur.html                          # Project 2: Affordable growth corridor (₹1,300/sq.ft)
├── kanshraipur.html                     # Project 3: High-demand residential zone (₹2,300/sq.ft)
├── chauri-bazar.html                    # Project 4: Strategic market connectivity (₹1,300/sq.ft)
├── gosai-bazar.html                     # Project 5: Budget-friendly corridor (₹1,000/sq.ft)
├── parjapatpur.html                     # Project 6: Peaceful residential development (₹1,200/sq.ft)
├── gallery.html                         # Filterable photography gallery with lightbox
├── blog.html                            # Educational land buying blog directory
├── blog-how-to-check-plot.html          # Guide: Ground inspection checklist
├── blog-why-bhadohi.html                # Guide: Bhadohi ring road & infrastructure
├── blog-plot-size-vs-budget.html        # Guide: Plot dimensions vs budget
├── blog-documents-checklist.html        # Guide: Legal registry & mutation documents
├── blog-how-to-calculate-prices.html    # Guide: Sq. ft. to total price calculation
├── contact.html                         # Interactive contact form & interactive map
├── privacy-policy.html                  # Legal privacy policy
├── terms-and-conditions.html            # Legal terms of service
├── disclaimer.html                      # Legal real estate disclaimer
├── sitemap.xml                          # Search engine XML sitemap
├── robots.txt                           # Search engine crawling rules
├── assets/
│   ├── css/
│   │   ├── brand-system.css             # Design tokens, typography, grid, buttons, header/footer
│   │   └── components.css               # Carousel, cards, calculator, Google reviews, forms
│   ├── js/
│   │   ├── main.js                      # Carousel, mobile navigation, review submission
│   │   ├── calculator.js                # Interactive plot price & budget estimator
│   │   ├── gallery.js                   # Filterable gallery & modal lightbox
│   │   └── contact.js                   # Contact form validation & submission
│   └── images/
│       ├── apr-logo.png                 # Official brand logo
│       └── projects/                    # Royalty-free residential stock photography
├── apr-group-theme/                     # Complete custom WordPress theme
│   ├── style.css                        # Theme metadata & base styles
│   ├── functions.php                    # CPT registration, asset enqueuing, theme supports
│   ├── header.php                       # WordPress sticky header & navigation
│   ├── footer.php                       # WordPress footer & sticky action buttons
│   ├── front-page.php                   # Modular front page template
│   ├── inc/
│   │   ├── acf-fields.php               # Native ACF meta field definitions
│   │   └── google-reviews.php           # Server-side Google Places / GBP API integration
│   └── template-parts/                  # Modular template segments
├── elementor-templates/                 # Elementor Theme Builder JSON templates
│   ├── elementor-header.json
│   ├── elementor-footer.json
│   └── elementor-homepage.json
├── acf-export/                          # Advanced Custom Fields JSON export
│   └── acf-apr-projects-field-group.json
├── WORDPRESS_ELEMENTOR_SETUP_GUIDE.md   # Step-by-step WordPress & Elementor installation guide
├── .gitignore                           # Git ignore rules
└── README.md                            # Repository documentation
```

---

## 🚀 Deployment Instructions

### Option 1: Static Hosting / GitHub Pages (Zero Config)
1. Push this repository to GitHub.
2. In GitHub, go to **Settings > Pages**.
3. Under **Build and deployment > Branch**, select `main` (or `master`) and folder `/ (root)`.
4. Click **Save**. Your website will be live globally in less than 2 minutes!

### Option 2: WordPress & Elementor CMS
1. Zip the `apr-group-theme/` folder.
2. In WordPress Admin, navigate to **Appearance > Themes > Add New > Upload Theme**.
3. Activate **APR Group Theme**.
4. Install and activate **Elementor** and **Advanced Custom Fields (ACF)**.
5. In **Custom Fields > Tools**, import `acf-export/acf-apr-projects-field-group.json`.
6. In **Templates > Saved Templates**, import the JSON templates from `elementor-templates/`.
7. Configure Google Business Profile / Places API credentials under **Settings > Google Reviews**.
8. For detailed instructions, refer to [WORDPRESS_ELEMENTOR_SETUP_GUIDE.md](WORDPRESS_ELEMENTOR_SETUP_GUIDE.md).

---

## 🌟 Key Features

1. **Automatic Hero Project Carousel:** Smooth rotating showcase of all 6 projects with touch swipe, keyboard arrows, and pagination dots.
2. **Interactive Plot Price & Budget Calculator:** Real-time formula estimating plot budgets based on exact dimensions or finding matching plotting sites for a given budget.
3. **Google Business Profile Integration:** 
   * Direct review submission: `https://g.page/r/CUNndIdTFafPEBM/review`
   * Google Maps reviews profile: `https://maps.app.goo.gl/oc3artJE4YjWZAFA8`
   * Server-side API integration supporting Google Places API & GBP OAuth.
   * **Zero Fake Data Policy:** Displays only authentic reviews fetched via the API with Google attribution.
4. **Horizontal Feedback Submission Form:** Compact, modern customer experience sharing form saving to admin verification queue.
5. **Floating Quick Actions:** Mathematically equal-dimension rounded rectangle buttons for WhatsApp (+91 63921 99296) and Direct Calling.
6. **Mobile-First Responsive Layout:** 100% accessible and responsive across mobile, tablet, laptop, and ultra-wide screens.
7. **Complete SEO Suite:** Canonical tags, Open Graph meta tags, Twitter Cards, Schema.org LocalBusiness structured data, `sitemap.xml`, and `robots.txt`.

---

## 📄 License & Attribution

* **Website Design & Code:** © 2026 APR GROUP OF COMPANY. All Rights Reserved.
* **Google Attribution:** Google and the Google logo are registered trademarks of Google LLC.