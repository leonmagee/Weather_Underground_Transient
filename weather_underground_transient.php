<?php

/**
 * Class weather_underground_transient
 */
class weather_underground_transient {

	public $state_abr;
	public $city_title;
	public $city_und;
	public $wu_key;
	public $wu_url;
	public $trans_key;
	public $trans_time;

	public function __construct( $state_abr, $city_title ) {

		$this->state_abr  = $state_abr;
		$this->city_title = $city_title;
		$this->city_und   = str_replace( ' ', '_', $this->city_title );
		$this->wu_key     = '60342d66c45e7af0';
		$this->wu_url     = 'http://api.wunderground.com/api/' . $this->wu_key . '/conditions/q/' . $this->state_abr . '/' . $this->city_und . '.json';
		$this->trans_key  = 'city_temp_' . $this->city_und . '_' . $this->state_abr;
		$this->trans_time = 300; // 5 minutes
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