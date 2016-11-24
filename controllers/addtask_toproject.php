<?php
        include '../controllers/connection.php';
        include_once '../controllers/init_session.php';



        $current_time=time();
        
        if(isset($_POST['date'])&&isset($_POST['task'])&&isset($_POST['priority']))

            {

    $task=$_POST['task'];
    $date=$_POST['date'];
    
    //$r->hsetnx('parent','project_id','1');
   //$project_id=$r->hget('parent','project_id');
    $project_id=$_POST['project_id'];
   $project_details=$r->hvals("project:".$project_id);
   
    
   
   
    $priority=$_POST['priority'];
   
    
    
     $r->hsetnx('parent','task_id','1');
   $task_id=$r->hget('parent','task_id');
   
    
   
    $r->hMset('task:'.$task_id, array('name' => $task,'assinged_for'=>$date,'introduced_on'=>$current_time,'association'=>'project:'.$project_id,'initiators_id'=>$user_id));
    
   
   
   $r->zadd("state:tasks",0,$task_id);
    
   $r->zadd("task_associated_to_project:".$project_id,$priority,$task_id);
   
     $associated_group=$r->hget("project:".$project_id,'associated_group');
    
  
    $current_date=time();
 $group_permissions=$r->zrange("group_permissions:".$associated_group,'0','-1');
    
 //echo var_dump($group_permissions);   
 foreach($group_permissions as $c)
    {
        
         $r->sadd("tasks:".$c,$task_id);
         if($c==$user_id)
            $r->zadd("notifications:".$c,$current_time,"you added the task ".$task." to the project ".$project_details[0]);
         else
        $r->zadd("notifications:".$c,$current_time,"the task ".$task." has been added to the project ".$project_details[0]);
    }
   
     
     
   //$r->zadd("notifications:".$user_id,$current_time,"you added task name ".$task."to project ".$project_details[0]);
     //$r->zadd("permissions:".$task_id,'1',$email);
        //$r->sadd("notifications:".$email,$task_id);
     //$r->sadd("tasks:".$user_id,$task_id);
     $r->zadd("tasks_associated_by_project:".$project_id,$priority,$task_id);
     
    

//$r->rpush("dates".$email,$date." ".$task_id);
    $r->incr('task_id');
    
//$check=$r->rpush("list_of_dates".$email,$date);    
///if($check==1)
        //echo "inserted";

$r->hincrby('parent','task_id',1);

}

header('Location: ../views/addtask_toproject.php');
        
        
        
        
        
        
        ?>