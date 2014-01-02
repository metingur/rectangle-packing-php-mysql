<!DOCTYPE html>
<html>
<head>
	<title>Diktörtgen parçala</title>
	<meta charset="utf-8">
<style type="text/css" media="screen">
	img {
			
			background: #3F4C6B;

		}
	body {
        font-family: 'Segoe ui', 'Lucida Grande', Tahoma, Helvetica, Arial;
        padding: 0;
    }

    h1 {
        margin: 0.2em 0;
        padding: 0.2em;
        color: #F9F7ED;
        background: #3F4C6B;
        border-top: 2px solid #ccc;
        border-bottom: 2px solid #ccc;
    }

    #canvasContainer {
        float: left;
        width: 645px;
        height: 510px;
        text-align: center;
        border: 1px solid #ddd;
        background: #eee;
    }
    #canvas {
        background: none repeat scroll 0 0 #C79810;
        text-align: left;
        margin: 4px auto;
        border: 2px solid white;
		
    }

    #controls {
        margin-left: 650px;

        width: 12em !important;
        width: auto;
        border: 1px solid #ddd;
        background: #eee;
        padding: 1em;
    }

    #controls label {
        display: block;
    }
    #controls input, #controls select {
        margin-left: 2em;
    }


    #controls h3.nofit {
        font-size: 12pt;
        margin-bottom: 0;
        background: #ddd;
        width: 12em;
        border: 1px solid #888;
        border-color: #ccc #888 transparent #ccc;
    }
    #nofit {
        list-style: none;
        margin: 0;
        padding: 0;
        width: 12em;
        height: 120px;
        overflow: scroll;
        border: 1px solid #888;
        border-color: #ccc #888 #888 #ccc;
    }
    #nofit li {
        background: white;
    }
    #nofit li:hover {
        background: #eee;
    }

    #status {
        font-size: 12pt;
        height: 1.5em;
        line-height: 1.5em;
        background: #444;

        color: #eee;
    }

    #status a.refresh {
        float: right;
        height: 1.5em;
        line-height: 1.5em;

        text-decoration: none;
        color: white;
        background: #888;
        padding: 0 3px;
        border-left: 1px solid #eee;
    }
    #status a.refresh:hover {
        background: white;
        color: #888;
    }

    span.label {
        color: #ccc;
    }

    #footer {
        text-align: center;
        border-top: 2px solid #ccc;
        border-bottom: 2px solid #ccc;
        background: #3F4C6B;
        color: white;
        margin-top: 1em;
    }
	</style>
</head>
<body>

<?php
 
define('NL', PHP_SAPI == 'cli' ? "\n" : "<br/>");
 
/*
$block = array(
    array('w' => 161, 'h' => 199),
    array('w' => 299, 'h' => 197),
    array('w' => 147, 'h' => 200),
    array('w' => 133, 'h' => 200),
    array('w' => 128, 'h' => 200),
    array('w' => 130, 'h' => 200)
); 
*/


$block = $_POST['boyut'];
$name = $_POST['name'];
$maxh = $_POST['yuk'];
$maxw = $_POST['gen'];

$conn=mysql_connect('localhost', 'db_user', 'password');
mysql_select_db("db_name",$conn);


$array_string=mysql_escape_string(serialize($block));
$result = mysql_query("INSERT INTO `table`(`name`, `column`, `yuk`, `gen`) VALUES ('$name','$array_string','$maxh','$maxw')",$conn);

if($result){
echo "Kayıt başarıyla eklendi... </br></br>";
}else{
echo "Kayıt eklenemedi sorun var.... </br></br>";
}

        
// Packer must be initialized outside the loop
require_once("RectanglePacking.php");
$packer = new RectanglePacking($maxh, $maxw);
 
for ($i=0; $i<count($block); $i++) {
 
    echo "{$block[$i][w]}x{$block[$i][h]}... ";
 
    // Try to find a suitable gap in the configured rectangle
    $coords = $packer->findCoords($block[$i][w],$block[$i][h]);

    if ($coords) {
	$fitted++;
		$blocks[$i][w] = $block[$i][w];
		$blocks[$i][h] = $block[$i][h];
		$blocks[$i][x] = $coords['x'];
		$blocks[$i][y] = $coords['y'];
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


<a href="http://metingur.com.tr/tasarim/index.php">Baştan Hesapla</a>

<div id="canvas" style="position: relative; width: <?php echo $maxh;?>px; height: <?php echo $maxw;?>px;">
<?php foreach ($blocks as $img): ?><div style="border: 1px solid red; background: none repeat scroll 0% 0% rgb(16, 43, 44); position: absolute; top: <?php echo $img['y']; ?>px; left: <?php echo $img['x']; ?>px; width: <?php echo ($img['w']-2); ?>px; height: <?php echo ($img['h']-2); ?>px;"></div><?php endforeach; ?>
</div>
<div>
	
</div>

</body>
</html>