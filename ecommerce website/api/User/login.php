<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/user.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare user object
$user = new User($db);
// set ID property of user to be edited
$user->username = isset($_GET['username']) ? $_GET['username'] : die();
$user->password = base64_encode(isset($_GET['password']) ? $_GET['password'] : die());
// read the details of user to be edited
$stmt = $user->login();
if($stmt->rowCount() > 0){
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // create array
    $user_arr=array(
        "status" => true,
        "message" => "Successfully Login!",
        "id" => $row['id'],
        "username" => $row['username']
    );
}
else{
    $user_arr=array(
        "status" => false,
        "message" => "Invalid Username or Password!",
    );
}
// make it json format
//print_r(json_encode($user_arr));
?>
<html>
<head>
<title>login successful!</title>
    <style type="text/css">
       @import url('https://fonts.googleapis.com/css?family=Roboto:300');

body {
  text-align:center;
  background-image: url(login3.jpg);
    background-size: cover;
  color:white;
  font-family:'Roboto';
  font-weight:500;
  font-size:50px;
  padding-top:40vh;
  height:100vh;
  overflow:hidden;
  -webkit-backface-visibility: hidden;
  -webkit-perspective: 1000;
  -webkit-transform: translate3d(0,0,0);
}

div {
  display:inline-block;
  overflow:hidden;
  white-space:nowrap;
}

div:first-of-type {    /* For increasing performance 
                       ID/Class should've been used. 
                       For a small demo 
                       it's okaish for now */
  animation: showup 7s infinite;
}

div:last-of-type {
  width:0px;
  animation: reveal 7s infinite;
}

div:last-of-type span {
  margin-left:-500px;
  animation: slidein 7s infinite;
}

@keyframes showup {
    0% {opacity:0;}
    20% {opacity:1;}
    80% {opacity:1;}
    100% {opacity:0;}
}

@keyframes slidein {
    0% { margin-left:-800px; }
    20% { margin-left:-800px; }
    35% { margin-left:0px; }
    100% { margin-left:0px; }
}

@keyframes reveal {
    0% {opacity:0;width:0px;}
    20% {opacity:1;width:0px;}
    30% {width:500px;}
    80% {opacity:1;}
    100% {opacity:0;width:500px;}
}
    </style>
</head>
    <body>
        <div>Congrats!</div> 
<div> 
  <span>logged in successfully.</span>
</div>
        <script type="text/javascript">
         alert("Login page has loaded successfully\n Server Adnin-Mukund Rastogi");
</script>


    </body>

</html>