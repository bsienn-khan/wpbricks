<?php
/**
 * Register/enqueue custom scripts and styles
 */
add_action( 'wp_enqueue_scripts', function () {
    // Enqueue your files on the canvas & frontend, not the builder panel. Otherwise custom CSS might affect builder)
    if ( ! bricks_is_builder_main() ) {
        wp_enqueue_style( 'bricks-child', get_stylesheet_uri(), [ 'bricks-frontend' ],
            filemtime( get_stylesheet_directory() . '/style.css' ) );
    }
} );

/**
 * Register custom elements
 */
add_action( 'init', function () {
    $element_files = [
        __DIR__ . '/elements/title.php',
    ];

    foreach ( $element_files as $file ) {
        \Bricks\Elements::register_element( $file );
    }
}, 11 );

/**
 * Add text strings to builder
 */
add_filter( 'bricks/builder/i18n', function ( $i18n ) {
    // For element category 'custom'
    $i18n['custom'] = esc_html__( 'Custom', 'bricks' );

    return $i18n;
} );

/**
 * ACF Business Type field - change separator to new line
 * ref: https://forum.bricksbuilder.io/t/no-bug-dynamic-data-in-bricks-form-checkbox-field/31489
 * ACF returns values as list and bricks form dynamic data requires a new line separator to display multiple values correctly.
 */
add_filter(
    'bricks/dynamic_data/text_separator', function ( $sep, $tag, $post_id, $filters ) {
    if ( $tag === 'acf_business_type' ) {
        return PHP_EOL;
    }

    return $sep;
},
    10,
    4
);

/**
 * Allow custom functions in Bricks code element using echo
 * Allow all functions that start with "brx_"
 * ref: https://academy.bricksbuilder.io/article/filter-bricks-code-echo_function_names/
 */
add_filter( 'bricks/code/echo_function_names', static fn() => [ '@^brx_' ] );

function brx_business_types() {
    $business_types = get_field( 'business_type', 'option' );

    if ( ! is_array( $business_types ) || empty( $business_types ) ) {
        return '';
    }

    return implode( PHP_EOL, array_map( static fn( $row ) => $row['line_item'], $business_types ) );
}
