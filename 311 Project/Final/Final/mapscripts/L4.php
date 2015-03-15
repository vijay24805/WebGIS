<?php

if (!extension_loaded("MapScript")) dl("php_mapscript.so");

$request = ms_newowsrequestobj();


foreach ($_GET as $k=>$v) {
     $request->setParameter($k, $v);

}


$idd=$_GET['date'];
$edate=$_GET['edate'];
$dt = '23';
$request->setParameter("VeRsIoN","1.0.0");
ms_ioinstallstdouttobuffer();
$oMap = ms_newMapobj("home/vij14/public_html/p1/maps/template.map");
$new_layer =ms_newlayerobj($oMap);
$new_layer->set("type", MS_LAYER_POINT);
$new_layer->set("dump", 1);
$new_layer->set("status", 1);
$new_layer->set("name","ny12");
$new_class = ms_newClassObj($new_layer);
$new_style = ms_newStyleObj($new_class);
$new_style-> color->setRGB(20, 20, 200);
$new_layer->setConnectionType(MS_POSTGIS);
$new_layer->set("connection","user=paw14 password=amruta dbname=d816 host=192.168.88.30");
$new_style->set("symbolname", "circle");
$new_style->set("size", 5);

$data1="geom from (select * from data311 where date>'";
$data2="' and date<'";
$data3="') as foo using unique uniquekey using srid=2263";
$data=$data1.$idd.$data2.$edate.$data3;
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
