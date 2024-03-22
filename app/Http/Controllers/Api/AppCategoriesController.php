<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\AppCategoriesResource;
use App\Models\AppCategories;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class AppCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = AppCategories::orderBy('priority_id', 'ASC')
            ->orderBy('id', 'ASC')
            ->get();

        return response()->json([
            'data' => $categories,
            'message' => 'Successfully retrieved all categories',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // return $request->all();
            $request->validate([
                'name' => 'required|string|max:255|unique:tblapp_categories,name',
                'header_name' => 'required|string|max:255',
                'is_productive' => 'required|in:0,1,2',
                'priority_id' => 'required|in:0,1,2,3',
            ]);

            $category = AppCategories::create($request->all());
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage(),
            ], 400);
        }
        return response()->json([
            'data' => $category,
            'message' => 'Successfully retrieved category',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            Validator::validate(['id' => $id], [
                'id' => 'required|exists:tblapp_categories,id',
            ]);
            $category = AppCategories::findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage(),
            ], 400);
        }

        return response()->json([
            'data' => $category,
            'message' => 'Successfully retrieved category',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(string $id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $category = AppCategories::findOrFail($id);
            $category->update($request->all());
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage(),
            ], 400);
        }

        return response()->json([
            'message' => 'Successfully updated category',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Validator::validate(['id' => $id], [
                'id' => 'required|exists:tblapp_categories,id',
            ]);
            AppCategories::destroy($id);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage(),
            ], 400);
        }

        return response()->json([
            'message' => 'Successfully deleted category'
        ]);
    }
}
