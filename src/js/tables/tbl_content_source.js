(() => {

	let editor = new $.fn.dataTable.Editor({
		ajax: '/../Progetti/content_manager_better/dt/tbl_content_source.php',
		table: '#tbl_content_source',
		fields: [{ name: 'content_source.name', label: 'Name:', type: "textarea" }, { name: 'content_source.regex', label: 'Regex:', type: "textarea" },]
	});

	let table = $('#tbl_content_source').DataTable({
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
			url: '/../Progetti/content_manager_better/dt/tbl_content_source.php',
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
		columns: [{ data: 'content_source.name', orderable: true, searchable: true }, { data: 'content_source.regex', orderable: true, searchable: true },],
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
	tables['tbl_content_source'] = { table, editor };
})();