<?php

class DCO_RF_Base {

	protected $options = array();

	protected function init_hooks() {
		$this->get_options();
		add_action( 'admin_init', array( $this, 'load_language' ) );

		if ( $this->options[ 'transliterate_file_name' ] ) {
			add_filter( 'sanitize_file_name', array( $this, 'transliterate' ) );
		}
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

}
