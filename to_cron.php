#!/usr/bin/php
<?php
$a = "nginx_node_upstream_checker.php";

$d = __DIR__;
$f = $d."/".$a;
$txt = "* * * * * 	root	cd $d;./$a > $a.log 2>&1\n";

print $txt;