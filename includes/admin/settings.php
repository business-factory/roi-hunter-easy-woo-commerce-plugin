<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( class_exists( 'WC_Settings_RH_Easy_New', false ) ) {
	return new WC_Settings_RH_Easy_New();
}

/**
 * WC_Settings_RH_Easy_New.
 */
class WC_Settings_RH_Easy_New {

	/**
	 * Constructor.
	 */
	public function __construct() {
        // Hook into the admin menu
        add_action( 'admin_menu', array( $this, 'settings_page' ) );
    }
    
    public function settings_page() {
        // Add the menu item and page
        $page_title =  __( 'ROI Hunter Easy', 'roi-hunter-easy' );
        $menu_title =  __( 'ROI Hunter Easy', 'roi-hunter-easy' );
        $capability = 'manage_options';
        $slug = 'roi-hunter-easy';
        $callback = array( $this, 'settings_page_content' );
        $icon = 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI1MTIiIGhlaWdodD0iNTEyIj4gIDxnIGZpbGw9IiNlZWUiPiAgICA8cGF0aCBkPSJNMzAzLjA1NiAxODcuMzA2YTMzLjUyNiAzMy41MjYgMCAwIDAtMTMuMDQ0LTEzLjIzNyA2MS43MTUgNjEuNzE1IDAgMCAwLTIwLjIxOS02Ljk5OGgtLjAxNmExNDguNTMyIDE0OC41MzIgMCAwIDAtMjUuNjg1LTIuMDY0Yy0xMC4wNCAwLTE5LjM1OS4zNzYtMjcuOTU4IDEuMTI4djg0LjY0OGgyMC43NjdjMTAuMjQzLjA5MSAyMC40OC0uNTQgMzAuNjM1LTEuODg3YTYzLjk3MiA2My45NzIgMCAwIDAgMjIuMTA1LTYuODA0IDMyLjk2NCAzMi45NjQgMCAwIDAgMTMuNDE0LTEzLjIzN2MzLjAyMS01LjUwNCA0LjUzMS0xMi41NTUgNC41MzEtMjEuMTU0YTQyLjA2IDQyLjA2IDAgMCAwLTQuNTMtMjAuMzk1eiIvPiAgICA8cGF0aCBkPSJNNDQwLjcwMSA3MS4zMTRsLTI1LjEwNyAyNS4xMDdDMzIwLjc1OCA0LjA2OCAxNjkuMzY3IDQuMzgyIDc0LjkzIDk3LjM4NmMtOTUuODAzIDk0LjM0OS05Ni45ODEgMjQ4LjQ5Ny0yLjYzMiAzNDQuM2wyNS4wODQtMjUuMDg0Yzk1LjE1NyA5NC4wOTYgMjQ4LjU2OCA5My43OCAzNDMuMzE5LS45NzEgOTUuMDgxLTk1LjA4MSA5NS4wODEtMjQ5LjIzNiAwLTM0NC4zMTd6TTMyMC4wNjcgMzg4LjM1YTU0OS4zNTEgNTQ5LjM1MSAwIDAgMC0xNS40OTUtMjcuNDEgODkxLjU0NSA4OTEuNTQ1IDAgMCAwLTE2LjgxNi0yNi44M2MtNS42NTQtOC43MDYtMTEuMjYtMTYuODk2LTE2LjgxNi0yNC41NzEtNS41NTgtNy42NzUtMTAuNzIzLTE0LjUzOC0xNS40OTUtMjAuNTktMy41MzEuMjQxLTYuNTYzLjM4Ny05LjA3Ny4zODdoLTMwLjI5NnY5OC45OThoLTQ3LjYyOVYxMzAuMjQ1YTI1NS45OTkgMjU1Ljk5OSAwIDAgMSAzNy4wODQtNS4wOTVsLS4wNDktLjAxN2MxMy4xMDQtLjg5MiAyNC44MTktMS4zMzggMzUuMTQ5LTEuMzM4IDM3Ljc4Mi4wMTEgNjYuNjkxIDYuOTQ0IDg2LjcyOCAyMC43OTkgMjAuMDM2IDEzLjg1NSAzMC4wNTUgMzUuMDE1IDMwLjA1NSA2My40NzgtLjAxMSAzNS41MjUtMTcuNTIxIDU5LjU5My01Mi41MyA3Mi4yIDQuNzk0IDUuNzUxIDEwLjIxMSAxMi44MDMgMTYuMjUyIDIxLjE1NHMxMi4yMTEgMTcuMzY1IDE4LjUxIDI3LjAzOWE1ODQuOTYyIDU4NC45NjIgMCAwIDEgMTguMTM5IDI5Ljg0NWM1Ljc5NCAxMC4yIDEwLjk1OSAyMC4yMTQgMTUuNDk1IDMwLjAzOGgtNTMuMjA5eiIvPiAgPC9nPjwvc3ZnPg==';
        $position = 100;
    
        add_menu_page( $page_title, $menu_title, $capability, $slug, $callback, $icon, $position );                     
    }

