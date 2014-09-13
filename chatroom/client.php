<?php

if (!isset($_COOKIE["name"])) {
    header("Location: error.html");
    return;
}

// get the name from cookie
$name = $_COOKIE["name"];

print "<?xml version=\"1.0\" encoding=\"utf-8\"?>";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Add Message Page</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
        <script type="text/javascript">
        //<![CDATA[
		function myFunction_white(){
			var color_field=document.getElementById("clr");
			color_field.value ="0xffffff";		
		}
		
		function myFunction_red(){
			var color_field=document.getElementById("clr");
			color_field.value ="0xff0000";		
		}
		
		function myFunction_green(){
			var color_field=document.getElementById("clr");
			color_field.value ="0x00ff00";		
		}
		
		function myFunction_blue(){
			var color_field=document.getElementById("clr");
			color_field.value ="0x0000ff";		
		}
		
		function myFunction_yellow(){
			var color_field=document.getElementById("clr");
			color_field.value ="0xffff00";		
		}
		
		function myFunction_gblue(){
			var color_field=document.getElementById("clr");
			color_field.value ="0x00ffff";		
		}
		
        function load() {
            var name = "<?php print $name; ?>";
            window.parent.frames["message"].document.getElementById("username").setAttribute("value", name)
            document.getElementById("username").setAttribute("value", name);
            setTimeout("document.getElementById('msg').focus()",100);
        }

        function uploadNanoGong() {
            // find the applet object
            var applet = document.getElementById("nanogong");
            var duration = applet.sendGongRequest("GetMediaDuration", "audio");
            console.log(duration);
            // get the length of the recorded audio
            if (duration <= 0) return true;

            // Tell the applet to post the voice recording to process_nanogong.php
            // A result will be returned and stored in the variable ret
            var ret = applet.sendGongRequest("PostToForm", "process_nanogong.php",
                                             "voicefile", "", "temp");
            console.log("ret: "+ret);
            // if the value of variable ret is null or empty, the voice upload has failed
            if (ret == null || ret == "") {
                alert("Failed to submit the voice recording!");
                return false;
            }

            // set the filename form field
            document.getElementById("filename").value = ret;
            // document.getElementById("filename").setAttribute("value", ret);
            console.log(document.getElementById("filename").value);
            return true;
        }
        //]]>
        </script>
    </head>
    <body style="text-align: left" onload="load()">
        <form action="add_message.php" method="post" onsubmit="return uploadNanoGong();">
            <table border="0" cellspacing="5" cellpadding="0">
                <tr>
                    <td>What is your message?</td>
                </tr>
                <tr>
                    <td><input class="text" type="text" name="message" id="msg" style= "width: 600px" /></td>
					<td><input class="text" type="text" name="color" id="clr"  value="0xffffff" style= "visibility:hidden;width: 0px" /></td>
					<td><button id="clab" type="button" style="width:45px;height:45px;background:#ffffff" onclick="myFunction_white()" ></td>
					<td><button id="clab" type="button" style="width:45px;height:45px;background:#ff0000" onclick="myFunction_red()" ></td>
					<td><button id="clab" type="button" style="width:45px;height:45px;background:#00ff00" onclick="myFunction_green()" ></td>
					<td><button id="clab" type="button" style="width:45px;height:45px;background:#0000ff" onclick="myFunction_blue()" ></td>
					<td><button id="clab" type="button" style="width:45px;height:45px;background:#ffff00" onclick="myFunction_yellow()" ></td>
					<td><button id="clab" type="button" style="width:45px;height:45px;background:#00ffff" onclick="myFunction_gblue()" ></td>
                    <td>
                       
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="username" id="username" value = "<?php $name; ?>" />
                   
                        <input class="button" type="submit" value="Send Your Message" style="width: 200px" />
                    </td>
                </tr>
            </table>
        </form>
        <hr />
		
			<table border="0" cellspacing="5" cellpadding="0">
				<tr>
					<td>
					<form action="userlist.php" target="_blank">
						<table border="0" cellspacing="5" cellpadding="0" align="left">
							<tr style="border-top: 1px solid gray" align="left">
								<td><input class="button" type="submit" value="Browse Online User List" style="width: 200px" /></td>
							</tr>
						</table>
					</form>
					</td>
					<td>
					<form action="logout.php" method="post" onsubmit="alert('Goodbye!')">
						<table border="0" cellspacing="5" cellpadding="0" align="left">
							<tr style="border-top: 1px solid gray" align="left">
								<td><input class="button" type="submit" value="Logout" style="width: 200px" /></td>
							</tr>
						</table>
					</form>
					</td>
				</tr>
			</table>
		
    </body>
</html>
