<?php
/**---------------------------------------------------------------------------------------------------------------
 *
 * Template Manager (Handlebars)
 *
 * ---------------------------------------------------------------------------------------------------------------*/

define ('GD_TEMPLATE_CONTROLBUTTONGROUP_ADDPROJECT', PoP_ServerUtils::get_template_definition('customcontrolbuttongroup-addproject'));
define ('GD_TEMPLATE_CONTROLBUTTONGROUP_ADDSTORY', PoP_ServerUtils::get_template_definition('customcontrolbuttongroup-addstory'));
define ('GD_TEMPLATE_CONTROLBUTTONGROUP_ADDANNOUNCEMENT', PoP_ServerUtils::get_template_definition('customcontrolbuttongroup-addannouncement'));
define ('GD_TEMPLATE_CONTROLBUTTONGROUP_ADDDISCUSSION', PoP_ServerUtils::get_template_definition('customcontrolbuttongroup-adddiscussion'));

class SectionProcessors_Template_Processor_ControlButtonGroups extends GD_Template_Processor_ControlButtonGroupsBase {

	function get_templates_to_process() {
	
		return array(
			GD_TEMPLATE_CONTROLBUTTONGROUP_ADDPROJECT,
			GD_TEMPLATE_CONTROLBUTTONGROUP_ADDSTORY,
			GD_TEMPLATE_CONTROLBUTTONGROUP_ADDANNOUNCEMENT,
			GD_TEMPLATE_CONTROLBUTTONGROUP_ADDDISCUSSION,
		);
	}

	function get_modules($template_id) {

		$ret = parent::get_modules($template_id);
	
		switch ($template_id) {
		
			case GD_TEMPLATE_CONTROLBUTTONGROUP_ADDPROJECT:

				$ret[] = GD_TEMPLATE_CUSTOMANCHORCONTROL_ADDPROJECT;
				$ret[] = GD_TEMPLATE_CUSTOMANCHORCONTROL_ADDPROJECTLINK;
				break;
		
			case GD_TEMPLATE_CONTROLBUTTONGROUP_ADDSTORY:

				$ret[] = GD_TEMPLATE_CUSTOMANCHORCONTROL_ADDSTORY;
				$ret[] = GD_TEMPLATE_CUSTOMANCHORCONTROL_ADDSTORYLINK;
				break;
		
			case GD_TEMPLATE_CONTROLBUTTONGROUP_ADDANNOUNCEMENT:

				$ret[] = GD_TEMPLATE_CUSTOMANCHORCONTROL_ADDANNOUNCEMENT;
				$ret[] = GD_TEMPLATE_CUSTOMANCHORCONTROL_ADDANNOUNCEMENTLINK;
				break;
		
			case GD_TEMPLATE_CONTROLBUTTONGROUP_ADDDISCUSSION:

				$ret[] = GD_TEMPLATE_CUSTOMANCHORCONTROL_ADDDISCUSSION;
				$ret[] = GD_TEMPLATE_CUSTOMANCHORCONTROL_ADDDISCUSSIONLINK;
				break;
		}
		
		return $ret;
	}
}

/**---------------------------------------------------------------------------------------------------------------
 * Initialization
 * ---------------------------------------------------------------------------------------------------------------*/
new SectionProcessors_Template_Processor_ControlButtonGroups();