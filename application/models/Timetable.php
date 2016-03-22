<?php

/**
 *  This is a model for the control data in our timetable slots
 */
class Timetable extends CI_Model
{

	protected $xml = null;
	protected $days = array();
	protected $timeslots = array();
	protected $courses = array();

	public function __construct()
	{
		parent::__construct();
		$this->xml = simplexml_load_file(DATAPATH . 'master.xml', "SimpleXMLElement", LIBXML_NOENT);

		//build a full list of days
		foreach ($this->xml->days->day as $day)
		{
			 //a day can have more than one booking
            foreach($day->booking as $booking)
            {
			$record = array();
			
			$record['weekday'] = $day['weekday'];
			$record['timeslot'] = $booking['timeslot'];
			$record['courseCode'] = $booking['courseCode'];
			$record['periodStart'] = $booking['periodStart'];
			$record['periodEnd'] = $booking['periodEnd'];
			$record['room'] = $booking['room'];
			$record['instructor'] = $booking['instructor'];
			$this->days[] = new Booking($record);
			
			}
		}

		//build a full list of timeslots
		foreach ($this->xml->timeslots->timeslot as $time)
		{
			$this->timeslots[] = new Booking($time);
		}

		//build a full list of courses
		foreach ($this->xml->courses->course as $course)
		{
			$this->courses[] = new Booking($course);
		}
	}

	//retrieve a list of days as an assoc. array
	function getDays(){
		return $this->days;
	}
	//retrieve a list of courses
	function getCourses(){
		return $this->courses; 
	}
	//retrieve a list of timeslots
	function getTimeslots(){
		return $this->timeslots; 
	}	
	//function searchTimetableByDay(){
	//	
	//}
	//
	//function searchTimetableByTimeslot(){
	//	
	//}
	//
	//function searchTimetableByCourse(){
	//	
	//}
}

Class Booking extends CI_Model
{

	public $weekday = "";
	public $timeslot = "";
	public $courseCode = "";
	public $periodStart = "";
	public $periodEnd = "";
	public $room = "";
	public $instructor = "";

	// Constructor
	public function __construct($detail)
	{
		parent::__construct();
		$this->weekday = (String) $detail['weekday'];
		$this->timeslot = (string) $detail['timeslot'];
		$this->courseCode = (string) $detail['courseCode'];
		$this->periodStart = (string) $detail['periodStart'];
		$this->periodEnd = (string) $detail['periodEnd'];
		$this->room = (string) $detail['room'];
		$this->instructor = (string) $detail['instructor'];
	}

}
