
        
        
     


<?php





$task_list=$r->zrange("tasks_associated_by_self:".$user_id,0,-1);
//echo var_dump($task_list);
foreach($task_list as $task)
{
    $task_score=$r->zscore("state:tasks",$task);
  // $check_task=$r->hget('tasks:'.$task,'status');
   
   if($task_score=='0')
   {
       $task_name=$r->hget('task:'.$task,'name');
       //echo $task;
      PRINT   "<a href='view_task_details.php?task_id=$task'>
          <li class='list-group-item list-group-item-success'>".$task_name."</li>
              </a>&nbsp";
  //echo var_dump($check_task);
    
}
}

?>
  