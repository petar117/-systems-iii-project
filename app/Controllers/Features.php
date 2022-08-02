<?php

namespace App\Controllers;

use App\Models\FavouritesModel;
use App\Models\ItemModel;

class Features extends BaseController
{
    public function index()
    {
        $itemModel = new ItemModel();
        $items = $itemModel->findAll();
        $data = [
            'items' => $items
        ];

        $data['title'] = 'Shop';
        echo view('templates/header', $data);
        echo view('features/shop', $data);
        echo view('templates/footer');

    }

    public function display($data)
    {
        $data['title'] = 'Shop';
        echo view('templates/header', $data);
        echo view('features/shop', ['data' => $data]);
        echo view('templates/footer', $data);
    }

    public function profile()
    {
        $itemModel = new ItemModel();
        $favouritesModel = new FavouritesModel();

        $items = $itemModel->where('userID', session()->get('id'))->findAll();

        $favourites = $favouritesModel->getFavourites(session()->get('id'));

        $data = [
            'items' => $items,
            'favourites' => $favourites
        ];

        $data['title'] = "Profile Page";
        echo view('templates/header', $data);
        echo view('features/profile', $data);
        echo view('templates/footer');
    }

    public function item($id)
    {
        $itemModel = new ItemModel();
        $item = $itemModel->where('id', $id)->first();
        $data = [
            'item' => $item
        ];

        $data['title'] = $item['itemName'];
        echo view('templates/header', $data);
        echo view('features/item', $data);
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

    public function deleteItem()
    {
        $itemModel = new ItemModel();

        $id = $this->request->getVar('id');

        $name = $itemModel->where("id", $id)->first()['imgLocation'];

        unlink('uploads/' . $name);

        $itemModel->where('id', $id)->delete();
        return "ok";
    }

    public function addFavourite()
    {
        $favouritesModel = new FavouritesModel();
        $data = [
            'userID' => session()->get('id'),
            'itemID' => $this->request->getVar('itemID')
        ];
        $favouritesModel->save($data);
        return "ok";
    }

    public function removeFavourite()
    {
        $favouritesModel = new FavouritesModel();
        $id = $this->request->getVar('id');
        $favouritesModel->where('id', $id)->delete();
        return "ok";
    }

    public function searchItem()
    {
        $itemModel = new ItemModel();
        $keyword = $this->request->getVar('text');
        $items = $itemModel->search($keyword);

        $data['items'] = $items;

        $response = $this->display($data);

        echo $response;
    }
}
