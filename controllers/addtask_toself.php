<?php



        include '../controllers/connection.php';
        include_once '../controllers/init_session.php';



      
        if(isset($_POST['date'])&&isset($_POST['task'])&&isset($_POST['priority']))

            {
          
    
    $task=$_POST['task'];
    $date=$_POST['date'];
    
    $priority=$_POST['priority'];
   
    
    $r->hsetnx('parent','task_id','1');
    
    $task_id=$r->hget('parent','task_id');
   
    $current_date=time();
  
    
    
    $r->hMset('task:'.$task_id, array('name' => $task,'assinged_for'=>$date,'introduced_on'=>$current_date,'association'=>"self".$user_id,'initiators_id'=>$user_id));
     
  
     
     $r->zadd("tasks_associated_by_self:".$user_id,$priority,$task_id);
      $r->sadd("tasks:".$user_id,$task_id);
      $q=$r->zadd("notifications:".$user_id,$current_date,"you added the task ".$task." to the SELF ");
      
  //echo var_dump($q); 
   $r->hincrby('parent','task_id',1);
    //$r->incr('self_id');
    
echo 'gaurav';

header('Location: ../views/add_task.php');

}


        
        
        
        
        
        
        ?>




