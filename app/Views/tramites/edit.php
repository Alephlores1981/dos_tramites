<?= $this->extend('layout') ?>

<?= $this->section('contenido') ?>
<h2>Editar Trámite</h2>

<!-- Mostrar errores de validación si existen -->
<?php if(session('errors')): ?>
<div class="alert alert-danger">
    <ul>
    <?php foreach(session('errors') as $error): ?>
        <li><?= esc($error) ?></li>
    <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

<form action="<?= base_url('tramites/'.$tramite['id']) ?>" method="post">
    <!-- Muy importante para simular PUT -->
    <input type="hidden" name="_method" value="PUT">

    <!-- Afiliado -->
    <div class="mb-3">
        <label for="afiliado_id" class="form-label">Afiliado</label>
        <select name="afiliado_id" id="afiliado_id" class="form-select" required>
            <option value="">-- Seleccione Afiliado --</option>
            <?php foreach($afiliados as $af): ?>
            <option value="<?= $af['id'] ?>" 
                <?= $af['id'] == $tramite['afiliado_id'] ? 'selected' : '' ?>>
                <?= esc($af['nombre'].' '.$af['apellido']) ?>
            </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Tipo de Trámite -->
    <div class="mb-3">
        <label for="tramite_id" class="form-label">Tipo de Trámite</label>
        <select name="tramite_id" id="tramite_id" class="form-select" required>
            <option value="">-- Seleccione Trámite --</option>
            <?php foreach($tipos as $tt): ?>
            <option value="<?= $tt['id'] ?>"
                <?= $tt['id'] == $tramite['tramite_id'] ? 'selected' : '' ?>>
                <?= esc($tt['descripcion']) ?>
            </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Delegación Inicia -->
    <div class="mb-3">
        <label for="delegacion_inicia_id" class="form-label">Delegación que Inicia</label>
        <select name="delegacion_inicia_id" id="delegacion_inicia_id" class="form-select" required>
            <option value="">-- Seleccione Delegación --</option>
            <?php foreach($delegaciones as $del): ?>
            <option value="<?= $del['id'] ?>"
                <?= $del['id'] == $tramite['delegacion_inicia_id'] ? 'selected' : '' ?>>
                <?= esc($del['nombre']) ?>
            </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Fecha de Inicio -->
    <div class="mb-3">
        <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
        <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" 
               value="<?= esc($tramite['fecha_inicio']) ?>" required>
    </div>

    <!-- Expediente -->
    <div class="mb-3">
        <label for="expediente" class="form-label">Expediente</label>
        <input type="text" name="expediente" id="expediente" class="form-control" 
               value="<?= esc($tramite['expediente']) ?>" required>
    </div>

    <!-- Observaciones -->
    <div class="mb-3">
        <label for="observaciones" class="form-label">Observaciones</label>
        <textarea name="observaciones" id="observaciones" rows="3" class="form-control">
            <?= esc($tramite['observaciones']) ?>
        </textarea>
    </div>

    <button type="submit" class="btn btn-primary">Actualizar</button>
    <a href="<?= base_url('tramites') ?>" class="btn btn-secondary">Cancelar</a>
</form>
<?= $this->endSection() ?>
