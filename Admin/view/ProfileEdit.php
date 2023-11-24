<?php
ob_start();
?>
<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    
</head>
<body class="home">  
<?php
include "header.php";
include "conn.php";


$nameErr= $nameErr2 = $emailErr = $genderErr = $dobErr = $passErr= "";
$uname = $email = $gender = $phone = $dob = $password=$id  = "";
$message= $error ="";

 // select or read data start
    include "../model/mydb.php";
$mydb= new MyDB();
$conobj=$mydb->openCon();
$result=$mydb->getAllUsers("admin", $conobj);
 
 
 if ($result->num_rows > 0) {
        // output data of each row
     while($row = $result->fetch_assoc()) {
         if($_SESSION['email']==$row['email'] && $_SESSION['pass']=$row['password']){

            $id= $row["id"];
            $uname= $row["uname"];
            $email= $row["email"];
			$gender= $row["gender"];
            $dob= $row["dob"];
            $phone= $row["phone"];
            $password= $row["password"];

         }
     }
 } else {
     echo "0 results";
 }
 



?>



<section class="registerForm" style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Update Profile</p>

                <form id="regForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">  


                  <div class="d-flex flex-row align-items-center mb-4">
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" id="form3Example1c" class="form-control" value="<?php echo $uname?>" name="uname" />
                      <label class="form-label" for="form3Example1c">Your Name</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    
                    <div class="form-outline flex-fill mb-0">
                      <input type="email" id="form3Example3c" class="form-control" value="<?php echo $email?>" name="email" hidden/>
                    </div>
                  </div>


                  <div class="d-flex flex-row align-items-center mb-4">
                    
                    <div class="form-outline flex-fill mb-0">
                      <input type="date" id="form3Example3c" class="form-control" value="<?php echo $dob?>" name="dob"/>
                      <label class="form-label" for="form3Example3c">Date of Birth</label>
                    </div>
                  </div>

              

                  <div class="d-flex flex-row align-items-center mb-4">
                    
                    <div class="form-outline flex-fill mb-0">



                    <?php
                    if($gender=="male"){
                      echo'
                      <input type="radio" name="gender" value="female"> Female
                      <input type="radio" name="gender" checked value="male"> Male
                      <input type="radio" name="gender" value="other"> Other
                      ';
                    }
                    if($gender=="female"){
                      echo'
                      <input type="radio" name="gender" checked value="female"> Female
                      <input type="radio" name="gender" value="male"> Male
                      <input type="radio" name="gender" value="other"> Other
                      ';
                    }
                    if($gender=="other"){
                      echo'
                      <input type="radio" name="gender" value="female"> Female
                      <input type="radio" name="gender"  value="male"> Male
                      <input type="radio" name="gender" checked value="other"> Other
                      ';
                    }
                    ?>

                    <label class="form-label" for="form3Example4c">Gender</label>
                    </div>
                  </div>


				  <div class="d-flex flex-row align-items-center mb-4">
                    
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" id="form3Exampl" class="form-control" value="<?php echo $phone?>" name="phone"/>
                      <label class="form-label" for="form3Exampl">Phone</label>
                    </div>
                  </div>

                  <input type="hidden" name="password" value="<?php echo $password?>" > 
                 


                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" name="submit" class="btn btn-primary btn-lg">Submit</button>
                  </div>

                </form>

              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <img src="../Controller/pexels-tirachard-kumtanom-733852.jpg"
                  class="img-fluid" alt="Sample image">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>  






<?php
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
else{
// insert start

if(isset($_POST['submit'])){
$uname = $_POST['uname'];
$email = $_POST['email'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$phone = $_POST['phone'];
$password = $_POST['password'];

$sql = "UPDATE admin SET uname='$uname', email = '$email',dob='$dob', gender='$gender', phone='$phone',password='$password' WHERE id= $id";

if ($conn->query($sql) === TRUE) {
  echo "Record Updated successfully <br>";
  $_SESSION['user']=$name;

  //header("Refresh:0");
  // select or read data start
header("Location: AdminProfile.php");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
// insert end



}
$conn->close();
}


?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>