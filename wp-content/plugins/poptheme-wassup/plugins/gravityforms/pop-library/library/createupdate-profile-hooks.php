<?php
/**---------------------------------------------------------------------------------------------------------------
 *
 * Data Load Library
 *
 * ---------------------------------------------------------------------------------------------------------------*/

class GD_GF_CreateUpdate_Profile_Hooks {

	function __construct() {

		add_filter('gd_createupdate_profile:form_data', array($this, 'get_form_data'), 10, 2);
		add_filter('gd_template:createprofile:components', array($this, 'get_components'), 10, 3);
		add_action('gd_createupdate_profile:additionals_create', array($this, 'additionals'), 10, 3);
	}

	function get_form_data($form_data, $atts) {

		global $gd_template_processor_manager;

		$form_data['newsletter'] = $gd_template_processor_manager->get_processor(GD_GF_TEMPLATE_FORMCOMPONENT_CUP_NEWSLETTER)->get_value(GD_GF_TEMPLATE_FORMCOMPONENT_CUP_NEWSLETTER, $atts);
		
		return $form_data;
	}

	function get_components($components, $template_id, $processor) {

		// switch ($template_id) {

		// 	case GD_TEMPLATE_FORMINNER_PROFILEORGANIZATION_CREATE:
		// 	case GD_TEMPLATE_FORMINNER_PROFILEINDIVIDUAL_CREATE:

		// Add before the Captcha
		$extra_components = array(
			GD_GF_TEMPLATE_FORMCOMPONENTGROUP_CUP_NEWSLETTER,
		);
		array_splice($components, array_search(GD_TEMPLATE_FORMCOMPONENTGROUP_CAPTCHA, $components), 0, $extra_components);
		
		// 		break;
		// }
		
		return $components;
	}

	function additionals($user_id, $form_data, $extras) {

		$subscribe = $form_data['newsletter'];
		if ($subscribe) {

			// Trigger the form sending
			$form_id = GD_Template_Helper_GFForm::get_newsletter_form_id();
			$fieldnames = GD_Template_Helper_GFForm::get_newsletter_form_field_names();

			$form_values = array(
				$fieldnames['email'] => $form_data['user_email'],
				$fieldnames['name'] => $extras['display_name'],
			);

			// Taken from http://www.gravityhelp.com/documentation/gravity-forms/extending-gravity-forms/api/api-functions/#submit_form
			GFAPI::submit_form($form_id, $form_values);
		}
	}
}

/**---------------------------------------------------------------------------------------------------------------
 * Initialize
 * ---------------------------------------------------------------------------------------------------------------*/
new GD_GF_CreateUpdate_Profile_Hooks();