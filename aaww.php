<?php
/*
Plugin Name: WT Analytics
Plugin URI:  https://webtrends.com
Description: Add the Webtrends hosted tag to your website. Allows for basic set-up and some configuration.
Version:     1.0
Author:      Jarrad Hill
Author URI:  https://jarradhill.com
License:     GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
 
WT Analytics is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
any later version.
 
WT Analytics is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with WT Analytics. If not, see https://www.gnu.org/licenses/gpl-3.0.html.
*/

function admin_only(){
    wp_enqueue_script('jquery');
    wp_enqueue_script( 'menu-script', plugins_url('/scripts/menu.js',__FILE__), array('jquery'));
    wp_enqueue_style( 'menu-style', plugins_url('/css/main.css',__FILE__ ));
    ?>
    <meta name="WT.z.wordpress_plugin" content="WordPress Admin Menu">
    <?php
}

function frontend(){
    ?>
    <meta name="WT.z.wordpress_plugin" content="WordPress Public Facing">
    <?php
}

add_action('admin_head', 'admin_only');
add_action('wp_head', 'frontend');

add_action('admin_menu', 'aaww_admin_menu' );

function aaww_admin_menu(){
    add_menu_page('WT Analytics', 'WT Analytics', 'administrator', 'aaww-options', 'aaww_admin_page', plugins_url('/images/icon.png',__FILE__));
    add_action('admin_init','register_aaww_settings');
}

function register_aaww_settings() {
    register_setting('aaww-configuration', 'aaww_active');
    register_setting('aaww-configuration', 'aaww_dcsid');
    register_setting('aaww-configuration', 'aaww_plugin_facebook_active');
    register_setting('aaww-configuration', 'aaww_plugin_facebook_domain');
    register_setting('aaww-configuration', 'aaww_plugin_gplus_active');
    register_setting('aaww-configuration', 'aaww_plugin_gplus_domain');
    register_setting('aaww-configuration', 'aaww_plugin_heatmaps_active');
    register_setting('aaww-configuration', 'aaww_plugin_heatmaps_domain');
    register_setting('aaww-configuration', 'aaww_plugin_replicate_active');
    register_setting('aaww-configuration', 'aaww_plugin_replicate_domain');
    register_setting('aaww-configuration', 'aaww_plugin_twitter_active');
    register_setting('aaww-configuration', 'aaww_plugin_twitter_domain');
    register_setting('aaww-configuration', 'aaww_plugin_youtube_active');
    register_setting('aaww-configuration', 'aaww_plugin_youtube_domain');
    register_setting('aaww-configuration', 'aaww_dcdomain');
    register_setting('aaww-configuration', 'aaww_time_zone');
    register_setting('aaww-configuration', 'aaww_time_zone_name');
    register_setting('aaww-configuration', 'aaww_i18n');
    register_setting('aaww-configuration', 'aaww_adimpressions');
    register_setting('aaww-configuration', 'aaww_adsparam');
    register_setting('aaww-configuration', 'aaww_offsite');
    register_setting('aaww-configuration', 'aaww_download');
    register_setting('aaww-configuration', 'aaww_downloadtypes');
    register_setting('aaww-configuration', 'aaww_anchor');
    register_setting('aaww-configuration', 'aaww_javascript');
    register_setting('aaww-configuration', 'aaww_cookieexpires');
    register_setting('aaww-configuration', 'aaww_onsitedoms');
    register_setting('aaww-configuration', 'aaww_fpcdom');
    register_setting('aaww-configuration', 'aaww_session_tracking');
}

