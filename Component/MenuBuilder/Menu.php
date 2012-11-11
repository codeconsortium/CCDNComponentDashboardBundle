<?php

/*
 * This file is part of the CCDNComponent DashboardBundle
 *
 * (c) CCDN (c) CodeConsortium <http://www.codeconsortium.com/>
 *
 * Available on github <http://www.github.com/codeconsortium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CCDNComponent\DashboardBundle\Component\MenuBuilder;

/**
 *
 * @author Reece Fowell <reece@codeconsortium.com>
 * @version 1.0
 */
class Menu
{

    /**
     *      
	 * @access public
	 * @return array
     */
    public function buildMenu($builder)
    {
		$builder
			->arrayNode('layout')
				->arrayNode('header')
					->arrayNode('top')
						->linkNode('ccdn_component_dashboard.layout.header_links.dashboard', 'ccdn_component_dashboard_index', array(
							'label_trans_bundle' => 'CCDNComponentDashboardBundle',
							'class'	=> 'nav_link',
						))->end()
					->end()
				->end()
				->arrayNode('footer')
					->arrayNode('sections')
						->htmlNode('sections_header', '<div class="footer_block"><h6>Sections</h6>')->end()
						->unorderedListNode('sections')
							->linkNode('ccdn_component_dashboard.layout.header_links.dashboard', 'ccdn_component_dashboard_index', array(
								'label_trans_bundle' => 'CCDNComponentDashboardBundle',
							))->end()
						->end()
						->htmlNode('sections_footer', '</div>')->end()
					->end()
				->end()
			->end();	
    }

}
