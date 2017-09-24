<?php

	$a = '';
	$con = pg_connect("dbname=ctower user=postgres password=postgres");

	$sys_ctower_version = "2018.05a";
	
	if ($_POST['cmd'] == 'get_server_info_div') {
		$a = $a . '<div style="position: absolute; top: 0px; left: 0%; right: 0%; width: 100%; height: 30px; background: #F4F4F4;"><label style="position: absolute; top: 6px; left: 7px; font-family: \'Roboto Condensed\'; font-size: 12px; font-weight: 300; color: black;">ControlTower Server Information</label></div>';
		$a = $a . '<label style="position: absolute; top: 35px; left: 7px; font-family: \'Roboto Condensed\'; font-size: 12px; font-weight: 300; color: gray;">Server Name/IP</label>';
		$a = $a . '<label style="position: absolute; top: 50px; left: 7px; font-family: \'Roboto Condensed\'; font-size: 12px; font-weight: 300; color: black;">' . gethostname() . '</label>';
		$a = $a . '<label style="position: absolute; top: 65px; left: 7px; font-family: \'Roboto Condensed\'; font-size: 12px; font-weight: 300; color: black;">' . $_SERVER['SERVER_ADDR'] . '</label>';
		$a = $a . '<table cellpadding="0" cellspacing="0" border="0" style="position: absolute; top: 90px; left: 4%; right: 4%; width: 92%;">';
		$a = $a . '<tr style="height: 28px;">';
		$a = $a . '<td style="width: 50%; font-family: \'Roboto Condensed\'; font-size: 12px; color: gray;">Total Jobs</td>';
		$a = $a . '<td style="width: 50%; font-family: \'Roboto Condensed\'; font-size: 12px; color: gray;">Failed Jobs</td>';
		$a = $a . '</tr>';
		$a = $a . '<tr style="height: 30px;">';
		$rs = pg_query($con,"select (select count(*) from jobs),(select count(*) from jobs where lower(last_outcome) = 'failed');");
		$row = pg_fetch_row($rs);
		$a = $a . '<td style="width: 50%; font-family: \'Roboto Condensed\'; font-size: 24px; color: black;">&nbsp;' . $row[0] . '</td>';
		$a = $a . '<td style="width: 50%; font-family: \'Roboto Condensed\'; font-size: 24px; color: black;">&nbsp;' . $row[1] . '</td>';
		pg_free_result($rs);
		$a = $a . '</tr>';
		$a = $a . '</table>';
		$a = $a . '';
	}
	
	if ($_POST['cmd'] == 'get_jobs_list') {
		$a = $a . '<table cellpadding="0" cellspacing="0" border="0" style="position: absolute; top: 0px; left: 0%; right: 0%; width: 100%; font-family: \'Roboto Condensed\';">';
		$a = $a . '<tr style="height: 26px;">';
		$a = $a . '<td style="width: 10%; font-size: 12px; color: gray; padding-left: 4px; border-bottom: 1px solid #F4F4F4; border-right: 1px solid #F4F4F4;">JOB ID</td>';
		$a = $a . '<td style="width: 20%; font-size: 12px; color: gray; padding-left: 4px; border-bottom: 1px solid #F4F4F4; border-right: 1px solid #F4F4F4;">JOB NAME</td>';
		$a = $a . '<td style="width: 20%; font-size: 12px; color: gray; padding-left: 4px; border-bottom: 1px solid #F4F4F4; border-right: 1px solid #F4F4F4;">JOB COMMAND</td>';
		$a = $a . '<td style="width: 10%; font-size: 12px; color: gray; padding-left: 4px; border-bottom: 1px solid #F4F4F4; border-right: 1px solid #F4F4F4;">ENABLED</td>';
		$a = $a . '<td style="width: 10%; font-size: 12px; color: gray; padding-left: 4px; border-bottom: 1px solid #F4F4F4; border-right: 1px solid #F4F4F4;">JOB STATE</td>';
		$a = $a . '<td style="width: 15%; font-size: 12px; color: gray; padding-left: 4px; border-bottom: 1px solid #F4F4F4; border-right: 1px solid #F4F4F4;">LAST RUNTIME</td>';
		$a = $a . '<td style="width: 10%; font-size: 12px; color: gray; padding-left: 4px; border-bottom: 1px solid #F4F4F4;">LAST OUTCOME</td>';
		$a = $a . '</tr>';
		$rs = pg_query($con,"select job_id,job_name,job_command,job_enabled::int,is_idle::int,case when last_runtime is null then 'Never Executed' else to_char(last_runtime,'YYYY-MM-DD HH24:MI') end,lower(last_outcome) from jobs order by job_id;");
		while ($row = pg_fetch_row($rs)) {
			$chk = $row[6];
			$tr_class = '';
			if (($chk == "none") or ($chk == "success")) {
				$tr_class = 'rowStandard';
			}
			if ($chk == "failed") {
				// $tr_class = 'rowError';
				$tr_class = 'rowStandard';
			}
			$a = $a . '<tr id="job_' . $row[0] . '" class="' . $tr_class . '" style="height: 26px;" oncontextmenu="setContextData(\'' . $row[0] . '\');" contextmenu="jobrowmenu">';
			$a = $a . '<td style="width: 10%; font-size: 12px; color: black; padding-left: 4px; border-bottom: 1px solid #F4F4F4; border-right: 1px solid #F4F4F4;">' . $row[0] . '</td>';
			$a = $a . '<td style="width: 20%; font-size: 12px; color: black; padding-left: 4px; border-bottom: 1px solid #F4F4F4; border-right: 1px solid #F4F4F4;">' . $row[1] . '</td>';
			$a = $a . '<td style="width: 20%; font-size: 12px; color: black; padding-left: 4px; border-bottom: 1px solid #F4F4F4; border-right: 1px solid #F4F4F4;">' . $row[2] . '</td>';
			if ((int)$row[3] == 1) {
				$a = $a . '<td style="width: 10%; font-size: 12px; color: black; padding-left: 4px; border-bottom: 1px solid #F4F4F4; border-right: 1px solid #F4F4F4;">Yes</td>';
			} else {
				$a = $a . '<td style="width: 10%; font-size: 12px; color: black; padding-left: 4px; border-bottom: 1px solid #F4F4F4; border-right: 1px solid #F4F4F4;">No</td>';
			}
			if ((int)$row[4] == 1) {
				$a = $a . '<td style="width: 10%; font-size: 12px; color: black; padding-left: 4px; border-bottom: 1px solid #F4F4F4; border-right: 1px solid #F4F4F4;">Idle</td>';
			} else {
				$a = $a . '<td style="width: 10%; font-size: 12px; color: black; padding-left: 4px; border-bottom: 1px solid #F4F4F4; border-right: 1px solid #F4F4F4;">Running</td>';
			}
			$a = $a . '<td style="width: 15%; font-size: 12px; color: black; padding-left: 4px; border-bottom: 1px solid #F4F4F4; border-right: 1px solid #F4F4F4;">' . $row[5] . '</td>';
			if ($chk == "failed") {
				$a = $a . '<td style="width: 10%; font-size: 12px; color: black; padding-left: 4px; border-bottom: 1px solid #F4F4F4;"><img src="16error.gif" style="border: none; float: left; opacity: 0.7;"/>&nbsp;&nbsp;Failed</td>';
			}
			if ($chk == "none") {
				$a = $a . '<td style="width: 10%; font-size: 12px; color: black; padding-left: 4px; border-bottom: 1px solid #F4F4F4;"><img src="16ok.png" style="border: none; float: left; opacity: 0.7;"/>&nbsp;&nbsp;No Outcome</td>';
			}
			if ($chk == "success") {
				$a = $a . '<td style="width: 10%; font-size: 12px; color: black; padding-left: 4px; border-bottom: 1px solid #F4F4F4;"><img src="16ok.png" style="border: none; float: left; opacity: 0.7;"/>&nbsp;&nbsp;Succeeded</td>';
			}
			$a = $a . '</tr>';
		}
		pg_free_result($rs);
		$a = $a . '</table>';
		$a = $a . '';
	}
	
	if ($_POST['cmd'] == 'request_job_exec') {
		if ($_POST['jobid'] != "") {
			$rs = pg_query($con,"select count(*) from run_requests where job_id = " . $_POST['jobid'] . " and is_waiting = 1::bit;");
			$row = pg_fetch_row($rs);
			$chk = (int)$row[0];
			pg_free_result($rs);
			if ($chk == 0) {
				pg_query($con,"insert into run_requests (job_id,is_waiting) values (" . $_POST['jobid'] . ",1::bit);");
			}
		}
	}
	
	pg_close($con);
	echo $a;
	
?>