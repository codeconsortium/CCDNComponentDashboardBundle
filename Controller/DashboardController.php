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

        $resources = $registry->getResources();

        // setup crumb trail.
        $crumbs = $this->getCrumbs()
            ->add($this->trans('ccdn_component_dashboard.crumbs.category.index'), $this->path('ccdn_component_dashboard_index'));

        return $this->renderResponse('CCDNComponentDashboardBundle:Dashboard:show.html.', array(
            'crumbs' => $crumbs,
            'resources' => $resources,
        ));
    }

    /**
     *
     * @access public
	 * @category string $category
     * @return RenderResponse
     */
    public function showAction($category)
    {
        $registry = $this->container->get('ccdn_component_dashboard.registry');

        $resources = $registry->getResourcesFor($category);

        // setup crumb trail.
        $crumbs = $this->getCrumbs()
            ->add($this->trans('ccdn_component_dashboard.crumbs.category.index'), $this->path('ccdn_component_dashboard_index'))
            ->add($category, $this->path('ccdn_component_dashboard_show', array('category' => $category)));

        return $this->renderResponse('CCDNComponentDashboardBundle:Dashboard:show.html.', array(
            'crumbs' => $crumbs,
            'resources' => $resources,
        ));
    }
}