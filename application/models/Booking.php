<?php

class Booking 
{
	protected $school_day = '';
	protected $period = '';
	protected $course_id = '';
	protected $period_start = '';
	protected $period_end = '';
	protected $room = '';
	protected $instructor = '';
	
	// Constructor
	public function __construct($detail) {
		parent::__construct();
		
		$this->school_day = (string) $detail['school_day'];
		$this->period = (string) $detail['period'];
		$this->course_id = (string) $detail['course_id'];
		$this->period_start = (string) $detail['period_start'];
		$this->period_end = (string) $detail['$period_end'];
		$this->room = (string) $detail['room'];
		$this->instructor = (string) $detail['instructor'];
	}
}