    public function settings_page_content() {
        
        $location = wc_get_base_location();
        $language = substr( get_bloginfo ( 'language' ), 0, 2 );
        $helper = new RH_Easy_Helper();

        // Check if WooCommerce REST API enabled and if user exists
        $helper->check_woocommerce_rest_api();

        $iframe = apply_filters( 'roi_hunter_easy_iframe_attributes', array(
            'type' => 'rh-easy-woo-commerce-initial-message',
            'storeUrl' => get_bloginfo('url'), // Public url of store homepage
            'previewUrl' => get_bloginfo('url') . '/wp-json/wc/v2/products/', // Url of API for product previews
            'rhStateApiBaseUrl' => get_bloginfo('url') . '/wp-json/roi-hunter-easy/v1',
            'storeName' => get_bloginfo('name'), // Name of the store
            'storeCurrency' => get_option('woocommerce_currency'), // Primary currency of the store
            'storeLanguage' => $language, // Primary language of the store
            'storeCountry' => $location['country'], // Primary target country of the store
            'pluginVersion' => RH_EASY_VERSION,
            'activeBeProfile' => 'production', // Active application profile (production, staging, dev)
            'customerId' => $helper->get_option( 'customer_id' ), // RH Easy customer ID
            'accessToken' => $helper->get_option( 'access_token' ), // RH Easy access token
            'clientToken' => $helper->get_option( 'clientToken' ), // Client token for authentication in store API (eg. https://my-woo-store.com/wp-json/roihuntereasy/state)
            'wooCommerceApiUrl' => get_bloginfo('url') . '/wp-json/wc/v2/',
            'wooCommerceApiKey' => $helper->get_option('cust_key'),
            'wooCommerceApiSecret' => $helper->get_option('cust_secret'),
        ));        

        //rhe_debug( $iframe );
        
        ?>
        <script type="application/javascript">
            function iFrameLoad() {
    

                // pass base url to React iframe fro future API calls to this site
                var iFrame = document.getElementById('RoiHunterEasyIFrame');
                iFrame.contentWindow.postMessage(<?php echo json_encode($iframe, JSON_PRETTY_PRINT); ?>, '*'
                ); 
        
                // Create IE + others compatible event handler
                var eventMethod = window.addEventListener ? "addEventListener" : "attachEvent";
                var eventer = window[eventMethod];
                var messageEvent = eventMethod == "attachEvent" ? "onmessage" : "message";
        
                // Listen to message from child window
                eventer(messageEvent, function (e) {
                    if (e.data.type === "roihunter_magento_plugin_height") {
        //            Change size of iFrame to correspond new height of content
                    console.log("new height: " + e.data.height);
                        document.getElementById('RoiHunterEasyIFrame').style.height = e.data.height + 'px';
                    } else if (e.data.type === "roihunter_location") {
                        window.top.location = e.data.location;
                    } else {
                    console.log("Unknown message event", e);
                    }
                }, false);
            }
        </script>
        <iframe src="https://goostav-fe-staging.roihunter.com/" id="RoiHunterEasyIFrame" scrolling="yes" frameBorder="0" allowfullscreen="true" align="center" onload="iFrameLoad()" style="width: 100%; min-height: 500px"><p><?php _e('Your browser does not support iFrames.', 'roi-hunter-easy'); ?></p></iframe>


        <?php 
    }

}

return new WC_Settings_RH_Easy_New();