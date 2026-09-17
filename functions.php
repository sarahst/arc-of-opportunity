<?php

/* Function to enqueue stylesheet from parent theme */

function child_enqueue__parent_scripts() {

    wp_enqueue_style( 'parent', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style(
        'arc-of-opportunity',
        get_stylesheet_uri(),
        array( 'parent', 'test-data-style' ),
        wp_get_theme()->get( 'Version' )
    );

}
add_action( 'wp_enqueue_scripts', 'child_enqueue__parent_scripts', 100 );

add_filter( 'body_class', function( $classes ) {
	if ( is_singular( array( 'post', 'event_listing' ) ) ) {
		$classes = array_values( array_diff( $classes, array( 'has-sidebar' ) ) );
	}
	return $classes;
}, 20 );

/**
 * Hide the Register for event button unless a registration email or URL is set.
 */
function acr_event_has_registration_contact( $post = null ) {
	$post = get_post( $post );

	if ( ! $post || 'event_listing' !== $post->post_type ) {
		return false;
	}

	$registration = get_post_meta( $post->ID, '_registration', true );

	return '' !== trim( (string) $registration );
}

add_filter( 'wpem_get_event_registration_method', function( $method, $post ) {
	if ( ! acr_event_has_registration_contact( $post ) ) {
		return false;
	}

	return $method;
}, 10, 2 );

add_filter( 'wpem_display_event_registration_method', function( $method, $post ) {
	if ( ! acr_event_has_registration_contact( $post ) ) {
		return false;
	}

	return $method;
}, 10, 2 );

add_filter( 'event_manager_registration_addon_form', function( $show ) {
	if ( is_singular( 'event_listing' ) && ! acr_event_has_registration_contact() ) {
		return false;
	}

	return $show;
} );

add_filter( 'acf/load_field/key=field_ATaJj057m', function( $field ) {
	$field['choices']['default'] = 'Default';
	return $field;
}, 20 );

/**
 * Always treat Hide Footer as "no" so the footer cannot be hidden
 * and the per-page Footer Style field stays available.
 */
function acr_force_hide_footer_no( $value ) {
	return 'no';
}
add_filter( 'acf/load_value/name=hide_footer', 'acr_force_hide_footer_no' );
add_filter( 'acf/update_value/name=hide_footer', 'acr_force_hide_footer_no' );

add_filter( 'acf/load_field/name=hide_footer', function( $field ) {
	$field['default_value'] = 'no';
	return $field;
} );

/**
 * When Hide Footer is "no", the theme only renders a per-page Footer Style.
 * If that field is empty, fall back to the Customizer footer so existing
 * pages that used "inherit" still show a footer.
 */
add_filter( 'acf/load_value/name=footer_style', function( $value ) {
	if ( ! empty( $value ) || is_admin() ) {
		return $value;
	}

	$customizer_footer = get_theme_mod( 'footer_layout_custom_select_style' );

	if ( $customizer_footer && strpos( $customizer_footer, 'tpl-' ) === 0 ) {
		return $customizer_footer;
	}

	return $value;
} );