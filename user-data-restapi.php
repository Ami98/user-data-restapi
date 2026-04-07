<?php
/*
Plugin Name: User Data Restapi
Description: Fetch users using REST API and display
Version: 1.0
*/

if (!defined('ABSPATH')) exit;

function udv_rest_scripts()
{
    wp_enqueue_script('udv-rest', plugin_dir_url(__FILE__) . 'assets/js/rest.js', [], null, true);

    wp_localize_script('udv-rest', 'udvRest', [
        'rest_url' => site_url('/wp-json/udv/v1/users')
    ]);
}
add_action('wp_enqueue_scripts', 'udv_rest_scripts');


function udv_rest_shortcode()
{
    ob_start();
?>
    <div id="rest-users">Loading...</div>
<?php
    return ob_get_clean();
}
add_shortcode('api_rest', 'udv_rest_shortcode');


add_action('rest_api_init', function () {
    register_rest_route('udv/v1', '/users', [
        'methods'  => 'GET',
        'callback' => 'udv_rest_users',
        'permission_callback' => '__return_true'
    ]);
});

function udv_rest_users()
{
    $response = wp_remote_get('https://jsonplaceholder.typicode.com/users');
    $body = wp_remote_retrieve_body($response);


    return json_decode($body);
}
