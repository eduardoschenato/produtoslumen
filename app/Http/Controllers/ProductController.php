<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Product;

class ProductController extends Controller
{
    
    public function index()
    {
        $products = Product::all();

        return response()->json($products, 200);
    }
    
    public function show($id)
    {
        $product = Product::find($id);

        if(!$product) {
            return response()->json(['message' => 'Produto não encontrado no sistema'], 404);
        }
        
        return response()->json($product, 200);
    }
    
    public function store(Request $request)
    {
        $product = new Product();
        $product->category_id = $request->input('category_id');
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->quantity = $request->input('quantity');

        if (!$request->hasFile('url_image')) {
            $product->url_image = '';
        } else {
            $file = $request->file('url_image');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move("uploads/products", $fileName);

            $product->url_image = $fileName;
        }
        
        $success = $product->save();

        if(!$success)
        {
            return response()->json(['message' => 'Ocorreu um problema ao inserir o produto!'], 500);
        }

        return response()->json(['message' => 'Produto inserido com sucesso!'], 201);
    }
    
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if(!$product) {
            return response()->json(['message' => 'Produto não encontrado no sistema'], 404);
        }

        $product->category_id = $request->input('category_id');
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->quantity = $request->input('quantity');

        if ($request->hasFile('url_image')) {
            $file = $request->file('url_image');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move("uploads/products", $fileName);

            $product->url_image = $fileName;
        }
        
        $success = $product->save();

        if(!$success)
        {
            return response()->json(['message' => 'Ocorreu um problema ao alterar o produto!'], 500);
        }

        return response()->json(['message' => 'Produto alterado com sucesso!'], 200);
    }
    
    public function remove($id)
    {
        $product = Product::find($id);

        if(!$product) {
            return response()->json(['message' => 'Produto não encontrado no sistema'], 404);
        }
        
        $success = $product->delete();

        if(!$success)
        {
            return response()->json(['message' => 'Ocorreu um problema ao excluir o produto!'], 500);
        }

        return response()->json(['message' => 'Produto excluído com sucesso!'], 201);
    }

}
