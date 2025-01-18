<?php

namespace App\Http\Controllers;

use App\Http\Requests\LinkUpdateRequest;
use App\Models\UserLink;
use App\Services\FileUploadService;
use Exception;
use Illuminate\Http\Request;
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

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function show($id)
    {
        // Display a specific QR code
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function edit($id)
    {
        // Show form for editing a QR code
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function update(Request $request, $id)
    {
        // Update a specific QR code
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        // Delete a specific QR code
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
