<?php

/**
 * Class weather_underground_transient
 */
class weather_underground_transient {

	public $slug;
	public $state_abr;
	public $city_title;
	public $wu_key;
	public $wu_url;
	public $trans_key;
	public $trans_time;

	public function __construct( $slug, $state_abr, $city_title ) {

		$this->slug       = $slug;
		$this->state_abr  = $state_abr;
		$this->city_title = $city_title;
		$this->wu_key     = 'your-api-key';
		$this->wu_url     = 'http://api.wunderground.com/api/' . $this->wu_key . '/conditions/q/' . $this->state_abr . '/' . $this->slug . '.json';
		$this->trans_key  = 'city_temp_' . $this->slug . '_' . $this->state_abr;
		$this->trans_time = 600; // 10 minutes
	}

	public function get_current_temp() {

		$current_temp_trans = get_transient( $this->trans_key );

		if ( ( ! $current_temp_trans ) || ( $current_temp_trans == '' ) ) {

			$wu_data = wp_remote_fopen( $this->wu_url );

			$wu_data_decode = json_decode( $wu_data );

			$current_temp = $wu_data_decode->current_observation->temp_f;

			set_transient( $this->trans_key, $current_temp, $this->trans_time );

			$current_temp_trans = get_transient( $this->trans_key );
		}

		return $current_temp_trans;

	}


}