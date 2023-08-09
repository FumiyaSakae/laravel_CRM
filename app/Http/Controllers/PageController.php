<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\topPage;

class PageController extends Controller
{
    public function index(){
        return Inertia::render('top/index', [
            'blogs' => topPage::all()
        ]);
    }

    public function create(){
        return Inertia::render('top/create');
    }

    public function show($id){
        return Inertia::render('top/show',
        [
            'id' => $id,
            'blog' => topPage::findOrFail($id)
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:20'],
            'content' =>['required']
        ]);
        $topPage = new topPage;
        $topPage->title = $request->title;
        $topPage->content = $request->content;
        $topPage->save();

        return to_route('topPage.index')
        ->with([
            'message' => '登録しました。'
        ]);
    }

    public function delete($id){
        $book = topPage::findOrFail($id);
        $book->delete();
        return to_route('topPage.index')
        ->with([
            'message' => '削除しました'
        ]);
    }
}
