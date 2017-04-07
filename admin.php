<!DOCTYPE html>
<html>
<head>
	<title>Mechanix Store</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/admin.css">
	<link href="https://fonts.googleapis.com/css?family=Monoton" rel="stylesheet">
	<link rel="shortcut icon" type="image/png" href="favicon.png"/>

</head>
<body>

<header class="image-bg-fluid-height">
		<h1 style="font-size: 45pt;">Mechanix Store</h1>
		<h3>Admin Panel</h3>
        <img class="img-responsive img-center"alt="">
    </header>

<table class="table">
  <thead>
    <tr>
      <th>#</th>
      <th>Client ID</th>
      <th>Client Name</th>
      <th>Phone Number</th>
      <th>Car Registration Number</th>
      <th>Appointment Date</th>
      <th>Mechanic Name</th>
      <th>Done</th>
    </tr>
  </thead>
  <tbody>


    <?php 
  
   require_once 'database.php';
        echo"";
        $sql="SELECT * FROM customer";
        $result=$conn->query($sql);
        $autoIn=1;
        if($result->num_rows>0){
        // echo"<table><tr><th>ID</th><th>Name</th><th>Address</th>
        // <th>Cell no</th><th>Car License</th><th>Car Engine</th><th>Appointed Day</th><th>Mechanic ID</th><th>Done</th></tr>";


        while($row=$result->fetch_assoc()){
       

 ?>


    <tr>
      <th scope="row"><?php echo $autoIn; $autoIn=$autoIn+1; ?></th>
      <td><?php echo $row["ID"]; ?></td>
      <td><?php echo $row["name"]; ?></td>
      <td><?php echo $row["cell_no"]; ?></td>
      <td><?php echo $row["car_license"]; ?></td>
      <td><?php echo $row["app_date"]; ?></td>
      <td><?php echo $row["mecha_id"]; ?></td>
      <td><?php echo $row["done"]; ?></td>
    </tr>

    <?php 

       // echo "<tr><td>".$row["ID"]."</td><td>".$row["name"]."</td><td>".$row["address"]."</td><td>".$row["cell_no"]."</td><td>".$row["car_license"]."</td><td>".$row["car_engine"]."</td><td>".$row["app_date"]."</td><td>".$row["mecha_id"]."</td><td>".$row["done"]."</td></tr>";
        }
        echo"</table>";
        }else{
        echo "0 results";
        }

     ?> 
  </tbody>
</table>



<br>
<b><i>Update Appointment</i><hr></b>
 <form action="admin.php" method="post" enctype="multipart/form-data">
 Customer number:
 <input type="number" name="index">
 <br>
 Mechanic ID:
 <input type="text" name="mechanic_id">
 <br>  
 <input type="submit" name="logInForUpdate">
 <br>
 </form>
 

    </body>
    </html>

<?php 
require_once 'db.php';
    if(isset($_POST["logInForUpdate"])){
        $in=$_POST["index"];
        $min=$_POST["mechanic_id"]; 
       // echo $in;
        //echo $min;
        //echo $cc;
       $update_querry="UPDATE customer SET mecha_ID ='$min' WHERE ID = '$in'"; 
        //echo $update_querry;
        if ($conn->query($u_querr)===true);{
            echo "sucessfully";
        }
        echo "  ";
        if($conn->query($update_querry)===true);{
            echo "Updated";
        }
        if($conn->query($u_querrd)===true);{
            echo '  ';
        }
    }

 ?>
 <h4><i>Work Panel</i></h4>
 <hr>
  <form action="admin.php" method="post" enctype="multipart/form-data">
 Work number:
 <input type="number" name="windex">
 <br>
 Result:
 <input type="text" name="result">
 <br>
 <input type="submit" name="workupdate">
 <br>
 </form>
 <?php 
require_once 'db.php';
    if(isset($_POST["workupdate"])){
        $win=$_POST["windex"];
        $re=$_POST["result"];
       // echo $in;
        //echo $min;
        //echo $cc;
        $update_querry="UPDATE customer SET done ='$re' WHERE ID = '$win'";
        //echo $update_querry;
        echo "  ";
        if($conn->query($update_querry)===true);{
            echo "Served";
        }
    }

 ?>




	






</body>
</html>


