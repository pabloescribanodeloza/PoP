<?php

/**---------------------------------------------------------------------------------------------------------------
 *
 * Filter Action
 *
 * ---------------------------------------------------------------------------------------------------------------*/

define ('GD_FILTER_AUTHOROPINIONATEDVOTES', 'authoropinionatedvotes');

class GD_Filter_AuthorOpinionatedVoteds extends GD_FilterAuthorPosts {

	function get_filtercomponents() {
	
		global $gd_filtercomponent_search, $gd_filtercomponent_stance, $gd_filtercomponent_references, $gd_filtercomponent_daterangepicker, $gd_filtercomponent_orderpost;
		$ret = array($gd_filtercomponent_search, $gd_filtercomponent_stance, $gd_filtercomponent_references, $gd_filtercomponent_daterangepicker, $gd_filtercomponent_orderpost);
		$ret = apply_filters('gd_template:filter-authoropinionatedvotes:filtercomponents', $ret);
		$ret = apply_filters('gd_template:filter-authorposts:filtercomponents', $ret);
		return $ret;
	}
	
	function get_name() {
	
		return GD_FILTER_AUTHOROPINIONATEDVOTES;
	}
}

/**---------------------------------------------------------------------------------------------------------------
 * Initialize
 * ---------------------------------------------------------------------------------------------------------------*/
new GD_Filter_AuthorOpinionatedVoteds();		
