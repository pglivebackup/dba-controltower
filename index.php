<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <title>CTower Admin</title>
    <script src="jquery-3.2.1.min.js"></script>
    <script src="ctower.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700" rel="stylesheet">
	<style>
		.rowStandard {
			background: transparent;
		}
		.rowStandard td {
			font-weight: 300;
		}
		.rowStandard:hover {
			background: #F4F4F4;
		}
		.rowError {
			background: red;
		}
	</style>
</head>
<body>
	<input id="hdn_selected_server_id" type="hidden" value="">
	<input id="hdn_current_screen" type="hidden" value="">
    <!-- <div style="position: absolute; top: 0px; left: 0px; right: 0px; width: 100%; height: 40px; background: #003056;"> -->
    <div style="position: absolute; top: 0px; left: 0px; right: 0px; width: 100%; height: 40px; border-bottom: 1px solid #F1F1F1;">
    <!-- <img src="496.png" style="position: absolute; top: 5px; left: 8px; width: 30px; height: 30px; border: none;"/> -->
    <img src="p3031.png" style="position: absolute; top: 5px; left: 8px; border: none;"/>
	<label style="position: absolute; top: 7px; left: 45px; font-family: 'Roboto Condensed'; font-size: 20px; font-weight: 700; color: black;">DBA ControlTower&nbsp;&nbsp;<font style="font-weight: 300;">Management Portal</font></label>
    </div>
	<div id="main" style="position: absolute; top: 40px; left: 0px; right: 0px; width: 100%; height: calc(100% - 40px);">
		<div id="mainleft" style="position: absolute; top: 10px; left: 10px; width: 190px; height: 165px; border: 1px solid #F1F1F1;"></div>
		<div style="position: absolute; top: 10px; left: 220px; width: calc(100% - 230px); height: calc(100% - 20px); border: 1px solid #F1F1F1;"> <!--  overflow-x: hidden; overflow-y: auto; -->
			<div style="position: absolute; top: 0px; left: 0%; right: 0%; width: 100%; height: 30px; background: #F4F4F4;"><label style="position: absolute; top: 6px; left: 7px; font-family: 'Roboto Condensed'; font-size: 12px; font-weight: 300; color: black;">Live Jobs Information</label></div>
			<div id="mainjobs" style="position: absolute; top: 35px; left: 5px; right: 5px; width: calc(100% - 10px); height: calc(100% - 40px); overflow-x: hidden; overflow-y: auto;"></div>
		</div>
	</div>
	<menu type="context" id="jobrowmenu">
		<menuitem label="Execute Now" icon="mnu01.gif" onclick="requestJobExecution();"></menuitem>
		<menuitem label="Disable Job"></menuitem>
		<menuitem label="Enable Job"></menuitem>
		<menuitem label="Edit Job" icon="mnu03.gif"></menuitem>
		<menuitem label="Delete Job" onclick="onContextDeleteJob();" icon="mnu02.gif"></menuitem>
	</menu>
</body>
</html>

