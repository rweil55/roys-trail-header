<?php
	@ini_set( 'upload_max_size' , '64M' );
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
/* 	this is Roy Weil's standard Trail header
 *
 *	to use: do the following
 *	Under "appearance", "customize", "Header Image" upload the left hand header logo
 *	   at a height of about 150
 *	Under "appearance", "customize", "Site Identity" enter header text
 *	Upload right hand header images to the directory wp-content/upload/Top-Banner-Images
 *
 *   Commonly used plugins:
 * 	Google Translate plugin
 *      Google Analytics for WordPress
 *	Google XML sitemap
 *      iThemes Sync
 *	UpdraftPlus - Backup/Restore
 *
 *   Other plugins that might be used
 *	freewheeling map
 *	Mmm Simple File/Category Lister
 *	Seamless Donations
 *	Seamless Donations Custom 
 *	Table Press
 *	WordPress Meta Robots
 *	WP File Manager
 */
?><!DOCTYPE html >
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->

<?php
// determine if this site will me displaying the freewheeling easy map
$rrw_trail_pluginDir = WP_CONTENT_DIR . "/plugins/freewheelingeasymap";
if (is_dir($rrw_trail_pluginDir) ) {
	// will do map display, so include some javascript
	print "
<script type='text/javascript' 
    src='https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyBsapjBVkpVG7skmQo62Iu_BVE977Oan24'></script>
<script type='text/javascript' 
    src='/wp-content/plugins/freewheelingeasymap/freewheelingeasy_map.js' > </script>
<script type='text/javascript' 
    src='/wp-content/plugins/freewheelingeasymap/markercluster.js' > </script>
	";
}
 wp_head(); 
 
?>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="hfeed site">
<!--  ==================================================================================================== header -->
		<header id="masthead"  style="text-align:left;" >
<a class="screen-reader-text skip-link" href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentythirteen' ); ?>"><?php _e( 'Skip to content', 'twentythirteen' ); ?></a>
           <table style="min-height: 30px; border:2px" role="presentation" 
			title="used for layout of the top header" >
           	 <tr>
                <td>&nbsp;</td><td>
<a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" 
                             title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
<img src="<?php header_image(); ?>" 
		alt="<?php bloginfo( 'name' ); ?> logo"
		class="alignnone size-full" /></a>
                    </td><td style="text-align:center; border:thin;">
                        <a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" 
                             title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                        <h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
                        <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
                        </a>
                </td>
                <td>
<?php 

$thumblist = rrw_trail_GetBannerPhotoList(); 
if (! is_array($thumblist) )
{
	print "<td>$thumblist</td>";
}
else
{
	$photoIdx = mt_rand(0, count($thumblist) - 1 );
	$photo = $thumblist[$photoIdx];
	print "
		<td > <!-- $photoIdx/" . count($thumblist) . " -->
                    <img  height='150' alt='Picture along the trail'
                    src='$photo'  ></td> ";
}
?>              
              </tr>
           </table > 
<!--  ==================================================================================================== nav bar -->
                <div id="navbar" class="navbar">
                    <nav id="site-navigation" class="navigation main-navigation" >
                    <table role="presentation" title="used for layout of the navigation bar">
		    <tr><td>
                        <h3 class="menu-toggle"><?php _e( 'Menu', 'twentythirteen' ); ?></h3>
                        <a class="screen-reader-text skip-link" href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentythirteen' ); ?>"><?php _e( 'Skip to content', 'twentythirteen' ); ?></a>
                        <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?></td><td style="text-align:right" >
						<?php  get_search_form(); ?>
    		    </td></tr>
		    </table> 
                    </nav><!-- #site-navigation -->
                </div><!-- #navbar -->
		</header><!-- #masthead -->

<!--  ==================================================================================================== main content -->
		<div id="main" class="site-main">
<?PHP
function rrw_trail_GetBannerPhotoList()
{	
/*	returns a list of files that are in the directory specified by the Settings/Trail Header 
 *	or returns a text string error message to be displayed.
 *	coded by Roy Weil 2016 May 14
 */
	$dir = "uploads/Top-Banner-Images/";
	$path = WP_CONTENT_DIR  . "/$dir";
	if (! is_dir($path)) {
		return "use WP File Manager to create<br />the /$dir directory<br />
		<!-- $path --> \n ";
	}
	if (! $dh = opendir($path))
		return "use WP File Manager to fix<br />/$dir directory<br />
		<!-- $path --> \n";
 	$thumbList = array();
        while (($file = readdir($dh)) !== false) {
            	$typeOfEntry =  filetype($path . $file);
			if (strcmp($typeOfEntry, "file") == 0) 
				$thumbList[] = "/wp-content/$dir/$file";
        }
    closedir($dh);
		
 	if (count($thumbList) <= 0) { 
		return  "use WP File Manager to add images<br />to $dir directory<br />\n";
	}	
	return $thumbList;
}