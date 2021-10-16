<?php

namespace Jneyra\MvcWebpackEncore\Asset;

use InvalidArgumentException;
use Jneyra\MvcWebpackEncore\Contracts\AssetHashInterface;
use Jneyra\MvcWebpackEncore\Contracts\WebpackEncoreManifestLocatorInterface;
use Jneyra\MvcWebpackEncore\Model\CachedManifest;

class AssetHash implements AssetHashInterface
{
    /** @var CachedManifest */
    private $manifest;

    /** @var string */
    private $webpackAssetName;

    public function __construct(WebpackEncoreManifestLocatorInterface $manifest, $webpackAssetName = 'encore_asset')
    {
        $this->manifest = $manifest->getManifest();
        $this->webpackAssetName = $webpackAssetName;
    }

    /**
     * @param string $assetPath
     *
     * @return string
     *
     * @throws InvalidArgumentException
     */
    public function hasAsset($assetPath)
    {
        $webpackAsset = '';
        $webAsset = $this->manifest->getAssetSuffix().$assetPath;
        $data = $this->manifest->getManifestData();

        if (array_key_exists($webAsset, $data)) {
            $webpackAsset = $data[$webAsset];
        }

        if ($webpackAsset === '') {
            throw new InvalidArgumentException('The asset is not registered on manifest.json');
        }

        return $webpackAsset;
    }

    /**
     * @return string
     */
    public function getWebpackAssetName()
    {
        return $this->webpackAssetName;
    }
}
