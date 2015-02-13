<?php 

class Artist {

	public $_name;

	public function __construct( $name = 'lyrics') {
		$this->_name = $name;
	}

	/**
	 * Recupera dei versi a caso dell'artista
	 * @param  integer $lines quante linne tirare fuori
	 * @return array stringa, album, canzone
	 */
	public function getRandomLyrics( $max_lines = 2 ) {

		$albums = scandir('./lyrics/' . $this->_name);
		$albums = array_values(array_filter( $albums, 'Helper::filter_scan_dir'));
		$album_index = rand(0, count($albums) - 1);

		$songs = scandir( './lyrics/' . $this->_name . '/' . $albums[$album_index] );
		$songs = array_values(array_filter( $songs, 'Helper::filter_scan_dir'));
		$song_index = rand(0, count($songs) - 1);

		$filename = './lyrics/' . $this->_name . '/' . $albums[$album_index] . '/' . $songs[$song_index];

		if( defined('DEBUG') ) {
			echo "filname $filename\n";
		}

		$handle = fopen($filename, 'r');

		$buffer = array();

		if( $handle ) {
			while( ($line = fgets($handle)) !== false ){
				array_push( $buffer, $line);
			}
			if (!feof($handle)) {
				echo 'Errore';
			}
		}

		fclose( $handle );

		$first_line = rand(0, count($buffer) - $max_lines );

		$string = '';
		for( $i = 0; $i < $max_lines; $i++ ) {
			$string .= $buffer[$first_line + $i];
		}

		if( $string === '' ) {
			return false;
		}

		return array( $string . "\n", $albums[$album_index], $songs[$song_index] );

	}

}