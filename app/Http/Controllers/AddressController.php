<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;


class AddressController extends Controller
{
    public function searchByCep($ceps)
    {
        $cepList = explode(',', $ceps);
        $client = new Client();
        $results = [];

        foreach ($cepList as $cep) {
            $url = "https://viacep.com.br/ws/{$cep}/json/";
            $response = $client->request('GET', $url);
            $data = json_decode($response->getBody(), true);

            if (isset($data['erro']) && $data['erro']) {
                // Handle error for invalid CEP
                continue;
            }

            $results[] = $this->reorganizaData($data);
        }

        return response()->json($results);
    }

    public function reorganizaData($data)
    {
        return [
            'cep' => $data['cep'],
            'label' => $data['logradouro'] . ', ' . $data['localidade'],
            'logradouro' => $data['logradouro'],
            'complemento' => $data['complemento'],
            'bairro' => $data['bairro'],
            'localidade' => $data['localidade'],
            'uf' => $data['uf'],
            'ibge' => $data['ibge'],
            'gia' => $data['gia'],
            'ddd' => $data['ddd'],
            'siafi' => $data['siafi'],
        ];
    }
}
