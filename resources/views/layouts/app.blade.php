<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light">
    <title>@yield('title', 'Produtos e composição') · Catálogo</title>
    <link rel="icon" href="data:,">
    <link rel="stylesheet" href="{{ asset('css/catalog.css') }}">
</head>
<body>
    <a class="skip-link" href="#conteudo">Ir para o conteúdo</a>
    <header class="site-header">
        <div class="container header-content">
            <a class="brand" href="{{ route('products.index') }}" aria-label="Catálogo, todos os produtos">
                <span class="brand-mark" aria-hidden="true">C</span>
                Catálogo
            </a>
            <span class="header-label">Produtos e seus detalhes</span>
        </div>
    </header>
    <main id="conteudo" class="container" tabindex="-1">
        @yield('content')
    </main>
</body>
</html>
