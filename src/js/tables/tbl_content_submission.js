(() => {

	let editor = new $.fn.dataTable.Editor({
		ajax: '/../Progetti/content_manager_better/dt/tbl_content_submission.php',
		table: '#tbl_content_submission',
		fields: [{ name: 'content_submission.url', label: 'Url:', type: "textarea" }, { name: 'content_submission.email', label: 'Email:', type: "textarea" }, { name: 'content_submission.state', label: 'State:', type: "select", options: [{ label: "", value: "" }, { label: "Approved", value: "Approved" }, { label: "Pending", value: "Pending" }, { label: "Rejected", value: "Rejected" }] }, { name: 'content_submission.ip', label: 'Ip:', type: "textarea" }, { name: 'content_submission.date', label: 'Date:', type: "datetime", default: "current_timestamp()" }, { name: 'content_submission.multimedia_format', label: 'Multimedia format:', type: "select", options: [{ label: "", value: "" }, { label: "audio", value: "audio" }, { label: "video", value: "video" }, { label: "immagine", value: "immagine" }, { label: "testo", value: "testo" }] }, { name: 'content_submission.fk_source_name', label: 'content_source (name):', type: "select" }, { name: 'content_tag[].pk_tag', label: 'content_tag (name):', type: 'checkbox', className: 'checkEditorGroup', },]
	});

	let table = $('#tbl_content_submission').DataTable({
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
			url: '/../Progetti/content_manager_better/dt/tbl_content_submission.php',
		},
		lengthMenu: [
			[5, 10, 25, 50, 75, 100, 200, 500, -1],
			[5, 10, 25, 50, 75, 100, 200, 500, 'All']
		],
		pageLength: 50,
		dom: 'B<"customB btn-group flex-wrap d-inline-block">rftlip',
		language: {
			lengthMenu: 'Mostra _MENU_',
			zeroRecords: 'Nessun record',
			info: 'pag. _PAGE_ / _PAGES_',
			infoEmpty: 'Nessun record disponibile',
			infoFiltered: '(_TOTAL_ record)'
		},
		order: [],
		columns: [{ data: 'content_submission.url', orderable: true, searchable: true }, { data: 'content_submission.email', orderable: true, searchable: true }, { data: 'content_submission.state', orderable: true, searchable: true }, { data: 'content_submission.ip', orderable: true, searchable: true }, { data: 'content_submission.date', orderable: true, searchable: true }, { data: 'content_submission.multimedia_format', orderable: true, searchable: true }, { data: 'content_source.name', orderable: true, searchable: true }, { data: 'content_tag', render: '[, ].name', orderable: true, searchable: true },],
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
	tables['tbl_content_submission'] = { table, editor };

	$("div.customB").html('<div class="btn-group ml-3" role="group"  aria-label="Status Buttons">'
		+ '<button type="button" class="btn btn-primary">Accept</button>'
		+ '<button type="button" class="btn btn-warning">Pending</button>'
		+ '<button type="button" class="btn btn-danger">Reject</button>'
		+ '</div>');
})();

const approved = () => {
	let ID = tables.tbl_content_submission.table.row({ selected: true }).data().content_submission.pk_submission;
	console.log(ID)
	ask("approveSubmission", {
		id: ID,
	}).then((response) => {
		if (response === true) {
			alert("submission approved");
		} else {
			alert("Impossibile to approve: " + response);
		}
		tables.tbl_content_submission.table.ajax.reload(null, false);
	});
};

const pending = () => {
	let ID = tables.tbl_content_submission.table.row({ selected: true }).data().content_submission.pk_submission;
	console.log(ID)
	ask("rejectSubmission", {
		id: ID,
	}).then((response) => {
		if (response === true) {
			alert("submission Rejected");
		} else {
			alert("Impossibile to Reject: " + response);
		}
		tables.tbl_content_submission.table.ajax.reload(null, false);
	});
}

const rejected = () => {
	let ID = tables.tbl_content_submission.table.row({ selected: true }).data().content_submission.pk_submission;
	console.log(ID)
	ask("rejectSubmission", {
		id: ID,
	}).then((response) => {
		if (response === true) {
			alert("submission Rejected");
		} else {
			alert("Impossibile to Reject: " + response);
		}
		tables.tbl_content_submission.table.ajax.reload(null, false);
	});

}