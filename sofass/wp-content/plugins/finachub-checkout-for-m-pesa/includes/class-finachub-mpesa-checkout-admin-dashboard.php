<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Finachub_Mpesa_Checkout_Admin_Dashboard
 *
 * Creates the admin dashboard pages with improved UI, persuasive upsells, updated menu title,
 * and adds a warning notice if PHP mail() function is disabled. Handles notice display correctly.
 */
class Finachub_Mpesa_Checkout_Admin_Dashboard {

    /**
     * The hook suffix for the main admin menu page.
     * @var string|false
     */
    private $main_hook_suffix = false;

    /**
     * Constructor. Hooks into WordPress admin actions.
     */
    public function __construct() {
        add_action( 'admin_menu', [ $this, 'add_admin_menu' ] );
        // Note: Enqueue is now hooked specifically in add_admin_menu

        // Add the check for the mail() function notice - hooked to the standard action
        add_action( 'admin_notices', [ $this, 'check_mail_function_notice' ] );
        // Hook into a later notice action specifically for our pages to ensure correct placement
        // We will capture notices within render_admin_page instead.
    }

    /**
     * Adds the admin menu items.
     */
    public function add_admin_menu() {
        // Store the hook suffix returned by add_menu_page
        $this->main_hook_suffix = add_menu_page(
            esc_html__( 'Finachub Lipa na Mpesa Dashboard', 'finachub-checkout-for-m-pesa' ), // Browser Title / Page Title
            esc_html__( 'Lipa na Mpesa', 'finachub-checkout-for-m-pesa' ), // Menu Title (Concise)
            'manage_options', // Capability required
            'finachub_mpesa_main', // Main slug
            [ $this, 'render_dashboard' ], // Callback for the main page
            'dashicons-money-alt', // Menu Icon
            54.5 // Position (below WooCommerce)
        );
        $settings_hook = add_submenu_page(
            'finachub_mpesa_main', // Parent slug
            esc_html__( 'Lipa na Mpesa Settings Guide', 'finachub-checkout-for-m-pesa' ), // Page title
            esc_html__( 'Settings Guide', 'finachub-checkout-for-m-pesa' ), // Menu title
            'manage_options', // Capability
            'finachub_mpesa_settings', // Menu slug
            [ $this, 'render_settings_page' ] // Callback
        );
        $help_hook = add_submenu_page(
            'finachub_mpesa_main', // Parent slug
            esc_html__( 'Lipa na Mpesa Help & Upgrade', 'finachub-checkout-for-m-pesa' ), // Page title
            esc_html__( 'Help & Upgrade', 'finachub-checkout-for-m-pesa' ), // Menu title
            'manage_options', // Capability
            'finachub_mpesa_help', // Menu slug
            [ $this, 'render_help_support_page' ] // Callback
        );

        // Hook asset enqueue specific to the pages where they are needed
        add_action( 'admin_print_styles-' . $this->main_hook_suffix, [ $this, 'enqueue_dashboard_assets' ] );
        add_action( 'admin_print_styles-' . $settings_hook, [ $this, 'enqueue_dashboard_assets' ] );
        add_action( 'admin_print_styles-' . $help_hook, [ $this, 'enqueue_dashboard_assets' ] );
    }

