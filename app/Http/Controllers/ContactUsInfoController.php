<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactUsInfoController extends Controller
{
    public function info()
    {
        return view('contact-us.info');
    }
}
