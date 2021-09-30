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

Editor::inst( $db, 'content_tag', 'pk_tag' )
	->fields(
			Field::inst( 'content_tag.pk_tag' )->setFormatter(Format::ifEmpty(null)),
			Field::inst( 'content_tag.name' )->setFormatter(Format::ifEmpty(null)),
	)
		->join(
			Mjoin::inst('content_submission')
			->link( 'content_tag.pk_tag', 'content_x_submission_tag.fk_tag' )
			->link( 'content_submission.pk_submission', 'content_x_submission_tag.fk_submission' )
			->fields(
				Field::inst( 'pk_submission' )
					->validator( Validate::required() )
					->options( Options::inst()
						->table( 'content_submission' )
						->value( 'pk_submission' )
						->label( 'url' )
					),
				Field::inst( 'url' )->set(false),
			)
		)
	->process( $_POST )
	->json();
