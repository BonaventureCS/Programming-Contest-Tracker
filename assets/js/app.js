//Brandon Kowalski '14
//Hackily generates the current standings table <3
var sortPatternSet = false;

function getData() {
  var request;
  request = $.ajax({
    url: '/standings',
    type: 'get'
  });

// callback handler that will be called on success
request.done(function (response, textStatus, jqXHR){
  drawTable(response);
});
}


function drawTable(data) {
  var table       = '';
  var standings   = data[0];
  var minutesArr  = data[1];
  var onePointers = data[2];
  var twoPointers = data[3];

  var currentTeam = -1; //start team at number that doesnt exist
  var problemNum;
  var minutes;
  var score;
  var s;



  for(var x = 0; x < standings.length; x++) {
    s = standings[x];

    if(s.teamID !== currentTeam) {
      currentTeam = s.teamID;
      table = table + '<tr><td>' + s.name + '</td>';

      problemNum = 1; //starting at one (not using nerd counting)
      minutes    = false;
      score      = false;
    }

    if(!score) {
      var oP = 0, tP = 0, total;
      for(var y = 0; y < onePointers.length; y++) {
        if(currentTeam === onePointers[y].teamID) {
          oP = onePointers[y].onePointers;
        }
      }

      for(var y = 0; y < twoPointers.length; y++) {
        if(currentTeam === twoPointers[y].teamID) {
          tP = twoPointers[y].twoPointers;
        }
      }
      tP = tP * 2;

      total = parseFloat(oP) + parseFloat(tP); //gotta love JavaScript typing!
      table = table + '<td>' + total + '</td>';
      score = true;
    } //!score

    if(!minutes) {
      var min = 0;
      for(var y = 0; y < minutesArr.length; y++) {
        if(currentTeam === minutesArr[y].teamID) {
          min = minutesArr[y].timeTaken;
        }
      }
      table = table + '<td>' + min + '</td>';
      minutes = true;
    }

    var problemAttempted;
    while(problemNum < 10) {

      problemAttempted = false;

      for(var y = 0; y < standings.length; y++) {
        if(currentTeam === standings[y].teamID && problemNum == standings[y].problemNumber) {
          table = table + '<td><center>' + standings[y].submitted + '<br><strong>' + standings[y].correct + '</strong></center></td>';
          problemAttempted = true;
          break;
        }
      }

      if(!problemAttempted) {
        table = table + '<td><center>-</center></td>';
      }

      problemNum++;

    }

  }
  $('#standings').empty();
  $('#standings').html(table); //jQuery to append built table to page.
  $('#standingsTable').trigger('update');
}

function redrawTable() {
  getData();
}

function addSubmission() {
  $.post('/submission', $('#subForm').serialize()).done(function(){
    redrawTable();
    $('#subForm').trigger('reset');
  });
}

$(document).ready(function() {
  getData();
   $('#standingsTable').tablesorter({
    sortList: [ [1,1],[2,0] ]
  });
});
