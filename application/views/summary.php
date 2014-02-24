<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />

<style>
body{margin:30px} 
*{font-size:110%}
td{color: gray;font-size:120%;padding-left:20px}
th{text-align:right}
</style>

	</head>
	<body>
		
<table>
<tr>
<th>Marked <td> <?php echo $cnt_marked ?>
<tr>
<th> Unmarked <td><?php echo $cnt_unmarked ?>
<tr><th>&nbsp;<td>

<?php 

foreach ($user_cnt_array as $user_cnt) 
{
    echo "<tr><th>";
    echo $user_cnt->user;
    echo "&nbsp; <td>";
    echo $user_cnt->cnt;
} 

?>	

</table>	

	</body>
</html>
