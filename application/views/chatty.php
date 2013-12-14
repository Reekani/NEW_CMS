<?php
session_start();
$_SESSION['username'] = $me; // Must be already set

echo $_SESSION['username'];
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/loose.dtd" >

<html>
<head>
<title>Sample Chat Application</title>
<style>
body {
	background-color: #eeeeee;
	padding:0;
	margin:0 auto;
	font-family:"Lucida Grande",Verdana,Arial,"Bitstream Vera Sans",sans-serif;
	font-size:11px;
}
</style>



</head>
<body>
<div id="main_container">

<a href="javascript:void(0)" onclick="javascript:chatWith('<?=$you?>')">Chat With <?=$you?></a>

<!-- YOUR BODY HERE -->

</div>



</body>
</html>