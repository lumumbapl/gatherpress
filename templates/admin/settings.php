<?php

use GatherPress\Core\Settings;

if ( ! isset( $sub_pages, $page ) ) {
	return;
}

$setting = Settings::get_instance();
?>
<div class="wrap">
	<h1 class="wp-heading-inline">
		<?php esc_html_e( 'GatherPress Settings', 'gatherpress' ); ?>
	</h1>
	<h2 class="nav-tab-wrapper">
		<?php
		foreach ( $sub_pages as $sub_page => $value ) {
			$active_page = ( $page === $setting->prefix_key( $sub_page ) ) ? 'nav-tab-active' : '';
			$url = add_query_arg(
				[ 'page' => $setting->prefix_key( $sub_page ) ],
				admin_url( 'options-general.php' )
			);
			?>
			<a class="<?php echo esc_attr( 'nav-tab ' . $active_page ); ?>" href="<?php echo esc_url( $url ); ?>">
				<?php echo esc_html( $value['name'] ); ?>
			</a>
			<?php
		}
		?>
	</h2>
	<?php if ( $setting->prefix_key( 'credits' ) === $page ) : ?>
		<?php do_settings_sections( $page ); ?>
	<?php else : ?>
		<form method="post" action="options.php">
			<?php settings_fields( $page ); ?>
			<?php do_settings_sections( $page ); ?>

			<?php submit_button( __( 'Save Settings', 'gatherpress' ) ); ?>
		</form>
	<?php endif; ?>
</div>
