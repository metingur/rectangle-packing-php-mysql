rectangle-packing
=================
  An algorithm implementation in PHP for rectangle packing.
  
  Algorithm based on <http://www.blackpawn.com/texts/lightmaps/default.html>
	It uses a binary tree to partition the space of the parent rectangle and allocate the passed rectangles by dividing the partitions into filled and empty.

  to run this project you need a mysql database. Create a database and run this command;
 
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

  And then you need to set up database configuration in database.php file.
 
 Many thanks to Iván Montes for helping and answering my questions.
