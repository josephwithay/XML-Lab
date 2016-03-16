<?php
/**
 *  This is a model for the control data in our timetable slots
 */
class Timetable extends CI_Model{
    
    protected $xml = null;
    protected $days = array();
    protected $timeslots = array();
    protected $courses = array();
    
    
    public function __construct() {
        parent::__construct();
        $this->xml = simplexml_load_file(DATAPATH . 'timetable.xml');
        
        //build a full list of days
        foreach($this->xml->days->day as $day){
            $this->days[] = new Booking($day);
        }
        
        //build a full list of timeslots
        foreach($this->xml->timeslots->timeslot as $time){
            $this->timeslots[] = new Booking($time);
        }
        
        //build a full list of courses
        foreach($this->xml->courses->course as $course){
            $this->courses[] = new Booking($course);
        }
    }
}
