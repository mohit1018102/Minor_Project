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



 date_default_timezone_set("Asia/Kolkata");


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


.cancelbtn {
    padding: 14px 20px;
    background-color: #f44336;
}


.cancelbtn, .signupbtn {
  float: left;
  width: 49%;
  margin-left:3px;
  margin-top:5px;

}


.container {
    padding: 16px;
    width:50%;
    background-color: lightgrey; 
    

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

.ex{
     position:absolute;
     
}
</style>
</head>
<body style="background:url('images/table10.jpg');background-attachment: fixed; background-size: 100% 100%;">
<ul style="position:sticky;top:0px;padding: -1;">
  
  <li><a href="action.php" style="background-color: green" title="visitor info" target="_blank">Enteries</a></li>
  <li><a>Date : <?php echo date("y-m-d"); ?></a></li>
   <li style="padding-left:75.4%;"><a  href="destroy.php"  title="logout" ><b > Log-Out </b></a></li>
 </ul>

<br>





<center><form action="" style="border:1px " method="POST" enctype="multipart/form-data">
  <div class="container">
    <h1>VISITOR PASS ENTRY</h1>
    
    <hr>

    
    <input type="text" placeholder="Full name of visitor" name="name" required>

    
    <input type="text" placeholder="Enter Mobile Number" name="num" placeholder="^[0-9]{10}$" required>

       <input type="text" placeholder="Enter City" name="city" required>

     
    <input type="text" placeholder="Enter Address" name="address" required>

    

    <br>
     <br>
   <b>Image :<b> <input type="file" name="upfile" accept="images/*" required>
    <br>
    <?php
       if(!empty($message)){echo $message;} ?>
       	
    <br>
    <br>
    

    <div class="clearfix">
      <button type="RESET" class="cancelbtn">Reset</button>
      <button type="submit" class="signupbtn" name="submit">submit</button>
    </div>
  </div>
</form>
</center>
</body>
</html>



<?php
if(isset($_POST["submit"]))
{


	$name=$_POST["name"];
	$mobile=$_POST["num"];
	$city=$_POST["city"];
	$address=$_POST["address"];
	$date=date("y-m-d");
	$time=date("h:i:s",time());
	$fn=$_FILES['upfile'] ['name'];

	
	
	$filebasename=basename($_FILES['upfile'] ['name']);
	$ext=strtolower(substr($filebasename,strrpos($filebasename,'.')+1));

	if(($ext=="jpg" || $ext=="jpeg" || $ext=="JPG") && ( $_FILES["upfile"]["type"]=="image/jpg" || $_FILES["upfile"]["type"]=="image/jpeg"))
        
	   {
		 $desired_dir="photo/";
		 $file_name=$_FILES['upfile'] ['name'];

		 if(file_exists($desired_dir . $file_name)){
		 	echo $file_name."is already exist.";
		 }
		 else
		 {     $sql="INSERT INTO `visitor`(number,name,address,city,gid,file) VALUES ('$mobile','$name','$address','$city','$id','$file_name')";
		      $result=mysqli_query($con,$sql);

		      if($result){

		 	   move_uploaded_file($_FILES["upfile"]["tmp_name"],$desired_dir.$file_name);
		 	   echo "Data is SUCESSFULLY UPLOAD.";
               echo "<a href='generate.php?f=$file_name'>GENERATE PASS</A>";

		 	}
		 	   else
		 	   	echo " error";
		 
		 }
	}
	else
		 { echo "INSERTION OF INFORMATION IS FAILED!!";}
}


?>