<?php
/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * This file include image/video poll theme proporties.
 *
 * @link       TS Poll
 * @since      1.7.0
 *
 * @package    TS_Poll
 * @subpackage TS_Poll/public/theme_partials
 */
?>
<style type="text/css" id="tsp_styles_<?php echo esc_attr( $total_soft_poll ); ?>">
	section.ts_poll_section_<?php echo esc_html( $total_soft_poll ); ?> > main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?> {
		display: -ms-flexbox;display: -webkit-flex;display: flex;
		-webkit-flex-direction: row;-ms-flex-direction: row;flex-direction: row;
		-webkit-flex-wrap: wrap;-ms-flex-wrap: wrap;flex-wrap: wrap;
		-webkit-justify-content: space-around;-ms-flex-pack: distribute;justify-content: space-around;
		-webkit-align-content: center;-ms-flex-line-pack: center;align-content: center;
		-webkit-align-items: flex-start;-ms-flex-align: start;align-items: flex-start;
		background-color: var(--tsp_main_bgc_<?php echo esc_html( $total_soft_poll ); ?>);
		width:100%;
		padding: 8px 10px 5px 10px;
	}
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?> > .ts_poll_answer {
		position: relative;
		display: inline-block;
		padding: 3px 3px;
		margin-top: 3px;
		line-height: 1.2 !important;
	}
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-layout="1"] > .ts_poll_answer {
		 width: 99%;
	}
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-layout="2"] > .ts_poll_answer {
		 width: 49%;
	}
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-layout="3"] > .ts_poll_answer {
		width: 32%;
	}
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-layout="4"] > .ts_poll_answer {
		width: 24%;
	}
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-layout="5"] > .ts_poll_answer {
		width: 19%;
	}
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>:not([data-tsp-color="Background"]) > .ts_poll_answer > .ts_poll_before_div{
		background-color: var(--tsp_answer_bgc_<?php echo esc_html( $total_soft_poll ); ?>);
	}
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-effect="1"] > .ts_poll_answer > .ts_poll_before_div{
		-ms-transform: rotateY(0deg);
		-moz-transform: rotateY(0deg);
		-o-transform: rotateY(0deg);
		-webkit-transform: rotateY(0deg);
		transform: rotateY(0deg);
		-webkit-transition: all 0.5s ease-in-out 0.5s;
		-moz-transition: all 0.5s ease-in-out 0.5s;
		-o-transition: all 0.5s ease-in-out 0.5s;
		-ms-transition: all 0.5s ease-in-out 0.5s;
		transition: all 0.5s ease-in-out 0.5s;
		-webkit-transition-delay: 0s;
		-moz-transition-delay: 0s;
		-o-transition-delay: 0s;
		-ms-transition-delay: 0s;
		transition-delay: 0s;
	}
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-effect="2"] > .ts_poll_answer > .ts_poll_before_div{
		-ms-transform: rotateX(0deg);
		-moz-transform: rotateX(0deg);
		-o-transform: rotateX(0deg);
		-webkit-transform: rotateX(0deg);
		transform: rotateX(0deg);
		-webkit-transition: all 0.5s ease-in-out 0.5s;
		-moz-transition: all 0.5s ease-in-out 0.5s;
		-o-transition: all 0.5s ease-in-out 0.5s;
		-ms-transition: all 0.5s ease-in-out 0.5s;
		transition: all 0.5s ease-in-out 0.5s;
		-webkit-transition-delay: 0s;
		-moz-transition-delay: 0s;
		-o-transition-delay: 0s;
		-ms-transition-delay: 0s;
		transition-delay: 0s;
	}
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?> > .ts_poll_answer > .ts_poll_before_div{
		display: -ms-flexbox;display: -webkit-flex;display: flex;
		-webkit-flex-wrap: nowrap;-ms-flex-wrap: nowrap;flex-wrap: nowrap;
		-webkit-justify-content:center;-ms-flex-pack: center;justify-content:center;
		-webkit-align-content: center;-ms-flex-line-pack: center;align-content: center;
		-webkit-align-items: center;-ms-flex-align: center;align-items: center;
		-webkit-transition: background-color 700ms linear;
		-ms-transition: background-color 700ms linear;
		transition: background-color 700ms linear;
	}
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-position="Position 1"] > .ts_poll_answer > .ts_poll_before_div,
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-position="Position 2"] > .ts_poll_answer > .ts_poll_before_div{
		-webkit-flex-direction: column-reverse;-ms-flex-direction: column-reverse;flex-direction: column-reverse;
	}
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-position="Position 3"] > .ts_poll_answer > .ts_poll_before_div,
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-position="Position 4"] > .ts_poll_answer > .ts_poll_before_div{
		-webkit-flex-direction: column;-ms-flex-direction: column;flex-direction: column;
	}
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-position="Position 5"] > .ts_poll_answer > .ts_poll_before_div{
		-webkit-flex-direction: row-reverse;-ms-flex-direction: row-reverse;flex-direction: row-reverse;
	}
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-position="Position 6"] > .ts_poll_answer > .ts_poll_before_div{
		-webkit-flex-direction: row;-ms-flex-direction: row;flex-direction: row;
	}
	:root{
		--tsp_checkbox_size_<?php echo esc_attr( $total_soft_poll ); ?>:<?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_ch_s"] ), FILTER_VALIDATE_INT ); ?>px;;
		--tsp_label_size_<?php echo esc_attr( $total_soft_poll ); ?> : calc(10px + var(--tsp_checkbox_size_<?php echo esc_html( $total_soft_poll ); ?>));
		--tsp_ans_ratio_<?php echo esc_attr( $total_soft_poll ); ?> : calc(100% - var(--tsp_label_size_<?php echo esc_html( $total_soft_poll ); ?>));
		--tsp_overlay_bgc_<?php echo esc_attr( $total_soft_poll ); ?>: <?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_p_a_oc"] ), FILTER_SANITIZE_STRING ); ?>; 
		--tsp_overlay_c_<?php echo esc_attr( $total_soft_poll ); ?>: <?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_p_a_c"] ), FILTER_SANITIZE_STRING ); ?>;
		--tsp_answer_h_bsh_<?php echo esc_attr( $total_soft_poll ); ?>: <?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_a_hshc"] ), FILTER_SANITIZE_STRING ); ?>;
		--tsp_answer_pbottom_<?php echo esc_attr( $total_soft_poll ); ?> : <?php echo esc_attr( $tspoll_question_styles["ts_poll_a_ih"] ); ?>px;
	}
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-position="Position 5"] > .ts_poll_answer > .ts_poll_before_div > .ts_poll_imgvd_div,
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-position="Position 6"] > .ts_poll_answer > .ts_poll_before_div > .ts_poll_imgvd_div
	{
		width:var(--tsp_ans_ratio_<?php echo esc_html( $total_soft_poll ); ?>);
	}
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-position="Position 5"] > .ts_poll_answer > .ts_poll_before_div > .ts_poll_answer_label,
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-position="Position 6"] > .ts_poll_answer > .ts_poll_before_div > .ts_poll_answer_label
	{
		width:var(--tsp_label_size_<?php echo esc_html( $total_soft_poll ); ?>);
	}
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?> > .ts_poll_answer > .ts_poll_after_div{
		background-color: var(--tsp_overlay_bgc_<?php echo esc_attr( $total_soft_poll ); ?>);
		width: 100%;
		height: 100%;
		position: absolute;
		top: 0 !important;
		left: 0 !important;
		display: flex;
		flex-direction: column;
		flex-wrap: wrap;
		align-content: center;
		justify-content: center;
		align-items: center;
		text-align: center;
	}
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-effect="0"] > .ts_poll_answer > .ts_poll_after_div{
		display: none;
	}
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-effect="1"] > .ts_poll_answer > .ts_poll_after_div{
		-ms-transform: rotateY(-90deg);
		-moz-transform: rotateY(-90deg);
		-o-transform: rotateY(-90deg);
		-webkit-transform: rotateY(-90deg);
		transform: rotateY(-90deg);
		-webkit-transition: all 0.5s ease-in-out 0.5s;
		-moz-transition: all 0.5s ease-in-out 0.5s;
		-o-transition: all 0.5s ease-in-out 0.5s;
		-ms-transition: all 0.5s ease-in-out 0.5s;
		transition: all 0.5s ease-in-out 0.5s;
		-webkit-transition-delay: 0s;
		-moz-transition-delay: 0s;
		-o-transition-delay: 0s;
		-ms-transition-delay: 0s;
		transition-delay: 0s;
	}
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-effect="2"] > .ts_poll_answer > .ts_poll_after_div{
		-ms-transform: rotateX(-90deg);
		-moz-transform: rotateX(-90deg);
		-o-transform: rotateX(-90deg);
		-webkit-transform: rotateX(-90deg);
		transform: rotateX(-90deg);
		-webkit-transition: all 0.5s ease-in-out 0.5s;
		-moz-transition: all 0.5s ease-in-out 0.5s;
		-o-transition: all 0.5s ease-in-out 0.5s;
		-ms-transition: all 0.5s ease-in-out 0.5s;
		transition: all 0.5s ease-in-out 0.5s;
		-webkit-transition-delay: 0s;
		-moz-transition-delay: 0s;
		-o-transition-delay: 0s;
		-ms-transition-delay: 0s;
		transition-delay: 0s;
	}
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?> > .ts_poll_answer > .ts_poll_after_div .ts_poll_r_answer_title,
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?> > .ts_poll_answer > .ts_poll_after_div .ts_poll_answer_percent_line{
		color: var(--tsp_overlay_c_<?php echo esc_attr( $total_soft_poll ); ?>) !important;
		line-height: 2 !important;
		font-size: var(--tsp_answer_fs_<?php echo esc_html( $total_soft_poll ); ?>) !important;
		display: block;
		width: 100%;
		font-family:var(--tsp_answer_ff_<?php echo esc_html( $total_soft_poll ); ?>);
		word-break: break-word;
	}
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?> > .ts_poll_answer > .ts_poll_before_div > .ts_poll_imgvd_div{
		position: relative;
		width: 100%;
	}
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-ratio="none"] > .ts_poll_answer > .ts_poll_before_div > .ts_poll_imgvd_div{
		padding-bottom: var(--tsp_answer_pbottom_<?php echo esc_attr( $total_soft_poll ); ?>);
	}
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-ratio="1"] > .ts_poll_answer > .ts_poll_before_div > .ts_poll_imgvd_div{
		padding-bottom: 100%; 
	}
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-ratio="2"] > .ts_poll_answer > .ts_poll_before_div > .ts_poll_imgvd_div{
		padding-bottom: 56.25%;
	}
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-ratio="3"] > .ts_poll_answer > .ts_poll_before_div > .ts_poll_imgvd_div{
		padding-bottom: 177.78%;
	} 
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-ratio="4"] > .ts_poll_answer > .ts_poll_before_div > .ts_poll_imgvd_div{
		padding-bottom: 133.3%; 
	}
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-ratio="5"] > .ts_poll_answer > .ts_poll_before_div > .ts_poll_imgvd_div{
		padding-bottom: 75%;
	}
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-ratio="6"] > .ts_poll_answer > .ts_poll_before_div > .ts_poll_imgvd_div{
		padding-bottom: 66.7%;
	} 
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-ratio="7"] > .ts_poll_answer > .ts_poll_before_div > .ts_poll_imgvd_div{
		padding-bottom: 150%; 
	}
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-ratio="8"] > .ts_poll_answer > .ts_poll_before_div > .ts_poll_imgvd_div{
		padding-bottom: 62.5%;
	}
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-ratio="9"] > .ts_poll_answer > .ts_poll_before_div > .ts_poll_imgvd_div{
		padding-bottom: 160%;
	}
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?> > .ts_poll_answer > .ts_poll_before_div,
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?> > .ts_poll_answer > .ts_poll_before_div > .ts_poll_imgvd_div{
		overflow:hidden;
	}
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?> > .ts_poll_answer > .ts_poll_before_div img{
		width: 100%;
		height: 100% !important;
		position: absolute;
		left: 0;
		top: 0;
		margin: 0 !important;
		padding: 0 !important;
		float: none !important;
	}
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?> > .ts_poll_answer > .ts_poll_before_div:hover {
		background-color: var(--tsp_answer_h_bgc_<?php echo esc_html( $total_soft_poll ); ?>) !important;
	}
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-hover="true"] > .ts_poll_answer > .ts_poll_before_div:hover {
		box-shadow: 0px 0px 5px var(--tsp_answer_h_bsh_<?php echo esc_attr( $total_soft_poll ); ?>) !important;
		-moz-box-shadow: 0px 0px 5px var(--tsp_answer_h_bsh_<?php echo esc_attr( $total_soft_poll ); ?>) !important;
		-webkit-box-shadow: 0px 0px 5px var(--tsp_answer_h_bsh_<?php echo esc_attr( $total_soft_poll ); ?>) !important;
	}
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?> > .ts_poll_answer > .ts_poll_before_div:hover label{
		color: var(--tsp_answer_h_c_<?php echo esc_html( $total_soft_poll ); ?>) !important;
	}
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?> > .ts_poll_answer input{
		display: none;
	}
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?> > .ts_poll_answer input + label{
		font-size: var(--tsp_answer_fs_<?php echo esc_html( $total_soft_poll ); ?>) !important;
		cursor: pointer;
		font-family: var(--tsp_answer_ff_<?php echo esc_html( $total_soft_poll ); ?>);
		position: relative;
	}
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>:not([data-tsp-color="Color"]) > .ts_poll_answer input + label{
		color: var(--tsp_answer_c_<?php echo esc_html( $total_soft_poll ); ?>) !important;
	}

	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-position="Position 2"] > .ts_poll_answer input + label,
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-position="Position 4"] > .ts_poll_answer input + label
	{
		height:var(--tsp_label_size_<?php echo esc_html( $total_soft_poll ); ?>);
	}

	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-position="Position 1"] > .ts_poll_answer input + label,
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-position="Position 3"] > .ts_poll_answer input + label
	{
		padding:7px;
	}

	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-position="Position 1"] > .ts_poll_answer input + label,
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-position="Position 2"] > .ts_poll_answer input + label,
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-position="Position 3"] > .ts_poll_answer input + label,
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-position="Position 4"] > .ts_poll_answer input + label{
		margin-bottom: 0px !important;
		width:100%;
		display: -ms-flexbox;
		display: -webkit-flex;
		display: flex;
		-webkit-flex-direction: row;
		-ms-flex-direction: row;
		flex-direction: row;
		-webkit-flex-wrap: nowrap;
		-ms-flex-wrap: nowrap;
		flex-wrap: nowrap;
		-webkit-justify-content: center;
		-ms-flex-pack: center;
		justify-content: center;
		-webkit-align-content: center;
		-ms-flex-line-pack: center;
		align-content: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
	}
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?> > .ts_poll_answer input + label:before{
		color: var(--tsp_before_check_c_<?php echo esc_html( $total_soft_poll ); ?>);
		content: var(--tsp_before_check_<?php echo esc_html( $total_soft_poll ); ?>);
		font-size :var(--tsp_checkbox_size_<?php echo esc_attr( $total_soft_poll ); ?>);
		font-family: FontAwesome !important;
	}
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-position="Position 1"] > .ts_poll_answer input + label:before,
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-position="Position 3"] > .ts_poll_answer input + label:before
	{
		margin: 0 .25em 0 0 !important;

	}
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-position="Position 5"] > .ts_poll_answer input + label,
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-position="Position 6"] > .ts_poll_answer input + label{
		display: -ms-flexbox;display: -webkit-flex;display: flex;
		-webkit-flex-direction: column;-ms-flex-direction: column;flex-direction: column;
		-webkit-align-items: center;-ms-flex-align: center;align-items: center;
		padding:0;
	}
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?> > .ts_poll_answer input:checked + label:before{
		color: var(--tsp_after_check_c_<?php echo esc_html( $total_soft_poll ); ?>) !important;
		content: var(--tsp_after_check_<?php echo esc_html( $total_soft_poll ); ?>);
	}
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?> > .ts_poll_answer input:checked + label:after{
		font-weight: bold;
	}
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-position="Position 2"] > .ts_poll_answer label > span,
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-position="Position 4"] > .ts_poll_answer label > span,
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-position="Position 5"] > .ts_poll_answer label > span,
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-position="Position 6"] > .ts_poll_answer label > span{
		visibility: hidden;
		display: none;
	}
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?> > .ts_poll_answer input + label{
		word-break: break-word;
		overflow:hidden;
	}
	<?php if ( $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Video Poll' ) { ?>
		:root{
			--tsp_video_bgc_<?php echo esc_attr( $total_soft_poll ); ?>: <?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_play_iovc"] ), FILTER_SANITIZE_STRING ); ?>; 
			--tsp_video_c_<?php echo esc_attr( $total_soft_poll ); ?>: <?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_play_ic"] ), FILTER_SANITIZE_STRING ); ?>;
			--tsp_video_fs_<?php echo esc_html( $total_soft_poll ); ?>:<?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_play_is"] ), FILTER_VALIDATE_INT ); ?>px;
		}
		main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?> .ts_poll_video_overlay{
			background: var(--tsp_video_bgc_<?php echo esc_attr( $total_soft_poll ); ?>);
			position: absolute;
			left: 0 !important;
			top: 0;
			width: 100% !important;
			cursor: pointer;
			z-index: 1;
			-webkit-transition: opacity 700ms linear;
			-ms-transition: opacity 700ms linear;
			transition: opacity 700ms linear;
			opacity: 0;
			height: 100%;
		}
		main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?> .ts_poll_video_overlay > .ts_poll_overlay_icon {
			position: relative;
			text-align: center;
			width: 100%;
			line-height: 1 !important;
			display: block;
			top: 50%;
			-ms-transform: translateY(-50%);
			-webkit-transform: translateY(-50%);
			-moz-transform: translateY(-50%);
			-o-transform: translateY(-50%);
			transform: translateY(-50%);
		}
		main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?> .ts_poll_video_overlay > .ts_poll_overlay_icon i{
			 color: var(--tsp_video_c_<?php echo esc_attr( $total_soft_poll ); ?>);
			 font-size: var(--tsp_video_fs_<?php echo esc_html( $total_soft_poll ); ?>);
		}
		main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?> .ts_poll_video_overlay > .ts_poll_overlay_icon i:before{
			 font-family:FontAwesome;
		}
		main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?> > .ts_poll_answer > .ts_poll_before_div:hover .ts_poll_video_overlay{
			 opacity: 1;
			 height: 100% !important;
		}
		section.tsp_popup_question_<?php echo esc_html( $total_soft_poll ); ?> * {
			-moz-box-sizing:border-box;-webkit-box-sizing:border-box;box-sizing:border-box;
		}
		section.tsp_popup_question_<?php echo esc_html( $total_soft_poll ); ?> {
			width: 100vw;
			height: 100vh;
			position: fixed;
			left: 0;
			right: 0;
			top: 0;
			bottom: 0;
			z-index: 9999999999;
			background: #6460604a;
			display:none;
		}
		div.tsp_popup_inner_<?php echo esc_html( $total_soft_poll ); ?> {
			position:relative;
			width: 100vw;
			height: 100vh;
			max-width: 70vw;
			max-height: 70vh;
			padding: 3em;
		}
		@media all and (max-width:400px) {
			div.tsp_popup_inner_<?php echo esc_html( $total_soft_poll ); ?> {
				max-width: 95vw;
				max-height: 95vh;
			}
		}

		div.tsp_popup_attachment_<?php echo esc_html( $total_soft_poll ); ?> {
			position: absolute;
			top: 0;
			right: 0;
			bottom: 0;
			left: 0;
			width:100%;
			height:100%;
		}
		div.tsp_popup_attachment_<?php echo esc_html( $total_soft_poll ); ?> > div > *{
			max-width: 100% !important;
			max-height: 100% !important;
		}
		div.tsp_popup_attachment_<?php echo esc_html( $total_soft_poll ); ?> > div {
    		width: 100%;
    		height: 0;
    		padding-bottom: 56.25%;
    		position: relative;
		}
		div.tsp_popup_attachment_<?php echo esc_html( $total_soft_poll ); ?> > div  > *:not(img) {
			position: absolute;
   			height: 100%;
   			width: 100%;
		}
		div.tsp_popup_attachment_<?php echo esc_html( $total_soft_poll ); ?> > div > img{
			left: 50%;
			top: 50%;
			transform: translate(-50%, -50%);
			position: absolute;
			max-height: 100% !important;
			width: auto !important;
			height: auto !important;
		}
		div.tsp_popup_inner_close_<?php echo esc_html( $total_soft_poll ); ?>{
			position: absolute;
			top: 1em;
			right: 1em;
			width: 4em;
			height: 4em;
			padding: 2em;
			cursor: pointer;
		}
		div.tsp_popup_inner_close_<?php echo esc_html( $total_soft_poll ); ?> > i{
			font-size: 3em;
			color:var(--tsp_popup_close_c_<?php echo esc_attr( $total_soft_poll ); ?>);
		}
	<?php } ?>
	/* all layouts to 1 */
	section.ts_poll_section_<?php echo esc_html( $total_soft_poll ); ?>[max-width~="300px"] main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?> > .ts_poll_answer {
		width: 99% !important;
	}
	/* layout 3 to 2 */
	section.ts_poll_section_<?php echo esc_html( $total_soft_poll ); ?>[max-width~="450px"] main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-layout="3"] > .ts_poll_answer,
	section.ts_poll_section_<?php echo esc_html( $total_soft_poll ); ?>[max-width~="450px"] main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-layout="4"] > .ts_poll_answer,
	section.ts_poll_section_<?php echo esc_html( $total_soft_poll ); ?>[max-width~="450px"] main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-layout="5"] > .ts_poll_answer {
		width: 49% ;
	}
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?> > .ts_poll_answer{
		-webkit-transition: all 0.3s ease-in-out;
		-moz-transition: all 0.3s ease-in-out;
		-o-transition: all 0.3s ease-in-out;
		-ms-transition: all 0.3s ease-in-out;
		transition: all 0.3s ease-in-out;
	}
