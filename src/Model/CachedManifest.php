<?php

namespace Jneyra\MvcWebpackEncore\Model;

class CachedManifest
{
    /** @var string */
    private $assetSuffix;

    /** @var string */
    private $manifestPath;

    /** @var array */
    private $manifestData;

    /**
     * @return string
     */
    public function getAssetSuffix()
    {
        return $this->assetSuffix;
    }

    /**
     * @param string $assetSuffix
     *
     * @return CachedManifest
     */
    public function setAssetSuffix($assetSuffix)
    {
        $this->assetSuffix = $assetSuffix;

        return $this;
    }

    /**
     * @return string
     */
    public function getManifestPath()
    {
        return $this->manifestPath;
    }

    /**
     * @param string $manifestPath
     *
     * @return CachedManifest
     */
    public function setManifestPath($manifestPath)
    {
        $this->manifestPath = $manifestPath;

        return $this;
    }

    /**
     * @return array
     */
    public function getManifestData()
    {
        return $this->manifestData;
    }

    /**
     * @param array $manifestData
     *
     * @return CachedManifest
     */
    public function setManifestData(array $manifestData)
    {
        $this->manifestData = $manifestData;

        return $this;
    }

    /**
     * @param array $manifestData
     *
     * @return CachedManifest
     */
    public static function fromArray(array $manifestData) {
        $instance = new self();
        foreach ($manifestData as $property => $value) {
            $instance->$property = $value;
        }

        return $instance;
    }
}
