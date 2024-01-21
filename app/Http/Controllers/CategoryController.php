<?php

namespace App\Http\Controllers;
use Exception;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Manager\ImageUploadManager;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

 
    
    public function store(StoreCategoryRequest $request)
    {
        try {
            $category = $request->except('photo');
            $category['slug'] = Str::slug($request->input('slug'));
            $category['user_id'] = auth()->id();
            if($request->has('photo')){
                $file = $request->input('photo');
                $width =400;
                $height =400;
                $width_thumb =150;
                $height_thumb =150;
                $name = Str::slug($request->input('slug'));
                $path = 'images/uploads/category/';
                $path_thumb ='images/uploads/category_thumb/';
                $category['photo']= ImageUploadManager::uploadImage($name, $width, $height, $path, $file);
                $category['photo']= ImageUploadManager::uploadImage($name, $width_thumb, $height_thumb, $path_thumb, $file);
            }
            $categories = (new Category())->storeCategory($category);
            return response()->json(['msg'=>'Category Created Succcessfully', 'cls'=>'success']);

        } catch (Exception $e) {

            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect']
            ]);
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
     
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
