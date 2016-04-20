<?php
/*
		Plugin Name: GE Social Media Tabs
		Tags: social media, facebook, twitter, tweets, flickr, YouTube, instagram, , profile, tabs, social networks, bookmarks, buttons, animated, jquery, flyout, sliding
		Description: Social media tabs for GE allows you to add  twitter, flickr, instagram, and linkedin, YouTube subscription and feeds to any widget area with stylish sliding tabs. Option also to have the tabs slide out from the side of the browsers
	
*/

class dc_jqsocialmediatabs {

	function dc_jqsocialmediatabs(){
	
		if(!is_admin()){
			// Header styles
			add_action( 'wp_enqueue_scripts', array('dc_jqsocialmediatabs', 'header') );

		}
		add_action( 'wp_footer', array('dc_jqsocialmediatabs', 'footer') );
	}

	function header(){
		
			// Scripts
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'dcjqsocialtabs', dc_jqsocialmediatabs::get_plugin_directory() . '/js/jquery.dcsmt.1.0.js', array('jquery') );
	}
	
	function footer(){
	//	echo "\n\t";
	}
	
	function get_plugin_directory(){
		return plugins_url() . '/ge-social-media-tabs';	
	}
};

require_once('inc/dcwp_admin.php');
require_once('inc/dcwp_widget.php');

if(is_admin()) {

	$dc_jqsocialmediatabs_admin = new dc_jqsocialmediatabs_admin();

}

// Initialize the plugin.
$dcjqsocialtabs = new dc_jqsocialmediatabs();

// Register the widget
add_action('widgets_init', create_function('', 'return register_widget("dc_jqsocialmediatabs_widget");'));

/* Time since function taken from WordPress.com */
if (!function_exists('wpcom_time_since')) :

function wpcom_time_since( $original, $do_more = 0 ) {
        // array of time period chunks
        $chunks = array(
                array(60 * 60 * 24 * 365 , 'year'),
                array(60 * 60 * 24 * 30 , 'month'),
                array(60 * 60 * 24 * 7, 'week'),
                array(60 * 60 * 24 , 'day'),
                array(60 * 60 , 'hour'),
                array(60 , 'minute'),
        );

        $today = time();
        $since = $today - $original;

        for ($i = 0, $j = count($chunks); $i < $j; $i++) {
                $seconds = $chunks[$i][0];
                $name = $chunks[$i][1];

                if (($count = floor($since / $seconds)) != 0)
                    break;
        }

        $print = ($count == 1) ? '1 '.$name : "$count {$name}s";

        if ($i + 1 < $j) {
                $seconds2 = $chunks[$i + 1][0];
                $name2 = $chunks[$i + 1][1];

                // add second item if it's greater than 0
                if ( (($count2 = floor(($since - ($seconds * $count)) / $seconds2)) != 0) && $do_more )
                        $print .= ($count2 == 1) ? ', 1 '.$name2 : ", $count2 {$name2}s";
        }
        return $print;
}
endif;

if (!function_exists('http_build_query')) :
    function http_build_query($query_data, $numeric_prefix='', $arg_separator='&'){
       $arr = array();
       foreach ( $query_data as $key => $val )
         $arr[] = urlencode($numeric_prefix.$key) . '=' . urlencode($val);
       return implode($arr, $arg_separator);
    }
endif;

?>