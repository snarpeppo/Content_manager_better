(() => {

	let editor = new $.fn.dataTable.Editor({
		ajax: '/../Progetti/content_manager_better/dt/tbl_content_tag.php',
		table: '#tbl_content_tag',
		fields: [{ name: 'content_tag.name', label: 'Name:', type: "textarea" }, { name: 'content_submission[].pk_submission', label: 'content_submission (url):', type: 'checkbox', className: 'checkEditorGroup', },]
	});

	let table = $('#tbl_content_tag').DataTable({
		serverSide: true,
		processing: true,
		responsive: true,
		select: true,
		lengthChange: true,
		search: {
			caseInsensitive: true
		},
		scrollResize: true,
		ajax: {
			type: 'POST',
			url: '/../Progetti/content_manager_better/dt/tbl_content_tag.php',
		},
		lengthMenu: [
			[5, 10, 25, 50, 75, 100, 200, 500, -1],
			[5, 10, 25, 50, 75, 100, 200, 500, 'All']
		],
		pageLength: 50,
		dom: 'Brftlip',
		language: {
			lengthMenu: 'Mostra _MENU_',
			zeroRecords: 'Nessun record',
			info: 'pag. _PAGE_ / _PAGES_',
			infoEmpty: 'Nessun record disponibile',
			infoFiltered: '(_TOTAL_ record)'
		},
		order: [],
		dom: 'Brftlip',
		columns: [{ data: 'content_tag.name', orderable: true, searchable: true }, { data: 'content_submission', render: '[, ].url', orderable: true, searchable: true },],
		buttons: [{
			extend: 'create',
			editor: editor,
			text: 'Crea',
			formTitle: '<h3>Crea</h3>'
		}, {
			extend: 'edit',
			editor: editor,
			text: 'Modifica',
			formTitle: '<h3>Modifica</h3>'
		}, {
			extend: 'remove',
			editor: editor,
			text: 'Cancella',
			formTitle: '<h3>Cancella</h3>'
		}, {
			extend: 'collection',
			text: 'Esporta',
			buttons: ['copy', 'excel', 'csv', 'pdf', 'print']
		}]
	});
	tables['tbl_content_tag'] = { table, editor };
})();