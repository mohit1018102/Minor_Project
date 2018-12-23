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
  $file=$_GET["f"];
  


  $sql = "SELECT * FROM `visitor` where file='$file'";
  $run_query=mysqli_query($con,$sql);
if(mysqli_num_rows($run_query) > 0 )
{ 
  while($row = mysqli_fetch_array($run_query)){
       $name=$row["name"];
       $num=$row["number"];
       $city=$row["city"];
       $address=$row["address"];
       $dd=$row["date"];
       $gid=$row["gid"];

    }

   }

    $sql = "SELECT * FROM `admin` where id='$gid'";
  $run_query=mysqli_query($con,$sql);

    if(mysqli_num_rows($run_query) > 0 )
    { 
        while($row = mysqli_fetch_array($run_query)){
         $first=$row["first"];
         $second=$row["second"];
      
      }

   }

date_default_timezone_set("Asia/Kolkata");

}
else
header('Location:index.php');

?>


<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="font-awesome.min.css">
<style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 700px;
  margin: auto;
  text-align: center;
  font-family: arial;
}

.title {
  color: grey;
  font-size: 18px;
}

button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}

a {
  text-decoration: none;
  font-size: 22px;
  color: black;
}

button:hover, a:hover {
  opacity: 0.7;
}
</style>
</head>
<body>

<h2 style="text-align:center">Visitor Card</h2>

<div class="card">
   <b><script type="text/javascript">document.write(new Date());</script></b>
   <br><br>

  <?php echo "<img src='photo/$file' style='width:200px;height:200px'/>"; ?>
  
    <h2><?php echo "NAME : $name"?></h2>
  <h2><?php echo "Contact No. : $num"?></h2>
  <h2><?php echo "Address : $address"?></h2>
  <h2><?php echo "City : $city"?></h2>

  
  <p class="title"><?php echo "Assigned by : $first $second";?></p>
  <p class="title"><?php echo "Registration-date/time : $dd";?></p>
  <p>GEU University</p>
  
  <p><SPAN STYLE="COLOR:Red">NOTE:This pass is valid for 5 hrs only</SPAN></p>
 <p><button onclick="print();">Print</button></p>

 <p><a href="register.php"><button>NEW VISITOR</button></a></p>
</div>

</body>
</html>



