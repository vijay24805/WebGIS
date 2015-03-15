<?php

$request = ms_newowsrequestobj();

foreach ($_GET as $k=>$v) {
     $request->setParameter($k, $v);
}

ms_ioinstallstdouttobuffer();
$oMap = ms_newMapobj("/home/vij14/public_html/p1/maps/template.map");

$new_layer =ms_newlayerobj($oMap);
$new_layer->set("type", MS_LAYER_POLYGON);
$new_layer->set("dump", 1);
$new_layer->set("status", 1);
$new_layer->set("name","nypp");
$new_layer->set("template","infotemplate.html");
$new_layer->setMetaData("wms_name","nypp");
$new_layer->setMetaData("wms_extent","913154.843600 120114.582600 1067382.510900 272932.046000");
$new_layer->setMetaData("gml_include_items","all");
$new_layer->setMetaData("gml_featureid","precinct");
$new_layer->setMetaData("wms_feature_info_mime_type","text/html");
$new_class = ms_newClassObj($new_layer);
$new_style = ms_newStyleObj($new_class);
$new_style-> outlinecolor->setRGB(255, 0, 0);

$new_layer->setConnectionType(MS_POSTGIS);
$new_layer->set("connection","user=vij14 password=kumar dbname=d813 host=192.168.88.30");
$data="geom from (select * from nypp order by precinct) as foo using unique precinct using SRID=2263";
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
