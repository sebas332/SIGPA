<?php
/**
 * Vista show.php (Detalle de Ficha Académica)
 * Muestra la información general, aprendices matriculados,
 * clases asociadas del cronograma y el avance académico de la ficha.
 */
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$current_role = $current_role ?? $_SESSION['current_role'] ?? 'Aprendiz';

// Determinar el estado actual según la fecha
$hoy = date('Y-m-d');
$estado = 'Lectiva';
$estado_class = 'status-lectiva';

if ($ficha->fecha_fin === '1970-01-01') {
    $estado = 'Cancelada';
    $estado_class = 'status-cancelada';
} elseif ($hoy < $ficha->fecha_inicio) {
    $estado = 'Pendiente';
    $estado_class = 'status-pendiente';
} elseif ($hoy >= $ficha->fecha_inicio && $hoy < $ficha->fecha_practicas) {
    $estado = 'Lectiva';
    $estado_class = 'status-lectiva';
} elseif ($hoy >= $ficha->fecha_practicas && $hoy <= $ficha->fecha_fin) {
    $estado = 'Productiva';
    $estado_class = 'status-productiva';
} else {
    $estado = 'Finalizada';
    $estado_class = 'status-finalizada';
}
?>

<style>
    :root {
        --sena-primary: #39A900;
        --sena-primary-hover: #2e8800;
        --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        --card-shadow-hover: 0 10px 30px rgba(0, 0, 0, 0.08);
        --border-radius-lg: 16px;
        --border-radius-md: 12px;
    }

    .detail-container {
        font-family: 'Inter', sans-serif;
        background-color: #fafbfc;
        padding-bottom: 4rem;
    }

    /* Tarjeta de Encabezado Principal */
    .detail-header-card {
        background-color: #ffffff;
        border-radius: var(--border-radius-lg);
        box-shadow: var(--card-shadow);
        padding: 1.8rem 2.5rem;
        border: 1px solid rgba(0, 0, 0, 0.04);
        margin-bottom: 2rem;
    }
    .btn-back-sena {
        background-color: #f3f4f6;
        color: #4b5563;
        border: 1px solid #e5e7eb;
        border-radius: 20px;
        padding: 0.35rem 1rem;
        font-size: 0.82rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        text-decoration: none;
        transition: all 0.2s ease;
        margin-bottom: 1rem;
    }
    .btn-back-sena:hover {
        background-color: #e5e7eb;
        color: #1f2937;
    }
    .detail-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 0.25rem;
    }
    .detail-subtitle {
        font-size: 0.95rem;
        color: #6b7280;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    .btn-edit-ficha {
        background-color: #ea580c;
        color: #ffffff;
        font-weight: 600;
        border: none;
        border-radius: 20px;
        padding: 0.5rem 1.25rem;
        font-size: 0.88rem;
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(234, 88, 12, 0.15);
    }
    .btn-edit-ficha:hover {
        background-color: #d97706;
        color: #ffffff;
    }
    .btn-delete-ficha-text {
        background-color: #fef2f2;
        color: #dc2626;
        font-weight: 600;
        border: 1px solid #fecaca;
        border-radius: 20px;
        padding: 0.5rem 1.25rem;
        font-size: 0.88rem;
        transition: all 0.2s ease;
    }
    .btn-delete-ficha-text:hover {
        background-color: #fee2e2;
        color: #b91c1c;
    }

    /* Badges de Estado */
    .status-badge {
        font-size: 0.72rem;
        font-weight: 700;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        display: inline-block;
        letter-spacing: 0.3px;
        text-transform: uppercase;
    }
    .status-lectiva { background-color: #e2f6e9; color: #157347; }
    .status-productiva { background-color: #fff3cd; color: #b58100; }
    .status-pendiente { background-color: #e7eafc; color: #3f51b5; }
    .status-finalizada { background-color: #f1f3f5; color: #6c757d; }
    .status-cancelada { background-color: #fde8e8; color: #e53e3e; }

    /* Tarjetas de Información General y Aprendices */
    .content-panel-card {
        background-color: #ffffff;
        border-radius: var(--border-radius-lg);
        box-shadow: var(--card-shadow);
        border: 1px solid rgba(0, 0, 0, 0.04);
        padding: 1.8rem;
        height: 100%;
    }
    .panel-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .panel-title i {
        color: var(--sena-primary);
    }
    
    /* Filas de Información General */
    .info-row {
        background-color: #f9fafb;
        border-radius: var(--border-radius-md);
        padding: 1rem 1.25rem;
        margin-bottom: 0.8rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border: 1px solid #f3f4f6;
    }
    .info-row-label {
        font-size: 0.75rem;
        font-weight: 700;
        color: #9ca3af;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .info-row-val {
        font-size: 0.95rem;
        font-weight: 700;
        color: #1f2937;
    }

    /* Lista de Aprendices */
    .btn-matricular-small {
        background-color: #e6f6df;
        color: var(--sena-primary);
        font-size: 0.8rem;
        font-weight: 700;
        border: 1px solid var(--sena-light-green);
        border-radius: 20px;
        padding: 0.35rem 0.9rem;
        transition: all 0.2s ease;
        text-decoration: none;
    }
    .btn-matricular-small:hover {
        background-color: var(--sena-primary);
        color: #ffffff;
    }
    .aprendiz-list-wrapper {
        max-height: 480px;
        overflow-y: auto;
        padding-right: 0.25rem;
    }
    .aprendiz-row {
        background-color: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: var(--border-radius-md);
        padding: 0.85rem 1.1rem;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: border 0.15s ease;
    }
    .aprendiz-row:hover {
        border-color: var(--sena-primary);
    }
    .avatar-initials-large {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background-color: #e0f2fe;
        color: #0369a1;
        font-weight: 700;
        font-size: 0.88rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .aprendiz-name {
        font-size: 0.9rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 0.1rem;
    }
    .aprendiz-meta {
        font-size: 0.75rem;
        color: #6b7280;
    }
    .btn-unlink-aprendiz {
        background-color: #fff5f5;
        color: #e53e3e;
        border: 1px solid #fed7d7;
        font-size: 0.78rem;
        font-weight: 600;
        border-radius: 20px;
        padding: 0.25rem 0.75rem;
        transition: all 0.15s ease;
        text-decoration: none;
    }
    .btn-unlink-aprendiz:hover {
        background-color: #e53e3e;
        color: #ffffff;
    }

    /* Cronograma y Clases */
    .schedule-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.25rem;
    }
    .schedule-card {
        background-color: #ffffff;
        border-radius: var(--border-radius-md);
        border: 1px solid #e5e7eb;
        padding: 1.25rem;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
        position: relative;
    }
    .schedule-card:hover {
        border-color: var(--sena-primary);
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
    }
    .schedule-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.9rem;
    }
    .schedule-day-badge {
        font-size: 0.72rem;
        font-weight: 700;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        background-color: #e6f6df;
        color: var(--sena-primary);
        text-transform: uppercase;
    }
    .schedule-sessions-count {
        font-size: 0.75rem;
        font-weight: 600;
        color: #6b7280;
    }
    .schedule-instructor {
        font-size: 0.95rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 0.2rem;
    }
    .schedule-environment {
        font-size: 0.8rem;
        color: #6b7280;
        display: flex;
        align-items: center;
        gap: 0.3rem;
        margin-bottom: 0.9rem;
    }
    .schedule-rap-box {
        font-size: 0.8rem;
        border-top: 1px solid #f3f4f6;
        padding-top: 0.75rem;
        color: #4b5563;
        line-height: 1.35;
    }

    /* Panel Resumen de Avance */
    .progress-box {
        background-color: #f8fafc;
        border-radius: var(--border-radius-md);
        padding: 1.25rem;
        border: 1px solid #f1f5f9;
        margin-bottom: 1.5rem;
    }
    .progress-number-row {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 0.8rem;
        margin-bottom: 1.25rem;
        text-align: center;
    }
    .progress-num-item {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 0.6rem 0.5rem;
    }
    .progress-num-val {
        font-size: 1.25rem;
        font-weight: 700;
        color: #0f172a;
    }
    .progress-num-lbl {
        font-size: 0.65rem;
        font-weight: 700;
        color: #64748b;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        margin-top: 0.1rem;
    }
</style>

<div class="detail-container container-fluid px-0">


    <!-- Encabezado Principal -->
    <div class="detail-header-card d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <div>
            <div class="detail-title">Detalle de Ficha: <?= $ficha->numero_ficha; ?></div>
            <div class="detail-subtitle">
                <span><?= htmlspecialchars($ficha->programa_nombre); ?></span>
                <span>•</span>
                <span>Jornada: <span class="badge bg-light text-dark border px-2.5 py-1 rounded-pill" style="font-size: 0.72rem;"><?= htmlspecialchars($ficha->jornada_nombre); ?></span></span>
                <span>•</span>
                <span class="status-badge <?= $estado_class; ?>"><?= $estado; ?></span>
            </div>
        </div>
        
        <?php if ($current_role === 'Coordinador'): ?>
            <div class="d-flex gap-2">
                <button type="button" class="btn-edit-ficha" data-bs-toggle="modal" data-bs-target="#modalEditarFicha">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square me-1" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                    </svg> Editar Ficha
                </button>
                <button type="button" class="btn-delete-ficha-text btn-delete-ficha-action" 
                        data-ficha="<?= $ficha->numero_ficha; ?>" 
                        data-url="<?= URLROOT; ?>/index.php?route=fichas/delete&id=<?= $ficha->numero_ficha; ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill me-1" viewBox="0 0 16 16">
                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                    </svg> Eliminar Ficha
                </button>
            </div>
        <?php endif; ?>
    </div>

    <!-- Primera Fila: Información General y Aprendices Matriculados -->
    <div class="row g-4 mb-4">
        <!-- Información General -->
        <div class="col-12 col-lg-5">
            <div class="content-panel-card">
                <div class="panel-title"><i class="fa-solid fa-circle-info"></i> Información General</div>
                
                <div class="info-row">
                    <span class="info-row-label"><i class="fa-solid fa-user-tie"></i> Instructor Líder</span>
                    <span class="info-row-val"><?= htmlspecialchars($ficha->instructor_nombre . ' ' . $ficha->instructor_apellido); ?></span>
                </div>
                <div class="info-row">
                    <span class="info-row-label"><i class="fa-solid fa-users"></i> Cupos Autorizados</span>
                    <span class="info-row-val"><?= $ficha->cantidad_estudiantes; ?> aprendices</span>
                </div>
                <div class="info-row">
                    <span class="info-row-label"><i class="fa-solid fa-calendar-day"></i> Fecha Inicio</span>
                    <span class="info-row-val"><?= $ficha->fecha_inicio; ?></span>
                </div>
                <div class="info-row" style="background-color: #fffbeb; border-color: #fef3c7;">
                    <span class="info-row-label text-warning" style="color: #b45309;"><i class="fa-solid fa-briefcase"></i> Fecha Prácticas</span>
                    <span class="info-row-val" style="color: #b45309;"><?= $ficha->fecha_practicas; ?></span>
                </div>
                <div class="info-row" style="background-color: #fef2f2; border-color: #fee2e2;">
                    <span class="info-row-label text-danger" style="color: #b91c1c;"><i class="fa-solid fa-flag-checkered"></i> Fecha Fin</span>
                    <span class="info-row-val" style="color: #b91c1c;"><?= $ficha->fecha_fin; ?></span>
                </div>
            </div>
        </div>

        <!-- Aprendices Inscritos -->
        <div class="col-12 col-lg-7">
            <div class="content-panel-card">
                <div class="panel-header d-flex justify-content-between align-items-center mb-4">
                    <div class="panel-title mb-0"><i class="fa-solid fa-user-graduate"></i> Aprendices Inscritos (<?= count($aprendices); ?>)</div>
                    <?php if ($current_role === 'Coordinador'): ?>
                        <button type="button" class="btn-matricular-small" data-bs-toggle="modal" data-bs-target="#modalInscribirAprendiz">
                            <i class="fa-solid fa-plus me-1"></i> Matricular Aprendiz
                        </button>
                    <?php endif; ?>
                </div>

                <div class="aprendiz-list-wrapper">
                    <?php if (empty($aprendices)): ?>
                        <div class="p-5 text-center text-muted">
                            <i class="fa-solid fa-users-slash fa-3x mb-3 text-secondary"></i>
                            <h6 class="fw-bold">No hay aprendices matriculados en esta ficha</h6>
                            <p class="small mb-0">Utiliza la opción de matricular para registrar estudiantes en este grupo.</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($aprendices as $ap): 
                            $iniciales = substr($ap->nombre, 0, 1) . substr($ap->apellido, 0, 1);
                        ?>
                            <div class="aprendiz-row">
                                <div class="d-flex align-items-center gap-3">
                                    <?php if (!empty($ap->foto) && is_file(dirname(__DIR__, 2) . '/public/uploads/profile/' . $ap->foto)): ?>
                                        <img src="<?= ASSETROOT; ?>/uploads/profile/<?= rawurlencode($ap->foto); ?>" alt="Foto" style="width: 44px; height: 44px; border-radius: 50%; object-fit: cover;">
                                    <?php else: ?>
                                        <div class="avatar-initials-large"><?= $iniciales; ?></div>
                                    <?php endif; ?>
                                    <div>
                                        <div class="aprendiz-name"><?= htmlspecialchars($ap->nombre . ' ' . $ap->apellido); ?></div>
                                        <div class="aprendiz-meta">Doc: <?= htmlspecialchars($ap->documento ?? 'N/A'); ?> • <?= htmlspecialchars($ap->correo); ?></div>
                                    </div>
                                </div>
                                <?php if ($current_role === 'Coordinador'): ?>
                                    <button class="btn-unlink-aprendiz btn-remover-aprendiz-action" 
                                            data-url="<?= URLROOT; ?>/index.php?route=fichas/removerAprendiz&id=<?= $ap->id_ficha_aprendiz; ?>&ficha=<?= $ficha->numero_ficha; ?>"
                                            data-nombre="<?= htmlspecialchars($ap->nombre . ' ' . $ap->apellido); ?>">
                                        Desvincular
                                    </button>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Segunda Fila: Resumen de Avance y Competencias -->
    <div class="row g-4 mb-4">
        <div class="col-12">
            <div class="content-panel-card">
                <div class="panel-title"><i class="fa-solid fa-chart-line"></i> Resumen de Avance y Competencias</div>
                
                <div class="row g-4">
                    <div class="col-12 col-md-4">
                        <div class="progress-box">
                            <div class="progress-number-row">
                                <div class="progress-num-item">
                                    <div class="progress-num-val"><?= $total_sesiones_programadas; ?></div>
                                    <div class="progress-num-lbl">Sesiones Prog.</div>
                                </div>
                                <div class="progress-num-item">
                                    <div class="progress-num-val" style="color:var(--sena-primary);"><?= $sesiones_realizadas; ?></div>
                                    <div class="progress-num-lbl">Realizadas</div>
                                </div>
                                <div class="progress-num-item">
                                    <div class="progress-num-val" style="color:#ea580c;"><?= $sesiones_pendientes; ?></div>
                                    <div class="progress-num-lbl">Pendientes</div>
                                </div>
                            </div>
                            
                            <!-- Barra de progreso -->
                            <div class="mb-2 d-flex justify-content-between font-semibold" style="font-size:0.82rem; color:#475569;">
                                <span>Progreso Académico</span>
                                <span><?= $porcentaje_avance; ?>% completado</span>
                            </div>
                            <div class="progress" style="height: 8px; border-radius: 4px; background-color:#e2e8f0; overflow:hidden;">
                                <div class="progress-bar" role="progressbar" style="width: <?= $porcentaje_avance; ?>%; background-color: var(--sena-primary); border-radius:4px;" aria-valuenow="<?= $porcentaje_avance; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Competencias y Resultados del Programa -->
                    <div class="col-12 col-md-8 border-md-start px-md-4">
                        <h6 class="fw-bold text-dark mb-3"><i class="fa-solid fa-book-bookmark text-success me-1"></i> Competencias y Resultados del Programa</h6>
                        <?php if (empty($competencias_programa)): ?>
                            <div class="alert alert-light text-center border text-muted">
                                <i class="fa-solid fa-folder-open mb-2 fs-4"></i><br>
                                No hay competencias asociadas a este programa.
                            </div>
                        <?php else: ?>
                            <div class="accordion accordion-flush shadow-sm border rounded-3" id="accordionCompetenciasFicha">
                                <?php foreach ($competencias_programa as $index => $comp): ?>
                                    <div class="accordion-item bg-white border-bottom">
                                        <h2 class="accordion-header" id="headingComp_<?= $comp->id_competencia; ?>">
                                            <button class="accordion-button collapsed fw-bold text-dark p-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseComp_<?= $comp->id_competencia; ?>" aria-expanded="false" aria-controls="collapseComp_<?= $comp->id_competencia; ?>" style="font-size: 0.9rem;">
                                                <i class="fa-solid fa-bookmark text-success me-2"></i> <?= htmlspecialchars($comp->codigo); ?> - <?= htmlspecialchars($comp->nombre); ?>
                                                <span class="badge bg-light text-dark border ms-3"><?= $comp->horas_totales; ?> hrs</span>
                                            </button>
                                        </h2>
                                        <div id="collapseComp_<?= $comp->id_competencia; ?>" class="accordion-collapse collapse" aria-labelledby="headingComp_<?= $comp->id_competencia; ?>" data-bs-parent="#accordionCompetenciasFicha">
                                            <div class="accordion-body p-3 bg-light">
                                                <?php 
                                                $raps = $resultados_programa[$comp->id_competencia] ?? [];
                                                if (empty($raps)): ?>
                                                    <div class="text-danger small"><i class="fa-solid fa-triangle-exclamation"></i> Sin resultados de aprendizaje</div>
                                                <?php else: ?>
                                                    <ul class="list-group list-group-flush rounded-3 border">
                                                        <?php foreach ($raps as $ra): ?>
                                                            <li class="list-group-item d-flex flex-column bg-white">
                                                                <span class="fw-bold text-primary small"><?= htmlspecialchars($ra->codigo); ?></span>
                                                                <span class="text-secondary small mt-1"><?= htmlspecialchars($ra->descripcion); ?></span>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tercera Fila: Cronograma y Clases Asociadas -->
    <div class="content-panel-card">
        <div class="panel-title"><i class="fa-solid fa-calendar-days"></i> Cronograma y Clases Asociadas</div>
        
        <?php if (empty($programacion)): ?>
            <div class="p-5 text-center text-muted border rounded-4 bg-light">
                <i class="fa-solid fa-calendar-xmark fa-3x mb-3 text-secondary"></i>
                <h6 class="fw-bold">No hay clases programadas para esta ficha</h6>
                <p class="small mb-0">Asigna horarios para que aparezcan en el calendario académico del grupo.</p>
            </div>
        <?php else: ?>
            <div class="schedule-grid">
                <?php foreach ($programacion as $prog): ?>
                    <div class="schedule-card">
                        <div class="schedule-header">
                            <span class="schedule-day-badge"><?= htmlspecialchars($prog->nombre_dia); ?></span>
                            <span class="schedule-sessions-count"><?= $prog->total_sesiones; ?> Sesiones</span>
                        </div>
                        <div class="schedule-instructor"><?= htmlspecialchars($prog->instructor_nombre . ' ' . $prog->instructor_apellido); ?></div>
                        <div class="schedule-environment">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-geo-alt-fill text-danger" viewBox="0 0 16 16">
                                <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/>
                            </svg>
                            <span><?= htmlspecialchars($prog->ambiente_nombre); ?></span>
                        </div>
                        <div class="schedule-rap-box">
                            <strong>RAP:</strong> <?= htmlspecialchars($prog->ra_descripcion); ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- ==============================================
     MODALES DEL DETALLE
     ============================================== -->

<?php if ($current_role === 'Coordinador'): ?>
<!-- Modal Inscribir Aprendiz -->
<div class="modal fade" id="modalInscribirAprendiz" tabindex="-1" aria-labelledby="modalInscribirAprendizLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header bg-dark text-white p-4 border-0">
                <h5 class="modal-title fw-bold" id="modalInscribirAprendizLabel">
                    <i class="fa-solid fa-user-plus me-2 text-success"></i> Matricular Aprendiz en Ficha
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <form action="<?= URLROOT; ?>/index.php?route=fichas/inscribirAprendiz" method="POST">
                <div class="modal-body p-4">
                    <input type="hidden" name="numero_ficha" value="<?= $ficha->numero_ficha; ?>">
                    <div class="mb-3">
                        <label for="id_usuario_aprendiz" class="form-label fw-semibold text-secondary">Seleccionar Aprendiz Candidato</label>
                        <select class="form-select form-select-lg rounded-3" id="id_usuario_aprendiz" name="id_usuario_aprendiz" required>
                            <option value="">Selecciona un aprendiz...</option>
                            <?php foreach ($candidatos as $cand): ?>
                                <option value="<?= $cand->id_usuario; ?>"><?= htmlspecialchars($cand->nombre . ' ' . $cand->apellido . ' (' . $cand->documento . ')'); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer p-4 border-0 bg-light">
                    <button type="button" class="btn btn-outline-secondary px-4 py-2" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-sena-success px-4 py-2"><i class="fa-solid fa-check"></i> Inscribir Aprendiz</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Editar Ficha -->
<div class="modal fade" id="modalEditarFicha" tabindex="-1" aria-labelledby="modalEditarFichaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header bg-warning text-dark p-4 border-0">
                <h5 class="modal-title fw-bold" id="modalEditarFichaLabel">
                    <i class="fa-solid fa-pen-to-square me-2"></i> Editar Datos de Ficha
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <form action="<?= URLROOT; ?>/index.php?route=fichas/update" method="POST" id="form-editar-ficha-detail">
                <input type="hidden" name="from_show" value="1">
                <input type="hidden" name="numero_ficha_original" value="<?= $ficha->numero_ficha; ?>">
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-secondary">Número de Ficha</label>
                            <input type="number" class="form-control form-control-lg rounded-3 bg-light border-0 fw-bold" name="numero_ficha" value="<?= $ficha->numero_ficha; ?>" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="edit_cantidad_estudiantes" class="form-label fw-semibold text-secondary">Cupos Autorizados</label>
                            <input type="number" class="form-control form-control-lg rounded-3" id="edit_cantidad_estudiantes" name="cantidad_estudiantes" value="<?= $ficha->cantidad_estudiantes; ?>" required>
                        </div>
                        <div class="col-md-12">
                            <label for="edit_id_programa" class="form-label fw-semibold text-secondary">Programa de Formación</label>
                            <select class="form-select form-select-lg rounded-3" id="edit_id_programa" name="id_programa" required>
                                <?php foreach ($programas as $prog): ?>
                                    <option value="<?= $prog->id_programa; ?>" <?= ($prog->id_programa == $ficha->id_programa) ? 'selected' : ''; ?>>
                                        <?= htmlspecialchars($prog->nombre) . ' (' . $prog->codigo . ')'; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="edit_instructor_lider" class="form-label fw-semibold text-secondary">Instructor Líder</label>
                            <select class="form-select form-select-lg rounded-3" id="edit_instructor_lider" name="id_usuario_instructor_lider" required>
                                <?php foreach ($instructores as $inst): ?>
                                    <option value="<?= $inst->id_usuario; ?>" <?= ($inst->id_usuario == $ficha->id_usuario_instructor_lider) ? 'selected' : ''; ?>>
                                        <?= htmlspecialchars($inst->nombre . ' ' . $inst->apellido); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="edit_jornada" class="form-label fw-semibold text-secondary">Jornada</label>
                            <select class="form-select form-select-lg rounded-3" id="edit_jornada" name="id_jornada" required>
                                <?php foreach ($jornadas as $jor): ?>
                                    <option value="<?= $jor->id_jornada; ?>" <?= ($jor->id_jornada == $ficha->id_jornada) ? 'selected' : ''; ?>>
                                        <?= htmlspecialchars($jor->nombre); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="edit_fecha_inicio" class="form-label fw-semibold text-secondary">Fecha Inicio</label>
                            <input type="date" class="form-control form-control-lg rounded-3" id="edit_fecha_inicio" name="fecha_inicio" value="<?= $ficha->fecha_inicio; ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label for="edit_fecha_practicas" class="form-label fw-semibold text-secondary">Fecha Prácticas</label>
                            <input type="date" class="form-control form-control-lg rounded-3" id="edit_fecha_practicas" name="fecha_practicas" value="<?= $ficha->fecha_practicas; ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label for="edit_fecha_fin" class="form-label fw-semibold text-secondary">Fecha Fin</label>
                            <input type="date" class="form-control form-control-lg rounded-3" id="edit_fecha_fin" name="fecha_fin" value="<?= $ficha->fecha_fin; ?>" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-4 border-0 bg-light">
                    <button type="button" class="btn btn-outline-secondary px-4 py-2" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-warning fw-semibold px-4 py-2 text-dark"><i class="fa-solid fa-floppy-disk"></i> Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- ==============================================
     SCRIPTS DE CONFIRMACIÓN Y VALIDACIÓN (DETAIL)
     ============================================== -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Alertas de Desvinculación de Aprendiz
    document.querySelectorAll('.btn-remover-aprendiz-action').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const url = this.getAttribute('data-url');
            const nombre = this.getAttribute('data-nombre');

            Swal.fire({
                title: '¿Desvincular Aprendiz?',
                html: `¿Estás seguro de que deseas desvincular a <strong>${nombre}</strong> de esta ficha académica?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6b7280',
                confirmButtonText: '<i class="fa-solid fa-user-minus me-1"></i> Sí, desvincular',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        });
    });

    // Alerta de Eliminación de Ficha Completa
    const btnDelete = document.querySelector('.btn-delete-ficha-action');
    if (btnDelete) {
        btnDelete.addEventListener('click', function(e) {
            e.preventDefault();
            const url = this.getAttribute('data-url');
            const numFicha = this.getAttribute('data-ficha');

            Swal.fire({
                title: `¿Eliminar Ficha #${numFicha}?`,
                text: "Esta acción eliminará de forma permanente el grupo. Se validará que no tenga aprendices, programaciones o asistencias vigentes.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6b7280',
                confirmButtonText: '<i class="fa-solid fa-trash-can me-1"></i> Sí, eliminar ficha',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        });
    }

    // Validación asíncrona del formulario de edición en el detalle
    const formEditarFichaDetail = document.getElementById('form-editar-ficha-detail');
    if (formEditarFichaDetail) {
        formEditarFichaDetail.addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            formData.append('is_ajax', '1');

            const btnSubmit = this.querySelector('button[type="submit"]');
            const btnHtml = btnSubmit.innerHTML;
            btnSubmit.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Guardando...';
            btnSubmit.disabled = true;

            try {
                const response = await fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });
                const result = await response.json();

                if (result.status === 'success') {
                    const modalInst = bootstrap.Modal.getInstance(document.getElementById('modalEditarFicha'));
                    if (modalInst) modalInst.hide();

                    Swal.fire({
                        icon: 'success',
                        title: 'Ficha Actualizada',
                        text: 'Los cambios se han guardado con éxito.',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error de Validación',
                        html: result.message
                    });
                }
            } catch(err) {
                console.error(err);
                Swal.fire('Error', 'No se pudo comunicar con el servidor.', 'error');
            } finally {
                btnSubmit.innerHTML = btnHtml;
                btnSubmit.disabled = false;
            }
        });
    }
});
</script>
