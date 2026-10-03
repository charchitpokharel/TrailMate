<?php

namespace App\Models;

use CodeIgniter\Model;

class TrailModel extends Model
{
    protected $table = 'trails';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['name', 'location', 'difficulty', 'distance_km', 'description'];
    protected $useTimestamps = true;
    public $validationRules = [
        'name' => 'required|min_length[3]|max_length[120]',
        'location' => 'required|min_length[2]|max_length[120]',
        'difficulty' => 'required|in_list[Easy,Moderate,Hard]',
        'distance_km' => 'required|decimal|greater_than[0]|less_than[1000]',
        'description' => 'required|min_length[10]|max_length[5000]',
    ];
}
