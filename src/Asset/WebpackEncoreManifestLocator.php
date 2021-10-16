<?php

namespace Jneyra\MvcWebpackEncore\Asset;

use Exception;
use Jneyra\MvcWebpackEncore\Contracts\WebpackEncoreManifestLocatorInterface;
use Jneyra\MvcWebpackEncore\Model\CachedManifest;

class WebpackEncoreManifestLocator implements WebpackEncoreManifestLocatorInterface
{
    /** @var string */
    private $publicDir;

    /** @var CachedManifest */
    private $manifestContent;

    public function __construct($publicDir)
    {
        $this->publicDir = $publicDir;
    }

    /**
     * @return CachedManifest
     *
     * @throws Exception
     */
    public function getManifest()
    {
        $manifestPath = realpath($this->publicDir.'/_build/manifest.json');

        if (!file_exists($manifestPath)) {
            throw new Exception(sprintf(
                '%s: %s',
                'There is no cached value for',
                $manifestPath
            ));
        }

        $strManifestContents = file_get_contents($manifestPath);
        $manifestData = json_decode($strManifestContents, true);

        $manifestSuffix = $this->getSuffix($manifestData);

        $this->manifestContent = CachedManifest::fromArray([
            'assetSuffix' => $manifestSuffix,
            'manifestPath' => $manifestPath,
            'manifestData' => $manifestData
        ]);

        return $this->manifestContent;
    }

    /**
     * @param null|array $manifestData
     *
     * @return string
     */
    private function getSuffix($manifestData) {
        $suffix = '';
        $manifestDataKeys = [];

        if (null !== $manifestData) {
            $manifestDataKeys = array_keys($manifestData);
        }

        if (count($manifestDataKeys) > 0) {
            $manifestDataPivot = reset($manifestDataKeys);
            $auxSuffixArray = explode(self::PROCESSED_ASSET_FOLDER, $manifestDataPivot);
            $suffix = sprintf('%s%s', reset($auxSuffixArray), self::PROCESSED_ASSET_FOLDER);
        }

        return $suffix;
    }
}
