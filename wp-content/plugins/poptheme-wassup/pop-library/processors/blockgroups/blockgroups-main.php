<?php
/**---------------------------------------------------------------------------------------------------------------
 *
 * Template Manager (Handlebars)
 *
 * ---------------------------------------------------------------------------------------------------------------*/

define ('GD_TEMPLATE_BLOCKGROUP_HOME', PoP_ServerUtils::get_template_definition('blockgroup-home'));
define ('GD_TEMPLATE_BLOCKGROUP_404', PoP_ServerUtils::get_template_definition('blockgroup-404'));
define ('GD_TEMPLATE_BLOCKGROUP_BACKGROUNDMENU', PoP_ServerUtils::get_template_definition('blockgroup-backgroundmenu'));
define ('GD_TEMPLATE_BLOCKGROUP_SINGLEPOST', PoP_ServerUtils::get_template_definition('blockgroup-singlepost'));
define ('GD_TEMPLATE_BLOCKGROUP_AUTHOR', PoP_ServerUtils::get_template_definition('blockgroup-author'));
define ('GD_TEMPLATE_BLOCKGROUP_AUTHORDESCRIPTION', PoP_ServerUtils::get_template_definition('blockgroup-authordescription'));
define ('GD_TEMPLATE_BLOCKGROUP_AUTHORSUMMARY', PoP_ServerUtils::get_template_definition('blockgroup-authorsummary'));

class GD_Template_Processor_MainBlockGroups extends GD_Template_Processor_ListBlockGroupsBase {

	function get_templates_to_process() {
	
		return array(
			GD_TEMPLATE_BLOCKGROUP_HOME,
			GD_TEMPLATE_BLOCKGROUP_404,
			GD_TEMPLATE_BLOCKGROUP_BACKGROUNDMENU,
			GD_TEMPLATE_BLOCKGROUP_SINGLEPOST,
			GD_TEMPLATE_BLOCKGROUP_AUTHOR,
			GD_TEMPLATE_BLOCKGROUP_AUTHORDESCRIPTION,
			GD_TEMPLATE_BLOCKGROUP_AUTHORSUMMARY,
		);
	}

	protected function get_controlgroup_bottom($template_id) {

		// Do not add for the quickview, since it is a modal and can't open a new modal (eg: Embed) on top
		$vars = GD_TemplateManager_Utils::get_vars();
		if (!$vars['fetching-json-quickview']) {

			switch ($template_id) {

				case GD_TEMPLATE_BLOCKGROUP_SINGLEPOST:

					global $post;
					if (get_post_status($post->ID) == 'publish')  {

						// Comment Leo 09/11/2015: No need to add this information for the Upvote/Downvote, it's too much
						// HIGHLIGHTS go in top since they have no submenu
						$cat = gd_get_the_main_category();
						$skip = apply_filters('GD_Template_Processor_MainBlockGroups:get_controlgroup_bottom:skip_categories', array());
						if (!in_array($cat, $skip)) {

							return GD_TEMPLATE_CONTROLGROUP_SHARE;
						}
					}
					break;

				case GD_TEMPLATE_BLOCKGROUP_AUTHOR:
				case GD_TEMPLATE_BLOCKGROUP_AUTHORDESCRIPTION:

					return GD_TEMPLATE_CONTROLGROUP_SHARE;
			}
		}

		return parent::get_controlgroup_bottom($template_id);
	}

	protected function get_blocksections_classes($template_id) {

		$ret = parent::get_blocksections_classes($template_id);

		switch ($template_id) {

			case GD_TEMPLATE_BLOCKGROUP_404:
			case GD_TEMPLATE_BLOCKGROUP_BACKGROUNDMENU:

				$ret['blocksection-extensions'] = 'row';
				break;

			case GD_TEMPLATE_BLOCKGROUP_SINGLEPOST:
			case GD_TEMPLATE_BLOCKGROUP_AUTHORDESCRIPTION:
			case GD_TEMPLATE_BLOCKGROUP_AUTHORSUMMARY:

				// Make the background white, with the #6acada border
				$ret['blocksection-extensions'] = 'row row-item';
				break;
		}

		return $ret;
	}

