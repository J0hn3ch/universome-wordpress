<?php
require_once (dirname(__FILE__) . '/uvm-register-user.php');

function uvm_register_form_enqueue_style() {
    wp_enqueue_style( 'uvm-registration-style'); 
}

function uvm_registration_form() {
    // only show the registration form to user with role 'Direttore'
    // IMPORTANT: implent check for users Direttore

        // check if registration is enabled
        //$registration_enabled = get_option('users_can_register');

        // if enabled
        //if($registration_enabled) {
            $output = uvm_registration_fields();
            add_action( 'wp_enqueue_scripts', 'uvm_register_form_enqueue_style' );
        //} else {
            //$output = __('User registration is not enabled');
        //}
        return $output;
}
//add_shortcode('uvm_registration_form', 'uvm_registration_form');

function uvm_registration_fields() {

    ob_start(); ?>

    <?php
    // show any error messages after form submission
    uvm_register_messages(); 
    ?>

    <div id="login-form">
        <form id="uvm_registration_form" class="uvm_form" action="" method="POST">
            <fieldset>
                <p id="log-username">
                    <label for="uvm_user_Login"><?php _e('Nome utente'); ?></label>
                    <input id="log" title="<?php _eti( 'Username' ) ?>" name="uvm_user_login" id="uvm_user_login" class="uvm_user_login" type="text" placeholder="Nome utente" size="40"/>
                </p>
                <p id="log-username">
                    <label for="uvm_user_email"><?php _e('Email'); ?></label>
                    <input id="log" name="uvm_user_email" id="uvm_user_email" class="uvm_user_email" type="email" placeholder="Email"/>
                </p>
                <p>
                    <input type="hidden" name="uvm_csrf" value="<?php echo wp_create_nonce('uvm-csrf'); ?>"/>
                    <input type="submit" class="login-button" value="<?php _e('Registra'); ?>"/>
                </p>
            </fieldset>
        </form>
    </div>

    <?php
    return ob_get_clean();
}

// displays error messages from form submissions
function uvm_register_messages() {
    if($codes = uvm_errors()->get_error_codes()) {
        echo '<div class="uvm_errors">';
        // Loop error codes and display errors
        foreach($codes as $code){
            $message = uvm_errors()->get_error_message($code);
            echo '<span class="error"><strong>' . __('Errore') . '</strong>: ' . $message . '</span><br/>';
        }
        echo '</div>';
    }
}


function myplugin_user_register( $user_id ) {
    if ( ! empty( $_POST['first_name'] ) ) {
        update_user_meta( $user_id, 'first_name', sanitize_text_field( $_POST['first_name'] ) );
    }
}