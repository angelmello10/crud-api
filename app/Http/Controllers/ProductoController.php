<?php
namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Http\Requests\StoreProductoRequest;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductoController extends Controller
{
    public function index()
    {
        return Producto::with('categoria')->get();
    }

    public function show($id)
    {
        try {
            $producto = Producto::with('categoria')->findOrFail($id);
            return response()->json($producto, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['mensaje' => 'Producto no encontrado'], 404);
        }
    }

    public function store(StoreProductoRequest $request)
    {
        
        $categoria = Categoria::find($request->categoria_id);
        if (!$categoria) {
            return response()->json(['mensaje' => 'Categoría no válida'], 400);
        }

        $producto = Producto::create($request->validated());

        return response()->json([
            'mensaje' => 'Producto creado con éxito',
            'producto' => $producto
        ], 201);
    }

    public function update(StoreProductoRequest $request, $id)
    {
        try {
            $producto = Producto::findOrFail($id);

            
            $categoria = Categoria::find($request->categoria_id);
            if (!$categoria) {
                return response()->json(['mensaje' => 'Categoría no válida'], 400);
            }

            $producto->update($request->validated());

            return response()->json([
                'mensaje' => 'Producto actualizado con éxito',
                'producto' => $producto
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['mensaje' => 'Producto no encontrado'], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $producto = Producto::findOrFail($id);
            $producto->delete();

            return response()->json(['mensaje' => 'Producto eliminado con éxito'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['mensaje' => 'Producto no encontrado'], 404);
        }
    }
}
