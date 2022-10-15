<?php
/*
Plugin Name: UVM Registration form
Plugin URI: https://github.com/J0hn3ch
Description: Registration form to put in a page for the web site universome.eu
Author: Gianluca Carbone
Version: 0.0.1
Author URI: https://github.com/J0hn3ch
*/

require_once (dirname(__FILE__) . '/includes/uvm-register-form.php');

/* =====[ ACTIVATION ]===== */
register_activation_hook( __FILE__, 'uvm_registration_form_activate' );
function uvm_registration_form_activate() {

    add_option('Activated_Plugin', 'UVM-Registration-Form' );

    /* activation code here */
    //do_action('uvm_registration_load');

    // Clear the permalinks after the post type has been registered.
    //flush_rewrite_rules();
}

function uvm_registration_load(){
    echo get_option( 'Activated_Plugin' );
    if ( is_admin() && get_option( 'Activated_Plugin' ) == 'UVM-Registration-Form' ) {
        //delete_option( 'Activated_Plugin' );
        echo "UVM Registration Load";
        add_shortcode('uvm_registration_form', 'uvm_registration_form');
    }
}
add_action( 'init', 'uvm_registration_load' );

/* =====[ DEACTIVATION ]===== */
// Call deactivate_PLUGINAME action
function uvm_registration_form_deactivate() {

    /* deactivation code here */
    uvm_registration_deactivation();

    // Clear the permalinks to remove our post type's rules from the database.
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'uvm_registration_form_deactivate' );

function uvm_registration_deactivation(){
    remove_shortcode( 'uvm_registration_form' );
}