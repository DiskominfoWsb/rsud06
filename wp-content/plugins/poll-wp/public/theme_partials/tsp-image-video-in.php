<?php
/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * This file include image/video in question poll theme proporties.
 *
 * @link       TS Poll
 * @since      1.7.0
 *
 * @package    TS_Poll
 * @subpackage TS_Poll/public/theme_partials
 */
?>

<style type="text/css" id="tsp_styles_<?php echo esc_attr( $total_soft_poll ); ?>">
  <?php if ( $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Image in Question' ) { ?>
	/* Root for image sizing */
	:root{
		--tsp_attachment_w_<?php echo esc_html( $total_soft_poll ); ?> : <?php echo filter_var( $tspoll_question_styles["ts_poll_i_h"], FILTER_VALIDATE_INT ); ?>%;
	}
	header.ts_poll_header_<?php echo esc_attr( $total_soft_poll ); ?> > div.ts_poll_img_div_<?php echo esc_attr( $total_soft_poll ); ?> {
		width: var(--tsp_attachment_w_<?php echo esc_html( $total_soft_poll ); ?>); 
		position:relative;
		margin-bottom : 5px;
	}
	header.ts_poll_header_<?php echo esc_attr( $total_soft_poll ); ?> > div.ts_poll_img_div_<?php echo esc_attr( $total_soft_poll ); ?>[data-tsp-ratio="1"]{
		padding-top:var(--tsp_attachment_w_<?php echo esc_html( $total_soft_poll ); ?>);
	}
	header.ts_poll_header_<?php echo esc_attr( $total_soft_poll ); ?> > div.ts_poll_img_div_<?php echo esc_attr( $total_soft_poll ); ?>[data-tsp-ratio="2"]{
		padding-top:calc(var(--tsp_attachment_w_<?php echo esc_html( $total_soft_poll ); ?>) * 9/16);
	}
	header.ts_poll_header_<?php echo esc_attr( $total_soft_poll ); ?> > div.ts_poll_img_div_<?php echo esc_attr( $total_soft_poll ); ?>[data-tsp-ratio="3"]{
		padding-top:calc(var(--tsp_attachment_w_<?php echo esc_html( $total_soft_poll ); ?>) * 16/9);
	}
	header.ts_poll_header_<?php echo esc_attr( $total_soft_poll ); ?> > div.ts_poll_img_div_<?php echo esc_attr( $total_soft_poll ); ?>[data-tsp-ratio="4"]{
		padding-top:calc(var(--tsp_attachment_w_<?php echo esc_html( $total_soft_poll ); ?>) * 4/3);
	}
	header.ts_poll_header_<?php echo esc_attr( $total_soft_poll ); ?> > div.ts_poll_img_div_<?php echo esc_attr( $total_soft_poll ); ?>[data-tsp-ratio="5"]{
		padding-top:calc(var(--tsp_attachment_w_<?php echo esc_html( $total_soft_poll ); ?>) * 3/4);
	}
	header.ts_poll_header_<?php echo esc_attr( $total_soft_poll ); ?> > div.ts_poll_img_div_<?php echo esc_attr( $total_soft_poll ); ?>[data-tsp-ratio="6"]{
		padding-top:calc(var(--tsp_attachment_w_<?php echo esc_html( $total_soft_poll ); ?>) * 2/3);
	}
	header.ts_poll_header_<?php echo esc_attr( $total_soft_poll ); ?> > div.ts_poll_img_div_<?php echo esc_attr( $total_soft_poll ); ?>[data-tsp-ratio="7"]{
		padding-top:calc(var(--tsp_attachment_w_<?php echo esc_html( $total_soft_poll ); ?>) * 3/2);
	}
	header.ts_poll_header_<?php echo esc_attr( $total_soft_poll ); ?> > div.ts_poll_img_div_<?php echo esc_attr( $total_soft_poll ); ?>[data-tsp-ratio="8"]{
		padding-top:calc(var(--tsp_attachment_w_<?php echo esc_html( $total_soft_poll ); ?>) * 5/8);
	}
	header.ts_poll_header_<?php echo esc_attr( $total_soft_poll ); ?> > div.ts_poll_img_div_<?php echo esc_attr( $total_soft_poll ); ?>[data-tsp-ratio="9"]{
		padding-top:calc(var(--tsp_attachment_w_<?php echo esc_html( $total_soft_poll ); ?>) * 8/5);
	}
	header.ts_poll_header_<?php echo esc_attr( $total_soft_poll ); ?> > div.ts_poll_img_div_<?php echo esc_attr( $total_soft_poll ); ?> > img{
		width:100%;
		height:100%;
		background-size:100% 100%;
		position: absolute;
		left: 0;
		top: 0;
		right: 0;
		bottom: 0; 
	}
	section.ts_poll_section_<?php echo esc_html( $total_soft_poll ); ?>[max-width~="500px"]  {
		--tsp_attachment_w_<?php echo esc_attr( $total_soft_poll ); ?> : 100%;
	}
  <?php } else { ?>
	:root{
		--tsp_video_w_<?php echo esc_html( $total_soft_poll ); ?> : <?php echo filter_var( $tspoll_question_styles["ts_poll_v_w"], FILTER_VALIDATE_INT ); ?>%;
	}
	header.ts_poll_header_<?php echo esc_attr( $total_soft_poll ); ?> div.ts_poll_video_div_<?php echo $total_soft_poll; ?> {
		position: relative;
		width: var(--tsp_video_w_<?php echo esc_html( $total_soft_poll ); ?>); 
		margin-bottom : 5px;
	}
	header.ts_poll_header_<?php echo esc_attr( $total_soft_poll ); ?> div.ts_poll_iframe_div_<?php echo $total_soft_poll; ?> {
		position: relative;
		width: 100%;
		padding-top: 56.25%;
		margin-bottom : 5px;
	}  
	header.ts_poll_header_<?php echo esc_attr( $total_soft_poll ); ?> div.ts_poll_iframe_div_<?php echo $total_soft_poll; ?> > iframe,
	header.ts_poll_header_<?php echo esc_attr( $total_soft_poll ); ?> div.ts_poll_iframe_div_<?php echo $total_soft_poll; ?> > video,
	header.ts_poll_header_<?php echo esc_attr( $total_soft_poll ); ?> div.ts_poll_iframe_div_<?php echo $total_soft_poll; ?> > img,
	header.ts_poll_header_<?php echo esc_attr( $total_soft_poll ); ?> div.ts_poll_iframe_div_<?php echo $total_soft_poll; ?> > div
	 {
		position: absolute;
		top: 0;
		left: 0;
		right:0;
		bottom:0;
		width: 100%;
		height: 100%;
		max-width: 100% !important;
		max-height: 100% !important;
	}
	section.ts_poll_section_<?php echo esc_html( $total_soft_poll ); ?>[max-width~="500px"]  {
		--tsp_video_w_<?php echo esc_attr( $total_soft_poll ); ?> : 100%;
	}
  <?php } ?>
  :root{
	  --tsp_checkbox_size_<?php echo esc_attr( $total_soft_poll ); ?>:<?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_ch_s"] ), FILTER_VALIDATE_INT ); ?>px;;
	  --tsp_answer_bw_<?php echo esc_html( $total_soft_poll ); ?>:<?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_a_bw"] ), FILTER_VALIDATE_INT ); ?>px;
	  --tsp_answer_br_<?php echo esc_html( $total_soft_poll ); ?>:<?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_a_br"] ), FILTER_VALIDATE_INT ); ?>px;
	  --tsp_answer_bc_<?php echo esc_html( $total_soft_poll ); ?>:<?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_a_bc"] ), FILTER_SANITIZE_STRING ); ?>;
	  --tsp_block_bgc_<?php echo esc_html( $total_soft_poll ); ?>:<?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_v_mbgc"] ), FILTER_SANITIZE_STRING ); ?>;
	  --tsp_progress_bgc_<?php echo esc_html( $total_soft_poll ); ?>:<?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_v_bgc"] ), FILTER_SANITIZE_STRING ); ?>;
	  --tsp_progress_c_<?php echo esc_html( $total_soft_poll ); ?>:<?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_v_c"] ), FILTER_SANITIZE_STRING ); ?>;

  }
  section.ts_poll_section_<?php echo esc_html( $total_soft_poll ); ?> > main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?> {
	  position: relative;
	  width:100%;
	  display: -ms-flexbox;display: -webkit-flex;display: flex;
	  -webkit-flex-direction: column;-ms-flex-direction: column;flex-direction: column;
	  -webkit-flex-wrap: nowrap;-ms-flex-wrap: nowrap;flex-wrap: nowrap;
	  -webkit-justify-content: center;-ms-flex-pack: center;justify-content: center;
	  -webkit-align-items: center;-ms-flex-align: center;align-items: center;
	  background-color: var(--tsp_main_bgc_<?php echo esc_html( $total_soft_poll ); ?>);
	  width:100%;
	  padding: 5px 10px;
  }
  main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?> > .ts_poll_answer:not(:last-child) {
	  margin-bottom: 3px;
  }
  main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>:not([data-tsp-color="Background"]) > .ts_poll_answer {
	  background-color: var(--tsp_answer_bgc_<?php echo esc_html( $total_soft_poll ); ?>);
  }
  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?>  > .ts_poll_answer {
	  position: relative;
	  width: 100%;
	  border-radius: var(--tsp_answer_br_<?php echo esc_html( $total_soft_poll ); ?>);
	  line-height: 1.2 !important;
  }
  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?>  > .ts_poll_answer .ts_poll_answer_label{
	  width: 100%;
	  line-height: 1.5;
	  padding: 7px 10px;
	  margin-bottom:0 !important;
	  float: none;
	  display: -webkit-box;
	  display: -moz-box;
	  display: -ms-inline-flexbox;
	  display: -webkit-inline-flex;
	  display: inline-flex;
	  -webkit-box-direction: normal;
	  -moz-box-direction: normal;
	  -webkit-box-orient: horizontal;
	  -moz-box-orient: horizontal;
	  -webkit-flex-direction: row;
	  -ms-flex-direction: row;
	  flex-direction: row;
	  -webkit-flex-wrap: nowrap;
	  -ms-flex-wrap: nowrap;
	  flex-wrap: nowrap;
	  -webkit-box-pack: start;
	  -moz-box-pack: start;
	  -webkit-justify-content: flex-start;
	  -ms-flex-pack: start;
	  justify-content: flex-start;
	  -webkit-align-content: center;
	  -ms-flex-line-pack: center;
	  align-content: center;
	  -webkit-box-align: center;
	  -moz-box-align: center;
	  -webkit-align-items: center;
	  -ms-flex-align: center;
	  align-items: center;
  }
  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?>  > .ts_poll_answer:hover {
	  background-color: var(--tsp_answer_h_bgc_<?php echo esc_html( $total_soft_poll ); ?>) !important;
  }
  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?>  > .ts_poll_answer:hover .ts_poll_answer_label {
	  color: var(--tsp_answer_h_c_<?php echo esc_html( $total_soft_poll ); ?>) !important;
  }
  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?> > .ts_poll_answer input {
	  display: none;
  }
  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?> > .ts_poll_answer input + label {
	  font-size: var(--tsp_answer_fs_<?php echo esc_html( $total_soft_poll ); ?>) !important;
	  cursor: pointer;
	  margin-bottom: 0px !important;
	  font-family: var(--tsp_answer_ff_<?php echo esc_html( $total_soft_poll ); ?>);
  }
  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?>:not([data-tsp-color="Color"]) > .ts_poll_answer input + label {
	  color: var(--tsp_answer_c_<?php echo esc_html( $total_soft_poll ); ?>) !important;
  }
  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?> > .ts_poll_answer input + label:before {
	  margin: 0 .25em 0 0 !important;
	  padding: 0 !important;
	  font-size: var(--tsp_checkbox_size_<?php echo esc_attr( $total_soft_poll ); ?>) !important;
	  font-family: FontAwesome !important;
  }
  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?> > .ts_poll_answer input:not(:checked) + label:before {
	  color: var(--tsp_before_check_c_<?php echo esc_html( $total_soft_poll ); ?>) !important;
	  content: var(--tsp_before_check_<?php echo esc_html( $total_soft_poll ); ?>);
  }
  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?> > .ts_poll_answer input:checked + label:before {
	  color: var(--tsp_after_check_c_<?php echo esc_html( $total_soft_poll ); ?>) !important;
	  content: var(--tsp_after_check_<?php echo esc_html( $total_soft_poll ); ?>);
  }
  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?>  > .ts_poll_answer input:checked + label:after {
	  font-weight: bold;
  }
  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?>  > .ts_poll_answer span.ts_poll_r_block{
	  position: absolute;
	  display: inline-block;
	  overflow: hidden;
	  top: 0;
	  left: 0;
	  width:100%;
	  height: 100%;
	  background: var(--tsp_block_bgc_<?php echo esc_html( $total_soft_poll ); ?>) !important;
	  border-radius: calc( var(--tsp_answer_br_<?php echo esc_html( $total_soft_poll ); ?>) - 3px);
	  opacity: 0;
	  z-index: -1;
	  cursor: default;
  }
  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?>  > .ts_poll_answer span.ts_poll_r_inner {
	  position: relative;
	  display: inline-block;
	  top: 0;
	  left: 0;
	  width: 100%;
	  height: 100%;
	  border-radius: calc( var(--tsp_answer_br_<?php echo esc_html( $total_soft_poll ); ?>) - 3px);
  }
  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?>  > .ts_poll_answer span.ts_poll_r_progress {
	  position: absolute;
	  display: inline-block;
	  top: 0;
	  left: 0;
	  height: 100%;
	  min-width: 10px !important;
	  border-radius: calc( var(--tsp_answer_br_<?php echo esc_html( $total_soft_poll ); ?>) - 2px);
  }
  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?>:not([data-tsp-voted="Background"]) > .ts_poll_answer span.ts_poll_r_progress{
	  background-color: var(--tsp_progress_bgc_<?php echo esc_html( $total_soft_poll ); ?>) !important;
  }
  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?>  > .ts_poll_answer label.ts_poll_r_label{
	  position: absolute;
	  display: -ms-inline-flexbox;
	  display: -webkit-inline-flex;
	  display: inline-flex;
	  -webkit-flex-direction: row;
	  -ms-flex-direction: row;
	  flex-direction: row;
	  -webkit-flex-wrap: wrap;
	  -ms-flex-wrap: wrap;
	  flex-wrap: wrap;
	  -webkit-justify-content: space-between;
	  -ms-flex-pack: justify;
	  justify-content: space-between;
	  -webkit-align-content: center;
	  -ms-flex-line-pack: center;
	  align-content: center;
	  -webkit-align-items: center;
	  -ms-flex-align: center;
	  align-items: center;
	  top: 0;
	  left: 0;
	  width: 100%;
	  height: 100%;
	  padding: 10px;
	  font-family: var(--tsp_answer_ff_<?php echo esc_html( $total_soft_poll ); ?>);
	  font-size: var(--tsp_answer_fs_<?php echo esc_html( $total_soft_poll ); ?>);
	  margin-bottom:0px;
  }
  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?>:not([data-tsp-voted="Color"]) > .ts_poll_answer label.ts_poll_r_label{
	  color: var(--tsp_progress_c_<?php echo esc_html( $total_soft_poll ); ?>) !important;
  }
  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?>  > .ts_poll_answer label.ts_poll_r_label span.ts_poll_r_info{
	  margin-left: auto;
	  line-height: 1 !important;
  }

