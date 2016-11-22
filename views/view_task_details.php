<html>
    <body>
       <?php
include '../controllers/connection.php';
include_once '../controllers/init_session.php';

if(isset($_REQUEST['task_id']))
{
    //echo $_REQUEST['task_id'];
$task=$_REQUEST['task_id'];
$hash=$r->hvals('task:'.$task);
//foreach($hash as $i)
    //echo $i;

$task_project=$r->hget('task:'.$task,'association');

//echo var_dump($task_project);

$d=split(':',$task_project);
//echo var_dump($task_project);
if($d[0]=='project')
{
$zscore_task=$r->zscore('tasks_associated_by_project:'.$d[1],$task);
$priority=$zscore_task;
}

else
{
    $zscore_task=$r->zscore('tasks_associated_by_self:'.$user_id,$task);
    $priority=$zscore_task;
}


////echo var_dump($task_project);
//echo"dd".$d[0];

echo "name:".$hash[0]."<br>";
//echo "priority:".$hash[1]."<br>";
echo "assinged_for:".$hash[1]."<br>";
echo "introduced_on:".$hash[2]."<br>";
echo "initiator's id:".$hash[4]."<br>";
echo "priority of the task: ".$priority;
//echo "status:".$hash[4];
//echo "status:".$hash[4];
//print '<form action="../controllers/complete_task.php" method="POST"><input type="hidden" value=".$task_id." name="hide"><input type="submit" value="submit"></form>';

print '<form action="" method="POST"><input type="submit"  name="submit"></form>';

//session_start();
//$_SESSION['name']='gaurav';
if(isset($_POST["submit"])) 
{
/*
 "http://localhost/play-pro3/controllers/complete_task.php"
 */
    
$ch = curl_init("http://".$_SERVER['SERVER_NAME']."/play-pro3/controllers/complete_task.php");

curl_setopt($ch,CURLOPT_POST, true);

curl_setopt($ch,CURLOPT_POSTFIELDS,"task_id=$task");
curl_setopt($ch,CURLOPT_HEADER,0);

curl_setopt($ch, CURLOPT_RETURNTRANSFER,false );
$resp = curl_exec($ch);
curl_close($ch);
header('Location: dashboard.php');


/*
http://localhost/play-pro3/views/dashboard.php
 */

}





}
else if(isset($_REQUEST['project_id']))
{
    $project=$_REQUEST['project_id'];
    $hash=$r->hvals('project:'.$project);
    echo "name:".$hash[0]."<br>";
    echo "created on:".$hash[1]."<br>";
    echo "description:".$hash[2]."<br>";
    echo "deadline:".$hash[3]."<br>";
    //echo "status:".$hash[4]."<br>";
    //echo $hash[4];
    $group_id=$hash[4];
    
    $list_members=$r->zrange('group_permissions:'.$group_id,0,-1);
   
    print "<h1>list of group associates</h1>";

            foreach ($list_members as $user)
            {
            $user_details=$r->hvals('user:'.$user);
    echo "name:".$user_details[0]."<br>";
     echo "email:".$user_details[2]."<br>";
                
      echo "<hr>";
            }
} 
?>
</body>
</html>