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
		$urlParsed = parsedUrl(require_get('url'));
		$pk = $db->fetchAll("SELECT pk_source FROM content_source WHERE regex = :urlParsed", [
			':urlParsed' => $urlParsed,
		])[0]["pk_source"];
		_json_ok($pk);
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

	case 'populateSelectTags':
		$query =
			"SELECT content_source.name as `source`,
			GROUP_CONCAT(DISTINCT content_tag.name) 
			AS tags FROM content_submission
		LEFT JOIN content_source 
			ON content_submission.fk_source_name = pk_source
		JOIN content_x_submission_tag 
			ON content_submission.pk_submission = content_x_submission_tag.fk_multimedia_format
		JOIN content_tag 
			ON content_x_submission_tag.fk_tag = pk_tag
		WHERE 
			content_source.pk_source = :source
		GROUP BY pk_source";
		$sth = $db->fetchAll($query, [
			':source' => require_get('source')
		])[0]['tags'];
		// var_dump($sth);
		_json_ok($sth);
		break;
}
