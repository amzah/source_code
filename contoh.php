<?php
include ("F:/xampp/htdocs/chart/src/jpgraph.php");
include ("F:/xampp/htdocs/chart/src/jpgraph_bar.php");
$db = mysql_connect("localhost", "root","") or die(mysql_error());
mysql_select_db("mhs",$db) or die(mysql_error());
$sql = mysql_query("SELECT * FROM siswa") or die(mysql_error());
while($row = mysql_fetch_array($sql))
{
$data[] = $row["nama"];
$leg[] = $row["nilai"];
}
$graph = new Graph(250,150,"auto");
$graph->SetScale("textint");
$graph->img->SetMargin(50,30,50,50);
$graph->AdjBackgroundImage(0.4,0.7,-1); //setting BG type
$graph->SetBackgroundImage("linux_pez.png",BGIMG_FILLFRAME);//adding image
$graph->SetShadow();
$graph->xaxis->SetTickLabels($leg);
$bplot = new BarPlot($data);
$bplot->SetFillColor("lightgreen"); // Fill color
$bplot->value->Show();
$bplot->value->SetFont(FF_ARIAL,FS_BOLD);
$bplot->value->SetAngle(45);
$bplot->value->SetColor("black","navy");
$graph->Add($bplot);
$graph->Stroke();
?>