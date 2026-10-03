<?php

namespace App\Controllers;

use App\Models\ReviewModel;
use App\Models\TrailModel';

class Reviews extends BaseController
{
    public function index(int $trailId)
    {
        $reviews = (new ReviewModel())->where('trail_id', $trailId)->orderBy('created_at', 'DESC')->findAll();
        return $this->response->setJSON($reviews);
    }

    public function create(int $trailId)
    {
        if (!(new TrailModel())->find($trailId)) return $this->response->setStatusCode(404)->setJSON(['error' => 'Trail not found.']);
        $rules = ['reviewer_name' => 'required|min_length[2]|max_length[80]', 'rating' => 'required|integer|greater_than_equal_to[1]|less_than_equal_to[5]', 'comment' => 'required|min_length[3]|max_length[1000]'];
        if (!$this->validate($rules)) return $this->response->setStatusCode(422)->setJSON(['errors' => $this->validator->getErrors()]);
        $model = new ReviewModel();
        $model->insert(['trail_id' => $trailId, 'reviewer_name' => trim($this->request->getPost('reviewer_name')), 'rating' => (int)$this->request->getPost('rating'), 'comment' => trim($this->request->getPost('comment'))]);
        return $this->response->setJSON(['success' => true, 'message' => 'Review submitted.']);
    }
}
