<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index() 
	{
		//defining data array
		$data = array();
		//our default title
		$this->data['title'] = "Bookings";

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
		 * Booking search list
		 *************************/
		$weekdays = array();
		foreach ($this->timetable->getDays() as $weekday => $weekday_value) 
		{
			$weekdays[] = array('key' => $weekday, 'value' => $weekday);
		}
		$data['chooseDay'] = $weekdays;

		$this->parser->parse('welcome', $data);
	}

}
