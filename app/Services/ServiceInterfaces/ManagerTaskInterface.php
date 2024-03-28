<?php
namespace App\Services\ServiceInterfaces;
use Illuminate\Http\Request;
interface ManagerTaskInterface{
function allTasks();
function store(Request $request);
function update(Request $request , $id);
function destroy($id);
function assignTask(Request $request);
}