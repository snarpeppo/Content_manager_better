<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../../config.php';
require_once  'utils.php';
require_once 'db_connection.php';

$action = require_get('action');
$db = new db_connection();
switch ($action) {
	case 'parseUrlForSource':
		$url = require_get('url');
		$urlParsed = parsedUrl($url);
		$query = "SELECT Name FROM content_source WHERE regex = :urlParsed";
		$name = $db->fetchAll($query, [
			':urlParsed' => $urlParsed,
		])[0]["Name"];
		_json_ok($name);
		break;

	case 'approveSubmission':
		$approve = "UPDATE content_submission SET State = 'Approved' WHERE pk_submission = :id";
		$sth = $db->UpdateOrDelete($approve, [
			':id' => require_get('id')
		]);
		_json_ok($sth);
		break;

	case 'rejectSubmission':
		$reject = "UPDATE content_submission SET State ='Rejected' WHERE pk_submission = :id";
		$sth = $db->UpdateOrDelete($reject, [
			':id' => require_get('id')
		]);
		_json_ok($sth);
		break;

	case 'backToPending':
		$query = "UPDATE content_submission SET State = 'Pending' WHERE pk_submission = :id";
		$sth = $db->UpdateOrDelete($query, [
			':id' => require_get('id')
		]);
		_json_ok($sth);
		break;
}
