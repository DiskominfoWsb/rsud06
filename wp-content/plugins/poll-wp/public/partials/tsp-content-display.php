<?php
/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * This file include main and footer section of poll.
 *
 * @link       TS Poll
 * @since      1.7.0
 *
 * @package    TS_Poll
 * @subpackage TS_Poll/public/partials
 */


if ( array_key_exists("ts_poll_ch_s", $tspoll_question_styles ) ) {
	if ( ! is_numeric( $tspoll_question_styles["ts_poll_ch_s"] ) ) {
		if ( $tspoll_question_styles["ts_poll_ch_s"] == 'big' ) {
			$tspoll_question_styles["ts_poll_ch_s"] = '32';
		} elseif ( $tspoll_question_styles["ts_poll_ch_s"] == 'medium 2' ) {
			$tspoll_question_styles["ts_poll_ch_s"] = '26';
		} elseif ( $tspoll_question_styles["ts_poll_ch_s"] == 'medium 1' ) {
			$tspoll_question_styles["ts_poll_ch_s"] = '22';
		} elseif ( $tspoll_question_styles["ts_poll_ch_s"] == 'small' ) {
			$tspoll_question_styles["ts_poll_ch_s"] = '18';
		} else {
			$tspoll_question_styles["ts_poll_ch_s"] == '22';
		}
	}
}


if ( $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Standart Poll' || $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Standard Poll' ) {
	if ( array_key_exists("ts_poll_p_shpop", $tspoll_question_styles ) ) {
		$ts_poll_old_standard = 'true';
		include TS_POLL_PLUGIN_ENV . 'public/theme_partials/tsp-standard.php';
	} else {
		include TS_POLL_PLUGIN_ENV . 'public/theme_partials/tsp-standard-wb.php';
	}
} elseif ( $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Image Poll' || $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Video Poll' ) {
	include TS_POLL_PLUGIN_ENV . 'public/theme_partials/tsp-image-video.php';
} elseif ( $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Standart Without Button' || $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Standard Without Button' ) {
	include TS_POLL_PLUGIN_ENV . 'public/theme_partials/tsp-standard-wb.php';
} elseif ( $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Image Without Button' || $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Video Without Button' ) {
	include TS_POLL_PLUGIN_ENV . 'public/theme_partials/tsp-image-video-wb.php';
} elseif ( $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Image in Question' || $ts_poll_question_params["TS_Poll_Q_Theme"] == 'Video in Question' ) {
	include TS_POLL_PLUGIN_ENV . 'public/theme_partials/tsp-image-video-in.php';
}

