<?php

include '../controllers/connection.php';
//include_once '../controllers/init_session.php';
    
$task_id=$_REQUEST['task_id'];

echo "gaur7a";
echo $task_id;
  $check_task=$r->zadd('state:tasks',1,$task_id);
  echo $check_task;


?>
