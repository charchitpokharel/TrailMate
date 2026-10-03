<?php

namespace App\Controllers;

use App\Models\TrailModel;

class Home extends BaseController
{
    public function index()
    {
        $trails = (new TrailModel())->orderBy('created_at', 'DESC')->findAll(6);
        return view('layouts/header', ['title' => 'Explore the outdoors'])
            . view('home', ['trails' => $trails])
            . view('layouts/footer');
    }
}
