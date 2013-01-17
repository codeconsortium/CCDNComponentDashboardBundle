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
 	 * @access protected
     */
    protected $container;

    /**
     *
	 * @access protected
     */
    protected $basePath;

    /**
     *
	 * @access protected
     */
    protected $baseUrl;

    /**
     *
	 * @access protected
     */
    protected $locale;

    /**
     *
	 * @access public
	 * @param $container
     */
    public function __construct($container)
    {
        $this->container = $container;

        $this->baseUrl = $this->container->get('request')->getBaseUrl();
        $this->basePath = $this->container->get('request')->getBasePath();
        $this->locale = $this->container->get('request')->getLocale();
    }

    /**
     *
     * Structure of $dashboards
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

        return array();
    }

}