</style>
<?php
  $tsp_main_answers = '';
for ( $i = 0;$i < $ts_poll_answers_count;$i ++ ) {
	$TS_Poll_Question_Answer_Param                              = $t_s_poll_answers_values[ $i ]["Answer_Param"];
	$TS_Poll_Colors_Array[ $t_s_poll_answers_values[ $i ]["id"] ] = $TS_Poll_Question_Answer_Param["TotalSoftPoll_Ans_Cl"];
	$tsp_main_answers .= sprintf(
		"
      <div class='ts_poll_answer' data-tsp-id='%s' data-tsp-type='%s'>
        <div class='ts_poll_before_div'>
          <div class='ts_poll_imgvd_div'>
            %s
            <img src='%s' alt='%s'>
          </div>
          <input  type='%s' 
                class='ts_poll_answer_input'
                id='%s'
                name='%s'
                value='%s'
                style='display:none;'>
          <label  class='ts_poll_answer_label' 
                  for='%s'>
            <span>%s</span>
          </label>
        </div>
        <div class='ts_poll_after_div'>
          <span class='ts_poll_after_span'>
            <span class='ts_poll_r_answer_title'>
              %s
            </span>
            <span class='ts_poll_answer_percent_line'
              data-tsp-w='%s'>
              %s
            </span>
          </span>
        </div>
      </div>
      ",
		esc_attr( $t_s_poll_answers_values[ $i ]["id"] ),
		$ts_poll_question_params["TS_Poll_Q_Theme"] == 'Video Poll' ? 'video' : 'image',
		$ts_poll_question_params["TS_Poll_Q_Theme"] == 'Video Poll' ? sprintf(
			"
        <div class='ts_poll_video_overlay' data-tsp-video='%s'><span class='ts_poll_overlay_icon'><i class='ts_poll_video_play_ic %s'></i></div>",
			esc_attr( $t_s_poll_answers_values[ $i ]["id"] ),
			esc_html( $tspoll_question_styles["ts_poll_play_it"] )
		) : '',
		$TS_Poll_Question_Answer_Param["TotalSoftPoll_Ans_Im"] == '' ? esc_url( plugins_url( 'img/tsp_no_img.jpg', __DIR__ ) ) : esc_url( $TS_Poll_Question_Answer_Param["TotalSoftPoll_Ans_Im"] ),
		esc_html( html_entity_decode( htmlspecialchars_decode( $t_s_poll_answers_values[ $i ]["Answer_Title"] ), ENT_QUOTES ) ),
		$tspoll_question_styles["ts_poll_ch_cm"] == 'true' ? 'checkbox' : 'radio',
		'ts_poll_answer_input_' . esc_attr( $total_soft_poll ) . '-' . esc_attr( $i + 1 ),
		'ts_poll_all' . esc_attr( $total_soft_poll ),
		esc_attr( $t_s_poll_answers_values[ $i ]["id"] ),
		'ts_poll_answer_input_' . esc_attr( $total_soft_poll ) . '-' . esc_attr( $i + 1 ),
		esc_html( html_entity_decode( htmlspecialchars_decode( $t_s_poll_answers_values[ $i ]["Answer_Title"] ), ENT_QUOTES ) ),
		$tspoll_question_styles["ts_poll_p_a_vt"] == 'countlab' || $tspoll_question_styles["ts_poll_p_a_vt"] == 'percentlab' || $tspoll_question_styles["ts_poll_p_a_vt"] == 'bothlab' ? esc_html( html_entity_decode( htmlspecialchars_decode( $t_s_poll_answers_values[ $i ]["Answer_Title"] ), ENT_QUOTES ) ) : '',
		$t_s_poll_question_settings["TotalSoft_Poll_Set_01"] == 'true' ? esc_html( round( (int) $t_s_poll_answers_values[ $i ]["Answer_Votes"] * 100 / (int) $total_soft_poll_res_count, 2 ) . '%' ) : esc_attr( '100%' ),
		$this->ts_poll_show_type(
			array(
				'tsp_show_results'   => $t_s_poll_question_settings["TotalSoft_Poll_Set_01"],
				'tsp_no_result_text' => $t_s_poll_question_settings["TotalSoft_Poll_Set_05"],
				'tsp_show_by'        => $tspoll_question_styles["ts_poll_p_a_vt"],
				'tsp_total_votes'    => $total_soft_poll_res_count,
				'tsp_answer_votes'   => $t_s_poll_answers_values[ $i ]["Answer_Votes"],
			)
		)
	);
}

