<?php

namespace App\Http\Controllers\Backend;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTrait;
use App\DataTables\BrandDataTable;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(BrandDataTable $dataTable)
    {
        return $dataTable->render('admin.brand.index');
    }

   
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|max:2000',
            'name' => 'required|max:200',
            'is_featured' => 'required',
            'status' => 'required',
        ]);

        $logoPath = $this->uploadImage($request, 'logo', 'uploads');

        Brand::create([
            'logo' => $logoPath,
            'name' => $request->input('name'),
            'slug' => Str::slug($request->name),
            'is_featured' => $request->input('is_featured'),
            'status' => $request->input('status'),
        ]);

        toastr()->success('Brand was successfully stored!');

        return redirect()->action([self::class, 'index']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $brand = Brand::findOrFail($id);

        return view('admin.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'logo' => 'nullable|image|max:2000',
            'name' => 'required|max:200',
            'is_featured' => 'required',
            'status' => 'required',
        ]);

        $brand = Brand::findOrFail($id);

        $logoPath = $this->updateImage($request, 'logo', 'uploads', $brand->logo);

        $brand->update([
            'logo' => empty(!$logoPath) ? $logoPath : $brand->logo ,
            'name' => $request->input('name'),
            'slug' => Str::slug($request->name),
            'is_featured' => $request->input('is_featured'),
            'status' => $request->input('status'),
        ]);

        toastr()->success('Brand was successfully Updated!');

        return redirect()->action([self::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);

        $brand->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function changeStatus(Request $request)
    {

        $brand = Brand::findOrFail($request->id);
        $brand->status = $request->status == 'true' ? 1 : 0;
        $brand->save();

        return response(['message' => 'Status has been updated!']);
    }
}
