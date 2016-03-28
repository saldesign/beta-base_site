	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="initial-scale=1.0">

		<title>Home - Beta-Base</title>
		<link rel="stylesheet" type="text/css" href="css/reset.css">
		<link href="font/css/beta-base.css" rel="stylesheet" type="text/css" />
		<link href='https://fonts.googleapis.com/css?family=Fira+Sans:400,500italic,400italic,700,500|Open+Sans:400,600,700,400italic,600italic' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="css/main.css">
	</head>
	<body class="cf">
	<header class="cf">
		<div class="maincontainer">
			<h1><a href="index.php"><span>Beta-Base - Rock Climbing Guide</span></a></h1>
			<a href="#menu" class="menu-link icon-menu"></a>
			<nav class="main-nav cf" role="navigation">
				<ul>
					<li><a href="signin.php" class="<?php if($thisPage == "signin"){
						echo "currentpage";
						} ?>">Sign In/Up</a></li>
					<li><a href="about.php" class="<?php if($thisPage == "about"){
						echo "currentpage";
						} ?>">About</a></li>
					<li><a href="share.php" class="<?php if($thisPage == "share"){
						echo "currentpage";
						} ?>">Share</a></li>
					<li><a href="find.php" class="<?php if($thisPage == "find"){
						echo "currentpage";
						} ?>">Find</a></li>
				</ul>
			</nav>
		</div>	
	</header>
