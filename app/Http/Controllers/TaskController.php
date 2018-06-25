<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $task = Task::orderBy('id', 'DESC')->paginate(8);

        return response()->json([
            'paginate' => [
                'total'         =>  $task->total(),
                'current_page'  =>  $task->currentPage(),
                'per_page'      =>  $task->perPage(),
                'last_page'     =>  $task->lastPage(),
                'from'          =>  $task->firstItem(),
                'to'            =>  $task->lastPage()
            ],

            'tasks' => $task

            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Form create
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = Task::create($request->all());

        return response()->json(["success" => "Task created successfully."]);
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);

        return response()->json($task);
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
        $patch = Task::find($id);

        $task = $patch->update(["keep" => $request->keep]);

        return response()->json(["success" => "Task updated successfully."]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::destroy($id);

        return response()->json(["success" => "Task deleted successfully."]);
    }
}
