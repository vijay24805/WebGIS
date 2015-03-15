<?php

if (!extension_loaded("MapScript")) dl("php_mapscript.so");

$request = ms_newowsrequestobj();


foreach ($_GET as $k=>$v) {
     $request->setParameter($k, $v);

}



$idd=$_GET['aoiID'];
$request->setParameter("VeRsIoN","1.0.0");
ms_ioinstallstdouttobuffer();
$oMap = ms_newMapobj("home/vij14/public_html/p1/maps/template.map");
$new_layer =ms_newlayerobj($oMap);
$new_layer->set("type", MS_LAYER_POLYGON);
$new_layer->set("dump", 1);
$new_layer->set("status", 1);
$new_layer->set("name","N1");
$new_class = ms_newClassObj($new_layer);
$new_style = ms_newStyleObj($new_class);
$new_style-> color->setRGB(200, 200, 255);
$new_style-> outlinecolor->setRGB(32, 32, 32);
$new_layer->setConnectionType(MS_POSTGIS);
$new_layer->set("connection","user=ras14 password=sina dbname=d817 host=192.168.88.30");


$data1="the_geom2 from (select gid,st_buffer(the_geom,";
$data2=") as the_geom2 from hw) as foo using unique gid using srid=2263";
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
