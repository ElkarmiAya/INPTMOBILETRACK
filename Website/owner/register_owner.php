<?php 

include '../connect.php';

if(isset($_POST['signUp'])){
    $fullName=$_POST['fName'];
    $phone=$_POST['Phone'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $password=md5($password);

     $checkEmail="SELECT * From owners where email='$email'";
     $result=$conn->query($checkEmail);
     if($result->num_rows>0){
        echo "Email Address Already Exists !";
     }
     else{
        $insertQuery="INSERT INTO owners(télephone, nom_complet, email, motdepass)
                       VALUES ('$phone','$fullName','$email','$password')";
            if($conn->query($insertQuery)==TRUE){
                header("location: login_owner.php");
            }
            else{
                echo "Error:".$conn->error;
            }
     }
   

}

if(isset($_POST['signIn'])){
   $email=$_POST['email'];
   $password=$_POST['password'];
   $password=md5($password) ;
   
   $sql="SELECT * FROM owners WHERE email='$email' and motdepass='$password'";
   $result=$conn->query($sql);
   if($result->num_rows>0){
    session_start();
    $row=$result->fetch_assoc();
    $_SESSION['phone']=$row['télephone'];
    $_SESSION['email']=$row['email'];
    header("Location: ownerhomepage.php");
    exit();
   }
   else{
    echo "Not Found, Incorrect Email or Password";
   }

}
?>