echo sprintf(
	"
    <main class='%s' 
          data-tsp-layout='%s' 
          data-tsp-color='%s'
          data-tsp-effect='%s'
          data-tsp-ratio='%s'
          data-tsp-position='%s'
          data-tsp-hover='%s'>
      %s
      <div class='%s'></div> 
    </main>
      %s     
    ",
	'ts_poll_main_' . esc_attr( $total_soft_poll ),
	esc_attr( $tspoll_question_styles["ts_poll_a_cc"] ),
	esc_attr( $tspoll_question_styles["ts_poll_a_ca"] ),
	esc_attr( $tspoll_question_styles["ts_poll_p_a_veff"] ),
	in_array( $tspoll_question_styles["ts_poll_a_ih"], range( 1, 9 ) ) ? esc_attr( $tspoll_question_styles["ts_poll_a_ih"] ) : esc_attr( 'none' ),
	esc_attr( $tspoll_question_styles["ts_poll_a_pos"] ),
	esc_attr( $tspoll_question_styles["ts_poll_a_hsh_show"] ),
	$tsp_main_answers,
	'ts_poll_after_line_' . esc_attr( $total_soft_poll ),
	$ts_poll_question_params["TS_Poll_Q_Theme"] == 'Video Poll' ?
	sprintf(
		'
        <section class="tsp_popup_question_%1$s tsp_flex_col tsp_popup_question_fixed" style="display:none;">
          <div class="tsp_popup_inner_%1$s tsp_flex_col">
            <div class="tsp_popup_attachment_%1$s tsp_flex_col">
              <img >
            </div>
          </div>
        </section>
      ',
		esc_attr( $total_soft_poll )
	)
	: ''
);
?>
