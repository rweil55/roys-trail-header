<?PHP
/*
 * contains the following functions
 *	rrwUtil_fetchparameterAny( $item, $shortCodeAttribute = null ) 
 *	rrwUtil_fetchparameterNumber')
 * rrwUtil_fetchparameterString')
 * rrwUtil_fetchparameterurl')
 * rrwUtil_rrw_dump_r($array, $return = false)
 * rrwUtil_dump_sql ($msg)
 * rrwUtil_SQLclean($sqlData)
 * write_log ( $log ) 
 
  */

if ( ! function_exists('rrwUtil_fetchparameterAny'))
{
	function rrwUtil_fetchparameterAny( $item, $shortCodeAttribute = null ) {
		if ( array_key_exists( $item, $_GET ) )
			return $_GET[ $item ];
		if (! is_null($shortCodeAttribute)) {

			$extCnt = shortcode_atts( array( "$item" => '' ), $shortCodeAttribute ) ;
			if (array_key_exists($item, $extCnt))
				return $extCnt[$item];
		}
		if ( array_key_exists( $item, $_POST ) )
			return $_POST[ $item ];
		if ( array_key_exists( $item, $_COOKIE ) )
			return $_COOKIE[ $item ];
		if ( array_key_exists( $item, $_ENV ) )
			return $_ENV[ $item ];
		return "";
	}
}

if ( ! function_exists('rrwUtil_fetchparameterNumber'))
{

	function rrwUtil_fetchparameterNumber($item, $shortCodeAttribute = null ){
		$thing = rrwUtil_fetchparameterAny( $item, $shortCodeAttribute );
		if ( strlen( $thing  ) > 6 || ! is_numeric( $thing  ) )
			return 0; // look for non existant record
		return $thing ;
	}
}

if ( ! function_exists('rrwUtil_fetchparameterString'))
{

	function rrwUtil_fetchparameterString($item, $shortCodeAttribute= null )
	{
		$thing = rrwUtil_fetchparameterAny($item, $shortCodeAttribute  );
		// print "<br />string for $item found $thing <br />";
		return rrwUtil_SQLclean($thing);
	}
}

if ( ! function_exists('rrwUtil_fetchparameterURL'))
{
	function rrwUtil_fetchparameterURL($item, $shortCodeAttribute = null )
	{
		$thing = rrwUtil_fetchparameterAny($item, $shortCodeAttribute);
		return rrwUtil_SQLclean($thing);
	}
}
if ( ! function_exists("rrwUtil_SQLclean"))
{
	function rrwUtil_SQLclean($sqlData)
	{
		$sqlData = str_replace("'", "''", $sqlData);
		$sqlData = str_replace("''''", "''", $sqlData);		// inncase called twice on same input
		return $sqlData;
	}
}
if ( ! function_exists('rrwUtil_rrw_dump_r'))
{
	function rrwUtil_rrw_dump_r($array, $return = false)
	{
		$msg = "<pre>\n" . print_r ($array, true) . "</pre>\n"; 
		if ($return)
			return $msg;
		print $msg;
		return true;
	}
}
if ( ! function_exists('rrwUtil_dump_sql'))
{
	function rrwUtil_dump_sql ($msg)
	{
	global $eol;
		if (array_key_exists("sql", $_GET) )
			print "$msg$eol";
	}
}


if ( ! function_exists('write_log')) {
    function write_log ( $log )  {
        if ( true === WP_DEBUG ) {
            if ( is_array( $log ) || is_object( $log ) ) {
                error_log( print_r( $log, true ) );
            } else {
                error_log( $log );
            }
        }
    }	// end of function write_log
}	// end of if function_exists('write_log'))

?>