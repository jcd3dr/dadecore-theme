<?php
/**
 * Cookie Consent Management with Google Consent Mode v2 Support.
 *
 * @package DadeCore_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Enqueue scripts and styles for cookie consent.
 */
function dadecore_cookie_consent_scripts_styles() {
	wp_enqueue_style( 'dadecore-cookie-consent-style', get_template_directory_uri() . '/assets/css/cookie-consent.css', array(), null );
	wp_enqueue_script( 'dadecore-cookie-consent-script', get_template_directory_uri() . '/assets/js/cookie-consent.js', array(), null, true );

    // Pass data to script
    $gtm_id = get_option('dadecore_gtm_id', '');
    $theme_name_slug = sanitize_title(get_bloginfo('name')); // Cookie name prefix

	wp_localize_script(
		'dadecore-cookie-consent-script',
		'dadecoreCookieConsent',
		array(
			'ajax_url' => admin_url( 'admin-ajax.php' ), // If needed for saving preferences via AJAX later
            'gtm_id' => $gtm_id,
            'cookie_name' => 'dc_consent_' . $theme_name_slug,
            'cookie_version' => '1', // Increment to invalidate old cookies if categories change
            'consent_categories' => dadecore_get_consent_categories(),
            'texts' => array(
                'banner_title' => esc_html__( 'Cookie Consent', 'dadecore-theme' ),
                'banner_message' => esc_html__( 'We use cookies to improve your experience and for marketing purposes. You can customize your settings below.', 'dadecore-theme' ),
                'accept_all_btn' => esc_html__( 'Accept All', 'dadecore-theme' ),
                'accept_selected_btn' => esc_html__( 'Accept Selected', 'dadecore-theme' ),
                'reject_all_btn' => esc_html__( 'Reject All (Essential Only)', 'dadecore-theme' ),
                'settings_btn' => esc_html__( 'Customize Settings', 'dadecore-theme' ),
                'save_settings_btn' => esc_html__( 'Save Settings', 'dadecore-theme' ),
                'close_btn_aria' => esc_html__( 'Close cookie consent settings', 'dadecore-theme' ),
            )
		)
	);
}
add_action( 'wp_enqueue_scripts', 'dadecore_cookie_consent_scripts_styles' );

/**
 * Default Google Consent Mode v2 settings (before any user interaction).
 * This should run as early as possible in the <head>.
 */
function dadecore_default_consent_mode() {
    // If GTM ID is not set, don't output consent mode defaults.
    $gtm_id = get_option('dadecore_gtm_id', '');
    if (empty($gtm_id)) {
        return;
    }
    ?>
    <script>
    // Define dataLayer and the gtag function.
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}

    // Default consent state - all denied initially, can be updated by cookie preferences
    gtag('consent', 'default', {
        'ad_storage': 'denied',
        'ad_user_data': 'denied',
        'ad_personalization': 'denied',
        'analytics_storage': 'denied',
        'functionality_storage': 'granted', // Often considered essential or for user preferences
        'personalization_storage': 'denied',
        'security_storage': 'granted', // Usually essential
        'wait_for_update': 500 // Milliseconds to wait for consent update before sending hits
    });
    // Send GTM ID to dataLayer for GTM script to pick up if needed
    dataLayer.push({'gtm.start': new Date().getTime(),event:'gtm.js'});
    <?php
    // If you have other specific tags that need default consent, add them here.
    // Example: gtag('set', 'ads_data_redaction', true); if ad_storage is denied.
    ?>
    </script>
    <?php
}
add_action( 'wp_head', 'dadecore_default_consent_mode', 0 ); // Highest priority

/**
 * Output the cookie consent banner and modal HTML structure.
 * This will be hidden by default via CSS and shown by JS if no consent cookie is found.
 */
