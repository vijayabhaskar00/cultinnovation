<?php
// error_log(json_encode(getallheaders()) . $_SERVER['REMOTE_ADDR'] );
if(isset($_GET['top10'])) {
	
	$ch = fopen("trips.csv", "r");
	fgetcsv($ch);
	$data = array();
	$rank = 0;
	while (($row = fgetcsv($ch)) !== FALSE && (++ $rank) <= 10) {
		$record = array();
	    	$record['code'] = $row[0];
	    	$record['trips'] = $row[1];
	    	$record['cash'] = $row[2];
	    	$record['digital'] = $row[3];
	    	$record['points'] = $row[4];
	    	$record['rank'] = $rank;
		$data[] = $record;
	}
	fclose($ch);
	$result = array();
	$res['data']= $data;
	$res['result'] = $rank <= 1 ? 0 : 1;
	$res['last_updated'] = date ("F d Y", filemtime("trips.csv"));
	echo json_encode($res);
	exit();
}
elseif(isset($_GET['code'])) {
	if(preg_match("/^[Tt][Uu][Cc][hH]\d\d\d\d$/", $_GET['code'])) {
		$ch = fopen("trips.csv", "r");
		$header_row = fgetcsv($ch);
		$rowno = 0;
		$res = array();
		while(($row = fgetcsv($ch)) !== FALSE) {
			$rowno++;
		    if( $row[0] == strtoupper($_GET['code'])) {
		    	$res['result'] = 1;
		    	$res['code'] = $row[0];
		    	$res['trips'] = $row[1];
		    	$res['cash'] = $row[2];
		    	$res['digital'] = $row[3];
		    	$res['points'] = $row[4];
		    	$res['rank'] = $rowno;
			$res['last_updated'] = date ("F d Y", filemtime("trips.csv"));
		    	echo json_encode($res);
		    	fclose($ch);
		    	exit();
		    }
		}
		fclose($ch);
		$res['result'] = -1;
		$res['last_updated'] = date ("F d Y", filemtime("trips.csv"));
		
		    	echo json_encode($res);
		exit();
	}
	else {
		$res['result'] = 0;
		$res['last_updated'] = date ("F d Y", filemtime("trips.csv"));
		
		    	echo json_encode($res);exit();
	}
}
else {
$res['result'] = -2;
$res['last_updated'] = date ("F d Y", filemtime("trips.csv"));
echo json_encode($res);
}
?>