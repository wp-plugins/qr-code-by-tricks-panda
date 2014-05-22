<?php
/*
Plugin Name: Generate QR Code
Plugin URI: http://www.trickspanda.com
Description: Add QR codes to your WordPress with shortcodes.
Version: 1.0
Author: Hardeep Asrani
Author URI: http://www.hardeepasrani.com
*/

add_action('init','qrcode_init');

function qrcode_init() {
    wp_enqueue_script( 'qrcode-js', plugins_url( '/qrcode.js', __FILE__ ));
}

function qrcode( $atts, $content = null ) {
    return '<div id="qrcode"></div>
<script type="text/javascript">
new QRCode(document.getElementById("qrcode"), "'.$content.'");
</script>';
}

add_shortcode("qrcode", "qrcode"); 

add_action('init', 'tpqrcode_shortcode_button_init');
 function tpqrcode_shortcode_button_init() {

      //Abort early if the user will never see TinyMCE
      if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') && get_user_option('rich_editing') == 'true')
           return;

      //Add a callback to regiser our tinymce plugin   
      add_filter("mce_external_plugins", "tpqrcode_register_tinymce_plugin"); 

      // Add a callback to add our button to the TinyMCE toolbar
      add_filter('mce_buttons', 'tpqrcode_add_tinymce_button');
}


//This callback registers our plug-in
function tpqrcode_register_tinymce_plugin($plugin_array) {
    $plugin_array['tpqrcode_button'] = $dir = plugins_url( 'shortcode.js', __FILE__ );
    return $plugin_array;
}

//This callback adds our button to the toolbar
function tpqrcode_add_tinymce_button($buttons) {
            //Add the button ID to the $button array
    $buttons[] = "tpqrcode_button";
    return $buttons;
}

?>