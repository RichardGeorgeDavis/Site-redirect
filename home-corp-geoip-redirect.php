<?php
/**
Plugin Name: Home Corp GeoIP Redirect
Version: 1.0
Description: Depends on GeoIP Detection plugin and redirects based on country.
Author: Richard George Davis
Author URI: https://lucidity.design
License: GPL2
*/
function geoip_redirect_header() {
    if (is_admin()) return;
    $country = geoip_detect2_get_info_from_current_ip()->country->isoCode;
    ?>
    <script>
        var baseUrl = 'https://' + window.location.hostname + '/'
        var otherUrl = 'https://homecorp.local/'
       	var target = {
            All: baseUrl + 'south-africa/',
            // South Africa
            ZA : baseUrl + 'south-africa/',
            // Botswana
            BW : baseUrl + 'botswana/',
            // Namibia
            NA : baseUrl + 'namibia/',
            //US : otherUrl,
            //CA : otherUrl,

        }
        var country = '<?php echo $country; ?>';
        console.log('detected country: ', country);
        var targetCountry = target[country] || target.All;
        if (window.top.location.href.indexOf(targetCountry) === -1) window.top.location.href = targetCountry;
    </script>
    <?php
}
add_action('wp_head', 'geoip_redirect_header');
