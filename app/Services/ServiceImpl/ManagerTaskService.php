<?php 
namespace App\Services\ServiceImpl ;
use Illuminate\Http\Request;
use App\Services\ServiceInterfaces\ManagerTaskInterface ;
use App\Models\Task;
use App\Models\Assignment;
use Illuminate\Support\Facades\Auth;
class ManagerTaskService implements ManagerTaskInterface {

    public function allTasks()
    {
        $tasks = Task::orderBy('created_at' , 'desc')->get();
        return $response = ['data' => $tasks] ;
    }

    public function store(Request $request){
        try{
            $task = Task::create([
                'user_id' => auth()->user()->id,
                'title' => $request->title ,
                'description' => $request->description ,
                'due_to_date' => $request->due_to_date ,
                'status' => 'pending'
            ]);
           return $reponse = ['data' => $task] ;
        }catch(\Exception $ex){
            return response()->json([ 'message' => 'Internal Error Server' , 'exception' => $ex], 500);

        }
    }

    function update(Request $request , $id){
        try{
            $task = Task::find($id);
            if($task == null)
            {              
              return response()->json(['message' => 'task Not found'] , 404);
            }
            $task->update([
                'user_id' => auth()->user()->id,
                'title' => $request->title ,
                'description' => $request->description ,
                'due_to_date' => $request->due_to_date ,
                'status' => 'pending'
            ]);
            return $response = ['data' => $task , 'message' => 'task updated successfully'];
        }catch(\Exception $ex){
            return response()->json([ 'message' => 'Internal Error Server' , 'exception' => $ex], 500);
        }
    }

    function destroy($id){
        try{
            $task = Task::find($id);
            if($task != null)
            {
                $task->delete();
                return $response = ['message' => 'deleted successfully'] ;
            }
                
            else {
                return response()->json(['message' => 'task Not found'] , 404);

            }

        }
        catch(\Exception $ex){
            return response()->json([ 'message' => 'Internal Error Server' , 'exception' => $ex], 500);
        }
    }

    function assignTask(Request $request){
        try{
            $assignment = Assignment::create([
                'task_id' => $request->task_id ,
                'user_id' => $request->user_id ,
            ]);

            return $response = ['data' => $assignment , 'message' => 'task assigned successfully'];
           
        } catch(\Exception $ex){
            return response()->json([ 'message' => 'Internal Error Server' , 'exception' => $ex], 500);
        }
    }
}
