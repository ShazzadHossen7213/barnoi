<?php
// Register the custom post type for Team Members
function custom_teammember()
{
	register_post_type(
		'teammember',
		array(
			'labels' => array(
				'name'                  => 'Team Members',
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
			'supports'               => array('title', 'thumbnail', 'excerpt'),
		)
	);
}
add_action('init', 'custom_teammember');

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
	// meta values
	$facebook = get_post_meta($post->ID, '_facebook_link', true);
	$instagram = get_post_meta($post->ID, '_instagram_link', true);
	$twitter = get_post_meta($post->ID, '_twitter_link', true);
	$pinterest = get_post_meta($post->ID, '_pinterest_link', true);
?>
	<div class="team_metafield">
		<label for="facebook_link">Facebook:</label>
		<input type="text" id="facebook_link" name="facebook_link" />
	</div>
	<div class=" team_metafield">
		<label for="instagram_link">Instagram:</label>
		<input type="text" id="instagram_link" name="instagram_link" />
	</div>
	<div class="team_metafield">
		<label for="twitter_link">Twitter:</label>
		<input type="text" id="twitter_link" name="twitter_link" />
	</div>
	<div class="team_metafield">
		<label for="pinterest_link">Pinterest:</label>
		<input type="text" id="pinterest_link" name="pinterest_link" />
	</div>
<?php
}

// Save the custom meta data when the post is saved
function save_team_member_meta($post_id)
{
	// Check if the fields are set and save them
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
