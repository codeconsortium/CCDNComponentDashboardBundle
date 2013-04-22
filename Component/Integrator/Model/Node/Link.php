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
class Link
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
     * @var \CCDNComponent\DashboardBundle\Component\Integrator\Model\Node\LinkCatalogue $parent
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
     * @var string $routeName
     */
    protected $routeName;

    /**
     *
     * @access protected
     * @var array $routeParams
     */
    protected $routeParams;

    /**
     *
     * @access protected
     * @var string $url
     */
    protected $url;

    /**
     *
     * @access protected
     * @var string $greaterRole
     */
    protected $greaterRole;

    /**
     *
     * @access protected
     * @var string $lesserRole
     */
    protected $lesserRole;

    /**
     *
     * @access protected
     * @var string $icon
     */
    protected $icon;

    /**
     *
     * @access public
     * @param \Symfony\Component\Security\Core\SecurityContext       $securityContext
     * @param \Symfony\Bundle\FrameworkBundle\Routing\Router         $router
     * @param \Symfony\Bundle\FrameworkBundle\Translation\Translator $translator
     */
    public function __construct($securityContext, $router, $translator, $parent, $name)
    {
        $this->securityContext = $securityContext;

        $this->router = $router;

        $this->translator = $translator;

        $this->parent = $parent;

        $this->name = $name;
    }

    /**
     *
     * @access public
     * @param  string                                                              $role
     * @return \CCDNComponent\DashboardBundle\Component\Integrator\Model\Node\Link
     */
    public function setAuthRole($role)
    {
        $this->greaterRole = $role;

        return $this;
    }

    /**
     *
     * @access public
     * @param  string                                                              $role
     * @return \CCDNComponent\DashboardBundle\Component\Integrator\Model\Node\Link
     */
    public function setLessThanAuthRole($role)
    {
        $this->lesserRole = $role;

        return $this;
    }

    /**
     *
     * @access public
     * @return bool
     */
    public function isAuthorised()
    {
        if ($this->lesserRole) {
            if ($this->greaterRole) {
                return !$this->securityContext->isGranted($this->lesserRole) && $this->securityContext->isGranted($this->greaterRole);;
            } else {
                return !$this->securityContext->isGranted($this->lesserRole);
            }
        } else {
            if ($this->greaterRole) {
                return $this->securityContext->isGranted($this->greaterRole);
            } else {
                return true;
            }
        }
    }

    /**
     *
     * @access public
     * @param  string                                                              $routeName
     * @param  array                                                               $routeParams
     * @return \CCDNComponent\DashboardBundle\Component\Integrator\Model\Node\Link
     */
    public function setRoute($routeName, array $routeParams = array())
    {
        $this->routeName = $routeName;
        $this->routeParams = $routeParams;

        return $this;
    }

    /**
     *
     * @access public
     * @return string
     */
    public function getPath()
    {
        return $this->router->generate($this->routeName, $this->routeParams);
    }

    /**
     *
     * @access public
     * @param  string                                                              $icon
     * @return \CCDNComponent\DashboardBundle\Component\Integrator\Model\Node\Link
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     *
     * @access public
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     *
     * @access public
     * @param  string                                                              $name
     * @param  array                                                               $params
     * @param  string                                                              $bundle
     * @return \CCDNComponent\DashboardBundle\Component\Integrator\Model\Node\Link
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
     * @return Object
     */
    public function end()
    {
        return $this->parent;
    }
}
