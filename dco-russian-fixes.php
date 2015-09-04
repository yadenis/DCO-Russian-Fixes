<?php

/*
  Plugin Name: DCO russian fixes
  Plugin URI: https://github.com/Denis-co/dco-russian-fixes
  Description: Add Wordpress russian language fixes
  Version: 1.0.6
  Author: Denis co.
  Author URI: http://denisco.pro
  License: GPLv2 or later
  Text Domain: dco-rf
 */

define( 'DCO_RF__PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'DCO_RF__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'DCO_RF__PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

require_once( DCO_RF__PLUGIN_DIR . 'class.dco-russian-fixes-base.php' );
require_once( DCO_RF__PLUGIN_DIR . 'class.dco-russian-fixes.php' );
if ( is_admin() ) {
	require_once( DCO_RF__PLUGIN_DIR . 'class.dco-russian-fixes-admin.php' );
}