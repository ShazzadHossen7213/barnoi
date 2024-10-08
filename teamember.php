<?php

/**
 * Template Name: Team Members
 */

get_header(); ?>

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
                      );

                      $team_members = new WP_Query($args);

                      if ($team_members->have_posts()) :
                        while ($team_members->have_posts()) : $team_members->the_post();
                              // meta values
                              $designation = get_post_meta($post->ID, '_designation', true);
                              $facebook = get_post_meta(get_the_ID(), '_facebook_link', true);
                              $instagram = get_post_meta(get_the_ID(), '_instagram_link', true);
                              $twitter = get_post_meta(get_the_ID(), '_twitter_link', true);
                              $pinterest = get_post_meta(get_the_ID(), '_pinterest_link', true);
                      ?>
                    <div class="col-xl-3 col-md-6 col-12 mb-40">
                        <div class="team">
                            <div class="team__img mb-10">
                                <a href="#"><?php echo the_post_thumbnail('teammember') ?></a>
                                <div class="team__content--overlay">
                                    <p><?php echo esc_html($designation); ?></p>
                                    <h4><?php the_title(); ?></h4>
                                </div>
                                <div class="overlay">
                                    <div class="icons">
                                        <ul>
                                            <li class="mb-15">
                                            <?php if (!empty($facebook)) : ?>
                                                <a href="<?php echo esc_url($facebook); ?>"><i class="fa-brands fa-facebook"></i></a>
                                            <?php endif; ?>
                                            </li>
                                            <li class="mb-15">
                                                 <?php if (!empty($instagram)) : ?>
                                                <a href="<?php echo esc_url($instagram); ?>"><i class="fa-brands fa-instagram"></i></a>
                                                <?php endif; ?>
                                            </li>
                                            <li class="mb-15">
                                                <?php if (!empty($twitter)) : ?>
                                                <a href="<?php echo esc_url($twitter); ?>"><i class="fa-brands fa-twitter"></i></a>
                                                <?php endif; ?>
                                            </li>
                                            <li class="mb-15">
                                                <?php if (!empty($pinterest)) : ?>
                                                <a href="<?php echo esc_url($pinterest); ?>"><i class="fa-brands fa-pinterest"></i></a>
                                                <?php endif; ?>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                     <?php
                      endwhile;
                      wp_reset_postdata(); // Reset post data
                    else :
                      echo '<p> Team Members Not Found.</p>';
                    endif;
                    ?>
                </div>
            </div>
        </section>
<!-- Team Area End Here -->


<!-- Team Area Start Here -->
<section class="team__area">
    <h1>Designation Wise Team Member Show </h1>
    <div class="container-fluid">
        <div class="row">
            <?php
            // Get all terms from the "designation" taxonomy
            $designations = get_terms(array(
                'taxonomy' => 'designation',
                'hide_empty' => true, // Show only terms with posts
            ));

            if (!empty($designations)) :
                foreach ($designations as $designation) : ?>
                    <div class="col-12">
                        <h2 class="designation-title"><?php echo esc_html($designation->name); ?></h2>
                    </div>

                    <?php
                    // Query for team members within the current designation
                    $args = array(
                        'post_type' => 'teammember',
                        'post_status' => 'publish',
                        'posts_per_page' => -1,
                        'orderby' => 'title',
                        'order' => 'ASC',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'designation',
                                'field' => 'term_id',
                                'terms' => $designation->term_id,
                            ),
                        ),
                    );
                    $team_members = new WP_Query($args);

                    if ($team_members->have_posts()) :
                        while ($team_members->have_posts()) : $team_members->the_post();

                            // Get meta values
                            $facebook = get_post_meta(get_the_ID(), '_facebook_link', true);
                            $instagram = get_post_meta(get_the_ID(), '_instagram_link', true);
                            $twitter = get_post_meta(get_the_ID(), '_twitter_link', true);
                            $pinterest = get_post_meta(get_the_ID(), '_pinterest_link', true);
                    ?>
                        <div class="col-xl-3 col-md-6 col-12 mb-40">
                            <div class="team">
                                <div class="team__img mb-10">
                                    <a href="#"><?php the_post_thumbnail('teammember'); ?></a>
                                    <div class="team__content--overlay">
                                        <p><?php echo esc_html($designation->name); ?></p>
                                        <h4><?php the_title(); ?></h4>
                                    </div>
                                    <div class="overlay">
                                        <div class="icons">
                                            <ul>
                                                <li class="mb-15">
                                                    <?php if (!empty($facebook)) : ?>
                                                        <a href="<?php echo esc_url($facebook); ?>"><i class="fa-brands fa-facebook"></i></a>
                                                    <?php endif; ?>
                                                </li>
                                                <li class="mb-15">
                                                    <?php if (!empty($instagram)) : ?>
                                                        <a href="<?php echo esc_url($instagram); ?>"><i class="fa-brands fa-instagram"></i></a>
                                                    <?php endif; ?>
                                                </li>
                                                <li class="mb-15">
                                                    <?php if (!empty($twitter)) : ?>
                                                        <a href="<?php echo esc_url($twitter); ?>"><i class="fa-brands fa-twitter"></i></a>
                                                    <?php endif; ?>
                                                </li>
                                                <li class="mb-15">
                                                    <?php if (!empty($pinterest)) : ?>
                                                        <a href="<?php echo esc_url($pinterest); ?>"><i class="fa-brands fa-pinterest"></i></a>
                                                    <?php endif; ?>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                        echo '<p>No team members found under this designation.</p>';
                    endif;
                endforeach;
            else :
                echo '<p>No designations found.</p>';
            endif;
            ?>
        </div>
    </div>
</section>
<!-- Team Area End Here -->

<?php get_footer(); ?>




        



