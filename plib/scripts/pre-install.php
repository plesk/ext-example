<?php

$displayErros = ini_get('display_errors');
if ($displayErros) {
    var_dump($displayErros);
    echo "display_errors = On\n";
    exit(1);
}

exit(0);
