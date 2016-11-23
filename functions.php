<?PHP
/*
Author:         Roy Weil
Author URI:     http: //royweil.com
Github URI:        https://github.com/rweil55/roys-trail-header
License:           GPL-2.0+
License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
*/
//	*******************************  Function to add more icons to the page editor page
add_filter( 'tiny_mce_before_init', 'rrw_trail_myformatTinyMCE' );
function rrw_trail_myformatTinyMCE( $in ) {
	$in['wordpress_adv_hidden'] = FALSE;
	return $in;
}

// ************************************  Function to change email address
function wpb_sender_email( $original_email_address ) {
    return 'tim.smith@example.com';
}
// Function to change sender name
function wpb_sender_name( $original_email_from ) {
	return 'Tim Smith';
}
// Hooking up our functions to WordPress filters 
//add_filter( 'wp_mail_from', 'wpb_sender_email' );
//add_filter( 'wp_mail_from_name', 'wpb_sender_name' );


// 	*******************************  check for updates to the roys-trail-header theme
require 'theme_update_check.php';
$MyUpdateChecker = new ThemeUpdateChecker(
    'roys-trail-header',
    'https://kernl.us/api/v1/theme-updates/581b74d414f158048efcf64c/'
);
// $MyUpdateChecker->purchaseCode = "somePurchaseCode";  <---- Optional!

//	******************************* fix WP File Manger to look at just upload
$rrw_trail_dirs = array("file-manager/file-manager.php", "wp-file-manager/file_folder_manager.php"); 
$rrw_trail_debug = false;
foreach ($rrw_trail_dirs as $rrw_trail_dir)
{
	if ($rrw_trail_debug) echo "look for file $dir <br />\n";
	$rrw_trail_source = WP_CONTENT_DIR  . "/plugins/$rrw_trail_dir"; ;
	if ($rrw_trail_debug) echo "look for path $rrw_trail_source <br />\n";
	if (file_exists($rrw_trail_source ) ) {
		if ($rrw_trail_debug) echo "found file $rrw_trail_dir <br />\n";
		$rrw_trail_buffer = file_get_contents($rrw_trail_source);
		if ($rrw_trail_debug) echo 'size of buffer ' . strlen($rrw_trail_buffer) . "<br />\n";
		rrw_trail_replace("manage_options", "upload_files", $rrw_trail_buffer, $rrw_trail_source);
		rrw_trail_replace("=> ABSPATH", "=> \"" . WP_CONTENT_DIR  . "/uploads\"", 
							$rrw_trail_buffer, $rrw_trail_source);
		rrw_trail_replace("=> site_url(),", "=> \"" . site_url() . "/wp-content/uploads\",", 
							$rrw_trail_buffer, $rrw_trail_source);
		rrw_trail_replace("add_submenu_page(", "//  removed by roys-header_trail  xdd_submenu_page(", 
							$rrw_trail_buffer, $rrw_trail_source);

	}
}          
function rrw_trail_replace ($rrw_trail_needle, $rrw_trail_replace, $rrw_trail_haystack, $rrw_trail_file)
{
$rrw_trail_replace_debug = false;
		if ($rrw_trail_replace_debug) 
				echo "looking for $rrw_trail_needle replaceing with $rrw_trail_replace <br />\n";
		if (strpos($rrw_trail_haystack, $rrw_trail_needle) ) {
			if ($rrw_trail_replace_debug) 
				echo "found $rrw_trail_needle replaceing with $rrw_trail_replace <br />\n";
			$rrw_trail_haystack = str_replace($rrw_trail_needle, $rrw_trail_replace, $rrw_trail_haystack);
			$rrw_trail_result = file_put_contents($rrw_trail_file, $rrw_trail_haystack);
			if( $rrw_trail_replace_debug) {
				if (! $rrw_trail_result) {
					echo "roys_trail_header filed to update the $rrw_trail_file file <br />\n";
				}
			}
		}
}
// do the update check in a Word Press Plugin Server
require 'theme_update_check.php';
$MyUpdateChecker = new ThemeUpdateChecker(
    'roys-trail-header',
    'https://kernl.us/api/v1/theme-updates/581b74d414f158048efcf64c/'
);
// $MyUpdateChecker->purchaseCode = "somePurchaseCode";  <---- Optional!
?>