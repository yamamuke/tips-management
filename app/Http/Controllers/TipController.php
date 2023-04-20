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
        // 更新日時順のソート機能
        if (isset($_GET['sort'])) {
            if ($_GET['sort'] === 'asc') {
                $tips = Auth::user()->tips()->orderBy('updated_at', 'asc')->get();
            } else {
                $tips = Auth::user()->tips()->orderBy('updated_at', 'desc')->get();
            }
        } else {
            $tips = Auth::user()->tips()->orderBy('updated_at', 'desc')->get();
        }
        
        // キーワード検索機能
        if (isset($_GET['keyword'])) {
            $keyword = $_GET['keyword'];
            $tips = Auth::user()->tips()->where('content', 'like', "%$keyword%")->get();
        } else {
            $keyword = NULL;
        }

        $categories = Auth::user()->categories;

        return view('tips.index', compact('tips', 'categories', 'keyword'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $categories = Auth::user()->categories;

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
        $categories = Auth::user()->categories;

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
