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

namespace CCDNComponent\DashboardBundle\Component\Integrator\Model\Node;

/**
 *
 * @author Reece Fowell <reece@codeconsortium.com>
 * @version 2.0
 */
class Page
{
	/**
	 *
	 * @access protected
	 * @var \Symfony\Component\Security\Core\SecurityContext $securityContext
	 */
	protected $securityContext;
	
	/**
	 *
	 * @access protected
	 * @var \Symfony\Bundle\FrameworkBundle\Routing\Router $router
	 */
	protected $router;
	
	/**
	 *
	 * @access protected
	 * @var \Symfony\Bundle\FrameworkBundle\Translation\Translator $translator
	 */ 
	protected $translator;

	/**
	 *
	 * @access protected
	 * @var \CCDNComponent\DashboardBundle\Component\Integrator\Model\Node\PageCatalogue $pageCatalogue
	 */
	protected $parent;
	
	/**
	 *
	 * @access protected
	 * @var string $name
	 */
	protected $name;
	
	/**
	 *
	 * @access protected
	 * @var string $labelName
	 */
	protected $labelName;
	
	/**
	 *
	 * @access protected
	 * @var array $labelParams
	 */
	protected $labelParams;
	
	/**
	 *
	 * @access protected
	 * @var string $labelBundle
	 */
	protected $labelBundle;

	/**
	 *
	 * @access protected
	 * @var array $categories
	 */
	protected $categories;
	
	/**
	 *
	 * @access public
	 * @param \Symfony\Component\Security\Core\SecurityContext $securityContext
	 * @param \Symfony\Bundle\FrameworkBundle\Routing\Router $router
	 * @param \Symfony\Bundle\FrameworkBundle\Translation\Translator $translator
	 */
	public function __construct($securityContext, $router, $translator, $parent, $name)
	{
		$this->securityContext = $securityContext;
		
		$this->router = $router;
		
		$this->translator = $translator;
	
		$this->parent = $parent;
		
		$this->name = $name;
		
		$this->categories = array();
	}
	
	/**
	 *
	 * @access public
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}
	
	/**
	 *
	 * @access public 
	 * @param string $name
	 * @param array $params
	 * @param string $bundle
	 * @return \CCDNComponent\DashboardBundle\Component\Integrator\Model\Node\Page
	 */
	public function setLabel($name, array $params = array(), $bundle = null)
	{
		$this->labelName = $name;
		$this->labelParams = $params;
		$this->labelBundle = $bundle;
		
		return $this;
	}
	
	/**
	 *
	 * @access public 
	 * @return string
	 */
	public function getLabel()
	{
		return $this->translator->trans($this->labelName, $this->labelParams, $this->labelBundle);
	}
	
	/**
	 *
	 * @access public 
	 * @return array
	 */
	public function countCategories()
	{
		$count = 0;
		
		foreach($this->categories as $category) {
			$count += $category->countLinks();
		}
		
		return $count;
	}
	
	/**
	 *
	 * @access public 
	 * @param \CCDNComponent\DashboardBundle\Component\Integrator\Model\Node\Category
	 */
	public function addCategory($category)
	{
		$this->categories[$category->getName()] = $category;
	}
	
	/**
	 *
	 * @access public 
	 * @return array
	 */
	public function getCategories()
	{
		return $this->categories;
	}
	
	/**
	 *
	 * @access public 
	 * @return Object
	 */
	public function end()
	{
		return $this->parent;
	}
}
