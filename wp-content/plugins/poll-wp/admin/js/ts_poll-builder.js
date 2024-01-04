(function($) {
    'use strict';
    /**
     * All of the code for your admin-facing JavaScript source
     * should reside in this file.
     *
     * Note: It has been assumed you will write $ code here, so the
     * $ function reference has been prepared for usage within the scope
     * of this function.
     *
     * This enables you to define handlers, for when the DOM is ready:
     *
     * $(function() {
     *
     * });
     *
     * When the window is loaded:
     *
     * $( window ).load(function() {
     *
     * });
     *
     * ...and/or other possibilities.
     *
     * Ideally, it is not considered best practise to attach more than a
     * single DOM-ready or window-load handler for a particular page.
     * Although scripts in the WordPress core, Plugins and Themes may be
     * practising this, we should strive to set a better example in our own work.
     */

    $(window).load(function() {
        $('#tsp_loader').hide();
        $('#tsp_builder_section').removeAttr('style');
    });

    // TSP Sidebar switcher
    $(document).on('click', '#tsp_switch_sidebar', function() {
        if (document.getElementById("tsp_sidebar").dataset.tspOpen == "open") {
            document.getElementById("tsp_sidebar").dataset.tspOpen = "close";
        } else if (document.getElementById("tsp_sidebar").dataset.tspOpen == "close") {
            document.getElementById("tsp_sidebar").dataset.tspOpen = "open";
        }
    });

    // TSP Toastr
    var tsp_toastr_options = { "closeButton": true, "newestOnTop": false, "progressBar": true, "positionClass": "toast-top-right", "preventDuplicates": true, "showDuration": "300", "hideDuration": "1000", "timeOut": "5000", "extendedTimeOut": "1000", "showEasing": "swing", "hideEasing": "linear", "showMethod": "fadeIn", "hideMethod": "fadeOut", };
    $(document).on('click', 'div.tsp_sidebar_item:not(".tsp_active")', function() {
        if (typeof tspoll_builder_json !== 'undefined') {
            if ($(this).attr('data-tsp-item') == "theme") {
                toastr["warning"](tspoll_builder_json.theme_warning, tspoll_builder_json.warning, tsp_toastr_options);
            } else {
                switch ($(this).attr('data-tsp-item')) {
                    case "field":
                    case "style":
                    case "setting":
                    case "shortcode":
                        $('div.tsp_sidebar_item').removeClass('tsp_active');
                        $(this).addClass('tsp_active');
                        $('.tsp_content').removeClass('active');
                        $('.tsp_content[data-tsp-section="field_style"]').addClass('active');
                        $('.tsp_content_subsection.active').removeClass('active');
                        $('.tsp_content_subsection[data-tsp-subsection="' + $(this).attr('data-tsp-item') + '"]').addClass('active');
                        break;
                    case "info":
                        toastr["warning"](tspoll_builder_json.statistics_warning, tspoll_builder_json.info, { "closeButton": true, "newestOnTop": false, "progressBar": true, "positionClass": "toast-top-full-width", "preventDuplicates": true, "showDuration": "300", "hideDuration": "1000", "timeOut": "5000", "extendedTimeOut": "1000", "showEasing": "swing", "hideEasing": "linear", "showMethod": "fadeIn", "hideMethod": "fadeOut", });
                        break;
                    case "votes_count":
                        if (tspoll_builder_json.tsp_creation != "save") {
                            $('div.tsp_sidebar_item').removeClass('tsp_active');
                            $(this).addClass('tsp_active');
                            $('.tsp_content').removeClass('active');
                            $('.tsp_content[data-tsp-section="votes_count"]').addClass('active');
                            $('.tsp_content_subsection.active').removeClass('active');
                        } else {
                            toastr["warning"](tspoll_builder_json.results_warning, tspoll_builder_json.warning, tsp_toastr_options);
                        }
                        break;
                    default:
                        $('.tsp_content[data-tsp-section="' + $(this).attr('data-tsp-item') + '"]').addClass('active');
                        break;
                }
            }
        } else {
            toastr["warning"](tspoll_builder_json.theme_choose_warning, tspoll_builder_json.warning, tsp_toastr_options);
        }
    });

    $(function() {
        if (typeof tspoll_builder_json !== 'undefined') {
            var tsp_styles = tspoll_builder_json.tsp_proporties.Question_Style,
                tsp_answers = tspoll_builder_json.tsp_answers,
                tsp_votes = tspoll_builder_json.tsp_votes,
                tsp_colors = tspoll_builder_json.tsp_colors,
                tsp_question_params = tspoll_builder_json.tsp_proporties.Question_Param,
                tsp_theme_settings = tspoll_builder_json.tsp_proporties.Question_Settings,
                tsp_answer_sort = tspoll_builder_json.tsp_proporties.Answers_Sort,
                tsp_question_id = tspoll_builder_json.tsp_proporties.id,
                tsp_delete_ids = [],
                tsp_theme_name = tsp_question_params.TS_Poll_Q_Theme;
            if (tspoll_builder_json.tsp_creation != "save") {
                $("input#tsp_global_shortcode").val(`[TS_Poll id="${tsp_question_id}"]`);
                $("input#tsp_global_theme_shortcode").val(`<?php echo do_shortcode('[TS_Poll id="${tsp_question_id}"]');?>`);
                $('.tsp_content_subsection[data-tsp-subsection="shortcode"] > div[data-tsp-field="notice"]').remove();
                $(document).ready(function() {
                    const tsp_data_results_table = new DataTable("#tsp_data_results_table");
                });
            } else {
                $('.tsp_content_subsection[data-tsp-subsection="shortcode"] > div[data-tsp-field="shortcode"]').remove();
            }
            var tsp_answers_props_arr = Object();
            Object.keys(tspoll_builder_json.tsp_proporties.Question_Answers).map((key) => tsp_answers_props_arr[key] = tspoll_builder_json.tsp_proporties.Question_Answers[key]);
            var tsp_icons = [];
            var tsp_emojies = [];
            tsp_icons = Object.values(tspoll_builder_json.fonts.tsp_fonts.tsp_fontawesome);
            tsp_emojies = Object.values(tspoll_builder_json.fonts.tsp_fonts.tsp_emojies);
            var tsp_all_fonts = Object.assign(tspoll_builder_json.fonts.tsp_fonts.tsp_fontawesome, tspoll_builder_json.fonts.tsp_fonts.tsp_emojies);
            var tsp_edit_elem_id = "";

            function tspGetKeyByValue(object, value) {
                return Object.keys(object).find(key => object[key] === value);
            }

            function tspSetImage(type, id, url, width, height) {

                if (type == "library") {
                    jQuery('input#tsp_answer_attachment_id').val(id);
                } else if (type == "embed") {
                    jQuery('input#tsp_answer_attachment_id').val(url);
                }
                if (tsp_theme_name == "Image Without Button") {
                    tsp_embed_data.tsp_embed[`tsp_embed_id_${tsp_edit_elem_id}`] = `<div class="tsp_embed_popup_inner_${tsp_edit_elem_id} tsp_video_popup_embed"><img src="${url}" alt="No Image avaible"></div>`;
                }

                document.documentElement.style.setProperty('--tsp_img_aspect_ratio', `${height}/${width}`);
                $(".tsp_img_change > img").attr("src", url);
                $("div.tsp_img_loading_div").attr("style", "display:none;");

                if (tsp_theme_name == "Image in Question") {
                    $(`header.ts_poll_header_${tsp_question_id} > div.ts_poll_img_div_${tsp_question_id} > img`).attr("src", url);
                    tsp_question_params.TotalSoftPoll_Q_Im = url;
                    $('.tsp_accordion_item_opened').children(".tsp_accordion_item_content").height(`${$('.tsp_accordion_item_opened').children(".tsp_accordion_item_content").children(".tsp_accordion_items").prop("scrollHeight")}px`);
                } else {
                    tsp_answers_props_arr[`${tsp_edit_elem_id}`].Answer_Param.TotalSoftPoll_Ans_Im = url;
                    $(`section.tsp_answer_section_${tsp_question_id} > .ts_poll_answer[data-tsp-id='${tsp_edit_elem_id}'] .ts_poll_answer_img_div img,main.ts_poll_main_${tsp_question_id} > .ts_poll_answer[data-tsp-id='${tsp_edit_elem_id}'] .ts_poll_imgvd_div img,main.ts_poll_main_${tsp_question_id} > .ts_poll_answer[data-tsp-id='${tsp_edit_elem_id}'] .ts_poll_attachment img`).attr("src", tsp_answers_props_arr[`${tsp_edit_elem_id}`].Answer_Param.TotalSoftPoll_Ans_Im);
                }

            }

            function tspAddNewAnswer(tsp_action, tsp_title, tsp_copied_id = "") {
                var tsp_new_answer_id = `new-${Math.floor(Math.random() * 900000) + 100000}`,
                    tsp_resalt_after_vote = $("input#TotalSoft_Poll_Set_01[type='checkbox']").is(":checked"),
                    tsp_checkbox_type = $("input#ts_poll_ch_cm[type='checkbox']").is(":checked") == false ? "radio" : "checkbox",
                    tsp_no_result_text = $("input#TotalSoft_Poll_Set_05[type='text']").val(),
                    tsp_style_special = [],
                    tsp_new_title_name = tsp_title,
                    tsp_new_element = "";
                if (tsp_action == "copy") {
                    let tsp_new_props = JSON.parse(JSON.stringify(tsp_answers_props_arr[tsp_copied_id]));
                    tsp_new_props.id = `${tsp_new_answer_id}`;
                    tsp_answers_props_arr[`${tsp_new_answer_id}`] = tsp_new_props;
                    $(`.tsp-list-item[aria-tsp-answer="${tsp_copied_id}"]`).clone(true).attr({ "aria-tsp-answer": tsp_new_answer_id, "aria-tsp-percent": 0, "aria-tsp-count": 0 }).appendTo("#tsp-list");
                    document.documentElement.style.setProperty(`--tsp_a_c_${tsp_question_id}-${tsp_new_answer_id}`, getComputedStyle(document.documentElement).getPropertyValue(`--tsp_a_c_${tsp_question_id}-${tsp_copied_id}`));
                    toastr["success"](tspoll_builder_json.copy_note, tspoll_builder_json.success, tsp_toastr_options);
                } else {
                    var tsp_new_props = {
                        id: tsp_new_answer_id,
                        Question_id: tsp_question_id,
                        Answer_Param: { TotalSoftPoll_Ans_Im: '', TotalSoftPoll_Ans_Vd: '', TotalSoftPoll_Ans_Cl: '#23a24d' },
                        Answer_Title: tsp_title,
                        Answer_Votes: "0",
                    };
                    tsp_answers_props_arr[`${tsp_new_answer_id}`] = tsp_new_props;

                    $("#tsp-list").append(`
                        <div class="tsp-list-item" aria-tsp-answer="${tsp_new_answer_id}" aria-tsp-percent="0" aria-tsp-count="0">
                            <div class="tsp_handle_list tsp_list_action flex-center ui-sortable-handle"><img src="${tspoll_builder_json.tsp_svg_move}"></div>
                            <div class="details tsp_analytics_flex_r"><h2>${tsp_new_title_name}</h2> </div>
                            <div class="tsp_list_action flex-center" data-tsp-action="edit"><img src="${tspoll_builder_json.tsp_svg_edit}"> </div>
                            <div class="tsp_list_action flex-center" data-tsp-action="copy"><img src="${tspoll_builder_json.tsp_svg_copy}"> </div>
                            <div class="tsp_list_action flex-center" data-tsp-action="delete"><img src="${tspoll_builder_json.tsp_svg_remove}"> </div>
                        </div>
                    `);
                    document.documentElement.style.setProperty(`--tsp_a_c_${tsp_question_id}-${tsp_new_answer_id}`, "#23a24d");
                    toastr["success"](tspoll_builder_json.add_note, tspoll_builder_json.success, tsp_toastr_options);
                }
                switch (tsp_theme_name) {
                    case 'Standart Poll':
                    case 'Standard Poll':
                        if ($("input#ts_poll_p_shpop").length) {
                            tsp_style_special.push(`
                                main.ts_poll_r_main_${tsp_question_id}[data-tsp-bool='false'] > .ts_poll_answer_result[data-tsp-id='${tsp_new_answer_id}'] > .ts_poll_answer_result_label > .ts_poll_answer_percent_line{
                                    background-color: var(--tsp_a_c_${tsp_question_id}-${tsp_new_answer_id});
                                }`);
                            tsp_style_special.push(`
                                main.ts_poll_main_${tsp_question_id}[data-tsp-bool='false'] > .ts_poll_answer[data-tsp-id='${tsp_new_answer_id}'] > .ts_poll_answer_label {
                                    color: var(--tsp_a_c_${tsp_question_id}-${tsp_new_answer_id});
                                }`);
                            var tsp_type_show_result = tsp_resalt_after_vote == true ? "0%" : "100%";
                            var tsp_vote_type_show = $('select#ts_poll_p_a_vt').find(":selected").val();
                            var tsp_answer_show_by = "";

                            switch (tsp_vote_type_show) {
                                case 'percent':
                                    tsp_answer_show_by = tsp_resalt_after_vote == true ? "0%" : tsp_no_result_text;
                                    break;
                                case 'count':
                                    tsp_answer_show_by = tsp_resalt_after_vote == true ? "0" : tsp_no_result_text;
                                    break;
                                case 'both':
                                    tsp_answer_show_by = tsp_resalt_after_vote == true ? `0 ( 0 % ) ` : tsp_no_result_text;
                                    break;
                            }

                            $(`<div class='ts_poll_answer_result' data-tsp-id='${tsp_new_answer_id}' >
                                        <label class='ts_poll_answer_result_label'>
                                            <span class='ts_poll_r_answer_title'>
                                                ${tsp_new_title_name}
                                            </span>
                                            <span class='ts_poll_answer_percent_line'
                                                data-tsp-w='${tsp_type_show_result}'
                                                style=''>
                                            </span>
                                            <span data-tsp-vt='${tsp_vote_type_show}' class='ts_poll_answer_info_line'>
                                                ${tsp_answer_show_by}
                                            </span>
                                        </label>
                                    </div>`).insertAfter($(`.ts_poll_form_${tsp_question_id}  main.ts_poll_r_main_${tsp_question_id} > .ts_poll_answer_result`).last());
                            $(`.ts_poll_form_${tsp_question_id}  main.ts_poll_r_main_${tsp_question_id} > .ts_poll_answer_result`).last().clone(true).insertAfter($(`#ts_poll_modal_result_section_${tsp_question_id}  main.ts_poll_r_main_${tsp_question_id} > .ts_poll_answer_result`).last());
                            tsp_new_element = `
                                    <div class='ts_poll_answer' data-tsp-id='${tsp_new_answer_id}'>
                                      <input  type='${tsp_checkbox_type}' 
                                              class='ts_poll_answer_input'
                                              id='ts_poll_answer_input_${tsp_question_id}-${tsp_new_answer_id}'
                                              name='ts_poll_all${tsp_question_id}'
                                              value='${tsp_new_answer_id}'
                                              style='display:none;'>
                                      <label  class='ts_poll_answer_label' 
                                              for='ts_poll_answer_input_${tsp_question_id}-${tsp_new_answer_id}'>
                                        <span>${tsp_new_title_name}</span>
                                      </label>
                                    </div>`;
                        } else {
                            var tsp_type_show_result = tsp_resalt_after_vote == true ? "0" : "100";
                            var tsp_vote_type_show = $('select#ts_poll_v_t').find(":selected").val();
                            var tsp_answer_show_by = "";
                            switch (tsp_vote_type_show) {
                                case 'percent':
                                case 'percentlab':
                                    tsp_answer_show_by = tsp_resalt_after_vote == true ? "0%" : tsp_no_result_text;
                                    break;
                                case 'count':
                                case 'countlab':
                                    tsp_answer_show_by = tsp_resalt_after_vote == true ? "0" : tsp_no_result_text;
                                    break;
                                case 'both':
                                case 'bothlab':
                                    tsp_answer_show_by = tsp_resalt_after_vote == true ? "0 ( 0% ) " : tsp_no_result_text;
                                    break;
                                default:
                                    tsp_answer_show_by = tsp_resalt_after_vote == true ? "0 ( 0% ) " : tsp_no_result_text;
                                    break;
                            }
                            tsp_new_element =
                                `<div class='ts_poll_answer' data-tsp-id='${tsp_new_answer_id}'>
                                        <input type='${tsp_checkbox_type}' class='ts_poll_answer_input'
                                            id='ts_poll_answer_input_${tsp_question_id}-${tsp_new_answer_id}'
                                            name='ts_poll_all${tsp_question_id}'
                                            value='${tsp_new_answer_id}'>
                                        <label class='ts_poll_answer_label ts_poll_fa' for='ts_poll_answer_input_${tsp_question_id}-${tsp_new_answer_id}'>
                                            ${tsp_new_title_name}
                                        </label>
                                        <span class='ts_poll_r_block'>
                                          <span class='ts_poll_r_inner'>
                                            <span class='ts_poll_r_progress' data-tsp-length='${tsp_type_show_result}'></span>
                                            <label class='ts_poll_r_label'>
                                               ${tsp_vote_type_show == 'countlab' || tsp_vote_type_show == 'percentlab' || tsp_vote_type_show == 'bothlab' ?  tsp_new_title_name  : ''}
                                              <span class='ts_poll_r_info'>
                                                ${tsp_answer_show_by}
                                              </span>
                                            </label>
                                          </span>
                                        </span>
                                    </div>`;
                        }

                        break;
                    case 'Image Poll':
                    case 'Video Poll':
                        tsp_style_special.push(`
                        main.ts_poll_main_${tsp_question_id}[data-tsp-color='Background'] > .ts_poll_answer[data-tsp-id='${tsp_new_answer_id}'] > .ts_poll_before_div{
                            background: var(--tsp_a_c_${tsp_question_id}-${tsp_new_answer_id});
                        }`);
                        tsp_style_special.push(`
                        main.ts_poll_main_${tsp_question_id}[data-tsp-color='Color'] > .ts_poll_answer[data-tsp-id='${tsp_new_answer_id}']  .ts_poll_answer_label{
                            color: var(--tsp_a_c_${tsp_question_id}-${tsp_new_answer_id});
                        }`);
                        var tsp_type_img_vd = "",
                            tsp_type_img_vd_html = "",
                            tsp_answer_show_by = "";
                        var tsp_type_show_result = tsp_resalt_after_vote == true ? "0%" : "100%";
                        var tsp_vote_type_show = $('select#ts_poll_p_a_vt').find(":selected").val();
                        var tsp_elem_img_link = tsp_action == "add" ? tspoll_builder_json.tsp_no_img : $(`main.ts_poll_main_${tsp_question_id} > .ts_poll_answer[data-tsp-id='${tsp_copied_id}'] img`).attr("src");
                        switch (tsp_vote_type_show) {
                            case 'percent':
                            case 'percentlab':
                                tsp_answer_show_by = tsp_resalt_after_vote == true ? "0%" : tsp_no_result_text;
                                break;
                            case 'count':
                            case 'countlab':
                                tsp_answer_show_by = tsp_resalt_after_vote == true ? "0" : tsp_no_result_text;
                                break;
                            case 'both':
                            case 'bothlab':
                                tsp_answer_show_by = tsp_resalt_after_vote == true ? "0 ( 0% ) " : tsp_no_result_text;
                                break;
                            default:
                                tsp_answer_show_by = tsp_resalt_after_vote == true ? "0 ( 0% ) " : tsp_no_result_text;
                                break;
                        }
                        if (tsp_theme_name == "Video Poll") {
                            tsp_type_img_vd = "video";
                            tsp_type_img_vd_html = `<div class='ts_poll_video_overlay' data-tsp-video='${tsp_new_answer_id}'><span class='ts_poll_overlay_icon'><i class='ts_poll_video_play_ic ${$("#ts_poll_play_it-icon_value").val()}'></i></div>`;
                            if (tsp_action == "add") {
                                tsp_embed_data.tsp_embed[`tsp_embed_id_${tsp_new_answer_id}`] = `<div class="tsp_embed_popup_inner_${tsp_new_answer_id} tsp_video_popup_embed"><img src="${tspoll_builder_json.tsp_no_video}" alt="No Video avaible"></div>`;
                            } else {
                                tsp_embed_data.tsp_embed[`tsp_embed_id_${tsp_new_answer_id}`] = JSON.parse(JSON.stringify(tsp_embed_data.tsp_embed[`tsp_embed_id_${tsp_copied_id}`]));
                            }
                        } else {
                            tsp_type_img_vd = "image";
                        }
                        tsp_new_element = `
                            <div class='ts_poll_answer' data-tsp-id='${tsp_new_answer_id}' data-tsp-type='${tsp_type_img_vd}'>
                              <div class='ts_poll_before_div'>
                                <div class='ts_poll_imgvd_div'>
                                  ${tsp_type_img_vd_html}
                                  <img src='${tsp_elem_img_link}' alt='${tsp_new_title_name}'>
                                </div>
                                <input  type='${tsp_checkbox_type}' 
                                      class='ts_poll_answer_input'
                                      id='ts_poll_answer_input_${tsp_question_id}-${tsp_new_answer_id}'
                                      name='ts_poll_all${tsp_question_id}'
                                      value='${tsp_new_answer_id}'
                                      style='display:none;'>
                                <label  class='ts_poll_answer_label' 
                                        for='ts_poll_answer_input_${tsp_question_id}-${tsp_new_answer_id}'>
                                  <span>${tsp_new_title_name}</span>
                                </label>
                              </div>
                              <div class='ts_poll_after_div'>
                                <span class='ts_poll_after_span'>
                                  <span class='ts_poll_r_answer_title'>
                                    ${tsp_vote_type_show == 'countlab' || tsp_vote_type_show == 'percentlab' || tsp_vote_type_show == 'bothlab' ? tsp_new_title_name  : ''}
                                  </span>
                                  <span class='ts_poll_answer_percent_line'
                                    data-tsp-w='${tsp_type_show_result}'>
                                    ${tsp_answer_show_by}
                                  </span>
                                </span>
                              </div>
                            </div>`;
                        break;
                    case 'Standart Without Button':
                    case 'Standard Without Button':
                        var tsp_type_show_result = tsp_resalt_after_vote == true ? "0" : "100";
                        var tsp_vote_type_show = $('select#ts_poll_v_t').find(":selected").val();
                        var tsp_answer_show_by = "";
                        switch (tsp_vote_type_show) {
                            case 'percent':
                            case 'percentlab':
                                tsp_answer_show_by = tsp_resalt_after_vote == true ? "0%" : tsp_no_result_text;
                                break;
                            case 'count':
                            case 'countlab':
                                tsp_answer_show_by = tsp_resalt_after_vote == true ? "0" : tsp_no_result_text;
                                break;
                            case 'both':
                            case 'bothlab':
                                tsp_answer_show_by = tsp_resalt_after_vote == true ? "0 ( 0% ) " : tsp_no_result_text;
                                break;
                            default:
                                tsp_answer_show_by = tsp_resalt_after_vote == true ? "0 ( 0% ) " : tsp_no_result_text;
                                break;
                        }
                        tsp_new_element =
                            `<div class='ts_poll_answer' data-tsp-id='${tsp_new_answer_id}'>
                                <input type='radio' class='ts_poll_answer_input'
                                    id='ts_poll_answer_input_${tsp_question_id}-${tsp_new_answer_id}'
                                    name='ts_poll_all${tsp_question_id}'
                                    value='${tsp_new_answer_id}'>
                                <label class='ts_poll_answer_label ts_poll_fa' for='ts_poll_answer_input_${tsp_question_id}-${tsp_new_answer_id}'>
                                    ${tsp_new_title_name}
                                </label>
                                <span class='ts_poll_r_block'>
                                  <span class='ts_poll_r_inner'>
                                    <span class='ts_poll_r_progress' data-tsp-length='${tsp_type_show_result}'></span>
                                    <label class='ts_poll_r_label'>
                                       ${tsp_vote_type_show == 'countlab' || tsp_vote_type_show == 'percentlab' || tsp_vote_type_show == 'bothlab' ?  tsp_new_title_name  : ''}
                                      <span class='ts_poll_r_info'>
                                        ${tsp_answer_show_by}
                                      </span>
                                    </label>
                                  </span>
                                </span>
                            </div>`;
                        break;
                    case 'Image Without Button':
                    case 'Video Without Button':
                        var tsp_type_show_result = tsp_resalt_after_vote == true ? "0" : "100";
                        var tsp_answer_show_by = "";
                        var tsp_elem_img_link = tsp_action == "add" ? tspoll_builder_json.tsp_no_img : $(`main.ts_poll_main_${tsp_question_id} > .ts_poll_answer[data-tsp-id='${tsp_copied_id}'] img`).attr("src");
                        if (tsp_action == "add") {
                            tsp_embed_data.tsp_embed[`tsp_embed_id_${tsp_new_answer_id}`] = tsp_theme_name == "Image Without Button" ? `<div class="tsp_embed_popup_inner_${tsp_new_answer_id} tsp_video_popup_embed"><img src="${tspoll_builder_json.tsp_no_img}" alt="No Image avaible"></div>` : `<div class="tsp_embed_popup_inner_${tsp_new_answer_id} tsp_video_popup_embed"><img src="${tspoll_builder_json.tsp_no_video}" alt="No Video avaible"></div>`;
                        } else {
                            tsp_embed_data.tsp_embed[`tsp_embed_id_${tsp_new_answer_id}`] = JSON.parse(JSON.stringify(tsp_embed_data.tsp_embed[`tsp_embed_id_${tsp_copied_id}`]));
                        }
                        switch (tsp_vote_type_show) {
                            case 'percent':
                            case 'percentlab':
                                tsp_answer_show_by = tsp_resalt_after_vote == true ? "0%" : tsp_no_result_text;
                                break;
                            case 'count':
                            case 'countlab':
                                tsp_answer_show_by = tsp_resalt_after_vote == true ? "0" : tsp_no_result_text;
                                break;
                            case 'both':
                            case 'bothlab':
                                tsp_answer_show_by = tsp_resalt_after_vote == true ? "0 ( 0% ) " : tsp_no_result_text;
                                break;
                            default:
                                tsp_answer_show_by = tsp_resalt_after_vote == true ? "0 ( 0% ) " : tsp_no_result_text;
                                break;
                        }
                        tsp_new_element = `
                            <div class='ts_poll_answer' data-tsp-id='${tsp_new_answer_id}'>
                                <div class='ts_poll_attachment'>
                                  <img src='${tsp_elem_img_link}' alt='${tsp_new_title_name}'>
                                  <div class='ts_poll_overlay_div'>
                                    <span class='ts_poll_overlay_span'>
                                      <i class='${$("#ts_poll_i_it-icon_value").val()} ts_poll_overlay_icon'></i>
                                    </span>
                                  </div>
                                </div>
                                <div class='ts_poll_vote'>
                                <input type='radio' class='ts_poll_answer_input'
                                    id='ts_poll_answer_input_${tsp_question_id}-${tsp_new_answer_id}'
                                    name='ts_poll_all${tsp_question_id}'
                                    value='${tsp_new_answer_id}'>
                                  <label class='ts_poll_e_vote' for='ts_poll_answer_input_${tsp_question_id}-${tsp_new_answer_id}'><span class='ts_poll_answer_label'>${tsp_new_title_name}</span></label>
                                  <span class='ts_poll_r_block'>
                                    <span class='ts_poll_r_inner'>
                                      <span class='ts_poll_r_progress' data-tsp-length='${tsp_type_show_result}'></span>
                                      <label class='ts_poll_r_label'>
                                          ${tsp_vote_type_show == 'countlab' || tsp_vote_type_show == 'percentlab' || tsp_vote_type_show == 'bothlab' ?  tsp_new_title_name  : ''}
                                        <span class='ts_poll_r_info'>
                                        ${tsp_answer_show_by}
                                        </span>
                                      </label>
                                    </span>
                                  </span>
                                </div>
                            </div>`;
                        break;
                    case 'Image in Question':
                    case 'Video in Question':
                        var tsp_vote_btn_show = $("input#ts_poll_vb_show[type='checkbox']").is(":checked") == false ? "ts_poll_e_vote" : "";
                        var tsp_type_show_result = tsp_resalt_after_vote == true ? "0" : "100";
                        var tsp_vote_type_show = $('select#ts_poll_v_t').find(":selected").val();
                        var tsp_answer_show_by = "";
                        switch (tsp_vote_type_show) {
                            case 'percent':
                            case 'percentlab':
                                tsp_answer_show_by = tsp_resalt_after_vote == true ? "0%" : tsp_no_result_text;
                                break;
                            case 'count':
                            case 'countlab':
                                tsp_answer_show_by = tsp_resalt_after_vote == true ? "0" : tsp_no_result_text;
                                break;
                            case 'both':
                            case 'bothlab':
                                tsp_answer_show_by = tsp_resalt_after_vote == true ? "0 ( 0% ) " : tsp_no_result_text;
                                break;
                            default:
                                tsp_answer_show_by = tsp_resalt_after_vote == true ? "0 ( 0% ) " : tsp_no_result_text;
                                break;
                        }
                        tsp_new_element = `
                            <div class='ts_poll_answer' data-tsp-id='${tsp_new_answer_id}'>
                                <input type='radio' class='ts_poll_answer_input'
                                      id='ts_poll_answer_input_${tsp_question_id}-${tsp_new_answer_id}'
                                      name='ts_poll_all${tsp_question_id}'
                                      value='${tsp_new_answer_id}'>
                                <label class='ts_poll_answer_label ${tsp_vote_btn_show}' for='ts_poll_answer_input_${tsp_question_id}-${tsp_new_answer_id}'>
                                    ${tsp_new_title_name}
                                </label>
                                <span class='ts_poll_r_block'>
                                  <span class='ts_poll_r_inner'>
                                    <span class='ts_poll_r_progress' data-tsp-length='${tsp_type_show_result}'></span>
                                    <label class='ts_poll_r_label'>
                                      ${tsp_vote_type_show == 'countlab' || tsp_vote_type_show == 'percentlab' || tsp_vote_type_show == 'bothlab' ?  tsp_new_title_name  : ''}
                                      <span class='ts_poll_r_info'>
                                        ${tsp_answer_show_by}
                                      </span>
                                    </label>
                                  </span>
                                </span>
                            </div>`;
                        break;
                }
                $(tsp_new_element).insertAfter($(`main.ts_poll_main_${tsp_question_id} > .ts_poll_answer`).last());
                if (tsp_style_special.length == 0) {
                    tsp_style_special.push(`
                    main.ts_poll_main_${tsp_question_id}[data-tsp-color="Background"] > .ts_poll_answer[data-tsp-id="${tsp_new_answer_id}"]{
                        background-color: var(--tsp_a_c_${tsp_question_id}-${tsp_new_answer_id});
                    }`);
                    tsp_style_special.push(`
                    main.ts_poll_main_${tsp_question_id}[data-tsp-color="Color"] > .ts_poll_answer[data-tsp-id="${tsp_new_answer_id}"]   .ts_poll_answer_label{
                        color: var(--tsp_a_c_${tsp_question_id}-${tsp_new_answer_id});
                    }`);
                    tsp_style_special.push(`
                    main.ts_poll_main_${tsp_question_id}[data-tsp-voted="Background"] > .ts_poll_answer[data-tsp-id="${tsp_new_answer_id}"]  span.ts_poll_r_progress{
                        background-color: var(--tsp_a_c_${tsp_question_id}-${tsp_new_answer_id});
                    }`);
                    tsp_style_special.push(`
                    main.ts_poll_main_${tsp_question_id}[data-tsp-voted="Color"] > .ts_poll_answer[data-tsp-id="${tsp_new_answer_id}"]  label.ts_poll_r_label{
                        color: var(--tsp_a_c_${tsp_question_id}-${tsp_new_answer_id});
                    }`);
                }
                var tsp_special_stylesheet = document.querySelector(`#ts_poll_special_${tsp_question_id}-css`).sheet;
                if (tsp_style_special.length != 0) {
                    for (let i = 0; i < tsp_style_special.length; i++) {
                        tsp_special_stylesheet.insertRule(tsp_style_special[i], 0);
                    }
                }
            }

            $(document).on('click', '.tsp_shortcode_div > span', function(event) {
                event.stopPropagation();
                event.preventDefault();
                var tsp_value_shortcode = $(`input#${$(this).attr("data-tsp-copy")}`).val();
                var tsp_create_input = document.createElement("input");
                tsp_create_input.setAttribute("value", tsp_value_shortcode);
                document.body.appendChild(tsp_create_input);
                tsp_create_input.select();
                document.execCommand("copy");
                document.body.removeChild(tsp_create_input);
                setTimeout(() => {
                    if ($(this).attr("data-tsp-copy") == "tsp_global_shortcode") {
                        toastr["success"](tspoll_builder_json.shortcode_note, tspoll_builder_json.success, { "closeButton": true, "newestOnTop": false, "progressBar": true, "positionClass": "toast-top-right", "preventDuplicates": true, "showDuration": "300", "hideDuration": "1000", "timeOut": "3000", "extendedTimeOut": "1000", "showEasing": "swing", "hideEasing": "linear", "showMethod": "fadeIn", "hideMethod": "fadeOut", });
                    } else {
                        toastr["success"](tspoll_builder_json.shortcode_theme_note, tspoll_builder_json.success, { "closeButton": true, "newestOnTop": false, "progressBar": true, "positionClass": "toast-top-right", "preventDuplicates": true, "showDuration": "300", "hideDuration": "1000", "timeOut": "3000", "extendedTimeOut": "1000", "showEasing": "swing", "hideEasing": "linear", "showMethod": "fadeIn", "hideMethod": "fadeOut", });
                    }

                }, 100);
            });

            $(document).on('click', `span#tsp_question_title_e,header.ts_poll_header_${tsp_question_id} .ts_poll_title_${tsp_question_id}`, function(event) {
                $('.tsp_sidebar_item[data-tsp-item="shortcode"]').trigger("click");
                var tsp_title_input = $('input#tsp_global_title');
                var tsp_title_input_l = tsp_title_input.val().length;
                tsp_title_input.focus();
                tsp_title_input[0].setSelectionRange(tsp_title_input_l, tsp_title_input_l);
            });

            $(document).on('input', 'input#tsp_global_title', function(event) {
                tspoll_builder_json.tsp_proporties.Question_Title = $(this).val();
                $("#tsp_question_title_e").text($(this).val());
                $(`.ts_poll_header_${tsp_question_id} > .ts_poll_title_${tsp_question_id},.ts_poll_r_header_${tsp_question_id} > .ts_poll_title_${tsp_question_id}`).text(tspoll_builder_json.tsp_proporties.Question_Title);
            });

            $('.ts-poll-select-icon > i.ts-poll-none').each(function() {
                $(this).attr("class", "ts-poll ts-poll-ban");
            });

            // TSP Aim modal
            // Close Picker function
            function tspCloseIconPicker() {
                $("#ts-poll-aim-modal").attr("style", "display:none;");
                $(".ts-poll-aim-icon-item.ts-poll-aim-icon-item-aesthetic-selected").each(function() {
                    $(this).removeClass("ts-poll-aim-icon-item-aesthetic-selected");
                });
                $("#ts-poll-aim-modal--search_input").val("");
            }

            $(document).on('click', '.ts-poll-aim-modal--header-close-btn', tspCloseIconPicker);

            // Set Icon  function
            function tspSetIconClass(changeItem, changeAttr, changeValue) {
                if (changeAttr == "class") {
                    var tsp_elem_classlist = $(`${changeItem}`).attr("class");
                    var tsp_elem_arr = tsp_elem_classlist.split(" ");
                    var tsp_removed_elems = [];
                    tsp_elem_arr.forEach(element => {
                        if (element.indexOf('ts-poll') > -1) {
                            tsp_removed_elems.push(element);
                        }
                    });
                    tsp_elem_arr = tsp_elem_arr.filter(function(val) {
                        return tsp_removed_elems.indexOf(val) == -1;
                    });
                    var tsp_add_classes = changeValue.split(" ");
                    var tsp_result_classes = tsp_elem_arr.concat(tsp_add_classes);
                    tsp_result_classes = tsp_result_classes.join(" ");
                    $(`${changeItem}`).attr("class", tsp_result_classes);
                } else {
                    document.documentElement.style.setProperty(changeItem, `"\\${tspGetKeyByValue(tsp_all_fonts, changeValue)}"`);
                }
                tspCloseIconPicker();
            }

            $(document).on('click', '#ts-poll-aim-insert-icon-button', function() {
                var tsp_selected_icon = $('.ts-poll-aim-icon-item.ts-poll-aim-icon-item-aesthetic-selected');
                var tsp_select_item_for = $(this).attr("data-tsp-field");
                var tsp_select_item = $(`.ts-poll-select-icon#${tsp_select_item_for}`);
                var tsp_selected_value = "";
                var tsp_input_icon_value = $(`#${tsp_select_item_for}-icon_value`);
                if ($(tsp_selected_icon).length != 0) {
                    if ($(tsp_selected_icon).attr("data-library-id") == "ts-poll-regular") {
                        tsp_selected_value = `ts-poll ts-poll-${$(tsp_selected_icon).attr("data-filter")}`;
                    } else {
                        tsp_selected_value = `ts-poll-emoji ts-poll-emoji-${$(tsp_selected_icon).attr("data-filter")}`;
                    }
                    $(tsp_input_icon_value).attr("value", tsp_selected_value);

                    tspSetIconClass($(tsp_input_icon_value).attr("data-tsp-elem"), $(tsp_input_icon_value).attr("data-change-prop"), tsp_selected_value);

                    $(tsp_select_item).children("i").attr("class", tsp_selected_value);
                    if (tsp_styles.hasOwnProperty(`${tsp_select_item_for}`)) {
                        tsp_styles[tsp_select_item_for] = tsp_selected_value;
                    }
                } else {
                    if (tsp_select_item_for == "ts_poll_ch_tbc" || tsp_select_item_for == "ts_poll_ch_tac") {
                        toastr["warning"](tspoll_builder_json.icon_warning, tspoll_builder_json.warning, tsp_toastr_options);
                    } else {
                        $(tsp_select_item).children("i").attr("class", "ts-poll ts-poll-ban");
                        tsp_selected_value = "ts-poll ts-poll-none";
                        $(tsp_input_icon_value).attr("value", tsp_selected_value);
                        if (tsp_styles.hasOwnProperty(`${tsp_select_item_for}`)) {
                            tsp_styles[tsp_select_item_for] = tsp_selected_value;
                        }
                        tspSetIconClass($(tsp_input_icon_value).attr("data-tsp-elem"), $(tsp_input_icon_value).attr("data-change-prop"), tsp_selected_value);
                    }
                }
            });

            // Change sidebar items
            $(document).on('click', '.ts-poll-aim-modal--sidebar-tab-item', function() {
                if (!$(this).hasClass('aesthetic-active')) {
                    $(".ts-poll-aim-modal--sidebar-tab-item.aesthetic-active").each(function() {
                        $(this).removeClass("aesthetic-active");
                    });
                    $(this).addClass("aesthetic-active");
                    if ($(this).attr("data-library-id") == "all") {
                        $(".ts-poll-aim-icon-item").each(function() {
                            $(this).removeAttr("style");
                        });
                    } else {
                        $(`.ts-poll-aim-icon-item[data-library-id="${$(this).attr('data-library-id')}"]`).each(function() {
                            $(this).removeAttr("style");
                        });
                        $(`.ts-poll-aim-icon-item:not([data-library-id="${$(this).attr('data-library-id')}"])`).each(function() {
                            $(this).attr("style", "display:none;");
                        });
                        $('.ts-poll-aim-modal--icon-preview-inner').animate({
                            scrollTop: 0
                        }, 50);
                    }

                    if ($("#ts-poll-aim-modal--search_input").val() != "") {
                        $("#ts-poll-aim-modal--search_input").trigger('input');
                    }
                }
            });

            // change selected icon
            $(document).on('click', 'div.ts-poll-aim-icon-item', function() {
                if ($(this).hasClass("ts-poll-aim-icon-item-aesthetic-selected")) {
                    $(this).removeClass("ts-poll-aim-icon-item-aesthetic-selected");
                } else {
                    $(".ts-poll-aim-icon-item.ts-poll-aim-icon-item-aesthetic-selected").each(function() {
                        $(this).removeClass("ts-poll-aim-icon-item-aesthetic-selected");
                    });
                    $(this).addClass("ts-poll-aim-icon-item-aesthetic-selected");
                }
            });

            // Init picker
            $(document).on('click', '.ts-poll-icon-picker-wrap > .icon-picker > .ts-poll-select-icon', function() {
                $("#ts-poll-aim-modal").attr("style", "display:flex;");
                $(".ts-poll-aim-icon-item.ts-poll-aim-icon-item-aesthetic-selected").each(function() {
                    $(this).removeClass("ts-poll-aim-icon-item-aesthetic-selected");
                });
                var tsp_select_item_for = $(this).attr("id");
                $("#ts-poll-aim-insert-icon-button").attr("data-tsp-field", tsp_select_item_for);
                var tsp_select_item = $(this);
                var tsp_current = $(this).find("i").attr("class");
                if (tsp_current == "ts-poll ts-poll-ban") {
                    $('.ts-poll-aim-modal--sidebar-tab-item[data-library-id="all"]').trigger("click");
                    $('.ts-poll-aim-modal--icon-preview-inner').animate({
                        scrollTop: 0
                    }, 50);
                } else {
                    $(`.ts-poll-aim-icon-item > .ts-poll-aim-icon-item-inner >  i[class='${tsp_current}']`).parent().parent().addClass('ts-poll-aim-icon-item-aesthetic-selected');
                    var tsp_selected_library = $(`.ts-poll-aim-icon-item > .ts-poll-aim-icon-item-inner >  i[class='${tsp_current}']`).parent().parent().attr('data-library-id');
                    $(`.ts-poll-aim-modal--sidebar-tab-item[data-library-id="${tsp_selected_library}"]`).trigger("click");
                    var position = $(`.ts-poll-aim-icon-item > .ts-poll-aim-icon-item-inner >  i[class='${tsp_current}']`).parent().parent().offset().top -
                        $('.ts-poll-aim-modal--icon-preview-inner').offset().top +
                        $('.ts-poll-aim-modal--icon-preview-inner').scrollTop() - 10;
                    $('.ts-poll-aim-modal--icon-preview-inner').animate({
                        scrollTop: position
                    });
                }
                // when click outside close modal
                $(document).mouseup(function(e) {
                    if (!$(".ts-poll-aim-modal--content").is(e.target) && $(".ts-poll-aim-modal--content").has(e.target).length === 0) {
                        tspCloseIconPicker();
                    }
                });
            });

            // Set icon none
            $(document).on('click', '.tsp-set-icon-none', function() {
                var tsp_selection_field = $(this).parent().parent().attr("data-tsp-field");
                $(`.icon-picker li#${tsp_selection_field} > i`).attr("class", "ts-poll ts-poll-ban")
                var tsp_selected_value = "ts-poll ts-poll-none";
                var tsp_input_icon_value = $(`input#${tsp_selection_field}-icon_value`);
                $(tsp_input_icon_value).attr("value", tsp_selected_value);
                if (tsp_styles.hasOwnProperty(`${tsp_selection_field}`)) {
                    tsp_styles[tsp_selection_field] = tsp_selected_value;
                }
                tspSetIconClass($(tsp_input_icon_value).attr("data-tsp-elem"), $(tsp_input_icon_value).attr("data-change-prop"), tsp_selected_value);
            });

            // Search icon
            $(document).on('input', '#ts-poll-aim-modal--search_input', function() {
                var searchText = $(this).val().toLowerCase();
                var tsp_active_sidebar_item = $(".ts-poll-aim-modal--sidebar-tab-item.aesthetic-active").attr("data-library-id");
                if (searchText == "") {
                    $(`.ts-poll-aim-icon-item[data-library-id="${tsp_active_sidebar_item}"]`).each(function() {
                        $(this).removeAttr("style");
                    });
                } else {
                    switch (tsp_active_sidebar_item) {
                        case "ts-poll-emoji-regular":
                        case "ts-poll-regular":
                            $(`.ts-poll-aim-icon-item[data-library-id="${tsp_active_sidebar_item}"]:not([data-filter*="${searchText}"])`).each(function() {
                                $(this).attr("style", "display:none;");
                            });
                            $(`.ts-poll-aim-icon-item[data-library-id="${tsp_active_sidebar_item}"][data-filter*="${searchText}"]`).each(function() {
                                $(this).removeAttr("style");
                            });
                            break;
                        default:
                            $(`.ts-poll-aim-icon-item:not([data-filter*="${searchText}"])`).each(function() {
                                $(this).attr("style", "display:none;");
                            });
                            $(`.ts-poll-aim-icon-item[data-filter*="${searchText}"]`).each(function() {
                                $(this).removeAttr("style");
                            });
                            break;
                    }
                }
            });

            $(`#tsp_answer_color`).spectrum({
                type: "color",
                showPalette: false,
                togglePaletteOnly: true,
                hideAfterPaletteSelect: true,
                showInput: true,
                showInitial: true,
                showButtons: false,
                move: function(color) {
                    $(this).val(color.toRgbString());
                    document.documentElement.style.setProperty(`--tsp_a_c_${tsp_question_id}-${tsp_edit_elem_id}`, color.toRgbString());
                    if (tsp_answers_props_arr[`${tsp_edit_elem_id}`].Answer_Param.hasOwnProperty(`TotalSoftPoll_Ans_Cl`)) {
                        tsp_answers_props_arr[`${tsp_edit_elem_id}`].Answer_Param.TotalSoftPoll_Ans_Cl = color.toRgbString();
                    }
                },
            });

            $(document).on('input', 'input#tsp_answer_title[type="text"]', function() {
                if (tsp_answers_props_arr[`${tsp_edit_elem_id}`].hasOwnProperty(`Answer_Title`)) {
                    tsp_answers_props_arr[`${tsp_edit_elem_id}`].Answer_Title = $(this).val();
                }
                switch (tsp_theme_name) {
                    case 'Standart Poll':
                    case 'Standard Poll':
                        if ($("input#ts_poll_p_shpop").length) {
                            $(`main.ts_poll_main_${tsp_question_id} > .ts_poll_answer[data-tsp-id='${tsp_edit_elem_id}'] span`).html(`${$(this).val()}`);
                            $(`main.ts_poll_r_main_${tsp_question_id} > .ts_poll_answer_result[data-tsp-id='${tsp_edit_elem_id}'] .ts_poll_r_answer_title`).html(`${$(this).val()}`);
                        } else {
                            var tsp_vote_type_show = $('select#ts_poll_v_t').find(":selected").val();
                            $(`main.ts_poll_main_${tsp_question_id} > .ts_poll_answer[data-tsp-id='${tsp_edit_elem_id}'] .ts_poll_answer_label`).html(`${$(this).val()}`);
                            if (tsp_vote_type_show == 'countlab' || tsp_vote_type_show == 'percentlab' || tsp_vote_type_show == 'bothlab') {
                                $(`main.ts_poll_main_${tsp_question_id} > .ts_poll_answer[data-tsp-id='${tsp_edit_elem_id}'] .ts_poll_r_label`).html(`${$(this).val()}`);
                            }
                        }
                        break;
                    case 'Image Poll':
                    case 'Video Poll':
                        var tsp_vote_type_show = $('select#ts_poll_p_a_vt').find(":selected").val();
                        $(`main.ts_poll_main_${tsp_question_id} > .ts_poll_answer[data-tsp-id='${tsp_edit_elem_id}'] img`).attr("alt", `${$(this).val()}`);
                        $(`main.ts_poll_main_${tsp_question_id} > .ts_poll_answer[data-tsp-id='${tsp_edit_elem_id}'] .ts_poll_answer_label  span`).html(`${$(this).val()}`);
                        if (tsp_vote_type_show == 'countlab' || tsp_vote_type_show == 'percentlab' || tsp_vote_type_show == 'bothlab') {
                            $(`main.ts_poll_main_${tsp_question_id} > .ts_poll_answer[data-tsp-id='${tsp_edit_elem_id}'] .ts_poll_after_div  .ts_poll_r_answer_title`).html(`${$(this).val()}`);
                        }
                        break;
                    case 'Standart Without Button':
                    case 'Standard Without Button':
                        var tsp_vote_type_show = $('select#ts_poll_v_t').find(":selected").val();
                        $(`main.ts_poll_main_${tsp_question_id} > .ts_poll_answer[data-tsp-id='${tsp_edit_elem_id}'] .ts_poll_answer_label`).html(`${$(this).val()}`);
                        if (tsp_vote_type_show == 'countlab' || tsp_vote_type_show == 'percentlab' || tsp_vote_type_show == 'bothlab') {
                            $(`main.ts_poll_main_${tsp_question_id} > .ts_poll_answer[data-tsp-id='${tsp_edit_elem_id}'] .ts_poll_r_label`).html(`${$(this).val()}`);
                        }
                        break;
                    case 'Image Without Button':
                    case 'Video Without Button':
                        var tsp_vote_type_show = $('select#ts_poll_v_t').find(":selected").val();
                        $(`main.ts_poll_main_${tsp_question_id} > .ts_poll_answer[data-tsp-id='${tsp_edit_elem_id}'] img`).attr("alt", `${$(this).val()}`);
                        $(`main.ts_poll_main_${tsp_question_id} > .ts_poll_answer[data-tsp-id='${tsp_edit_elem_id}'] .ts_poll_answer_label `).html(`${$(this).val()}`);
                        if (tsp_vote_type_show == 'countlab' || tsp_vote_type_show == 'percentlab' || tsp_vote_type_show == 'bothlab') {
                            $(`main.ts_poll_main_${tsp_question_id} > .ts_poll_answer[data-tsp-id='${tsp_edit_elem_id}'] .ts_poll_r_label`).html(`${$(this).val()}`);
                        }
                        break;
                    case 'Image in Question':
                    case 'Video in Question':
                        var tsp_vote_type_show = $('select#ts_poll_v_t').find(":selected").val();
                        $(`main.ts_poll_main_${tsp_question_id} > .ts_poll_answer[data-tsp-id='${tsp_edit_elem_id}'] .ts_poll_answer_label `).html(`${$(this).val()}`);
                        if (tsp_vote_type_show == 'countlab' || tsp_vote_type_show == 'percentlab' || tsp_vote_type_show == 'bothlab') {
                            $(`main.ts_poll_main_${tsp_question_id} > .ts_poll_answer[data-tsp-id='${tsp_edit_elem_id}'] .ts_poll_r_label`).html(`${$(this).val()}`);
                        }
                        break;


                }
                $(`.tsp-list-item[aria-tsp-answer="${tsp_edit_elem_id}"] h2`).html($(this).val());
            });
            // Add new answer
            $(document).on('click', '#tsp-add_answer', function() {
                tspAddNewAnswer("add", "New answer");
            });

            // Delete answer
            $(document).on('click', '.tsp_list_action[data-tsp-action="delete"]', function() {
                if ($("#tsp-list > .tsp-list-item").length <= 2) {
                    toastr["error"](tspoll_builder_json.amount_warning, tspoll_builder_json.error, tsp_toastr_options);
                    return;
                }
                var tsp_delete_answer_id = $(this).parent().attr("aria-tsp-answer");
                $(`main.ts_poll_main_${tsp_question_id} > .ts_poll_answer[data-tsp-id='${tsp_delete_answer_id}']`).remove();
                if (tsp_theme_name == "Standart Poll" || tsp_theme_name == "Standard Poll") {
                    $(`main.ts_poll_r_main_${tsp_question_id} > .ts_poll_answer_result[data-tsp-id='${tsp_delete_answer_id}']`).remove();
                }
                $(this).parent().remove();
                delete tsp_answers_props_arr[tsp_delete_answer_id];
                tsp_delete_ids.push(tsp_delete_answer_id);
                toastr["success"](tspoll_builder_json.delete_note, tspoll_builder_json.success, tsp_toastr_options);
                if (tsp_edit_elem_id == tsp_delete_answer_id) {
                    $(".tsp_back_to_answers").trigger("click");
                }
            });

            // Edit answer
            $(document).on('click', '.tsp_list_action[data-tsp-action="edit"]', function() {
                tsp_edit_elem_id = $(this).parent().attr("aria-tsp-answer");
                $("input#tsp_answer_title").val(tsp_answers_props_arr[`${tsp_edit_elem_id}`].Answer_Title);
                $("#tsp_answer_color").spectrum("set", tsp_answers_props_arr[`${tsp_edit_elem_id}`].Answer_Param.TotalSoftPoll_Ans_Cl);
                if (tsp_theme_name == "Image Poll" || tsp_theme_name == "Video Poll" || tsp_theme_name == "Image Without Button" || tsp_theme_name == "Video Without Button") {
                    if (tsp_answers_props_arr[`${tsp_edit_elem_id}`].Answer_Param.TotalSoftPoll_Ans_Im == "") {
                        tspSetImage("embed", "", tspoll_builder_json.tsp_no_img, "600", "600");
                    } else {
                        $.ajax({
                            url: tspoll_builder_json.ajaxurl,
                            data: {
                                action: 'tsp_get_attachment_id',
                                tsp_nonce: tspoll_builder_json.tsp_nonce,
                                attachment_url: tsp_answers_props_arr[`${tsp_edit_elem_id}`].Answer_Param.TotalSoftPoll_Ans_Im
                            },
                            beforeSend: function() {
                                $("div.tsp_img_loading_div").removeAttr("style");
                            },
                            type: 'POST',
                        }).done(function(response) {
                            if (response.success === true) {
                                if (response.data.hasOwnProperty('id')) {
                                    tspSetImage("library", response.data.id, response.data.image, response.data.width, response.data.height);
                                } else {
                                    tspSetImage("embed", "", response.data.image, response.data.width, response.data.height);
                                }
                            }
                        }).fail(function() {
                            tspSetImage("embed", "", tspoll_builder_json.tsp_no_img, "600", "600");
                        });

                    }
                    if (tsp_theme_name == "Video Poll" || tsp_theme_name == "Video Without Button") {
                        if (tsp_answers_props_arr[`${tsp_edit_elem_id}`].Answer_Param.TotalSoftPoll_Ans_Vd == "") {
                            jQuery('input#tsp_answer_video_attachment_id').val('');
                            jQuery('.tsp_vd_change > iframe').attr("style", "display:none;");
                            jQuery('.tsp_vd_change > img').removeAttr("style");
                            $(".tsp_img_div_edit").attr("style", "display:none;");
                        } else {
                            var data = {
                                action: 'tsp_check_attachment',
                                tsp_nonce: tspoll_builder_json.tsp_nonce,
                                attachment_url: tsp_answers_props_arr[`${tsp_edit_elem_id}`].Answer_Param.TotalSoftPoll_Ans_Vd
                            };
                            jQuery.post(tspoll_builder_json.ajaxurl, data, function(response) {
                                if (response.success === true) {
                                    jQuery('.tsp_vd_change').children("iframe").remove();
                                    jQuery('.tsp_vd_change').children("video").remove();
                                    jQuery('.tsp_vd_change').children("blockquote").remove();
                                    jQuery('.tsp_img_div_edit').removeAttr("style");
                                    jQuery('input#tsp_answer_video_attachment_id').val(response.data);
                                    jQuery('.tsp_vd_change').prepend(`<video controls="" name="media"><source src="${data.attachment_url}"></video>`);
                                    jQuery('.tsp_vd_change > img').attr("style", "display:none;");
                                } else {
                                    wp.apiRequest({
                                        url: wp.media.view.settings.oEmbedProxyUrl,
                                        data: {
                                            url: tsp_answers_props_arr[`${tsp_edit_elem_id}`].Answer_Param.TotalSoftPoll_Ans_Vd,
                                        },
                                        beforeSend: function() {
                                            $(".tsp_vd_loading_div").removeAttr("style");
                                        },
                                        type: 'GET',
                                        dataType: 'json',
                                        context: this
                                    }).done(function(responseApi) {
                                        if (responseApi.provider_name == "Embed Handler") {
                                            responseApi.html = `<video controls="" name="media"><source src="${data.url}" ></video>`;
                                        }
                                        jQuery('.tsp_vd_change').children("iframe").remove();
                                        jQuery('.tsp_vd_change').children("video").remove();
                                        jQuery('.tsp_vd_change').children("blockquote").remove();

                                        jQuery('.tsp_img_div_edit').removeAttr("style");
                                        jQuery('input#tsp_answer_video_attachment_id').val(tsp_answers_props_arr[`${tsp_edit_elem_id}`].Answer_Param.TotalSoftPoll_Ans_Vd);
                                        jQuery('.tsp_vd_change > img').attr("style", "display:none;");
                                        jQuery('.tsp_vd_change').prepend(responseApi.html);
                                        $(".tsp_vd_loading_div").attr("style", "display:none;");
                                    }).fail(function() {
                                        $(".tsp_vd_loading_div").attr("style", "display:none;");
                                    });
                                }
                            });
                        }
                    }

                }
                $("main.tsp_content_fields_menu").attr("style", "display:none;");
                $("main.tsp_content_fields_edit").removeAttr("style");
            });

            $(document).on('click', '.tsp_back_to_answers', function() {
                $("main.tsp_content_fields_edit").attr("style", "display:none;");
                $("main.tsp_content_fields_menu").removeAttr("style");
                jQuery('input#tsp_answer_video_attachment_id').val('');
                jQuery('.tsp_content_fields_edit .tsp_vd_change > iframe,.tsp_content_fields_edit .tsp_vd_change > video,.tsp_content_fields_edit .tsp_vd_change > blockquote').remove();
                jQuery('.tsp_content_fields_edit .tsp_vd_change > img').removeAttr("style");
                tsp_edit_elem_id = "";
            });

            // Copy answer
            $(document).on('click', '.tsp_list_action[data-tsp-action="copy"]', function() {
                var tsp_copied_elem = $(this).parent();
                tspAddNewAnswer("copy", $(tsp_copied_elem).children(".details").children("h2").text(), $(tsp_copied_elem).attr("aria-tsp-answer"));
            });


            // Spectrum Color Picker Init
            $('input[data-tsp-field="color"]').each(function() {
                var tsp_spectrum_element_id = $(this).attr('id');
                $(`#${$(this).attr('id')}`).spectrum({
                    type: "color",
                    showPalette: false,
                    togglePaletteOnly: true,
                    hideAfterPaletteSelect: true,
                    showInput: true,
                    showInitial: true,
                    showButtons: false,
                    showAlpha: true,
                    move: function(color) {
                        $(this).val(color.toRgbString());
                        document.documentElement.style.setProperty($(this).attr('data-tsp-change'), color.toRgbString());
                        if (tsp_styles.hasOwnProperty(`${tsp_spectrum_element_id}`)) {
                            tsp_styles[tsp_spectrum_element_id] = color.toRgbString();
                        } else if (tsp_theme_settings.hasOwnProperty(`${tsp_spectrum_element_id}`)) {
                            tsp_theme_settings[tsp_spectrum_element_id] = color.toRgbString();
                        }
                    },
                });
            });

            //Accordion style sidebar
            $(document).on('click', '.tsp_accordion_header', function() {
                if ($(this).parent().hasClass('tsp_accordion_item_opened')) {
                    $(this).parent().children('.tsp_accordion_item_content').removeAttr('style');
                    $(this).parent().removeClass('tsp_accordion_item_opened');
                } else if ($('.tsp_accordion_item_opened').length > 0) {
                    $('.tsp_accordion_item_opened').children('.tsp_accordion_item_content').removeAttr('style');
                    $('.tsp_accordion_item_opened').removeClass('tsp_accordion_item_opened');
                    $(this).parent().children('.tsp_accordion_item_content').height(`${$(this).parent().children('.tsp_accordion_item_content').prop("scrollHeight")}px`);
                    $(this).parent().addClass('tsp_accordion_item_opened');
                } else {
                    $(this).parent().children('.tsp_accordion_item_content').height(`${$(this).parent().children('.tsp_accordion_item_content').prop("scrollHeight")}px`);
                    $(this).parent().addClass('tsp_accordion_item_opened');
                }
            });

            $(document).on('click', '.tsp_position_select > .tsp_position_item:not(.tsp_active)', function(event) {
                event.preventDefault();
                $(this).siblings().removeClass('tsp_active');
                $(this).addClass('tsp_active');
                var tsp_change_style = $(this).parent().attr('data-tsp-select');
                if (tsp_styles.hasOwnProperty(`${tsp_change_style}`)) {
                    tsp_styles[tsp_change_style] = $(this).attr('data-tsp-pos');
                }
                if (tsp_theme_name == "Video Poll" || tsp_theme_name == "Image Poll") {
                    if (tsp_change_style == "ts_poll_a_ihr") {
                        tsp_styles["ts_poll_a_ih"] = $(this).attr('data-tsp-pos');
                    }
                }
                $(`${$(this).parent().attr('data-change-elem')}`).attr(`${$(this).parent().attr('data-change-prop')}`, $(this).attr('data-tsp-pos'));
            });

            $(document).on('input', '.tsp_range_input', function(event) {
                $(`.tsp_range_div_title[data-tsp-field="${$(this).attr('id')}"]`).attr('data-tsp-length', `${event.target.value}${$(this).attr('data-tsp-param')}`);
                var tsp_range_width = (100 * ($(this).val() - $(this).attr('min'))) / ($(this).attr('max') - $(this).attr('min')),
                    tsp_range_background = `linear-gradient(90deg, #8871c3 ${tsp_range_width}%, rgba(204, 204, 204, 0.214) ${tsp_range_width +
                        0.1}%)`;
                $(this).css('background', tsp_range_background);
                var tsp_change_style = $(this).attr('id');
                if (tsp_styles.hasOwnProperty(`${tsp_change_style}`)) {
                    tsp_styles[tsp_change_style] = event.target.value;
                } else if (tsp_theme_settings.hasOwnProperty(`${tsp_change_style}`)) {
                    tsp_theme_settings[tsp_change_style] = event.target.value;
                }
                document.documentElement.style.setProperty($(this).attr('data-tsp-change'), `${$(this).val() + $(this).attr('data-tsp-param')}`);
            });

            $(document).on('input', 'input.tsp_checkbox_input', function(event) {
                if (tsp_styles.hasOwnProperty(`${$(this).attr("id")}`)) {
                    tsp_styles[`${$(this).attr("id")}`] = `${$(this).is(':checked')}`;
                } else if (tsp_theme_settings.hasOwnProperty(`${$(this).attr("id")}`)) {
                    tsp_theme_settings[`${$(this).attr("id")}`] = `${$(this).is(':checked')}`;
                }
                if ($(this).is(':checked')) {
                    $(`${$(this).attr('data-change-elem')}`).attr(`${$(this).attr('data-change-prop')}`, $(this).parent().attr('data-tsp-check'));
                } else {
                    $(`${$(this).attr('data-change-elem')}`).attr(`${$(this).attr('data-change-prop')}`, $(this).parent().attr('data-tsp-uncheck'));
                }
                if ($(this).attr("id") == "TotalSoft_Poll_Set_01") {
                    $("select#ts_poll_v_t,select#ts_poll_p_a_vt").trigger("change");
                }
            });

            $('.tsp_range_input').trigger('input');

            $(document).on('input', 'input.tsp_text_input', function(event) {
                $(`${$(this).attr('data-tsp-elem')}`).attr(`${$(this).attr('data-change-prop')}`, event.target.value);
                var tsp_change_style = $(this).attr('id');
                if (tsp_styles.hasOwnProperty(`${tsp_change_style}`)) {
                    tsp_styles[tsp_change_style] = event.target.value;
                } else if (tsp_theme_settings.hasOwnProperty(`${tsp_change_style}`)) {
                    tsp_theme_settings[tsp_change_style] = event.target.value;
                }
                if ($(this).attr("id") == "TotalSoft_Poll_Set_05") {
                    $("select#ts_poll_v_t,select#ts_poll_p_a_vt").trigger("change");
                }

            });
            $(document).on('change', '.tsp_select_div > select', function(event) {
                if (tsp_styles.hasOwnProperty(`${$(this).attr("id")}`)) {
                    tsp_styles[`${$(this).attr("id")}`] = `${event.target.value}`;
                } else if (tsp_theme_settings.hasOwnProperty(`${$(this).attr("id")}`)) {
                    tsp_theme_settings[`${$(this).attr("id")}`] = `${event.target.value}`;
                }
                if ($(this).hasClass('tsp_root_elem')) {
                    document.documentElement.style.setProperty($(this).attr('data-change-prop'), event.target.value);
                } else {
                    $(`${$(this).attr('data-change-elem')}`).attr(`${$(this).attr('data-change-prop')}`, event.target.value);
                }

                if ($(this).attr("id") == "ts_poll_a_iht") {
                    if (event.target.value == "fixed") {
                        $(".tsp_position_select[data-tsp-select='ts_poll_a_ihr']").parent().attr("style", "display:none");
                        $(".tsp_range_div_title[data-tsp-field='ts_poll_a_ih']").parent().removeAttr("style");
                        $(`main.ts_poll_main_${tsp_question_id}`).attr("data-tsp-ratio", "none");
                        $(`input#ts_poll_a_ih`).trigger("input");
                    } else {
                        $(".tsp_range_div_title[data-tsp-field='ts_poll_a_ih']").parent().attr("style", "display:none");
                        $(".tsp_position_select[data-tsp-select='ts_poll_a_ihr']").parent().removeAttr("style");
                        if ($(".tsp_position_select[data-tsp-select='ts_poll_a_ihr'] > .tsp_active").length > 0) {
                            $(`main.ts_poll_main_${tsp_question_id}`).attr("data-tsp-ratio", $(".tsp_position_select[data-tsp-select='ts_poll_a_ihr'] > .tsp_active").attr("data-tsp-pos"));
                            tsp_styles["ts_poll_a_ih"] = $(".tsp_position_select[data-tsp-select='ts_poll_a_ihr'] > .tsp_active").attr("data-tsp-pos");

                        } else {
                            $(".tsp_position_select[data-tsp-select='ts_poll_a_ihr > .tsp_position_item']").first().trigger("click");
                        }
                    }
                    $('.tsp_accordion_item_opened.answer-image').children(".tsp_accordion_item_content").height(`${$('.tsp_accordion_item_opened.answer-image').children(".tsp_accordion_item_content").children(".tsp_accordion_items").prop("scrollHeight")}px`);
                }
                if ($(this).attr("id") == "ts_poll_v_t" || $(this).attr("id") == "ts_poll_p_a_vt") {
                    var tsp_after_vote_show = event.target.value;
                    if (!$("input#TotalSoft_Poll_Set_01").is(':checked')) {
                        var tsp_after_vote_show_text = $("input#TotalSoft_Poll_Set_05").val();
                        $("#tsp-list > .tsp-list-item").each(function() {
                            var tsp_answer_show_by = "";
                            switch (tsp_after_vote_show) {
                                case 'percent':
                                    tsp_answer_show_by = `<span class="ts_poll_r_info"> ${tsp_after_vote_show_text}</span>`;
                                    break;
                                case 'percentlab':
                                    tsp_answer_show_by = `${$(this).children(".details").children("h2").text()} <span class="ts_poll_r_info"> ${tsp_after_vote_show_text}</span>`;
                                    break;
                                case 'count':
                                    tsp_answer_show_by = `<span class="ts_poll_r_info"> ${tsp_after_vote_show_text} </span>`;
                                    break;
                                case 'countlab':
                                    tsp_answer_show_by = `${$(this).children(".details").children("h2").text()} <span class="ts_poll_r_info"> ${tsp_after_vote_show_text} </span>`;
                                    break;
                                case 'both':
                                    tsp_answer_show_by = `<span class="ts_poll_r_info"> ${tsp_after_vote_show_text} </span>`;
                                    break;
                                case 'bothlab':
                                    tsp_answer_show_by = `${$(this).children(".details").children("h2").text()} <span class="ts_poll_r_info"> ${tsp_after_vote_show_text} </span>`;
                                    break;
                            }

                            switch (tsp_theme_name) {
                                case 'Standart Poll':
                                case 'Standard Poll':
                                    if ($("input#ts_poll_p_shpop").length) {

                                        $(`.ts_poll_r_main_${tsp_question_id} .ts_poll_answer_result[data-tsp-id="${$(this).attr('aria-tsp-answer')}"] .ts_poll_answer_info_line`).html(tsp_after_vote_show_text);
                                    } else {
                                        $(`.ts_poll_answer[data-tsp-id="${$(this).attr('aria-tsp-answer')}"] .ts_poll_r_label`).html(tsp_answer_show_by);
                                    }
                                    break;
                                case 'Image Poll':
                                case 'Video Poll':
                                    switch (tsp_after_vote_show) {
                                        case 'percent':
                                            tsp_answer_show_by = `<span class="ts_poll_answer_percent_line"> ${tsp_after_vote_show_text}</span>`;
                                            break;
                                        case 'percentlab':
                                            tsp_answer_show_by = `<span class="ts_poll_r_answer_title">${$(this).children(".details").children("h2").text()}</span> <span class="ts_poll_answer_percent_line"> ${tsp_after_vote_show_text}</span>`;
                                            break;
                                        case 'count':
                                            tsp_answer_show_by = `<span class="ts_poll_answer_percent_line">${tsp_after_vote_show_text} </span>`;
                                            break;
                                        case 'countlab':
                                            tsp_answer_show_by = `<span class="ts_poll_r_answer_title">${$(this).children(".details").children("h2").text()}</span> <span class="ts_poll_answer_percent_line">${tsp_after_vote_show_text} </span>`;
                                            break;
                                        case 'both':
                                            tsp_answer_show_by = `<span class="ts_poll_answer_percent_line"> ${tsp_after_vote_show_text} </span>`;
                                            break;
                                        case 'bothlab':
                                            tsp_answer_show_by = `<span class="ts_poll_r_answer_title">${$(this).children(".details").children("h2").text()}</span> <span class="ts_poll_answer_percent_line"> ${tsp_after_vote_show_text} </span>`;
                                            break;
                                    }
                                    $(`.ts_poll_answer[data-tsp-id="${$(this).attr('aria-tsp-answer')}"] .ts_poll_after_span`).html(tsp_answer_show_by);
                                    break;
                                default:
                                    $(`.ts_poll_answer[data-tsp-id="${$(this).attr('aria-tsp-answer')}"] .ts_poll_r_label`).html(tsp_answer_show_by);
                                    break;
                            }
                        });

                    } else {

                        $("#tsp-list > .tsp-list-item").each(function() {
                            var tsp_answer_show_by = "";
                            switch (tsp_after_vote_show) {
                                case 'percent':
                                    tsp_answer_show_by = `<span class="ts_poll_r_info"> ${$(this).attr("aria-tsp-percent")} % </span>`;
                                    break;
                                case 'percentlab':
                                    tsp_answer_show_by = `${$(this).children(".details").children("h2").text()} <span class="ts_poll_r_info"> ${$(this).attr("aria-tsp-percent")} % </span>`;
                                    break;
                                case 'count':
                                    tsp_answer_show_by = `<span class="ts_poll_r_info"> ${$(this).attr("aria-tsp-count")} </span>`;
                                    break;
                                case 'countlab':
                                    tsp_answer_show_by = `${$(this).children(".details").children("h2").text()} <span class="ts_poll_r_info"> ${$(this).attr("aria-tsp-count")} </span>`;
                                    break;
                                case 'both':
                                    tsp_answer_show_by = `<span class="ts_poll_r_info"> ${$(this).attr("aria-tsp-count")} ( ${$(this).attr("aria-tsp-percent")} % )</span>`;
                                    break;
                                case 'bothlab':
                                    tsp_answer_show_by = `${$(this).children(".details").children("h2").text()} <span class="ts_poll_r_info"> ${$(this).attr("aria-tsp-count")} ( ${$(this).attr("aria-tsp-percent")} % )</span>`;
                                    break;
                            }

                            switch (tsp_theme_name) {
                                case 'Standart Poll':
                                case 'Standard Poll':
                                    if ($("input#ts_poll_p_shpop").length) {
                                        switch (tsp_after_vote_show) {
                                            case 'percent':
                                                tsp_answer_show_by = ` ${$(this).attr("aria-tsp-percent")} % `;
                                                break;

                                            case 'count':
                                                tsp_answer_show_by = ` ${$(this).attr("aria-tsp-count")} `;
                                                break;

                                            case 'both':
                                                tsp_answer_show_by = ` ${$(this).attr("aria-tsp-count")} ( ${$(this).attr("aria-tsp-percent")} % )`;
                                                break;

                                        }
                                        $(`.ts_poll_r_main_${tsp_question_id} .ts_poll_answer_result[data-tsp-id="${$(this).attr('aria-tsp-answer')}"] .ts_poll_answer_info_line`).html(tsp_answer_show_by);
                                    } else {
                                        $(`.ts_poll_answer[data-tsp-id="${$(this).attr('aria-tsp-answer')}"] .ts_poll_r_label`).html(tsp_answer_show_by);
                                    }
                                    break;
                                case 'Image Poll':
                                case 'Video Poll':
                                    switch (tsp_after_vote_show) {
                                        case 'percent':
                                            tsp_answer_show_by = `<span class="ts_poll_answer_percent_line"> ${$(this).attr("aria-tsp-percent")} %</span>`;
                                            break;
                                        case 'percentlab':
                                            tsp_answer_show_by = `<span class="ts_poll_r_answer_title">${$(this).children(".details").children("h2").text()}</span> <span class="ts_poll_answer_percent_line"> ${$(this).attr("aria-tsp-percent")} %</span>`;
                                            break;
                                        case 'count':
                                            tsp_answer_show_by = `<span class="ts_poll_answer_percent_line"> ${$(this).attr("aria-tsp-count")} </span>`;
                                            break;
                                        case 'countlab':
                                            tsp_answer_show_by = `<span class="ts_poll_r_answer_title">${$(this).children(".details").children("h2").text()}</span> <span class="ts_poll_answer_percent_line"> ${$(this).attr("aria-tsp-count")} </span>`;
                                            break;
                                        case 'both':
                                            tsp_answer_show_by = `<span class="ts_poll_answer_percent_line"> ${$(this).attr("aria-tsp-count")} ( ${$(this).attr("aria-tsp-percent")} % )</span>`;
                                            break;
                                        case 'bothlab':
                                            tsp_answer_show_by = `<span class="ts_poll_r_answer_title">${$(this).children(".details").children("h2").text()}</span> <span class="ts_poll_answer_percent_line"> ${$(this).attr("aria-tsp-count")} ( ${$(this).attr("aria-tsp-percent")} % )</span>`;
                                            break;
                                    }
                                    $(`.ts_poll_answer[data-tsp-id="${$(this).attr('aria-tsp-answer')}"] .ts_poll_after_span`).html(tsp_answer_show_by);
                                    break;
                                default:
                                    $(`.ts_poll_answer[data-tsp-id="${$(this).attr('aria-tsp-answer')}"] .ts_poll_r_label`).html(tsp_answer_show_by);
                                    break;
                            }
                        });

                    }
                }

                if ($(this).attr("id") == "ts_poll_p_sheff") {
                    $(`.ts_poll_r_section_${tsp_question_id},#ts_poll_modal_result_section_${tsp_question_id}`).removeAttr("style");
                }

            });
            if (tsp_theme_name == "Image Poll" || tsp_theme_name == "Video Poll") {
                $(".tsp_select_div > select#ts_poll_a_iht").trigger('change');
            }
            $(document).on('click', '.tsp_save_btn ', function() {
                var tsp_answer_sort_array = [];
                $("#tsp-list > .tsp-list-item").each(function() {
                    tsp_answer_sort_array.push($(this).attr("aria-tsp-answer"));
                });
                $.ajax({
                    url: tspoll_builder_json.ajaxurl,
                    data: {
                        action: 'tsp_save_question',
                        tsp_nonce: tspoll_builder_json.tsp_nonce,
                        tsp_id: tsp_question_id,
                        tsp_question_title: tspoll_builder_json.tsp_proporties.Question_Title,
                        tsp_answers: tsp_answers_props_arr,
                        tsp_answers_sort: tsp_answer_sort_array,
                        tsp_question_styles: tsp_styles,
                        tsp_question_params: tsp_question_params,
                        tsp_question_settings: tsp_theme_settings,
                        tsp_deleted_answers: tsp_delete_ids
                    },

                    beforeSend: function() {
                        $("section#tsp_loader").attr("style", "z-index: 100053;");
                    },
                    type: 'POST',
                }).done(function(response) {
                    if (response.success === true) {
                        if (response.data.hasOwnProperty("url")) {
                            window.location.href = response.data.url;
                        }
                    } else {
                        toastr["error"](tspoll_builder_json.save_warning, tspoll_builder_json.error, tsp_toastr_options)
                        setTimeout(() => {
                            window.location.href = window.location.href;
                        }, 400);
                    }
                }).fail(function(response) {
                    toastr["error"](tspoll_builder_json.save_warning, tspoll_builder_json.error, tsp_toastr_options)
                    setTimeout(() => {
                        window.location.href = window.location.href;
                    }, 400);
                });
            });
            $.contextMenu({
                selector: `main.ts_poll_main_${tsp_question_id} > div.ts_poll_answer`,
                callback: function(key, options) {
                    var tsp_clicked_context_menu = $(options.$trigger).attr("data-tsp-id");
                    switch (key) {
                        case "delete":
                        case "copy":
                            $(`.tsp-list-item[aria-tsp-answer="${tsp_clicked_context_menu}"] > .tsp_list_action[data-tsp-action="${key}"]`).trigger("click");
                            break;
                        case "edit":
                            if ($(".tsp_sidebar_item.tsp_active").attr("data-tsp-item") !== "field") {
                                $('.tsp_sidebar_item[data-tsp-item="field"]').trigger("click");
                            }
                            $(`.tsp-list-item[aria-tsp-answer="${tsp_clicked_context_menu}"] > .tsp_list_action[data-tsp-action="${key}"]`).trigger("click");
                            break;
                        default:
                            break;
                    }
                },
                items: {
                    "edit": { name: "Edit", icon: "edit" },
                    "copy": { name: "Clone", icon: "copy" },
                    "sep1": "---------",
                    "delete": { name: "Delete", icon: "delete" },
                }
            });

            // Sortable list answers
            $('#tsp-list').sortable({
                cursor: 'move',
                handle: ".tsp_handle_list",
                placeholder: "tsp-portlet-placeholder",
                update: function(event, ui) {
                    if ($(ui.item).prev().attr('aria-tsp-answer') == null) {
                        $(`.ts_poll_answer[data-tsp-id='${$(ui.item).attr("aria-tsp-answer")}']`).insertBefore($('.ts_poll_answer:first-child'));
                        if (tsp_theme_name == "Standart Poll" || tsp_theme_name == "Standard Poll") {
                            $(`.ts_poll_form_${tsp_question_id}  main.ts_poll_r_main_${tsp_question_id} > .ts_poll_answer_result[data-tsp-id='${$(ui.item).attr("aria-tsp-answer")}']`).insertBefore($(`.ts_poll_form_${tsp_question_id}  main.ts_poll_r_main_${tsp_question_id} > .ts_poll_answer_result:first-child`));
                            $(`#ts_poll_modal_result_section_${tsp_question_id}  main.ts_poll_r_main_${tsp_question_id} > .ts_poll_answer_result[data-tsp-id='${$(ui.item).attr("aria-tsp-answer")}']`).insertBefore($(`#ts_poll_modal_result_section_${tsp_question_id}  main.ts_poll_r_main_${tsp_question_id} > .ts_poll_answer_result:first-child`));
                        }
                    } else {
                        $(`.ts_poll_answer[data-tsp-id='${$(ui.item).attr("aria-tsp-answer")}']`).insertAfter($(`.ts_poll_answer[data-tsp-id="${$(ui.item).prev().attr('aria-tsp-answer')}"]`));
                        if (tsp_theme_name == "Standart Poll" || tsp_theme_name == "Standard Poll") {
                            $(`.ts_poll_form_${tsp_question_id}  main.ts_poll_r_main_${tsp_question_id} > .ts_poll_answer_result[data-tsp-id='${$(ui.item).attr("aria-tsp-answer")}']`).insertAfter($(`.ts_poll_form_${tsp_question_id}  main.ts_poll_r_main_${tsp_question_id} > .ts_poll_answer_result[data-tsp-id="${$(ui.item).prev().attr('aria-tsp-answer')}"]`));
                            $(`#ts_poll_modal_result_section_${tsp_question_id}  main.ts_poll_r_main_${tsp_question_id} > .ts_poll_answer_result[data-tsp-id='${$(ui.item).attr("aria-tsp-answer")}']`).insertAfter($(`#ts_poll_modal_result_section_${tsp_question_id}  main.ts_poll_r_main_${tsp_question_id} > .ts_poll_answer_result[data-tsp-id="${$(ui.item).prev().attr('aria-tsp-answer')}"]`));
                        }
                    }
                },
            });

            if (tsp_theme_name == "Image Poll" || tsp_theme_name == "Video Poll" || tsp_theme_name == "Image in Question" || tsp_theme_name == "Image Without Button" || tsp_theme_name == "Video Without Button") {

                jQuery(document).on("click", "div.tsp_img_change", function(e) {
                    e.preventDefault();
                    var tsp_wp_media_library;
                    if (tsp_wp_media_library) { tsp_wp_media_library.open(); }
                    tsp_wp_media_library = wp.media({
                        frame: 'post',
                        type: 'image',
                        multiple: false,
                        states: [new wp.media.controller.Library({
                            title: 'Select image',
                            library: wp.media.query({
                                type: 'image'
                            }),
                            multiple: false,
                            date: false,
                            gallery: false,
                        })]
                    });

                    tsp_wp_media_library.state('embed').on('select', function() {
                        var state = tsp_wp_media_library.state('embed'),
                            type = state.get('type'),
                            embed = state.props.toJSON();
                        if (type == "image") {
                            tspSetImage("embed", "", embed.url, embed.width, embed.height);
                        } else {
                            tspSetImage("embed", "", tspoll_builder_json.tsp_no_img, "600", "600");
                            toastr["error"](tspoll_builder_json.image_warning, tspoll_builder_json.error, tsp_toastr_options);
                        }
                    });

                    tsp_wp_media_library.state('library').on('select', function() {
                        var selection = tsp_wp_media_library.state('library').get('selection'),
                            tsp_selection_id = "";
                        selection.each(function(attachment) {
                            tsp_selection_id = attachment["id"];
                        });
                        if (Number.isInteger(tsp_selection_id)) {
                            var url = wp.media.attachment(tsp_selection_id).get('url');
                            var width = wp.media.attachment(tsp_selection_id).get('width');
                            var height = wp.media.attachment(tsp_selection_id).get('height');
                            tspSetImage("library", tsp_selection_id, url, width, height);
                        }
                    });

                    tsp_wp_media_library.on('open', function() {
                        $("button#menu-item-video-playlist,button#menu-item-playlist,button#menu-item-gallery,button#menu-item-insert").remove();
                        var tsp_selected_attachment = jQuery('input#tsp_answer_attachment_id').val();
                        if (Number.isInteger(+tsp_selected_attachment)) {
                            $("button#menu-item-library").trigger("click");
                            var selection = tsp_wp_media_library.state('library').get('selection');
                            var attachment = wp.media.attachment(+tsp_selected_attachment);
                            attachment.fetch();
                            selection.add(attachment ? [attachment] : []);
                        } else {
                            $("button#menu-item-embed").trigger("click");
                            $("input#embed-url-field").val(tsp_selected_attachment).trigger("input");
                        }
                    });
                    tsp_wp_media_library.open();
                });
            }
            if (tsp_theme_name == "Video Poll" || tsp_theme_name == "Video Without Button" || tsp_theme_name == "Video in Question") {
                jQuery(document).on("click", "div.tsp_vd_change", function(e) {
                    e.preventDefault();
                    var tsp_wp_media_library;
                    if (tsp_wp_media_library) { tsp_wp_media_library.open(); }
                    tsp_wp_media_library = wp.media({
                        frame: 'post',
                        type: 'video',
                        multiple: false,
                        states: [new wp.media.controller.Library({
                            title: 'Select video',
                            library: wp.media.query({
                                type: 'video'
                            }),
                            multiple: false,
                            date: false,
                            gallery: false,
                        })]
                    });
                    tsp_wp_media_library.state('embed').on('select', function() {
                        var state = tsp_wp_media_library.state('embed'),
                            type = state.get('type'),
                            embed = state.props.toJSON(),
                            url = embed.url;
                        var regexp = /https?:\/\/www\.youtube\.com\/embed\/([^/]+)/;
                        var youTubeEmbedMatch = regexp.exec(url);
                        if (youTubeEmbedMatch) {
                            url = 'https://www.youtube.com/watch?v=' + youTubeEmbedMatch[1];
                        }
                        wp.apiRequest({
                            url: wp.media.view.settings.oEmbedProxyUrl,
                            data: {
                                url: url,
                            },
                            beforeSend: function() {
                                $(".tsp_vd_loading_div").removeAttr("style");
                            },
                            type: 'GET',
                            dataType: 'json',
                            context: this
                        }).done(function(response) {

                            if (response.hasOwnProperty("thumbnail_url")) {
                                if (tsp_theme_name != "Video in Question") {
                                    tspSetImage("embed", "", response.thumbnail_url, response.thumbnail_width, response.thumbnail_height);
                                    toastr["info"](tspoll_builder_json.thumbnail_info, tspoll_builder_json.info, tsp_toastr_options);
                                }
                            } else {
                                if (response.provider_name == "Embed Handler") {
                                    response.html = `<video controls="" name="media"><source src="${url}" ></video>`;
                                }
                                if (tsp_theme_name != "Video in Question") {
                                    toastr["warning"](tspoll_builder_json.thumbnail_warning, tspoll_builder_json.warning, tsp_toastr_options);
                                }
                            }
                            jQuery('.tsp_vd_change').children("iframe").remove();
                            jQuery('.tsp_vd_change').children("video").remove();
                            jQuery('.tsp_vd_change').children("blockquote").remove();
                            jQuery('.tsp_img_div_edit').removeAttr("style");
                            jQuery('input#tsp_answer_video_attachment_id').val(url);
                            jQuery('.tsp_vd_change > img').attr("style", "display:none;");
                            jQuery('.tsp_vd_change').prepend(response.html);
                            if (tsp_theme_name == "Video in Question") {
                                tsp_question_params.TotalSoftPoll_Q_Vd = url;
                                $(`header.ts_poll_header_${tsp_question_id}  div.ts_poll_iframe_div_${tsp_question_id}`).html(`${response.html}`);
                            } else {
                                tsp_answers_props_arr[`${tsp_edit_elem_id}`].Answer_Param.TotalSoftPoll_Ans_Vd = url;
                                tsp_embed_data.tsp_embed[`tsp_embed_id_${tsp_edit_elem_id}`] = `${response.html}`;
                            }
                            $(".tsp_vd_loading_div").attr("style", "display:none;");
                        }).fail(function() {
                            $(".tsp_vd_loading_div").attr("style", "display:none;");
                            toastr["error"](tspoll_builder_json.link_warning, tspoll_builder_json.error, tsp_toastr_options)
                        });
                    });
                    tsp_wp_media_library.state('library').on('select', function() {
                        $(".tsp_vd_loading_div").removeAttr("style");
                        var selection = tsp_wp_media_library.state('library').get('selection'),
                            tsp_selection_id = "";
                        selection.each(function(attachment) {
                            tsp_selection_id = attachment["id"];
                        });
                        if (Number.isInteger(tsp_selection_id)) {
                            if (tsp_theme_name != "Video in Question") {
                                toastr["warning"](tspoll_builder_json.thumbnail_warning, tspoll_builder_json.warning, tsp_toastr_options);
                            }
                            jQuery('.tsp_vd_change').children("iframe").remove();
                            jQuery('.tsp_vd_change').children("video").remove();
                            jQuery('.tsp_vd_change').children("blockquote").remove();

                            jQuery('.tsp_img_div_edit').removeAttr("style");
                            var url = wp.media.attachment(tsp_selection_id).get('url');
                            if (tsp_theme_name == "Video in Question") {
                                tsp_question_params.TotalSoftPoll_Q_Vd = url;
                                $(`header.ts_poll_header_${tsp_question_id}  div.ts_poll_iframe_div_${tsp_question_id}`).html(`<video controls="" name="media"><source src="${url}"></video>`);
                            } else {
                                tsp_answers_props_arr[`${tsp_edit_elem_id}`].Answer_Param.TotalSoftPoll_Ans_Vd = url;
                                tsp_embed_data.tsp_embed[`tsp_embed_id_${tsp_edit_elem_id}`] = `<video controls="" name="media"><source src="${url}"></video>`;
                            }
                            jQuery('input#tsp_answer_video_attachment_id').val(tsp_selection_id);
                            jQuery('.tsp_vd_change').prepend(`<video controls="" name="media"><source src="${url}"></video>`);
                            jQuery('.tsp_vd_change > img').attr("style", "display:none;");
                            setTimeout(() => {
                                $(".tsp_vd_loading_div").attr("style", "display:none;");
                            }, 500);
                        }
                    });
                    tsp_wp_media_library.on('open', function() {
                        $("button#menu-item-video-playlist,button#menu-item-playlist,button#menu-item-gallery,button#menu-item-insert").remove();
                        var tsp_selected_attachment = jQuery('input#tsp_answer_video_attachment_id').val();
                        if (Number.isInteger(+tsp_selected_attachment)) {
                            $("button#menu-item-library").trigger("click");
                            $("input#embed-url-field").val("");
                            var selection = tsp_wp_media_library.state('library').get('selection');
                            var attachment = wp.media.attachment(+tsp_selected_attachment);
                            attachment.fetch();
                            selection.add(attachment ? [attachment] : []);
                        } else {
                            $("button#menu-item-embed").trigger("click");
                            $("input#embed-url-field").val(tsp_selected_attachment).trigger("input");
                        }
                    });
                    tsp_wp_media_library.open();
                });
            }
        }
    });
})(jQuery);