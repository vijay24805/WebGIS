<?php
// Connecting, selecting database
$dbconn = pg_connect("host=192.168.88.30 dbname=d817 user=ras14 password=sina")
    or die('Could not connect: ' . pg_last_error());

// Performing SQL query
$query = 'SELECT bin,count(*) FROM data311 group by bin order by bin ';

//$query = 'SELECT count(*) FROM data311 group by month order by month';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());


$rows = array();
$rows['name'] = '311 Complaints';
while($r = pg_fetch_assoc($result)) {
    $rows['data'][] = [($r['bin']*5+1)*1000*3600*24,$r['count']];

}

$query1 = 'SELECT count(*) FROM data311 WHERE key>1000000 and key<2000000 group by month order by month';

//$query1 = 'SELECT count(*) FROM data311 WHERE borough= 'BROOKLYN' group by month order by month ';
$result1 = pg_query($query1) or die('Query failed: ' . pg_last_error());

$rows1 = array();
$rows1['name'] = 'Manhattan';

while($rr = pg_fetch_assoc($result1)) {
    $rows1['data'][] = $rr['count'];
}


$query2 = 'SELECT count(*) FROM data311 WHERE key>2000000 and key<3000000 group by month order by month';
$query3 = 'SELECT count(*) FROM data311 WHERE key>3000000 and key<4000000 group by month order by month';
$query4 = 'SELECT count(*) FROM data311 WHERE key>4000000 and key<5000000 group by month order by month';
$query5 = 'SELECT count(*) FROM data311 WHERE key>5000000 group by month order by month';
$result2 = pg_query($query2) or die('Query failed: ' . pg_last_error());
$result3 = pg_query($query3) or die('Query failed: ' . pg_last_error());
$result4 = pg_query($query4) or die('Query failed: ' . pg_last_error());
$result5 = pg_query($query5) or die('Query failed: ' . pg_last_error());
$rows2 = array();
$rows3 = array();
$rows4 = array();
$rows5 = array();
$rows2['name'] = 'Bronx';
$rows3['name'] = 'Brooklyn';
$rows4['name'] = 'Queens';
$rows5['name'] = 'Staten Island';

while($rr = pg_fetch_assoc($result2)) {
    $rows2['data'][] = $rr['count'];
}
while($rr = pg_fetch_assoc($result3)) {
    $rows3['data'][] = $rr['count'];
}
while($rr = pg_fetch_assoc($result4)) {
    $rows4['data'][] = $rr['count'];
}
while($rr = pg_fetch_assoc($result5)) {
    $rows5['data'][] = $rr['count'];
}



$res = array();
array_push($res,$rows);
//array_push($res,$rows1);
//array_push($res,$rows2);
//array_push($res,$rows3);
//array_push($res,$rows4);
//array_push($res,$rows5);
print json_encode($res, JSON_NUMERIC_CHECK);



// Closing connection
pg_close($dbconn);
?>