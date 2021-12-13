/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	  //config.language = 'fr';
	  // Toolbar groups configuration.
config.toolbarGroups = [
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'tools' },
		{ name: 'others' }
	];

	  //config.uiColor = '#3c8dbc';
	  config.filebrowserImageUploadUrl ='http://localhost/fintechjobs/demo/plugins/ckeditor_4.4.5_full/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
	  config.filebrowserUploadUrl =  'http://localhost/fintechjobs/demo/plugins/ckeditor_4.4.5_full/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
	  config.filebrowserFlashUploadUrl = 'http://localhost/fintechjobs/demo/plugins/ckeditor_4.4.5_full/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
	 
};
