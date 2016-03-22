<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>{title}</title>
	</head>

	<body>

		<div id="container">

			<h1>Results</h1>
			<h2>{bingo}</h2>
			{result}
			<p>{facet} : {courseCode}{courseType} | {weekday}: {start}-{end} | {instructor} | {room}</p>
			{/result}

		</div>

	</body>
</html>
