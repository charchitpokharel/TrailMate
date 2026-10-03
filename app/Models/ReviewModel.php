<?php

namespace App\Models;

use CodeIgniter\Model;

class ReviewModel extends Model
{
    protected $table = 'reviews';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['trail_id', 'reviewer_name', 'rating', 'comment'];
    protected $useTimestamps = true;
}
