<?php

class pluginTinymce extends Plugin {

	private $loadOnController = array(
		'new-content',
		'edit-content'
	);

	public function init()
	{
		$this->dbFields = array(
			'toolbar1'=>'formatselect bold italic bullist numlist blockquote alignleft aligncenter alignright link pagebreak image removeformat code',
			'toolbar2'=>'',
			'plugins'=>'code autolink image link pagebreak advlist lists textcolor colorpicker textpattern'
		);
	}

	public function form()
	{
		global $language;

		$html  = '<div>';
		$html .= '<label>'.$language->get('Toolbar top').'</label>';
		$html .= '<input name="toolbar1" id="jstoolbar1" type="text" value="'.$this->getValue('toolbar1').'">';
		$html .= '</div>';

		$html .= '<div>';
		$html .= '<label>'.$language->get('Toolbar bottom').'</label>';
		$html .= '<input name="toolbar2" id="jstoolbar2" type="text" value="'.$this->getValue('toolbar2').'">';
		$html .= '</div>';

		$html .= '<div>';
		$html .= '<label>'.$language->get('Plugins').'</label>';
		$html .= '<input name="plugins" id="jsplugins" type="text" value="'.$this->getValue('plugins').'">';
		$html .= '</div>';

		return $html;
	}

	public function adminHead()
	{
		if (!in_array($GLOBALS['ADMIN_CONTROLLER'], $this->loadOnController)) {
			return false;
		}

		return '<script src="'.$this->htmlPath().'tinymce/tinymce.min.js"></script>';
	}

	public function adminBodyEnd()
	{
		if (!in_array($GLOBALS['ADMIN_CONTROLLER'], $this->loadOnController)) {
			return false;
		}

		global $language;

		$toolbar1 = $this->getValue('toolbar1');
		$toolbar2 = $this->getValue('toolbar2');
		$plugins = $this->getValue('plugins');

		$lang = 'en';
		if (file_exists($this->phpPath().'tinymce'.DS.'langs'.DS.$language->currentLanguage().'.js')) {
			$lang = $language->currentLanguage();
		} elseif (file_exists($this->phpPath().'tinymce'.DS.'langs'.DS.$language->currentLanguageShortVersion().'.js')) {
			$lang = $language->currentLanguageShortVersion();
		}

$script = <<<EOF
<script>

// Function required for Media Manager
// Insert an image on the editor in the cursor position
function editorInsertMedia(filename) {
	tinymce.activeEditor.insertContent("<img src=\""+filename+"\" alt=\"\">");
}

// Function required for Autosave function
// Returns the content of the editor
function editorGetContent() {
	return tinymce.get('jseditor').getContent();
}

$("#jseditor").show();

tinymce.init({
	selector: "#jseditor",
	theme: "modern",
	skin: "bludit",
	min_height: 500,
	max_height: 1000,
	element_format : "html",
	entity_encoding : "raw",
	schema: "html5",
	statusbar: false,
	menubar:false,
	remove_script_host: false,
	branding: false,
	browser_spellcheck: true,
	pagebreak_separator: PAGE_BREAK,
	paste_as_text: true,
	relative_urls: true,
	remove_script_host: false,
	document_base_url: DOMAIN_UPLOADS,
	plugins: ["$plugins"],
	toolbar1: "$toolbar1",
	toolbar2: "$toolbar2",
	language: "$lang"
});

</script>
EOF;
		return $script;
	}
}