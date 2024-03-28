<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Task ;
use App\Models\Assignment ;
use App\Services\ServiceInterfaces\ManagerTaskInterface;
use App\Services\ServiceImpl\ManagerTaskService;

class ManagerTaskController extends Controller
{
    private ManagerTaskInterface $managerTaskService ;
    public function __construct(ManagerTaskService $managerTaskService){
        $this->managerTaskService = $managerTaskService ;
    }
    function index()
    {
        $response = $this->managerTaskService->allTasks();
        return response()->json($response , 200);

    }

    function store(Request $request)
    {
        $validators = Validator::make($request->all() , [
            'title' => 'required' ,
            'description' => 'required' ,
            'due_to_date' => 'required' , 
        ]);
        if($validators->fails())
        {
            return response()->json([$validators->errors()], 400);
        }
       $response = $this->managerTaskService->store($request);
        return response()->json( $response , 200);

    }

    function update(Request $request , $id)
    {
        
        $validators = Validator::make($request->all() , [
            'title' => 'required' ,
            'description' => 'required' ,
            'due_to_date' => 'required' , 
        ]);
        if($validators->fails())
        {
            return response()->json([$validators->errors()], 400);
        }
        $response = $this->managerTaskService->update($request , $id);
       return response()->json($response , 200);

    }

    function destroy($id)
    {
        $response =  $this->managerTaskService->destroy($id);
        return response()->json($response, 200);
        
    }


    function assignTask(Request $request)
    {
        $validators = Validator::make($request->all() , [
            'task_id' => 'required' ,
            'user_id' => 'required' ,
        ]);
        if($validators->fails())
        {
            return response()->json([$validators->errors()], 400);
        }
        $response =  $this->managerTaskService->assignTask($request);
        return response()->json($response, 200);
    }
}
