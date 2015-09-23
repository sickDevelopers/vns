<?php

class NOIA {

	/**
	 * Prende i testi a caso e li twitta
	 * @return [type] [description]
	 */
	public static function go_alone_baby( $max_attempts = 3) {

		$attempts = 0;

		$artist = new Artist(ARTIST_NAME);
		list($lyrics, $album, $song) = $artist->getRandomLyrics();

		$tweet = new TwitterPost;
		$tweet->add_hashtags( $artist->_name, $album, $song );
		$result = $tweet->send( $lyrics );


		while( $result->httpstatus != 200 && $attempts < $max_attempts ) {
			$attempts++;
			
			list($lyrics, $album, $song) = $artist->getRandomLyrics();

			$tweet = new TwitterPost;
			$tweet->add_hashtags( $artist->_name, $album, $song );

			$result = $tweet->send( $lyrics );
		}

		var_dump( $result );

	}


	public static function go_debug() {

		echo "debug\n";

		$artist = new Artist(ARTIST_NAME);
		list($lyrics, $album, $song) = $artist->getRandomLyrics();

		var_dump($lyrics);

		$tweet = new TwitterPost;
		$tweet->add_hashtags( $artist->_name, $album, $song );

		var_dump( $tweet->_sign );

	}


	public static function go_login_and_debug() {

		echo "debug\n";
		if( Twitter::sign_in() ) {

			$artist = new Artist(ARTIST_NAME);
			list($lyrics, $album, $song) = $artist->getRandomLyrics();

			$tweet = new TwitterPost;
			$tweet->add_hashtags( $artist->_name, $album, $song );

			$result = $tweet->send( $lyrics );

			var_dump( $result );
		}

	}

}