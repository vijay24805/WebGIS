<?php

if (!extension_loaded("MapScript")) dl("php_mapscript.so");

$request = ms_newowsrequestobj();


foreach ($_GET as $k=>$v) {
     $request->setParameter($k, $v);

}

$quer1=DIS;
$quer2=4;
$quer3=$quer1.$quer2;

$idd=$_GET['aoiID'];
$request->setParameter("VeRsIoN","1.0.0");
ms_ioinstallstdouttobuffer();
$oMap = ms_newMapobj("/home/kas14/public_html/p1/maps/template.map");
$new_layer =ms_newlayerobj($oMap);
$new_layer->set("type", MS_LAYER_POLYGON);
$new_layer->set("dump", 1);
$new_layer->set("status", 1);
$new_layer->set("name",N1);
$new_class = ms_newClassObj($new_layer);
$new_style = ms_newStyleObj($new_class);
$new_style-> outlinecolor->setRGB(255-5, 0+100/40, 0+2+50/2);
$new_layer->setConnectionType(MS_POSTGIS);
$new_layer->set("connection","user=ras14 password=sina dbname=d817 host=192.168.88.30");


$data1="the_geom from (select * from cd where gid in (select gid from cd where borocd/100=";
$data2=")) as foo using unique gid using srid=2263";
$data=$data1.$idd.$data2;

$new_layer->set("data",$data) ;




$oMap->owsdispatch($request);
$contenttype = ms_iostripstdoutbuffercontenttype();
if ($contenttype == 'image/png')
{
   header('Content-type: image/png');
   ms_iogetStdoutBufferBytes();
}
else
{
	$buffer = ms_iogetstdoutbufferstring();
	echo $buffer;
}
ms_ioresethandlers();


?>
