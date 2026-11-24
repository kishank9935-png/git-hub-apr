<?php
/**
 * APR Group - Single Blog Post Template
 */
get_header();

while (have_posts()) : the_post();
    ?>
    <div class="breadcrumb-wrap">
      <div class="container">
        <ul class="breadcrumb-list">
          <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
          <li class="breadcrumb-separator">/</li>
          <li><a href="<?php echo esc_url(home_url('/blog/')); ?>">Blog</a></li>
          <li class="breadcrumb-separator">/</li>
          <li><?php the_title(); ?></li>
        </ul>
      </div>
    </div>

    <section class="section">
      <div class="container" style="max-width:880px;">
        <div class="article-header">
          <span class="section-tag"><?php echo get_the_category_list(', ') ?: 'Property Guide'; ?></span>
          <h1 class="article-title"><?php the_title(); ?></h1>
          <div class="blog-meta">
            <span>By <?php the_author(); ?></span>
            <span>• <?php echo get_the_date(); ?></span>
          </div>
        </div>

        <?php if (has_post_thumbnail()) : ?>
          <img src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php the_title_attribute(); ?>" class="article-featured-img">
        <?php endif; ?>

        <div class="article-body">
          <?php the_content(); ?>
        </div>

        <div style="background:var(--brand-green-light);border:1px solid rgba(21,149,104,0.3);border-radius:var(--radius-md);padding:24px;margin:35px 0;">
          <h3 style="color:var(--brand-navy);font-size:1.2rem;margin-bottom:8px;">Discuss with APR Group Property Advisors</h3>
          <p style="margin-bottom:16px;">Have questions about residential land in Bhadohi? Connect with our team directly on WhatsApp.</p>
          <a href="https://wa.me/916392199296" target="_blank" rel="noopener" class="btn btn-green">
            💬 WhatsApp Enquiry (+91 63921 99296)
          </a>
        </div>
      </div>
    </section>
    <?php
endwhile;

get_footer();
