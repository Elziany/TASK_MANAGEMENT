<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task ;
use App\Models\TaskDependencies ;
use Illuminate\Support\Facades\Validator;
use App\Services\ServiceInterfaces\DependencyInterface;
use App\Services\ServiceImpl\DependencyService;
class TaskDependency extends Controller
{
    private DependencyInterface $dependencyService ;
    function __construct(DependencyService $dependencyService){
        $this->dependencyService = $dependencyService;
    }
    function getAllDependencies($task_id){
        $response = $this->dependencyService->getAll($task_id);
       return response()->json($response , 200);
    }

    function addDependenicesTask(Request $request){
        $validators = Validator::make($request->all() , [
            'task_id' => 'required' ,
            'depends_on_task_id' => 'required' ,
        ]);
        if($validators->fails())
        {
            return response()->json([$validators->errors()], 400);
        }
        $response = $this->dependencyService->addDependency($request);
        return response()->json($response , 200);

    }
}