	function init_atts($template_id, &$atts) {

		switch ($template_id) {

			case GD_TEMPLATE_BLOCKGROUP_SINGLEPOST:
			case GD_TEMPLATE_BLOCKGROUP_AUTHOR:
			case GD_TEMPLATE_BLOCKGROUP_AUTHORDESCRIPTION:
			case GD_TEMPLATE_BLOCKGROUP_AUTHORSUMMARY:

				$blocktarget = $this->get_activeblock_selector($template_id, $atts);
				if ($controlgroup_top = $this->get_controlgroup_top($template_id)) {		
					$this->add_att($controlgroup_top, $atts, 'block-target', $blocktarget);
				}
				if ($controlgroup_bottom = $this->get_controlgroup_bottom($template_id)) {		
					$this->add_att($controlgroup_bottom, $atts, 'block-target', $blocktarget);
				}
				break;
		}

		switch ($template_id) {

			case GD_TEMPLATE_BLOCKGROUP_HOME:

				$this->append_att($template_id, $atts, 'class', 'blockgroup-home');
				break;

			case GD_TEMPLATE_BLOCKGROUP_AUTHOR:

				$this->append_att($template_id, $atts, 'class', 'blockgroup-author');
				break;

			case GD_TEMPLATE_BLOCKGROUP_SINGLEPOST:

				$this->append_att($template_id, $atts, 'class', 'blockgroup-singlepost');
				break;

			case GD_TEMPLATE_BLOCKGROUP_AUTHORDESCRIPTION:

				$this->append_att($template_id, $atts, 'class', 'blockgroup-author-description');
				break;
		}
		
		return parent::init_atts($template_id, $atts);
	}

	function get_submenu($template_id) {

		// Do not add for the quickview
		$vars = GD_TemplateManager_Utils::get_vars();
		if (!$vars['fetching-json-quickview']) {

			switch ($template_id) {

				case GD_TEMPLATE_BLOCKGROUP_SINGLEPOST:
				
					if ($submenu = GD_Template_Processor_CustomSectionBlocksUtils::get_single_submenu()) {
						return $submenu;
					}
					break;

				case GD_TEMPLATE_BLOCKGROUP_AUTHOR:
				case GD_TEMPLATE_BLOCKGROUP_AUTHORDESCRIPTION:		
					
					return GD_TEMPLATE_SUBMENU_AUTHOR;
			}
		}
		
		return parent::get_submenu($template_id);
	}

	function init_atts_blockgroup_block($blockgroup, $blockgroup_block, &$blockgroup_block_atts, $blockgroup_atts) {
		
		// Hide the Title
		switch ($blockgroup) {

			case GD_TEMPLATE_BLOCKGROUP_404:
			case GD_TEMPLATE_BLOCKGROUP_BACKGROUNDMENU:

				$this->append_att($blockgroup_block, $blockgroup_block_atts, 'class', 'col-xs-12 col-sm-4');
				break;

			case GD_TEMPLATE_BLOCKGROUP_SINGLEPOST:

				$this->append_att($blockgroup_block, $blockgroup_block_atts, 'class', 'col-xs-12');

				// Hide the Title, but not for the Comments
				if ($blockgroup_block == GD_TEMPLATE_BLOCK_SINGLE_CONTENT) {
					$this->add_att($blockgroup_block, $blockgroup_block_atts, 'title', '');		
				}
				break;

			case GD_TEMPLATE_BLOCKGROUP_AUTHORDESCRIPTION:
				
				$this->append_att($blockgroup_block, $blockgroup_block_atts, 'class', 'col-xs-12');
				$this->add_att($blockgroup_block, $blockgroup_block_atts, 'title', '');
				break;
				
			case GD_TEMPLATE_BLOCKGROUP_AUTHORSUMMARY:
				
				$this->append_att($blockgroup_block, $blockgroup_block_atts, 'class', 'col-xs-12');
				if ($blockgroup_block == GD_TEMPLATE_BLOCK_AUTHOR_SUMMARYCONTENT) {
					$this->add_att($blockgroup_block, $blockgroup_block_atts, 'title', '');		
				}
				break;
		}

		switch ($blockgroup) {

			case GD_TEMPLATE_BLOCKGROUP_BACKGROUNDMENU:
			case GD_TEMPLATE_BLOCKGROUP_404:

				$descriptions = array(
					GD_TEMPLATE_BLOCK_MENU_BODY_SECTIONS => __('Content', 'poptheme-wassup'),
					GD_TEMPLATE_BLOCK_MENU_BODY_MYSECTIONS => __('My Content', 'poptheme-wassup'),
					GD_TEMPLATE_BLOCK_MENU_BODY_ADDCONTENT => __('Add Content', 'poptheme-wassup'),
				);
				if ($description = $descriptions[$blockgroup_block]) {
				
					$description = sprintf(
						'<h4>%s</h4>',
						sprintf(
							__('%s:', 'poptheme-wassup'),
							$description
						)
					);
					$this->add_att($blockgroup_block, $blockgroup_block_atts, 'title', '');		
					$this->add_att($blockgroup_block, $blockgroup_block_atts, 'description', $description);		
				}
				break;
		}

		return parent::init_atts_blockgroup_block($blockgroup, $blockgroup_block, $blockgroup_block_atts, $blockgroup_atts);
	}

