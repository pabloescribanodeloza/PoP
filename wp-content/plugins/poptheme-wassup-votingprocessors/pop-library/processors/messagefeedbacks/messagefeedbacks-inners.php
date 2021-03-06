<?php
/**---------------------------------------------------------------------------------------------------------------
 *
 * Template Manager (Handlebars)
 *
 * ---------------------------------------------------------------------------------------------------------------*/

define ('GD_TEMPLATE_MESSAGEFEEDBACKINNER_OPINIONATEDVOTES', PoP_ServerUtils::get_template_definition('messagefeedbackinner-opinionatedvotes'));
define ('GD_TEMPLATE_MESSAGEFEEDBACKINNER_MYOPINIONATEDVOTES', PoP_ServerUtils::get_template_definition('messagefeedbackinner-myopinionatedvotes'));

class VotingProcessors_Template_Processor_CustomListMessageFeedbackInners extends GD_Template_Processor_MessageFeedbackInnersBase {

	function get_templates_to_process() {
	
		return array(
			GD_TEMPLATE_MESSAGEFEEDBACKINNER_OPINIONATEDVOTES,
			GD_TEMPLATE_MESSAGEFEEDBACKINNER_MYOPINIONATEDVOTES,
		);
	}

	function get_layouts($template_id) {

		$ret = parent::get_layouts($template_id);

		$layouts = array(
			GD_TEMPLATE_MESSAGEFEEDBACKINNER_OPINIONATEDVOTES => GD_TEMPLATE_LAYOUT_MESSAGEFEEDBACKFRAME_OPINIONATEDVOTES,
			GD_TEMPLATE_MESSAGEFEEDBACKINNER_MYOPINIONATEDVOTES => GD_TEMPLATE_LAYOUT_MESSAGEFEEDBACKFRAME_MYOPINIONATEDVOTES,
		);

		if ($layout = $layouts[$template_id]) {

			$ret[] = $layout;
		}

		return $ret;
	}
}


/**---------------------------------------------------------------------------------------------------------------
 * Initialization
 * ---------------------------------------------------------------------------------------------------------------*/
new VotingProcessors_Template_Processor_CustomListMessageFeedbackInners();