/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	  //config.language = 'fr';
	  // Toolbar groups configuration.
	  
config.toolbar = [
	
	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
	{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
	{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
	{ name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'SpecialChar', 'PageBreak','Iframe','MediaEmbed'] },
	{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
	{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
	{ name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
	{ name: 'others', items: [ '-' ] },
	{ name: 'about', items: [ 'About' ] }
];
	  //config.uiColor = '#3c8dbc';
	   config.filebrowserImageUploadUrl ='http://development.eweblabs.in/fintechjobsindia/plugins/ckeditor_4.4.5_full/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
	  config.filebrowserUploadUrl =  'http://development.eweblabs.in/fintechjobsindia/plugins/ckeditor_4.4.5_full/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
	  config.filebrowserFlashUploadUrl = 'http://development.eweblabs.in/fintechjobsindia/plugins/ckeditor_4.4.5_full/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
	 
};
