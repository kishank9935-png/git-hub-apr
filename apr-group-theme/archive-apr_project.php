<?php
/**
 * APR Group - Project Archive Template
 * Supports Elementor Theme Builder archive location
 */
get_header();

if (!function_exists('elementor_theme_do_location') || !elementor_theme_do_location('archive')) :
?>
  <!-- Breadcrumbs -->
  <div class="breadcrumb-wrap">
    <div class="container">
      <ul class="breadcrumb-list">
        <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
        <li class="breadcrumb-separator">/</li>
        <li>Our Projects</li>
      </ul>
    </div>
  </div>

  <section class="page-hero">
    <div class="container">
      <span class="section-tag green">Residential Plotting</span>
      <h1>Our Projects in Bhadohi</h1>
      <p>Discover our 6 plotting locations with centrally managed, transparent per-square-foot rates and direct developer assistance.</p>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <?php echo do_shortcode('[apr_project_grid count="12" columns="3"]'); ?>
    </div>
  </section>
<?php endif; ?>

<?php get_footer(); ?>
