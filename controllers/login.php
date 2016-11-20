<?php
include '../controllers/connection.php';


    $email=$_POST['email'];
    $check_email=$r->hexists('email:user',$email);
    //$check_email=$r->exists($email);
    $password=$_POST['passwd'];
    if($check_email==1)
    {
         $user_id=$r->hget('email:user',$email);
        
        
    //$hashed_password=sha1($password);
     $check_hash=$r->hget('user:'.$user_id,'password_hash');
    //echo var_dump($check_hash);
     if (password_verify($password,$check_hash)) 
                {
         session_start();
            $_SESSION["email"]=$email;
            $name=$r->hget($email,'name');
            $_SESSION["name"]=$name;
           
            $_SESSION["user_id"]=$user_id;
                    
            
            header("Location: ../views/dashboard.php");
} 
else {
    echo "wrong password";
   //$alert="wrong password"; 
   //include 'error.php';
        
}
     
     
       }
 else {
echo "wrong email";           
}
    ?>







    