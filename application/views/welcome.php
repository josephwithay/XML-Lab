<?php
if (!defined('APPPATH'))
	exit('No direct script access allowed');
/**
 * views/template.php
 *
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8"/>
		<title>{title}</title>
	</head>
	<body>
		<div class="container">
			<div class="bookingsearch">
				<h1>Search for courses!</h1>
				<form name="search" action='welcome/search' id="dropdownsearch">
					<select name="dropdownDays">
						{chooseDay}
						<option value="{key}">{value}</option>
						{/chooseDay}
					</select>
					<select name="dropdownTimeslots">
						{chooseTimeslot}
						<option value="{key}">{value}</option>
						{/chooseTimeslot}
					</select>
					<input type='submit' value='Submit'>
				</form>
				<div id="indexedList">
					<h1>Bookings by Day</h1>
					{days}    
					<h1>Bookings by Timeslot</h1>
					{timeslots}
					<h1>Bookings by Course</h1>
					{courses}
				</div>
				<div id="bookingResult">
					<h1>Results:</h1>
					{searchResult}
				</div>
			</div>
		</div>
	</body>
</html>
