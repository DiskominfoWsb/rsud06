<?php
$tsp_content_js = $tsp_content_js_block = '';
if ( $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Image Poll' || $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Video Poll' ) {
	if ( $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Video Poll' ) {
		global $wp_embed;
		remove_all_filters( 'embed_oembed_html', 10 );
		$tsp_embeds_arr = array();
		for ( $i = 0;$i < $ts_poll_answers_count;$i ++ ) {
			$tsp_embed_inner               = '';
			$TS_Poll_Question_Answer_Param =  $t_s_poll_answers_values[ $i ]["Answer_Param"];
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
		wp_localize_script( 'tspoll_builder', 'tsp_embed_data', array( 'tsp_embed' => $tsp_embeds_arr ) );
		$tsp_content_js_block .= sprintf(
			'
        $(document).on("click", `main.ts_poll_main_%1$s > .ts_poll_answer .ts_poll_video_overlay`, function() {
          var tsp_click_id =$(this).attr("data-tsp-video");
          $(`div.tsp_popup_attachment_%1$s`).html(tsp_embed_data.tsp_embed[`tsp_embed_id_${tsp_click_id}`]);
          $(`section.tsp_popup_question_%1$s`).css("display", "flex").hide().fadeIn(2000);
          $(document).mouseup(function(e) {
            if (!$(`div.tsp_popup_attachment_%1$s >`).is(e.target) && $(`div.tsp_popup_attachment_%1$s >`).has(e.target).length === 0) {
             $(`section.tsp_popup_question_%1$s`).fadeOut("slow"); $(`div.tsp_popup_attachment_%1$s`).html("");  
            }
          });
        });',
			esc_js( $total_soft_poll )
		);
	}

	$tsp_content_js_block .= sprintf(
		'
    $(document).on("click" ,  "button#ts_poll_result_button_%1$s" , function() {
      var ts_poll_eff = $(`main.ts_poll_main_%1$s`).attr("data-tsp-effect");
      $(`footer.ts_poll_footer_%1$s div.ts_poll_footer_res`).css({"z-index": "9999"}).animate({"opacity": "1"}, 400);
      if(ts_poll_eff=="0") {
        $(`main.ts_poll_main_%1$s > .ts_poll_answer > .ts_poll_after_div`).attr("style", "display:flex;");
      }else if(ts_poll_eff=="1") {
        $(`main.ts_poll_main_%1$s > .ts_poll_answer > .ts_poll_before_div`).attr("style",
          "transform :  rotateY(-90deg);-ms-transform: rotateY(-90deg);-o-transform: rotateY(-90deg);-moz-transform: rotateY(-90deg);-webkit-transform: rotateY(-90deg);"
        );
        setTimeout(function() {
          $(`main.ts_poll_main_%1$s > .ts_poll_answer > .ts_poll_before_div`).attr("style",
            "transform: rotateY(2deg);-ms-transform: rotateY(2deg);-o-transform: rotateY(2deg);-moz-transform: rotateY(2deg);-webkit-transform: rotateY(2deg);"
          );
          $(`main.ts_poll_main_%1$s > .ts_poll_answer > .ts_poll_after_div`).attr("style",
            "transform: rotateY(2deg);-ms-transform: rotateY(2deg);-o-transform: rotateY(2deg);-moz-transform: rotateY(2deg);-webkit-transform: rotateY(2deg);"
          );
        }, 500);
      }else if(ts_poll_eff=="2") {
        $(`main.ts_poll_main_%1$s > .ts_poll_answer > .ts_poll_before_div`).attr("style",
          "transform: rotateX(-90deg);-ms-transform: rotateX(-90deg);-o-transform: rotateX(-90deg);-moz-transform: rotateX(-90deg);-webkit-transform: rotateX(-90deg);"
        );
        setTimeout(function() {
          $(`main.ts_poll_main_%1$s > .ts_poll_answer > .ts_poll_before_div`).attr("style",
            "transform: rotateX(0deg);-ms-transform: rotateX(0deg);-o-transform: rotateX(0deg);-moz-transform: rotateX(0deg);-webkit-transform: rotateX(2deg);"
          );
          $(`main.ts_poll_main_%1$s > .ts_poll_answer > .ts_poll_after_div`).attr("style",
            "transform: rotateX(0deg);-ms-transform: rotateX(0deg);-o-transform: rotateX(0deg);-moz-transform: rotateX(0deg);-webkit-transform: rotateX(2deg);"
          );
        }, 500);
      }
    });
    $(document).on("click", "button#ts_poll_back_button_%1$s" , function() {
      var ts_poll_eff = $(`main.ts_poll_main_%1$s`).attr("data-tsp-effect");
      $(`footer.ts_poll_footer_%1$s div.ts_poll_footer_res`).animate({ "opacity": "0" }, 500);
      setTimeout(function() {
        $(`footer.ts_poll_footer_%1$s div.ts_poll_footer_res`).css({ "z-index":"-1" });
      }, 500);
      if (ts_poll_eff == "0") {
        $(`main.ts_poll_main_%1$s > .ts_poll_answer > .ts_poll_after_div`).attr("style", "display:none;");
      } else if (ts_poll_eff == "1") {
        $(`main.ts_poll_main_%1$s > .ts_poll_answer > .ts_poll_before_div`).attr("style",
          "transform: rotateY(-90deg);-ms-transform: rotateY(-90deg);-o-transform: rotateY(-90deg);-moz-transform: rotateY(-90deg);-webkit-transform: rotateY(-90deg);"
        );
        $(`main.ts_poll_main_%1$s > .ts_poll_answer > .ts_poll_after_div`).attr("style",
          "transform: rotateY(-90deg);-ms-transform: rotateY(-90deg);-o-transform: rotateY(-90deg);-moz-transform: rotateY(-90deg);-webkit-transform: rotateY(-90deg);"
        );
        setTimeout(function() {
          $(`main.ts_poll_main_%1$s > .ts_poll_answer > .ts_poll_before_div`).attr("style",
              "transform: rotateY(2deg);-ms-transform: rotateY(2deg);-o-transform: rotateY(2deg);-moz-transform: rotateY(2deg);-webkit-transform: rotateY(2deg);"
          );
        }, 500)
      } else if (ts_poll_eff == "2") {
        $(`main.ts_poll_main_%1$s > .ts_poll_answer > .ts_poll_before_div`).attr("style",
          "transform: rotateX(-90deg);-ms-transform: rotateX(-90deg);-o-transform: rotateX(-90deg);-moz-transform: rotateX(-90deg);-webkit-transform: rotateX(-90deg);"
        );
        $(`main.ts_poll_main_%1$s > .ts_poll_answer > .ts_poll_after_div`).attr("style",
          "transform: rotateX(-90deg);-ms-transform: rotateX(-90deg);-o-transform: rotateX(-90deg);-moz-transform: rotateX(-90deg);-webkit-transform: rotateX(-90deg);"
        );
        setTimeout(function() {
          $(`main.ts_poll_main_%1$s > .ts_poll_answer > .ts_poll_before_div`).attr("style",
              "transform: rotateX(0deg);-ms-transform: rotateX(0deg);-o-transform: rotateX(0deg);-moz-transform: rotateX(0deg);-webkit-transform: rotateX(2deg);"
          );
        }, 500);
      }
    });
    ',
		esc_attr( $total_soft_poll )
	);

} elseif ( $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Standart Without Button' || $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Standard Without Button'
  || $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Image Without Button' || $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Video Without Button'
  || $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Image in Question' || $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Video in Question' || ( $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Standard Poll' && ! array_key_exists("ts_poll_p_shpop", $tspoll_question_styles ) ) ) {
	$tsp_content_js_block .= sprintf(
		'
        $(document).on("click", "button#ts_poll_result_button_%1$s", function(){
          $("footer.ts_poll_footer_%1$s div.ts_poll_footer_res").css("z-index", "9999").animate({ "opacity": "1" }, 500);
          $("main.ts_poll_main_%1$s > div.ts_poll_answer  span.ts_poll_r_block").css("z-index", "9999").animate({ "opacity": "1" }, 500);
          setTimeout(() => {
            $("main.ts_poll_main_%1$s > div.ts_poll_answer  span.ts_poll_r_block span.ts_poll_r_progress").each(function () {
                $(this).animate({ "width": `${$(this).attr("data-tsp-length")}%%` }, 1500);
            });
          }, 500);
        });
        $(document).on("click", "button#ts_poll_back_button_%1$s" , function() {
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

	if ( $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Video Without Button' || $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Image Without Button' ) {
    remove_all_filters( 'embed_oembed_html', 10 );
    $tsp_embeds_arr = array();
		for ( $i = 0;$i < $ts_poll_answers_count;$i ++ ) {
			$tsp_embed_inner               = '';
			$TS_Poll_Question_Answer_Param =  $t_s_poll_answers_values[ $i ]["Answer_Param"];
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
		wp_localize_script( 'tspoll_builder', 'tsp_embed_data', array( 'tsp_embed' => $tsp_embeds_arr ) );
		$tsp_content_js_block .= sprintf(
			'
            $(document).on("click", `main.ts_poll_main_%1$s > .ts_poll_answer > .ts_poll_attachment`, function() {
              if($(`input#ts_poll_pop_show`).is(":checked")){
                var tsp_click_id =$(this).parent().attr("data-tsp-id");
                $(`div.tsp_popup_attachment_%1$s`).html(tsp_embed_data.tsp_embed[`tsp_embed_id_${tsp_click_id}`]);
                  $(`section.tsp_popup_question_%1$s`).css("display", "flex").hide().fadeIn(2000);              }
              $(document).mouseup(function(e) {
                if (!$(`div.tsp_popup_attachment_%1$s >`).is(e.target) && $(`div.tsp_popup_attachment_%1$s >`).has(e.target).length === 0) {
                  $(`section.tsp_popup_question_%1$s`).fadeOut("slow"); $(`div.tsp_popup_attachment_%1$s`).html("");                  }
              });
            });
            ',
			esc_js( $total_soft_poll )
		);
	}
}

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
$tsp_content_js_block .= sprintf(
	'
    $(document).on("click", `%1$s`, function() {
      toastr["info"]("In edit mode vote function is not working.", "Info", { "closeButton": true, "newestOnTop": false, "progressBar": true, "positionClass": "toast-top-right", "preventDuplicates": true, "showDuration": "300", "hideDuration": "1000", "timeOut": "5000", "extendedTimeOut": "1000", "showEasing": "swing", "hideEasing": "linear", "showMethod": "fadeIn", "hideMethod": "fadeOut", });
    });
    ',
	$tsp_click_element
);
$tsp_content_js       .= sprintf(
	'
    (function($) {
      "use strict";
      %s
    })(jQuery);
    ',
	$tsp_content_js_block
);
wp_add_inline_script( 'tspoll_builder', $tsp_content_js );

