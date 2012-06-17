<?php

namespace Gregwar\Tex2pngBundle\Extensions;

use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Symfony\Component\Form\FormView;

/**
 * Tex2pngTwig extension
 *
 * @author Gregwar <g.passault@gmail.com>
 */
class Tex2pngTwig extends \Twig_Extension
{
    private $container;
    private $environment;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    
    public function initRuntime(\Twig_Environment $environment)
    {
        $this->environment = $environment;
    }

    public function getFunctions()
    {
        return array(
            'tex' => new \Twig_Function_Method($this, 'tex', array('is_safe' => array('html'))),
            'tex_img' => new \Twig_Function_Method($this, 'tex_img', array('is_safe' => array('html'))),
        );
    }

    public function tex($tex, $density = 155)
    {
        return $this->container->get('tex2png')->create($tex, $density)->generate();
    }

    public function tex_img($tex, $density = 155)
    {
        return $this->tex($tex, $density)->html();
    }

    public function getName()
    {
        return 'tex2png';
    }
}

