<div class="container-fluid px-0">
    <div class="mb-4">
        <h3 class="fw-bold text-dark mb-1">Seleccionar Sesión de Programación Académica</h3>
        <p class="text-muted small mb-0">Selecciona la ficha y la fecha para realizar el control de asistencia de los aprendices</p>
    </div>

    <div class="card shadow-sm border-0 rounded-4 bg-white">
        <div class="card-body p-0">
            <?php if (empty($programacion)): ?>
                <div class="p-5 text-center text-muted">
                    <i class="fa-solid fa-calendar-xmark fa-3x mb-3 text-secondary"></i>
                    <h5 class="fw-bold">No tienes programación académica asignada</h5>
                    <p class="small mb-0">Comunícate con la Coordinación para que se te asigne horario de instrucción.</p>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-secondary small text-uppercase py-3">
                            <tr>
                                <th class="ps-4">Ficha</th>
                                <th>Ambiente</th>
                                <th>Día</th>
                                <th>Horario</th>
                                <th>Competencia / RA</th>
                                <th>Selección de Fecha</th>
                                <th class="text-end pe-4">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($programacion as $prog): ?>
                                <tr>
                                    <td class="ps-4 fw-bold text-primary fs-6">Ficha <?= $prog->numero_ficha; ?></td>
                                    <td>
                                        <span class="badge bg-secondary-subtle text-secondary-emphasis"><?= $prog->ambiente_nombre; ?></span>
                                    </td>
                                    <td><span class="badge bg-dark"><?= $prog->nombre_dia; ?></span></td>
                                    <td class="text-muted small fw-medium"><?= substr($prog->hora_inicio, 0, 5) . ' - ' . substr($prog->hora_fin, 0, 5); ?></td>
                                    <td>
                                        <div class="fw-bold text-dark small"><?= $prog->competencia_nombre; ?></div>
                                        <div class="text-muted small" style="max-width: 280px; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;" title="<?= $prog->ra_descripcion; ?>"><?= $prog->ra_codigo . ' - ' . $prog->ra_descripcion; ?></div>
                                    </td>
                                    <form action="<?= URLROOT; ?>/index.php" method="GET">
                                        <input type="hidden" name="route" value="asistencias/tomar">
                                        <input type="hidden" name="programacion" value="<?= $prog->id_programacion; ?>">
                                        <td>
                                            <input type="date" class="form-control form-control-sm shadow-sm" name="fecha" value="<?= date('Y-m-d'); ?>" required>
                                        </td>
                                        <td class="text-end pe-4">
                                            <button type="submit" class="btn btn-primary btn-sm fw-medium shadow-sm">
                                                <i class="fa-solid fa-clipboard-user me-1"></i> Tomar Asistencia
                                            </button>
                                        </td>
                                    </form>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
