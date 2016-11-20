<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<div class="page-wrapper">
				<div class="page-content">
					<h1>Page not found - 404 Error</h1>
					<h2><?php _e( 'Are you looking for a restricted page and are not
yet logged in?', 'twentythirteen' ); ?></h2>
<h3> It looks like nothing was found at this location. Use the links above<br />
or try a search</h3><?php get_search_form(); ?>
						
				</div><!-- .page-content -->
			</div><!-- .page-wrapper -->

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>