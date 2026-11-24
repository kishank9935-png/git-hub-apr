# APR GROUP OF COMPANY — WordPress & Elementor Architecture & Deployment Guide

## 1. Executive Summary & Brand Identity

This production package provides the complete website for **APR GROUP OF COMPANY** (Real Estate & Residential Plotting, Bhadohi, Uttar Pradesh, India), engineered with **strict 3-brand-colour fidelity**, 100% mobile responsiveness, dynamic rate management, and full visual editability through **WordPress & Elementor**.

### Strict 3-Colour Brand Palette:
1. **Brand Navy Blue (`#173B65`):** Headings, footer, navigation bar, badges, and primary structure.
2. **Brand Blue (`#2467C5`):** Primary action buttons, active navigation states, links, and calculation highlights.
3. **Brand Green (`#159568`):** WhatsApp instant enquiry buttons, listed rates, badges, and positive budget status.
*Neutral surfaces (Pure White `#FFFFFF`, Soft `#F5F8FC`, and Pale `#EBF2FA`) are used strictly for background contrast with zero random accent colours.*

---

## 2. Directory Structure & Deliverables

```text
APR GROUP/
├── index.html                           # Production Homepage
├── about.html                           # About Us Page
├── projects.html                        # Our Projects Listing (3-Column Desktop Grid)
├── rajpura-phase-1.html                 # Rajpura Phase 1 (₹2,500/sq.ft.)
├── ugapur.html                          # Ugapur, Bhadohi (₹1,300/sq.ft.)
├── kanshraipur.html                     # Kanshraipur (₹2,300/sq.ft.)
├── chauri-bazar.html                    # Chauri Bazar (₹1,300/sq.ft.)
├── gosai-bazar.html                     # Gosai Bazar, Gyanpur (₹1,000/sq.ft.)
├── parjapatpur.html                     # Parjapatpur, Bhadohi (₹1,200/sq.ft.)
├── gallery.html                         # Filterable Project Gallery with Lightbox
├── blog.html                            # Property Guides & Blog Index
├── blog-how-to-check-plot.html          # Article 1: How to Check a Plot Before Buying
├── blog-why-bhadohi.html                # Article 2: Why Bhadohi Is an Interesting Location
├── blog-plot-size-vs-budget.html        # Article 3: Plot Size vs Budget: Complete Guide
├── blog-documents-checklist.html        # Article 4: Important Documents to Check
├── blog-how-to-calculate-prices.html    # Article 5: How to Calculate Residential Plot Prices
├── contact.html                         # Contact Us with Embedded Google Map
├── privacy-policy.html                  # Privacy Policy
├── terms-and-conditions.html            # Terms and Conditions
├── disclaimer.html                      # Official Real Estate Disclaimer
├── sitemap.xml                          # XML Sitemap for Search Engines
├── robots.txt                           # Search Engine Crawler Directives
├── assets/
│   ├── css/
│   │   ├── brand-system.css             # 3-Color Design Tokens, Typography, Reset
│   │   └── components.css               # Calculator, Gallery, Cards, Forms, Maps
│   ├── js/
│   │   ├── calculator.js                # Live Multi-Mode Calculator Logic
│   │   ├── gallery.js                   # Filter Tabs & Lightbox Handler
│   │   ├── contact.js                   # Form Validation & WhatsApp Lead Generator
│   │   └── main.js                      # Mobile Drawer, Sticky Header, Current Year
│   └── images/
│       ├── apr-group-logo.png           # Official APR Group Logo
│       └── projects/                    # 18 Optimized Real Project DSLR Photos
├── apr-group-theme/                     # Production WordPress Custom Theme
│   ├── style.css                        # Theme Declaration & Header
│   ├── functions.php                    # CPT Registration, Elementor Hooks, Shortcodes
│   ├── header.php                       # Elementor Theme Builder Header Hook + Fallback
│   ├── footer.php                       # Elementor Theme Builder Footer Hook + Fallback
│   ├── front-page.php                   # Elementor Editable Canvas + Native Modular Sections
│   ├── archive-apr_project.php          # Dedicated Projects Archive Template
│   ├── single-apr_project.php           # Dedicated Project Detail Template with Live Calculator
│   ├── page.php                         # Generic Elementor-Compatible Page Template
│   ├── single.php                       # Blog Single Post Template
│   ├── home.php                         # Blog Index Template
│   ├── inc/
│   │   └── acf-fields.php               # Native ACF PHP Field Group Definitions
│   └── template-parts/
│       ├── calculator/smart-calculator.php
│       └── projects/card.php
├── elementor-templates/
│   ├── elementor-header.json            # Importable Elementor Header Template
│   ├── elementor-footer.json            # Importable Elementor Footer Template
│   └── elementor-homepage.json          # Importable Elementor Homepage Template
└── acf-export/
    └── acf-apr-projects-field-group.json # ACF JSON Field Group Export
```

