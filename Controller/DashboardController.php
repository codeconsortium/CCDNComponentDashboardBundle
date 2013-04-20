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

namespace CCDNComponent\DashboardBundle\Controller;

use CCDNComponent\DashboardBundle\Controller\BaseController;

/**
 *
 * @author Reece Fowell <reece@codeconsortium.com>
 * @version 1.0
 */
class DashboardController extends BaseController
{
    /**
     *
     * @access public
     * @return RenderResponse
     */
    public function indexAction()
    {
        $registry = $this->container->get('ccdn_component_dashboard.registry');

        $categories = $registry->getCategories();
		$pages = $registry->getPages();
		
        // setup crumb trail.
        $crumbs = $this->getCrumbs()
            ->add($this->trans('ccdn_component_dashboard.crumbs.category.index'), $this->path('ccdn_component_dashboard_index'));

        return $this->renderResponse('CCDNComponentDashboardBundle:Dashboard:show.html.',
			array(
	            'crumbs' => $crumbs,
				'pages' => $pages,
				'currentPage' => 'default',
	            'categories' => $categories,
	        )
		);
    }

    /**
     *
     * @access public
	 * @category string $category
     * @return RenderResponse
     */
    public function showAction($pageName)
    {
        $registry = $this->container->get('ccdn_component_dashboard.registry');

        $categories = $registry->getCategoriesForPage($pageName);
		$pages = $registry->getPages();
		
        // setup crumb trail.
        $crumbs = $this->getCrumbs()
            ->add($this->trans('ccdn_component_dashboard.crumbs.category.index'), $this->path('ccdn_component_dashboard_index'))
            ->add($pageName, $this->path('ccdn_component_dashboard_show', array('pageName' => $pageName)));

        return $this->renderResponse('CCDNComponentDashboardBundle:Dashboard:show.html.',
			array(
	            'crumbs' => $crumbs,
				'pages' => $pages,
				'currentPage' => $pageName,
	            'categories' => $categories,
	        )
		);
    }
}