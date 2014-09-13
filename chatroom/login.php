<?php

// if name is not in the post data, exit
if (!isset($_POST["name"])) {
    header("Location: error.html");
    exit;
}

$arrType=array('image/jpg','image/gif','image/png','image/bmp','image/pjpeg');
$max_size='500000';      
$upfile='./image/human'; 
$file=$_FILES['pic'];
  
   if($_SERVER['REQUEST_METHOD']=='POST'){ 
	     if(!is_uploaded_file($file['tmp_name'])){
	     	$picName="./image/auto.png";
	    }else{
	   
   
		  if($file['size']>$max_size){ 
		    echo "<font color='#FF0000'>file is too large</font>";
		    exit;
		   } 
		  if(!in_array($file['type'],$arrType)){ 
		     echo "<font color='#FF0000'>it is not an image file</font>";
		     exit;
		   }
		  if(!file_exists($upfile)){ 
		   mkdir($upfile,0777,true);
		   } 
		  $imageSize=getimagesize($file['tmp_name']);
		   $img=$imageSize[0].'*'.$imageSize[1];
		   $fname=$file['name'];
		   $ftype=explode('.',$fname);
		   $rand=date("YmdHis") . rand(100,999);
		   $picName=$upfile."/".$rand.$fname;
		   
		   if(file_exists($picName)){
		    echo "<font color='#FF0000'>please change to another filename</font>";
		    exit;
		     }
		   if(!move_uploaded_file($file['tmp_name'],$picName)){  
		    echo "<font color='#FF0000'>error</font>";
		    exit;
		    }else{
		   
		    }
     }
}
if(empty($picName)){
	$imgpath="./image/auto.png";
}else{
	$imgpath=$picName;
}


require_once('xmlHandler.php');

// create the chatroom xml file handler
$xmlh = new xmlHandler("chatroom.xml");
if (!$xmlh->fileExist()) {
    header("Location: error.html");
    exit;
}

$xmlh->openFile();

// get the 'users' element as the current element
$users_element = $xmlh->getElement("users");

// create a 'user' element for each user
$user_element = $xmlh->addElement($users_element, "user");

// add the name
$xmlh->setAttribute($user_element, "name", $_POST["name"]);
$xmlh->setAttribute($user_element, "pic", $imgpath);
$xmlh->saveFile();

// set the name to the cookie
setcookie("name", $_POST["name"]);

// Cookie done, redirect to client.php (to avoid reloading of page from the client)
header("Location: client.php");

?>
