Example Usage.
==============

Making your applications plug and playable with Dashboard is easy, first add to your own bundle the following service definition:

``` yml
parameters:
	acme_pizza_admin.dashboard.integrator.class: Acme\PizzaAdminBundle\Component\Dashboard\DashboardIntegrator

services:
	acme_pizza_admin.dashboard.integrator:
	    class: %acme_pizza_admin.dashboard.integrator.class%
	    arguments: [@service_container]
	    tags:
	        - { name: ccdn_component_dashboard.integrator }
```

Then add a directory structure of Component\Dashboard and create a file DashboardIntegrator.php and put the following contents in the file:

``` php
/*
 * This file is part of the CCDNComponent DashboardBundle as an example!
 *
 * (c) CCDN (c) CodeConsortium <http://www.codeconsortium.com/>
 *
 * Available on github <http://www.github.com/codeconsortium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CCDNAcme\AcmePizzaBundle\Component\Dashboard;

use CCDNComponent\DashboardBundle\Component\Integrator\BaseIntegrator;

/**
 *
 * @author Reece Fowell <reece@codeconsortium.com>
 * @version 1.0
 */
class DashboardIntegrator extends BaseIntegrator
{



	/**
	 *
	 *
	 * Structure of $resources
	 * 	[DASHBOARD_PAGE String]
	 * 		[CATEGORY_NAME String]
	 *			[ROUTE_FOR_LINK String]
	 *				[AUTH String]
	 *				[URL_LINK String]
	 *				[URL_NAME String]
	 */
	public function getResources()
	{
		$resources = array(
			'admin' => array(
				'Administrate Pizza Ingredients' => array(
					'admin_pizza_edit' => array('auth' => 'ROLE_ADMIN', 'name' => 'Edit Ingredients Choices', 'icon' => $this->basePath . '/bundles/ccdncomponentcommon/images/icons/Black/32x32/32x32_category.png'),
				),
			),

		);

		return $resources;
	}

}
```

The array is where you store data relevant to that particular bundle, the first level of indices in the array can be used to specify what pages items will appear on.

The array key as demonstrated in the above example (labelled in the legend as ROUTE_FOR_LINK) should be the name of the route that your link should go to. If however you cannot provide the route name because of some route properties you can specify a url as a param.

For example, /en/dashboard/admin will show all items added to the admin index. Of course if you just type in /en/dashboard then everything would appear.

You can repeat this step as many times as necessary in each individual bundle, and /en/dashboard will bring them all together into one nice integrated panel for easy navigation across your site.

The service tag ccdn_component_dashboard.subscriber is what notifies the dashboard of the links in your bundles DashboardIntegrator.php file.

You can also use the same page index across multiple bundles and when you view the page they will be grouped together.

See the other codeconsortium bundles such as the Forum bundle for more examples of this.


If you wish to add the index page to the header links in the default template of the common bundle, then add this to your app/config.

``` yml
#
# for CCDNComponent CommonBundle
#
ccdn_component_common:
    header_bar_links:
        - { bundle: CCDNComponentDashboardBundle, label: 'ccdn_component_dashboard.layout.header_links.dashboard', route: 'ccdn_component_dashboard_index' }
        - { bundle: CCDNUserMemberBundle, label: 'ccdn_user_member.layout.header_links.members', route: 'ccdn_user_member_index'}
        - { bundle: CCDNForumForumBundle, label: 'ccdn_forum_forum.layout.header_links.forum', route: ccdn_forum_forum_index }
```

- [Return back to the docs index](index.md).
