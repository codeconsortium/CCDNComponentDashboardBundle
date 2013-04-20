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

use CCDNComponent\DashboardBundle\Component\Integrator\Model\Node\Link;

/**
 *
 * @author Reece Fowell <reece@codeconsortium.com>
 * @version 2.0
 */
class LinkCatalogue
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
	 * @var Object $parent
	 */	
	protected $parent;
	
	/**
	 *
	 * @access protected
	 * @var array $links
	 */	
	protected $links;
	
	/**
	 *
	 * @access public
	 * @param \Symfony\Component\Security\Core\SecurityContext $securityContext
	 * @param \Symfony\Bundle\FrameworkBundle\Routing\Router $router
	 * @param \Symfony\Bundle\FrameworkBundle\Translation\Translator $translator
	 */
	public function __construct($securityContext, $router, $translator, $parent)
	{						
		$this->securityContext = $securityContext;
		
		$this->router = $router;
		
		$this->translator = $translator;
		
		$this->parent = $parent;
		
		$this->links = array();
	}
	
	/**
	 *
	 * @access public 
	 * @param string $name
	 * @return \CCDNComponent\DashboardBundle\Component\Integrator\Model\Node\Link
	 */
	public function addLink($name)
	{
		if (array_key_exists($name, $this->links)) {
			throw new \Exception('Link "' . $name . '" already exists in "' . $this->name . '" category');
		}

		$this->links[$name] = new Link($this->securityContext, $this->router, $this->translator, $this, $name);
		
		return $this->links[$name];
	}
	
	/**
	 *
	 * @access public 
	 * @return int
	 */
	public function countLinks()
	{
		$found = 0;
		
		foreach($this->links as $link) {
			if ($link->isAuthorised()) {
				$found++;
			}
		}
		
		return $found;
	}
	
	/**
	 *
	 * @access public 
	 * @return array
	 */
	public function getLinks()
	{
		return $this->links;
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