(function() {
	tinymce.PluginManager.add( 'tinymce_abbr_class', function( editor, url ) {
		// Add Button to Visual Editor Toolbar
		editor.addButton('tinymce_abbr_class', {
			title: 'Insert abbreviation',
			image: url + '/images/abbr-icon.png',
			cmd: 'tinymce_abbr_class',
		});		
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
			editor.execCommand('mceReplaceContent', false, '<abbr class="abbr" title="' + result + '">' + text + '</abbr>');

		});		
	});
})();