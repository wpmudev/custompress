<?php
/**
* Forces a rewrite rules recalc on all blogs on Multisite
* format of uniq is "1 xxxxxxxxxxxxx' or '0 xxxxxxxxxxxxx' 1 if a hard flush is requested
* Sets flag so flush is only called once even if flush_network_rewrite_rules is called multiple times
*/
if( ! function_exists('flush_network_rewrite_rules') ):

function flush_network_rewrite_rules($hard = true, $log = 'Unknown'){
	
	if(is_multisite() ){
		update_site_option('ct_flush_rewrite_rules', uniqid( ($hard ? '1 ' : '0 '), true));
	} else {
		update_option('ct_flush_rewrite_rules', uniqid( ($hard ? '1 ' : '0 '), true));
	}
	flush_rewrite_rules( $hard );
}

endif;

if( ! function_exists('write_to_log') ):

function write_to_log($error, $log = 'flush_rewrite_rules') {

	//create filename for each month
	$filename = CPT_PLUGIN_DIR . "{$log}_" . date('Y_m') . '.log';

	//add timestamp to error
	$message = gmdate('[Y-m-d H:i:s] ') . $error;

	//write to file
	file_put_contents($filename, $message . "\n\n", FILE_APPEND);
}

endif;

if ( ! function_exists( 'ct_printf_array' ) ) {
	function ct_printf_array( $format, $arr ) {
		return call_user_func_array( 'sprintf', array_merge( (array) $format, $arr ) );
	}
}

if ( ! function_exists( 'ct_format_date' ) ) {
	function ct_format_date( $value, $format = 'd/m/Y', $is_special_date = false ) {

		if ( ! $value ) {
			return $value;
		}

		// vars
		$unixtimestamp = 0;


		// numeric ( unix or YYYYMMDD or YYYYMMDDHHIISS)
		if ( is_numeric( $value ) ) {
			$len = strlen( $value );
			if ( $len !== 14 && $len !== 8 ) {
				$unixtimestamp = $value;
			} else {
				$unixtimestamp = strtotime( $value );
			}
		} else {
			$unixtimestamp = strtotime( $value );
		}

		if ( $is_special_date ) {
			$special_formats = ct_get_special_date_formats();

			if ( isset( $special_formats[ $format ] ) ) {
				$str_format = array_shift( $special_formats[ $format ] );

				if ( ! empty( $special_formats[ $format ] ) ) {
					// loop get date format
					$date_time_formated = array();
					foreach ( $special_formats[ $format ] as $fm ) {
						$date_time_formated[] = date( $fm, $unixtimestamp );
					}

					return ct_printf_array( $str_format, $date_time_formated );
				} else {
					$is_special_date = false;
				}
			} else {
				$is_special_date = false;
			}
		}

		if ( ! $is_special_date ) {
			$value = date_i18n( $format, $unixtimestamp );
		}

		// return
		return $value;
	}
}

if ( ! function_exists( 'ct_get_date_field' ) ) {
	/**
	 * Get date field by format
	 *
	 * @param  string $value raw date value
	 * @param  array $field
	 *
	 * @return string date formated
	 */
	function ct_get_date_field( $value, $field ) {

		if ( empty( $value ) ) {
			return $value;
		}

		if ( ! empty( $field['field_return_format'] ) ) {
			$value = ct_format_date( (int) $value, $field['field_return_format'], isset( $field['field_special_date_format'] ) );;
		} else {
			$value = esc_attr( strip_tags( $value ) );
		}

		return $value;
	}
}


/*
*  ct_str_replace
*
*  This function will replace an array of strings much like str_replace
*  The difference is the extra logic to avoid replacing a string that has alread been replaced
*  This is very useful for replacing date characters as they overlap with eachother
*
*  @since	1.3.8
*
*  @param	$post_id (int)
*  @return	$post_id (int)
*/

function ct_str_replace( $string = '', $search_replace = array() ) {

	// vars
	$ignore = array();


	// remove potential empty search to avoid PHP error
	unset( $search_replace[''] );


	// loop over conversions
	foreach ( $search_replace as $search => $replace ) {

		// ignore this search, it was a previous replace
		if ( in_array( $search, $ignore ) ) {
			continue;
		}


		// bail early if subsctring not found
		if ( strpos( $string, $search ) === false ) {
			continue;
		}


		// replace
		$string = str_replace( $search, $replace, $string );


		// append to ignore
		$ignore[] = $replace;

	}


	// return
	return $string;

}


