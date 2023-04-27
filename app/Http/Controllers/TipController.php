<?php

namespace App\Http\Controllers;

use App\Models\Tip;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $categories = Auth::user()->categories;
        // カテゴリー検索のプルダウンをカテゴリー名の昇順にするため
        $ctgry_collection = Auth::user()->categories()->orderBy('name', 'asc')->get();
        // 並び替え結果とキーワード検索の結果を相互に保持しながら実行
        if (isset($_GET['sort'])) {$sort = $_GET['sort'];} else {$sort = 'desc';}
        if (isset($_GET['keyword'])) {$keyword = $_GET['keyword'];} else {$keyword = null;}
        $tips = Auth::user()->tips()->orderBy('updated_at', $sort)->
            where('content', 'like', "%$keyword%")->get();
        
        // カテゴリー検索機能（並び替え順を維持）
        if (isset($_GET['selected_category'])) {
            $selected_category = $_GET['selected_category'];
            $tips = $categories->find($selected_category)->
                tips()->orderBy('updated_at', $sort)->get();
        } else {
            $selected_category = null;
        }

        return view('tips.index', compact(
            'tips', 'categories', 'sort', 'keyword', 'ctgry_collection', 'selected_category'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $categories = Auth::user()->categories();

        return view('tips.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $tip = new Tip();
        $tip->title = $request->input('title');
        $tip->content = $request->input('content');
        $tip->user_id = Auth::id();
        $tip->save();

        $tip->categories()->sync($request->input('category_ids'));

        return redirect()->route('tips.index')->with('flash_message', '「' . $tip->title . '」を追加しました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tip  $tip
     * @return \Illuminate\Http\Response
     */
    public function show(Tip $tip) {
        $categories = Auth::user()->categories();

        return view('tips.show', compact('tip', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tip  $tip
     * @return \Illuminate\Http\Response
     */
    public function edit(Tip $tip) {
        $categories = Auth::user()->categories();

        return view('tips.edit', compact('tip', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tip  $tip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tip $tip) {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $tip->title = $request->input('title');
        $tip->content = $request->input('content');
        $tip->save();

        $tip->categories()->sync($request->input('category_ids'));
        
        return redirect()->route('tips.show', $tip)->with('flash_message', '「' . $tip->title . '」を編集しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tip  $tip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tip $tip) {
        $tip->delete();

        return redirect()->route('tips.index')->with('flash_message', '「' . $tip->title . '」を削除しました。');
    }
}
