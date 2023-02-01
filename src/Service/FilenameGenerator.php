<?php

namespace App\Service;

class FilenameGenerator
{
    /**
     * @return string
     */
    public function getUniqFilename(): string
    {
        return uniqid() . ".png";
    }
}
