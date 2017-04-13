<?PHP

require_once "functionsRweil_inc.php";

//	*******************************  Function to add more icons to the page editor page
add_filter( 'tiny_mce_before_init', 'rrw_trail_myformatTinyMCE' );

function rrw_trail_myformatTinyMCE( $in ) {
	$in[ 'wordpress_adv_hidden' ] = FALSE;
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
    'roys-trail-header', 'http://pluginserver.royweil.com/roys-trail-header.php'
  //  'https://kernl.us/api/v1/theme-updates/58324bb2bdf1417153c8e59e/'
);


//  *******************************  hide a photo if this is a mobile/phone device

function rrw_if_phone_hide_photo ($att = array())
{
	if (array_key_exists("item", $att))
		$msg = $att["item"];
	else
		$msg = "";
	$browser = $_SERVER['HTTP_USER_AGENT'];
	if (strpos($browser, "Mobile") > 0 )
	{
		$desktop = false;
		$mobile = true;
	}else {
		$desktop = true;
		$mobile = false;
	}	
	if ($desktop)
		return $msg;
	else
		return "";
}

add_shortcode("ifphonehide", "rrw_if_phone_hide_photo");


function rrw_trail_display_doc(){
	global $eol;
	$msg = "";
	$docName = $_GET["docname"];
	if (empty($docName))
		return "Missing paramater";
	$url = "http://demo1.royweil.com/wp-content/uploads/2016/12/$docName";
	$url=urldecode($docName);
	$msg .= "$url$eol";
	
	$msg .= do_shortcode('[embeddoc url="' . $url . '" download="all"]');
	return $msg;
}

function rrw_trail_display_doc_button($atts) {
	
	$msg = "";
	extract( shortcode_atts( array(
        'pagename' => 'displaydoc',		// psge that gets called - should have a sortcode of [displacdoc]
		'docname' =>'',			// document that gets displayed
		'pagetitle' =>''
        ), $atts ) );
	if (empty($pagetitle))
		$pagetitle = $docname;
	if (empty($docname))
		return "missing docname parameter<br />\n";
	$msg .= '<form action="http://demo1.royweil.com/' . $pagename . '"><input type="hidden" name="docname" value="' . $docname . '" ><input type="submit" value="' . $pagetitle . '" /></form>';
	return $msg;
}

add_shortcode("Display-Doc", "rrw_trail_display_doc");
add_shortcode("Display-Doc-button", "rrw_trail_display_doc_button");

//	******************************* fix WP File Manger to look at just upload
$rrw_trail_dirs = array( "file-manager/file-manager.php", "wp-file-manager/file_folder_manager.php" );
$rrw_trail_debug = false;
// the below code dose not work on multisites


foreach ( $rrw_trail_dirs as $rrw_trail_dir ) {
	if ( $rrw_trail_debug )echo "look for file $dir <br />\n";
	$rrw_trail_source = WP_CONTENT_DIR . "/plugins/$rrw_trail_dir";;
	if ( $rrw_trail_debug )echo "look for path $rrw_trail_source <br />\n";
	if ( file_exists( $rrw_trail_source ) ) {
		if ( $rrw_trail_debug )echo "found file $rrw_trail_dir <br />\n";
		$rrw_trail_buffer = file_get_contents( $rrw_trail_source );
		if ( $rrw_trail_debug )echo 'size of buffer ' . strlen( $rrw_trail_buffer ) . "<br />\n";
		// we have the commands in $rrw_trail_buffer
		if ( ! strpos( $rrw_trail_buffer, "Code added and path" ) ) { // have we done this
			if ( $iiAutoLoad = strpos( $rrw_trail_buffer, "autoload.php';" ) ) {
				$rrw_trail_buffer = substr( $rrw_trail_buffer, 0, $iiAutoLoad +14) . '
				// Code added and path and url modified by roys-trail-header theme
				$pathArray = wp_upload_dir();		// information about the upload directory
				$path = $pathArray["basedir"];		// the actual path
				$url = $pathArray["baseurl"];
				' . substr( $rrw_trail_buffer, $iiAutoLoad +15 );
			} else {
				print( "iiAutoLoad equals $iiAutoLoad" );
			}
		}
		rrw_trail_replace( "manage_options", "upload_files", $rrw_trail_buffer, $rrw_trail_source );
		rrw_trail_replace( "=> ABSPATH", '=> $path', $rrw_trail_buffer, $rrw_trail_source );
		rrw_trail_replace( "=> site_url(),", '=> $url,', $rrw_trail_buffer, $rrw_trail_source );
		rrw_trail_replace( "add_submenu_page(", "//  removed by roys-header_trail  xdd_submenu_page(",
			$rrw_trail_buffer, $rrw_trail_source );

	}
}

function rrw_trail_replace( $rrw_trail_needle, $rrw_trail_replace, $rrw_trail_haystack, $rrw_trail_file ) {
	$rrw_trail_replace_debug = false;
	if ( $rrw_trail_replace_debug )
		echo "looking for $rrw_trail_needle replaceing with $rrw_trail_replace <br />\n";
	if ( strpos( $rrw_trail_haystack, $rrw_trail_needle ) ) {
		if ( $rrw_trail_replace_debug )
			echo "found $rrw_trail_needle replaceing with $rrw_trail_replace <br />\n";
		$rrw_trail_haystack = str_replace( $rrw_trail_needle, $rrw_trail_replace,
			$rrw_trail_haystack );
		$rrw_trail_result = file_put_contents( $rrw_trail_file, $rrw_trail_haystack );
		if ( $rrw_trail_replace_debug ) {
			if ( !$rrw_trail_result ) {
				echo "roys_trail_header filed to update the $rrw_trail_file file <br />\n";
			}
		}
	}
}
?>