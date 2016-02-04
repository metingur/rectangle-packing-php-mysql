<!DOCTYPE html>
<html>
<head>
	<title>Rectangle Packing</title>
	<meta charset="utf-8">
<style type="text/css" media="screen">
    #canvas {
        background: none repeat scroll 0 0 #C79810;
        text-align: left;
        margin: 4px auto;
        border: 2px solid white;
		
    }
	</style>
</head>
<body>

<?php
 
define('NL', PHP_SAPI == 'cli' ? "\n" : "<br/>");
 
$name = $_POST['name'];

$conn=mysql_connect('localhost', 'db_user', 'password');
mysql_select_db("db_name",$conn);

$q=mysql_query("SELECT * FROM `table` WHERE `name`='$name'",$conn);
while($rs=mysql_fetch_assoc($q))
{
$array= unserialize($rs['column']);

$yuk = $rs['yuk'];
$gen = $rs['gen'];
}




$block = $array;

$maxh = $yuk;
$maxw = $gen;
        
// Packer must be initialized outside the loop
require_once("RectanglePacking.php");
$packer = new RectanglePacking($maxh, $maxw);
 
for ($i=0; $i<count($block); $i++) {
 
    echo "{$block[$i][w]}x{$block[$i][h]}... ";
 
    // Try to find a suitable gap in the configured rectangle
    $coords = $packer->findCoords($block[$i][w],$block[$i][h]);

    if ($coords) {
		$blocks[$i][w] = $block[$i][w];
		$blocks[$i][h] = $block[$i][h];
		$blocks[$i][x] = $coords['x'];
		$blocks[$i][y] = $coords['y'];
		$fitted++;
		echo "{$coords['x']}x{$coords['y']} pozisyonunda" . NL;
    } else {
		echo "blok sığmıyor" . NL;
    }
	

	$totalArea += $blocks[$i][w] * $blocks[$i][h];
	
}  
	$dim = $packer->getDimensions();
	echo "<br>";
	echo "Kaplanan alan---> " .$dim['w']. "X".$dim['h'];
	echo "<br>";
	echo "Verimlilik----> %" .(($totalArea*100) / ($dim[w]*$dim[h]));
	echo "<br>";
	echo "Yerleşme oranı ---> %" .(($fitted*100) / count($block));
	echo "<br>";
	echo "<br>";
	 
?>


<a href="../tasarim/index.php">Baştan Hesapla</a>

<div id="canvas" style="position: relative; width: <?php echo $maxh;?>px; height: <?php echo $maxw;?>px;">
<?php foreach ($blocks as $img): ?><div style="border: 1px solid red; background: none repeat scroll 0% 0% rgb(16, 43, 44); position: absolute; top: <?php echo $img['y']; ?>px; left: <?php echo $img['x']; ?>px; width: <?php echo ($img['w']-2); ?>px; height: <?php echo ($img['h']-2); ?>px;"></div><?php endforeach; ?>
</div>
<div>
	
</div>

	</body>
</html>
