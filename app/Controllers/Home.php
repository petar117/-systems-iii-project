<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        echo view('templates/header');
        echo view('welcome_message');
        echo view('templates/footer');
    }
}
