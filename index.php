<?php
require 'flight/Flight.php';

Flight::register('db', 'PDO', array('mysql:host=127.0.0.1;port=3306;dbname=Contest', 'root', ''), function($db) {
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
});

Flight::route('/', function(){
  Flight::render('homepage');
});

/**
Standings retrieves the latest standings
from the database and returns them in JSON format.
This allows the page to parse the content.
*/
Flight::route('/standings', function(){
  $conn = Flight::db();

  $standings = $conn->query('SELECT DISTINCT name, problemNumber, correct, time AS submitted
    FROM 2013_Solutions s INNER JOIN 2013_Teams t ON s.teamID = t.id ORDER BY name ASC, problemNumber ASC, minutes ASC');

  $minutes   = $conn->query('SELECT sum(minutes) AS timeTaken, name FROM 2013_Solutions s
    INNER JOIN 2013_Teams t on s.teamID = t.id WHERE s.correct="y" GROUP BY t.id');

  $onePoint  = $conn->query('SELECT count(correct), name FROM 2013_Solutions s
    INNER JOIN 2013_Teams t ON s.teamID = t.id WHERE correct = \'Y\' and problemNumber > 7 GROUP BY teamID');

  $twoPoint  = $conn->query('SELECT count(correct), name FROM 2013_Solutions s
    INNER JOIN 2013_Teams t ON s.teamID = t.id WHERE correct = \'Y\' and problemNumber < 7 GROUP BY teamID');


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