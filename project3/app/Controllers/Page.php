<?php

namespace App\Controllers;

class Page extends BaseController
{
    public function index(): string
    {
        return view('page');
    }
}
