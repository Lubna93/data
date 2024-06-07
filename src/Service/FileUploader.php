<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    private $targetDirectory;
    private $targetDirectory2;

    public function __construct(string $targetDirectory, string $targetDirectory2)
    {
        $this->targetDirectory = $targetDirectory;
        $this->targetDirectory2 = $targetDirectory2;
    }

    public function upload(UploadedFile $file): string
    {
        $newFileName = md5(uniqid()) . '.' . $file->guessExtension();
        $file->move($this->targetDirectory, $newFileName);

        return $newFileName;
    }

    public function uploadA(UploadedFile $file): string
    {
        $newFileName = md5(uniqid()) . '.' . $file->guessExtension();
        $file->move($this->targetDirectory2, $newFileName);

        return $newFileName;
    }
}