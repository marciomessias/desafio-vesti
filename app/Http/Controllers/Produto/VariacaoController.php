<?php

namespace App\Http\Controllers\Produto;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Variacao;

class VariacaoController extends Controller
{
    public static function cadastrarVariacoes(Request $request)
    {
        try {

            $variacoes = $request->all();

            foreach ($variacoes as $variacao) {

                if (Variacao::where('variacao', $variacao['variacao'])->first()) {
                    continue;
                }

                $variacao['produto_referencia'] = explode('_' , $variacao['variacao'])[0];

                Variacao::create(
                    $variacao
                );
            }

            return response()->json([
                'status' => 'Variações cadastradas com sucesso e vinculadas aos produtos'
            ]);

        } catch (\Throwable $th) {
            
            return response()->json([
                'status'  => 'Erro ao cadastrar as variações',
                'message' => $th->getMessage()
            ]);
        }
        
    }
}
