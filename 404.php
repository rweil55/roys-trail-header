<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

$page1 = $_SERVER[ "REDIRECT_REDIRECT_SCRIPT_URL" ];

$ii = strpos( $page1, "." );
if ( $ii > 2 )
	$page1 = substr( $page1, 0, $ii );
$page1 = trim( str_replace( "/", "", $page1 ) );
foreach ( array( " ", "_" ) as $searchChar ) {
	$page_slug = trim( str_replace( $searchChar, "-", $page1 ) );
	$page = get_page_by_path( $page_slug, OBJECT );

	if ( isset( $page ) ) {
		$uri = $_SERVER[ "REDIRECT_REDIRECT_SCRIPT_URI" ]; // http://demo1.royweil.com/xxx
		$url = $_SERVER[ "REDIRECT_REDIRECT_SCRIPT_URL" ]; //xxx
		$urlNew = str_replace( $url, "", $uri );
		$urlNew .= "/$page_slug";
		header( "location:$urlNew", true,301);
		exit;
	}
}

set_query_var( "s", $page_slug );
get_header();
?>

<div id="primary" class="content-area">
	<div id="content" class="site-content" role="main">
		<div class="page-wrapper">
			<div class="page-content">
				<h1>Page not found - 404 Error</h1>
				<h3> It looks like nothing was found at this location. Use the links above<br />
or try a search</h3>
				<?php get_search_form($page_slug); ?>

			</div>
			<!-- .page-content -->
		</div>
		<!-- .page-wrapper -->

	</div>
	<!-- #content -->
</div> <!-- #primary -->

<?php
get_footer();

?>