	protected function get_description($template_id, $atts) {

		switch ($template_id) {

			case GD_TEMPLATE_BLOCKGROUP_404:

				return sprintf(
					'<p>%s</p>',
					__('Aiyoooo, it seems there is nothing here. Where else would you like to go?', 'poptheme-wassup')
				);

			// case GD_TEMPLATE_BLOCKGROUP_BACKGROUNDMENU:

			// 	return sprintf(
			// 		'<p>%s</p>',
			// 		__('Where would you like to go?', 'poptheme-wassup')
			// 	);
		}
	
		return parent::get_description($template_id, $atts);
	}

	function get_title($template_id) {

		switch ($template_id) {

			case GD_TEMPLATE_BLOCKGROUP_404:

				return __('Ops, this page doesn\'t exist!', 'poptheme-wassup');

			case GD_TEMPLATE_BLOCKGROUP_SINGLEPOST:
				
				global $post;
				return get_the_title($post->ID);

			case GD_TEMPLATE_BLOCKGROUP_AUTHOR:
			case GD_TEMPLATE_BLOCKGROUP_AUTHORDESCRIPTION:
			case GD_TEMPLATE_BLOCKGROUP_AUTHORSUMMARY:

				global $author;
				return get_the_author_meta('display_name', $author);
		}
		
		return parent::get_title($template_id);
	}

	protected function get_ordered_blockgroup_blockunits($template_id) {

		switch ($template_id) {

			case GD_TEMPLATE_BLOCKGROUP_HOME:
			case GD_TEMPLATE_BLOCKGROUP_AUTHOR:

				return array_merge(
					$this->get_blockgroup_blockgroups($template_id),
					$this->get_blockgroup_blocks($template_id)
				);
		}
	
		return parent::get_ordered_blockgroup_blockunits($template_id);
	}

	function get_blockgroup_blocks($template_id) {

		$ret = parent::get_blockgroup_blocks($template_id);

		global $gd_template_settingsmanager;

		switch ($template_id) {

			// case GD_TEMPLATE_BLOCKGROUP_HOME:

			// 	$ret[] = GD_TEMPLATE_BLOCK_MESSAGES_HOME;
			// 	break;

			case GD_TEMPLATE_BLOCKGROUP_404:
			case GD_TEMPLATE_BLOCKGROUP_BACKGROUNDMENU:

				$ret[] = GD_TEMPLATE_BLOCK_MENU_BODY_SECTIONS;
				$ret[] = GD_TEMPLATE_BLOCK_MENU_BODY_MYSECTIONS;
				$ret[] = GD_TEMPLATE_BLOCK_MENU_BODY_ADDCONTENT;
				break;

			case GD_TEMPLATE_BLOCKGROUP_AUTHORDESCRIPTION:

				$ret[] = GD_TEMPLATE_BLOCK_AUTHOR_CONTENT;
				break;

			case GD_TEMPLATE_BLOCKGROUP_AUTHORSUMMARY:

				$ret[] = GD_TEMPLATE_BLOCK_AUTHOR_SUMMARYCONTENT;
				$ret[] = GD_TEMPLATE_BLOCK_AUTHORALLCONTENT_SCROLL_FIXEDLIST;
				break;

			case GD_TEMPLATE_BLOCKGROUP_SINGLEPOST:

				// Allow TPPDebate to override this, adding the "What do you think about TPP" Create Block
				$blocks = array(
					GD_TEMPLATE_BLOCK_SINGLE_CONTENT,
					GD_TEMPLATE_BLOCK_SINGLEINTERACTION_CONTENT,
				);
				$blocks = apply_filters('GD_Template_Processor_MainBlockGroups:blocks:single', $blocks);
				$ret = array_merge(
					$ret,
					$blocks
				);
				break;

			case GD_TEMPLATE_BLOCKGROUP_HOME:

				// Allow the ThemeStyle to decide if to include block (eg: Swift) or blockgroup (eg: Expansive)
				$type = apply_filters(POP_HOOK_SETTINGSPROCESSORS_BLOCKTYPE_FEED, POP_BLOCKTYPE_SETTINGSPROCESSORS_BLOCK);
				if ($type == POP_BLOCKTYPE_SETTINGSPROCESSORS_BLOCK) {
				
					$page_id = GD_TemplateManager_Utils::get_hierarchy_page_id();
					if ($block = $gd_template_settingsmanager->get_page_block($page_id, GD_SETTINGS_HIERARCHY_HOME)) {
						$ret[] = $block;
					}
				}
				break;

			case GD_TEMPLATE_BLOCKGROUP_AUTHOR:

				// Allow the ThemeStyle to decide if to include block (eg: Swift) or blockgroup (eg: Expansive)
				$type = apply_filters(POP_HOOK_SETTINGSPROCESSORS_BLOCKTYPE_FEED, POP_BLOCKTYPE_SETTINGSPROCESSORS_BLOCK);
				if ($type == POP_BLOCKTYPE_SETTINGSPROCESSORS_BLOCK) {
				
					$page_id = GD_TemplateManager_Utils::get_hierarchy_page_id();
					if ($block = $gd_template_settingsmanager->get_page_block($page_id, GD_SETTINGS_HIERARCHY_AUTHOR)) {
						$ret[] = $block;
					}
				}
				break;
		}

		return $ret;
	}

