<?php
define('APPLICATION_PATH', dirname(dirname(__FILE__)));

set_include_path(
    APPLICATION_PATH . '/library/'
    . PATH_SEPARATOR . get_include_path()
);