/*
*  date & time formats
*
*  These settings contain an association of format strings from PHP => JS
*
*  @since	1.3.8
*
*  @param	n/a
*  @return	n/a
*/
if ( ! function_exists( 'ct_get_php_to_js_date_formats' ) ) {
	function ct_get_php_to_js_date_formats() {
		return array(
			// Year
			'Y' => 'yy',    // Numeric, 4 digits 								1999, 2003
			'y' => 'y',        // Numeric, 2 digits 								99, 03


			// Month
			'm' => 'mm',    // Numeric, with leading zeros  					01–12
			'n' => 'm',        // Numeric, without leading zeros  					1–12
			'F' => 'MM',    // Textual full   									January – December
			'M' => 'M',        // Textual three letters    						Jan - Dec


			// Weekday
			'l' => 'DD',    // Full name  (lowercase 'L') 						Sunday – Saturday
			'D' => 'D',        // Three letter name 	 							Mon – Sun


			// Day of Month
			'd' => 'dd',    // Numeric, with leading zeros						01–31
			'j' => 'd',        // Numeric, without leading zeros 					1–31
			'S' => '',        // The English suffix for the day of the month  	st, nd or th in the 1st, 2nd or 15th.
		);
	}
}

if ( ! function_exists( 'ct_get_php_to_js_time_formats' ) ) {
	function ct_get_php_to_js_time_formats() {
		return array(

			'a' => 'tt',    // Lowercase Ante meridiem and Post meridiem 		am or pm
			'A' => 'TT',    // Uppercase Ante meridiem and Post meridiem 		AM or PM
			'h' => 'hh',    // 12-hour format of an hour with leading zeros 	01 through 12
			'g' => 'h',        // 12-hour format of an hour without leading zeros 	1 through 12
			'H' => 'HH',    // 24-hour format of an hour with leading zeros 	00 through 23
			'G' => 'H',        // 24-hour format of an hour without leading zeros 	0 through 23
			'i' => 'mm',    // Minutes with leading zeros 						00 to 59
			's' => 'ss',    // Seconds, with leading zeros 						00 through 59

		);
	}
}


if ( ! function_exists( 'ct_get_special_date_formats' ) ) {
	function ct_get_special_date_formats() {
		return apply_filters( 'ct_special_date_formats', array(
			// js format 						=> php date format should be like this array('day %d month %d year %d', 'd','m','Y')
			"'day' d 'of' MM 'in the year' yy" => array( "day %d of %s in the year %d", "d", "F", "Y" )
		) );
	}
}


/*
*  ct_split_date_time
*
*  This function will split a format string into seperate date and time
*
*  @since	1.3.8
*
*  @param	$date_time (string)
*  @return	$formats (array)
*/

function ct_split_date_time( $date_time = '' ) {

	// vars
	$php_date = ct_get_php_to_js_date_formats();
	$php_time = ct_get_php_to_js_time_formats();
	$chars    = str_split( $date_time );
	$type     = 'date';


	// default
	$data = array(
		'date' => '',
		'time' => ''
	);


	// loop
	foreach ( $chars as $i => $c ) {

		// find type
		// - allow misc characters to append to previous type
		if ( isset( $php_date[ $c ] ) ) {

			$type = 'date';

		} elseif ( isset( $php_time[ $c ] ) ) {

			$type = 'time';

		}


		// append char
		$data[ $type ] .= $c;

	}


	// trim
	$data['date'] = trim( $data['date'] );
	$data['time'] = trim( $data['time'] );


	// return
	return $data;

}


/*
*  ct_convert_date_to_php
*
*  This fucntion converts a date format string from JS to PHP
*
*  @since	1.3.8
*
*  @param	$date (string)
*  @return	(string)
*/

function ct_convert_date_to_php( $date = '' ) {

	// vars
	$php_to_js = ct_get_php_to_js_date_formats();
	$js_to_php = array_flip( $php_to_js );


	// return
	return ct_str_replace( $date, $js_to_php );

}

/*
*  ct_convert_date_to_js
*
*  This fucntion converts a date format string from PHP to JS
*
*  @since	1.3.8
*
*  @param	$date (string)
*  @return	(string)
*/

function ct_convert_date_to_js( $date = '' ) {

	// vars
	$php_to_js = ct_get_php_to_js_date_formats();


	// return
	return ct_str_replace( $date, $php_to_js );

}


/*
*  ct_convert_time_to_php
*
*  This fucntion converts a time format string from JS to PHP
*
*  @since	1.3.8
*
*  @param	$time (string)
*  @return	(string)
*/

function ct_convert_time_to_php( $time = '' ) {

	// vars
	$php_to_js = ct_get_php_to_js_time_formats();
	$js_to_php = array_flip( $php_to_js );


	// return
	return ct_str_replace( $time, $js_to_php );

}


/*
*  ct_convert_time_to_js
*
*  This fucntion converts a date format string from PHP to JS
*
*  @since	1.3.8
*
*  @param	$time (string)
*  @return	(string)
*/

function ct_convert_time_to_js( $time = '' ) {

	// vars
	$php_to_js = ct_get_php_to_js_time_formats();


	// return
	return ct_str_replace( $time, $php_to_js );

}


if ( ! function_exists( 'ct_get_field_id' ) ) {
	function ct_get_field_id( $field ) {
		$key = $field['field_id'];
		if ( empty( $field['field_wp_allow'] ) ) {
			$key = '_ct_' . $key;
		} else {
			$key = 'ct_' . $key;
		}

		return $key;
	}
}
