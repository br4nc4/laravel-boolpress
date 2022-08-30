<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request){
        $data = $request->all();

        //dovrebbe salavare i dati a database in una tabella contacts

        return $data;
    }
}
