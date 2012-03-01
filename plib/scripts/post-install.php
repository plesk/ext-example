<?php

$request = <<<APICALL
<ui>
   <create-custombutton>
         <owner>
            <admin/>
         </owner>
      <properties>
         <internal>true</internal>
         <place>navigation</place>
         <url>/modules/example</url>
         <text>Example Module</text>
      </properties>
   </create-custombutton>
</ui>
APICALL;

try {
    $response = pm_ApiRpc::getService()->call($request);

    $result = $response->ui->{"create-custombutton"}->result;
    if ('ok' == $result->status) {
        pm_Bootstrap::init();
        pm_Bootstrap::getDbAdapter()->insert('misc', array('param' => 'moduleExampleCustomButton', 'val' => $result->id));
        echo "done\n";
        exit(0);
    } else {
        echo "error $result->errcode: $result->errtext\n";
        exit(1);
    }

}catch(PleskAPIParseException $e){
    echo $e->getMessage() . "\n";
    exit(1);
}
