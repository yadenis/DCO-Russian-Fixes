<?php

/*
  Plugin Name: DCO russian fixes
  Plugin URI: https://github.com/Denis-co/dco-russian-fixes
  Description: Add Wordpress russian language fixes
  Version: 0.1.1
  Author: Denis co.
  Author URI: http://denisco.pro
  License: GPLv2 or later
 */

// Add translatiration urls and files
function dco_sanitize_title( $title ) {
	global $wpdb;

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

	$symbol_table = apply_filters( 'dco_symbol_table', $symbol_table );

	// transliterate
	$title	 = strtr( $title, $symbol_table );
	$title	 = preg_replace( "/[^A-Za-z0-9`'_\-\.]/", '-', $title );

	return mb_strtolower( $title, 'UTF-8' );
}

add_filter( 'sanitize_title', 'dco_sanitize_title', 9 );
add_filter( 'sanitize_file_name', 'dco_sanitize_title' );

// Disable xmlrpc
add_filter( 'xmlrpc_enabled', '__return_false' );

// Remove unusable links from head
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );

// Convert dates to russian
function dco_russian_dates( $date = '' ) {
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

	return strtr( $date, $replace );
}

add_filter( 'get_the_time', 'dco_russian_dates' );
add_filter( 'get_the_date', 'dco_russian_dates' );
add_filter( 'get_comment_date', 'dco_russian_dates' );
add_filter( 'get_the_modified_date', 'dco_russian_dates' );
add_filter( 'date_i18n', 'dco_russian_dates' );
