<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends ApiController
{

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $categories = Category::all();

        return $this->successResponse($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return JsonResponse
     */
    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->all());

        return $this->successResponse($category, 'Category created successfully', Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function show(Category $category)
    {
        return $this->successResponse($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param Category $category
     * @return JsonResponse
     * @throws \Exception
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->fill($request->all());

        if($category->isClean()){
            throw new \Exception("Debe especificar al menos un valor diferente para actualizar", Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $category->save();

        return $this->successResponse($category, 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return $this->successResponse($category);
    }
}
