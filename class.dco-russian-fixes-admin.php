<?php

class DCO_RF_Admin extends DCO_RF_Base {
	public function __construct() {
		parent::__construct();
		
		$this->get_options();
		$this->init_hooks();
	}

	protected function init_hooks() {
		add_action( 'admin_init', array( $this, 'register_settings' ) );
		add_action( 'admin_menu', array( $this, 'create_menu' ) );
	}

	public function create_menu() {
		add_options_page( __( 'DCO Russian Fixes', 'dco-rf' ), __( 'DCO Russian Fixes', 'dco-rf' ), 'manage_options', 'dco_russian_fixes', array( $this, 'render' ) );
	}

	public function register_settings() {
		register_setting( 'dco_rf', 'dco_rf' );

		add_settings_section(
			'dco_rf_general', '', '', 'dco_rf'
		);

		add_settings_field(
			'transliterate_url', __( 'Transliterate url', 'dco-rf' ), array( $this, 'transliterate_url_render' ), 'dco_rf', 'dco_rf_general'
		);

		add_settings_field(
			'transliterate_file_name', __( 'Transliterate file name', 'dco-rf' ), array( $this, 'transliterate_file_name_render' ), 'dco_rf', 'dco_rf_general'
		);

		add_settings_field(
			'correct_dates', __( 'Correct dates', 'dco-rf' ), array( $this, 'correct_dates_render' ), 'dco_rf', 'dco_rf_general'
		);
	}

	public function transliterate_url_render() {
		?>
		<input type="hidden" name="dco_rf[transliterate_url]" value="0">
		<input type="checkbox" name="dco_rf[transliterate_url]" <?php checked( $this->options[ 'transliterate_url' ], 1 ); ?> value="1" <?php disabled( has_filter( 'dco_rf_get_options' ) ) ?>>
		<?php
	}

	public function transliterate_file_name_render() {
		?>
		<input type="hidden" name="dco_rf[transliterate_file_name]" value="0">
		<input type="checkbox" name="dco_rf[transliterate_file_name]" <?php checked( $this->options[ 'transliterate_file_name' ], 1 ); ?> value="1" <?php disabled( has_filter( 'dco_rf_get_options' ) ) ?>>
		<?php
	}

	public function correct_dates_render() {
		?>
		<input type="hidden" name="dco_rf[correct_dates]" value="0">
		<input type="checkbox" name="dco_rf[correct_dates]" <?php checked( $this->options[ 'correct_dates' ], 1 ); ?> value="1" <?php disabled( has_filter( 'dco_rf_get_options' ) ) ?>>
		<?php
	}

	function render() {
		?>
		<form action="options.php" method="post">

			<h2>DCO Russian Fixes</h2>

			<?php
			settings_fields( 'dco_rf' );
			do_settings_sections( 'dco_rf' );
			submit_button( null, 'primary', 'submit', true, disabled( has_filter( 'dco_rf_get_options' ), true, false ) );
			?>
		</form>
		<?php
	}

}

$dco_rf_admin = new DCO_RF_Admin();
