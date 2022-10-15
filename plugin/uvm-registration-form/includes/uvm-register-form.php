<?php
include "./uvm-register-user.php";

function uvm_registration_form() {
    // only show the registration form to user with role 'Direttore'
    // IMPORTANT: implent check for users Direttore

        // check if registration is enabled
        //$registration_enabled = get_option('users_can_register');

        // if enabled
        //if($registration_enabled) {
            $output = uvm_registration_fields();
        //} else {
            //$output = __('User registration is not enabled');
        //}
        return $output;
}
//add_shortcode('uvm_registration_form', 'uvm_registration_form');

function uvm_registration_fields() {

    ob_start(); ?>
    <h3 class="uvm_header"><?php _e('Registrazione redattori'); ?></h3>

    <?php
    // show any error messages after form submission
    uvm_register_messages(); ?>

    <form id="uvm_registration_form" class="uvm_form" action="" method="POST">
        <fieldset>
            <p>
                <label for="uvm_user_Login"><?php _e('Nome utente'); ?></label>
                <input name="uvm_user_login" id="uvm_user_login" class="uvm_user_login" type="text" size="25"/>
            </p>
            <p>
                <label for="uvm_user_email"><?php _e('Email'); ?></label>
                <input name="uvm_user_email" id="uvm_user_email" class="uvm_user_email" type="email"/>
            </p>
            <p>
                <input type="hidden" name="uvm_csrf" value="<?php echo wp_create_nonce('uvm-csrf'); ?>"/>
                <input type="submit" value="<?php _e('Registra'); ?>"/>
            </p>
        </fieldset>
    </form>
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