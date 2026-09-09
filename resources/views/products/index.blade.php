@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">Consulta de produtos</p>
            <h1>Produtos e composição</h1>
            <p class="page-description">Consulte os preços, as unidades de medida e os itens de cada produto.</p>
        </div>
        <span class="count-badge">{{ $products->count() }} {{ $products->count() === 1 ? 'produto' : 'produtos' }}</span>
    </div>

    <div class="product-list">
        @forelse ($products as $product)
            <article class="product-card" aria-labelledby="produto-{{ $product->id }}">
                <div class="product-heading">
                    <div>
                        <p class="product-code">Produto #{{ str_pad($product->id, 3, '0', STR_PAD_LEFT) }}</p>
                        <h2 id="produto-{{ $product->id }}">{{ $product->nome }}</h2>
                        <p class="product-unit">Unidade de medida: <strong>{{ $product->unidade_medida }}</strong></p>
                    </div>
                    <div class="product-price">
                        <span>Preço de venda</span>
                        <strong>R$ {{ number_format((float) $product->preco, 2, ',', '.') }}</strong>
                    </div>
                </div>
                <details class="composition" open>
                    <summary>
                        <span>Itens de composição <span class="item-count">{{ $product->itens->count() }}</span></span>
                        <span class="chevron" aria-hidden="true"></span>
                    </summary>
                    @include('products._items', ['product' => $product])
                </details>
                <div class="product-footer">
                    <a href="{{ route('products.items.index', $product) }}" aria-label="Ver detalhes de {{ $product->nome }}">Ver detalhes <span aria-hidden="true">→</span></a>
                </div>
            </article>
        @empty
            <div class="empty-state">
                <h2>Nenhum produto cadastrado</h2>
                <p>Os produtos e seus itens aparecerão aqui quando houver registros no catálogo.</p>
            </div>
        @endforelse
    </div>
@endsection
