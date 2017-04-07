<!DOCTYPE html>
<html>
   <head>
      <title>Mechanix Store</title>
      <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="css/style.css">
      <link href="https://fonts.googleapis.com/css?family=Monoton" rel="stylesheet">
      <link rel="shortcut icon" type="image/png" href="favicon.png"/>
   </head>
   <body>
      <header class="image-bg-fluid-height">
         <h1 style="font-size: 45pt;">Mechanix Store</h1>
         <h3>Where all your problems are fixed!</h3>
         <img class="img-responsive img-center"alt="">
      </header>
      <!--
         <div class="container">
          <div class="row">
            <div class="col-md-12 jumbotron">
              <div class="text-center">
                <h1>Mechanix Store</h1>
                <h3>Someone has to fix the problems</h3>
         
              </div>
            </div>
          </div>
         </div>
         
         
         -->
      <div class="row">
         <div class="col-md-3"> 
         </div>
         <div class="col-md-6">
            <form class="form-horizontal" action="index.php" method="post">
               <div class="form-group">
                  <label for="inputName" class="col-sm-2 control-label">Name</label>
                  <div class="col-sm-10">
                     <input type="Name" class="form-control" id="inputName" required placeholder="Name" name="name">
                  </div>
               </div>
               <div class="form-group">
                  <label for="inputAddress" class="col-sm-2 control-label">Address</label>
                  <div class="col-sm-10">
                     <textarea id="txtArea" class="form-control" rows="5" required cols="100" name="address" placeholder="Enter your Address">  </textarea>
                  </div>
               </div>
               <div class="form-group">
                  <label for="inputNumber" class="col-sm-2 control-label">Phone Number</label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control" id="inputNumber" required placeholder="Phone Number" name="phone">
                  </div>
               </div>
               <div class="form-group">
                  <label for="inputLicenseNumber" class="col-sm-2 control-label">Car License Number</label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control" id="inputLicenseNumber" required placeholder="License Number" name="carLicenseNo">
                  </div>
               </div>
               <div class="form-group">
                  <label for="inputEngineNumber" class="col-sm-2 control-label">Car Engine Number</label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control" id="inputEngineNumber" required placeholder="Engine Number" name="carEngineNo">
                  </div>
               </div>
               <div class="form-group">
                  <label for="inputAppointmentDate" class="col-sm-2 control-label">Appointment Date</label>
                  <div class="col-sm-10">
                     <input type="date" class="form-control" id="inputAppointmentDate" required placeholder="AppointmentDate" name="appointday">
                  </div>
               </div>
               <div class="form-group">
                  <label for="inputAppointmentDate" class="col-sm-2 control-label">Choose Mechanic</label>
                  <div class="col-sm-10"> 
                     <select required class="form-control" name="checked">
                      <option value="kundu">Kundu Mamu</option>
                      <option value="rafsan">Rafsan Chacchu</option>
                      <option value="intisar">Intisar Mamu</option>
                      <option value="parash">Parash Chachhu</option>
                    </select>
                  </div>
               </div>
               <!--
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> Remember me
                        </label>
                      </div>
                    </div>
                  </div>
                  
                  -->
               <div class="form-group">
               <div class="col-sm-offset-2 col-sm-10">
               <button type="submit" class="btn btn-default" name="clicked">Submit</button>
               </div>
               </div>
            </form>
         </div>
         <div class="col-md-3">
         </div>
      </div>
   </body>
</html>


<?php 
  
  include "database.php";
  
   if(isset($_POST["clicked"])){
            $name=$_POST["name"];
            $address=$_POST["address"];
            $phone=$_POST["phone"];
            $carLicenseNo=$_POST["carLicenseNo"];
            $carEngineNo=$_POST["carEngineNo"];
            $appointday=$_POST["appointday"];
            $checked=$_POST["checked"]."";
            $total;


            if (!is_numeric($phone)||!is_numeric($carEngineNo)) {
              echo "<script type='text/javascript'>alert('Input valid cell or engine number')</script>";
            }
            


            else {
              $select_sql="SELECT COUNT(*) as total FROM customer where done='' AND mecha_id='$checked' AND app_date='$appointday'";
              // $run_select_sql=mysql_query($select_sql);
              if($conn->query($select_sql)){
                $result = $conn->query($select_sql);
                while($row = $result->fetch_assoc()){
                  // echo  $row["total"];
                  $total=$row["total"];
                }
                // echo "true";
              }
              else{
                echo "Problem";
              }
              if($total<4){
              $insert_sql = "INSERT INTO  customer(name,  address,cell_no,car_license,
                car_engine,app_date,mecha_id,done)VALUES ('$name','$address','$phone',
                '$carLicenseNo','$carEngineNo','$appointday','$checked','')";

              if($conn->query($insert_sql)===TRUE ){
                  echo '<br>Sucessful. 
                  Sir....You will be informed soon.<br>';

                  $insert_sql2="INSERT INTO mechanic(customer_cell,name,mecha_ID)  VALUES ('$phone','$name','$checked')";
                  if($conn->query($insert_sql2)===TRUE){
                    echo '<br>Thank You!<br>';
                  }
                  else{
                    echo "mechanic problem";
                  }
              }
            }
              else{
                echo "<br>Excuse us....try to attain another mechanic.He already has a lot. <br>";
              }

            }
          
            


            // echo $checked;

    }


 ?>