<?php
/*-----------------------------------------------------------------------------------*/
# Login Form
/*-----------------------------------------------------------------------------------*/
function tie_login_form( $login_only  = 0 ) {
	global $user_ID, $user_identity, $user_level;
	$redirect = site_url();

	if ( $user_ID ) : ?>
		<?php if( empty( $login_only ) ): ?>
		<div id="user-login">
			<span class="author-avatar"><?php echo get_avatar( $user_ID, $size = '90'); ?></span>
			<p class="welcome-text"><?php _eti( 'Welcome' ) ?> <strong><?php echo $user_identity ?></strong> .</p>
			<ul>
				<li><a href="<?php echo admin_url() ?>"><?php _eti( 'Dashboard' ) ?> </a></li>
				<li><a href="<?php echo admin_url() ?>profile.php"><?php _eti( 'Your Profile' ) ?> </a></li>
				<li><a href="<?php echo wp_logout_url($redirect); ?>"><?php _eti( 'Logout' ) ?> </a></li>
			</ul>
			<div class="clear"></div>
		</div>
		<?php endif; ?>
	<?php else: ?>
		<div id="login-form">
			<form name="loginform" id="loginform" action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post' ) ) ?>" method="post">
				<p id="log-username"><input type="text" name="log" id="log" title="<?php _eti( 'Username' ) ?>" value="<?php _eti( 'Username' ) ?>" onfocus="if (this.value == '<?php _eti( 'Username' ) ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _eti( 'Username' ) ?>';}"  size="33" /></p>
				<p id="log-pass"><input type="password" name="pwd" id="pwd" title="<?php _eti( 'Password' ) ?>" value="<?php _eti( 'Password' ) ?>" onfocus="if (this.value == '<?php _eti( 'Password' ) ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _eti( 'Password' ) ?>';}" size="33" /></p>
				<input type="submit" name="submit" value="<?php _eti( 'Log in' ) ?>" class="login-button" />
				<label for="rememberme"><input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever" /> <?php _eti( 'Remember Me' ) ?></label>
				<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>"/>
			</form>
			<ul class="login-links">
				<?php echo wp_register() ?>
				<li><a href="<?php echo wp_lostpassword_url($redirect) ?>"><?php _eti( 'Lost your password?' ) ?></a></li>
			</ul>
		</div>
	<?php endif;
}
?>