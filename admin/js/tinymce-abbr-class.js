(function() {
	tinymce.PluginManager.add( 'tinymce_abbr_class', function( editor, url ) {
		// Add Button to Visual Editor Toolbar
		editor.addButton('tinymce_abbr_class', {
			title: 'Insert abbreviation',
			image: url + '/images/abbr-icon.png',
			id: 'mce-wp-abbr',
			cmd: 'tinymce_abbr_modal'
		});		

		// Get current editor selection and toggle class on abbr tinymce button
		editor.on('NodeChange', function(e){
			var node = editor.selection.getNode();
			if (node.nodeName == 'ABBR') {
				jQuery('#mce-wp-abbr').addClass('mce-active');
			} else {
				jQuery('#mce-wp-abbr').removeClass('mce-active');
			}
		});

		// Called when we click the Insert abbreviation button
		editor.addCommand( 'tinymce_abbr_modal', function() {
		   	// class = mce-active
		   	// aria-pressed = true
			jQuery('#mce-wp-abbr').toggleClass('mce-active');
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
			// Calls the pop-up modal dialog
			editor.windowManager.open({
				// Modal settings
				title: 'Insert abbreviation',
				id: 'tinymce-abbr-insert-dialog',
				body: [
					{
                   		type   : 'textbox',
						id: 'tinymce-abbr-title',
				   		name   : 'abbrTitle',
				   		label  : 'Title',
				   		tooltip: 'The meaning of your abbreviation',
               		},
					{
                   		type   : 'textbox',
						id: 'tinymce-abbr-lang',
				   		name   : 'abbrLang',
				   		label  : 'Language (optional)',
				   		tooltip: 'Example: fr, en, de, etc. Use it only if the abbreviation’s language is different from page main language',
               		},
			   	],
			   	onsubmit: function(e) {
					var text = editor.selection.getContent({
						'format': 'html'
					});
					editor.execCommand('mceReplaceContent', false, '<abbr class="abbr" title="' + jQuery('#tinymce-abbr-title').val() + '" lang="' + jQuery('#tinymce-abbr-lang').val() + '">' + text + '</abbr>');
					editor.windowManager.close();
				}
			});
		});
	});
})();