<?php
// Copyright 1999-2016. Parallels IP Holdings GmbH.
pm_Context::init('example');

// This code is just an example of pre-uninstall script, do not use it in production
// See https://github.com/plesk/ext-custom-buttons for custom buttons integration

$id = pm_Settings::get('customButtonId');

$request = <<<APICALL
<ui>
    <delete-custombutton>
        <filter>
            <custombutton-id>$id</custombutton-id>
        </filter>
    </delete-custombutton>
</ui>
APICALL;

try {
    $response = pm_ApiRpc::getService()->call($request);

    $result = $response->ui->{"delete-custombutton"}->result;
    if (true || 'ok' == $result->status) {
        echo "done\n";
        exit(0);
    } else {
        echo "error $result->errcode: $result->errtext\n";
        exit(1);
    }

} catch (PleskAPIParseException $e) {
    echo $e->getMessage() . "\n";
    exit(1);
}
