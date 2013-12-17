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

use CCDNComponent\DashboardBundle\Controller\BaseController;

/**
 *
 * @category CCDNComponent
 * @package  DashboardBundle
 *
 * @author   Reece Fowell <reece@codeconsortium.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @version  Release: 2.0
 * @link     https://github.com/codeconsortium/CCDNComponentDashboardBundle
 *
 */
class DashboardController extends BaseController
{
    /**
     *
     * @access public
     * @return RenderResponse
     */
    public function indexAction()
    {
        $registry = $this->container->get('ccdn_component_dashboard.registry');

        $categories = $registry->getCategories();
        $pages = $registry->getPages();

        return $this->renderResponse('CCDNComponentDashboardBundle:User:Dashboard/show.html.', array(
            'pages' => $pages,
            'currentPage' => 'default',
            'categories' => $categories,
        ));
    }

    /**
     *
     * @access public
     * @category string $category
     * @return RenderResponse
     */
    public function showAction($pageName)
    {
        $registry = $this->container->get('ccdn_component_dashboard.registry');

        $categories = $registry->getCategoriesForPage($pageName);
        $pages = $registry->getPages();

        return $this->renderResponse('CCDNComponentDashboardBundle:User:Dashboard/show.html.',array(
            'pages' => $pages,
            'currentPage' => $pageName,
            'categories' => $categories,
        ));
    }
}
