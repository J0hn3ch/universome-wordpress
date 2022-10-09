<?php
/*
	Plugin Name: Taqyeem Predefined Criteria
	Plugin URI: http://codecanyon.net/item/taqyeem-wordpress-review-plugin/4558799?ref=tielabs
	Description: Easily Create Criteria Sets, Assign Them To Your Reviews and Save Your Time !
	Author: TieLabs
	Version: 1.0.3
	Author URI: http://tielabs.com/
*/

/*-----------------------------------------------------------------------------------*/
# Load Text Domain
/*-----------------------------------------------------------------------------------*/
add_action('plugins_loaded', 'taqyeem_predef_init');
function taqyeem_predef_init() {
	load_plugin_textdomain( 'taqyeem-predefined' , false, dirname( plugin_basename( __FILE__ ) ).'/languages' );
}

/*-----------------------------------------------------------------------------------*/
# Check if Taqyeem is installed and check it's Version
/*-----------------------------------------------------------------------------------*/
function taq_admin_notice() {
    ?>
	<?php
	if( !function_exists ( 'taqyeem_init' ) ){ ?>
	<div class="error">
        <p><strong><?php esc_html_e( '&quot;Taqyeem Predefined Criteria&quot; plugin is an extension for and requires  <a href="http://codecanyon.net/item/taqyeem-wordpress-review-plugin/4558799?ref=tielabs">Taqyeem Plugin</a>', 'taqyeem-predefined' ); ?><strong></p>
	</div>
	<?php }
	if( function_exists ( 'taqyeem_init' ) && ( !defined( 'TIE_Plugin_ver' ) || version_compare( '2.0.0' , TIE_Plugin_ver , '>') ) ){ ?>
	<div class="error">
        <p><strong><?php esc_html_e( '&quot;Taqyeem Predefined Criteria&quot; plugin requires <a href="http://codecanyon.net/item/taqyeem-wordpress-review-plugin/4558799?ref=tielabs">Taqyeem Plugin</a> Version 2.0 or above.', 'taqyeem-predefined' ); ?><strong></p>
	</div>
	<?php }
}
add_action( 'admin_notices', 'taq_admin_notice' );


/*-----------------------------------------------------------------------------------*/
# Register main Scripts and Styles
/*-----------------------------------------------------------------------------------*/
function taq_predef_admin_register() {
	wp_register_style( 'taqyeem-admin-pre-defined-style', plugins_url('admin/style.css' , __FILE__), array(), '20120208', 'all' );
	wp_register_script( 'taqyeem-admin-pre-defined-js',  plugins_url('admin/tie-pre-defined.js' , __FILE__), array( 'jquery' ) , false , false );

	wp_enqueue_script( 'taqyeem-admin-pre-defined-js' );
	wp_enqueue_style( 'taqyeem-admin-pre-defined-style' );
	?>
	<script type='text/javascript'>
	/* <![CDATA[ */
		var taqyeem_predefined_lang = {"add_new_group_item":"<?php esc_html_e( 'Add Another Review Criteria' , 'taqyeem-predefined' ) ?>" , "enter_group_name":"<?php esc_html_e( 'Enter The Set Name' , 'taqyeem-predefined' ) ?>"};
		/* ]]> */
	</script>
	<?php
}
add_action( 'admin_enqueue_scripts', 'taq_predef_admin_register' );


/*-----------------------------------------------------------------------------------*/
# Insert Criteria Set in post review
/*-----------------------------------------------------------------------------------*/
add_action( 'tie_taqyeem_before_review_criteria' , 'taqyeem_predefined_group_list' , 1  );
function taqyeem_predefined_group_list(){
	$groups_data = get_option( 'taqyeem_options' ) ;

	if( !empty( $groups_data[ 'group' ] ) )
		$groups_data = $groups_data[ 'group' ];

	if( !empty( $groups_data ) && is_array( $groups_data ) ){
?>
<div class="select-pre-defined-criteria">
<select id="select-pre-defined-criteria">
	<option value="#NONE#"><?php  esc_html_e( 'Select Predefined Criteria Set' , 'taqyeem-predefined' ) ?></option>
	<?php
		foreach( $groups_data as $group){
			$list_content = '';
			if( !empty( $group[ 'criteria' ] ) && is_array( $group[ 'criteria' ] ) ){
				foreach( $group[ 'criteria' ] as $criteria_name){
					$list_content .= $criteria_name.'|';
				}
				$list_content = rtrim( $list_content , "|");
	?>
	<option value="<?php echo esc_attr( $list_content ) ?>"><?php echo esc_html( $group[ 'title' ] ) ?></option>
	<?php
			}
		}
	?>
</select>
</div>
<?php
	}
}


