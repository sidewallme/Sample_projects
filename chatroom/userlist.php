<?php

if (!isset($_COOKIE["name"])) {
    header("Location: error.html");
    return;
}
require_once('xmlHandler.php');
// create the chatroom xml file handler
$xmlh = new xmlHandler("chatroom.xml");
if (!$xmlh->fileExist()) {
    header("Location: error.html");
    exit;
}

// get the name from the cookie
$name = $_COOKIE["name"];
        
$xmlh->openFile();

// get the users element
$users_node = $xmlh->getElement("users");

// get all user nodes
$users_array = $xmlh->getChildNodes("user");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>User List</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
	<table border="1" cellspacing="0" cellpadding="5" align="left">
		<tr bgcolor="#ffffff">
			<th>UserPic</th>
			<th>UserName</th>
		</tr>
		<?php
		if($users_array != null) {
		 foreach ($users_array as $user) {?>
		<tr style="border-top: 1px solid gray" align="left">
		<td><img src="<?php echo $xmlh->getAttribute($user, "pic");?>" alt="<?php echo  $xmlh->getAttribute($user, "name")?>" width="50" height="50"></td>
		<td><?php echo $xmlh->getAttribute($user, "name")?></td>
		</tr>
		<?php }
		} ?>
	</table>
</body>
</html>