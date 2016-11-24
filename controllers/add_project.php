<?php 
if(!empty($_POST['date']))

            {
include '../controllers/connection.php';
include_once '../controllers/init_session.php';
    



    $name_project=$_POST['name_of_the_project'];
    $name_group=$_POST['name_of_group'];
    $date=$_POST['date'];
    $decription=$_POST['desc'];
    $form_group_id=$_POST['group_id'];
    
   
   
     $r->hsetnx('parent','project_id','1');
      $r->hsetnx('parent','group_id','1');
      $project_id= $r->hget('parent','project_id');
      $group_id= $r->hget('parent','group_id');
   
    $current_date= date("Y/m/d");
    $current_time=time();
   
   if($form_group_id=='default') 
   {
   
       $r->hMset('group:'.$group_id, array('name' => $name_group,'created_on'=>$date,'closed_on'=>'live'));
   $che=$r->zadd("group_permissions:".$group_id,1,$user_id);
   echo var_dump($che);
   
   $r->zadd("state:projects",'0',$project_id);
   $r->zadd("notifications:".$user_id,$current_time,"you added yourself as the group owner in the ".$name_group);
 
    
   
    
    $r->hMset('project:'.$project_id, array('name' => $name_project,'created_on'=>$current_date,'description'=>$decription,'deadline'=>$date,'associated_group'=>$group_id));
    $r->sadd("projects:".$user_id,$project_id);
    $r->zadd("notifications:".$user_id,$current_time,"you created the project ".$name_project);
   
    
    echo $group_id."<br>"; 
    $r->sadd("projects_group:".$group_id,$project_id);
    
    $list_modify=$_POST['list_members_modify'];
    $list_readonly=$_POST['list_members_readonly'];

    
    
  
       
      if(!empty($list_modify))
    {
$split_email= split(",",$list_modify); 
 
for($i=0;$i<sizeof($split_email);$i++)
{
     //echo 'list_modify:'.$split_email[$i].'<br>';
    $email_userid=$r->hget("email:user",$split_email[$i]);
     $r->sadd("projects:".$email_userid,$project_id);
     $r->zadd("notifications:".$email_userid,$current_time,"you were added in the project".$name_project);
     
     
         
        
   $r->zadd("group_permissions:".$group_id,'2',$email_userid);
 $r->zadd("notifications:".$email_userid,$current_time,"you have been added as the group modifier in the ".$name_group."by the ".$name);
     
     
     
    
}
    }
    
     
     
    if(!empty($list_readonly))
    {
    
$split_email= split(",",$list_readonly); 
    
for($i=0;$i<sizeof($split_email);$i++)
{
   
 
  $email_userid=$r->hget("email:user",$split_email[$i]);
     $r->sadd("projects:".$email_userid,$project_id);
     $r->zadd("notifications:".$email_userid,$current_time,"you were added in the project".$name_project);
     
      $r->zadd("group_permissions:".$group_id,'3',$email_userid);
 $r->zadd("notifications:".$email_userid,$current_time,"you have been added as the group read-only in the ".$name_group."by the ".$name);
     
     
    
}
    }
    
    

$r->hincrby('parent','project_id',1);
$r->hincrby('parent','group_id',1);
    }
   
    else 
        {
   
    
     $r->hMset('project:'.$project_id, array('name' => $name_project,'created_on'=>$current_date,'description'=>$decription,'deadline'=>$date,'associated_group'=>$form_group_id));
    //echo 'from_group:'.$form_group_id.'<br>'; 
     $r->sadd("projects:".$user_id,$project_id);
      $r->zadd("notifications:".$user_id,$current_time,"you created the project ".$name_project."with the group id ".$form_group_id);
     
      $r->sadd("projects_group:".$form_group_id,$project_id);
      $r->zadd("state:projects",'0',$project_id);
    
    $list_modify=$_POST['list_members_modify'];
    $list_readonly=$_POST['list_members_readonly'];

    
    
  
       
      if(!empty($list_modify))
    {
$split_email= split(",",$list_modify); 
 
for($i=0;$i<sizeof($split_email);$i++)
{
     //echo 'split_email:'.$split_email[$i].'<br>';
     
      $email_userid=$r->hget("email:user",$split_email[$i]);
     $r->sadd("projects:".$email_userid,$project_id);
     $r->zadd("notifications:".$email_userid,$current_time,"you were added in the project".$name_project);
     
     
    
}
    }
    
     
     
    if(!empty($list_readonly))
    {
    
$split_email= split(",",$list_readonly); 
    
for($i=0;$i<sizeof($split_email);$i++)
{
   //echo 'list_readonly:'.$split_email[$i].'<br>';
    $email_userid=$r->hget("email:user",$split_email[$i]);
//$r->zadd("group_permissions:".$group_id,'3',$split_email[$i]);
 $r->sadd("projects:".$email_userid,$project_id); 
 $r->zadd("notifications:".$email_userid,$current_time,"you were added in the project".$name_project);
 
    
}
    }
    
    
    
    //heck=$r->rpush("list_of_dates".$email,$date);    
///if($check==1)
        //echo "inserted";
$r->hincrby('parent','project_id',1);
    }
}
header('Location: ../views/add_project.php');


        
        
        
        
        
        
        ?>