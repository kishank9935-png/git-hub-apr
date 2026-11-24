<?php
/**
 * Fallback static cards for the 6 projects
 */
$uri = get_template_directory_uri();
$projects = array(
    array('title' => 'Rajpura Phase 1', 'rate' => 2500, 'loc' => 'Siddhi Vinayak Colony, Rajpura, Bhadohi', 'img' => $uri . '/assets/images/projects/rajpura-1.jpg', 'badge' => 'Head Office Location', 'slug' => 'rajpura-phase-1'),
    array('title' => 'Ugapur, Bhadohi', 'rate' => 1300, 'loc' => 'Ugapur, Bhadohi, UP', 'img' => $uri . '/assets/images/projects/ugapur-1.jpg', 'badge' => 'Affordable Growth', 'slug' => 'ugapur'),
    array('title' => 'Kanshraipur', 'rate' => 2300, 'loc' => 'Kanshraipur, Bhadohi, UP', 'img' => $uri . '/assets/images/projects/kanshraipur-1.jpg', 'badge' => 'High Demand', 'slug' => 'kanshraipur'),
    array('title' => 'Chauri Bazar', 'rate' => 1300, 'loc' => 'Chauri Bazar, Bhadohi, UP', 'img' => $uri . '/assets/images/projects/chauri-1.jpg', 'badge' => 'Market Connectivity', 'slug' => 'chauri-bazar'),
    array('title' => 'Gosai Bazar, Gyanpur', 'rate' => 1000, 'loc' => 'Gosai Bazar, Gyanpur, UP', 'img' => $uri . '/assets/images/projects/gosai-1.jpg', 'badge' => 'Best Budget Value', 'slug' => 'gosai-bazar'),
    array('title' => 'Parjapatpur, Bhadohi', 'rate' => 1200, 'loc' => 'Parjapatpur, Bhadohi, UP', 'img' => $uri . '/assets/images/projects/parjapatpur-1.jpg', 'badge' => 'Serene Surroundings', 'slug' => 'parjapatpur'),
);

foreach ($projects as $p) :
    $wa = 'https://wa.me/916392199296?text=' . rawurlencode('Hello APR Group, I want details for ' . $p['title']);
?>
<div class="card project-card">
  <div class="project-card-media">
    <img src="<?php echo esc_url($p['img']); ?>" alt="<?php echo esc_attr($p['title']); ?>" loading="lazy">
    <span class="project-badge"><?php echo esc_html($p['badge']); ?></span>
  </div>
  <div class="project-card-body">
    <h3 class="project-card-title"><?php echo esc_html($p['title']); ?></h3>
    <div class="project-location">📍 <?php echo esc_html($p['loc']); ?></div>
    <p>Residential plot options with verified boundaries and clear per-square-foot rates.</p>
    <div class="project-price-box">
      <span class="project-rate-label">Listed Rate</span>
      <div class="project-rate-value">₹<?php echo number_format($p['rate']); ?> <small style="font-size:0.85rem;color:var(--text-muted)">/ Sq. Ft.</small></div>
    </div>
    <div class="project-card-actions">
      <a href="<?php echo esc_url(home_url('/projects/' . $p['slug'] . '/')); ?>" class="btn btn-outline-blue btn-sm">View Details →</a>
      <a href="<?php echo esc_url($wa); ?>" target="_blank" rel="noopener" class="btn btn-green btn-sm">WhatsApp</a>
    </div>
  </div>
</div>
<?php endforeach; ?>
