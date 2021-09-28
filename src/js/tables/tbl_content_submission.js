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
		}, {
			//approved
			text: "Approve",
			extend: "selectedSingle",
			className: "btn btn-success btn-lg btn-rounded ml-5",
			editor: editor,
			action: function (e, datat, node, config) {
				let ID = table.row({ selected: true }).data().content_submission.pk_submission;
				console.log(ID)
				ask("approveSubmission", {
					id: ID,
				}).then((response) => {
					if (response === true) {
						alert("submission approved");
					} else {
						alert("Impossibile to approve: " + response);
					}
					datat.ajax.reload(null, false);
				});
			},

		}, {
			//pending
			text: "Pending",
			extend: "selectedSingle",
			className: "btn btn-warning btn-lg btn-rounded",
			editor: editor,
			action: function (e, datat, node, config) {
				let ID = table.row({ selected: true }).data().content_submission.pk_submission;
				console.log(ID)
				ask("backToPending", {
					id: ID,
				}).then((response) => {
					if (response === true) {
						alert("submission back to pending");
					} else {
						alert("Impossibile pending: " + response);
					}
					datat.ajax.reload(null, false);
				});
			},

		}, {
			//rejected
			text: "Reject",
			extend: "selectedSingle",
			className: "btn btn-danger btn-lg btn-rounded",
			editor: editor,
			action: function (e, datat, node, config) {
				let ID = table.row({ selected: true }).data().content_submission.pk_submission;
				console.log(ID)
				ask("rejectSubmission", {
					id: ID,
				}).then((response) => {
					if (response === true) {
						alert("submission Rejected");
					} else {
						alert("Impossibile to Reject: " + response);
					}
					datat.ajax.reload(null, false);
				});
			},

		},]
	});
	tables['tbl_content_submission'] = { table, editor };
})();