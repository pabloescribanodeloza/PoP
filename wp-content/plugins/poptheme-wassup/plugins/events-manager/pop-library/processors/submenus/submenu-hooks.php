<?php

/**---------------------------------------------------------------------------------------------------------------
 *
 * PageSection Hooks
 *
 * ---------------------------------------------------------------------------------------------------------------*/

class Wassup_EM_SubmenuHooks {

	function __construct() {

		add_filter(
			'GD_Template_Processor_CustomSubMenus:author:blockgroupitems', 
			array($this, 'singleauthorsubmenu_blockunits'),
			10,
			2
		);
	}

	function singleauthorsubmenu_blockunits($blockunits, $current_blockgroup) {

		// Events
		$event_subheaders = array(
			GD_TEMPLATE_BLOCKGROUP_TABPANEL_AUTHOREVENTSCALENDAR,
			GD_TEMPLATE_BLOCKGROUP_TABPANEL_AUTHORPASTEVENTS,
		);
		$blockunits[GD_TEMPLATE_BLOCKGROUP_TABPANEL_AUTHOREVENTS] = array_merge(
			array(
				GD_TEMPLATE_BLOCKGROUP_TABPANEL_AUTHOREVENTS,
			),
			$event_subheaders
		);
		if (in_array($current_blockgroup, $event_subheaders)) {

			$blockunits[$current_blockgroup] = array();
		}
		
		return $blockunits;
	}
}

/**---------------------------------------------------------------------------------------------------------------
 * Initialization
 * ---------------------------------------------------------------------------------------------------------------*/
new Wassup_EM_SubmenuHooks();
