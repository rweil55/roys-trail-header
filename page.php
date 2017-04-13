<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 
 1.1.2
 	added code to diplay the copyright notice on the sides of the page
 1.1.1
 	dded displays of astericks around the header comments and footer.
 */
$pluginUrl =get_permalink();
if (strpos($pluginUrl, "freewheeling") === false)
	$copyrightOnSides = false;
else
	$copyrightOnSides = true;
get_header(); ?>
<?PHP	if ($copyrightOnSides) {
			print "<table border=4 >
	<tr><td style='background-image:url(\"images/left%20margin.jpg\"); background-repeat:repeat-y; 
					width:20px; boreder:2 ' >&nbsp;
			</td><td>";
}
?>
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
						<div class="entry-thumbnail">
							<?php the_post_thumbnail(); ?>
						</div>
						<?php endif;
						if ( ! $copyrightOnSides) {
							print '<h1 id="entryTitleDisplay" class="entry-title">';
							the_title();
							print '</h1>';
						}
?>					</header><!-- .entry-header -->

					<div class="entry-content"> <!-- *************************************** Content -->
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
					</div><!-- .entry-content --> <!-- **** end Content -->

					<footer class="entry-meta">
						<?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
					</footer><!-- .entry-meta -->
				</article><!-- #post -->
						<!-- *************************************** Comments -->
				<?php // comments_template(); ?>
			<?php endwhile; ?>

		</div><!-- #content -->
<?PHP	if ($copyrightOnSides) {
			print "</td><td style='background-image:url(\"images/right%20margin.jpg\"); 
	background-repeat:repeat-y; width:20px;' >&nbsp;
			</td></tr>
		</table>";
}
?>	
</div><!-- #primary -->

<?php get_sidebar(); ?>
<!-- *************************************** footer -->
<?php get_footer(); ?>