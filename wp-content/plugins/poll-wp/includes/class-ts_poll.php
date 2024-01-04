<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       TS Poll
 * @since      1.7.0
 *
 * @package    TS_Poll
 * @subpackage TS_Poll/includes
 */
/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.7.0
 * @package    TS_Poll
 * @subpackage TS_Poll/includes
 * @author     TS Poll <TS Poll>
 */
class TS_Poll {
	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.7.0
	 * @access   protected
	 * @var      ts_poll_loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;
	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.7.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;
	/**
	 * The current version of the plugin.
	 *
	 * @since    1.7.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;
	/**
	 * The question proporty query result.
	 *
	 * @since    1.7.0
	 * @access   protected
	 * @var      string    $version    The question proporty query result.
	 */
	public $ts_poll_question_query;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.7.0
	 */

	public $ts_poll_fonts_array;

	public function __construct() {
		if ( defined( 'TS_POLL_VERSION' ) ) {
			$this->version = TS_POLL_VERSION;
		} else {
			$this->version = '1.8.9';
		}
		$this->plugin_name = 'TS Poll';
		$this->load_dependencies();
		new ts_poll_function();
		add_action( 'plugins_loaded', array( $this, 'tspoll_text_domain' ) );
		add_shortcode( 'Total_Soft_Poll', array( $this, 'ts_poll_shortcode' ) );
		add_shortcode( 'TS_Poll', array( $this, 'ts_poll_shortcode' ) );
		add_action( 'wp_ajax_tsp_vote_function', array( $this, 'tsp_vote_function' ) );
		add_action( 'wp_ajax_nopriv_tsp_vote_function', array( $this, 'tsp_vote_function' ) );
		add_filter( 'ts_poll_check_coming', array( $this, 'ts_poll_coming' ) );
		add_filter( 'ts_poll_check_end', array( $this, 'ts_poll_end' ) );
		$this->update_plugin();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		new ts_poll_gutenberg_block();
	}


	public function tspoll_text_domain() {
		load_plugin_textdomain( 'tspoll', false, TS_POLL_PLUGIN_DIR . '/languages/' );
	}

