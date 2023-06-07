<?php
defined('ABSPATH') or die();

require 'library/Indenter.php';

ob_start();

add_action('shutdown', function () {
    if (extension_loaded('mbstring') && html_markup_indenter_is_html() && !is_user_logged_in()) {
        $final = '';
        $levels = ob_get_level();
        for ($i = 0; $i < $levels; $i++) {
            $final = $final . ob_get_clean();
        }
        $indenter = new \Gajus\Dindent\Indenter();
        echo $indenter->indent($final);
    }
}, 0);

function html_markup_indenter_is_html() {
    foreach (headers_list() as $header) {
        if (strpos($header, "Content-Type: text/html") !== false) {
            return true;
        }
    }
    return false;
}

add_action('admin_notices', function() {
    if (!extension_loaded('mbstring')) {
        echo '<div class="notice notice-warning"><p>';
        echo __("Mbstring PHP extension is not loaded. HTML Markup Indenter has been disabled.", 'html-markup-indenter');
        echo '</p></div>';
    }
});