    /**
     * Checks if mail() function exists and displays an admin notice if not.
     * This function remains hooked to 'admin_notices' to add the notice at the standard time.
     */
    public function check_mail_function_notice() {
        // Check if the mail function is disabled
        if ( function_exists( 'mail' ) ) {
            return; // Exit if mail() exists
        }

        // Determine if we are on a screen where this notice is relevant.
        // We don't want this specific notice showing on *every* admin page.
        $show_notice = false;
        $screen = get_current_screen();

        if ( ! $screen ) {
            return; // Cannot determine screen
        }

        // Check if on the plugin's admin pages
        $plugin_page_bases = [
            $this->main_hook_suffix, // Toplevel page
            'lipa-na-mpesa_page_finachub_mpesa_settings', // Submenu page (check generated hook)
            'lipa-na-mpesa_page_finachub_mpesa_help'      // Submenu page (check generated hook)
        ];
         // Adjust submenu page IDs if necessary based on how WP generates them (may depend on menu title)
         $settings_hook = get_plugin_page_hookname('finachub_mpesa_settings', 'finachub_mpesa_main');
         $help_hook = get_plugin_page_hookname('finachub_mpesa_help', 'finachub_mpesa_main');
         if ($settings_hook) $plugin_page_bases[] = $settings_hook;
         if ($help_hook) $plugin_page_bases[] = $help_hook;
         $plugin_page_bases = array_unique($plugin_page_bases); // Ensure no duplicates

         if ( in_array( $screen->id, $plugin_page_bases, true ) ) {
             $show_notice = true;
         }

        // Check if on the WooCommerce Payment Settings page, specifically the M-Pesa section
        if ( $screen->id === 'woocommerce_page_wc-settings' && isset( $_GET['tab'] ) && $_GET['tab'] === 'checkout' ) {
            // Show on the main checkout tab or specifically if our section is selected
             if ( ! isset( $_GET['section'] ) || ( isset( $_GET['section'] ) && $_GET['section'] === 'finachub_mpesa_checkout' ) ) {
                 $show_notice = true;
             }
        }

        // Only add the notice content if we are on a relevant screen
        if ( $show_notice ) {
            $smtp_plugin_url = esc_url( admin_url( 'plugin-install.php?s=smtp&tab=search&type=term' ) );
            $message = sprintf(
                /* translators: 1: Opening strong tag, 2: Closing strong tag, 3: Opening link tag to SMTP search, 4: Closing link tag */
                esc_html__( '%1$sWarning:%2$s The PHP mail() function is disabled on your server. Finachub M-Pesa Checkout (and WooCommerce) relies on email functionality. This may cause errors during checkout completion or settings changes. Please install and configure an %3$sSMTP plugin%4$s to ensure emails are sent correctly.', 'finachub-checkout-for-m-pesa' ),
                '<strong>',
                '</strong>',
                '<a href="' . $smtp_plugin_url . '" target="_blank">',
                '</a>'
            );

            // Use a unique key if adding notices programmatically within hooks that might fire multiple times,
            // although admin_notices usually fires once per screen load.
            // WC_Admin_Notices::add_custom_notice( 'finachub_mail_disabled', '<p>' . wp_kses_post( $message ) . '</p>' ); // Alternative using WC way

             // Standard WP way:
             ?>
             <div class="notice notice-warning is-dismissible finachub-mail-notice">
                 <p><?php echo wp_kses_post( $message ); ?></p>
             </div>
             <?php
        }
    }


    /**
     * Enqueues admin dashboard assets (CSS & JS).
     * Hooked specifically to the plugin's admin pages.
     */
    public function enqueue_dashboard_assets() {
        // Assets are now enqueued only on the specific pages via hooks in add_admin_menu
        // No need for screen check here anymore unless providing assets for WC settings page too.

        // Enqueue Jost font
        wp_enqueue_style(
            'finachub_mpesa_jost_font_admin',
            'https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600;700&display=swap',
            [],
            '1.0' // Font version
        );

        // Enqueue jQuery UI CSS (if needed)
        wp_enqueue_style(
            'finachub_mpesa_jquery_ui',
            FINACHUB_MPESA_PLUGIN_URL . 'assets/css/vendor/jquery-ui.css',
            [],
            '1.13.2'
        );

        // Enqueue the dedicated admin styles
        wp_enqueue_style(
            'finachub_mpesa_admin_styles',
            FINACHUB_MPESA_PLUGIN_URL . 'assets/css/admin-styles.css',
            [ 'dashicons', 'finachub_mpesa_jost_font_admin', 'finachub_mpesa_jquery_ui' ],
            FINACHUB_MPESA_VERSION
        );
    }