	public function tsp_vote_function() {
		$tsp_question_id = filter_var( sanitize_text_field( $_POST['tsp_id'] ), FILTER_VALIDATE_INT );
		$tsp_changed_id  = filter_var( sanitize_text_field( $_POST['tsp_change_id'] ), FILTER_VALIDATE_INT );
		if ( ! isset( $_POST['tsp_vote_nonce'] ) || $_POST['tsp_vote_nonce'] == '' || ! wp_verify_nonce( $_POST['tsp_vote_nonce'], 'tsp_vote_nonce_' . $tsp_changed_id ) ) {
			wp_send_json_error( 'Invalid nonce' );
		}
		global $wpdb;
		$tsp_checkeds = sanitize_text_field( $_POST['tsp_checkeds'] );
		$tsp_checkeds = explode( '|', $tsp_checkeds );
		if ( is_int( $tsp_question_id ) && $tsp_question_id > 0 && is_array( $tsp_checkeds ) && count( $tsp_checkeds ) > 0 ) {
			$tsp_voted_question = $wpdb->get_row( $wpdb->prepare( 'SELECT * FROM ' . esc_sql( $wpdb->prefix . 'ts_poll_questions' ) . ' WHERE id = %d', $tsp_question_id ), ARRAY_A );
			if ( ! empty( $tsp_voted_question ) ) {
				$tsp_voted_question_settings = json_decode( $tsp_voted_question['Question_Settings'], true );
				$tsp_voted_question_style    = json_decode( $tsp_voted_question['Question_Style'], true );
				$tsp_voted_question_params   = json_decode( $tsp_voted_question['Question_Param'], true );
				if ( apply_filters( 'ts_poll_check_coming', $tsp_voted_question_settings['TotalSoft_Poll_Set_02'] ) === false && apply_filters( 'ts_poll_check_end', $tsp_voted_question_settings['TotalSoft_Poll_Set_03'] ) === false ) {
					$tsp_question_answers = $wpdb->get_results( $wpdb->prepare( 'SELECT * FROM ' . esc_sql( $wpdb->prefix . 'ts_poll_answers' ) . ' WHERE Question_id = %d', $tsp_question_id ), ARRAY_A );
					if ( ! empty( $tsp_question_answers ) ) {
						if ( count( $tsp_checkeds ) > 1 && array_key_exists( 'ts_poll_ch_cm', $tsp_voted_question_style ) && $tsp_voted_question_style['ts_poll_ch_cm'] == 'true' || count( $tsp_checkeds ) == 1 ) {
							$tsp_question_answers_ = array_column( $tsp_question_answers, 'Answer_Votes', 'id' );
							foreach ( $tsp_checkeds as $answer_key => $answer_value ) {
								if ( array_key_exists( (int) $answer_value, $tsp_question_answers_ ) ) {
									$wpdb->update( esc_sql( $wpdb->prefix . 'ts_poll_answers' ), array( 'Answer_Votes' => (int) $tsp_question_answers_[ $answer_value ] + 1 ), array( 'id' => (int) $answer_value ), array( '%d' ), array( '%d' ) );
									$tsp_question_answers_[ (int) $answer_value ] = (int) $tsp_question_answers_[ (int) $answer_value ] + 1;
								}
							}

							$str = "[TS_Poll id='". $tsp_question_id ."']";
							$str2 = '[TS_Poll id="'. $tsp_question_id .'"]';
							$str3 = "[Total_Soft_Poll id='". $tsp_question_id ."']";
							$str4 = '[Total_Soft_Poll id="'. $tsp_question_id .'"]';

							$tsp_query_args_wp = array(
								's'=> $str,'posts_per_page' => -1,'post_status' => 'publish'
							);
							$tsp_query_args_wp_two = array(
								's'=> $str2,'posts_per_page' => -1,'post_status' => 'publish'
							);
							$tsp_query_args_wp_three = array(
								's'=> $str3,'posts_per_page' => -1,'post_status' => 'publish'
							);
							$tsp_query_args_wp_four = array(
								's'=> $str4,'posts_per_page' => -1,'post_status' => 'publish'
							);
							$query = new WP_Query( $tsp_query_args_wp );
							if ($query->have_posts()){
							  while ( $query->have_posts() ) {
								$query->the_post();
								$my_post = array(
									'ID'            => get_the_ID(),
									'post_title'   => get_the_title()
								);
								wp_update_post( $my_post );
							  } 
							}
							$query2 = new WP_Query( $tsp_query_args_wp_two );
							if ($query2->have_posts()){
								while ( $query2->have_posts() ) {
								  $query2->the_post();
								  $my_post2 = array(
									  'ID'            => get_the_ID(),
									  'post_title'   => get_the_title()
								  );
								  wp_update_post( $my_post2 );
								} 
							}
							$query3 = new WP_Query( $tsp_query_args_wp_three );
							if ($query3->have_posts()){
								while ( $query3->have_posts() ) {
								  $query3->the_post();
								  $my_post3 = array(
									  'ID'            => get_the_ID(),
									  'post_title'   => get_the_title()
								  );
								  wp_update_post( $my_post3 );
								} 
							}
							$query4 = new WP_Query( $tsp_query_args_wp_four );
							if ($query4->have_posts()){
								while ( $query4->have_posts() ) {
								  $query4->the_post();
								  $my_post4 = array(
									  'ID'            => get_the_ID(),
									  'post_title'   => get_the_title()
								  );
								  wp_update_post( $my_post4 );
								} 
							}

							if ( $tsp_voted_question_settings['TotalSoft_Poll_Set_01'] == 'true' ) {
								$tsp_votes_total    = array_sum( $tsp_question_answers_ );
								$tsp_response_array = array();
								foreach ( $tsp_question_answers_ as $tsp_response_key => $tsp_response_value ) {
									$tsp_response_array[ (string) $tsp_response_key ] = array(
										'tsp_result_show' => $this->ts_poll_show_type(
											array(
												'tsp_show_results' => $tsp_voted_question_settings['TotalSoft_Poll_Set_01'],
												'tsp_no_result_text' => $tsp_voted_question_settings['TotalSoft_Poll_Set_05'],
												'tsp_show_by' => array_key_exists( 'ts_poll_p_a_vt', $tsp_voted_question_style ) ? $tsp_voted_question_style['ts_poll_p_a_vt'] : $tsp_voted_question_style['ts_poll_v_t'],
												'tsp_total_votes' => $tsp_votes_total,
												'tsp_answer_votes' => $tsp_response_value,
											)
										),
										'tsp_result_percent' => round( $tsp_response_value * 100 / $tsp_votes_total, 2 ),
									);
								}
								wp_send_json_success( $tsp_response_array );
							} else {
								wp_send_json_success();
							}

						}
					}
				}
			}
		}
		wp_send_json_error();
	}

