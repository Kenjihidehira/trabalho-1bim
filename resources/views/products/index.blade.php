<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; margin: 2rem; background: #f5f5f5; color: #222; }
        h1 { margin-bottom: 1.5rem; }
        .product { background: #fff; border-radius: 8px; padding: 1rem 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,.1); }
        .product h2 { margin: 0 0 .5rem; }
        table { width: 100%; border-collapse: collapse; margin-top: .75rem; }
        th, td { text-align: left; padding: .5rem; border-bottom: 1px solid #ddd; }
        th { background: #eee; }
        .empty { color: #777; font-style: italic; }
    </style>
</head>
<body>
    <h1>{{ $title }}</h1>

    @forelse ($products as $product)
        <div class="product">
            <h2>{{ $product->nome }}</h2>
            <p>
                <strong>Preço:</strong> R$ {{ number_format($product->preco, 2, ',', '.') }} |
                <strong>Unidade de medida:</strong> {{ $product->unidade_medida }}
            </p>

            @if ($product->itens->isEmpty())
                <p class="empty">Este produto não possui itens cadastrados.</p>
            @else
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Quantidade</th>
                            <th>Cor</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product->itens as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->quantidade }}</td>
                                <td>{{ $item->cor }}</td>
                                <td>R$ {{ number_format($item->valor, 2, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    @empty
        <p class="empty">Nenhum produto cadastrado.</p>
    @endforelse
</body>
</html>
