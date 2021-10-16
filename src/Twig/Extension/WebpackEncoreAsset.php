<?php

namespace Jneyra\MvcWebpackEncore\Twig\Extension;

use Jneyra\MvcWebpackEncore\Asset\AssetHash;
use Jneyra\MvcWebpackEncore\Contracts\AssetHashInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Twig_Extension;
use Twig_SimpleFunction;

final class WebpackEncoreAsset extends Twig_Extension
{
    const WEBPACK_ENCORE_OVERRIDE_METHOD = '__invoke';

    /** @var ContainerInterface */
    private $container;

    /** @var AssetHash */
    private $webpackEncoreService;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->webpackEncoreService = $this->container->get(AssetHashInterface::class);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return $this->webpackEncoreService->getWebpackAssetName();
    }

    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        $assetName = $this->webpackEncoreService->getWebpackAssetName();

        return [
            new Twig_SimpleFunction($assetName, [
                $this->webpackEncoreService,
                self::WEBPACK_ENCORE_OVERRIDE_METHOD
            ]),
        ];
    }
}