    /**
     * Renders the common admin page structure (header, content wrapper, footer).
     * Captures and displays admin notices *before* the custom wrapper.
     *
     * @param string $title      The title of the page.
     * @param string $content    The HTML content specific to the page being rendered.
     * @param string $page_class Optional CSS class for the main wrap div.
     */
    private function render_admin_page( $title, $content, $page_class = '' ) {

        // --- Start Output Buffering to Capture Notices ---
        ob_start();
        // Trigger the action hook where notices are usually displayed.
        // 'all_admin_notices' runs after specific screen notices and general 'admin_notices'.
        do_action( 'all_admin_notices' );
        // Get the captured notices content
        $admin_notices = ob_get_clean();
        // --- End Output Buffering ---

        ?>
        <div class="wrap"> <?php // Use standard WP wrap for notices, then our custom one inside ?>
            <?php
            // --- Print Captured Admin Notices Here ---
            // This ensures notices appear *above* our custom header/wrapper.
            echo $admin_notices;
            ?>

            <?php // --- Start Custom Plugin Wrapper --- ?>
            <div class="finachub-admin-wrap <?php echo esc_attr( $page_class ); ?>">
                 <div class="finachub-admin-header">
                     <img src="<?php echo esc_url( FINACHUB_MPESA_PLUGIN_URL . 'assets/img/mpesa-logo.png' ); ?>" alt="M-Pesa Logo" class="finachub-header-logo">
                     <h1><?php echo esc_html( $title ); ?></h1>
                     <span class="finachub-version-tag"><?php esc_html_e( 'Free Version', 'finachub-checkout-for-m-pesa' ); ?></span>
                 </div>
                <div class="finachub-admin-content">
                    <?php echo wp_kses_post( $content ); // Output the specific page content passed in ?>
                </div>
                 <div class="finachub-admin-footer">
                     <?php printf(
                         /* translators: 1: Opening anchor tag for Pro upgrade, 2: Closing anchor tag */
                         esc_html__( 'Thank you for using Finachub M-Pesa Checkout. %1$sUpgrade to Pro%2$s for the full experience!', 'finachub-checkout-for-m-pesa' ),
                         '<a href="' . esc_url('https://finachub.com/product-category/plugins/mpesa/') . '" target="_blank" rel="noopener noreferrer">', // Updated Purchase URL
                         '</a>'
                     ); ?>
                 </div>
            </div> <?php // --- End Custom Plugin Wrapper --- ?>

        </div> <?php // --- End Standard WP Wrap --- ?>
        <?php
    }


