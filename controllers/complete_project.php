<?php

include '../controllers/connection.php';
//include_once '../controllers/init_session.php';
    
$project_id=$_REQUEST['project_id'];

//echo "gaur7a";
//echo "huh";
//echo $task_id;
  $check_project=$r->zadd('state:projects',1,$project_id);
  //echo $check_task;


?>
