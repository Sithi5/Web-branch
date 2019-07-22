<?php session_start();?>
<html>
	<head>
		<meta http-equiv="refresh" content="60"/>

		<meta charset="UTF-16">
		<title>Mes projets Web</title>
		<link rel="stylesheet" type="text/css" href="./css/index.css">
	</head>

	<body>
		<?php include 'menu.php' ?>
		<div class="slide-container">
			<img id="images-slideshow" src="ressources\img\menu-des-roulants-preview.jpg" alt="slideshow" >
			<p id="current-slide-number"></p>
			<a class="prev"onclick="slideShow(-1, 1, 0, 0)">&#10094;</a>
			<a class="next" onclick="slideShow(1, 1, 0, 0)">&#10095;</a>
			<div style="text-align:center">
				<a class="dot"onclick="slideShow(0, 1, 1, 0)"></a>
				<a class="dot"onclick="slideShow(0, 1, 2, 0)"></a>
				<a class="dot"onclick="slideShow(0, 1, 3, 0)"></a>
			</div>
		</div>
		<div id="button-container">
			<button class="button" id="boutton-menu-des-roulants" type="button" onclick="window.location.href = 'menu.html';">menu des roulants</button>
			<button class="button" id="boutton-inscription" type="button" onclick="window.location.href = 'inscription';">inscription</button>
			<button class="button" id="boutton-camagru" type="button" onclick="window.location.href = 'Camagru';">Camagru</button>
		</div>
		<button class="button" type="button" onclick="Hide_button()">Show/Hide Buttons</button>

		<!--- login part--->

		<form action="" method="post">
    <input type="text" name="username" placeholder="Enter your username" required>
    <input type="password" name="password" placeholder="Enter your password" required>
    <input type="submit">
	</body>
</html>

<script src="index.js"></script>
<script src="hashing.js"></script>