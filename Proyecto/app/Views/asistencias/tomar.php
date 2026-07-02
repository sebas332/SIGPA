<div class="container-fluid px-0">
    <div class="mb-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center">
        <div>
            <a href="<?= URLROOT; ?>/index.php?route=asistencias/seleccionar" class="btn btn-outline-secondary btn-sm mb-3 shadow-sm">
                <i class="fa-solid fa-arrow-left me-2"></i> Volver a Seleccionar Sesión
            </a>
            <h2 class="fw-bold text-dark mb-1">Registro de Asistencia: <span class="text-primary">Ficha <?= $programacion->numero_ficha; ?></span></h2>
            <p class="text-muted small mb-0">Fecha de Control: <strong class="text-dark"><?= $fecha; ?></strong> | Ambiente: <?= $programacion->ambiente_nombre; ?></p>
        </div>
        <div class="mt-3 mt-md-0 d-flex gap-2">
            <button type="button" class="btn btn-outline-success btn-sm shadow-sm" onclick="checkAll(true)">
                <i class="fa-solid fa-check-double me-1"></i> Marcar Todos
            </button>
            <button type="button" class="btn btn-outline-danger btn-sm shadow-sm" onclick="checkAll(false)">
                <i class="fa-solid fa-xmark me-1"></i> Desmarcar Todos
            </button>
        </div>
    </div>

    <!-- Informacion de la competencia -->
    <div class="card shadow-sm border-0 rounded-4 mb-4 bg-light">
        <div class="card-body p-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h6 class="fw-bold text-dark mb-1"><i class="fa-solid fa-book text-primary me-2"></i><?= $programacion->competencia_nombre; ?></h6>
                    <p class="text-muted small mb-0">Resultado de Aprendizaje: <strong class="text-dark"><?= $programacion->ra_codigo . ' - ' . $programacion->ra_descripcion; ?></strong></p>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <span class="badge bg-primary px-3 py-2 fs-6">Sesiones Realizadas: <?= $programacion->sesiones_realizadas; ?> / <?= $programacion->total_sesiones; ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulario de toma de asistencia -->
    <div class="card shadow-sm border-0 rounded-4 bg-white">
        <div class="card-header bg-white p-4 border-0">
            <h5 class="fw-bold text-dark mb-0"><i class="fa-solid fa-user-check text-success me-2"></i>Listado de Aprendices (<?= count($aprendices); ?>)</h5>
        </div>
        <div class="card-body p-0">
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger m-4 shadow-sm"><?= $error; ?></div>
            <?php endif; ?>

            <form action="<?= URLROOT; ?>/index.php?route=asistencias/tomar&programacion=<?= $programacion->id_programacion; ?>&fecha=<?= $fecha; ?>" method="POST">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-secondary small text-uppercase py-3">
                            <tr>
                                <th class="ps-4" style="width: 250px;">Aprendiz</th>
                                <th>Correo Electrónico</th>
                                <th class="text-center" style="width: 150px;">¿Asistió?</th>
                                <th class="pe-4">Observaciones / Excusa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($aprendices as $ap): 
                                $id_aprendiz = $ap->id_usuario_aprendiz;
                                $asistenciaAnterior = $asistenciaPrevia[$id_aprendiz] ?? null;
                                // Si ya existía, usar su estado, si no, checkear por defecto
                                $checked = ($asistenciaAnterior && $asistenciaAnterior->asistio == 1) || (!$asistenciaAnterior) ? 'checked' : '';
                                $obs = $asistenciaAnterior ? $asistenciaAnterior->observacion : '';
                            ?>
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle bg-success-subtle text-success fw-bold me-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; border-radius: 50%;">
                                                <?= substr($ap->nombre, 0, 1); ?>
                                            </div>
                                            <span class="fw-bold text-dark"><?= $ap->nombre . ' ' . $ap->apellido; ?></span>
                                        </div>
                                    </td>
                                    <td class="text-muted small"><i class="fa-solid fa-envelope me-1 text-secondary"></i> <?= $ap->correo; ?></td>
                                    <td class="text-center">
                                        <div class="form-check form-switch form-check-lg d-flex justify-content-center">
                                            <input class="form-check-input asistencia-checkbox shadow-sm" type="checkbox" name="asistencia[<?= $id_aprendiz; ?>]" value="1" <?= $checked; ?>>
                                        </div>
                                    </td>
                                    <td class="pe-4">
                                        <input type="text" class="form-control form-control-sm shadow-sm" name="observacion[<?= $id_aprendiz; ?>]" value="<?= htmlspecialchars($obs); ?>" placeholder="Ej. Llegó tarde, excusa médica, etc.">
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="p-4 bg-light border-top border-light-subtle d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary btn-lg fw-bold shadow-sm px-5">
                        <i class="fa-solid fa-floppy-disk me-2"></i> Guardar Control de Asistencia
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function checkAll(checked) {
    let checkboxes = document.querySelectorAll('.asistencia-checkbox');
    checkboxes.forEach(function(cb) {
        cb.checked = checked;
    });
}
</script>
