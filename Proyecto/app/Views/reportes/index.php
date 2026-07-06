<div class="container-fluid px-0">
    <!-- Fila de Título del Módulo (Estilo Premium) -->
    <div class="card bg-white border-0 shadow-sm rounded-4 mb-4 no-print" style="border: 1px solid rgba(0,0,0,0.06);">
        <div class="card-body p-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h5 class="fw-bold text-dark mb-1">Centro de Reportes y Estadísticas</h5>
                <p class="text-muted small mb-0">Consulte y exporte reportes en tiempo real de toda la programación y control académico.</p>
            </div>
            <?php if (!empty($resultados)): ?>
                <div class="d-flex flex-wrap gap-2 justify-content-md-end">
                    <a href="#" id="btn-export-pdf" class="btn btn-danger btn-sm shadow-sm fw-bold d-flex align-items-center rounded-pill px-4 py-2" style="font-size: 0.85rem;">
                        <i class="fa-solid fa-file-pdf me-2"></i> Exportar PDF
                    </a>
                    <a href="#" id="btn-export-excel" class="btn btn-success btn-sm shadow-sm fw-bold d-flex align-items-center rounded-pill px-4 py-2" style="font-size: 0.85rem; background-color: #198754; border-color: #198754;">
                        <i class="fa-solid fa-file-excel me-2"></i> Exportar Excel
                    </a>
                    <button type="button" onclick="window.print()" class="btn btn-dark btn-sm shadow-sm fw-bold d-flex align-items-center rounded-pill px-4 py-2" style="font-size: 0.85rem;">
                        <i class="fa-solid fa-print me-2"></i> Imprimir
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Selector de Reportes mediante SGA Nav Pills (SPA Look) -->
    <div class="card bg-white border-0 shadow-sm rounded-4 mb-4 no-print" style="border: 1px solid rgba(0,0,0,0.06);">
        <div class="card-body p-3 text-center">
            <span class="text-muted small fw-bold d-block mb-3 text-uppercase" style="letter-spacing: 0.5px; font-size: 0.72rem;">Tipo de Reporte Activo</span>
            <ul class="nav sga-nav-pills flex-wrap justify-content-center gap-2 mb-0" id="report-tabs">
                <li class="nav-item">
                    <a class="nav-link <?= $tipo_reporte === 'programacion' ? 'active' : ''; ?>" href="<?= URLROOT; ?>/index.php?route=reportes/index&tipo_reporte=programacion">
                        <i class="fa-solid fa-calendar-days"></i> Programación
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $tipo_reporte === 'instructores' ? 'active' : ''; ?>" href="<?= URLROOT; ?>/index.php?route=reportes/index&tipo_reporte=instructores">
                        <i class="fa-solid fa-user-tie"></i> Instructores
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $tipo_reporte === 'ambientes' ? 'active' : ''; ?>" href="<?= URLROOT; ?>/index.php?route=reportes/index&tipo_reporte=ambientes">
                        <i class="fa-solid fa-building"></i> Ambientes
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $tipo_reporte === 'fichas' ? 'active' : ''; ?>" href="<?= URLROOT; ?>/index.php?route=reportes/index&tipo_reporte=fichas">
                        <i class="fa-solid fa-users"></i> Fichas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $tipo_reporte === 'resultados' ? 'active' : ''; ?>" href="<?= URLROOT; ?>/index.php?route=reportes/index&tipo_reporte=resultados">
                        <i class="fa-solid fa-clipboard-question"></i> Resultados
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $tipo_reporte === 'asistencias' ? 'active' : ''; ?>" href="<?= URLROOT; ?>/index.php?route=reportes/index&tipo_reporte=asistencias">
                        <i class="fa-solid fa-clipboard-check"></i> Asistencias
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $tipo_reporte === 'novedades' ? 'active' : ''; ?>" href="<?= URLROOT; ?>/index.php?route=reportes/index&tipo_reporte=novedades">
                        <i class="fa-solid fa-triangle-exclamation"></i> Novedades
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Panel de Filtro Único Superior -->
    <div class="card shadow-sm border-0 rounded-4 bg-white mb-4 no-print">
        <div class="card-body p-4">
            <form id="form-reportes" onsubmit="event.preventDefault();">
                <input type="hidden" name="tipo_reporte" value="<?= htmlspecialchars($tipo_reporte); ?>">
                
                <!-- Buscador de Texto Rápido -->
                <div class="row">
                    <div class="col-12">
                        <label class="text-muted small fw-bold mb-2">Búsqueda Rápida de Reporte</label>
                        <div class="input-group shadow-sm border rounded-pill overflow-hidden" style="border-color: #dee2e6 !important;">
                            <span class="input-group-text bg-white border-0 text-muted ps-3"><i class="fa-solid fa-magnifying-glass"></i></span>
                            <input type="text" id="search-input" class="form-control border-0 bg-white shadow-none py-2" placeholder="Escriba cualquier término (nombre, código, ficha, fecha, jornada, estado) para filtrar instantáneamente..." value="<?= htmlspecialchars($search); ?>">
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                    <span class="text-secondary small fw-medium" style="font-size: 0.85rem;">
                        <i class="fa-solid fa-circle-info text-success me-1"></i> Los resultados se filtran automáticamente en tiempo real.
                    </span>
                    <button type="button" id="btn-limpiar" class="btn btn-outline-secondary px-4 py-2 rounded-pill fw-semibold shadow-sm border-0 bg-light-subtle" style="font-size: 0.85rem;">
                        <i class="fa-solid fa-rotate-left me-1"></i> Limpiar Filtro
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Resultados del Reporte -->
    <div class="card shadow-sm border-0 rounded-4 bg-white">
        <!-- Header visible solo para Impresión Física -->
        <div class="print-header d-none w-100 p-4 border-bottom mb-4">
            <table class="w-100 align-middle">
                <tr>
                    <td style="width: 80px; text-align: left;">
                        <div style="width: 60px; height: 60px; background-color: #39A900; color: #FFFFFF; font-family: Arial, sans-serif; font-weight: bold; font-size: 16pt; display: flex; align-items: center; justify-content: center; border-radius: 6px;">SENA</div>
                    </td>
                    <td>
                        <h4 class="fw-bold text-dark m-0" style="font-size: 1.25rem;">SISTEMA DE GESTIÓN ACADÉMICA (SIGPA)</h4>
                        <h5 class="fw-semibold text-success m-0" style="font-size: 1rem; color: #39A900 !important;"><?= htmlspecialchars($report_title); ?></h5>
                        <p class="text-muted small m-0">Fecha de generación: <?= date('d/m/Y h:i A'); ?></p>
                    </td>
                </tr>
            </table>
        </div>

        <div class="card-header bg-transparent border-0 px-4 pt-4 pb-0 d-flex justify-content-between align-items-center no-print">
            <h5 class="fw-bold text-dark m-0 d-flex align-items-center" style="font-size: 1.05rem;">
                <i class="fa-solid fa-table-list text-success me-2 fs-5"></i>
                Detalles del Reporte
            </h5>
            <span id="badge-total-registros" class="badge bg-light text-secondary border px-3 py-2 fw-bold" style="font-size: 0.8rem;">
                Mostrando: 0 de 0
            </span>
        </div>

        <div class="card-body p-0 mt-3">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="tabla-reporte">
                    <thead class="table-light text-secondary small text-uppercase py-3">
                        <tr>
                            <?php if ($tipo_reporte === 'programacion'): ?>
                                <th class="ps-4">Ficha</th>
                                <th>Programa de Formación</th>
                                <th>Instructor</th>
                                <th>Ambiente Físico</th>
                                <th>Día / Horario</th>
                                <th>Competencia / Resultado de Aprendizaje</th>
                                <th class="text-center">Sesiones</th>
                                <th class="pe-4 text-center">F. Inicio</th>

                            <?php elseif ($tipo_reporte === 'instructores'): ?>
                                <th class="ps-4">Instructor</th>
                                <th>Correo Electrónico</th>
                                <th>Contacto</th>
                                <th>Titulación / Especialidad</th>
                                <th class="text-center">Prog. Asignadas</th>
                                <th class="pe-4 text-center">Fichas Relacionadas</th>

                            <?php elseif ($tipo_reporte === 'ambientes'): ?>
                                <th class="ps-4 text-center">ID</th>
                                <th>Nombre Ambiente</th>
                                <th>Tipo</th>
                                <th class="text-center">Capacidad</th>
                                <th class="text-center">Computadores</th>
                                <th>Equipamiento y Servicios</th>
                                <th class="pe-4 text-center">Estado</th>

                            <?php elseif ($tipo_reporte === 'fichas'): ?>
                                <th class="ps-4">Ficha</th>
                                <th class="text-center">Estudiantes</th>
                                <th class="text-center">F. Inicio</th>
                                <th class="text-center">Etapa Práctica</th>
                                <th class="text-center">F. Finalización</th>
                                <th>Instructor Líder</th>
                                <th>Programa Formativo</th>
                                <th class="pe-4 text-center">Jornada</th>

                            <?php elseif ($tipo_reporte === 'resultados'): ?>
                                <th class="ps-4">Código</th>
                                <th>Descripción de Resultado</th>
                                <th>Competencia Asociada</th>
                                <th>Programa Formativo</th>
                                <th class="pe-4 text-center">Sesiones Asignadas</th>

                            <?php elseif ($tipo_reporte === 'asistencias'): ?>
                                <th class="ps-4">Aprendiz</th>
                                <th class="text-center">Ficha</th>
                                <th>Instructor</th>
                                <th>Fecha Control</th>
                                <th>Competencia</th>
                                <th class="text-center">Estado</th>
                                <th class="pe-4">Observación</th>

                            <?php elseif ($tipo_reporte === 'novedades'): ?>
                                <th class="ps-4 text-center">ID</th>
                                <th>Ambiente Físico</th>
                                <th>Reportado Por</th>
                                <th>Descripción del Reporte / Avería</th>
                                <th class="pe-4 text-center">Fecha Reporte</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Fila de Estado Vacío -->
                        <tr id="empty-row" style="display: none;">
                            <td colspan="20" class="text-center p-5 text-muted">
                                <i class="fa-solid fa-folder-open fa-3x mb-3 text-secondary"></i>
                                <h6 class="fw-bold">No se encontraron registros</h6>
                                <p class="small mb-0">No hay información en el sistema que coincida con la búsqueda ingresada.</p>
                            </td>
                        </tr>

                        <?php foreach ($resultados as $row): ?>
                            <?php if ($tipo_reporte === 'programacion'): ?>
                                <tr class="report-row">
                                    <td class="ps-4 fw-bold text-primary">Ficha <?= $row->numero_ficha; ?></td>
                                    <td><div class="text-secondary small fw-medium" style="max-width: 180px;"><?= htmlspecialchars($row->programa_nombre); ?></div></td>
                                    <td class="fw-semibold text-dark"><?= htmlspecialchars($row->instructor_nombre); ?></td>
                                    <td><span class="text-secondary small"><i class="fa-solid fa-building me-1 text-black-50"></i> <?= htmlspecialchars($row->ambiente_nombre); ?></span></td>
                                    <td>
                                        <div class="fw-bold text-dark small mb-1"><?= htmlspecialchars($row->nombre_dia); ?></div>
                                        <span class="badge bg-light text-dark border font-monospace small" style="font-size: 0.76rem;"><?= substr($row->hora_inicio, 0, 5); ?> - <?= substr($row->hora_fin, 0, 5); ?></span>
                                    </td>
                                    <td>
                                        <div class="fw-semibold text-dark small text-wrap" style="max-width: 250px;">
                                            <?= htmlspecialchars($row->competencia_nombre); ?>
                                        </div>
                                        <span class="text-muted small font-monospace d-block mt-1" style="font-size: 0.74rem;">[<?= htmlspecialchars($row->ra_codigo); ?>] <?= htmlspecialchars($row->ra_descripcion); ?></span>
                                    </td>
                                    <td class="text-center">
                                        <?php 
                                        $porc = $row->total_sesiones > 0 ? round(($row->sesiones_realizadas / $row->total_sesiones) * 100) : 0;
                                        $badgeBg = ($row->sesiones_realizadas == $row->total_sesiones) ? 'bg-success' : 'bg-primary';
                                        ?>
                                        <span class="badge <?= $badgeBg; ?> px-3 py-1 shadow-sm font-monospace" style="font-size: 0.78rem;"><?= $row->sesiones_realizadas; ?> / <?= $row->total_sesiones; ?></span>
                                        <div class="progress mt-1 shadow-sm mx-auto" style="height: 4px; width: 60px; border-radius: 10px;">
                                            <div class="progress-bar <?= ($row->sesiones_realizadas == $row->total_sesiones) ? 'bg-success' : 'bg-primary'; ?>" role="progressbar" style="width: <?= $porc; ?>%" aria-valuenow="<?= $porc; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td class="pe-4 text-center"><span class="badge bg-light text-secondary border px-3 py-1 font-monospace"><?= $row->fecha_inicio; ?></span></td>
                                </tr>

                            <?php elseif ($tipo_reporte === 'instructores'): ?>
                                <tr class="report-row">
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle bg-primary-subtle text-primary fw-bold me-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; border-radius: 50%; font-size: 13px;">
                                                <?= substr($row->nombre, 0, 1); ?>
                                            </div>
                                            <div class="fw-bold text-dark"><?= htmlspecialchars($row->nombre . ' ' . $row->apellido); ?></div>
                                        </div>
                                    </td>
                                    <td class="text-secondary small font-monospace"><?= htmlspecialchars($row->correo); ?></td>
                                    <td><span class="text-muted small"><i class="fa-solid fa-phone me-1 text-secondary"></i> <?= htmlspecialchars($row->telefono); ?></span></td>
                                    <td><div class="text-secondary small fw-medium"><?= htmlspecialchars($row->titulacion); ?></div></td>
                                    <td class="text-center font-monospace"><span class="badge bg-light text-dark border px-3 py-1"><?= $row->total_programaciones; ?></span></td>
                                    <td class="pe-4 text-center font-monospace"><span class="badge bg-light text-primary border px-3 py-1"><?= $row->total_fichas; ?></span></td>
                                </tr>

                            <?php elseif ($tipo_reporte === 'ambientes'): ?>
                                <tr class="report-row">
                                    <td class="ps-4 text-center font-monospace fw-bold text-secondary">#<?= $row->id_numero_ambiente; ?></td>
                                    <td class="fw-bold text-dark"><?= htmlspecialchars($row->nombre); ?></td>
                                    <td><span class="badge bg-light text-dark border px-3 py-1"><?= htmlspecialchars($row->tipo); ?></span></td>
                                    <td class="text-center fw-semibold text-secondary font-monospace"><?= $row->capacidad; ?></td>
                                    <td class="text-center font-monospace"><?= $row->computadores; ?></td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-1">
                                            <?php if($row->aire): ?><span class="badge bg-success-subtle text-success border px-2 py-1 small" style="font-size: 0.72rem;">Aire</span><?php endif; ?>
                                            <?php if($row->ventilador): ?><span class="badge bg-info-subtle text-info border px-2 py-1 small" style="font-size: 0.72rem;">Ventilador</span><?php endif; ?>
                                            <?php if($row->tablero): ?><span class="badge bg-secondary-subtle text-secondary border px-2 py-1 small" style="font-size: 0.72rem;">Tablero</span><?php endif; ?>
                                            <?php if($row->tv): ?><span class="badge bg-primary-subtle text-primary border px-2 py-1 small" style="font-size: 0.72rem;">TV</span><?php endif; ?>
                                            <?php if(!$row->aire && !$row->ventilador && !$row->tablero && !$row->tv): ?>
                                                <span class="text-muted small fst-italic">Básico</span>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td class="pe-4 text-center">
                                        <?php if ($row->disponibilidad == 1): ?>
                                            <span class="badge bg-success shadow-sm px-3 py-1"><i class="fa-solid fa-circle-check me-1"></i> Disponible</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger shadow-sm px-3 py-1"><i class="fa-solid fa-circle-xmark me-1"></i> No Disp.</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>

                            <?php elseif ($tipo_reporte === 'fichas'): ?>
                                <tr class="report-row">
                                    <td class="ps-4 fw-bold text-primary">Ficha <?= $row->numero_ficha; ?></td>
                                    <td class="text-center font-monospace fw-bold text-secondary"><?= $row->cantidad_estudiantes; ?></td>
                                    <td class="text-center small font-monospace"><?= $row->fecha_inicio; ?></td>
                                    <td class="text-center small font-monospace"><span class="text-secondary"><?= $row->fecha_practicas; ?></span></td>
                                    <td class="text-center small font-monospace"><?= $row->fecha_fin; ?></td>
                                    <td class="fw-semibold text-dark"><?= htmlspecialchars($row->instructor_lider_nombre); ?></td>
                                    <td><div class="text-secondary small fw-medium" style="max-width: 200px;"><?= htmlspecialchars($row->programa_nombre); ?></div></td>
                                    <td class="pe-4 text-center"><span class="badge bg-light text-dark border px-3 py-1"><?= htmlspecialchars($row->jornada_nombre); ?></span></td>
                                </tr>

                            <?php elseif ($tipo_reporte === 'resultados'): ?>
                                <tr class="report-row">
                                    <td class="ps-4 font-monospace fw-bold text-primary"><?= htmlspecialchars($row->codigo); ?></td>
                                    <td><div class="text-dark small fw-medium text-wrap" style="max-width: 300px;"><?= htmlspecialchars($row->descripcion); ?></div></td>
                                    <td><div class="text-secondary small text-wrap" style="max-width: 250px;">[<?= htmlspecialchars($row->competencia_codigo); ?>] <?= htmlspecialchars($row->competencia_nombre); ?></div></td>
                                    <td><div class="text-black-50 small" style="max-width: 180px;"><?= htmlspecialchars($row->programa_nombre); ?></div></td>
                                    <td class="pe-4 text-center font-monospace fw-bold text-secondary"><?= $row->sesiones_asignadas; ?></td>
                                </tr>

                            <?php elseif ($tipo_reporte === 'asistencias'): ?>
                                <tr class="report-row">
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle bg-primary-subtle text-primary fw-bold me-2 d-flex align-items-center justify-content-center" style="width: 28px; height: 28px; border-radius: 50%; font-size: 11px;">
                                                <?= substr($row->aprendiz_nombre, 0, 1); ?>
                                            </div>
                                            <span class="fw-bold text-dark"><?= htmlspecialchars($row->aprendiz_nombre); ?></span>
                                        </div>
                                    </td>
                                    <td class="text-center fw-bold text-primary font-monospace">Ficha <?= $row->numero_ficha; ?></td>
                                    <td class="text-secondary small"><?= htmlspecialchars($row->instructor_nombre); ?></td>
                                    <td class="text-center"><span class="badge bg-light text-secondary border px-3 py-1 font-monospace"><?= $row->fecha_asistencia; ?></span></td>
                                    <td><div class="text-secondary small fw-medium" style="max-width: 220px;" title="<?= htmlspecialchars($row->competencia_nombre); ?>"><?= htmlspecialchars($row->competencia_nombre); ?></div></td>
                                    <td class="text-center">
                                        <?php if ($row->asistio == 1): ?>
                                            <span class="badge bg-success px-3 py-1 shadow-sm"><i class="fa-solid fa-check me-1"></i> Asistió</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger px-3 py-1 shadow-sm"><i class="fa-solid fa-xmark me-1"></i> Faltó</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="pe-4 text-muted small fst-italic" style="max-width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="<?= htmlspecialchars($row->observacion); ?>">
                                        <?= !empty($row->observacion) ? '"' . htmlspecialchars($row->observacion) . '"' : '<span class="text-black-50">Sin observaciones</span>'; ?>
                                    </td>
                                </tr>

                            <?php elseif ($tipo_reporte === 'novedades'): ?>
                                <tr class="report-row">
                                    <td class="ps-4 text-center font-monospace fw-bold text-secondary">#<?= $row->id_novedad; ?></td>
                                    <td class="fw-bold text-dark"><i class="fa-solid fa-building me-1 text-black-50"></i> <?= htmlspecialchars($row->ambiente_nombre); ?></td>
                                    <td class="fw-semibold text-dark"><?= htmlspecialchars($row->usuario_nombre); ?></td>
                                    <td class="text-secondary small text-wrap" style="max-width: 350px;"><?= htmlspecialchars($row->descripcion); ?></td>
                                    <td class="pe-4 text-center"><span class="badge bg-light text-secondary border px-3 py-1 font-monospace"><?= $row->fecha_reporte; ?></span></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Estilos CSS Personalizados (Fidedignos y de Impresión) -->
