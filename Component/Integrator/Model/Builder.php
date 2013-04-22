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

use CCDNComponent\DashboardBundle\Component\Integrator\Model\BuilderInterface;
use CCDNComponent\DashboardBundle\Component\Integrator\Model\Node\PageCatalogue;
use CCDNComponent\DashboardBundle\Component\Integrator\Model\Node\Category;

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
class Builder implements BuilderInterface
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
    protected $pageCatalogue;

    /**
     *
     * @access protected
     * @var array $categories
     */
    protected $categories;

    /**
     *
     * @access public
     * @param \Symfony\Component\Security\Core\SecurityContext       $securityContext
     * @param \Symfony\Bundle\FrameworkBundle\Routing\Router         $router
     * @param \Symfony\Bundle\FrameworkBundle\Translation\Translator $translator
     */
    public function __construct($securityContext, $router, $translator)
    {
        $this->securityContext = $securityContext;

        $this->router = $router;

        $this->translator = $translator;

        $this->pageCatalogue = new PageCatalogue($securityContext, $router, $translator);

        $this->categories = array();
    }

    /**
     *
     * @access public
     * @return \CCDNComponent\DashboardBundle\Component\Integrator\Model\Node\PageCatalogue
     */
    public function getPageCatalogue()
    {
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
     * @param  string                                                                 $name
     * @return CCDNComponent\DashboardBundle\Component\Integrator\Model\Node\Category
     */
    public function addCategory($name)
    {
        if (! array_key_exists($name, $this->categories)) {
            $this->categories[$name] = new Category($this->securityContext, $this->router, $this->translator, $this, $name, $this->pageCatalogue);
        }

        return $this->categories[$name];
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
     * @param  string $page
     * @return array
     */
    public function getCategoriesForPage($page)
    {
        return $this->pageCatalogue->getCategoriesForPage($page);
    }

    /**
     *
     * @access public
     * @return CCDNComponent\DashboardBundle\Component\Integrator\Model\Builder
     */
    public function end()
    {
        return $this;
    }
}
