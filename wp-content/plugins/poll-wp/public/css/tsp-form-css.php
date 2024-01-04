<style type="text/css" id="tsp_form_styles_<?php echo esc_attr( $total_soft_poll ); ?>">
	:root{
		/* Root for form and section */
		--tsp_section_w_<?php echo esc_html( $total_soft_poll ); ?>:<?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_mw"] ), FILTER_VALIDATE_INT ); ?>%;;
		--tsp_section_bw_<?php echo esc_html( $total_soft_poll ); ?>:<?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_bw"] ), FILTER_VALIDATE_INT ); ?>px;
		--tsp_section_bc_<?php echo esc_html( $total_soft_poll ); ?>:<?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_bc"] ), FILTER_SANITIZE_STRING ); ?>;
		--tsp_section_br_<?php echo esc_html( $total_soft_poll ); ?>:<?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_br"] ), FILTER_VALIDATE_INT ); ?>px;
		--tsp_section_box_c_<?php echo esc_html( $total_soft_poll ); ?>:<?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_boxshc"] ), FILTER_SANITIZE_STRING ); ?>;
	}

	/* FORM CSS */
	form.ts_poll_form_<?php echo esc_html( $total_soft_poll ); ?>{
		position:relative;
		display: -ms-flexbox;display: -webkit-flex;display: flex;
		-webkit-align-content: center;-ms-flex-line-pack: center;align-content: center;
		-webkit-align-items: center;-ms-flex-align: center;align-items: center;
		width:100%;
		margin-bottom:15px !important;
		margin-top:15px !important;
	}
	form.ts_poll_form_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-mode="coming"] > section > *:not(span.ts_poll_cs_<?php echo esc_html( $total_soft_poll ); ?>){
		display:none !important;
	}
	form.ts_poll_form_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-mode="coming"] > section > span.ts_poll_cs_<?php echo esc_html( $total_soft_poll ); ?>{
		display:flex !important;
	}
	form.ts_poll_form_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-mode="end"] > section > footer{
		display:none !important;
	}
	form.ts_poll_form_<?php echo esc_html( $total_soft_poll ); ?>{
		-webkit-justify-content: center;-ms-flex-pack: center;justify-content: center;
	}
	form.ts_poll_form_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-pos="left"]{
		-webkit-justify-content: flex-start;-ms-flex-pack: start;justify-content: flex-start;
	}
	form.ts_poll_form_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-pos="right"]{
		-webkit-justify-content: flex-end;-ms-flex-pack: end;justify-content: flex-end;
	}
	form.ts_poll_form_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-pos="center"]{
		-webkit-justify-content: center;-ms-flex-pack: center;justify-content: center;
	}
	form.ts_poll_form_<?php echo esc_html( $total_soft_poll ); ?> *{
		-moz-box-sizing: border-box;
		-webkit-box-sizing: border-box;
		box-sizing: border-box;
		font-weight:inherit;
	}
	form.ts_poll_form_<?php echo esc_html( $total_soft_poll ); ?> .ts_poll_loading{
		background: rgba(241, 241, 241, 0.85);
		position: absolute;
		top: 0;
		left: 0;
		text-align: center;
		width: 100%;
		height: 100%;
		line-height: 1;
		z-index: 99998;
		display: -ms-flexbox;display: -webkit-flex;display: flex;
		-webkit-align-content: center;-ms-flex-line-pack: center;align-content: center;
		-webkit-align-items: center;-ms-flex-align: center;align-items: center;
		-webkit-justify-content: center;-ms-flex-pack: center;justify-content: center;
		display: none;
	}
	form.ts_poll_form_<?php echo esc_html( $total_soft_poll ); ?> .ts_poll_loading .ts_poll_loading_img{
		margin: 0;
		padding: 0;
		width: 20px;
		height: 20px;
	}
	/* Section CSS */
	section.ts_poll_section_<?php echo esc_html( $total_soft_poll ); ?>{
		width: var(--tsp_section_w_<?php echo esc_html( $total_soft_poll ); ?>);
		border-width:  var(--tsp_section_bw_<?php echo esc_html( $total_soft_poll ); ?>);
		border-style:solid;
		border-color: var(--tsp_section_bc_<?php echo esc_html( $total_soft_poll ); ?>);
		border-radius: var(--tsp_section_br_<?php echo esc_html( $total_soft_poll ); ?>);
		display: -ms-flexbox;display: -webkit-flex;display: flex;
		-webkit-flex-direction: column;-ms-flex-direction: column;flex-direction: column;
		-webkit-flex-wrap: nowrap;-ms-flex-wrap: nowrap;flex-wrap: nowrap;
		overflow: hidden;
		position:relative;
	}
	section.ts_poll_section_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-box="none"]{
		-webkit-box-shadow: none;
		-moz-box-shadow: none;
		box-shadow: none;
	}
	section.ts_poll_section_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-box="true"]{
		-webkit-box-shadow: 0px 0px 13px var(--tsp_section_box_c_<?php echo esc_html( $total_soft_poll ); ?>);
		-moz-box-shadow: 0px 0px 13px var(--tsp_section_box_c_<?php echo esc_html( $total_soft_poll ); ?>);
		box-shadow: 0px 0px 13px var(--tsp_section_box_c_<?php echo esc_html( $total_soft_poll ); ?>);
	}
	section.ts_poll_section_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-box="false"]{
		-webkit-box-shadow: 0 25px 13px -18px var(--tsp_section_box_c_<?php echo esc_html( $total_soft_poll ); ?>);
		-moz-box-shadow: 0 25px 13px -18px var(--tsp_section_box_c_<?php echo esc_html( $total_soft_poll ); ?>);
		box-shadow: 0 25px 13px -18px var(--tsp_section_box_c_<?php echo esc_html( $total_soft_poll ); ?>);
	}
	section.ts_poll_section_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-box="sh03"]{
		box-shadow: 0 10px 6px -6px var(--tsp_section_box_c_<?php echo esc_html( $total_soft_poll ); ?>);
		-webkit-box-shadow: 0 10px 6px -6px var(--tsp_section_box_c_<?php echo esc_html( $total_soft_poll ); ?>);
		-moz-box-shadow: 0 10px 6px -6px var(--tsp_section_box_c_<?php echo esc_html( $total_soft_poll ); ?>);
	}
	section.ts_poll_section_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-box="sh04"]{
		box-shadow: 0 1px 4px var(--tsp_section_box_c_<?php echo esc_html( $total_soft_poll ); ?>), 0 0 40px var(--tsp_section_box_c_<?php echo esc_html( $total_soft_poll ); ?>) inset;
		-webkit-box-shadow: 0 1px 4px var(--tsp_section_box_c_<?php echo esc_html( $total_soft_poll ); ?>), 0 0 40px var(--tsp_section_box_c_<?php echo esc_html( $total_soft_poll ); ?>) inset;
		-moz-box-shadow: 0 1px 4px var(--tsp_section_box_c_<?php echo esc_html( $total_soft_poll ); ?>), 0 0 40px var(--tsp_section_box_c_<?php echo esc_html( $total_soft_poll ); ?>) inset;
	}
	section.ts_poll_section_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-box="sh05"]{
		box-shadow: 0 0 10px var(--tsp_section_box_c_<?php echo esc_html( $total_soft_poll ); ?>);
		-webkit-box-shadow: 0 0 10px var(--tsp_section_box_c_<?php echo esc_html( $total_soft_poll ); ?>);
		-moz-box-shadow: 0 0 10px var(--tsp_section_box_c_<?php echo esc_html( $total_soft_poll ); ?>);
	}
	section.ts_poll_section_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-box="sh06"]{
		box-shadow: 4px -4px var(--tsp_section_box_c_<?php echo esc_html( $total_soft_poll ); ?>);
		-moz-box-shadow: 4px -4px var(--tsp_section_box_c_<?php echo esc_html( $total_soft_poll ); ?>);
		-webkit-box-shadow: 4px -4px var(--tsp_section_box_c_<?php echo esc_html( $total_soft_poll ); ?>);
	}
	section.ts_poll_section_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-box="sh07"]{
		box-shadow: 5px 5px 3px var(--tsp_section_box_c_<?php echo esc_html( $total_soft_poll ); ?>);
		-moz-box-shadow: 5px 5px 3px var(--tsp_section_box_c_<?php echo esc_html( $total_soft_poll ); ?>);
		-webkit-box-shadow: 5px 5px 3px var(--tsp_section_box_c_<?php echo esc_html( $total_soft_poll ); ?>);
	}
	section.ts_poll_section_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-box="sh08"]{
		box-shadow: 2px 2px white, 4px 4px var(--tsp_section_box_c_<?php echo esc_html( $total_soft_poll ); ?>);
		-moz-box-shadow: 2px 2px white, 4px 4px var(--tsp_section_box_c_<?php echo esc_html( $total_soft_poll ); ?>);
		-webkit-box-shadow: 2px 2px white, 4px 4px var(--tsp_section_box_c_<?php echo esc_html( $total_soft_poll ); ?>);
	}
	section.ts_poll_section_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-box="sh09"]{
		box-shadow: 8px 8px 18px var(--tsp_section_box_c_<?php echo esc_html( $total_soft_poll ); ?>);
		-moz-box-shadow: 8px 8px 18px var(--tsp_section_box_c_<?php echo esc_html( $total_soft_poll ); ?>);
		-webkit-box-shadow: 8px 8px 18px var(--tsp_section_box_c_<?php echo esc_html( $total_soft_poll ); ?>);
	}
	section.ts_poll_section_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-box="sh10"]{
		box-shadow: 0 8px 6px -6px var(--tsp_section_box_c_<?php echo esc_html( $total_soft_poll ); ?>);
		-moz-box-shadow: 0 8px 6px -6px var(--tsp_section_box_c_<?php echo esc_html( $total_soft_poll ); ?>);
		-webkit-box-shadow: 0 8px 6px -6px var(--tsp_section_box_c_<?php echo esc_html( $total_soft_poll ); ?>);
	}
	section.ts_poll_section_<?php echo esc_html( $total_soft_poll ); ?>[data-tsp-box="sh11"]{
		box-shadow: 0 0 18px 7px var(--tsp_section_box_c_<?php echo esc_html( $total_soft_poll ); ?>);
		-moz-box-shadow: 0 0 18px 7px var(--tsp_section_box_c_<?php echo esc_html( $total_soft_poll ); ?>);
		-webkit-box-shadow: 0 0 18px 7px var(--tsp_section_box_c_<?php echo esc_html( $total_soft_poll ); ?>);
	}
</style>