	function get_blockgroup_blockgroups($template_id) {

		$ret = parent::get_blockgroup_blockgroups($template_id, $atts);

		global $gd_template_settingsmanager;

		switch ($template_id) {

			case GD_TEMPLATE_BLOCKGROUP_HOME:

				// Allow TPPDebate to override this
				if ($home_tops = apply_filters(
					'GD_Template_Processor_MainBlockGroups:blockgroups:home_tops', 
					array(
						GD_TEMPLATE_BLOCKGROUP_HOME_TOP
					)
				)) {
					$ret = array_merge(
						$ret,
						$home_tops
					);
				}

				$type = apply_filters(POP_HOOK_SETTINGSPROCESSORS_BLOCKTYPE_FEED, POP_BLOCKTYPE_SETTINGSPROCESSORS_BLOCK);
				if ($type == POP_BLOCKTYPE_SETTINGSPROCESSORS_BLOCKGROUP) {
				
					$page_id = GD_TemplateManager_Utils::get_hierarchy_page_id();
					if ($blockgroup = $gd_template_settingsmanager->get_page_blockgroup($page_id, GD_SETTINGS_HIERARCHY_HOME)) {
						$ret[] = $blockgroup;
					}
				}
				break;

			case GD_TEMPLATE_BLOCKGROUP_AUTHOR:

				// Allow TPPDebate to override this
				if ($author_tops = apply_filters(
					'GD_Template_Processor_MainBlockGroups:blockgroups:author_tops', 
					array(
						GD_TEMPLATE_BLOCKGROUP_AUTHOR_TOP
					)
				)) {
					$ret = array_merge(
						$ret,
						$author_tops
					);
				}
				
				// $ret[] = $gd_template_settingsmanager->get_page_blockgroup($page_id, GD_SETTINGS_HIERARCHY_AUTHOR);
				// Allow the ThemeStyle to decide if to include block (eg: Swift) or blockgroup (eg: Expansive)
				$type = apply_filters(POP_HOOK_SETTINGSPROCESSORS_BLOCKTYPE_FEED, POP_BLOCKTYPE_SETTINGSPROCESSORS_BLOCK);
				if ($type == POP_BLOCKTYPE_SETTINGSPROCESSORS_BLOCKGROUP) {
				
					$page_id = GD_TemplateManager_Utils::get_hierarchy_page_id();
					if ($blockgroup = $gd_template_settingsmanager->get_page_blockgroup($page_id, GD_SETTINGS_HIERARCHY_AUTHOR)) {
						$ret[] = $blockgroup;
					}
				}
				break;
		}

		return $ret;
	}

}

/**---------------------------------------------------------------------------------------------------------------
 * Initialization
 * ---------------------------------------------------------------------------------------------------------------*/
new GD_Template_Processor_MainBlockGroups();
