<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Produto;

class IntegrarProdutosVariacoes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:integrar-produtos-variacoes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enviar produtos e suas variações para a API da Vesti';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Produto::where('integrado', false)->each(function ($produto) {

            if ((count($produto->variacao)) > 0) {
                $data = $this->prepareData($produto);

                if ($this->callApi($data)) {
                    $produto->integrado = true;
                    $produto->save();

                    // Log para monitoramento no terminal dos produtos sendo integrados
                    error_log('Integrado o produto ' . $produto->nome . ' referencia ' . $produto->referencia);
                }
            }
        });
    }

    private function prepareData($produto)
    {
        $produtos['products'] = [
            'integration_id' => $produto['referencia'],
            'code' => $produto['referencia'],
            'name' => $produto['nome'],
            'description' => $produto['descricao'],
            'price' => $produto['preco'],
            'promotion' => $produto['promocao'],
            'composition' => $produto['composicao'],
            'brand' => $produto['marca'],
        ];

        foreach ($produto->variacao as $variation) {
            $produtos['products']['variants'][] = [
                'sku' => $variation['variacao'],
                'size' => $variation['tamanho'],
                'color' => $variation['cor'],
                'quantity' => $variation['quantidade'],
                'order' => $variation['unidade'],
                'unit_type' => $variation['ordem'],
            ];
        }

        return $produtos;
    }

    private function callApi($data)
    {
        $url = getenv('API_URL');
        $apikey = getenv('API_KEY');
        $company_id = getenv('COMPANY_ID');

        $res = Http::post("$url/v1/products/company/$company_id", [
            'headers' => [
                'apikey'   => $apikey,
                'Content-Type'    => 'application/json'
            ],
            'data' => $data
        ]);

        // return true;
        // Ao retornar código 200 será atualizado o produto para integrado true
        return $res->getStatusCode() == 200;
    }
}
