#!/usr/bin/env php
<?php

set_time_limit(0);

$vendorDir = __DIR__;
$deps = array(
    array('symfony', 'http://github.com/symfony/symfony', isset($_SERVER['SYMFONY_VERSION']) ? $_SERVER['SYMFONY_VERSION'] : 'origin/master'),
);

foreach($deps as $dep)
{
    list($name, $url, $rev) = $dep;

    echo "> Installing/Updating $name\n";

    $installDir = $vendorDir.'/'.$name;
    
    if(!is_dir($installDir))
    {
        system(sprintf('git clone -q %s %s', mopashellarg($url), mopashellarg($installDir)));
    }

    system(sprintf('cd %s && git fetch -q origin && git reset --hard %s', mopashellarg($installDir), mopashellarg($rev)));
}