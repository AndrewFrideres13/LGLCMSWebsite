<?php
//If there is no session, let's begin one
if (!session_id()) {
    session_start();
}

if(isset($_POST['textcolor']) || isset($_SESSION['passedColor'])){
	$textColorPassed = $_POST['textcolor'] ?? $_SESSION['passedColor'];
	$bgc = $_POST['inverted'] ?? $_SESSION['passedInverted'];
	$triad3 = $_POST['triad3'] ?? $_SESSION['passedTriad3'];
	//Pass these along to other pages
	$_SESSION['passedColor'] = $textColorPassed;
	$_SESSION['passedInverted'] = $bgc;
	$_SESSION['passedTriad3'] = $triad3;
	echo '<style>body{background-color:#'.$textColorPassed. ';} h2, h2#topHeading {color:'.$triad3.'!important;} .author, div.gameCategory h3, a {color:#'.$textColorPassed.';}</style>';
	echo '<style>#container{background-color:'.$bgc.' !important;} div.bookGenre, #nav {background-color:'.$bgc.' !important;filter: brightness(80%); div.bookGenre blockquote {filter:brightness(150%) !important;} </style>';
	echo '<style>div.bookGenre h3,  nav a, .categoryTitle, .categoryID, #login {color:'.$triad3.' !important;filter:brightness(150%);} table,td, th {border: 1px solid #'.$textColorPassed.';}</style>';
}
?>
