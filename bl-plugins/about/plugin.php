<?php

class pluginAbout extends Plugin {

	public function init()
	{
		$this->dbFields = array(
			'label'=>'About',
			'text'=>''
		);
	}

	public function form()
	{
		global $language;

		$html  = '<div class="alert alert-primary" role="alert">';
		$html .= $this->description();
		$html .= '</div>';

		$html .= '<div>';
		$html .= '<label>'.$language->get('Label').'</label>';
		$html .= '<input name="label" type="text" value="'.$this->getValue('label').'">';
		$html .= '<span class="tip">'.$language->get('This title is almost always used in the sidebar of the site').'</span>';
		$html .= '</div>';

		$html .= '<div>';
		$html .= '<label>'.$language->get('About').'</label>';
		$html .= '<textarea name="text" id="jstext">'.$this->getValue('text').'</textarea>';
		$html .= '</div>';

		return $html;
	}

	public function siteSidebar()
	{
		$html  = '<div class="plugin plugin-about">';
		$html .= '<h2 class="plugin-label">'.$this->getValue('label').'</h2>';
		$html .= '<div class="plugin-content">';
		$html .= html_entity_decode(nl2br($this->getValue('text')));
 		$html .= '</div>';
 		$html .= '</div>';

		return $html;
	}
}