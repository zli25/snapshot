<?php
	class Test_model extends CI_Model
	{
		function __construct()
		{
			parent::__construct();
			$this->load->database();
		}
		
		function insertdata($data)
		{
		
			$this->load->library('user_agent');
			if ($this->agent->is_browser())
			{
				$agent = $this->agent->browser().' '.$this->agent->version();
			}
			elseif ($this->agent->is_robot())
			{
				$agent = $this->agent->robot();
			}
			elseif ($this->agent->is_mobile())
			{
				$agent = $this->agent->mobile();
			}
			else
			{
				$agent = 'Unidentified User Agent';
			}

			$con = mysql_connect("localhost","root","");
			if (!$con)
			{
				die('Could not connect: ' . mysql_error());
			}
			mysql_select_db("Snapshot", $con);
			$time  = date('Y-m-d H:i:s');
			$img_base = $data['img_base'];	
			$series_id = $data['series_id'];
			$X1 = $data['X1']; 
			$Y1 = $data['Y1'];
			$X2 = $data['X2'];
			$Y2 = $data['Y2'];
			$sql = "Insert INTO Boundingbox (img_base, series_no, x1, y1, x2, y2, mark_date, user) 
				Values ('$img_base', '$series_id', '$X1', '$Y1', '$X2', '$Y2', '$time', '$agent')";
			mysql_query($sql, $con);
			$sql = "update Image set is_marked='1' where img_base='$img_base'"; 
			mysql_query($sql, $con);
			mysql_close($con);
		}
		
		function get_img()
		{	
			$con = mysql_connect("localhost","root","");
			if (!$con)
			{
				die('Could not connect: ' . mysql_error());
			}
			mysql_select_db("Snapshot", $con);
			//$result = mysql_query("select count(*) from Image", $con);
			$result = mysql_query("select * from Image where is_marked is NULL order by rand() limit 1", $con);
			$row = mysql_fetch_array($result);
			return $row;
		}
		
		function show_marked_img()
		{

			$con = mysql_connect("localhost","root","");
			if (!$con)
			{
				die('Could not connect: ' . mysql_error());
			}
			mysql_select_db("Snapshot", $con);
			$result = mysql_query("select i.img_base, b.series_no from Image as i inner join Boundingbox as b on i.img_base = b.img_base group by i.img_base", $con);				
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
			
			mysql_close($con);
			return $data;
			//return $data;
			
			
			//$sql="select b.img_id, b.x1, b.y1, b.x2, b.y2, b.mark_date, b.user from Boundingbox as b left join Image as i on b.img_base=i.img_base";
			
		}
		
		function add_series_no()
		{
		
			$con = mysql_connect("localhost","root","");
			if (!$con)
			{
				die('Could not connect: ' . mysql_error());
			}
			mysql_select_db("Snapshot", $con);
			if(mysql_query("Alter table Boundingbox add column series_no CHAR(1)", $con))
				echo "Success!";
			mysql_close($con);
		
			
		}
		
		
	}
?>