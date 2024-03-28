<?php
namespace App\Services\ServiceInterfaces;
use Illuminate\Http\Request;
interface DependencyInterface{
function getAll($task_id);
function addDependency(Request $request);
}