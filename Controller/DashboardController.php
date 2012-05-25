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

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
//use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * 
 * @author Reece Fowell <reece@codeconsortium.com> 
 * @version 1.0
 */
class DashboardController extends ContainerAware
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
		$crumb_trail = $this->container->get('ccdn_component_crumb.trail')
			->add($this->container->get('translator')->trans('crumbs.category.index', array(), 'CCDNComponentDashboardBundle'), $this->container->get('router')->generate('cc_dashboard_index'), "sitemap");


		return $this->container->get('templating')->renderResponse('CCDNComponentDashboardBundle:Dashboard:show.html.' . $this->getEngine(), array(
			'crumbs' => $crumb_trail,
			'resources' => $resources,
		));
	}

	
	
	/**
	 *
	 * @access public
	 * @return RenderResponse
	 */
	public function showAction($category)
	{
		$registry = $this->container->get('ccdn_component_dashboard.registry');
		
		$resources = $registry->getResourcesFor($category);
		
		// setup crumb trail.
		$crumb_trail = $this->container->get('ccdn_component_crumb.trail')
			->add($this->container->get('translator')->trans('crumbs.category.index', array(), 'CCDNComponentDashboardBundle'), $this->container->get('router')->generate('cc_dashboard_index'), "sitemap")
			->add($category, $this->container->get('router')->generate('cc_dashboard_show', array('category' => $category)), "sitemap");


		return $this->container->get('templating')->renderResponse('CCDNComponentDashboardBundle:Dashboard:show.html.' . $this->getEngine(), array(
			'crumbs' => $crumb_trail,
			'resources' => $resources,
		));
	}



	/**
	 *
	 * @access protected
	 * @return string
	 */
	protected function getEngine()
    {
        return $this->container->getParameter('ccdn_forum_admin.template.engine');
    }

}