    /**
     * Renders the main dashboard page, focusing on the Pro upsell.
     */
     public function render_dashboard() {
        ob_start();
        // ... (rest of dashboard content remains the same) ...
        ?>
        <div class="finachub-card finachub-promo-card dashboard-promo">
            <span class="finachub-promo-icon dashicons dashicons-dashboard"></span>
            <h2><?php esc_html_e( 'Unlock Full M-Pesa Automation & Insights with Pro!', 'finachub-checkout-for-m-pesa' ); ?></h2>
            <p class="subtitle"><?php esc_html_e( 'You\'re using the Free version with basic STK Push. Upgrade to Pro for automatic order updates, detailed analytics, and more.', 'finachub-checkout-for-m-pesa' ); ?></p>

            <div class="feature-comparison-grid">
                <div class="feature-card free-card">
                    <h3><span class="dashicons dashicons-lock"></span> <?php esc_html_e( 'Free Version Limitations', 'finachub-checkout-for-m-pesa' ); ?></h3>
                    <ul class="feature-list">
                        <li><span class="feature-icon dashicons dashicons-minus"></span> <?php esc_html_e( 'Manual Order Updates', 'finachub-checkout-for-m-pesa' ); ?></li>
                        <li><span class="feature-icon dashicons dashicons-minus"></span> <?php esc_html_e( 'No Callback Processing', 'finachub-checkout-for-m-pesa' ); ?></li>
                        <li><span class="feature-icon dashicons dashicons-minus"></span> <?php esc_html_e( 'No Admin Transaction Dashboard', 'finachub-checkout-for-m-pesa' ); ?></li>
                        <li><span class="feature-icon dashicons dashicons-minus"></span> <?php esc_html_e( 'No Data Export (CSV)', 'finachub-checkout-for-m-pesa' ); ?></li>
                        <li><span class="feature-icon dashicons dashicons-minus"></span> <?php esc_html_e( 'Basic Support', 'finachub-checkout-for-m-pesa' ); ?></li>
                    </ul>
                </div>
                <div class="feature-card pro-card">
                    <h3><span class="dashicons dashicons-unlock"></span> <?php esc_html_e( 'Key M-Pesa Pro Advantages', 'finachub-checkout-for-m-pesa' ); ?></h3>
                    <ul class="feature-list">
                        <li><span class="feature-icon dashicons dashicons-yes-alt"></span> <strong><?php esc_html_e( 'Auto Order Completion:', 'finachub-checkout-for-m-pesa' ); ?></strong> <?php esc_html_e( 'Process callbacks automatically.', 'finachub-checkout-for-m-pesa' ); ?></li>
                        <li><span class="feature-icon dashicons dashicons-yes-alt"></span> <strong><?php esc_html_e( 'Live Dashboard:', 'finachub-checkout-for-m-pesa' ); ?></strong> <?php esc_html_e( 'View & search transactions.', 'finachub-checkout-for-m-pesa' ); ?></li>
                        <li><span class="feature-icon dashicons dashicons-yes-alt"></span> <strong><?php esc_html_e( 'CSV Export:', 'finachub-checkout-for-m-pesa' ); ?></strong> <?php esc_html_e( 'Easy accounting & analysis.', 'finachub-checkout-for-m-pesa' ); ?></li>
                        <li><span class="feature-icon dashicons dashicons-yes-alt"></span> <strong><?php esc_html_e( 'Customization:', 'finachub-checkout-for-m-pesa' ); ?></strong> <?php esc_html_e( 'More waiting page options.', 'finachub-checkout-for-m-pesa' ); ?></li>
                        <li><span class="feature-icon dashicons dashicons-yes-alt"></span> <strong><?php esc_html_e( 'Priority Support:', 'finachub-checkout-for-m-pesa' ); ?></strong> <?php esc_html_e( 'Get faster help.', 'finachub-checkout-for-m-pesa' ); ?></li>
                    </ul>
                </div>
            </div>

            <div class="finachub-cta-section">
                <p class="cta-lead"><?php esc_html_e( 'Stop wasting time on manual checks! Automate your M-Pesa workflow today.', 'finachub-checkout-for-m-pesa' ); ?></p>
                <a href="<?php echo esc_url( 'https://finachub.com/product-category/plugins/mpesa/' ); ?>" target="_blank" class="finachub-cta-button primary"> <?php // Updated Purchase URL ?>
                    <span class="dashicons dashicons-star-filled"></span> <?php esc_html_e( 'Upgrade to Pro & Unlock All Features!', 'finachub-checkout-for-m-pesa' ); ?>
                </a>
                 <p class="discount-note"><?php esc_html_e( 'Limited-time upgrade discount may be available!', 'finachub-checkout-for-m-pesa' ); ?></p>
            </div>
        </div>
        <?php
        $content = ob_get_clean();
        $this->render_admin_page( esc_html__( 'Lipa na Mpesa Dashboard', 'finachub-checkout-for-m-pesa' ), $content, 'finachub-dashboard-page' );
    }

