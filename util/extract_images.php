<?php
	$con = mysql_connect("localhost","root","");
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db("Snapshot", $con);
	$result = mysql_query("select * from Boundingbox", $con);				
	while($row = mysql_fetch_array($result))
	{
		$marked_data[] = $row;
	}
	//print_r($marked_data);
	
	foreach($marked_data as $r => $line)
	{
		$data[] = $line;
		//print_r($data);
	}
	
	foreach($data as $r)
	{
		$img_url = "http://www.snapshotserengeti.org/subjects/standard/".$r['img_base']."_".$r['series_no'].".jpg";

		$img_name = "../images/working/" . $r['img_base']."_".$r['series_no']."_".$r['key_id'].".jpg";

		$img_name = "../images/working/".$r['img_base']."_".$r['series_no']."_".$r['key_id'].".jpg";

		$w = $r['x2']-$r['x1'];
		$h = $r['y2']-$r['y1'];
		$src_img = imagecreatefromjpeg($img_url);
		$dst_img = ImageCreateTrueColor($w,$h);
		imagecopyresampled($dst_img,$src_img,0,0,$r['x1'],$r['y1'],$w,$h,$w,$h);
		imagejpeg($dst_img,$img_name);
		imagedestroy($dst_img);
	}
	mysql_close($con);
	
?>
