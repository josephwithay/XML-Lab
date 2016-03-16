<?php

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
