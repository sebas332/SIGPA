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


    <!-- Botón Volver Atrás -->
    <div class="mb-3">
        <a href="javascript:history.back()" class="btn-back-sena">
            <i class="fa-solid fa-arrow-left"></i> Volver Atrás
        </a>
    </div>

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
                        <button type="button" class="btn-matricular-small" data-bs-toggle="modal" data-bs-target="#modalAsociarAprendices">
                            <i class="fa-solid fa-plus me-1"></i> Asociar Aprendiz
                        </button>
                    <?php endif; ?>
                </div>

                <div class="aprendiz-list-wrapper">
                    <?php if (empty($aprendices)): ?>
                        <div class="p-5 text-center text-muted">
                            <i class="fa-solid fa-users-slash fa-3x mb-3 text-secondary"></i>
                            <h6 class="fw-bold">No hay aprendices asociados a esta ficha</h6>
                            <p class="small mb-0">Utiliza la opción de asociar para registrar estudiantes en este grupo.</p>
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
                            <div class="mt-4 mb-2 d-flex justify-content-between font-semibold align-items-center" style="font-size:0.82rem; color:#475569;">
                                <span>Progreso de Horas</span>
                                <span><span style="color:var(--sena-primary); font-weight:bold;"><?= $horas_realizadas; ?></span> / <?= $total_horas_programadas; ?> hrs (<?= $porcentaje_avance; ?>%)</span>
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
                                            <div class="d-flex bg-white">
                                                <button class="accordion-button collapsed fw-bold text-dark p-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseComp_<?= $comp->id_competencia; ?>" aria-expanded="false" aria-controls="collapseComp_<?= $comp->id_competencia; ?>" style="font-size: 0.9rem;">
                                                    <i class="fa-solid fa-bookmark text-success me-2"></i> <?= htmlspecialchars($comp->codigo); ?> - <?= htmlspecialchars($comp->nombre); ?>
                                                    <span class="badge bg-light text-dark border ms-3"><?= $comp->horas_totales; ?> hrs</span>
                                                </button>
                                                <?php if ($current_role === 'Coordinador'): ?>
                                                    <div class="d-flex align-items-center pe-3 border-start">
                                                        <button type="button" class="btn btn-sm btn-outline-warning fw-bold text-nowrap btn-modificar-competencia" 
                                                                data-bs-toggle="modal" data-bs-target="#modalCompetencia"
                                                                onclick="cargarDatosModalCompetencia(this)"
                                                                data-id-competencia="<?= $comp->id_competencia; ?>"
                                                                data-codigo="<?= htmlspecialchars($comp->codigo); ?>"
                                                                data-nombre="<?= htmlspecialchars($comp->nombre); ?>"
                                                                data-horas-totales="<?= $comp->horas_totales; ?>"
                                                                data-resultados-totales="<?= $comp->resultados_totales; ?>"
                                                                data-porcentaje="<?= $comp->porcentaje; ?>"
                                                                data-horas-ejecutar="<?= $comp->horas_a_ejecutar; ?>">
                                                            <i class="fa-solid fa-sliders"></i> Modificar Competencia
                                                        </button>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </h2>
                                        <div id="collapseComp_<?= $comp->id_competencia; ?>" class="accordion-collapse collapse" aria-labelledby="headingComp_<?= $comp->id_competencia; ?>" data-bs-parent="#accordionCompetenciasFicha">
                                            <div class="accordion-body p-3 bg-light">
                                                <?php 
                                                $raps = $resultados_programa[$comp->id_competencia] ?? [];
                                                if (empty($raps)): ?>
                                                    <div class="text-danger small"><i class="fa-solid fa-triangle-exclamation"></i> Sin resultados de aprendizaje</div>
                                                <?php else: ?>
                                                    <ul class="list-group list-group-flush rounded-3 border">
                                                        <?php foreach ($raps as $ra): 
                                                            $prog_ra = $progreso_raps[$ra->id_resultado] ?? null;
                                                            $pct_ra = $prog_ra && $prog_ra['total_sesiones'] > 0 ? round(($prog_ra['sesiones_realizadas'] / $prog_ra['total_sesiones']) * 100) : 0;
                                                        ?>
                                                            <li class="list-group-item d-flex flex-column bg-white">
                                                                <div class="d-flex justify-content-between align-items-start">
                                                                    <span class="fw-bold text-primary small pe-2"><?= htmlspecialchars($ra->codigo); ?></span>
                                                                    <?php if ($prog_ra): ?>
                                                                        <span class="badge bg-light text-dark border" style="font-size: 0.7rem;">
                                                                            <span class="text-success"><?= $prog_ra['sesiones_realizadas'] ?></span>/<?= $prog_ra['total_sesiones'] ?> Ses 
                                                                            (<span class="text-success"><?= $prog_ra['horas_realizadas'] ?></span>/<?= $prog_ra['total_horas'] ?> hrs)
                                                                        </span>
                                                                    <?php else: ?>
                                                                        <span class="badge bg-light text-muted border" style="font-size: 0.7rem;">Sin iniciar</span>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <span class="text-secondary small mt-1"><?= htmlspecialchars($ra->descripcion); ?></span>
                                                                
                                                                <?php if ($prog_ra): ?>
                                                                <div class="progress mt-2" style="height: 4px; border-radius: 2px;">
                                                                    <div class="progress-bar <?= $pct_ra >= 100 ? 'bg-success' : 'bg-primary' ?>" role="progressbar" style="width: <?= $pct_ra; ?>%;" aria-valuenow="<?= $pct_ra; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                                <?php endif; ?>
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
<style>
    .ficha-create-dialog { max-width: 920px; }
    .ficha-create-content { border: 0; border-radius: 18px; overflow: hidden; box-shadow: 0 26px 70px rgba(15, 23, 42, 0.28); }
    .ficha-create-header { background: linear-gradient(135deg, #046b31 0%, #0b8e43 62%, #119b4d 100%); color: #ffffff; border: 0; min-height: 112px; padding: 1.45rem 1.9rem; }
    .ficha-create-header-icon { width: 64px; height: 64px; border-radius: 50%; background: #e3f7ea; color: #0b8e43; display: inline-flex; align-items: center; justify-content: center; font-size: 1.85rem; flex: 0 0 auto; margin-right: 1rem; }
    .ficha-create-title { font-size: 1.55rem; font-weight: 800; line-height: 1.15; letter-spacing: 0; margin-bottom: 0; color: #ffffff; }
    .ficha-create-subtitle { font-size: 0.95rem; color: #e3f7ea; font-weight: 500; opacity: 0.9; }
    .ficha-create-close { background-color: rgba(255,255,255,0.1); border-radius: 50%; width: 38px; height: 38px; opacity: 1; transition: all 0.2s; filter: invert(1) grayscale(100%) brightness(200%); }
    .ficha-create-close:hover { background-color: rgba(255,255,255,0.25); transform: rotate(90deg); }
    .ficha-create-body { padding: 2.2rem; background-color: #f8fafc; }
    .ficha-create-footer { padding: 1.4rem 2.2rem; background-color: #ffffff; border-top: 1px solid #e2e8f0; border-bottom-left-radius: 18px; border-bottom-right-radius: 18px; gap: 1rem; }
    .ficha-create-cancel { border-radius: 30px; font-weight: 600; padding: 0.6rem 1.8rem; border: 1px solid #cbd5e1; color: #475569; background: white; transition: all 0.2s; }
    .ficha-create-cancel:hover { background: #f1f5f9; color: #1e293b; border-color: #94a3b8; }
    .ficha-create-save { border-radius: 30px; font-weight: 700; padding: 0.6rem 2.2rem; background: #0b8e43; color: white; border: none; box-shadow: 0 4px 15px rgba(11, 142, 67, 0.25); transition: all 0.3s; }
    .ficha-create-save:hover { background: #046b31; transform: translateY(-2px); box-shadow: 0 6px 20px rgba(11, 142, 67, 0.35); color: white; }
</style>

<?php if ($current_role === 'Coordinador'): ?>
<!-- Modal Asociar Aprendices -->
<div class="modal fade" id="modalAsociarAprendices" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden bg-white">
            <div class="modal-header bg-white border-bottom p-4">
                <div class="d-flex align-items-center">
                    <div class="bg-success-subtle rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 48px; height: 48px;">
                        <i class="fa-solid fa-users text-success fs-4"></i>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold mb-0">Asociar Aprendices</h5>
                        <p class="mb-0 small text-secondary">Selecciona los aprendices a vincular con esta ficha.</p>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body p-4 bg-light">
                <div class="mb-3">
                    <div class="input-group input-group-lg shadow-sm rounded-3">
                        <span class="input-group-text bg-white border-end-0 text-muted"><i class="fa-solid fa-search"></i></span>
                        <input type="text" id="buscarAprendizInput" class="form-control border-start-0" placeholder="Buscar por nombre o documento...">
                    </div>
                </div>
                
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush rounded-4" id="listaAprendicesAsociar" style="max-height: 40vh; overflow-y: auto;">
                            <?php if (empty($candidatos)): ?>
                                <li class="list-group-item p-4 text-center text-muted">
                                    <i class="fa-solid fa-check-circle fs-3 mb-2 text-success"></i><br>
                                    No hay aprendices disponibles para asociar.
                                </li>
                            <?php else: ?>
                                <?php foreach($candidatos as $cand): ?>
                                    <li class="list-group-item d-flex align-items-center p-3 aprendiz-item-asociar">
                                        <input class="form-check-input me-3 fs-5 checkbox-aprendiz-asociar" type="checkbox" value="<?= $cand->id_usuario; ?>" id="cand_<?= $cand->id_usuario; ?>">
                                        <label class="form-check-label w-100 cursor-pointer d-flex justify-content-between align-items-center" for="cand_<?= $cand->id_usuario; ?>">
                                            <div>
                                                <span class="fw-bold d-block text-dark aprendiz-nombre-asociar"><?= htmlspecialchars($cand->nombre . ' ' . $cand->apellido); ?></span>
                                                <small class="text-secondary aprendiz-documento-asociar">Doc: <?= htmlspecialchars($cand->documento); ?> • <?= htmlspecialchars($cand->correo); ?></small>
                                            </div>
                                        </label>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-white border-top p-4 d-flex justify-content-end gap-2">
                <button type="button" class="btn btn-light fw-medium shadow-sm px-4" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success fw-medium shadow-sm px-4" id="btnGuardarAsociacionAprendices">
                    <i class="fa-solid fa-save me-1"></i> Asociar Seleccionados
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Ficha -->
<div class="modal fade" id="modalEditarFicha" tabindex="-1" aria-labelledby="modalEditarFichaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg ficha-create-content">
            <div class="modal-header ficha-create-header">
                <div class="d-flex align-items-center gap-3">
                    <span class="ficha-create-header-icon" aria-hidden="true">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </span>
                    <div>
                        <h5 class="modal-title ficha-create-title" id="modalEditarFichaLabel">Editar Datos de Ficha</h5>
                    </div>
                </div>
                <button type="button" class="btn-close ficha-create-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
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
                <div class="modal-footer ficha-create-footer">
                    <button type="button" class="btn ficha-create-cancel" data-bs-dismiss="modal"><i class="fa-regular fa-circle-xmark"></i> Cancelar</button>
                    <button type="submit" class="btn ficha-create-save"><i class="fa-solid fa-floppy-disk"></i> Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if ($current_role === 'Coordinador'): ?>
<!-- Modal Tabla de Control por Competencia -->
<div class="modal fade" id="modalCompetencia" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg ficha-create-content">
            <div class="modal-header ficha-create-header">
                <div class="d-flex align-items-center gap-3">
                    <span class="ficha-create-header-icon" aria-hidden="true">
                        <i class="fa-solid fa-layer-group"></i>
                    </span>
                    <div>
                        <h5 class="modal-title ficha-create-title">Tabla de Control: Ajuste de Competencia</h5>
                    </div>
                </div>
                <button type="button" class="btn-close ficha-create-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            
            <form action="<?= URLROOT; ?>/index.php?route=fichas/guardarAjusteMasivo" method="POST">
                <div class="modal-body p-4 bg-light">
                    <input type="hidden" name="numero_ficha" value="<?= $ficha->numero_ficha; ?>">
                    <input type="hidden" name="id_competencia" id="modal_id_competencia">
                    
                    <h5 class="fw-bold text-dark mb-2" id="modal_nombre_competencia"></h5>
                    <div class="text-secondary small mb-4 d-flex flex-wrap gap-2 align-items-center">
                        <span><i class="fa-solid fa-barcode me-1"></i> Código: <strong id="modal_codigo_competencia"></strong></span>
                        <span class="text-muted">|</span>
                        <span><i class="fa-solid fa-clock me-1"></i> Horas Totales: <strong id="modal_horas_competencia"></strong></span>
                        <span class="text-muted">|</span>
                        <span><i class="fa-solid fa-list-check me-1"></i> RAPs: <strong id="modal_resultados_competencia"></strong></span>
                        <span class="text-muted">|</span>
                        <span><i class="fa-solid fa-percent me-1"></i> Porcentaje: 
                            <input type="number" id="porcentaje_global" class="form-control form-control-sm d-inline-block fw-bold text-center" style="width: 75px; height: 26px; padding: 0.1rem;" min="1" max="100" value="100">%
                        </span>
                        <span class="text-muted">|</span>
                        <span><i class="fa-solid fa-business-time me-1"></i> Horas a Ejecutar: <strong id="modal_horas_ejecutar_competencia"></strong></span>
                        <span class="text-muted">|</span>
                        <span class="bg-primary-subtle text-primary px-2 py-1 rounded fw-bold"><i class="fa-solid fa-person-chalkboard me-1"></i> Límite de Sesiones: <span id="modal_sesiones_competencia" class="fs-6"></span></span>
                    </div>
                    
                    <!-- Alerta de Error (Oculta por defecto) -->
                    <div id="alerta_limite" class="alert alert-danger d-none fw-bold text-center border-0 shadow-sm mb-4">
                        <i class="fa-solid fa-triangle-exclamation fs-5 me-2"></i> Error: Excede el límite de sesiones
                    </div>

                    <!-- Tabla de RAPs -->
                    <div class="table-responsive bg-white rounded-3 border shadow-sm">
                        <table class="table table-bordered table-hover align-middle mb-0">
                            <thead class="table-light text-center">
                                <tr>
                                    <th style="width: 70%; text-align: left;" class="ps-3">Nombre del RAP</th>
                                    <th style="width: 30%;" class="pe-3">Sesiones Asignadas</th>
                                </tr>
                            </thead>
                            <tbody id="tabla_raps">
                                <!-- Las filas se generan vía JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="modal-footer ficha-create-footer">
                    <button type="button" class="btn ficha-create-cancel" data-bs-dismiss="modal"><i class="fa-regular fa-circle-xmark"></i> Cancelar</button>
                    <button type="submit" class="btn ficha-create-save" id="btn_guardar_ajuste"><i class="fa-solid fa-floppy-disk"></i> Guardar Ajustes</button>
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
// Variable Global (Regla de Oro)
let maximoSesionesPermitidas = 0;
const HORAS_POR_SESION = 6;
const numeroFichaGlobal = "<?= htmlspecialchars($ficha->numero_ficha); ?>";

window.cargarDatosModalCompetencia = async function(btn) {
    if (!btn) return;
    
    // DEPURACIÓN VISUAL: Mostrar un toast para confirmar que el click funcionó
    Swal.fire({
        toast: true, position: 'top-end', icon: 'info', title: 'Conectando con servidor...', showConfirmButton: false, timer: 2000
    });
    
    try {
        const horasTotales = parseInt(btn.getAttribute('data-horas-totales')) || 0;
        const idCompetencia = btn.getAttribute('data-id-competencia');
        const codigoComp = btn.getAttribute('data-codigo');
        const nombreComp = btn.getAttribute('data-nombre');
        const resultadosTotales = btn.getAttribute('data-resultados-totales') || 0;
        const porcentaje = parseFloat(btn.getAttribute('data-porcentaje')) || 100;
        const horasEjecutar = parseFloat(btn.getAttribute('data-horas-ejecutar')) || horasTotales;

        // Setear variables globales y UI inicial
        maximoSesionesPermitidas = Math.ceil(horasEjecutar / HORAS_POR_SESION);
        
        document.getElementById('modal_id_competencia').value = idCompetencia;
        document.getElementById('modal_nombre_competencia').textContent = nombreComp;
        document.getElementById('modal_codigo_competencia').textContent = codigoComp;
        document.getElementById('modal_horas_competencia').textContent = horasTotales + ' hrs';
        document.getElementById('modal_resultados_competencia').textContent = resultadosTotales;
        
        const inputPorcentajeGlobal = document.getElementById('porcentaje_global');
        inputPorcentajeGlobal.value = porcentaje;
        inputPorcentajeGlobal.setAttribute('data-horas-totales', horasTotales);
        
        document.getElementById('modal_horas_ejecutar_competencia').textContent = horasEjecutar + ' hrs';
        document.getElementById('modal_sesiones_competencia').textContent = maximoSesionesPermitidas;

        const tbody = document.getElementById('tabla_raps');
        tbody.innerHTML = '<tr><td colspan="3" class="text-center py-4"><i class="fa-solid fa-spinner fa-spin fs-4 text-warning"></i> Cargando resultados de la competencia...</td></tr>';
        document.getElementById('btn_guardar_ajuste').disabled = true;

        // Petición AJAX para obtener los RAPs y sus ajustes
        const response = await fetch(`<?= URLROOT; ?>/index.php?route=fichas/getAjustesCompetencia`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id_competencia: idCompetencia, numero_ficha: numeroFichaGlobal })
        });
        
        const data = await response.json();
        
        if (data.status === 'success') {
            if (data.raps.length === 0) {
                tbody.innerHTML = `<tr><td colspan="3" class="text-center text-muted py-4"><i class="fa-solid fa-circle-info me-2"></i>Esta competencia no tiene resultados de aprendizaje asociados.</td></tr>`;
            } else {
                // Ajustar UI (Cabecera) según lo guardado en base de datos
                const savedPorcentaje = parseFloat(data.raps[0].porcentaje_ajustado) || 100;
                inputPorcentajeGlobal.value = savedPorcentaje;
                
                // Recalcular Horas a Ejecutar y Límite de Sesiones
                const nuevasHorasEjecutar = Math.round(horasTotales * (savedPorcentaje / 100) * 100) / 100;
                maximoSesionesPermitidas = Math.ceil(nuevasHorasEjecutar / HORAS_POR_SESION);
                
                document.getElementById('modal_horas_ejecutar_competencia').textContent = nuevasHorasEjecutar + ' hrs';
                document.getElementById('modal_sesiones_competencia').textContent = maximoSesionesPermitidas;
                
                renderizarTablaRaps(data.raps);
            }
        } else {
            tbody.innerHTML = `<tr><td colspan="3" class="text-center text-danger py-4"><i class="fa-solid fa-triangle-exclamation me-2"></i>${data.message}</td></tr>`;
        }
    } catch (error) {
        console.error('Error procesando el modal:', error);
        document.getElementById('tabla_raps').innerHTML = `<tr><td colspan="3" class="text-center text-danger py-4"><i class="fa-solid fa-triangle-exclamation me-2"></i>Error interno al cargar la información.</td></tr>`;
    }
};

    // Evento de Guardado mediante Fetch
    const btnGuardarAjuste = document.getElementById('btn_guardar_ajuste');
    if (btnGuardarAjuste) {
        btnGuardarAjuste.addEventListener('click', async function(e) {
            e.preventDefault();
            
            if (this.disabled) return;
            const originalText = this.innerHTML;
            this.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-1"></i> Guardando...';
            this.disabled = true;

            const idCompetencia = document.getElementById('modal_id_competencia').value;
            const porcentajeGlobal = document.getElementById('porcentaje_global').value;
            
            const rapsData = [];
            document.querySelectorAll('#tabla_raps tr').forEach(tr => {
                if (tr.querySelector('.rap-id')) {
                    rapsData.push({
                        id_resultado: tr.querySelector('.rap-id').value,
                        horas_base: tr.querySelector('.rap-horas-base').value,
                        porcentaje: porcentajeGlobal,
                        sesiones: tr.querySelector('.input-sesiones').value
                    });
                }
            });

            try {
                const response = await fetch(`<?= URLROOT; ?>/index.php?route=fichas/guardarAjusteMasivoFetch`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        numero_ficha: numeroFichaGlobal,
                        id_competencia: idCompetencia,
                        raps: rapsData
                    })
                });

                const result = await response.json();
                
                if (result.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Ajuste Guardado',
                        text: 'La competencia ha sido balanceada correctamente.',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    Swal.fire('Error', result.message || 'No se pudieron guardar los ajustes.', 'error');
                    this.innerHTML = originalText;
                    this.disabled = false;
                }
            } catch (error) {
                Swal.fire('Error Crítico', 'No se pudo contactar con el servidor.', 'error');
                this.innerHTML = originalText;
                this.disabled = false;
            }
        });
    }

function renderizarTablaRaps(raps) {
    const tbody = document.getElementById('tabla_raps');
    tbody.innerHTML = '';

    raps.forEach((rap, index) => {
        tbody.innerHTML += `
            <tr>
                <td class="ps-3">
                    <div class="fw-bold text-primary small mb-1">${rap.codigo}</div>
                    <div class="text-secondary small" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">${rap.descripcion}</div>
                    <input type="hidden" class="rap-id" value="${rap.id_resultado}">
                    <input type="hidden" class="rap-horas-base" value="${rap.horas_base}">
                </td>
                <td class="pe-3">
                    <input type="number" class="form-control text-center fw-bold input-sesiones shadow-sm mx-auto w-50" value="${rap.sesiones_asignadas_ajustadas}" min="1" oninput="calcularSesiones()">
                </td>
            </tr>
        `;
    });
    
    document.getElementById('btn_guardar_ajuste').disabled = false;
    calcularSesiones(); // Cálculo inicial
}

// Evento para recalcular todo cuando cambia el porcentaje global
const inputPorcentajeGlobal = document.getElementById('porcentaje_global');
if (inputPorcentajeGlobal) {
    inputPorcentajeGlobal.addEventListener('input', function() {
        let porcentaje = parseFloat(this.value) || 0;
        if (porcentaje < 0) porcentaje = 0;
        if (porcentaje > 100) porcentaje = 100;
        
        const horasTotales = parseFloat(this.getAttribute('data-horas-totales')) || 0;
        
        // Recalcular horas a ejecutar y sesiones permitidas
        const nuevasHorasEjecutar = Math.round(horasTotales * (porcentaje / 100) * 100) / 100;
        maximoSesionesPermitidas = Math.ceil(nuevasHorasEjecutar / HORAS_POR_SESION);
        
        // Actualizar UI
        document.getElementById('modal_horas_ejecutar_competencia').textContent = nuevasHorasEjecutar + ' hrs';
        document.getElementById('modal_sesiones_competencia').textContent = maximoSesionesPermitidas;
        
        // Validar sesiones con el nuevo límite
        calcularSesiones();
    });
}

// Función Principal (Regla de Oro)
window.calcularSesiones = function() {
    let sumaTotal = 0;
    let algunCero = false;
    const btnGuardar = document.getElementById('btn_guardar_ajuste');
    const alertaError = document.getElementById('alerta_limite');

    // Sumar todas las sesiones y verificar mínimos
    document.querySelectorAll('.input-sesiones').forEach(input => {
        const valor = parseInt(input.value || 0);
        sumaTotal += valor;
        
        if (valor <= 0 || isNaN(valor)) {
            algunCero = true;
            input.classList.add('is-invalid', 'text-danger');
        } else {
            input.classList.remove('is-invalid', 'text-danger');
        }
    });

    // Validar regla estricta: Suma EXACTA al máximo Y ningún valor en 0
    if (sumaTotal !== maximoSesionesPermitidas || algunCero) {
        alertaError.classList.remove('d-none');
        btnGuardar.disabled = true;
        
        // Personalizar el mensaje de alerta
        if (algunCero) {
            alertaError.innerHTML = '<i class="fa-solid fa-triangle-exclamation fs-5 me-2"></i> Error: Cada RAP debe tener al menos 1 sesión.';
        } else if (sumaTotal < maximoSesionesPermitidas) {
            alertaError.innerHTML = `<i class="fa-solid fa-triangle-exclamation fs-5 me-2"></i> Error: Faltan asignar sesiones (Suma: ${sumaTotal}, Límite: ${maximoSesionesPermitidas})`;
            document.querySelectorAll('.input-sesiones').forEach(input => input.classList.add('is-invalid', 'text-danger'));
        } else {
            alertaError.innerHTML = `<i class="fa-solid fa-triangle-exclamation fs-5 me-2"></i> Error: Excede límite de sesiones (Suma: ${sumaTotal}, Límite: ${maximoSesionesPermitidas})`;
            document.querySelectorAll('.input-sesiones').forEach(input => input.classList.add('is-invalid', 'text-danger'));
        }
    } else {
        alertaError.classList.add('d-none');
        btnGuardar.disabled = false;
        
        // Limpiar todas las alertas rojas
        document.querySelectorAll('.input-sesiones').forEach(input => {
            input.classList.remove('is-invalid', 'text-danger');
        });
    }
}

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

    // Buscador de aprendices en modal
    const searchAprendizInput = document.getElementById('buscarAprendizInput');
    if (searchAprendizInput) {
        searchAprendizInput.addEventListener('input', function() {
            const filter = this.value.toLowerCase();
            const items = document.querySelectorAll('.aprendiz-item-asociar');
            items.forEach(item => {
                const nombre = item.querySelector('.aprendiz-nombre-asociar').textContent.toLowerCase();
                const doc = item.querySelector('.aprendiz-documento-asociar').textContent.toLowerCase();
                if (nombre.includes(filter) || doc.includes(filter)) {
                    item.classList.remove('d-none');
                    item.classList.add('d-flex');
                } else {
                    item.classList.remove('d-flex');
                    item.classList.add('d-none');
                }
            });
        });
    }

    // Guardar Asociación de Aprendices Vía AJAX
    const btnGuardarAsociacionAprendices = document.getElementById('btnGuardarAsociacionAprendices');
    if (btnGuardarAsociacionAprendices) {
        btnGuardarAsociacionAprendices.addEventListener('click', function() {
            const checkboxes = document.querySelectorAll('.checkbox-aprendiz-asociar:checked');
            if (checkboxes.length === 0) {
                Swal.fire('Atención', 'Selecciona al menos un aprendiz para asociar.', 'warning');
                return;
            }

            const aprendicesIds = Array.from(checkboxes).map(cb => cb.value);
            const numeroFicha = document.querySelector('input[name="numero_ficha_original"]').value;

            const formData = new FormData();
            formData.append('numero_ficha', numeroFicha);
            aprendicesIds.forEach(id => formData.append('aprendices[]', id));

            const btnOriginalText = this.innerHTML;
            this.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-1"></i> Asociando...';
            this.disabled = true;

            fetch('<?= URLROOT; ?>/index.php?route=fichas/asociarAprendices', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('¡Éxito!', data.message, 'success').then(() => {
                        window.location.reload();
                    });
                } else {
                    Swal.fire('Error', data.message, 'error');
                    this.innerHTML = btnOriginalText;
                    this.disabled = false;
                }
            })
            .catch(error => {
                console.error(error);
                Swal.fire('Error', 'Ocurrió un error en la solicitud AJAX.', 'error');
                this.innerHTML = btnOriginalText;
                this.disabled = false;
            });
        });
    }
</script>
