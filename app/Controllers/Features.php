<?php

namespace App\Controllers;

use App\Models\CommentModel;
use App\Models\FavouritesModel;
use App\Models\ItemModel;
use App\Models\RatingModel;

class Features extends BaseController
{
    public function index()
    {
        $itemModel = new ItemModel();
        $items = $itemModel->findAll();

        $categories = $itemModel->getCategories();

        // capitalise each first letter of each category
        foreach ($categories as &$category) {
            $category['category'] = ucfirst($category['category']);
        }

        $data = [
            'items' => $items,
            'categories' => $categories,
        ];

        $data['title'] = 'Shop';
        echo view('templates/header', $data);
        echo view('features/shop', $data);
        echo view('templates/footer');

    }

    public function display($data)
    {
        echo view('features/display', ['data' => $data]);
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

        $ratingModel = new RatingModel();

        $userRating = $ratingModel->where('userID', session()->get('id'))->where('itemID', $id)->first();

        if ($userRating <> NULL) {
            $data['userRating'] = $userRating['stars'];  // If user has already rated the item, display their rating
        } else {
            $data['userRating'] = "0";
        }

        $averageRating = $ratingModel->where('itemID', $id)->selectAvg('stars')->first();

        if ($averageRating['stars'] <> NULL) {
            $data['averageRating'] = $averageRating['stars'];  // If there are ratings, display the average rating
        } else {
            $data['averageRating'] = 0;
        }

        $similarItems = $itemModel->similarItems($item['id'],$item['category']);
        $data['similarItems'] = $similarItems;

        $commentModel = new CommentModel();

        $comments = $commentModel->getComments($item['id']);
        $data['comments'] = $comments;

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
                'category' => 'required|min_length[3]|max_length[50]',
            ];

            if ($this->validate($rules)) {

                $fileName = $img->getRandomName();
                $img->move('uploads', $fileName);

                $data = [
                    'itemName' => $this->request->getVar('itemName'),
                    'description' => $this->request->getVar('description'),
                    'price' => $this->request->getVar('price'),
                    'category' => $this->request->getVar('category'),
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

    public function filterItems(){
        $itemModel = new ItemModel();
        $category = strtolower($this->request->getVar('filter'));
        $items = $itemModel->where('category', $category)->findAll();

        $data['items'] = $items;

        $response = $this->display($data);

        echo $response;
    }

    public function isInFavourites()
    {
        $favouritesModel = new FavouritesModel();
        $itemID = $this->request->getVar('itemID');
        $userID = session()->get('id');
        return $favouritesModel->check($userID, $itemID);
    }

    public function updateRating()
    {

        $ratingModel = new RatingModel();

        $userID = session()->get('id');
        $itemID = $this->request->getVar('itemID');
        $rating = $this->request->getVar('rating');

        $averageRating = $ratingModel->userRating($userID, $itemID, $rating);

        echo $averageRating;
    }

    public function postComment()
    {
        $commentModel = new CommentModel();
        $data = [
            'userID' => session()->get('id'),
            'itemID' => $this->request->getVar('itemID'),
            'text' => $this->request->getVar('text')
        ];
        $commentModel->save($data);
        return "ok";
    }
}
