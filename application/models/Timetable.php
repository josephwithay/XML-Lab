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
		$record = array();

		//build a full list of days
		foreach ($this->xml->days as $days)
		{
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

					$this->days[] = new Booking($record);
				}
			}
		}

		//build a full list of timeslots
		foreach ($this->xml->timeslots as $timeslots)
		{
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

					$this->timeslots[] = new Booking($record);
				}
			}
		}

		//build a full list of courses
		foreach ($this->xml->courses as $courses)
		{
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

					$this->courses[] = new Booking($record);
				}
			}
		}

		/*
		 * *******************************************
		 * Debugging Mode
		 * ******************************************** 
		 */
		print_r($this->timeslots);
		die();
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
//retrieve a list of days as an assoc. array
	function getDays()
	{
		return isset($this->days) ? $this->days : null;
	}

//retrieve a list of timeslots
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
		$this->courseType = (string) $detail['courseType'];
		$this->courseCode = (string) $detail['courseCode'];
		$this->start = (string) $detail['start'];
		$this->end = (string) $detail['end'];
		$this->room = (string) $detail['room'];
		$this->instructor = (string) $detail['instructor'];
	}
}