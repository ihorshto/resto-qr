<?php

namespace App\Http\Controllers;

use App\Http\Requests\LinkUpdateRequest;
use App\Models\UserLink;
use App\Services\FileUploadService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserLinkController extends Controller
{
    public $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }

    public function index()
    {
        $links = auth()->user()->links()->get();

        return view('links.index', compact('links'));
    }

    public function create()
    {
        return view('links.create');
    }

    public function store(LinkUpdateRequest $request)
    {
        $validatedData = $request->validated();

        try {
            $imagePath = $this->fileUploadService->saveFile($request->input('file_name'), 'links_images');

            UserLink::create([
                'user_id' => $request->user()->id,
                'description' => $validatedData['description'],
                'image_path' => $imagePath,
                'link_path' => $validatedData['link_path'],
            ]);
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }

        return redirect()->route('links.index')->with('success', 'Lien créé avec succès !');
    }

    public function edit(UserLink $link)
    {
        return view('links.edit', compact('link'));
    }


    public function update(LinkUpdateRequest $request, UserLink $link)
    {
        $validatedData = $request->validated();

        $temporaryImageName = $request->input('file_name');


        // Check if the temporary image name exist
        if ($temporaryImageName) {
            try {
                $imagePath = $this->fileUploadService->saveFile($request->input('file_name'), 'links_images');
                if ($link->image_path) {
                    Storage::disk('public')->delete($link->image_path);
                }
            } catch (Exception $e) {
                return redirect()->back()->withErrors($e->getMessage());
            }
        } else {
            $imagePath = $link->image_path;
        }

        $link->update([
            'description' => $validatedData['description'],
            'image_path' => $imagePath,
            'link_path' => $validatedData['link_path'],
        ]);

        return redirect()->route('links.index')->with('success', 'Lien mis à jour avec succès !');
    }


    public function destroy(Request $request, UserLink $link)
    {
        if ($link->image_path) {
            Storage::disk('public')->delete($link->image_path);
        }
        $link->delete();

        return redirect()->route('links.index')->with('success', 'Lien supprimé avec succès !');
    }

    /**
     * Image uploading
     */
    public
    function uploadImage(Request $request): JsonResponse
    {
        // Validate the file as an image
        $this->fileUploadService->validateFile($request, 'jpeg,jpg,png,gif,svg,webp', 'file');

        try {
            $fileName = $this->fileUploadService->uploadFile($request, 'file', 'uploads/uploads_' . auth()->user()->id);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }

        return response()->json([
            'name' => $fileName,
        ]);
    }
}
