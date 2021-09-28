<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/lib/DataTables.php';

date_default_timezone_set('UTC');

use
	DataTables\Editor,
	DataTables\Editor\Field,
	DataTables\Editor\Format,
	DataTables\Editor\Mjoin,
	DataTables\Editor\Options,
	DataTables\Editor\Upload,
	DataTables\Editor\Validate,
	DataTables\Editor\ValidateOptions;

Editor::inst( $db, 'content_source', 'pk_source' )
	->fields(
			Field::inst( 'content_source.pk_source' )->setFormatter(Format::ifEmpty(null)),
			Field::inst( 'content_source.name' )->setFormatter(Format::ifEmpty(null)),
			Field::inst( 'content_source.regex' )->setFormatter(Format::ifEmpty(null)),
	)
	->process( $_POST )
	->json();

?>