/**
 * @license Copyright (c) 2003-2020, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

 CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	config.language = 'en';
	config.uiColor = '#D7D8D7';
	config.height = 500;
	config.removePlugins = 'elementspath';
	config.resize_enabled = false;
        config.shiftEnterMode = CKEDITOR.ENTER_BR;
	config.enterMode = CKEDITOR.ENTER_BR;
	
	config.toolbarGroups = [
		{ name: 'forms', groups: [ 'forms' ] },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'others', groups: [ 'others' ] }
	];
	
	config.removeButtons = 'Print,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Scayt,SelectAll,Superscript,Subscript,Language,Styles,Format,BidiLtr,BidiRtl,PasteText,PasteFromWord,CreateDiv,Blockquote,Preview,Outdent,Indent,Anchor,Flash,HorizontalRule,Smiley,SpecialChar,PageBreak';
};