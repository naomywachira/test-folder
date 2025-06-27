=== Finachub Lipa na Mpesa Checkout for WooCommerce ===
Contributors: Finacc, bnyamesa
Tags: mpesa,M-pesa, Lipa na Mpesa,woocommerce payments, STK Push
Requires at least: 5.0
Tested up to: 6.8
Stable tag: 1.2.0
Requires PHP: 7.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
WC requires at least: 4.0
WC tested up to: 8.8

Accept M-Pesa (Safaricom) payments directly on your WooCommerce store with STK push, basic transaction logging, and a clean user experience. Upgrade to Pro for automatic order updates and powerful features.

== Description ==

Finachub Lipa na Mpesa Checkout for WooCommerce provides a simple and effective way to integrate Kenya's leading mobile payment solution, M-Pesa, into your online store. This plugin allows customers to pay using Safaricom's STK Push prompt directly on their phones during checkout.

**Key Features (Free Version):**

*   **Direct M-Pesa Integration:** Enable M-Pesa as a payment option in WooCommerce.
*   **STK Push Initiation:** Send payment prompts directly to the customer's phone number entered at checkout.
*   **Sandbox & Live Modes:** Configure the plugin for testing with Safaricom's sandbox credentials or use your live credentials for real transactions.
*   **Basic Transaction Logging:** Records initiated transactions with pending status in a custom database table (visible via database tools, *not in admin*).
*   **User-Friendly Waiting Page:** A clean, modern screen reassures customers while they await the STK push prompt.
*   **Classic Checkout Compatibility:** Designed to work reliably with the standard WooCommerce checkout shortcode (`[woocommerce_checkout]`). *Ensures compatibility by overriding block checkout if necessary.*
*   **Modern Admin Interface:** Enjoy a refreshed, stylish admin dashboard for settings guidance, help, and Pro upgrade information.

**Upgrade to M-Pesa Pro for Powerful Automation & Management:**

