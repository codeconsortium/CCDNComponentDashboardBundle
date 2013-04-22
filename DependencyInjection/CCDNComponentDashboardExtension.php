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

namespace CCDNComponent\DashboardBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\Config\FileLocator;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
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
class CCDNComponentDashboardExtension extends Extension
{
    /**
     *
     * @access public
     * @return string
     */
    public function getAlias()
    {
        return 'ccdn_component_dashboard';
    }

    /**
     *
     * @access public
     * @param array                                                   $config
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        // Class file namespaces.
        $this
            ->getComponentSection($config, $container)
        ;

        // Configuration stuff.
        $container->setParameter('ccdn_component_dashboard.template.engine', $config['template']['engine']);

        $this
            ->getSEOSection($config, $container)
            ->getDashboardSection($config, $container)
        ;

        // Load Service definitions.
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }

    /**
     *
     * @access private
     * @param  array                                                                              $config
     * @param  \Symfony\Component\DependencyInjection\ContainerBuilder                            $container
     * @return \CCDNComponent\DashboardBundle\DependencyInjection\CCDNComponentDashboardExtension
     */
    private function getComponentSection(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ccdn_component_dashboard.component.integrator.registry.class', $config['component']['integrator']['registry']['class']);
        $container->setParameter('ccdn_component_dashboard.component.integrator.chain.class', $config['component']['integrator']['chain']['class']);

        return $this;
    }

    /**
     *
     * @access private
     * @param  array                                                                              $config
     * @param  \Symfony\Component\DependencyInjection\ContainerBuilder                            $container
     * @return \CCDNComponent\DashboardBundle\DependencyInjection\CCDNComponentDashboardExtension
     */
    private function getSEOSection(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ccdn_component_dashboard.seo.title_length', $config['seo']['title_length']);

        return $this;
    }

    /**
     *
     * @access private
     * @param  array                                                                              $config
     * @param  \Symfony\Component\DependencyInjection\ContainerBuilder                            $container
     * @return \CCDNComponent\DashboardBundle\DependencyInjection\CCDNComponentDashboardExtension
     */
    private function getDashboardSection(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ccdn_component_dashboard.dashboard.show.layout_template', $config['dashboard']['show']['layout_template']);

        return $this;
    }
}
