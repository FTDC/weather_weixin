<?php
//先切换到程序部署的目录
$path = dirname(__FILE__);
exec("cd {$path}");
echo $path;

exec("sudo /usr/bin/svn up --force", $output);
var_dump($output);

?>  
