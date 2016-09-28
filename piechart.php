<?php
	//Buat koneksi ke database
	$db_conn = mysql_connect('localhost', 'root', '');
	$db_sell = mysql_select_db('tutorial',$db_conn);
	
	//title yang akan dijadikan judul chart
	$title   = 'Statistik pengunjung website Media Kreatif Pada Tahun 2012';
	
	//Buat query untuk melihat data kunjungan bulanan pada tahun 2012
	$query   = mysql_query('select sum(Jumlah) as Kunjungan,left(Tanggal,7) as Bulan from sys_traffic where left(Tanggal,4)="2012" group by left(Tanggal,7)');
	
	while($res = mysql_fetch_array($query)){
		$bulan = $res['Bulan'];
		$jumlah= $res['Kunjungan'];
		$data = '["'.$bulan.'",'.$jumlah.'],';
	}
	//membuang tanda koma di akhir data
	$data = substr($data,0,(strlen($data)-1));
?>
<html>
  <head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="jsapi.js"></script>
    <script type="text/javascript">

      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          <?php echo $data; ?>
        ]);

        // Set chart options
        var options = {'title':'<?php echo $title; ?>',
                       'width':600,
                       'height':400};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>

  <body>
    <!--Div that will hold the pie chart-->
    <div id="chart_div"></div>
  </body>
</html>