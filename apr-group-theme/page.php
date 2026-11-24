<?php
/**
 * APR Group - Generic Page Template
 * 100% Elementor visual builder compatible
 */
get_header();

while (have_posts()) : the_post();
    if (defined('ELEMENTOR_VERSION') && \Elementor\Plugin::$instance->db->is_built_with_elementor(get_the_ID())) {
        the_content();
    } else {
        ?>
        <div class="breadcrumb-wrap">
          <div class="container">
            <ul class="breadcrumb-list">
              <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
              <li class="breadcrumb-separator">/</li>
              <li><?php the_title(); ?></li>
            </ul>
          </div>
        </div>

        <section class="page-hero">
          <div class="container">
            <h1><?php the_title(); ?></h1>
          </div>
        </section>

        <section class="section">
          <div class="container" style="max-width:880px;">
            <div class="article-body">
              <?php the_content(); ?>
            </div>
          </div>
        </section>
        <?php
    }
endwhile;

get_footer();
