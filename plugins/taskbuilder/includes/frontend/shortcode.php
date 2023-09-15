<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}
wp_enqueue_script('jquery');
wp_enqueue_script('jquery-ui-core');
wp_enqueue_script('jquery-ui-sortable');
wp_enqueue_script('jquery-ui-datepicker' );
wp_enqueue_editor();

wp_enqueue_style('wppm-bootstrap-css');
wp_enqueue_style('wppm-jquery-ui');
wp_enqueue_style('wppm-public-css');
wp_enqueue_style('wppm-admin-css');
wp_enqueue_style('wppm-modal-css');
wp_enqueue_style('wppm-flatpickr-css');
wp_enqueue_style('wppm-select2-css');
wp_enqueue_style('wppm-gpopover-css');
wp_enqueue_style('wppm-dragula-css');

wp_enqueue_script('wppm-admin');
wp_enqueue_script('wppm-public');
wp_enqueue_script('wppm-modal');
wp_enqueue_script('wppm-flatpickr-js');
wp_enqueue_script('wppm-select2-js');
wp_enqueue_script('wppm-gpopover-js');
wp_enqueue_script('wppm-dragula-js');
wp_enqueue_script('wppm-datatable-js');
wp_enqueue_script('wppm-datatable-css');
?>
<div class="wppm_bootstrap">
  <div id="wppm_project_container"></div>
  <div id="wppm_alert_success" class="alert alert-success wppm_alert" style="display:none;" role="alert">
    <img src="<?php echo esc_url( WPPM_PLUGIN_URL . 'asset/images/success.svg'); ?>" alt="success"> <span class="wppm_alert_text"></span>
  </div>
   <div id="wppm_alert_error" class="alert alert-danger wppm_alert" style="display:none;" role="alert">
    <img src="<?php echo esc_url( WPPM_PLUGIN_URL . 'asset/images/warning-triangle.svg'); ?>" alt="warning-triangle"> <span class="wppm_alert_text"></span>
  </div>
</div>
<!-- Pop-up snippet start -->
<div id="wppm_popup_background" style="display:none;"></div>
<div id="wppm_popup_container" style="display:none;">
  <div class="wppm_bootstrap">
    <div class="row">
      <div id="wppm_popup" class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
        <div id="wppm_popup_title" class="row" ><h3><?php echo esc_html_e('Modal Title','taskbuilder');?></h3></div>
        <div id="wppm_popup_body" class="row"><?php echo esc_html_e('I am body!','taskbuilder');?></div>
        <div id="wppm_popup_footer" class="row">
          <button type="button" class="btn wppm_popup_close"><?php echo esc_html_e('Close','taskbuilder');?></button>
          <button type="button" class="btn wppm_popup_action"><?php echo esc_html_e('Save Changes','taskbuilder');?></button>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Pop-up snippet end -->
<?php
add_action('wp_footer', 'wppm_page_inline_script', 999999999999999999);
do_action('wppm_after_shortcode_loaded');
if(!function_exists('wppm_page_inline_script')) {
  function wppm_page_inline_script() { ?>
    <script type="text/javascript">
      jQuery( document ).ready( function( jQuery ) {
        <?php if(is_user_logged_in()){ ?>
                wppm_get_project_list();
        <?php } else{ ?>
                wppm_sign_in();
        <?php }?>
      });
    </script>
  <?php } 
}  
?>