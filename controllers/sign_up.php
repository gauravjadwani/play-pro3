<?php
include '../controllers/connection.php';
if(!empty($_POST['name'])&&!empty($_POST['mobile'])&&!empty($_POST['passwd'])&&!empty($_POST['email']))
{
    $name=$_POST['name'];
    $mobile=$_POST['mobile'];
    $email=$_POST['email'];
    $password=$_POST['passwd'];
    $hashed_password=password_hash($password,PASSWORD_DEFAULT);
    $current_time=time();
    
    
    //$check_email= $r->hexists('email:user',$email);
    
    
    
   
    $r->hsetnx('parent','user_inotwd','1');
    $r->hsetnx('parent','project_id','1');
    $r->hsetnx('parent','task_id','1');
   
   //$user_id=$r->hget('parent','user_id');
    $user_id=$r->hget('parent','user_id');
    
    
   $check_email=$r->hsetnx('email:user',$email,$user_id);
   $check_contact=$r->hsetnx('contact:user',$mobile,$user_id);
    echo $check_hash;
     if($check_email===FALSE)
     {
         //require_once "../views/sign_up.html";
          header("location: ../views/modal.php?q=your email is registered with us!");
         exit();
     }
     if($check_contact===FALSE)
     {
        header("location: ../views/modal.php?q=your contact is registered with us!");
         exit();  
         
     }
    
    
    $check=$r->hMset('user:'.$user_id, array('name' =>$name, 'mobile' =>$mobile,'email'=>$email,'password_hash'=>$hashed_password,'timestamp'=>$current_time)); 
      $r->zadd("state:user",1,$user_id);
      
      
      //echo "<script>window.alert('user id is')</script>";
      
   if($check==1)
    { 
    echo "e";
        header("location: ../views/login.html");
    }
    else 
        echo "non-comit";
$r->hincrby('parent','user_id',1);
}
?>
