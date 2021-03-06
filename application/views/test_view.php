<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $this->load->helper('url');?>
        <base href="<?php echo base_url(); ?>" />
        <title>test for my img</title>
        <script src="js/jquery.min.js"></script>
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

        <script src="js/jquery.Jcrop.min.js"></script>
        <link rel="stylesheet" href="css/main.css" type="text/css" />
        <link rel="stylesheet" href="css/jquery.Jcrop.css" type="text/css" />
        <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
    </head>
    <body>
        <h1>Enjoy your marking!!!</h1>
        <?php

            $html = "<div id='wrapper'>\n";
            for ($i=0; $i<$num_of_img; $i++) 
            {
                $img_url = "http://www.snapshotserengeti.org/subjects/standard/$img_base" . "_$i.jpg";
                $html .= "<div data-id=$i class='holder'><img src='$img_url' data-series-id=$i id='$img_base" . "_$i'></div>\n";
            }
            $html .= "</div>\n";
            echo $html;
        ?>

        <div id="forms">
            <form id="data" style="float:left;">
                <label>Image Id <input type="text" <?php echo "value='$img_base'"?> size="6" id="Img_id" name="Img_id" /></label>
                <label>Series Id <input type="text"  size="1" id="Series_Id" name="Series_Id" /></label>
                <label>X1 <input type="text" size="3" id="x" name="X1" /></label>
                <label>Y1 <input type="text" size="3" id="y" name="Y1" /></label>
                <label>X2 <input type="text" size="3" id="x2" name="X2" /></label>
                <label>Y2 <input type="text" size="3" id="y2" name="Y2" /></label>
                <input type="submit" value="submit" id ="submit" class='btn-danger btn-lg' name="submit" />    
            </form>
            
            <form name="next_capture" method="post" action="index.php/test/showimg" style="float:left;margin-left:10px">
                <input type="submit" value="next capture" id="next_capture" name="next_capture"  class='btn-success btn-lg'/>
                <span id="message"></div>
            </form>
        </div>
        
        
    
    <script language="Javascript">
        var last_dataString = null;
    
        $(function(){

            $('img').each(function()
            {
                image_to_crop = $(this);
                image_to_crop.Jcrop({
                    onSelect: (function (locked_image_to_crop) { return function (coords) { showCoords(locked_image_to_crop, coords); } })(image_to_crop)
                });
            });

            
            $('#submit').click(function()
            {
                var dataString = $('#data').serialize();
                if (last_dataString && last_dataString == dataString) {
                    alert("Already submitted this!");
                    return false;
                }

                var series_no = $("#Series_Id").val();
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
                        $('#message').html("<span style='color:yellow;background:green'>Saved</span>").hide().fadeIn(700);
                        last_dataString = dataString;
                    } 

                });    
                return false;
            });    
        });

            
        function showCoords(image_to_crop, c)
        {
            $('#message').hide();

            $("#Series_Id").val(image_to_crop.attr('data-series-id'));

            $('#x').val(c.x);
            $('#y').val(c.y);
            $('#x2').val(c.x2);
            $('#y2').val(c.y2);
            $("#Img_id").val();

        };
    </script>
        
    </body>
</html>
