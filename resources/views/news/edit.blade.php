<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Editar notícia</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/style.css">
</head>
<body>
<div class="container">

    <div class="topbar">
        <h1 class="title">Editar notícia</h1>
        <a class="btn" href="{{ route('web.news.index') }}">← Voltar</a>
    </div>

    <div class="card">
        <div class="card-body">

            @if ($errors->any())
                <div class="news-item" style="border-color:#fecaca; background:#fff;">
                    <strong style="color:#b91c1c;">Corrija os erros abaixo:</strong>
                    <ul style="margin:10px 0 0 18px; color:#b91c1c;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <hr class="sep">
            @endif

            <form method="POST" action="{{ route('web.news.update', $news) }}">
                @csrf
                @method('PUT')

                <div style="display:grid; grid-template-columns: 1fr 1fr; gap:12px;">
                    <div>
                        <label>Título</label>
                        <input name="title" value="{{ old('title', $news->title) }}" placeholder="Título da notícia">
                    </div>

                    <div>
                        <label>Tag</label>
                        <input name="tag" value="{{ old('tag', $news->tag) }}" placeholder="Ex: Tecnologia">
                    </div>
                </div>

                <div style="margin-top:12px;">
                    <label>Categoria</label>
                    <select name="category_id">
                        <option value="">Selecione...</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}"
                                @selected(old('category_id', $news->category_id) == $cat->id)>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div style="margin-top:12px;">
                    <label>Resumo</label>
                    <input name="summary" value="{{ old('summary', $news->summary) }}" placeholder="Resumo curto (1 frase)">
                </div>

                <div style="margin-top:12px;">
                    <label>Conteúdo</label>
                    <textarea name="content" rows="10" placeholder="Conteúdo completo...">{{ old('content', $news->content) }}</textarea>
                </div>

                <div class="actions" style="margin-top:14px;">
                    <button class="btn btn-primary" type="submit">Atualizar</button>
                    <a class="btn" href="{{ route('web.news.show', $news) }}">Ver</a>

                    <form method="POST" action="{{ route('web.news.destroy', $news) }}"
                          onsubmit="return confirm('Tem certeza que deseja apagar?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Apagar</button>
                    </form>
                </div>
            </form>

        </div>
    </div>

</div>
</body>
</html>
