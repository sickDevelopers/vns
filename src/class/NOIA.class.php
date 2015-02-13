<?php

class NOIA {

	/**
	 * Prende i testi a caso e li twitta
	 * @return [type] [description]
	 */
	public static function go_alone_baby() {

		$artist = new Artist('verdena');
		list($lyrics, $album, $song) = $artist->getRandomLyrics();

		$tweet = new TwitterPost;
		$tweet->add_hashtags( $artist->_name, $album, $song );
		var_dump( $tweet->send( $lyrics ) );
	}


	public static function go_debug() {

		echo "debug\n";

		$artist = new Artist('verdena');
		list($lyrics, $album, $song) = $artist->getRandomLyrics();

		var_dump($lyrics);

		$tweet = new TwitterPost;
		$tweet->add_hashtags( $artist->_name, $album, $song );

		var_dump( $tweet->_sign );

	}

}