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
            ->select('f.id,f.itemID,i.itemName,i.price,i.imgLocation')->join('item i', 'i.id = f.itemID')
            ->where('f.userID', $userID)
            ->get();

        return $query->getResultArray();
    }
}