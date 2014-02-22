<?php

		$con = mysql_connect("localhost","root","");
			if (!$con)
			{
				die('Could not connect: ' . mysql_error());
			}
			mysql_select_db("Snapshot", $con);			
			$sql = "LOAD DATA LOCAL INFILE '../../data/zibo_boundingbox.csv' INTO TABLE Boundingbox FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n' (img_base, x1, y1, x2, y2, mark_date, user, series_no)";
			if(mysql_query($sql,$con))
				echo "Data Loaded successfully!";
			mysql_close($con);
				
?>
