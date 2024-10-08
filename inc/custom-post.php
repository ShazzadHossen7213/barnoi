<?php
// Register the custom post type for Team Members
function custom_teammember()
{
	register_post_type(
		'teammember',
		array(
			'labels' => array(
				'name'                  => 'All Team Members',
				'singular_name'         => 'Team Member',
				'add_new'               => 'Add New Team Member',
				'edit_item'             => 'Edit Team Member',
				'new_item'              => 'New Team Member',
				'view_item'             => 'View Team Member',
				'not_found'             => 'Sorry, we couldn\'t find the team member you are looking for.'
			),
			'menu_icon'              => 'dashicons-editor-indent',
			'public'                 => true,
			'publicly_queryable'     => true,
			'exclude_from_search'    => false,
			'menu_position'          => 5,
			'has_archive'            => true,
			'hierarchical'           => false,
			'show_ui'                => true,
			'capability_type'        => 'post',
			'rewrite'                => array('slug' => 'teammember'),
			'supports'               => array('title', 'thumbnail',),
		)
	);
}
add_action('init', 'custom_teammember');

// Register custom taxonomy for Team Members
function custom_teammember_taxonomy() {
    register_taxonomy(
        'designation',  // Taxonomy slug
        'teammember',  // Post type slug
        array(
            'labels' => array(
                'name'              => 'Designation',
                'singular_name'     => 'Designation',
                'search_items'      => 'Search Designation',
                'all_items'         => 'All Designation',
                'edit_item'         => 'Edit Designation',
                'update_item'       => 'Update Designation',
                'add_new_item'      => 'Add New Designation',
                'new_item_name'     => 'New Designation Name',
                'menu_name'         => 'Designation',
            ),
            'hierarchical'      => true,  // Set to true for category-like behavior
            'public'            => true,
            'show_ui'           => true,
            'show_admin_column' => true, // Display in the admin post listing page
            'rewrite'           => array('slug' => 'designation'), // URL-friendly taxonomy slug
        )
    );
}
add_action('init', 'custom_teammember_taxonomy');

// Add meta boxes for extra fields (Designation, Social Link, Email, Contact)
function add_team_member_metaboxes()
{
	add_meta_box(
		'team_member_details',          // Unique ID
		'Team Member Details',          // Box title
		'team_member_details_callback', // Content callback
		'teammember',                   // Post type
		'normal',                       // Context
		'default'                       // Priority
	);
}
add_action('add_meta_boxes', 'add_team_member_metaboxes');

// Callback function for meta box content
function team_member_details_callback($post)
{
    // Retrieve existing meta values
		$designation = get_post_meta($post->ID, '_designation', true);
    $facebook = get_post_meta($post->ID, '_facebook_link', true);
    $instagram = get_post_meta($post->ID, '_instagram_link', true);
    $twitter = get_post_meta($post->ID, '_twitter_link', true);
    $pinterest = get_post_meta($post->ID, '_pinterest_link', true);

		wp_nonce_field('save_team_member_meta_nonce', 'team_member_meta_nonce'); 
?>
	 <div class="team_metafield">
        <label for="designation">Designation:</label>
        <input type="text" id="designation" name="designation" value='<?php echo esc_html($designation); ?>' />
    </div>
	<div class="team_metafield">
		<label for="facebook_link">Facebook:</label>
		<input type="text" id="facebook_link" name="facebook_link" value='<?php echo esc_html ($facebook);?>' />
	</div>
	<div class=" team_metafield">
		<label for="instagram_link">Instagram:</label>
		<input type="text" id="instagram_link" name="instagram_link" value='<?php echo esc_html ($instagram);?>'/>
	</div>
	<div class="team_metafield">
		<label for="twitter_link">Twitter:</label>
		<input type="text" id="twitter_link" name="twitter_link" value='<?php echo esc_html ($twitter);?>' />
	</div>
	<div class="team_metafield">
		<label for="pinterest_link">Pinterest:</label>
		<input type="text" id="pinterest_link" name="pinterest_link" value='<?php echo esc_html ($pinterest);?>' />
	</div>
<?php
}

// Save the custom meta data 
function save_team_member_meta($post_id)
{
    // Check if the nonce is set and is valid
    if (!isset($_POST['team_member_meta_nonce']) || !wp_verify_nonce($_POST['team_member_meta_nonce'], 'save_team_member_meta_nonce')) {
        return;
    }

    // Check if the current user has permission to edit the post
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Check if the post is of type 'teammember'
    if (get_post_type($post_id) !== 'teammember') {
        return;
    }

    // Sanitize and save each field
		 if (isset($_POST['designation'])) {
        update_post_meta($post_id, '_designation', sanitize_text_field($_POST['designation']));
    }
    if (isset($_POST['facebook_link'])) {
        update_post_meta($post_id, '_facebook_link', sanitize_text_field($_POST['facebook_link']));
    }
    if (isset($_POST['instagram_link'])) {
        update_post_meta($post_id, '_instagram_link', sanitize_text_field($_POST['instagram_link']));
    }
    if (isset($_POST['twitter_link'])) {
        update_post_meta($post_id, '_twitter_link', sanitize_text_field($_POST['twitter_link']));
    }
    if (isset($_POST['pinterest_link'])) {
        update_post_meta($post_id, '_pinterest_link', sanitize_text_field($_POST['pinterest_link']));
    }
}
add_action('save_post', 'save_team_member_meta');
