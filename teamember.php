<?php

/**
 * Template Name: Team Members
 */

get_header(); ?>

<div class="team-members">
  <?php
  // Create a new WP_Query object to fetch team members
  $args = array(
    'post_type'      => 'teammember',
    'post_status'    => 'publish',
    'posts_per_page' => 3,
    'order'          => 'ASC',
    'paged'          => get_query_var('paged') ? get_query_var('paged') : 1,
  );

  $team_members = new WP_Query($args);

  if ($team_members->have_posts()) :
    while ($team_members->have_posts()) : $team_members->the_post();
  ?>
      <div class="team-member">
        <h2><?php the_title(); ?></h2>
        <div><?php the_content(); ?></div>
      </div>
  <?php
    endwhile;
    wp_reset_postdata(); // Reset post data
  else :
    echo '<p>No team members found.</p>';
  endif;
  ?>
</div>

<?php get_footer(); ?>