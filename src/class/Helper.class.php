<?php 


class Helper {

	public static function filter_scan_dir( $file ) {
		return !self::starts_with( $file, '.' );
	}

	public static function starts_with($haystack, $needle) {
    	$length = strlen($needle);
    	return (substr($haystack, 0, $length) === $needle);
	}

	static public function clean_tag($text) { 
		// replace non letter or digits by -
		$text = preg_replace('~[^\\pL\d]+~u', '-', $text);

		// trim
		$text = trim($text, '-');

		// transliterate
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

		// lowercase
		$text = strtolower($text);

		// remove unwanted characters
		$text = preg_replace('~[^-\w]+~', '', $text);

		$text = str_replace('-', '', $text);

		if (empty($text))
		{
			return '';
		}

		return $text;
	}

}