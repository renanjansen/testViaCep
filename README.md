# AddressController API

Esta API permite buscar informações de endereços para múltiplos CEPs, usando a API ViaCEP.

## Endpoints

### `GET /api/search/local/{ceps}`

Busca informações de endereços para um ou mais CEPs.

#### Parâmetros

- `ceps`: Uma string contendo um ou mais CEPs separados por vírgulas. Exemplo: `17560246,01001000,22770370`

#### Exemplo de Requisição

```http
GET /api/search/local/17560246,01001000,22770370 HTTP/1.1
Host: localhost
