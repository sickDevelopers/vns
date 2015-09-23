<?php

class Twitter {
	
	public static function sign_in( ) {

		\Codebird\Codebird::setConsumerKey(API_KEY, OAUTH_SECRET);
		$cb = \Codebird\Codebird::getInstance();

		session_start();
		// session_destroy();

		// store keys
		$file_tokens = parse_ini_file( BASE_DIR . '/tokens.ini' );
		if( isset($file_tokens['oauth_token']) && isset($file_tokens['oauth_token_secret']) ) {
			$_SESSION['oauth_token'] = $file_tokens['oauth_token'];
		    $_SESSION['oauth_token_secret'] = $file_tokens['oauth_token_secret'];
		}

		if (! isset($_SESSION['oauth_token'])) {

		    // get the request token
		    $reply = $cb->oauth_requestToken(array(
		        'oauth_callback' => 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']
		    ));

		    // store the token
		    $cb->setToken($reply->oauth_token, $reply->oauth_token_secret);
		    $_SESSION['oauth_token'] = $reply->oauth_token;
		    $_SESSION['oauth_token_secret'] = $reply->oauth_token_secret;
		    $_SESSION['oauth_verify'] = true;

		    // redirect to auth website
		    $auth_url = $cb->oauth_authorize();
		    header('Location: ' . $auth_url);
		    die();

		 }	elseif (isset($_GET['oauth_verifier']) && isset($_SESSION['oauth_verify'])) {

		    // verify the token
		    $cb->setToken($_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
		    unset($_SESSION['oauth_verify']);

		    // get the access token
		    $reply = $cb->oauth_accessToken(array(
		        'oauth_verifier' => $_GET['oauth_verifier']
		    ));

		    // store the token (which is different from the request token!)
		    $_SESSION['oauth_token'] = $reply->oauth_token;
		    $_SESSION['oauth_token_secret'] = $reply->oauth_token_secret;

		    $f = @fopen(BASE_DIR . "/tokens.ini", "r+");
			if ($f !== false) {
			    ftruncate($f, 0);
			    fwrite( "oauth_token=" . $reply->oauth_token . "\n");
			    fwrite( "oauth_token_secret=" . $reply->oauth_token_secret . "\n");
			}
			fclose($f);

		    // send to same URL, without oauth GET parameters
		    header('Location: ' . BASE_DIR . '/script.php?debug=1');
		    die();
		}

		// ADESSO HAI I TOKEN
		$cb->setToken($_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

		$reply = (array) $cb->statuses_homeTimeline();
		if( $reply['httpstatus'] == '200') {
			return true;
		}

		return false;

	}


}