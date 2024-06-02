<?php

namespace App\Http\Controllers\Backend;

use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminVendorProfileController extends Controller
{
    use ImageUploadTrait;
        /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = Vendor::where('user_id', Auth::user()->id)->first();

        return view('admin.vendor-profile.index',compact('profile'));
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'banner' => 'nullable|image|max:3000',
            'phone' => 'required|max:15',
            'email' => 'required|email|max:200',
            'address' => 'required',
            'description' => 'required',
            'fb_link' => 'nullable|url',
            'tw_link' => 'nullable|url',
            'insta_link' => 'nullable|url',
        ]);

        $vendor = Vendor::where('user_id',Auth::user()->id)->first();

        $bannerPath = $this->updateImage($request, 'banner', 'uploads', $vendor->banner);

        $vendor->update([
            'banner' => empty(!$bannerPath) ? $bannerPath : $vendor->banner,
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'description' => $request->input('description'),
            'fb_link' => $request->input('fb_link'),
            'tw_link' => $request->input('tw_link'),
            'insta_link' => $request->input('insta_link'),
        ]);

        toastr()->success('Vendor Profile was successfully stored!');

        return redirect()->action([self::class, 'index']);
    }

}
