<?php

namespace App\Http\Controllers\Produto;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutoController extends Controller
{
    public static function cadastrarProdutos(Request $request)
    {
        try {

            $produtos = $request->all();

            foreach ($produtos as $produto) {

                if (Produto::where('referencia', $produto['referencia'])->first()) {
                    continue;
                }

                Produto::create(
                    $produto
                );
            }

            return response()->json([
                'status' => 'Novos produtos cadastrados com sucesso'
            ]);

        } catch (\Throwable $th) {
            
            return response()->json([
                'status'  => 'Erro ao cadastrar os produtos',
                'message' => $th->getMessage()
            ]);
        }
        
    }
}
