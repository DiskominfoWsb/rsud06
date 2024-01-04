<?php
/**
 * Single Poll - Options
 */

use Pluginbazar\Utils;

defined( 'ABSPATH' ) || exit;

global $poll;


?>
    <div <?php liquidpoll_options_single_class( 'liquidpoll-options' ); ?>>

		<?php
		foreach ( $poll->get_poll_options() as $option_id => $option ) :

			$args = array_merge( array( 'option_id' => $option_id ), $option );

			liquidpoll_get_template( 'single-poll/options-single.php', $args );

		endforeach;
		?>

		<?php
		$typography_options = $poll->get_css_args( '_typography_options' );

		liquidpoll_apply_css( '.liquidpoll-option-list-1 .liquidpoll-option-single input + label', $typography_options );

		liquidpoll_apply_css( '.poll-single.theme-4 .liquidpoll-option-single.has-result svg.liquidpoll-votes-count circle', array(
			'stroke' => Utils::get_args_option( 'color', $typography_options ),
		) );
		?>

    </div>

<?php if ( $poll->get_poll_type() === 'poll' ) : ?>

    <div class="liquidpoll-popup-container">
        <div class="liquidpoll-popup-box">
            <span class="box-close dashicons dashicons-no-alt"></span>
            <div class="liquidpoll-new-option">
                <input type="text" placeholder="<?php esc_attr_e( 'Your option', 'wp-poll' ); ?>">
                <span class="liquidpoll-notice-warning"
                      style="display: none;"><?php esc_html_e( 'Please write some text !', 'wp-poll' ) ?></span>
                <button class="liquidpoll-button liquidpoll-button-blue"
                        data-pollid="<?php echo esc_attr( $poll->get_id() ); ?>"><?php esc_html_e( 'Add Option', 'wp-poll' ); ?></button>
            </div>
        </div>
    </div>

<?php endif; ?>