<style>
.sga-nav-pills .nav-link {
    text-decoration: none !important;
}

.sga-nav-pills {
    max-width: 100%;
    overflow-x: auto;
    white-space: nowrap;
}

.form-control {
    border-color: #dee2e6 !important;
    transition: all 0.2s ease-in-out;
}
.form-control:focus {
    border-color: #39A900 !important;
    box-shadow: 0 0 0 0.2rem rgba(57, 169, 0, 0.15) !important;
}

@media print {
    .sga-sidebar, 
    .sga-sidebar-user,
    .sga-menu-link,
    .logout,
    .footer-bottom,
    header,
    .sga-workspace-header,
    .no-print,
    .btn,
    .card-header,
    form,
    #sidebarBackdrop,
    .sga-sidebar-backdrop {
        display: none !important;
    }

    body, html {
        background-color: #ffffff !important;
        color: #000000 !important;
        margin: 0 !important;
        padding: 0 !important;
        font-family: Arial, sans-serif !important;
        font-size: 8.5pt !important;
    }
    
    .sga-app,
    .sga-workspace,
    .sga-content,
    .container-fluid,
    .card,
    .card-body {
        margin: 0 !important;
        padding: 0 !important;
        border: none !important;
        box-shadow: none !important;
        background: transparent !important;
        width: 100% !important;
    }

    .print-header {
        display: block !important;
        border-bottom: 2px solid #39A900 !important;
        margin-bottom: 20px !important;
    }

    table {
        width: 100% !important;
        border-collapse: collapse !important;
        margin-top: 10px !important;
        font-size: 8pt !important;
    }
    
    th, td {
        border: 1px solid #dddddd !important;
        padding: 5px 3px !important;
        text-align: left;
        vertical-align: middle !important;
    }
    
    th {
        background-color: #f2f2f2 !important;
        color: #000000 !important;
        font-weight: bold !important;
        text-transform: uppercase !important;
        font-size: 7.5pt !important;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }

    tr {
        page-break-inside: avoid !important;
    }

    .badge {
        border: 1px solid #ccc !important;
        background: transparent !important;
        color: #000 !important;
        padding: 1px 3px !important;
        font-size: 7pt !important;
    }

    .progress {
        display: none !important;
    }

    tbody tr[style*="display: none"] {
        display: none !important;
    }
}
</style>

