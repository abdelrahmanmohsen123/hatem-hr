<?php

namespace App\Support;

use Dompdf\Dompdf;
use Barryvdh\DomPDF\Facade\Pdf;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class FileUploader
{
    protected $resizeWidth;
    protected $resizeHeight;

    protected $quality = 80; // Default quality
    protected $format = 'png'; // Default quality


    public function setSize($width, $height)
    {
        $this->resizeWidth = $width;
        $this->resizeHeight = $height;

        return $this;
    }

    /**
     * Set the image output quality (0-100).
     */
    public function setQuality($quality)
    {
        $this->quality = $quality;
        return $this;
    }

    public function setFormat($format)
    {
        $this->format = $format;
        return $this;
    }

    public function save($file, $path)
    {
        ini_set('memory_limit', '512M');

        if (filter_var($file, FILTER_VALIDATE_URL)) {
            return $file;
        }

        $uniqueName = md5(uniqid());

        if ($file->getClientOriginalExtension() == 'mp3') {
            return $file->storeAs($path, $uniqueName . '.mp3', 'public');
        }

        if ($file->getClientOriginalExtension() == 'pdf') {
            return $file->storeAs($path, $uniqueName . '.pdf', 'public');
        }

        // For images
        if ($this->resizeWidth) {
            $file = Image::make($file)
                ->resize($this->resizeWidth, $this->resizeHeight, function ($constraint) {
                    $constraint->aspectRatio();
                })->encode('png');
        } else {
            $file = Image::make($file)->encode('png');
        }

        $file->encode($this->format, $this->quality);
        $resizedImageName = md5($file->__toString() . uniqid()) . '.png';
        $fullPath = $path . '/' . $resizedImageName;

        Storage::disk('public')->put($fullPath, $file->__toString());

        return $fullPath;
    }


    public function saveBase64Image($base64_image, $path, $ext = 'jpg')
    {
        ini_set('memory_limit', '512M');

        $base64_str = substr($base64_image, strpos($base64_image, ",") + 1);
        $image = base64_decode($base64_str);

        $imageName = md5(uniqid(true)) . '.' . $ext;
        $path = $path . '/' . $imageName;

        Storage::put($path, $image);

        return $path;
    }

    public function saveBase64File($base64_file, $path, $type = 'svga')
    {
        ini_set('memory_limit', '512M');

        $base64_str = substr($base64_file, strpos($base64_file, ",") + 1);
        $image = base64_decode($base64_str);

        $imageName = md5(uniqid(true)) . '.' . $type;

        $path = $path . '/' . $imageName;

        Storage::put($path, $image);

        return $path;
    }


    public function convertStringToImage($base64_image, $path, $ext = 'jpg')
    {
        ini_set('memory_limit', '512M');


        if (filter_var($base64_image, FILTER_VALIDATE_URL)) {
            return $base64_image;
        }
        // Decode the Base64 string into binary data
        $binaryData = base64_decode($base64_image);

        // Create an image object using Intervention Image
        $image = Image::make($binaryData);

        // Save the image to storage (optional)
        $imagePath = $path . '/' . uniqid() . '.' . $ext;
        Storage::put($imagePath, $binaryData);

        return $imagePath;
    }

    public function convertBase64ToFile($base64String, $path, $ext = 'pdf')
    {
        ini_set('memory_limit', '512M');

        // if (filter_var($base64String, FILTER_VALIDATE_URL)) {
        //     return $base64String;
        // }
        // Decode the Base64 string
        $binaryData = base64_decode($base64String);

        if ($binaryData === false) {
            throw new \Exception('Base64 decoding failed');
        }
        // Ensure the path exists
        Storage::makeDirectory($path);

        // Generate the full path (relative to the storage disk)
        $filePath = $path . '/' . uniqid() . '.' . $ext;

        // Full save path using the storage path
        $savePath = storage_path('app/public/' . $filePath);

        // Save the file to the storage disk
        file_put_contents($savePath, $binaryData);

        return $filePath;
    }

    public function remove($filePath)
    {
        // Check if the file exists
        if (Storage::exists($filePath)) {
            // Delete the file
            return Storage::delete($filePath);
        }

        return false;
    }
}
