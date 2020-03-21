#!/usr/bin/php
<?php

ini_set("default_socket_timeout",2);
error_reporting(0);

$k = "minter_main";
$n[$k][path] = "/etc/nginx/sites-enabled/00_upstream_main.conf";
$n[$k][nodes][] = "10.0.102.141:8841";
$n[$k][nodes][] = "10.0.102.142:8841";
$n[$k][nodes][] = "10.0.102.143:8841";
$n[$k][nodes][] = "10.0.102.146:8841";



//include "node_urls.php";



    print "=================".date("Y-m-d H:i:s")."=================\n";

//$node_urls = node_urls();
$conf_def = "upstream [name] {
[lines]
    server lxgn-o4.o.dp.ua:8841 backup;
}
";

$time = time();

while($time>(time()-58))
{

foreach($n as $k=>$v)
{
unset($lines,$blks,$reg2);
$out = $conf_def;

foreach($v[nodes] as $url)
{
//    $url = $t[1];
    $kuda = "http://";
    $kuda .= $url;
    $kuda .= "/status";
    $a = file_get_contents($kuda);
//    print $a;
    $a = json_decode($a,1);
//    print_r($a);
    $blks[$url] = $a[result][latest_block_height];
}


$m = max($blks);


foreach($blks as $url=>$num)
{
//print "$url";
    if($num<($m-1))
    {
    print "$url - disabled\n";
//    $lines[] = "\tserver $url disabled;";
//    $conf = preg_replace()
    }
    else
    $lines[] = "\tserver $url weight=100 max_fails=2 fail_timeout=5;";
}
$t = implode("\n",$lines);
$out = str_replace("[lines]",$t,$out);
$out = str_replace("[name]",$k,$out);

//print $out;
$md5_1 = md5($out);

$a = file_get_contents($v[path]);
//print $a;
$md5_2 = md5($a);

    if($md5_1 != $md5_2)
    {
    print "=================".date("Y-m-d H:i:s")."=================\n";
    print_r($blks);
print "max = $m\n";
	print "Reload:\n".$out."\n";
	file_put_contents($v[path],$out);
	$exec = "/etc/init.d/nginx force-reload";
	exec($exec,$reg2);
	print_r($reg2);
    }

}
//sleep(5);
for($i=0;$i<5;$i++)
{
print ".";
sleep(1);
}

}

print "\n";



?>