---

## 3. WordPress Installation & Activation

1. **Upload Theme:**
   - In your WordPress Admin Dashboard, navigate to **Appearance -> Themes -> Add New Theme -> Upload Theme**.
   - Zip the `apr-group-theme` folder and upload `apr-group-theme.zip` (or upload via SFTP into `wp-content/themes/apr-group-theme/`).
   - Click **Activate**.

2. **Automatic Project Seeding:**
   - Upon activation, the theme automatically registers the custom post type **Plot Projects (`apr_project`)** and creates the 6 verified default projects with their exact rates:
     - **Rajpura Phase 1:** ₹2,500/Sq. Ft.
     - **Ugapur, Bhadohi:** ₹1,300/Sq. Ft.
     - **Kanshraipur:** ₹2,300/Sq. Ft.
     - **Chauri Bazar:** ₹1,300/Sq. Ft.
     - **Gosai Bazar, Gyanpur:** ₹1,000/Sq. Ft.
     - **Parjapatpur, Bhadohi:** ₹1,200/Sq. Ft.

3. **Install Recommended Plugins:**
   - **Elementor** (Free or Pro)
   - **Advanced Custom Fields (ACF)** (Free or Pro) — *Optional, as `inc/acf-fields.php` provides automatic native support even without ACF active!*
   - **Rank Math SEO** or **Yoast SEO**

---

## 4. Visual Editing Through Elementor

The owner can visually edit any page without touching code:

1. **Editing Pages with Elementor:**
   - Go to **Pages -> All Pages**.
   - Hover over **Home**, **About Us**, **Our Projects**, **Gallery**, or **Contact Us**, and click **Edit with Elementor**.
   - Every text heading, description, button, and image container can be clicked and edited directly in the Elementor live preview pane.

2. **Embedding Dynamic Custom Modules in Elementor:**
   - **Smart Plot Price Calculator:** Drag an Elementor **Shortcode Widget** and paste:
     `[apr_plot_calculator]`
   - **Dynamic 3-Column Project Grid:** Drag an Elementor **Shortcode Widget** and paste:
     `[apr_project_grid count="6" columns="3"]`

3. **Importing Elementor Templates:**
   - Go to **Templates -> Saved Templates -> Import Templates**.
   - Select `elementor-templates/elementor-header.json`, `elementor-footer.json`, or `elementor-homepage.json`.
   - In Elementor Theme Builder (Elementor Pro), assign the header and footer to display across **Entire Site**.

---

## 5. Central Rate & Project Management (No Code Required)

To update project prices, add photos, or modify location information:
1. Go to **Plot Projects -> All Projects** in the WordPress sidebar.
2. Click on any project (e.g., **Rajpura Phase 1**).
3. Under the **Project Details & Rate Settings** metabox:
   - Change **Rate Per Square Foot (₹)**: (e.g., change `2500` to `2600`).
   - Change **Exact Project Location**.
   - Change **Project Badge / Highlight Text**.
   - Update the **Featured Image** (this automatically updates the archive card and single detail banner).
4. Click **Update**.
5. All live pricing tables, single-project calculators, and archive cards update across the entire site immediately!

---

## 6. How to Edit & Replace Photos in Elementor (Elementor में Photos कैसे बदलें)

All images in the website are 100% Elementor-compatible and can be easily swapped directly through the visual editor without writing a single line of code.

