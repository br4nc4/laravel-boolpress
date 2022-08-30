<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //middleware è un sistema che intercetta qualsiasi richiesta fatta al mio server
        //stabilisce se l'utente ha i permessi per portare a termine le richieste fatte.
        //si può usare nel controller, ma anche nel file delle rotte web.php
        //qualsiasi funzione presente in questo controller avrà il controllo del middleware
        //$this->middleware('auth');
    }

    public function index(){
        return view("admin.index");
    }
}
