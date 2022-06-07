<?php

$url=$_GET["url"]; 

$name=rand();
shell_exec("wget $url -O $name " );
echo file_get_contents($name);
