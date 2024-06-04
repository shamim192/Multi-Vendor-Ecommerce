<?php

namespace App\Http\Controllers\Backend;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ChildCategory;
use App\Models\ProductVariant;
use App\Traits\ImageUploadTrait;
use App\Models\ProductImageGallery;
use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.product.create', compact('categories','brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'thumb_image' => 'required|image|max:2000',
            'name' => 'required|max:200',
            'category_id' => 'required',
            'brand_id' => 'required',
            'price' => 'required',
            'qty' => 'required',
            'short_description' => 'required|max:600',
            'long_description' => 'required',
            'seo_titile' => 'nullable|max:200',
            'seo_description' => 'nullable|max:250',
            'status' => 'required',
        ]);

        $imagePath = $this->uploadImage($request, 'thumb_image', 'uploads');

        Product::create([
            'thumb_image' => $imagePath,
            'name' => $request->input('name'),
            'slug' => Str::slug($request->name),
            'vendor_id' => Auth::user()->vendor->id,
            'category_id' => $request->input('category_id'),
            'sub_category_id' => $request->input('sub_category_id'),
            'child_category_id' => $request->input('child_category_id'),
            'brand_id' => $request->input('brand_id'),
            'qty' => $request->input('qty'),
            'short_description' => $request->input('short_description'),
            'long_description' => $request->input('long_description'),
            'video_link' => $request->input('video_link'),
            'sku' => $request->input('sku'),
            'price' => $request->input('price'),
            'offer_price' => $request->input('offer_price'),
            'offer_start_date' => $request->input('offer_start_date'),
            'offer_end_date' => $request->input('offer_end_date'),
            'product_type' => $request->input('product_type'),
            'seo_title' => $request->input('seo_title'),
            'seo_description' => $request->input('seo_description'),
            'is_approved' => 1,
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
        $subCategories = SubCategory::where('category_id', $product->category_id)->get();
        $childCategories = ChildCategory::where('sub_category_id', $product->sub_category_id)->get();
        $categories = Category::all();
        $brands = Brand::all();

        return view('admin.product.edit', compact('product','categories','brands','subCategories','childCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'thumb_image' => 'nullable|image|max:2000',
            'name' => 'required|max:200',
            'category_id' => 'required',
            'brand_id' => 'required',
            'price' => 'required',
            'qty' => 'required',
            'short_description' => 'required|max:600',
            'long_description' => 'required',
            'seo_titile' => 'nullable|max:200',
            'seo_description' => 'nullable|max:250',
            'status' => 'required',
        ]);

        $prdouct = Product::findOrFail($id);

        $imagePath = $this->updateImage($request, 'thumb_image', 'uploads', $prdouct->thumb_image);

        $prdouct->update([
            'thumb_image' => empty(!$imagePath) ? $imagePath : $prdouct->thumb_image,
            'name' => $request->input('name'),
            'slug' => Str::slug($request->name),
            'vendor_id' => Auth::user()->vendor->id,
            'category_id' => $request->input('category_id'),
            'sub_category_id' => $request->input('sub_category_id'),
            'child_category_id' => $request->input('child_category_id'),
            'brand_id' => $request->input('brand_id'),
            'qty' => $request->input('qty'),
            'short_description' => $request->input('short_description'),
            'long_description' => $request->input('long_description'),
            'video_link' => $request->input('video_link'),
            'sku' => $request->input('sku'),
            'price' => $request->input('price'),
            'offer_price' => $request->input('offer_price'),
            'offer_start_date' => $request->input('offer_start_date'),
            'offer_end_date' => $request->input('offer_end_date'),
            'product_type' => $request->input('product_type'),
            'seo_title' => $request->input('seo_title'),
            'seo_description' => $request->input('seo_description'),
            'is_approved' => 1,
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

        /** Delte the main product image */
        $this->deleteImage($product->thumb_image);

        /** Delete product gallery images */
        $galleryImages = ProductImageGallery::where('product_id', $product->id)->get();
        foreach($galleryImages as $image){
            $this->deleteImage($image->image);
            $image->delete();
        }

        /** Delete product variants if exist */
        $variants = ProductVariant::where('product_id', $product->id)->get();

        foreach($variants as $variant){
            $variant->productVariantItems()->delete();
            $variant->delete();
        }

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

    public function getSubCategories(Request $request)
    {
        $subCategories = SubCategory::where('category_id', $request->id)->where('status', 1)->get();
        return $subCategories;
    }

    public function getChildCategories(Request $request)
    {
        $childCategories = ChildCategory::where('sub_category_id', $request->id)->where('status', 1)->get();
        return $childCategories;
    }
}
