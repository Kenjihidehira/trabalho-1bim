@extends('layouts.app')

@section('title', $product->nome)

@section('content')
    <a class="back-link" href="{{ route('products.index') }}"><span aria-hidden="true">←</span> Todos os produtos</a>
    <div class="page-heading detail-heading">
        <div>
            <p class="eyebrow">Detalhes do produto</p>
            <h1>{{ $product->nome }}</h1>
            <p class="page-description">Unidade de medida: <strong>{{ $product->unidade_medida }}</strong></p>
        </div>
        <div class="product-price">
            <span>Preço de venda</span>
            <strong>R$ {{ number_format((float) $product->preco, 2, ',', '.') }}</strong>
        </div>
    </div>
    <section class="product-card" aria-labelledby="itens-heading">
        <div class="section-heading">
            <h2 id="itens-heading">Itens de composição</h2>
            <span class="count-badge">{{ $product->itens->count() }} {{ $product->itens->count() === 1 ? 'item' : 'itens' }}</span>
        </div>
        @include('products._items', ['product' => $product])
    </section>
@endsection
