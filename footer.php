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
<table style="width:100%;"><tr>';
	// determine if this site will me displaying the Google translater
	$rrw_trail_pluginDir = WP_CONTENT_DIR . "/plugins/gtranslate";

	if (is_dir($rrw_trail_pluginDir) ) {
?>
<td> 
<!-- GTranslate: https://gtranslate.io/ -->
<a href="#" onclick="doGTranslate('en|en');return false;" title="English" class="gflag nturl" style="background-position:-0px -0px;"><img src="http://private.eriepittsburghtrail.org/wp-content/plugins/gtranslate/blank.png" height="16" width="16" alt="English" /></a><a href="#" onclick="doGTranslate('en|fr');return false;" title="French" class="gflag nturl" style="background-position:-200px -100px;"><img src="http://private.eriepittsburghtrail.org/wp-content/plugins/gtranslate/blank.png" height="16" width="16" alt="French" /></a><a href="#" onclick="doGTranslate('en|de');return false;" title="German" class="gflag nturl" style="background-position:-300px -100px;"><img src="http://private.eriepittsburghtrail.org/wp-content/plugins/gtranslate/blank.png" height="16" width="16" alt="German" /></a><a href="#" onclick="doGTranslate('en|it');return false;" title="Italian" class="gflag nturl" style="background-position:-600px -100px;"><img src="http://private.eriepittsburghtrail.org/wp-content/plugins/gtranslate/blank.png" height="16" width="16" alt="Italian" /></a><a href="#" onclick="doGTranslate('en|pt');return false;" title="Portuguese" class="gflag nturl" style="background-position:-300px -200px;"><img src="http://private.eriepittsburghtrail.org/wp-content/plugins/gtranslate/blank.png" height="16" width="16" alt="Portuguese" /></a><a href="#" onclick="doGTranslate('en|ru');return false;" title="Russian" class="gflag nturl" style="background-position:-500px -200px;"><img src="http://private.eriepittsburghtrail.org/wp-content/plugins/gtranslate/blank.png" height="16" width="16" alt="Russian" /></a><a href="#" onclick="doGTranslate('en|es');return false;" title="Spanish" class="gflag nturl" style="background-position:-600px -200px;"><img src="http://private.eriepittsburghtrail.org/wp-content/plugins/gtranslate/blank.png" height="16" width="16" alt="Spanish" /></a><style type="text/css">
<!--
#goog-gt-tt {display:none !important;}
.goog-te-banner-frame {display:none !important;}
.goog-te-menu-value:hover {text-decoration:none !important;}
body {top:0 !important;}
#google_translate_element2 {display:none!important;}
-->
</style>

<div id="google_translate_element2"></div>
<script type="text/javascript">
function googleTranslateElementInit2() {new google.translate.TranslateElement({pageLanguage: 'en',autoDisplay: false}, 'google_translate_element2');}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit2"></script>


<script type="text/javascript">
function GTranslateFireEvent(element,event){try{if(document.createEventObject){var evt=document.createEventObject();element.fireEvent('on'+event,evt)}else{var evt=document.createEvent('HTMLEvents');evt.initEvent(event,true,true);element.dispatchEvent(evt)}}catch(e){}}function doGTranslate(lang_pair){if(lang_pair.value)lang_pair=lang_pair.value;if(lang_pair=='')return;var lang=lang_pair.split('|')[1];var teCombo;var sel=document.getElementsByTagName('select');for(var i=0;i<sel.length;i++)if(sel[i].className=='goog-te-combo')teCombo=sel[i];if(document.getElementById('google_translate_element2')==null||document.getElementById('google_translate_element2').innerHTML.length==0||teCombo.length==0||teCombo.innerHTML.length==0){setTimeout(function(){doGTranslate(lang_pair)},500)}else{teCombo.value=lang;GTranslateFireEvent(teCombo,'change');GTranslateFireEvent(teCombo,'change')}}
</script>
</td>
<?php 
	} // end of check for google translate
	print "<td>  <a href='/wp-login'>login</a></td>
<td style='text-align:center' >Copyright &copy; " . date("Y") . " by ";

	echo esc_attr( get_bloginfo( 'name', 'display' ) ); 
	// determine if this site will me displaying the freewheeling easy map
	$rrw_trail_pluginDir = WP_CONTENT_DIR . "/plugins/freewheelingeasymap";
	if (is_dir($rrw_trail_pluginDir) ) {
		print (' | Site design/hosting by the book <a class="external" style="color:black;"
			 href="//freeWheelingEasy.com" >FreeWheeling Easy</a>');
	} else {
		print (' | Site design/hosting by <a class="external" style="color:black;" 
			href="//brokenlinks.royweil.com" >Roy Weil Consulting</a>');
	}
	print "</td>";
?>
 <td style='text-align:right' ><a href="/get_involved/contact_us">webmaster feedback</a>&nbsp; &nbsp;</td><td>
</td></tr>
</table>
			</div><!-- .site-info -->
		</footer><!-- #colophon -->
	</div><!-- #page -->

	<?php wp_footer(); ?>
</body>
</html>