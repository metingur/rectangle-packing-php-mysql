<div align="center" style="border:1px">
<?php
$conn = mysqli_connect("localhost","db_user","password","db_name");
 

if (mysqli_connect_errno()) {
    echo 'Failed to connect to MySQL: ' . mysqli_connect_error();
    exit();
}
$result = mysqli_query($conn,"SELECT  `name` FROM `table`");

?>
Kay�tl� bir Proje a��n
</br>
<form method="post" name="city" action="index3.php">
<select name="name" >
<option value="0" selected="selected"> Bir proje se�</option>
<?php
foreach ($result as $row) {

$name = $row["name"];

?>
<option value="<?php echo $name ?>"> <?php echo  $name ?> </option>
<?php
}?>
</select>
<input type='submit' value='G�nder' name='submit'>
</form>
--------------------------------------------
</br>
Yeni bir proje olu�turun

<form method='POST' action='index2.php'>
<p>Proje ismi: <input type="text" name="name" /></p>

<p> Mdf boyutlar� 170 x 210 - 183 x 366 - 210 x 244 - 210 x 280 </p>
<p> Sunta boyutlar� 170 x 210 -	183 x 366 -	210 x 244 -	210 x 280 -	210 x 366 -	220 x 280 -	220 x 366 </p>
<p> Tabakan�n Y�kseklik ve Geni�li�ini Giriniz: </p>
<p>Y�kseklik: <input type="text" name="yuk" /></p>
<p>Geni�lik: <input type="text" name="gen" /></p>
</br>



<p>�stedi�iniz boyutlar� giriniz (en x boy):</p>
<input type="text" name="boyut[0][w]" >
<input type="text" name="boyut[0][h]" >
</br>
<input type="text" name="boyut[1][w]" >
<input type="text" name="boyut[1][h]" >
</br>
<input type="text" name="boyut[2][w]" >
<input type="text" name="boyut[2][h]" >
</br>
<input type="text" name="boyut[3][w]" >
<input type="text" name="boyut[3][h]" >
</br>
<input type="text" name="boyut[4][w]" >
<input type="text" name="boyut[4][h]" >
</br>
<input type="text" name="boyut[5][w]" >
<input type="text" name="boyut[5][h]" >
</br>
<input type="text" name="boyut[6][w]" >
<input type="text" name="boyut[6][h]" >
</br>
<input type="text" name="boyut[7][w]" >
<input type="text" name="boyut[7][h]" >
</br>
<input type="text" name="boyut[8][w]" >
<input type="text" name="boyut[8][h]" >
</br>
<input type="text" name="boyut[9][w]" >
<input type="text" name="boyut[9][h]" >
</br>
<input type="text" name="boyut[10][w]" >
<input type="text" name="boyut[10][h]" >
</br>

<input type='submit' value='G�nder' name='submit'>

</form>
</div>