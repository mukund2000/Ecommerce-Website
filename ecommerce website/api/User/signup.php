<?php
 
// get database connection
include_once '../config/database.php';
 
// instantiate user object
include_once '../objects/user.php';
 
$database = new Database();
$db = $database->getConnection();
 
$user = new User($db);
 
// set user property values
$user->username = $_POST['username'];
$user->password = base64_encode($_POST['password']);
$user->created = date('Y-m-d H:i:s');
 
// create the user
if($user->signup()){
    $user_arr=array(
        "status" => true,
        "message" => "Successfully Signup!",
        "id" => $user->id,
        "username" => $user->username
    );
}
else{
    $user_arr=array(
        "status" => false,
        "message" => "Username already exists!"
    );
}
//print_r(json_encode($user_arr));
?>
<html>
<head>
    <title>sign up successful!</title>
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
    <div> Congrates</div>
    <div><span> Signup successfully!</span></div> 
    <script type="text/javascript">
         alert("Signup page has loaded successfully\n Server Adnin-Mukund Rastogi");
</script>
    
    </body>
</html>