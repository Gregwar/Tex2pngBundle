Gregwar's Tex2pngBundle
=====================

`GregwarTex2pngBundle` provides a service and a twig helper to convert Tex formulas to PNG images

Installation
============

### Step 1: Download the GregwarTex2pngBundle

***Using the vendors script***

Add the following lines to your `deps` file:

```
    [GregwarTex2pngBundle]
        git=git://github.com/Gregwar/Tex2pngBundle.git
        target=/bundles/Gregwar/Tex2pngBundle
```

Now, run the vendors script to download the bundle:

``` bash
$ php bin/vendors install
```

***Using submodules***

If you prefer instead to use git submodules, then run the following:

``` bash
$ git submodule add git://github.com/Gregwar/Tex2pngBundle.git vendor/bundles/Gregwar/Tex2pngBundle
$ git submodule update --init
```

***Using Composer***

Add the following to the "require" section of your `composer.json` file:

```
    "gregwar/tex2png-bundle": "1.0.0"
```

And update your dependencies

```
    php composer.phar update
```

### Step 2: Configure the Autoloader

If you use composer, you can skip this step.

Add it to your `autoload.pp` :

```php
<?php
...
'Gregwar' => __DIR__.'/../vendor/bundles',
```

### Step 3: Enable the bundle

Registers the bundle in your `app/AppKernel.php`:

```php
<?php
...
public function registerBundles()
{
    $bundles = array(
        ...
        new Gregwar\Tex2pngBundle\GregwarTex2pngBundle(),
        ...
    );
...
```

### Step 4: Configure the bundle and set up the directories

Adds the following configuration to your `app/config/config.yml`:

    gregwar_tex2png: ~

If you want to customize the cache directory name, you can specify it:

    gregwar_tex2png:
        cache_dir:  my_cache_dir

Creates the cache directory and change the permissions so the web server can write 
in it:

    mkdir web/cache
    chmod 777 web/cache

Usage
=====

Basics
------

This bundle is based on the [Gregwar's Tex2png](http://github.com/Gregwar/Tex2png) class and
provides a service and a twig extension :

    <img src="{{ tex('\\sum_{i=0}^{i=n} i') }}" />

The PNG image will be generated using the formula and cached into a file. If this file already
exists, it will do nothing else but just lookup for the good file name.

Note that you can use the tex_img twig function to generate the whole HTML tag :

    {{ tex_img('\\sum_{i=0}^{i=n} i') }}

If you want to change the density (resolution) of the image, you can specify it as a second 
argument (defaults: 155) :

    {{ tex_img('\\sum_{i=0}^{i=n} i', 300) }}

Using the service
-----------------

Twig2pngBundle provides a servie that can be used to generate tex files directly from your own
logics :

```php
<?php
...
$this->get('tex2png')->create('\sum_{i=0}^{i=n} i')
    ->saveTo('formulas/sum.png')
    ->generate();
```

Requirements
============

`GregwarTex2pngBundle` need you to have `latex` and `dvipng` installed, a temporary directory, and
the `shell_exec()` PHP function should be available and useable.

License
=======

This bundle is under MIT license
