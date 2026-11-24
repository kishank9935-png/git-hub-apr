<?php
/**
 * APR Group - Single Project Template
 * Supports Elementor Theme Builder single location
 */
get_header();

if (!function_exists('elementor_theme_do_location') || !elementor_theme_do_location('single')) :
    while (have_posts()) : the_post();
        $post_id = get_the_ID();
        $rate = apr_get_project_rate($post_id);
        $location = apr_get_project_location($post_id);
        $badge = get_post_meta($post_id, 'badge_text', true) ?: 'Verified Project';
        $thumbnail_url = has_post_thumbnail() ? get_the_post_thumbnail_url($post_id, 'large') : get_template_directory_uri() . '/assets/images/projects/rajpura-1.jpg';
        $title = get_the_title();
        $wa_url = 'https://wa.me/916392199296?text=' . rawurlencode('Hello APR Group, I want details and availability for ' . $title . ' project at Rs.' . number_format($rate) . '/sq.ft.');
        ?>
        <!-- Breadcrumbs -->
        <div class="breadcrumb-wrap">
          <div class="container">
            <ul class="breadcrumb-list">
              <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
              <li class="breadcrumb-separator">/</li>
              <li><a href="<?php echo esc_url(home_url('/projects/')); ?>">Our Projects</a></li>
              <li class="breadcrumb-separator">/</li>
              <li><?php echo esc_html($title); ?></li>
            </ul>
          </div>
        </div>

        <section class="page-hero">
          <div class="container">
            <span class="section-tag green"><?php echo esc_html($badge); ?></span>
            <h1><?php echo esc_html($title); ?></h1>
            <p>📍 <?php echo esc_html($location); ?></p>
          </div>
        </section>

        <section class="section">
          <div class="container grid-2" style="align-items:start;">
            <div>
              <div style="border-radius:var(--radius-lg);overflow:hidden;box-shadow:var(--shadow-md);margin-bottom:24px;">
                <img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php echo esc_attr($title); ?>" width="600" height="400">
              </div>

              <h2>About <?php echo esc_html($title); ?></h2>
              <div class="article-body">
                <?php the_content(); ?>
              </div>
            </div>

            <div>
              <div class="card" style="padding: 28px; border-top: 4px solid var(--brand-blue); margin-bottom: 24px;">
                <small style="text-transform:uppercase;font-weight:700;letter-spacing:0.08em;color:var(--text-muted);display:block;margin-bottom:6px;">Current Listed Rate</small>
                <div style="font-size:2.2rem;font-weight:800;color:var(--brand-green);line-height:1.1;margin-bottom:12px;">
                  ₹<?php echo number_format($rate); ?> <span style="font-size:1rem;color:var(--text-muted);font-weight:600;">/ Sq. Ft.</span>
                </div>
                <p style="font-size:0.9rem;margin-bottom:20px;">Residential plots · <?php echo esc_html($location); ?></p>

                <div style="display:flex;flex-direction:column;gap:10px;">
                  <a href="<?php echo esc_url($wa_url); ?>" target="_blank" rel="noopener" class="btn btn-green btn-lg">
                    💬 Enquire on WhatsApp
                  </a>
                  <a href="tel:+916392199296" class="btn btn-blue btn-lg">
                    📞 Call Office: +91 63921 99296
                  </a>
                </div>
              </div>

              <!-- Dedicated Calculator -->
              <div class="card" style="padding: 24px; background:var(--bg-surface);">
                <h3 style="font-size:1.18rem;margin-bottom:12px;">Calculate Plot Price for <?php echo esc_html($title); ?></h3>
                <p style="font-size:0.86rem;margin-bottom:14px;">Enter plot area in square feet to calculate your estimated cost at ₹<?php echo number_format($rate); ?>/sq.ft.</p>
                <div class="form-group">
                  <label class="form-label" for="single-calc-size">Enter Plot Area (Sq. Ft.)</label>
                  <input type="number" id="single-calc-size" class="form-control" placeholder="e.g. 1000, 1200, 1500" value="1000">
                </div>
                <button id="btn-single-calc" class="btn btn-blue" style="width:100%;">Calculate Price Estimate</button>
                <div id="single-calc-result" style="display:none;"></div>
              </div>

              <p class="calc-disclaimer" style="margin-top:20px;">
                <strong>Important Disclaimer:</strong> All prices and estimates shown are indicative based on the listed rate per square foot. Final price, boundary confirmation, registration, documentation and any applicable additional charges must be verified directly with APR GROUP OF COMPANY.
              </p>
            </div>
          </div>
        </section>

        <!-- Dynamic Size Matrix Table -->
        <section class="section section-soft">
          <div class="container">
            <h2 style="font-size:1.6rem;margin-bottom:8px;">Standard Plot Sizes & Estimated Price Matrix</h2>
            <p style="margin-bottom:24px;">Indicative pricing for <?php echo esc_html($title); ?> calculated at the verified rate of <strong>₹<?php echo number_format($rate); ?> per Sq. Ft.</strong></p>
            
            <div class="table-responsive">
              <table class="pricing-table">
                <thead>
                  <tr>
                    <th>Plot Size (Sq. Ft.)</th>
                    <th>Rate Per Sq. Ft.</th>
                    <th>Estimated Total Price</th>
                    <th>Enquiry Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sizes = array(500, 600, 800, 1000, 1200, 1500, 1800, 2000);
                  foreach ($sizes as $s) :
                      $cost = $s * $rate;
                      $wa_size = 'https://wa.me/916392199296?text=' . rawurlencode('Hello APR Group, I am interested in ' . $s . ' Sq.Ft. plot in ' . $title);
                  ?>
                  <tr>
                    <td><strong><?php echo number_format($s); ?> Sq. Ft.</strong></td>
                    <td>₹<?php echo number_format($rate); ?></td>
                    <td><span class="price-val">₹<?php echo number_format($cost); ?></span></td>
                    <td><a href="<?php echo esc_url($wa_size); ?>" target="_blank" rel="noopener" class="btn btn-green btn-sm">WhatsApp</a></td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </section>
        
        <script>
          document.addEventListener('DOMContentLoaded', function() {
            if (typeof initSingleProjectCalculator === 'function') {
              initSingleProjectCalculator(<?php echo intval($rate); ?>, '<?php echo esc_js($title); ?>');
            }
          });
        </script>
        <?php
    endwhile;
endif;

get_footer();
