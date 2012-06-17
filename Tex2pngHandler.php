<?php

namespace Gregwar\Tex2pngBundle;

use Gregwar\Tex2pngBundle\Tex2png;

/**
 * Tex2png handling class
 *
 * @author Gregwar <g.passault@gmail.com>
 */
class Tex2pngHandler extends Tex2png
{
    protected $fileCallback = null;

    /**
     * Defines the callback to call to compute the new filename
     */
    public function setFileCallback($file)
    {
        $this->fileCallback = $file;
    }

    /**
     * When processing the filename, call the callback
     */
    public function hookFile($filename)
    {
        $callback = $this->fileCallback;

        if (null === $callback)
            return $filename;

        return $callback($filename);
    }
}

