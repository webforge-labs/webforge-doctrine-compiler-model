<?php

use Webforge\Common\System\Dir;

require __DIR__.'/vendor/autoload.php';

$GLOBALS['env']['root'] = Dir::factoryTS(__DIR__);