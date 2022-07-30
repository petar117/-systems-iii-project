<?php

namespace App\Controllers;

class Features extends BaseController
{

    public function profile()
    {
        $data['title'] = "Profile Page";
        echo view('templates/header', $data);
        echo view('features/profile',$data);
        echo view('templates/footer');
    }

}
