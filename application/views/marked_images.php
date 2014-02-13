<!DOCTYPE html>
<html lang="en">
	<head>
		<?php $this->load->helper('url');?>
		<base href="<?php echo base_url(); ?>" />
		<title>Marked Images</title>
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.Jcrop.min.js"></script>
		<link rel="stylesheet" href="css/jquery.Jcrop.css" type="text/css" />
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
	</head>
	<body>
	
	<?php 
	foreach($rows as $r)
	{
		$img_url = "http://www.snapshotserengeti.org/subjects/standard/".$r['img_base']."_".$r['series_no'].".jpg";
		$img_id = $r['img_base']."_".$r['series_no'];
		echo "<img src='$img_url' id='$img_id' style='float:left;'>";		
	}
	
	?>	
	</body>
</html>
