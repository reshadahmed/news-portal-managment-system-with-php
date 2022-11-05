<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>Hello User</h1>
    <?php
    session_start();
    $name= $_SESSION['user'];
    $password=$_SESSION['pass'];
    
    if(!empty($name) && !empty($password)){
        $file = file_get_contents('data.json');
        $assoc = json_decode($file, true);
        //var_dump($assoc);
    
        foreach($assoc as $file){
            if($file["name"]==$name && $file["password"]==$password){
                echo "Successfully Logged In<br>";
                echo "Name: ".$name."<br>";
                echo "Email: ".$file['email']."<br>";
                echo "Gendr: ".$file['gender']."<br>";
                echo "Date of Birth: ".$file['dob']."<br>";
                //header('Location:profile.php');
            }
        }
      }
    ?>
</body>
</html>