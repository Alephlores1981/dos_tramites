<?= $this->extend('layout') ?>

<?= $this->section('contenido') ?>
<h1>Listado de Trámites</h1>

<?php if(session('message')): ?>
<div class="alert alert-success"><?= session('message') ?></div>
<?php endif; ?>

<?php if(session('error')): ?>
<div class="alert alert-danger"><?= session('error') ?></div>
<?php endif; ?>

<a href="<?= base_url('tramites/new') ?>" class="btn btn-primary mb-3">Nuevo Trámite</a>

<table class="table" id="tablaTramites">
    <thead>
        <tr>
            <th>ID</th>
            <th>Expediente</th>
            <th>Afiliado</th>
            <th>Trámite</th>
            <th>Delegación Inicia</th>
            <th>Fecha Inicio</th>
            <th>Usuario</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($tramites as $t): ?>
        <tr>
            <td><?= $t['id'] ?></td>
            <td><?= esc($t['expediente']) ?></td>
            <td><?= esc($t['afiliado_nombre'] ?? '') ?></td>
            <td><?= esc($t['tipo_tramite'] ?? '') ?></td>
            <td><?= esc($t['delegacion_inicia'] ?? '') ?></td>
            <td><?= esc($t['fecha_inicio']) ?></td>
            <td><?= esc($t['usuario_carga']) ?></td>
            <td>
                <a href="<?= base_url('tramites/'.$t['id'].'/edit') ?>" class="btn btn-warning btn-sm">Editar</a>
                
                <form action="<?= base_url('tramites/'.$t['id']) ?>" method="post" style="display:inline;">
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="btn btn-danger btn-sm"
                            onclick="return confirm('¿Eliminar trámite?');">
                        Eliminar
                    </button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
$(document).ready(function(){
    $('#tablaTramites').DataTable();
});
</script>
<?= $this->endSection() ?>
