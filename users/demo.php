<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Untitled 1</title>
<link rel="stylesheet" href="../style/box.css">
<script type="text/javascript">
<!--
    function toggle_visibility(id) {
       var e = document.getElementById(id);
      
          e.style.display = 'block';
    }
//-->
</script>
</head>

<body>
<!--<div class="alert-box error"><span>error: </span>Write your error message here.</div>
<div class="alert-box success"><span>success: </span>Write your success message here.</div>
<div class="alert-box warning"><span>warning: </span>Write your warning message here.</div>
<div class="alert-box notice"><span>notice: </span>Write your notice message here.</div>-->
</body>
<form>
<a href="#" onclick="toggle_visibility('foo');">Click here to toggle visibility of element #foo</a>
<input type="submit" onclick="toggle_visibility('foo');">

<div class="alert-box success"  id="foo" style="display: none;"><span>success: </span>Write your success message here.</div>
</form>
</html>
