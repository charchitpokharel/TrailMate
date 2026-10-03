<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\TrailModel;

class TrailSearch extends BaseController
{
    public function index()
    {
        $q = trim((string)$this->request->getGet('q'));
        if (mb_strlen($q) < 2) return $this->response->setJSON([]);
        $rows = (new TrailModel())->groupStart()
            ->like('name', $q)->orLike('location', $q)->orLike('difficulty', $q)
            ->groupEnd()->orderBy('name')->findAll(20);
        return $this->response->setJSON($rows);
    }
}