### A. Replacing Photos on Any Page (Homepage, About Us, Gallery, Contact):
1. In your WordPress dashboard, navigate to **Pages -> All Pages**.
2. Click **Edit with Elementor** on the page you wish to modify (e.g., **Home**).
3. In the live Elementor visual preview, simply **click directly on any picture / image box**.
4. In the left-hand Elementor panel under the **Content** tab, hover over the image preview and click **Choose Image**.
5. Click **Upload Files** to pick a photo from your computer, or choose one from your WordPress Media Library.
6. Click **Insert Media** at the bottom right.
7. Click the green **Update** button at the bottom of the Elementor panel. Your new photo is live instantly!

### B. Changing Individual Project Photos (Rajpura Phase 1, Ugapur, Kanshraipur, etc.):
1. In your WordPress sidebar, go to **Plot Projects -> All Projects**.
2. Click on the project name you want to update (e.g., **Rajpura Phase 1**).
3. On the right-hand sidebar, scroll down to the **Featured Image** box.
4. Click **Replace Image** (or **Set featured image**).
5. Upload your plot or site photo and click **Set featured image**.
6. Click **Update**.
7. The project card in the homepage 3-column grid, the project listing page, and the individual project header will all automatically display your new photo!

---

## 7. Smart Plot Price Calculator Mechanics

The calculator operates in two distinct modes:

### Mode 1: Search by Location
- Customer selects **Project Location**, **Plot Size (Sq. Ft.)**, and **Target Budget**.
- **Calculation:** $\text{Total Estimated Price} = \text{Plot Size} \times \text{Price per Sq. Ft.}$
- **Budget Comparison:** Compares total cost against user's budget and displays whether the plot is comfortably within budget or exceeds budget with the exact difference in INR.
- **Action:** Generates a direct prefilled WhatsApp enquiry button containing the project name, calculated area, rate, and estimated price.

### Mode 2: Search by Budget
- Customer selects their **Total Investment Budget** (e.g., ₹10 Lakh, ₹15 Lakh, ₹20 Lakh).
- **Calculation:** $\text{Estimated Land Area} = \frac{\text{Total Budget}}{\text{Rate per Sq. Ft.}}$
- Instantly displays all 6 projects side by side, showing the exact land area in square feet that can be purchased for that budget.

---

## 7. WhatsApp & Contact System Integration

- **Phone Number:** `+91 63921 99296`
- **WhatsApp Direct URL:** `https://wa.me/916392199296`
- **Lead Generation Routing:** Every project card and form dynamically injects prefilled message parameters into WhatsApp:
  - Project name
  - Client name & phone number
  - Preferred plot size
  - Budget bracket
  - Custom notes
- **Direct Calling:** Uses RFC 3966 `tel:+916392199296` for native one-tap dialing on mobile devices.

---

## 8. Embedded Google Maps Setup

- **Official Address:** Siddhi Vinayak Colony, Rajpura Phase 1, Bhadohi, Uttar Pradesh 221401, India.
- **Embedded Iframe Source:** Responsive iframe embedded directly in `contact.html` with zero horizontal overflow:
  ```html
  <iframe src="https://maps.google.com/maps?q=APR+GROUP+OF+COMPANY+Siddhi+Vinayak+Colony+Rajpura+Phase+1+Bhadohi+Uttar+Pradesh+221401&t=&z=16&ie=UTF8&iwloc=&output=embed"></iframe>
  ```
- **External Map Link:** Direct link to `https://maps.app.goo.gl/xPQswscYuLeQw1Kb9` with "Open in Google Maps" and "Get Directions" buttons.

---

## 9. Mobile Responsiveness & Quality Assurance

The design system uses CSS Grid with fluid clamps and auto-fit media queries:
- **Desktop (1920px & 1366px):** 3-column project cards, horizontal navigation, full calculator layout.
- **Tablet (1024px & 768px):** 2-column project cards, responsive trust bar, compact padding.
- **Mobile (430px, 390px, 375px, 360px, 320px):** Single-column stacked layout, touch-friendly hamburger drawer, sticky bottom WhatsApp/Call action buttons, zero horizontal scrolling.
