<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package barnoi
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'barnoi' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-branding">
			<?php
			the_custom_logo();
			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			$barnoi_description = get_bloginfo( 'description', 'display' );
			if ( $barnoi_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $barnoi_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endif; ?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'barnoi' ); ?></button>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				)
			);
			?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
	
	<nav class="navbar navbar-expand-custom navbar-mainbg">
	<a class="navbar-brand navbar-logo" href="#">Victory Token</a>
	<button class="navbar-toggler" type="button" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<i class="fas fa-bars text-white"></i>
	</button>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav ml-auto">
			<div class="hori-selector">
				<div class="left"></div>
				<div class="right"></div>
			</div>
			<li class="nav-item">
				<a class="nav-link" href="javascript:void(0);"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
			</li>
			<li class="nav-item active">
				<a class="nav-link" href="javascript:void(0);"><i class="fas fa-house-user"></i>Home</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="javascript:void(0);"><i class="far fa-clone"></i>Components</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="javascript:void(0);"><i class="far fa-calendar-alt"></i>Calendar</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="javascript:void(0);"><i class="far fa-chart-bar"></i>Charts</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="javascript:void(0);"><i class="far fa-copy"></i>Documents</a>
			</li>
		</ul>
	</div>
</nav>
