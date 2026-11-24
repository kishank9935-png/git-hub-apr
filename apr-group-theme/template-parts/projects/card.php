<?php
/**
 * APR Group - Project Card Template Part
 */
$post_id = get_the_ID();
$rate = apr_get_project_rate($post_id);
$location = apr_get_project_location($post_id);
$badge = get_post_meta($post_id, 'badge_text', true) ?: 'Verified Project';
$short_desc = get_post_meta($post_id, 'short_description', true) ?: get_the_excerpt();
$thumbnail_url = has_post_thumbnail() ? get_the_post_thumbnail_url($post_id, 'large') : get_template_directory_uri() . '/assets/images/projects/rajpura-1.jpg';
$permalink = get_permalink();
$wa_url = 'https://wa.me/916392199296?text=' . rawurlencode('Hello APR Group, I am interested in ' . get_the_title() . ' project.');
?>
<div class="card project-card">
  <div class="project-card-media">
    <img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
    <span class="project-badge"><?php echo esc_html($badge); ?></span>
  </div>
  <div class="project-card-body">
    <h3 class="project-card-title"><?php the_title(); ?></h3>
    <div class="project-location">
      📍 <?php echo esc_html($location); ?>
    </div>
    <p><?php echo esc_html($short_desc); ?></p>
    <div class="project-price-box">
      <span class="project-rate-label">Listed Rate</span>
      <div class="project-rate-value">₹<?php echo number_format($rate); ?> <small style="font-size:0.85rem;color:var(--text-muted)">/ Sq. Ft.</small></div>
    </div>
    <div class="project-card-actions">
      <a href="<?php echo esc_url($permalink); ?>" class="btn btn-outline-blue btn-sm">View Details →</a>
      <a href="<?php echo esc_url($wa_url); ?>" target="_blank" rel="noopener" class="btn btn-green btn-sm">WhatsApp</a>
    </div>
  </div>
</div>
