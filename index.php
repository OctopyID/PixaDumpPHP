<?php

require 'vendor/autoload.php';

$pxd = new \Octopy\PixaDump\PixaDump;
$pxd->send([
    'foo' => 'bar'
]);
