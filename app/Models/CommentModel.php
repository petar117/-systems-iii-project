<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentModel extends Model
{
    protected $table = 'comment';

    protected $allowedFields = [
        'userID',
        'itemID',
        'text',
    ];

    public function getComments($id)
    {
        $query = 'SELECT c.id, c.itemID, c.text, u.firstName, u.lastName FROM comment c INNER JOIN user u ON c.userID = u.id INNER JOIN item i ON c.itemID = i.id WHERE c.itemID = ' . $id;

        return $this->db->query($query)->getResultArray();
    }
}