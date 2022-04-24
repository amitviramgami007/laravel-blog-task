<?php

use App\Models\User;
use Illuminate\Support\Facades\Request;

function setActive($routeName, $active = 'active')
{
    return Request::segment(1) == $routeName ? $active : '';
}

function getUserName($userId)
{
    return User::where('id', $userId)->value('name');
}

function getTotalCount($modelName)
{
    $modelName = "App\\Models\\".$modelName;
    return $modelName::count();
}
