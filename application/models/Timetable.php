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
			$this->days[] = new Booking($day);
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
		$this->weekday = (string) $detail['weekday'];
		$this->timeslot = (string) $detail['timeslot'];
		$this->courseCode = (string) $detail['courseCode'];
		$this->periodStart = (string) $detail['periodStart'];
		$this->periodEnd = (string) $detail['periodEnd'];
		$this->room = (string) $detail['room'];
		$this->instructor = (string) $detail['instructor'];
	}

}

//function getDays(){
//	
//}
//
//function getCourses(){
//	
//}
//
//function getTimeslots(){
//	
//}
//
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