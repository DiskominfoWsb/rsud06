<style type="text/css" id="tsp_cs_styles_<?php echo esc_attr( $total_soft_poll ); ?>">
	:root{
		/* Root for coming soon */
		--tsp_coming_bgc_<?php echo esc_html( $total_soft_poll ); ?>:<?php echo filter_var( esc_html( $t_s_poll_question_settings["TotalSoft_Poll_Set_06"] ), FILTER_SANITIZE_STRING ); ?>;
		--tsp_coming_c_<?php echo esc_html( $total_soft_poll ); ?>:<?php echo filter_var( esc_html( $t_s_poll_question_settings["TotalSoft_Poll_Set_07"] ), FILTER_SANITIZE_STRING ); ?>;
		--tsp_coming_fs_<?php echo esc_html( $total_soft_poll ); ?>:<?php echo filter_var( esc_html( $t_s_poll_question_settings["TotalSoft_Poll_Set_08"] ), FILTER_VALIDATE_INT ); ?>px;
		--tsp_coming_ff_<?php echo esc_html( $total_soft_poll ); ?>:<?php echo filter_var( esc_html( $t_s_poll_question_settings["TotalSoft_Poll_Set_09"] ), FILTER_SANITIZE_STRING ); ?>;
	}
	span.ts_poll_cs_<?php echo esc_attr( $total_soft_poll ); ?> {
		background-color: var(--tsp_coming_bgc_<?php echo esc_attr( $total_soft_poll ); ?>);
		text-align: center;
		width: 100%;
		height: 100%;
		line-height: 1;
		display: -ms-flexbox;display: -webkit-flex;display: flex;
		-webkit-align-content: center;-ms-flex-line-pack: center;align-content: center;
		-webkit-align-items: center;-ms-flex-align: center;align-items: center;
		-webkit-flex-direction: column;-ms-flex-direction: column;flex-direction: column;
	}
	span.ts_poll_cs_text_<?php echo esc_attr( $total_soft_poll ); ?> {
		color: var(--tsp_coming_c_<?php echo esc_attr( $total_soft_poll ); ?>);
		font-size: var(--tsp_coming_fs_<?php echo esc_attr( $total_soft_poll ); ?>);
		font-family: var(--tsp_coming_ff_<?php echo esc_attr( $total_soft_poll ); ?>);
		cursor: default;
		padding: 110px 0;
	}
</style>
