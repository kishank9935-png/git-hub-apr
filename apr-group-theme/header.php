<?php
/**
 * APR Group Theme Header
 * Fully compatible with Elementor Theme Builder & native fallback
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php
// Check if Elementor Theme Builder has registered a custom Header template
if (!function_exists('elementor_theme_do_location') || !elementor_theme_do_location('header')) :
?>
  <!-- Topbar -->
  <div class="topbar">
    <div class="container topbar-content">
      <div class="topbar-items">
        <span class="topbar-item">📍 Siddhi Vinayak Colony, Rajpura Phase 1, Bhadohi, UP 221401</span>
        <span class="topbar-item">⏰ Mon - Sun (9:00 AM - 7:00 PM)</span>
      </div>
      <div class="topbar-items">
        <span class="topbar-item">📞 <a href="tel:+916392199296">+91 63921 99296</a></span>
        <span class="topbar-item">💬 <a target="_blank" rel="noopener" href="https://wa.me/916392199296">+91 63921 99296</a></span>
      </div>
    </div>
  </div>

  <!-- Header -->
  <header class="header-main">
    <div class="container header-container">
      <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo" aria-label="<?php bloginfo('name'); ?>">
        <?php if (has_custom_logo()) : the_custom_logo(); else : ?>
          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/apr-group-logo.png" alt="APR Group of Company Logo">
        <?php endif; ?>
      </a>

      <!-- Desktop Nav -->
      <nav class="site-nav" aria-label="<?php esc_attr_e('Main Navigation', 'apr-group'); ?>">
        <ul>
          <li><a href="<?php echo esc_url(home_url('/')); ?>" class="<?php echo is_front_page() ? 'active' : ''; ?>">Home</a></li>
          <li><a href="<?php echo esc_url(home_url('/about/')); ?>">About Us</a></li>
          <li class="has-dropdown">
            <a href="<?php echo esc_url(home_url('/projects/')); ?>" class="<?php echo is_post_type_archive('apr_project') || is_singular('apr_project') ? 'active' : ''; ?>">Our Projects ▾</a>
            <div class="dropdown-menu">
              <a href="<?php echo esc_url(home_url('/projects/rajpura-phase-1/')); ?>" class="dropdown-item"><span>Rajpura Phase 1</span><span class="rate">₹2,500/sq.ft.</span></a>
              <a href="<?php echo esc_url(home_url('/projects/ugapur/')); ?>" class="dropdown-item"><span>Ugapur, Bhadohi</span><span class="rate">₹1,300/sq.ft.</span></a>
              <a href="<?php echo esc_url(home_url('/projects/kanshraipur/')); ?>" class="dropdown-item"><span>Kanshraipur</span><span class="rate">₹2,300/sq.ft.</span></a>
              <a href="<?php echo esc_url(home_url('/projects/chauri-bazar/')); ?>" class="dropdown-item"><span>Chauri Bazar</span><span class="rate">₹1,300/sq.ft.</span></a>
              <a href="<?php echo esc_url(home_url('/projects/gosai-bazar/')); ?>" class="dropdown-item"><span>Gosai Bazar, Gyanpur</span><span class="rate">₹1,000/sq.ft.</span></a>
              <a href="<?php echo esc_url(home_url('/projects/parjapatpur/')); ?>" class="dropdown-item"><span>Parjapatpur, Bhadohi</span><span class="rate">₹1,200/sq.ft.</span></a>
            </div>
          </li>
          <li><a href="<?php echo esc_url(home_url('/gallery/')); ?>">Gallery</a></li>
          <li><a href="<?php echo esc_url(home_url('/blog/')); ?>">Blog</a></li>
          <li><a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact Us</a></li>
        </ul>
      </nav>

      <!-- Desktop Actions -->
      <div class="header-actions">
        <a href="https://wa.me/916392199296" target="_blank" rel="noopener" class="btn btn-green btn-sm">💬 WhatsApp</a>
        <a href="tel:+916392199296" class="btn btn-blue btn-sm">📞 Call Now</a>
        <button class="hamburger" aria-label="Toggle navigation menu" aria-expanded="false">
          <span></span><span></span><span></span>
        </button>
      </div>
    </div>
  </header>

  <!-- Mobile Drawer -->
  <div class="mobile-nav">
    <ul>
      <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
      <li><a href="<?php echo esc_url(home_url('/about/')); ?>">About Us</a></li>
      <li>
        <a href="<?php echo esc_url(home_url('/projects/')); ?>" class="mobile-submenu-toggle">Our Projects ▾</a>
        <div class="mobile-submenu">
          <a href="<?php echo esc_url(home_url('/projects/')); ?>">All Projects Overview</a>
          <a href="<?php echo esc_url(home_url('/projects/rajpura-phase-1/')); ?>">Rajpura Phase 1 (₹2,500/sq.ft.)</a>
          <a href="<?php echo esc_url(home_url('/projects/ugapur/')); ?>">Ugapur, Bhadohi (₹1,300/sq.ft.)</a>
          <a href="<?php echo esc_url(home_url('/projects/kanshraipur/')); ?>">Kanshraipur (₹2,300/sq.ft.)</a>
          <a href="<?php echo esc_url(home_url('/projects/chauri-bazar/')); ?>">Chauri Bazar (₹1,300/sq.ft.)</a>
          <a href="<?php echo esc_url(home_url('/projects/gosai-bazar/')); ?>">Gosai Bazar, Gyanpur (₹1,000/sq.ft.)</a>
          <a href="<?php echo esc_url(home_url('/projects/parjapatpur/')); ?>">Parjapatpur (₹1,200/sq.ft.)</a>
        </div>
      </li>
      <li><a href="<?php echo esc_url(home_url('/gallery/')); ?>">Gallery</a></li>
      <li><a href="<?php echo esc_url(home_url('/blog/')); ?>">Blog</a></li>
      <li><a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact Us</a></li>
    </ul>
    <div class="mobile-actions">
      <a href="https://wa.me/916392199296" target="_blank" rel="noopener" class="btn btn-green">💬 WhatsApp Enquiry</a>
      <a href="tel:+916392199296" class="btn btn-blue">📞 Call +91 63921 99296</a>
    </div>
  </div>
<?php endif; ?>
