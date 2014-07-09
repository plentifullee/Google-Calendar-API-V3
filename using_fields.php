<?php
//Google Calendar API v3.0
//Examples of using fields to return specific JSON results
//Created by plentifullee, visit my site at http://plenty.codes

$time_start = microtime(true); //for debugging purposes

$api_key = "replace_me"; //your public access API key from google's developer console, enable calendar api v3
$maxResults = "5"; //max JSON results
$timeMin = urlencode("replace_me"); //start date (ISO 8601 date), eg: 2014-01-01T01:00:00-07:00
$timeMax = urlencode("replace_me"); //end date (ISO 8601 date), eg: 2014-01-31T23:59:59-07:00"
$email = urlencode("replace_me");//replace with your google calendar email, eg: developer-calendar@google.com
echo "<b>Calendar email:</b> ".urldecode($email)."<br>";
echo "<b>Start date:</b> ".urldecode($timeMin)."<br>";
echo "<b>End date:</b> ".urldecode($timeMax)."<br>";
echo "<b>Max results:</b> ".$maxResults."<br>";
echo "<hr>";

$path = "https://www.googleapis.com/calendar/v3/calendars/$email/events?maxResults=$maxResults&orderBy=startTime&singleEvents=true&timeMax=$timeMax&timeMin=$timeMin&key=$api_key";
echo "<b>Original Feed URL:</b> <a href='".$path."' target='_blank'>".$path."</a><br><br>";

$fields = urlencode("items/summary"); //getting only the event description on the JSON feed
$path = "https://www.googleapis.com/calendar/v3/calendars/$email/events?maxResults=$maxResults&orderBy=startTime&singleEvents=true&timeMax=$timeMax&timeMin=$timeMin&fields=$fields&key=$api_key";
echo "Restrict results to only: <b>".urldecode($fields)."</b>";
echo "<br><b>Feed URL:</b> <a href='".$path."' target='_blank'>".$path."</a><br><br>"; //output the path used

$fields = urlencode("items/start/dateTime"); //getting only the start dateTime on the JSON feed
$path = "https://www.googleapis.com/calendar/v3/calendars/$email/events?maxResults=$maxResults&orderBy=startTime&singleEvents=true&timeMax=$timeMax&timeMin=$timeMin&fields=$fields&key=$api_key";
echo "Restrict results to only: <b>".urldecode($fields)."</b>";
echo "<br><b>Feed URL:</b> <a href='".$path."' target='_blank'>".$path."</a><br><br>";

$fields = urlencode("items(location, creator(email,displayName))"); //getting only the location and creator info on the JSON feed
$path = "https://www.googleapis.com/calendar/v3/calendars/$email/events?maxResults=$maxResults&orderBy=startTime&singleEvents=true&timeMax=$timeMax&timeMin=$timeMin&fields=$fields&key=$api_key";
echo "Restrict results to only: <b>".urldecode($fields)."</b>";
echo "<br><b>Feed URL:</b> <a href='".$path."' target='_blank'>".$path."</a><br><br>";
echo "<hr>";

$time_end = microtime(true); //for debugging purposes
$time = $time_end - $time_start;
echo "<br>Loading time: ".$time;