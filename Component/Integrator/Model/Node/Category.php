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

use CCDNComponent\DashboardBundle\Component\Integrator\Model\Node\PageCatalogue;
use CCDNComponent\DashboardBundle\Component\Integrator\Model\Node\LinkCatalogue;

/**
 *
 * @author Reece Fowell <reece@codeconsortium.com>
 * @version 2.0
 */
class Category
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
	 * @var \CCDNComponent\DashboardBundle\Component\Integrator\Model\BuilderInterface $parent
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
	 * @var \CCDNComponent\DashboardBundle\Component\Integrator\Model\Node\PageCatalogue $pageCatalogue
	 */
	protected $pageCatalogue;
	
	/**
	 *
	 * @access protected
	 * @var \CCDNComponent\DashboardBundle\Component\Integrator\Model\Node\LinkCatalogue $linkCatalogue
	 */
	protected $linkCatalogue;
	
	/**
	 *
	 * @access public
	 * @param \Symfony\Component\Security\Core\SecurityContext $securityContext
	 * @param \Symfony\Bundle\FrameworkBundle\Routing\Router $router
	 * @param \Symfony\Bundle\FrameworkBundle\Translation\Translator $translator
	 */
	public function __construct($securityContext, $router, $translator, $parent, $name, $pageCatalogue)
	{				
		$this->securityContext = $securityContext;
		
		$this->router = $router;
		
		$this->translator = $translator;
	
		$this->parent = $parent;
		
		$this->name = $name;
		
		$this->pageCatalogue = $pageCatalogue;
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
	 * @return \CCDNComponent\DashboardBundle\Component\Integrator\Model\Node\Category
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
	 * @return \CCDNComponent\DashboardBundle\Component\Integrator\Model\Node\Category
	 */
	public function addPages()
	{
		$this->pageCatalogue->addCategory($this);
		
		return $this->pageCatalogue;
	}
	
	/**
	 *
	 * @access public 
	 * @return array
	 */
	public function getPages()
	{
		return $this->pageCatalogue->getPages();
	}
	
	/**
	 *
	 * @access public 
	 * @return int
	 */
	public function countPages()
	{
		return $this->pageCatalogue->countPages();
	}
	
	/**
	 *
	 * @access public 
	 * @return \CCDNComponent\DashboardBundle\Component\Integrator\Model\Node\LinkCatalogue
	 */
	public function addLinks()
	{
		if (null == $this->linkCatalogue) {
			$this->linkCatalogue = new LinkCatalogue($this->securityContext, $this->router, $this->translator, $this);			
		}
		
		return $this->linkCatalogue;
	}
	
	/**
	 *
	 * @access public 
	 * @return array
	 */
	public function getLinks()
	{
		return $this->linkCatalogue->getLinks();
	}
	
	/**
	 *
	 * @access public 
	 * @return int
	 */
	public function countLinks()
	{
		return $this->linkCatalogue->countLinks();
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
