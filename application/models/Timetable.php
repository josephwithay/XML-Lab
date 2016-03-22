<?php

/**
 *  This is a model for the control data in our timetable slots
 */
class Timetable extends CI_Model
{

	protected $xml = null;
	protected $schedule = null;
	
	protected $days = array();
	protected $timeslots = array();
	protected $courses = array();
	
	protected $daysDropdown = array();
	protected $timeslotsDropdown = array();

	public function __construct()
	{
		parent::__construct();
		
		//load the xml files
		$this->xml = simplexml_load_file(DATAPATH . 'master' . XMLSUFFIX, "SimpleXMLElement", LIBXML_NOENT);
		$this->schedule = simplexml_load_file(DATAPATH . 'timetable' . XMLSUFFIX, "SimpleXMLElement", LIBXML_NOENT);
		
		$record = array();
		
		foreach ($this->schedule->days as $daysD)
		{
			$this->daysDropdown = $daysD;
		}

		foreach ($this->schedule->timeslots as $timeslotsD)
		{
			$this->timeslotsDropdown = $timeslotsD;
		}
		
		//build a full list of days
		foreach ($this->xml->days as $days)
		{
			//there is more than one day in weekdays
			foreach ($days->day as $day)
			{
				//a day can have more than one booking
				foreach ($day->booking as $booking)
				{
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

					//add records into days array
					$this->days[] = new Booking($record);
				}
			}
		}

		//build a full list of timeslots
		foreach ($this->xml->timeslots as $timeslots)
		{
			//there is more than one timeslot
			foreach ($timeslots->timeslot as $time)
			{
				//a timeslot can have more than one booking
				foreach ($time->booking as $booking)
				{
					$time = $booking[0]->timeslot;
					$record['start'] = $timeslot['start'];
					$record['end'] = $timeslot['end'];

					$day = $booking[0]->day;
					$record['weekday'] = $day['weekday'];

					$courseCode = $booking[0]->courseCode;
					$record['courseCode'] = $courseCode;

					$courseType = $booking[0]->courseType;
					$record['courseType'] = $courseType;

					$room = $booking[0]->room;
					$record['room'] = $room;

					$instructor = $booking[0]->instructor;
					$record['instructor'] = $instructor;

					//add records into timeslots array
					$this->timeslots[] = new Booking($record);
				}
			}
		}

		//build a full list of courses
		foreach ($this->xml->courses as $courses)
		{
			//there is more than one course
			foreach ($courses->course as $course)
			{
				//a course can have more than one booking
				foreach ($course->booking as $booking)
				{
					$record['courseCode'] = $course['courseCode'];

					$day = $booking[0]->day;
					$record['weekday'] = $day['weekday'];

					$timeslot = $booking[0]->timeslot;
					$record['start'] = $timeslot['start'];
					$record['end'] = $timeslot['end'];

					$courseType = $booking[0]->courseType;
					$record['courseType'] = $courseType;

					$room = $booking[0]->room;
					$record['room'] = $room;

					$instructor = $booking[0]->instructor;
					$record['instructor'] = $instructor;

					//add records into courses array
					$this->courses[] = new Booking($record);
				}
			}
		}

		/*
		 * *******************************************
		 * Debugging Mode
		 * ******************************************** 
		 */
//		echo 'DAYS ARRAY </ br>';
//		print_r($this->days);
//		echo 'TIMESLOTS ARRAY </ br>';
//		print_r($this->timeslots);
//		echo 'COURSES ARRAY';
//		print_r($this->timeslotsDropdown);
//		die();


	}

	/*
	 * ************************************************
	 * Search Methods by each Facet
	 * ************************************************
	 */
	function searchTimetableByDay($day,$slot)
	{
		
	}

	function searchTimetableByTimeslot($day,$slot)
	{
		
	}

	function searchTimetableByCourse($day,$slot)
	{
		
	}

	/*
	 * ************************************************
	 * Accessors
	 * ************************************************
	 */
	//retrieve a list of days 
	function getDaysDropdown()
	{
		return isset($this->daysDropdown) ? $this->daysDropdown : null;
	}

	//retrieve a list of timeslots
	function getTimeslotsDropdown()
	{
		return isset($this->timeslotsDropdown) ? $this->timeslotsDropdown : null;
	}
	//retrieve a list of days as an assoc. array
	function getDays()
	{
		return isset($this->days) ? $this->days : null;
	}

	//retrieve a list of timeslots as an assoc. array
	function getTimeslots()
	{
		return isset($this->timeslots) ? $this->timeslots : null;
	}

	//retrieve a list of courses
	function getCourses()
	{
		return isset($this->courses) ? $this->courses : null;
	}

}

Class Booking extends CI_Model
{

	public $weekday = "";
	public $start = "";
	public $end = "";
	public $courseType = "";
	public $courseCode = "";
	public $room = "";
	public $instructor = "";

	// Constructor
	public function __construct($detail=null)
	{
		parent::__construct();
		$this->weekday = (String) $detail['weekday'];
		$this->start = (String) $detail['start'];
		$this->end = (String) $detail['end'];
		$this->courseType = (String) $detail['courseType'];
		$this->courseCode = (String) $detail['courseCode'];
		$this->room = (String) $detail['room'];
		$this->instructor = (String) $detail['instructor'];
	}
}