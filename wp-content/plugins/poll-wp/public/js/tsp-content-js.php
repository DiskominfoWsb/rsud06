<?php
	$tsp_content_js = $tsp_content_js_block = $tsp_content_js_code = '';
switch ( $ts_poll_question_params["TS_Poll_Q_Theme"] ) {
	case 'Image Poll':
	case 'Video Poll':
		if ( $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Video Poll' ) {
			global $wp_embed;
			remove_all_filters( 'embed_oembed_html', 10 );
			$tsp_embeds_arr = array();
			for ( $i = 0;$i < $ts_poll_answers_count;$i++ ) {
				$tsp_embed_inner               = '';
				$TS_Poll_Question_Answer_Param = $t_s_poll_answers_values[ $i ]["Answer_Param"];
				$tsp_embed_inner               = sprintf(
					'
					  <div class="tsp_embed_popup_inner_%s tsp_video_popup_embed">
						  %s
					  </div>',
					esc_attr( $t_s_poll_answers_values[ $i ]["id"] ),
					$TS_Poll_Question_Answer_Param["TotalSoftPoll_Ans_Vd"] == '' ? sprintf( '<img src="%s" alt="No Video avaible">', esc_url( plugin_dir_url( __DIR__ ) . '/img/tsp_no_video.png' ) ) : do_shortcode( $wp_embed->run_shortcode( '[embed]' . esc_url( $TS_Poll_Question_Answer_Param["TotalSoftPoll_Ans_Vd"] ) . '[/embed]' ) )
				);
				$tsp_embeds_arr[ 'tsp_embed_id_' . $t_s_poll_answers_values[ $i ]["id"] ] = $tsp_embed_inner;
			}
			wp_localize_script( "ts_poll_js_{$total_soft_poll}", "ts_poll_data_{$total_soft_poll}", array( "tsp_embed_array_{$total_soft_poll}" => $tsp_embeds_arr ) );
			$tsp_content_js_code .= sprintf(
				'
  				$(document).on("click", `main.ts_poll_main_%1$s > .ts_poll_answer .ts_poll_video_overlay`, function() {
  				  	var tsp_click_id = $(this).attr("data-tsp-video");
  				  	$(`div.tsp_popup_attachment_%1$s`).html(ts_poll_data_%1$s.tsp_embed_array_%1$s[`tsp_embed_id_${tsp_click_id}`]);
  				  	$(`section.tsp_popup_question_%1$s`).css("display", "flex").hide().fadeIn(2000);            
  				  	$(document).mouseup(function(e) {
  				    	if (!$(`div.tsp_popup_attachment_%1$s >`).is(e.target) && $(`div.tsp_popup_attachment_%1$s >`).has(e.target).length === 0) {
  				    	 $(`section.tsp_popup_question_%1$s`).fadeOut("slow"); $(`div.tsp_popup_attachment_%1$s`).html("");
					      }
  				  	});
  				});
					',
				esc_js( $total_soft_poll )
			);
		}
		$tsp_data_effect = $tsp_data_back_effect = '';
		if ( $tspoll_question_styles["ts_poll_rb_show"] == 'true' || $ts_poll_can_vote === true ) {
			switch ( $tspoll_question_styles["ts_poll_p_a_veff"] ) {
				case '0':
					$tsp_data_effect      = sprintf( '$(`main.ts_poll_main_%1$s > .ts_poll_answer > .ts_poll_after_div`).css("display", "flex");', esc_attr( $total_soft_poll ) );
					$tsp_data_back_effect = sprintf( '$(`main.ts_poll_main_%1$s > .ts_poll_answer > .ts_poll_after_div`).css("display", "none");', esc_attr( $total_soft_poll ) );
					break;
				case '1':
					$tsp_data_effect      = sprintf(
						'
              $(`main.ts_poll_main_%1$s > .ts_poll_answer > .ts_poll_before_div`).css({
                "transform": "rotateY(-90deg)", "-ms-transform": "rotateY(-90deg)", "-o-transform": "rotateY(-90deg)", "-moz-transform": "rotateY(-90deg)", "-webkit-transform": "rotateY(-90deg)"
              });
              setTimeout(function() {
                $(`main.ts_poll_main_%1$s > .ts_poll_answer > .ts_poll_before_div`).css({
                  "transform": "rotateY(2deg)","-ms-transform": "rotateY(2deg)","-o-transform": "rotateY(2deg)","-moz-transform": "rotateY(2deg)","-webkit-transform": "rotateY(2deg)"
                });
                $(`main.ts_poll_main_%1$s > .ts_poll_answer > .ts_poll_after_div`).css({
                  "transform": "rotateY(2deg)", "-ms-transform": "rotateY(2deg)", "-o-transform": "rotateY(2deg)", "-moz-transform": "rotateY(2deg)", "-webkit-transform": "rotateY(2deg)"
                });
              }, 500);
             ',
						esc_attr( $total_soft_poll )
					);
					$tsp_data_back_effect = sprintf(
						'
              $(`main.ts_poll_main_%1$s > .ts_poll_answer > .ts_poll_before_div`).css({
                "transform": "rotateY(-90deg)","-ms-transform": "rotateY(-90deg)","-o-transform": "rotateY(-90deg)","-moz-transform": "rotateY(-90deg)","-webkit-transform": "rotateY(-90deg)"
              });
              $(`main.ts_poll_main_%1$s > .ts_poll_answer > .ts_poll_after_div`).css({
                "transform": "rotateY(-90deg)","-ms-transform": "rotateY(-90deg)","-o-transform": "rotateY(-90deg)","-moz-transform": "rotateY(-90deg)","-webkit-transform": "rotateY(-90deg)"
              });
              setTimeout(function() {
                $(`main.ts_poll_main_%1$s > .ts_poll_answer > .ts_poll_before_div`).css({
                    "transform": "rotateY(2deg)","-ms-transform": "rotateY(2deg)","-o-transform": "rotateY(2deg)","-moz-transform": "rotateY(2deg)","-webkit-transform": "rotateY(2deg)"
                });
              }, 500);
              ',
						esc_attr( $total_soft_poll )
					);
					break;
				case '2':
					$tsp_data_effect      = sprintf(
						'
              $(`main.ts_poll_main_%1$s > .ts_poll_answer > .ts_poll_before_div`).css({
               "transform": "rotateX(-90deg)","-ms-transform": "rotateX(-90deg)","-o-transform": "rotateX(-90deg)","-moz-transform": "rotateX(-90deg)","-webkit-transform": "rotateX(-90deg)"
              });
              setTimeout(function() {
                $(`main.ts_poll_main_%1$s > .ts_poll_answer > .ts_poll_before_div`).css({
                  "transform": "rotateX(0deg)","-ms-transform": "rotateX(0deg)","-o-transform": "rotateX(0deg)","-moz-transform": "rotateX(0deg)","-webkit-transform": "rotateX(2deg)"
                });
                $(`main.ts_poll_main_%1$s > .ts_poll_answer > .ts_poll_after_div`).css({
                  "transform": "rotateX(0deg)","-ms-transform": "rotateX(0deg)","-o-transform": "rotateX(0deg)","-moz-transform": "rotateX(0deg)","-webkit-transform": "rotateX(2deg)"
                });
              }, 500);
              ',
						esc_attr( $total_soft_poll )
					);
					$tsp_data_back_effect = sprintf(
						'
              $(`main.ts_poll_main_%1$s > .ts_poll_answer > .ts_poll_before_div`).css({
                "transform": "rotateX(-90deg)","-ms-transform": "rotateX(-90deg)","-o-transform": "rotateX(-90deg)","-moz-transform": "rotateX(-90deg)","-webkit-transform": "rotateX(-90deg)"
              });
              $(`main.ts_poll_main_%1$s > .ts_poll_answer > .ts_poll_after_div`).css({
                "transform": "rotateX(-90deg)","-ms-transform": "rotateX(-90deg)","-o-transform": "rotateX(-90deg)","-moz-transform": "rotateX(-90deg)","-webkit-transform": "rotateX(-90deg)"
              });
              setTimeout(function() {
                $(`main.ts_poll_main_%1$s > .ts_poll_answer > .ts_poll_before_div`).css({
                  "transform": "rotateX(0deg)","-ms-transform": "rotateX(0deg)","-o-transform": "rotateX(0deg)","-moz-transform": "rotateX(0deg)","-webkit-transform": "rotateX(2deg)"
                });
              }, 500)
              ',
						esc_attr( $total_soft_poll )
					);
					break;
				default:
					$tsp_data_effect      = sprintf( '$(`main.ts_poll_main_%1$s > .ts_poll_answer > .ts_poll_after_div`).css("display", "flex");', esc_attr( $total_soft_poll ) );
					$tsp_data_back_effect = sprintf( '$(`main.ts_poll_main_%1$s > .ts_poll_answer > .ts_poll_after_div`).css("display", "none");', esc_attr( $total_soft_poll ) );
					break;
			}
			$tsp_content_js_code .= sprintf(
				'
          function tsp_show_results_%1$s(){
            $(`footer.ts_poll_footer_%1$s div.ts_poll_footer_res`).css({"z-index": "9999"}).animate({"opacity": "1"}, 400);
            %2$s
          }
          ',
				esc_attr( $total_soft_poll ),
				$tsp_data_effect
			);
			if ( $t_s_poll_question_settings["TotalSoft_Poll_Set_01"] == 'true' ) {
				$tsp_content_js_code .= sprintf(
					'
            function tsp_change_results_%1$s(tsp_results_arr){
              $("main.ts_poll_main_%1$s > div.ts_poll_answer").each(function () {
                $(this).find("span.ts_poll_answer_percent_line").html(tsp_results_arr[`${$(this).attr("data-tsp-id")}`]["tsp_result_show"]);
              });
            }',
					esc_attr( $total_soft_poll )
				);
			}
		}

		if ( $tspoll_question_styles["ts_poll_rb_show"] == 'true' ) {
			$tsp_content_js_code .= sprintf(
				'
            $(document).on("click", "button#ts_poll_result_button_%1$s",tsp_show_results_%1$s );
            $(document).on("click", "button#ts_poll_back_button_%1$s" , function() {
              $(`footer.ts_poll_footer_%1$s div.ts_poll_footer_res`).animate({ "opacity": "0" }, 500);
              setTimeout(function() {
                $(`footer.ts_poll_footer_%1$s div.ts_poll_footer_res`).css({ "z-index":"-1" });
              }, 500);
              %2$s
            });
          ',
				esc_attr( $total_soft_poll ),
				$tsp_data_back_effect
			);
		}

		break;
	case 'Standart Without Button':
	case 'Standard Without Button':
	case 'Image Without Button':
	case 'Video Without Button':
	case 'Image in Question':
	case 'Video in Question':
	case 'Standard Poll':
		if ( $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Standard Poll' && array_key_exists("ts_poll_p_shpop", $tspoll_question_styles ) ) {
				break;
		}
		if ( $tspoll_question_styles["ts_poll_rb_show"] == 'true' || $ts_poll_can_vote === true ) {
			$tsp_content_js_code .= sprintf(
				'
          function tsp_show_results_%1$s(){
            $("footer.ts_poll_footer_%1$s div.ts_poll_footer_res").css("z-index", "9999").animate({ "opacity": "1" }, 500);
            $("main.ts_poll_main_%1$s > div.ts_poll_answer  span.ts_poll_r_block").css("z-index", "9999").animate({ "opacity": "1" }, 500);
            setTimeout(() => {
              $("main.ts_poll_main_%1$s > div.ts_poll_answer  span.ts_poll_r_block span.ts_poll_r_progress").each(function () {
                  $(this).animate({ "width": `${$(this).attr("data-tsp-length")}%%` }, 1500);
              });
            }, 500);
          }
          ',
				esc_js( $total_soft_poll )
			);

			if ( $t_s_poll_question_settings["TotalSoft_Poll_Set_01"] == 'true' ) {
				$tsp_content_js_code .= sprintf(
					'
            function tsp_change_results_%1$s(tsp_results_arr){
              $("main.ts_poll_main_%1$s > div.ts_poll_answer").each(function () {
                $(this).find("span.ts_poll_r_progress").attr("data-tsp-length",tsp_results_arr[`${$(this).attr("data-tsp-id")}`]["tsp_result_percent"]);
                $(this).find("span.ts_poll_r_info").html(tsp_results_arr[`${$(this).attr("data-tsp-id")}`]["tsp_result_show"]);
              });
            }
            ',
					esc_js( $total_soft_poll )
				);
			}

			if ( $tspoll_question_styles["ts_poll_rb_show"] == 'true' ) {
				$tsp_content_js_code .= sprintf(
					'
            $(document).on("click", "button#ts_poll_result_button_%1$s", tsp_show_results_%1$s);
            $(document).on("click", "button#ts_poll_back_button_%1$s",function() {
              $("main.ts_poll_main_%1$s > div.ts_poll_answer  span.ts_poll_r_block span.ts_poll_r_progress").each(function () {
                $(this).animate({ "width": 0 }, 500);
              });
              $("footer.ts_poll_footer_%1$s div.ts_poll_footer_res").animate({ "opacity": "0" }, 500);
              $("main.ts_poll_main_%1$s > div.ts_poll_answer  span.ts_poll_r_block").animate({ "opacity": "0" }, 500);
              setTimeout(() => {
                $("footer.ts_poll_footer_%1$s div.ts_poll_footer_res").css("z-index", "-1");
                $("main.ts_poll_main_%1$s > div.ts_poll_answer  span.ts_poll_r_block").css("z-index", "-1");
              }, 500);
            });
            ',
					esc_js( $total_soft_poll )
				);
			}
		}

		if ( $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Video Without Button' || $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Image Without Button' ) {
			$tsp_embeds_arr = array();
			remove_all_filters( 'embed_oembed_html', 10 );
			for ( $i = 0;$i < $ts_poll_answers_count;$i ++ ) {
				$tsp_embed_inner               = '';
				$TS_Poll_Question_Answer_Param = json_decode( $t_s_poll_answers_values[ $i ]["Answer_Param"], true );
				if ( $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Video Without Button' ) {
					$tsp_embed_inner = sprintf(
						'
              <div class="tsp_embed_popup_inner_%s tsp_video_popup_embed">
                %s
              </div>',
						esc_attr( $t_s_poll_answers_values[ $i ]["id"] ),
						$TS_Poll_Question_Answer_Param["TotalSoftPoll_Ans_Vd"] == '' ? sprintf( '<img src="%s" alt="No Video avaible">', esc_url( plugin_dir_url( __DIR__ ) . '/img/tsp_no_video.png' ) ) : do_shortcode( $wp_embed->run_shortcode( '[embed]' . esc_url( $TS_Poll_Question_Answer_Param["TotalSoftPoll_Ans_Vd"] ) . '[/embed]' ) )
					);
				} elseif ( $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Image Without Button' ) {
					$tsp_embed_inner = sprintf(
						'
              <div class="tsp_embed_popup_inner_%s tsp_video_popup_embed">
                <img src="%s" alt="No Image avaible">
              </div>',
						esc_attr( $t_s_poll_answers_values[ $i ]["id"] ),
						$TS_Poll_Question_Answer_Param["TotalSoftPoll_Ans_Im"] == '' ? esc_url( plugin_dir_url( __DIR__ ) . '/img/tsp_no_img.jpg' ) : esc_url( $TS_Poll_Question_Answer_Param["TotalSoftPoll_Ans_Im"] )
					);
				}
				$tsp_embeds_arr[ 'tsp_embed_id_' . $t_s_poll_answers_values[ $i ]["id"] ] = $tsp_embed_inner;
			}
			if ( $tspoll_question_styles["ts_poll_pop_show"] == 'true' ) {
				$tsp_content_js_code .= sprintf(
					'
            $(document).on("click", `main.ts_poll_main_%1$s > .ts_poll_answer > .ts_poll_attachment`, function() {
              var tsp_click_id =$(this).parent().attr("data-tsp-id");
              $(`div.tsp_popup_attachment_%1$s`).html(ts_poll_data_%1$s.tsp_embed_array_%1$s[`tsp_embed_id_${tsp_click_id}`]);
              $(`section.tsp_popup_question_%1$s`).css("display", "flex").hide().fadeIn(2000);                
              $(document).mouseup(function(e) {
                if (!$(`div.tsp_popup_attachment_%1$s >`).is(e.target) && $(`div.tsp_popup_attachment_%1$s >`).has(e.target).length === 0) {
                  $(`section.tsp_popup_question_%1$s`).fadeOut("slow"); $(`div.tsp_popup_attachment_%1$s`).html("");
                }
              });
            });
           ',
					esc_js( $total_soft_poll )
				);
				wp_localize_script( "ts_poll_js_{$total_soft_poll}", "ts_poll_data_{$total_soft_poll}", array( "tsp_embed_array_{$total_soft_poll}" => $tsp_embeds_arr ) );
			}
		}
}