/*-----------------------------------------------------------------------------------*/
# Add Pre-defined Criteria tab to Taqyeem dashboard
/*-----------------------------------------------------------------------------------*/
add_action( 'tie_taqyeem_panel_tabs' , 'tie_pre_defined_criteria_panel_tab' , 1  );
function tie_pre_defined_criteria_panel_tab(){ ?>
	<li class="tie-tabs pre-defined_criteria"><a href="#tab15"><span class="taq-icon-menu dashicons-before dashicons-feedback taq-icon-menu"></span><?php esc_html_e('Predefined Criteria','taqyeem-predefined'); ?></a></li>
<?php
}
add_action( 'tie_taqyeem_panel_tabs_content' , 'tie_pre_defined_criteria_panel_tab_content' , 1  );


/*-----------------------------------------------------------------------------------*/
# Pre-defined Criteria tab Content
/*-----------------------------------------------------------------------------------*/
function tie_pre_defined_criteria_panel_tab_content(){ ?>
<div id="tab15" class="tab_content taq-tabs-wrap">
	<h2><?php esc_html_e('Predefined Criteria','taqyeem-predefined'); ?></h2> <?php taq_save_button(); ?>
	<div class="clear"></div>
	<input id="add_review_criteria_group" type="button" class="button" value="<?php esc_html_e('Add New Review Criteria Set','taqyeem-predefined'); ?>">
	<div id="taqyeem-reviews-criteria-group">
		<?php
			$i = 0;
			$groups_data = get_option( 'taqyeem_options' );

			if( ! empty( $groups_data[ 'group' ] ) && is_array( $groups_data[ 'group' ] ) ){

				foreach( $groups_data[ 'group' ] as $group ){
					$i++;
					?>

						<div data-gropid="<?php echo esc_attr( $i ) ?>" class="taqyeem-item">
							<h3><?php echo esc_html( $group[ 'title' ] ) ?></h3>
							<input type="hidden" name="taqyeem_options[group][<?php echo esc_html( $i ) ?>][title]" value="<?php echo esc_attr( $group[ 'title' ] ) ?>" />
							<a class="del-review del-group" title="<?php  esc_html_e( 'Delete' , 'taqyeem-predefined' ) ?>"><?php  esc_html_e( 'Delete' , 'taqyeem-predefined' ) ?></a>
							<ul class="taq-reviews-group">
								<?php
									if( !empty( $group[ 'criteria' ] ) && is_array( $group[ 'criteria' ] ) ){
										foreach( $group[ 'criteria' ] as $criteria_name ){
											?>
											<li class="taqyeem-option-item taqyeem-review-item">
												<span class="label"><?php  esc_html_e( 'Review Criteria' , 'taqyeem-predefined' ) ?></span>
												<input name="taqyeem_options[group][<?php echo esc_attr( $i )  ?>][criteria][]" type="text" value="<?php echo esc_html( $criteria_name ) ?>">
												<a class="del-review del-group" title="<?php  esc_html_e( 'Delete' , 'taqyeem-predefined' ) ?>"></a>
											</li>
											<?php
										}
									}
								?>
							</ul>
							<input type="button" class="button add_review_criteria_item_in_group" value="<?php esc_html_e( 'Add Another Review Criteria' , 'taqyeem-predefined' ) ?>">
						</div>
		<?php
		}
	}
	?>
		<script>var nextGroup = <?php echo esc_html( $i+1 ) ?> ;</script>
	</div>
</div> <!-- Pre-defined Criteria -->
<?php
}
