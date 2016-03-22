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
		$this->xml = simplexml_load_file(DATAPATH . 'master' . XMLSUFFIX, "SimpleXMLElement", LIBXML_NOENT);

		//build a full list of days
		foreach ($this->xml->days->day as $day)
		{
			 //a day can have more than one booking
            foreach($day->booking as $booking)
            {
			$record = array();
			
			$record['weekday'] = $day['weekday'];
			
			$timeslot = $booking[0]->timeslot;
			$record['start'] = $timeslot['start'];
			$record['end'] = $timeslot['end'];
			
			$courseType = $booking[0]->courseType;
			$record['courseType'] = $courseType;
			
			$courseCode = $booking[0]->courseCode;
			$record['courseCode'] = $courseCode;
			
			$room = $booking[0]->room;
			$record['room'] = $room;
			
			$instructor = $booking[0]->instructor;
			$record['instructor'] = $instructor;
			
			
			$this->days[] = new Booking($record);
			
			}
			
			print_r($this->days);
			die();
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
	public $courseType = "";
	public $courseCode = "";
	public $start = "";
	public $end = "";
	public $room = "";
	public $instructor = "";

	// Constructor
	public function __construct($detail)
	{
		parent::__construct();
		$this->weekday = (String) $detail['weekday'];
		$this->timeslot = (string) $detail['timeslot'];
		$this->courseType = (string) $detail['courseType'];
		$this->courseCode = (string) $detail['courseCode'];
		$this->start = (string) $detail['start'];
		$this->end = (string) $detail['end'];
		$this->room = (string) $detail['room'];
		$this->instructor = (string) $detail['instructor'];
	}

}
