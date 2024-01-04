<?php
/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * This file include image/video wb poll theme proporties.
 *
 * @link       TS Poll
 * @since      1.7.0
 *
 * @package    TS_Poll
 * @subpackage TS_Poll/public/theme_partials
 */

?>
<style type="text/css" id="tsp_styles_<?php echo esc_attr( $total_soft_poll ); ?>">
  :root{
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
  main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?> .tsp_video_popup_embed{
	  display:none !important;
  }
  main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?> > .ts_poll_answer:not(:last-child) {
	  margin-bottom: 5px;
  }

  main.ts_poll_main_<?php echo esc_html( $total_soft_poll ); ?>:not([data-tsp-color="Background"]) > .ts_poll_answer {
	  background-color: var(--tsp_answer_bgc_<?php echo esc_html( $total_soft_poll ); ?>);
  }
  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?>  > .ts_poll_answer {
	  position: relative;
	  width: 100%;
	  border-width: var(--tsp_answer_bw_<?php echo esc_html( $total_soft_poll ); ?>);
	  border-style:solid;
	  border-color:var(--tsp_answer_bc_<?php echo esc_html( $total_soft_poll ); ?>);
	  border-radius: var(--tsp_answer_br_<?php echo esc_html( $total_soft_poll ); ?>);
	  cursor: pointer;
	  overflow: hidden;
	  display: -ms-flexbox;
	  display: -webkit-flex;
	  display: flex;
	  -webkit-flex-direction: row;
	  -ms-flex-direction: row;
	  flex-direction: row;
	  -webkit-flex-wrap: nowrap;
	  -ms-flex-wrap: nowrap;
	  flex-wrap: nowrap;
	  -webkit-justify-content: flex-start;
	  -ms-flex-pack: start;
	  justify-content: flex-start;
	  -webkit-align-content: center;
	  -ms-flex-line-pack: center;
	  align-content: center;
	  -webkit-align-items: center;
	  -ms-flex-align: center;
	  align-items: center;
	  line-height: 1.2 !important;
  }
  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?>  > .ts_poll_answer:hover {
	  background-color: var(--tsp_answer_h_bgc_<?php echo esc_attr( $total_soft_poll ); ?>) !important;
  }
  :root{
	  /* Root for attachment aspect ratio proporty */
	  --tsp_attachment_w_<?php echo esc_attr( $total_soft_poll ); ?>:<?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_i_h"] ), FILTER_VALIDATE_INT ); ?>%;
	  --tsp_overlay_bgc_<?php echo esc_html( $total_soft_poll ); ?>:<?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_i_oc"] ), FILTER_SANITIZE_STRING ); ?>;
	  --tsp_overlay_c_<?php echo esc_html( $total_soft_poll ); ?>:<?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_i_ic"] ), FILTER_SANITIZE_STRING ); ?>;
	  --tsp_overlay_icon_s_<?php echo esc_html( $total_soft_poll ); ?>:<?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_i_is"] ), FILTER_VALIDATE_INT ); ?>px;
  }
  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?>  > .ts_poll_answer > .ts_poll_attachment{
	  width : var(--tsp_attachment_w_<?php echo esc_attr( $total_soft_poll ); ?>);
	  height:0;
	  position:relative;
  }
  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?>[data-tsp-ratio="1"] > .ts_poll_answer > .ts_poll_attachment,
  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?>[data-tsp-ratio="1"] > .ts_poll_answer > .ts_poll_vote
  {
	  padding-top: var(--tsp_attachment_w_<?php echo esc_attr( $total_soft_poll ); ?>);
  }
  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?>[data-tsp-ratio="2"] > .ts_poll_answer > .ts_poll_attachment,
  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?>[data-tsp-ratio="2"] > .ts_poll_answer > .ts_poll_vote
  {
	  padding-top: calc(calc(9/16) * var(--tsp_attachment_w_<?php echo esc_attr( $total_soft_poll ); ?>));
  }
  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?>[data-tsp-ratio="3"] > .ts_poll_answer > .ts_poll_attachment,
  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?>[data-tsp-ratio="3"] > .ts_poll_answer > .ts_poll_vote
  {
	  padding-top: calc(calc(16/9) * var(--tsp_attachment_w_<?php echo esc_attr( $total_soft_poll ); ?>));
  }
  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?>[data-tsp-ratio="4"] > .ts_poll_answer > .ts_poll_attachment,
  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?>[data-tsp-ratio="4"] > .ts_poll_answer > .ts_poll_vote
  {
	  padding-top: calc(calc(4/3) * var(--tsp_attachment_w_<?php echo esc_attr( $total_soft_poll ); ?>));
  }
  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?>[data-tsp-ratio="5"] > .ts_poll_answer > .ts_poll_attachment,
  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?>[data-tsp-ratio="5"] > .ts_poll_answer > .ts_poll_vote
  {
	  padding-top: calc(calc(3/4) * var(--tsp_attachment_w_<?php echo esc_attr( $total_soft_poll ); ?>));
  }
  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?>[data-tsp-ratio="6"] > .ts_poll_answer > .ts_poll_attachment,
  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?>[data-tsp-ratio="6"] > .ts_poll_answer > .ts_poll_vote
  {
	  padding-top: calc(calc(2/3) * var(--tsp_attachment_w_<?php echo esc_attr( $total_soft_poll ); ?>));
  }
  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?>[data-tsp-ratio="7"] > .ts_poll_answer > .ts_poll_attachment,
  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?>[data-tsp-ratio="7"] > .ts_poll_answer > .ts_poll_vote
  {
	  padding-top: calc(calc(3/2) * var(--tsp_attachment_w_<?php echo esc_attr( $total_soft_poll ); ?>));
  }
  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?>[data-tsp-ratio="8"] > .ts_poll_answer > .ts_poll_attachment,
  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?>[data-tsp-ratio="8"] > .ts_poll_answer > .ts_poll_vote
  {
	  padding-top: calc(calc(5/8) * var(--tsp_attachment_w_<?php echo esc_attr( $total_soft_poll ); ?>));
  }
  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?>[data-tsp-ratio="9"] > .ts_poll_answer > .ts_poll_attachment,
  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?>[data-tsp-ratio="9"] > .ts_poll_answer > .ts_poll_vote
  {
	  padding-top: calc(calc(8/5) * var(--tsp_attachment_w_<?php echo esc_attr( $total_soft_poll ); ?>));
  }
  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?>  > .ts_poll_answer > .ts_poll_attachment > img{
	  height: 100% !important;
	  width: 100%;
	  margin: 0 !important;
	  padding: 0 !important;
	  float: none !important;
	  position:absolute;
	  left:0;
	  top:0;
  }
  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?> > .ts_poll_answer > .ts_poll_vote{
	  width:calc(100% - var(--tsp_attachment_w_<?php echo esc_attr( $total_soft_poll ); ?>));
	  position:relative;
  }
  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?>  > .ts_poll_answer > .ts_poll_attachment > .ts_poll_overlay_div {
	  position: absolute;
	  width: 100%;
	  height: 100%;
	  top: 0;
	  left: 0;
	  background: var(--tsp_overlay_bgc_<?php echo esc_html( $total_soft_poll ); ?>);
	  z-index: -1;
	  opacity: 0;
  }
  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?>  > .ts_poll_answer > .ts_poll_attachment:hover > .ts_poll_overlay_div {
	  z-index: 999;
	  opacity: 1;
  }
  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?>  > .ts_poll_answer > .ts_poll_attachment span.ts_poll_overlay_span {
	  display: block;
	  width: 100%;
	  text-align: center;
	  position: relative;
	  top: 50%;
	  -ms-transform: translateY(-50%);
	  -webkit-transform: translateY(-50%);
	  -moz-transform: translateY(-50%);
	  -o-transform: translateY(-50%);
	  transform: translateY(-50%);
	  font-weight: 400 !important;
  }
  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?>  > .ts_poll_answer > .ts_poll_attachment i.ts_poll_overlay_icon {
	  color: var(--tsp_overlay_c_<?php echo esc_html( $total_soft_poll ); ?>);
	  font-size: var(--tsp_overlay_icon_s_<?php echo esc_html( $total_soft_poll ); ?>);
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
	  border-top-right-radius: calc( var(--tsp_answer_br_<?php echo esc_html( $total_soft_poll ); ?>) - 2px);
	  border-bottom-right-radius: calc( var(--tsp_answer_br_<?php echo esc_html( $total_soft_poll ); ?>) - 2px);
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
  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?> > .ts_poll_answer > .ts_poll_vote  > .ts_poll_e_vote{
	  position:absolute;
	  top:0;
	  right:0;
	  width: 100%;
	  height: 100%;
	  display: -ms-flexbox;display: -webkit-flex;display: flex;
	  -webkit-flex-direction: row;-ms-flex-direction: row;flex-direction: row;
	  -webkit-flex-wrap: nowrap;-ms-flex-wrap: nowrap;flex-wrap: nowrap;
	  -webkit-justify-content: flex-start;-ms-flex-pack: start;justify-content: flex-start;
	  -webkit-align-content: center;-ms-flex-line-pack: center;align-content: center;
	  -webkit-align-items: center;-ms-flex-align: center;align-items: center;
	  cursor:pointer;
  }

  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?> > .ts_poll_answer > .ts_poll_vote  > .ts_poll_e_vote > .ts_poll_answer_label{
	  display: inline-block;
	  float: none;
	  font-family: var(--tsp_answer_ff_<?php echo esc_html( $total_soft_poll ); ?>);
	  font-size: var(--tsp_answer_fs_<?php echo esc_html( $total_soft_poll ); ?>) !important;
	  cursor: pointer;
	  margin-bottom: 0px !important;
	  position: relative;
	  padding-left: 10px;
	  font-weight: 400 !important;
  }
  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?>:not([data-tsp-color="Color"]) > .ts_poll_answer > .ts_poll_vote  > .ts_poll_e_vote > .ts_poll_answer_label{
	  color: var(--tsp_answer_c_<?php echo esc_html( $total_soft_poll ); ?>) !important;
  }
  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?> > .ts_poll_answer:hover > .ts_poll_vote  > .ts_poll_e_vote > .ts_poll_answer_label{
	  color: var(--tsp_answer_h_c_<?php echo esc_html( $total_soft_poll ); ?>) !important;
  }

  main.ts_poll_main_<?php echo esc_attr( $total_soft_poll ); ?> > .ts_poll_answer input {
	  display: none !important;
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

  <?php if ( $tspoll_question_styles["ts_poll_pop_show"] == 'true' || $ts_poll_edit == 'true' ) { ?>
	:root{
		--tsp_popup_close_c_<?php echo esc_attr( $total_soft_poll ); ?> : <?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_pop_ic"] ), FILTER_SANITIZE_STRING ); ?>;
		--tsp_popup_bw_<?php echo esc_attr( $total_soft_poll ); ?> : <?php echo filter_var( $tspoll_question_styles["ts_poll_pop_bw"], FILTER_VALIDATE_INT ); ?>px;
		--tsp_popup_bc_<?php echo esc_attr( $total_soft_poll ); ?> : <?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_pop_bc"] ), FILTER_SANITIZE_STRING ); ?>;
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
	div.tsp_popup_attachment_<?php echo esc_html( $total_soft_poll ); ?> {
		position: absolute;
		top: 0;
		right: 0;
		bottom: 0;
		left: 0;
		width:100%;
		height:100%;
	}
	@media all and (max-width:400px) {
		div.tsp_popup_inner_<?php echo esc_html( $total_soft_poll ); ?> {
			max-width: 95vw;
			max-height: 95vh;
		}
	}
	div.tsp_popup_attachment_<?php echo esc_html( $total_soft_poll ); ?> > div > *{
		max-width: 100% !important;
		max-height: 100% !important;
		border:var(--tsp_popup_bw_<?php echo esc_attr( $total_soft_poll ); ?>) solid var(--tsp_popup_bc_<?php echo esc_attr( $total_soft_poll ); ?>);
	}
	div.tsp_popup_attachment_<?php echo esc_html( $total_soft_poll ); ?> > div {
    	width: 100%;
    	height: 0;
    	padding-bottom: 56.25%;
    	position: relative;
	}
	div.tsp_popup_attachment_<?php echo esc_html( $total_soft_poll ); ?> > div  > img{
		left: 50%;
		top: 50%;
		transform: translate(-50%, -50%);
		position: absolute;
		max-height: 100% !important;
		width: auto !important;
		height: auto !important;
	}
	div.tsp_popup_attachment_<?php echo esc_html( $total_soft_poll ); ?> > div  > *:not(img) {
		position: absolute;
   		height: 100%;
   		width: 100%;
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
</style>

<?php
  global $wp_embed;
  $tsp_main_ansers = '';
for ( $i = 0;$i < $ts_poll_answers_count;$i ++ ) {
	$TS_Poll_Question_Answer_Param =  $t_s_poll_answers_values[ $i ]["Answer_Param"];
	if ( array_key_exists( "TotalSoftPoll_Ans_Cl",$TS_Poll_Question_Answer_Param ) ) {
		$TS_Poll_Colors_Array[ $t_s_poll_answers_values[ $i ]["id"] ] = $TS_Poll_Question_Answer_Param["TotalSoftPoll_Ans_Cl"];
	}
	$tsp_main_ansers .= sprintf(
		"
      <div class='ts_poll_answer' data-tsp-id='%s'>
        <div class='ts_poll_attachment' >
          <img src='%s' alt='%s'>
          <div class='ts_poll_overlay_div'>
            <span class='ts_poll_overlay_span'>
              <i class='%s ts_poll_overlay_icon'></i>
            </span>
          </div>
        </div>
        <div class='ts_poll_vote'>
          %s
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
      </div>",
		esc_attr( $t_s_poll_answers_values[ $i ]["id"] ),
		$TS_Poll_Question_Answer_Param["TotalSoftPoll_Ans_Im"] == '' ? esc_url( plugins_url( 'img/tsp_no_img.jpg', __DIR__ ) ) : esc_url( $TS_Poll_Question_Answer_Param["TotalSoftPoll_Ans_Im"] ),
		esc_html( html_entity_decode( htmlspecialchars_decode( $t_s_poll_answers_values[ $i ]["Answer_Title"] ), ENT_QUOTES ) ),
		esc_html( $tspoll_question_styles["ts_poll_i_it"] ),
		sprintf( "<input type='radio' class='ts_poll_answer_input' id='%s' name='%s' value='%s'> <label class='ts_poll_e_vote' for='%s'><span class='ts_poll_answer_label'>%s</span></label>", 'ts_poll_answer_input_' . esc_attr( $total_soft_poll ) . '-' . esc_attr( $i + 1 ), 'ts_poll_all' . esc_attr( $total_soft_poll ), esc_attr( $t_s_poll_answers_values[ $i ]["id"] ), 'ts_poll_answer_input_' . esc_attr( $total_soft_poll ) . '-' . esc_attr( $i + 1 ), esc_html( html_entity_decode( htmlspecialchars_decode( $t_s_poll_answers_values[ $i ]["Answer_Title"] ), ENT_QUOTES ) ) ),
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
          data-tsp-ratio='%s'
          data-tsp-color='%s'
          data-tsp-voted='%s'
          data-tsp-veff='%s'>
      %s
      <div class='%s'></div>
    </main>",
	'ts_poll_main_' . esc_attr( $total_soft_poll ),
	esc_attr( $tspoll_question_styles["ts_poll_i_ra"] ),
	esc_attr( $tspoll_question_styles["ts_poll_a_ca"] ),
	esc_attr( $tspoll_question_styles["ts_poll_v_ca"] ),
	filter_var( esc_html( $tspoll_question_styles["ts_poll_v_eff"] ), FILTER_VALIDATE_INT ),
	$tsp_main_ansers,
	'ts_poll_after_line_' . esc_attr( $total_soft_poll )
);
if ( $tspoll_question_styles["ts_poll_pop_show"] == 'true' || $ts_poll_edit == 'true' ) {
	echo sprintf(
		'
      <section class="tsp_popup_question_%1$s tsp_flex_col tsp_popup_question_fixed" style="display:none;">
        <div class="tsp_popup_inner_%1$s tsp_flex_col">
          <div class="tsp_popup_attachment_%1$s tsp_flex_col">
            <img >
          </div>
        </div>
        <div class="tsp_popup_inner_close_%1$s tsp_flex_col">
          <i class="tsp_popup_close_icon_%1$s  %2$s"></i>
        </div>
      </section>
    ',
		esc_attr( $total_soft_poll ),
		esc_attr( $tspoll_question_styles["ts_poll_pop_it"] )
	);
}
?>
