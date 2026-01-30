<?php
/**
 * Register/enqueue custom scripts and styles
 */
add_action('wp_enqueue_scripts', function () {
    // Enqueue your files on the canvas & frontend, not the builder panel. Otherwise, custom CSS might affect the builder
    if (! bricks_is_builder_main()) {
        // Enqueue CSS
        // Dependency 'bricks-frontend'
        // It tells WordPress: "Do not load my child CSS until the main Bricks frontend CSS has loaded."
        // This ensures your custom styles actually override the default Bricks styles because they appear later in the HTML.
        wp_enqueue_style('bricks-child-css', get_theme_file_uri('/style.css'), ['bricks-frontend']);

        // Enqueue JS
        // Dependency true so it loads after all other scripts in the footer
        wp_enqueue_script('bricks-child-js', get_theme_file_uri( '/scripts.js'), true);
    }
});

/**
 * Register custom elements
 */
add_action('init', function () {
    $element_files = [
        __DIR__.'/elements/title.php',
    ];

    foreach ($element_files as $file) {
        \Bricks\Elements::register_element($file);
    }
}, 11);

/**
 * Add text strings to builder
 */
add_filter('bricks/builder/i18n', function ($i18n) {
    // For element category 'custom'
    $i18n['custom'] = esc_html__('Custom', 'bricks');

    return $i18n;
});

/*------ Custom Code Snippets ------*/

/**
 * ACF Business Type field - change separator to new line
 * ref: https://forum.bricksbuilder.io/t/no-bug-dynamic-data-in-bricks-form-checkbox-field/31489
 * ACF returns values as list and bricks form dynamic data requires a new line separator to display multiple values correctly.
 */
add_filter('bricks/dynamic_data/text_separator', function ($sep, $tag, $post_id, $filters) {
    if ($tag === 'acf_business_type') {
        return PHP_EOL;
    }

    return $sep;
}, 10, 4);

/**
 * Allow custom functions in Bricks code element using echo
 * Allow all functions that start with "brx_"
 * ref: https://academy.bricksbuilder.io/article/filter-bricks-code-echo_function_names/
 */
add_filter('bricks/code/echo_function_names', static fn() => ['@^brx_']);

/**
 * Retrieves and formats a list of business types from an options field.
 *
 * This function fetches the 'business_type' field from the options and processes it into
 * a single string with line items separated by newline characters. If the field is not
 * an array or is empty, an empty string is returned.
 *
 * @return string A newline-separated string of business type line items, or an empty string if no data is available.
 */
function brx_business_types()
{
    $business_types = get_field('business_type', 'option');

    if (! is_array($business_types) || empty($business_types)) {
        return '';
    }

    return implode(PHP_EOL, array_map(static fn($row) => $row['line_item'], $business_types));
}

/**
 * Extend allowed HTML tags in the "Custom Tag" field
 *
 * Define the additional tags to be added (e.g. 'form' & 'select')
 */
add_filter('bricks/allowed_html_tags', function ($allowed_html_tags) {
    // Allow "dynamic ACF field" as a custom tag
    $additional_tags = ['{acf_heading_tag}'];

    // Merge additional tags with the existing allowed tags
    return array_merge($allowed_html_tags, $additional_tags);
});
