<?php

/*
 * This file is part of the CCDN AdminBundle
 *
 * (c) CCDN (c) CodeConsortium <http://www.codeconsortium.com/> 
 * 
 * Available on github <http://www.github.com/codeconsortium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CCDNComponent\DashboardBundle\Component\Integrator;


/**
 * 
 * @author Reece Fowell <reece@codeconsortium.com> 
 * @version 1.0
 */
class BaseIntegrator
{


	
	/**
	 *
	 */
	protected $container;
		
	
	
	/**
	 *
	 */
	protected $basePath;



	/**
	 *
	 */
	protected $baseUrl;
	
	
	
	/**
	 *
	 */
	protected $locale;
	
	
	
	/**
	 *
	 */
	public function __construct($service_container)
	{
		$this->container = $service_container;
		$this->baseUrl = $this->container->get('request')->getBaseUrl();
		$this->basePath = $this->container->get('request')->getBasePath();
		$this->locale = $this->container->get('request')->getSession()->getLocale();
	}
	
	
	
	/**
	 *
	 */
	public function getResources()
	{
		
		/**
		 *
		 * Structure of $dashboards
		 * 	[DASHBOARD_PAGE String]
		 * 		[CATEGORY_NAME String]
		 *			[ROUTE_FOR_LINK String]
		 *				[AUTH String]
		 *				[URL_LINK String]
		 *				[URL_NAME String]
		 */
		return array();
	}
	
}
