# mvc-webpack-encore

We can add a new frontend development folder based on new standards and patterns, these JS code snippets can be transpiled and compiled via Webpack.

## Symfony Webpack Encore

This Package pretends to be able to give compatibility to add new JS code, This code can have multiple purposes, but the main one is to be a section where to put the frontend code.

Symfony Webpack Encore wasn't available until version 3.3, if you have older versions you can try to install this package.

### How to Install (Backend)

Inside the folder project, you need to run the following command to install the package via Composer CLI

``` bash
$ composer require jneyra/mvc-webpack-encore:dev-master
``` 

Then Install the package and add it to your vendor's folder with:

``` bash
$ composer install
```

These commands shouldn't display an error if there are no incompatibilities with the project.

Finally, add the following configuration in ```parameters.yml``` and ```services.yml``` inside the project.

``` yaml
parameters:
    web_dir: '%kernel.root_dir%/../web' # You need to define the location of your public folder
    webpack_twig_tag: 'webpack_asset' # You need to add a new asset tag to use in your 'twig' that imports the JS code
```

> **Note:**  _These definitions may change depending on how your project is structured._

``` yaml
services:
    Jneyra\MvcWebpackEncore\Contracts\WebpackEncoreManifestLocatorInterface:
        alias: Jneyra\MvcWebpackEncore\Asset\WebpackEncoreManifestLocator
        public: true

    Jneyra\MvcWebpackEncore\Contracts\AssetHashInterface:
        alias: Jneyra\MvcWebpackEncore\Asset\AssetHash
        public: true

    Jneyra\MvcWebpackEncore\Asset\WebpackEncoreManifestLocator:
        class: Jneyra\MvcWebpackEncore\Asset\WebpackEncoreManifestLocator
        public: true
        arguments:
            - '%web_dir%'

    Jneyra\MvcWebpackEncore\Asset\AssetHash:
        class: Jneyra\MvcWebpackEncore\Asset\AssetHash
        public: true
        arguments:
            - '@Jneyra\MvcWebpackEncore\Asset\WebpackEncoreManifestLocator'
            - '%webpack_twig_tag%'

    Jneyra\MvcWebpackEncore\Twig\Extension\WebpackEncoreAsset:
        public: false
        class: Jneyra\MvcWebpackEncore\Twig\Extension\WebpackEncoreAsset
        arguments:
            - '@service_container'
        tags:
            - { name: twig.extension }
```

> **Note:**  _In future updates you will no longer have to define all these services._

### How to Install (Frontend)

You must create a folder inside the project where all the source code will go before transpiling with webpack

You must have NodeJS installed and manage the Encore Package:

https://symfony.com/doc/current/frontend/encore/installation.html#installing-encore-in-non-symfony-applications

Finally, Configure your Webpack File with your configs in your project

https://symfony.com/doc/current/frontend/encore/installation.html#creating-the-webpack-config-js-file

### Transpile Webpack Modes

You need to install Webpack and compile your files, the compiled files will be saved in the public folder

``` bash
$ npm i
```
> **Webpack Install**, this command runs once to install all necessary modules

``` bash
$ npm run dev
```
> **Developer mode**, this command runs once and after the compilation output the bach is finished

``` bash
$ npm run watch
```
> **Watch mode**, after the compilation output the bach will continue "listening" for the files changes

``` bash
$ npm run prod
```
> *Production mode**, compiles applying clean minification on the code ready to production deploy

