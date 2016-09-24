(function() {
	tinymce.PluginManager.add( 'tinymce_abbr_class', function( editor, url ) {
		// Add Button to Visual Editor Toolbar
		editor.addButton('tinymce_abbr_class', {
			title: 'Insert abbreviation',
			image: url + '/images/abbr-icon.png',
			cmd: 'tinymce_abbr_modal',
		});		

		// Called when we click the Insert Gistpen button
		editor.addCommand( 'tinymce_abbr_modal', function() {
			// Check we have selected some text that we want to link
			var text = editor.selection.getContent({
				'format': 'html'
			});
			if ( text.length === 0 ) {
				alert( 'Please select some text first.' );
				return;
			}
			// Calls the pop-up modal
			editor.windowManager.open(
				{
					// Modal settings
					title: 'Insert abbreviation',
//					file:  url + '/tinymce-abbr-dialog.html',
					id: 'tinymce-abbr-insert-dialog',
					buttons: 
					[
						{
                   			type   : 'textbox',
				   			name   : 'abbrTitle',
				   			label  : 'Title',
				   			tooltip: 'The meaning of your abbreviation',
               			},
               			{
							text: 'Insert',
							id: 'tinymce-abbr-button-insert',
							class: 'insert',
							onclick: function( editor, url ) {
								tinymce_abbr_insertion(abbrTitle);
							},
						},
					],
                },
                {
                	editor: editor,                   //    This is a reference to the current editor. We'll need this to insert the shortcode we create.
				}				
			);

		});

	});

	function tinymce_abbr_insertion(abbrTitle) {
		var title = abbrTitle;
		editor.execCommand('mceReplaceContent', false, '<abbr class="abbr" title="' + title + '">' + text + '</a>');
	}

})();
/*
		// Add Command when Button Clicked
		editor.addCommand('tinymce_abbr_class', function() {
			// Check we have selected some text that we want to link
			var text = editor.selection.getContent({
				'format': 'html'
			});
			if ( text.length === 0 ) {
				alert( 'Please select some text first.' );
				return;
			}

			// Ask the user to enter a URL
			var result = prompt('Enter title');
			if ( !result ) {
				// User cancelled - exit
				return;
			}
			if (result.length === 0) {
				// User didn't enter a URL - exit
				return;
			}	

			// Insert selected text back into editor, wrapping it in an anchor tag
			editor.execCommand('mceReplaceContent', false, '<abbr class="abbr" title="' + result + '">' + text + '</a>');

		});		
	});
})();*/