// Admin Page Display
function aaww_admin_page(){
    ?>
    <form action='options.php' method='post'>
        <div class="config-heading" >
            <h2 class="left" >Webtrends Analytics</h2>
            <img class="right" width="130" src="<?php echo plugins_url('/images/logo.png',__FILE__ ); ?>" />
        </div>
        <?php

        settings_fields( 'aaww-configuration' );
        ?>
        <div class="clear">
            <label>Enable Analytics: </label>
            <input id="aaww_active" name="aaww_active" type="checkbox" value="1" <?php checked( '1', get_option( 'aaww_active' ) ); ?> />
            <br/>
        </div>
        
        <div class="config-options">
            <label class="option_label">Collection Server: </label>
            <input type="text" id="aaww_dcdomain" name="aaww_dcdomain" placeholder="statse.webtrendslive.com" size="40" value="<?php echo get_option('aaww_dcdomain'); ?>" />
            <br/>
            <label class="option_label">DCSID: </label>
            <input type="text" id="aaww_dcsid" name="aaww_dcsid" size="40" value="<?php echo get_option('aaww_dcsid'); ?>" />
            <br/>
            <label class="option_label">Time zone: </label>
            <select id="aaww_time_zone" name="aaww_time_zone" value="<?php echo get_option('aaww_time_zone'); ?>">
                <?php

                $result = generate_timezone_list();
                $selectedtz = get_option('aaww_time_zone_name');

                foreach($result as $key => $value):
                    echo '<option value="'.$value.'"';
                    if($key == $selectedtz){
                        echo ' selected="selected"';
                    }
                    echo '>'.$key.'</option>';
                endforeach;
                ?>
            </select>
            <input type="hidden" id="aaww_time_zone_name" name="aaww_time_zone_name" value="<?php echo get_option('aaww_time_zone_name'); ?>"/>
            <br/>
            <label class="option_label">First Person Cookie Domain: </label>
            <input type="text" id="aaww_fpcdom" name="aaww_fpcdom" size="40" value="<?php echo get_option('aaww_fpcdom'); ?>" />
            <br/>
            <label class="option_label">On-site Domains: </label>
            <input type="text" id="aaww_onsitedoms" name="aaww_onsitedoms" size="40" value="<?php echo get_option('aaww_onsitedoms'); ?>" />
            <br/>
            <label class="option_label">Session Only Tracking: </label>
            <input name="aaww_session_tracking" type="checkbox" value="1" <?php checked( '1', get_option('aaww_session_tracking') ); ?> />
            <br/>
            <label class="option_label">Enable Facebook: </label>
            <input name="aaww_plugin_facebook_active" type="checkbox" value="1" <?php checked( '1', get_option('aaww_plugin_facebook_active') ); ?> />
            <input type="text" id="aaww_plugin_facebook_domain" name="aaww_plugin_facebook_domain" placeholder="//s.webtrends.com/js/webtrends.fb.js" size="40" value="<?php echo get_option('aaww_plugin_facebook_domain'); ?>" />
            <br/>
            <label class="option_label">Enable Google Plus: </label>
            <input name="aaww_plugin_gplus_active" type="checkbox" value="1" <?php checked( '1', get_option('aaww_plugin_gplus_active') ); ?> />
            <input type="text" id="aaww_plugin_gplus_domain" name="aaww_plugin_gplus_domain" placeholder="//s.webtrends.com/js/webtrends.gplus.js" size="40" value="<?php echo get_option('aaww_plugin_gplus_domain'); ?>" />
            <br/>
            <label class="option_label">Enable Heatmaps: </label>
            <input name="aaww_plugin_heatmaps_active" type="checkbox" value="1" <?php checked( '1', get_option('aaww_plugin_heatmaps_active') ); ?> />
            <input type="text" id="aaww_plugin_heatmaps_domain" name="aaww_plugin_heatmaps_domain" placeholder="//s.webtrends.com/js/webtrends.heatmaps.js" size="40" value="<?php echo get_option('aaww_plugin_heatmaps_domain'); ?>" />
            <br/>
            <label class="option_label">Enable Replicate: </label>
            <input name="aaww_plugin_replicate_active" type="checkbox" value="1" <?php checked( '1', get_option('aaww_plugin_replicate_active') ); ?> />
            <input type="text" id="aaww_plugin_replicate_domain" name="aaww_plugin_replicate_domain" placeholder="//s.webtrends.com/js/webtrends.replicate.js" size="40" value="<?php echo get_option('aaww_plugin_replicate_domain'); ?>" />
            <br/>
            <label class="option_label">Enable Twitter: </label>
            <input name="aaww_plugin_twitter_active" type="checkbox" value="1" <?php checked( '1', get_option('aaww_plugin_twitter_active') ); ?> />
            <input type="text" id="aaww_plugin_twitter_domain" name="aaww_plugin_twitter_domain" placeholder="//s.webtrends.com/js/webtrends.twitter.js" size="40" value="<?php echo get_option('aaww_plugin_twitter_domain'); ?>" />
            <br/>
            <label class="option_label">Enable YouTube: </label>
            <input name="aaww_plugin_youtube_active" type="checkbox" value="1" <?php checked( '1', get_option('aaww_plugin_youtube_active') ); ?> />
            <input type="text" id="aaww_plugin_youtube_domain" name="aaww_plugin_youtube_domain" placeholder="//s.webtrends.com/js/webtrends.yt.js" size="40" value="<?php echo get_option('aaww_plugin_youtube_domain'); ?>" />
            <br/>
            <label class="option_label">Enable i18n: </label>
            <input name="aaww_i18n" type="checkbox" value="1" <?php checked( '1', get_option('aaww_i18n') ); ?> />
            <br/>
            <label class="option_label">Enable Ad Impressions: </label>
            <input id="aaww_adimpressions" name="aaww_adimpressions" type="checkbox" value="1" <?php checked( '1', get_option('aaww_adimpressions') ); ?> />
            <br/>
            <label class="option_label">Ad Impression Parameters: </label>
            <input type="text" id="aaww_adsparam" name="aaww_adsparam" size="40" placeholder="WT.ac" value="<?php echo get_option('aaww_adsparam'); ?>" />
            <br/>
            <label class="option_label">Track Off-Site Links: </label>
            <input name="aaww_offsite" type="checkbox" value="1" <?php checked( '1', get_option('aaww_offsite') ); ?> />
            <br/>
            <label class="option_label">Track File Downloads: </label>
            <input id="aaww_download" name="aaww_download" type="checkbox" value="1" <?php checked( '1', get_option('aaww_download') ); ?> />
            <br/>
            <label class="option_label">File Types to Track: </label>
            <input type="text" id="aaww_downloadtypes" name="aaww_downloadtypes" placeholder="xls,doc,pdf,txt,csv,zip,docx,xlsx,rar,gzip" size="40" value="<?php echo get_option('aaww_downloadtypes'); ?>" />
            <br/>
            <label class="option_label">Track Anchor Links: </label>
            <input name="aaww_anchor" type="checkbox" value="1" <?php checked( '1', get_option('aaww_anchor') ); ?> />
            <br/>
            <label class="option_label">Track JavaScript Links: </label>
            <input name="aaww_javascript" type="checkbox" value="1" <?php checked( '1', get_option('aaww_javascript') ); ?> />
            <br/>
        </div>
        <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
    </form>

    <?php
}

