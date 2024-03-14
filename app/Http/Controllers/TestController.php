<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    public function main (Request $request) {
        return "main page";
    }

    public function admin (Request $request) {
        return "Authenticated Admin Page";
    }

    public function supervisor (Request $request) {
        return "Authenticated Supervisor Page";
    }

    public function user (Request $request) {
        return "Authenticated User Page";
    }
}
