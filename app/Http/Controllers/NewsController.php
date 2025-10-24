<?php

namespace App\Http\Controllers;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        // Lấy tin mới nhất, phân trang
        $news = News::latest()->paginate(6);

        // Truyền sang view
        return view('news.index', compact('news'));
    }

    public function show($id)
    {
        $item = News::findOrFail($id);
        return view('news.show', compact('item'));
    }
}
