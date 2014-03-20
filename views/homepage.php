<?php date_default_timezone_set( "America/New_York"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Computer Science Department at St. Bonaventure University">
  <title>High School Programming Contest Submissions</title>

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
          <ul class="nav nav-pills pull-right">
            <li class="active"><a href="/">Submissions</a></li>
            <li><a href="/scoreboard" target="_new">Printable Scoreboard</a></li>
            <li><a href="/scoresheets">Team Sheets</a></li>
            <li><a href="/setup">Setup</a></li>
          </ul>
          <h3>programmingContest(<?php echo date("Y"); ?>);</h3>
        </div>
        <hr>
        <div class="well well-sm">
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

          <a onclick="redrawTable()" class="btn btn-block btn-primary">Refresh Standings</a>
        </div>

        <div class="row marketing">
          <div class="col-lg-12">
            <h3>Problem Submissions:</h3>
            <form id="subForm">
              <div class="row">
                <div class="col-lg-2">
                  <select class="form-control" name="team" id="teamSelect">
                    <option value="-1">Select Team</option>
                    <?php
                      foreach ($schools as $school) {
                        echo '<option value="' . $school['id']  .'">' . $school['name'] . '</option>';
                      }

                    ?>
                  </select>
                </div>
                <div class="col-lg-2">
                  <select class="form-control" name="problem">
                    <option value="-1">Select Problem</option>
                    <option value="1">Problem #1</option>
                    <option value="2">Problem #2</option>
                    <option value="3">Problem #3</option>
                    <option value="4">Problem #4</option>
                    <option value="5">Problem #5</option>
                    <option value="6">Problem #6</option>
                    <option value="7">Problem #7</option>
                    <option value="8">Problem #8</option>
                    <option value="9">Problem #9</option>
                  </select>
                </div>
                <div class="col-lg-2">
                  <input class="form-control" type="text" name="time" placeholder="Submission Time">
                </div>
                <div class="col-lg-2">
                  <select class="form-control" name="correct">
                    <option value="-1">Select Correctness</option>
                    <option value="Y">Correct</option>
                    <option value="N">Incorrect</option>
                  </select>
                </div>
              </div><br>
              <div class="row">
                <div class="col-lg-8">
                <textarea class="form-control" name="comments" placeholder="Comments go here."></textarea>
                </div>
                <div class="col-lg-4">
               <!--  <input type="submit"> -->
                  <a onClick="addSubmission()" class="btn btn-primary">Submit</a>
                </div>
              </div>
            </form>
          </div>

        </div>
        <hr>
        <div class="footer">Warning! This form has no validation. Ya mess up, you need to edit database manually. &lt;3</div>
      </div>

      <script src="bower_components/jquery/dist/jquery.min.js"></script>
      <script src="assets/js/tablesorter.min.js"></script>
      <script src="assets/js/app.js"></script>
    </body>
    </html>
