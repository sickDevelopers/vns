<?php 

ini_set('display_errors', '1');
date_default_timezone_set('Europe/Rome');

require 'vendor/autoload.php';
?>

<html>
	<head><title>VNS</title>

	<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
	<script>
		$(document).ready( function() {

			$('#tweet').on('click', function(ev) {
				ev.preventDefault();

				$.ajax({
					url: 'script.php',
					success: function(data) {
						$('body').append(data);
					}
				})	
			})

			$('#debug').on('click', function(ev) {
				ev.preventDefault();

				$.ajax({
					url: 'script.php',
					data: {
						debug: 1
					},
					method: 'GET',
					success: function(data) {
						$('body').append(data);
					}
				})	
			})
			
		})
	</script>

	</head>
	<body>
		<button id="tweet">Posta Tweet</button>
		<button id="debug">Debug</button>
	</body>
</html>

