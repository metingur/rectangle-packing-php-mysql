rectangle-packing
=================

  This is a php project that is about rectangle packing. About this project you need a mysql database. Create a database and run this command
<code><pre>
  CREATE TABLE IF NOT EXISTS `table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `column` varchar(500) NOT NULL,
  `yuk` int(15) NOT NULL,
  `gen` int(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;
</code></pre>

  And then you need to set up database configuration in index.php (line 3), index2.php (line 147) and index3.php (line 132) <code><pre> $conn=mysql_connect('localhost', 'db_user', 'password'); </code></pre>
  
  If you want to see working examples. Click this link http://metingur.com.tr/tasarim/
  
  This project will be updated.
  
