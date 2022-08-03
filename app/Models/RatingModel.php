<?php

namespace App\Models;

use CodeIgniter\Model;

class RatingModel extends Model
{
    protected $table = 'rating';

    protected $allowedFields = [
        'stars',
        'userID',
        'itemID'
    ];

    /**
     * @throws \ReflectionException
     */
    public function userRating($userID, $itemID, $rating)
    {
        $query = 'SELECT * FROM rating WHERE userID =' . $userID . ' AND itemID = ' . $itemID;
        $result = $this->db->query($query)->getNumRows();

        if ($result > 0) {
            $ratingID = $this->db->query($query)->getRowArray()['id'];
            $this->update($ratingID,['stars' => $rating, 'userID' => $userID, 'itemID' => $itemID]);
        } else {
            $this->insert(['stars' => $rating, 'userID' => $userID, 'itemID' => $itemID]);
        }

        $query2 = 'SELECT AVG(stars) AS averageRating FROM rating WHERE itemID = ' . $itemID;

        $result2 = $this->db->query($query2)->getResultArray();

        $rating = $result2[0]['averageRating'];

        if ($rating == '') {
            $rating = 0;
        }
        return $rating;
    }

}