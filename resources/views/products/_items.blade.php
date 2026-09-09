@if ($product->itens->isEmpty())
    <p class="empty-items">Nenhum item de composição cadastrado para este produto.</p>
@else
    <div class="table-wrapper">
        <table>
            <caption class="sr-only">Itens de composição de {{ $product->nome }}</caption>
            <thead>
                <tr>
                    <th scope="col">Item</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Cor</th>
                    <th scope="col" class="align-right">Valor</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($product->itens as $item)
                    <tr>
                        <th scope="row">#{{ str_pad($item->id, 3, '0', STR_PAD_LEFT) }}</th>
                        <td>{{ rtrim(rtrim(number_format((float) $item->quantidade, 3, ',', '.'), '0'), ',') }}</td>
                        <td>{{ $item->cor }}</td>
                        <td class="align-right money">R$ {{ number_format((float) $item->valor, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
