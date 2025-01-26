<?php

namespace App\Services;

use App\Models\Document;
use App\Models\UserDocument;
use App\Models\UserQrCode;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadService
{
    protected string $disk;
    protected int $maxFileSize;

    public function __construct(string $disk = 'public', int $maxFileSize = 4096)
    {
        $this->disk = $disk;
        $this->maxFileSize = $maxFileSize; // File size in KB
    }

    // Setter for $disk
    public function setDisk(string $disk): self
    {
        $this->disk = $disk;
        return $this; // Allow method chaining
    }

    // Setter for $maxFileSize
    public function setMaxFileSize(int $maxFileSize): self
    {
        $this->maxFileSize = $maxFileSize;
        return $this; // Allow method chaining
    }

    public function validateFile(Request $request, string $allowedMimes, string $fileName): void
    {
        $request->validate([
            $fileName => "required|mimes:{$allowedMimes}|max:{$this->maxFileSize}",
        ], [
            $fileName . '.mimes' => 'Le fichier doit être de type : ' . str_replace(',', ', ', $allowedMimes) . '.',
            $fileName . '.required' => 'Veuillez télécharger un fichier.',
            $fileName . '.max' => 'La taille du fichier ne doit pas dépasser ' . ($this->maxFileSize / 1024) . ' Mo.',
        ]);
    }

    public function uploadFile(Request $request, string $requestFileName, string $folderName): string
    {
        $file = $request->file($requestFileName);
        $originalName = $file->getClientOriginalName();
        $cleanedName = $this->sanitizeFileName($originalName);
        $timestamp = time();
        $fileName = "{$timestamp}_{$cleanedName}";


        $filePath = Storage::disk($this->disk)->putFileAs(
            $folderName,
            $file,
            $fileName
        );

        $mimeType = $file->getMimeType();

        if (str_starts_with($mimeType, 'image/')) {
            if ($mimeType == 'image/svg+xml' || $mimeType == 'text/svg+xml') {
                // Optionally minify the SVG file
                $this->minifySvg($filePath);
            } else {
                // Compress the image with Imagick if it's a raster image
                $this->compressImageWithImagick($filePath);
            }
        }

        if (!$filePath) {
            throw new \Exception('Erreur lors de l\'enregistrement du fichier');
        }

        if ($requestFileName == 'upload') {
            // Generate the public URL for the stored file
            return Storage::url($filePath);
        }

        return $fileName;
    }

    public function saveFile(string $temporaryFileName, string $targetFolder): string
    {
        $userId = auth()->check() ? auth()->user()->id : '0';
        $tempFilePath = "uploads/uploads_{$userId}/{$temporaryFileName}";

        if (!Storage::disk($this->disk)->exists($tempFilePath)) {
            throw new Exception('Le fichier téléchargé n\'a pas été trouvé ou a été supprimé.');
        }

        $documentFilePath = Storage::disk('public')->putFileAs(
            $targetFolder,
            Storage::disk($this->disk)->path($tempFilePath),
            $temporaryFileName
        );

        if (!$documentFilePath) {
            throw new Exception('Erreur lors de l\'enregistrement du fichier');
        }

//        $this->cleanUpUserFolder($userId);

        return $documentFilePath;
    }

    public function cleanUpUserFolder(int $userId): void
    {
        if ($userId != '0') {
            $userTempDir = "uploads/uploads_{$userId}";
            Storage::disk($this->disk)->deleteDirectory($userTempDir);
        }
    }

    public function sanitizeFileName(string $fileName): string
    {
        $cleanedName = preg_replace('/[^a-zA-Z0-9-_\.]/u', '_', trim($fileName));
        $cleanedName = preg_replace('/_+/', '_', $cleanedName);
        return trim($cleanedName, '_');
    }

    public function compressImageWithImagick($path)
    {
        // Load the full path to the image
        $fullPath = Storage::disk('public')->path($path);

        // Create an Imagick object
        $imagick = new \Imagick($fullPath);

        // Set image compression quality (JPEG)
        if ($imagick->getImageMimeType() == 'image/jpeg') {
            $imagick->setImageCompression(\Imagick::COMPRESSION_JPEG);
            $imagick->setImageCompressionQuality(75); // Adjust quality as needed
        }

        // Set compression quality for PNG
        if ($imagick->getImageMimeType() == 'image/png') {
            $imagick->setOption('png:compression-level', '9'); // 0-9, where 9 is the highest compression
        }

        // Write the image back to the path, overwriting the original
        $imagick->writeImage($fullPath);

        // Clear resources
        $imagick->clear();
        $imagick->destroy();

        return $fullPath;
    }

    /**
     * Minifies an SVG file by removing unnecessary whitespace and comments.
     *
     * @param string $filePath
     * @return void
     */
    private function minifySvg(string $filePath): void
    {
        $svgContent = Storage::get($filePath);

        // Minify the SVG content
        $minifiedSvg = preg_replace(
            [
                '/>\s+</',     // Remove whitespace between tags
                '/<!--.*?-->/' // Remove comments
            ],
            [
                '><',
                ''
            ],
            $svgContent
        );

        // Save the minified content back to the file
        Storage::put($filePath, $minifiedSvg);
    }

    public function openFile($qrcode)
    {
        return $this->findFile($qrcode);
    }


    private function findFile($qrcode)
    {
        // Define the path to the file
        $filePath = $qrcode->qr_code_path;
        // Check if the file exists
        if (!Storage::disk('public')->exists($filePath)) {
            return redirect()->back()->withErrors("Le qr code n'existe pas.");
        }

        info('after');


        // Generate a slugged title for the download filename
        $titleSlug = $this->sanitizeFileName($qrcode->title);

        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
        $filename = "{$titleSlug}.{$extension}";

        // Set headers to display the file inline with the correct filename
        $headers = [
            'Content-Type' => Storage::disk('public')->mimeType($filePath),
            'Content-Disposition' => "inline; filename=\"{$filename}\"",
        ];

        return response()->file(storage_path("app/public/{$filePath}"), $headers);
    }

}
