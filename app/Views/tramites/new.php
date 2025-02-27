<?= $this->extend('layout') ?>

<?= $this->section('contenido') ?>
<h2>Nuevo Trámite</h2>

<?php if(session('errors')): ?>
<div class="alert alert-danger">
    <?php foreach(session('errors') as $error): ?>
        <li><?= $error ?></li>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<form action="<?= base_url('tramites') ?>" method="post">
    <!-- Afiliado -->
    <div class="mb-3">
        <label for="afiliado_id" class="form-label">Afiliado</label>
        <select name="afiliado_id" class="form-select" required>
            <option value="">-- Seleccionar --</option>
            <?php foreach($afiliados as $af): ?>
            <option value="<?= $af['id'] ?>">
                <?= $af['nombre'].' '.$af['apellido'] ?>
            </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Tipo de Trámite -->
    <div class="mb-3">
        <label for="tramite_id" class="form-label">Tipo Trámite</label>
        <select name="tramite_id" class="form-select" required>
            <option value="">-- Seleccionar --</option>
            <?php foreach($tipos as $tt): ?>
            <option value="<?= $tt['id'] ?>">
                <?= $tt['descripcion'] ?>
            </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Delegación Inicia -->
    <div class="mb-3">
        <label for="delegacion_inicia_id" class="form-label">Delegación Inicia</label>
        <select name="delegacion_inicia_id" class="form-select" required>
            <option value="">-- Seleccionar --</option>
            <?php foreach($delegaciones as $del): ?>
            <option value="<?= $del['id'] ?>">
                <?= $del['nombre'] ?>
            </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Fecha Inicio -->
    <div class="mb-3">
        <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
        <input type="date" name="fecha_inicio" class="form-control" required>
    </div>

    <!-- Expediente -->
    <div class="mb-3">
        <label for="expediente" class="form-label">Expediente</label>
        <input type="text" name="expediente" class="form-control" >
    </div>

    <!-- Observaciones -->
    <div class="mb-3">
        <label for="observaciones" class="form-label">Observaciones</label>
        <textarea name="observaciones" class="form-control"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="<?= base_url('tramites') ?>" class="btn btn-secondary">Volver</a>
</form>
<?= $this->endSection() ?>
