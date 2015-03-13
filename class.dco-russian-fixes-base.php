<?php

class DCO_RF_Base {

	protected $options = array();

	protected function init_hooks() {
		$this->get_options();
		add_action( 'admin_init', array( $this, 'load_language' ) );
	}

	protected function get_options() {
		$default = array(
			'transliterate_url'			 => 1,
			'transliterate_file_name'	 => 1,
			'correct_dates'				 => 1
		);

		$options = get_option( 'dco_rf' );

		$this->options = apply_filters( 'dco_rf_get_options', wp_parse_args( $options, $default ), $options, $default );
	}

	public function load_language() {
		load_plugin_textdomain( 'dco-rf', false, plugin_basename( DCO_RF__PLUGIN_DIR ) . '/languages' );
	}

}