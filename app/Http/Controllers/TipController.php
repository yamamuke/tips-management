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
    public function index() {
        $tips = Auth::user()->tips;

        return view('tips.index', compact('tips'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('tips.create');
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
            // 'category' => 'required',
        ]);

        $tip = new Tip();
        $tip->title = $request->input('title');
        $tip->category_id = $request->input('category_id');
        $tip->content = $request->input('content');
        $tip->user_id = Auth::id();
        $tip->save();

        return redirect()->route('tips.index')->with('flash_message', 'Tipを追加しました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tip  $tip
     * @return \Illuminate\Http\Response
     */
    public function show(Tip $tip) {
        // $categories = CategoryTip::where('id', tip->category_tip_id);

        return view('tips.show', compact('tip'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tip  $tip
     * @return \Illuminate\Http\Response
     */
    public function edit(Tip $tip) {
        return view('tips.edit', compact('tip'));
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
            'category => required',
        ]);

        $tip->title = $request->input('title');
        $tip->category_id = $request->input('category_id');
        $tip->content = $request->input('content');
        $tip->save();

        return redirect()->route('tips.show', $tip)->with('flash_message', 'Tipを編集しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tip  $tip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tip $tip) {
        $tip->delete();

        return redirect()->route('tips.index')->with('flash_message', 'Tipを削除しました。');
    }
}
