<?php

if (!defined('ABSPATH')) {
    exit;
}




add_action('admin_menu', 'wcmps_register_option_page');

function wcmps_register_option_page() { 
    add_menu_page('WooCommerce Maps', 'WooCommerce Maps', 'manage_options', 'plugin_settings', 'wcmps_option_page_content',"data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE5LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJMYXllcl8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCINCgkgdmlld0JveD0iMCAwIDUxMiA1MTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMiA1MTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxnPg0KCTxnPg0KCQk8cGF0aCBkPSJNMjU2LDBDMTYxLjg5NiwwLDg1LjMzMyw3Ni41NjMsODUuMzMzLDE3MC42NjdjMCwyOC4yNSw3LjA2Myw1Ni4yNiwyMC40OSw4MS4xMDRMMjQ2LjY2Nyw1MDYuNQ0KCQkJYzEuODc1LDMuMzk2LDUuNDQ4LDUuNSw5LjMzMyw1LjVzNy40NTgtMi4xMDQsOS4zMzMtNS41bDE0MC44OTYtMjU0LjgxM2MxMy4zNzUtMjQuNzYsMjAuNDM4LTUyLjc3MSwyMC40MzgtODEuMDIxDQoJCQlDNDI2LjY2Nyw3Ni41NjMsMzUwLjEwNCwwLDI1NiwweiBNMjU2LDI1NmMtNDcuMDUyLDAtODUuMzMzLTM4LjI4MS04NS4zMzMtODUuMzMzYzAtNDcuMDUyLDM4LjI4MS04NS4zMzMsODUuMzMzLTg1LjMzMw0KCQkJczg1LjMzMywzOC4yODEsODUuMzMzLDg1LjMzM0MzNDEuMzMzLDIxNy43MTksMzAzLjA1MiwyNTYsMjU2LDI1NnoiLz4NCgk8L2c+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8L3N2Zz4NCg==");
}
 

    
function wcmps_option_page_content() {
    ?>
<h2>Maps for WooCommerce</h2>
<p>Add your Google Map <strong>API Key</strong></p>
<p>for more information about how to get google map API Key click <a target="_blank" rel="noopener noreferrer"
        href="https://developers.google.com/maps/documentation/embed/get-api-key">here</a>.</p>
<form method="post" action="options.php">
    <?php
        settings_fields('plugin_settings');
      ?>
    <table>
        <tbody style="text-align:left">
            <tr>
                <th>Google Map API Key</th>
                <td>
                    <input type="text" name="api_key" id="api_key" value="<?php echo get_option('api_key');?>" required>
                </td>
            </tr>
            <tr>
                <th>Default Latitude</th>
                <td>
                    <input type="text" name="default_lat" id="default_lat"
                        value="<?php echo get_option('default_lat');?>" required>
                </td>
            </tr>
            <tr>
                <th>Default Longitude</th>
                <td>
                    <input type="text" name="default_long" id="default_long"
                        value="<?php echo get_option('default_long');?>" required>
                </td>
            </tr>
        </tbody>
    </table>
    <?php 
        submit_button();
      ?>
</form>
<?php
    }

    add_action('admin_init', 'wcmps_register_plugin_settings');
    function wcmps_register_plugin_settings() {
      register_setting('plugin_settings', 'api_key');
      register_setting('plugin_settings', 'default_lat');
      register_setting('plugin_settings', 'default_long');
    }


add_action( 'woocommerce_after_order_notes', 'wcmps_lat_checkout_field' );

function wcmps_lat_checkout_field( $checkout ) {
    woocommerce_form_field( 'billing_lat', array(
        'type'          => 'hidden',
        'class'         => array('hidden'),
        'id' => 'wcmps_lat',
        'value'=>$default_lat,
        ), $checkout->get_value( 'billing_lat' ));
}


add_action( 'woocommerce_after_order_notes', 'wcmps_long_checkout_field' );

function wcmps_long_checkout_field( $checkout ) {
    woocommerce_form_field( 'billing_long', array(
        'type'          => 'hidden',
        'class'         => array('hidden'),
        'id' => 'wcmps_long',
        'value'=>$default_long,
        ), $checkout->get_value( 'billing_long' ));
}



add_action( 'woocommerce_after_order_notes', 'wcmps_map_checkout_field' );

function wcmps_map_checkout_field( $checkout ) {
    $default_lat = get_option('default_lat');
    $default_long = get_option('default_long');
echo "<div style='width:100%;height:400px' id='googleMap'></div>";


$wcmps_params = array('lat' => $default_lat,'long'=>$default_long);
wp_enqueue_script('wc-maps-script',plugins_url( 'assets/js/main.js', __FILE__ ));
wp_localize_script ( 'wc-maps-script', 'OBJECT', $wcmps_params );
wp_enqueue_script ( 'google-maps-script',
'https://maps.googleapis.com/maps/api/js?callback=client_map_initialize&key=".get_option('.$api_key.')."' );
}


add_action( 'woocommerce_checkout_update_order_meta', 'wcmps_billing_lat_checkout_field_update_order_meta' );

function wcmps_billing_lat_checkout_field_update_order_meta( $order_id ) {
if ( ! empty( $_POST['billing_lat'] ) ) {
update_post_meta( $order_id, 'Lat', sanitize_text_field( $_POST['billing_lat'] ) );
}
}


add_action( 'woocommerce_checkout_update_order_meta', 'wcmps_billing_long_checkout_field_update_order_meta' );

function wcmps_billing_long_checkout_field_update_order_meta( $order_id ) {
if ( ! empty( $_POST['billing_long'] ) ) {
update_post_meta( $order_id, 'Long', sanitize_text_field( $_POST['billing_long'] ) );
}
}


add_action( 'woocommerce_admin_order_data_after_billing_address', 'wcmps_geo_fields_display_admin_order_meta', 10, 1 );

function wcmps_geo_fields_display_admin_order_meta($order){


$order_id = $order->get_id();
$lat = get_post_meta( $order_id, 'Lat', true );
$long = get_post_meta( $order_id, 'Long', true );

echo '<div style="width:100%;height:400px" id="googleMap"></div>';


$wcmps_params = array('lat' => $lat,'long'=>$long);
wp_enqueue_script('wc-maps-script',plugins_url( 'assets/js/main.js', __FILE__ ));
wp_localize_script ( 'wc-maps-script', 'OBJECT', $wcmps_params );
wp_enqueue_script ( 'google-maps-script',
'https://maps.googleapis.com/maps/api/js?callback=admin_map_initialize&key=".get_option('.$api_key.')."' );
}



add_action( 'woocommerce_checkout_order_review', 'wcmps_add_map', 15 );
function wcmps_add_map() {
  print '<div>
  <div id="googleMap" style="width:100%;height:400px"></div>
</div>';
}