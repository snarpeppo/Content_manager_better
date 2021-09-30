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

Editor::inst($db, 'content_x_submission_tag', ['fk_submission', 'fk_tag'])
	->fields(
		Field::inst('content_x_submission_tag.fk_submission')
			->validator(Validate::required())
			->options(
				Options::inst()
					->table('content_submission')
					->value('pk_submission')
					->label('url')
			)->setFormatter(Format::ifEmpty(null)),
		Field::inst('content_submission.url')->setFormatter(Format::ifEmpty(null)),
		Field::inst('content_x_submission_tag.fk_tag')
			->validator(Validate::required())
			->options(
				Options::inst()
					->table('content_tag')
					->value('pk_tag')
					->label('name')
			)->setFormatter(Format::ifEmpty(null)),
		Field::inst('content_tag.name')->setFormatter(Format::ifEmpty(null)),
	)
	->leftJoin('content_submission', 'content_submission.pk_submission', '=', 'content_x_submission_tag.fk_submission')
	->leftJoin('content_tag', 'content_tag.pk_tag', '=', 'content_x_submission_tag.fk_tag')
	->process($_POST)
	->json();