    /**
     * Renders the settings guide page with improved clarity and style.
     */
    public function render_settings_page() {
        ob_start();
        // ... (rest of settings page content remains the same) ...
         $wc_settings_url = admin_url( 'admin.php?page=wc-settings&tab=checkout§ion=finachub_mpesa_checkout' ); // Direct link to section
        ?>
        <p class="intro-text"><?php esc_html_e( 'Follow these simple steps to configure the M-Pesa payment gateway.', 'finachub-checkout-for-m-pesa' ); ?></p>

        <div class="finachub-card settings-guide-card">
             <h3><span class="dashicons dashicons-admin-settings"></span> <?php esc_html_e( 'Configuration Steps', 'finachub-checkout-for-m-pesa' ); ?></h3>

            <ol class="settings-steps-list modern-steps">
                 <li class="step-item">
                     <div class="step-content">
                         <h4><?php esc_html_e( 'Go to M-Pesa Payment Settings', 'finachub-checkout-for-m-pesa' ); ?></h4>
                         <?php /* Updated Text: Guides user to find M-Pesa on the linked page */ ?>
                         <p><?php printf( /* translators: %1$s opening <strong> tag, %2$s closing </strong> tag, %3$s opening <a> tag for direct link, %4$s closing </a> tag */ esc_html__( 'Navigate to %1$sWooCommerce → Settings → Payments%2$s and click "Manage" next to M-Pesa, or %3$sgo directly to the M-Pesa settings%4$s.', 'finachub-checkout-for-m-pesa' ), '<strong>', '</strong>', '<a href="'.esc_url($wc_settings_url).'" target="_blank">', '</a>' ); ?></p>
                     </div>
                 </li>

                 <li class="step-item">
                     <div class="step-content">
                         <h4><?php esc_html_e( 'Enable the Gateway', 'finachub-checkout-for-m-pesa' ); ?></h4>
                         <p><?php esc_html_e( 'At the top of the M-Pesa settings page, make sure the checkbox for "Enable M-Pesa Payment" is ticked.', 'finachub-checkout-for-m-pesa' ); ?></p>
                     </div>
                 </li>

                 <li class="step-item">
                     <div class="step-content">
                         <h4><?php esc_html_e( 'Enter API Credentials', 'finachub-checkout-for-m-pesa' ); ?></h4>
                         <p><?php esc_html_e( 'Carefully fill in the following fields obtained from your app on the Safaricom Developer Portal.', 'finachub-checkout-for-m-pesa' ); ?></p>

                         <div class="credentials-group">
                             <div class="credential-item">
                                 <span class="dashicons dashicons-admin-network credential-icon"></span>
                                 <div class="credential-details">
                                     <strong><?php esc_html_e( 'Consumer Key & Consumer Secret', 'finachub-checkout-for-m-pesa' ); ?></strong>
                                     <p><?php esc_html_e( 'Unique keys identifying your application. Keep the Secret confidential.', 'finachub-checkout-for-m-pesa' ); ?></p>
                                 </div>
                             </div>
                             <div class="credential-item credential-pair">
                                <span class="dashicons dashicons-nametag credential-icon"></span>
                                <div class="credential-details">
                                    <strong><?php esc_html_e( 'Short Code', 'finachub-checkout-for-m-pesa' ); ?></strong>
                                    <p><?php esc_html_e( 'Your M-Pesa PayBill or Till Number.', 'finachub-checkout-for-m-pesa' ); ?></p>
                                    <div class="env-values">
                                        <div class="env-sandbox"><span class="env-label"><?php esc_html_e( 'Sandbox (Testing):', 'finachub-checkout-for-m-pesa' ); ?></span> Use <code>174379</code></div>
                                        <div class="env-live"><span class="env-label"><?php esc_html_e( 'Live (Real Payments):', 'finachub-checkout-for-m-pesa' ); ?></span> <?php esc_html_e( 'Enter your official Short Code.', 'finachub-checkout-for-m-pesa' ); ?></div>
                                    </div>
                                </div>
                             </div>
                             <div class="credential-item credential-pair">
                                 <span class="dashicons dashicons-lock credential-icon"></span>
                                 <div class="credential-details">
                                     <strong><?php esc_html_e( 'Passkey', 'finachub-checkout-for-m-pesa' ); ?></strong>
                                     <p><?php esc_html_e( 'The Lipa Na M-Pesa Online Passkey associated with your Short Code.', 'finachub-checkout-for-m-pesa' ); ?></p>
                                     <div class="env-values">
                                         <div class="env-sandbox"><span class="env-label"><?php esc_html_e( 'Sandbox (Testing):', 'finachub-checkout-for-m-pesa' ); ?></span> Use <code>bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919</code></div>
                                         <div class="env-live"><span class="env-label"><?php esc_html_e( 'Live (Real Payments):', 'finachub-checkout-for-m-pesa' ); ?></span> <?php esc_html_e( 'Enter your official Passkey.', 'finachub-checkout-for-m-pesa' ); ?></div>
                                     </div>
                                 </div>
                             </div>
                             <div class="credential-item credential-pair">
                                 <span class="dashicons dashicons-admin-generic credential-icon"></span>
                                 <div class="credential-details">
                                     <strong><?php esc_html_e( 'Environment Setting', 'finachub-checkout-for-m-pesa' ); ?></strong>
                                     <p><?php esc_html_e( 'Select the mode matching the credentials you entered above.', 'finachub-checkout-for-m-pesa' ); ?></p>
                                     <div class="env-values">
                                         <div class="env-sandbox"><span class="env-label"><?php esc_html_e( 'Using Sandbox Keys:', 'finachub-checkout-for-m-pesa' ); ?></span> Select <strong>Sandbox</strong> in the dropdown.</div>
                                         <div class="env-live"><span class="env-label"><?php esc_html_e( 'Using Live Keys:', 'finachub-checkout-for-m-pesa' ); ?></span> Select <strong>Live</strong> in the dropdown.</div>
                                     </div>
                                     <p class="important-note"><span class="dashicons dashicons-warning"></span> <?php esc_html_e( 'Crucial: This setting MUST match the type of credentials (Sandbox or Live) you entered!', 'finachub-checkout-for-m-pesa' ); ?></p>
                                 </div>
                             </div>
                         </div>
                         <div class="settings-tip-box inline-tip">
                             <span class="dashicons dashicons-info-outline"></span>
                             <p><?php printf( /* translators: %1$s and %2$s are opening/closing anchor tags for Safaricom Dev Portal */ esc_html__( 'Can\'t find your credentials? Get them from the %1$sSafaricom Developer Portal%2$s.', 'finachub-checkout-for-m-pesa' ), '<a href="https://developer.safaricom.co.ke/getting-started/sandbox-credentials" target="_blank" rel="noopener noreferrer">', '</a>' ); ?></p>
                         </div>
                     </div>
                 </li>

                 <li class="step-item">
                     <div class="step-content">
                         <h4><?php esc_html_e( 'Verify Callback URL', 'finachub-checkout-for-m-pesa' ); ?></h4>
                         <p><?php esc_html_e( 'The plugin automatically suggests a Callback URL. Ensure it starts with HTTPS.', 'finachub-checkout-for-m-pesa' ); ?></p>
                         <p><small><em><?php esc_html_e( 'Note: Automatic order updates using this URL require the Pro version. In the free version, this URL is registered but payment confirmations sent here are not processed.', 'finachub-checkout-for-m-pesa' ); ?></em></small></p>
                     </div>
                 </li>

                 <li class="step-item">
                     <div class="step-content">
                         <h4><?php esc_html_e( 'Save Settings', 'finachub-checkout-for-m-pesa' ); ?></h4>
                         <p><?php esc_html_e( 'Scroll down to the bottom of the page and click the "Save changes" button.', 'finachub-checkout-for-m-pesa' ); ?></p>
                     </div>
                 </li>
            </ol>
        </div>


        <div class="finachub-card finachub-promo-card settings-promo">
             <span class="finachub-promo-icon small dashicons dashicons-update-alt"></span>
            <h4><?php esc_html_e( 'Tired of Manual Order Updates?', 'finachub-checkout-for-m-pesa' ); ?></h4>
            <p><?php esc_html_e( 'Upgrade to M-Pesa Pro! It processes payment confirmations automatically via the Callback URL, instantly updating order statuses. Save time and ensure accuracy!', 'finachub-checkout-for-m-pesa' ); ?></p>
            <a href="<?php echo esc_url( 'https://finachub.com/product-category/plugins/mpesa/' ); ?>" target="_blank" class="finachub-cta-button secondary small"> <?php // Updated Purchase URL ?>
                 <?php esc_html_e( 'Learn about Pro Auto-Updates', 'finachub-checkout-for-m-pesa' ); ?> <span class="dashicons dashicons-arrow-right-alt"></span>
            </a>
        </div>

        <p class="support-link-centered"><?php printf( /* translators: %1$s/%2$s opening/closing contact link, %3$s/%4$s opening/closing docs link */ esc_html__( 'Need more help? Visit our %1$sContact Page%2$s or read the %3$sFull Documentation%4$s.', 'finachub-checkout-for-m-pesa' ),
                 '<a href="' . esc_url( 'https://finachub.com/contact-us/' ) . '" target="_blank" rel="noopener noreferrer">', // Updated Contact URL
                 '</a>',
                 '<a href="' . esc_url( 'https://finachub.com/mpesa-checkout-docs/' ) . '" target="_blank" rel="noopener noreferrer">', // Updated Docs URL
                 '</a>' ); ?></p>

        <?php
        $content = ob_get_clean();
        $this->render_admin_page( esc_html__( 'Lipa na Mpesa - Settings Guide', 'finachub-checkout-for-m-pesa' ), $content, 'finachub-settings-page' );
    }


