<?php

class pluginStaticPages extends Plugin {

	public function init()
	{
		// Fields and default values for the database of this plugin
		$this->dbFields = array(
			'label'=>'Static Pages',
			'homeLink'=>true
		);
	}

	// Method called on the settings of the plugin on the admin area
	public function form()
	{
		global $language;

		$html  = '<div class="alert alert-primary" role="alert">';
		$html .= $this->description();
		$html .= '</div>';

		$html .= '<div>';
		$html .= '<label>'.$language->get('Label').'</label>';
		$html .= '<input id="jslabel" name="label" type="text" value="'.$this->getValue('label').'">';
		$html .= '<span class="tip">'.$language->get('This title is almost always used in the sidebar of the site').'</span>';
		$html .= '</div>';

		$html .= '<div>';
		$html .= '<label>'.$language->get('Home link').'</label>';
		$html .= '<select name="homeLink">';
		$html .= '<option value="true" '.($this->getValue('homeLink')===true?'selected':'').'>'.$language->get('Enabled').'</option>';
		$html .= '<option value="false" '.($this->getValue('homeLink')===false?'selected':'').'>'.$language->get('Disabled').'</option>';
		$html .= '</select>';
		$html .= '<span class="tip">'.$language->get('show-the-home-link-on-the-sidebar').'</span>';
		$html .= '</div>';

		return $html;
	}

	// Method called on the sidebar of the website
	public function siteSidebar()
	{
		global $language;
		global $url;
		global $site;
		global $pages;

		// HTML for sidebar
		$html  = '<div class="plugin plugin-static-pages">';

		// Print the label if not empty
		$label = $this->getValue('label');
		if (!empty($label)) {
			$html .= '<h2 class="plugin-label">'.$label.'</h2>';
		}

		$html .= '<div class="plugin-content">';
		$html .= '<ul>';

		// Show Home page link
		if ($this->getValue('homeLink')) {
			$html .= '<li>';
			$html .= '<a href="' . $site->url() . '">' . $language->get('Home page') . '</a>';
			$html .= '</li>';
		}

		// Show static pages
		$staticPages = buildStaticPages();
		foreach ($staticPages as $page) {
			$html .= '<li>';
			$html .= '<a href="' . $page->permalink() . '">' . $page->title() . '</a>';
			$html .= '</li>';
		}

		$html .= '</ul>';
 		$html .= '</div>';
 		$html .= '</div>';

		return $html;
	}
}