<?php

if (false !== ($upgrade = array_search('upgrade', $argv))) {
    $upgradeVersion = $argv[$upgrade + 1];
    echo "upgrading from version $upgradeVersion\n";

    if (version_compare($upgradeVersion, '1.2') < 0) {
        pm_Bootstrap::init();
        $id = pm_Bootstrap::getDbAdapter()->fetchOne("select val from misc where param = 'moduleExampleCustomButton'");
        pm_Bootstrap::getDbAdapter()->delete('misc', array("param = 'moduleExampleCustomButton'"));

        pm_Context::init('example');
        pm_Settings::set('customButtonId', $id);
    }

    echo "done\n";
    exit(0);
}

$request = <<<APICALL
<ui>
   <create-custombutton>
         <owner>
            <admin/>
         </owner>
      <properties>
         <file>/usr/local/psa/admin/htdocs/skins/default/plesk/icons/help_on.gif</file>
         <internal>true</internal>
         <place>navigation</place>
         <url>/modules/example/index.php</url>
         <text>Example Module</text>
      </properties>
   </create-custombutton>
</ui>
APICALL;

try {
    $response = pm_ApiRpc::getService()->call($request);

    $result = $response->ui->{"create-custombutton"}->result;
    if ('ok' == $result->status) {
        pm_Context::init('example');
        pm_Settings::set('customButtonId', $result->id);
        echo "done\n";
        exit(0);
    } else {
        echo "error $result->errcode: $result->errtext\n";
        exit(1);
    }

} catch(PleskAPIParseException $e) {
    echo $e->getMessage() . "\n";
    exit(1);
}
