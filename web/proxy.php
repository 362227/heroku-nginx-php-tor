<?php

$url=$_GET["url"]; 

$name=rand();
shell_exec("wget $url -O 1.txt " );
echo file_get_contents("1.txt");
