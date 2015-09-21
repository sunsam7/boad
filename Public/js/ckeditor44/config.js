/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */
CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
    config.image_previewText = ' ';

	config.toolbar = 'MyToolbar';  
  
    config.toolbar_MyToolbar =  
    [    
        //['Cut','Copy','Paste','PasteText','PasteFromWord','-','Scayt'],  
        ['Source','-','Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],  
        ['Image','Table','HorizontalRule','Smiley','SpecialChar'],  
        '/', 
        [ 'Format','Font','FontSize' ],
        [ 'TextColor','BGColor' ],
        ['Bold','Italic','Strike'],
        //['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
        ['Link','Unlink'],
        //['Maximize','-','About']  
    ];


};
