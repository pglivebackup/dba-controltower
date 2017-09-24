var interval_left;
var interval_jobs;
var selected_job = '';

$(document).ready(function() {
	refreshServerInformation();
	refreshJobsInformation();
	interval_left = setInterval(function() {
		refreshServerInformation();
	},5000);
	interval_jobs = setInterval(function() {
		refreshJobsInformation();
	},5000);
});

function refreshServerInformation() {
	$.post("bk.php",{cmd: 'get_server_info_div'},function(data) {
		document.getElementById('mainleft').innerHTML = data;
	});
	return false;
}

function refreshJobsInformation() {
	$.post("bk.php",{cmd: 'get_jobs_list'},function(data) {
		document.getElementById('mainjobs').innerHTML = data;
	});
	return false;
}

function setContextData(jobid) {
	selected_job = jobid;
	return false;
}

function onContextDeleteJob() {
	alert(selected_job);
	return false;
}

function requestJobExecution() {
	if (selected_job != '') {
		$.post("bk.php",{cmd: 'request_job_exec', jobid: selected_job});
	}
	return false;
}