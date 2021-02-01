<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ローカル変数todosにTodoModel.all()の結果を渡す
        $todos = Todo::all();

        Log::debug('this is debug!!');

        // 戻り値：todo>index.blade.phpとtodos変数
        return view('todo.index', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('todo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $todo = new Todo();
        $todo->title = $request->input('title');
        $todo->save();

        return redirect('todos')->with(
            'resultMessage',
            '「'.$todo->title.'」を登録しました!'
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // find(id)で1件取得してtodoに代入
        $todo = Todo::find($id);

        return view('todo.show', compact('todo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // find(id)で1件取得してtodoに代入
        $todo = Todo::find($id);

        return view('todo.edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 更新処理
        $todo = Todo::find($id);

        $todo->title = $request->input('title');
        $todo->save();

        return redirect('todos')->with(
            'resultMessage',
            '「'.$todo->title.'」に更新しました!'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 削除処理
        $todo = Todo::find($id);
        $todo->delete();

        return redirect('todos')->with(
            'resultMessage',
            '「'.$todo->title.'」を削除しました!'
        );
    }
}
