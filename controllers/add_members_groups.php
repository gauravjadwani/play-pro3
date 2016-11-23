<?php
include '../controllers/connection.php';
include_once '../controllers/init_session.php';
    

    $group_id=$_POST['group_id'];
if($group_id!='default')
{
        $list_modify=$_POST['list_members_modify'];
    $list_readonly=$_POST['list_members_readonly'];
    
    $group_id_name=$r->hget("group:".$group_id,'name');
    $current_time=time();
    echo $group_id."<br>";
    if(!empty($list_modify))
    {
$split_email= split(",",$list_modify); 
    
for($i=0;$i<sizeof($split_email);$i++)
{
     //echo 'list_modify:'.$split_email[$i].'<br>';
    $email_userid=$r->hget("email:user",$split_email[$i]);
    //echo $email_userid;
    $email_userid_name=$r->hget("user:".$email_userid,'name');
     //$r->sadd("projects:".$email_userid,$project_id);
     $r->zadd("notifications:".$email_userid,$current_time,"you were added in the project  by ".$name);
     $r->zadd("notifications:".$user_id,$current_time,"you added ".$email_userid_name." in the group ".$group_id_name);
     
         
        
   $r->zadd("group_permissions:".$group_id,'2',$email_userid);
 //$r->zadd("notifications:".$email_userid,$current_time,"you have been added as the group modifier in the ".$name_group."by the ".$name);
     
   
   $projects_list=$r->smembers("projects_group:".$group_id);
   
   foreach ($projects_list as $key) 
       {
        $r->sadd("projects:".$email_userid,$key);
   }
   
   
     
    
}
    }
    
     
     
    if(!empty($list_readonly))
    {
    
$split_email= split(",",$list_readonly); 
    
for($i=0;$i<sizeof($split_email);$i++)
{
   
 
  $email_userid=$r->hget("email:user",$split_email[$i]);
   $email_userid_name=$r->hget("user:".$email_userid,'name');
     //$r->sadd("projects:".$email_userid,$project_id);
      $r->zadd("notifications:".$email_userid,$current_time,"you were added in the project  by ".$name);
          $r->zadd("notifications:".$user_id,$current_time,"you added ".$email_userid_name." in the project ");
     $r->zadd("group_permissions:".$group_id,'3',$email_userid);
 //$r->zadd("notifications:".$email_userid,$current_time,"you have been added as the group read-only in the ".$name_group."by the ".$name);
     
      $projects_list=$r->smembers("projects_group:".$group_id);
   
   foreach ($projects_list as $key) 
       {
        $r->sadd("projects:".$email_userid,$key);
   }
   
    
}
    }
    
    
    
    //header('Location: ../views/add_members_groups.php');
    
    
    
}
 else {
echo "no:id";    
}



?>
