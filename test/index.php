<!DOCTYPE html> 

<html style="width: 100%; height: 100%;" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>View</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>

<body>
<script>
function keyListener(e) {
	switch (e.keyCode) {
	case 37:
		alert('left');
		break;
	case 39:
		alert('right');
		break;
	}
};

document.onkeydown = keyListener;
</script>

</body>

</html>
