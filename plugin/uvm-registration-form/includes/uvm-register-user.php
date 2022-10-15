<?php

// register a new user
function uvm_add_new_user() {
    if (isset( $_POST["uvm_user_login"] ) && wp_verify_nonce($_POST['uvm_csrf'], 'uvm-csrf')) {
        $user_name		= $_POST["uvm_user_login"];
        $user_email		= $_POST["uvm_user_email"];

        // this is required for username checks
        require_once(ABSPATH . WPINC . '/registration.php');

        if(username_exists($user_name)) {
            // Username already registered
            uvm_errors()->add('username_unavailable', __('Nome utente è già utilizzato'));
        }
        if(!validate_username($user_name)) {
            // invalid username
            uvm_errors()->add('username_invalid', __('Nome utente non valido'));
        }
        if($user_name == '') {
            // empty username
            uvm_errors()->add('username_empty', __('Inserisci il nome utente'));
        }
        if(!is_email($user_email)) {
            //invalid email
            uvm_errors()->add('email_invalid', __('Email non valida'));
        }
        if(email_exists($user_email)) {
            //Email address already registered
            uvm_errors()->add('email_used', __('Email già in uso'));
        }

        $errors = uvm_errors()->get_error_messages();

        // if no errors then cretate user
        if(empty($errors)) {

            // create a random password
            $random_password = wp_generate_password( 12, false );

            $user_id = wp_create_user(
                $user_name,
                $random_password,
                $user_email
            );

            if($user_id) {
                // send an email to the admin
                wp_new_user_notification($user_id);

                // log the new user in
                //wp_setcookie($user_name, $user_pass, true);
                //wp_set_current_user($new_user_id, $user_login);
                //do_action('wp_login', $user_login);

                // success
                //if ( ! is_wp_error( $user_id ) ) {
                //    echo 'User created: ' . $user_id;
                //}

                // send the newly created user to the home page after logging them in
                wp_redirect(home_url()); exit;
            }

        }

    }
}
add_action('init', 'uvm_add_new_user');

// used for tracking error messages
function uvm_errors(){
    static $wp_error; // global variable handle
    return isset($wp_error) ? $wp_error : ($wp_error = new WP_Error(null, null, null));
}