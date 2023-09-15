<?php
/**
 * @author  RadiusTheme
 * @since   1.0.0
 * @version 1.0.0
 */

use RadiusTheme\ClassifiedLite\Helper;
use RadiusTheme\ClassifiedLite\Options;

use Rtcl\Helpers\Link;

$nav_menu_args    = Helper::nav_menu_args();
$login_icon_title = is_user_logged_in() ? esc_html__( 'My Account', 'cl-classified' ) : esc_html__( 'Login/Register', 'cl-classified' );
?>
<div class="main-header-inner">

	<?php get_template_part( 'template-parts/header/site', 'logo' ) ?>

    <div class="main-navigation-area <?php echo esc_attr( Options::$menu_alignment ) ?>">
        <div id="main-navigation" class="main-navigation">
			<?php wp_nav_menu( $nav_menu_args ); ?>
        </div>
    </div>

    <div class="header-icon-area">
		<?php if ( Helper::is_chat_enabled() ): ?>
            <a class="header-chat-icon rtcl-chat-unread-count"
               title="<?php esc_attr_e( 'Chat', 'cl-classified' ); ?>"
               href="<?php echo esc_url( Link::get_my_account_page_link( 'chat' ) ); ?>"><i class="far fa-comments"></i></a>
		<?php endif; ?>
		<?php if ( class_exists( 'Rtcl' ) && Options::$options['header_login_icon'] ): ?>
            <a class="header-login-icon" data-toggle="tooltip" title="<?php echo esc_attr( $login_icon_title ); ?>"
               href="<?php echo esc_url( Link::get_my_account_page_link() ); ?>"><i class="far fa-user"
                                                                                    aria-hidden="true"></i></a>
		<?php endif; ?>
		<?php if ( Options::$options['header_btn_txt'] && Options::$options['header_btn'] ): ?>
            <div class="header-btn-area">
                <a class="header-btn" href="<?php echo esc_url( Options::$options['header_btn_url'] ); ?>"><i
                            class="fas fa-plus"
                            aria-hidden="true"></i><?php echo esc_html( Options::$options['header_btn_txt'] ); ?>
                </a>
            </div>
		<?php endif; ?>
    </div>

</div>