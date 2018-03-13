(function() {
    tinymce.PluginManager.add( 'wpcloudshell_class', function( editor, url ) {
        // Add Button to Visual Editor Toolbar
        editor.addButton('wpcloudshell_class', {
            title: 'Insert Azure Cloud Shell Link',
            cmd: 'wpcloudshell_class',
            image: url + '/icon.png',

        }); 
        editor.addCommand('wpcloudshell_class', function() {
            //editor.execCommand('mceInsertContent', false, '<image src="https://shell.azure.com/images/launchcloudshell.png" />');
            editor.insertContent('<a style="cursor:pointer" onclick=\'javascript:window.open("https://shell.azure.com", "_blank", "toolbar=no,scrollbars=yes,resizable=yes,menubar=no,location=no,status=no")\'><img src="https://shell.azure.com/images/launchcloudshell.png" /></a>');
     
        });

        
    });
})();


