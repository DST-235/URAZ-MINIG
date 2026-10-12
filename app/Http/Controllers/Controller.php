<?php

namespace App\Http\Controllers;

use Illuminate\Http\UploadedFile;

abstract class Controller
{
    /**
     * Store an uploaded file without relying on the finfo/fileinfo PHP extension.
     * Uses the client-supplied extension and raw file contents to bypass MIME detection.
     */
    protected function storeUpload(UploadedFile $file, string $folder, string $disk = 'public'): string
    {
        $ext      = strtolower($file->getClientOriginalExtension()) ?: 'bin';
        $relative = $folder . '/' . uniqid() . '.' . $ext;
        $absolute = storage_path('app/' . $disk . '/' . $relative);

        if (!is_dir(dirname($absolute))) {
            mkdir(dirname($absolute), 0755, true);
        }

        $file->move(dirname($absolute), basename($absolute));

        return $relative;
    }

    protected function deleteUpload(?string $relative, string $disk = 'public'): void
    {
        if (!$relative) return;
        $absolute = storage_path('app/' . $disk . '/' . $relative);
        if (is_file($absolute)) {
            @unlink($absolute);
        }
    }
}
