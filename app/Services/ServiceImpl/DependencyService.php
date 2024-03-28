<?php 
namespace App\Services\ServiceImpl ;
use Illuminate\Http\Request;
use App\Services\ServiceInterfaces\DependencyInterface;
use App\Models\Task;
use App\Models\Assignment;
use App\Models\TaskDependencies;
use Illuminate\Support\Facades\Auth;
class DependencyService implements DependencyInterface {
    function getAll($task_id){
        $task = Task::find($task_id);
        if($task == null)
        {              
          return response()->json(['message' => 'task Not found'] , 404);
        }
        $response = $task->dependencies ;
        return $response ;
    }
    
function addDependency(Request $request){
    try{
        $taskDependency = TaskDependencies::create([
         'task_id' => $request->task_id ,
         'depends_on_task_id' => $request->depends_on_task_id ,
        ]) ;
        $response = ['message' => 'task dependency added successfully' , 'data' => $taskDependency];
        return $response;
     }catch(\Exception $ex){
         return response()->json([ 'message' => 'Internal Error Server' , 'exception' => $ex], 500);
     }
}
}