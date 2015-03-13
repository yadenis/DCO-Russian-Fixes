<?php

class DCO_RF_Admin extends DCO_RF_Base {

	public function __construct() {
		add_action( 'init', array( $this, 'init_hooks' ) );
	}

	public function init_hooks() {
		parent::init_hooks();

		add_action( 'admin_init', array( $this, 'register_settings' ) );
		add_action( 'admin_menu', array( $this, 'create_menu' ) );

		if ( $this->options[ 'transliterate_url' ] ) {
			add_filter( 'sanitize_title', array( $this, 'transliterate' ), 9 );
		}
		if ( $this->options[ 'transliterate_file_name' ] ) {
			add_filter( 'sanitize_file_name', array( $this, 'transliterate' ) );
		}
	}

	/**
	 * Transliterate urls and files
	 */
	public function transliterate( $string ) {
		// define symbols table
		$symbol_table = array(
			'А'	 => 'A', 'Б'	 => 'B', 'В'	 => 'V', 'Г'	 => 'G', 'Д'	 => 'D',
			'Е'	 => 'E', 'Ё'	 => 'YO', 'Ж'	 => 'ZH', 'З'	 => 'Z', 'И'	 => 'I',
			'Й'	 => 'Y', 'К'	 => 'K', 'Л'	 => 'L', 'М'	 => 'M', 'Н'	 => 'N',
			'О'	 => 'O', 'П'	 => 'P', 'Р'	 => 'R', 'С'	 => 'S', 'Т'	 => 'T',
			'У'	 => 'U', 'Ф'	 => 'F', 'Х'	 => 'H', 'Ц'	 => 'C', 'Ч'	 => 'CH',
			'Ш'	 => 'SH', 'Щ'	 => 'SHH', 'Ъ'	 => "", 'Ы'	 => 'YI', 'Ь'	 => "",
			'Э'	 => 'E`', 'Ю'	 => 'YU', 'Я'	 => 'YA',
			'а'	 => 'a', 'б'	 => 'b', 'в'	 => 'v', 'г'	 => 'g', 'д'	 => 'd',
			'е'	 => 'e', 'ё'	 => 'yo', 'ж'	 => 'zh', 'з'	 => 'z', 'и'	 => 'i',
			'й'	 => 'y', 'к'	 => 'k', 'л'	 => 'l', 'м'	 => 'm', 'н'	 => 'n',
			'о'	 => 'o', 'п'	 => 'p', 'р'	 => 'r', 'с'	 => 's', 'т'	 => 't',
			'у'	 => 'u', 'ф'	 => 'f', 'х'	 => 'h', 'ц'	 => 'c', 'ч'	 => 'ch',
			'ш'	 => 'sh', 'щ'	 => 'shh', 'ь'	 => "", 'ы'	 => 'yi', 'ъ'	 => "",
			'э'	 => 'e`', 'ю'	 => 'yu', 'я'	 => 'ya'
		);

		$symbol_table = apply_filters( 'dco_rf_symbol_table', $symbol_table );

		// transliterate
		$dco_string	 = strtr( $string, $symbol_table );
		$dco_string	 = preg_replace( "/[^A-Za-z0-9`'_\-\.]/", '-', $dco_string );

		return apply_filters( 'dco_rf_transliterate', mb_strtolower( $dco_string, 'UTF-8' ), $string, $symbol_table );
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
		<div class="wrap">
			<h2>DCO Russian Fixes</h2>
			<form action="options.php" method="post">
				<?php
				settings_fields( 'dco_rf' );
				do_settings_sections( 'dco_rf' );
				submit_button( null, 'primary', 'submit', true, disabled( has_filter( 'dco_rf_get_options' ), true, false ) );
				?>
			</form>
		</div>
		<?php
	}

}

$dco_rf_admin = new DCO_RF_Admin();
