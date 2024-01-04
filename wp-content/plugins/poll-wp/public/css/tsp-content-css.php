<style type="text/css" id="tsp_global_styles_<?php echo esc_attr( $total_soft_poll ); ?>">
	.tsp_flex_col {
		display: -ms-flexbox;
		display: -webkit-flex;
		display: flex;
		-webkit-flex-direction: column;
		-ms-flex-direction: column;
		flex-direction: column;
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
	.tsp_flex_row {
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
	/* Main CSS */
	:root{
		<?php if ( $ts_poll_question_params["TS_Poll_Q_Theme"] != 'Image Without Button' && $ts_poll_question_params["TS_Poll_Q_Theme"] != 'Video Without Button' ) { ?>
		   --tsp_before_check_c_<?php echo esc_html( $total_soft_poll ); ?>:<?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_ch_cbc"] ), FILTER_SANITIZE_STRING ); ?>;
		   --tsp_after_check_c_<?php echo esc_html( $total_soft_poll ); ?>:<?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_ch_cac"] ), FILTER_SANITIZE_STRING ); ?>;
		   --tsp_before_check_<?php echo esc_html( $total_soft_poll ); ?>:"\<?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_ch_tbc"] ), FILTER_SANITIZE_STRING ); ?>";
		   --tsp_after_check_<?php echo esc_html( $total_soft_poll ); ?>:"\<?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_ch_tac"] ), FILTER_SANITIZE_STRING ); ?>";
		<?php } ?>
		--tsp_answer_fs_<?php echo esc_html( $total_soft_poll ); ?>:<?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_a_fs"] ), FILTER_VALIDATE_INT ); ?>px;
		--tsp_main_bgc_<?php echo esc_html( $total_soft_poll ); ?>:<?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_a_mbgc"] ), FILTER_SANITIZE_STRING ); ?>;
		--tsp_answer_bgc_<?php echo esc_html( $total_soft_poll ); ?>:<?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_a_bgc"] ), FILTER_SANITIZE_STRING ); ?>;
		--tsp_answer_h_bgc_<?php echo esc_html( $total_soft_poll ); ?>:<?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_a_hbgc"] ), FILTER_SANITIZE_STRING ); ?>;
		--tsp_answer_h_c_<?php echo esc_html( $total_soft_poll ); ?>:<?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_a_hc"] ), FILTER_SANITIZE_STRING ); ?>;
		--tsp_answer_c_<?php echo esc_html( $total_soft_poll ); ?>:<?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_a_c"] ), FILTER_SANITIZE_STRING ); ?>;
		--tsp_answer_ff_<?php echo esc_html( $total_soft_poll ); ?>:<?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_boxsh"] ), FILTER_SANITIZE_STRING ); ?>;
	}
	footer.ts_poll_footer_<?php echo esc_html( $total_soft_poll ); ?> button{
		font-weight:normal !important;
	}
	footer.ts_poll_footer_<?php echo esc_html( $total_soft_poll ); ?> button:focus{
		outline: none !important;
	}

	form.ts_poll_form_<?php echo esc_html( $total_soft_poll ); ?>[max-width~="450px"] section.ts_poll_section_<?php echo esc_html( $total_soft_poll ); ?>{
		width: 100% !important;
	}
	
	section.ts_poll_section_<?php echo esc_html( $total_soft_poll ); ?>[max-width~="250px"] footer.ts_poll_footer_<?php echo esc_html( $total_soft_poll ); ?> button {
		width: 98% !important;
		margin: 5px 1% !important;
	}

	/* After answers line CSS */
	:root{
		--tsp_main_l_bw_<?php echo esc_html( $total_soft_poll ); ?>:<?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_laa_w"] ), FILTER_VALIDATE_INT ); ?>%;
		--tsp_main_l_bh_<?php echo esc_html( $total_soft_poll ); ?>:<?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_laa_h"] ), FILTER_VALIDATE_INT ); ?>px;
		--tsp_main_l_bc_<?php echo esc_html( $total_soft_poll ); ?>:<?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_laa_c"] ), FILTER_SANITIZE_STRING ); ?>;
		--tsp_main_l_bs_<?php echo esc_html( $total_soft_poll ); ?>:<?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_laa_s"] ), FILTER_SANITIZE_STRING ); ?>;
	}
	main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?> >  div.ts_poll_after_line_<?php echo esc_html( $total_soft_poll ); ?> {
		width: var(--tsp_main_l_bw_<?php echo esc_html( $total_soft_poll ); ?>);
		margin-top: 5px;
		border-top: var(--tsp_main_l_bh_<?php echo esc_html( $total_soft_poll ); ?>) var(--tsp_main_l_bs_<?php echo esc_html( $total_soft_poll ); ?>) var(--tsp_main_l_bc_<?php echo esc_html( $total_soft_poll ); ?>);
	}
	<?php
	if ( ( $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Standard Poll' && $ts_poll_old_standard === '' ) || $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Standart Without Button' || $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Standard Without Button'
	|| $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Image Without Button' || $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Video Without Button'
	|| $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Image in Question' || $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Video in Question'
	) {
		?>
		main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?>[data-tsp-veff="2"]  > .ts_poll_answer span.ts_poll_r_progress{ 
			background-size: 30px 30px;
			-moz-background-size: 30px 30px;
			-webkit-background-size: 30px 30px;
			-o-background-size: 30px 30px;
			background-image: -moz-linear-gradient(-45deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0.15) 25%, rgba(255, 255, 255, 0) 25%, rgba(255, 255, 255, 0) 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, rgba(255, 255, 255, 0) 75%, rgba(255, 255, 255, 0) 100%);
			background-image: -webkit-gradient(linear, left top, right bottom, color-stop(0%, rgba(255, 255, 255, 0.2)), color-stop(25%, rgba(255, 255, 255, 0.2)), color-stop(25%, rgba(255, 255, 255, 0)), color-stop(50%, rgba(255, 255, 255, 0)), color-stop(50%, rgba(255, 255, 255, 0.2)), color-stop(75%, rgba(255, 255, 255, 0.2)), color-stop(75%, rgba(255, 255, 255, 0)), color-stop(100%, rgba(255, 255, 255, 0)));
			background-image: -o-linear-gradient(-45deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0.15) 25%, rgba(255, 255, 255, 0) 25%, rgba(255, 255, 255, 0) 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, rgba(255, 255, 255, 0) 75%, rgba(255, 255, 255, 0) 100%);
			background-image: -ms-linear-gradient(-45deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0.15) 25%, rgba(255, 255, 255, 0) 25%, rgba(255, 255, 255, 0) 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, rgba(255, 255, 255, 0) 75%, rgba(255, 255, 255, 0) 100%);
			box-shadow: 0 5px 5px rgba(255, 255, 255, 0.6) inset, 0 -5px 7px rgba(0, 0, 0, 0.4) inset;
			-moz-box-shadow: 0 5px 5px rgba(255, 255, 255, 0.6) inset, 0 -5px 7px rgba(0, 0, 0, 0.4) inset;
			-webkit-box-shadow: 0 5px 5px rgba(255, 255, 255, 0.6) inset, 0 -5px 7px rgba(0, 0, 0, 0.4) inset;
			filter: progid:-DXImageTransform.Microsoft.gradient(startColorstr='#33ffffff', endColorstr='#33000000', GradientType=0);
			animation: TSprogress 2s linear infinite;
			-moz-animation: TSprogress 2s linear infinite;
			-webkit-animation: TSprogress 2s linear infinite;
		}
		main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?>[data-tsp-veff="3"]  > .ts_poll_answer span.ts_poll_r_progress{
			background-size: 30px 30px;
			-moz-background-size: 30px 30px;
			-webkit-background-size: 30px 30px;
			-o-background-size: 30px 30px;
			background-image: -moz-linear-gradient(-45deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0.15) 25%, rgba(255, 255, 255, 0) 25%, rgba(255, 255, 255, 0) 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, rgba(255, 255, 255, 0) 75%, rgba(255, 255, 255, 0) 100%);
			background-image: -webkit-gradient(linear, left top, right bottom, color-stop(0%, rgba(255, 255, 255, 0.2)), color-stop(25%, rgba(255, 255, 255, 0.2)), color-stop(25%, rgba(255, 255, 255, 0)), color-stop(50%, rgba(255, 255, 255, 0)), color-stop(50%, rgba(255, 255, 255, 0.2)), color-stop(75%, rgba(255, 255, 255, 0.2)), color-stop(75%, rgba(255, 255, 255, 0)), color-stop(100%, rgba(255, 255, 255, 0)));
			background-image: -o-linear-gradient(-45deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0.15) 25%, rgba(255, 255, 255, 0) 25%, rgba(255, 255, 255, 0) 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, rgba(255, 255, 255, 0) 75%, rgba(255, 255, 255, 0) 100%);
			background-image: -ms-linear-gradient(-45deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0.15) 25%, rgba(255, 255, 255, 0) 25%, rgba(255, 255, 255, 0) 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, rgba(255, 255, 255, 0) 75%, rgba(255, 255, 255, 0) 100%);
			filter: progid:-DXImageTransform.Microsoft.gradient(startColorstr='#33ffffff', endColorstr='#33000000', GradientType=0);
			animation: TSprogress 2s linear infinite;
			-moz-animation: TSprogress 2s linear infinite;
			-webkit-animation: TSprogress 2s linear infinite;
		}
		main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?>[data-tsp-veff="4"]  > .ts_poll_answer span.ts_poll_r_progress{
			background-size: 30px 30px;
			-moz-background-size: 30px 30px;
			-webkit-background-size: 30px 30px;
			-o-background-size: 30px 30px;
			background-image: -moz-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0.15) 25%, rgba(255, 255, 255, 0) 25%, rgba(255, 255, 255, 0) 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, rgba(255, 255, 255, 0) 75%, rgba(255, 255, 255, 0) 100%);
			background-image: -webkit-gradient(linear, right top, left bottom, color-stop(0%, rgba(255, 255, 255, 0.2)), color-stop(25%, rgba(255, 255, 255, 0.2)), color-stop(25%, rgba(255, 255, 255, 0)), color-stop(50%, rgba(255, 255, 255, 0)), color-stop(50%, rgba(255, 255, 255, 0.2)), color-stop(75%, rgba(255, 255, 255, 0.2)), color-stop(75%, rgba(255, 255, 255, 0)), color-stop(100%, rgba(255, 255, 255, 0)));
			background-image: -o-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0.15) 25%, rgba(255, 255, 255, 0) 25%, rgba(255, 255, 255, 0) 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, rgba(255, 255, 255, 0) 75%, rgba(255, 255, 255, 0) 100%);
			background-image: -ms-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0.15) 25%, rgba(255, 255, 255, 0) 25%, rgba(255, 255, 255, 0) 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, rgba(255, 255, 255, 0) 75%, rgba(255, 255, 255, 0) 100%);
			box-shadow: 0 5px 5px rgba(255, 255, 255, 0.6) inset, 0 -5px 7px rgba(0, 0, 0, 0.4) inset;
			-moz-box-shadow: 0 5px 5px rgba(255, 255, 255, 0.6) inset, 0 -5px 7px rgba(0, 0, 0, 0.4) inset;
			-webkit-box-shadow: 0 5px 5px rgba(255, 255, 255, 0.6) inset, 0 -5px 7px rgba(0, 0, 0, 0.4) inset;
			filter: progid:-DXImageTransform.Microsoft.gradient(startColorstr='#33ffffff', endColorstr='#33000000', GradientType=0);
			animation: TSprogressa 2s linear infinite;
			-moz-animation: TSprogressa 2s linear infinite;
			-webkit-animation: TSprogressa 2s linear infinite;
		}
		main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?>[data-tsp-veff="5"]  > .ts_poll_answer span.ts_poll_r_progress{
		   background-size: 30px 30px;
		   -moz-background-size: 30px 30px;
		   -webkit-background-size: 30px 30px;
		   -o-background-size: 30px 30px;
		   background-image: -moz-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0.15) 25%, rgba(255, 255, 255, 0) 25%, rgba(255, 255, 255, 0) 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, rgba(255, 255, 255, 0) 75%, rgba(255, 255, 255, 0) 100%);
		   background-image: -webkit-gradient(linear, right top, left bottom, color-stop(0%, rgba(255, 255, 255, 0.2)), color-stop(25%, rgba(255, 255, 255, 0.2)), color-stop(25%, rgba(255, 255, 255, 0)), color-stop(50%, rgba(255, 255, 255, 0)), color-stop(50%, rgba(255, 255, 255, 0.2)), color-stop(75%, rgba(255, 255, 255, 0.2)), color-stop(75%, rgba(255, 255, 255, 0)), color-stop(100%, rgba(255, 255, 255, 0)));
		   background-image: -o-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0.15) 25%, rgba(255, 255, 255, 0) 25%, rgba(255, 255, 255, 0) 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, rgba(255, 255, 255, 0) 75%, rgba(255, 255, 255, 0) 100%);
		   background-image: -ms-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0.15) 25%, rgba(255, 255, 255, 0) 25%, rgba(255, 255, 255, 0) 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, rgba(255, 255, 255, 0) 75%, rgba(255, 255, 255, 0) 100%);
		   filter: progid:-DXImageTransform.Microsoft.gradient(startColorstr='#33ffffff', endColorstr='#33000000', GradientType=0);
		   animation: TSprogressa 2s linear infinite;
		   -moz-animation: TSprogressa 2s linear infinite;
		   -webkit-animation: TSprogressa 2s linear infinite;
		}
		main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?>[data-tsp-veff="6"]  > .ts_poll_answer span.ts_poll_r_progress{
			background-size: 30px 30px;
			-moz-background-size: 30px 30px;
			-webkit-background-size: 30px 30px;
			-o-background-size: 30px 30px;
			background-image: -moz-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0.15) 25%, rgba(255, 255, 255, 0) 25%, rgba(255, 255, 255, 0) 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, rgba(255, 255, 255, 0) 75%, rgba(255, 255, 255, 0) 100%);
			background-image: -webkit-gradient(linear, right top, left bottom, color-stop(0%, rgba(255, 255, 255, 0.2)), color-stop(25%, rgba(255, 255, 255, 0.2)), color-stop(25%, rgba(255, 255, 255, 0)), color-stop(50%, rgba(255, 255, 255, 0)), color-stop(50%, rgba(255, 255, 255, 0.2)), color-stop(75%, rgba(255, 255, 255, 0.2)), color-stop(75%, rgba(255, 255, 255, 0)), color-stop(100%, rgba(255, 255, 255, 0)));
			background-image: -o-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0.15) 25%, rgba(255, 255, 255, 0) 25%, rgba(255, 255, 255, 0) 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, rgba(255, 255, 255, 0) 75%, rgba(255, 255, 255, 0) 100%);
			background-image: -ms-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0.15) 25%, rgba(255, 255, 255, 0) 25%, rgba(255, 255, 255, 0) 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, rgba(255, 255, 255, 0) 75%, rgba(255, 255, 255, 0) 100%);
			box-shadow: 0 5px 5px rgba(255, 255, 255, 0.6) inset, 0 -5px 7px rgba(0, 0, 0, 0.4) inset;
			-moz-box-shadow: 0 5px 5px rgba(255, 255, 255, 0.6) inset, 0 -5px 7px rgba(0, 0, 0, 0.4) inset;
			-webkit-box-shadow: 0 5px 5px rgba(255, 255, 255, 0.6) inset, 0 -5px 7px rgba(0, 0, 0, 0.4) inset;
			filter: progid:-DXImageTransform.Microsoft.gradient(startColorstr='#33ffffff', endColorstr='#33000000', GradientType=0);
			animation: TSprogressb 2s linear infinite;
			-moz-animation: TSprogressb 2s linear infinite;
			-webkit-animation: TSprogressb 2s linear infinite;
		}
		main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?>[data-tsp-veff="7"]  > .ts_poll_answer span.ts_poll_r_progress{
			background-size: 30px 30px;
			-moz-background-size: 30px 30px;
			-webkit-background-size: 30px 30px;
			-o-background-size: 30px 30px;
			background-image: -moz-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0.15) 25%, rgba(255, 255, 255, 0) 25%, rgba(255, 255, 255, 0) 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, rgba(255, 255, 255, 0) 75%, rgba(255, 255, 255, 0) 100%);
			background-image: -webkit-gradient(linear, right top, left bottom, color-stop(0%, rgba(255, 255, 255, 0.2)), color-stop(25%, rgba(255, 255, 255, 0.2)), color-stop(25%, rgba(255, 255, 255, 0)), color-stop(50%, rgba(255, 255, 255, 0)), color-stop(50%, rgba(255, 255, 255, 0.2)), color-stop(75%, rgba(255, 255, 255, 0.2)), color-stop(75%, rgba(255, 255, 255, 0)), color-stop(100%, rgba(255, 255, 255, 0)));
			background-image: -o-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0.15) 25%, rgba(255, 255, 255, 0) 25%, rgba(255, 255, 255, 0) 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, rgba(255, 255, 255, 0) 75%, rgba(255, 255, 255, 0) 100%);
			background-image: -ms-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0.15) 25%, rgba(255, 255, 255, 0) 25%, rgba(255, 255, 255, 0) 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, rgba(255, 255, 255, 0) 75%, rgba(255, 255, 255, 0) 100%);
			filter: progid:-DXImageTransform.Microsoft.gradient(startColorstr='#33ffffff', endColorstr='#33000000', GradientType=0);
			animation: TSprogressb 2s linear infinite;
			-moz-animation: TSprogressb 2s linear infinite;
			-webkit-animation: TSprogressb 2s linear infinite;
		}
		main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?>[data-tsp-veff="8"]  > .ts_poll_answer span.ts_poll_r_progress{
			background-size: 30px 30px;
			-moz-background-size: 30px 30px;
			-webkit-background-size: 30px 30px;
			-o-background-size: 30px 30px;
			background-image: -moz-linear-gradient(-45deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0.15) 25%, rgba(255, 255, 255, 0) 25%, rgba(255, 255, 255, 0) 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, rgba(255, 255, 255, 0) 75%, rgba(255, 255, 255, 0) 100%);
			background-image: -webkit-gradient(linear, left top, right bottom, color-stop(0%, rgba(255, 255, 255, 0.2)), color-stop(25%, rgba(255, 255, 255, 0.2)), color-stop(25%, rgba(255, 255, 255, 0)), color-stop(50%, rgba(255, 255, 255, 0)), color-stop(50%, rgba(255, 255, 255, 0.2)), color-stop(75%, rgba(255, 255, 255, 0.2)), color-stop(75%, rgba(255, 255, 255, 0)), color-stop(100%, rgba(255, 255, 255, 0)));
			background-image: -o-linear-gradient(-45deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0.15) 25%, rgba(255, 255, 255, 0) 25%, rgba(255, 255, 255, 0) 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, rgba(255, 255, 255, 0) 75%, rgba(255, 255, 255, 0) 100%);
			background-image: -ms-linear-gradient(-45deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0.15) 25%, rgba(255, 255, 255, 0) 25%, rgba(255, 255, 255, 0) 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, rgba(255, 255, 255, 0) 75%, rgba(255, 255, 255, 0) 100%);
			box-shadow: 0 5px 5px rgba(255, 255, 255, 0.6) inset, 0 -5px 7px rgba(0, 0, 0, 0.4) inset;
			-moz-box-shadow: 0 5px 5px rgba(255, 255, 255, 0.6) inset, 0 -5px 7px rgba(0, 0, 0, 0.4) inset;
			-webkit-box-shadow: 0 5px 5px rgba(255, 255, 255, 0.6) inset, 0 -5px 7px rgba(0, 0, 0, 0.4) inset;
			filter: progid:-DXImageTransform.Microsoft.gradient(startColorstr='#33ffffff', endColorstr='#33000000', GradientType=0);
			animation: TSprogressc 2s linear infinite;
			-moz-animation: TSprogressc 2s linear infinite;
			-webkit-animation: TSprogressc 2s linear infinite;
		}
		main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?>[data-tsp-veff="9"]  > .ts_poll_answer span.ts_poll_r_progress{
			background-size: 30px 30px;
			-moz-background-size: 30px 30px;
			-webkit-background-size: 30px 30px;
			-o-background-size: 30px 30px;
			background-image: -moz-linear-gradient(-45deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0.15) 25%, rgba(255, 255, 255, 0) 25%, rgba(255, 255, 255, 0) 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, rgba(255, 255, 255, 0) 75%, rgba(255, 255, 255, 0) 100%);
			background-image: -webkit-gradient(linear, left top, right bottom, color-stop(0%, rgba(255, 255, 255, 0.2)), color-stop(25%, rgba(255, 255, 255, 0.2)), color-stop(25%, rgba(255, 255, 255, 0)), color-stop(50%, rgba(255, 255, 255, 0)), color-stop(50%, rgba(255, 255, 255, 0.2)), color-stop(75%, rgba(255, 255, 255, 0.2)), color-stop(75%, rgba(255, 255, 255, 0)), color-stop(100%, rgba(255, 255, 255, 0)));
			background-image: -o-linear-gradient(-45deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0.15) 25%, rgba(255, 255, 255, 0) 25%, rgba(255, 255, 255, 0) 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, rgba(255, 255, 255, 0) 75%, rgba(255, 255, 255, 0) 100%);
			background-image: -ms-linear-gradient(-45deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0.15) 25%, rgba(255, 255, 255, 0) 25%, rgba(255, 255, 255, 0) 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, rgba(255, 255, 255, 0) 75%, rgba(255, 255, 255, 0) 100%);
			filter: progid:-DXImageTransform.Microsoft.gradient(startColorstr='#33ffffff', endColorstr='#33000000', GradientType=0);
			animation: TSprogressc 2s linear infinite;
			-moz-animation: TSprogressc 2s linear infinite;
			-webkit-animation: TSprogressc 2s linear infinite;
		}

		@-webkit-keyframes TSprogress {
			0% {
				background-position: 0 0;
			}
			100% {
				background-position: -60px -60px;
			}
		}      
		@-moz-keyframes TSprogress {
			0% {
				background-position: 0 0;
			}
			100% {
				background-position: -60px -60px;
			}
		}      
		@keyframes TSprogress {
			0% {
				background-position: 0 0;
			}
			100% {
				background-position: -60px -60px;
			}
		}      
		@-webkit-keyframes TSprogressa {
			0% {
				background-position: 0 0;
			}
			100% {
				background-position: -60px 60px;
			}
		}      
		@-moz-keyframes TSprogressa {
			0% {
				background-position: 0 0;
			}
			100% {
				background-position: -60px 60px;
			}
		}      
		@keyframes TSprogressa {
			0% {
				background-position: 0 0;
			}
			100% {
				background-position: -60px 60px;
			}
		}      
		@-webkit-keyframes TSprogressb {
			0% {
				background-position: 0 0;
			}
			100% {
				background-position: 60px -60px;
			}
		}      
		@-moz-keyframes TSprogressb {
			0% {
				background-position: 0 0;
			}
			100% {
				background-position: 60px -60px;
			}
		}      
		@keyframes TSprogressb {
			0% {
				background-position: 0 0;
			}
			100% {
				background-position: 60px -60px;
			}
		}      
		@-webkit-keyframes TSprogressc {
			0% {
				background-position: 0 0;
			}
			100% {
				background-position: 60px 60px;
			}
		}      
		@-moz-keyframes TSprogressc {
			0% {
				background-position: 0 0;
			}
			100% {
				background-position: 60px 60px;
			}
		}      
		@keyframes TSprogressc {
			0% {
				background-position: 0 0;
			}
			100% {
				background-position: 60px 60px;
			}
		}
	<?php } ?>
</style>
