<?php
 
require dirname(__FILE__) . '/utils.php';
 
if (!isset($_GET['start']) || !isset($_GET['end'])) {
  die("Please provide a date range.");
}

$range_start = parseDateTime($_GET['start']);
$range_end = parseDateTime($_GET['end']);
 
$time_zone = null;
if (isset($_GET['timeZone'])) {
  $time_zone = new DateTimeZone($_GET['timeZone']);
}
 
$json = file_get_contents(dirname(__FILE__) . '/../json/events.json');

$input_arrays = json_decode($json, true);

 
$output_arrays = array();
foreach ($input_arrays as $array) {

 
  $event = new Event($array, $time_zone);

 
  if ($event->isWithinDayRange($range_start, $range_end)) {
    $output_arrays[] = $event->toArray();
  }
}

echo json_encode($output_arrays);
