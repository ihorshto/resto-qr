<?php

namespace App\Http\Controllers;

use App\Models\UserQrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UserQrCodeController extends Controller
{

    public function index()
    {
        $qrcode = auth()->user()->qrcode()->first() ?? null;

        if($qrcode) {
            return view('qrcode.index', compact('qrcode'));
        } else {
            return redirect()->route('qrcode.create');
        }
    }

    public function create()
    {
        $qrcode = auth()->user()->qrcode()->first() ?? null;

        return view('qrcode.create', compact('qrcode'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255'
        ]);

        $qrcodeLink = "http://google.com";
        $qrcodeImagePath = 'qr-codes/qr-code-' . auth()->user()->id . '.png';

        // Generate QR Code
        QrCode::size(400)->format('png')->generate($qrcodeLink, public_path($qrcodeImagePath));

        // Check if QR Code file exists
        if (file_exists(public_path($qrcodeImagePath))) {
            $qrcode = UserQrCode::create([
                'user_id' => auth()->user()->id,
                'title' => $validated['title'],
                'qr_code_path' => $qrcodeImagePath // Save the file path
            ]);

            return redirect()->route('qrcode.create', compact('qrcode'))->with('success', 'Qrcode crée avec succès !');
        }

        return redirect()->route('qrcode.create')->with('error', 'Qrcode n\'est pas correct.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Display a specific QR code
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Show form for editing a QR code
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Update a specific QR code
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete a specific QR code
    }
}
