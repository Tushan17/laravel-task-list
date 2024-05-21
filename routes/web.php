<?php

use App\Http\Controllers\ChartJSController;
use App\Http\Requests\TaskRequest;
use App\Models\Graph;
use \App\Models\Task;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/






Route::get('/', function () {
    return redirect()->route('tasks.index');
});



Route::get('/tasks', function (){
    return view('index',[
        // 'tasks' => \App\Models\Task::latest()->where('completed', true)->get()
        // \App\Models\Task::select('id','title')->where('completed', true)->get()
        // 'tasks' => Task::latest()->get()

        'tasks' => Task::latest()->paginate(10)

    ]);
})->name('tasks.index');

Route::get('graph1', [ChartJSController::class,'chart'])->name('graph.test1');

Route::get('/graph', function(){
    $graphs = Graph::select('x','y')->orderBy('x')->get();
    $xarray =array();
    $yarray =array();


    foreach ($graphs as $graph) {
        array_push($xarray,$graph->x);
        array_push($yarray,$graph->y);
    }

    $xarr = json_encode($xarray);
    $yarr = json_encode($yarray);
    // dd($graphs);
    // dd($yarray);

    return view('graph',[
        'graphs'=>$graphs,
        'xarray'=>$xarr,
        'yarray'=>$yarr

    ]);

})->name('graph.test');

Route::view('/tasks/create','create')
->name('tasks.create');

Route::get('/tasks/{task}/edit',function(Task $task){
    return view('edit',[
        'task'=> $task
    ]);
})->name('tasks.edit');

Route::get('/tasks/{task}',function(Task $task){
    return view('show',[
        'task'=>$task
    ]);
})->name('tasks.show');


Route::post('/tasks',function(TaskRequest $request){
    // dd($request->all());
    // $data = $request->validated();


    // $task = new Task;
    // $task->title = $data['title'];
    // $task->description =$data['description'];
    // $task->long_description =$data['long_description'];

    // $task->save();

    $task = Task::create($request->validated());

    return redirect()->route('tasks.show',['task'=>$task->id])
    ->with('success','Task created succesfully');
})->name('tasks.store');


Route::put('/tasks/{task}',function(Task $task, TaskRequest $request){
    // dd($request->all());
    // $data = $request->validated();

    // $task->title = $data['title'];
    // $task->description =$data['description'];
    // $task->long_description =$data['long_description'];

    // $task->save();

    $task ->update($request->validated());

    return redirect()->route('tasks.show',['task'=>$task->id])
    ->with('success','Task Updated succesfully');
})->name('tasks.update');


Route::delete('/task/{task}',function(Task $task){
    $task->delete();

    return redirect()->route('tasks.index')
    ->with('success','Task deleted successfully');
})->name('tasks.destroy');


Route::put('tasks/{task}/toggle-complete', function(Task $task){
    $task->toggleComplete();

    return redirect()->back()->with('success','Task updated successfully!');
})->name('tasks.toggle-complete');



