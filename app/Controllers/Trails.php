<?php

namespace App\Controllers;

use App\Models\TrailModel;

class Trails extends BaseController
{
    private function page(string $view, array $data = [])
    {
        return view('layouts/header', $data + ['title' => 'TrailMate'])
            . view($view, $data)
            . view('layouts/footer');
    }

    public function index()
    {
        return $this->page('trails/index', [
            'trails' => (new TrailModel())->orderBy('name')->findAll()
        ]);
    }

    public function show(int $id)
    {
        $trail = (new TrailModel())->find($id);
        if (!$trail) return redirect()->to('/trails')->with('error', 'Trail not found.');
        return $this->page('trails/show', ['trail' => $trail]);
    }

    public function new()
    {
        return $this->page('trails/form', ['trail' => null, 'action' => site_url('trails')]);
    }

    public function create()
    {
        $model = new TrailModel();
        if (!$this->validate($model->validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $model->insert($this->trailInput());
        return redirect()->to('/trails')->with('success', 'Trail created.');
    }

    public function edit(int $id)
    {
        $trail = (new TrailModel())->find($id);
        if (!$trail) return redirect()->to('/trails')->with('error', 'Trail not found.');
        return $this->page('trails/form', ['trail' => $trail, 'action' => site_url("trails/$id/update")]);
    }

    public function update(int $id)
    {
        $model = new TrailModel();
        if (!$model->find($id)) return redirect()->to('/trails')->with('error', 'Trail not found.');
        if (!$this->validate($model->validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $model->update($id, $this->trailInput());
        return redirect()->to("/trails/$id")->with('success', 'Trail updated.');
    }

    public function delete(int $id)
    {
        (new TrailModel())->delete($id);
        return redirect()->to('/trails')->with('success', 'Trail deleted.');
    }

    private function trailInput(): array
    {
        return [
            'name' => trim((string)$this->request->getPost('name')),
            'location' => trim((string)$this->request->getPost('location')),
            'difficulty' => $this->request->getPost('difficulty'),
            'distance_km' => (float)$this->request->getPost('distance_km'),
            'description' => trim((string)$this->request->getPost('description')),
        ];
    }
}
