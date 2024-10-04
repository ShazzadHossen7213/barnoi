<?php

/**
 * Template Name: Team Members
 */

get_header(); ?>




<div class="team-member">
  <h2><?php the_title(); ?></h2>
  <div><?php the_content(); ?></div>
</div>


<!-- Team Area  Start Here  -->
<section class="team__area">
  <div class="container-fluid">
    <div class="row">
      <?php
      // Create a new WP_Query object to fetch team members
      $args = array(
        'post_type'      => 'teammember',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'order'          => 'ASC',
        'paged'          => get_query_var('paged') ? get_query_var('paged') : 1,
      );

      $team_members = new WP_Query($args);

      if ($team_members->have_posts()) :
        while ($team_members->have_posts()) : $team_members->the_post();
      ?>
          <div class="col-xl-3 col-md-6 col-12 mb-40">
            <div class="team">
              <div class="team__img mb-10">
                <a href="#"><?php echo the_post_thumbnail('teammember') ?></a>
                <div class="overlay">
                  <div class="icons">
                    <a href="<?php echo esc_attr($facebook); ?>"><i class="fa-brands fa-facebook"></i></a>
                    <a href="<?php echo esc_attr($instagram); ?>"><i class="fa-brands fa-instagram"></i></a>
                    <a href="<?php echo esc_attr($twitter); ?>"><i class="fa-brands fa-twitter"></i></a>
                    <a href="<?php echo esc_attr($pinterest); ?>"><i class="fa-brands fa-pinterest"></i></a>
                  </div>
                </div>
              </div>
              <div class="team__content text-center">
                <p><?php the_excerpt(); ?></p>
                <h4><?php the_title(); ?></h4>
              </div>
            </div>
          </div>
      <?php
        endwhile;
        wp_reset_postdata(); // Reset post data
      else :
        echo '<p>No team members found.</p>';
      endif;
      ?>
    </div>
</section>

<!-- Team Area End Here -->
<?php get_footer(); ?>