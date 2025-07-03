/**
 * DadeCore Theme - Cookie Consent Management Script
 * Handles banner, modal, user preferences, and Google Consent Mode v2 updates.
 */
(function(window, document, dadecoreCookieConsent) {
    'use strict';

    if (!dadecoreCookieConsent) {
        console.error('DadeCore Cookie Consent: Missing localization data.');
        return;
    }

    const { gtm_id, cookie_name, cookie_version, consent_categories, texts } = dadecoreCookieConsent;

    const banner = document.getElementById('dc-cookie-consent-banner');
    const modal = document.getElementById('dc-cookie-consent-modal');
    const acceptAllBtn = document.getElementById('dc-accept-all');
    const rejectAllBtn = document.getElementById('dc-reject-all');
    const openSettingsBtn = document.getElementById('dc-open-settings');
    const closeModalBtn = document.getElementById('dc-close-modal');
    const saveSettingsBtn = document.getElementById('dc-save-settings');
    const acceptAllModalBtn = document.getElementById('dc-accept-all-modal');
    const settingsForm = document.getElementById('dc-cookie-settings-form');

    const COOKIE_EXPIRY_DAYS = 365;

    /**
     * Gets a cookie value by name.
     */
    function getCookie(name) {
        const nameEQ = name + "=";
        const ca = document.cookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) === ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

    /**
     * Sets a cookie.
     */
    function setCookie(name, value, days) {
        let expires = "";
        if (days) {
            const date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "") + expires + "; path=/; SameSite=Lax";
    }

    /**
     * Updates Google Consent Mode based on current preferences.
     */
    function updateGoogleConsent(preferences) {
        if (typeof gtag !== 'function' || !gtm_id) {
            // console.warn('DadeCore Cookie Consent: gtag function not found or GTM ID missing. Consent update skipped.');
            return;
        }

        const consentCommand = {};
        for (const categoryKey in consent_categories) {
            if (consent_categories.hasOwnProperty(categoryKey)) {
                const category = consent_categories[categoryKey];
                const granted = preferences[categoryKey] === 'granted';
                for (const mapKey in category.google_consent_map) {
                    if (category.google_consent_map.hasOwnProperty(mapKey)) {
                        consentCommand[mapKey] = granted ? 'granted' : 'denied';
                    }
                }
            }
        }

        // Ensure essential ones that might not be in preferences (if readonly) are set
        if (consent_categories.essential && consent_categories.essential.google_consent_map) {
             for (const mapKey in consent_categories.essential.google_consent_map) {
                consentCommand[mapKey] = 'granted';
            }
        }

        // console.log('DadeCore Cookie Consent: Updating gtag consent with:', consentCommand);
        gtag('consent', 'update', consentCommand);

        // Push an event to dataLayer for GTM to pick up
        window.dataLayer = window.dataLayer || [];
        dataLayer.push({'event': 'dc_consent_updated', 'dc_consent_preferences': preferences });
    }

    /**
     * Saves user consent preferences to a cookie and updates Google Consent Mode.
     */
    function saveConsent(preferences) {
        const cookieData = {
            version: cookie_version,
            preferences: preferences,
            timestamp: new Date().toISOString()
        };
        setCookie(cookie_name, JSON.stringify(cookieData), COOKIE_EXPIRY_DAYS);
        updateGoogleConsent(preferences);
        hideBanner();
        hideModal();
    }

    /**
     * Gets current consent preferences from form inputs.
     */
    function getPreferencesFromForm() {
        const preferences = {};
        const inputs = settingsForm.querySelectorAll('input[type="checkbox"], input[type="hidden"]');
        inputs.forEach(input => {
            const key = input.name.replace('consent_', '');
            if (input.type === 'checkbox') {
                preferences[key] = input.checked ? 'granted' : 'denied';
            } else if (input.type === 'hidden') { // For readonly essential cookies
                preferences[key] = 'granted';
            }
        });
        return preferences;
    }

    /**
     * Sets form inputs based on preferences.
     */
    function setFormFromPreferences(preferences) {
        if (!settingsForm) return;
        for (const key in preferences) {
            if (preferences.hasOwnProperty(key)) {
                const input = settingsForm.querySelector(`input[name="consent_${key}"]`);
                if (input && input.type === 'checkbox') {
                    input.checked = preferences[key] === 'granted';
                }
            }
        }
    }

    /**
     * Handles "Accept All" action.
     */
    function acceptAll() {
        const preferences = {};
        for (const key in consent_categories) {
            preferences[key] = 'granted';
        }
        saveConsent(preferences);
    }

    /**
     * Handles "Reject All" action (keeps essential only).
     */
    function rejectAll() {
        const preferences = {};
        for (const key in consent_categories) {
            preferences[key] = consent_categories[key].readonly ? 'granted' : 'denied';
        }
        saveConsent(preferences);
    }

    /**
     * Handles "Save Settings" from modal.
     */
    function saveModalSettings() {
        const preferences = getPreferencesFromForm();
        saveConsent(preferences);
    }

    function showBanner() {
        if (banner) banner.hidden = false;
    }

    function hideBanner() {
        if (banner) banner.hidden = true;
    }

    function showModal() {
        if (modal) modal.hidden = false;
        // Load current preferences into modal when shown
        const storedCookie = getCookie(cookie_name);
        if (storedCookie) {
            try {
                const parsedCookie = JSON.parse(storedCookie);
                if (parsedCookie.preferences) {
                    setFormFromPreferences(parsedCookie.preferences);
                }
            } catch (e) { /* Use defaults from form */ }
        }
    }

    function hideModal() {
        if (modal) modal.hidden = true;
    }

    /**
     * Initializes the consent management.
     */
    function init() {
        if (!banner || !modal || !settingsForm) {
            // console.error('DadeCore Cookie Consent: Banner or modal elements not found.');
            return;
        }

        const storedCookie = getCookie(cookie_name);
        let userPreferences = null;

        if (storedCookie) {
            try {
                const parsedCookie = JSON.parse(storedCookie);
                if (parsedCookie.version === cookie_version) {
                    userPreferences = parsedCookie.preferences;
                    // Preferences are valid, update consent mode silently
                    updateGoogleConsent(userPreferences);
                    // console.log('DadeCore Cookie Consent: Valid cookie found, consent updated.', userPreferences);
                } else {
                    // Version mismatch, cookie is invalid, show banner
                    // console.log('DadeCore Cookie Consent: Cookie version mismatch, showing banner.');
                    showBanner();
                }
            } catch (e) {
                // Invalid cookie format, show banner
                // console.error('DadeCore Cookie Consent: Error parsing cookie, showing banner.', e);
                showBanner();
            }
        } else {
            // No cookie, show banner
            // console.log('DadeCore Cookie Consent: No cookie found, showing banner.');
            showBanner();
        }

        // Event Listeners
        if (acceptAllBtn) acceptAllBtn.addEventListener('click', acceptAll);
        if (rejectAllBtn) rejectAllBtn.addEventListener('click', rejectAll);
        if (openSettingsBtn) openSettingsBtn.addEventListener('click', () => {
            hideBanner(); // Optionally hide banner when modal opens
            showModal();
        });
        if (closeModalBtn) closeModalBtn.addEventListener('click', hideModal);
        if (saveSettingsBtn) saveSettingsBtn.addEventListener('click', saveModalSettings);
        if (acceptAllModalBtn) acceptAllModalBtn.addEventListener('click', () => {
            acceptAll(); // This will also hide the modal via saveConsent
        });

        // Close modal if backdrop is clicked
        modal.addEventListener('click', function(event) {
            if (event.target === modal) {
                hideModal();
            }
        });
    }

    // Auto-initialize on DOMContentLoaded or if already loaded
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})(window, document, window.dadecoreCookieConsent || {});
