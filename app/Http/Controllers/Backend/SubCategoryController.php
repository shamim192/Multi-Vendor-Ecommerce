<?php

namespace App\Http\Controllers\Backend;

use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\SubCategoryDataTable;
use App\Models\Category;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SubCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.sub-category.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', 1)->orderBy('name', 'asc')->get();

        return view('admin.sub-category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required|max:200|unique:sub_categories,name',
            'status' => 'required',
        ]);

        SubCategory::create([
            'category_id' => $request->input('category_id'),
            'name' => $request->input('name'),
            'slug' => Str::slug($request->name),
            'status' => $request->input('status'),
        ]);

        toastr()->success('Sub Category was successfully stored!');

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
        $subCategory = SubCategory::findOrFail($id);
        $categories = Category::where('status', 1)->orderBy('name', 'asc')->get();

        return view('admin.sub-category.edit', compact('subCategory','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required|max:200|unique:sub_categories,name,' . $id,
            'status' => 'required',
        ]);

        $subCategory = SubCategory::findOrFail($id);

        $subCategory->update([
            'category_id' => $request->input('category_id'),
            'name' => $request->input('name'),
            'slug' => Str::slug($request->name),
            'status' => $request->input('status'),
        ]);

        toastr()->success('Sub Category was successfully Updated!');

        return redirect()->action([self::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subCategory = SubCategory::findOrFail($id);

        $subCategory->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function changeStatus(Request $request)
    {

        $subCategory = SubCategory::findOrFail($request->id);
        $subCategory->status = $request->status == 'true' ? 1 : 0;
        $subCategory->save();

        return response(['message' => 'Status has been updated!']);
    }
}
