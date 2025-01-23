<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\FileUploadService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }
    public function showLinks(User $user)
    {
        $links = $user->links()->get();

        return view('showLinks', compact('links', 'user'));
    }

    public function customizeLinksPage()
    {
        return view('customize');
    }

    public function updateStyles(Request $request)
    {
        $validated = $request->validate([
            'background_color' => 'string|nullable',
            'logo_name' => 'string|nullable',
            'background_image_name' => 'string|nullable'
        ]);

        if ($validated['logo_name'] && $validated['logo_name'] != '') {
            $logoPath = $this->fileUploadService->saveFile($request->input('logo_name'), 'logo_images');
        }
        if ($validated['background_image_name'] && $validated['background_image_name'] != '') {
            $backgroundImagePath = $this->fileUploadService->saveFile($request->input('background_image_name'), 'background_images');
        }
        if($validated['background_color'] && $validated['background_color'] != '') {
            $backgroundColor = $validated['background_color'];
        }

        auth()->user()->update([
            'logo_path' => $logoPath ?? auth()->user()->logo_path,
            'background_color' => $backgroundColor ?? auth()->user()->background_image_path ,
            'background_image_path' => $backgroundImagePath ?? auth()->user()->background_color,
        ]);

        return redirect()->route('users.customize')->with('success', 'Uodated !');
    }
}
