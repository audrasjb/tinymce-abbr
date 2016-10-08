/* no need !
(function() {
	tinymce.PluginManager.add( 'tinymce_abbr_delete_class', function( editor, url ) {
		// Add Button to Visual Editor Toolbar
		editor.addButton('tinymce_abbr_delete_class', {
			title: 'Delete abbreviation',
			image: url + '/images/abbr-delete-icon.png',
			cmd: 'tinymce_abbr_delete',
		});		

		// Called when we click the Delete abbreviation button
		editor.addCommand( 'tinymce_abbr_delete', function() {
			// Check we have selected some text that we want to link
			var text = editor.selection.getContent({
				'format': 'html'
			});
			if ( text.length === 0 ) {
				alert( 'Please select some text first.' );
				return;
			} else {
				// Get node element
				var node = editor.selection.getNode();
				// Remove ABBR node element (and not other potential nodes!)
				if (node.nodeName == 'ABBR') {
					var txt = editor.selection.getContent();
					var newTxt = document.createTextNode(txt);
					node.parentNode.replaceChild(newTxt, node);
				}
			}
		});
	});
})();
*/