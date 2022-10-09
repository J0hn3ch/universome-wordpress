<?php 
/*
Template Name: Registration page
*/
?>
<?php get_header(); ?>
	<div class="content">
		<?php tie_breadcrumbs() ?>
		
		<?php if ( ! have_posts() ) : ?>
			<?php get_template_part( 'framework/parts/not-found' ); ?>
		<?php endif; ?>
		
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		
		<?php $get_meta = get_post_custom($post->ID);  ?>
		<?php //Above Post Banner
		if( empty( $get_meta["tie_hide_above"][0] ) ){
			if( !empty( $get_meta["tie_banner_above"][0] ) ) echo '<div class="e3lan e3lan-post">' .do_shortcode( htmlspecialchars_decode($get_meta["tie_banner_above"][0]) ) .'</div>';
			else tie_banner('banner_above' , '<div class="e3lan e3lan-post">' , '</div>' );
		}
		?>
		<article class="post-listing post">
			<?php get_template_part( 'framework/parts/post-head' ); ?>
			<div class="post-inner">
				<h1 class="post-title"><?php the_title(); ?></h1>
				<p class="post-meta"></p>
				<div class="clear"></div>
				<div class="entry">

					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __ti( 'Pages:' ), 'after' => '</div>' ) ); ?>
                    <form name="createuser" id="createuser" method="post" class="validate" novalidate="novalidate">

                        <input name="action" type="hidden" value="createuser">
                        <!-- Variable input field -->
                        <input type="hidden" id="_wpnonce_create-user" name="_wpnonce_create-user" value="141e463ad8"><input type="hidden" name="_wp_http_referer" value="/wp-admin/user-new.php">

                        <p id="signup-first_name"><input name="first_name" type="text" id="first_name" value="Nome" title="Nome" onfocus="if (this.value == 'Nome') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Nome';}" size="40"></p>
                        <p id="signup-last_name"><input name="last_name" type="text" id="last_name" value="Cognome" title="Cognome" onfocus="if (this.value == 'Cognome') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Cognome';}" size="40"></p>
                        <p id="sign-username"><input name="user_login" type="text"  id="user_login" title="Username" value="Username" onfocus="if (this.value == 'Username') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Username';}" size="60"></p>
                        <p id="signup-email"><input name="email" type="email" id="email" value="Email" title="Email" onfocus="if (this.value == 'Email') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Email';}" size="40"></p>
                        <p id="signup-pass"><input type="password" name="pwd" id="pwd" title="Password" value="Password" onfocus="if (this.value == 'Password') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Password';}" size="33"></p>

                        <p id="signup-notification">
                            <input type="checkbox" name="send_user_notification" id="send_user_notification" value="1" checked="checked">
                            <label for="send_user_notification">Invia al nuovo utente un’email a proposito del suo account.</label>
                        </p>

                        <p id="signup-role">
                            <label for="role">Ruolo</label>
                            <select name="role" id="role">
                                <option selected="selected" value="subscriber">Sottoscrittore</option>
                                <option value="contributor">Contributore</option>
                                <option value="author">Autore</option>
                                <option value="editor">Editore</option>
                                <option value="administrator">Amministratore</option>
                            </select>
                        </p>
                        <p class="submit"><input type="submit" name="createuser" id="createusersub" value="Registrati" class="login-button button button-primary"></p>
                        <!-- <label for="rememberme"><input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever"> Remember Me</label> -->
                        <input type="hidden" name="redirect_to" value="/?page_id=24">
                    </form>
					<?php edit_post_link( __ti( 'Edit' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .entry /-->	
			
			</div><!-- .post-inner -->
		</article><!-- .post-listing -->
		<?php endwhile; ?>
		
		<?php //Below Post Banner
		if( empty( $get_meta["tie_hide_below"][0] ) ){
			if( !empty( $get_meta["tie_banner_below"][0] ) ) echo '<div class="e3lan e3lan-post">' .do_shortcode( htmlspecialchars_decode($get_meta["tie_banner_below"][0]) ) .'</div>';
			else tie_banner('banner_below' , '<div class="e3lan e3lan-post">' , '</div>' );
		}
		?>
		
		<?php comments_template( '', true ); ?>
	</div><!-- .content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>