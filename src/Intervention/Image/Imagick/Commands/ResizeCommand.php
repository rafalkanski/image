<?php

namespace Intervention\Image\Imagick\Commands;

class ResizeCommand extends \Intervention\Image\Commands\AbstractCommand
{
    /**
     * Resizes image dimensions
     *
     * @param  \Intervention\Image\Image $image
     * @return boolean
     */
    public function execute($image)
    {
        $width = $this->argument(0)->value();
        $height = $this->argument(1)->value();
        $algorithm = $this->argument(2)->value();

        if (\is_null($algorithm)) {
            $algorithm = \Imagick::FILTER_BOX;
        }

        $constraints = $this->argument(2)->type('closure')->value();

        // resize box
        $resized = $image->getSize()->resize($width, $height,$algorithm, $constraints);

        // modify image
        $image->getCore()->resizeImage($resized->getWidth(), $resized->getHeight(), $algorithm, 1);

        return true;
    }
}
