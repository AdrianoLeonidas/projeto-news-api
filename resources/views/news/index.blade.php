<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Notícias</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/style.css">
</head>
<body>
<div class="container">

    <div class="topbar">
        <h1 class="title">Notícias</h1>

        <div style="display:flex; gap:10px; align-items:center;">
            <a class="btn btn-primary" href="{{ route('web.news.create') }}">+ Nova notícia</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-ghost" type="submit">Sair</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <strong>Filtros</strong>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('web.news.index') }}" class="filters">
                <div>
                    <label>Categoria</label>
                    <select name="category_id">
                        <option value="">Todas</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" @selected(request('category_id') == $cat->id)>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label>Tag</label>
                    <input name="tag" value="{{ request('tag') }}" placeholder="Ex: Tecnologia">
                </div>

                <div>
                    <label>Título</label>
                    <input name="title" value="{{ request('title') }}" placeholder="Buscar por título...">
                </div>

                <div>
                    <button class="btn btn-primary" type="submit">Filtrar</button>
                </div>
            </form>

            <hr class="sep">

            <div class="news-list">
                @forelse($news as $item)
                    <div class="news-item">
                        <h3>{{ $item->title }}</h3>

                        <div class="meta">
                            <span class="badge">Categoria: {{ $item->category->name ?? '-' }}</span>
                            <span class="badge">Tag: {{ $item->tag }}</span>
                            <span class="badge">Autor: {{ $item->user->name ?? '—' }}</span>
                        </div>

                        <p class="summary">{{ $item->summary }}</p>

                        <div class="actions">
                            <a class="btn" href="{{ route('web.news.show', $item) }}">Ver</a>
                            <a class="btn" href="{{ route('web.news.edit', $item) }}">Editar</a>

                            <form method="POST" action="{{ route('web.news.destroy', $item) }}"
                                  onsubmit="return confirm('Tem certeza que deseja apagar?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Apagar</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="news-item">
                        <strong>Nenhuma notícia encontrada.</strong>
                        <div class="meta">Tente ajustar os filtros.</div>
                    </div>
                @endforelse
            </div>

            <div style="margin-top:16px;">
                {{ $news->withQueryString()->links() }}
            </div>
        </div>
    </div>

</div>
</body>
</html>
