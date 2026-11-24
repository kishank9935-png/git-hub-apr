<?php
/**
 * APR Group - Front Page Template
 * Elementor visual canvas compatible with complete native fallback
 */
get_header();

// If page was built with Elementor, output Elementor content directly
if (have_posts()) :
    while (have_posts()) : the_post();
        if (defined('ELEMENTOR_VERSION') && \Elementor\Plugin::$instance->db->is_built_with_elementor(get_the_ID())) {
            the_content();
        } else {
            // Native Modular Production Homepage
            ?>
            <!-- SECTION 1: HERO -->
            <section class="hero-home">
              <div class="container hero-grid">
                <div class="hero-content">
                  <span class="section-tag">Residential Plotting Solutions</span>
                  <h1>Find the Right Plot for Your Future</h1>
                  <p>Explore residential plot locations, compare prices and find land according to your needs and budget with APR GROUP OF COMPANY in Bhadohi, Uttar Pradesh.</p>
                  
                  <div class="hero-actions">
                    <a href="#projects-section" class="btn btn-blue btn-lg">Explore Our Projects →</a>
                  </div>
                </div>

                <div class="hero-visual">
                  <div class="hero-carousel" id="heroProjectCarousel" aria-label="APR Group Projects Carousel">
                    <div class="hero-carousel-slides">
                      <!-- Slide 1: Rajpura Phase 1 -->
                      <div class="hero-carousel-slide active" data-index="0">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/projects/rajpura-1.jpg" alt="Rajpura Phase 1 residential plots in Bhadohi" width="600" height="420">
                        <div class="hero-carousel-caption">
                          <span class="carousel-project-tag">Head Office Location</span>
                          <h4 class="carousel-project-title">Rajpura Phase 1</h4>
                          <span class="carousel-project-rate">₹2,500 / Sq. Ft.</span>
                        </div>
                      </div>

                      <!-- Slide 2: Ugapur -->
                      <div class="hero-carousel-slide" data-index="1">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/projects/ugapur-1.jpg" alt="Ugapur residential land in Bhadohi" width="600" height="420" loading="lazy">
                        <div class="hero-carousel-caption">
                          <span class="carousel-project-tag">Prime Growth</span>
                          <h4 class="carousel-project-title">Ugapur, Bhadohi</h4>
                          <span class="carousel-project-rate">₹1,300 / Sq. Ft.</span>
                        </div>
                      </div>

                      <!-- Slide 3: Kanshraipur -->
                      <div class="hero-carousel-slide" data-index="2">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/projects/kanshraipur-1.jpg" alt="Kanshraipur residential plots in Bhadohi" width="600" height="420" loading="lazy">
                        <div class="hero-carousel-caption">
                          <span class="carousel-project-tag">High Demand</span>
                          <h4 class="carousel-project-title">Kanshraipur</h4>
                          <span class="carousel-project-rate">₹2,300 / Sq. Ft.</span>
                        </div>
                      </div>

                      <!-- Slide 4: Chauri Bazar -->
                      <div class="hero-carousel-slide" data-index="3">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/projects/chauri-1.jpg" alt="Chauri Bazar residential plots" width="600" height="420" loading="lazy">
                        <div class="hero-carousel-caption">
                          <span class="carousel-project-tag">Market Connectivity</span>
                          <h4 class="carousel-project-title">Chauri Bazar</h4>
                          <span class="carousel-project-rate">₹1,300 / Sq. Ft.</span>
                        </div>
                      </div>

                      <!-- Slide 5: Gosai Bazar -->
                      <div class="hero-carousel-slide" data-index="4">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/projects/gosai-1.jpg" alt="Gosai Bazar Gyanpur residential plots" width="600" height="420" loading="lazy">
                        <div class="hero-carousel-caption">
                          <span class="carousel-project-tag">Best Budget Value</span>
                          <h4 class="carousel-project-title">Gosai Bazar, Gyanpur</h4>
                          <span class="carousel-project-rate">₹1,000 / Sq. Ft.</span>
                        </div>
                      </div>

                      <!-- Slide 6: Parjapatpur -->
                      <div class="hero-carousel-slide" data-index="5">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/projects/parjapatpur-1.jpg" alt="Parjapatpur residential land in Bhadohi" width="600" height="420" loading="lazy">
                        <div class="hero-carousel-caption">
                          <span class="carousel-project-tag">Serene Residential</span>
                          <h4 class="carousel-project-title">Parjapatpur, Bhadohi</h4>
                          <span class="carousel-project-rate">₹1,200 / Sq. Ft.</span>
                        </div>
                      </div>
                    </div>

                    <!-- Navigation Arrows -->
                    <button class="hero-carousel-arrow prev" aria-label="Previous Project Slide">
                      <svg viewBox="0 0 24 24"><path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/></svg>
                    </button>
                    <button class="hero-carousel-arrow next" aria-label="Next Project Slide">
                      <svg viewBox="0 0 24 24"><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/></svg>
                    </button>

                    <!-- Pagination Dots -->
                    <div class="hero-carousel-dots" role="tablist">
                      <button class="carousel-dot active" data-slide="0" aria-label="Go to Rajpura Phase 1" aria-selected="true"></button>
                      <button class="carousel-dot" data-slide="1" aria-label="Go to Ugapur" aria-selected="false"></button>
                      <button class="carousel-dot" data-slide="2" aria-label="Go to Kanshraipur" aria-selected="false"></button>
                      <button class="carousel-dot" data-slide="3" aria-label="Go to Chauri Bazar" aria-selected="false"></button>
                      <button class="carousel-dot" data-slide="4" aria-label="Go to Gosai Bazar" aria-selected="false"></button>
                      <button class="carousel-dot" data-slide="5" aria-label="Go to Parjapatpur" aria-selected="false"></button>
                    </div>
                  </div>
                </div>
              </div>
            </section>

            <!-- SECTION 2: TRUST AND INTRODUCTION -->
            <section class="trust-bar">
              <div class="container trust-grid">
                <div class="trust-item">
                  <div class="trust-icon"><svg viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg></div>
                  <div><h4>6 Plotting Projects</h4><p>Multiple prime growth locations</p></div>
                </div>
                <div class="trust-item">
                  <div class="trust-icon green"><svg viewBox="0 0 24 24"><path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/></svg></div>
                  <div><h4>Transparent Pricing</h4><p>Clear listed rate per square foot</p></div>
                </div>
                <div class="trust-item">
                  <div class="trust-icon"><svg viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg></div>
                  <div><h4>Direct Guidance</h4><p>Assistance directly from APR Group</p></div>
                </div>
                <div class="trust-item">
                  <div class="trust-icon green"><svg viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM6 9h12v2H6V9zm8 5H6v-2h8v2zm4-6H6V6h12v2z"/></svg></div>
                  <div><h4>Fast Enquiry Support</h4><p>Quick responses via call & WhatsApp</p></div>
                </div>
              </div>
            </section>

            <!-- SECTION 3: SMART PLOT SEARCH & CALCULATOR -->
            <section class="section section-soft" id="smart-search-section">
              <div class="container text-center">
                <span class="section-tag">Interactive Tool</span>
                <h2>Smart Property Search & Price Calculator</h2>
                <p class="lead">Compare rates, calculate estimated plot prices, or find how much land area fits your budget across all APR Group locations.</p>
                <?php get_template_part('template-parts/calculator/smart-calculator'); ?>
              </div>
            </section>

            <!-- SECTION 4: OUR PROJECTS (3-COLUMN GRID) -->
            <section class="section" id="projects-section">
              <div class="container text-center">
                <span class="section-tag">Residential Plotting</span>
                <h2>Our Featured Projects in Bhadohi</h2>
                <p class="lead">Explore our 6 residential plotting locations with verified rates and site layouts.</p>
                <div style="margin-top: 40px;">
                  <?php echo do_shortcode('[apr_project_grid count="6" columns="3"]'); ?>
                </div>
              </div>
            </section>

            <!-- SECTION 5: ABOUT APR GROUP -->
            <section class="section section-soft">
              <div class="container grid-2" style="align-items: center;">
                <div>
                  <span class="section-tag">About APR Group</span>
                  <h2>Building Your Future with Transparent Guidance</h2>
                  <p>APR GROUP OF COMPANY is headquartered at Siddhi Vinayak Colony, Rajpura Phase 1, Bhadohi. We specialize in residential land plotting across Bhadohi and nearby expanding areas.</p>
                  <p>Our core philosophy is straightforward: transparent per-square-foot rates, verified project locations, and dedicated personal assistance from initial site visit to final paperwork.</p>
                  <div style="margin-top: 24px; display:flex; gap:12px; flex-wrap:wrap;">
                    <a href="<?php echo esc_url(home_url('/about/')); ?>" class="btn btn-blue">Know More About Us →</a>
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-outline-navy">Visit Our Office</a>
                  </div>
                </div>
                <div>
                  <div style="border-radius: var(--radius-lg); overflow:hidden; box-shadow: var(--shadow-lg); border:4px solid #fff;">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/projects/about-office.jpg" alt="APR Group real estate plotting development" loading="lazy" width="600" height="400">
                  </div>
                </div>
              </div>
            </section>

            <!-- SECTION 6: WHY CHOOSE US -->
            <section class="section">
              <div class="container text-center">
                <span class="section-tag">Our Strengths</span>
                <h2>Why Property Buyers Choose APR Group</h2>
                <p class="lead">We focus on genuine business practices, straightforward rates, and dependable customer service.</p>

                <div class="grid-4 text-left" style="margin-top: 40px;">
                  <div class="card" style="padding: 24px;">
                    <div class="trust-icon" style="margin-bottom: 16px;"><svg viewBox="0 0 24 24"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/></svg></div>
                    <h4>Transparent Listed Rates</h4>
                    <p>Every project has clear, listed per-square-foot prices so you can plan your budget without unexpected surprises.</p>
                  </div>
                  <div class="card" style="padding: 24px;">
                    <div class="trust-icon green" style="margin-bottom: 16px;"><svg viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg></div>
                    <h4>6 Strategic Locations</h4>
                    <p>Carefully selected plotting sites in Rajpura, Ugapur, Kanshraipur, Chauri Bazar, Gosai Bazar and Parjapatpur.</p>
                  </div>
                  <div class="card" style="padding: 24px;">
                    <div class="trust-icon" style="margin-bottom: 16px;"><svg viewBox="0 0 24 24"><path d="M19 3h-4.18C14.4 1.84 13.3 1 12 1c-1.3 0-2.4.84-2.82 2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 0c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm2 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/></svg></div>
                    <h4>Direct Site Visits</h4>
                    <p>We accompany you to visit the exact plot, inspect the ground layout, boundaries, and check road accessibility.</p>
                  </div>
                  <div class="card" style="padding: 24px;">
                    <div class="trust-icon green" style="margin-bottom: 16px;"><svg viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-2 12H6v-2h12v2zm0-3H6V9h12v2zm0-3H6V6h12v2z"/></svg></div>
                    <h4>Active Communication</h4>
                    <p>Instant phone calls and WhatsApp support at +91 63921 99296 for questions, rate cards, and appointment bookings.</p>
                  </div>
                </div>
              </div>
            </section>

            <!-- SECTION 7: CUSTOMER REVIEWS & FEEDBACK -->
            <section class="section" id="reviews-section">
              <div class="container text-center">
                <span class="section-tag green">Verified Buyer Reviews</span>
                <h2>Customer Reviews & Testimonials</h2>
                <p class="lead">Genuine feedback from land buyers who explored, visited, and purchased residential plots with APR GROUP OF COMPANY in Bhadohi.</p>

                <?php
                $gbp_data = function_exists('apr_get_google_business_reviews') ? apr_get_google_business_reviews() : array();
                $has_reviews = !empty($gbp_data['reviews']);
                $write_review_url = defined('APR_GOOGLE_REVIEW_SUBMIT_URL') ? APR_GOOGLE_REVIEW_SUBMIT_URL : 'https://g.page/r/CUNndIdTFafPEBM/review';
                $maps_profile_url = defined('APR_GOOGLE_MAPS_PROFILE_URL') ? APR_GOOGLE_MAPS_PROFILE_URL : 'https://maps.app.goo.gl/oc3artJE4YjWZAFA8';
                ?>

                <!-- Google Business Profile Verification & Rating Header -->
                <div class="google-reviews-header">
                  <div class="google-brand-wrap">
                    <svg class="google-g-logo" viewBox="0 0 24 24" aria-label="Google Business Profile">
                      <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.8-2.4 3.66v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.15z"/>
                      <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.24v3.15C3.26 21.4 7.33 24 12 24z"/>
                      <path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.24C.45 8.16 0 9.94 0 12s.45 3.84 1.24 5.42l4.04-3.15z"/>
                      <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.33 0 3.26 2.6 1.24 6.58l4.04 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/>
                    </svg>
                    <div class="google-brand-info">
                      <h3>APR GROUP OF COMPANY</h3>
                      <div class="google-stars-row">
                        <span class="google-rating-score">5.0</span>
                        <span class="google-stars">★★★★★</span>
                        <span>• Verified Google Business Profile</span>
                      </div>
                    </div>
                  </div>
                  <div class="google-actions">
                    <a href="<?php echo esc_url($write_review_url); ?>" target="_blank" rel="noopener noreferrer" class="google-btn google-btn-outline" aria-label="Write a review on Google Business Profile">
                      <span>Write a Review on Google ↗</span>
                    </a>
                    <a href="<?php echo esc_url($maps_profile_url); ?>" target="_blank" rel="noopener noreferrer" class="google-btn google-btn-primary" aria-label="Read all Google reviews for APR GROUP OF COMPANY">
                      <span>Read All Google Reviews ↗</span>
                    </a>
                  </div>
                </div>

                <?php if ($has_reviews): ?>
                <!-- Authentic Customer Reviews Grid (Imported via API) -->
                <div class="grid-3 text-left">
                  <?php foreach ($gbp_data['reviews'] as $rev): ?>
                  <div class="testimonial-card">
                    <div class="testimonial-card-top">
                      <span class="testimonial-rating"><?php echo str_repeat('★', (int) ($rev['rating'] ?? 5)); ?></span>
                      <span class="testimonial-source-badge">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="#2467C5"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/></svg>
                        Google Review
                      </span>
                    </div>
                    <p>"<?php echo esc_html($rev['comment']); ?>"</p>
                    <div class="testimonial-author">
                      <?php if (!empty($rev['photo_url'])): ?>
                        <img src="<?php echo esc_url($rev['photo_url']); ?>" alt="<?php echo esc_attr($rev['display_name']); ?>" class="testimonial-avatar" style="object-fit:cover;" width="40" height="40">
                      <?php else: ?>
                        <div class="testimonial-avatar"><?php echo esc_html(substr($rev['display_name'], 0, 1)); ?></div>
                      <?php endif; ?>
                      <div>
                        <b><?php echo esc_html($rev['display_name']); ?></b>
                        <small><?php echo !empty($rev['date']) ? esc_html($rev['date']) . ' • ' : ''; ?>Verified Review</small>
                      </div>
                    </div>
                    <a href="<?php echo esc_url($rev['author_url'] ?? $maps_profile_url); ?>" target="_blank" rel="noopener noreferrer" class="testimonial-view-google">View on Google Maps ↗</a>
                  </div>
                  <?php endforeach; ?>
                </div>
                <?php else: ?>
                <!-- Official Google Business Profile Verified Showcase (Zero Fake Reviews) -->
                <div class="google-showcase-card">
                  <div class="google-showcase-badge">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="#159568"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/></svg>
                    <span>Verified Google Business Profile • 100% Authentic Customer Feedback</span>
                  </div>
                  <p class="google-showcase-desc">
                    All genuine customer reviews for <strong>APR GROUP OF COMPANY</strong> are hosted and verified directly on Google. We strictly do not publish unverified or fabricated testimonials.
                  </p>
                  <div class="google-showcase-actions">
                    <a href="<?php echo esc_url($maps_profile_url); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-blue">
                      <span>Read All Google Reviews on Maps ↗</span>
                    </a>
                    <a href="<?php echo esc_url($write_review_url); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-green">
                      <span>Write a Review on Google ↗</span>
                    </a>
                  </div>
                  <div class="google-api-integration-note">
                    <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                    <span><strong>Live Google Reviews API:</strong> Configure your Google Cloud Places API or Google Business Profile credentials in WordPress Admin (<em>Settings &gt; Google Reviews</em>) to sync authentic reviews with reviewer display names and photos dynamically via the official API.</span>
                  </div>
                </div>
                <?php endif; ?>

                <div style="font-size:0.8rem; color:var(--text-muted); margin-top:14px; text-align:right;">
                  * Google is a trademark of Google LLC. Customer reviews and ratings are hosted on Google Business Profile.
                </div>

                <!-- Compact Horizontal Customer Feedback / Experience Submission Section -->
                <div class="share-review-horizontal">
                  <div id="reviewSuccessAlert" class="review-alert-success" role="alert"></div>

                  <div class="share-review-layout">
                    <!-- Left Column: Heading, Subtitle & Interactive Stars -->
                    <div class="share-review-sidebar">
                      <span class="section-tag" style="margin-bottom:6px;">Direct Feedback</span>
                      <h3>Share Your Experience</h3>
                      <p>Visited our plotting sites or consulted our team? Your genuine feedback helps other buyers in Bhadohi.</p>

                      <div class="rating-select-wrap">
                        <label class="form-label">Star Rating *</label>
                        <div class="rating-stars-interactive" id="starContainer">
                          <button type="button" class="star-btn selected" data-rating="1" aria-label="Rate 1 star">★</button>
                          <button type="button" class="star-btn selected" data-rating="2" aria-label="Rate 2 stars">★</button>
                          <button type="button" class="star-btn selected" data-rating="3" aria-label="Rate 3 stars">★</button>
                          <button type="button" class="star-btn selected" data-rating="4" aria-label="Rate 4 stars">★</button>
                          <button type="button" class="star-btn selected" data-rating="5" aria-label="Rate 5 stars">★</button>
                        </div>
                        <div class="rating-label-text" id="ratingTextLabel">5 Stars - Outstanding Experience</div>
                        <input type="hidden" name="rating" id="reviewRatingInput" value="5">
                      </div>

                      <div style="font-size:0.78rem; color:var(--brand-green); font-weight:700; display:flex; align-items:center; gap:6px; margin-top:4px;">
                        <span>🔒 100% Verified Buyer Reviews Only</span>
                      </div>
                    </div>

                    <!-- Right Column: Compact Horizontal Form Fields -->
                    <div class="share-review-main">
                      <form id="aprReviewForm" novalidate>
                        <div class="share-form-grid">
                          <div class="form-group">
                            <label class="form-label" for="revCustomerName">Customer Name *</label>
                            <input type="text" id="revCustomerName" name="customer_name" class="form-control" required placeholder="Enter your full name">
                          </div>

                          <div class="form-group">
                            <label class="form-label" for="revMobileNumber">Mobile Number <span style="font-weight:normal;color:var(--text-muted);">(optional)</span></label>
                            <input type="tel" id="revMobileNumber" name="mobile_number" class="form-control" placeholder="10-digit mobile number">
                          </div>
                        </div>

                        <div class="share-form-grid" style="margin-top:10px;">
                          <div class="form-group">
                            <label class="form-label" for="revProjectSelect">Project Location <span style="font-weight:normal;color:var(--text-muted);">(optional)</span></label>
                            <select id="revProjectSelect" name="project_location" class="form-control">
                              <option value="">-- Choose Project Location --</option>
                              <option value="Rajpura Phase 1">Rajpura Phase 1 (₹2,500/sq.ft.)</option>
                              <option value="Ugapur, Bhadohi">Ugapur, Bhadohi (₹1,300/sq.ft.)</option>
                              <option value="Kanshraipur">Kanshraipur (₹2,300/sq.ft.)</option>
                              <option value="Chauri Bazar">Chauri Bazar (₹1,300/sq.ft.)</option>
                              <option value="Gosai Bazar, Gyanpur">Gosai Bazar, Gyanpur (₹1,000/sq.ft.)</option>
                              <option value="Parjapatpur, Bhadohi">Parjapatpur, Bhadohi (₹1,200/sq.ft.)</option>
                            </select>
                          </div>

                          <div class="form-group" style="display:flex; align-items:flex-end;">
                            <button type="submit" class="btn btn-blue" style="width:100%; height:42px; padding:0 14px; font-size:0.9rem; justify-content:center;">Submit Review For Verification →</button>
                          </div>
                        </div>

                        <div class="form-group" style="margin-top:10px;">
                          <label class="form-label" for="revReviewText">Write Your Review *</label>
                          <textarea id="revReviewText" name="review_text" class="form-control" rows="2" required placeholder="Share your experience regarding site visit, transparent pricing, plot boundary layout, or office guidance..."></textarea>
                        </div>

                        <div class="review-admin-notice-inline">
                          <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                          <span><strong>Policy:</strong> Submitted reviews are stored and verified by our office team before public approval to prevent spam.</span>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </section>

            <!-- SECTION 8: CTA -->
            <section class="section" style="padding-top: 20px;">
              <div class="container">
                <div class="cta-banner">
                  <h2>Looking for the Right Plot in Bhadohi?</h2>
                  <p>Connect with the APR GROUP OF COMPANY team today. We provide verified rate details, schedule personalized site visits, and guide you through plot selection.</p>
                  <div class="cta-banner-actions">
                    <a href="https://wa.me/916392199296" target="_blank" rel="noopener" class="btn btn-green btn-lg">💬 WhatsApp Us (+91 63921 99296)</a>
                    <a href="tel:+916392199296" class="btn btn-blue btn-lg">📞 Call Now (+91 63921 99296)</a>
                  </div>
                </div>
              </div>
            </section>
            <?php
        }
    endwhile;
endif;

get_footer();
