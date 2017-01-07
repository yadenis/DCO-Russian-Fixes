<?php
defined('ABSPATH') or die;

class DCO_RF_Admin extends DCO_RF_Base {

	public function __construct() {
		add_action( 'init', array( $this, 'init_hooks' ) );
	}

	public function init_hooks() {
		parent::init_hooks();

		add_action( 'admin_init', array( $this, 'register_settings' ) );
		add_action( 'admin_menu', array( $this, 'create_menu' ) );

		//Additional links on the plugin page
		add_filter( 'plugin_row_meta', array( $this, 'register_plugin_links' ), 10, 2 );
	}

	public function register_plugin_links( $links, $file ) {
		if ( $file == DCO_RF__PLUGIN_BASENAME ) {
			$links[] = '<a href="https://github.com/Denis-co/DCO-Russian-Fixes">' . __( 'GitHub', 'dco-russian-fixes' ) . '</a>';
			$links[] = '<a href="http://www.compnot.ru/wordpress/dco-russian-fixes-korrektiruem-russkij-wordpress.html">' . __( 'Plugin page', 'dco-russian-fixes' ) . '</a>';
		}

		return $links;
	}

	public function create_menu() {
		add_options_page( __( 'DCO Russian Fixes', 'dco-russian-fixes' ), __( 'DCO Russian Fixes', 'dco-russian-fixes' ), 'manage_options', 'dco_russian_fixes', array( $this, 'render' ) );
	}

	public function register_settings() {
		register_setting( 'dco_rf', 'dco_rf' );

		add_settings_section(
			'dco_rf_general', '', '', 'dco_rf'
		);

		add_settings_field(
			'transliterate_url', __( 'Transliterate url', 'dco-russian-fixes' ), array( $this, 'transliterate_url_render' ), 'dco_rf', 'dco_rf_general'
		);

		add_settings_field(
			'transliterate_file_name', __( 'Transliterate file name', 'dco-russian-fixes' ), array( $this, 'transliterate_file_name_render' ), 'dco_rf', 'dco_rf_general'
		);

		add_settings_field(
			'correct_dates', __( 'Correct dates', 'dco-russian-fixes' ), array( $this, 'correct_dates_render' ), 'dco_rf', 'dco_rf_general'
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
			<h1><?php _e('DCO Russian Fixes', 'dco-russian-fixes'); ?></h1>
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
