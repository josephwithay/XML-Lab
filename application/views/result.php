<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * views/result.php
 *
 */
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>{title}</title>
	</head>
	<body>
		<div id="container">
			<h1>Results</h1>
			<h2>{bingo}</h2>
			{results}
				{facet} :
				<table style="border:solid;">
					<tr>
						<td><b>Course: </b></td>
						<td>{courseCode} {courseType} </td>
					</tr>
					<tr>
						<td><b>Day: </b></td>
						<td>{weekday} - {timeslot} </td>
					</tr>
					<tr>
						<td><b>Instructor: </b></td>
						<td>{instructor} </td>
					</tr>
					<tr>
						<td><b>Room: </b></td>
						<td>{room}</td>
					</tr>
				</table>
			{/results}
		</div>
	</body>
</html>
