<?php

namespace App\Controllers;

use App\Models\ItemModel;

class Features extends BaseController
{

    public function profile()
    {
        $data['title'] = "Profile Page";
        echo view('templates/header', $data);
        echo view('features/profile', $data);
        echo view('templates/footer');
    }

    /**
     * @throws \ReflectionException
     */
    public function addItem()
    {

        $img = $this->request->getFile('file');

        $file_type = $img->getClientMimeType();

        $valid_file_types = array("image/png", "image/jpeg", "image/jpg");

        if (in_array($file_type, $valid_file_types)) {

            $rules = [
                'itemName' => 'required|min_length[3]|max_length[50]',
                'description' => 'required|min_length[3]|max_length[500]',
                'price' => 'required|numeric|min_length[1]|max_length[11]',
            ];

            if ($this->validate($rules)) {

                $fileName = $img->getRandomName();
                $img->move('uploads', $fileName);

                $data = [
                    'itemName' => $this->request->getVar('itemName'),
                    'description' => $this->request->getVar('description'),
                    'price' => $this->request->getVar('price'),
                    'imgLocation' => $img->getName(),
                    'userID' => session()->get('id')
                ];

                $itemModel = new ItemModel();

                $itemModel->save($data);

                return "ok";
            } else {
                $data['validation'] = $this->validator;
                return $data['validation']->listErrors();
            }
        } else {
            return "Invalid File Type";
        }
    }
}
