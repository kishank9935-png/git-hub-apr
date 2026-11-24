<?php
/**
 * APR Group - Blog Index Template
 */
get_header();
?>
<div class="breadcrumb-wrap">
  <div class="container">
    <ul class="breadcrumb-list">
      <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
      <li class="breadcrumb-separator">/</li>
      <li>Blog & Guides</li>
    </ul>
  </div>
</div>

<section class="page-hero">
  <div class="container">
    <span class="section-tag green">Real Estate Knowledge</span>
    <h1>Property Buying Guides & Insights</h1>
    <p>Practical guides, budgeting advice, and location insights to help you make well-informed land purchasing decisions in Bhadohi.</p>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="grid-3">
      <?php
      if (have_posts()) :
          while (have_posts()) : the_post();
              ?>
              <article class="card blog-card">
                <div class="blog-card-media">
                  <?php if (has_post_thumbnail()) : ?>
                    <img src="<?php the_post_thumbnail_url('medium_large'); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
                  <?php else : ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/projects/site-visit.jpg" alt="<?php the_title_attribute(); ?>" loading="lazy">
                  <?php endif; ?>
                </div>
                <div class="blog-card-body">
                  <div class="blog-meta">
                    <span class="blog-meta-badge"><?php echo get_the_category_list(', ') ?: 'Guide'; ?></span>
                    <span>• <?php echo get_the_date(); ?></span>
                  </div>
                  <h3 class="blog-card-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                  </h3>
                  <p class="blog-card-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 18); ?></p>
                  <div class="blog-card-footer">
                    <a href="<?php the_permalink(); ?>" style="font-weight:700;">Read Full Guide →</a>
                  </div>
                </div>
              </article>
              <?php
          endwhile;
      else :
          echo '<p>No articles published yet.</p>';
      endif;
      ?>
    </div>
  </div>
</section>

<?php get_footer(); ?>
