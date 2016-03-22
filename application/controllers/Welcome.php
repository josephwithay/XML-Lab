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
		 * Day booking search list
		 *************************/
		$weekdays = array();
		
		foreach ($this->timetable->getDays() as $weekday => $weekday_name) 
		{
			$weekdays[] = array('key' => $weekday, 'value' => $weekday_name);
		}
		$data['chooseDay'] = $weekdays;
		
		/*************************
		 * Timeslot booking search list
		 *************************/
		$timeslots = array();
		
		foreach ($this->timetable->getTimeslots() as $timeslot => $timeslot_value) 
		{
			$timeslots[] = array('key' => $timeslot, 'value' => $timeslot_value);
		}
		$data['chooseTimeslot'] = $timeslots;

		$this->parser->parse('welcome', $data);
	}

}
