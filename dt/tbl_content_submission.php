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

Editor::inst($db, 'content_submission', 'pk_submission')
	->fields(
		Field::inst('content_submission.pk_submission')->setFormatter(Format::ifEmpty(null)),
		Field::inst('content_submission.url')->setFormatter(Format::ifEmpty(null)),
		Field::inst('content_submission.email')->setFormatter(Format::ifEmpty(null)),
		Field::inst('content_submission.state')->setFormatter(Format::ifEmpty(null)),
		Field::inst('content_submission.ip')->setFormatter(Format::ifEmpty(null)),
		Field::inst('content_submission.date')->setFormatter(Format::ifEmpty(null)),
		Field::inst('content_submission.multimedia_format')->setFormatter(Format::ifEmpty(null)),
		Field::inst('content_submission.fk_source_name')
			->validator(Validate::required())
			->options(
				Options::inst()
					->table('content_source')
					->value('pk_source')
					->label('name')
			)->setFormatter(Format::ifEmpty(null)),
		Field::inst('content_source.name')->setFormatter(Format::ifEmpty(null)),
	)
	->leftJoin('content_source', 'content_source.pk_source', '=', 'content_submission.fk_source_name')
	->join(
		Mjoin::inst('content_tag')
			->link('content_submission.pk_submission', 'content_x_submission_tag.fk_submission')
			->link('content_tag.pk_tag', 'content_x_submission_tag.fk_tag')
			->fields(
				Field::inst('pk_tag')
					->validator(Validate::required())
					->options(
						Options::inst()
							->table('content_tag')
							->value('pk_tag')
							->label('name')
					),
				Field::inst('name')->set(false),
			)
	)
	->process($_POST)
	->json();
