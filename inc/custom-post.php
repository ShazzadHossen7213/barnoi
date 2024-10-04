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
			'supports'               => array('title', 'thumbnail', 'editor'),
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
	// Retrieve current meta values if available
	$designation = get_post_meta($post->ID, '_team_member_designation', true);
	$social_link = get_post_meta($post->ID, '_team_member_social_link', true);
	$email = get_post_meta($post->ID, '_team_member_email', true);
	$contact = get_post_meta($post->ID, '_team_member_contact', true);
?>
	<div class="team_metafield">
		<label for="team_member_designation">Designation:</label>
		<input type="text" id="team_member_designation" name="team_member_designation" value="<?php echo esc_attr($designation); ?>" />
	</div>
	<div class="team_metafield">
		<label for="team_member_social_link">Social Link:</label>
		<input type="url" id="team_member_social_link" name="team_member_social_link" value="<?php echo esc_attr($social_link); ?>" />
	</div>
	<div class="team_metafield">
		<label for="team_member_email">Email:</label>
		<input type="email" id="team_member_email" name="team_member_email" value="<?php echo esc_attr($email); ?>" />
	</div>
	<div class="team_metafield">
		<label for="team_member_contact">Contact:</label>
		<input type="text" id="team_member_contact" name="team_member_contact" value="<?php echo esc_attr($contact); ?>" />
	</div>
<?php
}

// Save the custom meta data when the post is saved
function save_team_member_meta($post_id)
{
	// Check if the fields are set and save them
	if (isset($_POST['team_member_designation'])) {
		update_post_meta($post_id, '_team_member_designation', sanitize_text_field($_POST['team_member_designation']));
	}

	if (isset($_POST['team_member_social_link'])) {
		update_post_meta($post_id, '_team_member_social_link', esc_url_raw($_POST['team_member_social_link']));
	}

	if (isset($_POST['team_member_email'])) {
		update_post_meta($post_id, '_team_member_email', sanitize_email($_POST['team_member_email']));
	}

	if (isset($_POST['team_member_contact'])) {
		update_post_meta($post_id, '_team_member_contact', sanitize_text_field($_POST['team_member_contact']));
	}
}
add_action('save_post', 'save_team_member_meta');
