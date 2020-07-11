<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Category;

class CategoryController extends Controller
{
    
    public function index()
    {
        $categories = Category::all();

        return response()->json($categories, 200);
    }
    
    public function show($id)
    {
        $category = Category::find($id);

        if(!$category) {
            return response()->json(['message' => 'Categoria não encontrada no sistema'], 404);
        }
        
        return response()->json($category, 200);
    }
    
    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->input('name');
        
        $success = $category->save();

        if(!$success)
        {
            return response()->json(['message' => 'Ocorreu um problema ao inserir a categoria!'], 500);
        }

        return response()->json(['message' => 'Categoria inserida com sucesso!'], 201);
    }
    
    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if(!$category) {
            return response()->json(['message' => 'Categoria não encontrada no sistema'], 404);
        }

        $category->name = $request->input('name');
        
        $success = $category->save();

        if(!$success)
        {
            return response()->json(['message' => 'Ocorreu um problema ao alterar a categoria!'], 500);
        }

        return response()->json(['message' => 'Categoria alterada com sucesso!'], 200);
    }
    
    public function remove($id)
    {
        $category = Category::find($id);

        if(!$category) {
            return response()->json(['message' => 'Categoria não encontrada no sistema'], 404);
        }
        
        $success = $category->delete();

        if(!$success)
        {
            return response()->json(['message' => 'Ocorreu um problema ao excluir a categoria!'], 500);
        }

        return response()->json(['message' => 'Categoria excluída com sucesso!'], 201);
    }

}