<!-- Lógica JavaScript SPA Reactiva y Filtro Instantáneo -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const reportType = "<?= $tipo_reporte; ?>";
    const searchInput = document.getElementById("search-input");
    const btnLimpiar = document.getElementById("btn-limpiar");

    // 1. Filtrado de la tabla del lado del cliente
    function filtrarTabla() {
        const query = searchInput.value.toLowerCase().trim();
        const rows = document.querySelectorAll("#tabla-reporte tbody tr.report-row");
        let visibleCount = 0;

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            const matchesSearch = text.includes(query);

            if (matchesSearch) {
                row.style.display = "";
                visibleCount++;
            } else {
                row.style.display = "none";
            }
        });

        // Actualizar contador
        const totalBadge = document.getElementById("badge-total-registros");
        if (totalBadge) {
            totalBadge.textContent = `Mostrando: ${visibleCount} de ${rows.length}`;
        }

        // Mostrar u ocultar la fila de estado vacío
        const emptyRow = document.getElementById("empty-row");
        if (emptyRow) {
            emptyRow.style.display = (visibleCount === 0) ? "" : "none";
        }

        // Actualizar URLs de exportación
        updateExportUrls();
    }

    // 2. Modificar URLs de exportación con los parámetros activos
    function updateExportUrls() {
        const pdfBtn = document.getElementById("btn-export-pdf");
        const excelBtn = document.getElementById("btn-export-excel");
        
        if (!pdfBtn && !excelBtn) return;

        const params = new URLSearchParams();
        params.append("tipo_reporte", reportType);
        if (searchInput.value.trim() !== '') {
            params.append("search", searchInput.value.trim());
        }

        const queryStr = params.toString();
        
        if (pdfBtn) {
            pdfBtn.href = "<?= URLROOT; ?>/index.php?route=reportes/exportarPDF&" + queryStr;
        }
        if (excelBtn) {
            excelBtn.href = "<?= URLROOT; ?>/index.php?route=reportes/exportarExcel&" + queryStr;
        }
    }

    // 3. Limpiar filtro
    if (btnLimpiar) {
        btnLimpiar.addEventListener("click", function() {
            searchInput.value = "";
            filtrarTabla();
        });
    }

    // 4. Escuchar cambios en el input
    if (searchInput) {
        searchInput.addEventListener("input", filtrarTabla);
    }

    // Filtrado inicial
    filtrarTabla();
});
</script>
