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

namespace CCDNComponent\DashboardBundle\Component\Integrator\Registry;

use Symfony\Component\DependencyInjection\ContainerAware;

/**
 *
 * @author Reece Fowell <reece@codeconsortium.com>
 * @version 1.0
 */
class DashboardRegistry extends ContainerAware
{

    /**
     *
 	 * @access protected
     */
    protected $container;

    /**
     *
     * @access public
  	 * @param $container
     */
    public function __construct($container)
    {
        $this->container = $container;
    }

    /**
     *
     * @access public
	 * @param $category
	 * @return array
     */
    public function getResourcesFor($category)
    {
        $resources = $this->getResources();

        if (array_key_exists($category, $resources)) {
            return array($resources[$category]);
        } else {
            return array();
        }
    }

    /**
     *
     * Structure of Subscribers
     * 	[DASHBOARD_PAGE <string>]
     * 		[CATEGORY_NAME <string>]
     *			[ROUTE_FOR_LINK <string>]
     *				[AUTH <string>] (optional)
     *				[URL_LINK <string>]
     *				[URL_NAME <string>]
     *
     * @access public
 	 * @return array
     */
    public function getResources()
    {
        $subscribers = $this->container->get('ccdn_component_dashboard.integrator_chain')->getIntegrators();

        $resources = array();

        // Reduce duplicates.
        foreach ($subscribers as $subscriberkey => $subscriber) {
            $resources = array_merge_recursive($subscriber->getResources(), $resources);
        }

        // strip out the resources requiring higher permissions
        // than that which is granted for this user request.
        foreach ($resources as $resourceKey => $resource) {
            foreach ($resource as $categoryKey => $category) {
                foreach ($category as $itemKey => $item) {
                    // if no url is present, then use the ROUTE_FOR_LINK to generate the url.
                    if ( ! array_key_exists('url', $item)) {
                        $resources[$resourceKey][$categoryKey][$itemKey]['url'] = $this->container->get('router')->generate($itemKey);
                    }

					// Only show if NOT-logged in.
                    if (array_key_exists('no_auth', $item)) {
						if ($item['no_auth'] == true)
						{
							if ($this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY'))
							{
	                            // prune dead leaves if we have sufficient auth.
	                            unset($resources[$resourceKey][$categoryKey][$itemKey]);

								continue;
							}
						}
                    }				
					
                    // if we don't have the right auth, then don't show it.
                    if (array_key_exists('auth', $item)) {
                        if ( ! $this->container->get('security.context')->isGranted($item['auth'])) {
                            // prune dead leaves if we do not have sufficient auth.
                            unset($resources[$resourceKey][$categoryKey][$itemKey]);

                            continue;
                        }
                    }
                }

                // prune dead branches.
                if (count($resources[$resourceKey][$categoryKey]) < 1) {
                    unset($resources[$resourceKey][$categoryKey]);
                }
            }

            // prune dead branches.
            if (count($resources[$resourceKey]) < 1) {
                unset($resources[$resourceKey]);
            }

        }

        return $resources;
    }

}
