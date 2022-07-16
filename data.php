<html>
<?php
include "connection.php";
include "staff_navbar.php";
?>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Number of stars given'],
          <?php
          $sql = "SELECT * FROM review";
          $row = mysqli_query($conn, $sql);
          while($result = mysqli_fetch_assoc($row)){
              echo "['".$result['Service_name']."',".$result['stars']."],";
          }
          ?>
        ]);

        var options = {
          title: 'All Reviews'
        };

        var chart = new google.visualization.BarChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
  </body>
</html>
