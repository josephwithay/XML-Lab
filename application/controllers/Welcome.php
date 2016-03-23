<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index() 
	{
		//defining data array
		$data = array();
		//our default title
		$data['title'] = "Bookings";

		/*************************
		 * Booking by days
		 *************************/
		$days_bookings = $this->timetable->getDays();
		$fragments_by_days = '';
		foreach ($days_bookings as $booking) 
		{
			//parse view fragment and add to string
			$fragments_by_days .= $this->parser->parse('booking', $booking, TRUE);
		}
		$data['days'] = $fragments_by_days;

		/*************************
		 * Booking by timeslots
		 *************************/
		$timeslots_bookings = $this->timetable->getTimeslots();
		$fragments_by_timeslots = '';
		foreach ($timeslots_bookings as $booking) 
		{
			//parse view fragment and add to string
			$fragments_by_timeslots .= $this->parser->parse('booking', $booking, TRUE);
		}
		$data['timeslots'] = $fragments_by_timeslots;
		
		/*************************
		 * Booking by courses
		 *************************/
		$courses_bookings = $this->timetable->getCourses();
		$fragments_by_courses = '';
		foreach ($courses_bookings as $booking) 
		{
			//parse view fragment and add to string
			$fragments_by_courses .= $this->parser->parse('booking', $booking, TRUE);
		}
		$data['courses'] = $fragments_by_courses;
		
		/*************************
		 * Day booking search list
		 *************************/
		$weekdays = array();
		
		foreach ($this->timetable->getDaysDropdown() as $weekday => $weekday_name) 
		{
			$weekdays[] = array('key' => $weekday_name, 'value' => $weekday_name);
		}
		$data['chooseDay'] = $weekdays;
		
		/*************************
		 * Timeslot booking search list
		 *************************/
		$timeslots = array();
		
		foreach ($this->timetable->getTimeslotsDropdown() as $timeslot => $timeslot_value) 
		{
			$timeslots[] = array('key' => $timeslot_value, 'value' => $timeslot_value);
		}
		$data['chooseTimeslot'] = $timeslots;
		
		/*************************
		 * Getting session data
		 *************************/
		$currentResult = $this->session->userdata('currentResult');

		if (isset($currentResult)) 
		{
			$data['searchResult'] = $this->parser->parse('booking', $currentResult, TRUE);
		} else 
		{
			$data['searchResult'] = 'No data found.';
		}

		$this->parser->parse('welcome', $data);
	}
	
	public function search() 
	{	
		$this->load->model('booking');
		//instantiate variables to be used
		$data = array();
		$results = array();
		$bingo = false; // check for bingo condition
		
		//get day and timeslot via get_post data
		$day = $this->input->get_post('chooseDay', TRUE);
		$timeslot = $this->input->get_post('chooseTimeslot', TRUE);
		
		// write a string to show what the user searched for and what results 
		// are being displayed
		$data['title'] = "Bookings for " . $day . "@" . $timeslot;
		
		//matching bookings by day results to be added to results array
		foreach ($this->timetable->searchTimetableByDay($day, $timeslot) as $booking) 
		{
			$booking = (array) $booking;
			$dayFacet = $booking;
			$booking['facet'] = "By Day";
			$results[] = $booking;
		}
		//matching bookings by timeslot results to be added to results array
		foreach ($this->timetable->searchTimetableByTimeslot($day, $timeslot) as $booking) 
		{
			$booking = (array) $booking;
			$timeslotFacet = $booking;
			$booking['facet'] = "By Timeslot";
			$results[] = $booking;
		}
		//matching bookings by course results to be added to results array
		foreach ($this->timetable->searchTimetableByCourse($day, $timeslot) as $booking) 
		{
			$booking = (array) $booking;
			$courseFacet = $booking;
			$booking['facet'] = "By Course";
			$results[] = $booking;
		}

		/*************************
		 * Checking for Bingo
		 *************************/
		if (isset($dayFacet) && isset($timeslotFacet) && isset($courseFacet))
		{
			 if ($dayFacet == $timeslotFacet && $dayFacet == $courseFacet )
			{
			  $bingo = true;
			}
		}
		// show single common result if all 3 match
		if ($bingo)
		{
			$timeslotFacet['facet'] = "Any";
			$data['results'] = array($timeslotFacet);
			$data['bingo'] = "Bingo!";

			//set userdata
			$this->session->set_userdata('currentResult', $timeslotFacet);
		} else 
		{
			$data['bingo'] = "No bingo!";
			//put the results in data
			$data['results'] = $results;
			//set userdata
			$this->session->set_userdata('currentResult', NULL);
		}
		//parse the template
		$this->parser->parse('result', $data);
	}

}
