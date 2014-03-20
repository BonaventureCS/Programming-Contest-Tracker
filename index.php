<?php
date_default_timezone_set('America/New_York');
require 'flight/Flight.php';
require'settings.php'; //EDIT THIS FILE ON DAY OF CONTEST


Flight::register('db', 'PDO', array('mysql:host=127.0.0.1;port=3306;dbname=Contest', 'root', ''), function($db) {
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
});

Flight::route('/', function(){
  $conn = Flight::db();

  $schools = $conn->query('SELECT * FROM 2013_Teams ORDER BY name');

  Flight::render('homepage', array('schools' => $schools));
});

Flight::route('/submission', function() {
  $conn = Flight::db();

  $stmt = $conn->prepare("INSERT INTO 2013_Solutions (teamID, problemNumber, time, minutes, correct, comments)
    VALUES (:teamID, :problemNumber, :time, :minutes, :correct, :comments)");

  $stmt->bindParam(':teamID', $_POST['team']);
  $stmt->bindParam(':problemNumber', $_POST['problem']);
  $stmt->bindParam(':time', $_POST['time']);
  $stmt->bindParam(":correct", $_POST['correct']);
  $stmt->bindParam(":comments", $_POST['comments']);

  global $contestStartTimeAndDate;

  $start = date("h:i:s", $contestStartTimeAndDate);
  $end =  date("h:i:s", strtotime($_POST['time']));

  $now = new DateTime($end);
  $ref = new DateTime($start);
  $diff = $now->diff($ref);
  $hours = $diff->h;
  $times = $diff->i;
  $interval = ($hours * 60) + $times + 1;

  $stmt->bindParam(":minutes", $interval);
  $stmt->execute();

});

/**
Standings retrieves the latest standings
from the database and returns them in JSON format.
This allows the page to parse the content.
*/
Flight::route('/standings', function(){
  $conn = Flight::db();

  $standings = $conn->query('SELECT DISTINCT name, problemNumber, correct, teamID, time AS submitted
    FROM 2013_Solutions s INNER JOIN 2013_Teams t ON s.teamID = t.id ORDER BY name ASC, problemNumber ASC, minutes ASC');

  $minutes   = $conn->query('SELECT sum(minutes) AS timeTaken, name, teamID FROM 2013_Solutions s
    INNER JOIN 2013_Teams t on s.teamID = t.id WHERE s.correct="Y" GROUP BY t.id');

  $onePoint  = $conn->query('SELECT count(correct) as onePointers, name, teamID FROM 2013_Solutions s
    INNER JOIN 2013_Teams t ON s.teamID = t.id WHERE correct = \'Y\' and problemNumber > 7 GROUP BY teamID');

  $twoPoint  = $conn->query('SELECT count(correct) as twoPointers, name, teamID FROM 2013_Solutions s
    INNER JOIN 2013_Teams t ON s.teamID = t.id WHERE correct = \'Y\' and problemNumber <= 7 GROUP BY teamID');


  $returnArr   = array();
  $standingArr = array();
  $minutesArr  = array();
  $onePointArr = array();
  $twoPointArr = array();

  foreach($standings as $row) {
    array_push($standingArr, $row);
  }

  foreach($minutes as $row) {
    array_push($minutesArr, $row);
  }

  foreach($onePoint as $row) {
    array_push($onePointArr, $row);
  }

  foreach($twoPoint as $row) {
    array_push($twoPointArr, $row);
  }

  array_push($returnArr, $standingArr);
  array_push($returnArr, $minutesArr);
  array_push($returnArr, $onePointArr);
  array_push($returnArr, $twoPointArr);


  Flight::json($returnArr);
});

Flight::start();
?>