// Localize the script with new data
$params = array(
    'active' => get_option('aaww_active'),
    'dcsid' => get_option('aaww_dcsid'),
    'facebook' => get_option('aaww_plugin_facebook_active'),
    'facebookdomain' => get_option('aaww_plugin_facebook_domain'),
    'gplus' => get_option('aaww_plugin_gplus_active'),
    'gplusdomain' => get_option('aaww_plugin_gplus_domain'),
    'heatmaps' => get_option('aaww_plugin_heatmaps_active'),
    'heatmapsdomain' => get_option('aaww_plugin_heatmaps_domain'),
    'replicate' => get_option('aaww_plugin_replicate_active'),
    'replicatedomain' => get_option('aaww_plugin_replicate_domain'),
    'twitter' => get_option('aaww_plugin_twitter_active'),
    'twitterdomain' => get_option('aaww_plugin_twitter_domain'),
    'youtube' => get_option('aaww_plugin_youtube_active'),
    'youtubedomain' => get_option('aaww_plugin_youtube_domain'),
    'dcdomain' => get_option('aaww_dcdomain'),
    'time_zone' => get_option('aaww_time_zone'),
    'time_zone_name' => get_option('aaww_time_zone_name'),
    'i18n' => get_option('aaww_i18n'),
    'adimpressions' => get_option('aaww_adimpressions'),
    'adsparam' => get_option('aaww_adsparam'),
    'offsite' => get_option('aaww_offsite'),
    'download' => get_option('aaww_download'),
    'downloadtypes' => get_option('aaww_downloadtypes'),
    'anchor' => get_option('aaww_anchor'),
    'javascript' => get_option('aaww_javascript'),
    'onsitedoms' => get_option('aaww_onsitedoms'),
    'fpcdom' => get_option('aaww_fpcdom'),
    'cookieexpires' => get_option('aaww_session_tracking')
);


if(get_option('aaww_active') == '1'){
    // Expose variables to JavaScript
    wp_register_script('wa_data',plugins_url('/scripts/webtrends.load.js',__FILE__ ));
    wp_localize_script('wa_data','wa_parameters', $params );
    wp_enqueue_script( 'wa_data' );
}

function generate_timezone_list()
{
    static $regions = array(
        DateTimeZone::AFRICA,
        DateTimeZone::AMERICA,
        DateTimeZone::ANTARCTICA,
        DateTimeZone::ASIA,
        DateTimeZone::ATLANTIC,
        DateTimeZone::AUSTRALIA,
        DateTimeZone::EUROPE,
        DateTimeZone::INDIAN,
        DateTimeZone::PACIFIC,
    );

    $timezones = array();
    foreach( $regions as $region )
    {
        $timezones = array_merge( $timezones, DateTimeZone::listIdentifiers( $region ) );
    }

    $timezone_offsets = array();
    foreach( $timezones as $timezone )
    {
        $tz = new DateTimeZone($timezone);
        $timezone_offsets[$timezone] = $tz->getOffset(new DateTime);
    }

    // sort timezone by offset
    ksort($timezone_offsets);

    $timezone_list = array();
    foreach( $timezone_offsets as $timezone => $offset )
    {
        $offset_formatted = gmdate( 'H:i', abs($offset) );
        $dec_time = explode(':', $offset_formatted);
        $dec_mins = round(($dec_time[1]/60)*100,2)/100;
        $pretty_offset = $dec_time[0] - $dec_mins;
        $timezone_list[$timezone] = "${pretty_offset}";
    }
    return $timezone_list;
}

?>