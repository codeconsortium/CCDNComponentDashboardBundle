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

use CCDNComponent\DashboardBundle\Component\Integrator\Model\Node\Page;

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
class PageCatalogue
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
     * @var array $poages
     */
    protected $pages;

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

        $this->pages = array();
    }

    /**
     *
     * @access public
     * @param  \CCDNComponent\DashboardBundle\Component\Integrator\Model\Node\Category      $category
     * @return \CCDNComponent\DashboardBundle\Component\Integrator\Model\Node\PageCatalogue
     */
    public function addCategory($category)
    {
        $this->parent = $category;

        return $this;
    }

    /**
     *
     * @access public
     * @param  string                                                                       $name
     * @return \CCDNComponent\DashboardBundle\Component\Integrator\Model\Node\PageCatalogue
     */
    public function addPage($name)
    {
        if (! array_key_exists($name, $this->pages)) {
            $this->pages[$name] = new Page($this->securityContext, $this->router, $this->translator, $this, $name);
        }

        $this->pages[$name]->addCategory($this->parent);

        return $this->pages[$name];
    }

    /**
     *
     * @access public
     * @return array
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     *
     * @access public
     * @param  string $pageName
     * @return array
     */
    public function getCategoriesForPage($pageName)
    {
        foreach ($this->pages as $page) {
            if ($page->getName() == $pageName) {
                return $page->getCategories();
            }
        }

        throw new \Exception('Page "' . $pageName . '" not found.');
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
