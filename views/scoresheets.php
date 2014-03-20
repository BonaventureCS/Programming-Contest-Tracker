<?php date_default_timezone_set( "America/New_York"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Computer Science Department at St. Bonaventure University">

  <title>High School Programming Contest Scoresheets</title>

  <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <style type="text/css">
    .break { page-break-before: always; }
  </style>

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
    </head>

    <body>
      <div class="container">
       <div class="hidden-print">
         <p class="bg-primary">Just print this page. Althought it doesn't look it it will print all these scoresheets on separate pages. Turn off headers and footers while printing to hide the ugly webaddress, etc.</p>
       </div>
 <?php
 $current = -1;
 $temp = $sheets;
 $first = true;


 foreach ($sheets as $sheet) {
  if($sheet['teamID'] != $current) {
    if($first) {
      $first = false;
    }
    else { ?>
      </tbody></table></div> <!-- end sheet -->
  <?php }
  $current = $sheet['teamID']; ?>

<div class="sheet break">
  <div class="header">
    <h3>St. Bonaventure University High School Programming Contest <?php echo date("Y"); ?></h3>
    <h3><?php echo $sheet['name']; ?> Scoresheet</h3>
  </div>
  <hr>
  <div class="">
    <table id="standingsTable" class="table table-hover table-bordered">
      <thead>
        <tr>
          <th>Problem Number</th>
          <th>Correct</th>
          <th>Time Taken</th>
          <th>Comments</th>
        </tr>
      </thead>
      <tbody>

        <?php
      }
      echo '<tr><td>Problem #' . $sheet['problemNumber'] . '</td><td>' . $sheet['correct'] . '</td><td>' . $sheet['minutes'] . '</td><td> '
       . $sheet['comments'] . '</tr>';
    }



      ?>
                 </tbody>
            </table>
          </div> <!-- end sheet -->
      </div>

      <script src="bower_components/jquery/dist/jquery.min.js"></script>
      <script src="assets/js/tablesorter.min.js"></script>
      <script src="assets/js/app.js"></script>
    </body>
    </html>