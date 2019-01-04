<?php


	$servername = "localhost";
    $username = "root";
    $password = "";
    $db = "team2";

    // Create connection
    $con = mysqli_connect($servername, $username, $password,$db);

    // Check connection
    if (!$con) {
      die("Connection failed: " . mysqli_connect_error());
    }


 session_start();

 if(isset($_SESSION["uid"]))
 
{ $id=$_SESSION["uid"];
 $sql="select * from admin where id=$id LIMIT 1";
 $run_query=mysqli_query($con,$sql);

   while($row=mysqli_fetch_array($run_query))
   { 
   	$f=$row["first"];
   	$s=$row["second"];

   }

}
 
 else
 	header('Location:index.php');



 


 ?>



 <?php



$sql="SELECT DISTINCT city  FROM visitor";

$result=mysqli_query($con,$sql);







?>

<!DOCTYPE html>
<html>
<head>
	
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box}


input[type=text], input[type=password] {
    width: 100%;
    padding: 15px;
    margin: 5px 0 22px 0;
    display: inline-block;
    border: none;
    background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
    background-color: #ddd;
    outline: none;
}

hr {
    border: 1px solid #f1f1f1;
    margin-bottom: 25px;
}


button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    opacity: 0.9;
}

button:hover {
    opacity:1;
}

/* Extra styles for the cancel button */
.cancelbtn {
    padding: 14px 20px;
    background-color: #f44336;
}


.cancelbtn, .signupbtn {
  float: left;
  width: 50%;
}


.container {
    padding: 16px;
}


.clearfix::after {
    content: "";
    clear: both;
    display: table;
}


@media screen and (max-width: 300px) {
    .cancelbtn, .signupbtn {
       width: 100%;
    }
}
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
}

li {
    float: left;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover {
    background-color: #111;
}
</style>
</head>
<body style="background:url('images/table10.jpg');background-attachment: fixed; background-size: 100% 100%;">

<ul style="position:sticky; top:0px;">
  <li><a style="background-color: green;">Guard : </a></li>
  <li><a  target="_blank"><?php echo $f." ".$s; ?></a></li>
  <li><a>Date : <?php echo date("y-m-d"); ?></a></li>
</ul>


<table >
<form  action="table.php" method="POST" target="frame">

 <tr>
	<td> city </td>
	<td><select name=f1>
			<?php

                 while($row=mysqli_fetch_array($result))
                 {  $x=$row["city"];
                    
                 	echo "<option value='$x'> $x </option>";
                 }

			?>
      </select></td>
      
       <td><input type=submit value="  city search"></td>
   

  </form>
  <BR>
  <BR>


  <?php//------------------------------------------------------------------------?>

  <?php



$sql="SELECT date  FROM visitor";

$result=mysqli_query($con,$sql);







?>

  <form  action="table2.php" method="POST" target="frame">
           <td>&nbsp;</td>
		<td>Date :</td><td><select name=f2>
			<?php

                 while($row=mysqli_fetch_array($result))
                 {  $x=$row["date"];
                    
                 	echo "<option value='$x'> $x </option>";
                 }

			?>
      </select></td>

       <td><input type=submit value="Date search"></td>
  </form>


  <br>


</table>
<center></center><iframe width=100% height=500px  style="background:ghostwhite;" name="frame">
</iframe></center>



</body>
</html>



