<?php
if(isset($_POST['textcolor'])){
$textColorPassed=$_POST['textcolor'];
$bgc=$_POST['inverted'];
$triad3=$_POST['triad3'];
echo '<style>body{background-color:#'.$textColorPassed. ';} h2, h2#topHeading {color:'.$triad3.'!important;} .author {color:#'.$textColorPassed.';}</style>';
echo '<style>#container{background-color:'.$bgc.' !important;} div.bookGenre, #nav {background-color:'.$bgc.' !important;filter: brightness(80%); div.bookGenre blockquote {filter:brightness(150%) !important;} </style>';
echo '<style>
div.bookGenre h3 {color:'.$triad3.' !important;filter:brightness(150%);}</style>';
}; 
?>