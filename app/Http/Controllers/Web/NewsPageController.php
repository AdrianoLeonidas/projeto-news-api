<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;


class NewsPageController extends Controller
{
    /**
     * Lista de notícias com filtros + paginação
     */
    public function index(Request $request)
    {
        $query = News::query()->with(['category', 'user']);

        // filtro por categoria
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->integer('category_id'));
        }

        // filtro por tag
        if ($request->filled('tag')) {
            $query->where('tag', 'like', '%' . $request->string('tag') . '%');
        }

        // filtro por título
        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->string('title') . '%');
        }

        $news = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('news.index', compact('news', 'categories'));
    }

    /**
     * Visualizar uma notícia
     */
    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }

    /**
     * Formulário de criação
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('news.create', compact('categories'));
    }

    /**
     * Salvar nova notícia
     */
   public function store(StoreNewsRequest $request)
{
    $data = $request->validated();
    $data['user_id'] = auth()->id();

    \App\Models\News::create($data);

    return redirect()->route('web.news.index')->with('success', 'Notícia criada com sucesso!');
}


    /**
     * Formulário de edição
     */
    public function edit(News $news)
    {
        $this->authorize('update', $news);

        $categories = Category::orderBy('name')->get();

        return view('news.edit', compact('news', 'categories'));
    }

    /**
     * Atualizar notícia
     */
   public function update(UpdateNewsRequest $request, \App\Models\News $news)
{
    $this->authorize('update', $news);

    $news->update($request->validated());

    return redirect()->route('web.news.index')->with('success', 'Notícia atualizada com sucesso!');
}

    /**
     * Deletar notícia
     */
    public function destroy(News $news)
    {
        $this->authorize('delete', $news);

        $news->delete();

        return redirect()
            ->route('web.news.index')
            ->with('success', 'Notícia deletada com sucesso!');
    }
}
