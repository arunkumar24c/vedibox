<?php
$CONF['host'] = 'localhost';
$CONF['user'] = 'root';
$CONF['pass'] = '';
$CONF['name'] = 'liveerp_datamigration';

$db = new mysqli($CONF['host'], $CONF['user'], $CONF['pass'], $CONF['name']);

if ($db->connect_errno) {
    echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
}
$db->set_charset("utf8mb4");

$sql = mysqli_query($db, "SELECT * FROM ps_product_master");
while($sqlfetch = mysqli_fetch_array($sql))
{
	$data = explode(",",$sqlfetch['product_code']);
	
	if($data[0] != '')
	{
		$insert = mysqli_query($db,"UPDATE  ps_product_master
		SET
			product_category = '".$data[1]."',
			product_name = '".$data[2]."',
			product_code = '".$data[0]."'
		WHERE
			product_id = '".$sqlfetch['product_id']."'
		
		");
	}
	
}
