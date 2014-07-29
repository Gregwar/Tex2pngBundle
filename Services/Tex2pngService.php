<?php

namespace Gregwar\Tex2pngBundle\Services;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Tex2png service
 *
 * @author Gregwar <g.passault@gmail.com>
 */
class Tex2pngService
{
    protected $cache_dir;
    protected $handler_class;
    protected $container;

    public function __construct($cache_dir, $handler_class, ContainerInterface $container)
    {
        $this->cache_dir = $cache_dir;
        $this->handler_class = $handler_class;
        $this->container = $container;
    }

    /**
     * Create a PNG image from a LaTeX formula
     *
     * @param $tex the LaTeX formula
     * @param $density the density (resolution)
     *
     * @return object a tex2png object
     */
    public function create($tex, $density = 155)
    {
        $asset = $this->container->get('templating.helper.assets');

        $handler_class = $this->handler_class;
        $tex2png = new $handler_class($tex, $density);

        $tex2png->setCacheDirectory($this->cache_dir);

        $tex2png->setFileCallback(function($file) use ($asset) {
            return $asset->getUrl($file);
        });

        return $tex2png;
    }

    public function setHandler($handler)
    {
        $this->handler_class = $handler; 
    }
}
