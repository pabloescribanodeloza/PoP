<?php
/**---------------------------------------------------------------------------------------------------------------
 *
 * Template Manager (Handlebars)
 *
 * ---------------------------------------------------------------------------------------------------------------*/

define ('GD_TEMPLATE_CONTROLBUTTONGROUP_EVENTLINKS', PoP_ServerUtils::get_template_definition('customcontrolbuttongroup-eventlinks'));
define ('GD_TEMPLATE_CONTROLBUTTONGROUP_MYEVENTLINKS', PoP_ServerUtils::get_template_definition('customcontrolbuttongroup-myeventlinks'));
define ('GD_TEMPLATE_CONTROLBUTTONGROUP_ADDEVENT', PoP_ServerUtils::get_template_definition('customcontrolbuttongroup-addevent'));

define ('GD_TEMPLATE_CONTROLBUTTONGROUP_TOGGLEMAP', PoP_ServerUtils::get_template_definition('controlbuttongroup-togglemap'));

class GD_EM_Template_Processor_CustomControlButtonGroups extends GD_Template_Processor_ControlButtonGroupsBase {

	function get_templates_to_process() {
	
		return array(
			GD_TEMPLATE_CONTROLBUTTONGROUP_EVENTLINKS,
			GD_TEMPLATE_CONTROLBUTTONGROUP_MYEVENTLINKS,
			GD_TEMPLATE_CONTROLBUTTONGROUP_ADDEVENT,
			GD_TEMPLATE_CONTROLBUTTONGROUP_TOGGLEMAP,
		);
	}

	function get_modules($template_id) {

		$ret = parent::get_modules($template_id);
	
		switch ($template_id) {
		
			case GD_TEMPLATE_CONTROLBUTTONGROUP_EVENTLINKS:

				// $ret[] = GD_TEMPLATE_CUSTOMANCHORCONTROL_CALENDAR;
				$ret[] = GD_TEMPLATE_CUSTOMANCHORCONTROL_PASTEVENTS;
				break;
		
			case GD_TEMPLATE_CONTROLBUTTONGROUP_ADDEVENT:

				$ret[] = GD_TEMPLATE_CUSTOMANCHORCONTROL_ADDEVENT;
				$ret[] = GD_TEMPLATE_CUSTOMANCHORCONTROL_ADDEVENTLINK;
				break;

			case GD_TEMPLATE_CONTROLBUTTONGROUP_MYEVENTLINKS:

				$ret[] = GD_TEMPLATE_CUSTOMANCHORCONTROL_MYPASTEVENTS;
				break;

			case GD_TEMPLATE_CONTROLBUTTONGROUP_TOGGLEMAP:

				$ret[] = GD_TEMPLATE_ANCHORCONTROL_TOGGLEMAP;
				break;
		}
		
		return $ret;
	}
}

/**---------------------------------------------------------------------------------------------------------------
 * Initialization
 * ---------------------------------------------------------------------------------------------------------------*/
new GD_EM_Template_Processor_CustomControlButtonGroups();