<div class="container-fluid px-0">
    <div class="mb-4">
        <h3 class="fw-bold text-dark mb-1">Historial y Reporte de Asistencia</h3>
        <p class="text-muted small mb-0">Seguimiento y control de presencia en la programación académica</p>
    </div>

    <div class="card shadow-sm border-0 rounded-4 bg-white">
        <div class="card-body p-0">
            <?php if (empty($asistencias)): ?>
                <div class="p-5 text-center text-muted">
                    <i class="fa-solid fa-clipboard-question fa-3x mb-3 text-secondary"></i>
                    <h5 class="fw-bold">No hay registros de asistencia para mostrar</h5>
                    <p class="small mb-0">Los registros aparecerán en cuanto un instructor guarde los controles de las sesiones.</p>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-secondary small text-uppercase py-3">
                            <tr>
                                <?php if ($current_role === 'Coordinador'): ?>
                                    <th class="ps-4">Aprendiz</th>
                                    <th>Ficha</th>
                                    <th>Instructor</th>
                                <?php else: ?>
                                    <th class="ps-4">Ficha</th>
                                    <th>Instructor</th>
                                <?php endif; ?>
                                <th>Fecha Control</th>
                                <th>Competencia</th>
                                <th>Estado</th>
                                <th class="pe-4">Observación</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($asistencias as $asist): ?>
                                <tr>
                                    <?php if ($current_role === 'Coordinador'): ?>
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-circle bg-primary-subtle text-primary fw-bold me-2 d-flex align-items-center justify-content-center" style="width: 28px; height: 28px; border-radius: 50%; font-size: 12px;">
                                                    <?= substr($asist->aprendiz_nombre, 0, 1); ?>
                                                </div>
                                                <span class="fw-bold text-dark"><?= $asist->aprendiz_nombre . ' ' . $asist->aprendiz_apellido; ?></span>
                                            </div>
                                        </td>
                                        <td class="fw-bold text-primary">Ficha <?= $asist->numero_ficha; ?></td>
                                        <td class="text-muted small"><?= $asist->instructor_nombre . ' ' . $asist->instructor_apellido; ?></td>
                                    <?php else: ?>
                                        <td class="ps-4 fw-bold text-primary">Ficha <?= $asist->numero_ficha; ?></td>
                                        <td class="text-muted small"><?= $asist->instructor_nombre . ' ' . $asist->instructor_apellido; ?></td>
                                    <?php endif; ?>

                                    <td><span class="badge bg-secondary-subtle text-secondary-emphasis px-3 py-1"><?= $asist->fecha_asistencia; ?></span></td>
                                    <td>
                                        <div class="fw-bold text-dark small"><?= $asist->competencia_nombre; ?></div>
                                    </td>
                                    <td>
                                        <?php if ($asist->asistio == 1): ?>
                                            <span class="badge bg-success shadow-sm px-3 py-1"><i class="fa-solid fa-check me-1"></i> Asistió</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger shadow-sm px-3 py-1"><i class="fa-solid fa-xmark me-1"></i> Faltó</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="pe-4 text-muted small fst-italic">
                                        <?= !empty($asist->observacion) ? '"' . $asist->observacion . '"' : '<span class="text-black-50">Sin observaciones</span>'; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
