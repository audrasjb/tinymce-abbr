(function() {
	tinymce.PluginManager.add( 'tinymce_abbr_class', function( editor, url ) {
		// Add Button to Visual Editor Toolbar
		editor.addButton('tinymce_abbr_class', {
			title: 'Insert abbreviation',
			image: url + '/images/abbr-icon.png',
			cmd: 'tinymce_abbr_modal',
		});		

		// Called when we click the Insert abbreviation button
		editor.addCommand( 'tinymce_abbr_modal', function() {
			// Initialize abbrTitle var
			var abbrTitle = '';
			// Check we have selected some text that we want to link
			var text = editor.selection.getContent({
				'format': 'html'
			});
			if ( text.length === 0 ) {
				alert( 'Please select some text first.' );
				return;
			}
			// Calls the pop-up modal
			editor.windowManager.open({
				// Modal settings
				title: 'Insert abbreviation',
				id: 'tinymce-abbr-insert-dialog',
				buttons: [
					{
                   		type   : 'textbox',
						id: 'tinymce-abbr-textbox',
				   		name   : 'abbrTitle',
				   		label  : 'Title',
				   		tooltip: 'The meaning of your abbreviation',
               		},
               		{
						text: 'Ok',
						id: 'tinymce-abbr-button-insert',
						class: 'insert',
						onclick: function(e) {
							var text = editor.selection.getContent({
								'format': 'html'
							});
							editor.execCommand('mceReplaceContent', false, '<abbr class="abbr" title="' + jQuery('#tinymce-abbr-textbox').val() + '">' + text + '</a>');
							editor.windowManager.close();
						},
					},
				],
			});
		});
	});
})();