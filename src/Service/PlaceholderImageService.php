<?php

namespace App\Service;

use Error;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class PlaceholderImageService
{
    private string $saveDirectory;
    private FilenameGenerator $filenameGenerator;
    private string $placeholderServiceProvideUrl = "https://placehold.co/";
    private int $minImgWidth = 150;
    private int $minImgHeight = 150;

    public function __construct(FilenameGenerator $generator, ParameterBagInterface $container)
    {
        $this->filenameGenerator = $generator;
        $this->saveDirectory = $container->get("upload.directory");
    }

    /**
     * @param int $imgWidth
     * @param int $imgHeight
     * @return string
     * @throws Error
     */
    public function getNewImageStream(int $imgWidth, int $imgHeight): string
    {
        if ($imgWidth < $this->minImgWidth || $imgHeight < $this->minImgHeight) {
            throw new Error("L'image est trop grande");
        }
        $contents = file_get_contents("{$this->placeholderServiceProvideUrl}/{$imgWidth}x{$imgHeight}");
        if (!$contents) {
            throw new Error("Impossible de charger l'image");
        }
        return $contents;
    }

    /**
     * @param int $imgWidth
     * @param int $imgHeight
     * @return bool
     * @throws Error
     */
    public function getNewImageAndSave(int $imgWidth, int $imgHeight): bool
    {
        $file = __DIR__ . "/../../uploads/" . $this->filenameGenerator->getUniqFilename();
        $contents = $this->getNewImageStream($imgWidth, $imgHeight);
        $bytes = file_put_contents($file, $contents);
        return file_exists($file) && $bytes;
    }
}