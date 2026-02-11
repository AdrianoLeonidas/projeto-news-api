<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;


class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::query()->with(['category', 'user']);

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->integer('category_id'));
        }

        if ($request->filled('tag')) {
            $query->where('tag', 'like', '%' . $request->string('tag') . '%');
        }

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->string('title') . '%');
        }

        $perPage = (int) $request->query('per_page', 10);
        $perPage = max(1, min(50, $perPage)); // trava pra não explodir

        return response()->json(
            $query->latest()->paginate($perPage)->withQueryString()
        );
    }

    public function store(StoreNewsRequest $request)
{
    $data = $request->validated();
    $data['user_id'] = $request->user()->id;

    $news = \App\Models\News::create($data);

    return response()->json($news->load(['category', 'user']), 201);
}

    public function show(News $news)
    {
        return response()->json($news->load(['category', 'user']));
    }

    public function update(UpdateNewsRequest $request, \App\Models\News $news)
{
    $this->authorize('update', $news);

    $data = $request->validated();
    $news->update($data);

    return response()->json($news->load(['category', 'user']));
}


    public function destroy(News $news)
    {
        $this->authorize('delete', $news);

        $news->delete();

        return response()->json(['message' => 'Notícia deletada com sucesso.']);
    }
}