</style>

<?php $tsp_main_answers = '';
for ( $i = 0;$i < $ts_poll_answers_count;$i ++ ) {
	$TS_Poll_Question_Answer_Param = $t_s_poll_answers_values[ $i ]["Answer_Param"];
	if ( array_key_exists( "TotalSoftPoll_Ans_Cl", $TS_Poll_Question_Answer_Param ) ) {
		$TS_Poll_Colors_Array[ $t_s_poll_answers_values[ $i ]["id"] ] = $TS_Poll_Question_Answer_Param["TotalSoftPoll_Ans_Cl"];
	}
	$tsp_main_answers .= sprintf(
		"
    <div class='ts_poll_answer' data-tsp-id='%s'>
      <input type='radio' class='ts_poll_answer_input'
            id='%s'
            name='%s'
            value='%s'>
      <label class='ts_poll_answer_label %s' for='%s'>
          %s
      </label>
      <span class='ts_poll_r_block'>
        <span class='ts_poll_r_inner'>
          <span class='ts_poll_r_progress' data-tsp-length='%d'></span>
          <label class='ts_poll_r_label'>
            %s
            <span class='ts_poll_r_info'>
              %s
            </span>
          </label>
        </span>
      </span>
    </div>        
    ",
		esc_attr( $t_s_poll_answers_values[ $i ]["id"] ),
		'ts_poll_answer_input_' . esc_attr( $total_soft_poll ) . '-' . esc_attr( $i + 1 ),
		'ts_poll_all' . esc_attr( $total_soft_poll ),
		esc_attr( $t_s_poll_answers_values[ $i ]["id"] ),
		$tspoll_question_styles["ts_poll_vb_show"] != 'true' ? 'ts_poll_e_vote' : '',
		'ts_poll_answer_input_' . esc_attr( $total_soft_poll ) . '-' . esc_attr( $i + 1 ),
		esc_html( html_entity_decode( htmlspecialchars_decode( $t_s_poll_answers_values[ $i ]["Answer_Title"] ), ENT_QUOTES ) ),
		$t_s_poll_question_settings["TotalSoft_Poll_Set_01"] == 'true' ? esc_html( round( (int) $t_s_poll_answers_values[ $i ]["Answer_Votes"] * 100 / (int) $total_soft_poll_res_count, 2 ) ) : 100,
		$tspoll_question_styles["ts_poll_v_t"] == 'countlab' || $tspoll_question_styles["ts_poll_v_t"] == 'percentlab' || $tspoll_question_styles["ts_poll_v_t"] == 'bothlab' ? esc_html( html_entity_decode( htmlspecialchars_decode( $t_s_poll_answers_values[ $i ]["Answer_Title"] ), ENT_QUOTES ) ) : '',
		$this->ts_poll_show_type(
			array(
				'tsp_show_results'   => $t_s_poll_question_settings["TotalSoft_Poll_Set_01"],
				'tsp_no_result_text' => $t_s_poll_question_settings["TotalSoft_Poll_Set_05"],
				'tsp_show_by'        => $tspoll_question_styles["ts_poll_v_t"],
				'tsp_total_votes'    => $total_soft_poll_res_count,
				'tsp_answer_votes'   => $t_s_poll_answers_values[ $i ]["Answer_Votes"],
			)
		)
	);
}
echo sprintf(
	"
  <main class='%s'
        data-tsp-color='%s'
        data-tsp-voted='%s'
        data-tsp-veff='%s'>
    %s    
    <div class='%s'></div>
  </main>",
	'ts_poll_main_' . esc_attr( $total_soft_poll ),
	esc_attr( $tspoll_question_styles["ts_poll_a_ca"] ),
	esc_attr( $tspoll_question_styles["ts_poll_v_ca"] ),
	filter_var( esc_html( $tspoll_question_styles["ts_poll_v_eff"] ), FILTER_VALIDATE_INT ),
	$tsp_main_answers,
	'ts_poll_after_line_' . esc_attr( $total_soft_poll )
); ?>
