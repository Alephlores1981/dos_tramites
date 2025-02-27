<?= $this->extend('layout') ?>

<?= $this->section('contenido') ?>
<h2>Detalle del Trámite</h2>

<!-- Datos básicos del trámite -->
<p><strong>ID:</strong> <?= $tramite['id'] ?></p>
<p><strong>Expediente:</strong> <?= esc($tramite['expediente']) ?></p>
<!-- ... otros campos ... -->

<hr>
<h3>Historial de Instancias</h3>
<table class="table">
    <thead>
        <tr>
            <th>Fecha Cambio</th>
            <th>Instancia</th>
            <th>Observaciones</th>
            <th>Usuario</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($historial as $h): ?>
        <tr>
            <td><?= esc($h['fecha_cambio']) ?></td>
            <td><?= esc($h['instancia_nombre']) ?></td>
            <td><?= esc($h['observaciones']) ?></td>
            <td><?= esc($h['usuario_cambio']) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?= $this->endSection() ?>
