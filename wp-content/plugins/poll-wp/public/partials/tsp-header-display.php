<?php
/**
 *
 * This file include header section of poll.
 *
 * @link       TS Poll
 * @since      1.7.0
 *
 * @package    TS_Poll
 * @subpackage TS_Poll/public/partials
 */
?>
<style type="text/css" id="tsp_header_styles_<?php echo esc_attr( $total_soft_poll ); ?>">
	:root{
		/* Root for header */
		--tsp_header_bgc_<?php echo esc_html( $total_soft_poll ); ?>:<?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_q_bgc"] ), FILTER_SANITIZE_STRING ); ?>;
		--tsp_header_c_<?php echo esc_html( $total_soft_poll ); ?>:<?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_q_c"] ), FILTER_SANITIZE_STRING ); ?>;
		--tsp_header_fs_<?php echo esc_html( $total_soft_poll ); ?>:<?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_q_fs"] ), FILTER_VALIDATE_INT ); ?>px;
		--tsp_header_ff_<?php echo esc_html( $total_soft_poll ); ?>:<?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_q_ff"] ), FILTER_SANITIZE_STRING ); ?>;
		--tsp_header_ta_<?php echo esc_html( $total_soft_poll ); ?>:<?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_q_ta"] ), FILTER_SANITIZE_STRING ); ?>;
		/* Root for header line*/
		--tsp_header_l_w_<?php echo esc_html( $total_soft_poll ); ?>:<?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_laq_w"] ), FILTER_VALIDATE_INT ); ?>%;
		--tsp_header_l_bh_<?php echo esc_html( $total_soft_poll ); ?>:<?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_laq_h"] ), FILTER_VALIDATE_INT ); ?>px;
		--tsp_header_l_bs_<?php echo esc_html( $total_soft_poll ); ?>:<?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_laq_s"] ), FILTER_SANITIZE_STRING ); ?>;
		--tsp_header_l_bc_<?php echo esc_html( $total_soft_poll ); ?>:<?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_laq_c"] ), FILTER_SANITIZE_STRING ); ?>;
	}

	/* Header CSS */
	header.ts_poll_header_<?php echo esc_attr( $total_soft_poll ); ?>{
		width:100%;
		display: -ms-flexbox;display: -webkit-flex;display: flex;
		-webkit-flex-direction: column;-ms-flex-direction: column;flex-direction: column;
		-webkit-flex-wrap: nowrap;-ms-flex-wrap: nowrap;flex-wrap: nowrap;
		-webkit-justify-content: center;-ms-flex-pack: center;justify-content: center;
		-webkit-align-content: center;-ms-flex-line-pack: center;align-content: center;
		-webkit-align-items: center;-ms-flex-align: center;align-items: center;
		-webkit-justify-content: center;-ms-flex-pack: center;justify-content: center;
		background-color:var(--tsp_header_bgc_<?php echo esc_html( $total_soft_poll ); ?>); 
		color:var(--tsp_header_c_<?php echo esc_html( $total_soft_poll ); ?>); 
		padding: 5px 10px 5px;
	}
	header.ts_poll_header_<?php echo esc_attr( $total_soft_poll ); ?> > span.ts_poll_title_<?php echo esc_attr( $total_soft_poll ); ?>{
		margin-bottom: 7px;
		font-family:var(--tsp_header_ff_<?php echo esc_html( $total_soft_poll ); ?>);
		line-height:1.2;
		font-size:var(--tsp_header_fs_<?php echo esc_html( $total_soft_poll ); ?>);
		text-align:var(--tsp_header_ta_<?php echo esc_html( $total_soft_poll ); ?>);
		word-break: break-word;
	}
	header.ts_poll_header_<?php echo esc_attr( $total_soft_poll ); ?>[data-tsp-pos="left"] > span.ts_poll_title_<?php echo esc_attr( $total_soft_poll ); ?>{
		margin-right: auto;
	}
	header.ts_poll_header_<?php echo esc_attr( $total_soft_poll ); ?>[data-tsp-pos="right"] > span.ts_poll_title_<?php echo esc_attr( $total_soft_poll ); ?>{
		margin-left: auto;
	}
	header.ts_poll_header_<?php echo esc_attr( $total_soft_poll ); ?> > div.ts_poll_line_<?php echo esc_attr( $total_soft_poll ); ?>{
		width:var(--tsp_header_l_w_<?php echo esc_html( $total_soft_poll ); ?>);
		border-top-width:var(--tsp_header_l_bh_<?php echo esc_html( $total_soft_poll ); ?>);
		border-top-style:var(--tsp_header_l_bs_<?php echo esc_html( $total_soft_poll ); ?>);
		border-top-color:var(--tsp_header_l_bc_<?php echo esc_html( $total_soft_poll ); ?>);
	}
 

</style>
<?php
	$tsp_in_question = '';
if ( $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Image in Question' || $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Video in Question' ) {
	if ( $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Image in Question' ) {
		$tsp_in_question = sprintf(
			'
                <div class="%s" data-tsp-ratio="%s">
                    <img src="%s">
                </div>
            ',
			'ts_poll_img_div_' . esc_attr( $total_soft_poll ),
			esc_attr( $tspoll_question_styles["ts_poll_i_ra"] ),
			$ts_poll_question_params["TotalSoftPoll_Q_Im"] == '' ? esc_url( plugins_url( 'img/tsp_no_img.jpg', __DIR__ ) ) : esc_url( $ts_poll_question_params["TotalSoftPoll_Q_Im"] )
		);
	} else {
		global $wp_embed;
		$tsp_in_question = sprintf(
			"
            <div class='%s'>
                <div class='%s'>
                    %s
                </div>
            </div>
            ",
			'ts_poll_video_div_' . esc_attr( $total_soft_poll ),
			'ts_poll_iframe_div_' . esc_attr( $total_soft_poll ),
			$ts_poll_question_params["TotalSoftPoll_Q_Vd"] == '' ?
			sprintf( '<img src="%s">', esc_url( plugins_url( 'img/tsp_no_video.png', __DIR__ ) ) ) :
			do_shortcode( $wp_embed->run_shortcode( '[embed]' . esc_url( $ts_poll_question_params["TotalSoftPoll_Q_Vd"] ) . '[/embed]' ) )
		);
	}
}
	echo sprintf(
		"
        <header class='%s' data-tsp-pos='%s'>
            %s
            <span class='%s'>
                %s
            </span>
            <div class='%s'></div>
        </header>",
		'ts_poll_header_' . esc_attr( $total_soft_poll ),
		esc_attr( $tspoll_question_styles["ts_poll_q_ta"] ),
		$ts_poll_question_params["TS_Poll_Q_Theme"] == 'Image in Question' || $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Video in Question' ? $tsp_in_question : '',
		'ts_poll_title_' . esc_attr( $total_soft_poll ),
		esc_html( html_entity_decode( htmlspecialchars_decode( $ts_poll_question_query['Question_Title'] ), ENT_QUOTES ) ),
		'ts_poll_line_' . esc_attr( $total_soft_poll )
	);
	?>
