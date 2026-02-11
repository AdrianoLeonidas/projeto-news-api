<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>{{ $news->title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/style.css">
</head>
<body>
<div class="container">

    <div class="topbar">
        <h1 class="title">{{ $news->title }}</h1>
        <a class="btn" href="{{ route('web.news.index') }}">← Voltar</a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="meta">
                <span class="badge">Categoria: {{ $news->category->name ?? '-' }}</span>
                <span class="badge">Tag: {{ $news->tag }}</span>
                <span class="badge">Autor: {{ $news->user->name ?? '—' }}</span>
                <span class="badge">Criado: {{ $news->created_at?->format('d/m/Y H:i') }}</span>
            </div>

            <p class="summary"><strong>Resumo:</strong> {{ $news->summary }}</p>

            <hr class="sep">

            <div class="content">{{ $news->content }}</div>

            <hr class="sep">

            <div class="actions">
                <a class="btn" href="{{ route('web.news.edit', $news) }}">Editar</a>
                <form method="POST" action="{{ route('web.news.destroy', $news) }}"
                      onsubmit="return confirm('Tem certeza que deseja apagar?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Apagar</button>
                </form>
            </div>

        </div>
    </div>

</div>
</body>
</html>
