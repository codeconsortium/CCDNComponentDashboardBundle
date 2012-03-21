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

namespace CCDNComponent\DashboardBundle\Component\Chain;

use CCDNComponent\DashboardBundle\Component\Integrator\IntegratorInterface;

/**
 * 
 * @author Reece Fowell <reece@codeconsortium.com> 
 * @version 1.0
 */
class IntegratorChain
{
	
	
	
	/**
	 *
	 */
	private $integrators;



	public function __construct()
	{
		$this->integrators = array();
	}
	
	
	
	/**
	 *
	 */
	public function addIntegrator(IntegratorInterface $integrator)
	{
		$this->integrators[] = $integrator;
	}
	
	
	
	/**
	 *
	 */
	public function getIntegrators()
	{
		return $this->integrators;
	}
	
}
