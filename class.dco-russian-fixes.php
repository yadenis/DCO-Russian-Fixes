<?php

class DCO_RF extends DCO_RF_Base {

	public function __construct() {
		add_action( 'init', array($this, 'init_hooks'));
	}

	public function init_hooks() {
		parent::init_hooks();
		
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
