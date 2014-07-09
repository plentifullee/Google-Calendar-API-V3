<?php
//Google Calendar API v3.0
//Examples of retrieving and processing a JSON format google calendar feed
//Created by plentifullee, visit my site at http://plenty.codes

$time_start = microtime(true); //for debugging purposes

$api_key = "replace_me"; //your public access API key from google's developer console, enable calendar api v3
$maxResults = "5"; //max JSON results
$timeMin = urlencode("replace_me"); //start date (ISO 8601 date), eg: 2014-01-01T01:00:00-07:00
$timeMax = urlencode("replace_me"); //end date (ISO 8601 date), eg: 2014-01-31T23:59:59-07:00"
$email = urlencode("replace_me");//replace with your google calendar email, eg: developer-calendar@google.com
$path = "https://www.googleapis.com/calendar/v3/calendars/$email/events?maxResults=$maxResults&orderBy=startTime&singleEvents=true&timeMax=$timeMax&timeMin=$timeMin&key=$api_key";
$feed = json_decode(file_get_contents($path));
echo "<b>Calendar email:</b> ".urldecode($email)."<br>";
echo "<b>Start date:</b> ".urldecode($timeMin)."<br>";
echo "<b>End date:</b> ".urldecode($timeMax)."<br>";
echo "<b>Max results:</b> ".$maxResults."<br>";
echo "<b>Feed URL:</b> <a href='".$path."' target='_blank'>".$path."</a><br><br>";
echo "<hr>";

for($i = 0; $i < $maxResults; $i++) {
	if(isset($feed->{'items'}[$i])) {
		//retrieve event information
		if(isset($feed->{'items'}[$i]->{'summary'})) {
			$cal_summary = $feed->{'items'}[$i]->{'summary'};	
		} else {
			$cal_summary = "Not defined!";
		}	
		if(isset($feed->{'items'}[$i]->{'location'})) {
			$cal_location = $feed->{'items'}[$i]->{'location'};
		} else {
			$cal_location = "Not defined!";
		}
		if(isset($feed->{'items'}[$i]->{'creator'}->{'email'})) {
			$cal_creator_email = $feed->{'items'}[$i]->{'creator'}->{'email'};
		} else {
			$cal_creator_email = "Not defined!";
		}
		if(isset($feed->{'items'}[$i]->{'creator'}->{'displayName'})) {
			$cal_creator_name = $feed->{'items'}[$i]->{'creator'}->{'displayName'};
		} else {
			$cal_creator_name = "Not defined!";
		}
		if(isset($feed->{'items'}[$i]->{'start'}->{'dateTime'})) {
			$cal_start_time = $feed->{'items'}[$i]->{'start'}->{'dateTime'};
		} else {
			$cal_start_time = "Not defined!";
		}
		if(isset($feed->{'items'}[$i]->{'end'}->{'dateTime'})) {
			$cal_end_time = $feed->{'items'}[$i]->{'end'}->{'dateTime'};
		} else {
			$cal_end_time = "Not defined!";
		}
		//output the results
		echo "<b>Event Title:</b> ".$cal_summary."<br>";
		echo "<b>Created by:</b> ".$cal_creator_name."<br>";
		echo "<b>Creator's email:</b> ".$cal_creator_email."<br>";
		echo "<b>Start Time:</b> ".substr($cal_start_time, 0, 10)." ".date("g:ia", strtotime(substr($cal_start_time, 11, 5)))."<br>"; //time format processing
		echo "<b>End Time:</b> ".substr($cal_end_time, 0, 10)." ".date("g:ia", strtotime(substr($cal_end_time, 11, 5)))."<br>";
		echo "<b>Location:</b> ".$cal_location."<br><br>";
	} else {
		break; //if out of loop
	}
}
echo "<hr>";

$time_end = microtime(true); //for debugging purposes
$time = $time_end - $time_start;
echo "<br>Loading time: ".$time;