*   **Automatic Order Completion:** Process Safaricom callback notifications to automatically update order statuses (e.g., to 'Processing' or 'Completed') upon successful payment - **Eliminate manual checks and save significant time!**
*   **Detailed Transaction Dashboard:** View, search, and filter all M-Pesa transactions with full status updates within your WordPress admin.
*   **CSV Export:** Easily export transaction data for accounting and reporting.
*   **Advanced Error Logging & Debugging:** Get more insights into API communication.
*   **Customizable Waiting Page:** More options to tailor the waiting screen text and appearance.
*   **Priority Support:** Get faster assistance from our support team via email.
*   **[Stop Manual Work - Upgrade to Pro!](https://finachub.com/product-category/plugins/mpesa/)**

== Installation ==

1.  **Prerequisites:**
    *   WordPress 5.0 or higher.
    *   WooCommerce 4.0 or higher installed and activated.
    *   Your website **must** use HTTPS (SSL certificate installed and active).
    *   PHP 7.2 or higher.
2.  **Upload Plugin Files:**
    *   Download the plugin ZIP file from the source (e.g., WordPress.org or Finachub).
    *   Log into your WordPress admin area, navigate to Plugins → Add New → Upload Plugin.
    *   Choose the downloaded ZIP file and click "Install Now".
    *   Alternatively, upload the unzipped `finachub-checkout-for-m-pesa` folder to your `/wp-content/plugins/` directory via FTP.
3.  **Activate the Plugin:**
    *   In your WordPress admin, go to Plugins and activate "Finachub Lipa na Mpesa Checkout for WooCommerce".
4.  **Configure the Plugin:**
    *   Navigate to the new "M-Pesa" menu item in your admin sidebar, then click "Settings Guide" for detailed steps OR go directly to WooCommerce → Settings → Payments and click "Manage" next to M-Pesa.
    *   Check the "Enable M-Pesa Payment" box.
    *   Enter your M-Pesa API credentials (Consumer Key, Consumer Secret, Short Code, Passkey) obtained from the [Safaricom Developer Portal](https://developer.safaricom.co.ke/). Use Sandbox credentials for testing first.
    *   Select the correct "Environment" (Sandbox or Live) matching your credentials.
    *   Note the Callback URL displayed (ending in `/wc-api/finachub_callback/`) and copy it. You will need to register this URL in your Safaricom Developer Portal app settings under the "Callback URL" field. (Note: Full callback processing and automatic order updates requires the Pro version).
    *   Save your changes.
5.  **Verify Checkout Page:**
    *   This plugin forces the use of the classic WooCommerce checkout shortcode (`[woocommerce_checkout]`) on your checkout page for reliable operation in the free version. Upon activation, it attempts to update your designated checkout page (usually the page selected under WooCommerce -> Settings -> Advanced). Please verify that your checkout page content contains *only* this shortcode (`[woocommerce_checkout]`) and remove any block editor content if present.

== Frequently Asked Questions ==

= Does this plugin automatically update order status after payment? =

The **Free** version initiates the STK push but **does not** automatically process the callback from Safaricom to update the order status in WooCommerce. Orders will remain 'On Hold' even after payment is completed by the customer. You need to manually verify payment in your M-Pesa account/portal and update the order status in WooCommerce. **Automatic order completion via callback is a key feature of the [Pro version](https://finachub.com/product-category/plugins/mpesa/) that saves you time and manual work.**

= Where do I get the M-Pesa API credentials? =

You need to register an app on the [Safaricom Developer Portal](https://developer.safaricom.co.ke/) to get your Consumer Key, Consumer Secret. You will also need your allocated Short Code (PayBill or Till Number) and the associated Lipa na M-Pesa Online Passkey. Use their Sandbox environment first for testing.

= Is my website required to use HTTPS? =

Yes, absolutely. Safaricom's API requires secure HTTPS connections for all communication, including the callback URL (even if not fully processed in the free version). Your site must have a valid SSL certificate.

= What phone number format should customers use? =

Customers should enter their Safaricom number starting with 07... or 01... The plugin automatically formats it to the required 254... format for the API call (e.g., 0712345678 becomes 254712345678).

= Where can I find documentation or get support? =

*   **Admin Guides:** Check the "Settings Guide" and "Help & Upgrade" pages under the "M-Pesa" menu in your WordPress admin.
*   **Online Documentation:** [Finachub M-Pesa Docs](https://finachub.com/mpesa-checkout-docs/)
*   **Support:** Visit our [Contact Page](https://finachub.com/contact-us/) or email us at info@finachub.com. Pro users receive priority support.

= How do I upgrade to the Pro version? =

Visit the [Finachub M-Pesa Plugin Page](https://finachub.com/product-category/plugins/mpesa/) to purchase and download the Pro version. You can then deactivate the Free version and activate the Pro version. Your settings should generally be retained.

== Screenshots ==

1.  Admin Dashboard - Modern UI showcasing Pro upgrade benefits and links, with a potential notice about orders needing manual update.
2.  Admin Settings Guide - Clear, numbered steps for configuring the plugin, including instructions for the Callback URL.
3.  WooCommerce Settings - The M-Pesa gateway settings page, showing standard options and a greyed-out section highlighting Pro features.
4.  Admin Help & Upgrade Page - Troubleshooting tips, support links, and a detailed Pro features overview.
5.  Checkout Page - M-Pesa payment option with phone number input field.
6.  Frontend Waiting Page - Clean screen shown after initiating payment, with spinner, order details, and a clear message about the manual process in the free version.
7.  M-Pesa STK Push Prompt - Example of the prompt on a customer's phone (for illustration).

== Changelog ==

= 1.2.0 =
*   Major Admin UI Overhaul: Implemented a modern, stylish, and user-friendly interface for all admin pages (Dashboard, Settings Guide, Help).
*   Improved Admin Navigation: Consolidated plugin pages under a single "M-Pesa" top-level menu.
*   Refined Settings Guide: Made configuration steps clearer, improved layout, and added direct link to WC settings. Addressed step 4 visibility issue.
*   Updated Admin Page Structure: Used cards, grids, improved typography, spacing, and iconography (Dashicons).
*   Refined Pro Upsell Content: Enhanced the presentation of Pro features in the admin area.
*   Updated URLs: Corrected purchase, documentation, and contact URLs throughout the plugin and readme. Added support email.
*   Dependency Check: Ensured Dashicons CSS is correctly enqueued for admin styles.
*   Code Standards: Minor improvements for clarity and WordPress coding standards.
*   Version Bump.

= 1.1.3 =
*   **Feature:** Added a notice to the Admin Dashboard displaying the count of 'On Hold' M-Pesa orders needing manual verification, highlighting the value of Pro automation.
*   **Feature:** Added a clear, greyed-out section to the WooCommerce M-Pesa Settings page showcasing key Pro features (Auto Updates, Dashboard, Export, Priority Support).
*   **Enhancement:** Refined CTA text across admin pages and the waiting page to be more benefit-driven ("Automate & Save Time", "Stop Manual Updates").
*   **Enhancement:** Improved Settings Guide steps for clarity on Callback URL and navigation.
*   **Enhancement:** Enqueued admin styles on the WooCommerce settings page for the M-Pesa section.
*   **Enhancement:** Made Callback URL field readonly in settings as it's auto-generated.
*   **Fix:** Corrected jQuery UI version in enqueue script.
*   Version Bump.


= 1.1.2 =
*   Security: Added nonce verification to the waiting page URL generation and access check.
*   Security: Added nonce verification to the payment processing step (`process_payment`).
*   Security: Ensured `wp_unslash` is used before sanitization on relevant `$_POST`/`$_GET` data.
*   Code Quality: Used `gmdate()` for UTC timestamps in API calls.
*   Code Quality: Used `wp_json_encode()` for API payloads.
*   Improved Waiting Page User Validation: Stricter checks for valid order and user access (logged-in vs guest).
*   Refined Waiting Page Content & Styling (Minor CSS tweaks).

= 1.1.1 =
*   Improved styling for the waiting page.
*   Updated API integration for enhanced reliability.
*   Minor bug fixes and performance improvements.

= 1.1.0 =
*   Initial release of Finachub Lipa na Mpesa Checkout for WooCommerce.
*   Basic M-Pesa STK Push payment processing.
*   Custom table for basic transaction logging.
*   Static waiting page for pending payments.
*   Forced classic checkout shortcode for compatibility.

== Upgrade Notice ==

= **Stop Manual Order Updates! Upgrade to M-Pesa Pro Today!** =
Unlock automatic order updates, a full transaction dashboard, CSV exports, priority support, and more. Stop manual checks and streamline your M-Pesa payments! **[Get M-Pesa Pro Now!](https://finachub.com/product-category/plugins/mpesa/)**

== Support ==

For documentation, please visit: [Finachub M-Pesa Docs](https://finachub.com/mpesa-checkout-docs/)
For support inquiries, please visit: [Finachub Contact Page](https://finachub.com/contact-us/) or email info@finachub.com.