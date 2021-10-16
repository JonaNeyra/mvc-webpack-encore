<?php

namespace Jneyra\MvcWebpackEncore\Contracts;

use InvalidArgumentException;

interface AssetHashInterface
{
    /**
     * @param string $assetPath
     *
     * @return string
     *
     * @throws InvalidArgumentException
     */
    public function hasAsset($assetPath);

    /**
     * @return string
     */
    public function getWebpackAssetName();
}
