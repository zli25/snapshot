<!DOCTYPE html>
<html lang="en">
	<head>
		<?php $this->load->helper('url');?>
		<base href="<?php echo base_url(); ?>" />
		<title>test for my img</title>
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.Jcrop.min.js"></script>
		<link rel="stylesheet" href="css/main.css" type="text/css" />
		<link rel="stylesheet" href="css/jquery.Jcrop.css" type="text/css" />
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
	</head>
	<body>
		<h1>Enjoy your marking!!!</h1>
		<?php

			if($num_of_img==1)
			{
				$img_url = "http://www.snapshotserengeti.org/subjects/standard/".$img_base."_0.jpg";
				$img_id = $img_base."_0";
				echo "<div id='wrapper' >";
				echo "<div data-id=0 id='holder'>
						<img src='$img_url' id='$img_id'>
					  </div>
					";
				echo "</div>";


			}
			if($num_of_img==2)
			{
				$img_url0 = "http://www.snapshotserengeti.org/subjects/standard/".$img_base."_0.jpg";
				$img_id0 = $img_base."_0";
				echo "<div id='wrapper'>";
				echo "<div data-id=0 id='holder' ><img src='$img_url0' id='$img_id0'> ";
				$img_url1 = "http://www.snapshotserengeti.org/subjects/standard/".$img_base."_1.jpg";
				$img_id1 = $img_base."_1";
				echo "<div data-id=1 id='holder'><img src='$img_url1' id='$img_id1'> </div>";
				echo "</div>";

			}

			if($num_of_img==3)
			{
				$img_url0 = "http://www.snapshotserengeti.org/subjects/standard/".$img_base."_0.jpg";
				$img_id0 = $img_base."_0";
				echo "<div id='wrapper'>";
				echo "<div data-id=0 id='holder'><img src='$img_url0' id='$img_id0'></div> ";
				
				$img_url1 = "http://www.snapshotserengeti.org/subjects/standard/".$img_base."_1.jpg";
				$img_id1 = $img_base."_1";
				echo "<div data-id=1 id='holder'><img src='$img_url1' id='$img_id1'> </div>";
		
				$img_url2 = "http://www.snapshotserengeti.org/subjects/standard/".$img_base."_2.jpg";
				$img_id2 = $img_base."_2";
				echo "<div data-id=2 id='holder'><img src='$img_url2' id='$img_id2' ></div>";
				echo "</div>";
				
			}

		?>

		<div id="forms">
			<form id="data" style="float:left;">
				<label>Image Id <input type="text" <?php echo "value='$img_base'"?> size="25" id="Img_id" name="Img_id" /></label>
				<label>Series Id <input type="text"  size="1" id="Series_Id" name="Series_Id" /></label>
				<label>X1 <input type="text" size="3" id="x" name="X1" /></label>
				<label>Y1 <input type="text" size="3" id="y" name="Y1" /></label>
				<label>X2 <input type="text" size="3" id="x2" name="X2" /></label>
				<label>Y2 <input type="text" size="3" id="y2" name="Y2" /></label>
				<!--<label>W <input type="text" size="4" id="w" name="W" /></label>
				<label>H <input type="text" size="4" id="h" name="H" /></label>-->
				<input type="submit" value="submit" size="12" id ="submit" class='submit_button' name="submit" />	
			</form>
			
			<form name="next_capture" method="post" action="index.php/test/showimg" style="float:left;">
				<input type="submit" value="next capture" size="12" id ="next_capture" name="next_capture" />
				<span id="message"></div>
			</form>
		</div>
		
		
	
	
	<script language="Javascript">
	
		$(function(){

            $('#wrapper').delegate('div', 'click', function(evt) {
                //console.log(evt.currentTarget.getAttribute('data-id') );
                var series_no = evt.currentTarget.getAttribute('data-id');
                if (series_no) {
				    $("#Series_Id").val(series_no);
                }
            });
	
			$('img').Jcrop({
				onSelect: showCoords,
				onChange: showCoords
			});
			
			$('.submit_button').click(function(){
				
				var dataString = $('#data').serialize();
				var series_no = $("#Series_Id").val();
				//alert(series_no);
				if(series_no =="")
				{
					alert("Please Select a image!");
					return false;
				}
				$.ajax({
					type:"POST",
					url:"index.php/test/insert",
					data:dataString,
					success: function() { 
						$('#message').html("<span style='font-size:40px;color:red;'>Submitted!</span>").hide().fadeIn(2000)
					} 

				});	
				return false;
			});	
			
			
		});
			
		function showCoords(c)
		{
            //console.log(c);
			$('#x').val(c.x);
			$('#y').val(c.y);
			$('#x2').val(c.x2);
			$('#y2').val(c.y2);
			$('#w').val(c.w);
			$('#h').val(c.h);
			$("#Img_id").val();

		};
	</script>
		
	</body>
</html>
