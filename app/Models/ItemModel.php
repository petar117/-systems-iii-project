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
    ];
}