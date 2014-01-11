jQuery(document).ready(function($) {

    tinymce.create('tinymce.plugins.tpqrcode_plugin', {
        init : function(ed, url) {
                // Register command for when button is clicked
                ed.addCommand('tpqrcode_insert_shortcode', function() {
                    var link = prompt("Link/Text"),
                shortcode;
                if (link !== null) {
                    shortcode = '[qrcode]' + link + '[/qrcode]';
                    ed.execCommand('mceInsertContent', 0, shortcode);
                }
                });

            // Register buttons - trigger above command when clicked
            ed.addButton('tpqrcode_button', {title : 'Insert QR Code', cmd : 'tpqrcode_insert_shortcode', image: url + '/qrcode.png' });
        },   
    });

    // Register our TinyMCE plugin
    // first parameter is the button ID1
    // second parameter must match the first parameter of the tinymce.create() function above
    tinymce.PluginManager.add('tpqrcode_button', tinymce.plugins.tpqrcode_plugin);
});