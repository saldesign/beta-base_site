<?php 
signedin(1);


 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Admin Panel</title>
	<link rel="stylesheet" type="text/css" href="../css/reset.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,400italic">
	<link rel="stylesheet" type="text/css" href="admin.css">
</head>
<body>


<header role="banner">
  <h1>Admin Panel</h1>
  <ul class="utilities">
    <li class="users"><a href="#">Logged in as: <?php echo USERNAME; ?></a></li>
    <li class="logout warn"><a href="../signin.php?action=logout">Log Out</a></li>
  </ul>
</header>