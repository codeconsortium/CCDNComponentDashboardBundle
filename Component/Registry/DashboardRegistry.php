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

namespace CCDNComponent\DashboardBundle\Component\Registry;

use Symfony\Component\DependencyInjection\ContainerAware;


/**
 * 
 * @author Reece Fowell <reece@codeconsortium.com> 
 * @version 1.0
 */
class DashboardRegistry
{



	/**
	 *
	 */	
	protected $container;
	
	

	/**
	 *
	 *
	 */
	public function __construct($service_container)
	{
		$this->container = $service_container;
	}
	
	
	
	/**
	 *
	 *
	 */
	public function getResourcesFor($category)
	{
		$resources = $this->getResources();
		
		if (array_key_exists($category, $resources))
		{
			return array($resources[$category]);
		} else {
			return array();
		}
	}
	
	
	
	/**
	 *
	 *
	 */
	public function getResources()
	{
		
		/**
		 *
		 * Structure of Subscribers
		 * 	[DASHBOARD_PAGE String]
		 * 		[CATEGORY_NAME String]
		 *			[ROUTE_FOR_LINK String]
		 *				[AUTH String]
		 *				[URL_LINK String]
		 *				[URL_NAME String]
		 */
		$subscribers = $this->container->get('ccdn_component_dashboard.subscriber_chain')->getSubscribers();

		$resources = array();

		foreach($subscribers as $subscriberkey => $subscriber)
		{		
			
			$resources = array_merge_recursive($subscriber->getResources(), $resources);
		}
		
		// strip out the resources requiring higher permissions
		// than that which is granted for this user request.
		foreach ($resources as $resourceKey => $resource)
		{
			foreach($resource as $categoryKey => $category)
			{
				foreach($category as $itemKey => $item)
				{
					if (array_key_exists('auth', $item))
					{
						if ( ! $this->container->get('security.context')->isGranted($item['auth']))
						{
							// prune dead leaves if we do not have sufficient auth.
							unset($resources[$resourceKey][$categoryKey][$itemKey]);
							
							continue;
						}
					}
				}

				// prune dead branches.
				if (count($resources[$resourceKey][$categoryKey]) < 1)
				{
					unset($resources[$resourceKey][$categoryKey]);
				}
			}

			// prune dead branches.
			if (count($resources[$resourceKey]) < 1)
			{
				unset($resources[$resourceKey]);
			}

		}
		
		return $resources;
	}
	
}
