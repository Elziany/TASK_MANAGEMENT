<?php
namespace App\Services\ServiceInterfaces;
use Illuminate\Http\Request;
interface UserTaskInterface{
function allTasks();
function updateStatus(Request $request , $id);
}