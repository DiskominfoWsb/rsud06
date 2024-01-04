<?php
$tsp_content_special_style = ":root{";
foreach ( $TS_Poll_Colors_Array as $key => $value ) :
	$tsp_content_special_style .= sprintf(
		'--tsp_a_c_%1$s-%2$s : %3$s;',
		esc_html( $total_soft_poll ),
		esc_html( $key ),
		esc_attr( $value )
	);
endforeach;
$tsp_content_special_style .= "}";

if ( $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Standart Poll' || $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Standard Poll' ) {
	foreach ( $TS_Poll_Colors_Array as $key => $value ) :
		$tsp_content_special_style .= sprintf(
			' 
            main.ts_poll_r_main_%1$s[data-tsp-bool="false"] > .ts_poll_answer_result[data-tsp-id="%2$s"] > .ts_poll_answer_result_label > .ts_poll_answer_percent_line{
                background-color: var(--tsp_a_c_%1$s-%2$s);
            }
            main.ts_poll_main_%1$s[data-tsp-bool="false"] > .ts_poll_answer[data-tsp-id="%2$s"] > .ts_poll_answer_label {
                color: var(--tsp_a_c_%1$s-%2$s);
            }
            ',
			esc_html( $total_soft_poll ),
			esc_html( $key )
		);
	endforeach;
} elseif ( $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Image Poll' || $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Video Poll' ) {
	foreach ( $TS_Poll_Colors_Array as $key => $value ) :
		$tsp_content_special_style .= sprintf(
			'
            	main.ts_poll_main_%1$s[data-tsp-color="Background"] > .ts_poll_answer[data-tsp-id="%2$s"] > .ts_poll_before_div{
            	    background: var(--tsp_a_c_%1$s-%2$s);
            	}
            	main.ts_poll_main_%1$s[data-tsp-color="Color"] > .ts_poll_answer[data-tsp-id="%2$s"]  .ts_poll_answer_label{
            	    color: var(--tsp_a_c_%1$s-%2$s);
            	}
            ',
			esc_html( $total_soft_poll ),
			esc_html( $key )
		);
	endforeach;
} elseif ( $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Standart Without Button' || $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Standard Without Button' ||
		 $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Image Without Button' || $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Video Without Button' ||
		 $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Image in Question' || $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Video in Question' ) {
	foreach ( $TS_Poll_Colors_Array as $key => $value ) :
		$tsp_content_special_style .= sprintf(
			' 
            main.ts_poll_main_%1$s[data-tsp-color="Background"] > .ts_poll_answer[data-tsp-id="%2$s"]{
                background-color: var(--tsp_a_c_%1$s-%2$s);
            }
            main.ts_poll_main_%1$s[data-tsp-color="Color"] > .ts_poll_answer[data-tsp-id="%2$s"] .ts_poll_answer_label{
                color: var(--tsp_a_c_%1$s-%2$s);
            }
            main.ts_poll_main_%1$s[data-tsp-voted="Background"] > .ts_poll_answer[data-tsp-id="%2$s"]  span.ts_poll_r_progress{
                background-color: var(--tsp_a_c_%1$s-%2$s);
            }
            main.ts_poll_main_%1$s[data-tsp-voted="Color"] > .ts_poll_answer[data-tsp-id="%2$s"]  label.ts_poll_r_label{
                color: var(--tsp_a_c_%1$s-%2$s);
            }
            ',
			esc_html( $total_soft_poll ),
			esc_html( $key )
		);
	endforeach;
}
wp_register_style( "ts_poll_special_colors_stylesheet_{$total_soft_poll}", false );
wp_enqueue_style( "ts_poll_special_colors_stylesheet_{$total_soft_poll}" );
wp_add_inline_style( "ts_poll_special_colors_stylesheet_{$total_soft_poll}", $tsp_content_special_style );