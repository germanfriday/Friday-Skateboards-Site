<?php

if (!class_exists('cfct_module_audio_slider')) {
	class cfct_module_audio_slider extends cfct_build_module {
		
		/**
		 * Set up the module
		 */
		public function __construct() {
			$opts = array(
				'description' => __('Add the audio player and featured image slider to the page (single column only).', 'carrington-build'),
				'icon' => 'audio-slider/icon.png'
			);
			
			// use if this module is to have no user configurable options
			// Will suppress the module edit button in the admin module display
			# $this->editable = false 
			
			parent::__construct('cfct-audio-slider', __('Garage Band Audio Slider', 'carrington-build'), $opts);
		}

		/**
		 * Display the module content in the Post-Content
		 * 
		 * @param array $data - saved module data
		 * @return array string HTML
		 */
		public function display($data) {
			$h_tag = $this->h_tag($data);
			$title = esc_html($data[$this->get_field_id('content')]);
			return $this->load_view($data, compact('h_tag', 'title'));
		}

		/**
		 * Build the admin form
		 * 
		 * @param array $data - saved module data
		 * @return string HTML
		 */
		public function admin_form($data) {
			$tags = $this->h_tags();
			$output = '
<div>
	<p>This module does not have any additional options.</p>
</div>
			';
			return $output;
		}
		
		/**
		 * Default value of h2 if no tag has been selected
		 *
		 * @param array $data - saved module data
		 * @return string text
		 */
		private function h_tag($data = array()) {
			return (!empty($data[$this->get_field_id('h_tag')]) ? $data[$this->get_field_id('h_tag')] : 'h2');
		}
		
		/**
		 * Filter and return list of available tags
		 *
		 * @return array
		 */
		private function h_tags() {
		}

		/**
		 * Return a textual representation of this module.
		 *
		 * @param array $data - saved module data
		 * @return string text
		 */
		public function text($data) {
			return strip_tags($data[$this->get_field_id('content')]);
		}

		/**
		 * Modify the data before it is saved, or not
		 *
		 * @param array $new_data 
		 * @param array $old_data 
		 * @return array
		 */
		public function update($new_data, $old_data) {
			if (isset($new_data[$this->get_field_id('h_tag')]) && !in_array($new_data[$this->get_field_id('h_tag')], array_keys($this->h_tags()))) {
				$new_data[$this->get_field_id('h_tag')] = $this->h_tag();
			}
			return $new_data;
		}
		
		/**
		 * Add custom javascript to the post/page admin
		 * OPTIONAL: omit this method if you're not using it
		 *
		 * @return string JavaScript
		 */
		public function admin_js() {
			return '';
		}
		
		/**
		 * Add custom css to the post/page admin
		 * OPTIONAL: omit this method if you're not using it
		 *
		 * @return string CSS
		 */
		public function admin_css() {
			return '';
		}
	}
	// register the module with Carrington Build
	cfct_build_register_module('cfct-audio-slider', 'cfct_module_audio_slider');
}
?>