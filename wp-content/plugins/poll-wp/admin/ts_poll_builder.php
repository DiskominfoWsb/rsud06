<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

echo sprintf(
	"
  <section id='tsp_loader' class='tsp_flex_col'>
  	<div id='tsp_load_circle'></div>
  	<img src='%s' class='tsp_load_img'>
  </section>
  ",
	esc_url( plugin_dir_url( __FILE__ ) . 'img/ts_poll_logo.png' )
);
\ob_start();
if ( 'new' === $this->tsp_build ) {
	echo '<div class="tsp_content active" data-tsp-section="theme" >';
	foreach ( $this->tsp_themes as $key => $value ) {
		echo sprintf(
			'
          <div class="tsp_theme tsp_flex_col">
            <div class="tsp_theme_header">
              <a class="tsp_theme_demo tsp_flex_col" href="%s" target="_blank">
                <i class="ts-poll ts-poll-eye"></i>
              </a>
              <div class="tsp_theme_version">%s</div>
              <img src="%s" alt="%s"/>
            </div>
            <div class="tsp_theme_main">
              <h1 class="tsp_theme_name">%s</h1>
              <div class="tsp_theme_choose tsp_flex_col">
                <a href="%s" class="tsp_theme_use"><span><i class="ts-poll ts-poll-magic"></i>%s</span></a>
              </div>
              </div>
          </div>
        ',
			esc_url( 'https://total-soft.com/' . $this->tsp_themes_links[ $key ] ),
			esc_attr__( 'FREE THEME', 'tspoll' ),
			esc_url( plugin_dir_url( __FILE__ ) . "img/tsp-$key.png" ),
			esc_attr( $key ),
			esc_html( $value ),
			esc_url( add_query_arg( 'tsp-theme', $key ) ),
			esc_attr__( 'Use Theme', 'tspoll' ),
		);
	}
	echo '</div>';
} else {
	global $wp_embed;
	$tsp_all_fonts_arr         = apply_filters("tsp_get_all_fonts","");
	$tsp_font_families         = array_combine( array_keys( $tsp_all_fonts_arr['tsp_font_families'] ), array_keys( $tsp_all_fonts_arr['tsp_font_families'] ) );
	$tsp_builder_arr           = array(
		esc_html__( 'General options', 'tspoll' )    => array(
			'ts_poll_mw'         => array(
				'label'        => esc_attr__( 'Main width', 'tspoll' ),
				'type'         => 'range',
				'options'      => array(
					'min' => 20,
					'max' => 100,
				),
				'change'       => '--tsp_section_w_' . $this->tsp_build_id,
				'change_param' => '%',
			),
			'ts_poll_pos'        => array(
				'label'       => esc_attr__( 'Position', 'tspoll' ),
				'type'        => 'select-position',
				'options'     => array(
					'left'   => esc_attr__( 'Left', 'tspoll' ),
					'center' => esc_attr__( 'Center', 'tspoll' ),
					'right'  => esc_attr__( 'Right', 'tspoll' ),
				),
				'change_elem' => '.ts_poll_form_' . $this->tsp_build_id,
				'change_attr' => 'data-tsp-pos',
			),
			'ts_poll_bw'         => array(
				'label'        => esc_attr__( 'Border width', 'tspoll' ),
				'type'         => 'range',
				'options'      => array(
					'min' => 0,
					'max' => 10,
				),
				'change'       => '--tsp_section_bw_' . $this->tsp_build_id,
				'change_param' => 'px',
			),
			'ts_poll_bc'         => array(
				'label'       => esc_attr__( 'Border color', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_section_bc_' . $this->tsp_build_id,
			),
			'ts_poll_br'         => array(
				'label'        => esc_attr__( 'Border radius', 'tspoll' ),
				'type'         => 'range',
				'options'      => array(
					'min' => 0,
					'max' => 50,
				),
				'change'       => '--tsp_section_br_' . $this->tsp_build_id,
				'change_param' => 'px',
			),
			'ts_poll_boxsh_type' => array(
				'label'       => esc_attr__( 'Shadow type', 'tspoll' ),
				'type'        => 'select',
				'options'     => array(
					'none'  => esc_attr__( 'None', 'tspoll' ),
					'true'  => esc_attr__( 'Shadow', 'tspoll' ) . '1',
					'false' => esc_attr__( 'Shadow', 'tspoll' ) . '2',
					'sh03'  => esc_attr__( 'Shadow', 'tspoll' ) . '3',
					'sh04'  => esc_attr__( 'Shadow', 'tspoll' ) . '4',
					'sh05'  => esc_attr__( 'Shadow', 'tspoll' ) . '5',
					'sh06'  => esc_attr__( 'Shadow', 'tspoll' ) . '6',
					'sh07'  => esc_attr__( 'Shadow', 'tspoll' ) . '7',
					'sh08'  => esc_attr__( 'Shadow', 'tspoll' ) . '8',
					'sh09'  => esc_attr__( 'Shadow', 'tspoll' ) . '9',
					'sh10'  => esc_attr__( 'Shadow', 'tspoll' ) . '10',
					'sh11'  => esc_attr__( 'Shadow', 'tspoll' ) . '11',
				),
				'change_elem' => '.ts_poll_section_' . $this->tsp_build_id,
				'change_attr' => 'data-tsp-box',
			),
			'ts_poll_boxshc'     => array(
				'label'       => esc_attr__( 'Shadow color', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_section_box_c_' . $this->tsp_build_id,
			),
		),
		esc_html__( 'Header', 'tspoll' )             => array(
			'ts_poll_q_bgc' => array(
				'label'       => esc_attr__( 'Background color', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_header_bgc_' . $this->tsp_build_id,
			),
			'ts_poll_q_c'   => array(
				'label'       => esc_attr__( 'Color', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_header_c_' . $this->tsp_build_id,
			),
			'ts_poll_q_fs'  => array(
				'label'        => esc_attr__( 'Font size', 'tspoll' ),
				'type'         => 'range',
				'options'      => array(
					'min' => 8,
					'max' => 48,
				),
				'change'       => '--tsp_header_fs_' . $this->tsp_build_id,
				'change_param' => 'px',
			),
			'ts_poll_q_ff'  => array(
				'label'       => esc_attr__( 'Font family', 'tspoll' ),
				'type'        => 'select',
				'options'     => $tsp_font_families,
				'change_attr' => '--tsp_header_ff_' . $this->tsp_build_id,
			),
			'ts_poll_q_ta'  => array(
				'label'       => esc_attr__( 'Text align', 'tspoll' ),
				'type'        => 'select-position',
				'options'     => array(
					'left'   => esc_attr__( 'Left', 'tspoll' ),
					'center' => esc_attr__( 'Center', 'tspoll' ),
					'right'  => esc_attr__( 'Right', 'tspoll' ),
				),
				'change_elem' => '.ts_poll_header_' . $this->tsp_build_id . ' ,.ts_poll_r_header_' . $this->tsp_build_id,
				'change_attr' => 'data-tsp-pos',
			),
		),
		esc_html__( 'Header line', 'tspoll' )        => array(
			'ts_poll_laq_w' => array(
				'label'        => esc_attr__( 'Width', 'tspoll' ),
				'type'         => 'range',
				'options'      => array(
					'min' => 0,
					'max' => 100,
				),
				'change'       => '--tsp_header_l_w_' . $this->tsp_build_id,
				'change_param' => '%',
			),
			'ts_poll_laq_h' => array(
				'label'        => esc_attr__( 'Height', 'tspoll' ),
				'type'         => 'range',
				'options'      => array(
					'min' => 0,
					'max' => 5,
				),
				'change'       => '--tsp_header_l_bh_' . $this->tsp_build_id,
				'change_param' => 'px',
			),
			'ts_poll_laq_s' => array(
				'label'       => esc_attr__( 'Style', 'tspoll' ),
				'type'        => 'select',
				'options'     => array(
					'none'   => esc_attr__( 'None', 'tspoll' ),
					'solid'  => esc_attr__( 'Solid', 'tspoll' ),
					'dotted' => esc_attr__( 'Dotted', 'tspoll' ),
					'dashed' => esc_attr__( 'Dashed', 'tspoll' ),
				),
				'change_attr' => '--tsp_header_l_bs_' . $this->tsp_build_id,
			),
			'ts_poll_laq_c' => array(
				'label'       => esc_attr__( 'Color', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_header_l_bc_' . $this->tsp_build_id,
			),
		),
		esc_html__( 'Answer options', 'tspoll' )     => array(
			'ts_poll_a_ctf'      => array(
				'label'       => esc_attr__( 'Individual color', 'tspoll' ),
				'type'        => 'input-toggle',
				'options'     => array(
					'yes' => 'true',
					'no'  => 'false',
				),
				'change_elem' => '.ts_poll_main_' . $this->tsp_build_id . ',.ts_poll_r_section_' . $this->tsp_build_id . ',.ts_poll_r_main_' . $this->tsp_build_id,
				'change_attr' => 'data-tsp-bool',
			),
			'ts_poll_a_ca'       => array(
				'label'       => esc_attr__( 'Individual colors for', 'tspoll' ),
				'type'        => 'select',
				'options'     => array(
					'Nothing'    => esc_attr__( 'Nothing', 'tspoll' ),
					'Background' => esc_attr__( 'Background', 'tspoll' ),
					'Color'      => esc_attr__( 'Color', 'tspoll' ),
				),
				'change_elem' => '.ts_poll_main_' . $this->tsp_build_id,
				'change_attr' => 'data-tsp-color',
			),
			'ts_poll_a_mbgc'     => array(
				'label'       => esc_attr__( 'Main background', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_main_bgc_' . $this->tsp_build_id,
			),
			'ts_poll_a_bgc'      => array(
				'label'       => esc_attr__( 'Answer background', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_answer_bgc_' . $this->tsp_build_id,
			),
			'ts_poll_a_c'        => array(
				'label'       => esc_attr__( 'Answer color', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_answer_c_' . $this->tsp_build_id,
			),
			'ts_poll_a_hbgc'     => array(
				'label'       => esc_attr__( 'Hover background', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_answer_h_bgc_' . $this->tsp_build_id,
			),
			'ts_poll_a_hc'       => array(
				'label'       => esc_attr__( 'Hover color', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_answer_h_c_' . $this->tsp_build_id,
			),
			'ts_poll_a_hsh_show' => array(
				'label'       => esc_attr__( 'Hover shadow', 'tspoll' ),
				'type'        => 'input-toggle',
				'options'     => array(
					'yes' => 'true',
					'no'  => 'false',
				),
				'change_elem' => '.ts_poll_main_' . $this->tsp_build_id,
				'change_attr' => 'data-tsp-hover',
			),
			'ts_poll_a_hshc'     => array(
				'label'       => esc_attr__( 'Shadow color', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_answer_h_bsh_' . $this->tsp_build_id,
			),
			'ts_poll_a_fs'       => array(
				'label'        => esc_attr__( 'Font size', 'tspoll' ),
				'type'         => 'range',
				'options'      => array(
					'min' => 8,
					'max' => 48,
				),
				'change'       => '--tsp_answer_fs_' . $this->tsp_build_id,
				'change_param' => 'px',
			),
			'ts_poll_boxsh'      => array(
				'label'       => esc_attr__( 'Font family', 'tspoll' ),
				'type'        => 'select',
				'options'     => $tsp_font_families,
				'change_attr' => '--tsp_answer_ff_' . $this->tsp_build_id,
			),
			'ts_poll_a_cc'       => array(
				'label'       => esc_attr__( 'Column count', 'tspoll' ),
				'type'        => 'select',
				'options'     => array_combine( range( 1, 5 ), range( 1, 5 ) ),
				'change_elem' => '.ts_poll_main_' . $this->tsp_build_id,
				'change_attr' => 'data-tsp-layout',
			),
			'ts_poll_a_bw'       => array(
				'label'        => esc_attr__( 'Border width', 'tspoll' ),
				'type'         => 'range',
				'options'      => array(
					'min' => 0,
					'max' => 8,
				),
				'change'       => '--tsp_answer_bw_' . $this->tsp_build_id,
				'change_param' => 'px',
			),
			'ts_poll_a_bc'       => array(
				'label'       => esc_attr__( 'Border color', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_answer_bc_' . $this->tsp_build_id,
			),
			'ts_poll_a_br'       => array(
				'label'        => esc_attr__( 'Border radius', 'tspoll' ),
				'type'         => 'range',
				'options'      => array(
					'min' => 0,
					'max' => 10,
				),
				'change'       => '--tsp_answer_br_' . $this->tsp_build_id,
				'change_param' => 'px',
			),
		),
		esc_html__( 'Answer image', 'tspoll' )       => array(
			'ts_poll_a_iht' => array(
				'label'   => esc_attr__( 'Image height type', 'tspoll' ),
				'type'    => 'select',
				'options' => array(
					'fixed' => esc_attr__( 'Fixed', 'tspoll' ),
					'ratio' => esc_attr__( 'Ratio', 'tspoll' ),
				),
			),
			'ts_poll_a_ih'  => array(
				'label'        => esc_attr__( 'Image height', 'tspoll' ),
				'type'         => 'range',
				'options'      => array(
					'min' => 50,
					'max' => 500,
				),
				'change'       => '--tsp_answer_pbottom_' . $this->tsp_build_id,
				'change_param' => 'px',
			),
			'ts_poll_a_ihr' => array(
				'label'       => esc_attr__( 'Image ratio', 'tspoll' ),
				'type'        => 'select-position',
				'options'     => array(
					'1' => '1x1',
					'2' => '16x9',
					'3' => '9x16',
					'4' => '3x4',
					'5' => '4x3',
					'6' => '3x2',
					'7' => '2x3',
					'8' => '8x5',
					'9' => '5x8',
				),
				'change_elem' => '.ts_poll_main_' . $this->tsp_build_id,
				'change_attr' => 'data-tsp-ratio',
			),
			'ts_poll_i_h'   => array(
				'label'        => esc_attr__( 'Image width', 'tspoll' ),
				'type'         => 'range',
				'options'      => array(
					'min' => 5,
					'max' => 50,
				),
				'change'       => '--tsp_attachment_w_' . $this->tsp_build_id,
				'change_param' => '%',
			),
			'ts_poll_i_ra'  => array(
				'label'       => esc_attr__( 'Image ratio', 'tspoll' ),
				'type'        => 'select-position',
				'options'     => array(
					'1' => '1x1',
					'2' => '16x9',
					'3' => '9x16',
					'4' => '3x4',
					'5' => '4x3',
					'6' => '3x2',
					'7' => '2x3',
					'8' => '8x5',
					'9' => '5x8',
				),
				'change_elem' => '.ts_poll_main_' . $this->tsp_build_id,
				'change_attr' => 'data-tsp-ratio',
			),
			'ts_poll_i_oc'  => array(
				'label'       => esc_attr__( 'Hover Overlay', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_overlay_bgc_' . $this->tsp_build_id,
			),
			'ts_poll_i_it'  => array(
				'label'       => esc_attr__( 'Hover icon', 'tspoll' ),
				'type'        => 'select-icon',
				'change_elem' => 'i.ts_poll_overlay_icon',
				'change_attr' => 'class',
			),
			'ts_poll_i_ic'  => array(
				'label'       => esc_attr__( 'Hover color', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_overlay_c_' . $this->tsp_build_id,
			),
			'ts_poll_i_is'  => array(
				'label'        => esc_attr__( 'Icon size', 'tspoll' ),
				'type'         => 'range',
				'options'      => array(
					'min' => 8,
					'max' => 72,
				),
				'change'       => '--tsp_overlay_icon_s_' . $this->tsp_build_id,
				'change_param' => 'px',
			),
		),
		esc_html__( 'Checkbox options', 'tspoll' )   => array(
			'ts_poll_ch_cm'  => array(
				'label'       => esc_attr__( 'Check many', 'tspoll' ),
				'type'        => 'input-toggle',
				'options'     => array(
					'yes' => 'checkbox',
					'no'  => 'radio',
				),
				'change_elem' => '.ts_poll_answer_input',
				'change_attr' => 'type',
			),
			'ts_poll_ch_sh'  => array(
				'label'       => esc_attr__( 'Show checkbox', 'tspoll' ),
				'type'        => 'input-toggle',
				'options'     => array(
					'yes' => 'true',
					'no'  => 'false',
				),
				'change_elem' => '.ts_poll_main_' . $this->tsp_build_id,
				'change_attr' => 'data-tsp-checkbox',
			),
			'ts_poll_ch_s'   => array(
				'label'        => esc_attr__( 'Size', 'tspoll' ),
				'type'         => 'range',
				'options'      => array(
					'min' => 18,
					'max' => 32,
				),
				'change'       => '--tsp_checkbox_size_' . $this->tsp_build_id,
				'change_param' => 'px',
			),
			'ts_poll_ch_tbc' => array(
				'label'       => esc_attr__( 'Unchecked icon', 'tspoll' ),
				'type'        => 'select-icon',
				'change_elem' => '--tsp_before_check_' . $this->tsp_build_id,
				'change_attr' => 'root',
			),
			'ts_poll_ch_cbc' => array(
				'label'       => esc_attr__( 'Unchecked color', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_before_check_c_' . $this->tsp_build_id,
			),
			'ts_poll_ch_tac' => array(
				'label'       => esc_attr__( 'Checked Icon', 'tspoll' ),
				'type'        => 'select-icon',
				'change_elem' => '--tsp_after_check_' . $this->tsp_build_id,
				'change_attr' => 'root',
			),
			'ts_poll_ch_cac' => array(
				'label'       => esc_attr__( 'Checked color', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_after_check_c_' . $this->tsp_build_id,
			),
			'ts_poll_a_pos'  => array(
				'label'       => esc_attr__( 'Checkbox position', 'tspoll' ),
				'type'        => 'select-position-image',
				'options'     => array(
					'Position 1' => esc_url( plugin_dir_url( __FILE__ ) . 'img/tsp-top-with.svg' ),
					'Position 2' => esc_url( plugin_dir_url( __FILE__ ) . 'img/tsp-top-without.svg' ),
					'Position 3' => esc_url( plugin_dir_url( __FILE__ ) . 'img/tsp-bottom-with.svg' ),
					'Position 4' => esc_url( plugin_dir_url( __FILE__ ) . 'img/tsp-bottom-without.svg' ),
					'Position 5' => esc_url( plugin_dir_url( __FILE__ ) . 'img/tsp-left.svg' ),
					'Position 6' => esc_url( plugin_dir_url( __FILE__ ) . 'img/tsp-right.svg' ),
				),
				'change_elem' => '.ts_poll_main_' . $this->tsp_build_id,
				'change_attr' => 'data-tsp-position',
			),
		),
		esc_html__( 'Line after answers', 'tspoll' ) => array(
			'ts_poll_laa_w' => array(
				'label'        => esc_attr__( 'Width', 'tspoll' ),
				'type'         => 'range',
				'options'      => array(
					'min' => 0,
					'max' => 100,
				),
				'change'       => '--tsp_main_l_bw_' . $this->tsp_build_id,
				'change_param' => '%',
			),
			'ts_poll_laa_h' => array(
				'label'        => esc_attr__( 'Height', 'tspoll' ),
				'type'         => 'range',
				'options'      => array(
					'min' => 0,
					'max' => 5,
				),
				'change'       => '--tsp_main_l_bh_' . $this->tsp_build_id,
				'change_param' => 'px',
			),
			'ts_poll_laa_s' => array(
				'label'       => esc_attr__( 'Style', 'tspoll' ),
				'type'        => 'select',
				'options'     => array(
					'none'   => esc_attr__( 'None', 'tspoll' ),
					'solid'  => esc_attr__( 'Solid', 'tspoll' ),
					'dotted' => esc_attr__( 'Dotted', 'tspoll' ),
					'dashed' => esc_attr__( 'Dashed', 'tspoll' ),
				),
				'change_attr' => '--tsp_main_l_bs_' . $this->tsp_build_id,
			),
			'ts_poll_laa_c' => array(
				'label'       => esc_attr__( 'Color', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_main_l_bc_' . $this->tsp_build_id,
			),
		),
		esc_html__( 'Total votes', 'tspoll' )        => array(
			'ts_poll_tv_show' => array(
				'label'       => esc_attr__( 'Show button', 'tspoll' ),
				'type'        => 'input-toggle',
				'options'     => array(
					'yes' => '',
					'no'  => 'display:none;',
				),
				'change_elem' => '.ts_poll_total_v',
				'change_attr' => 'style',
			),
			'ts_poll_tv_pos'  => array(
				'label'       => esc_attr__( 'Position', 'tspoll' ),
				'type'        => 'select-position',
				'options'     => array(
					'left'   => esc_attr__( 'Left', 'tspoll' ),
					'right'  => esc_attr__( 'Right', 'tspoll' ),
					'full' => esc_attr__( 'Full', 'tspoll' ),
				),
				'change_elem' => '.ts_poll_total_v',
				'change_attr' => 'data-tsp-pos',
			),
			'ts_poll_tv_c'    => array(
				'label'       => esc_attr__( 'Color', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_total_c_' . $this->tsp_build_id,
			),
			'ts_poll_tv_fs'   => array(
				'label'        => esc_attr__( 'Font size', 'tspoll' ),
				'type'         => 'range',
				'options'      => array(
					'min' => 8,
					'max' => 48,
				),
				'change'       => '--tsp_total_fs_' . $this->tsp_build_id,
				'change_param' => 'px',
			),
			'ts_poll_tv_text' => array(
				'label'       => esc_attr__( 'Text', 'tspoll' ),
				'type'        => 'text',
				'change_elem' => '.ts_poll_total_v,.ts_poll_total_v > span',
				'change_attr' => 'data-tsp-text',
			),
			'ts_poll_vt_it'   => array(
				'label'       => esc_attr__( 'Icon', 'tspoll' ),
				'type'        => 'select-icon',
				'change_elem' => '.ts_poll_total_v',
				'change_attr' => 'class',
			),
			'ts_poll_vt_ia'   => array(
				'label'       => esc_attr__( 'Icon position', 'tspoll' ),
				'type'        => 'select',
				'options'     => array(
					'after'  => esc_attr__( 'After text', 'tspoll' ),
					'before' => esc_attr__( 'Before text', 'tspoll' ),
				),
				'change_elem' => '.ts_poll_total_v',
				'change_attr' => 'data-tsp-align',
			),
		),
		esc_html__( 'Vote button', 'tspoll' )        => array(
			'ts_poll_vb_show' => array(
				'label'       => esc_attr__( 'Show button', 'tspoll' ),
				'type'        => 'input-toggle',
				'options'     => array(
					'yes' => '',
					'no'  => 'display:none;',
				),
				'change_elem' => '.ts_poll_vote_button',
				'change_attr' => 'style',
			),
			'ts_poll_vb_mbgc' => array(
				'label'       => esc_attr__( 'Main background', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_footer_bgc_' . $this->tsp_build_id,
			),
			'ts_poll_vb_pos'  => array(
				'label'       => esc_attr__( 'Position', 'tspoll' ),
				'type'        => 'select-position',
				'options'     => array(
					'left'  => esc_attr__( 'Left', 'tspoll' ),
					'right' => esc_attr__( 'Right', 'tspoll' ),
					'full'  => esc_attr__( 'Full Width', 'tspoll' ),
				),
				'change_elem' => '.ts_poll_vote_button',
				'change_attr' => 'data-tsp-pos',
			),
			'ts_poll_vb_bw'   => array(
				'label'        => esc_attr__( 'Border width', 'tspoll' ),
				'type'         => 'range',
				'options'      => array(
					'min' => 0,
					'max' => 5,
				),
				'change'       => '--tsp_vote_bw_' . $this->tsp_build_id,
				'change_param' => 'px',
			),
			'ts_poll_vb_bc'   => array(
				'label'       => esc_attr__( 'Border color', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_vote_bc_' . $this->tsp_build_id,
			),
			'ts_poll_vb_br'   => array(
				'label'        => esc_attr__( 'Border radius', 'tspoll' ),
				'type'         => 'range',
				'options'      => array(
					'min' => 0,
					'max' => 30,
				),
				'change'       => '--tsp_vote_br_' . $this->tsp_build_id,
				'change_param' => 'px',
			),
			'ts_poll_vb_bgc'  => array(
				'label'       => esc_attr__( 'Background', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_vote_bgc_' . $this->tsp_build_id,
			),
			'ts_poll_vb_c'    => array(
				'label'       => esc_attr__( 'Color', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_vote_c_' . $this->tsp_build_id,
			),
			'ts_poll_vb_hbgc' => array(
				'label'       => esc_attr__( 'Hover background', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_vote_h_bgc_' . $this->tsp_build_id,
			),
			'ts_poll_vb_hc'   => array(
				'label'       => esc_attr__( 'Hover color', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_vote_h_c_' . $this->tsp_build_id,
			),
			'ts_poll_vb_fs'   => array(
				'label'        => esc_attr__( 'Font size', 'tspoll' ),
				'type'         => 'range',
				'options'      => array(
					'min' => 8,
					'max' => 48,
				),
				'change'       => '--tsp_vote_fs_' . $this->tsp_build_id,
				'change_param' => 'px',
			),
			'ts_poll_vb_ff'   => array(
				'label'       => esc_attr__( 'Font family', 'tspoll' ),
				'type'        => 'select',
				'options'     => $tsp_font_families,
				'change_attr' => '--tsp_vote_ff_' . $this->tsp_build_id,
			),
			'ts_poll_vb_text' => array(
				'label'       => esc_attr__( 'Text', 'tspoll' ),
				'type'        => 'text',
				'change_elem' => '.ts_poll_vote_button,.ts_poll_vote_icon > span',
				'change_attr' => 'data-tsp-text',
			),
			'ts_poll_vb_it'   => array(
				'label'       => esc_attr__( 'Icon', 'tspoll' ),
				'type'        => 'select-icon',
				'change_elem' => '.ts_poll_vote_icon',
				'change_attr' => 'class',
			),
			'ts_poll_vb_ia'   => array(
				'label'       => esc_attr__( 'Position', 'tspoll' ),
				'type'        => 'select',
				'options'     => array(
					'after'  => esc_attr__( 'After text', 'tspoll' ),
					'before' => esc_attr__( 'Before text', 'tspoll' ),
				),
				'change_elem' => '.ts_poll_vote_icon',
				'change_attr' => 'data-tsp',
			),
			'ts_poll_vb_is'   => array(
				'label'        => esc_attr__( 'Icon size', 'tspoll' ),
				'type'         => 'range',
				'options'      => array(
					'min' => 8,
					'max' => 48,
				),
				'change'       => '--tsp_vote_icon_fs_' . $this->tsp_build_id,
				'change_param' => 'px',
			),
		),
		esc_html__( 'Result button', 'tspoll' )      => array(
			'ts_poll_rb_show' => array(
				'label'       => esc_attr__( 'Show button', 'tspoll' ),
				'type'        => 'input-toggle',
				'options'     => array(
					'yes' => '',
					'no'  => 'display:none;',
				),
				'change_elem' => '.ts_poll_back_button,.ts_poll_result_button,.ts_poll_r_footer_' . $this->tsp_build_id,
				'change_attr' => 'style',
			),
			'ts_poll_rb_mbgc' => array(
				'label'       => esc_attr__( 'Main background', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_footer_bgc_' . $this->tsp_build_id,
			),
			'ts_poll_rb_pos'  => array(
				'label'       => esc_attr__( 'Position', 'tspoll' ),
				'type'        => 'select-position',
				'options'     => array(
					'left'  => esc_attr__( 'Left', 'tspoll' ),
					'right' => esc_attr__( 'Right', 'tspoll' ),
					'full'  => esc_attr__( 'Full Width', 'tspoll' ),
				),
				'change_elem' => '.ts_poll_result_button',
				'change_attr' => 'data-tsp-pos',
			),
			'ts_poll_rb_bw'   => array(
				'label'        => esc_attr__( 'Border width', 'tspoll' ),
				'type'         => 'range',
				'options'      => array(
					'min' => 0,
					'max' => 5,
				),
				'change'       => '--tsp_result_bw_' . $this->tsp_build_id,
				'change_param' => 'px',
			),
			'ts_poll_rb_bc'   => array(
				'label'       => esc_attr__( 'Border color', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_result_bc_' . $this->tsp_build_id,
			),
			'ts_poll_rb_br'   => array(
				'label'        => esc_attr__( 'Border Radius', 'tspoll' ),
				'type'         => 'range',
				'options'      => array(
					'min' => 0,
					'max' => 30,
				),
				'change'       => '--tsp_result_br_' . $this->tsp_build_id,
				'change_param' => 'px',
			),
			'ts_poll_rb_bgc'  => array(
				'label'       => esc_attr__( 'Background', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_result_bgc_' . $this->tsp_build_id,
			),
			'ts_poll_rb_c'    => array(
				'label'       => esc_attr__( 'Color', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_result_c_' . $this->tsp_build_id,
			),
			'ts_poll_rb_hbgc' => array(
				'label'       => esc_attr__( 'Hover background', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_result_h_bgc_' . $this->tsp_build_id,
			),
			'ts_poll_rb_hc'   => array(
				'label'       => esc_attr__( 'Hover color', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_result_h_c_' . $this->tsp_build_id,
			),
			'ts_poll_rb_fs'   => array(
				'label'        => esc_attr__( 'Font size', 'tspoll' ),
				'type'         => 'range',
				'options'      => array(
					'min' => 8,
					'max' => 48,
				),
				'change'       => '--tsp_result_fs_' . $this->tsp_build_id,
				'change_param' => 'px',
			),
			'ts_poll_rb_ff'   => array(
				'label'       => esc_attr__( 'Font family', 'tspoll' ),
				'type'        => 'select',
				'options'     => $tsp_font_families,
				'change_attr' => '--tsp_result_ff_' . $this->tsp_build_id,
			),
			'ts_poll_rb_text' => array(
				'label'       => esc_attr__( 'Text', 'tspoll' ),
				'type'        => 'text',
				'change_elem' => '.ts_poll_result_button,.ts_poll_result_icon > span',
				'change_attr' => 'data-tsp-text',
			),
			'ts_poll_rb_it'   => array(
				'label'       => esc_attr__( 'Icon', 'tspoll' ),
				'type'        => 'select-icon',
				'change_elem' => '.ts_poll_result_icon',
				'change_attr' => 'class',
			),
			'ts_poll_rb_ia'   => array(
				'label'       => esc_attr__( 'Position', 'tspoll' ),
				'type'        => 'select',
				'options'     => array(
					'after'  => esc_attr__( 'After text', 'tspoll' ),
					'before' => esc_attr__( 'Before text', 'tspoll' ),
				),
				'change_elem' => '.ts_poll_result_icon',
				'change_attr' => 'data-tsp',
			),
			'ts_poll_rb_is'   => array(
				'label'        => esc_attr__( 'Icon size', 'tspoll' ),
				'type'         => 'range',
				'options'      => array(
					'min' => 8,
					'max' => 48,
				),
				'change'       => '--tsp_result_icon_fs_' . $this->tsp_build_id,
				'change_param' => 'px',
			),
		),
		esc_html__( 'Back button', 'tspoll' )        => array(
			'ts_poll_p_bb_mbgc' => array(
				'label'       => esc_attr__( 'Main background', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_r_footer_bgc_' . $this->tsp_build_id,
			),
			'ts_poll_p_bb_pos'  => array(
				'label'       => esc_attr__( 'Position', 'tspoll' ),
				'type'        => 'select-position',
				'options'     => array(
					'left'  => esc_attr__( 'Left', 'tspoll' ),
					'right' => esc_attr__( 'Right', 'tspoll' ),
					'full'  => esc_attr__( 'Full Width', 'tspoll' ),
				),
				'change_elem' => '.ts_poll_back_button',
				'change_attr' => 'data-tsp-pos',
			),
			'ts_poll_p_bb_bc'   => array(
				'label'       => esc_attr__( 'Border color', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_back_bc_' . $this->tsp_build_id,
			),
			'ts_poll_p_bb_bgc'  => array(
				'label'       => esc_attr__( 'Background', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_back_bgc_' . $this->tsp_build_id,
			),
			'ts_poll_p_bb_c'    => array(
				'label'       => esc_attr__( 'Color', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_back_c_' . $this->tsp_build_id,
			),
			'ts_poll_p_bb_hbgc' => array(
				'label'       => esc_attr__( 'Hover background', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_back_h_bgc_' . $this->tsp_build_id,
			),
			'ts_poll_p_bb_hc'   => array(
				'label'       => esc_attr__( 'Hover color', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_back_h_c_' . $this->tsp_build_id,
			),
			'ts_poll_p_bb_text' => array(
				'label'       => esc_attr__( 'Text', 'tspoll' ),
				'type'        => 'text',
				'change_elem' => '.ts_poll_back_button,.ts_poll_back_icon > span',
				'change_attr' => 'data-tsp-text',
			),
			'ts_poll_p_bb_it'   => array(
				'label'       => esc_attr__( 'Icon', 'tspoll' ),
				'type'        => 'select-icon',
				'change_elem' => '.ts_poll_back_icon',
				'change_attr' => 'class',
			),
			'ts_poll_p_bb_ia'   => array(
				'label'       => esc_attr__( 'Position', 'tspoll' ),
				'type'        => 'select',
				'options'     => array(
					'after'  => esc_attr__( 'After text', 'tspoll' ),
					'before' => esc_attr__( 'Before text', 'tspoll' ),
				),
				'change_elem' => '.ts_poll_back_icon',
				'change_attr' => 'data-tsp',
			),
			'ts_poll_bb_mbgc'   => array(
				'label'       => esc_attr__( 'Main background', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_r_footer_bgc_' . $this->tsp_build_id,
			),
			'ts_poll_bb_pos'    => array(
				'label'       => esc_attr__( 'Position', 'tspoll' ),
				'type'        => 'select-position',
				'options'     => array(
					'left'  => esc_attr__( 'Left', 'tspoll' ),
					'right' => esc_attr__( 'Right', 'tspoll' ),
					'full'  => esc_attr__( 'Full Width', 'tspoll' ),
				),
				'change_elem' => '.ts_poll_back_button',
				'change_attr' => 'data-tsp-pos',
			),
			'ts_poll_bb_bc'     => array(
				'label'       => esc_attr__( 'Border color', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_back_bc_' . $this->tsp_build_id,
			),
			'ts_poll_bb_bgc'    => array(
				'label'       => esc_attr__( 'Background', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_back_bgc_' . $this->tsp_build_id,
			),
			'ts_poll_bb_c'      => array(
				'label'       => esc_attr__( 'Color', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_back_c_' . $this->tsp_build_id,
			),
			'ts_poll_bb_hbgc'   => array(
				'label'       => esc_attr__( 'Hover background', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_back_h_bgc_' . $this->tsp_build_id,
			),
			'ts_poll_bb_hc'     => array(
				'label'       => esc_attr__( 'Hover color', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_back_h_c_' . $this->tsp_build_id,
			),
			'ts_poll_bb_text'   => array(
				'label'       => esc_attr__( 'Text', 'tspoll' ),
				'type'        => 'text',
				'change_elem' => '.ts_poll_back_button,.ts_poll_back_icon > span',
				'change_attr' => 'data-tsp-text',
			),
			'ts_poll_bb_it'     => array(
				'label'       => esc_attr__( 'Icon', 'tspoll' ),
				'type'        => 'select-icon',
				'change_elem' => '.ts_poll_back_icon',
				'change_attr' => 'class',
			),
			'ts_poll_bb_ia'     => array(
				'label'       => esc_attr__( 'Position', 'tspoll' ),
				'type'        => 'select',
				'options'     => array(
					'after'  => esc_attr__( 'After text', 'tspoll' ),
					'before' => esc_attr__( 'Before text', 'tspoll' ),
				),
				'change_elem' => '.ts_poll_back_icon',
				'change_attr' => 'data-tsp',
			),
		),
		esc_html__( 'Result header', 'tspoll' )      => array(
			'ts_poll_p_q_bgc' => array(
				'label'       => esc_attr__( 'Background color', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_r_header_bgc_' . $this->tsp_build_id,
			),
			'ts_poll_p_q_c'   => array(
				'label'       => esc_attr__( 'Color', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_r_header_c_' . $this->tsp_build_id,
			),
			'ts_poll_p_laq_w' => array(
				'label'        => esc_attr__( 'Line width', 'tspoll' ),
				'type'         => 'range',
				'options'      => array(
					'min' => 0,
					'max' => 100,
				),
				'change'       => '--tsp_r_header_l_w_' . $this->tsp_build_id,
				'change_param' => '%',
			),
			'ts_poll_p_laq_h' => array(
				'label'        => esc_attr__( 'Line height', 'tspoll' ),
				'type'         => 'range',
				'options'      => array(
					'min' => 0,
					'max' => 5,
				),
				'change'       => '--tsp_r_header_l_bh_' . $this->tsp_build_id,
				'change_param' => 'px',
			),
			'ts_poll_p_laq_s' => array(
				'label'       => esc_attr__( 'Line style', 'tspoll' ),
				'type'        => 'select',
				'options'     => array(
					'none'   => esc_attr__( 'None', 'tspoll' ),
					'solid'  => esc_attr__( 'Solid', 'tspoll' ),
					'dotted' => esc_attr__( 'Dotted', 'tspoll' ),
					'dashed' => esc_attr__( 'Dashed', 'tspoll' ),
				),
				'change_attr' => '--tsp_r_header_l_bs_' . $this->tsp_build_id,
			),
			'ts_poll_p_laq_c' => array(
				'label'       => esc_attr__( 'Line color', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_r_header_l_bc_' . $this->tsp_build_id,
			),
		),
		esc_html__( 'Popup option', 'tspoll' )       => array(
			'ts_poll_pop_show' => array(
				'label'   => esc_attr__( 'Show popup', 'tspoll' ),
				'type'    => 'input-toggle',
				'options' => array(
					'yes' => 'Yes',
					'no'  => 'No',
				),
			),
			'ts_poll_pop_it'   => array(
				'label'       => esc_attr__( 'Close icon', 'tspoll' ),
				'type'        => 'select-icon',
				'change_elem' => '.tsp_popup_close_icon_' . $this->tsp_build_id,
				'change_attr' => 'class',
			),
			'ts_poll_pop_ic'   => array(
				'label'       => esc_attr__( 'Icon color', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_popup_close_c_' . $this->tsp_build_id,
			),
			'ts_poll_pop_bw'   => array(
				'label'        => esc_attr__( 'Border width', 'tspoll' ),
				'type'         => 'range',
				'options'      => array(
					'min' => 0,
					'max' => 10,
				),
				'change'       => '--tsp_popup_bw_' . $this->tsp_build_id,
				'change_param' => 'px',
			),
			'ts_poll_pop_bc'   => array(
				'label'       => esc_attr__( 'Border color', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_popup_bc_' . $this->tsp_build_id,
			),
			'ts_poll_p_bw'     => array(
				'label'        => esc_attr__( 'Border width', 'tspoll' ),
				'type'         => 'range',
				'options'      => array(
					'min' => 0,
					'max' => 10,
				),
				'change'       => '--tsp_r_section_bw_' . $this->tsp_build_id,
				'change_param' => 'px',
			),
			'ts_poll_p_bc'     => array(
				'label'       => esc_attr__( 'Border color', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_r_section_bc_' . $this->tsp_build_id,
			),
			'ts_poll_p_shpop'  => array(
				'label'   => esc_attr__( 'Show in popup', 'tspoll' ),
				'type'    => 'input-toggle',
				'options' => array(
					'yes' => 'Yes',
					'no'  => 'No',
				),
			),
			'ts_poll_p_sheff'  => array(
				'label'       => esc_attr__( 'Show effect', 'tspoll' ),
				'type'        => 'select',
				'options'     => array(
					'FTTB' => esc_attr__( 'From Top to Bottom', 'tspoll' ),
					'FLTR' => esc_attr__( 'From Left to Right', 'tspoll' ),
					'FRTL' => esc_attr__( 'From Right to Left', 'tspoll' ),
					'FCTA' => esc_attr__( 'From Center to Full', 'tspoll' ),
					'FTL'  => esc_attr__( 'Rotate Y', 'tspoll' ),
					'FTR'  => esc_attr__( 'Rotate X', 'tspoll' ),
					'FBL'  => esc_attr__( 'Rotate', 'tspoll' ),
					'FBR'  => esc_attr__( 'Skew X', 'tspoll' ),
					'FBTT' => esc_attr__( 'Skew Y', 'tspoll' ),
				),
				'change_elem' => '#ts_poll_modal_result_section_' . $this->tsp_build_id . ',.ts_poll_r_section_' . $this->tsp_build_id,
				'change_attr' => 'data-tsp-effect',
			),
		),
		esc_html__( 'After vote', 'tspoll' )         => array(
			'ts_poll_p_a_mbgc' => array(
				'label'       => esc_attr__( 'Main background', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_r_main_bgc_' . $this->tsp_build_id,
			),
			'ts_poll_p_a_bgc'  => array(
				'label'       => esc_attr__( 'Answer background', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_r_answer_bgc_' . $this->tsp_build_id,
			),
			'ts_poll_p_a_oc'   => array(
				'label'       => esc_attr__( 'Background', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_overlay_bgc_' . $this->tsp_build_id,
			),
			'ts_poll_p_a_c'    => array(
				'label'       => esc_attr__( 'Answer color', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_overlay_c_' . $this->tsp_build_id,
			),
			'ts_poll_p_a_vc'   => array(
				'label'       => esc_attr__( 'Vote color', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_r_answer_vc_' . $this->tsp_build_id,
			),
			'ts_poll_p_a_vt'   => array(
				'label'       => esc_attr__( 'Vote type', 'tspoll' ),
				'type'        => 'select',
				'options'     => array(
					'percent'    => esc_attr__( 'Percent', 'tspoll' ),
					'percentlab' => esc_attr__( 'Label + Percent', 'tspoll' ),
					'count'      => esc_attr__( 'Votes Count', 'tspoll' ),
					'countlab'   => esc_attr__( 'Label + Votes Count', 'tspoll' ),
					'both'       => esc_attr__( 'Both', 'tspoll' ),
					'bothlab'    => esc_attr__( 'Label + Both', 'tspoll' ),
				),
				'change_elem' => '.ts_poll_answer_info_line',
				'change_attr' => 'data-tsp-vt',
			),
			'ts_poll_p_a_veff' => array(
				'label'       => esc_attr__( 'Vote effect', 'tspoll' ),
				'type'        => 'select',
				'options'     => array(
					'0' => esc_attr__( 'None', 'tspoll' ),
					'1' => esc_attr__( 'Effect', 'tspoll' ) . '1',
					'2' => esc_attr__( 'Effect', 'tspoll' ) . '2',
				),
				'change_elem' => '.ts_poll_main_' . $this->tsp_build_id,
				'change_attr' => 'data-tsp-effect',
			),
			'ts_poll_p_laa_w'  => array(
				'label'        => esc_attr__( 'Line width', 'tspoll' ),
				'type'         => 'range',
				'options'      => array(
					'min' => 0,
					'max' => 100,
				),
				'change'       => '--tsp_r_main_l_w_' . $this->tsp_build_id,
				'change_param' => '%',
			),
			'ts_poll_p_laa_h'  => array(
				'label'        => esc_attr__( 'Line height', 'tspoll' ),
				'type'         => 'range',
				'options'      => array(
					'min' => 0,
					'max' => 5,
				),
				'change'       => '--tsp_r_main_l_h_' . $this->tsp_build_id,
				'change_param' => 'px',
			),
			'ts_poll_p_laa_s'  => array(
				'label'       => esc_attr__( 'Line style', 'tspoll' ),
				'type'        => 'select',
				'options'     => array(
					'none'   => esc_attr__( 'None', 'tspoll' ),
					'solid'  => esc_attr__( 'Solid', 'tspoll' ),
					'dotted' => esc_attr__( 'Dotted', 'tspoll' ),
					'dashed' => esc_attr__( 'Dashed', 'tspoll' ),
				),
				'change_attr' => '--tsp_r_main_l_bs_' . $this->tsp_build_id,
			),
			'ts_poll_p_laa_c'  => array(
				'label'       => esc_attr__( 'Line color', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_r_main_l_bc_' . $this->tsp_build_id,
			),
			'ts_poll_v_ca'     => array(
				'label'       => esc_attr__( 'Individual colors for', 'tspoll' ),
				'type'        => 'select',
				'options'     => array(
					'Nothing'    => esc_attr__( 'Nothing', 'tspoll' ),
					'Background' => esc_attr__( 'Background', 'tspoll' ),
					'Color'      => esc_attr__( 'Color', 'tspoll' ),
				),
				'change_elem' => '.ts_poll_main_' . $this->tsp_build_id,
				'change_attr' => 'data-tsp-voted',
			),
			'ts_poll_v_mbgc'   => array(
				'label'       => esc_attr__( 'Main background', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_block_bgc_' . $this->tsp_build_id,
			),
			'ts_poll_v_bgc'    => array(
				'label'       => esc_attr__( 'Answer background', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_progress_bgc_' . $this->tsp_build_id,
			),
			'ts_poll_v_c'      => array(
				'label'       => esc_attr__( 'Answer color', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_progress_c_' . $this->tsp_build_id,
			),
			'ts_poll_v_t'      => array(
				'label'   => esc_attr__( 'Result show type', 'tspoll' ),
				'type'    => 'select',
				'options' => array(
					'percent'    => esc_attr__( 'Percent', 'tspoll' ),
					'percentlab' => esc_attr__( 'Label + Percent', 'tspoll' ),
					'count'      => esc_attr__( 'Votes Count', 'tspoll' ),
					'countlab'   => esc_attr__( 'Label + Votes Count', 'tspoll' ),
					'both'       => esc_attr__( 'Both', 'tspoll' ),
					'bothlab'    => esc_attr__( 'Label + Both', 'tspoll' ),
				),
			),
			'ts_poll_v_eff'    => array(
				'label'       => esc_attr__( 'Vote effect', 'tspoll' ),
				'type'        => 'select',
				'options'     => array(
					'0' => esc_attr__( 'None', 'tspoll' ),
					'1' => esc_attr__( 'Effect', 'tspoll' ) . '1',
					'2' => esc_attr__( 'Effect', 'tspoll' ) . '2',
					'3' => esc_attr__( 'Effect', 'tspoll' ) . '3',
					'4' => esc_attr__( 'Effect', 'tspoll' ) . '4',
					'5' => esc_attr__( 'Effect', 'tspoll' ) . '5',
					'6' => esc_attr__( 'Effect', 'tspoll' ) . '6',
					'7' => esc_attr__( 'Effect', 'tspoll' ) . '7',
					'8' => esc_attr__( 'Effect', 'tspoll' ) . '8',
					'9' => esc_attr__( 'Effect', 'tspoll' ) . '9',
				),
				'change_elem' => '.ts_poll_main_' . $this->tsp_build_id,
				'change_attr' => 'data-tsp-veff',
			),
		),
	);
	$tsp_builder_setting_arr   = array(
		esc_html__( 'Upcoming poll options', 'tspoll' ) => array(
			'TotalSoft_Poll_Set_02' => array(
				'label' => esc_attr__( 'Start date', 'tspoll' ),
				'type'  => 'date',
			),
			'TotalSoft_Poll_Set_04' => array(
				'label' => esc_attr__( 'Text', 'tspoll' ),
				'type'  => 'text',
			),
			'TotalSoft_Poll_Set_06' => array(
				'label'       => esc_attr__( 'Overlay color', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_coming_bgc_' . $this->tsp_build_id,
			),
			'TotalSoft_Poll_Set_07' => array(
				'label'       => esc_attr__( 'Color', 'tspoll' ),
				'type'        => 'color',
				'change_prop' => '--tsp_coming_c_' . $this->tsp_build_id,
			),
			'TotalSoft_Poll_Set_08' => array(
				'label'        => esc_attr__( 'Font size', 'tspoll' ),
				'type'         => 'range',
				'options'      => array(
					'min' => 8,
					'max' => 48,
				),
				'change'       => '--tsp_coming_fs_' . $this->tsp_build_id,
				'change_param' => 'px',
			),
			'TotalSoft_Poll_Set_09' => array(
				'label'       => esc_attr__( 'Font family', 'tspoll' ),
				'type'        => 'select',
				'options'     => $tsp_font_families,
				'change_attr' => '--tsp_coming_ff_' . $this->tsp_build_id,
			),
		),
		esc_html__( 'End poll options', 'tspoll' )      => array(
			'TotalSoft_Poll_Set_03' => array(
				'label' => esc_attr__( 'End date', 'tspoll' ),
				'type'  => 'date',
			),
		),
		esc_html__( 'Result options', 'tspoll' )        => array(
			'TotalSoft_Poll_Set_01' => array(
				'label'   => esc_attr__( 'Show results', 'tspoll' ),
				'type'    => 'input-toggle',
				'options' => array(
					'yes' => '',
					'no'  => '',
				),
			),
			'TotalSoft_Poll_Set_05' => array(
				'label' => esc_attr__( 'Text for no result', 'tspoll' ),
				'type'  => 'text',
			),
		),
	);
	$tsp_builder_styles        = array( 'ts_poll_mw', 'ts_poll_pos', 'ts_poll_bw', 'ts_poll_bc', 'ts_poll_br', 'ts_poll_boxsh_show', 'ts_poll_boxsh_type', 'ts_poll_boxsh', 'ts_poll_boxshc', 'ts_poll_q_bgc', 'ts_poll_q_c', 'ts_poll_q_fs', 'ts_poll_q_ff', 'ts_poll_q_ta', 'ts_poll_laq_w', 'ts_poll_laq_h', 'ts_poll_laq_c', 'ts_poll_laq_s', 'ts_poll_a_fs', 'ts_poll_a_ctf', 'ts_poll_a_bgc', 'ts_poll_a_c', 'ts_poll_ch_cm', 'ts_poll_ch_s', 'ts_poll_ch_tbc', 'ts_poll_ch_cbc', 'ts_poll_ch_tac', 'ts_poll_ch_cac', 'ts_poll_a_hbgc', 'ts_poll_a_hc', 'ts_poll_laa_w', 'ts_poll_laa_h', 'ts_poll_laa_c', 'ts_poll_laa_s', 'ts_poll_vb_mbgc', 'ts_poll_vb_pos', 'ts_poll_vb_bw', 'ts_poll_vb_bc', 'ts_poll_vb_br', 'ts_poll_vb_bgc', 'ts_poll_vb_c', 'ts_poll_vb_fs', 'ts_poll_vb_ff', 'ts_poll_vb_text', 'ts_poll_vb_it', 'ts_poll_vb_ia', 'ts_poll_vb_is', 'ts_poll_vb_hbgc', 'ts_poll_vb_hc', 'ts_poll_rb_show', 'ts_poll_rb_pos', 'ts_poll_rb_bw', 'ts_poll_rb_bc', 'ts_poll_rb_br', 'ts_poll_rb_bgc', 'ts_poll_rb_c', 'ts_poll_rb_fs', 'ts_poll_rb_ff', 'ts_poll_rb_text', 'ts_poll_rb_it', 'ts_poll_rb_ia', 'ts_poll_rb_is', 'ts_poll_rb_hbgc', 'ts_poll_rb_hc', 'ts_poll_p_bw', 'ts_poll_p_bc', 'ts_poll_p_shpop', 'ts_poll_p_sheff', 'ts_poll_p_q_bgc', 'ts_poll_p_q_c', 'ts_poll_p_laq_w', 'ts_poll_p_laq_h', 'ts_poll_p_laq_c', 'ts_poll_p_laq_s', 'ts_poll_p_a_bgc', 'ts_poll_p_a_c', 'ts_poll_p_a_vt', 'ts_poll_p_a_vc', 'ts_poll_p_a_veff', 'ts_poll_p_laa_w', 'ts_poll_p_laa_h', 'ts_poll_p_laa_c', 'ts_poll_p_laa_s', 'ts_poll_p_bb_pos', 'ts_poll_p_bb_bc', 'ts_poll_p_bb_bgc', 'ts_poll_p_bb_c', 'ts_poll_p_bb_text', 'ts_poll_p_bb_it', 'ts_poll_p_bb_ia', 'ts_poll_p_bb_hbgc', 'ts_poll_p_bb_hc', 'ts_poll_p_bb_mbgc', 'ts_poll_p_a_mbgc', 'ts_poll_a_mbgc', 'ts_poll_a_cc', 'ts_poll_a_ih', 'ts_poll_a_ca', 'ts_poll_a_pos', 'ts_poll_a_hsh_show', 'ts_poll_a_hshc', 'ts_poll_p_a_oc', 'ts_poll_play_ic', 'ts_poll_play_is', 'ts_poll_play_iovc', 'ts_poll_play_it', 'ts_poll_tv_show', 'ts_poll_tv_pos', 'ts_poll_tv_c', 'ts_poll_tv_fs', 'ts_poll_tv_text', 'ts_poll_vt_it', 'ts_poll_v_ca', 'ts_poll_v_mbgc', 'ts_poll_v_bgc', 'ts_poll_v_c', 'ts_poll_v_t', 'ts_poll_v_eff', 'ts_poll_bb_mbgc', 'ts_poll_bb_pos', 'ts_poll_bb_bc', 'ts_poll_bb_bgc', 'ts_poll_bb_c', 'ts_poll_bb_text', 'ts_poll_bb_it', 'ts_poll_bb_ia', 'ts_poll_bb_hbgc', 'ts_poll_bb_hc', 'ts_poll_vt_ia', 'ts_poll_a_bw', 'ts_poll_a_bc', 'ts_poll_a_br', 'ts_poll_ch_sh', 'ts_poll_rb_mbgc', 'ts_poll_i_h', 'ts_poll_i_ra', 'ts_poll_i_oc', 'ts_poll_i_it', 'ts_poll_i_ic', 'ts_poll_i_is', 'ts_poll_pop_show', 'ts_poll_pop_it', 'ts_poll_pop_ic', 'ts_poll_pop_bw', 'ts_poll_pop_bc', 'ts_poll_v_w', 'ts_poll_vb_show' );
	$tsp_builder_styles_base   = $this->tsp_build_proporties['Question_Style'];
	$tsp_builder_settings_base =  $this->tsp_build_proporties['Question_Settings'];
	$tsp_builder_param_base    =  $this->tsp_build_proporties['Question_Param'];
	switch ( $tsp_builder_param_base['TS_Poll_Q_Theme'] ) {
		case 'Standart Poll':
		case 'Standard Poll':
			$tsp_builder_arr[ esc_html__( 'After vote', 'tspoll' ) ]['ts_poll_p_a_vt']['options']       = array(
				'percent' => esc_attr__( 'Percent', 'tspoll' ),
				'count'   => esc_attr__( 'Votes Count', 'tspoll' ),
				'both'    => esc_attr__( 'Both', 'tspoll' ),
			);
			$tsp_builder_arr[ esc_html__( 'After vote', 'tspoll' ) ]['ts_poll_p_a_veff']['options']     = array(
				'1' => esc_attr__( 'Effect', 'tspoll' ) . '1',
				'2' => esc_attr__( 'Effect', 'tspoll' ) . '2',
				'3' => esc_attr__( 'Effect', 'tspoll' ) . '3',
				'4' => esc_attr__( 'Effect', 'tspoll' ) . '4',
				'5' => esc_attr__( 'Effect', 'tspoll' ) . '5',
				'6' => esc_attr__( 'Effect', 'tspoll' ) . '6',
				'7' => esc_attr__( 'Effect', 'tspoll' ) . '7',
				'8' => esc_attr__( 'Effect', 'tspoll' ) . '8',
				'9' => esc_attr__( 'Effect', 'tspoll' ) . '9',
			);
			$tsp_builder_arr[ esc_html__( 'After vote', 'tspoll' ) ]['ts_poll_p_a_veff']['change_elem'] = '.ts_poll_r_main_' . $this->tsp_build_id;
			$tsp_builder_arr[ esc_html__( 'After vote', 'tspoll' ) ]['ts_poll_p_a_veff']['change_attr'] = 'data-tsp-veff';
			$tsp_builder_arr[ esc_html__( 'After vote', 'tspoll' ) ]['ts_poll_p_a_c']['change_prop']    = '--tsp_r_answer_pc_' . $this->tsp_build_id;
			break;
		case 'Image Poll':
		case 'Video Poll':
			if ( in_array( $tsp_builder_styles_base['ts_poll_a_ih'], range( 1, 9 ) ) ) {
				$tsp_builder_styles_base['ts_poll_a_iht'] = 'ratio';
				$tsp_builder_styles_base['ts_poll_a_ihr'] = $tsp_builder_styles_base['ts_poll_a_ih'];
				$tsp_builder_styles_base['ts_poll_a_ih']  = '160';
			} elseif ( in_array( $tsp_builder_styles_base['ts_poll_a_ih'], range( 50, 500 ) ) ) {
				$tsp_builder_styles_base['ts_poll_a_iht'] = 'fixed';
				$tsp_builder_styles_base['ts_poll_a_ihr'] = '1';
			}
			if ( $tsp_builder_param_base['TS_Poll_Q_Theme'] == 'Video Poll' ) {
				$tsp_builder_arr[ esc_html__( 'Video play', 'tspoll' ) ] = array(
					'ts_poll_play_iovc' => array(
						'label'       => esc_attr__( 'Background color', 'tspoll' ),
						'type'        => 'color',
						'change_prop' => '--tsp_video_bgc_' . $this->tsp_build_id,
					),
					'ts_poll_play_ic'   => array(
						'label'       => esc_attr__( 'Color', 'tspoll' ),
						'type'        => 'color',
						'change_prop' => '--tsp_video_c_' . $this->tsp_build_id,
					),
					'ts_poll_play_is'   => array(
						'label'        => esc_attr__( 'Icon size', 'tspoll' ),
						'type'         => 'range',
						'options'      => array(
							'min' => 8,
							'max' => 150,
						),
						'change'       => '--tsp_video_fs_' . $this->tsp_build_id,
						'change_param' => 'px',
					),
					'ts_poll_play_it'   => array(
						'label'       => esc_attr__( 'Icon', 'tspoll' ),
						'type'        => 'select-icon',
						'change_elem' => '.ts_poll_video_play_ic',
						'change_attr' => 'class',
					),
				);
			}
			break;
		case 'Image in Question':
			unset( $tsp_builder_arr[ esc_html__( 'Answer image', 'tspoll' ) ] );
			$key             = esc_html__( 'Header', 'tspoll' );
			$keys            = array_keys( $tsp_builder_arr );
			$index           = array_search( $key, $keys );
			$pos             = false === $index ? count( $tsp_builder_arr ) : $index + 1;
			$tsp_builder_arr = array_merge( array_slice( $tsp_builder_arr, 0, $pos ), array( esc_html__( 'Header image', 'tspoll' ) => array() ), array_slice( $tsp_builder_arr, $pos ) );
			$tsp_builder_arr[ esc_html__( 'Header image', 'tspoll' ) ] = array(
				'ts_poll_i_h'        => array(
					'label'        => esc_attr__( 'Image width', 'tspoll' ),
					'type'         => 'range',
					'options'      => array(
						'min' => 10,
						'max' => 90,
					),
					'change'       => '--tsp_attachment_w_' . $this->tsp_build_id,
					'change_param' => '%',
				),
				'ts_poll_i_ra'       => array(
					'label'       => esc_attr__( 'Image ratio', 'tspoll' ),
					'type'        => 'select-position',
					'options'     => array(
						'1' => '1x1',
						'2' => '16x9',
						'3' => '9x16',
						'4' => '3x4',
						'5' => '4x3',
						'6' => '3x2',
						'7' => '2x3',
						'8' => '8x5',
						'9' => '5x8',
					),
					'change_elem' => '.ts_poll_img_div_' . $this->tsp_build_id,
					'change_attr' => 'data-tsp-ratio',
				),
				'TotalSoftPoll_Q_Im' => array(
					'label' => esc_attr__( 'Question image', 'tspoll' ),
					'type'  => 'wp_media_image',
				),
			);
			unset( $tsp_builder_arr[ esc_html__( 'Answer image', 'tspoll' ) ]['ts_poll_i_h'] );
			unset( $tsp_builder_arr[ esc_html__( 'Answer image', 'tspoll' ) ]['ts_poll_i_ra'] );
			break;
		case 'Video in Question':
			unset( $tsp_builder_arr[ esc_html__( 'Answer image', 'tspoll' ) ] );
			$key             = esc_html__( 'Header', 'tspoll' );
			$keys            = array_keys( $tsp_builder_arr );
			$index           = array_search( $key, $keys );
			$pos             = false === $index ? count( $tsp_builder_arr ) : $index + 1;
			$tsp_builder_arr = array_merge( array_slice( $tsp_builder_arr, 0, $pos ), array( esc_html__( 'Header video', 'tspoll' ) => array() ), array_slice( $tsp_builder_arr, $pos ) );
			$tsp_builder_arr[ esc_html__( 'Header video', 'tspoll' ) ] = array(
				'ts_poll_v_w'        => array(
					'label'        => esc_attr__( 'Video width', 'tspoll' ),
					'type'         => 'range',
					'options'      => array(
						'min' => 0,
						'max' => 100,
					),
					'change'       => '--tsp_video_w_' . $this->tsp_build_id,
					'change_param' => '%',
				),
				'TotalSoftPoll_Q_Vd' => array(
					'label' => esc_attr__( 'Question video', 'tspoll' ),
					'type'  => 'wp_media_video',
				),
			);
			break;
	}
	?>
  <div class="tsp_content tsp_flex_row active" data-tsp-section="field_style">
	<div class="tsp_preview_content">
	  <?php
		echo do_shortcode( sprintf( '[TS_Poll id="%s" edit="true"]', esc_attr( $this->tsp_build_id ) ) );
		$t_s_poll_builder_params = $this->tsp_build_proporties;
		?>
	</div>
	<div class=" tsp_flex_col tsp_content_subsection active" data-tsp-subsection="field">
	  <main class="tsp_content_fields_menu">
		  <div aria-tsp-use="field" class="tsp_flex_col active">
			<div class="tsp-list tsp_flex_col" id="tsp-list" >
			  <?php
				$tsp_sort_order = explode( ',', $t_s_poll_builder_params['Answers_Sort'] );
				uksort(
					$t_s_poll_builder_params['Question_Answers'],
					function( $x, $y ) use ( $tsp_sort_order ) {
						if ( (int) array_search( $x, $tsp_sort_order ) == (int) array_search( $y, $tsp_sort_order ) ) {
							return 0;
						}
						return ( (int) array_search( $x, $tsp_sort_order ) < (int) array_search( $y, $tsp_sort_order ) ) ? -1 : 1;
					}
				);
			  $tsp_total_votes_count = array_sum( array_column( $t_s_poll_builder_params['Question_Answers'], 'Answer_Votes' ) );
			  if ( $tsp_total_votes_count == '0' || $tsp_total_votes_count == 0 ) {
				  $tsp_total_votes_count = 1;
			  }
			  foreach ( $t_s_poll_builder_params['Question_Answers'] as $key => $value ) :
					?>
				<div class="tsp-list-item" aria-tsp-answer="<?php echo esc_attr( $value['id'] ); ?>" aria-tsp-count="<?php echo esc_attr( $value['Answer_Votes'] ); ?>" aria-tsp-percent="<?php echo esc_attr( round( $value['Answer_Votes'] * 100 / $tsp_total_votes_count, 2 ) ); ?>">
				  <div class="tsp_handle_list tsp_list_action flex-center">
					<img src="<?php echo esc_url( plugin_dir_url( __FILE__ ) . 'img/move.svg' ); ?>">
				  </div>
				  <div class="details tsp_analytics_flex_r">
					  <h2><?php echo esc_attr( $value['Answer_Title'] ); ?></h2>
				  </div>
				  <div class="tsp_list_action flex-center" data-tsp-action="edit">
					<img src="<?php echo esc_url( plugin_dir_url( __FILE__ ) . 'img/edit.svg' ); ?>">
				  </div>
				  <div class="tsp_list_action flex-center" data-tsp-action="copy">
					<img src="<?php echo esc_url( plugin_dir_url( __FILE__ ) . 'img/copy.svg' ); ?>">
				  </div>
				  <div class="tsp_list_action flex-center" data-tsp-action="delete">
					  <img src="<?php echo esc_url( plugin_dir_url( __FILE__ ) . 'img/recycle.svg' ); ?>">
				  </div>
				</div>
			  <?php endforeach; ?>
			</div>
			<div class="tsp-add_answer-div tsp_flex_row">
			  <div id="tsp-add_answer">
				<span class="tsp-add_answer_text"><span></span><?php esc_html_e( 'Add answer', 'tspoll' ); ?></span>
				<span class="right ts-poll ts-poll-plus"></span>
			  </div>
			</div>
		  </div>
	  </main>
	  <main class="tsp_content_fields_edit " style="display:none;" >
		<div class="tsp_back_to_answers tsp_flex_row ts-poll ts-poll-home">
		  <?php esc_html_e( 'Back to answers', 'tspoll' ); ?>
		</div>
		<div class="tsp_answer_params">
		  <div class="tsp_select_div_edit">
			<span class="tsp_select_div_title tsp_field_title">
			  <?php esc_html_e( 'Answer title', 'tspoll' ); ?>
			</span>
			<input id="tsp_answer_title" name="tsp_answer_title" type="text"  value="" placeholder="<?php esc_html_e( 'Answer title', 'tspoll' ); ?>"/>
		  </div>
		  <div class="tsp_color_div_edit">
						<label class="tsp_color_label" for="tsp_answer_color"><?php esc_html_e( 'Special color', 'tspoll' ); ?></label>
						<input id="tsp_answer_color" name="tsp_answer_color"  value="#ffffff" />
					</div>
		  <?php
			switch ( $tsp_builder_param_base['TS_Poll_Q_Theme'] ) {
				case 'Video Poll':
				case 'Video Without Button':
					echo sprintf(
						'
                  <div class="tsp_video_div_edit">
                    <span class="tsp_field_title">%s</span>
                    <div class="tsp_vd_change">
                      <img src="%s" style="display:none;">
                      <div class="tsp_vd_hover_div">
                        <span>%s</span>
                        <input type="text"  id="tsp_answer_video_attachment_id" style="display:none;">
                      </div>
                      <div class="tsp_vd_loading_div tsp_flex_col"  style="display:none;">
                        <img src="%s" >
                      </div>
                    </div>
                  </div>
                  <div class="tsp_img_div_edit">
                    <span class="tsp_field_title">%s</span>
                    <div class="tsp_img_change">
                      <img src="%s">
                      <div class="tsp_img_hover_div">
                        <span>%s</span>
                        <input type="text"  id="tsp_answer_attachment_id" style="display:none;">
                      </div>
                      <div class="tsp_img_loading_div tsp_flex_col"  style="display:none;">
                        <img src="%s" >
                      </div>
                    </div>
                  </div>
                  ',
						esc_attr__( 'Answer video', 'tspoll' ),
						esc_url( plugin_dir_url( __DIR__ ) . 'public/img/tsp_no_video.png' ),
						esc_html__( 'Choose video', 'tspoll' ),
						esc_url( plugin_dir_url( __DIR__ ) . 'public/img/tsp_loading.gif' ),
						esc_attr__( 'Answer image', 'tspoll' ),
						esc_url( plugin_dir_url( __DIR__ ) . 'public/img/tsp_no_img.jpg' ),
						esc_html__( 'Choose image', 'tspoll' ),
						esc_url( plugin_dir_url( __DIR__ ) . 'public/img/tsp_loading.gif' )
					);
					break;
				case 'Image Poll':
				case 'Image Without Button':
					echo sprintf(
						'
                  <div class="tsp_img_div_edit">
                    <span class="tsp_field_title">%s</span>
                    <div class="tsp_img_change">
                      <img src="%s">
                      <div class="tsp_img_hover_div">
                        <span>%s</span>
                        <input type="text"  id="tsp_answer_attachment_id" style="display:none;">
                      </div>
                      <div class="tsp_img_loading_div tsp_flex_col"  style="display:none;">
                        <img src="%s" >
                      </div>
                    </div>
                  </div>
                  ',
						esc_html__( 'Answer image', 'tspoll' ),
						esc_url( plugin_dir_url( __DIR__ ) . 'public/img/tsp_no_img.jpg' ),
						esc_html__( 'Choose image', 'tspoll' ),
						esc_url( plugin_dir_url( __DIR__ ) . 'public/img/tsp_loading.gif' )
					);
					break;
			}
			?>
		</div>
	  </main>
	</div>
	<div class="tsp_flex_col  tsp_content_subsection" data-tsp-subsection="style">
	  <div class="tsp_styles_sidebar">
	  <?php
		$tsp_builder_styles_base_keys  = array_keys( $tsp_builder_styles_base );
		$tsp_builder_styles_base_count = count( $tsp_builder_styles_base_keys );
		foreach ( $tsp_builder_arr as $fields_key => $fields_value ) {
			if ( count( array_diff( $tsp_builder_styles_base_keys, array_keys( $tsp_builder_arr[ $fields_key ] ) ) ) == $tsp_builder_styles_base_count ) {
				continue;
			}
			echo sprintf(
				'
          <div class="tsp_accordion_item %s">
            <header class="tsp_accordion_header ">
              <i class="ts-poll ts-poll-angle-right tsp_accordion_header_icon"></i>
              <h3 class="tsp_accordion_header_title">%s</h3>
            </header>
            <div class="tsp_accordion_item_content">
              <div class="tsp_accordion_items tsp_analytics_flex_c">
          ',
				esc_attr( str_replace( ' ', '-', strtolower( $fields_key ) ) ),
				esc_attr( $fields_key )
			);
			foreach ( $fields_value as $key => $value ) {
				if ( array_key_exists( $key, $tsp_builder_styles_base ) ) {
					echo $this->tsp_get_field_html( $key, $value, $tsp_builder_styles_base[ $key ] );
				} elseif ( $key == 'TotalSoftPoll_Q_Im' || $key == 'TotalSoftPoll_Q_Vd' ) {
					echo $this->tsp_get_field_html( $key, $value, $tsp_builder_param_base[ $key ] );
				}
			}
			echo '</div>
            </div>
          </div>  ';
		}
		?>
	  </div>
	</div>
	<div class="tsp_flex_col  tsp_content_subsection" data-tsp-subsection="setting">
	  <div class="tsp_styles_sidebar">
	  <?php
		foreach ( $tsp_builder_setting_arr as $fields_key => $fields_value ) {
			echo sprintf(
				'
            <div class="tsp_accordion_item %s">
              <header class="tsp_accordion_header ">
                <i class="ts-poll ts-poll-angle-right tsp_accordion_header_icon"></i>
                <h3 class="tsp_accordion_header_title">%s</h3>
              </header>
              <div class="tsp_accordion_item_content">
                <div class="tsp_accordion_items tsp_analytics_flex_c">
            ',
				esc_attr( str_replace( ' ', '-', strtolower( $fields_key ) ) ),
				esc_attr( $fields_key )
			);
			foreach ( $fields_value as $key => $value ) {
				if ( array_key_exists( $key, $tsp_builder_settings_base ) ) {
					echo $this->tsp_get_field_html( $key, $value, $tsp_builder_settings_base[ $key ] );
				}
			}
			echo '</div>
            </div>
          </div>  ';
		}
		echo sprintf(
			'
          <div class="tsp_accordion_item %s">
            <header class="tsp_accordion_header ">
              <i class="ts-poll ts-poll-angle-right tsp_accordion_header_icon"></i>
              <h3 class="tsp_accordion_header_title">%s</h3>
            </header>
            <div class="tsp_accordion_item_content">
              <div class="tsp_accordion_items tsp_analytics_flex_c">
                <div class="tsp_checkbox_div">
                  <input class="tsp_checkbox_input_pro" type="checkbox" id="tsp_vote_once_option">
                  <label class="tsp_checkbox_label_pro" for="tsp_vote_once_option">%s</label>
                </div>
                <div class="tsp_select_div">
                  <span class="tsp_select_div_title tsp_field_title">
                    %s
                  </span>
                  <select disabled="">
                    <option >%s</option>
                    <option >%s</option>
                    <option selected="">%s</option>
                    <option >%s</option>
                    <option >%s</option>
                    <option >%s</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          ',
			esc_attr( 'tsp_settings_pro' ),
			esc_attr__( 'Vote Options', 'tspoll' ),
			esc_attr__( 'Vote Once', 'tspoll' ),
			esc_attr__( 'One time voting type', 'tspoll' ),
			esc_attr__( 'PHP Cookie', 'tspoll' ),
			esc_attr__( 'IP Address', 'tspoll' ),
			esc_attr__( 'IP Address time', 'tspoll' ),
			esc_attr__( 'IP Address PHP Cookie', 'tspoll' ),
			esc_attr__( 'IP Address PHP Cookie time', 'tspoll' ),
			esc_attr__( 'PHP Cookie time', 'tspoll' )
		);
		?>
	  </div>    
	</div>
	<div class="tsp_flex_col tsp_content_subsection" data-tsp-subsection="shortcode">
	  <div class="tsp_flex_col" data-tsp-field="shortcode" >
		<p><?php esc_html_e( 'Copy & paste the shortcode directly into any WordPress post or page.', 'tspoll' ); ?></p>
		<div class="tsp_flex_row tsp_shortcode_div">
		  <input type="text" id="tsp_global_shortcode" disabled="">
		  <span class="ts-poll ts-poll-files-o" data-tsp-copy="tsp_global_shortcode"></span>
		</div>
	  </div>
	  <div class="tsp_flex_col" data-tsp-field="shortcode" >
		<p><?php esc_html_e( 'Copy & paste this code into a template file to include the poll within your theme.', 'tspoll' ); ?></p>
		<div class="tsp_flex_row tsp_shortcode_div">
		  <input type="text" id="tsp_global_theme_shortcode" disabled="">
		  <span class="ts-poll ts-poll-files-o" data-tsp-copy="tsp_global_theme_shortcode"></span>
		</div>
	  </div>
	  <div class="tsp_flex_col" data-tsp-field="notice" >
		<div class="tsp_notice_div"><p><?php esc_html_e( 'Please save poll for getting shortcode.', 'tspoll' ); ?></p></div>
	  </div>
	  <div class="tsp_flex_col" data-tsp-field="title" >
		<p><?php esc_html_e( 'Write question text', 'tspoll' ); ?></p>
		<div class="tsp_flex_row tsp_shortcode_div">
		  <input type="text" id="tsp_global_title" value="<?php echo esc_html( html_entity_decode( htmlspecialchars_decode( $this->tsp_build_proporties['Question_Title'] ), ENT_QUOTES ) ); ?>">
		</div>
	  </div>

	</div>
  </div>      
	<?php if ( isset( $_GET['tsp-id'] ) ) { ?>
  <div class="tsp_content" data-tsp-section="votes_count">
  	<div class="tsp_flex_col tsp_analytics_card">
	  <div class="tsp_flex_col" data-tsp-field="notice" >
		<div class="tsp_notice_div"><p><?php esc_html_e( 'If you want to change answer votes,go to pro.', 'tspoll' ); ?></p></div>
	  </div>
	  <table id="tsp_data_results_table">
		<thead>
			<tr>
			  <th data-sortable="false">
				<?php esc_html_e( 'No.', 'tspoll' ); ?>
			  </th>
			  <th data-sortable="false">
				<?php esc_html_e( 'Answer', 'tspoll' ); ?>
			  </th>
			  <th data-sortable="false">
				<?php esc_html_e( 'Votes count', 'tspoll' ); ?>
			  </th>
			</tr>
		</thead>
		<tbody>
			<?php

				$tsp_info_table_count = 1;
			foreach ( $t_s_poll_builder_params['Question_Answers'] as $key => $value ) {
				echo sprintf(
					'
                    <tr data-tsp-elem="%d">
                      <td>%d</td>
                      <td>%s</td>
                      <td><input class="tsp_change_results" type="text" value="%d" min="0"></td>
                    </tr>
                    ',
					(int) esc_html( $value['id'] ),
					esc_attr( (int) $tsp_info_table_count ),
					esc_html( $value['Answer_Title'] ),
					(int) esc_html( $value['Answer_Votes'] )
				);
				$tsp_info_table_count += 1;
			}
			?>

		</tbody>
		<tfoot>
			<tr>
			  <th >
				<?php esc_html_e( 'No.', 'tspoll' ); ?>
			  </th>
			  <th >
				<?php esc_html_e( 'Answer', 'tspoll' ); ?>
			  </th>
			  <th >
				<?php esc_html_e( 'Votes count', 'tspoll' ); ?>
			  </th>
			</tr>
		</tfoot>
	  </table>
	</div>  
  </div>

	<?php }
}
$tsp_content_builder = \ob_get_clean();
$tsp_icons_html      = $tsp_icon_picker_html = '';
if ( 'edit' === $this->tsp_build ) {
	foreach ( $tsp_all_fonts_arr['tsp_fonts'] as $key => $value ) {
		foreach ( $value as $icon_key => $icon_value ) {
			$tsp_icons_html .= sprintf(
				'
        <div class="ts-poll-aim-icon-item"
              data-library-id="%1$s"
              data-filter="%2$s">
          <div class="ts-poll-aim-icon-item-inner">
            <i class="%3$s"></i>
            <div class="ts-poll-aim-icon-item-name" title="%4$s">%4$s</div>
          </div>
        </div>
        ',
				'tsp_emojies' === $key ? esc_attr( 'ts-poll-emoji-regular' ) : esc_attr( 'ts-poll-regular' ),
				'tsp_emojies' === $key ? esc_attr( str_replace( 'ts-poll-emoji ts-poll-emoji-', '', $icon_value ) ) : esc_attr( str_replace( 'ts-poll ts-poll-', '', $icon_value ) ),
				esc_attr( $icon_value ),
				'tsp_emojies' === $key ? esc_attr( str_replace( '-', ' ', str_replace( 'ts-poll-emoji ts-poll-emoji-', '', $icon_value ) ) ) : esc_attr( str_replace( '-', ' ', str_replace( 'ts-poll ts-poll-', '', $icon_value ) ) )
			);
		}
	}
	$tsp_icon_picker_html = sprintf(
		'
    <div class="ts-poll-aim-modal" id="ts-poll-aim-modal" style="display:none;">
      <div class="ts-poll-aim-modal--content">
        <div class="ts-poll-aim-modal--header">
          <div class="ts-poll-aim-modal--header-logo-area">
            <span class="ts-poll-aim-modal--header-logo-title">
              Aesthetic Icon Picker
            </span>
          </div>
          <div class="ts-poll-aim-modal--header-close-btn">
            <i class="ts-poll-fas ts-poll-times" title="Close"></i>
          </div>
        </div>
        <div class="ts-poll-aim-modal--body">
          <div id="ts-poll-aim-modal--sidebar" class="ts-poll-aim-modal--sidebar">
            <div class="ts-poll-aim-modal--sidebar-tabs">
              <div class="ts-poll-aim-modal--sidebar-tab-item aesthetic-active" data-library-id="all">
                <i class="ts-poll ts-poll-star"></i>
                %s
              </div>
              <div class="ts-poll-aim-modal--sidebar-tab-item" data-library-id="ts-poll-regular">
                <i class="ts-poll ts-poll-font-awesome"></i>
                %s
              </div>
              <div class="ts-poll-aim-modal--sidebar-tab-item" data-library-id="ts-poll-emoji-regular">
                <i class="ts-poll-emoji ts-poll-emoji-grinning"></i>
                %s
              </div>
            </div>
          </div>
          <div id="ts-poll-aim-modal--icon-preview-wrap" class="ts-poll-aim-modal--icon-preview-wrap">
            <div class="ts-poll-aim-modal--icon-search">
              <input type="text" id="ts-poll-aim-modal--search_input"  placeholder="%s">
              <i class="ts-poll-fas ts-poll-search"></i>
            </div>
            <div class="ts-poll-aim-modal--icon-preview-inner">
              <div id="ts-poll-aim-modal--icon-preview">
                %s
              </div>
            </div>
          </div>
        </div>
        <div class="ts-poll-aim-modal--footer">
          <button class="ts-poll-aim-insert-icon-button" id="ts-poll-aim-insert-icon-button">
            %s
          </button>
        </div>
      </div>
    </div>',
		esc_html__( 'all', 'tspoll' ),
		esc_html__( 'font awesome', 'tspoll' ),
		esc_html__( 'emojies', 'tspoll' ),
		esc_html__( 'Filter by name...', 'tspoll' ),
		$tsp_icons_html,
		esc_html__( 'Select', 'tspoll' )
	);


	$tsp_font_families_css = '';
	foreach ( $tsp_all_fonts_arr['tsp_font_families'] as $key => $value ) {
		$tsp_font_params        = $value;
		$tsp_font_families_css .= sprintf(
			'
        @font-face {
          font-family: "%s";
          font-style: normal;
          font-weight: 400;
          src: url("%s"); 
          src: url("%s") format("embedded-opentype"), 
               url("%s") format("woff2"), 
               url("%s") format("woff"), 
               url("%s") format("truetype"), 
               url("%s") format("svg");
        }
      ',
			esc_attr( $key ),
			array_key_exists( 'eot', $tsp_font_params ) ? esc_url( $tsp_font_params['eot'] ) : '',
			array_key_exists( 'eot', $tsp_font_params ) ? esc_url( $tsp_font_params['eot'] ) : '',
			array_key_exists( 'woff2', $tsp_font_params ) ? esc_url( $tsp_font_params['woff2'] ) : '',
			array_key_exists( 'woff', $tsp_font_params ) ? esc_url( $tsp_font_params['woff'] ) : '',
			array_key_exists( 'ttf', $tsp_font_params ) ? esc_url( $tsp_font_params['ttf'] ) : '',
			array_key_exists( 'svg', $tsp_font_params ) ? esc_url( $tsp_font_params['svg'] ) : ''
		);
	}
	wp_register_style( 'ts_poll_builder_font_faces', false );
	wp_enqueue_style( 'ts_poll_builder_font_faces' );
	wp_add_inline_style( 'ts_poll_builder_font_faces', $tsp_font_families_css );
}
echo sprintf(
	"
  <section id='tsp_builder_section' class='tsp_flex_row' style='display:none;'>
    <aside id='tsp_sidebar' class='tsp_flex_col tsp_sidebar' data-tsp-use='%s' data-tsp-open='open'>
      <div class='ts_poll_logo tsp_flex_col'>
        <img src='%s'  alt='TS Poll Logo'>
      </div>
      <div class='tsp_sidebar_item %s' data-tsp-item='theme'>
        <svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.com/svgjs' version='1.1' width='20' height='20' x='0' y='0' viewBox='0 0 24 24' style='enable-background:new 0 0 20 20' xml:space='preserve'><g><path xmlns='http://www.w3.org/2000/svg' d='m24 10h-24v-5a5.006 5.006 0 0 1 5-5h5v3a1 1 0 0 0 2 0v-3h2v5a1 1 0 0 0 2 0v-5h2v7a1 1 0 0 0 2 0v-6.9a5.009 5.009 0 0 1 4 4.9zm-23.7 2a7.011 7.011 0 0 0 6.7 5h2v4a3 3 0 0 0 6 0v-4h2a7.011 7.011 0 0 0 6.7-5z' fill='#8c8c8c' data-original='#000000'/></g></svg>
        <span class='tsp_sidebar_item_title'>%s</span>  
      </div>
      <div class='tsp_sidebar_item %s' data-tsp-item='field'>
        <svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.com/svgjs' version='1.1' width='20' height='20' x='0' y='0' viewBox='0 0 24 24' style='enable-background:new 0 0 20 20' xml:space='preserve'><g><path xmlns='http://www.w3.org/2000/svg' d='m21 17h-11v2a1 1 0 0 1 -2 0v-2h-2v2a1 1 0 0 1 -2 0v-2h-1a3 3 0 0 0 0 6h18a3 3 0 0 0 0-6z' fill='#8c8c8c' data-original='#000000'/><path xmlns='http://www.w3.org/2000/svg' d='m21 9h-11v2a1 1 0 0 1 -2 0v-2h-2v2a1 1 0 0 1 -2 0v-2h-1a3 3 0 0 0 0 6h18a3 3 0 0 0 0-6z' fill='#8c8c8c' data-original='#000000'/><path xmlns='http://www.w3.org/2000/svg' d='m21 1h-11v2a1 1 0 0 1 -2 0v-2h-2v2a1 1 0 0 1 -2 0v-2h-1a3 3 0 0 0 0 6h18a3 3 0 0 0 0-6z' fill='#8c8c8c' data-original='#000000'/></g></svg>
        <span class='tsp_sidebar_item_title'>%s</span>  
      </div>
      <div class='tsp_sidebar_item' data-tsp-item='style'>
        <svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.com/svgjs' version='1.1' width='20' height='20' x='0' y='0' viewBox='0 0 512.051 512.051' style='enable-background:new 0 0 512 512' xml:space='preserve'><g><g xmlns='http://www.w3.org/2000/svg'>	<path d='M21.359,101.359h58.368c11.52,42.386,55.219,67.408,97.605,55.888c27.223-7.399,48.489-28.665,55.888-55.888h257.472   c11.782,0,21.333-9.551,21.333-21.333s-9.551-21.333-21.333-21.333H233.22C221.7,16.306,178.001-8.716,135.615,2.804   c-27.223,7.399-48.489,28.665-55.888,55.888H21.359c-11.782,0-21.333,9.551-21.333,21.333S9.577,101.359,21.359,101.359z' fill='#8c8c8c' data-original='#000000'/>	<path d='M490.692,234.692h-58.368c-11.497-42.38-55.172-67.416-97.552-55.92c-27.245,7.391-48.529,28.674-55.92,55.92H21.359   c-11.782,0-21.333,9.551-21.333,21.333c0,11.782,9.551,21.333,21.333,21.333h257.493c11.497,42.38,55.172,67.416,97.552,55.92   c27.245-7.391,48.529-28.674,55.92-55.92h58.368c11.782,0,21.333-9.551,21.333-21.333   C512.025,244.243,502.474,234.692,490.692,234.692z' fill='#8c8c8c' data-original='#000000'/>	<path d='M490.692,410.692H233.22c-11.52-42.386-55.219-67.408-97.605-55.888c-27.223,7.399-48.489,28.665-55.888,55.888H21.359   c-11.782,0-21.333,9.551-21.333,21.333c0,11.782,9.551,21.333,21.333,21.333h58.368c11.52,42.386,55.219,67.408,97.605,55.888   c27.223-7.399,48.489-28.665,55.888-55.888h257.472c11.782,0,21.333-9.551,21.333-21.333   C512.025,420.243,502.474,410.692,490.692,410.692z' fill='#8c8c8c' data-original='#000000'/></g></g></svg>
        <span class='tsp_sidebar_item_title'>%s</span>  
      </div>
      <div class='tsp_sidebar_item' data-tsp-item='setting'>
        <svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.com/svgjs' version='1.1' viewBox='0 0 640 512' width='20' height='20'><path fill='#8c8c8c' d='M512.1 191l-8.2 14.3c-3 5.3-9.4 7.5-15.1 5.4-11.8-4.4-22.6-10.7-32.1-18.6-4.6-3.8-5.8-10.5-2.8-15.7l8.2-14.3c-6.9-8-12.3-17.3-15.9-27.4h-16.5c-6 0-11.2-4.3-12.2-10.3-2-12-2.1-24.6 0-37.1 1-6 6.2-10.4 12.2-10.4h16.5c3.6-10.1 9-19.4 15.9-27.4l-8.2-14.3c-3-5.2-1.9-11.9 2.8-15.7 9.5-7.9 20.4-14.2 32.1-18.6 5.7-2.1 12.1.1 15.1 5.4l8.2 14.3c10.5-1.9 21.2-1.9 31.7 0L552 6.3c3-5.3 9.4-7.5 15.1-5.4 11.8 4.4 22.6 10.7 32.1 18.6 4.6 3.8 5.8 10.5 2.8 15.7l-8.2 14.3c6.9 8 12.3 17.3 15.9 27.4h16.5c6 0 11.2 4.3 12.2 10.3 2 12 2.1 24.6 0 37.1-1 6-6.2 10.4-12.2 10.4h-16.5c-3.6 10.1-9 19.4-15.9 27.4l8.2 14.3c3 5.2 1.9 11.9-2.8 15.7-9.5 7.9-20.4 14.2-32.1 18.6-5.7 2.1-12.1-.1-15.1-5.4l-8.2-14.3c-10.4 1.9-21.2 1.9-31.7 0zm-10.5-58.8c38.5 29.6 82.4-14.3 52.8-52.8-38.5-29.7-82.4 14.3-52.8 52.8zM386.3 286.1l33.7 16.8c10.1 5.8 14.5 18.1 10.5 29.1-8.9 24.2-26.4 46.4-42.6 65.8-7.4 8.9-20.2 11.1-30.3 5.3l-29.1-16.8c-16 13.7-34.6 24.6-54.9 31.7v33.6c0 11.6-8.3 21.6-19.7 23.6-24.6 4.2-50.4 4.4-75.9 0-11.5-2-20-11.9-20-23.6V418c-20.3-7.2-38.9-18-54.9-31.7L74 403c-10 5.8-22.9 3.6-30.3-5.3-16.2-19.4-33.3-41.6-42.2-65.7-4-10.9.4-23.2 10.5-29.1l33.3-16.8c-3.9-20.9-3.9-42.4 0-63.4L12 205.8c-10.1-5.8-14.6-18.1-10.5-29 8.9-24.2 26-46.4 42.2-65.8 7.4-8.9 20.2-11.1 30.3-5.3l29.1 16.8c16-13.7 34.6-24.6 54.9-31.7V57.1c0-11.5 8.2-21.5 19.6-23.5 24.6-4.2 50.5-4.4 76-.1 11.5 2 20 11.9 20 23.6v33.6c20.3 7.2 38.9 18 54.9 31.7l29.1-16.8c10-5.8 22.9-3.6 30.3 5.3 16.2 19.4 33.2 41.6 42.1 65.8 4 10.9.1 23.2-10 29.1l-33.7 16.8c3.9 21 3.9 42.5 0 63.5zm-117.6 21.1c59.2-77-28.7-164.9-105.7-105.7-59.2 77 28.7 164.9 105.7 105.7zm243.4 182.7l-8.2 14.3c-3 5.3-9.4 7.5-15.1 5.4-11.8-4.4-22.6-10.7-32.1-18.6-4.6-3.8-5.8-10.5-2.8-15.7l8.2-14.3c-6.9-8-12.3-17.3-15.9-27.4h-16.5c-6 0-11.2-4.3-12.2-10.3-2-12-2.1-24.6 0-37.1 1-6 6.2-10.4 12.2-10.4h16.5c3.6-10.1 9-19.4 15.9-27.4l-8.2-14.3c-3-5.2-1.9-11.9 2.8-15.7 9.5-7.9 20.4-14.2 32.1-18.6 5.7-2.1 12.1.1 15.1 5.4l8.2 14.3c10.5-1.9 21.2-1.9 31.7 0l8.2-14.3c3-5.3 9.4-7.5 15.1-5.4 11.8 4.4 22.6 10.7 32.1 18.6 4.6 3.8 5.8 10.5 2.8 15.7l-8.2 14.3c6.9 8 12.3 17.3 15.9 27.4h16.5c6 0 11.2 4.3 12.2 10.3 2 12 2.1 24.6 0 37.1-1 6-6.2 10.4-12.2 10.4h-16.5c-3.6 10.1-9 19.4-15.9 27.4l8.2 14.3c3 5.2 1.9 11.9-2.8 15.7-9.5 7.9-20.4 14.2-32.1 18.6-5.7 2.1-12.1-.1-15.1-5.4l-8.2-14.3c-10.4 1.9-21.2 1.9-31.7 0zM501.6 431c38.5 29.6 82.4-14.3 52.8-52.8-38.5-29.6-82.4 14.3-52.8 52.8z'></path></svg>      
        <span class='tsp_sidebar_item_title'>%s</span>  
      </div>
      <div class='tsp_sidebar_item' data-tsp-item='shortcode'>
        <svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' width='24px' height='24px' viewBox='0 0 24 24' version='1.1'><g id='surface1'><path style='fill-rule:nonzero;fill:rgb(54.901961%%,54.901961%%,54.901961%%);fill-opacity:1;stroke-width:25;stroke-linecap:butt;stroke-linejoin:round;stroke:rgb(54.901961%%,54.901961%%,54.901961%%);stroke-opacity:1;stroke-miterlimit:10;' d='M 42.368475 56.519248 L 42.368475 169.480752 C 42.368475 177.310574 48.689426 183.631525 56.519248 183.631525 L 84.739234 183.631525 C 87.349175 183.631525 89.469752 185.752102 89.469752 188.321262 C 89.469752 190.931203 87.349175 193.05178 84.739234 193.05178 L 56.519248 193.05178 C 43.510324 193.011 32.989 182.489676 32.94822 169.480752 L 32.94822 56.519248 C 32.989 43.510324 43.510324 32.989 56.519248 32.94822 L 84.739234 32.94822 C 87.349175 32.94822 89.469752 35.068797 89.469752 37.678738 C 89.469752 40.247898 87.349175 42.368475 84.739234 42.368475 L 56.519248 42.368475 C 48.689426 42.368475 42.368475 48.689426 42.368475 56.519248 Z M 183.631525 169.480752 L 183.631525 56.519248 C 183.631525 48.689426 177.310574 42.368475 169.480752 42.368475 L 141.260766 42.368475 C 138.650825 42.368475 136.530248 40.247898 136.530248 37.678738 C 136.530248 35.068797 138.650825 32.94822 141.260766 32.94822 L 169.480752 32.94822 C 182.489676 32.989 193.011 43.510324 193.05178 56.519248 L 193.05178 169.480752 C 193.011 182.489676 182.489676 193.011 169.480752 193.05178 L 141.260766 193.05178 C 138.650825 193.05178 136.530248 190.931203 136.530248 188.321262 C 136.530248 185.752102 138.650825 183.631525 141.260766 183.631525 L 169.480752 183.631525 C 177.310574 183.631525 183.631525 177.310574 183.631525 169.480752 Z M 183.631525 169.480752 ' transform='matrix(0.0957876,0,0,0.0957876,1.176,1.176)'/><path style=' stroke:none;fill-rule:nonzero;fill:rgb(54.901961%%,54.901961%%,54.901961%%);fill-opacity:1;' d='M 5.234375 6.589844 L 5.234375 17.410156 C 5.234375 18.160156 5.839844 18.765625 6.589844 18.765625 L 9.292969 18.765625 C 9.542969 18.765625 9.746094 18.96875 9.746094 19.214844 C 9.746094 19.464844 9.542969 19.667969 9.292969 19.667969 L 6.589844 19.667969 C 5.34375 19.664062 4.335938 18.65625 4.332031 17.410156 L 4.332031 6.589844 C 4.335938 5.34375 5.34375 4.335938 6.589844 4.332031 L 9.292969 4.332031 C 9.542969 4.332031 9.746094 4.535156 9.746094 4.785156 C 9.746094 5.03125 9.542969 5.234375 9.292969 5.234375 L 6.589844 5.234375 C 5.839844 5.234375 5.234375 5.839844 5.234375 6.589844 Z M 17.410156 18.765625 L 14.707031 18.765625 C 14.457031 18.765625 14.253906 18.96875 14.253906 19.214844 C 14.253906 19.464844 14.457031 19.667969 14.707031 19.667969 L 17.410156 19.667969 C 18.65625 19.664062 19.664062 18.65625 19.667969 17.410156 L 19.667969 6.589844 C 19.664062 5.34375 18.65625 4.335938 17.410156 4.332031 L 14.707031 4.332031 C 14.457031 4.332031 14.253906 4.535156 14.253906 4.785156 C 14.253906 5.03125 14.457031 5.234375 14.707031 5.234375 L 17.410156 5.234375 C 18.160156 5.234375 18.765625 5.839844 18.765625 6.589844 L 18.765625 17.410156 C 18.765625 18.160156 18.160156 18.765625 17.410156 18.765625 Z M 17.410156 18.765625 '/></g></svg>
        <span class='tsp_sidebar_item_title'>%s</span>  
      </div>
      <div class='tsp_sidebar_item' data-tsp-item='info'>
        <svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.com/svgjs' version='1.1' width='20' height='20' x='0' y='0' viewBox='0 0 24 24' style='enable-background:new 0 0 512 512' xml:space='preserve'><g><path xmlns='http://www.w3.org/2000/svg' d='M22.5,21H5.5A2.5,2.5,0,0,1,3,18.5V1.5a1.5,1.5,0,0,0-3,0v17A5.506,5.506,0,0,0,5.5,24h17a1.5,1.5,0,0,0,0-3Z' fill='#8c8c8c' data-original='#000000'/><path xmlns='http://www.w3.org/2000/svg' d='M9.5,9A1.5,1.5,0,0,0,8,10.5v7a1.5,1.5,0,0,0,3,0v-7A1.5,1.5,0,0,0,9.5,9Z' fill='#8c8c8c' data-original='#000000'/><path xmlns='http://www.w3.org/2000/svg' d='M14,13.5v4a1.5,1.5,0,0,0,3,0v-4a1.5,1.5,0,0,0-3,0Z' fill='#8c8c8c' data-original='#000000'/><path xmlns='http://www.w3.org/2000/svg' d='M20,9.5v8a1.5,1.5,0,0,0,3,0v-8a1.5,1.5,0,0,0-3,0Z' fill='#8c8c8c' data-original='#000000'/><path xmlns='http://www.w3.org/2000/svg' d='M6,7.5a1.487,1.487,0,0,0,.936-.329L9.214,5.35a2.392,2.392,0,0,1,3.191.176,5.43,5.43,0,0,0,7.3.3l3.764-3.185A1.5,1.5,0,1,0,21.531.355L17.768,3.54A2.411,2.411,0,0,1,14.526,3.4a5.389,5.389,0,0,0-7.186-.4L5.063,4.829A1.5,1.5,0,0,0,6,7.5Z' fill='#8c8c8c' data-original='#000000'/></g></svg>
        <span class='tsp_sidebar_item_title'>%s</span>  
      </div>
	  <div class='tsp_sidebar_item' data-tsp-item='votes_count'>
        <svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' width='24px' height='24px' viewBox='0 0 24 24' version='1.1'><g id='surface1'><path style='fill-rule:nonzero;fill:rgb(0%%,0%%,0%%);fill-opacity:1;stroke-width:11;stroke-linecap:butt;stroke-linejoin:round;stroke:rgb(54.901961%%,54.901961%%,54.901961%%);stroke-opacity:1;stroke-miterlimit:10;' d='M 140.105922 40.666132 C 147.547519 40.666132 153.678162 46.796774 153.678162 54.238371 L 153.678162 99.42776 L 212.43979 99.42776 C 219.881388 99.42776 226.01203 105.558403 226.01203 113 L 226.01203 179.935818 C 226.01203 182.442056 223.968482 184.485603 221.462245 184.485603 L 4.537755 184.485603 C 2.031518 184.485603 -0.0120299 182.442056 -0.0120299 179.935818 L -0.0120299 94.916533 C -0.0120299 87.474936 6.118612 81.344293 13.56021 81.344293 L 72.321838 81.344293 L 72.321838 54.238371 C 72.321838 46.796774 78.452481 40.666132 85.894078 40.666132 Z M 81.344293 54.238371 L 81.344293 85.894078 C 81.344293 88.361758 79.339303 90.405306 76.833066 90.405306 L 13.56021 90.405306 C 11.053972 90.405306 9.048982 92.410295 9.048982 94.916533 L 9.048982 175.424591 L 216.951018 175.424591 L 216.951018 113 C 216.951018 110.493763 214.946028 108.488773 212.43979 108.488773 L 149.166934 108.488773 C 146.660697 108.488773 144.655707 106.445225 144.655707 103.977545 L 144.655707 54.238371 C 144.655707 51.732134 142.612159 49.727144 140.105922 49.727144 L 85.894078 49.727144 C 83.387841 49.727144 81.344293 51.732134 81.344293 54.238371 Z M 117.511227 63.260826 L 117.511227 99.42776 L 110.300975 99.42776 L 110.300975 74.172598 L 103.12928 74.172598 L 103.12928 69.198681 L 103.553413 69.198681 C 105.789748 69.198681 107.948968 68.697434 109.337038 67.810611 C 110.68655 66.885231 111.689045 65.535719 112.151735 63.260826 Z M 51.115214 106.638013 C 52.927416 108.450215 53.814239 110.68655 53.814239 113.848265 C 53.814239 115.197777 53.852796 116.200272 53.390106 117.087095 C 53.390106 118.012475 52.850301 118.86074 52.387611 119.78612 C 51.963479 120.672942 51.462231 121.559765 50.575409 122.446587 L 41.090264 131.931732 C 41.090264 132.818555 40.666132 133.743935 40.666132 134.206625 L 54.238371 134.206625 L 54.238371 140.105922 L 31.643677 140.105922 C 31.643677 138.332277 31.605119 136.944207 32.067809 135.594694 L 33.494437 131.5076 C 33.918569 130.158087 34.805392 128.88569 36.154904 127.96031 C 37.041727 126.610797 38.468354 125.64686 39.817867 124.297347 L 42.941024 121.598322 L 44.791784 119.78612 C 45.254474 119.32343 45.601492 118.39805 46.064182 117.93536 C 46.488314 117.47267 46.603987 116.54729 46.603987 116.123157 L 46.603987 113.424132 C 46.603987 110.262418 45.215917 108.912905 42.941024 108.912905 C 42.054202 108.912905 41.128822 108.874348 40.666132 109.337038 L 39.278062 110.725108 C 38.815372 111.187798 38.853929 112.113178 38.853929 113 L 38.853929 115.699025 L 31.643677 115.699025 L 31.643677 114.426627 C 31.643677 110.802223 32.530499 108.450215 34.342702 106.638013 C 36.116347 104.82581 38.892487 103.977545 42.941024 103.977545 C 46.565429 103.977545 49.341569 104.82581 51.115214 106.638013 Z M 191.271723 124.297347 C 193.045368 125.64686 193.932191 127.883195 193.932191 131.5076 C 193.932191 133.782492 193.430943 135.671809 192.505563 137.021322 C 191.618741 138.370834 190.230671 139.219099 188.418468 139.681789 C 190.693361 140.144479 192.621236 141.031302 193.508058 142.380814 C 194.394881 143.730327 194.780456 146.043777 194.780456 148.318669 C 194.780456 149.668182 194.819013 150.477889 194.356323 151.827402 C 193.893633 153.215472 193.430943 154.140852 192.505563 155.528922 C 191.618741 156.415744 190.346343 157.302566 188.996831 158.189389 C 187.647318 158.652079 185.333868 159.037654 183.058976 159.037654 C 179.434571 159.037654 176.774104 158.150831 175.424591 156.377187 C 173.612389 154.564984 172.609894 151.943074 172.609894 148.318669 L 179.935818 148.318669 C 179.048996 149.668182 179.511686 150.902022 179.935818 152.251534 C 180.398508 153.176914 181.709463 154.102294 183.058976 154.102294 C 183.945798 154.102294 184.871178 154.140852 185.333868 153.678162 L 186.721938 152.251534 C 187.184628 151.827402 187.146071 151.017694 187.146071 150.555004 L 187.146071 146.043777 C 187.146071 145.156954 186.644823 144.694264 186.182133 144.231574 L 184.909736 142.804947 C 184.447046 142.342257 183.521666 142.380814 182.634843 142.380814 L 180.359951 142.380814 L 180.359951 137.445454 L 182.634843 137.445454 C 183.521666 137.445454 184.022913 137.484012 184.485603 137.021322 L 185.758001 135.594694 C 186.220691 135.132004 186.259248 134.669315 186.721938 133.782492 C 186.721938 132.857112 187.146071 132.394422 187.146071 131.5076 C 187.146071 129.695397 186.644823 128.423 186.182133 127.96031 C 185.719443 127.073487 184.832621 126.996372 183.483108 126.996372 C 182.596286 126.996372 182.095038 126.957815 181.632348 127.420505 L 180.359951 128.808575 C 179.935818 129.271265 179.935818 130.196645 179.935818 130.659335 L 179.935818 132.934227 L 173.188256 132.934227 C 173.188256 129.309822 174.036521 126.533682 175.848724 124.72148 C 177.660926 122.909277 180.321393 122.022455 183.483108 122.022455 C 186.644823 122.022455 189.459521 122.947835 191.271723 124.297347 Z M 191.271723 124.297347 ' transform='matrix(0.10131,0,0,0.10131,0.552,0.552)'/><path style=' stroke:none;fill-rule:nonzero;fill:rgb(54.901961%%,54.901961%%,54.901961%%);fill-opacity:1;' d='M 9.253906 4.671875 C 8.5 4.671875 7.878906 5.292969 7.878906 6.046875 L 7.878906 8.792969 L 1.925781 8.792969 C 1.171875 8.792969 0.550781 9.414062 0.550781 10.167969 L 0.550781 18.78125 C 0.550781 19.035156 0.757812 19.242188 1.011719 19.242188 L 22.988281 19.242188 C 23.242188 19.242188 23.449219 19.035156 23.449219 18.78125 L 23.449219 12 C 23.449219 11.246094 22.828125 10.625 22.074219 10.625 L 16.121094 10.625 L 16.121094 6.046875 C 16.121094 5.292969 15.5 4.671875 14.746094 4.671875 Z M 9.253906 5.589844 L 14.746094 5.589844 C 15 5.589844 15.207031 5.792969 15.207031 6.046875 L 15.207031 11.085938 C 15.207031 11.335938 15.410156 11.542969 15.664062 11.542969 L 22.074219 11.542969 C 22.328125 11.542969 22.53125 11.746094 22.53125 12 L 22.53125 18.324219 L 1.46875 18.324219 L 1.46875 10.167969 C 1.46875 9.914062 1.671875 9.710938 1.925781 9.710938 L 8.335938 9.710938 C 8.589844 9.710938 8.792969 9.503906 8.792969 9.253906 L 8.792969 6.046875 C 8.792969 5.792969 9 5.589844 9.253906 5.589844 Z M 11.914062 6.960938 C 11.867188 7.191406 11.765625 7.328125 11.628906 7.421875 C 11.488281 7.511719 11.269531 7.5625 11.042969 7.5625 L 11 7.5625 L 11 8.066406 L 11.726562 8.066406 L 11.726562 10.625 L 12.457031 10.625 L 12.457031 6.960938 Z M 4.902344 11.085938 C 4.492188 11.085938 4.210938 11.171875 4.03125 11.355469 C 3.847656 11.539062 3.757812 11.777344 3.757812 12.144531 L 3.757812 12.273438 L 4.488281 12.273438 L 4.488281 12 C 4.488281 11.910156 4.484375 11.816406 4.53125 11.769531 L 4.671875 11.628906 C 4.71875 11.582031 4.8125 11.585938 4.902344 11.585938 C 5.132812 11.585938 5.273438 11.722656 5.273438 12.042969 L 5.273438 12.316406 C 5.273438 12.359375 5.261719 12.453125 5.21875 12.5 C 5.171875 12.546875 5.136719 12.640625 5.089844 12.6875 L 4.902344 12.871094 L 4.585938 13.144531 C 4.449219 13.28125 4.304688 13.378906 4.214844 13.515625 C 4.078125 13.609375 3.988281 13.738281 3.945312 13.875 L 3.800781 14.289062 C 3.753906 14.425781 3.757812 14.566406 3.757812 14.746094 L 6.046875 14.746094 L 6.046875 14.148438 L 4.671875 14.148438 C 4.671875 14.101562 4.714844 14.007812 4.714844 13.917969 L 5.675781 12.957031 C 5.765625 12.867188 5.816406 12.777344 5.859375 12.6875 C 5.90625 12.59375 5.960938 12.507812 5.960938 12.414062 C 6.007812 12.324219 6.003906 12.222656 6.003906 12.085938 C 6.003906 11.765625 5.914062 11.539062 5.730469 11.355469 C 5.550781 11.171875 5.269531 11.085938 4.902344 11.085938 Z M 19.140625 12.914062 C 18.820312 12.914062 18.550781 13.003906 18.367188 13.1875 C 18.183594 13.371094 18.097656 13.652344 18.097656 14.019531 L 18.78125 14.019531 L 18.78125 13.789062 C 18.78125 13.742188 18.78125 13.648438 18.824219 13.601562 L 18.953125 13.460938 C 19 13.414062 19.050781 13.417969 19.140625 13.417969 C 19.277344 13.417969 19.367188 13.425781 19.414062 13.515625 C 19.460938 13.5625 19.511719 13.691406 19.511719 13.875 C 19.511719 13.964844 19.46875 14.011719 19.46875 14.105469 C 19.421875 14.195312 19.417969 14.242188 19.371094 14.289062 L 19.242188 14.433594 C 19.195312 14.480469 19.144531 14.476562 19.054688 14.476562 L 18.824219 14.476562 L 18.824219 14.976562 L 19.054688 14.976562 C 19.144531 14.976562 19.238281 14.972656 19.285156 15.019531 L 19.414062 15.164062 C 19.460938 15.210938 19.511719 15.257812 19.511719 15.347656 L 19.511719 15.804688 C 19.511719 15.851562 19.515625 15.933594 19.46875 15.976562 L 19.328125 16.121094 C 19.28125 16.167969 19.1875 16.164062 19.097656 16.164062 C 18.960938 16.164062 18.828125 16.070312 18.78125 15.976562 C 18.738281 15.839844 18.691406 15.714844 18.78125 15.578125 L 18.039062 15.578125 C 18.039062 15.945312 18.140625 16.210938 18.324219 16.394531 C 18.460938 16.574219 18.730469 16.664062 19.097656 16.664062 C 19.328125 16.664062 19.5625 16.625 19.699219 16.578125 C 19.835938 16.488281 19.964844 16.398438 20.054688 16.308594 C 20.148438 16.167969 20.195312 16.074219 20.242188 15.933594 C 20.289062 15.796875 20.285156 15.714844 20.285156 15.578125 C 20.285156 15.347656 20.246094 15.113281 20.15625 14.976562 C 20.066406 14.839844 19.871094 14.75 19.640625 14.703125 C 19.824219 14.65625 19.964844 14.570312 20.054688 14.433594 C 20.148438 14.296875 20.199219 14.105469 20.199219 13.875 C 20.199219 13.507812 20.109375 13.28125 19.929688 13.144531 C 19.746094 13.007812 19.460938 12.914062 19.140625 12.914062 Z M 19.140625 12.914062 '/></g></svg> 
		<span class='tsp_sidebar_item_title'>%s</span>  
	  </div>
      <a href='%s' class='tsp_sidebar_item'  target='_blank'>
        <svg  xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.com/svgjs' version='1.1' width='20' height='20' viewBox='0 0 576 512' ><path fill='#8c8c8c' d='M576 216v16c0 13.255-10.745 24-24 24h-8l-26.113 182.788C514.509 462.435 494.257 480 470.37 480H105.63c-23.887 0-44.139-17.565-47.518-41.212L32 256h-8c-13.255 0-24-10.745-24-24v-16c0-13.255 10.745-24 24-24h67.341l106.78-146.821c10.395-14.292 30.407-17.453 44.701-7.058 14.293 10.395 17.453 30.408 7.058 44.701L170.477 192h235.046L326.12 82.821c-10.395-14.292-7.234-34.306 7.059-44.701 14.291-10.395 34.306-7.235 44.701 7.058L484.659 192H552c13.255 0 24 10.745 24 24zM312 392V280c0-13.255-10.745-24-24-24s-24 10.745-24 24v112c0 13.255 10.745 24 24 24s24-10.745 24-24zm112 0V280c0-13.255-10.745-24-24-24s-24 10.745-24 24v112c0 13.255 10.745 24 24 24s24-10.745 24-24zm-224 0V280c0-13.255-10.745-24-24-24s-24 10.745-24 24v112c0 13.255 10.745 24 24 24s24-10.745 24-24z'></path></svg>      
        <span class='tsp_sidebar_item_title'>%s</span>  
      </a>
      <a href='%s' class='tsp_sidebar_item' data-tsp-item='contactus' target='_blank'>
        <svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' width='30px' height='30px' viewBox='0 0 30 30' version='1.1'><g id='surface1'><path style='fill-rule:nonzero;fill:#8c8c8c;fill-opacity:1;stroke-width:1;stroke-linecap:butt;stroke-linejoin:miter;stroke:#8c8c8c;stroke-opacity:1;stroke-miterlimit:4;' d='M 18 3.375 C 15.7 3.375 13.76875 4.975 13.2625 7.125 L 3 7.125 C 1.965625 7.125 1.125 7.965625 1.125 9 L 1.125 18.75 C 1.125 19.784375 1.965625 20.625 3 20.625 L 16.5 20.625 C 17.534375 20.625 18.375 19.784375 18.375 18.75 L 18.375 13.125 L 19.125 13.125 L 19.125 12.375 L 18 12.375 C 15.725 12.375 13.875 10.525 13.875 8.25 C 13.875 5.975 15.725 4.125 18 4.125 C 20.275 4.125 22.125 5.975 22.125 8.25 L 22.125 9.375 C 22.125 9.7875 21.7875 10.125 21.375 10.125 C 20.9625 10.125 20.625 9.7875 20.625 9.375 L 20.625 8.25 C 20.625 6.80625 19.44375 5.625 18 5.625 C 16.55625 5.625 15.375 6.80625 15.375 8.25 C 15.375 9.69375 16.55625 10.875 18 10.875 C 18.796875 10.875 19.5125 10.51875 19.99375 9.95625 C 20.21875 10.49375 20.753125 10.875 21.375 10.875 C 22.203125 10.875 22.875 10.203125 22.875 9.375 L 22.875 8.25 C 22.875 5.5625 20.6875 3.375 18 3.375 Z M 1.875 9.0375 L 6.40625 12.75 L 1.875 16.4625 Z M 17.625 18.75 C 17.625 19.371875 17.121875 19.875 16.5 19.875 L 3 19.875 C 2.378125 19.875 1.875 19.371875 1.875 18.75 L 1.875 17.425 L 7 13.234375 L 8.5625 14.5125 C 8.90625 14.79375 9.328125 14.934375 9.75 14.934375 C 10.171875 14.934375 10.59375 14.79375 10.9375 14.5125 L 12.5 13.234375 L 17.625 17.425 Z M 17.625 13.10625 L 17.625 16.45625 L 13.09375 12.75 L 14.45 11.578125 C 15.25625 12.440625 16.375 13.0125 17.625 13.10625 Z M 13.971875 10.99375 L 10.4625 13.934375 C 10.05 14.26875 9.45 14.26875 9.034375 13.934375 L 2.1375 8.284375 C 2.34375 8.0375 2.653125 7.875 3 7.875 L 13.14375 7.875 C 13.13125 8 13.125 8.125 13.125 8.25 C 13.125 9.265625 13.4375 10.2125 13.971875 10.99375 Z M 18 10.125 C 16.965625 10.125 16.125 9.284375 16.125 8.25 C 16.125 7.215625 16.965625 6.375 18 6.375 C 19.034375 6.375 19.875 7.215625 19.875 8.25 C 19.875 9.284375 19.034375 10.125 18 10.125 Z M 18 10.125 ' transform='matrix(1.25,0,0,1.25,0,0)'/></g></svg>
        <span class='tsp_sidebar_item_title'>%s</span>  
      </a>
    </aside>
    <main id='tsp_builder_main' class='tsp_flex_col'>
      <header id='tsp_builder_head' class='tsp_flex_item'> 
        <div id='tsp_switch_sidebar' class='tsp_switch_sidebar tsp_flex_col'>
          <div id='tsp-toggle-btn'>
            <span class='bar-top'></span>
            <span class='bar-mid'></span>
            <span class='bar-bot'></span>
          </div>
        </div>     
        <div class='tsp_buttons tsp_flex_row'>
          %s
          <a href='%s' class='tsp_support tsp_flex_item'  target='_blank' title='TS Poll support forum'>
            <div class='tsp_support-inner'>
              <div class='tsp_support-icon'>
                <i class='ts-poll ts-poll-fw ts-poll-comments'></i>
              </div>
              <div>%s</div>
            </div>
          </a>
          %s
        </div>
        <div class='tsp_back_wp tsp_flex_col'>
          <a href='%s' id='TS_Poll_Back_Manager' class='tsp_flex_col' title='Back to Manager'>
            <i class='ts-poll ts-poll-times'></i>
          </a>
        </div>
      </header>
      <section id='tsp_builder_content'>
        %s
        %s
      </section>
    </main>
  </section>
  ",
	'new' === $this->tsp_build ? esc_attr( 'false' ) : '',
	esc_url( plugin_dir_url( __FILE__ ) . 'img/ts_poll_logo.png' ),
	'new' === $this->tsp_build ? esc_attr( 'tsp_active' ) : '',
	esc_attr__( 'Theme', 'tspoll' ),
	'edit' === $this->tsp_build ? esc_attr( 'tsp_active' ) : '',
	esc_attr__( 'Fields', 'tspoll' ),
	esc_attr__( 'Styles', 'tspoll' ),
	esc_attr__( 'Settings', 'tspoll' ),
	esc_attr__( 'Shortcode', 'tspoll' ),
	esc_attr__( 'Statistics', 'tspoll' ),
	esc_attr__( 'Votes count', 'tspoll' ),
	esc_url( 'https://total-soft.com/wp-poll/' ),
	esc_attr__( 'Go pro', 'tspoll' ),
	esc_url( 'https://total-soft.com/contact-us/' ),
	esc_attr__( 'Contact Us', 'tspoll' ),
	'new' === $this->tsp_build ? '' : sprintf(
		"
    		<span id='tsp_question_title_e'>
    		  %s
    		</span>
    	",
		esc_html( html_entity_decode( htmlspecialchars_decode( $this->tsp_build_proporties['Question_Title'] ), ENT_QUOTES ) )
	),
	esc_url( 'https://wordpress.org/support/plugin/poll-wp/' ),
	esc_attr__( 'Support Forum', 'tspoll' ),
	'new' === $this->tsp_build ? '' : sprintf(
		'
    <div class="tsp_save_btn tsp_flex_item">
      <div class="tsp_save_btn-inner">
        <div class="tsp_save_btn-icon">
          <i class="ts-poll ts-poll-folder-open ts-poll-fw"></i>
        </div>
        <div>%s</div>
      </div>
    </div>',
		isset( $_GET['tsp-theme'] ) ? esc_html__( 'Save', 'tspoll' ) : esc_html__( 'Update', 'tspoll' )
	),
	esc_url( admin_url( 'admin.php?page=ts-poll' ) ),
	$tsp_content_builder,
	$tsp_icon_picker_html
);
?>
