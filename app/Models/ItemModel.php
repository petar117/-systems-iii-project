<?php
namespace App\Models;
use CodeIgniter\Model;

class ItemModel extends Model{
    protected $table = 'item';

    protected $allowedFields = [
        'itemName',
        'description',
        'price',
        'imgLocation',
        'userID',
        'category',
    ];

    public function search($keyword)
    {
        $query = "select * from item where itemName like '%" . $keyword . "%'";

        return $this->db->query($query)->getResultArray();
    }

    public function getCategories()
    {
        $query = "select DISTINCT category from item";

        return $this->db->query($query)->getResultArray();
    }
}