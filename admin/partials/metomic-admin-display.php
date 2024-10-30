<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://metomic.io
 * @since      1.0.0
 *
 * @package    Metomic
 * @subpackage Metomic/admin/partials
 */
?>

<div class="metomic-config">

	<svg width="76" height="29" viewBox="0 0 76 29" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M25.4291 12.8769C25.4291 8.92724 27.3228 6.60075 30.9478 6.60075C34.3563 6.60075 35.4925 9.03545 35.4925 12.1735V29H43.1754V11.3078C43.1754 4.70709 39.7127 0 32.8955 0C28.8377 0 25.9701 1.24441 23.4813 4.00373C21.8582 1.51493 19.0989 0 15.2575 0C11.1996 0 8.38619 1.67724 7.08769 4.11194V0.649252H0V29H7.68284V12.7146C7.68284 8.92724 9.6306 6.60075 13.2015 6.60075C16.6101 6.60075 17.7463 9.03545 17.7463 12.1735V29H25.4291V12.8769Z" fill="#58466D"/>
		<path d="M75.9344 21.7432H48.8822V28.9932H75.9344V21.7432Z" fill="#58466D"/>
	</svg>

	<br /><br />
	<br />

	<?php if (!get_option('mtm_project_id', null)) { ?>
		<h3>You're all set!</h3>

		<p>Metomic is now monitoring your website and automatically informing users of any third parties you're using.</p>
		<p>We've already picked up your brand colour and language, but if you'd like to customize further:</p>

		<a class="button button-metomic-success" target="_blank" id="create-metomic-account">Sign Up to Metomic</a>

		<a class="button button-primary button-metomic" target="_blank" id="connect-metomic-account">Connect your existing account</a>
		<input type="hidden" id="site-url" value="<?php echo get_site_url() ?>" />

		<form method="post" id="metomic-connect" style="display: none;"> 
			<?php do_settings_sections( 'metomic-admin' ); ?>
		</form>

		<br /><br />
		<br />

		<h3>Alternatively, paste your Project ID</h3>
		<p>If you’ve already customised your Consent Manager installation you can paste your existing project ID here and import your settings.</p>
		<form method="post"> 
			<?php do_settings_sections( 'metomic-admin' ); ?>
			<button type="submit" class="button button-primary button-metomic">Import Consent Manager</button>
		</form>
	<?php } else { ?>
		<h3>You’re connected!</h3>
		<p>You can customise your Consent Manager’s colours and positioning from Metomic.</p>
		<a class="button button-primary button-metomic" target="_blank" href="https://app.metomic.io/dashboard/consent/appearance">Customise Consent Manager</a>

		<br /><br />
		<br />

		<h3>Disconnecting your account</h3>
		<p>When you disconnect your Metomic account from WordPress, the Consent Manager and cookie policy will no longer appear on your page.</p>
		<form method="post"> 
			<input type="hidden" id="mtm_project_id" name="mtm_project_id" value="">
			<button type="submit" class="button button-metomic-danger">Disconnect your account</button>
		</form>
	<?php } ?>

</div>