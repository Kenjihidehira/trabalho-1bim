@extends('layouts.app')

@section('title', 'Página não encontrada')

@section('content')
    <div class="empty-state">
        <p class="eyebrow">Erro 404</p>
        <h1>Página não encontrada</h1>
        <p>O produto ou endereço informado não está disponível.</p>
        <a class="back-link" href="{{ route('products.index') }}">Voltar para os produtos</a>
    </div>
@endsection
