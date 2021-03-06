<?php
/**---------------------------------------------------------------------------------------------------------------
 *
 * Template Manager (Handlebars)
 *
 * ---------------------------------------------------------------------------------------------------------------*/

define ('GD_TEMPLATE_LAYOUT_MESSAGEFEEDBACKFRAME_USER_CHANGEPASSWORD', PoP_ServerUtils::get_template_definition('layout-messagefeedbackframe-user-changepassword'));

class GD_Template_Processor_UserMessageFeedbackFrameLayouts extends GD_Template_Processor_MessageFeedbackFrameLayoutsBase {

	function get_templates_to_process() {
	
		return array(
			GD_TEMPLATE_LAYOUT_MESSAGEFEEDBACKFRAME_USER_CHANGEPASSWORD,
			// GD_TEMPLATE_LAYOUT_MESSAGEFEEDBACKFRAME_USERAVATAR_UPDATE,
		);
	}

	function get_layout($template_id) {

		$layouts = array(
			GD_TEMPLATE_LAYOUT_MESSAGEFEEDBACKFRAME_USER_CHANGEPASSWORD => GD_TEMPLATE_LAYOUT_MESSAGEFEEDBACK_USER_CHANGEPASSWORD,
			// GD_TEMPLATE_LAYOUT_MESSAGEFEEDBACKFRAME_USERAVATAR_UPDATE => GD_TEMPLATE_LAYOUT_MESSAGEFEEDBACK_USERAVATAR_UPDATE,
		);

		if ($layout = $layouts[$template_id]) {

			return $layout;
		}

		return parent::get_layout($template_id);
	}
}


/**---------------------------------------------------------------------------------------------------------------
 * Initialization
 * ---------------------------------------------------------------------------------------------------------------*/
new GD_Template_Processor_UserMessageFeedbackFrameLayouts();