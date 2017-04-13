<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

	print '	</div><!-- #main -->
		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="site-info">
<table style="width:100%;">
<tr>
    <td> &nbsp;</td>';
	// determine if this site will me displaying the Google translater
	$rrw_trail_pluginDir = WP_CONTENT_DIR . "/plugins";
	write_log ($rrw_trail_pluginDir);
	if (is_dir("$rrw_trail_pluginDir/gtranslate") ) {
			$transHtml = do_shortcode('[gtranslate]'); 
			print "\n    <td >\n$transHtml\n &nbsp; </td>\n\n";
	} // end of check for google translate
	print "
    <td> &nbsp;</td>
    <td>  <a href='/wp-login'>login</a></td>
    <td> &nbsp;</td>
    <td style='text-align:center' >Copyright &copy; " . date("Y") . " by ";

	echo esc_attr( get_bloginfo( 'name', 'display' ) );

	// if displaying the freewheeling easy map change credit lne.
	if (is_dir("$rrw_trail_pluginDir/freewheeling-easy-map") ) {
		print (' | Site design/hosting by the book <a class="external" style="color:black;"
			 href="//freeWheelingEasy.com" >FreeWheeling Easy</a>');
	} else {
		print (' | Site design/hosting by <a class="external" style="color:black;" 
			href="//brokenlinks.royweil.com" >Roy Weil Consulting</a>');
	}
	print "    </td>";
	if ( is_multisite() ) 
		$endSlash = "/";
	else
		$endSlash = ""; 
	print "
     <td style='text-align:right' ><a href='/webmaster-feedback$endSlash' >webmaster feedback</a>&nbsp; &nbsp;</td>
     <td> &nbsp;</td>
  </tr>
</table>
";
?>
			</div><!-- .site-info -->
		</footer><!-- #colophon -->
	</div><!-- #page -->

	<?php wp_footer(); ?>
</body>
</html>