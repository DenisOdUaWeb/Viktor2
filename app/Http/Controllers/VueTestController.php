<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VueTestController extends Controller
{
    public function index()  // FOR  API ROUTS NOT WEB ROUTS !!!
    {
        return [
            'name' => 'John Doe',
        ];
    }
}