if ( $ts_poll_can_vote === true ) {
	wp_localize_script( "ts_poll_js_{$total_soft_poll}", "ts_poll_ajax_{$total_soft_poll}", array( 'ts_poll_ajax_url' => esc_url( admin_url( 'admin-ajax.php' ) ) ) );

	$tsp_click_element = '';
	switch ( $ts_poll_question_params["TS_Poll_Q_Theme"] ) {
		case 'Standart Poll':
		case 'Standard Poll':
		case 'Image Poll':
		case 'Video Poll':
			$tsp_click_element = sprintf( 'footer.ts_poll_footer_%1$s  #ts_poll_vote_button', esc_js( $total_soft_poll ) );
			break;
		case 'Standart Without Button':
		case 'Standard Without Button':
			$tsp_click_element = sprintf( 'main.ts_poll_main_%1$s > .ts_poll_answer > .ts_poll_answer_input + label.ts_poll_answer_label', esc_js( $total_soft_poll ) );
			break;
		case 'Image Without Button':
		case 'Video Without Button':
			$tsp_click_element = sprintf( 'main.ts_poll_main_%1$s > .ts_poll_answer > .ts_poll_vote > .ts_poll_e_vote', esc_js( $total_soft_poll ) );
			break;
		case 'Image in Question':
		case 'Video in Question':
			if ( $ts_poll_edit != 'true' ) {
				if ( $tspoll_question_styles["ts_poll_vb_show"] == 'true' ) {
					$tsp_click_element = sprintf( 'footer.ts_poll_footer_%1$s  #ts_poll_vote_button', esc_js( $total_soft_poll ) );
				} else {
					$tsp_click_element = sprintf( 'main.ts_poll_main_%1$s > .ts_poll_answer  > label.ts_poll_e_vote', esc_js( $total_soft_poll ) );
				}
			} else {
				$tsp_click_element = sprintf( 'footer.ts_poll_footer_%1$s  #ts_poll_vote_button,main.ts_poll_main_%1$s > .ts_poll_answer  > label.ts_poll_e_vote', esc_js( $total_soft_poll ) );
			}
			break;
	}
	$tsp_content_js_code .= sprintf(
		'
          $(document).on("click", `%3$s`, function(event) {
            var tsp_checked_array = [];
            setTimeout(() => {
              $(`main.ts_poll_main_%1$s input[name="ts_poll_all%1$s"]`).each(function(){
                if($(this).is(":checked")){
                  tsp_checked_array.push($(this).val());
                }
              });
              if(tsp_checked_array.length === 0 || event.type != "click"){
                return;
              }
              $.ajax({
                url: ts_poll_ajax_%1$s.ts_poll_ajax_url,
                data: {
                  action: "tsp_vote_function",
                  tsp_vote_nonce: $(`#tsp_vote_nonce_field_%1$s`).val(),
                  tsp_id : %5$s,
                  tsp_change_id : %1$s,
                  tsp_checkeds : tsp_checked_array.join("|"),
                },
                beforeSend: function() {
                  $("form.ts_poll_form_%1$s div.ts_poll_loading").attr("style","display:flex;");
                },
                type: "POST",
              }).done(function(response) {
                if (response.success === true) {
                  $("form.ts_poll_form_%1$s footer").remove();
                  $("form.ts_poll_form_%1$s div.ts_poll_loading").removeAttr("style");
                    %4$s
                }else{
                  $("form.ts_poll_form_%1$s div.ts_poll_loading").removeAttr("style");
                }
              }).fail(function() {
                $("form.ts_poll_form_%1$s div.ts_poll_loading").removeAttr("style");
              });
            }, 100);
          });
          ',
		esc_js( $total_soft_poll ),
		esc_url( admin_url( 'admin-ajax.php' ) ),
		$tsp_click_element,
		$t_s_poll_question_settings["TotalSoft_Poll_Set_01"] == 'true' ? sprintf( 'tsp_change_results_%1$s(response.data); tsp_show_results_%1$s();', esc_js( $total_soft_poll ) ) : sprintf( 'tsp_show_results_%1$s();', esc_js( $total_soft_poll ) ),
		$ts_poll_base_id
	);
}

$tsp_content_js .= sprintf(
	'
    (function($) {
      "use strict";
      %s
    })(jQuery);
    ',
	$tsp_content_js_code
);
  wp_add_inline_script( "ts_poll_js_{$total_soft_poll}", $tsp_content_js );

