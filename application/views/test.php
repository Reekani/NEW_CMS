<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >

<head>
<title>j</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link type="text/css" rel="stylesheet" href="js/autocomplete.css"  />
        <script type="text/javascript" src="js/jquery-1.3.2.js"></script>
        <script type="text/javascript" src="css/autocomplete.js"></script> 

</head>
<body>

<form onsubmit="return false;" action="">
<input type="text" style="width: 300px;" value="" id="auto" class="ac_input"/>

</form>

<script type="text/javascript">

$("#auto").autocomplete(
"dane.php",
{
delay:10,
minChars:1,
matchSubset:1,
matchContains:1,
cacheLength:10,
autoFill:false,
matchCase: false,
selectFirst: false,
max:10,
scrollHeight: 180,
mustMatch: false

}
);

</script>
</body>
</html> 