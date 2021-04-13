<?php
echo "<br><br>";
//This one will show the IP that is listed in the cPanel
echo $_SERVER['SERVER_ADDR'];


echo "<br><br>API-IP: ";
//This is the IP that the API needs to successfully connect
echo file_get_contents("https://api.ipify.org");
?>