tinyMCE.init({
    // selector
    selector: "textarea.tinymce",

	//theme of the editor
	theme: "modern",
	skin: "lightgray",
    
	//brand off
    branding: false,

	//width and height of the editor
	width: "100%",
	height: 400,
	
	//display statusbar
	statubar: true,

	//resize
	resize: false,

	/* plugin */
	plugins: [
		"advlist autolink link image lists charmap print preview hr anchor pagebreak",
		"searchreplace visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
		"save table contextmenu directionality emoticons template paste textcolor preview"
	],

	//toolbar
	toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | preview",

	//menu settings
	menu: {
    file: {title: 'File', items: 'newdocument'},
    edit: {title: 'Edit', items: 'undo redo | cut copy paste pastetext | selectall'},
    insert: {title: 'Insert', items: 'link media | template hr'},
    view: {title: 'View', items: 'visualaid'},
    format: {title: 'Format', items: 'bold italic underline strikethrough superscript subscript | formats | removeformat'},
    table: {title: 'Table', items: 'inserttable tableprops deletetable | cell row column'},
    tools: {title: 'Tools', items: 'spellchecker code'},
  }


 });


	
	