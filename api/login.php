<?php
include_once("../include/auth.php");
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$random = '';
  for ($i = 0; $i < 200; $i++) {
    $random .= chr(mt_rand(33, 126));
  }
if(isset($postdata) && !empty($postdata))
{
$pwd = mysqli_real_escape_string($mysqli, trim($request->password));
$email = mysqli_real_escape_string($mysqli, trim($request->email));
$pass = md5($pwd);
$sql = "SELECT * FROM users where email='$email' and password='$pass'";
if($result = mysqli_query($mysqli,$sql))
{
$rows = array();
while($row = mysqli_fetch_assoc($result))
{
$dbemail = $row['email'];
$id = $row['id'];
}
if(empty($dbemail) == true){
echo json_encode(array("message" => "Invalid Pasword/Email"));
} else {
echo json_encode(array("id" => $id, "email" => $dbemail,"token" =>$random, "auth" =>true, "status" =>200, "message" =>"success"));
}
}
else
{
http_response_code(404);
}
}
?>