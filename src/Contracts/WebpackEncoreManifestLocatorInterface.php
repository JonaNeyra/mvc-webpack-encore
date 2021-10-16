<?php

namespace Jneyra\MvcWebpackEncore\Contracts;

use Exception;
use Jneyra\MvcWebpackEncore\Model\CachedManifest;

interface WebpackEncoreManifestLocatorInterface
{
    const PROCESSED_ASSET_FOLDER = '_build/';

    /**
     * @return CachedManifest
     *
     * @throws Exception
     */
    public function getManifest();
}