    /**
     * Renders the help and support/upgrade page.
     */
     public function render_help_support_page() {
        ob_start();
         // ... (rest of help page content remains the same) ...
       ?>
        <p class="intro-text"><?php esc_html_e( 'Find quick solutions, get support, or explore the powerful features available in M-Pesa Pro.', 'finachub-checkout-for-m-pesa' ); ?></p>

        <div class="help-support-grid">
            <div class="finachub-card help-column troubleshooting-card">
                <h3><span class="dashicons dashicons-sos"></span> <?php esc_html_e( 'Common Issues & Support', 'finachub-checkout-for-m-pesa' ); ?></h3>
                <ul class="troubleshooting-list">
                    <li><span class="dashicons dashicons-warning"></span><strong><?php esc_html_e( 'STK Push Not Received?', 'finachub-checkout-for-m-pesa' ); ?></strong> <?php esc_html_e( 'Check: 1) Correct API keys/Shortcode/Passkey entered. 2) "Environment" setting matches keys (Sandbox/Live). 3) Customer phone format starts 07/01 (plugin converts to 254). 4) Your site uses HTTPS.', 'finachub-checkout-for-m-pesa' ); ?></li>
                    <li><span class="dashicons dashicons-warning"></span><strong><?php esc_html_e( 'Orders Stuck "On Hold"?', 'finachub-checkout-for-m-pesa' ); ?></strong> <?php esc_html_e( 'Expected in Free version. Payment happens, but the plugin doesn\'t auto-update status. Manually verify payment via M-Pesa statement/portal & update order in WC. Pro version automates this.', 'finachub-checkout-for-m-pesa' ); ?></li>
                    <li><span class="dashicons dashicons-warning"></span><strong><?php esc_html_e( 'Checkout Error Message?', 'finachub-checkout-for-m-pesa' ); ?></strong> <?php esc_html_e( 'Often caused by PHP mail() function being disabled on your server (check for fatal errors in logs). Install and configure an SMTP plugin. Also, enable WordPress debugging (WP_DEBUG) and check WooCommerce logs (WooCommerce > Status > Logs > select "finachub-mpesa") for specific API error messages from Safaricom.', 'finachub-checkout-for-m-pesa' ); ?></li>
                     <li><span class="dashicons dashicons-lock"></span><strong><?php esc_html_e( 'HTTPS Required?', 'finachub-checkout-for-m-pesa' ); ?></strong> <?php esc_html_e( 'Yes, your entire website must be served over HTTPS for secure API communication.', 'finachub-checkout-for-m-pesa' ); ?></li>
                     <li><span class="dashicons dashicons-email-alt"></span><strong><?php esc_html_e( 'Need Support?', 'finachub-checkout-for-m-pesa' ); ?></strong> <?php printf( /* translators: %1$s opening <a> tag for contact page, %2$s closing </a> tag, %3$s opening mailto link, %4$s closing </a> tag */ esc_html__( 'Visit our %1$sContact Page%2$s or email us directly at %3$sinfo@finachub.com%4$s.', 'finachub-checkout-for-m-pesa' ), '<a href="'.esc_url('https://finachub.com/contact-us/').'" target="_blank" rel="noopener noreferrer">', '</a>', '<a href="mailto:info@finachub.com">', '</a>' ); // Updated Contact URL & Email ?></li>
                </ul>
                 <p class="doc-link"><a href="<?php echo esc_url( 'https://finachub.com/mpesa-checkout-docs/' ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Read the Full Documentation', 'finachub-checkout-for-m-pesa' ); ?> <span class="dashicons dashicons-external"></span></a></p> <?php // Updated Docs URL ?>
            </div>

            <div class="finachub-card help-column finachub-promo-card upgrade-card">
                 <h3><span class="dashicons dashicons-awards"></span> <?php esc_html_e( 'Why Upgrade to M-Pesa Pro?', 'finachub-checkout-for-m-pesa' ); ?></h3>
                 <p class="promo-lead"><strong><?php esc_html_e( 'Enhance efficiency, gain insights, and provide a smoother customer experience!', 'finachub-checkout-for-m-pesa' ); ?></strong></p>
                 <ul class="pro-benefits-list">
                    <li><span class="dashicons dashicons-update-alt"></span> <?php esc_html_e( 'Automatic Order Completion (via Callbacks)', 'finachub-checkout-for-m-pesa' ); ?></li>
                    <li><span class="dashicons dashicons-dashboard"></span> <?php esc_html_e( 'Detailed Transaction Dashboard & Analytics', 'finachub-checkout-for-m-pesa' ); ?></li>
                    <li><span class="dashicons dashicons-search"></span> <?php esc_html_e( 'Advanced Transaction Search & Filtering', 'finachub-checkout-for-m-pesa' ); ?></li>
                    <li><span class="dashicons dashicons-download"></span> <?php esc_html_e( 'Easy Accounting with CSV Data Exports', 'finachub-checkout-for-m-pesa' ); ?></li>
                    <li><span class="dashicons dashicons-admin-customizer"></span> <?php esc_html_e( 'Customizable Waiting Page Options', 'finachub-checkout-for-m-pesa' ); ?></li>
                    <li><span class="dashicons dashicons-sos"></span> <?php esc_html_e( 'Priority Email Support', 'finachub-checkout-for-m-pesa' ); ?></li>
                    <li><span class="dashicons dashicons-admin-plugins"></span> <?php esc_html_e( 'Regular Updates & New Features', 'finachub-checkout-for-m-pesa' ); ?></li>
                 </ul>
                 <div class="finachub-cta-section mini-cta">
                     <a href="<?php echo esc_url( 'https://finachub.com/product-category/plugins/mpesa/' ); ?>" target="_blank" class="finachub-cta-button primary small"> <?php // Updated Purchase URL ?>
                         <?php esc_html_e( 'See Pro Features & Pricing', 'finachub-checkout-for-m-pesa' ); ?> <span class="dashicons dashicons-arrow-right-alt"></span>
                     </a>
                 </div>
            </div>
        </div>
        <?php
        $content = ob_get_clean();
        $this->render_admin_page( esc_html__( 'Lipa na Mpesa - Help & Upgrade', 'finachub-checkout-for-m-pesa' ), $content, 'finachub-help-page' );
    }

} // End Class