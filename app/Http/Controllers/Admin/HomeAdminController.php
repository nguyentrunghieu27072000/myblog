<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeAdminController extends Controller
{
    public function index(){
        $data = array(
            'name'=> 'hello',
        );
        return view('layout/dash');
    }
}
