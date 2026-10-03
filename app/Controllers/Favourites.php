<?php

namespace App\Controllers;

use App\Models\TrailModel;

class Favourites extends BaseController
{
    public function index()
    {
        $ids = session()->get('favourites') ?? [];
        $trails = empty($ids) ? [] : (new TrailModel())->whereIn('id', $ids)->findAll();
        return view('layouts/header', ['title' => 'My favourites'])
            . view('favourites', ['trails' => $trails])
            . view('layouts/footer');
    }

    public function toggle(int $id)
    {
        $trail = (new TrailModel())->find($id);
        if (!$trail) return $this->response->setStatusCode(404)->setJSON(['error' => 'Trail not found.']);
        $ids = session()->get('favourites') ?? [];
        if (in_array($id, $ids)) {
            $ids = array_values(array_diff($ids, [$id]));
            $saved = false;
        } else {
            $ids[] = $id;
            $saved = true;
        }
        session()->set('favourites', $ids);
        return $this->response->setJSON(['saved' => $saved, 'count' => count($ids)]);
    }
}
