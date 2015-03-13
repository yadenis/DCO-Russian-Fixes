<?php

class DCO_RF extends DCO_RF_Base {

	public function __construct() {
		add_action( 'init', array($this, 'init_hooks'));
	}

	public function init_hooks() {
		parent::init_hooks();
		
		if ( is_admin() ) {
			if ( $this->options[ 'transliterate_url' ] ) {
				add_filter( 'sanitize_title', array( $this, 'transliterate' ), 9 );
			}
			if ( $this->options[ 'transliterate_file_name' ] ) {
				add_filter( 'sanitize_file_name', array( $this, 'transliterate' ) );
			}
		}

		if ( $this->options[ 'correct_dates' ] ) {
			add_filter( 'get_the_time', array( $this, 'correct_dates' ) );
			add_filter( 'get_the_date', array( $this, 'correct_dates' ) );
			add_filter( 'get_comment_date', array( $this, 'correct_dates' ) );
			add_filter( 'get_the_modified_date', array( $this, 'correct_dates' ) );
			add_filter( 'date_i18n', array( $this, 'correct_dates' ) );

			add_filter( 'get_the_archive_title', array( $this, 'correct_archive_titles' ) );
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

	/**
	 * Correct dates to russian format
	 */
	public function correct_dates( $date = '' ) {
		$replace = array(
			'Январь'	 => 'января',
			'Февраль'	 => 'февраля',
			'Март'		 => 'марта',
			'Апрель'	 => 'апреля',
			'Май'		 => 'мая',
			'Июнь'		 => 'июня',
			'Июль'		 => 'июля',
			'Август'	 => 'августа',
			'Сентябрь'	 => 'сентября',
			'Октябрь'	 => 'октября',
			'Ноябрь'	 => 'ноября',
			'Декабрь'	 => 'декабря',
			'th'		 => '',
			'st'		 => '',
			'nd'		 => '',
			'rd'		 => ''
		);

		$replace = apply_filters( 'dco_rf_replace_dates_table', $replace );

		return apply_filters( 'dco_rf_correct_dates', strtr( $date, $replace ), $date, $replace );
	}

	/*
	 * Need to correct the archive titles because get_the_date hook is general for this and dates
	 */
	public function correct_archive_titles( $title = '' ) {
		$replace = array(
			'января'	 => 'Январь',
			'февраля'	 => 'Февраль',
			'марта'		 => 'Март',
			'апреля'	 => 'Апрель',
			'мая'		 => 'Май',
			'июня'		 => 'Июнь',
			'июля'		 => 'Июль',
			'августа'	 => 'Август',
			'сентября'	 => 'Сентябрь',
			'октября'	 => 'Октябрь',
			'ноября'	 => 'Ноябрь',
			'декабря'	 => 'Декабрь',
		);

		$replace = apply_filters( 'dco_rf_replace_archive_titles_table', $replace );

		return apply_filters( 'dco_rf_correct_archive_titles', strtr( $title, $replace ), $title, $replace );
	}

}

$dco_rf = new DCO_RF();
