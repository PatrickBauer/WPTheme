<?php


/**
 * BASIC SETUP
 */
function base_setup() {
    load_theme_textdomain('base', get_template_directory() . '/languages');

    add_theme_support('post-thumbnails');

    register_nav_menus(array(
        'primary' => __('Primary Menu', 'base'),
    ));
}

add_action('after_setup_theme', 'base_setup');


/**
 * ADD CSS AND JS
 */
function base_scripts() {
    //wp_enqueue_style( 'font-russo', '//fonts.googleapis.com/css?family=Droid+Sans' );
    wp_enqueue_style('base-style', get_stylesheet_uri());
    wp_enqueue_script('javascript-combined', get_stylesheet_directory_uri() . '/script.js', array(), FALSE, TRUE);
}

add_action('wp_enqueue_scripts', 'base_scripts');


/**
 * BETTER WP TITLE
 */
function theme_name_wp_title($title, $sep) {
    if (is_feed()) {
        return $title;
    }

    global $page, $paged;

    // Add the blog name
    $title .= get_bloginfo('name', 'display');

    // Add the blog description for the home/front page.
    $site_description = get_bloginfo('description', 'display');
    if ($site_description && (is_home() || is_front_page())) {
        $title .= " $sep $site_description";
    }

    // Add a page number if necessary:
    if (($paged >= 2 || $page >= 2) && !is_404()) {
        $title .= " $sep " . sprintf(__('Page %s', '_s'), max($paged, $page));
    }

    return $title;
}

add_filter('wp_title', 'theme_name_wp_title', 10, 2);

/**
 * REMOVE CLUTTER IN HEAD
 */
function remove_clutter() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'rsd_link'); // remove really simple discovery link
    remove_action('wp_head', 'wp_generator'); // remove wordpress version
    remove_action('wp_head', 'feed_links', 2); // remove rss feed links (make sure you add them in yourself if youre using feedblitz or an rss service)
    remove_action('wp_head', 'feed_links_extra', 3); // removes all extra rss feed links
    remove_action('wp_head', 'index_rel_link'); // remove link to index page
    remove_action('wp_head', 'wlwmanifest_link'); // remove wlwmanifest.xml (needed to support windows live writer)
    remove_action('wp_head', 'start_post_rel_link', 10, 0); // remove random post link
    remove_action('wp_head', 'parent_post_rel_link', 10, 0); // remove parent post link
    remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // remove the next and previous post links
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0); // remove shortlink
    remove_action('wp_head', 'rel_canonical', 10, 0); // remove canonical link
    add_filter('emoji_svg_url', '__return_false');
    add_filter('rest_enabled', '_return_false');
    add_filter('rest_jsonp_enabled', '_return_false');
    remove_action('template_redirect', 'rest_output_link_header', 11, 0);
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'rest_output_link_wp_head', 10);
    remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
    remove_action('rest_api_init', 'wp_oembed_register_route');
    remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
    remove_action('wp_head', 'wp_oembed_add_host_js');
}

add_action('init', 'remove_clutter', 9999);

/**
 * DISABLE SEARCH
 */
function disable_search($query, $error = TRUE) {
    if (is_search()) {
        $query->is_search     = FALSE;
        $query->query_vars[s] = FALSE;
        $query->query[s]      = FALSE;

        if ($error == TRUE) {
            $query->is_404 = TRUE;
        }
    }
}

add_action('parse_query', 'disable_search');
add_filter('get_search_form', create_function('$a', "return null;"));

/**
 * DISABLE ARCHIVES
 */
function disable_archives() {
    //If we are on category or tag or date or author archive
    if (is_category() || is_tag() || is_date() || is_author()) {
        global $wp_query;
        $wp_query->set_404(); //set to 404 not found page
    }
}

add_action('template_redirect', 'disable_archives');