	private function update_plugin() {
		global $wpdb;
		$tsp_answers_table           = esc_sql( $wpdb->prefix . 'ts_poll_answers' );
		$tsp_questions_table         = esc_sql( $wpdb->prefix . 'ts_poll_questions' );
		$tsp_answers_table_check     = $wpdb->get_results( $wpdb->prepare( 'SELECT  table_name FROM information_schema.TABLES WHERE TABLE_SCHEMA = %s AND TABLE_NAME = %s', esc_sql( $wpdb->dbname ), $tsp_answers_table ) );
		$tsp_questions_table_check   = $wpdb->get_results( $wpdb->prepare( 'SELECT  table_name FROM information_schema.TABLES WHERE TABLE_SCHEMA = %s AND TABLE_NAME = %s', esc_sql( $wpdb->dbname ), $tsp_questions_table ) );
		if ( empty( $tsp_answers_table_check ) || empty( $tsp_questions_table_check ) ) {
			$tsp_questions_table_create = 'CREATE TABLE IF NOT EXISTS ' . $tsp_questions_table . '( id INTEGER(10) UNSIGNED AUTO_INCREMENT, Question_Title VARCHAR(155) DEFAULT "", Question_Param longtext NOT NULL, Question_Style longtext NOT NULL, Question_Settings longtext NOT NULL,Answers_Sort longtext NOT NULL,created_at VARCHAR(50) NOT NULL,updated_at VARCHAR(50) NOT NULL, PRIMARY KEY (id))';
			$tsp_answers_table_create   = 'CREATE TABLE IF NOT EXISTS ' . $tsp_answers_table . '( id INTEGER(10) UNSIGNED AUTO_INCREMENT,Question_id int(11) NOT NULL, Answer_Title VARCHAR(255) NOT NULL, Answer_Param longtext NOT NULL, Answer_Votes int(11) NOT NULL, PRIMARY KEY (id))';
			require_once ABSPATH . 'wp-admin/includes/upgrade.php';
			dbDelta( $tsp_questions_table_create );
			dbDelta( $tsp_answers_table_create );
			$tsp_questions_table_convert = 'ALTER TABLE ' . $tsp_questions_table . ' CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci';
			$tsp_answers_table_convert   = 'ALTER TABLE ' . $tsp_answers_table . ' CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci';
			$wpdb->query( $tsp_questions_table_convert );
			$wpdb->query( $tsp_answers_table_convert );
			$tsp_old_table_check = $wpdb->get_results( $wpdb->prepare( 'SELECT  table_name FROM information_schema.TABLES WHERE TABLE_SCHEMA = %s AND TABLE_NAME = %s', esc_sql( $wpdb->dbname ), esc_sql( $wpdb->prefix . 'totalsoft_poll_manager' ) ) );
			if ( ! empty( $tsp_old_table_check ) ) {
				$tsp_sql               = 'SELECT * FROM ' . esc_sql( $wpdb->prefix . 'totalsoft_poll_manager' );
				$ts_poll_all_questions = $wpdb->get_results( $tsp_sql, ARRAY_A );

				if ( ! empty( $ts_poll_all_questions ) ) {

					for ( $i = 0; $i < count( $ts_poll_all_questions ); $i++ ) {
						$tsp_old_question = $tsp_old_question_params = $tsp_old_question_styles = $tsp_old_question_settings = $tsp_old_question_answers_sort = array();
						$tsp_old_question = array(
							'id'                    => $ts_poll_all_questions[ $i ]['id'],
							'Question_Title'        => $ts_poll_all_questions[ $i ]['TotalSoftPoll_Question'],
							'tsp_question_theme_id' => $ts_poll_all_questions[ $i ]['TotalSoftPoll_Theme'],
							'tsp_answers_count'     => $ts_poll_all_questions[ $i ]['TotalSoftPoll_Ans_C'],
						);
						$tsp_get_params   = $wpdb->get_row( $wpdb->prepare( 'SELECT * FROM ' . esc_sql( $wpdb->prefix . 'totalsoft_poll_quest_im' ) . ' WHERE Question_ID = %d', (int) $tsp_old_question['id'] ), ARRAY_A );
						if ( ! empty( $tsp_get_params ) ) {
							$tsp_old_question_params['TotalSoftPoll_Q_Vd'] = $tsp_get_params['TotalSoftPoll_Q_Vd'];
							$tsp_old_question_params['TotalSoftPoll_Q_Im'] = $tsp_get_params['TotalSoftPoll_Q_Im'];
						} else {
							$tsp_old_question_params['TotalSoftPoll_Q_Vd'] = '';
							$tsp_old_question_params['TotalSoftPoll_Q_Im'] = '';
							$tsp_get_params['TotalSoftPoll_Q_01']          = '';
						}

						if ( $tsp_get_params['TotalSoftPoll_Q_01'] != '' ) {
							$tsp_get_settings = $wpdb->get_row( $wpdb->prepare( 'SELECT * FROM ' . esc_sql( $wpdb->prefix . 'totalsoft_poll_setting' ) . ' WHERE id = %d', (int) $tsp_get_params['TotalSoftPoll_Q_01'] ), ARRAY_A );
							if ( ! empty( $tsp_get_settings ) ) {
								$tsp_old_question_settings = array(
									'TotalSoft_Poll_Set_01' => $tsp_get_settings['TotalSoft_Poll_Set_01'],
									'TotalSoft_Poll_Set_02' => $tsp_get_settings['TotalSoft_Poll_Set_02'],
									'TotalSoft_Poll_Set_03' => $tsp_get_settings['TotalSoft_Poll_Set_03'],
									'TotalSoft_Poll_Set_04' => $tsp_get_settings['TotalSoft_Poll_Set_04'],
									'TotalSoft_Poll_Set_05' => $tsp_get_settings['TotalSoft_Poll_Set_05'],
									'TotalSoft_Poll_Set_06' => $tsp_get_settings['TotalSoft_Poll_Set_06'],
									'TotalSoft_Poll_Set_07' => $tsp_get_settings['TotalSoft_Poll_Set_07'],
									'TotalSoft_Poll_Set_08' => $tsp_get_settings['TotalSoft_Poll_Set_08'],
									'TotalSoft_Poll_Set_09' => $tsp_get_settings['TotalSoft_Poll_Set_09'],
									'TotalSoft_Poll_Set_10' => $tsp_get_settings['TotalSoft_Poll_Set_10'],
									'TotalSoft_Poll_Set_11' => $tsp_get_settings['TotalSoft_Poll_Set_11'],
								);
							} else {
								$tsp_old_question_settings = array(
									'TotalSoft_Poll_Set_01' => 'true',
									'TotalSoft_Poll_Set_02' => '',
									'TotalSoft_Poll_Set_03' => '',
									'TotalSoft_Poll_Set_04' => 'Coming Soon',
									'TotalSoft_Poll_Set_05' => 'Thank You !',
									'TotalSoft_Poll_Set_06' => 'rgba(209,209,209,0.79)',
									'TotalSoft_Poll_Set_07' => '#000000',
									'TotalSoft_Poll_Set_08' => '32',
									'TotalSoft_Poll_Set_09' => 'Gabriola',
									'TotalSoft_Poll_Set_10' => 'false',
									'TotalSoft_Poll_Set_11' => 'ipaddress',
								);
							}
						} else {
							$tsp_old_question_settings = array(
								'TotalSoft_Poll_Set_01' => 'true',
								'TotalSoft_Poll_Set_02' => '',
								'TotalSoft_Poll_Set_03' => '',
								'TotalSoft_Poll_Set_04' => 'Coming Soon',
								'TotalSoft_Poll_Set_05' => 'Thank You !',
								'TotalSoft_Poll_Set_06' => 'rgba(209,209,209,0.79)',
								'TotalSoft_Poll_Set_07' => '#000000',
								'TotalSoft_Poll_Set_08' => '32',
								'TotalSoft_Poll_Set_09' => 'Gabriola',
								'TotalSoft_Poll_Set_10' => 'false',
								'TotalSoft_Poll_Set_11' => 'ipaddress',
							);
						}
						$tsp_get_theme_type = $wpdb->get_row( $wpdb->prepare( 'SELECT * FROM ' . esc_sql( $wpdb->prefix . 'totalsoft_poll_dbt' ) . ' WHERE id = %d', (int) $tsp_old_question['tsp_question_theme_id'] ), ARRAY_A );
						if ( ! empty( $tsp_get_theme_type ) ) {
							$tsp_themes_tables                          = array(
								'Standart Poll'           => array( 'totalsoft_poll_stpoll', 'totalsoft_poll_stpoll_1', 'totalsoft_poll_1' ),
								'Standard Poll'           => array( 'totalsoft_poll_stpoll', 'totalsoft_poll_stpoll_1', 'totalsoft_poll_1' ),
								'Image Poll'              => array( 'totalsoft_poll_impoll', 'totalsoft_poll_impoll_1', 'totalsoft_poll_2' ),
								'Video Poll'              => array( 'totalsoft_poll_impoll', 'totalsoft_poll_impoll_1', 'totalsoft_poll_2' ),
								'Standard Without Button' => array( 'totalsoft_poll_stwibu', 'totalsoft_poll_stwibu_1', 'totalsoft_poll_3' ),
								'Standart Without Button' => array( 'totalsoft_poll_stwibu', 'totalsoft_poll_stwibu_1', 'totalsoft_poll_3' ),
								'Image Without Button'    => array( 'totalsoft_poll_imwibu', 'totalsoft_poll_imwibu_1', 'totalsoft_poll_4' ),
								'Video Without Button'    => array( 'totalsoft_poll_imwibu', 'totalsoft_poll_imwibu_1', 'totalsoft_poll_4' ),
								'Image in Question'       => array( 'totalsoft_poll_iminqu', 'totalsoft_poll_iminqu_1', 'totalsoft_poll_5' ),
								'Video in Question'       => array( 'totalsoft_poll_iminqu', 'totalsoft_poll_iminqu_1', 'totalsoft_poll_5' ),
							);
							$tsp_old_question_params['TS_Poll_Q_Theme'] = $tsp_get_theme_type['TotalSoft_Poll_TType'];
							$tsp_theme_style_select                     = $wpdb->get_row( $wpdb->prepare( 'SELECT * FROM ' . esc_sql( $wpdb->prefix . $tsp_themes_tables[ $tsp_get_theme_type['TotalSoft_Poll_TType'] ][0] ) . ' WHERE TotalSoft_Poll_TID = %d', (int) $tsp_old_question['tsp_question_theme_id'] ), ARRAY_A );
							$tsp_theme_style_select_part                = $wpdb->get_row( $wpdb->prepare( 'SELECT * FROM ' . esc_sql( $wpdb->prefix . $tsp_themes_tables[ $tsp_get_theme_type['TotalSoft_Poll_TType'] ][1] ) . ' WHERE TotalSoft_Poll_TID = %d', (int) $tsp_old_question['tsp_question_theme_id'] ), ARRAY_A );

							if ( empty( $tsp_theme_style_select ) || empty( $tsp_theme_style_select_part ) ) {
								$tsp_theme_key           = str_replace( ' ', '-', strtolower( $tsp_get_theme_type['TotalSoft_Poll_TType'] ) );
								$tsp_old_question_styles = apply_filters("tsp_get_theme_params", $tsp_theme_key);
							} else {
								$tsp_theme_select = array_merge( $tsp_theme_style_select, $tsp_theme_style_select_part );
								$tsp_remove_props = array( 'id', 'TotalSoft_Poll_TID', 'TotalSoft_Poll_TTitle', 'TotalSoft_Poll_TType' );
								$tsp_theme_select = array_diff_key( $tsp_theme_select, array_flip( $tsp_remove_props ) );
								$tsp_remove_new   = array();
								if ( $tsp_get_theme_type['TotalSoft_Poll_TType'] == 'Image in Question' || $tsp_get_theme_type['TotalSoft_Poll_TType'] == 'Image Without Button' ) {
									if ( $tsp_get_theme_type['TotalSoft_Poll_TType'] == 'Image in Question' && array_key_exists( 'TotalSoft_Poll_5_I_H', $tsp_theme_select ) ) {
										$tsp_theme_select['TotalSoft_Poll_5_I_H'] = floor( (int) $tsp_theme_select['TotalSoft_Poll_5_I_H'] / 5.5 );
									} elseif ( $tsp_get_theme_type['TotalSoft_Poll_TType'] == 'Image Without Button' && array_key_exists( 'TotalSoft_Poll_4_I_H', $tsp_theme_select ) ) {
										$tsp_theme_select['TotalSoft_Poll_4_I_H'] = floor( (int) $tsp_theme_select['TotalSoft_Poll_4_I_H'] / 4 );
									}
								}
								foreach ( $tsp_theme_select as $key => $value ) {
									$newkey                      = str_replace( $tsp_themes_tables[ $tsp_get_theme_type['TotalSoft_Poll_TType'] ][2], 'ts_poll', strtolower( $key ) );
									$tsp_remove_new[]            = $key;
									$tsp_theme_select[ $newkey ] = $value;
								}
								$tsp_old_question_styles = array_diff_key( $tsp_theme_select, array_flip( $tsp_remove_new ) );
							}
						} else {
							$tsp_old_question_params['TS_Poll_Q_Theme'] = 'Standard Poll';
							$tsp_old_question_styles = apply_filters("tsp_get_theme_params", 'standard-poll');
						}
						$tsp_get_question_answers = $wpdb->get_results( $wpdb->prepare( 'SELECT * FROM ' . esc_sql( $wpdb->prefix . 'totalsoft_poll_answers' ) . ' WHERE Question_ID = %d', (int) $tsp_old_question['id'] ), ARRAY_A );
						if ( empty( $tsp_get_question_answers ) ) {
							continue;
						} else {
							$tsp_get_results = $wpdb->get_results( $wpdb->prepare( 'SELECT `Poll_A_Votes`,`Poll_A_ID` FROM ' . esc_sql( $wpdb->prefix . 'totalsoft_poll_results' ) . ' WHERE Poll_ID = %d', (int) $tsp_old_question['id'] ), ARRAY_A );
							$tsp_get_results = array_column( $tsp_get_results, 'Poll_A_Votes', 'Poll_A_ID' );
							for ( $a = 0; $a < count( $tsp_get_question_answers ); $a++ ) {
								$tsp_answer_param = array(
									'TotalSoftPoll_Ans_Im' => $tsp_get_question_answers[ $a ]['TotalSoftPoll_Ans_Im'],
									'TotalSoftPoll_Ans_Vd' => $tsp_get_question_answers[ $a ]['TotalSoftPoll_Ans_Vd'],
									'TotalSoftPoll_Ans_Cl' => $tsp_get_question_answers[ $a ]['TotalSoftPoll_Ans_Cl'],
								);
								$wpdb->insert(
									$tsp_answers_table,
									array(
										'id'           => '',
										'Question_id'  => (int) $tsp_old_question['id'],
										'Answer_Title' => $tsp_get_question_answers[ $a ]['TotalSoftPoll_Ans'],
										'Answer_Param' => json_encode( $tsp_answer_param ),
										'Answer_Votes' => (int) $tsp_get_results[ $tsp_get_question_answers[ $a ]['id'] ],
									),
									array( '%d', '%d', '%s', '%s', '%d' )
								);
								$tsp_old_question_answers_sort[] = $wpdb->insert_id;
							}
						}
						$wpdb->insert(
							$tsp_questions_table,
							array(
								'id'                => (int) $tsp_old_question['id'],
								'Question_Title'    => $tsp_old_question['Question_Title'],
								'Question_Param'    => json_encode( $tsp_old_question_params ),
								'Question_Style'    => json_encode( $tsp_old_question_styles ),
								'Question_Settings' => json_encode( $tsp_old_question_settings ),
								'Answers_Sort'      => implode( ',', $tsp_old_question_answers_sort ),
								'created_at'        => date( 'd.m.Y h:i:sa' ),
								'updated_at'        => date( 'd.m.Y h:i:sa' ),
							),
							array( '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s' )
						);
					}
				}
			}
		}
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - ts_poll_loader. Orchestrates the hooks of the plugin.
	 * - ts_poll_admin. Defines all hooks for the admin area.
	 * - ts_poll_public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.7.0
	 * @access   private
	 */


	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-ts_poll-loader.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-ts_poll-function.php';


		/**
		 * The class responsible for defining all actions that occur in the admin dashboard area.
		*/
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-ts_poll_dashboard.php';


		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-ts_poll-admin.php';
		/**
		* The class responsible for defining all actions that occur in the admin area.
		*/
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-ts_poll_list.php';
		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		/**
		* The class responsible for defining all actions that occur in the admin area.
		*/
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-ts_poll_block.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-ts_poll-widget.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-ts_poll-public.php';
		$this->loader = new ts_poll_loader();
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.7.0
	 * @access   private
	 */
	private function define_admin_hooks() {
		$plugin_admin = new ts_poll_admin( $this->get_plugin_name(), $this->get_version() );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'ts_poll_admin_menu', 9 );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'ts_poll_admin_sub', 90 );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'ts_poll_builder_sub', 100 );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'ts_poll_pro_sub', 110 );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'ts_poll_addons_sub', 120 );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.7.0
	 * @access   private
	 */
	private function define_public_hooks() {
		function ts_poll_register_widget() {
			register_widget( 'ts_poll_widget' );
		}
		$plugin_public = new ts_poll_public( $this->get_plugin_name(), $this->get_version() );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		add_action( 'widgets_init', 'ts_poll_register_widget' );
	}

	public function ts_poll_coming( $ts_poll_check_date ) {
		if ( strpos( $ts_poll_check_date, '-' ) !== false ) {
			list($ts_poll_cs_year,$ts_poll_cs_month,$ts_poll_cs_day) = explode( '-', $ts_poll_check_date );
			if ( (int) date( 'Y' ) < (int) $ts_poll_cs_year ) {
				return true;
			} elseif ( (int) date( 'Y' ) == (int) $ts_poll_cs_year ) {
				if ( (int) date( 'm' ) < (int) $ts_poll_cs_month ) {
					return true;
				} elseif ( (int) date( 'm' ) == (int) $ts_poll_cs_month ) {
					if ( (int) date( 'd' ) < (int) $ts_poll_cs_day ) {
						return true;
					}
				}
			}
		}
		return false;
	}

	public function ts_poll_end( $ts_poll_check_end_date ) {
		if ( strpos( $ts_poll_check_end_date, '-' ) !== false ) {
			list($ts_poll_end_year,$ts_poll_end_month,$ts_poll_end_day) = explode( '-', $ts_poll_check_end_date );
			if ( (int) date( 'Y' ) > (int) $ts_poll_end_year ) {
				return true;
			} elseif ( (int) date( 'Y' ) == (int) $ts_poll_end_year ) {
				if ( (int) date( 'm' ) > (int) $ts_poll_end_month ) {
					return true;
				} elseif ( (int) date( 'm' ) == (int) $ts_poll_end_month ) {
					if ( (int) date( 'd' ) > (int) $ts_poll_end_day ) {
						return true;
					}
				}
			}
		}
		return false;
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.7.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.7.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.7.0
	 * @return    ts_poll_loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Primary function to render a poll on the frontend.
	 *
	 * @since 1.7.0
	 *
	 * @param int $id Poll ID.
	 */
	private function ts_poll_content( $total_soft_poll, $ts_poll_edit ) {

		$tsp_themes = array(
			'standart-poll'           => 'Standart Poll',
			'standard-poll'           => 'Standard Poll',
			'image-poll'              => 'Image Poll',
			'video-poll'              => 'Video Poll',
			'standart-without-button' => 'Standart Without Button',
			'standard-without-button' => 'Standard Without Button',
			'image-without-button'    => 'Image Without Button',
			'video-without-button'    => 'Video Without Button',
			'image-in-question'       => 'Image in Question',
			'video-in-question'       => 'Video in Question',
		);
		global $wpdb;
		$ts_poll_question_table     = esc_url( $wpdb->prefix . 'ts_poll_questions' );
		$ts_poll_answers_table      = esc_url( $wpdb->prefix . 'ts_poll_answers' );
		$ts_poll_coming_soon_bool   = $ts_poll_endpoll_bool = $ts_poll_time_bool = $ts_poll_vote_bool = $ts_poll_can_vote = false;
		$t_s_poll_answers_values    = $ts_poll_answers_query = $ts_poll_answers_count = $tspoll_question_styles = $ts_poll_question_params = $t_s_poll_question_settings =  $ts_poll_old_standard = '';
		$total_soft_poll_res_count  = 1;
		$total_soft_poll_res_count1 = 0;
		$ts_poll_answers_columned   = $ts_poll_answers_order = $ts_poll_question_query = $TS_Poll_Colors_Array = array();
		if ( $ts_poll_edit != 'true' ) {
			wp_enqueue_script( $this->plugin_name . 'ResizeSensor', plugin_dir_url( __DIR__ ) . 'public/js/ResizeSensor.js', array(), time(), false );
			wp_enqueue_script( $this->plugin_name . 'ElementQueries', plugin_dir_url( __DIR__ ) . 'public/js/ElementQueries.js', array(), time(), false );
		}
		if ( is_numeric( $total_soft_poll ) && is_int( (int) $total_soft_poll ) && (int) $total_soft_poll > 0 || array_key_exists( $total_soft_poll, $tsp_themes ) ) {
			if ( is_numeric( $total_soft_poll ) && is_int( (int) $total_soft_poll ) && (int) $total_soft_poll > 0 ) {
				$ts_poll_question_query = apply_filters( "tsp_get_all_params", (string) $total_soft_poll, true, true);
			} elseif ( array_key_exists( $total_soft_poll, $tsp_themes ) ) {
				if ( $ts_poll_edit !== 'true' ) { return false; }
				$ts_poll_question_query = apply_filters( "tsp_get_all_params", (string) $total_soft_poll, false, true);
			} else {
				return false;
			}
			if ($ts_poll_question_query === false) { return false; }
			$t_s_poll_answers_values = $ts_poll_question_query['Answers'];
			$ts_poll_answers_count      = $ts_poll_question_query['answers_count'];
			$tspoll_question_styles     = $ts_poll_question_query['Question_Style'];
			$ts_poll_question_params    = $ts_poll_question_query['Question_Param'];
			$t_s_poll_question_settings = $ts_poll_question_query['Question_Settings'];
			$total_soft_poll_res_count = array_sum( array_column(  $t_s_poll_answers_values , 'Answer_Votes' ) );
			if ( $total_soft_poll_res_count == 0 ) {
				$total_soft_poll_res_count  = 1;
				$total_soft_poll_res_count1 = 0;
			} else {
				$total_soft_poll_res_count1 = $total_soft_poll_res_count;
			}
			if ( $t_s_poll_question_settings["TotalSoft_Poll_Set_02"] != '' ) {
				$ts_poll_coming_soon_bool = apply_filters( 'ts_poll_check_coming',$t_s_poll_question_settings["TotalSoft_Poll_Set_02"] );
			}
			if ( $t_s_poll_question_settings["TotalSoft_Poll_Set_03"] != '' && $ts_poll_coming_soon_bool == false ) {
				$ts_poll_endpoll_bool = apply_filters( 'ts_poll_check_end', $t_s_poll_question_settings["TotalSoft_Poll_Set_03"] );
			}
			if ( $ts_poll_coming_soon_bool === false && $ts_poll_endpoll_bool === false ) {
				$ts_poll_can_vote = true;
			}
		} else {
			return false;
		}
		$ts_poll_base_id = '';
		if ( $ts_poll_edit === 'true' ) {
			$ts_poll_coming_soon_bool = $ts_poll_endpoll_bool = false;
			$ts_poll_can_vote         = true;
		} else {
			$ts_poll_base_id            = $total_soft_poll;
			$total_soft_poll            = rand( 100000, 999999 );
			$tspoll_fontfamily_swap_arr = array(
				'ts_poll_q_ff',
				'ts_poll_boxsh',
				'ts_poll_vb_ff',
				'ts_poll_rb_ff',
				'TotalSoft_Poll_Set_09',
			);
			$tsp_font_families_css      = '';
			foreach ( $tspoll_fontfamily_swap_arr as $key => $value ) {
				if ( isset( $tspoll_question_styles[$value] ) || isset( $t_s_poll_question_settings[$value] ) ) {
					if ( isset( $tspoll_question_styles[$value] ) ) {
						$tsp_font_families_css .= apply_filters("tsp_get_font_face", $tspoll_question_styles[$value]);
					} else {
						$tsp_font_families_css .= apply_filters("tsp_get_font_face", $t_s_poll_question_settings[$value]);
					}
				}
			}
			wp_register_style( "ts_poll_builder_font_faces_{$total_soft_poll}", false );
			wp_enqueue_style( "ts_poll_builder_font_faces_{$total_soft_poll}" );
			wp_add_inline_style( "ts_poll_builder_font_faces_{$total_soft_poll}", $tsp_font_families_css );
		}
		// Include Form and Section CSS File
		include plugin_dir_path( dirname( __FILE__ ) ) . 'public/css/tsp-form-css.php';
		echo sprintf(
			"
			<form method='POST' class='%s' data-tsp-pos='%s'>
				<section class='%s' data-tsp-box='%s'>
					%s
				",
			'ts_poll_form ts_poll_form_' . esc_attr( $total_soft_poll ),
			esc_attr( $tspoll_question_styles["ts_poll_pos"] ),
			'ts_poll_section ts_poll_section_' . esc_attr( $total_soft_poll ),
			$tspoll_question_styles["ts_poll_boxsh_show"] != '' || $tspoll_question_styles["ts_poll_boxsh_show"] != 'false' ? esc_attr( $tspoll_question_styles["ts_poll_boxsh_type"] ) : '',
			$ts_poll_coming_soon_bool === false && $ts_poll_endpoll_bool === false && $ts_poll_can_vote === true ? sprintf( "<div class='ts_poll_loading'><img class='ts_poll_loading_img' src='%s'></div>", esc_url( plugins_url( 'public/img/tsp_loading.gif', __DIR__ ) ) ) : ''
		);
		// if cooming soon poll show coming soon div
		if ( $ts_poll_coming_soon_bool === true ) {
			include plugin_dir_path( dirname( __FILE__ ) ) . 'public/css/tsp-soon-css.php';
			echo sprintf(
				"
				<span class='%s'>
					<span class='%s'>
					  %s
				 	</span>
				</span>
				",
				'ts_poll_cs_' . esc_html( $total_soft_poll ),
				'ts_poll_cs_text_' . esc_html( $total_soft_poll ),
				esc_html( html_entity_decode( htmlspecialchars_decode( $t_s_poll_question_settings["TotalSoft_Poll_Set_04"] ), ENT_QUOTES ) )
			);
		} elseif ( $ts_poll_endpoll_bool === true || $ts_poll_can_vote === true ) {
			include plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/tsp-header-display.php';
			include plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/tsp-content-display.php';
			include plugin_dir_path( dirname( __FILE__ ) ) . 'public/css/tsp-content-css.php';
			wp_enqueue_style( "ts_poll_special_{$total_soft_poll}", plugin_dir_url( __DIR__ ) . 'public/css/ts_poll-content-special.css', array(), time(), 'all' );
			$tsp_special_colors = $tsp_special_colors_block = $tsp_special_colors_css = '';
			foreach ( $TS_Poll_Colors_Array as $key => $value ) :
				$tsp_special_colors .= sprintf(
					'
					--tsp_a_c_%s-%s : %s;',
					esc_html( $total_soft_poll ),
					esc_html( $key ),
					esc_attr( $value )
				);
				switch ( $ts_poll_question_params["TS_Poll_Q_Theme"] ) {
					case 'Standart Poll':
					case 'Standard Poll':
						if ( $ts_poll_old_standard === 'true' ) {
							$tsp_special_colors_css .= sprintf(
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
						} else {
							$tsp_special_colors_css .= sprintf(
								'
								main.ts_poll_main_%1$s[data-tsp-color="Background"] > .ts_poll_answer[data-tsp-id="%2$s"]{
									background-color: var(--tsp_a_c_%1$s-%2$s);
								}
								main.ts_poll_main_%1$s[data-tsp-color="Color"] > .ts_poll_answer[data-tsp-id="%2$s"]   .ts_poll_answer_label{
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
						}
						break;
					case 'Image Poll':
					case 'Video Poll':
						$tsp_special_colors_css .= sprintf(
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
						break;
					case 'Standart Without Button':
					case 'Standard Without Button':
					case 'Image Without Button':
					case 'Video Without Button':
					case 'Image in Question':
					case 'Video in Question':
						$tsp_special_colors_css .= sprintf(
							' 
							main.ts_poll_main_%1$s[data-tsp-color="Background"] > .ts_poll_answer[data-tsp-id="%2$s"]{
								background-color: var(--tsp_a_c_%1$s-%2$s);
							}
							main.ts_poll_main_%1$s[data-tsp-color="Color"] > .ts_poll_answer[data-tsp-id="%2$s"]   .ts_poll_answer_label{
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
						break;
				}
			endforeach;
			$tsp_special_colors_block = sprintf(
				':root{
					%1$s
				}
				%2$s
				',
				$tsp_special_colors,
				$tsp_special_colors_css
			);
			wp_add_inline_style( "ts_poll_special_{$total_soft_poll}", $tsp_special_colors_block );
			if ( $ts_poll_can_vote === true && $ts_poll_old_standard === '' ) {
				include plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/tsp-footer-display.php';
			}
			if ( $ts_poll_edit === 'true' ) {
				include plugin_dir_path( dirname( __FILE__ ) ) . 'public/js/tsp-content-js-edit.php';
			} else {
				if ( $ts_poll_endpoll_bool === true ) {
					wp_enqueue_script( "ts_poll_end_js_{$total_soft_poll}", plugin_dir_url( __DIR__ ) . 'public/js/ts_poll-content.js', array( 'jquery' ), time(), false );
					include plugin_dir_path( dirname( __FILE__ ) ) . 'public/js/tsp-end-js.php';
				} elseif ( $ts_poll_can_vote === true ) {
					wp_enqueue_script( "ts_poll_js_{$total_soft_poll}", plugin_dir_url( __DIR__ ) . 'public/js/ts_poll-content.js', array( 'jquery' ), time(), false );
					include plugin_dir_path( dirname( __FILE__ ) ) . 'public/js/tsp-content-js.php';
				}
			}
		}

		echo sprintf(
			'
				</section>
				%s
			</form>
			',
			wp_nonce_field( 'tsp_vote_nonce_' . $total_soft_poll, 'tsp_vote_nonce_field_' . $total_soft_poll, true, false )
		);

		if ( $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Standart Poll' || $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Standard Poll' ) {
			if ( $ts_poll_old_standard === 'true' ) {
				if ( $ts_poll_edit == 'true' || $tspoll_question_styles["ts_poll_p_shpop"] == 'true' && $ts_poll_endpoll_bool !== true && $ts_poll_can_vote === true ) {
					echo sprintf(
						'
						<section class="ts_poll_result_popup_section_%1$s">	
						</section>
						<div class="ts_poll_result_popup_result_%1$s">
							<div id="ts_poll_modal_result_section_%1$s" data-tsp-effect="%3$s">
								%2$s
							</div>
						</div>
					',
						esc_attr( $total_soft_poll ),
						$tsp_result_section_inner,
						esc_attr( $tspoll_question_styles["ts_poll_p_sheff"] )
					);
				}
			}
		}
	}


	/**
	 * Shortcode function for show poll
	 *
	 * @since 1.7.0
	 *
	 * @param array $atts Shortcode attributes provided by a user.
	 *
	 * @return string
	 */
	public function ts_poll_shortcode( $atts ) {
		$atts = shortcode_atts(
			array(
				'id'   => '',
				'edit' => '',
			),
			$atts
		);
		\ob_start();
			$this->ts_poll_content( $atts['id'], $atts['edit'] );
		return \ob_get_clean();
	}


	public function ts_poll_show_type( $tsp_show_type_arr ) {
		switch ( $tsp_show_type_arr['tsp_show_by'] ) {
			case 'percent':
			case 'percentlab':
				return $tsp_show_type_arr['tsp_show_results'] == 'true' ? esc_html( round( (int) $tsp_show_type_arr['tsp_answer_votes'] * 100 / $tsp_show_type_arr['tsp_total_votes'], 2 ) . '%' ) : esc_html( html_entity_decode( htmlspecialchars_decode( $tsp_show_type_arr['tsp_no_result_text'] ), ENT_QUOTES ) );
				break;
			case 'count':
			case 'countlab':
				return $tsp_show_type_arr['tsp_show_results'] == 'true' ? esc_html( (int) $tsp_show_type_arr['tsp_answer_votes'] ) : esc_html( html_entity_decode( htmlspecialchars_decode( $tsp_show_type_arr['tsp_no_result_text'] ), ENT_QUOTES ) );
				break;
			case 'both':
			case 'bothlab':
				return $tsp_show_type_arr['tsp_show_results'] == 'true' ? esc_html( (int) $tsp_show_type_arr['tsp_answer_votes'] . ' ( ' . round( (int) $tsp_show_type_arr['tsp_answer_votes'] * 100 / (int) $tsp_show_type_arr['tsp_total_votes'], 2 ) . ' % )' ) : esc_html( html_entity_decode( htmlspecialchars_decode( $tsp_show_type_arr['tsp_no_result_text'] ), ENT_QUOTES ) );
			  break;
			default:
				return $tsp_show_type_arr['tsp_show_results'] == 'true' ? esc_html( (int) $tsp_show_type_arr['tsp_answer_votes'] . ' ( ' . round( (int) $tsp_show_type_arr['tsp_answer_votes'] * 100 / (int) $tsp_show_type_arr['tsp_total_votes'], 2 ) . ' % )' ) : esc_html( html_entity_decode( htmlspecialchars_decode( $tsp_show_type_arr['tsp_no_result_text'] ), ENT_QUOTES ) );
			break;
		}
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.7.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
