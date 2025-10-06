<?php
// Copyright 1999-2025. WebPros International GmbH. All rights reserved.

// This code is just an example of pre-install script, do not use it in production

$memoryLimit = ini_get('memory_limit');
switch (true) {
    case false !== strpos($memoryLimit, 'K'):
        $memoryLimit = (int)$memoryLimit * 1024;
        break;
    case false !== strpos($memoryLimit, 'M'):
        $memoryLimit = (int)$memoryLimit * 1024 * 1024;
        break;
    default:
        $memoryLimit = (int)$memoryLimit;
}

if ($memoryLimit < 32 * 1024 * 1024) {
    echo "$memoryLimit is too small\n";
    exit(1);
}

exit(0);
