<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Assignment;
use Illuminate\Support\Facades\Validator;
use App\Services\ServiceInterfaces\UserTaskInterface;
use App\Services\ServiceImpl\UserTaskService;
class UserTaskController extends Controller
{
    private UserTaskInterface $userService ;
    function __construct(UserTaskService $userService){
        $this->userService = $userService;
    }
    function getAllTasks()
    {
        $response = $this->userService->allTasks();
       return response()->json( $response , 200);;
    }


    function updateStatus(Request $request , $id)
    {
        $validators =  Validator::make($request->all() , [
            'status' => 'required|string|in:pending,completed,canceled'
        ]);
        if($validators->fails())
        {
            return response()->json([$validators->errors()], 400);
        }
      $response = $this->userService->updateStatus($request , $id);
      return  response()->json($response , 200);
    }
}
