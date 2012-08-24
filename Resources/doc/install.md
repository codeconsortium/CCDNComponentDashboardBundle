Installing CCDNComponent DashboardBundle 1.2
============================================

## Dependencies:

1. [CCDNComponent CommonBundle](https://github.com/codeconsortium/CommonBundle/tree/v1.2).
2. [CCDNComponent CrumbTrailBundle](https://github.com/codeconsortium/CrumbTrailBundle/tree/v1.2).

## Installation:

Installation takes only 8 steps:

1. Download and install the dependencies.
2. Register bundles with autoload.php.
3. Register bundles with AppKernel.php.
4. Run vendors install script.
5. Update your app/config/config.yml.
6. Update your app/config/routing.yml.
7. Symlink assets to your public web directory.
8. Warmup the cache.

### Step 1: Download and install the dependencies.

Append the following to end of your deps file (found in the root of your Symfony2 installation):

``` ini
[CCDNComponentDashboardBundle]
	git=http://github.com/codeconsortium/DashboardBundle.git
	target=/bundles/CCDNComponent/DashboardBundle
    version=v1.2
```

### Step 2: Register bundles with autoload.php.

Add the following to the registerNamespaces array in the method by appending it to the end of the array.

``` php
// app/autoload.php
$loader->registerNamespaces(array(
    'CCDNComponent'    => __DIR__.'/../vendor/bundles',
	**...**
));
```

### Step 3: Register bundles with AppKernel.php.

In your AppKernel.php add the following bundles to the registerBundles method array:

``` php
// app/AppKernel.php
public function registerBundles()
{
    $bundles = array(
	    new CCDNComponent\DashboardBundle\CCDNComponentDashboardBundle(),
		**...**
	);
}
```

### Step 4: Run vendors install script.

From your projects root Symfony directory on the command line run:

``` bash
$ php bin/vendors install
```

### Step 5: Update your app/config/config.yml.

In your app/config/config.yml add:    

``` yml
#
# for CCDNComponent DashboardBundle
#
ccdn_component_dashboard:
    template:
        engine: twig
    dashboard:
        show:
            layout_template: CCDNComponentCommonBundle:Layout:layout_body_right.html.twig
```

### Step 6: Update your app/config/routing.yml.

In your app/config/routing.yml add:

``` yml
CCDNComponentDashboardBundle:
    resource: "@CCDNComponentDashboardBundle/Resources/config/routing.yml"
    prefix: /

```

### Step 7: Symlink assets to your public web directory.

From your projects root Symfony directory on the command line run:

``` bash
$ php app/console assets:install --symlink web/
```

### Step 8: Warmup the cache.

From your projects root Symfony directory on the command line run:

``` bash
$ php app/console cache:warmup
```

## Next Steps.

Installation should now be complete!

If you need further help/support, have suggestions or want to contribute please join the community at [Code Consortium](http://www.codeconsortium.com)

- [Return back to the docs index](index.md).
- [Configuration Reference](configuration_reference.md).
