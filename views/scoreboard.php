<?php date_default_timezone_set( "America/New_York"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Computer Science Department at St. Bonaventure University">

  <title>High School Programming Contest Scoreboard</title>

  <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
    </head>

    <body>

      <div class="container">
        <div class="header">
          <h3>St. Bonaventure University High School Programming Contest <?php echo date("Y"); ?> - Scoreboard</h3>
        </div>
        <hr>
        <div class="">
          <table id="standingsTable" class="table table-hover table-bordered">
            <thead>
              <tr>
                <th>Team Name</th>
                <th>Score</th>
                <th>Minutes</th>
                <th>P1</th>
                <th>P2</th>
                <th>P3</th>
                <th>P4</th>
                <th>P5</th>
                <th>P6</th>
                <th>P7</th>
                <th>P8</th>
                <th>P9</th>
              </tr>
            </thead>
            <tbody id="standings">
            </tbody>
          </table>
        </div>
        <div class="hidden-print">
          <a onclick="redrawTable()" class="btn btn-block btn-primary">Refresh Standings</a><br>
          Feel free to print this page. This text and the button above hides when printed (as long as your browser is modern).
        </div>
      </div>

      <script src="bower_components/jquery/dist/jquery.min.js"></script>
      <script src="assets/js/tablesorter.min.js"></script>
      <script src="assets/js/app.js"></script>
    </body>
    </html>
