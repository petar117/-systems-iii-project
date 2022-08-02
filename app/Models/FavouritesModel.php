<?php
namespace App\Models;
use CodeIgniter\Model;

class FavouritesModel extends Model{
    protected $table = 'favourites';

    protected $allowedFields = [
        'userID',
        'itemID'
    ];

    /**
     * @throws \Exception
     */
    public function getFavourites($userID){

        $query = $this->db->table('favourites f')
            ->select('*')->join('item', 'item.id = favourites.itemID')
            ->where('favourites.userID', $userID)
            ->get();

        return $query->getResultArray();
    }
}