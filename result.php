<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
      <style type="text/css" media="screen">
         #canvas {
         background: none repeat scroll 0 0 #C79810;
         text-align: left;
         margin: 4px auto;
         border: 2px solid white;
         }
         *,
         *::before,
         *::after {
         box-sizing: content-box; 
         }
      </style>
      <title>Rectangle Packing</title>
   </head>
   <body>
      <div class="container">
      <br> 
      <div class="row">
         <div class="col-" align="center">
            <?php
               define('NL', PHP_SAPI == 'cli' ? "\n" : "<br/>");
                
               
               $blockss = $_POST['boyut'];
               $name = $_POST['name'];
               $maxh = $_POST['yuk'];
               $maxw = $_POST['gen'];
               
               
               $column = 2;
               $array = array_chunk($blockss, $column);
               
               
               
               foreach ( $array as $k=>$v )
               {
               $array[$k] ['w'] = $array[$k] ['0'];
               unset($array[$k]['0']);
               $array[$k] ['h'] = $array[$k] ['1'];
               unset($array[$k]['1']);
               }
               
               $block = $array;
               
				usort($block,
				function ($a, $b)
				{
					if ($a['w'] * $a['h'] === $b['w'] * $b['h']) {
						return 0;
					}

					return ($a['w'] * $a['h'] < $b['w'] * $b['h']) ? 1 : -1;
				});
               
               echo '<div class="alert alert-primary" role="alert">';
               echo "Project Name ==> $name";
               echo "<br>";
               echo "<br>";		  
               
               require_once("database.php");
               
			   //print_r($block);
               $array_string=serialize($block);
               
			   //echo $array_string;	
         
               
               $sql = "INSERT INTO `table`(`name`, `column`, `yuk`, `gen`) VALUES ('$name','$array_string','$maxh','$maxw')";
               if ($conn->query($sql) === TRUE) {
               // echo "New record created successfully";
               } else {
               echo "Error: " . $sql . "<br>" . $conn->error;
               }
               
               
                       
               // Packer must be initialized outside the loop
               require_once("RectanglePacking.php");
               $packer = new RectanglePacking($maxh, $maxw);
                
               for ($i=0; $i<count($block); $i++) {
                
                   echo "Location for {$block[$i][w]}x{$block[$i][h]} ";
                
                   // Try to find a suitable gap in the configured rectangle
                   $coords = $packer->findCoords($block[$i][w],$block[$i][h]);
               
                   if ($coords) {
               		$blocks[$i][w] = $block[$i][w];
               		$blocks[$i][h] = $block[$i][h];
               		$blocks[$i][x] = $coords['x'];
               		$blocks[$i][y] = $coords['y'];
               		$fitted++;
               		echo "is {$coords['x']}x{$coords['y']}" . NL;
                   } else {
               		echo "it does not fit into" . NL;
                   }
               	
               
               	$totalArea += $blocks[$i][w] * $blocks[$i][h];
               	
               }  
               	$dim = $packer->getDimensions();
               	
               	echo "<br>";
               echo "Rectangle area => $maxh X $maxw";               
               	
               	echo "<br>";
               	echo "<br>";
               	echo "Covered Area ---> " .$dim['w']. "X".$dim['h'];
               	echo "<br>";
               	echo "Productivity ----> %" .(($totalArea*100) / ($dim[w]*$dim[h]));
               	echo "<br>";
               	echo "The settlement rate ---> %" .(($fitted*100) / count($block));
               	echo "<br>";
               	echo "</div>";
               	 
               ?>
            <a class="btn btn-danger btn-lg" href="http://rectangle.metingur.com.tr" role="button">New Project</a>
         </div>
         <div class="col-lg" align="center">
            <div id="canvas" style="position: relative; width: <?php echo $maxh;?>px; height: <?php echo $maxw;?>px;">
               <?php foreach ($blocks as $img): ?>
               <div style="border: 1px solid red; background: none repeat scroll 0% 0% rgb(16, 43, 44); position: absolute; top: <?php echo $img['y']; ?>px; left: <?php echo $img['x']; ?>px; width: <?php echo ($img['w']-2); ?>px; height: <?php echo ($img['h']-2); ?>px;"></div>
               <?php endforeach; ?>
            </div>
         </div>
      </div>
   </body>
</html>
