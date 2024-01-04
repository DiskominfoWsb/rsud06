<style type="text/css" id="tsp_footer_styles_<?php echo esc_attr( $total_soft_poll ); ?>">
	/* Footer CSS */
	:root{
	  <?php
		echo sprintf(
			'--tsp_footer_bgc_%1$s:%2$s;',
			esc_html( $total_soft_poll ),
			$ts_poll_question_params["TS_Poll_Q_Theme"] == 'Image Poll' || $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Video Poll' || $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Image in Question' || $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Video in Question' ? filter_var( esc_html( $tspoll_question_styles["ts_poll_vb_mbgc"] ), FILTER_SANITIZE_STRING ) : filter_var( esc_html( $tspoll_question_styles["ts_poll_rb_mbgc"] ), FILTER_SANITIZE_STRING )
		);
		if ( $tspoll_question_styles["ts_poll_rb_show"] == 'true' || $ts_poll_edit == 'true' ) {
			echo sprintf(
				'
              --tsp_result_bw_%1$s:%2$s;
              --tsp_result_bc_%1$s:%3$s;
              --tsp_result_br_%1$s:%4$s;
              --tsp_result_bgc_%1$s:%5$s;
              --tsp_result_c_%1$s:%6$s;
              --tsp_result_h_bgc_%1$s:%7$s;
              --tsp_result_h_c_%1$s:%8$s;
              --tsp_result_fs_%1$s:%9$s;
              --tsp_result_ff_%1$s:%10$s;
              --tsp_result_icon_fs_%1$s:%11$s;
              --tsp_back_bgc_%1$s:%12$s;
              --tsp_back_bc_%1$s:%13$s;
              --tsp_back_c_%1$s:%14$s;
              --tsp_back_h_bgc_%1$s:%15$s;
              --tsp_back_h_c_%1$s:%16$s;
              --tsp_r_footer_bgc_%1$s:%17$s;
              ',
				esc_html( $total_soft_poll ),
				filter_var( esc_html( $tspoll_question_styles["ts_poll_rb_bw"] ), FILTER_VALIDATE_INT ) . 'px',
				filter_var( esc_html( $tspoll_question_styles["ts_poll_rb_bc"] ), FILTER_SANITIZE_STRING ),
				filter_var( esc_html( $tspoll_question_styles["ts_poll_rb_br"] ), FILTER_VALIDATE_INT ) . 'px',
				filter_var( esc_html( $tspoll_question_styles["ts_poll_rb_bgc"] ), FILTER_SANITIZE_STRING ),
				filter_var( esc_html( $tspoll_question_styles["ts_poll_rb_c"] ), FILTER_SANITIZE_STRING ),
				filter_var( esc_html( $tspoll_question_styles["ts_poll_rb_hbgc"] ), FILTER_SANITIZE_STRING ),
				filter_var( esc_html( $tspoll_question_styles["ts_poll_rb_hc"] ), FILTER_SANITIZE_STRING ),
				filter_var( esc_html( $tspoll_question_styles["ts_poll_rb_fs"] ), FILTER_VALIDATE_INT ) . 'px',
				filter_var( esc_html( $tspoll_question_styles["ts_poll_rb_ff"] ), FILTER_SANITIZE_STRING ),
				filter_var( esc_html( $tspoll_question_styles["ts_poll_rb_is"] ), FILTER_VALIDATE_INT ) . 'px',
				$ts_poll_question_params["TS_Poll_Q_Theme"] == 'Image Poll' || $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Video Poll' ? filter_var( esc_html( $tspoll_question_styles["ts_poll_p_bb_bgc"] ), FILTER_SANITIZE_STRING ) : filter_var( esc_html( $tspoll_question_styles["ts_poll_bb_bgc"] ), FILTER_SANITIZE_STRING ),
				$ts_poll_question_params["TS_Poll_Q_Theme"] == 'Image Poll' || $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Video Poll' ? filter_var( esc_html( $tspoll_question_styles["ts_poll_p_bb_bc"] ), FILTER_SANITIZE_STRING ) : filter_var( esc_html( $tspoll_question_styles["ts_poll_bb_bc"] ), FILTER_SANITIZE_STRING ),
				$ts_poll_question_params["TS_Poll_Q_Theme"] == 'Image Poll' || $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Video Poll' ? filter_var( esc_html( $tspoll_question_styles["ts_poll_p_bb_c"] ), FILTER_SANITIZE_STRING ) : filter_var( esc_html( $tspoll_question_styles["ts_poll_bb_c"] ), FILTER_SANITIZE_STRING ),
				$ts_poll_question_params["TS_Poll_Q_Theme"] == 'Image Poll' || $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Video Poll' ? filter_var( esc_html( $tspoll_question_styles["ts_poll_p_bb_hbgc"] ), FILTER_SANITIZE_STRING ) : filter_var( esc_html( $tspoll_question_styles["ts_poll_bb_hbgc"] ), FILTER_SANITIZE_STRING ),
				$ts_poll_question_params["TS_Poll_Q_Theme"] == 'Image Poll' || $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Video Poll' ? filter_var( esc_html( $tspoll_question_styles["ts_poll_p_bb_hc"] ), FILTER_SANITIZE_STRING ) : filter_var( esc_html( $tspoll_question_styles["ts_poll_bb_hc"] ), FILTER_SANITIZE_STRING ),
				$ts_poll_question_params["TS_Poll_Q_Theme"] == 'Image Poll' || $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Video Poll' ? filter_var( esc_html( $tspoll_question_styles["ts_poll_p_bb_mbgc"] ), FILTER_SANITIZE_STRING ) : filter_var( esc_html( $tspoll_question_styles["ts_poll_bb_mbgc"] ), FILTER_SANITIZE_STRING )
			);
		}
		if ( $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Image in Question' || $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Video in Question' ||
			  $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Image Poll' || $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Video Poll' || $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Standard Poll' ) {
			echo sprintf(
				'
                --tsp_vote_bw_%1$s:%2$s;
                --tsp_vote_br_%1$s:%3$s;
                --tsp_vote_bc_%1$s:%4$s;
                --tsp_vote_fs_%1$s:%5$s;
                --tsp_vote_ff_%1$s:%6$s;
                --tsp_vote_bgc_%1$s:%7$s;
                --tsp_vote_c_%1$s:%8$s;
                --tsp_vote_h_bgc_%1$s:%9$s;
                --tsp_vote_h_c_%1$s:%10$s;
                --tsp_vote_icon_fs_%1$s:%11$s;
                ',
				esc_html( $total_soft_poll ),
				filter_var( esc_html( $tspoll_question_styles["ts_poll_vb_bw"] ), FILTER_VALIDATE_INT ) . 'px',
				filter_var( esc_html( $tspoll_question_styles["ts_poll_vb_br"] ), FILTER_VALIDATE_INT ) . 'px',
				filter_var( esc_html( $tspoll_question_styles["ts_poll_vb_bc"] ), FILTER_SANITIZE_STRING ),
				filter_var( esc_html( $tspoll_question_styles["ts_poll_vb_fs"] ), FILTER_VALIDATE_INT ) . 'px',
				filter_var( esc_html( $tspoll_question_styles["ts_poll_vb_ff"] ), FILTER_SANITIZE_STRING ),
				filter_var( esc_html( $tspoll_question_styles["ts_poll_vb_bgc"] ), FILTER_SANITIZE_STRING ),
				filter_var( esc_html( $tspoll_question_styles["ts_poll_vb_c"] ), FILTER_SANITIZE_STRING ),
				filter_var( esc_html( $tspoll_question_styles["ts_poll_vb_hbgc"] ), FILTER_SANITIZE_STRING ),
				filter_var( esc_html( $tspoll_question_styles["ts_poll_vb_hc"] ), FILTER_SANITIZE_STRING ),
				filter_var( esc_html( $tspoll_question_styles["ts_poll_vb_is"] ), FILTER_VALIDATE_INT ) . 'px'
			);
		}
		?>
	}
	footer.ts_poll_footer_<?php echo esc_html( $total_soft_poll ); ?>{
		width: 100%;
		position:relative;
		padding: 10px;
		background-color: var(--tsp_footer_bgc_<?php echo esc_html( $total_soft_poll ); ?>);
	}
	footer.ts_poll_footer_<?php echo esc_html( $total_soft_poll ); ?>  button{
		display: -ms-inline-flexbox;
		display: -webkit-inline-flex;
		display: inline-flex;
		-webkit-flex-direction: row;
		-ms-flex-direction: row;
		flex-direction: row;
		-webkit-flex-wrap: wrap;
		-ms-flex-wrap: wrap;
		flex-wrap: wrap;
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

	footer.ts_poll_footer_<?php echo esc_html( $total_soft_poll ); ?>  button[data-tsp-pos="right"]{
		float:right;
	}
	footer.ts_poll_footer_<?php echo esc_html( $total_soft_poll ); ?>  button[data-tsp-pos="left"]{
		float:left;
	}
	footer.ts_poll_footer_<?php echo esc_html( $total_soft_poll ); ?>  button.ts_poll_back_button[data-tsp-pos="right"]{
		margin-left : auto;
	}
	footer.ts_poll_footer_<?php echo esc_html( $total_soft_poll ); ?>  button.ts_poll_back_button[data-tsp-pos="left"]{
		margin-right : auto;
	}
	footer.ts_poll_footer_<?php echo esc_html( $total_soft_poll ); ?>  button[data-tsp-pos="full"]{
		width: 98% !important;
		margin: 5px 1% !important;
	}
	footer.ts_poll_footer_<?php echo esc_html( $total_soft_poll ); ?> button > i {
		display: -ms-inline-flexbox;
		display: -webkit-inline-flex;
		display: inline-flex;
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
	footer.ts_poll_footer_<?php echo esc_html( $total_soft_poll ); ?> button:not([data-tsp-text=""]) > i[data-tsp="before"]:before {
		margin-right: 10px;
	}
	footer.ts_poll_footer_<?php echo esc_html( $total_soft_poll ); ?> button:not([data-tsp-text=""]) > i[data-tsp="after"]{
		-webkit-flex-direction: row-reverse;
		-ms-flex-direction: row-reverse;
		flex-direction: row-reverse;
	}
	footer.ts_poll_footer_<?php echo esc_html( $total_soft_poll ); ?> button:not([data-tsp-text=""]) > i[data-tsp="after"]:before {
		margin-left: 10px;
	}
	

	footer.ts_poll_footer_<?php echo esc_html( $total_soft_poll ); ?> > div.ts_poll_footer_main{
		position: relative;
		width:100%;
	}
	footer.ts_poll_footer_<?php echo esc_html( $total_soft_poll ); ?> > div.ts_poll_footer_main > *:not([data-tsp-pos="full"]){
		margin : 0 5px;
	}

	footer.ts_poll_footer_<?php echo esc_html( $total_soft_poll ); ?> > div.ts_poll_footer_res{
		position: absolute;
		left:0;
		right:0;
		bottom:0;
		top:0;
		background-color: var(--tsp_r_footer_bgc_<?php echo esc_html( $total_soft_poll ); ?>);
		opacity:0;
		z-index:-1;
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
		padding:7px;
	}



	<?php if ( $tspoll_question_styles["ts_poll_rb_show"] == 'true' || $ts_poll_edit == 'true' ) { ?>
		/* Result Button */
		footer.ts_poll_footer_<?php echo esc_html( $total_soft_poll ); ?>  .ts_poll_result_button {
			background-color: var(--tsp_result_bgc_<?php echo esc_html( $total_soft_poll ); ?>) !important;
			border: var(--tsp_result_bw_<?php echo esc_html( $total_soft_poll ); ?>) solid var(--tsp_result_bc_<?php echo esc_html( $total_soft_poll ); ?>) !important;
			border-radius: var(--tsp_result_br_<?php echo esc_html( $total_soft_poll ); ?>) !important;
			color: var(--tsp_result_c_<?php echo esc_html( $total_soft_poll ); ?>) !important;
			padding: 3px 10px;
			text-transform: none;
			line-height: 1;
			cursor: pointer;
		}
		footer.ts_poll_footer_<?php echo esc_html( $total_soft_poll ); ?>  .ts_poll_result_button  span {
			font-size: var(--tsp_result_fs_<?php echo esc_html( $total_soft_poll ); ?>) !important;
			font-family: var(--tsp_result_ff_<?php echo esc_html( $total_soft_poll ); ?>) !important;
			color: var(--tsp_result_c_<?php echo esc_html( $total_soft_poll ); ?>) !important;
		}
		footer.ts_poll_footer_<?php echo esc_html( $total_soft_poll ); ?>  .ts_poll_result_button  span:before {
			content:attr(data-tsp-text);

		}
		footer.ts_poll_footer_<?php echo esc_html( $total_soft_poll ); ?>  .ts_poll_result_button:hover {
			background-color: var(--tsp_result_h_bgc_<?php echo esc_html( $total_soft_poll ); ?>) !important;
			opacity: 1;
		}
		footer.ts_poll_footer_<?php echo esc_html( $total_soft_poll ); ?>  .ts_poll_result_button:hover > .ts_poll_result_icon:before,
		footer.ts_poll_footer_<?php echo esc_html( $total_soft_poll ); ?>  .ts_poll_result_button:hover > .ts_poll_result_icon > span{
			color: var(--tsp_result_h_c_<?php echo esc_html( $total_soft_poll ); ?>) !important;
		}
		footer.ts_poll_footer_<?php echo esc_html( $total_soft_poll ); ?>  .ts_poll_result_button > .ts_poll_result_icon {
			font-size: var(--tsp_result_icon_fs_<?php echo esc_html( $total_soft_poll ); ?>) !important;
		}
		footer.ts_poll_footer_<?php echo esc_html( $total_soft_poll ); ?>  .ts_poll_result_button > .ts_poll_result_icon:before {
			color: var(--tsp_result_c_<?php echo esc_html( $total_soft_poll ); ?>) !important;
			font-family: FontAwesome;
		}
		/* Back Button */
		footer.ts_poll_footer_<?php echo esc_html( $total_soft_poll ); ?>  .ts_poll_back_button {
			background-color: var(--tsp_back_bgc_<?php echo esc_html( $total_soft_poll ); ?>) !important;
			border: var(--tsp_result_bw_<?php echo esc_html( $total_soft_poll ); ?>) solid var(--tsp_back_bc_<?php echo esc_html( $total_soft_poll ); ?>) !important;
			border-radius: var(--tsp_result_br_<?php echo esc_html( $total_soft_poll ); ?>) !important;
			color: var(--tsp_back_c_<?php echo esc_html( $total_soft_poll ); ?>) !important;
			padding: 3px 10px !important;
			text-transform: none !important;
			line-height: 1 !important;
			cursor: pointer;
		}
		footer.ts_poll_footer_<?php echo esc_html( $total_soft_poll ); ?> .ts_poll_back_button span {
			font-size: var(--tsp_result_fs_<?php echo esc_html( $total_soft_poll ); ?>) !important;
			font-family: var(--tsp_result_ff_<?php echo esc_html( $total_soft_poll ); ?>);
			color: var(--tsp_back_c_<?php echo esc_html( $total_soft_poll ); ?>) !important;
		}
		footer.ts_poll_footer_<?php echo esc_html( $total_soft_poll ); ?> .ts_poll_back_button span:before {
			content:attr(data-tsp-text);
		}
		footer.ts_poll_footer_<?php echo esc_html( $total_soft_poll ); ?> .ts_poll_back_button:hover {
			background-color: var(--tsp_back_h_bgc_<?php echo esc_html( $total_soft_poll ); ?>) !important;
			opacity: 1 !important;
		}
		footer.ts_poll_footer_<?php echo esc_html( $total_soft_poll ); ?> .ts_poll_back_button:hover > .ts_poll_back_icon:before,
		footer.ts_poll_footer_<?php echo esc_html( $total_soft_poll ); ?> .ts_poll_back_button:hover > .ts_poll_back_icon > span{
			color: var(--tsp_back_h_c_<?php echo esc_html( $total_soft_poll ); ?>) !important;
		}
		footer.ts_poll_footer_<?php echo esc_html( $total_soft_poll ); ?> .ts_poll_back_button > .ts_poll_back_icon {
			font-size: var(--tsp_result_icon_fs_<?php echo esc_html( $total_soft_poll ); ?>) !important;
		}
		footer.ts_poll_footer_<?php echo esc_html( $total_soft_poll ); ?> .ts_poll_back_button > .ts_poll_back_icon:before{
			color: var(--tsp_back_c_<?php echo esc_html( $total_soft_poll ); ?>) !important;
			font-family: FontAwesome;
		}
	<?php } ?>   

	<?php
	if ( isset( $tspoll_question_styles["ts_poll_tv_show"] ) ) {
		if ( $tspoll_question_styles["ts_poll_tv_show"] == 'true' || $ts_poll_edit == 'true' ) {
			?>
				/* Total Votes */
				:root{
					--tsp_total_fs_<?php echo esc_html( $total_soft_poll ); ?>:<?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_tv_fs"] ), FILTER_VALIDATE_INT ); ?>px;
					--tsp_total_c_<?php echo esc_html( $total_soft_poll ); ?>:<?php echo filter_var( esc_html( $tspoll_question_styles["ts_poll_tv_c"] ), FILTER_SANITIZE_STRING ); ?>;
				}
				footer.ts_poll_footer_<?php echo esc_html( $total_soft_poll ); ?> .ts_poll_total_v {
					font-size: var(--tsp_total_fs_<?php echo esc_html( $total_soft_poll ); ?>) !important;
					color: var(--tsp_total_c_<?php echo esc_html( $total_soft_poll ); ?>) !important;
					padding: 3px 10px !important;
					text-transform: none !important;
					line-height: 1 !important;
					cursor: default;
					display: -ms-inline-flexbox;
					display: -webkit-inline-flex;
					display: inline-flex;
					-webkit-flex-wrap: wrap;
					-ms-flex-wrap: wrap;
					flex-wrap: wrap;
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
				footer.ts_poll_footer_<?php echo esc_html( $total_soft_poll ); ?> .ts_poll_total_v span:before{
					content:attr(data-tsp-text);
				}
				footer.ts_poll_footer_<?php echo esc_html( $total_soft_poll ); ?> .ts_poll_total_v span{
					margin:0 5px;
				}
				footer.ts_poll_footer_<?php echo esc_html( $total_soft_poll ); ?>  .ts_poll_total_v[data-tsp-pos="right"]{
					float: right;
				}
				footer.ts_poll_footer_<?php echo esc_html( $total_soft_poll ); ?>  .ts_poll_total_v[data-tsp-pos="left"]{
					float: left;
				}
				footer.ts_poll_footer_<?php echo esc_html( $total_soft_poll ); ?>  .ts_poll_total_v[data-tsp-pos="full"]{
					width: 98% !important;
					text-align: center;
				}
				footer.ts_poll_footer_<?php echo esc_attr( $total_soft_poll ); ?>  .ts_poll_total_v:not([data-tsp-text=""])[data-tsp-align="after"] {
					vertical-align: middle;
					-webkit-flex-direction: row-reverse;
					-ms-flex-direction: row-reverse;
					flex-direction: row-reverse;
				}
				footer.ts_poll_footer_<?php echo esc_attr( $total_soft_poll ); ?>  .ts_poll_total_v:not([data-tsp-text=""])[data-tsp-align="before"] {
					vertical-align: middle;
					-webkit-flex-direction: row;
					-ms-flex-direction: row;
					flex-direction: row;
				}
			<?php
		}
	}
	?>
	  /* Vote Button */
	  footer.ts_poll_footer_<?php echo esc_html( $total_soft_poll ); ?> .ts_poll_vote_button {
		  background-color: var(--tsp_vote_bgc_<?php echo esc_html( $total_soft_poll ); ?>) !important;
		  border: var(--tsp_vote_bw_<?php echo esc_html( $total_soft_poll ); ?>) solid var(--tsp_vote_bc_<?php echo esc_html( $total_soft_poll ); ?>) !important;
		  border-radius: var(--tsp_vote_br_<?php echo esc_html( $total_soft_poll ); ?>);
		  color: var(--tsp_vote_c_<?php echo esc_html( $total_soft_poll ); ?>) !important;
		  padding: 3px 10px;
		  text-transform: none;
		  line-height: 1;
		  cursor: pointer;
	  }
	  footer.ts_poll_footer_<?php echo esc_html( $total_soft_poll ); ?> .ts_poll_vote_button span {
		  font-size: var(--tsp_vote_fs_<?php echo esc_html( $total_soft_poll ); ?>) !important;
		  font-family: var(--tsp_vote_ff_<?php echo esc_html( $total_soft_poll ); ?>) !important;
		  color: var(--tsp_vote_c_<?php echo esc_html( $total_soft_poll ); ?>) !important;
	  }
	  footer.ts_poll_footer_<?php echo esc_html( $total_soft_poll ); ?> .ts_poll_vote_button span:before {
		  content:attr(data-tsp-text);
	  }
	  footer.ts_poll_footer_<?php echo esc_html( $total_soft_poll ); ?> .ts_poll_vote_button:hover {
		  background-color: var(--tsp_vote_h_bgc_<?php echo esc_html( $total_soft_poll ); ?>) !important;
		  opacity: 1;
	  }
	  footer.ts_poll_footer_<?php echo esc_html( $total_soft_poll ); ?>  .ts_poll_vote_button:hover > .ts_poll_vote_icon:before,
	  footer.ts_poll_footer_<?php echo esc_html( $total_soft_poll ); ?>  .ts_poll_vote_button:hover > .ts_poll_vote_icon > span{
		  color: var(--tsp_vote_h_c_<?php echo esc_html( $total_soft_poll ); ?>) !important;
	  }
	  footer.ts_poll_footer_<?php echo esc_html( $total_soft_poll ); ?>  .ts_poll_vote_button > .ts_poll_vote_icon {
		  font-size: var(--tsp_vote_icon_fs_<?php echo esc_html( $total_soft_poll ); ?>);
	  }
	  footer.ts_poll_footer_<?php echo esc_html( $total_soft_poll ); ?>  .ts_poll_vote_button > .ts_poll_vote_icon:before {
		  color: var(--tsp_vote_c_<?php echo esc_html( $total_soft_poll ); ?>); 
		  font-family: FontAwesome;
	  }
</style>
<?php
	$tsp_result_button_code = $tsp_vote_button_code = $tsp_total_button_code = $tsp_back_button_code = '';
if ( $tspoll_question_styles["ts_poll_rb_show"] == 'true' || $ts_poll_edit == 'true' ) {
	$tsp_result_button_code .= sprintf(
		"<button class='ts_poll_result_button'
                     id='%s'
                     style='%s'
                     name='ts_poll_result_button' type='button'
                     data-tsp-shid='%s'
                     data-tsp-pos='%s'
                     data-tsp-text='%s' >
              <i class='ts_poll_result_icon %s' data-tsp='%s'><span data-tsp-text='%s'></span></i>
            </button>",
		'ts_poll_result_button_' . esc_attr( $total_soft_poll ),
		$tspoll_question_styles["ts_poll_rb_show"] != 'true' ? esc_attr( 'display:none;' ) : '',
		esc_attr( $total_soft_poll ),
		esc_attr( $tspoll_question_styles["ts_poll_rb_pos"] ),
		esc_attr( html_entity_decode( htmlspecialchars_decode( $tspoll_question_styles["ts_poll_rb_text"] ), ENT_QUOTES ) ),
		esc_attr( $tspoll_question_styles["ts_poll_rb_it"] ),
		esc_attr( $tspoll_question_styles["ts_poll_rb_ia"] ),
		esc_html( html_entity_decode( htmlspecialchars_decode( $tspoll_question_styles["ts_poll_rb_text"] ), ENT_QUOTES ) )
	);

	$tsp_back_button_code .= sprintf(
		"<button data-tsp-shid='%s' 
                    style='%s'
                    data-tsp-pos='%s' class='%s' 
                    id='%s' 
                    name='%s' type='button' 
                    data-tsp-text='%s'>
                    <i class='ts_poll_back_icon %s' data-tsp='%s'><span>%s</span></i>
              </button>",
		esc_attr( $total_soft_poll ),
		$tspoll_question_styles["ts_poll_rb_show"] != 'true' ? esc_attr( 'display:none;' ) : '',
		$ts_poll_question_params["TS_Poll_Q_Theme"] == 'Image Poll' || $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Video Poll' ? esc_attr( $tspoll_question_styles["ts_poll_p_bb_pos"] ) : esc_attr( $tspoll_question_styles["ts_poll_bb_pos"] ),
		'ts_poll_back_button',
		'ts_poll_back_button_' . esc_attr( $total_soft_poll ),
		'ts_poll_back_button_' . esc_attr( $total_soft_poll ),
		$ts_poll_question_params["TS_Poll_Q_Theme"] == 'Image Poll' || $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Video Poll' ? esc_html( html_entity_decode( htmlspecialchars_decode( $tspoll_question_styles["ts_poll_p_bb_text"] ), ENT_QUOTES ) ) : esc_html( html_entity_decode( htmlspecialchars_decode( $tspoll_question_styles["ts_poll_bb_text"] ), ENT_QUOTES ) ),
		$ts_poll_question_params["TS_Poll_Q_Theme"] == 'Image Poll' || $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Video Poll' ? esc_attr( $tspoll_question_styles["ts_poll_p_bb_it"] ) : esc_attr( $tspoll_question_styles["ts_poll_bb_it"] ),
		$ts_poll_question_params["TS_Poll_Q_Theme"] == 'Image Poll' || $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Video Poll' ? esc_attr( $tspoll_question_styles["ts_poll_p_bb_ia"] ) : esc_attr( $tspoll_question_styles["ts_poll_bb_ia"] ),
		$ts_poll_question_params["TS_Poll_Q_Theme"] == 'Image Poll' || $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Video Poll' ? esc_html( html_entity_decode( htmlspecialchars_decode( $tspoll_question_styles["ts_poll_p_bb_text"] ), ENT_QUOTES ) ) : esc_html( html_entity_decode( htmlspecialchars_decode( $tspoll_question_styles["ts_poll_bb_text"] ), ENT_QUOTES ) )
	);
}

if ( $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Image in Question' || $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Video in Question' ) {
	if ( $tspoll_question_styles["ts_poll_vb_show"] == 'true' || $ts_poll_edit == 'true' ) {
		$tsp_vote_button_code .= sprintf(
			"<button class='ts_poll_vote_button'
                         id='ts_poll_vote_button'
                         style='%s'
                         name='ts_poll_vote_button' type='button'
                         data-tsp-text='%s'
                         data-tsp-pos='%s'>
                  <i class='ts_poll_vote_icon %s' data-tsp='%s'><span data-tsp-text='%s'></span></i>
                </button>",
			$tspoll_question_styles["ts_poll_vb_show"] != 'true' ? esc_attr( 'display:none;' ) : '',
			esc_html( html_entity_decode( htmlspecialchars_decode( $tspoll_question_styles["ts_poll_vb_text"] ), ENT_QUOTES ) ),
			esc_attr( $tspoll_question_styles["ts_poll_vb_pos"] ),
			esc_attr( $tspoll_question_styles["ts_poll_vb_it"] ),
			esc_attr( $tspoll_question_styles["ts_poll_vb_ia"] ),
			esc_html( html_entity_decode( htmlspecialchars_decode( $tspoll_question_styles["ts_poll_vb_text"] ), ENT_QUOTES ) )
		);
	}
}

if ( $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Image Poll' || $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Video Poll' || $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Standard Poll' ) {
	$tsp_vote_button_code .= sprintf(
		"<button class='ts_poll_vote_button'
                     id='ts_poll_vote_button'
                     name='ts_poll_vote_button' type='button'
                     data-tsp-text='%s'
                     data-tsp-pos='%s'>
              <i class='ts_poll_vote_icon %s' data-tsp='%s'><span data-tsp-text='%s'></span></i>
            </button>",
		esc_html( html_entity_decode( htmlspecialchars_decode( $tspoll_question_styles["ts_poll_vb_text"] ), ENT_QUOTES ) ),
		esc_attr( $tspoll_question_styles["ts_poll_vb_pos"] ),
		esc_attr( $tspoll_question_styles["ts_poll_vb_it"] ),
		esc_attr( $tspoll_question_styles["ts_poll_vb_ia"] ),
		esc_html( html_entity_decode( htmlspecialchars_decode( $tspoll_question_styles["ts_poll_vb_text"] ), ENT_QUOTES ) )
	);
}

if ( isset( $tspoll_question_styles["ts_poll_tv_show"] ) ) {
	if ( $tspoll_question_styles["ts_poll_tv_show"] == 'true' || $ts_poll_edit == 'true' ) {
		if (isset($tspoll_question_styles["ts_poll_tv_pos"]) && $tspoll_question_styles["ts_poll_tv_pos"] === "center") {
			$tspoll_question_styles["ts_poll_tv_pos"] = "full";
		}
		$tsp_total_button_code .= sprintf(
			'<div class="ts_poll_total_v %s" style="%s" data-tsp-pos="%s" data-tsp-text="%s" data-tsp-align="%s">
                  <span data-tsp-text="%s">%s</span>
                </div> ',
			esc_html( $tspoll_question_styles["ts_poll_vt_it"] ),
			$tspoll_question_styles["ts_poll_tv_show"] != 'true' ? esc_attr( 'display:none;' ) : '',
			esc_attr( $tspoll_question_styles["ts_poll_tv_pos"] ),
			esc_html( html_entity_decode( htmlspecialchars_decode( $tspoll_question_styles["ts_poll_tv_text"] ), ENT_QUOTES ) ),
			esc_attr( $tspoll_question_styles["ts_poll_vt_ia"] ),
			esc_html( html_entity_decode( htmlspecialchars_decode( $tspoll_question_styles["ts_poll_tv_text"] ), ENT_QUOTES ) ),
			' : ' . esc_html( (int) $total_soft_poll_res_count1 )
		);
	}
}

	echo sprintf(
		"
      <footer class='%s'>
        <div class='ts_poll_footer_main'>
            %s
            %s
            %s
        </div>
        <div class='ts_poll_footer_res'>
          %s
        </div>
      </footer>
      ",
		'ts_poll_footer_' . esc_attr( $total_soft_poll ),
		$tsp_result_button_code,
		$tsp_vote_button_code,
		$tsp_total_button_code,
		$tsp_back_button_code
	);
	?>
