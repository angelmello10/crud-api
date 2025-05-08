<?php
namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    
    public function index()
    {
        return Categoria::all();
    }

    
    public function store(Request $request)
    {
        
        $request->validate([
            'nombre' => 'required|string|unique:categorias,nombre',
        ]);

        
        $categoria = Categoria::create([
            'nombre' => $request->nombre,
        ]);

        return response()->json($categoria, 201);
    }

    
    public function destroy($id)
    {
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return response()->json(['message' => 'Categoría no encontrada'], 404);
        }

        
        if ($categoria->productos()->count() > 0) {
            return response()->json(['message' => 'No se puede eliminar. La categoría tiene productos asociados.'], 400);
        }

        
        $categoria->delete();

        return response()->json(['message' => 'Categoría eliminada correctamente.']);
    }
}