function dadecore_cookie_consent_markup() {
	?>
    <div id="dc-cookie-consent-banner" class="dc-cookie-banner" role="dialog" aria-live="polite" aria-label="<?php esc_attr_e( 'Cookie Consent Banner', 'dadecore-theme' ); ?>" hidden>
        <div class="dc-cookie-banner__content">
            <p class="dc-cookie-banner__text"><?php echo esc_html( dadecore_get_cookie_text('banner_message') ); ?></p>
        </div>
        <div class="dc-cookie-banner__actions">
            <button type="button" id="dc-accept-all" class="dc-btn dc-btn-primary"><?php echo esc_html( dadecore_get_cookie_text('accept_all_btn') ); ?></button>
            <button type="button" id="dc-reject-all" class="dc-btn dc-btn-secondary"><?php echo esc_html( dadecore_get_cookie_text('reject_all_btn') ); ?></button>
            <button type="button" id="dc-open-settings" class="dc-btn dc-btn-link"><?php echo esc_html( dadecore_get_cookie_text('settings_btn') ); ?></button>
        </div>
    </div>

    <div id="dc-cookie-consent-modal" class="dc-cookie-modal" role="dialog" aria-modal="true" aria-labelledby="dc-cookie-modal-title" hidden>
        <div class="dc-cookie-modal__content">
            <button type="button" id="dc-close-modal" class="dc-cookie-modal__close" aria-label="<?php echo esc_attr( dadecore_get_cookie_text('close_btn_aria') ); ?>">&times;</button>
            <h2 id="dc-cookie-modal-title" class="dc-cookie-modal__title"><?php echo esc_html( dadecore_get_cookie_text('banner_title') ); ?></h2>
            <p class="dc-cookie-modal__description"><?php echo esc_html( dadecore_get_cookie_text('banner_message') ); ?></p>

            <form id="dc-cookie-settings-form">
                <?php foreach ( dadecore_get_consent_categories() as $key => $category ) : ?>
                    <div class="dc-cookie-category">
                        <div class="dc-cookie-category__header">
                            <label for="dc-consent-<?php echo esc_attr( $key ); ?>" class="dc-cookie-category__label">
                                <?php echo esc_html( $category['label'] ); ?>
                            </label>
                            <?php if ( ! $category['readonly'] ) : ?>
                                <input type="checkbox" id="dc-consent-<?php echo esc_attr( $key ); ?>" name="consent_<?php echo esc_attr( $key ); ?>" class="dc-cookie-category__toggle" value="granted" <?php checked( $category['default_state'] === 'granted' ); ?>>
                            <?php else: ?>
                                <span class="dc-cookie-category__readonly-badge"><?php esc_html_e( 'Always Active', 'dadecore-theme' ); ?></span>
                                <input type="hidden" name="consent_<?php echo esc_attr( $key ); ?>" value="granted">
                            <?php endif; ?>
                        </div>
                        <p class="dc-cookie-category__description"><?php echo esc_html( $category['description'] ); ?></p>
                    </div>
                <?php endforeach; ?>
            </form>

            <div class="dc-cookie-modal__actions">
                <button type="button" id="dc-save-settings" class="dc-btn dc-btn-primary"><?php echo esc_html( dadecore_get_cookie_text('save_settings_btn') ); ?></button>
                <button type="button" id="dc-accept-all-modal" class="dc-btn dc-btn-secondary"><?php echo esc_html( dadecore_get_cookie_text('accept_all_btn') ); ?></button>
            </div>
        </div>
    </div>
	<?php
}
add_action( 'wp_footer', 'dadecore_cookie_consent_markup' );

/**
 * Get consent categories configuration.
 * This could be extended to be filterable or configurable via theme options.
 */
function dadecore_get_consent_categories() {
    // Mapping from our categories to Google Consent Mode parameters
    return array(
        'essential' => array(
            'label' => __( 'Strictly Necessary', 'dadecore-theme' ),
            'description' => __( 'These cookies are essential for the website to function and cannot be switched off. They are usually only set in response to actions made by you which amount to a request for services, such as setting your privacy preferences, logging in or filling in forms.', 'dadecore-theme' ),
            'readonly' => true, // Cannot be disabled by user
            'default_state' => 'granted', // Always granted
            'google_consent_map' => ['security_storage' => 'granted', 'functionality_storage' => 'granted'] // Example mapping
        ),
        'analytics' => array(
            'label' => __( 'Analytics Cookies', 'dadecore-theme' ),
            'description' => __( 'These cookies allow us to count visits and traffic sources so we can measure and improve the performance of our site. They help us to know which pages are the most and least popular and see how visitors move around the site.', 'dadecore-theme' ),
            'readonly' => false,
            'default_state' => 'denied', // Default to denied
            'google_consent_map' => ['analytics_storage' => 'granted'] // If user grants this, analytics_storage becomes granted
        ),
        'marketing' => array(
            'label' => __( 'Marketing Cookies', 'dadecore-theme' ),
            'description' => __( 'These cookies may be set through our site by our advertising partners. They may be used by those companies to build a profile of your interests and show you relevant adverts on other sites.', 'dadecore-theme' ),
            'readonly' => false,
            'default_state' => 'denied',
            'google_consent_map' => ['ad_storage' => 'granted', 'ad_user_data' => 'granted', 'ad_personalization' => 'granted']
        ),
        // Example of a more granular category if needed
        // 'personalization' => array(
        //     'label' => __( 'Personalization Cookies', 'dadecore-theme' ),
        //     'description' => __( 'These cookies enable the website to provide enhanced functionality and personalisation. They may be set by us or by third party providers whose services we have added to our pages.', 'dadecore-theme' ),
        //     'readonly' => false,
        //     'default_state' => 'denied',
        //     'google_consent_map' => ['personalization_storage' => 'granted']
        // ),
    );
}

/**
 * Helper to get localized texts for cookie consent.
 */
function dadecore_get_cookie_text( $key, $default = '' ) {
    $localized_data = wp_scripts()->get_data( 'dadecore-cookie-consent-script', 'dadecoreCookieConsent' );
    return isset( $localized_data['texts'][$key] ) ? $localized_data['texts'][$key] : $default;
}

?>
