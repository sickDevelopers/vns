<?php

class TwitterPost {

	public $_sign;

	/**
	 * Costruttore
	 */
	function __construct() {
		$this->sign = '';
	}

	/**
	 * Send tweet
	 * @param  [type] $text [description]
	 * @return [type]       [description]
	 */
	public function send( $text, $tweet_params = array() ) {

		\Codebird\Codebird::setConsumerKey(API_KEY, OAUTH_SECRET); // static, see 'Using multiple Codebird instances'
		$cb = \Codebird\Codebird::getInstance();

		$cb->setToken(ADMIN_SECRET, ADMIN_TOKEN_SECRET);

		$params = array(
		  'status' => $text . $this->_sign
		);
		$params = $params + $tweet_params;

		return $cb->statuses_update( $params );

	}

	/**
	 * [addHashtags description]
	 * Si aspetta come argomento gli hashtags in formato stinga
	 */
	public function add_hashtags() {

		$buffer = '';
		$arguments = func_get_args();
		for( $i = 0; $i < func_num_args(); $i++ ) {
			$buffer .= '#' . Helper::clean_tag(func_get_arg($i));
			if( $i != func_num_args() - 1 ) {
				$buffer .= ' ';
			}
		}

		$this->_sign .= $buffer;

	}

	public function reset_hashtags() {
		$this->_sign = '';
	}
}