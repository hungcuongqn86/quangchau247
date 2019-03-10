<?php
/*
 * Fawzi Theme's Functions
 * Author & Copyright: VictorThemes
 * URL: http://themeforest.net/user/VictorThemes
 */

/**
 * Define - Folder Paths
 */
define( 'FAWZI_THEMEROOT_PATH', get_template_directory() );
define( 'FAWZI_THEMEROOT_URI', get_template_directory_uri() );
define( 'FAWZI_CSS', FAWZI_THEMEROOT_URI . '/assets/css' );
define( 'FAWZI_IMAGES', FAWZI_THEMEROOT_URI . '/assets/images' );
define( 'FAWZI_SCRIPTS', FAWZI_THEMEROOT_URI . '/assets/js' );
define( 'FAWZI_FRAMEWORK', get_template_directory() . '/inc' );
define( 'FAWZI_LAYOUT', get_template_directory() . '/layouts' );
define( 'FAWZI_CS_IMAGES', FAWZI_THEMEROOT_URI . '/inc/theme-options/theme-extend/images' );
define( 'FAWZI_CS_FRAMEWORK', get_template_directory() . '/inc/theme-options/theme-extend' ); // Called in Icons field *.json
define( 'FAWZI_ADMIN_PATH', get_template_directory() . '/inc/theme-options/cs-framework' ); // Called in Icons field *.json

/**
 * Define - Global Theme Info's
 */
if (is_child_theme()) { // If Child Theme Active
	$fawzi_theme_child = wp_get_theme();
	$fawzi_get_parent = $fawzi_theme_child->Template;
	$fawzi_theme = wp_get_theme($fawzi_get_parent);
} else { // Parent Theme Active
	$fawzi_theme = wp_get_theme();
}
define('FAWZI_NAME', $fawzi_theme->get( 'Name' ), true);
define('FAWZI_VERSION', $fawzi_theme->get( 'Version' ), true);
define('FAWZI_BRAND_URL', $fawzi_theme->get( 'AuthorURI' ), true);
define('FAWZI_BRAND_NAME', $fawzi_theme->get( 'Author' ), true);

/**
 * All Main Files Include
 */
require_once( FAWZI_FRAMEWORK . '/init.php' );