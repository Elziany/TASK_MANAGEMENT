<?php
namespace App\Services\ServiceInterfaces;
use Illuminate\Http\Request;
interface AuthInterface{
function register(Request $request , $role);
function login(Request $request);
}