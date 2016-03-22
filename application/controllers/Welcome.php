<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 * 	- or -
	 * 		http://example.com/index.php/welcome/index
	 * 	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index() 
	{
		$this->data = array();
		//our default title
		$this->data['title'] = "Bookings";

		//bookings by days
		$days_bookings = $this->timetable->getDays();
		$fragments_by_days = '';
		foreach ($days_bookings as $booking) 
		{
			//parse view fragment and add to string
			$fragments_by_days .= $this->parser->parse('booking', $booking, TRUE);
		}
		$data['days'] = $fragments_by_days;

//fill booking search lists
		$list_weekdays = array();
		foreach ($this->timetable->getDays() as $weekday => $weekday_value) 
		{
			$list_weekdays[] = array('key' => $weekday, 'value' => $weekday_value);
		}
		$data['chooseDay'] = $list_weekdays;

		$this->load->view('welcome');
	}

}
