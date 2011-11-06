<!DOCTYPE HTML>
<html>
<head>
	<title>Paathshaala Search</title>
	<?php
		include 'source.php';
		echo $header;
	?>
	<link rel="stylesheet" href="css/video.css" />
	<link rel="stylesheet" href="css/search.css" />
</head>
<body>
<div id='topbar'></div>
<img src="pics/load.gif" id='loading' style='display:none;'>
<div id='container'>
<?php
	echo $topBar;
	echo $feedback; 
?>
<div class='mainLeft'>
	<span class='smallSubtitle'>Search Results</span>
	<div id=findStuff></div>
	<div id='ShowNext'> Show more results.</div>
	<div id=next></div>
</div>
<div class='mainRight'>
</div>
</div><!-- /container -->
<?php
	echo $bottomBar;
	echo $scripts;
	echo $piwik; 
?>
<script type='text/javascript'>
$(document).ready(function() {

	$('div#next').mouseover(function(){
		var q = getUrlVars()['q'],
				tag = getUrlVars()['tag'];
			Paathshaala.Search( q , tag );
	});

	$('div#next').trigger('mouseover');

});
</script>
</body>
</html>

