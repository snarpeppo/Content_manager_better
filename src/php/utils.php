<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

function post($k)
{
	return (isset($_POST[$k]) && !empty($_POST[$k])) ? $_POST[$k] : null;
}
function get($k)
{
	return (isset($_GET[$k]) && !empty($_GET[$k])) ? $_GET[$k] : null;
}

function require_get($v)
{
	return isset($_GET[$v]) && !empty($_GET[$v]) ? $_GET[$v] : die(DEBUG ? $v . ' require' : 'e no!');
}

function require_post($v)
{
	return isset($_POST[$v]) && !empty($_POST[$v]) ? $_POST[$v] : die(DEBUG ? $v . ' require' : 'e no!');
}

function _json_ok($data = "")
{
	global $time_start;
	$jsonOpt = JSON_UNESCAPED_SLASHES + (DEBUG ? JSON_PRETTY_PRINT : 0);
	header('Content-type: application/json; charset=utf-8');
	die(json_encode([
		'error' => false,
		'response' => $data,
		'msec' => microtime(true) - $time_start
	], $jsonOpt));
}

function _json_error($err)
{
	global $time_start;
	$jsonOpt = JSON_UNESCAPED_SLASHES + JSON_NUMERIC_CHECK + (DEBUG ? JSON_PRETTY_PRINT : 0);
	header('Content-type: application/json; charset=utf-8');
	die(json_encode([
		'error' => $err,
		'msec' => microtime(true) - $time_start
	], $jsonOpt));
}

function parsedUrl($v)
{
	return parse_url($v, PHP_URL_HOST);
}
