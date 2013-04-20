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

namespace CCDNComponent\DashboardBundle\Component\Integrator\Model;

use CCDNComponent\DashboardBundle\Component\Integrator\Model\Node\PageCatalogue;
use CCDNComponent\DashboardBundle\Component\Integrator\Model\Node\Category;

/**
 *
 * @author Reece Fowell <reece@codeconsortium.com>
 * @version 2.0
 */
interface BuilderInterface
{
	/**
	 *
	 * @access public
	 * @param \Symfony\Component\Security\Core\SecurityContext $securityContext
	 * @param \Symfony\Bundle\FrameworkBundle\Routing\Router $router
	 * @param \Symfony\Bundle\FrameworkBundle\Translation\Translator $translator
	 */
	public function __construct($securityContext, $router, $translator);
	
	/**
	 *
	 * @access public 
	 * @return \CCDNComponent\DashboardBundle\Component\Integrator\Model\Node\PageCatalogue
	 */
	public function getPageCatalogue();
	/**
	 *
	 * @access public
	 * @return array
	 */
	public function getPages();
	
	/**
	 *
	 * @access public
	 * @param string $name
	 * @return CCDNComponent\DashboardBundle\Component\Integrator\Model\Node\Category
	 */
	public function addCategory($name);
	
	/**
	 *
	 * @access public
	 * @return array
	 */
	public function getCategories();
	/**
	 *
	 * @access public
	 * @param string $page
	 * @return array
	 */
	public function getCategoriesForPage($page);
	
	/**
	 *
	 * @access public
	 * @return CCDNComponent\DashboardBundle\Component\Integrator\Model\Builder
	 */
	public function end();
}