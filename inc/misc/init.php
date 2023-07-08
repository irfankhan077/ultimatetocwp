<?php
/**
 * Registration logic for the new ACF field type.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'init', 'pt_include_acf_field_posttype' );
/**
 * Registers the ACF field type.
 */
function pt_include_acf_field_posttype() {
	if ( ! function_exists( 'acf_register_field_type' ) ) {
		return;
	}

	require_once NSM_DIR . '/inc/misc/class-pt-acf-field-posttype.php';

	acf_register_field_type( 'pt_acf_field_posttype' );
}