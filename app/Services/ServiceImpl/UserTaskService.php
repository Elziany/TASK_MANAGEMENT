<?php 
namespace App\Services\ServiceImpl ;
use Illuminate\Http\Request;
use App\Services\ServiceInterfaces\UserTaskInterface ;
use App\Models\Task;
use App\Models\Assignment;
use Illuminate\Support\Facades\Auth;
class UserTaskService implements UserTaskInterface {
     function allTasks(){
        try{
            $user = auth()->user() ;
            $tasks = $user->tasks ;
            return $response = ['data' => $tasks];
        }catch(\Exception $ex){
            return response()->json([ 'message' => 'Internal Error Server' , 'exception' => $ex], 500);
        }
     }

     function updateStatus(Request $request , $id){
        try{
            $task = auth()->user()->tasks->where('id' , $id)->first();
            $task_dependencies = $task->dependencies->where('status' , 'pending');

            if($task == null){
                return response()->json([ 'message' => 'task not found'], 404);
            }
            if(count($task_dependencies) > 0){
                return response()->json([ 'message' => 'task cannot cannot be completed untill dependencies colmpleted first'], 400);
            }
            
            $task->update([
                'status' => $request->status
            ]);
            return $response = ['message' => 'status updated ' , 'data' => $task];
        }catch(\Exception $ex){
            return response()->json([ 'message' => 'Internal Error Server' , 'exception' => $ex], 500);
        }
       
     }
}