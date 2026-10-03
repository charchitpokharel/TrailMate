<h1 class="h2 mb-3"><?= $trail ? 'Edit trail' : 'Add a trail' ?></h1>
<?php if (session()->getFlashdata('errors')): ?><div class="alert alert-danger"><ul class="mb-0"><?php foreach(session()->getFlashdata('errors') as $error): ?><li><?= esc($error) ?></li><?php endforeach ?></ul></div><?php endif ?>
<form method="post" action="<?= esc($action) ?>" class="card card-body gap-3"><?= csrf_field() ?>
<div><label class="form-label">Trail name</label><input class="form-control" name="name" required maxlength="120" value="<?= esc(old('name', $trail['name'] ?? '')) ?>"></div>
<div><label class="form-label">Location</label><input class="form-control" name="location" required maxlength="120" value="<?= esc(old('location', $trail['location'] ?? '')) ?>"></div>
<div><label class="form-label">Difficulty</label><select class="form-select" name="difficulty" required><?php foreach(['Easy','Moderate','Hard'] as $d): ?><option <?= old('difficulty',$trail['difficulty']??'Easy')===$d?'selected':'' ?>><?= $d ?></option><?php endforeach ?></select></div>
<div><label class="form-label">Distance (km)</label><input type="number" min="0.1" max="999.99" step="0.01" class="form-control" name="distance_km" required value="<?= esc(old('distance_km',$trail['distance_km']??'')) ?>"></div>
<div><label class="form-label">Description</label><textarea class="form-control" name="description" rows="4" required><?= esc(old('description',$trail['description']??'')) ?></textarea></div>
<div><button class="btn btn-forest">Save trail</button> <a class="btn btn-outline-secondary" href="<?= site_url('trails') ?>">Cancel</a></div></form>
