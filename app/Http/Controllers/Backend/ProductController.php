<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTrait;
use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('admin.product.index');
    }

   
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.create');
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

        Product::create([
            'logo' => $logoPath,
            'name' => $request->input('name'),
            'slug' => Str::slug($request->name),
            'is_featured' => $request->input('is_featured'),
            'status' => $request->input('status'),
        ]);

        toastr()->success('Product was successfully stored!');

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
        $product = Product::findOrFail($id);

        return view('admin.product.edit', compact('product'));
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

        $prdouct = Product::findOrFail($id);

        $logoPath = $this->updateImage($request, 'logo', 'uploads', $prdouct->logo);

        $prdouct->update([
            'logo' => empty(!$logoPath) ? $logoPath : $prdouct->logo ,
            'name' => $request->input('name'),
            'slug' => Str::slug($request->name),
            'is_featured' => $request->input('is_featured'),
            'status' => $request->input('status'),
        ]);

        toastr()->success('Product was successfully Updated!');

        return redirect()->action([self::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function changeStatus(Request $request)
    {

        $product = Product::findOrFail($request->id);
        $product->status = $request->status == 'true' ? 1 : 0;
        $product->save();

        return response(['message' => 'Status has been updated!']);
    }
}
