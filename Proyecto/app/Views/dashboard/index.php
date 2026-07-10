<style>
/* Estilos precisos para igualar las imágenes adjuntas por el usuario */
.sga-nav-pills .nav-link {
    color: #495057;
    background-color: #ffffff;
    border: 1px solid rgba(0, 0, 0, 0.06);
    border-radius: 12px;
    padding: 0.8rem 1.6rem;
    font-weight: 600;
    font-size: 0.92rem;
    display: flex;
    align-items: center;
    gap: 0.6rem;
    transition: all 0.2s ease;
    box-shadow: 0 2px 6px rgba(0,0,0,0.02);
    position: relative;
}
.sga-nav-pills .nav-link:hover {
    color: #212529;
    border-color: rgba(0, 0, 0, 0.12);
    transform: translateY(-1px);
}
.sga-nav-pills .nav-link.active {
    color: #ffffff !important;
    background-color: #39A900 !important;
    border-color: #39A900 !important;
    box-shadow: 0 4px 12px rgba(57, 169, 0, 0.25) !important;
}
.active-badge {
    background-color: #e8f5e9;
    color: #2e7d32;
    border-radius: 25px;
    padding: 0.45rem 1.2rem;
    font-size: 0.85rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.dot-indicator {
    width: 10px;
    height: 10px;
    background-color: #39A900;
    border-radius: 50%;
    display: inline-block;
    box-shadow: 0 0 0 2px rgba(57,169,0,0.2);
}
.btn-new-ficha {
    background-color: #39A900;
    color: #ffffff;
    border: none;
    border-radius: 25px;
    padding: 0.6rem 1.4rem;
    font-weight: 600;
    font-size: 0.88rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.2s ease;
    box-shadow: 0 4px 10px rgba(57, 169, 0, 0.2);
    text-decoration: none;
}
.btn-new-ficha:hover {
    background-color: #007832;
    color: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(57, 169, 0, 0.3);
}
.btn-sena-sm {
    background-color: #39A900;
    color: #ffffff;
    border: none;
    border-radius: 8px;
    padding: 0.45rem 1.1rem;
    font-weight: 700;
    font-size: 0.85rem;
    transition: all 0.2s ease;
    text-decoration: none;
    box-shadow: 0 2px 6px rgba(57,169,0,0.2);
}
.btn-sena-sm:hover {
    background-color: #007832;
    color: #ffffff;
    transform: translateY(-1px);
    box-shadow: 0 4px 10px rgba(57,169,0,0.3);
}
.ficha-card {
    border: 1px solid rgba(0, 0, 0, 0.06);
    border-radius: 20px;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.ficha-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 24px rgba(0,0,0,0.06) !important;
}
.badge-ficha-id {
    background-color: #e8f5e9;
    color: #2e7d32;
    font-weight: 700;
    font-size: 0.78rem;
    padding: 0.35rem 0.8rem;
    border-radius: 15px;
}
.badge-dia-sena {
    background-color: #e8f5e9;
    color: #2e7d32;
    font-weight: 700;
    font-size: 0.78rem;
    padding: 0.35rem 0.9rem;
    border-radius: 15px;
}
.detail-row {
    font-size: 0.88rem;
    color: #6c757d;
    margin-bottom: 0.6rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.badge-notify {
    position: absolute;
    top: -8px;
    right: -8px;
    background-color: #dc3545;
    color: white;
    width: 22px;
    height: 22px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.7rem;
    font-weight: 700;
    box-shadow: 0 2px 5px rgba(220,53,69,0.4);
}
.box-icon-sena {
    width: 48px;
    height: 48px;
    background-color: #e8f5e9;
    color: #39A900;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    font-size: 1.3rem;
    flex-shrink: 0;
}
.icon-circle-check {
    width: 38px;
    height: 38px;
    background-color: #e8f5e9;
    color: #39A900;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    font-size: 1.1rem;
    flex-shrink: 0;
}
.icon-circle-xmark {
    width: 38px;
    height: 38px;
    background-color: #ffebee;
    color: #dc3545;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    font-size: 1.1rem;
    flex-shrink: 0;
}
.search-asist {
    border: 1px solid rgba(0,0,0,0.12);
    border-radius: 20px;
    padding: 0.4rem 1.2rem;
    font-size: 0.88rem;
    width: 260px;
    transition: all 0.2s ease;
}
.search-asist:focus {
    border-color: #39A900;
    outline: none;
    box-shadow: 0 0 0 3px rgba(57,169,0,0.15);
    width: 300px;
}
/* Estilos específicos para Coordinador */
.badge-ficha-table {
    color: #2e7d32;
    font-weight: 800;
    font-size: 0.95rem;
}
.badge-ambiente-table {
    background-color: #eef2f5;
    color: #495057;
    font-weight: 700;
    font-size: 0.82rem;
    padding: 0.35rem 0.8rem;
    border-radius: 15px;
    display: inline-block;
}
.progress-sena {
    height: 6px;
    width: 80px;
    background-color: #e9ecef;
    border-radius: 10px;
    overflow: hidden;
    display: inline-block;
}
.progress-sena-bar {
    height: 100%;
    background-color: #39A900;
    border-radius: 10px;
}
.icon-box-warning {
    width: 52px;
    height: 52px;
    background-color: #fff8e1;
    color: #f57c00;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 16px;
    font-size: 1.4rem;
    flex-shrink: 0;
}
.btn-resuelta {
    background-color: #e8f5e9;
    color: #2e7d32;
    border: 1px solid #c8e6c9;
    border-radius: 25px;
    padding: 0.45rem 1.2rem;
    font-weight: 700;
    font-size: 0.82rem;
    text-decoration: none;
    transition: all 0.2s ease;
    display: inline-block;
}
.btn-resuelta:hover {
    background-color: #39A900;
    color: #ffffff;
    border-color: #39A900;
}
.ambiente-img-box {
    height: 190px;
    width: 100%;
    position: relative;
    background-color: #f8f9fa;
    overflow: hidden;
}
.ambiente-img-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.badge-amb-top-left {
    position: absolute;
    top: 12px;
    left: 12px;
    background-color: #212529;
    color: #ffffff;
    font-size: 0.78rem;
    font-weight: 700;
    padding: 0.3rem 0.8rem;
    border-radius: 15px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}
.badge-amb-top-right {
    position: absolute;
    top: 12px;
    right: 12px;
    background-color: #ff9800;
    color: #ffffff;
    font-size: 0.75rem;
    font-weight: 800;
    padding: 0.3rem 0.8rem;
    border-radius: 15px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}
.badge-equip-blue { background-color: #e3f2fd; color: #1565c0; font-size: 0.75rem; font-weight: 700; padding: 0.25rem 0.65rem; border-radius: 6px; }
.badge-equip-purple { background-color: #f3e5f5; color: #7b1fa2; font-size: 0.75rem; font-weight: 700; padding: 0.25rem 0.65rem; border-radius: 6px; }
.badge-equip-indigo { background-color: #e8eaf6; color: #303f9f; font-size: 0.75rem; font-weight: 700; padding: 0.25rem 0.65rem; border-radius: 6px; }
.badge-equip-green { background-color: #e8f5e9; color: #2e7d32; font-size: 0.75rem; font-weight: 700; padding: 0.25rem 0.65rem; border-radius: 6px; }

/* Estilos específicos para Instructor Líder (Planilla Digital y Botones Conmutables) */
.btn-estado-toggle {
    width: 44px;
    height: 44px;
    border-radius: 14px;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    font-weight: 800;
    cursor: pointer;
    transition: all 0.15s ease;
    flex-shrink: 0;
}
.btn-estado-toggle.presente {
    background-color: #e8f5e9;
    color: #39A900;
    border: 1px solid #c8e6c9;
}
.btn-estado-toggle.falla {
    background-color: #ffebee;
    color: #dc3545;
    border: 1px solid #ffcdd2;
}
.btn-estado-toggle:hover {
    transform: scale(1.05);
}
.input-obs-sena {
    background-color: #f8f9fa;
    border: 1px solid rgba(0,0,0,0.06);
    border-radius: 12px;
    padding: 0.6rem 1.2rem;
    font-size: 0.88rem;
    width: 100%;
    max-width: 400px;
    transition: all 0.2s ease;
}
.input-obs-sena:focus {
    background-color: #ffffff;
    border-color: #39A900;
    outline: none;
    box-shadow: 0 0 0 3px rgba(57,169,0,0.15);
}
.btn-sena-lg {
    background-color: #39A900;
    color: #ffffff;
    border: none;
    border-radius: 16px;
    padding: 0.85rem 2rem;
    font-weight: 700;
    font-size: 1rem;
    transition: all 0.2s ease;
    box-shadow: 0 6px 16px rgba(57, 169, 0, 0.25);
}
.btn-sena-lg:hover {
    background-color: #007832;
    color: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 8px 22px rgba(57, 169, 0, 0.35);
}
.select-sena {
    border: 1px solid rgba(0,0,0,0.12);
    border-radius: 12px;
    padding: 0.6rem 1.2rem;
    font-size: 0.9rem;
    font-weight: 600;
    color: #212529;
    background-color: #ffffff;
}
.input-date-sena {
    border: 1px solid rgba(0,0,0,0.12);
    border-radius: 12px;
    padding: 0.6rem 1.2rem;
    font-size: 0.9rem;
    font-weight: 600;
    color: #212529;
    background-color: #ffffff;
}

/* Estilos para el Calendario Mensual de Programación Académica */
.calendar-days-grid {
    display: grid;
    grid-template-columns: repeat(7, minmax(0, 1fr));
    gap: 12px;
}
#gridDiasCalendario,
#gridDiasCalendarioAmbiente {
    grid-auto-rows: 132px;
    align-items: stretch;
}
.calendar-day-name {
    text-align: center;
    font-weight: 700;
    font-size: 0.82rem;
    padding: 0.9rem 0;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    background: #fafbfc;
    border-radius: 12px;
    border: 1px solid rgba(0,0,0,0.04);
}
.calendar-cell {
    min-width: 0;
    min-height: 0;
    height: 100%;
    background: #ffffff;
    border: 1px solid rgba(0,0,0,0.06);
    border-radius: 12px;
    padding: 0.5rem;
    display: flex;
    flex-direction: column;
    gap: 4px;
    position: relative;
    overflow: hidden;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 2px 4px rgba(0,0,0,0.01);
}
.calendar-cell:hover {
    box-shadow: 0 8px 24px rgba(0,0,0,0.05);
    border-color: rgba(57, 169, 0, 0.25);
}
.calendar-cell.other-month {
    background: #f8fafc;
    opacity: 0.55;
}
.calendar-cell.today {
    border: 2px solid #39A900;
    background: rgba(57, 169, 0, 0.015);
    box-shadow: 0 4px 15px rgba(57, 169, 0, 0.08);
}
.calendar-cell-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex: 0 0 auto;
    min-width: 0;
    border-bottom: 1px solid rgba(0,0,0,0.02);
    padding-bottom: 0.2rem;
}
.calendar-day-num {
    font-weight: 800;
    font-size: 0.95rem;
    color: #1e293b;
}
.calendar-cell.today .calendar-day-num {
    color: #39A900;
}
.calendar-sessions-badge {
    background-color: #d1fae5;
    color: #065f46;
    font-size: 0.65rem;
    font-weight: 700;
    padding: 0.15rem 0.4rem;
    border-radius: 20px;
}
.calendar-session-list {
    display: flex;
    flex-direction: column;
    flex: 1 1 auto;
    min-height: 0;
    gap: 4px;
    overflow-y: auto;
    padding-right: 2px;
}
.calendar-session-list::-webkit-scrollbar {
    width: 3px;
}
.calendar-session-list::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 3px;
}
.calendar-session-card {
    flex: 0 0 auto;
    min-width: 0;
    background: #f8fafc;
    border-left: 3px solid #39A900;
    padding: 0.4rem;
    border-radius: 6px;
    font-size: 0.7rem;
    display: flex;
    flex-direction: column;
    gap: 2px;
    overflow: hidden;
    border: 1px solid rgba(0,0,0,0.04);
    border-left: 3px solid #39A900;
    transition: all 0.2s ease;
}
.calendar-session-card .d-flex {
    min-width: 0;
    gap: 4px;
}
.calendar-session-card:hover {
    background: #f1f5f9;
    border-color: rgba(0,0,0,0.08);
}
.calendar-session-time {
    font-weight: 700;
    color: #334155;
    font-size: 0.68rem;
    min-width: 0;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.calendar-session-ficha {
    font-weight: 700;
    color: #e28743;
    font-size: 0.68rem;
    flex: 0 0 auto;
}
.calendar-session-instructor {
    color: #2563eb;
    font-weight: 700;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 3px;
    font-size: 0.66rem;
    margin-top: 1px;
    min-width: 0;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.calendar-session-instructor:hover {
    text-decoration: underline;
    color: #1d4ed8;
}

/* SGA Custom styling for unified calendar/scheduling filter bar */
.unified-filter-bar {
    border-radius: 20px !important;
    border: 1px solid #cbd5e1 !important;
    background-color: #ffffff;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
}
@media (min-width: 992px) {
    .unified-filter-bar {
        border-radius: 9999px !important;
        border: 1px solid #4a5568 !important; /* Coincide con el color de borde gris oscuro de la imagen */
    }
}

.btn-nav-mes {
    width: 38px;
    height: 38px;
    border: 1px solid #e2e8f0;
    border-radius: 12px !important;
    background-color: #ffffff;
    color: #475569;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}
.btn-nav-mes:hover {
    background-color: #f1f5f9;
    color: #1e293b;
    border-color: #cbd5e1;
}

.badge-mes-actual {
    font-family: var(--bs-font-sans-serif);
    font-weight: 700;
    letter-spacing: 0.5px;
    background-color: #f8fafc;
    border-radius: 12px;
    padding: 6px 14px;
    font-size: 0.85rem;
    color: #1e293b;
}

.select-filtro-custom {
    font-size: 0.85rem !important;
    font-weight: 500 !important;
    color: #475569 !important;
    border: 1px solid #e2e8f0 !important;
    border-radius: 12px !important;
    background-color: #f8fafc !important;
    height: 38px;
    padding: 0 28px 0 16px !important;
    min-width: 120px;
    width: auto;
    transition: all 0.2s ease;
}
.select-filtro-custom:hover {
    border-color: #cbd5e1 !important;
    background-color: #f1f5f9 !important;
}
.select-filtro-custom:focus {
    border-color: #94a3b8 !important;
    outline: 0;
    box-shadow: 0 0 0 2px rgba(148, 163, 184, 0.15) !important;
}

.select-filtro-highlighted {
    background-color: #ffffff !important;
    border: 1.5px solid #10b981 !important;
    color: #059669 !important;
    font-weight: 600 !important;
}
.select-filtro-highlighted:hover {
    background-color: #f0fdf4 !important;
    border-color: #059669 !important;
}
.select-filtro-highlighted:focus {
    border-color: #047857 !important;
    box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.15) !important;
}
.indicator-dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    display: inline-block;
}
.dot-green {
    background-color: #22c55e;
}
.dot-yellow {
    background-color: #eab308;
}
.dot-red {
    background-color: #ef4444;
}
</style>

<div class="container-fluid px-0">

    <?php if ($current_role === 'Coordinador'): ?>
        <!-- PANEL DE CONTROL DEL COORDINADOR -->
        
        <!-- 2. Pestañas de Navegación Estilizadas -->
        <ul class="nav sga-nav-pills mb-5 gap-3 d-none" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-vision-tab" data-bs-toggle="pill" data-bs-target="#pills-vision" type="button" role="tab" aria-controls="pills-vision" aria-selected="true">
                    <i class="fa-solid fa-house me-1"></i> Visión General
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-fichas-tab" data-bs-toggle="pill" data-bs-target="#pills-fichas" type="button" role="tab" aria-controls="pills-fichas" aria-selected="false">
                    <i class="fa-solid fa-user-group me-1"></i> Fichas de Formación
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-programas-tab" data-bs-toggle="pill" data-bs-target="#pills-programas" type="button" role="tab" aria-controls="pills-programas" aria-selected="false">
                    <i class="fa-solid fa-book-open me-1"></i> Programas
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-programacion-tab" data-bs-toggle="pill" data-bs-target="#pills-programacion" type="button" role="tab" aria-controls="pills-programacion" aria-selected="false">
                    <i class="fa-solid fa-calendar-days me-1"></i> Programación Académica
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-ambientes-tab" data-bs-toggle="pill" data-bs-target="#pills-ambientes" type="button" role="tab" aria-controls="pills-ambientes" aria-selected="false">
                    <i class="fa-solid fa-location-dot me-1"></i> Ambientes Físicos
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-novedades-tab" data-bs-toggle="pill" data-bs-target="#pills-novedades" type="button" role="tab" aria-controls="pills-novedades" aria-selected="false">
                    <i class="fa-solid fa-triangle-exclamation me-1"></i> Novedades Reportadas
                    <?php if (!empty($novedades)): ?>
                        <span class="badge-notify"><?= count($novedades); ?></span>
                    <?php endif; ?>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-usuarios-tab" data-bs-toggle="pill" data-bs-target="#pills-usuarios" type="button" role="tab" aria-controls="pills-usuarios" aria-selected="false">
                    <i class="fa-solid fa-users-gear me-1"></i> Usuarios y Roles
                </button>
            </li>
        </ul>

        <!-- 3. Contenido de las Pestañas -->
        <div class="tab-content" id="pills-tabContent">

            <!-- PESTAÑA: VISIÓN GENERAL -->
            <div class="tab-pane fade show active" id="pills-vision" role="tabpanel" aria-labelledby="pills-vision-tab">
                


                <!-- Banner de bienvenida verde esmeralda con el perfil flotante -->
                <?php
                $avatarUrlWelcome = 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=120&auto=format&fit=crop';
                if ($current_role === 'Instructor') $avatarUrlWelcome = 'https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=120&auto=format&fit=crop';
                if ($current_role === 'Aprendiz') $avatarUrlWelcome = 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=120&auto=format&fit=crop';
                $db = Database::getInstance();
                $db->query("SELECT foto FROM usuarios WHERE id_usuario = :id");
                $db->bind(':id', (int) $_SESSION['user_id']);
                $userFotoRow = $db->single();
                if ($userFotoRow && !empty($userFotoRow->foto)) {
                    $filePath = APPROOT . '/../public/uploads/profile/' . $userFotoRow->foto;
                    if (is_file($filePath)) {
                        $avatarUrlWelcome = ASSETROOT . '/uploads/profile/' . rawurlencode($userFotoRow->foto) . '?v=' . filemtime($filePath);
                    }
                }
                ?>
                <div class="banner-welcome d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                    <div>
                        <div class="badge-active">Sesión de Coordinación Activa</div>
                        <h3>¡Hola, Coordinadora <?= htmlspecialchars(explode(' ', $_SESSION['user_name'])[0]); ?>!</h3>
                        <p>Desde este portal tienes acceso total a la planeación curricular, asignación de instructores líderes, control de novedades y auditoría de asistencia institucional con un nivel óptimo de control.</p>
                    </div>
                    <a href="<?= URLROOT; ?>/index.php?route=perfil/index" class="banner-user-card shadow-sm mt-3 mt-md-0 ms-md-4 text-decoration-none" style="transition: all 0.25s ease;">
                        <img class="banner-welcome-avatar-img" src="<?= htmlspecialchars($avatarUrlWelcome, ENT_QUOTES, 'UTF-8'); ?>" alt="Foto de perfil">
                        <span>
                            <small><?= htmlspecialchars($current_role); ?> Académico</small>
                            <strong><?= htmlspecialchars($_SESSION['user_name']); ?></strong>
                            <div class="user-email"><?= htmlspecialchars($usuario->correo ?? 'arestrepo@sena.edu.co'); ?></div>
                        </span>
                    </a>
                </div>

                <!-- Tarjetas Estadísticas con Sparklines -->
                <div class="row g-4 mb-4">
                    <!-- Tarjeta 1: Fichas Activas -->
                    <div class="col-12 col-md-3">
                        <div class="stat-card">
                            <div class="stat-info">
                                <span class="stat-title">Fichas Activas</span>
                                <span class="stat-value"><?= count($fichas); ?></span>
                                <span class="stat-desc">Matriculadas en lectiva</span>
                            </div>
                            <div class="stat-visual">
                                <div class="stat-icon green">
                                    <i class="fa-solid fa-users"></i>
                                </div>
                                <svg class="sparkline" viewBox="0 0 100 30">
                                    <path d="M 0,25 Q 20,5 40,20 T 80,10 T 100,5" fill="none" stroke="#2e7d32" stroke-width="2" stroke-linecap="round"></path>
                                    <circle cx="100" cy="5" r="2" fill="#2e7d32"></circle>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tarjeta 2: Programas -->
                    <div class="col-12 col-md-3">
                        <div class="stat-card">
                            <div class="stat-info">
                                <span class="stat-title">Programas</span>
                                <span class="stat-value"><?= $programas_count ?? count($programas); ?></span>
                                <span class="stat-desc">Ofertas académicas</span>
                            </div>
                            <div class="stat-visual">
                                <div class="stat-icon yellow">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                </div>
                                <svg class="sparkline" viewBox="0 0 100 30">
                                    <path d="M 0,20 Q 20,25 40,15 T 80,22 T 100,10" fill="none" stroke="#f57c00" stroke-width="2" stroke-linecap="round"></path>
                                    <circle cx="100" cy="10" r="2" fill="#f57c00"></circle>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tarjeta 3: Ambientes -->
                    <div class="col-12 col-md-3">
                        <div class="stat-card">
                            <div class="stat-info">
                                <span class="stat-title">Ambientes</span>
                                <span class="stat-value"><?= $ambientes_count ?? count($ambientes); ?></span>
                                <span class="stat-desc">Sedes físicas activas</span>
                            </div>
                            <div class="stat-visual">
                                <div class="stat-icon blue">
                                    <i class="fa-solid fa-building"></i>
                                </div>
                                <svg class="sparkline" viewBox="0 0 100 30">
                                    <path d="M 0,28 Q 20,15 40,22 T 80,8 T 100,12" fill="none" stroke="#0288d1" stroke-width="2" stroke-linecap="round"></path>
                                    <circle cx="100" cy="12" r="2" fill="#0288d1"></circle>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tarjeta 4: Novedades -->
                    <div class="col-12 col-md-3">
                        <div class="stat-card">
                            <div class="stat-info">
                                <span class="stat-title">Novedades</span>
                                <span class="stat-value"><?= count($novedades); ?></span>
                                <span class="stat-desc">Pendientes por revisión</span>
                            </div>
                            <div class="stat-visual">
                                <div class="stat-icon red">
                                    <i class="fa-solid fa-triangle-exclamation"></i>
                                </div>
                                <svg class="sparkline" viewBox="0 0 100 30">
                                    <path d="M 0,15 L 20,15 L 40,15 L 60,15 L 80,15 L 100,15" fill="none" stroke="#dc3545" stroke-width="2" stroke-linecap="round"></path>
                                    <circle cx="100" cy="15" r="2" fill="#dc3545"></circle>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Novedades visuales de Dashboard (UI request) -->
                <?php
                // Lógica para Visión General
                $hoyStr = date('Y-m-d');
                $mesNombres = ['', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
                $diaSemanaNumeros = ['Sunday' => 'Domingo', 'Monday' => 'Lunes', 'Tuesday' => 'Martes', 'Wednesday' => 'Miércoles', 'Thursday' => 'Jueves', 'Friday' => 'Viernes', 'Saturday' => 'Sábado'];
                $diaSemanaActual = $diaSemanaNumeros[date('l')];
                $mesActual = date('n'); // 1-12
                $anioActual = date('Y');
                
                // 1. Agenda de Hoy
                $proximaSesion = null;
                $sesionesHoy = [];
                $hoyStr = date('Y-m-d');
                if (isset($programacion) && is_array($programacion)) {
                    $sesionesHoy = array_filter($programacion, function($p) use ($hoyStr) {
                        return !empty($p->fecha_inicio) && $p->fecha_inicio === $hoyStr;
                    });
                    usort($sesionesHoy, function($a, $b) {
                        return strtotime($a->hora_inicio) - strtotime($b->hora_inicio);
                    });
                    $horaActual = date('H:i');
                    foreach ($sesionesHoy as $sesion) {
                        if (substr($sesion->hora_fin, 0, 5) > $horaActual) {
                            $proximaSesion = $sesion;
                            break;
                        }
                    }
                    if (!$proximaSesion && count($sesionesHoy) > 0) {
                        $proximaSesion = $sesionesHoy[count($sesionesHoy) - 1]; // Última
                    }
                }
                
                // 2. Disponibilidad (Calendario)
                $diasProgramados = []; // dia_mes => 'ocupado' o 'reservado'
                $maxVolumen = 1;
                $filtroAmb = $_GET['filtro_ambiente'] ?? '';
                if (isset($programacion) && is_array($programacion)) {
                    foreach ($programacion as $p) {
                        if ($filtroAmb !== '' && trim($p->ambiente_nombre ?? '') !== $filtroAmb) continue;
                        
                        if (!empty($p->fecha_inicio)) {
                            $progTime = strtotime($p->fecha_inicio);
                            $progMes = (int)date('m', $progTime);
                            $progAnio = (int)date('Y', $progTime);
                            
                            if ($progMes === (int)$mesActual && $progAnio === (int)$anioActual) {
                                $d = (int)date('d', $progTime);
                                if (!isset($diasProgramados[$d])) $diasProgramados[$d] = 0;
                                $diasProgramados[$d]++;
                                if ($diasProgramados[$d] > $maxVolumen) $maxVolumen = $diasProgramados[$d];
                            }
                        }
                    }
                }
                
                // 3. Ambientes por Estado
                $ambActivos = 0; $ambMantenimiento = 0; $ambInactivos = 0;
                $totalAmbientes = count($ambientes ?? []);
                if (isset($ambientes) && is_array($ambientes)) {
                    foreach ($ambientes as $amb) {
                        if (isset($amb->disponibilidad) && $amb->disponibilidad == 1) {
                            $ambActivos++;
                        } else {
                            $ambInactivos++;
                        }
                    }
                }
                $pctActivos = $totalAmbientes > 0 ? round(($ambActivos / $totalAmbientes) * 100) : 0;
                $pctMantenimiento = $totalAmbientes > 0 ? round(($ambMantenimiento / $totalAmbientes) * 100) : 0;
                $pctInactivos = $totalAmbientes > 0 ? round(($ambInactivos / $totalAmbientes) * 100) : 0;
                
                // 4. Programación por Jornada
                $turnos = ['Lunes' => ['M'=>0, 'T'=>0, 'N'=>0], 'Martes' => ['M'=>0, 'T'=>0, 'N'=>0], 'Miércoles' => ['M'=>0, 'T'=>0, 'N'=>0], 'Jueves' => ['M'=>0, 'T'=>0, 'N'=>0], 'Viernes' => ['M'=>0, 'T'=>0, 'N'=>0], 'Sábado' => ['M'=>0, 'T'=>0, 'N'=>0]];
                $maxTurno = 1;
                $mapaDias = [1 => 'Lunes', 2 => 'Martes', 3 => 'Miércoles', 4 => 'Jueves', 5 => 'Viernes', 6 => 'Sábado', 7 => 'Domingo'];
                if (isset($programacion) && is_array($programacion)) {
                    foreach ($programacion as $p) {
                        if (empty($p->fecha_inicio)) continue;
                        $diaNum = date('N', strtotime($p->fecha_inicio));
                        $dia = $mapaDias[$diaNum] ?? 'Lunes';
                        
                        $jornadaStr = strtoupper(trim($p->jornada_nombre ?? ''));
                        if (empty($jornadaStr)) {
                            $hora = (int) substr($p->hora_inicio ?? '00:00', 0, 2);
                            if ($hora < 13) $jornada = 'M';
                            elseif ($hora < 18) $jornada = 'T';
                            else $jornada = 'N';
                        } else {
                            $jornada = substr($jornadaStr, 0, 1);
                        }
                        if (isset($turnos[$dia]) && in_array($jornada, ['M', 'T', 'N'])) {
                            $turnos[$dia][$jornada]++;
                            if ($turnos[$dia][$jornada] > $maxTurno) $maxTurno = $turnos[$dia][$jornada];
                        }
                    }
                }
                $turnosToPct = function($val) use ($maxTurno) { return $maxTurno > 0 ? round(($val / $maxTurno) * 100) : 0; };
                
                // 5. Novedades Recientes
                $novRecientes = isset($novedades) ? array_slice($novedades, 0, 2) : [];
                ?>
                <style>
                /* Dashboard Visual Redesign */
                .vg-card {
                    background-color: #ffffff;
                    border: 1px solid #e5e7eb;
                    border-radius: 32px;
                    padding: 1.8rem;
                    box-shadow: 0 4px 20px -2px rgba(0,0,0,0.02);
                    height: 100%;
                    display: flex;
                    flex-direction: column;
                }
                .vg-header {
                    display: flex;
                    justify-content: space-between;
                    align-items: flex-start;
                    margin-bottom: 1.5rem;
                }
                .vg-header-left {
                    display: flex;
                    align-items: center;
                    gap: 1rem;
                }
                .vg-icon-wrapper {
                    width: 42px;
                    height: 42px;
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 1.1rem;
                }
                .vg-icon-green { background-color: #e6f6f1; color: #10b981; }
                .vg-icon-red { background-color: #fef2f2; color: #ef4444; }
                .vg-icon-blue { background-color: #eff6ff; color: #3b82f6; }
                
                .vg-title-group {
                    display: flex;
                    flex-direction: column;
                }
                .vg-title {
                    font-weight: 800;
                    font-size: 1.05rem;
                    color: #111827;
                    margin: 0 0 0.2rem 0;
                }
                .vg-subtitle {
                    font-size: 0.75rem;
                    color: #9ca3af;
                    margin: 0;
                }
                
                .vg-btn-outline {
                    border: 1.5px solid #e5e7eb;
                    border-radius: 20px;
                    padding: 0.4rem 1rem;
                    font-size: 0.8rem;
                    font-weight: 700;
                    color: #4b5563;
                    background: transparent;
                    display: inline-flex;
                    align-items: center;
                    gap: 0.5rem;
                    transition: all 0.2s;
                }
                .vg-btn-outline:hover {
                    background-color: #f9fafb;
                    border-color: #d1d5db;
                }
                
                /* Agenda */
                .vg-agenda-container {
                    position: relative;
                    padding-left: 5rem;
                    margin-top: 1rem;
                    max-height: 360px;
                    overflow-y: auto;
                    overflow-x: hidden;
                    padding-right: 0.5rem;
                }
                
                /* Custom scrollbar for agenda */
                .vg-agenda-container::-webkit-scrollbar {
                    width: 6px;
                }
                .vg-agenda-container::-webkit-scrollbar-track {
                    background: transparent;
                }
                .vg-agenda-container::-webkit-scrollbar-thumb {
                    background-color: #d1d5db;
                    border-radius: 20px;
                }
                .vg-agenda-line {
                    position: absolute;
                    left: 4.2rem;
                    top: 10px;
                    bottom: 0;
                    width: 2px;
                    background-color: #f3f4f6;
                    z-index: 1;
                }
                .vg-agenda-time {
                    position: absolute;
                    left: 0;
                    top: 0;
                    border: 1.5px solid #4b5563;
                    border-radius: 12px;
                    padding: 0.4rem 0.8rem;
                    text-align: center;
                    background: white;
                    z-index: 2;
                    display: flex;
                    flex-direction: column;
                }
                .vg-agenda-time span {
                    font-size: 0.75rem;
                    font-weight: 800;
                    color: #111827;
                    line-height: 1.2;
                }
                .vg-agenda-time span:last-child {
                    color: #6b7280;
                }
                .vg-agenda-dot {
                    position: absolute;
                    left: 4.05rem;
                    top: 15px;
                    width: 8px;
                    height: 8px;
                    border: 2px solid #d1d5db;
                    border-radius: 50%;
                    background: white;
                    z-index: 3;
                }
                .vg-agenda-card {
                    border: 1.5px solid #e5e7eb;
                    border-radius: 20px;
                    padding: 1.2rem;
                    background: white;
                    margin-bottom: 1rem;
                    position: relative;
                    z-index: 4;
                }
                .vg-agenda-card-header {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    margin-bottom: 0.5rem;
                }
                .vg-agenda-ficha {
                    color: #10b981;
                    font-size: 0.75rem;
                    font-weight: 800;
                    letter-spacing: 0.5px;
                    text-transform: uppercase;
                }
                .vg-badge-orange {
                    background-color: #fff7ed;
                    color: #f59e0b;
                    padding: 0.2rem 0.6rem;
                    border-radius: 12px;
                    font-size: 0.7rem;
                    font-weight: 700;
                    display: flex;
                    align-items: center;
                    gap: 0.4rem;
                }
                .vg-badge-orange::before {
                    content: '';
                    width: 6px;
                    height: 6px;
                    background-color: #f59e0b;
                    border-radius: 50%;
                }
                .vg-agenda-course {
                    font-weight: 800;
                    font-size: 1.1rem;
                    color: #111827;
                    margin-bottom: 1rem;
                }
                .vg-agenda-details {
                    display: flex;
                    gap: 2rem;
                    font-size: 0.8rem;
                    color: #4b5563;
                    font-weight: 600;
                }
                .vg-agenda-details i {
                    color: #9ca3af;
                    margin-right: 0.4rem;
                }
                
                /* Calendar */
                .vg-cal-grid {
                    display: grid;
                    grid-template-columns: repeat(7, 1fr);
                    gap: 0.5rem;
                    text-align: center;
                    margin-top: 0.5rem;
                }
                .vg-cal-day-name {
                    font-size: 0.65rem;
                    font-weight: 800;
                    color: #9ca3af;
                    margin-bottom: 0.5rem;
                }
                .vg-cal-cell {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    gap: 0.3rem;
                    padding: 0.4rem 0;
                    font-size: 0.85rem;
                    font-weight: 700;
                    color: #111827;
                    border-radius: 12px;
                }
                .vg-cal-cell.muted {
                    color: #d1d5db;
                }
                .vg-cal-cell.active {
                    background-color: #10b981;
                    color: white;
                }
                .vg-dot {
                    width: 5px;
                    height: 5px;
                    border-radius: 50%;
                }
                .vg-dot.green { background-color: #10b981; }
                .vg-dot.yellow { background-color: #f59e0b; }
                .vg-dot.red { background-color: #ef4444; }
                .vg-cal-cell.active .vg-dot.green { background-color: white; }
                
                .vg-cal-legend {
                    display: flex;
                    justify-content: center;
                    gap: 1.5rem;
                    margin-top: auto;
                    padding-top: 1.5rem;
                }
                .vg-cal-legend-item {
                    display: flex;
                    align-items: center;
                    gap: 0.4rem;
                    font-size: 0.7rem;
                    font-weight: 700;
                    color: #6b7280;
                }
                
                /* Donut Chart */
                .vg-donut-container {
                    display: flex;
                    align-items: center;
                    gap: 2rem;
                    margin-top: 1rem;
                }
                .vg-donut {
                    width: 110px;
                    height: 110px;
                    border-radius: 50%;
                    background: conic-gradient(
                        #10b981 0% <?= $pctActivos ?>%,
                        #f59e0b <?= $pctActivos ?>% <?= $pctActivos + $pctMantenimiento ?>%,
                        #ef4444 <?= $pctActivos + $pctMantenimiento ?>% 100%
                    );
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }
                .vg-donut-inner {
                    width: 80px;
                    height: 80px;
                    background: white;
                    border-radius: 50%;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                }
                .vg-donut-inner strong {
                    font-size: 1.2rem;
                    font-weight: 800;
                    color: #111827;
                }
                .vg-donut-inner span {
                    font-size: 0.6rem;
                    font-weight: 700;
                    color: #6b7280;
                    letter-spacing: 0.5px;
                }
                .vg-donut-legend {
                    flex: 1;
                    display: flex;
                    flex-direction: column;
                    gap: 0.8rem;
                }
                .vg-donut-item {
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    font-size: 0.85rem;
                    font-weight: 700;
                    color: #4b5563;
                }
                .vg-donut-item-left {
                    display: flex;
                    align-items: center;
                    gap: 0.6rem;
                }
                .vg-info-box {
                    background-color: #f9fafb;
                    border-radius: 16px;
                    padding: 1rem;
                    display: flex;
                    align-items: flex-start;
                    gap: 0.8rem;
                    margin-top: auto;
                }
                .vg-info-box i {
                    color: #10b981;
                    margin-top: 0.2rem;
                }
                .vg-info-box p {
                    margin: 0;
                    font-size: 0.75rem;
                    color: #6b7280;
                    font-weight: 600;
                }
                
                /* Bar Chart */
                .vg-bar-container {
                    height: 140px;
                    display: flex;
                    align-items: flex-end;
                    gap: 1rem;
                    margin-top: 1rem;
                    border-bottom: 1px solid #f3f4f6;
                    padding-bottom: 0.5rem;
                    position: relative;
                    padding-left: 1.5rem;
                }
                .vg-bar-y-axis {
                    position: absolute;
                    left: 0;
                    top: 0;
                    bottom: 0;
                    display: flex;
                    flex-direction: column;
                    justify-content: space-between;
                    font-size: 0.65rem;
                    font-weight: 700;
                    color: #9ca3af;
                    padding-bottom: 0.5rem;
                }
                .vg-bar-group {
                    flex: 1;
                    display: flex;
                    justify-content: center;
                    align-items: flex-end;
                    gap: 4px;
                    height: 100%;
                }
                .vg-bar {
                    width: 6px;
                    border-radius: 4px;
                }
                .vg-bar.green { background-color: #10b981; }
                .vg-bar.yellow { background-color: #f59e0b; }
                .vg-bar.blue { background-color: #6366f1; }
                .vg-bar-labels {
                    display: flex;
                    padding-left: 1.5rem;
                    margin-top: 0.5rem;
                }
                .vg-bar-label {
                    flex: 1;
                    text-align: center;
                    font-size: 0.7rem;
                    font-weight: 700;
                    color: #6b7280;
                }
                .vg-bar-footer {
                    display: flex;
                    justify-content: space-between;
                    margin-top: auto;
                    padding-top: 1rem;
                    font-size: 0.75rem;
                    font-weight: 700;
                }
                .vg-bar-footer .left { color: #9ca3af; }
                .vg-bar-footer .right { color: #10b981; cursor: pointer; text-decoration: none; }
                
                /* Novedades */
                .vg-nov-list {
                    display: flex;
                    flex-direction: column;
                    gap: 1rem;
                    margin-top: 0.5rem;
                }
                .vg-nov-item {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    padding-bottom: 1rem;
                    border-bottom: 1px solid #f3f4f6;
                }
                .vg-nov-item:last-child {
                    border-bottom: none;
                    padding-bottom: 0;
                }
                .vg-nov-left {
                    display: flex;
                    gap: 1rem;
                    align-items: flex-start;
                }
                .vg-nov-icon {
                    width: 32px;
                    height: 32px;
                    border-radius: 10px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 0.9rem;
                }
                .vg-nov-icon.blue { background-color: #eff6ff; color: #3b82f6; }
                .vg-nov-icon.green { background-color: #e6f6f1; color: #10b981; }
                .vg-nov-text h4 {
                    margin: 0 0 0.2rem 0;
                    font-size: 0.85rem;
                    font-weight: 800;
                    color: #111827;
                }
                .vg-nov-text p {
                    margin: 0;
                    font-size: 0.7rem;
                    color: #9ca3af;
                    font-weight: 600;
                }
                .vg-badge {
                    padding: 0.3rem 0.6rem;
                    border-radius: 12px;
                    font-size: 0.65rem;
                    font-weight: 800;
                }
                .vg-badge.blue { background-color: #eff6ff; color: #3b82f6; border: 1px solid #bfdbfe; }
                .vg-badge.green { background-color: #e6f6f1; color: #10b981; border: 1px solid #a7f3d0; }
                
                .vg-btn-solid {
                    background-color: #10b981;
                    color: white;
                    border: none;
                    border-radius: 20px;
                    padding: 0.8rem;
                    width: 100%;
                    font-weight: 700;
                    font-size: 0.85rem;
                    margin-top: auto;
                    transition: all 0.2s;
                }
                .vg-btn-solid:hover {
                    background-color: #059669;
                }
                
                /* INSTRUCTOR REDESIGN CSS */
                .inst-hero-banner {
                    background: linear-gradient(135deg, #064e3b 0%, #065f46 100%);
                    border-radius: 24px;
                    padding: 2.5rem 3rem;
                    color: white;
                }
                .inst-badge-active {
                    background-color: rgba(255,255,255,0.1);
                    color: #a7f3d0;
                    padding: 0.4rem 1rem;
                    border-radius: 20px;
                    font-size: 0.75rem;
                    font-weight: 700;
                    display: inline-block;
                    letter-spacing: 0.5px;
                }
                .inst-profile-card {
                    background-color: rgba(255,255,255,0.08);
                    border: 1px solid rgba(255,255,255,0.1);
                    border-radius: 16px;
                    padding: 1.2rem;
                    display: flex;
                    align-items: center;
                    gap: 1.2rem;
                    min-width: 320px;
                }
                .inst-profile-card img {
                    width: 50px;
                    height: 50px;
                    border-radius: 50%;
                    object-fit: cover;
                    border: 2px solid #34d399;
                }
                .inst-kpi-card {
                    background-color: #ffffff;
                    border-radius: 20px;
                    padding: 1.5rem;
                    height: 100%;
                }
                .inst-kpi-title {
                    font-size: 0.7rem;
                    font-weight: 800;
                    color: #9ca3af;
                    letter-spacing: 1px;
                }
                .inst-kpi-icon {
                    width: 35px;
                    height: 35px;
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 1rem;
                }
                .inst-kpi-value {
                    font-size: 2.2rem;
                    font-weight: 800;
                    color: #111827;
                    line-height: 1;
                    margin-bottom: 0.8rem;
                }
                .inst-kpi-subtitle {
                    font-size: 0.75rem;
                    font-weight: 600;
                }
                
                /* Layout */
                .inst-agenda-panel, .inst-cal-panel {
                    background-color: #ffffff;
                    border-radius: 24px;
                    padding: 2rem;
                    height: 100%;
                }
                .inst-agenda-sup {
                    font-size: 0.7rem;
                    font-weight: 800;
                    letter-spacing: 1px;
                }
                .inst-agenda-badge {
                    background-color: #f3f4f6;
                    color: #6b7280;
                    padding: 0.4rem 1rem;
                    border-radius: 20px;
                    font-size: 0.75rem;
                    font-weight: 700;
                }
                .inst-agenda-card {
                    border: 1px solid #f3f4f6;
                    border-radius: 16px;
                    padding: 1.5rem;
                    margin-bottom: 1rem;
                    transition: all 0.2s;
                }
                .inst-agenda-card:hover {
                    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
                    border-color: #e5e7eb;
                }
                .inst-agenda-ficha {
                    background-color: #e6f6f1;
                    color: #10b981;
                    padding: 0.2rem 0.6rem;
                    border-radius: 12px;
                    font-size: 0.65rem;
                    font-weight: 800;
                    letter-spacing: 0.5px;
                }
                .inst-agenda-time {
                    color: #6b7280;
                    font-size: 0.75rem;
                    font-weight: 700;
                }
                .inst-btn-call {
                    background-color: #10b981;
                    color: white;
                    border: none;
                    border-radius: 8px;
                    padding: 0.6rem 1.2rem;
                    font-weight: 700;
                    font-size: 0.85rem;
                    transition: all 0.2s;
                }
                .inst-btn-call:hover {
                    background-color: #059669;
                }
                
                /* Calendar */
                .inst-cal-grid-header {
                    display: grid;
                    grid-template-columns: repeat(7, 1fr);
                    text-align: center;
                    font-weight: 700;
                    color: #9ca3af;
                    font-size: 0.75rem;
                    margin-bottom: 1rem;
                }
                .inst-cal-grid-body {
                    display: grid;
                    grid-template-columns: repeat(7, 1fr);
                    gap: 5px;
                }
                .inst-cal-cell {
                    aspect-ratio: 1;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                    border-radius: 12px;
                    font-weight: 700;
                    font-size: 0.9rem;
                    color: #374151;
                    cursor: pointer;
                    transition: all 0.2s;
                    position: relative;
                }
                .inst-cal-cell:hover {
                    background-color: #f3f4f6;
                }
                .inst-cal-cell.active {
                    background-color: #10b981;
                    color: white;
                    box-shadow: 0 4px 10px rgba(16, 185, 129, 0.3);
                }
                .inst-cal-cell.muted {
                    color: #d1d5db;
                }
                .inst-cal-dot {
                    width: 5px;
                    height: 5px;
                    border-radius: 50%;
                    margin-top: 4px;
                }
                .inst-cal-dot.green { background-color: #10b981; }
                .inst-cal-cell.active .inst-cal-dot.green { background-color: white; }
                .inst-dot-legend {
                    width: 8px;
                    height: 8px;
                    border-radius: 50%;
                }
                .inst-dot-legend.green { background-color: #10b981; }
                .inst-dot-legend.grey { background-color: #e5e7eb; border: 1px solid #d1d5db; }
                </style>
                
                <div class="row g-4 mb-4">
                    <!-- Fila 1 -->
                    <div class="col-12 col-lg-7">
                        <div class="vg-card">
                            <div class="vg-header">
                                <div class="vg-header-left">
                                    <div class="vg-icon-wrapper vg-icon-green">
                                        <i class="fa-regular fa-clock"></i>
                                    </div>
                                    <div class="vg-title-group">
                                        <h3 class="vg-title">Agenda de Hoy</h3>
                                        <p class="vg-subtitle" id="vg-agenda-date"><?= $diaSemanaActual ?>, <?= date('d') ?> De <?= $mesNombres[$mesActual] ?> De <?= $anioActual ?></p>
                                    </div>
                                </div>
                                <a href="#pills-programacion" class="vg-btn-solid" style="width: auto; padding: 0.4rem 1rem; margin-top: 0; text-decoration: none;" onclick="window.location.hash = '#pills-programacion'; return false;">
                                    <i class="fa-regular fa-calendar"></i> Ver Calendario Completo
                                </a>
                            </div>
                            
                            <div class="vg-agenda-container">
                                <?php if (count($sesionesHoy) > 0): ?>
                                    <div class="vg-agenda-line"></div>
                                    <?php foreach ($sesionesHoy as $sesion): ?>
                                    <div style="position: relative; margin-bottom: 1.5rem;">
                                        <div class="vg-agenda-dot" style="left: -0.95rem;"></div>
                                        <div class="vg-agenda-time" style="left: -5rem;">
                                            <span><?= substr($sesion->hora_inicio, 0, 5) ?></span>
                                            <span><?= substr($sesion->hora_fin, 0, 5) ?></span>
                                        </div>
                                        
                                        <div class="vg-agenda-card shadow-sm" style="margin-bottom: 0;">
                                            <div class="vg-agenda-card-header">
                                                <span class="vg-agenda-ficha">FICHA #<?= htmlspecialchars($sesion->numero_ficha ?? 'N/A') ?></span>
                                                <?php if ($sesion === $proximaSesion): ?>
                                                    <span class="vg-badge-orange">Próxima</span>
                                                <?php else: ?>
                                                    <span class="vg-badge-blue" style="background-color:#eff6ff;color:#3b82f6;padding:0.2rem 0.6rem;border-radius:12px;font-size:0.7rem;font-weight:700;">Programada</span>
                                                <?php endif; ?>
                                            </div>
                                            <h4 class="vg-agenda-course"><?= htmlspecialchars($sesion->programa_nombre ?? 'Programa Formativo') ?></h4>
                                            <div class="vg-agenda-details">
                                                <span><i class="fa-solid fa-location-dot"></i> Ambiente: <strong><?= htmlspecialchars($sesion->ambiente_nombre ?? 'N/A') ?></strong></span>
                                                <span><i class="fa-regular fa-user"></i> Instructor: <strong><?= htmlspecialchars(($sesion->instructor_nombre ?? '').' '.($sesion->instructor_apellido ?? '')) ?></strong></span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="text-center py-4 text-muted" style="margin-top: 2rem;">
                                        <div style="background-color: #f9fafb; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem auto;">
                                            <i class="fa-regular fa-calendar" style="font-size: 1.5rem; color: #9ca3af;"></i>
                                        </div>
                                        <h4 style="font-weight: 800; font-size: 1rem; color: #4b5563; margin-bottom: 0.5rem;">No hay clases programadas</h4>
                                        <p style="font-size: 0.8rem; color: #9ca3af; margin-bottom: 0;">No se encontraron bloques académicos registrados para<br>este día de la semana.</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12 col-lg-5">
                        <div class="vg-card">
                            <div class="vg-header">
                                <div class="vg-header-left">
                                    <div class="vg-icon-wrapper vg-icon-green">
                                        <i class="fa-regular fa-calendar"></i>
                                    </div>
                                    <div class="vg-title-group">
                                        <h3 class="vg-title">Calendario de Ambientes</h3>
                                        <p class="vg-subtitle">Calendario mensual</p>
                                    </div>
                                </div>
                                <form method="GET" action="" style="display: flex; align-items: center; gap: 0.5rem; margin: 0;" onsubmit="return false;">
                                    <span style="font-size: 0.75rem; color: #4b5563; font-weight: 700;">Ambiente:</span>
                                    <div class="vg-btn-outline" style="padding: 0 1.5rem 0 0.8rem; position: relative; background: white; margin: 0;">
                                        <i class="fa-solid fa-building" style="color: #10b981; margin-right: 0.3rem;"></i>
                                        <select name="filtro_ambiente" id="filtro_ambiente_select" onchange="filtrarCalendarioLocal()" style="appearance: none; border: none; background: transparent; font-size: 0.75rem; font-weight: 700; color: #4b5563; padding: 0.4rem 0; outline: none; cursor: pointer; max-width: 150px;">
                                            <option value="">Todos</option>
                                            <?php 
                                            // Extraer ambientes únicos de la programación
                                            $ambientesDisponibles = [];
                                            if (isset($programacion) && is_array($programacion)) {
                                                foreach($programacion as $p) {
                                                    if (!empty($p->ambiente_nombre)) {
                                                        $ambientesDisponibles[trim($p->ambiente_nombre)] = trim($p->ambiente_nombre);
                                                    }
                                                }
                                                asort($ambientesDisponibles);
                                                foreach($ambientesDisponibles as $amb) {
                                                    $sel = ($filtroAmb === $amb) ? 'selected' : '';
                                                    echo "<option value='" . htmlspecialchars($amb) . "' {$sel}>" . htmlspecialchars($amb) . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                        <i class="fa-solid fa-chevron-down" style="font-size: 0.6rem; color: #9ca3af; position: absolute; right: 0.8rem; top: 50%; transform: translateY(-50%); pointer-events: none;"></i>
                                    </div>
                                </form>
                            </div>
                            
                            <div class="vg-cal-grid">
                                <div class="vg-cal-day-name">LUN</div>
                                <div class="vg-cal-day-name">MAR</div>
                                <div class="vg-cal-day-name">MIE</div>
                                <div class="vg-cal-day-name">JUE</div>
                                <div class="vg-cal-day-name">VIE</div>
                                <div class="vg-cal-day-name">SAB</div>
                                <div class="vg-cal-day-name">DOM</div>
                                
                                <?php
                                $primerDiaMes = date('w', mktime(0, 0, 0, $mesActual, 1, $anioActual));
                                $primerDiaMes = $primerDiaMes == 0 ? 7 : $primerDiaMes; // 1 = Lunes
                                
                                $diasMesAnterior = date('t', mktime(0, 0, 0, $mesActual - 1, 1, $anioActual));
                                
                                // Días del mes anterior para rellenar
                                for ($i = 1; $i < $primerDiaMes; $i++) {
                                    $diaMostrar = $diasMesAnterior - ($primerDiaMes - $i) + 1;
                                    echo '<div class="vg-cal-cell muted">'.$diaMostrar.' <div class="vg-dot yellow"></div></div>';
                                }
                                
                                // Días del mes actual
                                $diasTotal = cal_days_in_month(CAL_GREGORIAN, $mesActual, $anioActual);
                                $hoy = date('j');
                                for ($d = 1; $d <= $diasTotal; $d++) {
                                    $activeClass = ($d == $hoy) ? 'active' : '';
                                    
                                    // Lógica de puntos (volumen de programación)
                                    $volumen = $diasProgramados[$d] ?? 0;
                                    $dotClass = 'green'; // Disponible por defecto
                                    if ($volumen > 0) {
                                        if ($maxVolumen > 0 && $volumen > ($maxVolumen * 0.66)) {
                                            $dotClass = 'red'; // Ocupado (Alta demanda)
                                        } else {
                                            $dotClass = 'yellow'; // Reservado (Media demanda)
                                        }
                                    }
                                    
                                    echo '<div class="vg-cal-cell '.$activeClass.'" style="cursor: pointer;" onclick="verAgendaDia('.$d.', '.$mesActual.', '.$anioActual.', this)">'.$d.' <div class="vg-dot '.$dotClass.'"></div></div>';
                                }
                                
                                // Días del mes siguiente para completar la cuadrícula (hasta 42 celdas)
                                $celdasUsadas = ($primerDiaMes - 1) + $diasTotal;
                                $diasSiguiente = 1;
                                while ($celdasUsadas < 42) {
                                    echo '<div class="vg-cal-cell muted">'.$diasSiguiente.' <div class="vg-dot green"></div></div>';
                                    $diasSiguiente++;
                                    $celdasUsadas++;
                                    if ($celdasUsadas % 7 == 0 && $celdasUsadas >= 35) break; // Terminar en fila de 5 o 6
                                }
                                ?>
                            </div>
                            
                            <div class="vg-cal-legend">
                                <div class="vg-cal-legend-item"><div class="vg-dot green"></div> Disponible</div>
                                <div class="vg-cal-legend-item"><div class="vg-dot yellow"></div> Reservado</div>
                                <div class="vg-cal-legend-item"><div class="vg-dot red"></div> Ocupado</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <script>
                const programacionDataVg = <?= json_encode($programacion ?? []) ?>;
                const nombresDiasVg = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
                const mesesNombresVg = ['', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
                
                const currentMesVg = <?= (int)$mesActual ?>;
                const currentAnioVg = <?= (int)$anioActual ?>;

                function filtrarCalendarioLocal() {
                    const selectAmbiente = document.getElementById('filtro_ambiente_select');
                    const filtroAmbiente = selectAmbiente ? selectAmbiente.value.trim() : '';

                    let maxVol = 1;
                    let diasProgramados = {};

                    programacionDataVg.forEach(p => {
                        if (filtroAmbiente !== '' && (!p.ambiente_nombre || p.ambiente_nombre.trim() !== filtroAmbiente)) return;
                        if (p.fecha_inicio) {
                            const parts = p.fecha_inicio.split('-');
                            if (parts.length === 3) {
                                const y = parseInt(parts[0]);
                                const m = parseInt(parts[1]);
                                const d = parseInt(parts[2]);
                                
                                if (m === currentMesVg && y === currentAnioVg) {
                                    if (!diasProgramados[d]) diasProgramados[d] = 0;
                                    diasProgramados[d]++;
                                    if (diasProgramados[d] > maxVol) maxVol = diasProgramados[d];
                                }
                            }
                        }
                    });

                    document.querySelectorAll('.vg-cal-cell:not(.muted)').forEach(cell => {
                        const text = cell.textContent || cell.innerText;
                        const d = parseInt(text.trim());
                        
                        let dot = cell.querySelector('.vg-dot');
                        if (!dot) return;
                        
                        dot.className = 'vg-dot green'; 
                        const vol = diasProgramados[d] || 0;
                        
                        if (vol > 0) {
                            if (maxVol > 0 && vol > (maxVol * 0.66)) {
                                dot.className = 'vg-dot red';
                            } else {
                                dot.className = 'vg-dot yellow';
                            }
                        }
                    });

                    const activeCell = document.querySelector('.vg-cal-cell.active');
                    if (activeCell) {
                        activeCell.click();
                    } else {
                        // Si no hay ninguna activa, forzamos actualizar la vista de hoy para reflejar el filtro
                        verAgendaDia(new Date().getDate(), currentMesVg, currentAnioVg, null);
                    }
                }

                function verAgendaDia(dia, mes, anio, elementoDia) {
                    document.querySelectorAll('.vg-cal-cell').forEach(el => el.classList.remove('active'));
                    if (elementoDia) elementoDia.classList.add('active');

                    const fechaObj = new Date(anio, mes - 1, dia);
                    const diaSemanaNombre = nombresDiasVg[fechaObj.getDay()];

                    const yyyy = anio;
                    const mm = String(mes).padStart(2, '0');
                    const dd = String(dia).padStart(2, '0');
                    const dateStr = `${yyyy}-${mm}-${dd}`;

                    const selectAmbiente = document.querySelector('select[name="filtro_ambiente"]');
                    let filtroAmbiente = selectAmbiente ? selectAmbiente.value.trim() : '';
                    
                    let sesiones = programacionDataVg.filter(p => {
                        let coincideAmbiente = filtroAmbiente === '' || (p.ambiente_nombre && p.ambiente_nombre.trim() === filtroAmbiente);
                        let coincideFecha = p.fecha_inicio === dateStr;
                        return coincideFecha && coincideAmbiente;
                    });

                    sesiones.sort((a, b) => (a.hora_inicio || '').localeCompare(b.hora_inicio || ''));
                    
                    const hoy = new Date();

                    const agendaContainer = document.querySelector('.vg-agenda-container');
                    const tituloFecha = document.getElementById('vg-agenda-date');
                    if (tituloFecha) {
                        tituloFecha.innerHTML = `${diaSemanaNombre}, ${dia} De ${mesesNombresVg[mes]} De ${anio}`;
                        const tituloH3 = tituloFecha.previousElementSibling;
                        if (hoy.getDate() === dia && hoy.getMonth() + 1 === mes && hoy.getFullYear() === anio) {
                            tituloH3.textContent = 'Agenda de Hoy';
                        } else {
                            tituloH3.textContent = 'Agenda del Día';
                        }
                    }

                    if (sesiones.length > 0) {
                        let htmlStr = '<div class="vg-agenda-line"></div>';
                        
                        let horaActual = hoy.getHours().toString().padStart(2, '0') + ':' + hoy.getMinutes().toString().padStart(2, '0');
                        let esHoy = (hoy.getDate() === dia && hoy.getMonth() + 1 === mes && hoy.getFullYear() === anio);
                        
                        let proximaRef = null;
                        if (esHoy) {
                            for (let s of sesiones) {
                                if (s.hora_fin && s.hora_fin.substring(0,5) > horaActual) {
                                    proximaRef = s;
                                    break;
                                }
                            }
                            if (!proximaRef && sesiones.length > 0) proximaRef = sesiones[sesiones.length - 1];
                        }

                        sesiones.forEach(s => {
                            let ficha = s.numero_ficha || 'N/A';
                            let programa = s.programa_nombre || 'Programa Formativo';
                            let ambiente = s.ambiente_nombre || 'N/A';
                            let instr_nombre = s.instructor_nombre || '';
                            let instr_apellido = s.instructor_apellido || '';
                            let instructor = `${instr_nombre} ${instr_apellido}`.trim();
                            if (!instructor) instructor = 'N/A';
                            
                            let inicio = s.hora_inicio ? s.hora_inicio.substring(0, 5) : '';
                            let fin = s.hora_fin ? s.hora_fin.substring(0, 5) : '';
                            
                            let badgeHtml = '<span class="vg-badge-blue" style="background-color:#eff6ff;color:#3b82f6;padding:0.2rem 0.6rem;border-radius:12px;font-size:0.7rem;font-weight:700;">Programada</span>';
                            if (esHoy && s === proximaRef) {
                                badgeHtml = '<span class="vg-badge-orange">Próxima</span>';
                            }

                            htmlStr += `
                                <div style="position: relative; margin-bottom: 1.5rem;">
                                    <div class="vg-agenda-dot" style="left: -0.95rem;"></div>
                                    <div class="vg-agenda-time" style="left: -5rem;">
                                        <span>${inicio}</span>
                                        <span>${fin}</span>
                                    </div>
                                    
                                    <div class="vg-agenda-card shadow-sm" style="margin-bottom: 0;">
                                        <div class="vg-agenda-card-header">
                                            <span class="vg-agenda-ficha">FICHA #${ficha}</span>
                                            ${badgeHtml}
                                        </div>
                                        <h4 class="vg-agenda-course">${programa}</h4>
                                        <div class="vg-agenda-details">
                                            <span><i class="fa-solid fa-location-dot"></i> Ambiente: <strong>${ambiente}</strong></span>
                                            <span><i class="fa-regular fa-user"></i> Instructor: <strong>${instructor}</strong></span>
                                        </div>
                                    </div>
                                </div>
                            `;
                        });
                        
                        agendaContainer.innerHTML = htmlStr;
                    } else {
                        agendaContainer.innerHTML = `
                            <div class="text-center py-4 text-muted" style="margin-top: 2rem;">
                                <div style="background-color: #f9fafb; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem auto;">
                                    <i class="fa-regular fa-calendar" style="font-size: 1.5rem; color: #9ca3af;"></i>
                                </div>
                                <h4 style="font-weight: 800; font-size: 1rem; color: #4b5563; margin-bottom: 0.5rem;">No hay clases programadas</h4>
                                <p style="font-size: 0.8rem; color: #9ca3af; margin-bottom: 0;">No se encontraron bloques académicos registrados para<br>este día de la semana.</p>
                            </div>
                        `;
                    }
                }
                </script>
                
                <div class="row g-4 mb-5">
                    <!-- Fila 2 -->
                    <div class="col-12 col-lg-4">
                        <div class="vg-card">
                            <div class="vg-header">
                                <div class="vg-header-left">
                                    <div class="vg-icon-wrapper vg-icon-green">
                                        <i class="fa-solid fa-house"></i>
                                    </div>
                                    <div class="vg-title-group">
                                        <h3 class="vg-title">Ambientes por Estado</h3>
                                        <p class="vg-subtitle">Inventario e infraestructura</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="vg-donut-container">
                                <div class="vg-donut">
                                    <div class="vg-donut-inner">
                                        <strong><?= $totalAmbientes ?></strong>
                                        <span>TOTAL</span>
                                    </div>
                                </div>
                                <div class="vg-donut-legend">
                                    <div class="vg-donut-item">
                                        <div class="vg-donut-item-left"><div class="vg-dot green"></div> Activos</div>
                                        <span><?= $ambActivos ?> (<?= $pctActivos ?>%)</span>
                                    </div>
                                    <div class="vg-donut-item">
                                        <div class="vg-donut-item-left"><div class="vg-dot yellow"></div> Mantenimiento</div>
                                        <span><?= $ambMantenimiento ?> (<?= $pctMantenimiento ?>%)</span>
                                    </div>
                                    <div class="vg-donut-item">
                                        <div class="vg-donut-item-left"><div class="vg-dot red"></div> Inactivos</div>
                                        <span><?= $ambInactivos ?> (<?= $pctInactivos ?>%)</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="vg-info-box">
                                <i class="fa-solid fa-circle-info"></i>
                                <p>Para cambiar estados de ambientes, asigne novedades o configure su disponibilidad.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12 col-lg-4">
                        <div class="vg-card">
                            <div class="vg-header mb-2">
                                <div class="vg-header-left">
                                    <div class="vg-icon-wrapper vg-icon-green">
                                        <i class="fa-solid fa-chart-line"></i>
                                    </div>
                                    <div class="vg-title-group">
                                        <h3 class="vg-title">Programación por Jornada</h3>
                                        <p class="vg-subtitle">Schedules académicos</p>
                                    </div>
                                </div>
                                <div style="display:flex; gap: 0.5rem; font-size: 0.6rem; font-weight: 800; color: #9ca3af; align-items:center;">
                                    <span style="display:flex;align-items:center;gap:2px;"><div class="vg-dot green"></div> M</span>
                                    <span style="display:flex;align-items:center;gap:2px;"><div class="vg-dot yellow"></div> T</span>
                                    <span style="display:flex;align-items:center;gap:2px;"><div class="vg-dot blue"></div> N</span>
                                </div>
                            </div>
                            
                            <div class="vg-bar-container">
                                <div class="vg-bar-y-axis">
                                    <span><?= $maxTurno ?></span>
                                    <span><?= round($maxTurno * 0.66) ?></span>
                                    <span><?= round($maxTurno * 0.33) ?></span>
                                    <span>0</span>
                                </div>
                                
                                <?php foreach (['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'] as $dia): ?>
                                <div class="vg-bar-group">
                                    <div class="vg-bar green" style="height: <?= $turnosToPct($turnos[$dia]['M']) ?>%" title="Mañana: <?= $turnos[$dia]['M'] ?>"></div>
                                    <div class="vg-bar yellow" style="height: <?= $turnosToPct($turnos[$dia]['T']) ?>%" title="Tarde: <?= $turnos[$dia]['T'] ?>"></div>
                                    <div class="vg-bar blue" style="height: <?= $turnosToPct($turnos[$dia]['N']) ?>%" title="Noche: <?= $turnos[$dia]['N'] ?>"></div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            
                            <div class="vg-bar-labels">
                                <div class="vg-bar-label">Lun</div>
                                <div class="vg-bar-label">Mar</div>
                                <div class="vg-bar-label">Mié</div>
                                <div class="vg-bar-label">Jue</div>
                                <div class="vg-bar-label">Vie</div>
                                <div class="vg-bar-label">Sáb</div>
                            </div>
                            
                            <div class="vg-bar-footer">
                                <span class="left">Distribución por turnos</span>
                                <a href="#" class="right" onclick="cambiarVista('calendario'); document.getElementById('pills-programacion-tab').click(); return false;">Ver Bloques &rarr;</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12 col-lg-4">
                        <div class="vg-card">
                            <div class="vg-header mb-4">
                                <div class="vg-header-left">
                                    <div class="vg-icon-wrapper vg-icon-red">
                                        <i class="fa-solid fa-triangle-exclamation"></i>
                                    </div>
                                    <div class="vg-title-group">
                                        <h3 class="vg-title">Novedades Recientes</h3>
                                        <p class="vg-subtitle">Infraestructura y aulas</p>
                                    </div>
                                </div>
                                <a href="#" style="color: #10b981; font-size: 0.75rem; font-weight: 800; cursor: pointer; text-decoration: none;" onclick="document.getElementById('pills-novedades-tab').click(); return false;">VER TODAS</a>
                            </div>
                            
                            <div class="vg-nov-list">
                                <?php if (!empty($novRecientes)): ?>
                                    <?php foreach ($novRecientes as $nov): ?>
                                        <?php 
                                        $esResuelta = (strtolower(trim($nov->estado ?? '')) === 'resuelta');
                                        $iconClass = $esResuelta ? 'green' : 'blue';
                                        $iconName = $esResuelta ? 'fa-check-circle' : 'fa-triangle-exclamation';
                                        ?>
                                        <div class="vg-nov-item">
                                            <div class="vg-nov-left">
                                                <div class="vg-nov-icon <?= $iconClass ?>"><i class="fa-solid <?= $iconName ?>"></i></div>
                                                <div class="vg-nov-text">
                                                    <h4><?= htmlspecialchars(mb_strimwidth($nov->descripcion ?? 'Novedad sin descripción', 0, 35, '...')) ?></h4>
                                                    <p><?= htmlspecialchars($nov->fecha_reporte ?? date('Y-m-d')) ?></p>
                                                </div>
                                            </div>
                                            <div class="vg-badge <?= $iconClass ?>" <?= !$esResuelta ? 'style="display:flex;align-items:center;gap:0.3rem;"' : '' ?>>
                                                <?= htmlspecialchars(ucfirst($nov->estado ?? 'Pendiente')) ?>
                                                <?php if (!$esResuelta): ?><i class="fa-solid fa-clock" style="font-size:0.6rem;"></i><?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="text-center text-muted small py-3">
                                        No hay novedades recientes.
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <button class="vg-btn-solid mt-auto" onclick="document.getElementById('pills-novedades-tab').click(); setTimeout(() => document.getElementById('btnNuevaNovedad').click(), 300);">
                                <i class="fa-solid fa-plus me-1"></i> Registrar Novedad
                            </button>
                        </div>
                    </div>
                </div>

            </div>
            
            <!-- PESTAÑA 1: FICHAS DE FORMACIÓN -->
            <div class="tab-pane fade" id="pills-fichas" role="tabpanel" aria-labelledby="pills-fichas-tab">
                <?php include APPROOT . '/Views/fichas/index.php'; ?>
            </div>

            <!-- PESTAÑA NUEVA: PROGRAMAS DE FORMACIÓN -->
            <div class="tab-pane fade" id="pills-programas" role="tabpanel" aria-labelledby="pills-programas-tab">
                <style>
                    .programas-hero-card,
                    .programas-filter-card {
                        background: #ffffff;
                        border: 1px solid rgba(15, 23, 42, 0.08);
                        border-radius: 24px;
                        box-shadow: 0 16px 45px rgba(15, 23, 42, 0.06);
                    }

                    .programas-hero-card {
                        display: grid;
                        grid-template-columns: auto minmax(0, 1fr) 1px auto;
                        align-items: center;
                        gap: 1.6rem;
                        padding: 1.7rem 2.1rem;
                    }

                    .programas-hero-icon {
                        width: 82px;
                        height: 82px;
                        border-radius: 50%;
                        background: linear-gradient(145deg, #eef9f1 0%, #dff2e6 100%);
                        color: #118a3b;
                        display: inline-flex;
                        align-items: center;
                        justify-content: center;
                        font-size: 2.45rem;
                    }

                    .programas-hero-title {
                        color: #111827;
                        font-size: clamp(1.35rem, 2vw, 1.85rem);
                        font-weight: 800;
                        letter-spacing: 0;
                        margin-bottom: 0.55rem;
                    }

                    .programas-hero-subtitle {
                        color: #6b7280;
                        font-size: 0.98rem;
                        line-height: 1.45;
                        max-width: 760px;
                    }

                    .programas-hero-divider {
                        width: 1px;
                        height: 86px;
                        background: #a8d8b6;
                    }

                    .programas-create-btn {
                        min-width: 205px;
                        justify-content: center;
                        border-radius: 14px;
                        padding: 0.85rem 1.25rem;
                        background: #0f8f2f;
                        color: #ffffff;
                        box-shadow: 0 10px 22px rgba(15, 143, 47, 0.2);
                        font-size: 0.95rem;
                        font-weight: 800;
                    }

                    .programas-create-btn:hover {
                        background: #087329;
                        color: #ffffff;
                    }

                    .programas-create-btn .programas-create-icon {
                        width: 28px;
                        height: 28px;
                        border-radius: 50%;
                        background: #ffffff;
                        color: #0f8f2f;
                        display: inline-flex;
                        align-items: center;
                        justify-content: center;
                        font-size: 0.82rem;
                    }

                    .programas-filter-card {
                        display: grid;
                        grid-template-columns: minmax(280px, 1fr) minmax(230px, 0.58fr) auto;
                        gap: 1rem;
                        padding: 1.45rem;
                        align-items: center;
                    }

                    .programas-search-box,
                    .programas-select-box,
                    .programas-count-pill {
                        min-height: 56px;
                        border-radius: 14px;
                        display: flex;
                        align-items: center;
                        gap: 0.85rem;
                        padding: 0 1.15rem;
                    }

                    .programas-search-box {
                        border: 1.5px solid #0f8f2f;
                        background: #ffffff;
                    }

                    .programas-select-box {
                        border: 1px solid #d7dee8;
                        background: #ffffff;
                        position: relative;
                    }

                    .programas-count-pill {
                        min-width: 205px;
                        justify-content: center;
                        border: 1px solid #c7e9d2;
                        background: #eaf7ef;
                        color: #0f8f2f;
                        font-size: 0.95rem;
                        font-weight: 800;
                    }

                    .programas-field-icon {
                        color: #0f8f2f;
                        font-size: 1.28rem;
                        flex: 0 0 auto;
                    }

                    .programas-search-input,
                    .programas-select-input {
                        width: 100%;
                        border: 0;
                        outline: 0;
                        box-shadow: none;
                        background: transparent;
                        color: #111827;
                        font-size: 0.95rem;
                        font-weight: 500;
                    }

                    .programas-search-input::placeholder {
                        color: #7b8494;
                    }

                    .programas-select-input {
                        appearance: none;
                        padding-right: 2.4rem;
                    }

                    .programas-select-chevron {
                        position: absolute;
                        right: 1.35rem;
                        color: #0f8f2f;
                        pointer-events: none;
                    }

                    @media (max-width: 1199.98px) {
                        .programas-hero-card {
                            grid-template-columns: auto minmax(0, 1fr);
                        }

                        .programas-hero-divider {
                            display: none;
                        }

                        .programas-create-btn {
                            grid-column: 1 / -1;
                            width: 100%;
                        }

                        .programas-filter-card {
                            grid-template-columns: 1fr;
                        }

                        .programas-count-pill {
                            width: 100%;
                        }
                    }

                    @media (max-width: 767.98px) {
                        .programas-hero-card {
                            grid-template-columns: 1fr;
                            padding: 1.4rem;
                            text-align: left;
                        }

                        .programas-hero-icon {
                            width: 70px;
                            height: 70px;
                            font-size: 2.1rem;
                        }

                        .programas-filter-card {
                            padding: 1rem;
                        }

                        .programas-search-box,
                        .programas-select-box,
                        .programas-count-pill {
                            min-height: 54px;
                            padding: 0 1rem;
                        }
                    }
                </style>

                <div class="programas-hero-card mb-4">
                    <div class="programas-hero-icon" aria-hidden="true">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>
                    <div class="programas-hero-copy">
                        <h5 class="programas-hero-title">Catálogo de Programas de Formación</h5>
                        <p class="programas-hero-subtitle mb-0">Explora la oferta académica disponible para aprendices y consulta los detalles de cada programa de formación.</p>
                    </div>
                    <div class="programas-hero-divider" aria-hidden="true"></div>
                    <button type="button" class="btn programas-create-btn text-decoration-none d-inline-flex align-items-center gap-3" data-bs-toggle="modal" data-bs-target="#modalCrearPrograma">
                        <span class="programas-create-icon"><i class="fa-solid fa-plus"></i></span>
                        <span>Crear Programa</span>
                    </button>
                </div>

                <!-- Buscador de Programas -->
                <div class="programas-filter-card mb-4">
                    <label class="programas-search-box mb-0" for="buscarPrograma">
                        <i class="fa-solid fa-magnifying-glass programas-field-icon"></i>
                        <input type="text" id="buscarPrograma" class="programas-search-input" placeholder="Buscar por código o nombre del programa...">
                    </label>

                    <label class="programas-select-box mb-0" for="filtroVigenciaPrograma">
                        <i class="fa-regular fa-calendar programas-field-icon"></i>
                        <select id="filtroVigenciaPrograma" class="programas-select-input">
                            <option value="">Todas las vigencias</option>
                            <?php 
                            $vigencias = array_unique(array_column($programas ?? [], 'vigencia'));
                            rsort($vigencias);
                            foreach ($vigencias as $v): ?>
                                <option value="<?= htmlspecialchars($v); ?>"><?= htmlspecialchars($v); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <i class="fa-solid fa-chevron-down programas-select-chevron"></i>
                    </label>

                    <div class="programas-count-pill">
                        <i class="fa-solid fa-layer-group programas-field-icon"></i>
                        <span id="contadorProgramas"><?= count($programas ?? []); ?> programas</span>
                    </div>
                </div>

                <div class="card bg-white border-0 shadow-sm rounded-4 p-0 overflow-hidden" style="border: 1px solid rgba(0,0,0,0.06);">
                    <div class="card-body p-0">
                        <?php if (empty($programas)): ?>
                            <div class="text-center py-5 text-muted">
                                <i class="fa-solid fa-book-open fa-3x mb-3 text-secondary"></i>
                                <h5 class="fw-bold">No hay programas registrados</h5>
                            </div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light text-secondary small text-uppercase py-3" style="font-size: 0.78rem; font-weight: 700; letter-spacing: 0.5px;">
                                        <tr>
                                            <th class="ps-4 py-3">CÓDIGO</th>
                                            <th class="py-3">PROGRAMA</th>
                                            <th class="py-3">VERSIÓN</th>
                                            <th class="py-3">VIGENCIA</th>
                                            <th class="text-end pe-4 py-3">ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <?php foreach ($programas as $p): ?>
                                    <tbody class="programa-item" data-search="<?= htmlspecialchars(strtolower($p->codigo . ' ' . $p->nombre)); ?>" data-vigencia="<?= htmlspecialchars($p->vigencia); ?>">
                                        <tr>
                                            <td class="ps-4"><span class="badge-ficha-table fw-bold">#<?= $p->codigo; ?></span></td>
                                                <td>
                                                    <div class="fw-bold text-dark small"><?= $p->nombre; ?></div>
                                                    <div class="text-muted small">Duración total: <?= $p->duracion_lectiva + $p->duracion_practica; ?> horas</div>
                                                </td>
                                                <td class="text-dark small fw-medium">v<?= $p->version; ?></td>
                                                <td class="text-dark small fw-medium"><?= $p->vigencia; ?></td>
                                                <td class="text-end pe-4">
                                                    <a href="<?= URLROOT; ?>/index.php?route=programas/show&id=<?= $p->id_programa; ?>" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-bold shadow-sm">
                                                        <i class="fa-solid fa-eye me-1"></i> Ver Programa
                                                    </a>
                                                </td>
                                            </tr>

                                        </tbody>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- PESTAÑA 2: PROGRAMACIÓN ACADÉMICA -->
            <div class="tab-pane fade" id="pills-programacion" role="tabpanel" aria-labelledby="pills-programacion-tab">
                <style>
                    .programacion-hero-card,
                    .programacion-view-toggle,
                    .programacion-control-card {
                        background: #ffffff;
                        border: 1px solid rgba(15, 23, 42, 0.08);
                        border-radius: 24px;
                        box-shadow: 0 16px 45px rgba(15, 23, 42, 0.06);
                    }

                    .programacion-hero-card {
                        display: grid;
                        grid-template-columns: auto 1px minmax(0, 1fr) auto;
                        align-items: center;
                        gap: 1.7rem;
                        padding: 1.7rem 2.1rem;
                    }

                    .programacion-hero-icon {
                        width: 82px;
                        height: 82px;
                        border-radius: 50%;
                        background: linear-gradient(145deg, #eef9f1 0%, #dff2e6 100%);
                        color: #0f8f2f;
                        display: inline-flex;
                        align-items: center;
                        justify-content: center;
                        font-size: 2.75rem;
                    }

                    .programacion-hero-divider {
                        width: 1px;
                        height: 86px;
                        background: #a8d8b6;
                    }

                    .programacion-hero-title {
                        color: #111827;
                        font-size: clamp(1.35rem, 2vw, 1.85rem);
                        font-weight: 800;
                        letter-spacing: 0;
                        margin-bottom: 0.55rem;
                    }

                    .programacion-hero-subtitle {
                        color: #6b7280;
                        font-size: 0.98rem;
                        line-height: 1.45;
                        max-width: 760px;
                    }

                    .programacion-action-btn {
                        min-width: 205px;
                        justify-content: center;
                        border: 0;
                        border-radius: 16px;
                        padding: 0.85rem 1.25rem;
                        background: #0f8f2f;
                        color: #ffffff;
                        box-shadow: 0 10px 22px rgba(15, 143, 47, 0.2);
                        font-size: 0.95rem;
                        font-weight: 800;
                    }

                    .programacion-action-btn:hover {
                        background: #087329;
                        color: #ffffff;
                    }

                    .programacion-action-icon {
                        width: 28px;
                        height: 28px;
                        border-radius: 50%;
                        background: #ffffff;
                        color: #0f8f2f;
                        display: inline-flex;
                        align-items: center;
                        justify-content: center;
                        font-size: 0.82rem;
                    }

                    .programacion-view-row {
                        display: flex;
                        justify-content: flex-end;
                        margin-bottom: 1.5rem;
                    }

                    .programacion-view-toggle {
                        display: inline-flex;
                        align-items: center;
                        gap: 0.65rem;
                        border-radius: 999px;
                        padding: 0.45rem;
                    }

                    .programacion-view-label {
                        color: #6b7280;
                        font-size: 0.82rem;
                        font-weight: 800;
                        letter-spacing: 0.6px;
                        text-transform: uppercase;
                        padding: 0 0.7rem;
                    }

                    .programacion-view-btn {
                        min-height: 44px;
                        border: 1px solid rgba(15, 23, 42, 0.08) !important;
                        border-radius: 999px !important;
                        background: #ffffff !important;
                        color: #1f2937 !important;
                        padding: 0 1.35rem !important;
                        font-weight: 700;
                        box-shadow: none !important;
                        display: inline-flex;
                        align-items: center;
                        gap: 0.55rem;
                    }

                    .programacion-view-btn.active,
                    .programacion-view-btn.btn-success {
                        background: #eaf7ef !important;
                        color: #0f8f2f !important;
                        border-color: #c7e9d2 !important;
                    }

                    .programacion-control-card {
                        display: grid;
                        grid-template-columns: auto 1px minmax(0, 1fr);
                        align-items: center;
                        gap: 1.05rem;
                        padding: 1.35rem 1.45rem;
                    }

                    .programacion-month-controls {
                        display: flex;
                        align-items: center;
                        gap: 0.65rem;
                        flex: 0 0 auto;
                    }

                    .programacion-nav-btn {
                        width: 42px;
                        height: 42px;
                        border: 1px solid #dfe6ee;
                        border-radius: 12px !important;
                        background: #ffffff;
                        color: #0f8f2f;
                        display: inline-flex;
                        align-items: center;
                        justify-content: center;
                        font-size: 0.95rem;
                    }

                    .programacion-nav-btn:hover {
                        background: #f0fdf4;
                        border-color: #c7e9d2;
                        color: #087329;
                    }

                    .programacion-month-box {
                        min-width: 172px;
                        min-height: 42px;
                        border: 1px solid #dfe6ee;
                        border-radius: 12px;
                        background: #ffffff;
                        color: #111827;
                        display: inline-flex;
                        align-items: center;
                        justify-content: center;
                        gap: 0.65rem;
                        padding: 0 0.9rem;
                        font-weight: 800;
                        font-size: 0.9rem;
                    }

                    .programacion-month-box i {
                        color: #0f8f2f;
                    }

                    .programacion-control-divider {
                        width: 1px;
                        height: 48px;
                        background: #e1e8ef;
                    }

                    .programacion-filter-grid {
                        display: grid;
                        grid-template-columns: repeat(4, minmax(0, 1fr));
                        gap: 0.75rem;
                        min-width: 0;
                    }

                    .programacion-filter-field {
                        min-height: 42px;
                        border: 1px solid #dfe6ee;
                        border-radius: 12px;
                        background: #ffffff;
                        display: flex;
                        align-items: center;
                        gap: 0.52rem;
                        padding: 0 0.75rem;
                        position: relative;
                        margin: 0;
                        min-width: 0;
                    }

                    .programacion-filter-field.is-primary {
                        border-color: #85d39a;
                    }

                    .programacion-filter-field > i:first-child {
                        color: #0f8f2f;
                        font-size: 0.98rem;
                        flex: 0 0 auto;
                    }

                    .programacion-filter-select {
                        width: 100%;
                        border: 0;
                        background: transparent;
                        color: #1f2937;
                        font-size: 0.82rem;
                        font-weight: 700;
                        outline: 0;
                        box-shadow: none;
                        appearance: none;
                        min-width: 0;
                        padding-right: 1.25rem;
                        text-overflow: ellipsis;
                        white-space: nowrap;
                        overflow: hidden;
                    }

                    .programacion-filter-chevron {
                        position: absolute;
                        right: 0.72rem;
                        color: #111827;
                        pointer-events: none;
                        font-size: 0.78rem;
                    }

                    @media (max-width: 1199.98px) {
                        .programacion-hero-card {
                            grid-template-columns: auto 1px minmax(0, 1fr);
                        }

                        .programacion-action-btn {
                            grid-column: 1 / -1;
                            width: 100%;
                        }

                        .programacion-control-card {
                            grid-template-columns: 1fr;
                        }

                        .programacion-control-divider {
                            display: none;
                        }

                        .programacion-month-controls {
                            justify-content: center;
                        }

                        .programacion-filter-grid {
                            grid-template-columns: repeat(2, minmax(220px, 1fr));
                        }
                    }

                    @media (max-width: 767.98px) {
                        .programacion-hero-card {
                            grid-template-columns: 1fr;
                            padding: 1.4rem;
                        }

                        .programacion-hero-icon {
                            width: 70px;
                            height: 70px;
                            font-size: 2.25rem;
                        }

                        .programacion-hero-divider {
                            display: none;
                        }

                        .programacion-view-row {
                            justify-content: stretch;
                        }

                        .programacion-view-toggle {
                            width: 100%;
                            flex-wrap: wrap;
                        }

                        .programacion-view-btn {
                            flex: 1 1 150px;
                            justify-content: center;
                        }

                        .programacion-month-controls,
                        .programacion-filter-grid {
                            width: 100%;
                        }

                        .programacion-month-controls {
                            display: grid;
                            grid-template-columns: 42px 1fr 42px;
                        }

                        .programacion-month-box {
                            min-width: 0;
                        }

                        .programacion-filter-grid {
                            grid-template-columns: 1fr;
                        }
                    }
                </style>

                <!-- Cabecera de Horarios y Programación -->
                <div class="programacion-hero-card mb-4">
                    <div class="programacion-hero-icon" aria-hidden="true">
                        <i class="fa-regular fa-clock"></i>
                    </div>
                    <div class="programacion-hero-divider" aria-hidden="true"></div>
                    <div class="programacion-hero-copy">
                        <h5 class="programacion-hero-title">Horarios y Programación</h5>
                        <p class="programacion-hero-subtitle mb-0">Distribución del calendario lectivo y asignaciones de docentes.</p>
                    </div>
                    <?php if ($current_role === 'Coordinador'): ?>
                        <button type="button" class="btn programacion-action-btn d-inline-flex align-items-center gap-3" data-bs-toggle="modal" data-bs-target="#modalAsignarHorario">
                            <span class="programacion-action-icon"><i class="fa-solid fa-plus"></i></span>
                            <span>Asignar Horario</span>
                        </button>
                    <?php endif; ?>
                </div>

                <!-- Selector de Vista -->
                <div class="programacion-view-row">
                    <div class="programacion-view-toggle">
                        <span class="programacion-view-label">Vista:</span>
                        <button type="button" class="btn programacion-view-btn active" id="btnVistaCalendario" onclick="cambiarVista('calendario')">
                            <i class="fa-solid fa-calendar-days"></i> Calendario Mensual
                        </button>
                        <button type="button" class="btn programacion-view-btn text-secondary" id="btnVistaLista" onclick="cambiarVista('lista')">
                            <i class="fa-solid fa-list"></i> Lista Completa
                        </button>
                    </div>
                </div>

                <!-- Barra de Navegación del Mes y Filtros Unificados SGA -->
                <div class="programacion-control-card mb-4" id="seccionNavegacionMes">
                    <div class="programacion-month-controls">
                        <button type="button" class="btn programacion-nav-btn" onclick="navegarMes(-1)" title="Mes anterior">
                            <i class="fa-solid fa-chevron-left"></i>
                        </button>
                        <div class="programacion-month-box">
                            <i class="fa-regular fa-calendar-days"></i>
                            <span id="nombreMesAnio">Julio 2026</span>
                        </div>
                        <button type="button" class="btn programacion-nav-btn" onclick="navegarMes(1)" title="Mes siguiente">
                            <i class="fa-solid fa-chevron-right"></i>
                        </button>
                    </div>

                    <div class="programacion-control-divider" aria-hidden="true"></div>

                    <div class="programacion-filter-grid">
                        <label class="programacion-filter-field is-primary" for="filtroDiaSemana">
                            <i class="fa-regular fa-calendar-days"></i>
                            <select id="filtroDiaSemana" class="programacion-filter-select">
                                <option value="">Todos los días</option>
                                <option value="Lunes">Lunes</option>
                                <option value="Martes">Martes</option>
                                <option value="Miércoles">Miércoles</option>
                                <option value="Jueves">Jueves</option>
                                <option value="Viernes">Viernes</option>
                                <option value="Sábado">Sábado</option>
                                <option value="Domingo">Domingo</option>
                            </select>
                            <i class="fa-solid fa-chevron-down programacion-filter-chevron"></i>
                        </label>

                        <label class="programacion-filter-field" for="filtroInstructor">
                            <i class="fa-solid fa-users"></i>
                            <select id="filtroInstructor" class="programacion-filter-select">
                                <option value="">Instructores (Todos)</option>
                            </select>
                            <i class="fa-solid fa-chevron-down programacion-filter-chevron"></i>
                        </label>

                        <label class="programacion-filter-field" for="filtroAmbiente">
                            <i class="fa-regular fa-building"></i>
                            <select id="filtroAmbiente" class="programacion-filter-select">
                                <option value="">Ambientes (Todos)</option>
                            </select>
                            <i class="fa-solid fa-chevron-down programacion-filter-chevron"></i>
                        </label>

                        <label class="programacion-filter-field" for="filtroFicha">
                            <i class="fa-regular fa-address-card"></i>
                            <select id="filtroFicha" class="programacion-filter-select">
                                <option value="">Fichas (Todas)</option>
                            </select>
                            <i class="fa-solid fa-chevron-down programacion-filter-chevron"></i>
                        </label>
                    </div>
                </div>

                <!-- Contenedor del Calendario -->
                <div class="card bg-white border-0 shadow-sm rounded-4 p-4 mb-4" id="cardCalendario" style="border: 1px solid rgba(0,0,0,0.06);">
                    <div class="calendar-days-grid mb-2">
                        <div class="calendar-day-name" style="border-left: 4px solid #39A900; color: #1e3a8a;">Lunes</div>
                        <div class="calendar-day-name" style="border-left: 4px solid #7c3aed; color: #581c87;">Martes</div>
                        <div class="calendar-day-name" style="border-left: 4px solid #2563eb; color: #1e3a8a;">Miércoles</div>
                        <div class="calendar-day-name" style="border-left: 4px solid #d97706; color: #78350f;">Jueves</div>
                        <div class="calendar-day-name" style="border-left: 4px solid #ec4899; color: #701a75;">Viernes</div>
                        <div class="calendar-day-name" style="border-left: 4px solid #6b7280; color: #374151;">Sábado</div>
                        <div class="calendar-day-name" style="border-left: 4px solid #f97316; color: #7c2d12;">Domingo</div>
                    </div>
                    <div class="calendar-days-grid" id="gridDiasCalendario">
                        <!-- Generado dinámicamente con JS -->
                    </div>
                </div>

                <!-- Contenedor de la Lista Completa -->
                <div class="card bg-white border-0 shadow-sm rounded-4 p-0 overflow-hidden d-none" id="cardListaCompleta" style="border: 1px solid rgba(0,0,0,0.06);">
                    <div class="card-body p-0">
                        <?php if (empty($programacion)): ?>
                            <div class="text-center py-5 text-muted">
                                <i class="fa-solid fa-calendar-xmark fa-3x mb-3 text-secondary"></i>
                                <h5 class="fw-bold">No hay sesiones de formación programadas</h5>
                            </div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light text-secondary small text-uppercase py-3" style="font-size: 0.78rem; font-weight: 700; letter-spacing: 0.5px;">
                                        <tr>
                                            <th class="ps-4 py-3">FICHA</th>
                                            <th class="py-3">DÍA / HORAS</th>
                                            <th class="py-3">INSTRUCTOR</th>
                                            <th class="py-3">AMBIENTE</th>
                                            <th class="py-3">RAP EVALUADO</th>
                                            <th class="text-end pe-4 py-3">AVANCE SESIONES</th>
                                            <?php if ($current_role === 'Coordinador'): ?>
                                                <th class="text-end pe-4 py-3">ACCIÓN</th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($programacion as $prog): ?>
                                            <?php 
                                                $pct = $prog->total_sesiones > 0 ? round(($prog->sesiones_realizadas / $prog->total_sesiones) * 100) : 75; 
                                            ?>
                                            <tr>
                                                <td class="ps-4"><span class="badge-ficha-table">#<?= $prog->numero_ficha; ?></span></td>
                                                <td>
                                                    <div class="fw-bold text-dark small"><i class="fa-regular fa-clock text-secondary me-1"></i> <?= $prog->nombre_dia; ?></div>
                                                    <div class="text-muted small"><?= substr($prog->hora_inicio, 0, 5) . ' - ' . substr($prog->hora_fin, 0, 5); ?></div>
                                                </td>
                                                <td class="text-dark small fw-medium"><?= $prog->instructor_nombre . ' ' . $prog->instructor_apellido; ?></td>
                                                <td><span class="badge-ambiente-table"><?= $prog->ambiente_nombre; ?></span></td>
                                                <td class="text-muted small" style="max-width: 320px;"><?= $prog->ra_descripcion; ?></td>
                                                <td class="text-end pe-4">
                                                    <div class="fw-bold text-dark small mb-1"><?= $prog->sesiones_realizadas; ?> / <?= $prog->total_sesiones; ?></div>
                                                    <div class="progress-sena"><div class="progress-sena-bar" style="width: <?= $pct; ?>%;"></div></div>
                                                </td>
                                                <?php if ($current_role === 'Coordinador'): ?>
                                                    <td class="text-end pe-4">
                                                        <a href="<?= URLROOT; ?>/index.php?route=programacion/delete&id=<?= $prog->id_programacion; ?>" class="btn btn-outline-danger btn-sm shadow-sm" onclick="return confirm('¿Seguro que deseas eliminar esta programación?');" data-bs-toggle="tooltip" title="Eliminar Programación">
                                                            <i class="fa-solid fa-trash-can"></i>
                                                        </a>
                                                    </td>
                                                <?php endif; ?>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

            </div>

            <!-- PESTAÑA 3: AMBIENTES FÍSICOS -->
            <div class="tab-pane fade" id="pills-ambientes" role="tabpanel" aria-labelledby="pills-ambientes-tab">
                
                <style>
                    /* Inserción de estilos CSS específicos para ambientes */
                    .env-kpi-card {
                        background: #ffffff;
                        border: 1px solid rgba(0, 0, 0, 0.05);
                        border-radius: 16px;
                        padding: 1.25rem;
                        display: flex;
                        align-items: center;
                        gap: 1rem;
                        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.01), 0 2px 4px -2px rgba(0,0,0,0.01);
                        transition: all 0.2s ease;
                    }
                    .env-kpi-card:hover {
                        transform: translateY(-2px);
                        box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05);
                    }
                    .env-kpi-icon-wrapper {
                        width: 48px;
                        height: 48px;
                        border-radius: 12px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        font-size: 1.25rem;
                        flex-shrink: 0;
                    }
                    .env-kpi-icon-green { background-color: #e8f5e9; color: #39A900; }
                    .env-kpi-icon-blue { background-color: #e0f2fe; color: #0288d1; }
                    .env-kpi-icon-purple { background-color: #f3e8ff; color: #7c3aed; }
                    .env-kpi-icon-orange { background-color: #fff7ed; color: #ea580c; }

                    .env-kpi-value {
                        font-size: 1.6rem;
                        font-weight: 700;
                        color: #0f172a;
                        line-height: 1.2;
                    }
                    .env-kpi-title {
                        font-size: 0.85rem;
                        font-weight: 500;
                        color: #64748b;
                    }
                    .env-kpi-desc {
                        font-size: 0.75rem;
                        color: #64748b;
                        margin-top: 0.15rem;
                    }
                    .env-kpi-desc-trend {
                        color: #15803d;
                        font-weight: 600;
                    }

                    .env-search-box {
                        position: relative;
                    }
                    .env-search-box input {
                        padding-left: 2.5rem;
                        border-radius: 10px;
                        border: 1px solid rgba(0, 0, 0, 0.08);
                    }
                    .env-search-box i {
                        position: absolute;
                        left: 0.95rem;
                        top: 50%;
                        transform: translateY(-50%);
                        color: #94a3b8;
                    }
                    .env-filter-select {
                        border-radius: 10px;
                        border: 1px solid rgba(0, 0, 0, 0.08);
                        font-weight: 500;
                        color: #334155;
                        background-color: #ffffff;
                    }
                    .env-filter-btn {
                        border-radius: 10px;
                        border: 1px solid rgba(0, 0, 0, 0.08);
                        font-weight: 500;
                        color: #475569;
                        background-color: #ffffff;
                        display: inline-flex;
                        align-items: center;
                        gap: 0.5rem;
                    }
                    .env-filter-btn:hover {
                        background-color: #f8fafc;
                    }
                    .env-toggle-btn {
                        border: 1px solid rgba(0, 0, 0, 0.08);
                        background-color: #ffffff;
                        color: #64748b;
                        border-radius: 10px;
                        padding: 0.5rem 0.75rem;
                    }
                    .env-toggle-btn.active {
                        background-color: #e8f5e9;
                        color: #39A900;
                        border-color: #39A900;
                    }

                    .env-card {
                        border: 1px solid rgba(0,0,0,0.06) !important;
                        border-radius: 16px !important;
                        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02), 0 2px 4px -2px rgba(0,0,0,0.02) !important;
                        transition: all 0.25s ease !important;
                        background: #ffffff;
                    }
                    .env-card:hover {
                        transform: translateY(-3px) !important;
                        box-shadow: 0 12px 20px -3px rgba(0,0,0,0.06) !important;
                    }
                    .env-card-img-container {
                        height: 100%;
                        min-height: 180px;
                        background: #0f172a;
                        overflow: hidden;
                        position: relative;
                    }
                    .env-card-img {
                        width: 100%;
                        height: 100%;
                        object-fit: cover;
                        opacity: 0.85;
                        transition: transform 0.3s ease;
                    }
                    .env-card:hover .env-card-img {
                        transform: scale(1.03);
                    }
                    .env-badge-status {
                        position: absolute;
                        top: 0.75rem;
                        left: 0.75rem;
                        z-index: 10;
                        border-radius: 6px;
                        padding: 0.25rem 0.6rem;
                        font-size: 0.72rem;
                        font-weight: 700;
                        letter-spacing: 0.5px;
                        text-transform: uppercase;
                    }
                    .env-badge-status-active {
                        background-color: #39A900;
                        color: #ffffff;
                    }
                    .env-badge-status-inactive {
                        background-color: #64748b;
                        color: #ffffff;
                    }
                    .env-badge-id {
                        position: absolute;
                        top: 0.75rem;
                        right: 2.5rem;
                        z-index: 10;
                        background-color: rgba(15, 23, 42, 0.85);
                        color: #ffffff;
                        border-radius: 6px;
                        padding: 0.25rem 0.6rem;
                        font-size: 0.72rem;
                        font-weight: 600;
                    }
                    .env-card-options {
                        position: absolute;
                        top: 0.75rem;
                        right: 0.75rem;
                        z-index: 10;
                    }
                    .env-card-options .dropdown-toggle::after {
                        display: none;
                    }
                    .env-card-options .btn-link {
                        color: #ffffff;
                        text-shadow: 0 1px 3px rgba(0,0,0,0.5);
                        padding: 0;
                        line-height: 1;
                    }

                    .env-equip-badge {
                        font-size: 0.72rem;
                        font-weight: 600;
                        padding: 0.3rem 0.6rem;
                        border-radius: 8px;
                        border: 1px solid transparent;
                    }
                    .env-equip-aire { background-color: #e0f2fe; color: #0369a1; border-color: #bae6fd; }
                    .env-equip-ventilador { background-color: #dcfce7; color: #15803d; border-color: #bbf7d0; }
                    .env-equip-tablero { background-color: #fce7f3; color: #a21caf; border-color: #fbcfe8; }
                    .env-equip-tv { background-color: #e0e7ff; color: #4338ca; border-color: #c7d2fe; }
                    .env-equip-proyector { background-color: #ffedd5; color: #c2410c; border-color: #fed7aa; }
                    .env-equip-extractor { background-color: #fef9c3; color: #854d0e; border-color: #fef08a; }
                    .env-equip-osciloscopio { background-color: #ecfeff; color: #0e7490; border-color: #cffafe; }

                    .env-dot {
                        width: 8px;
                        height: 8px;
                        border-radius: 50%;
                        display: inline-block;
                    }
                    .env-dot-active { background-color: #39A900; }
                    .env-dot-inactive { background-color: #94a3b8; }

                    .env-spec-label {
                        font-size: 0.82rem;
                        color: #64748b;
                    }
                    .env-spec-value {
                        font-size: 0.85rem;
                        font-weight: 600;
                        color: #0f172a;
                    }
                    .env-maintenance-text {
                        font-size: 0.72rem;
                        color: #64748b;
                    }
                    .env-action-btn-edit {
                        color: #0d6efd;
                        border-color: rgba(13, 110, 253, 0.2) !important;
                        background: transparent;
                        font-size: 0.78rem;
                        font-weight: 600;
                        padding: 0.35rem 0.75rem;
                        border-radius: 8px;
                    }
                    .env-action-btn-edit:hover {
                        background-color: #0d6efd;
                        color: #ffffff;
                    }
                    .env-action-btn-delete {
                        color: #dc3545;
                        border-color: rgba(220, 53, 69, 0.2) !important;
                        background: transparent;
                        font-size: 0.78rem;
                        padding: 0.35rem 0.55rem;
                        border-radius: 8px;
                    }
                    .env-action-btn-delete:hover {
                        background-color: #dc3545;
                        color: #ffffff;
                    }

                    /* Estilos para el Detalle y Calendario de Disponibilidad del Ambiente */
                    .btn-volver-ambientes {
                        background: #ffffff;
                        border: 1px solid rgba(0, 0, 0, 0.08);
                        border-radius: 10px;
                        padding: 0.5rem 1rem;
                        font-weight: 500;
                        color: #475569;
                        transition: all 0.2s;
                    }
                    .btn-volver-ambientes:hover {
                        background: #f8fafc;
                        color: #0f172a;
                    }
                    .env-detail-sidebar {
                        background: #ffffff;
                        border: 1px solid rgba(0, 0, 0, 0.06);
                        border-radius: 20px;
                        padding: 1.5rem;
                        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.01), 0 2px 4px -2px rgba(0,0,0,0.01);
                    }
                    .env-detail-img-container {
                        border-radius: 16px;
                        overflow: hidden;
                        position: relative;
                        aspect-ratio: 16/10;
                        background: #0f172a;
                    }
                    .env-detail-img {
                        width: 100%;
                        height: 100%;
                        object-fit: cover;
                    }
                    .env-detail-badge-id {
                        display: inline-block;
                        background: #e2e8f0;
                        color: #334155;
                        font-weight: 700;
                        font-size: 0.72rem;
                        padding: 0.25rem 0.6rem;
                        border-radius: 6px;
                        margin-top: 1rem;
                    }
                    .env-detail-title {
                        font-size: 1.35rem;
                        font-weight: 700;
                        color: #0f172a;
                        margin-top: 0.5rem;
                        margin-bottom: 0.25rem;
                    }
                    .env-detail-badge-type {
                        display: inline-block;
                        background: #e8f5e9;
                        color: #39A900;
                        font-size: 0.75rem;
                        font-weight: 600;
                        padding: 0.25rem 0.6rem;
                        border-radius: 6px;
                        margin-bottom: 1.25rem;
                    }
                    .env-detail-spec-item {
                        display: flex;
                        align-items: center;
                        gap: 0.75rem;
                        padding: 0.6rem 0;
                        border-bottom: 1px solid rgba(0, 0, 0, 0.04);
                    }
                    .env-detail-spec-item:last-child {
                        border-bottom: none;
                    }
                    .env-detail-spec-icon {
                        color: #64748b;
                        font-size: 1rem;
                        width: 20px;
                        text-align: center;
                    }
                    .env-detail-spec-label {
                        font-size: 0.8rem;
                        color: #64748b;
                    }
                    .env-detail-spec-val {
                        font-size: 0.85rem;
                        font-weight: 600;
                        color: #0f172a;
                        margin-left: auto;
                    }
                    .env-detail-equip-section {
                        margin-top: 1.5rem;
                        border-top: 1px solid rgba(0, 0, 0, 0.06);
                        padding-top: 1rem;
                    }
                    .env-detail-btn {
                        border-radius: 12px;
                        padding: 0.65rem 1rem;
                        font-weight: 600;
                        font-size: 0.85rem;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        gap: 0.5rem;
                        width: 100%;
                        transition: all 0.2s;
                        border: 1px solid transparent;
                    }
                    .env-detail-btn-primary {
                        background: #39A900;
                        color: #ffffff;
                        border-color: #39A900;
                    }
                    .env-detail-btn-primary:hover {
                        background: #308e00;
                        border-color: #308e00;
                    }
                    .env-detail-btn-danger {
                        background: transparent;
                        color: #dc3545;
                        border-color: #dc3545;
                    }
                    .env-detail-btn-danger:hover {
                        background: #dc3545;
                        color: #ffffff;
                    }
                    .env-detail-btn-secondary {
                        background: transparent;
                        color: #64748b;
                        border-color: #cbd5e1;
                    }
                    .env-detail-btn-secondary:hover {
                        background: #f8fafc;
                        color: #0f172a;
                    }

                    /* Stat cards */
                    .env-stat-card {
                        background: #ffffff;
                        border: 1px solid rgba(0, 0, 0, 0.05);
                        border-radius: 16px;
                        padding: 1rem;
                        display: flex;
                        align-items: center;
                        gap: 0.75rem;
                        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.01), 0 2px 4px -2px rgba(0,0,0,0.01);
                        flex: 1;
                        min-width: 180px;
                    }
                    .env-stat-icon-wrapper {
                        width: 40px;
                        height: 40px;
                        border-radius: 50%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        font-size: 1.1rem;
                        flex-shrink: 0;
                    }
                    .env-stat-icon-green { background-color: #e8f5e9; color: #39A900; }
                    .env-stat-icon-orange { background-color: #fff7ed; color: #ea580c; }
                    .env-stat-icon-blue { background-color: #e0f2fe; color: #0288d1; }
                    .env-stat-icon-purple { background-color: #f3e8ff; color: #7c3aed; }
                    .env-stat-value {
                        font-size: 1.35rem;
                        font-weight: 700;
                        color: #0f172a;
                        line-height: 1.1;
                    }
                    .env-stat-title {
                        font-size: 0.78rem;
                        font-weight: 500;
                        color: #64748b;
                    }
                    .env-stat-desc {
                        font-size: 0.7rem;
                        color: #94a3b8;
                    }

                    /* Calendar styling */
                    .env-cal-header-controls {
                        display: flex;
                        align-items: center;
                        gap: 0.5rem;
                    }
                    .env-cal-btn {
                        border: 1px solid rgba(0, 0, 0, 0.08);
                        background: #ffffff;
                        color: #475569;
                        padding: 0.4rem 0.75rem;
                        border-radius: 8px;
                        font-size: 0.82rem;
                        font-weight: 500;
                        transition: all 0.2s;
                    }
                    .env-cal-btn:hover {
                        background: #f8fafc;
                        color: #0f172a;
                    }
                    .env-calendar-container {
                        background: #ffffff;
                        border: 1px solid rgba(0, 0, 0, 0.06);
                        border-radius: 20px;
                        padding: 1.5rem;
                        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.01), 0 2px 4px -2px rgba(0,0,0,0.01);
                    }
                    .env-calendar-days-grid {
                        display: grid;
                        grid-template-columns: repeat(7, 1fr);
                        gap: 8px;
                    }
                    .env-calendar-day-name {
                        text-align: center;
                        font-size: 0.8rem;
                        font-weight: 700;
                        color: #475569;
                        padding: 0.5rem 0;
                        text-transform: capitalize;
                    }
                    .env-calendar-cell {
                        border: 1px solid rgba(0, 0, 0, 0.05);
                        background: #ffffff;
                        border-radius: 12px;
                        height: 115px;
                        padding: 0.5rem;
                        display: flex;
                        flex-direction: column;
                        justify-content: space-between;
                        transition: all 0.2s;
                        position: relative;
                    }
                    .env-calendar-cell:hover {
                        border-color: rgba(0,0,0,0.12);
                        box-shadow: 0 4px 12px -2px rgba(0,0,0,0.03);
                    }
                    .env-calendar-cell.other-month {
                        background: #f8fafc;
                    }
                    .env-calendar-cell.other-month .env-calendar-day-num {
                        color: #94a3b8;
                    }
                    .env-calendar-day-num {
                        font-size: 0.9rem;
                        font-weight: 700;
                        color: #334155;
                    }
                    .env-calendar-cell.sunday .env-calendar-day-num {
                        color: #ef4444;
                    }
                    .env-calendar-cell.today {
                        border: 2px solid #39A900 !important;
                        background-color: rgba(57, 169, 0, 0.01);
                    }
                    .env-cell-dot {
                        width: 6px;
                        height: 6px;
                        border-radius: 50%;
                        position: absolute;
                        top: 8px;
                        right: 8px;
                    }
                    .env-cell-dot-free { background-color: #39A900; }
                    .env-cell-dot-reserved { background-color: #0288d1; }
                    .env-cell-dot-class { background-color: #ea580c; }
                    .env-cell-dot-maint { background-color: #7c3aed; }
                    .env-cell-dot-inactive { background-color: #ef4444; }

                    .env-calendar-session-list {
                        display: flex;
                        flex-direction: column;
                        gap: 4px;
                        margin-top: 0.5rem;
                        flex-grow: 1;
                        justify-content: flex-start;
                        overflow-y: auto;
                        max-height: 70px;
                    }
                    .env-calendar-session-list::-webkit-scrollbar {
                        width: 3px;
                    }
                    .env-calendar-session-list::-webkit-scrollbar-track {
                        background: transparent;
                    }
                    .env-calendar-session-list::-webkit-scrollbar-thumb {
                        background: #cbd5e1;
                        border-radius: 3px;
                    }
                    .env-cal-session-card {
                        border-radius: 8px;
                        padding: 0.4rem;
                        font-size: 0.65rem;
                        font-weight: 600;
                        line-height: 1.2;
                        transition: all 0.2s;
                        cursor: pointer;
                        border: 1px solid transparent;
                    }
                    .env-cal-session-card-blue {
                        background-color: #e0f2fe;
                        border-left: 3px solid #0288d1;
                        border-color: #bae6fd;
                        color: #0369a1;
                    }
                    .env-cal-session-card-blue:hover {
                        background-color: #bae6fd;
                    }
                    .env-cal-session-card-orange {
                        background-color: #fff7ed;
                        border-left: 3px solid #ea580c;
                        border-color: #fed7aa;
                        color: #c2410c;
                    }
                    .env-cal-session-card-orange:hover {
                        background-color: #fed7aa;
                    }
                    .env-cal-session-card-purple {
                        background-color: #f3e8ff;
                        border-left: 3px solid #7c3aed;
                        border-color: #e9d5ff;
                        color: #6b21a8;
                    }
                    .env-cal-session-card-purple:hover {
                        background-color: #e9d5ff;
                    }
                    .env-cal-session-card-red {
                        background-color: #fef2f2;
                        border-left: 3px solid #ef4444;
                        border-color: #fee2e2;
                        color: #991b1b;
                    }
                    .env-cal-session-card-red:hover {
                        background-color: #fee2e2;
                    }

                    /* Legend dot */
                    .env-legend-dot {
                        width: 8px;
                        height: 8px;
                        border-radius: 50%;
                        display: inline-block;
                    }
                </style>

                <?php
                $total_ambientes = count($ambientes);
                $total_pcs = 0;
                $total_capacidad = 0;
                $total_activos = 0;
                foreach ($ambientes as $amb) {
                    $total_pcs += $amb->computadores;
                    $total_capacidad += $amb->capacidad;
                    if ($amb->disponibilidad == 1) {
                        $total_activos++;
                    }
                }
                $porcentaje_activos = $total_ambientes > 0 ? round(($total_activos / $total_ambientes) * 100) : 0;
                ?>

                <div id="env-catalog-view">
                <!-- Cabecera -->
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center mb-4 gap-3">
                    <div class="d-flex align-items-center gap-3">
                        <div style="width: 48px; height: 48px; background-color: #e8f5e9; color: #39A900; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                            <i class="fa-solid fa-building"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold text-dark mb-0">Ambientes de Aprendizaje SENA</h4>
                            <p class="text-muted small mb-0">Administra la capacidad instalada y el equipamiento de las salas de formación.</p>
                        </div>
                    </div>
                    <?php if ($current_role === 'Coordinador'): ?>
                        <button type="button" class="btn btn-success fw-semibold px-4 py-2 shadow-sm d-flex align-items-center gap-2" style="background-color: #39A900; border-color: #39A900; border-radius: 25px;" data-bs-toggle="modal" data-bs-target="#modalCrearAmbiente">
                            <i class="fa-solid fa-circle-plus fs-5"></i> Crear Nuevo Ambiente
                        </button>
                    <?php endif; ?>
                </div>

                <!-- KPIs -->
                <div class="row g-3 mb-4">
                    <div class="col-6 col-md-3">
                        <div class="env-kpi-card">
                            <div class="env-kpi-icon-wrapper env-kpi-icon-green">
                                <i class="fa-solid fa-cube"></i>
                            </div>
                            <div>
                                <div class="env-kpi-value" id="kpi-total-ambientes"><?= $total_ambientes ?></div>
                                <div class="env-kpi-title">Ambientes totales</div>
                                <div class="env-kpi-desc"><span class="env-kpi-desc-trend">↗ 2 más</span> que el mes anterior</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="env-kpi-card">
                            <div class="env-kpi-icon-wrapper env-kpi-icon-blue">
                                <i class="fa-solid fa-desktop"></i>
                            </div>
                            <div>
                                <div class="env-kpi-value" id="kpi-total-pcs"><?= $total_pcs ?></div>
                                <div class="env-kpi-title">PCs disponibles</div>
                                <div class="env-kpi-desc"><span class="text-primary font-weight-bold">85%</span> del total instalado</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="env-kpi-card">
                            <div class="env-kpi-icon-wrapper env-kpi-icon-purple">
                                <i class="fa-solid fa-users"></i>
                            </div>
                            <div>
                                <div class="env-kpi-value" id="kpi-total-capacidad"><?= $total_capacidad ?></div>
                                <div class="env-kpi-title">Capacidad total</div>
                                <div class="env-kpi-desc">Disponible para formación</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="env-kpi-card">
                            <div class="env-kpi-icon-wrapper env-kpi-icon-orange">
                                <i class="fa-solid fa-screwdriver-wrench"></i>
                            </div>
                            <div>
                                <div class="env-kpi-value" id="kpi-total-activos"><?= $porcentaje_activos ?>%</div>
                                <div class="env-kpi-title">Ambientes activos</div>
                                <div class="env-kpi-desc text-success fw-semibold">Excelente disponibilidad</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filtros -->
                <div class="row g-3 align-items-center mb-4">
                    <div class="col-12 col-md-4 col-lg-3">
                        <div class="env-search-box">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <input type="text" id="env-search-input" class="form-control" placeholder="Buscar ambiente, código o equipo...">
                        </div>
                    </div>
                    <div class="col-6 col-sm-4 col-md-2">
                        <select id="env-filter-estado" class="form-select env-filter-select">
                            <option value="all">Estado: Todos</option>
                            <option value="1">Estado: Activos</option>
                            <option value="0">Estado: Inactivos</option>
                        </select>
                    </div>
                    <div class="col-6 col-sm-4 col-md-2">
                        <select id="env-filter-tipo" class="form-select env-filter-select">
                            <option value="all">Tipo: Todos</option>
                            <option value="convencional">Tipo: Convencionales</option>
                            <option value="especializado">Tipo: Especializados</option>
                        </select>
                    </div>
                    <div class="col-6 col-sm-4 col-md-2">
                        <select id="env-filter-sede" class="form-select env-filter-select">
                            <option value="all">Sede: Todas</option>
                            <option value="sede-central">Sede Principal</option>
                        </select>
                    </div>
                    <div class="col-6 col-sm-auto">
                        <button type="button" class="btn env-filter-btn">
                            <i class="fa-solid fa-filter"></i> Filtros
                        </button>
                    </div>
                    <div class="col-12 col-sm-auto ms-sm-auto d-flex gap-2 justify-content-end">
                        <div class="btn-group" role="group">
                            <button type="button" id="env-toggle-grid" class="btn env-toggle-btn active"><i class="fa-solid fa-grip"></i></button>
                            <button type="button" id="env-toggle-list" class="btn env-toggle-btn"><i class="fa-solid fa-list"></i></button>
                        </div>
                    </div>
                </div>

                <!-- Grid de Tarjetas -->
                <div class="row g-4" id="env-cards-container">
                    <?php if (empty($ambientes)): ?>
                        <div class="col-12 text-center py-5 text-muted bg-white rounded-4 border">
                            <i class="fa-solid fa-building-circle-xmark fa-3x mb-3 text-secondary"></i>
                            <h5 class="fw-bold">No hay ambientes físicos registrados</h5>
                        </div>
                    <?php else: ?>
                        <?php foreach ($ambientes as $amb): ?>
                            <?php 
                            $fotos_key = isset($fotos_ambientes) ? $fotos_ambientes : ($fotos ?? []);
                            $ambFotos = $fotos_key[$amb->id_numero_ambiente] ?? []; 
                            ?>
                            <div class="col-12 col-lg-6 mb-2 env-card-wrapper" 
                                 data-id="<?= $amb->id_numero_ambiente ?>"
                                 data-nombre="<?= htmlspecialchars(strtolower($amb->nombre)) ?>"
                                 data-tipo="<?= htmlspecialchars(strtolower($amb->tipo)) ?>"
                                 data-especialidad="<?= htmlspecialchars(strtolower($amb->especialidad_ambiente)) ?>"
                                 data-disponibilidad="<?= $amb->disponibilidad ?>"
                                 data-computadores="<?= $amb->computadores ?>"
                                 data-capacidad="<?= $amb->capacidad ?>"
                                 data-equipos="aire:<?= $amb->aire ? 1 : 0 ?>;ventilador:<?= $amb->ventilador ? 1 : 0 ?>;tablero:<?= $amb->tablero ? 1 : 0 ?>;tv:<?= $amb->tv ? 1 : 0 ?>">
                                <div class="card env-card overflow-hidden h-100">
                                    <div class="row g-0 h-100">
                                        <!-- Foto e Indicadores -->
                                        <div class="col-12 col-sm-5 position-relative env-card-img-container" style="cursor: pointer;" onclick="verGaleria('<?= htmlspecialchars(addslashes($amb->nombre)); ?>', '<?= htmlspecialchars(json_encode($ambFotos), ENT_QUOTES, 'UTF-8'); ?>')">
                                            <?php if (!empty($ambFotos)): ?>
                                                <img src="<?= $ambFotos[0]->url; ?>" class="env-card-img" alt="<?= htmlspecialchars($amb->nombre); ?>" onerror="this.src='https://images.unsplash.com/photo-1580582932707-520aed937b7b?q=80&w=600&auto=format&fit=crop';">
                                            <?php else: ?>
                                                <img src="https://images.unsplash.com/photo-1580582932707-520aed937b7b?q=80&w=600&auto=format&fit=crop" class="env-card-img" alt="Aula General">
                                            <?php endif; ?>
                                            
                                            <!-- Estado -->
                                            <span class="env-badge-status <?= $amb->disponibilidad == 1 ? 'env-badge-status-active' : 'env-badge-status-inactive' ?>">
                                                <?= $amb->disponibilidad == 1 ? '✔ ACTIVO' : '✖ INACTIVO' ?>
                                            </span>
                                            
                                            <!-- ID y Opciones -->
                                            <span class="env-badge-id">Amb. <?= $amb->id_numero_ambiente; ?></span>
                                            <div class="env-card-options" onclick="event.stopPropagation();">
                                                <div class="dropdown">
                                                    <button class="btn btn-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa-solid fa-ellipsis-vertical fs-5"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow rounded-3">
                                                        <li>
                                                            <a class="dropdown-item small d-flex align-items-center gap-2" href="<?= URLROOT; ?>/index.php?route=dashboard/index&novedades_ambiente=<?= $amb->id_numero_ambiente; ?>#pills-novedades">
                                                                <i class="fa-solid fa-triangle-exclamation text-warning"></i> Novedades
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item small d-flex align-items-center gap-2" href="<?= URLROOT; ?>/index.php?route=ambientes/toggleDisponibilidad&id=<?= $amb->id_numero_ambiente; ?>">
                                                                <i class="fa-solid fa-power-off text-muted"></i> Cambiar disponibilidad
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Detalles -->
                                        <div class="col-12 col-sm-7 p-3 d-flex flex-column justify-content-between" style="cursor: pointer;" onclick="verDisponibilidad(<?= $amb->id_numero_ambiente; ?>, '<?= htmlspecialchars(addslashes($amb->nombre)); ?>', '<?= htmlspecialchars(addslashes($amb->tipo)); ?>', <?= $amb->capacidad; ?>, <?= $amb->computadores; ?>, '<?= htmlspecialchars(addslashes($amb->especialidad_ambiente)); ?>', <?= $amb->aire; ?>, <?= $amb->ventilador; ?>, <?= $amb->tablero; ?>, <?= $amb->tv; ?>, <?= $amb->disponibilidad; ?>, '<?= $amb->fecha_creacion ?>', '<?= !empty($ambFotos) ? $ambFotos[0]->url : 'https://images.unsplash.com/photo-1580582932707-520aed937b7b?q=80&w=600&auto=format&fit=crop' ?>')">
                                            <div>
                                                <h5 class="fw-bold text-dark mb-1 card-title-text"><?= htmlspecialchars($amb->nombre); ?></h5>
                                                <div class="small text-secondary mb-2 d-flex align-items-center gap-2">
                                                    <span><?= htmlspecialchars($amb->tipo); ?></span>
                                                    <span class="env-dot <?= $amb->disponibilidad == 1 ? 'env-dot-active' : 'env-dot-inactive' ?>"></span>
                                                    <?php if (!empty($amb->especialidad_ambiente)): ?>
                                                        <span><?= htmlspecialchars($amb->especialidad_ambiente); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                                
                                                <hr class="my-2 opacity-10">
                                                
                                                <div class="d-flex justify-content-between align-items-center py-1">
                                                    <span class="env-spec-label">PCs</span>
                                                    <span class="env-spec-value"><?= $amb->computadores; ?></span>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center py-1">
                                                    <span class="env-spec-label">Capacidad</span>
                                                    <span class="env-spec-value"><?= $amb->capacidad; ?> personas</span>
                                                </div>
                                                
                                                <!-- Equipamiento -->
                                                <div class="d-flex flex-wrap gap-1.5 mt-3">
                                                    <?php if ($amb->aire): ?>
                                                        <span class="env-equip-badge env-equip-aire">Aire</span>
                                                    <?php endif; ?>
                                                    <?php if ($amb->ventilador): ?>
                                                        <span class="env-equip-badge env-equip-ventilador">Ventilador</span>
                                                    <?php endif; ?>
                                                    <?php if ($amb->tablero): ?>
                                                        <span class="env-equip-badge env-equip-tablero">Tablero</span>
                                                    <?php endif; ?>
                                                    <?php if ($amb->tv): ?>
                                                        <span class="env-equip-badge env-equip-tv">TV</span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-center justify-content-between border-top pt-2.5 mt-3 border-light-subtle">
                                                <div class="env-maintenance-text">
                                                    <i class="fa-regular fa-calendar me-1"></i> Mantenimiento: <?= date('d/m/Y', strtotime($amb->fecha_creacion)) ?>
                                                </div>
                                                <?php if ($current_role === 'Coordinador'): ?>
                                                    <div class="d-flex gap-2">
                                                        <button class="btn env-action-btn-edit d-flex align-items-center gap-1" onclick="event.stopPropagation(); editarAmbiente(<?= $amb->id_numero_ambiente; ?>, '<?= htmlspecialchars(addslashes($amb->nombre)); ?>', '<?= htmlspecialchars(addslashes($amb->tipo)); ?>', <?= $amb->capacidad; ?>, <?= $amb->computadores; ?>, '<?= htmlspecialchars(addslashes($amb->especialidad_ambiente)); ?>', <?= $amb->aire; ?>, <?= $amb->ventilador; ?>, <?= $amb->tablero; ?>, <?= $amb->tv; ?>, <?= $amb->disponibilidad; ?>)">
                                                            <i class="fa-solid fa-pen"></i> Editar
                                                        </button>
                                                        <a href="<?= URLROOT; ?>/index.php?route=ambientes/delete&id=<?= $amb->id_numero_ambiente; ?>" class="btn env-action-btn-delete d-flex align-items-center justify-content-center" onclick="event.stopPropagation(); return confirm('¿Seguro que deseas borrar este ambiente?');">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <!-- Paginación / Footer Info -->
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4 pt-3 border-top border-light-subtle gap-3">
                    <div class="text-secondary small" id="env-pagination-info">
                        Mostrando 1 a <?= $total_ambientes ?> de <?= $total_ambientes ?> ambientes
                    </div>
                    <nav aria-label="Navegación de ambientes">
                        <ul class="pagination pagination-sm mb-0 align-items-center gap-1" id="env-pagination-controls">
                            <li class="page-item disabled"><span class="page-link rounded border-0 bg-transparent text-secondary"><i class="fa-solid fa-chevron-left"></i></span></li>
                            <li class="page-item active"><span class="page-link rounded fw-bold text-white border-0" style="background-color: #39A900; min-width: 28px; text-align: center; cursor: pointer;">1</span></li>
                            <li class="page-item disabled"><span class="page-link rounded border-0 bg-transparent text-secondary"><i class="fa-solid fa-chevron-right"></i></span></li>
                        </ul>
                    </nav>
                </div>
                </div><!-- Fin de env-catalog-view -->

                <!-- VISTA DETALLE Y CALENDARIO DE AMBIENTE -->
                <div id="env-detail-view" class="d-none">
                    <!-- Botón Volver -->
                    <div class="mb-4">
                        <button type="button" class="btn-volver-ambientes" onclick="volverAlCatalogo()">
                            <i class="fa-solid fa-arrow-left me-2"></i> Volver a Ambientes
                        </button>
                    </div>

                    <div class="row g-4">
                        <!-- Columna Izquierda: Ficha del Ambiente -->
                        <div class="col-12 col-md-4 col-lg-3">
                            <div class="env-detail-sidebar">
                                <div class="env-detail-img-container">
                                    <img id="detail-env-image" src="" class="env-detail-img" alt="Ambiente">
                                    <span id="detail-env-status-badge" class="env-badge-status env-badge-status-active" style="top: 0.75rem; left: 0.75rem;">✔ ACTIVO</span>
                                </div>
                                
                                <span id="detail-env-code" class="env-detail-badge-id">Amb. 1</span>
                                <h3 id="detail-env-name" class="env-detail-title">Laboratorio de Software 1</h3>
                                <span id="detail-env-type-badge" class="env-detail-badge-type">Convencional</span>

                                <div class="env-detail-specs">
                                    <div class="env-detail-spec-item">
                                        <i class="fa-solid fa-users env-detail-spec-icon"></i>
                                        <span class="env-detail-spec-label">Capacidad</span>
                                        <span id="detail-env-capacity" class="env-detail-spec-val">35 personas</span>
                                    </div>
                                    <div class="env-detail-spec-item">
                                        <i class="fa-solid fa-desktop env-detail-spec-icon"></i>
                                        <span class="env-detail-spec-label">Equipos (PCs)</span>
                                        <span id="detail-env-pcs" class="env-detail-spec-val">35</span>
                                    </div>
                                    <div class="env-detail-spec-item">
                                        <i class="fa-solid fa-building env-detail-spec-icon"></i>
                                        <span class="env-detail-spec-label">Tipo de Ambiente</span>
                                        <span id="detail-env-type" class="env-detail-spec-val">Convencional</span>
                                    </div>
                                    <div class="env-detail-spec-item">
                                        <i class="fa-solid fa-screwdriver-wrench env-detail-spec-icon"></i>
                                        <span class="env-detail-spec-label">Último mantenimiento</span>
                                        <span id="detail-env-maintenance" class="env-detail-spec-val">02/07/2026</span>
                                    </div>
                                </div>

                                <!-- Equipamiento -->
                                <div class="env-detail-equip-section">
                                    <h6 class="fw-bold text-dark small mb-3">Equipamiento</h6>
                                    <div id="detail-env-equip-badges" class="d-flex flex-wrap gap-1">
                                        <!-- Generado dinámicamente -->
                                    </div>
                                </div>

                                <!-- Acciones -->
                                <div class="mt-4 pt-3 border-top border-light-subtle d-flex flex-column gap-2">
                                    <?php if ($current_role === 'Coordinador'): ?>
                                        <button type="button" id="detail-btn-edit" class="env-detail-btn env-detail-btn-primary">
                                            <i class="fa-solid fa-pen"></i> Editar Ambiente
                                        </button>
                                        <a href="#" id="detail-btn-toggle-disp" class="env-detail-btn env-detail-btn-danger text-decoration-none">
                                            <i class="fa-solid fa-power-off"></i> Desactivar Ambiente
                                        </a>
                                    <?php endif; ?>
                                    <a href="#" id="detail-btn-view-ficha" class="env-detail-btn env-detail-btn-secondary text-decoration-none">
                                        <i class="fa-regular fa-file-lines"></i> Ver Novedades
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Columna Derecha: Calendario y Disponibilidad -->
                        <div class="col-12 col-md-8 col-lg-9">
                            <div class="card bg-white border-0 shadow-sm rounded-4 p-4 mb-4" style="border: 1px solid rgba(0,0,0,0.06);">
                                <!-- Cabecera del Calendario -->
                                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3 mb-4">
                                    <div>
                                        <h4 class="fw-bold text-dark mb-1">Disponibilidad del Ambiente</h4>
                                        <p class="text-muted small mb-0">Calendario de ocupación y disponibilidad del ambiente.</p>
                                    </div>
                                    <div class="env-cal-header-controls">
                                        <button type="button" class="env-cal-btn" onclick="navegarMesAmbiente(0)">Hoy</button>
                                        <button type="button" class="env-cal-btn"><i class="fa-regular fa-calendar"></i></button>
                                        <select class="form-select form-select-sm border-secondary-subtle" style="width: auto; border-radius: 8px;">
                                            <option>Mes</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Tarjetas de Métricas del Mes -->
                                <div class="row g-3 mb-4">
                                    <div class="col-6 col-lg-3">
                                        <div class="env-stat-card">
                                            <div class="env-stat-icon-wrapper env-stat-icon-green">
                                                <i class="fa-regular fa-circle-check"></i>
                                            </div>
                                            <div>
                                                <div id="stat-dias-libres" class="env-stat-value">16</div>
                                                <div class="env-stat-title">Días libres</div>
                                                <div class="env-stat-desc">Este mes</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-lg-3">
                                        <div class="env-stat-card">
                                            <div class="env-stat-icon-wrapper env-stat-icon-orange">
                                                <i class="fa-solid fa-users"></i>
                                            </div>
                                            <div>
                                                <div id="stat-dias-ocupados" class="env-stat-value">10</div>
                                                <div class="env-stat-title">Días ocupados</div>
                                                <div class="env-stat-desc">Este mes</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-lg-3">
                                        <div class="env-stat-card">
                                            <div class="env-stat-icon-wrapper env-stat-icon-blue">
                                                <i class="fa-regular fa-calendar-days"></i>
                                            </div>
                                            <div>
                                                <div id="stat-proxima-reserva" class="env-stat-value" style="font-size: 0.95rem;">Mañana</div>
                                                <div class="env-stat-title">Próxima reserva</div>
                                                <div id="stat-proxima-reserva-time" class="env-stat-desc">7:00 AM - 11:00 AM</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-lg-3">
                                        <div class="env-stat-card">
                                            <div class="env-stat-icon-wrapper env-stat-icon-purple">
                                                <i class="fa-solid fa-chart-pie"></i>
                                            </div>
                                            <div>
                                                <div id="stat-uso-ambiente" class="env-stat-value">62%</div>
                                                <div class="env-stat-title">Uso del ambiente</div>
                                                <div class="env-stat-desc">Este mes</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Nombre del Mes actual -->
                                <div class="d-flex align-items-center gap-2 flex-nowrap mb-4">
                                    <button type="button" class="btn btn-nav-mes" onclick="navegarMesAmbiente(-1)">
                                        <i class="fa-solid fa-chevron-left"></i>
                                    </button>
                                    <span class="badge-mes-actual d-flex align-items-center justify-content-center" id="env-calendar-month-name" style="min-width: 150px; font-weight: 700; height: 38px;">Julio 2026</span>
                                    <button type="button" class="btn btn-nav-mes" onclick="navegarMesAmbiente(1)">
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </button>
                                </div>

                                <!-- Grid de Días -->
                                <div class="calendar-days-grid mb-2">
                                    <div class="calendar-day-name" style="border-left: 4px solid #39A900; color: #1e3a8a;">Lunes</div>
                                    <div class="calendar-day-name" style="border-left: 4px solid #7c3aed; color: #581c87;">Martes</div>
                                    <div class="calendar-day-name" style="border-left: 4px solid #2563eb; color: #1e3a8a;">Miércoles</div>
                                    <div class="calendar-day-name" style="border-left: 4px solid #d97706; color: #78350f;">Jueves</div>
                                            <div class="calendar-day-name" style="border-left: 4px solid #ec4899; color: #701a75;">Viernes</div>
                                    <div class="calendar-day-name" style="border-left: 4px solid #6b7280; color: #374151;">Sábado</div>
                                    <div class="calendar-day-name" style="border-left: 4px solid #f97316; color: #7c2d12;">Domingo</div>
                                </div>
                                <div class="calendar-days-grid" id="gridDiasCalendarioAmbiente">
                                    <!-- Generado dinámicamente con JS -->
                                </div>
                             </div>
                        </div>
                    </div>
                </div>

                <!-- Script del motor de filtros de ambientes -->
                <script>
                    // Variables globales para la vista de detalle de ambientes
                    var selectedAmbiente = null;
                    var calendarDateAmbiente = new Date(2026, 6, 1);
                    var programacionAmbienteData = [];
                    var excepcionesAmbienteData = [];

                    function verDisponibilidad(id, nombre, tipo, capacidad, computadores, especialidad, aire, ventilador, tablero, tv, disponibilidad, fecha_creacion, url_foto) {
                        selectedAmbiente = {
                            id: id,
                            nombre: nombre,
                            tipo: tipo,
                            capacidad: capacidad,
                            computadores: computadores,
                            especialidad: especialidad,
                            aire: aire,
                            ventilador: ventilador,
                            tablero: tablero,
                            tv: tv,
                            disponibilidad: disponibilidad,
                            fecha_creacion: fecha_creacion,
                            url_foto: url_foto
                        };
                        
                        document.getElementById('detail-env-image').src = url_foto;
                        document.getElementById('detail-env-image').onerror = function() {
                            this.src = 'https://images.unsplash.com/photo-1580582932707-520aed937b7b?q=80&w=600&auto=format&fit=crop';
                        };
                        
                        const statusBadge = document.getElementById('detail-env-status-badge');
                        if (disponibilidad == 1) {
                            statusBadge.innerText = '✔ ACTIVO';
                            statusBadge.className = 'env-badge-status env-badge-status-active';
                        } else {
                            statusBadge.innerText = '✖ INACTIVO';
                            statusBadge.className = 'env-badge-status env-badge-status-inactive';
                        }
                        
                        document.getElementById('detail-env-code').innerText = `Amb. ${id}`;
                        document.getElementById('detail-env-name').innerText = nombre;
                        
                        const typeBadge = document.getElementById('detail-env-type-badge');
                        typeBadge.innerText = tipo;
                        typeBadge.className = `env-detail-badge-type ${tipo.toLowerCase() === 'especializado' ? 'bg-info-subtle text-info' : 'bg-success-subtle text-success'}`;
                        
                        document.getElementById('detail-env-capacity').innerText = `${capacidad} personas`;
                        document.getElementById('detail-env-pcs').innerText = computadores;
                        document.getElementById('detail-env-type').innerText = tipo;
                        
                        let fechaMantenimiento = 'No registrada';
                        if (fecha_creacion) {
                            const parts = fecha_creacion.split(' ')[0].split('-');
                            if (parts.length === 3) {
                                fechaMantenimiento = `${parts[2]}/${parts[1]}/${parts[0]}`;
                            }
                        }
                        document.getElementById('detail-env-maintenance').innerText = fechaMantenimiento;
                        
                        const equipBadges = document.getElementById('detail-env-equip-badges');
                        equipBadges.innerHTML = '';
                        if (aire == 1) equipBadges.innerHTML += `<span class="env-equip-badge env-equip-aire">Aire</span>`;
                        if (ventilador == 1) equipBadges.innerHTML += `<span class="env-equip-badge env-equip-ventilador">Ventilador</span>`;
                        if (tablero == 1) equipBadges.innerHTML += `<span class="env-equip-badge env-equip-tablero">Tablero</span>`;
                        if (tv == 1) equipBadges.innerHTML += `<span class="env-equip-badge env-equip-tv">TV</span>`;
                        if (aire != 1 && ventilador != 1 && tablero != 1 && tv != 1) equipBadges.innerHTML += `<span class="text-secondary small">Ninguno</span>`;
                        
                        const btnEdit = document.getElementById('detail-btn-edit');
                        if (btnEdit) {
                            btnEdit.setAttribute('onclick', `editarAmbiente(${id}, '${nombre.replace(/'/g, "\\'")}', '${tipo}', ${capacidad}, ${computadores}, '${(especialidad || '').replace(/'/g, "\\'")}', ${aire}, ${ventilador}, ${tablero}, ${tv}, ${disponibilidad})`);
                        }
                        
                        const btnToggle = document.getElementById('detail-btn-toggle-disp');
                        if (btnToggle) {
                            btnToggle.href = `${urlRoot}/index.php?route=ambientes/toggleDisponibilidad&id=${id}`;
                            btnToggle.innerHTML = disponibilidad == 1 ? '<i class="fa-solid fa-power-off"></i> Desactivar Ambiente' : '<i class="fa-solid fa-power-off"></i> Activar Ambiente';
                            btnToggle.className = disponibilidad == 1 ? 'env-detail-btn env-detail-btn-danger text-decoration-none' : 'env-detail-btn env-detail-btn-primary text-decoration-none';
                        }
                        
                        const btnFicha = document.getElementById('detail-btn-view-ficha');
                        if (btnFicha) {
                            btnFicha.href = `${urlRoot}/index.php?route=dashboard/index&novedades_ambiente=${id}#pills-novedades`;
                        }
                        
                        document.getElementById('env-catalog-view').classList.add('d-none');
                        document.getElementById('env-detail-view').classList.remove('d-none');
                        
                        calendarDateAmbiente = new Date(2026, 6, 1);
                        cargarProgramacionAmbiente(id);
                    }

                    function volverAlCatalogo() {
                        selectedAmbiente = null;
                        document.getElementById('env-detail-view').classList.add('d-none');
                        document.getElementById('env-catalog-view').classList.remove('d-none');
                    }

                    function reservarAmbienteActual() {
                        if (!selectedAmbiente) return;
                        
                        const modalEl = document.getElementById('modalAsignarHorario');
                        if (!modalEl) {
                            Swal.fire('Atención', 'Para realizar una reserva, diríjase a la pestaña Programación Académica y use el formulario de asignación.', 'info');
                            return;
                        }
                        
                        const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
                        modal.show();
                        
                        const selectAmbiente = document.getElementById('modal_id_numero_ambiente');
                        if (selectAmbiente) {
                            selectAmbiente.value = selectedAmbiente.id;
                            selectAmbiente.dispatchEvent(new Event('change'));
                        }
                    }

                    function navegarMesAmbiente(dir) {
                        if (dir === 0) {
                            calendarDateAmbiente = new Date();
                        } else {
                            calendarDateAmbiente.setMonth(calendarDateAmbiente.getMonth() + dir);
                        }
                        renderizarCalendarioAmbiente();
                    }

                    function cargarProgramacionAmbiente(id) {
                        const grid = document.getElementById('gridDiasCalendarioAmbiente');
                        grid.innerHTML = `
                            <div class="col-12 text-center py-5">
                                <div class="spinner-border text-success" role="status">
                                    <span class="visually-hidden">Cargando disponibilidad...</span>
                                </div>
                            </div>
                        `;
                        
                        fetch(`${urlRoot}/index.php?route=ambientes/get_programacion&id=${id}&_t=${Date.now()}`)
                            .then(res => res.json())
                            .then(res => {
                                if (res.success) {
                                    programacionAmbienteData = res.data;
                                    excepcionesAmbienteData = res.excepciones || [];
                                } else {
                                    console.error("Error al cargar la programación del ambiente:", res.message);
                                    programacionAmbienteData = [];
                                    excepcionesAmbienteData = [];
                                }
                                renderizarCalendarioAmbiente();
                            })
                            .catch(err => {
                                console.error("Error en fetch de programación:", err);
                                programacionAmbienteData = [];
                                excepcionesAmbienteData = [];
                                renderizarCalendarioAmbiente();
                            });
                    }

                    function renderizarCalendarioAmbiente() {
                        const grid = document.getElementById('gridDiasCalendarioAmbiente');
                        const labelMesAnio = document.getElementById('env-calendar-month-name');
                        
                        if (!grid || !labelMesAnio || !selectedAmbiente) return;
                        
                        grid.innerHTML = '';
                        
                        const year = calendarDateAmbiente.getFullYear();
                        const month = calendarDateAmbiente.getMonth();
                        
                        const meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
                        labelMesAnio.innerText = meses[month] + ' ' + year;
                        
                        const primerDiaMes = new Date(year, month, 1);
                        const startDay = primerDiaMes.getDay();
                        const localStartDay = startDay === 0 ? 7 : startDay;
                        
                        const diasEnMes = new Date(year, month + 1, 0).getDate();
                        const diasEnMesAnterior = new Date(year, month, 0).getDate();
                        
                        for (let i = localStartDay - 1; i > 0; i--) {
                            const diaNum = diasEnMesAnterior - i + 1;
                            const prevDate = new Date(year, month - 1, diaNum);
                            crearCeldaDiaAmbiente(prevDate, true, grid);
                        }
                        
                        const hoy = new Date();
                        for (let i = 1; i <= diasEnMes; i++) {
                            const currentDate = new Date(year, month, i);
                            const esHoy = currentDate.getDate() === hoy.getDate() && currentDate.getMonth() === hoy.getMonth() && currentDate.getFullYear() === hoy.getFullYear();
                            crearCeldaDiaAmbiente(currentDate, false, grid, esHoy);
                        }
                        
                        const celdasTotales = grid.children.length;
                        const celdasRestantes = celdasTotales % 7 === 0 ? 0 : 7 - (celdasTotales % 7);
                        for (let i = 1; i <= celdasRestantes; i++) {
                            const nextDate = new Date(year, month + 1, i);
                            crearCeldaDiaAmbiente(nextDate, true, grid);
                        }
                        
                        calcularMetricasMesAmbiente(year, month);
                    }

                    function crearCeldaDiaAmbiente(date, esOtroMes, grid, esHoy = false) {
                        const diaNum = date.getDate();
                        const yyyy = date.getFullYear();
                        const mm = String(date.getMonth() + 1).padStart(2, '0');
                        const dd = String(diaNum).padStart(2, '0');
                        const dateStr = `${yyyy}-${mm}-${dd}`;
                        const dayOfWeek = date.getDay();
                        
                        const sesiones = programacionAmbienteData.filter(s => {
                            if (s.fecha_inicio !== dateStr) return false;
                            
                            let isLiberado = false;
                            if (excepcionesAmbienteData && excepcionesAmbienteData.length > 0) {
                                let descMatcher = '[LIBERADO_PROG:' + s.id_programacion + ']';
                                isLiberado = excepcionesAmbienteData.some(e => 
                                    e.fecha_reporte === dateStr && 
                                    e.descripcion.includes(descMatcher)
                                );
                            }
                            return !isLiberado;
                        });
                        
                        const celda = document.createElement('div');
                        celda.className = 'calendar-cell';
                        celda.style.cursor = 'pointer';
                        if (esOtroMes) celda.classList.add('other-month');
                        if (esHoy) celda.classList.add('today');
                        
                        let html = `
                            <div class="calendar-cell-header">
                                <span class="calendar-day-num">${diaNum}</span>
                        `;
                        
                        if (selectedAmbiente.disponibilidad === 0) {
                            html += `<span class="indicator-dot dot-red" title="No disponible"></span>`;
                        } else if (sesiones.length > 0) {
                            html += `<span class="indicator-dot dot-yellow" title="Ocupado"></span>`;
                        } else {
                            html += `<span class="indicator-dot dot-green" title="Disponible"></span>`;
                        }
                        
                        html += `
                            </div>
                            <div class="calendar-session-list">
                        `;
                        
                        if (selectedAmbiente.disponibilidad === 0) {
                            html += `
                                <div class="calendar-session-card" style="border-left: 3px solid #dc3545; background-color: #fef2f2;">
                                    <div class="d-flex align-items-center gap-1 text-danger fw-bold">
                                        <i class="fa-solid fa-ban"></i> No disponible
                                    </div>
                                </div>
                            `;
                        } else {
                            sesiones.forEach(s => {
                                const instNombre = s.instructor_nombre + ' ' + s.instructor_apellido;
                                const instNombreCorto = s.instructor_nombre + ' ' + s.instructor_apellido.charAt(0) + '.';
                                const infoEscapada = encodeURIComponent(JSON.stringify(s));
                                
                                const isBlue = (parseInt(s.id_programacion) % 2 === 0);
                                const cardBorderColor = isBlue ? '#0288d1' : '#ea580c';
                                const cardBgColor = isBlue ? '#e0f2fe' : '#fff7ed';
                                
                                html += `
                                    <div class="calendar-session-card" style="border-left: 3px solid ${cardBorderColor}; background-color: ${cardBgColor};" onclick="event.stopPropagation(); mostrarDetalleSessionAmbiente('${instNombre}', '${infoEscapada}')">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span class="calendar-session-time">${s.hora_inicio.substring(0,5)} - ${s.hora_fin.substring(0,5)}</span>
                                            <span class="calendar-session-ficha">#${s.numero_ficha}</span>
                                        </div>
                                        <span class="calendar-session-instructor">
                                            <i class="fa-solid fa-user-tie text-secondary small"></i> ${instNombreCorto}
                                        </span>
                                    </div>
                                `;
                            });
                        }
                        
                        html += `</div>`;
                        celda.innerHTML = html;
                        grid.appendChild(celda);
                    }

                    function mostrarDetalleSessionAmbiente(instructor, infoEscapada) {
                        const s = JSON.parse(decodeURIComponent(infoEscapada));
                        Swal.fire({
                            title: `<strong class="text-dark"><i class="fa-solid fa-clock text-success me-2"></i>Detalle de Formación</strong>`,
                            html: `
                                <div class="text-start py-2 px-3 small">
                                    <p class="mb-2"><strong>Ficha:</strong> <span class="badge bg-secondary">#${s.numero_ficha}</span></p>
                                    <p class="mb-2"><strong>Instructor:</strong> ${instructor}</p>
                                    <p class="mb-2"><strong>Ambiente:</strong> ${s.ambiente_nombre}</p>
                                    <p class="mb-2"><strong>Horario:</strong> ${s.nombre_dia} (${s.hora_inicio.substring(0, 5)} - ${s.hora_fin.substring(0, 5)})</p>
                                    <p class="mb-2"><strong>Competencia:</strong> ${s.competencia_nombre || 'N/A'}</p>
                                    <p class="mb-0"><strong>Resultado:</strong> [${s.ra_codigo}] ${s.ra_descripcion}</p>
                                </div>
                            `,
                            confirmButtonText: 'Cerrar',
                            confirmButtonColor: '#39A900',
                            customClass: {
                                popup: 'rounded-4 border-0'
                            }
                        });
                    }

                    function calcularMetricasMesAmbiente(year, month) {
                        const totalDays = new Date(year, month + 1, 0).getDate();
                        
                        let workingDays = 0;
                        let diasOcupados = 0;
                        const occupiedDates = new Set();
                        
                        for (let i = 1; i <= totalDays; i++) {
                            const d = new Date(year, month, i);
                            if (d.getDay() !== 0) {
                                workingDays++;
                            }
                        }
                        
                        programacionAmbienteData.forEach(s => {
                            let isLiberado = false;
                            if (excepcionesAmbienteData && excepcionesAmbienteData.length > 0) {
                                let descMatcher = '[LIBERADO_PROG:' + s.id_programacion + ']';
                                isLiberado = excepcionesAmbienteData.some(e => 
                                    e.fecha_reporte === s.fecha_inicio && 
                                    e.descripcion.includes(descMatcher)
                                );
                            }
                            if (isLiberado) return;

                            const parts = s.fecha_inicio.split('-');
                            if (parts.length === 3) {
                                const sYear = parseInt(parts[0], 10);
                                const sMonth = parseInt(parts[1], 10) - 1;
                                if (sYear === year && sMonth === month) {
                                    occupiedDates.add(s.fecha_inicio);
                                }
                            }
                        });
                        
                        diasOcupados = occupiedDates.size;
                        let diasLibres = workingDays - diasOcupados;
                        if (diasLibres < 0) diasLibres = 0;
                        
                        document.getElementById('stat-dias-libres').innerText = diasLibres;
                        document.getElementById('stat-dias-ocupados').innerText = diasOcupados;
                        
                        const usagePct = workingDays > 0 ? Math.round((diasOcupados / workingDays) * 100) : 0;
                        document.getElementById('stat-uso-ambiente').innerText = usagePct + '%';
                        
                        const hoyStr = new Date().toISOString().split('T')[0];
                        const proximas = programacionAmbienteData
                            .filter(s => {
                                if (s.fecha_inicio < hoyStr) return false;
                                let isLiberado = false;
                                if (excepcionesAmbienteData && excepcionesAmbienteData.length > 0) {
                                    let descMatcher = '[LIBERADO_PROG:' + s.id_programacion + ']';
                                    isLiberado = excepcionesAmbienteData.some(e => 
                                        e.fecha_reporte === s.fecha_inicio && 
                                        e.descripcion.includes(descMatcher)
                                    );
                                }
                                return !isLiberado;
                            })
                            .sort((a, b) => {
                                if (a.fecha_inicio !== b.fecha_inicio) {
                                    return a.fecha_inicio.localeCompare(b.fecha_inicio);
                                }
                                return a.hora_inicio.localeCompare(b.hora_inicio);
                            });
                            
                        const proximaCardValue = document.getElementById('stat-proxima-reserva');
                        const proximaCardTime = document.getElementById('stat-proxima-reserva-time');
                        
                        if (proximas.length > 0) {
                            const prox = proximas[0];
                            const fechaParts = prox.fecha_inicio.split('-');
                            const fechaFormat = `${fechaParts[2]}/${fechaParts[1]}`;
                            
                            let diaLabel = fechaFormat;
                            const d = new Date(prox.fecha_inicio + 'T00:00:00');
                            const hoy = new Date();
                            const mañana = new Date();
                            mañana.setDate(hoy.getDate() + 1);
                            
                            if (d.toDateString() === hoy.toDateString()) {
                                diaLabel = 'Hoy';
                            } else if (d.toDateString() === mañana.toDateString()) {
                                diaLabel = 'Mañana';
                            }
                            
                            proximaCardValue.innerText = diaLabel;
                            proximaCardTime.innerText = `${prox.hora_inicio.substring(0, 5)} - ${prox.hora_fin.substring(0, 5)}`;
                        } else {
                            proximaCardValue.innerText = 'Ninguna';
                            proximaCardTime.innerText = 'Sin reservas futuras';
                        }
                    }

                    document.addEventListener("DOMContentLoaded", function() {
                        const searchInput = document.getElementById("env-search-input");
                        const filterEstado = document.getElementById("env-filter-estado");
                        const filterTipo = document.getElementById("env-filter-tipo");
                        const filterSede = document.getElementById("env-filter-sede");
                        const cardsContainer = document.getElementById("env-cards-container");
                        
                        const kpiTotal = document.getElementById("kpi-total-ambientes");
                        const kpiPcs = document.getElementById("kpi-total-pcs");
                        const kpiCapacidad = document.getElementById("kpi-total-capacidad");
                        const kpiActivos = document.getElementById("kpi-total-activos");
                        const paginationInfo = document.getElementById("env-pagination-info");
                        const paginationControls = document.getElementById("env-pagination-controls");

                        const wrappers = Array.from(document.querySelectorAll(".env-card-wrapper"));
                        const itemsPerPage = 4;
                        let currentPage = 1;
                        let filteredWrappers = wrappers.slice();

                        function renderPagination() {
                            const totalFiltered = filteredWrappers.length;
                            const totalPages = Math.max(1, Math.ceil(totalFiltered / itemsPerPage));
                            currentPage = Math.min(Math.max(currentPage, 1), totalPages);

                            const startIndex = totalFiltered === 0 ? 0 : (currentPage - 1) * itemsPerPage;
                            const endIndex = Math.min(startIndex + itemsPerPage, totalFiltered);
                            const visiblePageItems = new Set(filteredWrappers.slice(startIndex, endIndex));

                            wrappers.forEach(wrapper => {
                                wrapper.classList.toggle("d-none", !visiblePageItems.has(wrapper));
                            });

                            if (paginationInfo) {
                                if (totalFiltered === 0) {
                                    paginationInfo.textContent = "No hay ambientes para mostrar";
                                } else {
                                    paginationInfo.textContent = `Mostrando ${startIndex + 1} a ${endIndex} de ${totalFiltered} ambientes`;
                                }
                            }

                            if (!paginationControls) return;

                            let controlsHtml = `
                                <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                                    <button type="button" class="page-link rounded border-0 bg-transparent text-secondary" data-env-page="prev" aria-label="Página anterior">
                                        <i class="fa-solid fa-chevron-left"></i>
                                    </button>
                                </li>
                            `;

                            for (let page = 1; page <= totalPages; page++) {
                                const isActive = page === currentPage;
                                controlsHtml += `
                                    <li class="page-item ${isActive ? 'active' : ''}">
                                        <button type="button" class="page-link rounded fw-bold border-0 ${isActive ? 'text-white' : 'text-secondary bg-transparent'}" data-env-page="${page}" style="${isActive ? 'background-color: #39A900;' : ''} min-width: 28px; text-align: center;">
                                            ${page}
                                        </button>
                                    </li>
                                `;
                            }

                            controlsHtml += `
                                <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                                    <button type="button" class="page-link rounded border-0 bg-transparent text-secondary" data-env-page="next" aria-label="Página siguiente">
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </button>
                                </li>
                            `;

                            paginationControls.innerHTML = controlsHtml;
                        }

                        function applyFilters(resetPage = true) {
                            const query = searchInput ? searchInput.value.trim().toLowerCase() : "";
                            const estado = filterEstado ? filterEstado.value : "all";
                            const tipo = filterTipo ? filterTipo.value : "all";

                            let visibleCount = 0;
                            let activeCount = 0;
                            let totalPcs = 0;
                            let totalCapacidad = 0;
                            filteredWrappers = [];

                            wrappers.forEach(wrapper => {
                                const name = wrapper.dataset.nombre;
                                const id = wrapper.dataset.id;
                                const wrapperTipo = wrapper.dataset.tipo;
                                const specialty = wrapper.dataset.especialidad;
                                const isAvailable = wrapper.dataset.disponibilidad;
                                const pcs = parseInt(wrapper.dataset.computadores) || 0;
                                const cap = parseInt(wrapper.dataset.capacidad) || 0;
                                const equipments = wrapper.dataset.equipos;

                                const matchesSearch = !query || 
                                                      name.includes(query) || 
                                                      id.includes(query) || 
                                                      specialty.includes(query) || 
                                                      equipments.includes(query);

                                const matchesEstado = (estado === "all") || (isAvailable === estado);
                                const matchesTipo = (tipo === "all") || (wrapperTipo.includes(tipo));

                                if (matchesSearch && matchesEstado && matchesTipo) {
                                    filteredWrappers.push(wrapper);
                                    visibleCount++;
                                    if (isAvailable === "1") {
                                        activeCount++;
                                    }
                                    totalPcs += pcs;
                                    totalCapacidad += cap;
                                }
                            });

                            if (kpiTotal) kpiTotal.textContent = visibleCount;
                            if (kpiPcs) kpiPcs.textContent = totalPcs;
                            if (kpiCapacidad) kpiCapacidad.textContent = totalCapacidad;
                            if (kpiActivos) {
                                const pct = visibleCount > 0 ? Math.round((activeCount / visibleCount) * 100) : 0;
                                kpiActivos.textContent = pct + "%";
                            }

                            if (resetPage) {
                                currentPage = 1;
                            }

                            renderPagination();
                        }

                        if (searchInput) searchInput.addEventListener("input", function() { applyFilters(true); });
                        if (filterEstado) filterEstado.addEventListener("change", function() { applyFilters(true); });
                        if (filterTipo) filterTipo.addEventListener("change", function() { applyFilters(true); });
                        if (filterSede) filterSede.addEventListener("change", function() { applyFilters(true); });

                        if (paginationControls) {
                            paginationControls.addEventListener("click", function(event) {
                                const button = event.target.closest("[data-env-page]");
                                const pageItem = button ? button.closest(".page-item") : null;
                                if (!button || (pageItem && pageItem.classList.contains("disabled"))) return;

                                const targetPage = button.dataset.envPage;
                                const totalPages = Math.max(1, Math.ceil(filteredWrappers.length / itemsPerPage));

                                if (targetPage === "prev") {
                                    currentPage = Math.max(1, currentPage - 1);
                                } else if (targetPage === "next") {
                                    currentPage = Math.min(totalPages, currentPage + 1);
                                } else {
                                    currentPage = parseInt(targetPage, 10) || 1;
                                }

                                renderPagination();
                            });
                        }

                        const btnGrid = document.getElementById("env-toggle-grid");
                        const btnList = document.getElementById("env-toggle-list");

                        if (btnGrid && btnList) {
                            btnGrid.addEventListener("click", function() {
                                btnGrid.classList.add("active");
                                btnList.classList.remove("active");
                                cardsContainer.classList.remove("env-list-view-active");
                                wrappers.forEach(w => {
                                    w.classList.remove("col-12");
                                    w.classList.add("col-lg-6");
                                });
                            });

                            btnList.addEventListener("click", function() {
                                btnList.classList.add("active");
                                btnGrid.classList.remove("active");
                                cardsContainer.classList.add("env-list-view-active");
                                wrappers.forEach(w => {
                                    w.classList.remove("col-lg-6");
                                    w.classList.add("col-12");
                                });
                            });
                        }

                        applyFilters();
                    });
                </script>
            </div>

            <!-- PESTAÑA 4: NOVEDADES REPORTADAS -->
            <div class="tab-pane fade" id="pills-novedades" role="tabpanel" aria-labelledby="pills-novedades-tab">
                
                <div class="mb-4 pb-1">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-start gap-2">
                        <div>
                            <h5 class="fw-bold text-dark mb-1">
                                Reportes de Novedades e Incidencias
                                <?php if (!empty($novedades_ambiente)): ?>
                                    <span class="text-success">- <?= htmlspecialchars($novedades_ambiente->nombre); ?></span>
                                <?php endif; ?>
                            </h5>
                            <p class="text-muted small mb-0">
                                <?php if (!empty($novedades_ambiente)): ?>
                                    Novedades registradas únicamente para este ambiente.
                                <?php else: ?>
                                    Novedades reportadas por los instructores líderes en relación al estado de la infraestructura física.
                                <?php endif; ?>
                            </p>
                        </div>
                        <?php if (!empty($novedades_ambiente)): ?>
                            <a href="<?= URLROOT; ?>/index.php?route=dashboard/index#pills-novedades" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                                <i class="fa-solid fa-list me-1"></i> Ver todas
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="card bg-white border-0 shadow-sm rounded-4 p-4 p-md-5" style="border: 1px solid rgba(0,0,0,0.06);">
                    
                    <?php if (empty($novedades)): ?>
                        <?php if (!empty($novedades_ambiente)): ?>
                            <div class="p-5 text-center text-muted">
                                <i class="fa-solid fa-file-shield fa-3x mb-3 text-success"></i>
                                <h6 class="fw-bold">No hay novedades para <?= htmlspecialchars($novedades_ambiente->nombre); ?></h6>
                                <p class="small mb-0">Este ambiente no tiene reportes registrados.</p>
                            </div>
                        <?php else: ?>
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center py-4 border-bottom border-light-subtle gap-4">
                            <div class="d-flex align-items-start gap-4">
                                <div class="icon-box-warning">
                                    <i class="fa-solid fa-triangle-exclamation"></i>
                                </div>
                                <div>
                                    <div class="d-flex align-items-center gap-3 mb-2">
                                        <span class="fw-bold text-dark fs-6">Ambiente 102</span>
                                        <span class="text-secondary font-monospace small">ID Reporte: #1</span>
                                    </div>
                                    <p class="text-dark fw-medium mb-2 fst-italic" style="font-size: 1.05rem;">"El aire acondicionado del fondo hace ruido excesivo y gotea de vez en cuando."</p>
                                    <div class="text-muted small" style="font-size: 0.82rem;">Darwin Cordero • Reportado el: 2026-06-25</div>
                                </div>
                            </div>
                            <div class="text-md-end">
                                <a href="#" class="btn-resuelta" onclick="alert('Estado actualizado: La avería ha sido notificada al equipo de mantenimiento.'); return false;">
                                    Marcar como Resuelta
                                </a>
                            </div>
                        </div>

                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center py-4 border-light-subtle gap-4">
                            <div class="d-flex align-items-start gap-4">
                                <div class="icon-box-warning">
                                    <i class="fa-solid fa-triangle-exclamation"></i>
                                </div>
                                <div>
                                    <div class="d-flex align-items-center gap-3 mb-2">
                                        <span class="fw-bold text-dark fs-6">Ambiente 204</span>
                                        <span class="text-secondary font-monospace small">ID Reporte: #2</span>
                                    </div>
                                    <p class="text-dark fw-medium mb-2 fst-italic" style="font-size: 1.05rem;">"Tres puertos ethernet en la mesa del centro no tienen conectividad de red."</p>
                                    <div class="text-muted small" style="font-size: 0.82rem;">Darwin Cordero • Reportado el: 2026-06-27</div>
                                </div>
                            </div>
                            <div class="text-md-end">
                                <a href="#" class="btn-resuelta" onclick="alert('Estado actualizado: La avería ha sido notificada al equipo de mantenimiento.'); return false;">
                                    Marcar como Resuelta
                                </a>
                            </div>
                        </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <?php foreach ($novedades as $nov): ?>
                            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center py-4 border-bottom border-light-subtle gap-4">
                                <div class="d-flex align-items-start gap-4">
                                    <div class="icon-box-warning">
                                        <i class="fa-solid fa-triangle-exclamation"></i>
                                    </div>
                                    <div>
                                        <div class="d-flex align-items-center gap-3 mb-2">
                                            <span class="fw-bold text-dark fs-6"><?= $nov->ambiente_nombre; ?></span>
                                            <span class="text-secondary font-monospace small">ID Reporte: #<?= $nov->id_novedad; ?></span>
                                        </div>
                                        <p class="text-dark fw-medium mb-2 fst-italic" style="font-size: 1.05rem;">"<?= $nov->descripcion; ?>"</p>
                                        <div class="text-muted small" style="font-size: 0.82rem;"><?= $nov->usuario_nombre . ' ' . $nov->usuario_apellido; ?> • Reportado el: <?= $nov->fecha_reporte; ?></div>
                                    </div>
                                </div>
                                <div class="text-md-end">
                                    <?php if (!empty($nov->evidencia)): ?>
                                        <button type="button" class="btn btn-outline-secondary btn-sm me-2" style="border-radius: 8px;" onclick="mostrarEvidencia('<?= $nov->evidencia; ?>')">
                                            <i class="fa-solid fa-image"></i> Ver Evidencia
                                        </button>
                                    <?php endif; ?>
                                    <a href="<?= URLROOT; ?>/index.php?route=ambientes/resolverNovedad&id=<?= $nov->id_novedad; ?>" class="btn-resuelta">
                                        Marcar como Resuelta
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </div>

                <!-- Modal para Ver Evidencia -->
                <div class="modal fade" id="modalVerEvidencia" tabindex="-1" aria-labelledby="modalVerEvidenciaLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content border-0 rounded-4 shadow">
                            <div class="modal-header border-bottom-0 pb-0 pt-4 px-4">
                                <h5 class="modal-title fw-bold text-dark" id="modalVerEvidenciaLabel"><i class="fa-solid fa-image text-secondary me-2"></i>Evidencia Fotográfica</h5>
                                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center p-4">
                                <img id="imagenEvidenciaModal" src="" alt="Evidencia de novedad" class="img-fluid rounded-3" style="max-height: 70vh; object-fit: contain;">
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    function mostrarEvidencia(url) {
                        document.getElementById('imagenEvidenciaModal').src = url;
                        var evidenciaModal = new bootstrap.Modal(document.getElementById('modalVerEvidencia'));
                        evidenciaModal.show();
                    }
                </script>

            </div>

            <!-- PESTAÑA 5: GESTIÓN DE USUARIOS Y ROLES -->
            <div class="tab-pane fade" id="pills-usuarios" role="tabpanel" aria-labelledby="pills-usuarios-tab">
                <div class="card bg-white border-0 shadow-sm rounded-4 mb-4" style="border: 1px solid rgba(0,0,0,0.06);">
                    <div class="card-body p-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                        <div>
                            <h5 class="fw-bold text-dark mb-1">Administración de Usuarios y Roles</h5>
                            <p class="text-muted small mb-0">Gestión de cuentas de acceso, perfiles académicos y niveles de privilegio.</p>
                        </div>
                        <?php if ($current_role === 'Coordinador'): ?>
                            <div class="d-flex flex-wrap gap-2 justify-content-end">
                                <a href="<?= URLROOT; ?>/index.php?route=usuarios/exportarPDF" class="btn btn-danger btn-sm shadow-sm fw-medium d-flex align-items-center rounded-3 px-3 py-2">
                                    <i class="fa-solid fa-file-pdf me-2"></i> Exportar PDF
                                </a>
                                <button type="button" class="btn btn-dark btn-sm shadow-sm fw-medium d-flex align-items-center rounded-3 px-3 py-2" data-bs-toggle="modal" data-bs-target="#modalCargaMasivaUsuarios">
                                    <i class="fa-solid fa-upload me-2"></i> Carga Masiva
                                </button>
                                <button type="button" class="btn btn-primary btn-sm shadow-sm fw-medium d-flex align-items-center rounded-3 px-3 py-2" data-bs-toggle="modal" data-bs-target="#modalCrearUsuario" style="background-color: #0d6efd; border:none;">
                                    <i class="fa-solid fa-user-plus me-2"></i> Nuevo Usuario
                                </button>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="row mb-4 g-3 align-items-center">
                    <div class="col-md-7 col-lg-8">
                        <div class="input-group shadow-sm border-0 rounded-3 overflow-hidden">
                            <span class="input-group-text bg-white border-0 text-muted ps-3"><i class="fa-solid fa-magnifying-glass"></i></span>
                            <input type="text" id="buscadorUsuarios" class="form-control border-0 bg-white shadow-none py-2" placeholder="Buscar por nombre, correo, login, teléfono o titulación...">
                        </div>
                    </div>
                    <div class="col-md-5 col-lg-4">
                        <select id="filtroRol" class="form-select shadow-sm border-0 rounded-3 py-2 text-secondary fw-medium">
                            <option value="">Todos los roles</option>
                            <?php if(isset($roles)): foreach ($roles as $r): ?>
                                <option value="<?= $r->nombre_rol; ?>"><?= $r->nombre_rol; ?></option>
                            <?php endforeach; endif; ?>
                        </select>
                    </div>
                </div>

                <div class="card bg-white border-0 shadow-sm rounded-4 p-0 overflow-hidden" style="border: 1px solid rgba(0,0,0,0.06);">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light text-secondary small text-uppercase py-3" style="font-size: 0.78rem; font-weight: 700; letter-spacing: 0.5px;">
                                    <tr>
                                        <th class="ps-4 py-3">Usuario</th>
                                        <th class="py-3">Login</th>
                                        <th class="py-3">Titulación</th>
                                        <th class="py-3">Roles Asignados</th>
                                        <th class="text-end pe-4 py-3">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(isset($usuarios)): foreach ($usuarios as $u): ?>
                                        <tr>
                                            <td class="ps-4 py-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-circle bg-success text-white fw-bold me-3 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; border-radius: 50%; font-size: 1.1rem;">
                                                        <?= strtoupper(substr($u->nombre, 0, 1)); ?>
                                                    </div>
                                                    <div>
                                                        <div class="fw-bold text-dark small"><?= $u->nombre . ' ' . $u->apellido; ?></div>
                                                        <span class="text-muted small" style="font-size: 0.78rem;"><?= $u->correo; ?></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-light text-dark border px-3 py-1" style="font-size: 0.8rem;">ID: <?= $u->documento; ?></span>
                                            </td>
                                            <td><div class="text-secondary small fw-medium"><?= $u->titulacion; ?></div></td>
                                            <td>
                                                <div class="d-flex flex-wrap gap-1">
                                                    <?php 
                                                    $misRoles = $rolesUsuario[$u->id_usuario] ?? [];
                                                    foreach ($misRoles as $rol): 
                                                        $badgeBg = 'bg-secondary';
                                                        if ($rol->nombre_rol === 'Coordinador') $badgeBg = 'bg-danger';
                                                        if ($rol->nombre_rol === 'Instructor') $badgeBg = 'bg-primary';
                                                        if ($rol->nombre_rol === 'Aprendiz') $badgeBg = 'bg-success';
                                                    ?>
                                                        <span class="badge <?= $badgeBg; ?> px-2 py-1 shadow-sm" style="font-size: 0.7rem;"><?= $rol->nombre_rol; ?></span>
                                                    <?php endforeach; ?>
                                                </div>
                                            </td>
                                            <td class="text-end pe-4">
                                                <div class="d-flex flex-column align-items-end gap-2">
                                                    <!-- Botones CRUD -->
                                                    <div class="d-flex gap-2">
                                                        <button class="btn btn-sm btn-outline-primary shadow-sm" onclick="editarUsuario(<?= $u->id_usuario; ?>, '<?= htmlspecialchars(addslashes($u->nombre)); ?>', '<?= htmlspecialchars(addslashes($u->apellido)); ?>', '<?= htmlspecialchars(addslashes($u->documento)); ?>', '<?= htmlspecialchars(addslashes($u->telefono)); ?>', '<?= htmlspecialchars(addslashes($u->correo)); ?>', '<?= htmlspecialchars(addslashes($u->titulacion)); ?>', '<?= !empty($rolesUsuario[$u->id_usuario]) ? $rolesUsuario[$u->id_usuario][0]->id_rol : ''; ?>')" title="Editar">
                                                            <i class="fa-solid fa-pen"></i> Editar
                                                        </button>
                                                        <a href="<?= URLROOT; ?>/index.php?route=usuarios/delete&id=<?= $u->id_usuario; ?>" class="btn btn-sm btn-outline-danger shadow-sm" onclick="return confirm('¿Seguro que deseas borrar a este usuario?');" title="Eliminar">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    <?php elseif ($current_role === 'Instructor'): 
        // Cálculos para KPIs
        $total_clases = count($programacion ?? []);
        $fichas_unicas = [];
        if (!empty($programacion)) {
            $fichas_unicas = array_unique(array_column($programacion, 'numero_ficha'));
        }
        $total_fichas = count($fichas_unicas);
        $fallas_reportadas = 0; // Calculo omitido por ahora
        $sesiones_realizadas = !empty($programacion) ? array_sum(array_column($programacion, 'sesiones_realizadas')) : 0;
        $total_sesiones = !empty($programacion) ? array_sum(array_column($programacion, 'total_sesiones')) : 0;
        $cumplimiento = $total_sesiones > 0 ? round(($sesiones_realizadas / $total_sesiones) * 100) : 0;
    ?>
        <style>
        /* INSTRUCTOR REDESIGN CSS (Hero usará clases globales) */
        .inst-kpi-card {
            background-color: #ffffff;
            border-radius: 20px;
            padding: 1.5rem;
            height: 100%;
        }
        .inst-kpi-title {
            font-size: 0.7rem;
            font-weight: 800;
            color: #9ca3af;
            letter-spacing: 1px;
        }
        .inst-kpi-icon {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
        }
        .inst-kpi-value {
            font-size: 2.2rem;
            font-weight: 800;
            color: #111827;
            line-height: 1;
            margin-bottom: 0.8rem;
        }
        .inst-kpi-subtitle {
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        /* Layout */
        .inst-agenda-panel, .inst-cal-panel {
            background-color: #ffffff;
            border-radius: 24px;
            padding: 2rem;
            height: 100%;
        }
        .inst-agenda-sup {
            font-size: 0.7rem;
            font-weight: 800;
            letter-spacing: 1px;
        }
        .inst-agenda-badge {
            background-color: #f3f4f6;
            color: #6b7280;
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
        }
        .inst-agenda-card {
            border: 1px solid #f3f4f6;
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            transition: all 0.2s;
        }
        .inst-agenda-card:hover {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            border-color: #e5e7eb;
        }
        .inst-agenda-ficha {
            background-color: #e6f6f1;
            color: #10b981;
            padding: 0.2rem 0.6rem;
            border-radius: 12px;
            font-size: 0.65rem;
            font-weight: 800;
            letter-spacing: 0.5px;
        }
        .inst-agenda-time {
            color: #6b7280;
            font-size: 0.75rem;
            font-weight: 700;
        }
        .inst-btn-call {
            background-color: #10b981;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0.6rem 1.2rem;
            font-weight: 700;
            font-size: 0.85rem;
            transition: all 0.2s;
        }
        .inst-btn-call:hover {
            background-color: #059669;
        }
        
        /* Calendar */
        .inst-cal-grid-header {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            text-align: center;
            font-weight: 700;
            color: #9ca3af;
            font-size: 0.75rem;
            margin-bottom: 1rem;
        }
        .inst-cal-grid-body {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
        }
        .inst-cal-cell {
            aspect-ratio: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.9rem;
            color: #374151;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
        }
        .inst-cal-cell:hover {
            background-color: #f3f4f6;
        }
        .inst-cal-cell.active {
            background-color: #10b981;
            color: white;
            box-shadow: 0 4px 10px rgba(16, 185, 129, 0.3);
        }
        .inst-cal-cell.muted {
            color: #d1d5db;
        }
        .inst-cal-dot {
            width: 5px;
            height: 5px;
            border-radius: 50%;
            margin-top: 4px;
        }
        .inst-cal-dot.green { background-color: #10b981; }
        .inst-cal-cell.active .inst-cal-dot.green { background-color: white; }
        .inst-dot-legend {
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }
        .inst-dot-legend.green { background-color: #10b981; }
        .inst-dot-legend.grey { background-color: #e5e7eb; border: 1px solid #d1d5db; }
        </style>

        <!-- PANEL DE CONTROL DEL INSTRUCTOR LÍDER -->
        
        <!-- 3. Pestañas Ocultas (Lógica de Navegación) -->
        <ul class="nav sga-nav-pills mb-5 gap-3 d-none" id="pills-tab-inst" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-vision-inst-tab" data-bs-toggle="pill" data-bs-target="#pills-vision-inst" type="button" role="tab" aria-controls="pills-vision-inst" aria-selected="true">Visión General</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-inst-asistencia-tab" data-bs-toggle="pill" data-bs-target="#pills-inst-asistencia" type="button" role="tab" aria-controls="pills-inst-asistencia" aria-selected="false">Registrar Asistencia</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-inst-novedad-tab" data-bs-toggle="pill" data-bs-target="#pills-inst-novedad" type="button" role="tab" aria-controls="pills-inst-novedad" aria-selected="false">Reportar Novedad</button>
            </li>
        </ul>

        <div class="tab-content" id="pills-tabContentInst">
            
            <!-- PESTAÑA 0: VISIÓN GENERAL (Rediseño) -->
            <div class="tab-pane fade show active" id="pills-vision-inst" role="tabpanel" aria-labelledby="pills-vision-inst-tab">
        <!-- 1. Hero Section Nuevo Diseño -->
        <div class="banner-welcome d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
            <div>
                <div class="badge-active"><i class="fa-solid fa-circle text-success me-2" style="font-size: 8px;"></i> Portal de Registro de Asistencia Docente Activo</div>
                <h3>¡Hola, Instructor <?= htmlspecialchars(explode(' ', $_SESSION['user_name'] ?? 'Usuario')[0]); ?>!</h3>
                <p>Explora el resumen de tus actividades formativas asignadas, consulta el calendario mensual de tus clases y mantén el control sobre tu cumplimiento académico.</p>
            </div>
            <a href="<?= URLROOT; ?>/index.php?route=perfil/index" class="banner-user-card shadow-sm mt-3 mt-md-0 ms-md-4 text-decoration-none" style="transition: all 0.25s ease;">
                <img class="banner-welcome-avatar-img" src="<?= htmlspecialchars($avatarUrl ?? '', ENT_QUOTES, 'UTF-8'); ?>" alt="Foto de perfil">
                <span>
                    <small>DOCENTE INSTRUCTOR</small>
                    <strong><?= htmlspecialchars($_SESSION['user_name'] ?? 'Usuario'); ?></strong>
                    <div class="user-email"><i class="fa-regular fa-envelope me-1"></i> instructor@sena.edu.co</div>
                </span>
            </a>
        </div>

        <!-- 2. KPI Cards -->
        <div class="row g-3 mb-4">
            <div class="col-12 col-md-6 col-xl-3">
                <div class="inst-kpi-card shadow-sm">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <span class="inst-kpi-title">MIS BLOQUES</span>
                        <div class="inst-kpi-icon text-success bg-success-subtle"><i class="fa-regular fa-calendar"></i></div>
                    </div>
                    <div class="inst-kpi-value"><?= $total_clases ?></div>
                    <div class="inst-kpi-subtitle text-success"><i class="fa-solid fa-arrow-trend-up me-1"></i> Clases semanales asignadas</div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-3">
                <div class="inst-kpi-card shadow-sm">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <span class="inst-kpi-title">FICHAS ACTIVAS</span>
                        <div class="inst-kpi-icon text-success bg-success-subtle"><i class="fa-solid fa-user-group"></i></div>
                    </div>
                    <div class="inst-kpi-value"><?= $total_fichas ?></div>
                    <div class="inst-kpi-subtitle text-success"><i class="fa-solid fa-layer-group me-1"></i> Cohortes de formación</div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-3">
                <div class="inst-kpi-card shadow-sm">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <span class="inst-kpi-title">FALLAS REPORTADAS</span>
                        <div class="inst-kpi-icon text-danger bg-danger-subtle"><i class="fa-solid fa-triangle-exclamation"></i></div>
                    </div>
                    <div class="inst-kpi-value"><?= $fallas_reportadas ?></div>
                    <div class="inst-kpi-subtitle text-danger"><i class="fa-solid fa-thumbtack me-1"></i> Incidentes registrados</div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-3">
                <div class="inst-kpi-card shadow-sm">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <span class="inst-kpi-title">CUMPLIMIENTO</span>
                        <div class="inst-kpi-icon text-success bg-success-subtle"><i class="fa-regular fa-circle-check"></i></div>
                    </div>
                    <div class="inst-kpi-value"><?= $cumplimiento ?>%</div>
                    <div class="inst-kpi-subtitle text-secondary"><i class="fa-regular fa-clock me-1"></i> <?= $sesiones_realizadas ?> de <?= $total_sesiones ?> sesiones</div>
                </div>
            </div>
        </div>

                
                <div class="row g-4 mb-4">
                    <!-- Columna Izquierda: Agenda -->
                    <div class="col-12 col-lg-7">
                        <div class="inst-agenda-panel shadow-sm d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom border-light-subtle">
                                <div>
                                    <span class="inst-agenda-sup text-success">AGENDA PARA EL DÍA SELECCIONADO</span>
                                    <h4 class="fw-bold mb-0 mt-1 text-dark" id="inst-agenda-fecha">Seleccione un día</h4>
                                </div>
                                <div class="inst-agenda-badge" id="inst-agenda-count">0 Clases Asignadas</div>
                            </div>
                            
                            <div id="inst-agenda-container" class="flex-grow-1" style="overflow-y: auto; max-height: 480px; padding-right: 0.5rem;">
                                <!-- Se llena dinámicamente con JS -->
                                <div class="text-center py-5 text-muted">
                                    <i class="fa-regular fa-calendar-check fa-3x mb-3 text-secondary"></i>
                                    <p class="fw-bold mb-0">Seleccione un día del calendario</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Columna Derecha: Calendario -->
                    <div class="col-12 col-lg-5">
                        <div class="inst-cal-panel shadow-sm">
                            <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom border-light-subtle">
                                <h6 class="fw-bold mb-0 text-dark" style="font-size: 0.95rem;"><i class="fa-regular fa-calendar me-2 text-success"></i> MI CALENDARIO</h6>
                                <div class="d-flex align-items-center gap-3">
                                    <button class="btn btn-sm btn-light rounded-circle shadow-sm" onclick="navegarMesInst(-1)"><i class="fa-solid fa-chevron-left"></i></button>
                                    <span class="text-secondary fw-bold text-capitalize" style="font-size: 0.85rem;" id="inst-cal-mes-anio"></span>
                                    <button class="btn btn-sm btn-light rounded-circle shadow-sm" onclick="navegarMesInst(1)"><i class="fa-solid fa-chevron-right"></i></button>
                                </div>
                            </div>

                            <div class="inst-cal-grid-header">
                                <div>L</div><div>M</div><div>M</div><div>J</div><div>V</div><div>S</div><div>D</div>
                            </div>
                            <div class="inst-cal-grid-body" id="inst-cal-body">
                                <!-- Generado por JS -->
                            </div>
                            
                            <div class="d-flex justify-content-center gap-4 mt-4 pt-4 border-top border-light-subtle">
                                <div class="d-flex align-items-center gap-2 text-secondary" style="font-size: 0.75rem; font-weight: 600;"><div class="inst-dot-legend green"></div> Con clases</div>
                                <div class="d-flex align-items-center gap-2 text-secondary" style="font-size: 0.75rem; font-weight: 600;"><div class="inst-dot-legend grey"></div> Sin clases</div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    const programacionInst = <?= json_encode($programacion ?? []) ?>;
                    const programasNombresInst = <?= json_encode($programas_fichas ?? []) ?>;
                    
                    let fechaActualInst = new Date();
                    let currentMesInst = fechaActualInst.getMonth() + 1;
                    let currentAnioInst = fechaActualInst.getFullYear();
                    
                    const mesesNombresInst = ['', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
                    const diasSemanaNombres = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];

                    function renderizarCalendarioInst(mes, anio) {
                        const calBody = document.getElementById('inst-cal-body');
                        const labelMesAnio = document.getElementById('inst-cal-mes-anio');
                        
                        if(!calBody) return;
                        
                        labelMesAnio.innerText = mesesNombresInst[mes] + ' ' + anio;
                        calBody.innerHTML = '';

                        const primerDiaStr = `${anio}-${String(mes).padStart(2, '0')}-01T00:00:00`;
                        const primerDiaObj = new Date(primerDiaStr);
                        let diaSemanaInicio = primerDiaObj.getDay(); // 0 (Dom) a 6 (Sab)
                        
                        // Ajustar Lunes = 0 ... Domingo = 6
                        const offset = diaSemanaInicio === 0 ? 6 : diaSemanaInicio - 1;
                        const diasMes = new Date(anio, mes, 0).getDate();

                        const strMes = String(mes).padStart(2, '0');
                        let diasConClase = new Set();
                        programacionInst.forEach(p => {
                            if (p.fecha_inicio && p.fecha_inicio.startsWith(`${anio}-${strMes}`)) {
                                const d = parseInt(p.fecha_inicio.split('-')[2], 10);
                                diasConClase.add(d);
                            }
                        });

                        const hoy = new Date();
                        const esMesActual = (hoy.getMonth() + 1 === mes && hoy.getFullYear() === anio);
                        const diaActual = hoy.getDate();

                        let html = '';
                        for (let i = 0; i < offset; i++) {
                            html += `<div class="inst-cal-cell muted"></div>`;
                        }

                        for (let d = 1; d <= diasMes; d++) {
                            const tieneClase = diasConClase.has(d);
                            let dotHtml = tieneClase ? `<div class="inst-cal-dot green"></div>` : `<div class="inst-cal-dot" style="background:transparent;"></div>`;
                            html += `<div class="inst-cal-cell" id="inst-cal-cell-${d}" onclick="seleccionarDiaInst(${d}, this)">
                                        ${d} ${dotHtml}
                                     </div>`;
                        }
                        
                        calBody.innerHTML = html;
                        
                        // Autoseleccionar
                        if (esMesActual) {
                            const hoyCell = document.getElementById(`inst-cal-cell-${diaActual}`);
                            if(hoyCell) hoyCell.click();
                        } else if (diasConClase.size > 0) {
                            const primerDiaClase = Math.min(...Array.from(diasConClase));
                            const cell = document.getElementById(`inst-cal-cell-${primerDiaClase}`);
                            if(cell) cell.click();
                        } else {
                            const firstCell = document.getElementById(`inst-cal-cell-1`);
                            if(firstCell) firstCell.click();
                        }
                    }

                    function seleccionarDiaInst(d, element) {
                        document.querySelectorAll('.inst-cal-cell').forEach(el => el.classList.remove('active'));
                        element.classList.add('active');
                        verAgendaDiaInst(d, currentMesInst, currentAnioInst);
                    }

                    function verAgendaDiaInst(dia, mes, anio) {
                        const strMes = String(mes).padStart(2, '0');
                        const strDia = String(dia).padStart(2, '0');
                        const dateStr = `${anio}-${strMes}-${strDia}`;
                        
                        const fechaObj = new Date(`${dateStr}T00:00:00`);
                        const nombreDia = diasSemanaNombres[fechaObj.getDay()];
                        
                        document.getElementById('inst-agenda-fecha').innerText = `${nombreDia}, ${dia} de ${mesesNombresInst[mes].toLowerCase()} de ${anio}`;

                        let sesionesDia = programacionInst.filter(p => p.fecha_inicio === dateStr);
                        sesionesDia.sort((a, b) => a.hora_inicio.localeCompare(b.hora_inicio));

                        document.getElementById('inst-agenda-count').innerText = `${sesionesDia.length} Clase${sesionesDia.length !== 1 ? 's' : ''} Asignada${sesionesDia.length !== 1 ? 's' : ''}`;

                        const container = document.getElementById('inst-agenda-container');
                        
                        if (sesionesDia.length === 0) {
                            container.innerHTML = `
                                <div class="text-center py-5 text-muted">
                                    <div style="background-color: #f9fafb; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem auto;">
                                        <i class="fa-regular fa-calendar-xmark text-secondary fs-4"></i>
                                    </div>
                                    <h6 class="fw-bold mb-1">Sin clases programadas</h6>
                                    <p class="small mb-0">No tienes asignaciones para este día.</p>
                                </div>
                            `;
                            return;
                        }

                        let html = '';
                        sesionesDia.forEach(s => {
                            const horaFinStr = s.hora_fin ? s.hora_fin.substring(0,5) : '';
                            const horaIniStr = s.hora_inicio ? s.hora_inicio.substring(0,5) : '';
                            const tituloProg = programasNombresInst[s.numero_ficha] || 'Programa de Formación';
                            
                            html += `
                                <div class="inst-agenda-card shadow-sm bg-white">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="d-flex align-items-center gap-3">
                                            <span class="inst-agenda-ficha">FICHA #${s.numero_ficha}</span>
                                            <span class="inst-agenda-time"><i class="fa-regular fa-clock me-1"></i> ${horaIniStr} - ${horaFinStr}</span>
                                        </div>
                                    </div>
                                    
                                    <h5 class="fw-bold text-dark mb-1">${tituloProg}</h5>
                                    <p class="small text-secondary mb-3" style="line-height: 1.4;"><strong>RA:</strong> ${s.ra_descripcion}</p>
                                    
                                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mt-3 pt-3 border-top border-light-subtle gap-3">
                                        <div class="d-flex gap-4">
                                            <div class="small text-secondary fw-medium"><i class="fa-solid fa-location-dot me-1 text-muted"></i> Ambiente: <strong class="text-dark">${s.ambiente_nombre || 'No asignado'}</strong></div>
                                            <div class="small text-secondary fw-medium">Sesiones: <strong class="text-dark">${s.sesiones_realizadas}/${s.total_sesiones}</strong></div>
                                        </div>
                                        ${s.fecha_inicio === '<?= date('Y-m-d') ?>' ? 
                                            `<button class="inst-btn-call" onclick="window.location.hash = '#pills-inst-asistencia'; document.getElementById('id_programacion_select').value = '${s.id_programacion}'; const evt = new Event('change'); document.getElementById('id_programacion_select').dispatchEvent(evt); return false;">
                                                <i class="fa-solid fa-clipboard-user me-2"></i> Llamar Asistencia
                                            </button>`
                                        : 
                                            `<button class="inst-btn-call" style="background-color: #9ca3af; cursor: not-allowed; border-color: #9ca3af;" onclick="Swal.fire('Acceso Denegado', 'Solo puedes llamar asistencia el mismo día de la sesión programada.', 'warning'); return false;">
                                                <i class="fa-solid fa-lock me-2"></i> Asistencia Bloqueada
                                            </button>`
                                        }
                                    </div>
                                </div>
                            `;
                        });
                        
                        container.innerHTML = html;
                    }

                    function navegarMesInst(dir) {
                        currentMesInst += dir;
                        if (currentMesInst > 12) {
                            currentMesInst = 1;
                            currentAnioInst++;
                        } else if (currentMesInst < 1) {
                            currentMesInst = 12;
                            currentAnioInst--;
                        }
                        renderizarCalendarioInst(currentMesInst, currentAnioInst);
                    }

                    document.addEventListener('DOMContentLoaded', function() {
                        if (document.getElementById('inst-cal-body')) {
                            renderizarCalendarioInst(currentMesInst, currentAnioInst);
                        }
                    });
                </script>
            </div>

            <!-- PESTAÑA 1: REGISTRAR ASISTENCIA (Rediseño) -->
            <div class="tab-pane fade" id="pills-inst-asistencia" role="tabpanel" aria-labelledby="pills-inst-asistencia-tab">

                <style>
                    /* === PLANILLA DIGITAL DE ASISTENCIA — PREMIUM REDESIGN === */
                    .asi-hero {
                        background: linear-gradient(135deg, #064e3b 0%, #065f46 100%);
                        border-radius: 20px;
                        padding: 1.75rem 2rem;
                        color: #fff;
                        margin-bottom: 1.5rem;
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        gap: 1.5rem;
                        flex-wrap: wrap;
                        box-shadow: 0 8px 24px rgba(6,78,59,.18);
                        position: relative;
                        overflow: hidden;
                    }
                    .asi-hero::before {
                        content: "";
                        position: absolute;
                        top: -40px; right: -40px;
                        width: 200px; height: 200px;
                        border-radius: 50%;
                        background: radial-gradient(circle, rgba(52,211,153,.18) 0%, transparent 70%);
                        pointer-events: none;
                    }
                    .asi-hero-icon-box {
                        background: rgba(255,255,255,.12);
                        width: 52px; height: 52px;
                        border-radius: 14px;
                        display: flex; align-items: center; justify-content: center;
                        font-size: 1.4rem;
                        margin-right: 1.1rem;
                        flex-shrink: 0;
                    }
                    .asi-hero-controls { display: flex; gap: 1rem; flex-wrap: wrap; align-items: flex-end; }
                    .asi-hero-controls label { font-size: 0.62rem; font-weight: 800; letter-spacing: .6px; color: #a7f3d0; text-transform: uppercase; margin-bottom: .35rem; display: block; }
                    .asi-hero-controls select, .asi-hero-controls input[type="date"] {
                        border: none; border-radius: 10px; padding: .55rem 1rem;
                        font-size: .9rem; font-weight: 600; color: #1f2937;
                        background: #fff; min-width: 210px;
                        box-shadow: 0 2px 6px rgba(0,0,0,.08);
                    }

                    /* KPI Cards */
                    .asi-kpi-row { display: grid; grid-template-columns: repeat(4, 1fr); gap: .9rem; margin-bottom: 1.5rem; }
                    @media(max-width:767px){ .asi-kpi-row { grid-template-columns: repeat(2, 1fr); } }
                    .asi-kpi-card-new {
                        background: #fff; border-radius: 16px;
                        padding: 1.2rem 1.3rem; border: 1px solid rgba(0,0,0,.06);
                        display: flex; align-items: center; gap: 1rem;
                        box-shadow: 0 2px 8px rgba(0,0,0,.04); transition: box-shadow .2s;
                    }
                    .asi-kpi-card-new:hover { box-shadow: 0 6px 18px rgba(0,0,0,.08); }
                    .asi-kpi-icon-new {
                        width: 46px; height: 46px; border-radius: 50%;
                        display: flex; align-items: center; justify-content: center; font-size: 1.2rem; flex-shrink: 0;
                    }
                    .asi-kpi-icon-new.total    { background: #e0f2fe; color: #0284c7; }
                    .asi-kpi-icon-new.present  { background: #dcfce7; color: #16a34a; }
                    .asi-kpi-icon-new.absent   { background: #ffedd5; color: #ea580c; }
                    .asi-kpi-icon-new.pending  { background: #f3e8ff; color: #9333ea; }
                    .asi-kpi-val  { font-size: 1.65rem; font-weight: 800; color: #111827; line-height: 1; }
                    .asi-kpi-lbl  { font-size: .78rem; color: #4b5563; font-weight: 600; margin-top: .15rem; }
                    .asi-kpi-sub2  { font-size: .68rem; color: #9ca3af; }

                    /* Main card panels */
                    .asi-panel-new {
                        background: #fff; border-radius: 18px;
                        padding: 1.5rem; border: 1px solid rgba(0,0,0,.06);
                        box-shadow: 0 2px 10px rgba(0,0,0,.04);
                    }
                    .asi-thead2 { display: flex; align-items: center; padding: .5rem 0 .75rem; border-bottom: 2px solid #f3f4f6; margin-bottom: .75rem; }
                    .asi-thead2 span { font-size: .7rem; font-weight: 800; color: #9ca3af; text-transform: uppercase; letter-spacing: .5px; }

                    /* Student row */
                    .asi-row {
                        display: flex; align-items: center;
                        padding: .85rem 1rem; border-radius: 12px;
                        border: 1px solid #f3f4f6; margin-bottom: .4rem;
                        background: #fff; transition: border-color .18s, box-shadow .18s;
                        gap: .75rem;
                    }
                    .asi-row:hover { border-color: #d1fae5; box-shadow: 0 4px 12px rgba(0,0,0,.05); }
                    .asi-row-num { width: 36px; text-align: center; font-size: .85rem; font-weight: 700; color: #9ca3af; flex-shrink: 0; }
                    .asi-row-name { flex: 2; }
                    .asi-row-name strong { font-size: .9rem; font-weight: 700; color: #111827; display: block; }
                    .asi-row-doc { flex: 1; font-size: .8rem; color: #6b7280; font-weight: 500; }
                    .asi-row-action { width: 110px; display: flex; justify-content: center; flex-shrink: 0; }

                    /* Toggle button */
                    .asi-btn-estado {
                        width: 34px; height: 34px; border-radius: 50%;
                        border: none; cursor: pointer; font-weight: 700; font-size: .95rem;
                        display: flex; align-items: center; justify-content: center;
                        transition: all .18s;
                    }
                    .asi-btn-estado.pendiente { background: #f3f4f6; color: #9ca3af; border: 1.5px dashed #d1d5db; }
                    .asi-btn-estado.presente  { background: #10b981; color: #fff; box-shadow: 0 2px 8px rgba(16,185,129,.35); }
                    .asi-btn-estado.ausente   { background: #ef4444; color: #fff; box-shadow: 0 2px 8px rgba(239,68,68,.35); }

                    /* Legend dots */
                    .asi-dot { width: 8px; height: 8px; border-radius: 50%; display: inline-block; margin-right: .4rem; }
                    .asi-dot.presente { background: #10b981; }
                    .asi-dot.ausente  { background: #ef4444; }
                    .asi-dot.pendiente{ background: #f59e0b; }

                    /* Sidebar action buttons */
                    .asi-action-btn {
                        display: flex; align-items: center; justify-content: center; gap: .5rem;
                        padding: .65rem 1rem; border-radius: 10px; font-size: .85rem; font-weight: 600;
                        border: 1.5px solid; cursor: pointer; width: 100%; transition: all .18s; background: none;
                    }
                    .asi-action-btn.success { border-color: #86efac; color: #16a34a; background: #f0fdf4; }
                    .asi-action-btn.success:hover { background: #dcfce7; }
                    .asi-action-btn.danger  { border-color: #fca5a5; color: #dc2626; background: #fef2f2; }
                    .asi-action-btn.danger:hover  { background: #fee2e2; }
                    .asi-action-btn.neutral { border-color: #e5e7eb; color: #6b7280; background: #fff; }
                    .asi-action-btn.neutral:hover { background: #f9fafb; }

                    /* Save button */
                    .asi-save-btn {
                        background: #16a34a; color: #fff; font-weight: 700; font-size: .95rem;
                        border: none; border-radius: 12px; padding: .9rem 1.5rem;
                        width: 100%; cursor: pointer; display: flex; align-items: center;
                        justify-content: center; gap: .6rem; transition: background .2s, box-shadow .2s;
                        box-shadow: 0 4px 14px rgba(22,163,74,.3);
                    }
                    .asi-save-btn:hover { background: #15803d; box-shadow: 0 6px 20px rgba(22,163,74,.4); }

                    /* Info table */
                    .asi-info-tbl td { padding: .35rem .25rem; font-size: .82rem; vertical-align: middle; border: none; }
                    .asi-info-tbl td:first-child { color: #6b7280; font-weight: 600; width: 45%; }
                    .asi-info-tbl td:last-child { color: #111827; font-weight: 600; text-align: right; }
                </style>

                <form action="<?= URLROOT; ?>/index.php?route=asistencias/guardarPlanilla" method="POST" id="formAsistenciaDigital">

                    <!-- ① HERO BANNER -->
                    <div class="asi-hero">
                        <div class="d-flex align-items-center">
                            <div class="asi-hero-icon-box"><i class="fa-solid fa-clipboard-user"></i></div>
                            <div>
                                <h4 class="fw-bold mb-1" style="font-size:1.2rem;">Planilla Digital de Asistencia</h4>
                                <p class="mb-0" style="color:#a7f3d0;font-size:.85rem;">Gestiona la asistencia de los aprendices de manera rápida y sencilla.</p>
                            </div>
                        </div>
                        <div class="asi-hero-controls">
                            <div>
                                <label>Sesión Programada</label>
                                <select name="id_programacion" id="id_programacion_select" required>
                                    <option value="">Seleccione una sesión...</option>
                                    <?php if (!empty($programacion)): ?>
                                        <?php foreach ($programacion as $prog): ?>
                                            <option value="<?= $prog->id_programacion; ?>"
                                                data-desc="<?= htmlspecialchars($prog->nombre_programa ?? 'Programa de Formación'); ?>"
                                                data-amb="<?= htmlspecialchars($prog->id_numero_ambiente ?? 'Sin Asignar'); ?>"
                                                data-hora="<?= htmlspecialchars($prog->hora_inicio ?? '00:00') . ' - ' . htmlspecialchars($prog->hora_fin ?? '00:00'); ?>"
                                                data-jornada="<?= htmlspecialchars($prog->jornada ?? 'Diurna'); ?>"
                                                data-fecha="<?= htmlspecialchars($prog->fecha_inicio ?? date('Y-m-d')); ?>">
                                                <?= htmlspecialchars(date('d/m/Y', strtotime($prog->fecha_inicio)) . ' - ' . ($prog->nombre_dia ?? 'Sesión') . ' ' . substr($prog->hora_inicio ?? '00:00', 0, 5) . ' - Ficha ' . $prog->numero_ficha . ' - RAP ' . ($prog->ra_codigo ?? '')); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div>
                                <label>Fecha de Sesión</label>
                                <input type="date" name="fecha_asistencia" id="fecha_asistencia_input" value="<?= date('Y-m-d'); ?>" required readonly>
                            </div>
                        </div>
                    </div>

                    <!-- ② KPI CARDS -->
                    <div class="asi-kpi-row">
                        <div class="asi-kpi-card-new">
                            <div class="asi-kpi-icon-new total"><i class="fa-solid fa-users"></i></div>
                            <div>
                                <div class="asi-kpi-val"><span id="kpi-total-val">0</span> <span style="font-size:.95rem;color:#9ca3af;">/ 0</span></div>
                                <div class="asi-kpi-lbl">Aprendices registrados</div>
                                <div class="asi-kpi-sub2"><span id="kpi-total-pct">0</span>% del total</div>
                            </div>
                        </div>
                        <div class="asi-kpi-card-new">
                            <div class="asi-kpi-icon-new present"><i class="fa-solid fa-check"></i></div>
                            <div>
                                <div class="asi-kpi-val" id="kpi-presentes-val">0</div>
                                <div class="asi-kpi-lbl">Asistieron</div>
                                <div class="asi-kpi-sub2"><span id="kpi-presentes-pct">0</span>% del total</div>
                            </div>
                        </div>
                        <div class="asi-kpi-card-new">
                            <div class="asi-kpi-icon-new absent"><i class="fa-solid fa-face-frown-open"></i></div>
                            <div>
                                <div class="asi-kpi-val" id="kpi-ausentes-val">0</div>
                                <div class="asi-kpi-lbl">No asistieron</div>
                                <div class="asi-kpi-sub2"><span id="kpi-ausentes-pct">0</span>% del total</div>
                            </div>
                        </div>
                        <div class="asi-kpi-card-new">
                            <div class="asi-kpi-icon-new pending"><i class="fa-solid fa-clipboard-list"></i></div>
                            <div>
                                <div class="asi-kpi-val" id="kpi-pendientes-val">–</div>
                                <div class="asi-kpi-lbl">Pendientes</div>
                                <div class="asi-kpi-sub2">Por marcar</div>
                            </div>
                        </div>
                    </div>

                    <!-- ③ MAIN CONTENT -->
                    <div class="row g-4 mb-4">

                        <!-- LEFT: Student List -->
                        <div class="col-12 col-lg-8">
                            <div class="asi-panel-new h-100 d-flex flex-column">

                                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
                                    <div>
                                        <h6 class="fw-bold text-dark mb-1" style="font-size:.95rem;">
                                            <i class="fa-solid fa-users me-2 text-success"></i> Planilla de Aprendices
                                        </h6>
                                        <p class="text-muted small mb-0">Marca la asistencia de cada aprendiz</p>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <div class="input-group input-group-sm" style="max-width:200px;">
                                            <span class="input-group-text bg-white border-end-0" style="border-radius:8px 0 0 8px;">
                                                <i class="fa-solid fa-magnifying-glass text-muted" style="font-size:.75rem;"></i>
                                            </span>
                                            <input type="text" id="buscadorAprendices" class="form-control border-start-0 ps-0" placeholder="Buscar aprendiz..." style="border-radius:0 8px 8px 0;">
                                        </div>
                                        <button type="button" class="btn btn-outline-secondary btn-sm d-flex align-items-center gap-1 px-3" style="border-radius:8px;font-size:.82rem;">
                                            <i class="fa-solid fa-filter"></i> Filtros
                                        </button>
                                    </div>
                                </div>

                                <div class="asi-thead2">
                                    <span style="width:36px;text-align:center;">#</span>
                                    <span style="flex:2;padding-left:.5rem;">Aprendiz</span>
                                    <span style="flex:1;">Documento</span>
                                    <span style="width:110px;text-align:center;">Estado</span>
                                </div>

                                <div id="listaAprendicesContainer" class="flex-grow-1" style="min-height:230px;">
                                    <div class="d-flex flex-column align-items-center justify-content-center text-center py-5 text-muted h-100">
                                        <svg width="90" height="90" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg" class="mb-3 opacity-60">
                                            <rect x="18" y="8" width="46" height="58" rx="5" fill="#e5e7eb"/>
                                            <rect x="23" y="16" width="36" height="4" rx="2" fill="#d1d5db"/>
                                            <rect x="23" y="24" width="28" height="4" rx="2" fill="#d1d5db"/>
                                            <rect x="23" y="32" width="32" height="4" rx="2" fill="#d1d5db"/>
                                            <rect x="23" y="40" width="20" height="4" rx="2" fill="#d1d5db"/>
                                            <circle cx="62" cy="58" r="18" fill="#f3f4f6" stroke="#d1d5db" stroke-width="2"/>
                                            <circle cx="62" cy="58" r="11" fill="none" stroke="#9ca3af" stroke-width="2.5"/>
                                            <line x1="70" y1="66" x2="78" y2="74" stroke="#9ca3af" stroke-width="3" stroke-linecap="round"/>
                                        </svg>
                                        <p class="fw-bold text-dark mb-1" style="font-size:.9rem;">No hay aprendices registrados en esta sesión</p>
                                        <p class="small mb-0">Los aprendices aparecerán aquí cuando la sesión tenga aprendices asignados.</p>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-center gap-4 mt-4 pt-3 border-top text-muted small fw-medium">
                                    <span><span class="asi-dot presente"></span> Asistió</span>
                                    <span><span class="asi-dot ausente"></span> No asistió</span>
                                    <span><span class="asi-dot pendiente"></span> Pendiente</span>
                                </div>
                            </div>
                        </div>

                        <!-- RIGHT: Sidebar -->
                        <div class="col-12 col-lg-4">

                            <div class="asi-panel-new mb-3">
                                <h6 class="fw-bold text-dark mb-3" style="font-size:.9rem;">
                                    <i class="fa-solid fa-bolt text-warning me-2"></i> Acciones Rápidas
                                </h6>
                                <div class="d-grid gap-2">
                                    <button type="button" class="asi-action-btn success" onclick="marcarTodos('presente')">
                                        <i class="fa-solid fa-check"></i> Marcar todos como asistieron
                                    </button>
                                    <button type="button" class="asi-action-btn danger" onclick="marcarTodos('ausente')">
                                        <i class="fa-solid fa-xmark"></i> Marcar todos como no asistieron
                                    </button>
                                    <button type="button" class="asi-action-btn neutral" onclick="marcarTodos('pendiente')">
                                        <i class="fa-solid fa-rotate-right"></i> Limpiar planilla
                                    </button>
                                </div>
                            </div>

                            <div class="asi-panel-new mb-3">
                                <h6 class="fw-bold text-dark mb-3" style="font-size:.9rem;">
                                    <i class="fa-regular fa-calendar text-success me-2"></i> Información de la Sesión
                                </h6>
                                <table class="asi-info-tbl w-100">
                                    <tbody>
                                        <tr><td>Programa:</td><td id="info-prog">-</td></tr>
                                        <tr><td>Ambiente:</td><td id="info-amb">-</td></tr>
                                        <tr><td>Hora:</td><td id="info-hora">-</td></tr>
                                        <tr><td>Instructor:</td><td><?= htmlspecialchars($_SESSION['user_name'] ?? 'Instructor'); ?></td></tr>
                                        <tr><td>Jornada:</td><td><span class="badge bg-success-subtle text-success rounded-pill px-2" id="info-jor">-</span></td></tr>
                                    </tbody>
                                </table>
                            </div>

                            <button type="submit" class="asi-save-btn">
                                <i class="fa-regular fa-floppy-disk"></i> Guardar Planilla de Asistencia
                            </button>

                        </div>
                    </div>

                    <!-- ④ FOOTER TIP -->
                    <div class="d-flex align-items-center gap-2 py-2 px-3 rounded-3 shadow-sm"
                         style="background:#eff6ff;border:1px solid #bfdbfe;color:#1d4ed8;font-size:.83rem;">
                        <i class="fa-solid fa-circle-info"></i>
                        Recuerda que puedes marcar la asistencia individualmente o usar las acciones rápidas para agilizar el proceso.
                    </div>

                    <!-- ⑤ JS LOGIC (unchanged) -->
                    <script>
                        const aprendicesPorProgramacion = <?= isset($aprendicesPorProgramacion) ? $aprendicesPorProgramacion : '{}'; ?>;
                        const listaContainer = document.getElementById('listaAprendicesContainer');
                        const selectProgramacion = document.getElementById('id_programacion_select');
                        const fechaAsistenciaInput = document.getElementById('fecha_asistencia_input');
                        const buscador = document.getElementById('buscadorAprendices');
                        let currentAprendices = [];

                        function renderizarKPIs() {
                            const total = currentAprendices.length;
                            document.getElementById('kpi-total-val').innerText = total;
                            document.getElementById('kpi-total-val').nextElementSibling.innerText = `/ ${total}`;

                            if (total === 0) {
                                document.getElementById('kpi-presentes-val').innerText = '0';
                                document.getElementById('kpi-presentes-pct').innerText = '0';
                                document.getElementById('kpi-ausentes-val').innerText = '0';
                                document.getElementById('kpi-ausentes-pct').innerText = '0';
                                document.getElementById('kpi-pendientes-val').innerText = '–';
                                return;
                            }

                            const btns = listaContainer.querySelectorAll('.asi-btn-estado');
                            let presentes = 0, ausentes = 0, pendientes = 0;
                            btns.forEach(btn => {
                                if (btn.classList.contains('presente')) presentes++;
                                else if (btn.classList.contains('ausente')) ausentes++;
                                else pendientes++;
                            });

                            document.getElementById('kpi-presentes-val').innerText = presentes;
                            document.getElementById('kpi-presentes-pct').innerText = Math.round((presentes / total) * 100);
                            document.getElementById('kpi-ausentes-val').innerText = ausentes;
                            document.getElementById('kpi-ausentes-pct').innerText = Math.round((ausentes / total) * 100);
                            document.getElementById('kpi-pendientes-val').innerText = pendientes > 0 ? pendientes : '–';
                        }

                        selectProgramacion.addEventListener('change', function () {
                            const idProg = this.value;
                            listaContainer.innerHTML = '';

                            if (!idProg || !aprendicesPorProgramacion[idProg] || aprendicesPorProgramacion[idProg].length === 0) {
                                currentAprendices = [];
                                listaContainer.innerHTML = `
                                    <div class="d-flex flex-column align-items-center justify-content-center text-center py-5 text-muted h-100">
                                        <svg width="90" height="90" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg" class="mb-3 opacity-60">
                                            <rect x="18" y="8" width="46" height="58" rx="5" fill="#e5e7eb"/>
                                            <rect x="23" y="16" width="36" height="4" rx="2" fill="#d1d5db"/>
                                            <rect x="23" y="24" width="28" height="4" rx="2" fill="#d1d5db"/>
                                            <rect x="23" y="32" width="32" height="4" rx="2" fill="#d1d5db"/>
                                            <rect x="23" y="40" width="20" height="4" rx="2" fill="#d1d5db"/>
                                            <circle cx="62" cy="58" r="18" fill="#f3f4f6" stroke="#d1d5db" stroke-width="2"/>
                                            <circle cx="62" cy="58" r="11" fill="none" stroke="#9ca3af" stroke-width="2.5"/>
                                            <line x1="70" y1="66" x2="78" y2="74" stroke="#9ca3af" stroke-width="3" stroke-linecap="round"/>
                                        </svg>
                                        <p class="fw-bold text-dark mb-1" style="font-size:.9rem;">No hay aprendices registrados en esta sesión</p>
                                        <p class="small mb-0">Los aprendices aparecerán aquí cuando la sesión tenga aprendices asignados.</p>
                                    </div>`;
                                renderizarKPIs();
                                document.getElementById('info-prog').innerText = '-';
                                document.getElementById('info-amb').innerText = '-';
                                document.getElementById('info-hora').innerText = '-';
                                document.getElementById('info-jor').innerText = '-';
                                if (fechaAsistenciaInput) fechaAsistenciaInput.value = '<?= date('Y-m-d'); ?>';
                                return;
                            }

                            const option = this.options[this.selectedIndex];
                            const fechaSesion = option.getAttribute('data-fecha');
                            const fechaActual = '<?= date('Y-m-d') ?>';

                            if (fechaSesion !== fechaActual) {
                                Swal.fire('Acceso Denegado', 'La asistencia solo puede tomarse en la fecha exacta de la sesión (' + fechaSesion + ').', 'warning');
                                this.value = '';
                                const evt = new Event('change');
                                this.dispatchEvent(evt);
                                return;
                            }

                            document.getElementById('info-prog').innerText = option.getAttribute('data-desc') || 'Programa Técnico';
                            document.getElementById('info-amb').innerText = option.getAttribute('data-amb') ? `Ambiente ${option.getAttribute('data-amb')}` : 'Sin Asignar';
                            document.getElementById('info-hora').innerText = option.getAttribute('data-hora') || '00:00 - 00:00';
                            document.getElementById('info-jor').innerText = option.getAttribute('data-jornada') || 'Diurna';
                            if (fechaAsistenciaInput) fechaAsistenciaInput.value = fechaSesion || '<?= date('Y-m-d'); ?>';

                            currentAprendices = aprendicesPorProgramacion[idProg];
                            renderizarListaAsistencia(currentAprendices);
                        });

                        function renderizarListaAsistencia(aprendices) {
                            if (aprendices.length === 0) {
                                listaContainer.innerHTML = `<div class="text-center py-4 text-muted"><p class="fw-medium mb-0">No se encontraron aprendices con ese criterio.</p></div>`;
                                return;
                            }
                            let html = '';
                            aprendices.forEach((apr, index) => {
                                html += `
                                    <div class="asi-row" data-nombre="${apr.nombre} ${apr.apellido}">
                                        <div class="asi-row-num">${index + 1}</div>
                                        <div class="asi-row-name">
                                            <strong>${apr.nombre} ${apr.apellido}</strong>
                                            <div class="d-none d-md-block mt-1">
                                                <input type="text" name="asistencia[${apr.id_usuario}][observacion]"
                                                    class="form-control form-control-sm shadow-none"
                                                    style="border:1px solid #f3f4f6;border-radius:6px;font-size:.72rem;"
                                                    placeholder="Agregar observación, incapacidad o excusa médica...">
                                            </div>
                                        </div>
                                        <div class="asi-row-doc">${apr.documento || 'N/A'}</div>
                                        <div class="asi-row-action">
                                            <input type="hidden" name="asistencia[${apr.id_usuario}][estado]" id="estado_apr_${apr.id_usuario}" value="">
                                            <button type="button" class="asi-btn-estado pendiente shadow-sm"
                                                onclick="toggleEstadoAsistencia(this, 'estado_apr_${apr.id_usuario}')">–</button>
                                        </div>
                                    </div>`;
                            });
                            listaContainer.innerHTML = html;
                            renderizarKPIs();
                        }

                        buscador.addEventListener('input', function (e) {
                            const term = e.target.value.toLowerCase();
                            listaContainer.querySelectorAll('.asi-row').forEach(item => {
                                item.style.display = item.getAttribute('data-nombre').toLowerCase().includes(term) ? 'flex' : 'none';
                            });
                        });

                        function toggleEstadoAsistencia(btn, hiddenId) {
                            const h = document.getElementById(hiddenId);
                            if (h.value === "") {
                                h.value = "1"; btn.className = "asi-btn-estado presente shadow-sm";
                                btn.innerHTML = '<i class="fa-solid fa-check"></i>';
                            } else if (h.value === "1") {
                                h.value = "0"; btn.className = "asi-btn-estado ausente shadow-sm";
                                btn.innerHTML = '<i class="fa-solid fa-xmark"></i>';
                            } else {
                                h.value = ""; btn.className = "asi-btn-estado pendiente shadow-sm";
                                btn.innerHTML = '–';
                            }
                            renderizarKPIs();
                        }

                        function marcarTodos(estado) {
                            if (currentAprendices.length === 0) return;
                            listaContainer.querySelectorAll('.asi-btn-estado').forEach(btn => {
                                const h = btn.previousElementSibling;
                                if (estado === 'presente') {
                                    h.value = "1"; btn.className = "asi-btn-estado presente shadow-sm";
                                    btn.innerHTML = '<i class="fa-solid fa-check"></i>';
                                } else if (estado === 'ausente') {
                                    h.value = "0"; btn.className = "asi-btn-estado ausente shadow-sm";
                                    btn.innerHTML = '<i class="fa-solid fa-xmark"></i>';
                                } else {
                                    h.value = ""; btn.className = "asi-btn-estado pendiente shadow-sm";
                                    btn.innerHTML = '–';
                                }
                            });
                            renderizarKPIs();
                        }

                        document.getElementById('formAsistenciaDigital').addEventListener('submit', function (e) {
                            if (currentAprendices.length === 0) {
                                e.preventDefault();
                                alert("No hay aprendices registrados para enviar la planilla.");
                                return;
                            }
                            const pendings = listaContainer.querySelectorAll('.asi-btn-estado.pendiente');
                            if (pendings.length > 0) {
                                if (!confirm("Hay " + pendings.length + " aprendiz/ces marcados como 'Pendiente'. El sistema los guardará como 'Falla'. ¿Deseas continuar?")) {
                                    e.preventDefault();
                                }
                            }
                        });
                    </script>
                </form>

            </div>
            <!-- PESTAÑA 3: REPORTAR NOVEDAD DE AMBIENTE -->
            <div class="tab-pane fade" id="pills-inst-novedad" role="tabpanel" aria-labelledby="pills-inst-novedad-tab">
                <style>
                    .nov-report-shell {
                        margin: 0;
                    }
                    .nov-report-hero {
                        position: relative;
                        overflow: hidden;
                        background: linear-gradient(135deg, #064e3b 0%, #065f46 100%);
                        color: #fff;
                        border-radius: 20px;
                        padding: 1.75rem 2rem;
                        min-height: 150px;
                        display: flex;
                        align-items: center;
                        justify-content: space-between;
                        gap: 1.5rem;
                        flex-wrap: wrap;
                        box-shadow: 0 8px 24px rgba(6, 78, 59, 0.18);
                    }
                    .nov-report-hero::before {
                        content: "";
                        position: absolute;
                        top: -40px;
                        right: -40px;
                        width: 200px;
                        height: 200px;
                        border-radius: 50%;
                        background: radial-gradient(circle, rgba(52, 211, 153, 0.18) 0%, transparent 70%);
                        pointer-events: none;
                    }
                    .nov-report-hero > * {
                        position: relative;
                        z-index: 1;
                    }
                    .nov-report-breadcrumb {
                        display: flex;
                        align-items: center;
                        gap: 0.55rem;
                        color: rgba(255, 255, 255, 0.82);
                        font-weight: 700;
                        font-size: 0.9rem;
                        margin-bottom: 1.2rem;
                    }
                    .nov-report-hero h2 {
                        font-size: clamp(1.55rem, 2.8vw, 2.45rem);
                        font-weight: 800;
                        margin: 0 0 0.65rem;
                        letter-spacing: 0;
                    }
                    .nov-report-hero p {
                        color: rgba(255, 255, 255, 0.82);
                        font-size: 1rem;
                        margin: 0;
                        max-width: 760px;
                    }
                    .nov-report-visual {
                        width: 132px;
                        height: 120px;
                        min-width: 132px;
                        position: relative;
                    }
                    .nov-clipboard {
                        position: absolute;
                        inset: 10px 28px 10px 6px;
                        background: #f8fafc;
                        border-radius: 14px;
                        transform: rotate(8deg);
                        box-shadow: 0 16px 28px rgba(0, 0, 0, 0.22);
                    }
                    .nov-clipboard::before {
                        content: "";
                        position: absolute;
                        top: -12px;
                        left: 32px;
                        width: 48px;
                        height: 24px;
                        border-radius: 12px 12px 8px 8px;
                        background: #8bd450;
                    }
                    .nov-clipboard span {
                        display: block;
                        height: 7px;
                        margin: 18px 18px 0;
                        border-radius: 999px;
                        background: #d7dee8;
                    }
                    .nov-clipboard span:first-child {
                        width: 18px;
                        background: #39a900;
                    }
                    .nov-alert-mark {
                        position: absolute;
                        right: 4px;
                        bottom: 7px;
                        width: 78px;
                        height: 68px;
                        background: #39a900;
                        clip-path: polygon(50% 0, 100% 100%, 0 100%);
                        display: flex;
                        align-items: flex-end;
                        justify-content: center;
                        padding-bottom: 10px;
                        color: #fff;
                        font-weight: 900;
                        font-size: 2.05rem;
                        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
                    }
                    .nov-report-card {
                        background: #fff;
                        border: 1px solid rgba(15, 23, 42, 0.06);
                        border-radius: 8px;
                        box-shadow: 0 20px 60px rgba(15, 23, 42, 0.08);
                        padding: 2rem;
                        margin-top: 1.5rem;
                    }
                    .nov-report-titlebar {
                        display: flex;
                        align-items: center;
                        gap: 1rem;
                        padding-bottom: 1.55rem;
                        margin-bottom: 1.55rem;
                        border-bottom: 1px solid #e5e7eb;
                    }
                    .nov-title-icon {
                        width: 52px;
                        height: 52px;
                        border-radius: 8px;
                        display: grid;
                        place-items: center;
                        background: #dcfce7;
                        color: #07823d;
                        font-size: 1.35rem;
                    }
                    .nov-report-titlebar h3 {
                        margin: 0 0 0.25rem;
                        font-size: 1.15rem;
                        font-weight: 800;
                        color: #111827;
                    }
                    .nov-report-titlebar p {
                        margin: 0;
                        color: #6b7280;
                        font-size: 0.92rem;
                    }
                    .nov-field-label {
                        color: #111827;
                        font-weight: 800;
                        font-size: 0.86rem;
                        margin-bottom: 0.7rem;
                    }
                    .nov-required {
                        color: #ef4444;
                    }
                    .nov-field-wrap {
                        position: relative;
                    }
                    .nov-field-icon {
                        position: absolute;
                        top: 50%;
                        left: 1rem;
                        transform: translateY(-50%);
                        width: 38px;
                        height: 38px;
                        border-radius: 8px;
                        display: grid;
                        place-items: center;
                        background: #e9f9ef;
                        color: #087d3b;
                        pointer-events: none;
                    }
                    .nov-input,
                    .nov-select,
                    .nov-textarea {
                        width: 100%;
                        border: 1px solid #dfe4ea;
                        border-radius: 8px;
                        color: #1f2937;
                        background-color: #fff;
                        box-shadow: 0 8px 18px rgba(15, 23, 42, 0.04);
                        transition: border-color 0.2s ease, box-shadow 0.2s ease;
                    }
                    .nov-input,
                    .nov-select {
                        min-height: 58px;
                        padding: 0 1rem 0 4.05rem;
                        font-weight: 700;
                    }
                    .nov-input {
                        padding-right: 3.5rem;
                    }
                    .nov-date-input {
                        padding-left: 1rem;
                    }
                    .nov-select {
                        appearance: none;
                        background-image: linear-gradient(45deg, transparent 50%, #1f2937 50%), linear-gradient(135deg, #1f2937 50%, transparent 50%);
                        background-position: calc(100% - 22px) 25px, calc(100% - 16px) 25px;
                        background-size: 6px 6px, 6px 6px;
                        background-repeat: no-repeat;
                    }
                    .nov-date-icon {
                        position: absolute;
                        top: 50%;
                        right: 1.1rem;
                        transform: translateY(-50%);
                        color: #475569;
                        pointer-events: none;
                    }
                    .nov-input:focus,
                    .nov-select:focus,
                    .nov-textarea:focus {
                        border-color: #39a900;
                        box-shadow: 0 0 0 4px rgba(57, 169, 0, 0.13);
                        outline: none;
                    }
                    .nov-textarea {
                        min-height: 158px;
                        resize: vertical;
                        padding: 1rem 1.1rem;
                        line-height: 1.55;
                    }
                    .nov-char-count {
                        text-align: right;
                        color: #6b7280;
                        font-size: 0.82rem;
                        font-weight: 700;
                        margin-top: 0.45rem;
                    }
                    .nov-upload-zone {
                        position: relative;
                        border: 1.5px dashed #cfd7e3;
                        border-radius: 8px;
                        min-height: 138px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        padding: 1.35rem;
                        text-align: center;
                        color: #6b7280;
                        background: #fff;
                        transition: border-color 0.2s ease, background 0.2s ease;
                        cursor: pointer;
                    }
                    .nov-upload-zone:hover,
                    .nov-upload-zone.is-dragover {
                        border-color: #39a900;
                        background: #f4fbf0;
                    }
                    .nov-upload-zone input {
                        position: absolute;
                        inset: 0;
                        opacity: 0;
                        cursor: pointer;
                    }
                    .nov-upload-icon {
                        color: #087d3b;
                        font-size: 1.75rem;
                        margin-bottom: 0.45rem;
                    }
                    .nov-upload-main {
                        color: #374151;
                        font-weight: 800;
                        margin-bottom: 0.2rem;
                    }
                    .nov-upload-help {
                        font-size: 0.86rem;
                        margin-bottom: 0.35rem;
                    }
                    .nov-file-name {
                        color: #087d3b;
                        font-size: 0.82rem;
                        font-weight: 800;
                        margin-top: 0.45rem;
                    }
                    .nov-report-footer {
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        gap: 1rem;
                        margin-top: 2rem;
                    }
                    .nov-info-note {
                        display: flex;
                        align-items: center;
                        gap: 0.8rem;
                        background: #ecfdf3;
                        border: 1px solid #d8f3df;
                        color: #087d3b;
                        border-radius: 8px;
                        padding: 0.95rem 1.1rem;
                        font-weight: 700;
                        min-height: 58px;
                        flex: 1;
                    }
                    .nov-submit-btn {
                        min-height: 58px;
                        border: none;
                        border-radius: 8px;
                        padding: 0 1.65rem;
                        background: #008d3f;
                        color: #fff;
                        font-weight: 800;
                        box-shadow: 0 14px 26px rgba(0, 141, 63, 0.22);
                        display: inline-flex;
                        align-items: center;
                        justify-content: center;
                        gap: 0.75rem;
                        white-space: nowrap;
                    }
                    .nov-submit-btn:hover {
                        background: #007832;
                    }
                    @media (max-width: 768px) {
                        .nov-report-shell {
                            margin: 0;
                        }
                        .nov-report-hero {
                            padding: 1.35rem;
                            align-items: flex-start;
                        }
                        .nov-report-visual {
                            display: none;
                        }
                        .nov-report-card {
                            padding: 1.25rem;
                        }
                        .nov-report-footer {
                            flex-direction: column;
                            align-items: stretch;
                        }
                        .nov-submit-btn {
                            width: 100%;
                        }
                    }
                </style>

                <div class="nov-report-shell">
                    <section class="nov-report-hero" aria-labelledby="nov-report-title">
                        <div>
                            <div class="nov-report-breadcrumb">
                                <i class="fa-solid fa-house"></i>
                                <i class="fa-solid fa-chevron-right" style="font-size: 0.72rem;"></i>
                                <span>Reportar novedad</span>
                            </div>
                            <h2 id="nov-report-title">Reportar Incidencia o Falla física</h2>
                            <p>Reporta problemas de infraestructura o equipos para su gestión y seguimiento.</p>
                        </div>
                        <div class="nov-report-visual" aria-hidden="true">
                            <div class="nov-clipboard">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                            <div class="nov-alert-mark">!</div>
                        </div>
                    </section>

                    <section class="nov-report-card">
                        <form action="<?= URLROOT; ?>/index.php?route=ambientes/guardarNovedad" method="POST" enctype="multipart/form-data" id="formReportarNovedad">
                            <div class="nov-report-titlebar">
                                <div class="nov-title-icon"><i class="fa-regular fa-clipboard"></i></div>
                                <div>
                                    <h3>Información del Reporte</h3>
                                    <p>Completa los datos para registrar la incidencia o falla.</p>
                                </div>
                            </div>

                            <div class="row g-4 mb-4">
                                <div class="col-12 col-lg-7">
                                    <label class="nov-field-label" for="nov_ambiente">Ambiente Físico <span class="nov-required">*</span></label>
                                    <div class="nov-field-wrap">
                                        <span class="nov-field-icon"><i class="fa-regular fa-building"></i></span>
                                        <select name="id_numero_ambiente" id="nov_ambiente" class="nov-select" required>
                                            <option value="">Seleccione un ambiente...</option>
                                            <?php if (!empty($ambientes)): ?>
                                                <?php foreach ($ambientes as $amb): ?>
                                                    <option value="<?= $amb->id_numero_ambiente; ?>">Ambiente <?= $amb->id_numero_ambiente; ?> - <?= htmlspecialchars($amb->nombre); ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-5">
                                    <label class="nov-field-label" for="nov_fecha">Fecha del Reporte <span class="nov-required">*</span></label>
                                    <div class="nov-field-wrap">
                                        <input type="date" name="fecha_reporte" id="nov_fecha" class="nov-input nov-date-input" value="<?= date('Y-m-d'); ?>" required>
                                        <span class="nov-date-icon"><i class="fa-regular fa-calendar"></i></span>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="nov-field-label" for="nov_descripcion">Descripción detallada del suceso <span class="nov-required">*</span></label>
                                <textarea name="descripcion" id="nov_descripcion" rows="6" maxlength="1000" class="nov-textarea" placeholder="Describe el daño o anomalía de forma clara y detallada.&#10;&#10;Ejemplo: El cable de conexión de red del Smart TV está cortado o no hay señal en el tablero digital." required></textarea>
                                <div class="nov-char-count"><span id="nov_desc_count">0</span> / 1000 caracteres</div>
                            </div>

                            <div class="mb-4">
                                <label class="nov-field-label" for="nov_evidencia">Adjuntar evidencia <span class="fw-semibold text-secondary">(opcional)</span></label>
                                <label class="nov-upload-zone" id="novUploadZone" for="nov_evidencia">
                                    <input type="file" name="evidencia" id="nov_evidencia" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">
                                    <span>
                                        <div class="nov-upload-icon"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                                        <div class="nov-upload-main">Arrastra y suelta archivos aquí</div>
                                        <div class="nov-upload-help">o selecciona un archivo desde tu dispositivo</div>
                                        <div class="small fw-semibold text-secondary">Formatos permitidos: JPG, PNG, WEBP &nbsp;•&nbsp; Tamaño máximo: 10MB</div>
                                        <div class="nov-file-name" id="novFileName"></div>
                                    </span>
                                </label>
                            </div>

                            <div class="nov-report-footer">
                                <div class="nov-info-note">
                                    <i class="fa-solid fa-circle-info"></i>
                                    <span>Tu reporte será notificado al coordinador académico para su revisión y gestión.</span>
                                </div>
                                <button type="submit" class="nov-submit-btn">
                                    <i class="fa-regular fa-paper-plane"></i>
                                    <span>Registrar y Notificar Incidencia</span>
                                </button>
                            </div>
                        </form>
                    </section>
                </div>

                <script>
                    (function () {
                        const descripcion = document.getElementById('nov_descripcion');
                        const contador = document.getElementById('nov_desc_count');
                        const evidencia = document.getElementById('nov_evidencia');
                        const uploadZone = document.getElementById('novUploadZone');
                        const fileName = document.getElementById('novFileName');
                        const maxFileSize = 10 * 1024 * 1024;
                        const allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];

                        if (descripcion && contador) {
                            const updateCount = () => {
                                contador.textContent = descripcion.value.length;
                            };
                            descripcion.addEventListener('input', updateCount);
                            updateCount();
                        }

                        function clearFile(message) {
                            if (evidencia) evidencia.value = '';
                            if (fileName) fileName.textContent = message || '';
                        }

                        if (evidencia && fileName) {
                            evidencia.addEventListener('change', function () {
                                const file = this.files && this.files[0] ? this.files[0] : null;
                                if (!file) {
                                    clearFile('');
                                    return;
                                }
                                if (!allowedTypes.includes(file.type)) {
                                    clearFile('Formato no permitido. Usa JPG, PNG o WEBP.');
                                    return;
                                }
                                if (file.size > maxFileSize) {
                                    clearFile('El archivo supera el tamaño máximo de 10MB.');
                                    return;
                                }
                                fileName.textContent = file.name;
                            });
                        }

                        if (uploadZone) {
                            ['dragenter', 'dragover'].forEach(eventName => {
                                uploadZone.addEventListener(eventName, function (event) {
                                    event.preventDefault();
                                    uploadZone.classList.add('is-dragover');
                                });
                            });
                            ['dragleave', 'drop'].forEach(eventName => {
                                uploadZone.addEventListener(eventName, function (event) {
                                    event.preventDefault();
                                    uploadZone.classList.remove('is-dragover');
                                });
                            });
                        }
                    })();
                </script>

            </div>

        </div>

    <?php else: ?>
        <!-- PORTAL DEL APRENDIZ -->

        <?php
        $aprProgramacion = $programacion ?? [];
        $aprAsistenciasResumen = $asistencias ?? [];
        $aprTotalClases = count($aprProgramacion);
        $aprFichasUnicas = [];
        $aprSesionesRealizadas = 0;
        $aprTotalSesiones = 0;
        $aprProximaClase = null;
        $aprHoy = date('Y-m-d');

        foreach ($aprProgramacion as $prog) {
            if (!empty($prog->numero_ficha)) {
                $aprFichasUnicas[(string) $prog->numero_ficha] = true;
            }

            $aprSesionesRealizadas += (int) ($prog->sesiones_realizadas ?? 0);
            $aprTotalSesiones += (int) ($prog->total_sesiones ?? 0);

            $fechaProg = $prog->fecha_inicio ?? null;
            if ($fechaProg && $fechaProg >= $aprHoy) {
                $horaProg = $prog->hora_inicio ?? '00:00:00';
                $fechaHoraProg = $fechaProg . ' ' . $horaProg;
                $fechaHoraActual = $aprProximaClase
                    ? (($aprProximaClase->fecha_inicio ?? '9999-12-31') . ' ' . ($aprProximaClase->hora_inicio ?? '23:59:59'))
                    : null;

                if ($aprProximaClase === null || $fechaHoraProg < $fechaHoraActual) {
                    $aprProximaClase = $prog;
                }
            }
        }

        if ($aprProximaClase === null && !empty($aprProgramacion)) {
            $aprProximaClase = $aprProgramacion[0];
        }

        $aprFichasKeys = array_keys($aprFichasUnicas);
        $aprTotalFichas = count($aprFichasKeys);
        $aprFichaPrincipal = $aprFichasKeys[0] ?? 'Sin ficha';
        $aprProgramaPrincipal = $aprProximaClase
            ? ($programas_fichas[$aprProximaClase->numero_ficha] ?? 'Programa de Formación')
            : 'Programa de Formación';
        $aprTotalRegistros = count($aprAsistenciasResumen);
        $aprAsistidas = 0;
        $aprFallas = 0;

        foreach ($aprAsistenciasResumen as $asistResumen) {
            if ((int) ($asistResumen->asistio ?? 0) === 1) {
                $aprAsistidas++;
            } else {
                $aprFallas++;
            }
        }

        $aprTasaAsistencia = $aprTotalRegistros > 0 ? round(($aprAsistidas / $aprTotalRegistros) * 100) : 0;
        $aprCumplimientoSesiones = $aprTotalSesiones > 0 ? round(($aprSesionesRealizadas / $aprTotalSesiones) * 100) : 0;
        $aprPrimerNombre = htmlspecialchars(explode(' ', $_SESSION['user_name'] ?? 'Aprendiz')[0]);
        $aprNombreCompleto = htmlspecialchars(trim(($_SESSION['user_name'] ?? 'Aprendiz') . ' ' . ($_SESSION['user_lastname'] ?? '')));
        $aprCorreo = htmlspecialchars($usuario->correo ?? 'aprendiz@sena.edu.co');
        $aprAvatarUrl = $avatarUrl ?? 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=120&auto=format&fit=crop';
        ?>

        <style>
        .apr-overview .banner-welcome {
            margin-bottom: 1.5rem;
        }
        .apr-overview .banner-welcome p {
            max-width: 760px;
        }
        .apr-kpi-card {
            background-color: #ffffff;
            border-radius: 20px;
            padding: 1.5rem;
            height: 100%;
            border: 1px solid rgba(0,0,0,0.04);
        }
        .apr-kpi-title {
            font-size: 0.7rem;
            font-weight: 800;
            color: #9ca3af;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .apr-kpi-icon {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
        }
        .apr-kpi-value {
            font-size: 2.2rem;
            font-weight: 800;
            color: #111827;
            line-height: 1;
            margin-bottom: 0.8rem;
        }
        .apr-kpi-subtitle {
            font-size: 0.75rem;
            font-weight: 600;
        }
        .apr-agenda-panel,
        .apr-cal-panel {
            background-color: #ffffff;
            border-radius: 24px;
            padding: 2rem;
            height: 100%;
            border: 1px solid rgba(0,0,0,0.04);
        }
        .apr-agenda-sup {
            font-size: 0.7rem;
            font-weight: 800;
            letter-spacing: 1px;
            color: #059669;
            text-transform: uppercase;
        }
        .apr-agenda-badge {
            background-color: #f3f4f6;
            color: #6b7280;
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            white-space: nowrap;
        }
        .apr-agenda-card {
            border: 1px solid #f3f4f6;
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            transition: all 0.2s;
        }
        .apr-agenda-card:hover {
            box-shadow: 0 6px 18px rgba(15, 23, 42, 0.06);
            border-color: #d1fae5;
        }
        .apr-agenda-ficha {
            background-color: #e6f6f1;
            color: #10b981;
            padding: 0.2rem 0.6rem;
            border-radius: 12px;
            font-size: 0.65rem;
            font-weight: 800;
            letter-spacing: 0.5px;
        }
        .apr-agenda-time {
            color: #6b7280;
            font-size: 0.75rem;
            font-weight: 700;
        }
        .apr-btn-detail {
            background-color: #10b981;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0.6rem 1.2rem;
            font-weight: 700;
            font-size: 0.85rem;
            transition: all 0.2s;
            white-space: nowrap;
        }
        .apr-btn-detail:hover {
            background-color: #059669;
            color: white;
        }
        .apr-cal-grid-header,
        .apr-cal-grid-body {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            text-align: center;
        }
        .apr-cal-grid-header {
            font-weight: 700;
            color: #9ca3af;
            font-size: 0.75rem;
            margin-bottom: 1rem;
        }
        .apr-cal-grid-body {
            gap: 5px;
        }
        .apr-cal-cell {
            aspect-ratio: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.9rem;
            color: #374151;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
        }
        .apr-cal-cell:hover {
            background-color: #f3f4f6;
        }
        .apr-cal-cell.active {
            background-color: #10b981;
            color: white;
            box-shadow: 0 4px 10px rgba(16, 185, 129, 0.3);
        }
        .apr-cal-cell.muted {
            color: #d1d5db;
            cursor: default;
        }
        .apr-cal-dot {
            width: 5px;
            height: 5px;
            border-radius: 50%;
            margin-top: 4px;
            background-color: #10b981;
        }
        .apr-cal-cell.active .apr-cal-dot {
            background-color: white;
        }
        .apr-dot-legend {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #10b981;
        }
        .apr-dot-legend.grey {
            background-color: #e5e7eb;
            border: 1px solid #d1d5db;
        }
        @media (max-width: 767px) {
            .apr-agenda-panel,
            .apr-cal-panel {
                padding: 1.25rem;
                border-radius: 18px;
            }
            .apr-agenda-card {
                padding: 1.1rem;
            }
            .apr-overview .banner-welcome p {
                max-width: 100%;
            }
        }
        </style>

        <section class="apr-overview">
            <div class="banner-welcome d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                <div>
                    <div class="badge-active">Portal de Consulta Formativa Activo</div>
                    <h3>¡Hola, Aprendiz <?= $aprPrimerNombre; ?>!</h3>
                    <p>Consulta tu programación de clases, revisa tu calendario mensual y mantente al día con tu ficha, tus instructores y tu seguimiento de asistencia.</p>
                </div>
                <a href="<?= URLROOT; ?>/index.php?route=perfil/index" class="banner-user-card shadow-sm mt-3 mt-md-0 ms-md-4 text-decoration-none">
                    <img class="banner-welcome-avatar-img" src="<?= htmlspecialchars($aprAvatarUrl, ENT_QUOTES, 'UTF-8'); ?>" alt="Foto de perfil">
                    <span>
                        <small>APRENDIZ SENA</small>
                        <strong><?= $aprNombreCompleto; ?></strong>
                        <div class="user-email"><i class="fa-regular fa-envelope me-1"></i> <?= $aprCorreo; ?></div>
                    </span>
                </a>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="apr-kpi-card shadow-sm">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <span class="apr-kpi-title">Mis clases</span>
                            <div class="apr-kpi-icon text-success bg-success-subtle"><i class="fa-regular fa-calendar"></i></div>
                        </div>
                        <div class="apr-kpi-value"><?= $aprTotalClases; ?></div>
                        <div class="apr-kpi-subtitle text-success"><i class="fa-solid fa-book-open me-1"></i> Sesiones programadas</div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="apr-kpi-card shadow-sm">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <span class="apr-kpi-title">Ficha activa</span>
                            <div class="apr-kpi-icon text-success bg-success-subtle"><i class="fa-solid fa-user-group"></i></div>
                        </div>
                        <div class="apr-kpi-value"><?= $aprTotalFichas; ?></div>
                        <div class="apr-kpi-subtitle text-success"><i class="fa-solid fa-layer-group me-1"></i> Ficha #<?= htmlspecialchars($aprFichaPrincipal); ?></div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="apr-kpi-card shadow-sm">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <span class="apr-kpi-title">Fallas</span>
                            <div class="apr-kpi-icon text-danger bg-danger-subtle"><i class="fa-solid fa-triangle-exclamation"></i></div>
                        </div>
                        <div class="apr-kpi-value"><?= $aprFallas; ?></div>
                        <div class="apr-kpi-subtitle text-danger"><i class="fa-solid fa-thumbtack me-1"></i> Registros de inasistencia</div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="apr-kpi-card shadow-sm">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <span class="apr-kpi-title">Cumplimiento</span>
                            <div class="apr-kpi-icon text-success bg-success-subtle"><i class="fa-regular fa-circle-check"></i></div>
                        </div>
                        <div class="apr-kpi-value"><?= $aprCumplimientoSesiones; ?>%</div>
                        <div class="apr-kpi-subtitle text-secondary"><i class="fa-regular fa-clock me-1"></i> <?= $aprSesionesRealizadas; ?> de <?= $aprTotalSesiones; ?> sesiones</div>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-12 col-lg-7">
                    <div class="apr-agenda-panel shadow-sm d-flex flex-column">
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4 pb-2 border-bottom border-light-subtle gap-3">
                            <div>
                                <span class="apr-agenda-sup">Agenda para el día seleccionado</span>
                                <h4 class="fw-bold mb-0 mt-1 text-dark" id="apr-agenda-fecha">Seleccione un día</h4>
                            </div>
                            <div class="apr-agenda-badge" id="apr-agenda-count">0 Clases Asignadas</div>
                        </div>

                        <div id="apr-agenda-container" class="flex-grow-1" style="overflow-y:auto; max-height:480px; padding-right:.5rem;">
                            <div class="text-center py-5 text-muted">
                                <i class="fa-regular fa-calendar-check fa-3x mb-3 text-secondary"></i>
                                <p class="fw-bold mb-0">Seleccione un día del calendario</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-5">
                    <div class="apr-cal-panel shadow-sm">
                        <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom border-light-subtle">
                            <h6 class="fw-bold mb-0 text-dark" style="font-size:0.95rem;"><i class="fa-regular fa-calendar me-2 text-success"></i> MI CALENDARIO</h6>
                            <div class="d-flex align-items-center gap-3">
                                <button class="btn btn-sm btn-light rounded-circle shadow-sm" type="button" onclick="navegarMesAprResumen(-1)"><i class="fa-solid fa-chevron-left"></i></button>
                                <span class="text-secondary fw-bold text-capitalize" style="font-size:0.85rem;" id="apr-cal-mes-anio"></span>
                                <button class="btn btn-sm btn-light rounded-circle shadow-sm" type="button" onclick="navegarMesAprResumen(1)"><i class="fa-solid fa-chevron-right"></i></button>
                            </div>
                        </div>

                        <div class="apr-cal-grid-header">
                            <div>L</div><div>M</div><div>M</div><div>J</div><div>V</div><div>S</div><div>D</div>
                        </div>
                        <div class="apr-cal-grid-body" id="apr-cal-body"></div>

                        <div class="d-flex justify-content-center gap-4 mt-4 pt-4 border-top border-light-subtle">
                            <div class="d-flex align-items-center gap-2 text-secondary" style="font-size:0.75rem;font-weight:600;"><div class="apr-dot-legend"></div> Con clases</div>
                            <div class="d-flex align-items-center gap-2 text-secondary" style="font-size:0.75rem;font-weight:600;"><div class="apr-dot-legend grey"></div> Sin clases</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script>
        const programacionAprResumen = <?= json_encode($aprProgramacion ?? []) ?>;
        const programasNombresAprResumen = <?= json_encode($programas_fichas ?? []) ?>;
        let fechaActualAprResumen = new Date();
        let currentMesAprResumen = fechaActualAprResumen.getMonth() + 1;
        let currentAnioAprResumen = fechaActualAprResumen.getFullYear();
        const mesesNombresAprResumen = ['', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        const diasSemanaAprResumen = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];

        function renderizarCalendarioAprResumen(mes, anio) {
            const calBody = document.getElementById('apr-cal-body');
            const labelMesAnio = document.getElementById('apr-cal-mes-anio');
            if (!calBody || !labelMesAnio) return;

            labelMesAnio.innerText = mesesNombresAprResumen[mes] + ' ' + anio;
            calBody.innerHTML = '';

            const primerDiaObj = new Date(`${anio}-${String(mes).padStart(2, '0')}-01T00:00:00`);
            const offset = primerDiaObj.getDay() === 0 ? 6 : primerDiaObj.getDay() - 1;
            const diasMes = new Date(anio, mes, 0).getDate();
            const strMes = String(mes).padStart(2, '0');
            const diasConClase = new Set();

            programacionAprResumen.forEach(p => {
                if (p.fecha_inicio && p.fecha_inicio.startsWith(`${anio}-${strMes}`)) {
                    diasConClase.add(parseInt(p.fecha_inicio.split('-')[2], 10));
                }
            });

            let html = '';
            for (let i = 0; i < offset; i++) {
                html += '<div class="apr-cal-cell muted"></div>';
            }

            for (let d = 1; d <= diasMes; d++) {
                const dotHtml = diasConClase.has(d) ? '<div class="apr-cal-dot"></div>' : '<div class="apr-cal-dot" style="background:transparent;"></div>';
                html += `<div class="apr-cal-cell" id="apr-cal-cell-${d}" onclick="seleccionarDiaAprResumen(${d}, this)">${d}${dotHtml}</div>`;
            }

            calBody.innerHTML = html;

            const hoy = new Date();
            const esMesActual = hoy.getMonth() + 1 === mes && hoy.getFullYear() === anio;
            if (esMesActual) {
                const hoyCell = document.getElementById(`apr-cal-cell-${hoy.getDate()}`);
                if (hoyCell) {
                    hoyCell.click();
                    return;
                }
            }

            if (diasConClase.size > 0) {
                const primerDiaClase = Math.min(...Array.from(diasConClase));
                const cell = document.getElementById(`apr-cal-cell-${primerDiaClase}`);
                if (cell) cell.click();
            } else {
                const firstCell = document.getElementById('apr-cal-cell-1');
                if (firstCell) firstCell.click();
            }
        }

        function seleccionarDiaAprResumen(dia, element) {
            document.querySelectorAll('#apr-cal-body .apr-cal-cell').forEach(el => el.classList.remove('active'));
            element.classList.add('active');
            verAgendaDiaAprResumen(dia, currentMesAprResumen, currentAnioAprResumen);
        }

        function verAgendaDiaAprResumen(dia, mes, anio) {
            const strMes = String(mes).padStart(2, '0');
            const strDia = String(dia).padStart(2, '0');
            const dateStr = `${anio}-${strMes}-${strDia}`;
            const fechaObj = new Date(`${dateStr}T00:00:00`);
            const nombreDia = diasSemanaAprResumen[fechaObj.getDay()];
            const agendaFecha = document.getElementById('apr-agenda-fecha');
            const agendaCount = document.getElementById('apr-agenda-count');
            const container = document.getElementById('apr-agenda-container');
            if (!agendaFecha || !agendaCount || !container) return;

            agendaFecha.innerText = `${nombreDia}, ${dia} de ${mesesNombresAprResumen[mes].toLowerCase()} de ${anio}`;

            const sesionesDia = programacionAprResumen
                .filter(p => p.fecha_inicio === dateStr)
                .sort((a, b) => (a.hora_inicio || '').localeCompare(b.hora_inicio || ''));

            agendaCount.innerText = `${sesionesDia.length} Clase${sesionesDia.length !== 1 ? 's' : ''} Asignada${sesionesDia.length !== 1 ? 's' : ''}`;

            if (sesionesDia.length === 0) {
                container.innerHTML = `
                    <div class="text-center py-5 text-muted">
                        <div style="background-color:#f9fafb;width:60px;height:60px;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem auto;">
                            <i class="fa-regular fa-calendar-xmark text-secondary fs-4"></i>
                        </div>
                        <h6 class="fw-bold mb-1">Sin clases programadas</h6>
                        <p class="small mb-0">No tienes sesiones asignadas para este día.</p>
                    </div>
                `;
                return;
            }

            container.innerHTML = sesionesDia.map(s => {
                const horaInicio = s.hora_inicio ? s.hora_inicio.substring(0, 5) : '';
                const horaFin = s.hora_fin ? s.hora_fin.substring(0, 5) : '';
                const tituloPrograma = programasNombresAprResumen[s.numero_ficha] || 'Programa de Formación';
                const instructor = `${s.instructor_nombre || ''} ${s.instructor_apellido || ''}`.trim() || 'Instructor asignado';
                const ambiente = s.ambiente_nombre || 'No asignado';
                const sesionesRealizadas = s.sesiones_realizadas || 0;
                const totalSesiones = s.total_sesiones || 0;

                return `
                    <div class="apr-agenda-card shadow-sm bg-white">
                        <div class="d-flex justify-content-between align-items-center mb-3 gap-3">
                            <div class="d-flex align-items-center gap-3 flex-wrap">
                                <span class="apr-agenda-ficha">FICHA #${s.numero_ficha || 'N/A'}</span>
                                <span class="apr-agenda-time"><i class="fa-regular fa-clock me-1"></i> ${horaInicio} - ${horaFin}</span>
                            </div>
                        </div>
                        <h5 class="fw-bold text-dark mb-1">${tituloPrograma}</h5>
                        <p class="small text-secondary mb-3" style="line-height:1.4;"><strong>RA:</strong> ${s.ra_descripcion || 'Resultado de aprendizaje asignado'}</p>
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mt-3 pt-3 border-top border-light-subtle gap-3">
                            <div class="d-flex flex-column flex-md-row gap-3 gap-md-4">
                                <div class="small text-secondary fw-medium"><i class="fa-solid fa-location-dot me-1 text-muted"></i> Ambiente: <strong class="text-dark">${ambiente}</strong></div>
                                <div class="small text-secondary fw-medium"><i class="fa-solid fa-user-tie me-1 text-muted"></i> Instructor: <strong class="text-dark">${instructor}</strong></div>
                                <div class="small text-secondary fw-medium">Sesiones: <strong class="text-dark">${sesionesRealizadas}/${totalSesiones}</strong></div>
                            </div>
                        </div>
                    </div>
                `;
            }).join('');
        }

        function navegarMesAprResumen(dir) {
            currentMesAprResumen += dir;
            if (currentMesAprResumen > 12) {
                currentMesAprResumen = 1;
                currentAnioAprResumen++;
            } else if (currentMesAprResumen < 1) {
                currentMesAprResumen = 12;
                currentAnioAprResumen--;
            }
            renderizarCalendarioAprResumen(currentMesAprResumen, currentAnioAprResumen);
        }

        function sincronizarVistaAprendizResumen() {
            const detalleHashes = ['#pills-apr-ficha', '#pills-apr-asist'];
            const mostrandoDetalle = detalleHashes.includes(window.location.hash);
            const resumen = document.querySelector('.apr-overview');
            const detalle = document.getElementById('pills-tabContentApr');

            if (resumen) resumen.classList.toggle('d-none', mostrandoDetalle);
            if (detalle) detalle.classList.toggle('d-none', !mostrandoDetalle);
        }

        document.addEventListener('DOMContentLoaded', function() {
            renderizarCalendarioAprResumen(currentMesAprResumen, currentAnioAprResumen);
            sincronizarVistaAprendizResumen();
        });
        window.addEventListener('hashchange', sincronizarVistaAprendizResumen);
        </script>

        <!-- Pestañas Aprendiz -->
        <ul class="nav sga-nav-pills mb-5 gap-3 d-none" id="pills-tab-apr" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-apr-ficha-tab" data-bs-toggle="pill" data-bs-target="#pills-apr-ficha" type="button" role="tab" aria-controls="pills-apr-ficha" aria-selected="true">
                    <i class="fa-solid fa-id-card me-1"></i> Mi Ficha y Avance
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-apr-asist-tab" data-bs-toggle="pill" data-bs-target="#pills-apr-asist" type="button" role="tab" aria-controls="pills-apr-asist" aria-selected="false">
                    <i class="fa-solid fa-chart-line me-1"></i> Seguimiento de Asistencia
                </button>
            </li>
        </ul>

        <!-- Contenido de las Pestañas Aprendiz -->
        <div class="tab-content d-none" id="pills-tabContentApr">
            
            <!-- PESTAÑA 1: MI FICHA Y AVANCE -->
            <div class="tab-pane fade show active" id="pills-apr-ficha" role="tabpanel" aria-labelledby="pills-apr-ficha-tab">
                <?php
                $aprProgramaFicha = (!empty($aprProgramaPrincipal) && $aprProgramaPrincipal !== 'Programa de Formación')
                    ? $aprProgramaPrincipal
                    : 'Análisis y Desarrollo de Software';
                $aprInstructorLider = $aprProximaClase
                    ? trim(($aprProximaClase->instructor_nombre ?? '') . ' ' . ($aprProximaClase->instructor_apellido ?? ''))
                    : '';
                $aprInstructorLider = $aprInstructorLider !== '' ? $aprInstructorLider : 'Darwin Cordero';
                $aprJornadaFicha = $aprProximaClase->jornada ?? 'Tarde';
                $aprCompetenciasFicha = [];

                if (!empty($competencias)) {
                    foreach ($competencias as $comp) {
                        $programaComp = trim((string) ($comp->programa_nombre ?? ''));
                        if ($programaComp === '' || strtolower($programaComp) === strtolower($aprProgramaFicha)) {
                            $aprCompetenciasFicha[] = $comp;
                        }
                    }
                }

                if (empty($aprCompetenciasFicha) && !empty($competencias)) {
                    $aprCompetenciasFicha = $competencias;
                }

                $aprModuloIconos = ['fa-laptop', 'fa-code', 'fa-database', 'fa-gears', 'fa-network-wired'];
                $aprModuloDescripciones = [
                    'Desarrolla soluciones de software de acuerdo con los requisitos y especificaciones técnicas establecidas.',
                    'Implementa soluciones de software siguiendo estándares de calidad y modelos de referencia.',
                    'Integra conocimientos técnicos y procedimentales para fortalecer tu ruta formativa.',
                    'Aplica actividades prácticas orientadas al cumplimiento de los resultados de aprendizaje.'
                ];
                ?>

                <style>
                .apr-ficha-breadcrumb {
                    display: flex;
                    align-items: center;
                    gap: 0.65rem;
                    color: #64748b;
                    font-size: 0.84rem;
                    font-weight: 700;
                    margin-bottom: 1.35rem;
                }
                .apr-ficha-breadcrumb .active {
                    color: #0f9f4f;
                }
                .apr-ficha-card {
                    background: #ffffff;
                    border: 1px solid rgba(15, 23, 42, 0.07);
                    border-radius: 12px;
                    box-shadow: 0 18px 48px rgba(15, 23, 42, 0.05);
                    padding: 2rem;
                    margin-bottom: 1.5rem;
                }
                .apr-ficha-head {
                    display: grid;
                    grid-template-columns: auto minmax(0, 1fr) auto;
                    align-items: center;
                    gap: 1.6rem;
                    margin-bottom: 1.8rem;
                }
                .apr-ficha-main-icon,
                .apr-ficha-info-icon,
                .apr-module-icon {
                    background: #edf9f0;
                    color: #0f9f4f;
                    display: grid;
                    place-items: center;
                    flex-shrink: 0;
                }
                .apr-ficha-main-icon {
                    width: 88px;
                    height: 88px;
                    border-radius: 12px;
                    font-size: 2.25rem;
                }
                .apr-ficha-kicker {
                    color: #0f9f4f;
                    font-size: 0.72rem;
                    font-weight: 900;
                    letter-spacing: 0.6px;
                    text-transform: uppercase;
                    margin-bottom: 0.45rem;
                }
                .apr-ficha-title {
                    font-size: clamp(1.65rem, 2.5vw, 2.35rem);
                    line-height: 1.08;
                    font-weight: 900;
                    color: #111827;
                    margin: 0 0 0.55rem;
                    letter-spacing: 0;
                }
                .apr-ficha-meta {
                    color: #6b7280;
                    font-size: 0.92rem;
                    font-weight: 700;
                }
                .apr-ficha-jornada {
                    min-width: 138px;
                    min-height: 86px;
                    border-radius: 12px;
                    background: #dff3e9;
                    color: #064e3b;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    gap: 0.85rem;
                    padding: 1rem 1.2rem;
                    box-shadow: 0 12px 24px rgba(15, 23, 42, 0.08);
                }
                .apr-ficha-jornada i {
                    color: #0f9f4f;
                    font-size: 1.3rem;
                }
                .apr-ficha-jornada span {
                    display: block;
                    color: #334155;
                    font-size: 0.68rem;
                    font-weight: 900;
                    letter-spacing: 0.8px;
                    text-transform: uppercase;
                }
                .apr-ficha-jornada strong {
                    display: block;
                    font-size: 1.25rem;
                    font-weight: 900;
                    color: #064e3b;
                    line-height: 1.1;
                }
                .apr-ficha-info-grid {
                    display: grid;
                    grid-template-columns: repeat(3, minmax(0, 1fr));
                    gap: 1rem;
                    margin-bottom: 1.45rem;
                }
                .apr-ficha-info-card {
                    border: 1px solid #e8edf2;
                    border-radius: 10px;
                    padding: 1.15rem 1.25rem;
                    display: flex;
                    align-items: center;
                    gap: 1rem;
                    min-height: 118px;
                    background: #fff;
                }
                .apr-ficha-info-icon {
                    width: 58px;
                    height: 58px;
                    border-radius: 50%;
                    font-size: 1.35rem;
                }
                .apr-ficha-info-card span {
                    color: #64748b;
                    display: block;
                    font-size: 0.69rem;
                    font-weight: 900;
                    letter-spacing: 0.7px;
                    text-transform: uppercase;
                    margin-bottom: 0.35rem;
                }
                .apr-ficha-info-card strong {
                    display: block;
                    color: #111827;
                    font-size: 0.98rem;
                    font-weight: 900;
                    line-height: 1.25;
                }
                .apr-ficha-info-card small {
                    display: block;
                    color: #64748b;
                    font-size: 0.82rem;
                    font-weight: 600;
                    margin-top: 0.25rem;
                }
                .apr-ficha-info-card .is-success {
                    color: #0f9f4f;
                }
                .apr-ficha-dates {
                    border-top: 1px solid #e8edf2;
                    padding-top: 1.1rem;
                    display: grid;
                    grid-template-columns: repeat(3, minmax(0, 1fr));
                    gap: 1rem;
                    color: #64748b;
                    font-size: 0.86rem;
                    font-weight: 700;
                }
                .apr-ficha-date-item {
                    display: flex;
                    align-items: center;
                    gap: 0.6rem;
                    flex-wrap: wrap;
                    min-width: 0;
                }
                .apr-ficha-date-item i {
                    color: #64748b;
                }
                .apr-ficha-date-item strong {
                    color: #111827;
                    font-weight: 900;
                }
                .apr-modules-card {
                    background: #ffffff;
                    border: 1px solid rgba(15, 23, 42, 0.07);
                    border-radius: 12px;
                    box-shadow: 0 18px 48px rgba(15, 23, 42, 0.04);
                    padding: 1.8rem;
                }
                .apr-modules-title {
                    color: #111827;
                    font-size: 1.18rem;
                    font-weight: 900;
                    margin: 0 0 0.35rem;
                }
                .apr-modules-subtitle {
                    color: #64748b;
                    font-size: 0.83rem;
                    font-weight: 600;
                    margin-bottom: 1.2rem;
                }
                .apr-module-row {
                    border: 1px solid #e8edf2;
                    border-radius: 10px;
                    padding: 1rem;
                    display: grid;
                    grid-template-columns: auto minmax(0, 1fr) auto auto;
                    align-items: center;
                    gap: 1rem;
                    margin-bottom: 0.85rem;
                    background: #fff;
                }
                .apr-module-row:last-child {
                    margin-bottom: 0;
                }
                .apr-module-icon {
                    width: 68px;
                    height: 68px;
                    border-radius: 10px;
                    font-size: 1.55rem;
                }
                .apr-module-code {
                    color: #0f7a42;
                    font-size: 0.65rem;
                    font-weight: 900;
                    letter-spacing: 0.7px;
                    text-transform: uppercase;
                    margin-bottom: 0.32rem;
                }
                .apr-module-name {
                    color: #111827;
                    font-size: 0.95rem;
                    font-weight: 900;
                    line-height: 1.35;
                    margin: 0;
                }
                .apr-module-desc {
                    color: #64748b;
                    font-size: 0.82rem;
                    font-weight: 600;
                    line-height: 1.35;
                    margin: 0.45rem 0 0;
                }
                .apr-module-badge {
                    display: inline-flex;
                    align-items: center;
                    border-radius: 999px;
                    background: #e4f8e9;
                    color: #0f9f4f;
                    font-size: 0.65rem;
                    font-weight: 900;
                    letter-spacing: 0.5px;
                    text-transform: uppercase;
                    padding: 0.35rem 0.65rem;
                    margin-left: 0.65rem;
                    vertical-align: middle;
                    white-space: nowrap;
                }
                .apr-module-hours {
                    min-width: 128px;
                    text-align: center;
                }
                .apr-module-hours strong {
                    display: block;
                    color: #111827;
                    font-size: 1.45rem;
                    font-weight: 900;
                    line-height: 1;
                }
                .apr-module-hours span {
                    display: block;
                    color: #111827;
                    font-size: 0.78rem;
                    font-weight: 800;
                    margin-top: 0.2rem;
                }
                .apr-module-hours small {
                    display: block;
                    color: #64748b;
                    font-size: 0.78rem;
                    font-weight: 600;
                    margin-top: 0.2rem;
                }
                .apr-module-arrow {
                    width: 38px;
                    height: 38px;
                    border: none;
                    border-radius: 50%;
                    background: #e4f8e9;
                    color: #0f9f4f;
                    display: grid;
                    place-items: center;
                    flex-shrink: 0;
                }
                @media (max-width: 992px) {
                    .apr-ficha-head,
                    .apr-module-row {
                        grid-template-columns: 1fr;
                    }
                    .apr-ficha-main-icon {
                        width: 72px;
                        height: 72px;
                        font-size: 1.8rem;
                    }
                    .apr-ficha-jornada,
                    .apr-module-hours {
                        justify-content: flex-start;
                        text-align: left;
                    }
                    .apr-module-arrow {
                        display: none;
                    }
                }
                @media (max-width: 768px) {
                    .apr-ficha-card,
                    .apr-modules-card {
                        padding: 1.2rem;
                    }
                    .apr-ficha-info-grid,
                    .apr-ficha-dates {
                        grid-template-columns: 1fr;
                    }
                    .apr-ficha-info-card {
                        min-height: auto;
                    }
                }
                </style>

                <div class="apr-ficha-breadcrumb">
                    <i class="fa-solid fa-house"></i>
                    <i class="fa-solid fa-chevron-right" style="font-size:0.68rem;"></i>
                    <span>Inicio</span>
                    <i class="fa-solid fa-chevron-right" style="font-size:0.68rem;"></i>
                    <span class="active">Mi ficha académica</span>
                </div>

                <section class="apr-ficha-card">
                    <div class="apr-ficha-head">
                        <div class="apr-ficha-main-icon">
                            <i class="fa-solid fa-graduation-cap"></i>
                        </div>
                        <div>
                            <div class="apr-ficha-kicker">Programa de formación titulada</div>
                            <h2 class="apr-ficha-title"><?= htmlspecialchars($aprProgramaFicha); ?></h2>
                            <div class="apr-ficha-meta">Código de Programa: 228106&nbsp;&nbsp;•&nbsp;&nbsp;Versión V1&nbsp;&nbsp;•&nbsp;&nbsp;Vigencia: 2024-2026</div>
                        </div>
                        <div class="apr-ficha-jornada">
                            <i class="fa-regular fa-calendar"></i>
                            <div>
                                <span>Jornada</span>
                                <strong><?= htmlspecialchars($aprJornadaFicha); ?></strong>
                            </div>
                        </div>
                    </div>

                    <div class="apr-ficha-info-grid">
                        <div class="apr-ficha-info-card">
                            <div class="apr-ficha-info-icon"><i class="fa-regular fa-user"></i></div>
                            <div>
                                <span>Instructor Líder</span>
                                <strong><?= htmlspecialchars($aprInstructorLider); ?></strong>
                                <small>Soporte y Orientación Ficha</small>
                            </div>
                        </div>
                        <div class="apr-ficha-info-card">
                            <div class="apr-ficha-info-icon"><i class="fa-regular fa-clock"></i></div>
                            <div>
                                <span>Duración Formación</span>
                                <strong>18 meses Lectiva</strong>
                                <small>+6 meses Etapa Práctica</small>
                            </div>
                        </div>
                        <div class="apr-ficha-info-card">
                            <div class="apr-ficha-info-icon"><i class="fa-regular fa-file-lines"></i></div>
                            <div>
                                <span>Estado Académico</span>
                                <strong class="is-success">En Etapa Lectiva</strong>
                                <small>Ficha activa para clases</small>
                            </div>
                        </div>
                    </div>

                    <div class="apr-ficha-dates">
                        <div class="apr-ficha-date-item"><i class="fa-regular fa-calendar"></i> Fecha de Inicio: <strong>2024-04-15</strong></div>
                        <div class="apr-ficha-date-item"><i class="fa-regular fa-calendar-check"></i> Ingreso a Prácticas: <strong>2025-10-15</strong></div>
                        <div class="apr-ficha-date-item"><i class="fa-regular fa-flag"></i> Fecha de Cierre: <strong>2026-04-15</strong></div>
                    </div>
                </section>

                <section class="apr-modules-card">
                    <h3 class="apr-modules-title">Competencias y Módulos de Formación</h3>
                    <div class="apr-modules-subtitle">Consulta las competencias y módulos que componen tu programa de formación.</div>

                    <?php if (empty($aprCompetenciasFicha)): ?>
                        <div class="text-center text-muted py-4">
                            <i class="fa-regular fa-folder-open fa-2x mb-2"></i>
                            <p class="fw-bold mb-0">No hay competencias registradas para esta ficha.</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($aprCompetenciasFicha as $idx => $comp): ?>
                            <?php
                            $moduloNumero = $idx + 1;
                            $horasModulo = (int) ($comp->horas_totales ?? ($idx === 0 ? 340 : 240));
                            $sesionesModulo = (int) ($comp->total_sesiones ?? ($idx === 0 ? 60 : 48));
                            $iconoModulo = $aprModuloIconos[$idx % count($aprModuloIconos)];
                            $descripcionModulo = $aprModuloDescripciones[$idx % count($aprModuloDescripciones)];
                            ?>
                            <div class="apr-module-row">
                                <div class="apr-module-icon"><i class="fa-solid <?= $iconoModulo; ?>"></i></div>
                                <div>
                                    <div class="apr-module-code">Código <?= htmlspecialchars($comp->codigo ?? 'N/A'); ?></div>
                                    <p class="apr-module-name">
                                        <?= htmlspecialchars($comp->nombre ?? 'Competencia de formación'); ?>
                                        <span class="apr-module-badge">Módulo <?= $moduloNumero; ?></span>
                                    </p>
                                    <p class="apr-module-desc"><?= htmlspecialchars($descripcionModulo); ?></p>
                                </div>
                                <div class="apr-module-hours">
                                    <strong><?= $horasModulo; ?></strong>
                                    <span>Horas Totales</span>
                                    <small><?= $sesionesModulo; ?> sesiones</small>
                                </div>
                                <button type="button" class="apr-module-arrow" aria-label="Ver módulo <?= $moduloNumero; ?>">
                                    <i class="fa-solid fa-chevron-right"></i>
                                </button>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </section>

            </div>

            <!-- PESTAÑA 2: SEGUIMIENTO DE ASISTENCIA -->
            <div class="tab-pane fade" id="pills-apr-asist" role="tabpanel" aria-labelledby="pills-apr-asist-tab">
                <?php
                $total_asistencias = count($asistencias ?? []);
                $asistidas = 0;
                $fallas = 0;
                if ($total_asistencias > 0) {
                    foreach ($asistencias as $a) {
                        if ((int) $a->asistio === 1) {
                            $asistidas++;
                        } else {
                            $fallas++;
                        }
                    }
                }
                $tasa = $total_asistencias > 0 ? round(($asistidas / $total_asistencias) * 100) : 0;
                $mesesAsistencia = [
                    1 => 'enero', 2 => 'febrero', 3 => 'marzo', 4 => 'abril',
                    5 => 'mayo', 6 => 'junio', 7 => 'julio', 8 => 'agosto',
                    9 => 'septiembre', 10 => 'octubre', 11 => 'noviembre', 12 => 'diciembre'
                ];
                ?>

                <style>
                .apr-asist-breadcrumb {
                    display: flex;
                    align-items: center;
                    gap: 0.65rem;
                    color: #64748b;
                    font-size: 0.84rem;
                    font-weight: 700;
                    margin-bottom: 1.35rem;
                }
                .apr-asist-breadcrumb .active {
                    color: #0f9f4f;
                }
                .apr-asist-kpis {
                    display: grid;
                    grid-template-columns: repeat(3, minmax(0, 1fr));
                    gap: 1rem;
                    margin-bottom: 1.5rem;
                }
                .apr-asist-kpi {
                    background: #fff;
                    border: 1px solid rgba(15, 23, 42, 0.07);
                    border-radius: 12px;
                    box-shadow: 0 18px 42px rgba(15, 23, 42, 0.05);
                    padding: 1.55rem;
                    display: flex;
                    align-items: center;
                    gap: 1.25rem;
                    min-height: 160px;
                }
                .apr-asist-kpi-icon {
                    width: 86px;
                    height: 86px;
                    border-radius: 50%;
                    display: grid;
                    place-items: center;
                    flex-shrink: 0;
                    font-size: 2rem;
                    background: #edf9f0;
                    color: #0f9f4f;
                }
                .apr-asist-kpi-icon.danger {
                    background: #fde8eb;
                    color: #dc3545;
                }
                .apr-asist-kpi-label {
                    color: #334155;
                    font-size: 0.72rem;
                    font-weight: 900;
                    letter-spacing: 0.6px;
                    text-transform: uppercase;
                    margin-bottom: 0.55rem;
                }
                .apr-asist-kpi-value {
                    color: #0f9f4f;
                    font-size: 2.3rem;
                    font-weight: 900;
                    line-height: 1;
                    margin-bottom: 0.75rem;
                }
                .apr-asist-kpi-value.danger {
                    color: #dc3545;
                }
                .apr-asist-kpi-value span {
                    font-size: 1.12rem;
                    font-weight: 900;
                }
                .apr-asist-kpi-desc {
                    color: #64748b;
                    font-size: 0.84rem;
                    font-weight: 600;
                    line-height: 1.55;
                    margin: 0;
                }
                .apr-asist-panel {
                    background: #fff;
                    border: 1px solid rgba(15, 23, 42, 0.07);
                    border-radius: 12px;
                    box-shadow: 0 18px 48px rgba(15, 23, 42, 0.04);
                    padding: 1.65rem;
                }
                .apr-asist-panel-head {
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    gap: 1rem;
                    margin-bottom: 1.5rem;
                }
                .apr-asist-panel-title {
                    color: #111827;
                    font-size: 1.18rem;
                    font-weight: 900;
                    margin: 0 0 0.35rem;
                }
                .apr-asist-panel-subtitle {
                    color: #64748b;
                    font-size: 0.84rem;
                    font-weight: 600;
                    margin: 0;
                }
                .apr-asist-actions {
                    display: flex;
                    align-items: center;
                    gap: 0.75rem;
                }
                .apr-asist-search {
                    position: relative;
                    min-width: 280px;
                }
                .apr-asist-search i {
                    position: absolute;
                    left: 1rem;
                    top: 50%;
                    transform: translateY(-50%);
                    color: #64748b;
                }
                .apr-asist-search input {
                    width: 100%;
                    border: 1px solid #e5e7eb;
                    border-radius: 10px;
                    min-height: 48px;
                    padding: 0 1rem 0 2.8rem;
                    color: #111827;
                    font-weight: 600;
                    outline: none;
                    transition: border-color 0.2s ease, box-shadow 0.2s ease;
                }
                .apr-asist-search input:focus {
                    border-color: #39a900;
                    box-shadow: 0 0 0 4px rgba(57, 169, 0, 0.12);
                }
                .apr-asist-filter {
                    border: none;
                    border-radius: 10px;
                    min-height: 48px;
                    padding: 0 1rem;
                    background: #f0f8f2;
                    color: #0f7a42;
                    font-weight: 900;
                    display: inline-flex;
                    align-items: center;
                    gap: 0.55rem;
                }
                .apr-asist-list {
                    display: flex;
                    flex-direction: column;
                    gap: 0.75rem;
                }
                .apr-asist-item {
                    border: 1px solid #e5e7eb;
                    border-radius: 12px;
                    padding: 1.25rem;
                    display: grid;
                    grid-template-columns: auto minmax(0, 1fr) auto auto;
                    align-items: center;
                    gap: 1rem;
                    background: #fff;
                }
                .apr-asist-item-icon {
                    width: 64px;
                    height: 64px;
                    border-radius: 50%;
                    display: grid;
                    place-items: center;
                    font-size: 1.35rem;
                    background: #edf9f0;
                    color: #0f9f4f;
                    flex-shrink: 0;
                }
                .apr-asist-item-icon.danger {
                    background: #fde8eb;
                    color: #dc3545;
                }
                .apr-asist-row-title {
                    display: flex;
                    align-items: center;
                    gap: 0.75rem;
                    flex-wrap: wrap;
                    margin-bottom: 0.35rem;
                }
                .apr-asist-row-title strong {
                    color: #111827;
                    font-size: 0.98rem;
                    font-weight: 900;
                }
                .apr-asist-date-badge {
                    border-radius: 999px;
                    background: #e4f8e9;
                    color: #0f7a42;
                    font-size: 0.72rem;
                    font-weight: 900;
                    padding: 0.28rem 0.6rem;
                }
                .apr-asist-date-badge.danger {
                    background: #fde8eb;
                    color: #dc3545;
                }
                .apr-asist-module {
                    color: #334155;
                    font-size: 0.86rem;
                    font-weight: 700;
                    margin-bottom: 0.8rem;
                }
                .apr-asist-meta {
                    display: flex;
                    align-items: center;
                    flex-wrap: wrap;
                    gap: 0.85rem;
                    color: #64748b;
                    font-size: 0.82rem;
                    font-weight: 700;
                }
                .apr-asist-meta span {
                    display: inline-flex;
                    align-items: center;
                    gap: 0.45rem;
                }
                .apr-asist-note {
                    color: #64748b;
                    font-size: 0.86rem;
                    font-style: italic;
                    font-weight: 600;
                    text-align: right;
                    max-width: 280px;
                }
                .apr-asist-chevron {
                    color: #64748b;
                    font-size: 1.05rem;
                }
                @media (max-width: 1100px) {
                    .apr-asist-kpis {
                        grid-template-columns: 1fr;
                    }
                    .apr-asist-item {
                        grid-template-columns: auto minmax(0, 1fr);
                    }
                    .apr-asist-note {
                        grid-column: 2;
                        text-align: left;
                        max-width: none;
                    }
                    .apr-asist-chevron {
                        display: none;
                    }
                }
                @media (max-width: 768px) {
                    .apr-asist-panel,
                    .apr-asist-kpi {
                        padding: 1.15rem;
                    }
                    .apr-asist-panel-head,
                    .apr-asist-actions {
                        flex-direction: column;
                        align-items: stretch;
                    }
                    .apr-asist-search {
                        min-width: 0;
                    }
                    .apr-asist-item {
                        grid-template-columns: 1fr;
                    }
                    .apr-asist-note {
                        grid-column: auto;
                    }
                }
                </style>

                <div class="apr-asist-breadcrumb">
                    <i class="fa-solid fa-house"></i>
                    <i class="fa-solid fa-chevron-right" style="font-size:0.68rem;"></i>
                    <span>Inicio</span>
                    <i class="fa-solid fa-chevron-right" style="font-size:0.68rem;"></i>
                    <span class="active">Mi asistencia</span>
                </div>

                <div class="apr-asist-kpis">
                    <div class="apr-asist-kpi">
                        <div class="apr-asist-kpi-icon"><i class="fa-solid fa-chart-line"></i></div>
                        <div>
                            <div class="apr-asist-kpi-label">Tasa de asistencia</div>
                            <div class="apr-asist-kpi-value"><?= $tasa; ?>%</div>
                            <p class="apr-asist-kpi-desc">Debes mantener un porcentaje superior al 85% para evitar sanciones.</p>
                        </div>
                    </div>
                    <div class="apr-asist-kpi">
                        <div class="apr-asist-kpi-icon"><i class="fa-regular fa-circle-check"></i></div>
                        <div>
                            <div class="apr-asist-kpi-label">Asistencias confirmadas</div>
                            <div class="apr-asist-kpi-value"><?= $asistidas; ?> <span>asistió</span></div>
                            <p class="apr-asist-kpi-desc">Sesiones formativas donde estuviste presente.</p>
                        </div>
                    </div>
                    <div class="apr-asist-kpi">
                        <div class="apr-asist-kpi-icon danger"><i class="fa-solid fa-triangle-exclamation"></i></div>
                        <div>
                            <div class="apr-asist-kpi-label">Fallas registradas</div>
                            <div class="apr-asist-kpi-value danger"><?= $fallas; ?> <span>fallas</span></div>
                            <p class="apr-asist-kpi-desc">Fallas sin justificación o incapacidades reportadas.</p>
                        </div>
                    </div>
                </div>

                <section class="apr-asist-panel">
                    <div class="apr-asist-panel-head">
                        <div>
                            <h3 class="apr-asist-panel-title">Registro Detallado de Asistencia</h3>
                            <p class="apr-asist-panel-subtitle">Consulta el historial de tus asistencias registradas.</p>
                        </div>
                        <div class="apr-asist-actions">
                            <div class="apr-asist-search">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                <input type="text" id="inputSearchAsist" placeholder="Buscar por fecha o RAP...">
                            </div>
                            <button type="button" class="apr-asist-filter" onclick="document.getElementById('inputSearchAsist')?.focus();">
                                <i class="fa-solid fa-filter"></i> Filtrar
                            </button>
                        </div>
                    </div>

                    <div class="apr-asist-list" id="listaAsistencias">
                        <?php if (empty($asistencias)): ?>
                            <div class="apr-asist-item item-asistencia">
                                <div class="apr-asist-item-icon"><i class="fa-regular fa-calendar-xmark"></i></div>
                                <div>
                                    <div class="apr-asist-row-title">
                                        <strong>Sin registros de asistencia</strong>
                                    </div>
                                    <div class="apr-asist-module filter-text">Cuando el instructor cierre una planilla, tus registros aparecerán aquí.</div>
                                </div>
                                <div class="apr-asist-note">"Sin observaciones."</div>
                                <i class="fa-solid fa-chevron-right apr-asist-chevron"></i>
                            </div>
                        <?php else: ?>
                            <?php foreach ($asistencias as $asist): ?>
                                <?php
                                $asistioRegistro = (int) ($asist->asistio ?? 0) === 1;
                                $fechaRegistro = $asist->fecha_asistencia ?? $asist->fecha_inicio ?? date('Y-m-d');
                                $timestampRegistro = strtotime($fechaRegistro);
                                $fechaLarga = $timestampRegistro
                                    ? date('d', $timestampRegistro) . ' de ' . $mesesAsistencia[(int) date('n', $timestampRegistro)] . ' de ' . date('Y', $timestampRegistro)
                                    : htmlspecialchars($fechaRegistro);
                                $horaInicioRegistro = !empty($asist->hora_inicio) ? date('h:i A', strtotime($asist->hora_inicio)) : '--:--';
                                $horaFinRegistro = !empty($asist->hora_fin) ? date('h:i A', strtotime($asist->hora_fin)) : '--:--';
                                $instructorRegistro = trim(($asist->instructor_nombre ?? '') . ' ' . ($asist->instructor_apellido ?? ''));
                                $instructorRegistro = $instructorRegistro !== '' ? $instructorRegistro : 'Instructor asignado';
                                $ambienteRegistro = $asist->ambiente_nombre ?? 'Ambiente asignado';
                                $programaRegistro = $asist->programa_nombre ?? $asist->competencia_nombre ?? 'Programa de Formación';
                                $observacionRegistro = !empty($asist->observacion) ? $asist->observacion : 'Sin observaciones del instructor.';
                                ?>
                                <div class="apr-asist-item item-asistencia">
                                    <div class="apr-asist-item-icon <?= $asistioRegistro ? '' : 'danger'; ?>">
                                        <i class="fa-solid <?= $asistioRegistro ? 'fa-chart-line' : 'fa-triangle-exclamation'; ?>"></i>
                                    </div>
                                    <div>
                                        <div class="apr-asist-row-title">
                                            <strong><?= $asistioRegistro ? 'Asistencia Confirmada' : 'Falla Registrada'; ?></strong>
                                            <span class="apr-asist-date-badge <?= $asistioRegistro ? '' : 'danger'; ?>"><?= htmlspecialchars($fechaLarga); ?></span>
                                        </div>
                                        <div class="apr-asist-module filter-text">Módulo: <?= htmlspecialchars($programaRegistro); ?> (Ficha <?= htmlspecialchars($asist->numero_ficha ?? 'N/A'); ?>)</div>
                                        <div class="apr-asist-meta">
                                            <span><i class="fa-regular fa-clock"></i> <?= htmlspecialchars($horaInicioRegistro . ' - ' . $horaFinRegistro); ?></span>
                                            <span><i class="fa-regular fa-user"></i> Instructor: <?= htmlspecialchars($instructorRegistro); ?></span>
                                            <span><i class="fa-regular fa-building"></i> Ambiente: <?= htmlspecialchars($ambienteRegistro); ?></span>
                                        </div>
                                    </div>
                                    <div class="apr-asist-note">
                                        "<?= htmlspecialchars($observacionRegistro); ?>"
                                    </div>
                                    <i class="fa-solid fa-chevron-right apr-asist-chevron"></i>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </section>
            </div>

        </div>

    <?php endif; ?>

</div>

<!-- MODAL GESTIONAR APRENDICES -->
<?php if ($current_role === 'Coordinador'): ?>
<div class="modal fade" id="modalGestionarAprendices" tabindex="-1" aria-labelledby="modalGestionarAprendicesLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header bg-success text-white p-4 border-0">
                <h5 class="modal-title fw-bold" id="modalGestionarAprendicesLabel"><i class="fa-solid fa-user-graduate me-2"></i>Gestionar Aprendices</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body p-0">
                <ul class="nav nav-tabs nav-fill bg-light border-bottom-0" id="gestionarTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active fw-medium py-3" id="individual-tab" data-bs-toggle="tab" data-bs-target="#individual" type="button" role="tab" aria-controls="individual" aria-selected="true"><i class="fa-solid fa-user-plus me-2"></i>Registrar y Matricular</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-medium py-3" id="masiva-tab" data-bs-toggle="tab" data-bs-target="#masiva" type="button" role="tab" aria-controls="masiva" aria-selected="false"><i class="fa-solid fa-file-csv me-2"></i>Carga Masiva CSV</button>
                    </li>
                </ul>
                <div class="tab-content p-4" id="gestionarTabsContent">
                    <!-- Tab Individual (Crear Aprendiz) -->
                    <div class="tab-pane fade show active" id="individual" role="tabpanel" aria-labelledby="individual-tab">
                        <form action="<?= URLROOT; ?>/index.php?route=fichas/crearYMatricular" method="POST">
                            <input type="hidden" name="numero_ficha" class="input-ficha-id">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="nombre" class="form-label fw-medium text-secondary">Nombres</label>
                                    <input type="text" class="form-control form-control-lg" id="nombre" name="nombre" placeholder="Ej. Carlos Arturo" required pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+" title="El nombre solo debe contener letras.">
                                </div>
                                <div class="col-md-6">
                                    <label for="apellido" class="form-label fw-medium text-secondary">Apellidos</label>
                                    <input type="text" class="form-control form-control-lg" id="apellido" name="apellido" placeholder="Ej. Gómez" required pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+" title="El apellido solo debe contener letras.">
                                </div>
                                <div class="col-md-6">
                                    <label for="documento" class="form-label fw-medium text-secondary">Documento de Identidad (Login)</label>
                                    <input type="text" inputmode="numeric" class="form-control form-control-lg" id="documento" name="documento" placeholder="Ej. 1020304050" required pattern="[0-9]{6,10}" maxlength="10" title="El documento debe contener solo números, entre 6 y 10 dígitos.">
                                </div>
                                <div class="col-md-6">
                                    <label for="telefono" class="form-label fw-medium text-secondary">Teléfono de Contacto</label>
                                    <input type="text" class="form-control form-control-lg" id="telefono" name="telefono" placeholder="Ej. 3019876543" required inputmode="numeric" pattern="[0-9]{10}" maxlength="10" title="El teléfono debe tener exactamente 10 números.">
                                </div>
                                <div class="col-md-6">
                                    <label for="correo" class="form-label fw-medium text-secondary">Correo Electrónico</label>
                                    <input type="email" class="form-control form-control-lg" id="correo" name="correo" placeholder="Ej. correo@soy.sena.edu.co" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" title="El correo debe tener un formato válido (ejemplo@dominio.com).">
                                </div>
                                <div class="col-md-6">
                                    <label for="contrasena" class="form-label fw-medium text-secondary">Contraseña Inicial</label>
                                    <input type="text" class="form-control form-control-lg" id="contrasena" name="contrasena" placeholder="Ej. Pass123*" required pattern="(?=[A-ZÑÁÉÍÓÚ])(?=.*\d)(?=.*[!@#$%^&amp;*(),.?&quot;:{}|&lt;&gt;[\]\\/_\-+=~'`;]).{8,30}" title="La contraseña debe iniciar con mayúscula, tener de 8 a 30 caracteres, e incluir un número y un carácter especial.">
                                </div>
                            </div>
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-success fw-bold shadow-sm py-2"><i class="fa-solid fa-user-plus me-2"></i>Crear y Matricular Aprendiz</button>
                            </div>
                        </form>
                    </div>
                    <!-- Tab Masiva -->
                    <div class="tab-pane fade" id="masiva" role="tabpanel" aria-labelledby="masiva-tab">
                        <form action="<?= URLROOT; ?>/index.php?route=fichas/inscribirMasivoCSV" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="numero_ficha" class="input-ficha-id">
                            <div class="alert alert-info small rounded-3">
                                <i class="fa-solid fa-circle-info me-2"></i> El archivo CSV debe contener una columna (idealmente sin encabezados) donde cada fila sea el <strong>Documento</strong> del aprendiz. Los aprendices deben estar previamente registrados en el sistema.
                            </div>
                            <div class="mb-3">
                                <label for="archivo_csv" class="form-label fw-medium text-secondary">Archivo CSV</label>
                                <input class="form-control form-control-lg" type="file" id="archivo_csv" name="archivo_csv" accept=".csv" required>
                            </div>
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-dark fw-bold shadow-sm py-2"><i class="fa-solid fa-upload me-2"></i>Procesar Archivo</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- MODAL CREAR NUEVA FICHA -->
<?php if ($current_role === 'Coordinador'): ?>
<div class="modal fade" id="modalCrearFicha" tabindex="-1" aria-labelledby="modalCrearFichaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header border-bottom-0 bg-light px-4 py-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="box-icon-sena"><i class="fa-solid fa-folder-plus"></i></div>
                    <h5 class="modal-title fw-bold text-dark" id="modalCrearFichaLabel">Crear Nueva Ficha de Formación</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= URLROOT; ?>/index.php?route=fichas/create" method="POST">
                <div class="modal-body px-4 py-4 px-md-5">
                    <div class="row g-4 mb-4">
                        <div class="col-12 col-md-6">
                            <label class="text-muted small fw-bold mb-2">Número de Ficha</label>
                            <input type="number" name="numero_ficha" class="form-control select-sena shadow-sm" required placeholder="Ej. 2721345">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="text-muted small fw-bold mb-2">Programa de Formación</label>
                            <select name="id_programa" class="form-select select-sena shadow-sm" required>
                                <option value="" disabled selected>Seleccione un programa...</option>
                                <?php if(isset($programas)): ?>
                                    <?php foreach ($programas as $prog): ?>
                                        <option value="<?= $prog->id_programa; ?>"><?= $prog->nombre; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="row g-4 mb-4">
                        <div class="col-12 col-md-6">
                            <label class="text-muted small fw-bold mb-2">Instructor Líder</label>
                            <select name="id_usuario_instructor_lider" class="form-select select-sena shadow-sm" required>
                                <option value="" disabled selected>Seleccione el instructor líder...</option>
                                <?php if(isset($instructores)): ?>
                                    <?php foreach ($instructores as $inst): ?>
                                        <option value="<?= $inst->id_usuario; ?>"><?= $inst->nombre . ' ' . $inst->apellido; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="text-muted small fw-bold mb-2">Jornada</label>
                            <select name="id_jornada" class="form-select select-sena shadow-sm" required>
                                <option value="" disabled selected>Seleccione la jornada...</option>
                                <?php if(isset($jornadas)): ?>
                                    <?php foreach ($jornadas as $jor): ?>
                                        <option value="<?= $jor->id_jornada; ?>"><?= $jor->nombre; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="row g-4 mb-4">
                        <div class="col-12 col-md-4">
                            <label class="text-muted small fw-bold mb-2">Fecha de Inicio</label>
                            <input type="date" name="fecha_inicio" class="form-control input-date-sena shadow-sm" required>
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="text-muted small fw-bold mb-2">Inicio Etapa Práctica</label>
                            <input type="date" name="fecha_practicas" class="form-control input-date-sena shadow-sm" required>
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="text-muted small fw-bold mb-2">Fecha de Fin</label>
                            <input type="date" name="fecha_fin" class="form-control input-date-sena shadow-sm" required>
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-12 col-md-6">
                            <label class="text-muted small fw-bold mb-2">Cantidad de Aprendices Esperada</label>
                            <input type="number" name="cantidad_estudiantes" class="form-control select-sena shadow-sm" required placeholder="Ej. 30">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top-0 bg-light px-4 py-3 d-flex justify-content-end">
                    <button type="button" class="btn btn-outline-secondary px-4 rounded-pill fw-bold" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-new-ficha ms-2 border-0" style="padding: 0.6rem 1.4rem;"><i class="fa-solid fa-save"></i> Guardar Ficha</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL CARGA MASIVA USUARIOS -->
<div class="modal fade" id="modalCargaMasivaUsuarios" tabindex="-1" aria-labelledby="modalCargaMasivaUsuariosLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header border-bottom-0 bg-light px-4 py-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="box-icon-sena" style="color: #212529; background-color: #e9ecef;"><i class="fa-solid fa-file-csv"></i></div>
                    <h5 class="modal-title fw-bold text-dark" id="modalCargaMasivaUsuariosLabel">Carga Masiva de Usuarios</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= URLROOT; ?>/index.php?route=usuarios/importarMasivoCSV" method="POST" enctype="multipart/form-data">
                <div class="modal-body px-4 py-4 px-md-5">
                    <div class="alert alert-info small rounded-3 mb-4">
                        <i class="fa-solid fa-circle-info me-2"></i> Descarga la plantilla oficial, llénala con los datos correspondientes y súbela aquí. Las contraseñas serán autogeneradas.
                        <div class="mt-2 text-center">
                            <a href="<?= URLROOT; ?>/index.php?route=usuarios/descargarPlantillaCSV" class="btn btn-sm btn-outline-info shadow-sm bg-white fw-bold"><i class="fa-solid fa-download me-2"></i>Descargar Plantilla CSV</a>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="text-muted small fw-bold mb-3 d-block">¿Qué tipo de usuarios vas a cargar?</label>
                        <div class="d-flex gap-3">
                            <div class="form-check border rounded-3 p-3 flex-fill text-center cursor-pointer shadow-sm" style="cursor: pointer;" onclick="document.getElementById('rolInstructorMasivo').click()">
                                <input class="form-check-input float-none ms-0 mb-2" type="radio" name="rol_carga" id="rolInstructorMasivo" value="2" required onchange="toggleFichaMasiva(this.value)">
                                <label class="form-check-label d-block fw-bold" for="rolInstructorMasivo">Instructores</label>
                            </div>
                            <div class="form-check border rounded-3 p-3 flex-fill text-center cursor-pointer shadow-sm" style="cursor: pointer;" onclick="document.getElementById('rolAprendizMasivo').click()">
                                <input class="form-check-input float-none ms-0 mb-2" type="radio" name="rol_carga" id="rolAprendizMasivo" value="3" required onchange="toggleFichaMasiva(this.value)">
                                <label class="form-check-label d-block fw-bold" for="rolAprendizMasivo">Aprendices</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4" id="contenedorFichaMasiva" style="display: none;">
                        <label for="ficha_carga" class="text-muted small fw-bold mb-2">Asignar a Ficha (Obligatorio)</label>
                        <select name="numero_ficha" id="ficha_carga" class="form-select shadow-sm">
                            <option value="">Seleccione la ficha destino...</option>
                            <?php if (isset($fichas)): foreach ($fichas as $f): ?>
                                <option value="<?= $f->numero_ficha; ?>"><?= $f->numero_ficha; ?> - <?= $f->programa_nombre ?? 'Programa No Asignado'; ?></option>
                            <?php endforeach; endif; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="archivo_csv_usuarios" class="text-muted small fw-bold mb-2">Seleccione el Archivo CSV Lleno</label>
                        <input class="form-control form-control-lg shadow-sm" type="file" id="archivo_csv_usuarios" name="archivo_csv" accept=".csv" required>
                    </div>
                </div>
                <div class="modal-footer border-top-0 bg-light px-4 py-3 d-flex justify-content-end">
                    <button type="button" class="btn btn-outline-secondary px-4 rounded-pill fw-bold" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-dark ms-2 border-0 rounded-pill px-4" style="padding: 0.6rem 1.4rem;"><i class="fa-solid fa-upload"></i> Procesar Carga</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL CREAR NUEVO USUARIO -->
<div class="modal fade" id="modalCrearUsuario" tabindex="-1" aria-labelledby="modalCrearUsuarioLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header border-bottom-0 bg-light px-4 py-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="box-icon-sena" style="color: #0d6efd; background-color: #cfe2ff;"><i class="fa-solid fa-user-plus"></i></div>
                    <h5 class="modal-title fw-bold text-dark" id="modalCrearUsuarioLabel">Registrar Nuevo Usuario</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= URLROOT; ?>/index.php?route=usuarios/create" method="POST">
                <div class="modal-body px-4 py-4 px-md-5">
                    <div class="row g-4 mb-4">
                        <div class="col-12 col-md-6">
                            <label class="text-muted small fw-bold mb-2">Nombres</label>
                            <input type="text" name="nombre" class="form-control select-sena shadow-sm" required placeholder="Ej. Carlos Arturo" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+" title="El nombre solo debe contener letras.">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="text-muted small fw-bold mb-2">Apellidos</label>
                            <input type="text" name="apellido" class="form-control select-sena shadow-sm" required placeholder="Ej. Gómez" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+" title="El apellido solo debe contener letras.">
                        </div>
                    </div>

                    <div class="row g-4 mb-4">
                        <div class="col-12 col-md-6">
                            <label class="text-muted small fw-bold mb-2">Teléfono de Contacto</label>
                            <input type="text" name="telefono" class="form-control select-sena shadow-sm" required placeholder="Ej. 3019876543" inputmode="numeric" pattern="[0-9]{10}" maxlength="10" title="El teléfono debe tener exactamente 10 números.">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="text-muted small fw-bold mb-2">Correo Electrónico</label>
                            <input type="email" name="correo" class="form-control select-sena shadow-sm" required placeholder="Ej. correo@soy.sena.edu.co" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" title="El correo debe tener un formato válido (ejemplo@dominio.com).">
                        </div>
                    </div>

                    <div class="row g-4 mb-4">
                        <div class="col-12">
                            <label class="text-muted small fw-bold mb-2">Titulación o Nivel Académico</label>
                            <input type="text" name="titulacion" class="form-control select-sena shadow-sm" required placeholder="Ej. Ingeniero de Sistemas o Bachiller" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+" title="La titulación solo debe contener letras.">
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-12 col-md-4">
                            <label class="text-muted small fw-bold mb-2">Documento de Identidad (Login)</label>
                            <input type="text" inputmode="numeric" name="documento" class="form-control select-sena shadow-sm" required placeholder="Ej. 1020304050" pattern="[0-9]{6,10}" maxlength="10" title="El documento debe contener solo números, entre 6 y 10 dígitos.">
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="text-muted small fw-bold mb-2">Contraseña Inicial<span class="d-none d-md-inline"><br>&nbsp;</span></label>
                            <input type="text" name="contrasena" class="form-control select-sena shadow-sm" required placeholder="Ej. Pass123*" pattern="(?=[A-ZÑÁÉÍÓÚ])(?=.*\d)(?=.*[!@#$%^&amp;*(),.?&quot;:{}|&lt;&gt;[\]\\/_\-+=~'`;]).{8,30}" title="La contraseña debe iniciar con mayúscula, tener de 8 a 30 caracteres, e incluir un número y un carácter especial.">
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="text-muted small fw-bold mb-2">Rol Principal<span class="d-none d-md-inline"><br>&nbsp;</span></label>
                            <select name="id_rol" class="form-select select-sena shadow-sm" required>
                                <?php if(isset($roles)): foreach ($roles as $r): ?>
                                    <option value="<?= $r->id_rol; ?>"><?= $r->nombre_rol; ?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top-0 bg-light px-4 py-3 d-flex justify-content-end">
                    <button type="button" class="btn btn-outline-secondary px-4 rounded-pill fw-bold" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn shadow-sm border-0" style="background-color: #39A900; color: white; padding: 0.6rem 1.4rem; border-radius: 25px; font-weight: 600;" onmouseover="this.style.backgroundColor='#007832'" onmouseout="this.style.backgroundColor='#39A900'"><i class="fa-solid fa-floppy-disk"></i> Guardar Usuario</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDITAR FICHA -->


<!-- MODAL CREAR AMBIENTE -->
<div class="modal fade" id="modalCrearAmbiente" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-dark text-white px-4 py-4 border-0">
                <h5 class="modal-title fw-bold" id="modalCrearAmbienteLabel"><i class="fa-solid fa-building me-2 text-success"></i>Registrar Nuevo Ambiente</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <form action="<?= URLROOT; ?>/index.php?route=ambientes/create" method="POST" enctype="multipart/form-data">
                <div class="modal-body px-4 py-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nombre" class="form-label fw-medium text-secondary">Nombre del Ambiente</label>
                            <input type="text" class="form-control form-control-lg" id="nombre" name="nombre" placeholder="Ej. Laboratorio de Software 2" maxlength="15" required>
                        </div>
                        <div class="col-md-6">
                            <label for="tipo" class="form-label fw-medium text-secondary">Tipo (Ej. Laboratorio)</label>
                            <select class="form-select form-select-lg" id="tipo" name="tipo" onchange="toggleEspecialidad(this, 'especialidad_ambiente')" required>
                                <option value="" disabled selected>Seleccione un tipo</option>
                                <option value="Convencional">Convencional</option>
                                <option value="Especializado">Especializado</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="capacidad" class="form-label fw-medium text-secondary">Capacidad (Max 2 dígitos)</label>
                            <input type="text" class="form-control form-control-lg" id="capacidad" name="capacidad" placeholder="Ej. 35" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,2)" required>
                        </div>
                        <div class="col-md-4">
                            <label for="computadores" class="form-label fw-medium text-secondary">Cantidad de Computadores</label>
                            <input type="text" class="form-control form-control-lg" id="computadores" name="computadores" placeholder="Ej. 35" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,3)" required>
                        </div>
                        <div class="col-md-4" id="div_especialidad_ambiente" style="display:none;">
                            <label for="especialidad_ambiente" class="form-label fw-medium text-secondary">Especialidad del Ambiente</label>
                            <input type="text" class="form-control form-control-lg" id="especialidad_ambiente" name="especialidad_ambiente" placeholder="Ej. Desarrollo de Software, Redes, SST">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-medium text-secondary d-block mt-2 mb-2">Fotos del Ambiente (Opcional)</label>
                            <input type="file" class="form-control form-control-lg" name="fotos[]" multiple accept="image/*">
                            <small class="text-muted">Puedes seleccionar varias imágenes a la vez.</small>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-medium text-secondary d-block mb-3">Dotación e Instalaciones</label>
                            <div class="d-flex flex-wrap gap-4 bg-light p-3 rounded-3 border border-secondary-subtle">
                                <div class="form-check form-switch form-check-lg">
                                    <input class="form-check-input" type="checkbox" id="aire" name="aire" value="1" checked>
                                    <label class="form-check-label fw-medium" for="aire">Aire Acondicionado</label>
                                </div>
                                <div class="form-check form-switch form-check-lg">
                                    <input class="form-check-input" type="checkbox" id="ventilador" name="ventilador" value="1">
                                    <label class="form-check-label fw-medium" for="ventilador">Ventilador</label>
                                </div>
                                <div class="form-check form-switch form-check-lg">
                                    <input class="form-check-input" type="checkbox" id="tablero" name="tablero" value="1" checked>
                                    <label class="form-check-label fw-medium" for="tablero">Tablero / Pizarra</label>
                                </div>
                                <div class="form-check form-switch form-check-lg">
                                    <input class="form-check-input" type="checkbox" id="tv" name="tv" value="1" checked>
                                    <label class="form-check-label fw-medium" for="tv">Televisor</label>
                                </div>
                                <div class="form-check form-switch form-check-lg">
                                    <input class="form-check-input" type="checkbox" id="disponibilidad" name="disponibilidad" value="1" checked>
                                    <label class="form-check-label fw-medium text-success" for="disponibilidad">Disponible de Inmediato</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-4 border-0 bg-light d-flex justify-content-end">
                    <button type="button" class="btn btn-outline-secondary px-4 rounded-pill fw-bold" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary fw-bold shadow-sm ms-2" style="padding: 0.6rem 1.4rem; border-radius: 25px;"><i class="fa-solid fa-floppy-disk me-2"></i> Crear</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .modal-dialog.amb-edit-modal {
        max-width: 910px;
    }

    .amb-edit-modal .modal-content {
        border: 0;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 26px 70px rgba(15, 23, 42, 0.28);
    }

    .amb-edit-header {
        background: linear-gradient(135deg, #046b31 0%, #0b8e43 62%, #0f9f4c 100%);
        color: #ffffff;
        border: 0;
        padding: 1.45rem 1.7rem;
        min-height: 108px;
    }

    .amb-edit-header-icon {
        width: 58px;
        height: 58px;
        border-radius: 50%;
        background: #dff5e7;
        color: #0b8e43;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        flex: 0 0 auto;
    }

    .amb-edit-title {
        font-size: 1.45rem;
        font-weight: 800;
        line-height: 1.15;
        letter-spacing: 0;
    }

    .amb-edit-subtitle {
        color: rgba(255, 255, 255, 0.82);
        font-size: 0.92rem;
        margin-top: 0.2rem;
    }

    .amb-edit-close {
        filter: invert(1) grayscale(100%) brightness(2);
        opacity: 0.9;
        box-shadow: none;
    }

    .amb-edit-body {
        padding: 1.6rem 1.85rem 1.4rem;
        background: #ffffff;
    }

    .amb-edit-label {
        color: #374151;
        font-size: 0.9rem;
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 0.55rem;
        margin-bottom: 0.6rem;
    }

    .amb-edit-label i {
        color: #0b8e43;
        font-size: 0.95rem;
    }

    .amb-edit-input,
    .amb-edit-select {
        min-height: 52px;
        border: 1px solid #d8dee8;
        border-radius: 9px;
        color: #111827;
        font-size: 1rem;
        box-shadow: none;
        padding: 0.72rem 0.95rem;
    }

    .amb-edit-input:focus,
    .amb-edit-select:focus {
        border-color: #0b8e43;
        box-shadow: 0 0 0 3px rgba(11, 142, 67, 0.12);
    }

    .amb-edit-upload {
        position: relative;
        display: grid;
        grid-template-columns: auto 1fr auto;
        align-items: center;
        gap: 1rem;
        min-height: 88px;
        border: 1px dashed #cfd7e2;
        border-radius: 10px;
        background: #ffffff;
        padding: 1rem 1.2rem;
        cursor: pointer;
        transition: border-color 0.2s ease, background 0.2s ease;
    }

    .amb-edit-upload:hover {
        border-color: #0b8e43;
        background: #fbfefc;
    }

    .amb-edit-upload-icon {
        width: 54px;
        height: 54px;
        border-radius: 50%;
        background: #e8f7ed;
        color: #0b8e43;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.55rem;
    }

    .amb-edit-upload-title {
        color: #111827;
        font-size: 1rem;
        font-weight: 800;
        line-height: 1.1;
    }

    .amb-edit-upload-subtitle {
        color: #6b7280;
        font-size: 0.9rem;
        margin-top: 0.25rem;
    }

    .amb-edit-upload-pill {
        border-radius: 999px;
        background: #e8f7ed;
        color: #157347;
        font-size: 0.85rem;
        font-weight: 700;
        padding: 0.45rem 1.1rem;
        white-space: nowrap;
    }

    .amb-edit-file-input {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    .amb-edit-help {
        color: #6b7280;
        font-size: 0.86rem;
        margin-top: 0.7rem;
    }

    .amb-edit-equipment {
        border: 1px solid #d8dee8;
        border-radius: 10px;
        padding: 1.1rem 1.15rem;
        display: grid;
        grid-template-columns: repeat(4, minmax(130px, 1fr));
        gap: 1rem 1.25rem;
        background: #ffffff;
    }

    .amb-edit-switch {
        display: flex;
        align-items: center;
        gap: 0.65rem;
        min-width: 0;
        padding-left: 0;
        margin-bottom: 0;
    }

    .amb-edit-switch .form-check-input {
        width: 2.6rem;
        height: 1.35rem;
        margin: 0;
        cursor: pointer;
        flex: 0 0 auto;
    }

    .amb-edit-switch .form-check-input:checked {
        background-color: #0b8e43;
        border-color: #0b8e43;
    }

    .amb-edit-switch .form-check-input:focus {
        box-shadow: 0 0 0 3px rgba(11, 142, 67, 0.15);
        border-color: #0b8e43;
    }

    .amb-edit-switch-icon {
        color: #0b8e43;
        font-size: 1.05rem;
        flex: 0 0 auto;
    }

    .amb-edit-switch-label {
        color: #1f2937;
        font-size: 0.9rem;
        font-weight: 750;
        line-height: 1.15;
    }

    .amb-edit-footer {
        background: #ffffff;
        border-top: 1px solid #e5e7eb;
        padding: 1.15rem 1.85rem;
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
    }

    .amb-edit-cancel,
    .amb-edit-save {
        min-width: 150px;
        min-height: 46px;
        border-radius: 999px;
        font-weight: 800;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.55rem;
    }

    .amb-edit-cancel {
        color: #4b5563;
        border: 1px solid #aeb7c4;
        background: #ffffff;
    }

    .amb-edit-cancel:hover {
        border-color: #6b7280;
        background: #f9fafb;
        color: #111827;
    }

    .amb-edit-save {
        border: 0;
        background: #0b8e43;
        color: #ffffff;
        box-shadow: 0 10px 22px rgba(11, 142, 67, 0.22);
    }

    .amb-edit-save:hover {
        background: #087638;
        color: #ffffff;
    }

    @media (max-width: 767.98px) {
        .amb-edit-modal .modal-dialog {
            margin: 0.75rem;
        }

        .amb-edit-body {
            padding: 1.2rem;
        }

        .amb-edit-upload {
            grid-template-columns: auto 1fr;
        }

        .amb-edit-upload-pill {
            grid-column: 1 / -1;
            justify-self: start;
        }

        .amb-edit-equipment {
            grid-template-columns: 1fr;
        }

        .amb-edit-footer {
            flex-direction: column-reverse;
        }

        .amb-edit-cancel,
        .amb-edit-save {
            width: 100%;
        }
    }

    .pm-training-calendar {
        border: 1px solid #e3e8ef;
        border-radius: 14px;
        background: #ffffff;
        box-shadow: 0 12px 30px rgba(15, 23, 42, 0.06);
        overflow: hidden;
    }

    .schedule-modal-dialog {
        max-width: min(1120px, calc(100vw - 2rem));
    }

    .pm-calendar-topbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        padding: 1.25rem;
        background: #ffffff;
    }

    .pm-calendar-title-wrap {
        display: flex;
        align-items: center;
        gap: 0.9rem;
        min-width: 0;
    }

    .pm-calendar-icon {
        display: grid;
        width: 42px;
        height: 42px;
        min-width: 42px;
        place-items: center;
        border-radius: 10px;
        background: #e8f7ed;
        color: #0b8e43;
        font-size: 1.25rem;
    }

    .pm-calendar-title {
        color: #0f172a;
        font-size: 1.2rem;
        font-weight: 850;
        line-height: 1.15;
        margin: 0;
    }

    .pm-calendar-subtitle {
        color: #52637a;
        font-size: 0.9rem;
        margin-top: 0.2rem;
    }

    .pm-calendar-controls {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex: 0 0 auto;
    }

    .pm-calendar-nav,
    .pm-calendar-month {
        min-height: 42px;
        border: 1px solid #d8dee8;
        border-radius: 10px;
        background: #ffffff;
        color: #0f172a;
        font-weight: 800;
        box-shadow: 0 4px 12px rgba(15, 23, 42, 0.03);
    }

    .pm-calendar-nav {
        width: 46px;
        display: inline-grid;
        place-items: center;
    }

    .pm-calendar-month {
        min-width: 170px;
        padding: 0 1rem;
    }

    .pm-calendar-counter {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        margin: 0 1.25rem 1rem;
        padding: 0.9rem 1rem;
        border-radius: 10px;
        background: linear-gradient(90deg, #eff8ff 0%, #dff1ff 100%);
        color: #0b3a78;
    }

    .pm-calendar-counter-label {
        display: inline-flex;
        align-items: center;
        gap: 0.7rem;
        font-size: 1rem;
        font-weight: 850;
    }

    .pm-calendar-counter-value {
        color: #0f172a;
        font-size: 1.25rem;
        font-weight: 900;
    }

    .pm-calendar-counter-value .pm-counter-current {
        color: #dc2626;
    }

    .pm-calendar-message {
        display: none;
        margin: -0.35rem 1.25rem 1rem;
        padding: 0.65rem 0.85rem;
        border-radius: 9px;
        background: #fff7ed;
        color: #9a3412;
        font-size: 0.82rem;
        font-weight: 750;
    }

    .pm-calendar-message.show {
        display: block;
    }

    .pm-calendar-weekdays {
        display: grid;
        grid-template-columns: repeat(7, minmax(0, 1fr));
        margin: 0 1.25rem 0;
        border: 1px solid #18a15b;
        border-radius: 10px;
        overflow: hidden;
    }

    .pm-calendar-weekday-btn {
        min-height: 42px;
        display: grid;
        place-items: center;
        width: 100%;
        border: 0;
        border-right: 1px solid #18a15b;
        background: #ffffff;
        color: #087a43;
        font-weight: 850;
        transition: background-color 0.16s ease, color 0.16s ease;
    }

    .pm-calendar-weekday-btn:last-child {
        border-right: 0;
    }

    .pm-calendar-weekday-btn:hover,
    .pm-calendar-weekday-btn.is-active {
        background: #0b8e43;
        color: #ffffff;
    }

    .pm-calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, minmax(0, 1fr));
        margin: 1rem 1.25rem 0;
        border: 1px solid #e3e8ef;
        border-radius: 10px;
        overflow: hidden;
        background: #ffffff;
    }

    .pm-calendar-cell {
        position: relative;
        min-height: 94px;
        padding: 0.65rem;
        border-right: 1px solid #e8edf3;
        border-bottom: 1px solid #e8edf3;
        background: #ffffff;
        cursor: pointer;
        transition: background-color 0.16s ease, box-shadow 0.16s ease;
    }

    .pm-calendar-cell:nth-child(7n) {
        border-right: 0;
    }

    .pm-calendar-cell:nth-last-child(-n + 7) {
        border-bottom: 0;
    }

    .pm-calendar-cell:hover:not(.is-disabled) {
        background: #f8fffb;
        box-shadow: inset 0 0 0 2px rgba(11, 142, 67, 0.12);
    }

    .pm-calendar-cell.is-other-month {
        background: #f8fafc;
        color: #7a8798;
    }

    .pm-calendar-cell.is-disabled {
        background: #f5f6f8;
        color: #a8b0bd;
        cursor: not-allowed;
    }

    .pm-calendar-cell.is-selected {
        background: #f0fbf3;
        box-shadow: inset 0 0 0 2px rgba(11, 142, 67, 0.2);
    }

    .pm-calendar-day {
        display: flex;
        align-items: baseline;
        gap: 0.35rem;
        color: #0f172a;
        font-weight: 850;
        line-height: 1;
    }

    .pm-calendar-cell.is-other-month .pm-calendar-day,
    .pm-calendar-cell.is-disabled .pm-calendar-day {
        color: inherit;
    }

    .pm-calendar-day-number {
        font-size: 1rem;
    }

    .pm-calendar-day-month {
        color: #55708f;
        font-size: 0.78rem;
        font-weight: 650;
    }

    .pm-session-chip {
        position: absolute;
        left: 0.65rem;
        right: 0.65rem;
        top: 2.45rem;
        display: flex;
        align-items: center;
        gap: 0.45rem;
        min-height: 42px;
        padding: 0.45rem 1.7rem 0.45rem 0.55rem;
        border: 0;
        border-radius: 8px;
        background: #dff5e4;
        color: #0f172a;
        font-size: 0.76rem;
        line-height: 1.05;
        text-align: left;
        box-shadow: 0 8px 18px rgba(16, 185, 129, 0.12);
    }

    .pm-session-chip i {
        color: #16a34a;
        font-size: 1rem;
        flex: 0 0 auto;
    }

    .pm-session-remove {
        position: absolute;
        right: 0.4rem;
        top: 50%;
        transform: translateY(-50%);
        display: grid;
        width: 20px;
        height: 20px;
        place-items: center;
        border: 0;
        border-radius: 50%;
        background: transparent;
        color: #ef4444;
        font-size: 0.75rem;
    }

    .pm-calendar-legend {
        display: flex;
        align-items: center;
        gap: 2rem;
        flex-wrap: wrap;
        margin: 1rem 1.25rem 1.25rem;
        padding: 0.9rem 1rem;
        border: 1px solid #e3e8ef;
        border-radius: 10px;
        color: #40516a;
        font-size: 0.86rem;
    }

    .pm-calendar-legend-item {
        display: inline-flex;
        align-items: center;
        gap: 0.55rem;
    }

    .pm-legend-icon {
        display: grid;
        width: 22px;
        height: 22px;
        place-items: center;
        border-radius: 50%;
        color: #16a34a;
        font-size: 1rem;
    }

    .pm-legend-square {
        width: 22px;
        height: 22px;
        border-radius: 6px;
        background: #dff5e4;
    }

    .pm-legend-square.is-empty {
        background: #eef0f3;
    }

    @media (max-width: 767.98px) {
        .pm-calendar-topbar {
            align-items: stretch;
            flex-direction: column;
        }

        .pm-calendar-controls {
            width: 100%;
            justify-content: space-between;
        }

        .pm-calendar-month {
            min-width: 0;
            flex: 1 1 auto;
        }

        .pm-calendar-weekdays,
        .pm-calendar-grid {
            margin-left: 0.75rem;
            margin-right: 0.75rem;
        }

        .pm-calendar-counter,
        .pm-calendar-message,
        .pm-calendar-legend {
            margin-left: 0.75rem;
            margin-right: 0.75rem;
        }

        .pm-calendar-cell {
            min-height: 82px;
            padding: 0.45rem;
        }

        .pm-session-chip {
            left: 0.4rem;
            right: 0.4rem;
            top: 2rem;
            min-height: 36px;
            font-size: 0.68rem;
        }

        .pm-calendar-legend {
            gap: 1rem;
        }
    }
</style>

<!-- MODAL EDITAR AMBIENTE -->
<div class="modal fade" id="modalEditarAmbiente" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered amb-edit-modal">
        <div class="modal-content">
            <div class="modal-header amb-edit-header">
                <div class="d-flex align-items-center gap-3">
                    <span class="amb-edit-header-icon" aria-hidden="true">
                        <i class="fa-regular fa-clock"></i>
                    </span>
                    <div>
                        <h5 class="modal-title amb-edit-title" id="modalEditarAmbienteLabel">Editar Ambiente</h5>
                        <div class="amb-edit-subtitle">Actualiza la información del ambiente físico</div>
                    </div>
                </div>
                <button type="button" class="btn-close amb-edit-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <form action="<?= URLROOT; ?>/index.php?route=ambientes/update" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_numero_ambiente" id="edit_amb_id">
                <div class="modal-body amb-edit-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="amb-edit-label" for="edit_amb_nombre">
                                <i class="fa-regular fa-clipboard"></i> Nombre del Ambiente
                            </label>
                            <input type="text" class="form-control amb-edit-input" id="edit_amb_nombre" name="nombre" maxlength="15" required>
                        </div>
                        <div class="col-md-6">
                            <label class="amb-edit-label" for="edit_amb_tipo">
                                <i class="fa-solid fa-layer-group"></i> Tipo
                            </label>
                            <select class="form-select amb-edit-select" id="edit_amb_tipo" name="tipo" onchange="toggleEspecialidad(this, 'edit_amb_especialidad')" required>
                                <option value="Convencional">Convencional</option>
                                <option value="Especializado">Especializado</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="amb-edit-label" for="edit_amb_capacidad">
                                <i class="fa-regular fa-id-badge"></i> Capacidad (Max 2 dígitos)
                            </label>
                            <input type="text" class="form-control amb-edit-input" id="edit_amb_capacidad" name="capacidad" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,2)" required>
                        </div>
                        <div class="col-md-4">
                            <label class="amb-edit-label" for="edit_amb_computadores">
                                <i class="fa-solid fa-desktop"></i> Cantidad de Computadores
                            </label>
                            <input type="text" class="form-control amb-edit-input" id="edit_amb_computadores" name="computadores" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,3)" required>
                        </div>
                        <div class="col-md-4" id="div_edit_amb_especialidad" style="display:none;">
                            <label class="amb-edit-label" for="edit_amb_especialidad">
                                <i class="fa-solid fa-graduation-cap"></i> Especialidad del Ambiente
                            </label>
                            <input type="text" class="form-control amb-edit-input" id="edit_amb_especialidad" name="especialidad_ambiente">
                        </div>
                        <div class="col-12">
                            <label class="amb-edit-label" for="edit_amb_fotos">
                                <i class="fa-regular fa-image"></i> Agregar Nuevas Fotos (Opcional)
                            </label>
                            <label class="amb-edit-upload" for="edit_amb_fotos">
                                <span class="amb-edit-upload-icon" aria-hidden="true">
                                    <i class="fa-solid fa-cloud-arrow-up"></i>
                                </span>
                                <span>
                                    <span class="amb-edit-upload-title d-block">Elegir archivos</span>
                                    <span class="amb-edit-upload-subtitle d-block">o arrastra y suelta imágenes aquí</span>
                                </span>
                                <span class="amb-edit-upload-pill" id="edit_amb_fotos_status">Sin archivos seleccionados</span>
                                <input type="file" class="amb-edit-file-input" id="edit_amb_fotos" name="fotos[]" multiple accept="image/*">
                            </label>
                            <div class="amb-edit-help">Puedes seleccionar varias imágenes. Las existentes se mantendrán.</div>
                        </div>
                        <div class="col-12">
                            <label class="amb-edit-label">
                                <i class="fa-solid fa-screwdriver-wrench"></i> Dotación e Instalaciones
                            </label>
                            <div class="amb-edit-equipment">
                                <div class="form-check form-switch amb-edit-switch">
                                    <input class="form-check-input" type="checkbox" id="edit_amb_aire" name="aire" value="1">
                                    <i class="fa-regular fa-snowflake amb-edit-switch-icon"></i>
                                    <label class="form-check-label amb-edit-switch-label" for="edit_amb_aire">Aire Acondicionado</label>
                                </div>
                                <div class="form-check form-switch amb-edit-switch">
                                    <input class="form-check-input" type="checkbox" id="edit_amb_vent" name="ventilador" value="1">
                                    <i class="fa-solid fa-fan amb-edit-switch-icon"></i>
                                    <label class="form-check-label amb-edit-switch-label" for="edit_amb_vent">Ventilador</label>
                                </div>
                                <div class="form-check form-switch amb-edit-switch">
                                    <input class="form-check-input" type="checkbox" id="edit_amb_tablero" name="tablero" value="1">
                                    <i class="fa-solid fa-chalkboard amb-edit-switch-icon"></i>
                                    <label class="form-check-label amb-edit-switch-label" for="edit_amb_tablero">Tablero / Pizarra</label>
                                </div>
                                <div class="form-check form-switch amb-edit-switch">
                                    <input class="form-check-input" type="checkbox" id="edit_amb_tv" name="tv" value="1">
                                    <i class="fa-solid fa-tv amb-edit-switch-icon"></i>
                                    <label class="form-check-label amb-edit-switch-label" for="edit_amb_tv">Televisor</label>
                                </div>
                                <div class="form-check form-switch amb-edit-switch">
                                    <input class="form-check-input" type="checkbox" id="edit_amb_disp" name="disponibilidad" value="1">
                                    <i class="fa-regular fa-circle-check amb-edit-switch-icon"></i>
                                    <label class="form-check-label amb-edit-switch-label" for="edit_amb_disp">Disponible</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer amb-edit-footer">
                    <button type="button" class="btn amb-edit-cancel" data-bs-dismiss="modal">
                        <i class="fa-regular fa-circle-xmark"></i> Cancelar
                    </button>
                    <button type="submit" class="btn amb-edit-save">
                        <i class="fa-regular fa-floppy-disk"></i> Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDITAR PROGRAMA COMPLETO (AJAX) -->
<div class="modal fade" id="modalEditarPrograma" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden bg-white">
            <div class="modal-header bg-success text-white p-4 border-0 position-relative">
                <div class="d-flex align-items-center">
                    <div class="bg-white rounded-circle d-flex justify-content-center align-items-center me-3 shadow-sm" style="width: 48px; height: 48px;">
                        <i class="fa-solid fa-pen-to-square text-success fs-4"></i>
                    </div>
                    <div>
                        <h4 class="modal-title fw-bold mb-1">Editar Programa Formativo</h4>
                        <p class="mb-0 small text-white-50">Actualiza los datos del programa seleccionado.</p>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 mt-4 me-4" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body p-0 position-relative" style="background: #ffffff; min-height: 400px;">
                <div class="d-flex justify-content-center align-items-center position-absolute top-0 start-0 w-100 h-100 bg-white" id="loaderEditarPrograma" style="z-index:10;">
                    <div class="text-center">
                        <div class="spinner-border text-primary mb-2" role="status" style="width: 3rem; height: 3rem;"></div>
                        <div class="text-muted fw-bold">Cargando información...</div>
                    </div>
                </div>
                <div id="contenedorEditarPrograma" class="w-100 h-100 overflow-auto"></div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Confirmación de Eliminación de Programa -->
<div class="modal fade" id="modalEliminarPrograma" tabindex="-1" aria-labelledby="modalEliminarProgramaLabel" aria-hidden="true" style="backdrop-filter: blur(5px); background-color: rgba(0,0,0,0.5);">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg text-center p-4">
            <div class="modal-body">
                <div class="mb-4 text-danger">
                    <div style="width: 80px; height: 80px; background-color: #fee2e2; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                        <i class="fa-solid fa-trash-can" style="font-size: 2.5rem;"></i>
                    </div>
                </div>
                <h4 class="fw-bold text-dark mb-2">¿Eliminar Programa?</h4>
                <p class="text-muted mb-4" style="font-size: 0.95rem;">Se eliminará este programa junto con todas sus competencias y resultados. Esta acción no se puede deshacer.</p>
                <div class="d-flex justify-content-center gap-3">
                    <button type="button" class="btn btn-light border px-4 py-2 fw-medium shadow-sm text-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <a href="#" id="btnConfirmarEliminarPrograma" class="btn btn-danger px-4 py-2 fw-bold shadow-sm" style="background-color: #dc2626; border-color: #dc2626;">Sí, eliminar</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detalles de Programación del Instructor -->
<div class="modal fade" id="modalDetalleInstructor" tabindex="-1" aria-labelledby="modalDetalleInstructorLabel" aria-hidden="true" style="backdrop-filter: blur(5px); background-color: rgba(0,0,0,0.5);">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg bg-white">
            <div class="modal-header bg-dark text-white p-4 border-0">
                <h5 class="modal-title fw-bold" id="modalDetalleInstructorLabel"><i class="fa-solid fa-chalkboard-user me-2 text-primary"></i>Programación del Instructor</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body p-4">
                <div class="d-flex align-items-center gap-3 mb-4 p-3 bg-light rounded-3 border">
                    <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                        <i class="fa-solid fa-user-tie fs-2"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold text-dark mb-1" id="instNombreDetalle">Nombre del Instructor</h4>
                        <span class="badge bg-primary text-uppercase" style="font-size: 0.75rem;">Docente Formador</span>
                    </div>
                </div>
                <h6 class="fw-bold text-secondary mb-3">Sesiones y Horarios Asignados</h6>
                <div class="table-responsive">
                    <table class="table table-hover align-middle border rounded overflow-hidden mb-0" id="tablaDetalleInstructor">
                        <thead class="table-light text-secondary small text-uppercase" style="font-size: 0.75rem; font-weight: 700;">
                            <tr>
                                <th class="ps-3 py-3">FICHA</th>
                                <th class="py-3">PROGRAMA</th>
                                <th class="py-3">COMPETENCIA / RAP</th>
                                <th class="text-end pe-3 py-3">SESIONES</th>
                            </tr>
                        </thead>
                        <tbody id="cuerpoDetalleInstructor">
                            <!-- Inyectado dinámicamente -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer p-3 border-0 bg-light d-flex justify-content-end">
                <button type="button" class="btn btn-outline-secondary px-4 rounded-pill fw-bold" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL CREAR PROGRAMA -->
<div class="modal fade" id="modalCrearPrograma" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <!-- Header Verde Institucional SENA -->
            <div class="modal-header bg-success text-white p-4 border-0 position-relative">
                <div class="d-flex align-items-center">
                    <div class="bg-white rounded-circle d-flex justify-content-center align-items-center me-3 shadow-sm" style="width: 48px; height: 48px;">
                        <i class="fa-solid fa-graduation-cap text-success fs-4"></i>
                    </div>
                    <div>
                        <h4 class="modal-title fw-bold mb-1">Registrar Nuevo Programa</h4>
                        <p class="mb-0 small text-white-50">Crea un nuevo programa de formación en el catálogo.</p>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 mt-4 me-4" data-bs-dismiss="modal"></button>
            </div>
            
            <form action="<?= URLROOT; ?>/index.php?route=programas/create" method="POST">
                <div class="modal-body p-4 p-md-5">
                    <div class="row g-4">
                        <!-- Nombre del Programa -->
                        <div class="col-md-12">
                            <label class="form-label fw-bold text-dark small mb-2"><i class="fa-solid fa-book text-success me-2"></i> Nombre del Programa</label>
                            <input type="text" class="form-control form-control-lg rounded-3" name="nombre" placeholder="Ej. Producción Multimedia" required>
                        </div>
                        
                        <!-- Código y Tipo -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-dark small mb-2"><i class="fa-solid fa-hashtag text-success me-2"></i> Código</label>
                            <input type="text" class="form-control form-control-lg rounded-3" name="codigo" placeholder="Ej. 228190" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-dark small mb-2"><i class="fa-solid fa-tags text-success me-2"></i> Tipo de Programa</label>
                            <select class="form-select form-select-lg rounded-3" name="id_tipo_programa" required>
                                <option value="" disabled selected>Selecciona un tipo...</option>
                                <?php if(isset($tipos)): foreach($tipos as $t): ?>
                                    <option value="<?= $t->id_tipo_programa; ?>"><?= htmlspecialchars($t->nombre); ?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                        
                        <!-- Versión y Vigencia -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-dark small mb-2"><i class="fa-solid fa-code-branch text-success me-2"></i> Versión</label>
                            <input type="text" class="form-control form-control-lg rounded-3" name="version" placeholder="Ej. V1" value="V1" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-dark small mb-2"><i class="fa-solid fa-calendar-check text-success me-2"></i> Vigencia</label>
                            <input type="text" class="form-control form-control-lg rounded-3" name="vigencia" placeholder="Ej. 2026" value="2026" required>
                        </div>
                        
                        <!-- Duraciones -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-dark small mb-2"><i class="fa-solid fa-clock text-success me-2"></i> Duración Lectiva (hrs)</label>
                            <input type="number" class="form-control form-control-lg rounded-3" name="duracion_lectiva" placeholder="Ej. 3120" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-dark small mb-2"><i class="fa-solid fa-briefcase text-success me-2"></i> Duración Práctica (hrs)</label>
                            <input type="number" class="form-control form-control-lg rounded-3" name="duracion_practica" placeholder="Ej. 864" required>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer p-4 border-top-0 d-flex justify-content-end gap-2 bg-white">
                    <button type="button" class="btn btn-light border rounded-pill px-4 fw-bold text-secondary" data-bs-dismiss="modal">
                        <i class="fa-regular fa-circle-xmark me-1"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-success rounded-pill px-4 fw-bold shadow-sm">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Guardar Programa
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDITAR PROGRAMA -->
<div class="modal fade" id="modalEditarPrograma" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-light px-4 py-4">
                <h5 class="modal-title fw-bold text-dark">Editar Programa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= URLROOT; ?>/index.php?route=programas/update" method="POST">
                <input type="hidden" name="id_programa" id="edit_prog_id">
                <div class="modal-body px-4 py-4">
                    <div class="row g-3 mb-3">
                        <div class="col-md-8">
                            <label class="text-muted small fw-bold mb-1">Nombre Programa</label>
                            <input type="text" name="nombre" id="edit_prog_nombre" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted small fw-bold mb-1">Código</label>
                            <input type="text" name="codigo" id="edit_prog_codigo" class="form-control" required>
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="text-muted small fw-bold mb-1">Versión</label>
                            <input type="text" name="version" id="edit_prog_version" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted small fw-bold mb-1">Vigencia</label>
                            <input type="text" name="vigencia" id="edit_prog_vigencia" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted small fw-bold mb-1">Tipo Programa</label>
                            <select name="id_tipo_programa" id="edit_prog_tipo" class="form-select" required>
                                <?php if(isset($tipos)): foreach($tipos as $t): ?>
                                    <option value="<?= $t->id_tipo_programa; ?>"><?= $t->nombre; ?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="text-muted small fw-bold mb-1">Duración Lectiva (hrs)</label>
                            <input type="number" name="duracion_lectiva" id="edit_prog_lectiva" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small fw-bold mb-1">Duración Práctica (hrs)</label>
                            <input type="number" name="duracion_practica" id="edit_prog_practica" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="submit" class="btn btn-primary rounded-pill">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDITAR USUARIO -->
<div class="modal fade" id="modalEditarUsuario" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-light px-4 py-4">
                <h5 class="modal-title fw-bold text-dark">Editar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= URLROOT; ?>/index.php?route=usuarios/update" method="POST">
                <input type="hidden" name="id_usuario" id="edit_usr_id">
                <div class="modal-body px-4 py-4">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="text-muted small fw-bold mb-1">Nombres</label>
                            <input type="text" name="nombre" id="edit_usr_nombre" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small fw-bold mb-1">Apellidos</label>
                            <input type="text" name="apellido" id="edit_usr_apellido" class="form-control" required>
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="text-muted small fw-bold mb-1">Documento</label>
                            <input type="number" name="documento" id="edit_usr_documento" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small fw-bold mb-1">Contraseña (Opcional)</label>
                            <input type="text" name="contrasena" placeholder="Dejar en blanco para no cambiar" class="form-control">
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="text-muted small fw-bold mb-1">Teléfono</label>
                            <input type="text" name="telefono" id="edit_usr_telefono" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small fw-bold mb-1">Correo</label>
                            <input type="email" name="correo" id="edit_usr_correo" class="form-control" required>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="text-muted small fw-bold mb-1">Titulación</label>
                            <input type="text" name="titulacion" id="edit_usr_titulacion" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small fw-bold mb-1">Rol Principal</label>
                            <select name="id_rol" id="edit_usr_rol" class="form-select" required>
                                <?php if(isset($roles)): foreach ($roles as $r): ?>
                                    <option value="<?= $r->id_rol; ?>"><?= $r->nombre_rol; ?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="submit" class="btn btn-primary rounded-pill">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Crear Competencia -->
<div class="modal fade" id="modalCrearCompetencia" tabindex="-1" aria-labelledby="modalCrearCompetenciaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header bg-dark text-white p-4 border-0">
                <h5 class="modal-title fw-bold" id="modalCrearCompetenciaLabel"><i class="fa-solid fa-book-medical me-2 text-success"></i>Registrar Competencia</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <form action="<?= URLROOT; ?>/index.php?route=programas/createCompetencia" method="POST">
                <input type="hidden" name="redirect" value="dashboard/index#pills-programas">
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="id_programa_comp" class="form-label fw-medium text-secondary">Programa de Formación</label>
                            <select class="form-select form-select-lg" id="id_programa_comp" name="id_programa" required>
                                <option value="">Selecciona un programa...</option>
                                <?php foreach ($programas as $prog): ?>
                                    <option value="<?= $prog->id_programa; ?>"><?= htmlspecialchars($prog->nombre) . ' (' . htmlspecialchars($prog->codigo) . ')'; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-8">
                            <label for="nombre_comp" class="form-label fw-medium text-secondary">Nombre de la Competencia</label>
                            <input type="text" class="form-control form-control-lg" id="nombre_comp" name="nombre" placeholder="Ej. Programar aplicaciones web" required>
                        </div>
                        <div class="col-md-4">
                            <label for="codigo_comp" class="form-label fw-medium text-secondary">Código Competencia</label>
                            <input type="text" class="form-control form-control-lg" id="codigo_comp" name="codigo" placeholder="Ej. 220501099" required>
                        </div>
                        <div class="col-md-4">
                            <label for="horas_totales" class="form-label fw-medium text-secondary">Horas Totales</label>
                            <input type="number" class="form-control form-control-lg" id="horas_totales" name="horas_totales" placeholder="Ej. 180" required>
                        </div>
                        <div class="col-md-4">
                            <label for="resultados_totales" class="form-label fw-medium text-secondary">Resultados Totales (RA)</label>
                            <input type="number" class="form-control form-control-lg" id="resultados_totales" name="resultados_totales" placeholder="Ej. 3" required>
                        </div>
                        <div class="col-md-4">
                            <label for="porcentaje" class="form-label fw-medium text-secondary">Porcentaje (%)</label>
                            <input type="number" class="form-control form-control-lg" id="porcentaje" name="porcentaje" placeholder="Ej. 100" value="100" required>
                        </div>
                        
                        <!-- Campos Calculados Dinámicamente en el cliente -->
                        <div class="col-md-6 mt-3">
                            <div class="p-3 bg-light rounded-3 border">
                                <span class="d-block text-muted small fw-bold">Horas a Ejecutar</span>
                                <h4 class="m-0 fw-bold text-success" id="calc_horas_ejecutar">0 hrs</h4>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="p-3 bg-light rounded-3 border">
                                <span class="d-block text-muted small fw-bold">Total Sesiones (de 6 horas)</span>
                                <h4 class="m-0 fw-bold text-primary" id="calc_total_sesiones">0 sesiones</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-4 border-0 bg-light">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success fw-bold shadow-sm"><i class="fa-solid fa-floppy-disk me-2"></i> Guardar Competencia</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Crear Resultado -->
<div class="modal fade" id="modalCrearResultado" tabindex="-1" aria-labelledby="modalCrearResultadoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header bg-dark text-white p-4 border-0">
                <h5 class="modal-title fw-bold" id="modalCrearResultadoLabel"><i class="fa-solid fa-file-pen me-2 text-warning"></i>Registrar Resultado de Aprendizaje</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <form action="<?= URLROOT; ?>/index.php?route=programas/createResultado" method="POST">
                <input type="hidden" name="redirect" value="dashboard/index#pills-programas">
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="id_competencia_ra" class="form-label fw-medium text-secondary">Competencia Asociada</label>
                            <select class="form-select form-select-lg" id="id_competencia_ra" name="id_competencia" onchange="calcularSesionesResultado('ra')" required>
                                <option value="" data-total-sesiones="0" data-resultados-totales="0" data-resultados-actuales="0" data-sesiones-usadas="0">Selecciona una competencia...</option>
                                <?php foreach ($competencias as $comp): 
                                    $raComp = array_filter($resultados ?? [], function($r) use ($comp) {
                                        return $r->id_competencia == $comp->id_competencia;
                                    });
                                    $resultados_actuales = count($raComp);
                                    $sesiones_usadas = 0;
                                    foreach ($raComp as $r) {
                                        $sesiones_usadas += ($r->sesiones_asignadas ?? 0);
                                    }
                                ?>
                                    <option value="<?= $comp->id_competencia; ?>" 
                                            data-total-sesiones="<?= $comp->total_sesiones; ?>"
                                            data-resultados-totales="<?= $comp->resultados_totales; ?>"
                                            data-resultados-actuales="<?= $resultados_actuales; ?>"
                                            data-sesiones-usadas="<?= $sesiones_usadas; ?>">
                                        <?= htmlspecialchars($comp->codigo) . ' - ' . htmlspecialchars($comp->nombre); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Campos Calculados Dinámicamente para el Resultado -->
                        <div class="col-md-4 mt-3">
                            <div class="p-3 bg-light rounded-3 border">
                                <span class="d-block text-muted small fw-bold">Sesiones de la Competencia</span>
                                <h5 class="m-0 fw-bold text-success" id="ra_total_sesiones">0 sesiones</h5>
                            </div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <div class="p-3 bg-light rounded-3 border">
                                <span class="d-block text-muted small fw-bold">Resultados (Actuales / Límite)</span>
                                <h5 class="m-0 fw-bold text-primary" id="ra_resultados_status">0 / 0</h5>
                            </div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <div class="p-3 bg-light rounded-3 border">
                                <span class="d-block text-muted small fw-bold">Sesiones (Usadas / Disponibles)</span>
                                <h5 class="m-0 fw-bold text-warning-emphasis" id="ra_sesiones_status">0 / 0</h5>
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="alert alert-info py-2 px-3 mb-0 small border-0 shadow-sm" id="ra_info_calculo" style="display:none; background-color: #e0f2f1; color: #00796b;">
                                <i class="fa-solid fa-calculator me-1"></i> El Trigger de la base de datos asignará automáticamente <strong><span id="ra_sugerido">0</span> sesiones</strong> por resultado de aprendizaje si dejas el campo vacío.
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="codigo_ra" class="form-label fw-medium text-secondary">Código RA</label>
                            <input type="text" class="form-control form-control-lg" id="codigo_ra" name="codigo" placeholder="Ej. RA-05" required>
                        </div>
                        <div class="col-md-8">
                            <label for="sesiones_asignadas" class="form-label fw-medium text-secondary">Sesiones Asignadas (Opcional - Calcula Trigger)</label>
                            <input type="number" class="form-control form-control-lg" id="sesiones_asignadas" name="sesiones_asignadas" placeholder="Deja vacío para cálculo automático">
                        </div>
                        <div class="col-md-12">
                            <label for="descripcion_ra" class="form-label fw-medium text-secondary">Descripción del Resultado</label>
                            <textarea class="form-control form-control-lg" id="descripcion_ra" name="descripcion" rows="4" placeholder="Ej. Implementar interfaces seguras y responsivas..." required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-4 border-0 bg-light">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-warning fw-bold shadow-sm text-dark"><i class="fa-solid fa-floppy-disk me-2"></i> Guardar Resultado</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php endif; ?>

<!-- MODAL GALERÍA AMBIENTE -->
<div class="modal fade" id="modalGaleriaAmbiente" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden bg-dark">
            <div class="modal-header border-0 bg-dark text-white p-3">
                <h5 class="modal-title fw-bold" id="modalGaleriaAmbienteLabel">Galería de Fotos</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body p-0">
                <div id="carouselGaleria" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner" id="galeriaCarouselInner">
                        <!-- Las imágenes se insertan aquí vía JS -->
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselGaleria" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color: rgba(0,0,0,0.5); border-radius: 50%; padding: 20px;"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselGaleria" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true" style="background-color: rgba(0,0,0,0.5); border-radius: 50%; padding: 20px;"></span>
                        <span class="visually-hidden">Siguiente</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL CREACIÓN ("+ Asignar Horario") -->
<div class="modal fade" id="modalAsignarHorario" tabindex="-1" aria-labelledby="modalAsignarHorarioLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered schedule-modal-dialog">
        <div class="modal-content schedule-modal-content">
            <div class="modal-header schedule-modal-header">
                <div class="schedule-modal-heading">
                    <span class="schedule-modal-icon" aria-hidden="true">
                        <i class="fa-solid fa-clock"></i>
                    </span>
                    <div>
                        <h5 class="modal-title schedule-modal-title" id="modalAsignarHorarioLabel">Programar Nueva Sesión Académica</h5>
                        <div class="schedule-modal-subtitle">Asigna los detalles de la sesión académica.</div>
                    </div>
                </div>
                <button type="button" class="btn-close schedule-modal-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <form id="formCrearProgramacionAjax">
                <div class="modal-body schedule-modal-body">
                    <div class="row schedule-modal-grid">
                        <div class="col-md-6">
                            <label for="modal_numero_ficha" class="schedule-modal-label">
                                <i class="fa-solid fa-calendar-plus"></i>
                                <span>Ficha de Formación</span>
                            </label>
                            <select class="form-select schedule-modal-control" id="modal_numero_ficha" name="numero_ficha" required>
                                <option value="">Selecciona la ficha...</option>
                                <?php foreach ($fichas as $f): ?>
                                    <option value="<?= $f->numero_ficha; ?>">Ficha <?= $f->numero_ficha; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="modal_programa_nombre" class="schedule-modal-label">
                                <i class="fa-solid fa-graduation-cap"></i>
                                <span>Programa de Formación</span>
                            </label>
                            <input type="text" class="form-control schedule-modal-control" id="modal_programa_nombre" readonly placeholder="Se cargará automáticamente...">
                        </div>
                        <div class="col-md-12">
                            <label for="modal_id_competencia" class="schedule-modal-label">
                                <i class="fa-solid fa-bullseye"></i>
                                <span>Competencia</span>
                            </label>
                            <select class="form-select schedule-modal-control" id="modal_id_competencia" name="id_competencia" disabled required>
                                <option value="">Selecciona primero una ficha...</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="modal_id_resultado_aprendizaje" class="schedule-modal-label">
                                <i class="fa-solid fa-book-open"></i>
                                <span>Resultado de Aprendizaje (RA)</span>
                            </label>
                            <select class="form-select schedule-modal-control" id="modal_id_resultado_aprendizaje" name="id_resultado_aprendizaje" disabled required>
                                <option value="">Selecciona primero una competencia...</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="modal_id_usuario" class="schedule-modal-label">
                                <i class="fa-solid fa-user"></i>
                                <span>Instructor</span>
                            </label>
                            <select class="form-select schedule-modal-control" id="modal_id_usuario" name="id_usuario" required>
                                <option value="">Selecciona al instructor...</option>
                                <?php foreach ($instructores as $inst): ?>
                                    <option value="<?= $inst->id_usuario; ?>"><?= $inst->nombre . ' ' . $inst->apellido; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="modal_id_numero_ambiente" class="schedule-modal-label">
                                <i class="fa-solid fa-building"></i>
                                <span>Ambiente de Formación</span>
                            </label>
                            <select class="form-select schedule-modal-control" id="modal_id_numero_ambiente" name="id_numero_ambiente" required>
                                <option value="">Selecciona un ambiente...</option>
                                <?php foreach ($ambientes as $amb): ?>
                                    <option value="<?= $amb->id_numero_ambiente; ?>"><?= $amb->nombre; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- Reemplazando Día y Fecha única por Rango de Fechas Masivo -->
                        <div class="col-md-6">
                            <label for="pm_fecha_inicio" class="schedule-modal-label">
                                <i class="fa-solid fa-calendar-days"></i>
                                <span>Fecha Inicial</span>
                            </label>
                            <input type="date" class="form-control schedule-modal-control pm-trigger-calc" id="pm_fecha_inicio" name="fecha_inicio" required>
                        </div>
                        <div class="col-md-6">
                            <label for="pm_fecha_fin" class="schedule-modal-label">
                                <i class="fa-solid fa-calendar-check"></i>
                                <span>Fecha Final Límite</span>
                            </label>
                            <input type="date" class="form-control schedule-modal-control pm-trigger-calc" id="pm_fecha_fin" name="fecha_fin" required>
                        </div>

                        <!-- Calendario mensual interactivo -->
                        <div class="col-md-12 mt-3">
                            <section class="pm-training-calendar" aria-label="Calendario de Formación">
                                <div class="pm-calendar-topbar">
                                    <div class="pm-calendar-title-wrap">
                                        <span class="pm-calendar-icon" aria-hidden="true">
                                            <i class="fa-regular fa-calendar"></i>
                                        </span>
                                        <div>
                                            <h6 class="pm-calendar-title">Calendario de Formación</h6>
                                            <div class="pm-calendar-subtitle">Visualiza y gestiona los días de formación programados</div>
                                        </div>
                                    </div>
                                    <div class="pm-calendar-controls">
                                        <button type="button" class="pm-calendar-nav" id="pm_calendar_prev" aria-label="Mes anterior">
                                            <i class="fa-solid fa-chevron-left"></i>
                                        </button>
                                        <button type="button" class="pm-calendar-month" id="pm_calendar_month" aria-live="polite">
                                            Julio 2026 <i class="fa-solid fa-chevron-down ms-2 small"></i>
                                        </button>
                                        <button type="button" class="pm-calendar-nav" id="pm_calendar_next" aria-label="Mes siguiente">
                                            <i class="fa-solid fa-chevron-right"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="pm-calendar-counter">
                                    <div class="pm-calendar-counter-label">
                                        <i class="fa-solid fa-layer-group"></i>
                                        <span>Sesiones Generadas:</span>
                                    </div>
                                    <div class="pm-calendar-counter-value">
                                        <span id="pm_contador_generadas" class="pm-counter-current">0</span> /
                                        <span id="pm_contador_permitidas">∞</span>
                                    </div>
                                </div>

                                <div class="pm-calendar-message" id="pm_calendar_limit_msg">
                                    Ya se generó el número máximo de sesiones para esta programación.
                                </div>

                                <div class="pm-calendar-weekdays" aria-label="Seleccionar días de formación">
                                    <button type="button" class="pm-calendar-weekday-btn" data-iso-day="1">Lun</button>
                                    <button type="button" class="pm-calendar-weekday-btn" data-iso-day="2">Mar</button>
                                    <button type="button" class="pm-calendar-weekday-btn" data-iso-day="3">Mié</button>
                                    <button type="button" class="pm-calendar-weekday-btn" data-iso-day="4">Jue</button>
                                    <button type="button" class="pm-calendar-weekday-btn" data-iso-day="5">Vie</button>
                                    <button type="button" class="pm-calendar-weekday-btn" data-iso-day="6">Sáb</button>
                                    <button type="button" class="pm-calendar-weekday-btn" data-iso-day="7">Dom</button>
                                </div>

                                <div class="pm-calendar-grid" id="pm_calendar_grid"></div>

                                <div class="pm-calendar-legend">
                                    <span class="pm-calendar-legend-item">
                                        <span class="pm-legend-icon"><i class="fa-regular fa-circle-check"></i></span>
                                        Sesión programada
                                    </span>
                                    <span class="pm-calendar-legend-item">
                                        <span class="pm-legend-square"></span>
                                        Día con sesiones
                                    </span>
                                    <span class="pm-calendar-legend-item">
                                        <span class="pm-legend-square is-empty"></span>
                                        Día sin sesiones
                                    </span>
                                </div>
                            </section>
                        </div>
                        <div class="col-md-6">
                            <label for="modal_hora_inicio" class="schedule-modal-label">
                                <i class="fa-solid fa-clock"></i>
                                <span>Hora de Inicio</span>
                            </label>
                            <input type="time" class="form-control schedule-modal-control" id="modal_hora_inicio" name="hora_inicio" required>
                        </div>
                        <div class="col-md-6">
                            <label for="modal_hora_fin" class="schedule-modal-label">
                                <i class="fa-solid fa-clock"></i>
                                <span>Hora de Fin</span>
                            </label>
                            <input type="time" class="form-control schedule-modal-control" id="modal_hora_fin" name="hora_fin" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer schedule-modal-footer">
                    <button type="button" class="btn schedule-modal-cancel" data-bs-dismiss="modal">
                        <i class="fa-regular fa-circle-xmark"></i>
                        <span>Cancelar</span>
                    </button>
                    <button type="submit" class="btn schedule-modal-save">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>Guardar Horario</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL VISTA DETALLE DIARIO -->
<div class="modal fade" id="modalDetalleDia" aria-labelledby="modalDetalleDiaLabel" aria-hidden="true" style="backdrop-filter: blur(5px); background-color: rgba(0,0,0,0.5);">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header bg-dark text-white p-4 border-0">
                <h5 class="modal-title fw-bold" id="modalDetalleDiaLabel"><i class="fa-solid fa-calendar-day me-2 text-info"></i>Detalle de Sesiones Programadas</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body p-4 bg-light" id="contenidoDetalleDia">
                <!-- Se cargará por AJAX vía Fetch -->
                <div class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Cargando...</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 p-3 bg-white justify-content-end rounded-bottom-4">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Script de Automatización: Conmutación de Asistencia en vivo y Búsqueda -->
<script>
// Función automatizada para conmutar el estado de asistencia entre PRESENTE y FALLA
function toggleEstadoAsistencia(btn, inputId) {
    const hiddenInput = document.getElementById(inputId);
    if (!hiddenInput) return;

    if (btn.classList.contains('asi-btn-estado')) {
        if (hiddenInput.value === '') {
            hiddenInput.value = '1';
            btn.className = 'asi-btn-estado presente shadow-sm';
            btn.innerHTML = '<i class="fa-solid fa-check"></i>';
        } else if (hiddenInput.value === '1') {
            hiddenInput.value = '0';
            btn.className = 'asi-btn-estado ausente shadow-sm';
            btn.innerHTML = '<i class="fa-solid fa-xmark"></i>';
        } else {
            hiddenInput.value = '';
            btn.className = 'asi-btn-estado pendiente shadow-sm';
            btn.innerHTML = '–';
        }

        if (typeof renderizarKPIs === 'function') {
            renderizarKPIs();
        }
        return;
    }

    const container = btn.closest('.list-group-item');
    const label = container ? container.querySelector('.lbl-estado') : null;

    if (btn.classList.contains('presente')) {
        // Conmutar a FALLA
        btn.classList.remove('presente');
        btn.classList.add('falla');
        btn.innerHTML = 'F';
        hiddenInput.value = '0';
        
        if (label) {
            label.classList.remove('text-success');
            label.classList.add('text-danger');
            label.textContent = 'INASISTENCIA (FALLA)';
        }
    } else {
        // Conmutar a PRESENTE
        btn.classList.remove('falla');
        btn.classList.add('presente');
        btn.innerHTML = '<i class="fa-solid fa-check"></i>';
        hiddenInput.value = '1';
        
        if (label) {
            label.classList.remove('text-danger');
            label.classList.add('text-success');
            label.textContent = 'ASISTE (PRESENTE)';
        }
    }

    const bulkStatus = document.getElementById('estadoAsistenciaMasiva');
    if (bulkStatus) {
        bulkStatus.textContent = 'Planilla modificada manualmente';
        bulkStatus.classList.remove('text-success', 'fw-bold');
        bulkStatus.classList.add('text-secondary');
    }
}

// Marcar en una sola acción a todos los aprendices de la planilla como presentes
function marcarTodosPresentes() {
    const form = document.getElementById('formAsistenciaDigital');
    if (!form) return;

    const attendanceButtons = form.querySelectorAll('.btn-estado-toggle');
    attendanceButtons.forEach(function (button) {
        const row = button.closest('.list-group-item');
        const hiddenInput = row ? row.querySelector('input[type="hidden"][name$="[estado]"]') : null;
        const label = row ? row.querySelector('.lbl-estado') : null;

        button.classList.remove('falla');
        button.classList.add('presente');
        button.innerHTML = '<i class="fa-solid fa-check"></i>';
        if (hiddenInput) hiddenInput.value = '1';
        if (label) {
            label.classList.remove('text-danger');
            label.classList.add('text-success');
            label.textContent = 'ASISTE (PRESENTE)';
        }
    });

    const status = document.getElementById('estadoAsistenciaMasiva');
    if (status) {
        status.textContent = attendanceButtons.length + ' aprendices marcados como presentes';
        status.classList.remove('text-secondary');
        status.classList.add('text-success', 'fw-bold');
    }
}

// Búsqueda en tiempo real de asistencias del Aprendiz
document.addEventListener("DOMContentLoaded", function() {
    const inputSearch = document.getElementById("inputSearchAsist");
    if (inputSearch) {
        inputSearch.addEventListener("input", function() {
            const query = this.value.toLowerCase();
            const items = document.querySelectorAll("#listaAsistencias .item-asistencia");
            
            items.forEach(item => {
                const text = item.textContent.toLowerCase();
                if (text.includes(query)) {
                    item.style.display = "flex";
                } else {
                    item.style.display = "none";
                }
            });
        });
    }
});

// Buscador y filtro en tiempo real para Usuarios en el Dashboard
document.addEventListener("DOMContentLoaded", function() {
    const buscadorUsr = document.getElementById('buscadorUsuarios');
    const filtroRol = document.getElementById('filtroRol');
    
    const tablaUsuarios = document.querySelector('#pills-usuarios table tbody');
    const rowsUsr = tablaUsuarios ? tablaUsuarios.querySelectorAll('tr') : [];

    function filtrarTablaUsuarios() {
        if (!buscadorUsr || !filtroRol) return;
        
        const term = buscadorUsr.value.toLowerCase().trim();
        const roleFilter = filtroRol.value.toLowerCase();

        rowsUsr.forEach(row => {
            const textContent = row.textContent.toLowerCase();
            const rolesColumn = row.querySelector('td:nth-child(4)'); // Columna 4 = Roles
            const rolesText = rolesColumn ? rolesColumn.textContent.toLowerCase() : '';

            const matchTerm = textContent.includes(term);
            const matchRole = roleFilter === '' || rolesText.includes(roleFilter);

            if (matchTerm && matchRole) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    if (buscadorUsr) buscadorUsr.addEventListener('input', filtrarTablaUsuarios);
    if (filtroRol) filtroRol.addEventListener('change', filtrarTablaUsuarios);
});

function verGaleria(nombre, fotosJson) {
    try {
        var fotos = JSON.parse(fotosJson);
        var modal = new bootstrap.Modal(document.getElementById('modalGaleriaAmbiente'));
        document.getElementById('modalGaleriaAmbienteLabel').innerText = 'Ambiente: ' + nombre;
        
        var carouselInner = document.getElementById('galeriaCarouselInner');
        carouselInner.innerHTML = '';
        
        if (fotos.length === 0) {
            carouselInner.innerHTML = '<div class="carousel-item active"><div class="d-flex align-items-center justify-content-center flex-column text-white" style="height: 400px; background: #222;"><i class="fa-solid fa-camera-retro fa-3x mb-3 text-secondary"></i><h5>Sin fotos</h5></div></div>';
        } else {
            fotos.forEach(function(foto, index) {
                var activeClass = index === 0 ? 'active' : '';
                carouselInner.innerHTML += '<div class="carousel-item ' + activeClass + '"><img src="' + foto.url + '" class="d-block w-100" style="max-height: 70vh; object-fit: contain; background: #000;"></div>';
            });
        }
        
        modal.show();
    } catch(e) {
        console.error("Error al abrir galería: ", e);
    }
}

function confirmarEliminacionPrograma(idPrograma) {
    const btn = document.getElementById('btnConfirmarEliminarPrograma');
    btn.href = '<?= URLROOT; ?>/index.php?route=programas/delete&id=' + idPrograma;
    const modal = new bootstrap.Modal(document.getElementById('modalEliminarPrograma'));
    modal.show();
}

// Filtros de Programas
document.addEventListener("DOMContentLoaded", function() {
    const buscarPrograma = document.getElementById('buscarPrograma');
    const filtroVigencia = document.getElementById('filtroVigenciaPrograma');
    const programaItems = document.querySelectorAll('.programa-item');
    const contadorProgramas = document.getElementById('contadorProgramas');

    function filtrarProgramas() {
        if (!buscarPrograma || !filtroVigencia) return;
        
        const searchVal = buscarPrograma.value.toLowerCase().trim();
        const vigenciaVal = filtroVigencia.value;
        let count = 0;

        programaItems.forEach(item => {
            const dataSearch = item.getAttribute('data-search') || '';
            const dataVigencia = item.getAttribute('data-vigencia') || '';
            
            const matchSearch = dataSearch.includes(searchVal);
            const matchVigencia = vigenciaVal === '' || dataVigencia === vigenciaVal;

            if (matchSearch && matchVigencia) {
                item.style.display = '';
                count++;
            } else {
                item.style.display = 'none';
            }
        });

        if (contadorProgramas) {
            contadorProgramas.innerText = count + (count === 1 ? ' programa' : ' programas');
        }
    }

    if (buscarPrograma) buscarPrograma.addEventListener('input', filtrarProgramas);
    if (filtroVigencia) filtroVigencia.addEventListener('change', filtrarProgramas);
});

function abrirModalEditarPrograma(idPrograma) {
    const modal = new bootstrap.Modal(document.getElementById('modalEditarPrograma'));
    modal.show();

    document.getElementById('loaderEditarPrograma').classList.remove('d-none');
    document.getElementById('loaderEditarPrograma').classList.add('d-flex');
    document.getElementById('contenedorEditarPrograma').innerHTML = '';

    fetch('<?= URLROOT; ?>/index.php?route=programas/editarCompleto&id=' + idPrograma + '&ajax=1')
        .then(response => response.text())
        .then(html => {
            document.getElementById('contenedorEditarPrograma').innerHTML = html;
            document.getElementById('loaderEditarPrograma').classList.remove('d-flex');
            document.getElementById('loaderEditarPrograma').classList.add('d-none');
            
            // Re-ejecutar scripts dentro del HTML inyectado
            const scripts = document.getElementById('contenedorEditarPrograma').querySelectorAll('script');
            scripts.forEach(oldScript => {
                const newScript = document.createElement('script');
                Array.from(oldScript.attributes).forEach(attr => newScript.setAttribute(attr.name, attr.value));
                newScript.appendChild(document.createTextNode(oldScript.innerHTML));
                oldScript.parentNode.replaceChild(newScript, oldScript);
            });
        })
        .catch(error => {
            console.error('Error cargando el formulario:', error);
            document.getElementById('contenedorEditarPrograma').innerHTML = '<div class="alert alert-danger m-4">Error al cargar la información. Intenta nuevamente.</div>';
            document.getElementById('loaderEditarPrograma').classList.remove('d-flex');
            document.getElementById('loaderEditarPrograma').classList.add('d-none');
        });
}

function editarFicha(ficha, cant, inicio, practicas, fin, id_lider, id_prog, id_jor) {
    document.getElementById('edit_numero_ficha_original').value = ficha;
    document.getElementById('edit_numero_ficha').value = ficha;
    document.getElementById('edit_id_programa').value = id_prog;
    document.getElementById('edit_instructor_lider').value = id_lider;
    document.getElementById('edit_jornada').value = id_jor;
    document.getElementById('edit_cantidad_estudiantes').value = cant;
    document.getElementById('edit_fecha_inicio').value = inicio;
    document.getElementById('edit_fecha_practicas').value = practicas;
    document.getElementById('edit_fecha_fin').value = fin;
    var modal = new bootstrap.Modal(document.getElementById('modalEditarFicha'));
    modal.show();
}

function toggleEspecialidad(selectElement, targetId) {
    var target = document.getElementById(targetId);
    var divTarget = document.getElementById('div_' + targetId);
    if (!target || !divTarget) return;
    if (selectElement.value === 'Especializado') {
        divTarget.style.display = 'block';
        target.setAttribute('required', 'required');
    } else {
        divTarget.style.display = 'none';
        target.removeAttribute('required');
        target.value = '';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    var fotosInput = document.getElementById('edit_amb_fotos');
    var fotosStatus = document.getElementById('edit_amb_fotos_status');

    if (fotosInput && fotosStatus) {
        fotosInput.addEventListener('change', function() {
            var total = fotosInput.files ? fotosInput.files.length : 0;
            fotosStatus.textContent = total === 0
                ? 'Sin archivos seleccionados'
                : total === 1
                    ? '1 archivo seleccionado'
                    : total + ' archivos seleccionados';
        });
    }
});

function editarAmbiente(id, nombre, tipo, cap, comp, esp, aire, vent, tab, tv, disp) {
    document.getElementById('edit_amb_id').value = id;
    document.getElementById('edit_amb_nombre').value = nombre;
    document.getElementById('edit_amb_tipo').value = tipo;
    
    toggleEspecialidad(document.getElementById('edit_amb_tipo'), 'edit_amb_especialidad');
    
    document.getElementById('edit_amb_capacidad').value = cap;
    document.getElementById('edit_amb_computadores').value = comp;
    document.getElementById('edit_amb_especialidad').value = esp;
    document.getElementById('edit_amb_aire').checked = aire == 1;
    document.getElementById('edit_amb_vent').checked = vent == 1;
    document.getElementById('edit_amb_tablero').checked = tab == 1;
    document.getElementById('edit_amb_tv').checked = tv == 1;
    document.getElementById('edit_amb_disp').checked = disp == 1;
    var modal = new bootstrap.Modal(document.getElementById('modalEditarAmbiente'));
    modal.show();
}

function editarPrograma(id, nombre, codigo, ver, vig, lec, prac, tipo) {
    document.getElementById('edit_prog_id').value = id;
    document.getElementById('edit_prog_nombre').value = nombre;
    document.getElementById('edit_prog_codigo').value = codigo;
    document.getElementById('edit_prog_version').value = ver;
    document.getElementById('edit_prog_vigencia').value = vig;
    document.getElementById('edit_prog_lectiva').value = lec;
    document.getElementById('edit_prog_practica').value = prac;
    document.getElementById('edit_prog_tipo').value = tipo;
    var modal = new bootstrap.Modal(document.getElementById('modalEditarPrograma'));
    modal.show();
}

function editarUsuario(id, nom, ape, doc, tel, cor, tit, rolId) {
    document.getElementById('edit_usr_id').value = id;
    document.getElementById('edit_usr_nombre').value = nom;
    document.getElementById('edit_usr_apellido').value = ape;
    document.getElementById('edit_usr_documento').value = doc;
    document.getElementById('edit_usr_telefono').value = tel;
    document.getElementById('edit_usr_correo').value = cor;
    document.getElementById('edit_usr_titulacion').value = tit;
    if (rolId && document.getElementById('edit_usr_rol')) {
        document.getElementById('edit_usr_rol').value = rolId;
    }
    var modal = new bootstrap.Modal(document.getElementById('modalEditarUsuario'));
    modal.show();
}

// Validaciones para formularios de usuarios (Crear y Editar)
document.addEventListener("DOMContentLoaded", function () {
    const forms = document.querySelectorAll("form[action*='usuarios/create'], form[action*='usuarios/update']");
    forms.forEach(function (form) {
        // Restringir entrada a letras y espacios en tiempo real
        const textFields = form.querySelectorAll("input[name='nombre'], input[name='apellido'], input[name='titulacion']");
        textFields.forEach(input => {
            input.addEventListener("input", function() {
                this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '');
            });
        });

        // Restringir entrada a números en tiempo real
        const numericFields = form.querySelectorAll("input[name='telefono'], input[name='documento']");
        numericFields.forEach(input => {
            input.addEventListener("input", function() {
                this.value = this.value.replace(/\D/g, '');
            });
        });

        // Restringir y truncar el campo de correo en tiempo real
        const emailFields = form.querySelectorAll("input[type='email']");
        emailFields.forEach(input => {
            input.addEventListener("input", function() {
                const val = this.value;
                const atIndex = val.indexOf('@');
                if (atIndex !== -1) {
                    const afterAt = val.substring(atIndex + 1);
                    const comMatch = afterAt.match(/\.(com|co)/i);
                    if (comMatch) {
                        const suffixIndex = atIndex + 1 + comMatch.index + comMatch[0].length;
                        if (val.length > suffixIndex) {
                            this.value = val.substring(0, suffixIndex);
                        }
                    }
                }
            });
        });

        // Obtener campos relevantes
        const inputs = form.querySelectorAll("input[name='nombre'], input[name='apellido'], input[name='telefono'], input[type='email'], input[name='titulacion'], input[name='documento'], input[name='contrasena']");
        
        inputs.forEach(input => {
            // Contenedor para mensajes de validación personalizados
            const container = document.createElement("div");
            container.className = "validation-feedback-container mt-1";
            
            const errorMsg = document.createElement("div");
            errorMsg.className = "validation-feedback text-danger small fw-semibold";
            errorMsg.style.cssText = "display: none; font-size: 0.78rem; margin-top: 3px;";
            
            const successMsg = document.createElement("div");
            successMsg.className = "validation-feedback text-success small fw-semibold";
            successMsg.style.cssText = "display: none; font-size: 0.78rem; margin-top: 3px;";
            
            container.appendChild(errorMsg);
            container.appendChild(successMsg);
            input.parentNode.appendChild(container);

            function updateFeedback(isValid, text) {
                if (isValid) {
                    errorMsg.style.display = "none";
                    successMsg.style.display = "none";
                    input.classList.remove("is-invalid");
                    input.classList.add("is-valid");
                    input.setCustomValidity("");
                } else {
                    successMsg.style.display = "none";
                    errorMsg.textContent = "❌ " + text;
                    errorMsg.style.display = "block";
                    input.classList.remove("is-valid");
                    input.classList.add("is-invalid");
                    input.setCustomValidity(text);
                }
            }

            function clearFeedback() {
                errorMsg.style.display = "none";
                successMsg.style.display = "none";
                input.classList.remove("is-valid", "is-invalid");
                input.setCustomValidity("");
            }

            function validate() {
                const val = input.value;
                const name = input.name;
                const type = input.type;

                if (val === "") {
                    const isOptionalEmpty = form.action.includes('update') && name === 'contrasena';
                    if (isOptionalEmpty) {
                        clearFeedback();
                    } else {
                        updateFeedback(false, "Este campo es requerido.");
                    }
                    return;
                }

                if (name === "nombre" || name === "apellido") {
                    if (/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/.test(val)) {
                        updateFeedback(true, "Formato de " + (name === "nombre" ? "nombre" : "apellido") + " válido.");
                    } else {
                        updateFeedback(false, "Solo debe contener letras.");
                    }
                }
                else if (name === "telefono") {
                    if (/^\d{10}$/.test(val)) {
                        updateFeedback(true, "Número de teléfono válido.");
                    } else {
                        updateFeedback(false, "Debe contener exactamente 10 números (actual: " + val.length + ").");
                    }
                }
                else if (type === "email") {
                    // Validaciones específicas para el correo
                    if (!val.includes('@')) {
                        updateFeedback(false, "Debe incluir el carácter '@'.");
                        return;
                    }
                    
                    const atIndex = val.indexOf('@');
                    const afterAt = val.substring(atIndex + 1);
                    
                    if (afterAt === "" || !/^[a-zA-Z]/.test(afterAt)) {
                        updateFeedback(false, "Debe haber letras después de el '@'.");
                        return;
                    }
                    
                    const dotIndex = afterAt.indexOf('.');
                    if (dotIndex === -1) {
                        updateFeedback(false, "Debe incluir un punto '.' después del dominio.");
                        return;
                    }
                    
                    const afterDot = afterAt.substring(dotIndex + 1);
                    if (afterDot.toLowerCase() !== "com" && afterDot.toLowerCase() !== "co") {
                        updateFeedback(false, "Solo se permite '.com' o '.co' al final.");
                        return;
                    }
                    
                    updateFeedback(true, "Correo electrónico válido.");
                }
                else if (name === "titulacion") {
                    if (/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/.test(val)) {
                        updateFeedback(true, "Formato de titulación válido.");
                    } else {
                        updateFeedback(false, "Solo debe contener letras.");
                    }
                }
                else if (name === "documento") {
                    if (/^\d{6,10}$/.test(val)) {
                        updateFeedback(true, "Número de documento válido.");
                    } else {
                        if (val.length < 6) {
                            updateFeedback(false, "Debe contener mínimo 6 dígitos (actual: " + val.length + ").");
                        } else if (val.length > 10) {
                            updateFeedback(false, "Debe contener máximo 10 dígitos (actual: " + val.length + ").");
                        } else {
                            updateFeedback(false, "Solo debe contener números.");
                        }
                    }
                }
                else if (name === "contrasena") {
                    if (val.length < 8 || val.length > 30) {
                        updateFeedback(false, "La contraseña debe tener entre 8 y 30 caracteres (actual: " + val.length + ").");
                        return;
                    }
                    if (!/^[A-ZÑÁÉÍÓÚ]/.test(val)) {
                        updateFeedback(false, "La primera letra debe ser mayúscula.");
                        return;
                    }
                    if (!/\d/.test(val)) {
                        updateFeedback(false, "Debe contener al menos un número.");
                        return;
                    }
                    if (!/[!@#$%^&*(),.?":{}|<>[\]\\/_\-+=~`';]/.test(val)) {
                        updateFeedback(false, "Debe contener al menos un carácter especial.");
                        return;
                    }
                    updateFeedback(true, "Contraseña segura y válida.");
                }
            }

            input.addEventListener("input", validate);
            input.addEventListener("focus", validate);
            input.addEventListener("blur", validate);
        });

        form.addEventListener("submit", function (e) {
            let formValid = true;
            inputs.forEach(input => {
                // Forzar validación al enviar
                input.focus();
                input.blur();
                if (!input.checkValidity()) {
                    formValid = false;
                }
            });
            if (!formValid) {
                e.preventDefault();
            }
        });
    });
});

// Funciones para competencias y resultados en el Dashboard
function abrirModalCompetencia(idPrograma) {
    const selectProg = document.getElementById('id_programa_comp');
    if (selectProg) {
        selectProg.value = idPrograma;
    }
    var modal = new bootstrap.Modal(document.getElementById('modalCrearCompetencia'));
    modal.show();
}

function abrirModalResultado(idCompetencia) {
    const selectComp = document.getElementById('id_competencia_ra');
    if (selectComp) {
        selectComp.value = idCompetencia;
        calcularSesionesResultado('ra');
    }
    var modal = new bootstrap.Modal(document.getElementById('modalCrearResultado'));
    modal.show();
}

function calcularCompetencia() {
    const horasTotalesInput = document.getElementById('horas_totales');
    const porcentajeInput = document.getElementById('porcentaje');
    const calcHorasEjecutar = document.getElementById('calc_horas_ejecutar');
    const calcTotalSesiones = document.getElementById('calc_total_sesiones');

    if (!horasTotalesInput || !porcentajeInput) return;

    const horasTotales = parseFloat(horasTotalesInput.value) || 0;
    const porcentaje = parseFloat(porcentajeInput.value) || 0;

    const horasAEjecutar = Math.ceil((horasTotales * porcentaje) / 100);
    const totalSesiones = Math.ceil(horasAEjecutar / 6);

    if (calcHorasEjecutar) calcHorasEjecutar.innerText = horasAEjecutar + ' hrs';
    if (calcTotalSesiones) calcTotalSesiones.innerText = totalSesiones + ' sesiones';
}

function calcularSesionesResultado(prefix) {
    const selectComp = document.getElementById(prefix === 'ra' ? 'id_competencia_ra' : 'id_competencia');
    const raTotalSesiones = document.getElementById(prefix === 'ra' ? 'ra_total_sesiones' : 'prog_ra_total_sesiones');
    const raResultadosStatus = document.getElementById(prefix === 'ra' ? 'ra_resultados_status' : 'prog_ra_resultados_status');
    const raSesionesStatus = document.getElementById(prefix === 'ra' ? 'ra_sesiones_status' : 'prog_ra_sesiones_status');
    const raInfoCalculo = document.getElementById(prefix === 'ra' ? 'ra_info_calculo' : 'prog_ra_info_calculo');
    const raSugerido = document.getElementById(prefix === 'ra' ? 'ra_sugerido' : 'prog_ra_sugerido');

    if (!selectComp) return;

    const selectedOption = selectComp.options[selectComp.selectedIndex];
    if (!selectedOption || selectComp.value === "") {
        if (raTotalSesiones) raTotalSesiones.innerText = '0 sesiones';
        if (raResultadosStatus) raResultadosStatus.innerText = '0 / 0';
        if (raSesionesStatus) raSesionesStatus.innerText = '0 / 0';
        if (raInfoCalculo) raInfoCalculo.style.display = 'none';
        return;
    }

    const totalSesiones = parseInt(selectedOption.getAttribute('data-total-sesiones')) || 0;
    const resultadosTotales = parseInt(selectedOption.getAttribute('data-resultados-totales')) || 0;
    const resultadosActuales = parseInt(selectedOption.getAttribute('data-resultados-actuales')) || 0;
    const sesionesUsadas = parseInt(selectedOption.getAttribute('data-sesiones-usadas')) || 0;

    const sugerido = resultadosTotales > 0 ? Math.floor(totalSesiones / resultadosTotales) : 0;
    const disponibles = totalSesiones - sesionesUsadas;

    if (raTotalSesiones) raTotalSesiones.innerText = totalSesiones + ' sesiones';
    if (raResultadosStatus) raResultadosStatus.innerText = resultadosActuales + ' / ' + resultadosTotales;
    if (raSesionesStatus) raSesionesStatus.innerText = sesionesUsadas + ' / ' + totalSesiones + ' (' + disponibles + ' disp.)';
    
    if (raInfoCalculo) {
        raInfoCalculo.style.display = 'block';
        if (raSugerido) raSugerido.innerText = sugerido;
    }
}

function calcularCompetenciaPrograma() {
    const horasTotalesInput = document.getElementById('prog_comp_horas_totales');
    const porcentajeInput = document.getElementById('prog_comp_porcentaje');
    const calcHorasEjecutar = document.getElementById('prog_comp_calc_horas_ejecutar');
    const calcTotalSesiones = document.getElementById('prog_comp_calc_total_sesiones');

    if (!horasTotalesInput || !porcentajeInput) return;

    const horasTotales = parseFloat(horasTotalesInput.value) || 0;
    const porcentaje = parseFloat(porcentajeInput.value) || 0;

    const horasAEjecutar = Math.ceil((horasTotales * porcentaje) / 100);
    const totalSesiones = Math.ceil(horasAEjecutar / 6);

    if (calcHorasEjecutar) calcHorasEjecutar.innerText = horasAEjecutar + ' hrs';
    if (calcTotalSesiones) calcTotalSesiones.innerText = totalSesiones + ' sesiones';
}

document.addEventListener("DOMContentLoaded", function() {
    const horasTotalesInput = document.getElementById('horas_totales');
    const porcentajeInput = document.getElementById('porcentaje');

    if (horasTotalesInput) {
        horasTotalesInput.addEventListener('input', calcularCompetencia);
    }
    if (porcentajeInput) {
        porcentajeInput.addEventListener('input', calcularCompetencia);
    }

    const progCompHoras = document.getElementById('prog_comp_horas_totales');
    const progCompPorcentaje = document.getElementById('prog_comp_porcentaje');
    if (progCompHoras) {
        progCompHoras.addEventListener('input', calcularCompetenciaPrograma);
    }
    if (progCompPorcentaje) {
        progCompPorcentaje.addEventListener('input', calcularCompetenciaPrograma);
    }
});

// Lógica CRUD 100% Asíncrona para Fichas (Tabla Responsiva)
document.addEventListener('DOMContentLoaded', function () {
    const URL_ROOT = '<?= URLROOT; ?>';
    const formCrearFicha = document.querySelector('#modalCrearFicha form');
    
    // Pasar el ID de la ficha al modal "Gestionar Aprendices"
    const modalGestionar = document.getElementById('modalGestionarAprendices');
    if (modalGestionar) {
        modalGestionar.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const fichaId = button.getAttribute('data-ficha');
            const inputs = modalGestionar.querySelectorAll('.input-ficha-id');
            inputs.forEach(function(input) {
                input.value = fichaId;
            });
        });
        
        // Validación del formulario de creación de aprendiz individual
        const formCrearAprendiz = modalGestionar.querySelector('form[action*="crearYMatricular"]');
        if (formCrearAprendiz) {
            const numFields = formCrearAprendiz.querySelectorAll("input[name='telefono'], input[name='documento']");
            numFields.forEach(input => {
                input.addEventListener("input", function() {
                    this.value = this.value.replace(/\D/g, '');
                });
            });
            const textFields = formCrearAprendiz.querySelectorAll("input[name='nombre'], input[name='apellido']");
            textFields.forEach(input => {
                input.addEventListener("input", function() {
                    this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '');
                });
            });
        }
    }
    const formEditarFicha = document.querySelector('#modalEditarFicha form');
    
    // Función compartida para manejar submit
    async function handleAjaxForm(e, formElement, isEdit) {
        e.preventDefault(); 
        const formData = new FormData(formElement);
        formData.append('is_ajax', '1'); 
        
        const btnSubmit = formElement.querySelector('button[type="submit"]');
        const btnHtml = btnSubmit.innerHTML;
        btnSubmit.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Procesando...';
        btnSubmit.disabled = true;

        try {
            const response = await fetch(formElement.action, {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
            
            const result = await response.json();
            
            if (result.status === 'success') {
                const d = result.data; 
                const tbody = document.querySelector('#tabla-fichas tbody');
                
                const nombreJornada = d.jornada_nombre || d.id_jornada; 
                const nombreInstructor = (d.instructor_nombre && d.instructor_apellido) ? `${d.instructor_nombre} ${d.instructor_apellido}` : d.id_usuario_instructor_lider;
                const nombrePrograma = d.programa_nombre || d.id_programa;
                
                if (isEdit) {
                    // Actualización Quirúrgica
                    const filaFicha = document.getElementById(`fila-ficha-${formData.get('numero_ficha_original')}`);
                    if (filaFicha) {
                        filaFicha.id = `fila-ficha-${d.numero_ficha}`;
                        
                        const elNumero = filaFicha.querySelector('.js-numero-ficha a');
                        if (elNumero) {
                            elNumero.textContent = d.numero_ficha;
                            elNumero.href = `${URL_ROOT}/index.php?route=fichas/show&id=${d.numero_ficha}`;
                        }
                        
                        const elPrograma = filaFicha.querySelector('.js-programa');
                        if (elPrograma) elPrograma.textContent = nombrePrograma;
                        
                        const elFechas = filaFicha.querySelector('.js-fechas');
                        if (elFechas) elFechas.textContent = `Inicia: ${d.fecha_inicio} | Fin: ${d.fecha_fin}`;
                        
                        const elJornada = filaFicha.querySelector('.js-jornada');
                        if (elJornada) elJornada.textContent = nombreJornada;
                        
                        const elInstructor = filaFicha.querySelector('.js-instructor');
                        if (elInstructor) elInstructor.textContent = nombreInstructor;
                        
                        const elEstudiantes = filaFicha.querySelector('.js-estudiantes');
                        if (elEstudiantes) elEstudiantes.textContent = `${d.cantidad_estudiantes} aprendices`;
                        
                        // Actualizar ID del botón gestionar aprendices si existe
                        const btnGestionar = filaFicha.querySelector('.btn-gestionar-aprendices');
                        if (btnGestionar) {
                            btnGestionar.setAttribute('data-ficha', d.numero_ficha);
                        }
                    } else {
                        window.location.reload();
                    }
                    
                    const modalInst = bootstrap.Modal.getInstance(document.getElementById('modalEditarFicha'));
                    if (modalInst) modalInst.hide();
                    
                    Swal.fire({ icon: 'success', title: 'Ficha Actualizada', toast: true, position: 'top-end', showConfirmButton: false, timer: 2000 });
                } else {
                    // Creación (Inyectar fila)
                    const noFichasRow = document.getElementById('no-fichas-row');
                    if (noFichasRow) noFichasRow.remove();
                    
                    const newRow = document.createElement('tr');
                    newRow.id = `fila-ficha-${d.numero_ficha}`;
                    newRow.innerHTML = `
                        <td class="ps-4 fw-bold text-primary fs-6 js-numero-ficha">
                            <a href="${URL_ROOT}/index.php?route=fichas/show&id=${d.numero_ficha}" class="text-decoration-none">${d.numero_ficha}</a>
                        </td>
                        <td>
                            <div class="fw-bold text-dark js-programa">${nombrePrograma}</div>
                            <div class="text-muted small js-fechas">Inicia: ${d.fecha_inicio} | Fin: ${d.fecha_fin}</div>
                        </td>
                        <td><span class="badge bg-dark js-jornada">${nombreJornada}</span></td>
                        <td><span class="text-secondary fw-medium js-instructor">${nombreInstructor}</span></td>
                        <td><span class="badge bg-secondary-subtle text-secondary-emphasis px-3 py-1 js-estudiantes">${d.cantidad_estudiantes} aprendices</span></td>
                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="${URL_ROOT}/index.php?route=fichas/show&id=${d.numero_ficha}" class="btn btn-sm btn-outline-secondary rounded-circle shadow-sm" title="Ver Detalles">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-success rounded-circle shadow-sm btn-gestionar-aprendices" data-ficha="${d.numero_ficha}" data-bs-toggle="modal" data-bs-target="#modalGestionarAprendices" title="Gestionar Aprendices">
                                    <i class="fa-solid fa-user-plus"></i>
                                </button>
                            </div>
                        </td>
                    `;
                    tbody.appendChild(newRow);
                    
                    const modalInst = bootstrap.Modal.getInstance(document.getElementById('modalCrearFicha'));
                    if (modalInst) modalInst.hide();
                    formElement.reset();
                    
                    Swal.fire({ icon: 'success', title: 'Ficha Creada', toast: true, position: 'top-end', showConfirmButton: false, timer: 2000 });
                }
            } else {
                Swal.fire('Error', result.message || 'Error en la operación', 'error');
            }
        } catch (error) {
            console.error("Fetch Error:", error);
            Swal.fire('Error de Conexión', 'El servidor no respondió a tiempo.', 'error');
        } finally {
            btnSubmit.innerHTML = btnHtml;
            btnSubmit.disabled = false;
        }
    }

    if (formCrearFicha) {
        formCrearFicha.addEventListener('submit', (e) => handleAjaxForm(e, formCrearFicha, false));
    }
    
    if (formEditarFicha) {
        // Remover event listeners anteriores reemplazando con un clon si fuera necesario (aunque como lo definimos arriba funciona)
        const oldFormEditarFicha = formEditarFicha.cloneNode(true);
        formEditarFicha.parentNode.replaceChild(oldFormEditarFicha, formEditarFicha);
        oldFormEditarFicha.addEventListener('submit', (e) => handleAjaxForm(e, oldFormEditarFicha, true));
    }
});

// Variable global para almacenar el mes y año actual de visualización del calendario
var calendarDate = new Date(2026, 6, 1); // Inicializado en Julio 2026 como en la imagen

// Variables globales para la sincronización y roles
const currentRole = '<?= $current_role; ?>';
const urlRoot = '<?= URLROOT; ?>';

// Almacenar localmente toda la programación académica
window.programacionDataGlobal = <?= json_encode($programacion) ?>;

// Carga y población dinámica de los filtros select
function cargarFiltrosDinamicos() {
    const selectInst = document.getElementById('filtroInstructor');
    const selectAmb = document.getElementById('filtroAmbiente');
    const selectFicha = document.getElementById('filtroFicha');
    
    const selectedInst = selectInst ? selectInst.value : '';
    const selectedAmb = selectAmb ? selectAmb.value : '';
    const selectedFicha = selectFicha ? selectFicha.value : '';
    
    // 1. Instructores
    const instructoresUnicos = [];
    const instructorIds = new Set();
    if (window.programacionDataGlobal) {
        window.programacionDataGlobal.forEach(prog => {
            const id = prog.id_usuario;
            const nombre = prog.instructor_nombre + ' ' + prog.instructor_apellido;
            if (id && !instructorIds.has(id)) {
                instructorIds.add(id);
                instructoresUnicos.push({ id: id, nombre: nombre });
            }
        });
    }
    instructoresUnicos.sort((a, b) => a.nombre.localeCompare(b.nombre));
    
    if (selectInst) {
        selectInst.innerHTML = '<option value="">Instructores (Todos)</option>';
        instructoresUnicos.forEach(inst => {
            const option = document.createElement('option');
            option.value = inst.id;
            option.textContent = inst.nombre;
            selectInst.appendChild(option);
        });
        selectInst.value = selectedInst;
    }
    
    // 2. Ambientes
    const ambientesUnicos = [];
    const ambienteNombres = new Set();
    if (window.programacionDataGlobal) {
        window.programacionDataGlobal.forEach(prog => {
            const nombre = prog.ambiente_nombre;
            if (nombre && !ambienteNombres.has(nombre.toLowerCase())) {
                ambienteNombres.add(nombre.toLowerCase());
                ambientesUnicos.push(nombre);
            }
        });
    }
    ambientesUnicos.sort();
    
    if (selectAmb) {
        selectAmb.innerHTML = '<option value="">Ambientes (Todos)</option>';
        ambientesUnicos.forEach(amb => {
            const option = document.createElement('option');
            option.value = amb;
            option.textContent = amb;
            selectAmb.appendChild(option);
        });
        selectAmb.value = selectedAmb;
    }
    
    // 3. Fichas
    const fichasUnicas = [];
    const fichaNumeros = new Set();
    if (window.programacionDataGlobal) {
        window.programacionDataGlobal.forEach(prog => {
            const num = prog.numero_ficha;
            if (num && !fichaNumeros.has(num.toString())) {
                fichaNumeros.add(num.toString());
                fichasUnicas.push(num);
            }
        });
    }
    fichasUnicas.sort((a, b) => a - b);
    
    if (selectFicha) {
        selectFicha.innerHTML = '<option value="">Fichas (Todas)</option>';
        fichasUnicas.forEach(f => {
            const option = document.createElement('option');
            option.value = f;
            option.textContent = 'Ficha ' + f;
            selectFicha.appendChild(option);
        });
        selectFicha.value = selectedFicha;
    }
}

function inicializarCalendario() {
    cargarFiltrosDinamicos();
    
    const filtroDiaSemana = document.getElementById('filtroDiaSemana');
    const filtroFicha = document.getElementById('filtroFicha');
    const filtroInstructor = document.getElementById('filtroInstructor');
    const filtroAmbiente = document.getElementById('filtroAmbiente');
    
    const actualizarTodo = () => {
        renderizarCalendario();
        renderizarLista();
    };

    if (filtroDiaSemana) filtroDiaSemana.addEventListener('change', actualizarTodo);
    if (filtroFicha) filtroFicha.addEventListener('change', actualizarTodo);
    if (filtroInstructor) filtroInstructor.addEventListener('change', actualizarTodo);
    if (filtroAmbiente) filtroAmbiente.addEventListener('change', actualizarTodo);
    
    // Configurar selectores y envío del formulario modal de creación
    setupAsignarHorarioModal();
    
    renderizarCalendario();
    renderizarLista();
    iniciarMonitoreoProgramacion();
}

function navegarMes(offset) {
    calendarDate.setMonth(calendarDate.getMonth() + offset);
    renderizarCalendario();
    renderizarLista();
}

function irMesActual() {
    calendarDate = new Date();
    renderizarCalendario();
    renderizarLista();
}

function cambiarVista(vista) {
    const btnCal = document.getElementById('btnVistaCalendario');
    const btnList = document.getElementById('btnVistaLista');
    const cardCal = document.getElementById('cardCalendario');
    const navMes = document.getElementById('seccionNavegacionMes');
    const cardList = document.getElementById('cardListaCompleta');
    
    if (vista === 'calendario') {
        btnCal.classList.add('btn-success', 'active');
        btnCal.classList.remove('btn-light', 'text-secondary');
        btnCal.style.backgroundColor = '#39A900';
        
        btnList.classList.add('btn-light', 'text-secondary');
        btnList.classList.remove('btn-success', 'active');
        btnList.style.backgroundColor = '';
        
        cardCal.classList.remove('d-none');
        navMes.classList.remove('d-none');
        cardList.classList.add('d-none');
    } else {
        btnList.classList.add('btn-success', 'active');
        btnList.classList.remove('btn-light', 'text-secondary');
        btnList.style.backgroundColor = '#39A900';
        
        btnCal.classList.add('btn-light', 'text-secondary');
        btnCal.classList.remove('btn-success', 'active');
        btnCal.style.backgroundColor = '';
        
        cardCal.classList.add('d-none');
        navMes.classList.remove('d-none'); // Keep the unified navigation month + filters bar visible!
        cardList.classList.remove('d-none');
    }
}

// Calcular las sesiones activas por fecha (Lógica Atómica Día a Día con Filtros Unificados)
function obtenerSesionesPorFecha(dateStr) {
    const targetDate = new Date(dateStr + 'T00:00:00');
    const targetDateString = targetDate.toISOString().split('T')[0];
    
    const filtroDia = document.getElementById('filtroDiaSemana') ? document.getElementById('filtroDiaSemana').value : '';
    const fichaFiltro = document.getElementById('filtroFicha') ? document.getElementById('filtroFicha').value : '';
    const instructorFiltro = document.getElementById('filtroInstructor') ? document.getElementById('filtroInstructor').value : '';
    const ambienteFiltro = document.getElementById('filtroAmbiente') ? document.getElementById('filtroAmbiente').value : '';
    
    return window.programacionDataGlobal.filter(prog => {
        // Filtrar por Ficha
        if (fichaFiltro && prog.numero_ficha.toString() !== fichaFiltro) {
            return false;
        }
        
        // Filtrar por Ambiente
        if (ambienteFiltro && prog.ambiente_nombre.toLowerCase() !== ambienteFiltro.toLowerCase()) {
            return false;
        }

        // Filtrar por Instructor
        if (instructorFiltro && prog.id_usuario.toString() !== instructorFiltro) {
            return false;
        }

        // Filtrar por Día de la semana
        if (filtroDia && prog.nombre_dia !== filtroDia) {
            return false;
        }
        
        // Verificar si la sesión está liberada por novedad
        let isLiberado = false;
        if (window.excepcionesGlobal && window.excepcionesGlobal.length > 0) {
            let descMatcher = '[LIBERADO_PROG:' + prog.id_programacion + ']';
            isLiberado = window.excepcionesGlobal.some(e => 
                e.fecha_reporte === targetDateString && 
                e.descripcion.includes(descMatcher)
            );
        }
        
        if (isLiberado) {
            return false;
        }

        // Coincidencia estricta de fecha (1 fila = 1 sesión)
        return prog.fecha_inicio === targetDateString;
    });
}

function renderizarCalendario() {
    const grid = document.getElementById('gridDiasCalendario');
    const labelMesAnio = document.getElementById('nombreMesAnio');
    
    if (!grid || !labelMesAnio) return;
    
    grid.innerHTML = '';
    
    const year = calendarDate.getFullYear();
    const month = calendarDate.getMonth();
    
    // Nombres de meses en español
    const meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    labelMesAnio.innerText = meses[month] + ' ' + year;
    
    // Primer día del mes
    const primerDiaMes = new Date(year, month, 1);
    const startDay = primerDiaMes.getDay();
    const localStartDay = startDay === 0 ? 7 : startDay;
    
    const diasEnMes = new Date(year, month + 1, 0).getDate();
    const diasEnMesAnterior = new Date(year, month, 0).getDate();
    
    // Generar días del mes anterior para rellenar la primera semana
    for (let i = localStartDay - 1; i > 0; i--) {
        const diaNum = diasEnMesAnterior - i + 1;
        const prevDate = new Date(year, month - 1, diaNum);
        crearCeldaDia(prevDate, true, grid);
    }
    
    // Generar días del mes actual
    const hoy = new Date();
    for (let i = 1; i <= diasEnMes; i++) {
        const currentDate = new Date(year, month, i);
        const esHoy = currentDate.getDate() === hoy.getDate() && currentDate.getMonth() === hoy.getMonth() && currentDate.getFullYear() === hoy.getFullYear();
        crearCeldaDia(currentDate, false, grid, esHoy);
    }
    
    // Rellenar la última semana con días del mes siguiente (para completar la cuadrícula de 7 columnas)
    const celdasTotales = grid.children.length;
    const celdasRestantes = celdasTotales % 7 === 0 ? 0 : 7 - (celdasTotales % 7);
    for (let i = 1; i <= celdasRestantes; i++) {
        const nextDate = new Date(year, month + 1, i);
        crearCeldaDia(nextDate, true, grid);
    }
}

function crearCeldaDia(date, esOtroMes, grid, esHoy = false) {
    const diaNum = date.getDate();
    const yyyy = date.getFullYear();
    const mm = String(date.getMonth() + 1).padStart(2, '0');
    const dd = String(diaNum).padStart(2, '0');
    const dateStr = `${yyyy}-${mm}-${dd}`;
    
    const sesiones = obtenerSesionesPorFecha(dateStr);
    
    const celda = document.createElement('div');
    celda.className = 'calendar-cell';
    celda.style.cursor = 'pointer';
    celda.setAttribute('onclick', `abrirDetalleDia('${dateStr}', event)`);
    
    if (esOtroMes) celda.classList.add('other-month');
    if (esHoy) celda.classList.add('today');
    
    let html = `
        <div class="calendar-cell-header">
            <span class="calendar-day-num">${diaNum}</span>
            ${sesiones.length > 0 ? `<span class="calendar-sessions-badge">${sesiones.length} Sesiones</span>` : ''}
        </div>
        <div class="calendar-session-list">
    `;
    
    sesiones.forEach(s => {
        const instNombre = s.instructor_nombre + ' ' + s.instructor_apellido;
        const instNombreCorto = s.instructor_nombre + ' ' + s.instructor_apellido.charAt(0) + '.';
        const infoEscapada = encodeURIComponent(JSON.stringify(s));
        
        html += `
            <div class="calendar-session-card">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <span class="calendar-session-time">${s.hora_inicio.substring(0,5)} - ${s.hora_fin.substring(0,5)}</span>
                    <span class="calendar-session-ficha">#${s.numero_ficha}</span>
                </div>
                <span class="calendar-session-instructor" onclick="mostrarDetalleInstructor('${instNombre}', '${infoEscapada}', event)">
                    <i class="fa-solid fa-user-tie text-secondary small"></i> ${instNombreCorto}
                </span>
            </div>
        `;
    });
    
    html += `</div>`;
    celda.innerHTML = html;
    grid.appendChild(celda);
}

function mostrarDetalleInstructor(nombre, infoEscapada, event) {
    if (event) event.stopPropagation();
    
    const data = JSON.parse(decodeURIComponent(infoEscapada));
    document.getElementById('instNombreDetalle').innerText = nombre;
    
    const asignaciones = window.programacionDataGlobal.filter(p => p.id_usuario === data.id_usuario);
    
    const cuerpo = document.getElementById('cuerpoDetalleInstructor');
    cuerpo.innerHTML = '';
    
    asignaciones.forEach(a => {
        const pct = a.total_sesiones > 0 ? Math.round((a.sesiones_realizadas / a.total_sesiones) * 100) : 75;
        cuerpo.innerHTML += `
            <tr>
                <td class="ps-3"><span class="badge bg-secondary text-white fw-bold">#${a.numero_ficha}</span></td>
                <td>
                    <div class="fw-bold text-dark text-wrap" style="max-width: 250px;">${a.competencia_nombre}</div>
                    <div class="text-muted small mt-1"><i class="fa-regular fa-clock me-1"></i> ${a.nombre_dia} (${a.hora_inicio.substring(0,5)} - ${a.hora_fin.substring(0,5)})</div>
                </td>
                <td class="text-wrap small text-secondary" style="max-width: 300px;">
                    <strong>[${a.ra_codigo}]</strong> ${a.ra_descripcion}
                </td>
                <td class="text-end pe-3">
                    <div class="fw-bold text-dark small mb-1">${a.sesiones_realizadas} / ${a.total_sesiones}</div>
                    <div class="progress" style="height: 6px; border-radius: 10px;">
                        <div class="progress-bar bg-success" style="width: ${pct}%;"></div>
                    </div>
                </td>
            </tr>
        `;
    });
    
    const modal = new bootstrap.Modal(document.getElementById('modalDetalleInstructor'));
    modal.show();
}

function abrirDetalleDia(fecha, event) {
    if (event && event.target.closest('.calendar-session-instructor')) {
        return; // El clic en instructor ya maneja su propio modal
    }
    
    const modalEl = document.getElementById('modalDetalleDia');
    const contenido = document.getElementById('contenidoDetalleDia');
    if (!modalEl || !contenido) return;
    
    const modal = new bootstrap.Modal(modalEl);
    modal.show();
    
    contenido.innerHTML = `
        <div class="text-center py-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Cargando...</span>
            </div>
        </div>
    `;
    
    fetch(`<?= URLROOT; ?>/index.php?route=programacion/detalle_dia&fecha=${fecha}&_t=${Date.now()}`)
        .then(res => res.json())
        .then(res => {
            if (!res.success) {
                contenido.innerHTML = `<div class="alert alert-danger">${res.message}</div>`;
                return;
            }
            
            const partes = fecha.split('-');
            const fechaFormateada = `${partes[2]}/${partes[1]}/${partes[0]}`;
            document.getElementById('modalDetalleDiaLabel').innerHTML = `<i class="fa-solid fa-calendar-day me-2 text-info"></i>Detalle de Sesiones: ${fechaFormateada}`;
            
            let html = '';
            let tieneSesiones = false;
            
            for (const [jornada, sesiones] of Object.entries(res.jornadas)) {
                if (sesiones.length > 0) {
                    let sesionesActivas = 0;
                    
                    let jornadaHtml = `
                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-header bg-primary bg-opacity-10 border-0 py-3">
                                <h6 class="mb-0 fw-bold text-primary"><i class="fa-solid fa-sun me-2"></i>Jornada ${jornada}</h6>
                            </div>
                            <div class="card-body p-0">
                                <ul class="list-group list-group-flush">
                    `;

                    sesiones.forEach(s => {
                        // Verificar si la sesión está liberada
                        let isLiberado = false;
                        if (window.excepcionesGlobal && window.excepcionesGlobal.length > 0) {
                            let descMatcher = '[LIBERADO_PROG:' + s.id_programacion + ']';
                            isLiberado = window.excepcionesGlobal.some(e => 
                                e.fecha_reporte === fecha && 
                                e.descripcion.includes(descMatcher)
                            );
                        }
                        
                        if (isLiberado) return; // Omitir sesiones liberadas

                        sesionesActivas++;
                        jornadaHtml += `
                            <li class="list-group-item p-3 border-bottom">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <span class="badge bg-success-subtle text-success-emphasis rounded-pill fw-bold">Ficha #${s.numero_ficha}</span>
                                    <span class="small fw-semibold text-secondary"><i class="fa-regular fa-clock me-1"></i>${s.hora_inicio.substring(0,5)} - ${s.hora_fin.substring(0,5)}</span>
                                </div>
                                <div class="mb-1"><strong>Competencia:</strong> ${s.competencia_nombre}</div>
                                <div class="mb-1 text-muted small"><strong>Resultado (RA):</strong> [${s.ra_codigo}] ${s.ra_descripcion}</div>
                                <div class="row g-2 mt-2 pt-2 border-top">
                                    <div class="col-sm-6 text-dark small"><i class="fa-solid fa-user-tie text-secondary me-2"></i><strong>Instructor:</strong> ${s.instructor_nombre} ${s.instructor_apellido}</div>
                                    <div class="col-sm-6 text-dark small"><i class="fa-solid fa-building text-secondary me-2"></i><strong>Ambiente:</strong> ${s.ambiente_nombre}</div>
                                </div>
                                ${currentRole === 'Coordinador' ? `
                                <div class="mt-3 text-end d-flex justify-content-end gap-2">
                                    <button class="btn btn-sm btn-outline-warning" onclick="liberarAmbiente(${s.id_programacion}, '${fecha}', ${s.id_numero_ambiente}, event)">
                                        <i class="fa-solid fa-unlock-keyhole me-1"></i> Liberar Clase / Novedad
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" onclick="eliminarProgramacionAjax(${s.id_programacion})">
                                        <i class="fa-solid fa-trash-can me-1"></i> Eliminar
                                    </button>
                                </div>
                                ` : ''}
                            </li>
                        `;
                    });
                    
                    jornadaHtml += `
                                </ul>
                            </div>
                        </div>
                    `;
                    
                    if (sesionesActivas > 0) {
                        html += jornadaHtml;
                        tieneSesiones = true;
                    }
                }
            }
            
            if (!tieneSesiones) {
                html = `
                    <div class="text-center py-5 text-muted">
                        <i class="fa-solid fa-calendar-xmark fa-3x mb-3 text-secondary"></i>
                        <h5>No hay sesiones programadas para este día</h5>
                        <p class="small mb-0">Las celdas vacías no registran horarios vigentes.</p>
                    </div>
                `;
            }
            
            contenido.innerHTML = html;
        })
        .catch(err => {
            console.error(err);
            contenido.innerHTML = `<div class="alert alert-danger">Error al cargar los datos del servidor.</div>`;
        });
}

function liberarAmbiente(idProgramacion, fecha, idAmbiente, event) {
    if (event) event.stopPropagation();

    Swal.fire({
        title: 'Liberar Clase / Registrar Novedad',
        target: document.getElementById('modalDetalleDia'),
        html: `<p>Esta clase desaparecerá del calendario solo para el día <b>${fecha}</b>.</p>
               <input type="text" id="motivo_liberacion" class="form-control" placeholder="Ej. Instructor enfermo, falla técnica...">`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ff9800',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí, Liberar',
        cancelButtonText: 'Cancelar',
        focusConfirm: false,
        preConfirm: () => {
            const motivo = document.getElementById('motivo_liberacion').value;
            if (!motivo) {
                Swal.showValidationMessage('Debes ingresar un motivo');
            }
            return motivo;
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const formData = new FormData();
            formData.append('id_programacion', idProgramacion);
            formData.append('fecha', fecha);
            formData.append('motivo', result.value);
            formData.append('id_ambiente', idAmbiente);

            fetch(`${urlRoot}/index.php?route=programacion/liberar_ajax`, {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(res => {
                if (res.success) {
                    Swal.fire('¡Liberado!', res.message, 'success');
                    
                    // Cerrar modal actual
                    const modalEl = document.getElementById('modalDetalleDia');
                    const modal = bootstrap.Modal.getInstance(modalEl);
                    if (modal) modal.hide();

                    // Forzar actualización
                    fetch(`${urlRoot}/index.php?route=programacion/get_programacion_ajax&role=${encodeURIComponent(currentRole)}`)
                    .then(r => r.json())
                    .then(r => {
                        window.programacionDataGlobal = r.data;
                        window.excepcionesGlobal = r.excepciones || [];
                        cargarFiltrosDinamicos();
                        renderizarCalendario();
                        renderizarLista();
                        if (typeof selectedAmbiente !== 'undefined' && selectedAmbiente !== null) {
                            cargarProgramacionAmbiente(selectedAmbiente.id);
                        }
                    });
                } else {
                    Swal.fire('Error', res.message, 'error');
                }
            })
            .catch(err => {
                console.error(err);
                Swal.fire('Error', 'No se pudo contactar al servidor', 'error');
            });
        }
    });
}

function eliminarProgramacionAjax(idProgramacion) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡Esta sesión se eliminará permanentemente!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`<?= URLROOT; ?>/index.php?route=programacion/delete_ajax&id=${idProgramacion}`)
                .then(res => res.json())
                .then(res => {
                    if (res.success) {
                        // Remover del arreglo global
                        window.programacionDataGlobal = window.programacionDataGlobal.filter(p => parseInt(p.id_programacion) !== parseInt(idProgramacion));
                        
                        // Cerrar modal
                        const modalEl = document.getElementById('modalDetalleDia');
                        const modal = bootstrap.Modal.getInstance(modalEl);
                        if (modal) modal.hide();
                        
                        Swal.fire({
                            icon: 'success',
                            title: 'Eliminado',
                            text: 'La sesión ha sido eliminada correctamente.',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2500
                        });
                        
                        // Refrescar vistas y filtros
                        cargarFiltrosDinamicos();
                        renderizarCalendario();
                        renderizarLista();
                        if (typeof selectedAmbiente !== 'undefined' && selectedAmbiente !== null) {
                            cargarProgramacionAmbiente(selectedAmbiente.id);
                        }
                    } else {
                        Swal.fire('Error', res.message, 'error');
                    }
                })
                .catch(err => {
                    console.error(err);
                    Swal.fire('Error', 'Hubo un problema de conexión.', 'error');
                });
        }
    });
}

function setupAsignarHorarioModal() {
    const selectFicha = document.getElementById('modal_numero_ficha');
    const inputPrograma = document.getElementById('modal_programa_nombre');
    const selectCompetencia = document.getElementById('modal_id_competencia');
    const selectResultado = document.getElementById('modal_id_resultado_aprendizaje');
    const formCrear = document.getElementById('formCrearProgramacionAjax');

    if (!selectFicha) return;

    selectFicha.addEventListener('change', function() {
        const val = this.value;
        
        inputPrograma.value = '';
        selectCompetencia.innerHTML = '<option value="">Cargando...</option>';
        selectCompetencia.disabled = true;
        selectResultado.innerHTML = '<option value="">Selecciona primero una competencia...</option>';
        selectResultado.disabled = true;

        if (!val) {
            selectCompetencia.innerHTML = '<option value="">Selecciona primero una ficha...</option>';
            return;
        }

        fetch(`<?= URLROOT; ?>/index.php?route=programacion/get_competencias_por_ficha&ficha=${val}`)
            .then(res => res.json())
            .then(res => {
                if (res.success) {
                    inputPrograma.value = res.programa.nombre;
                    let html = '<option value="">Selecciona la competencia...</option>';
                    res.competencias.forEach(c => {
                        html += `<option value="${c.id_competencia}">${c.codigo} - ${c.nombre}</option>`;
                    });
                    selectCompetencia.innerHTML = html;
                    selectCompetencia.disabled = false;
                } else {
                    Swal.fire('Error', res.message, 'error');
                }
            })
            .catch(err => {
                console.error(err);
                Swal.fire('Error', 'No se pudo cargar la información de la ficha.', 'error');
            });
    });

    selectCompetencia.addEventListener('change', function() {
        const val = this.value;
        selectResultado.innerHTML = '<option value="">Cargando...</option>';
        selectResultado.disabled = true;

        const fichaVal = document.getElementById('modal_numero_ficha').value;
        
        fetch(`<?= URLROOT; ?>/index.php?route=programacion/get_resultados_por_competencia&id_competencia=${val}&ficha=${fichaVal}`)
            .then(res => res.json())
            .then(res => {
                if (res.success) {
                    // Limpiamos los límites anteriores
                    window.resultadosLimites = {};

                    let html = '<option value="">Selecciona el resultado...</option>';
                    res.resultados.forEach(r => {
                        html += `<option value="${r.id_resultado}">${r.codigo} - ${r.descripcion}</option>`;
                        window.resultadosLimites[r.id_resultado] = r.limite_sesiones;
                    });
                    selectResultado.innerHTML = html;
                    selectResultado.disabled = false;
                } else {
                    Swal.fire('Error', res.message, 'error');
                }
            })
            .catch(err => {
                console.error(err);
                Swal.fire('Error', 'No se pudo cargar la información de la competencia.', 'error');
            });
    });

    // Motor de calendario mensual para programación masiva
    let fechasGeneradasLote = [];
    let limitePermitido = 999;
    let calendarViewDate = new Date(2026, 6, 1);
    const diasSeleccionadosSemana = new Set();

    const fechaInicio = document.getElementById('pm_fecha_inicio');
    const fechaFin = document.getElementById('pm_fecha_fin');
    const calendarGrid = document.getElementById('pm_calendar_grid');
    const calendarMonth = document.getElementById('pm_calendar_month');
    const calendarPrev = document.getElementById('pm_calendar_prev');
    const calendarNext = document.getElementById('pm_calendar_next');
    const calendarLimitMsg = document.getElementById('pm_calendar_limit_msg');
    const weekdayButtons = document.querySelectorAll('.pm-calendar-weekday-btn');
    const contadorGeneradas = document.getElementById('pm_contador_generadas');
    const contadorPermitidas = document.getElementById('pm_contador_permitidas');
    const btnSubmit = formCrear.querySelector('button[type="submit"]');

    if (fechaInicio && fechaFin) {
        [fechaInicio, fechaFin].forEach(el => {
            el.addEventListener('change', function() {
                sincronizarMesConRango();
                depurarFechasFueraDeRango();
                regenerarFechasDesdeDiasSeleccionados();
                renderCalendarioFormacion();
            });
        });
    }

    weekdayButtons.forEach(button => {
        button.addEventListener('click', function() {
            const isoDay = parseInt(this.dataset.isoDay, 10);
            if (diasSeleccionadosSemana.has(isoDay)) {
                diasSeleccionadosSemana.delete(isoDay);
                quitarFechasPorDiaSemana(isoDay);
            } else {
                diasSeleccionadosSemana.add(isoDay);
                agregarFechasPorDiaSemana(isoDay);
            }
            renderCalendarioFormacion();
        });
    });

    if (calendarPrev) {
        calendarPrev.addEventListener('click', function() {
            calendarViewDate.setMonth(calendarViewDate.getMonth() - 1);
            renderCalendarioFormacion();
        });
    }

    if (calendarNext) {
        calendarNext.addEventListener('click', function() {
            calendarViewDate.setMonth(calendarViewDate.getMonth() + 1);
            renderCalendarioFormacion();
        });
    }

    if (calendarMonth) {
        calendarMonth.addEventListener('click', function() {
            sincronizarMesConRango(true);
            renderCalendarioFormacion();
        });
    }

    if (calendarGrid) {
        calendarGrid.addEventListener('click', function(event) {
            const removeButton = event.target.closest('.pm-session-remove');
            if (removeButton) {
                event.stopPropagation();
                quitarFechaSeleccionada(removeButton.dataset.date);
                return;
            }

            const cell = event.target.closest('.pm-calendar-cell');
            if (!cell || cell.classList.contains('is-disabled')) return;

            alternarFechaSeleccionada(cell.dataset.date);
        });
    }

    document.querySelectorAll('.pm-trigger-calc').forEach(el => {
        el.addEventListener('change', renderCalendarioFormacion);
    });

    const selectResultadoAprendizaje = document.getElementById('modal_id_resultado_aprendizaje');
    if (selectResultadoAprendizaje) {
        selectResultadoAprendizaje.addEventListener('change', function() {
            const raId = this.value;
            if (raId && window.resultadosLimites && window.resultadosLimites[raId]) {
                limitePermitido = parseInt(window.resultadosLimites[raId]);
                contadorPermitidas.textContent = limitePermitido;
            } else {
                limitePermitido = 999;
                contadorPermitidas.textContent = '∞';
            }
            if (fechasGeneradasLote.length > limitePermitido) {
                fechasGeneradasLote = fechasGeneradasLote.slice(0, limitePermitido);
            }
            regenerarFechasDesdeDiasSeleccionados();
            renderCalendarioFormacion();
        });
    }

    function crearFechaLocal(dateStr) {
        if (!dateStr) return null;
        return new Date(dateStr + 'T00:00:00');
    }

    function fechaAString(dateObj) {
        const year = dateObj.getFullYear();
        const month = String(dateObj.getMonth() + 1).padStart(2, '0');
        const day = String(dateObj.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }

    function normalizarMes(dateObj) {
        return new Date(dateObj.getFullYear(), dateObj.getMonth(), 1);
    }

    function sincronizarMesConRango(force = false) {
        const inicio = crearFechaLocal(fechaInicio.value);
        const fin = crearFechaLocal(fechaFin.value);
        if (!inicio) return;

        const viewStart = normalizarMes(calendarViewDate);
        const startMonth = normalizarMes(inicio);
        const endMonth = fin ? normalizarMes(fin) : null;
        const outsideRangeMonths = endMonth && (viewStart < startMonth || viewStart > endMonth);

        if (force || outsideRangeMonths || fechasGeneradasLote.length === 0) {
            calendarViewDate = startMonth;
        }
    }

    function estaEnRango(dateObj) {
        const inicio = crearFechaLocal(fechaInicio.value);
        const fin = crearFechaLocal(fechaFin.value);
        if (!inicio || !fin) return false;
        return dateObj >= inicio && dateObj <= fin;
    }

    function depurarFechasFueraDeRango() {
        fechasGeneradasLote = fechasGeneradasLote.filter(fechaStr => {
            const dateObj = crearFechaLocal(fechaStr);
            return dateObj && estaEnRango(dateObj);
        });
    }

    function isoDiaSemana(dateObj) {
        const day = dateObj.getDay();
        return day === 0 ? 7 : day;
    }

    function obtenerFechasValidasPorDia(isoDay) {
        const inicio = crearFechaLocal(fechaInicio.value);
        const fin = crearFechaLocal(fechaFin.value);
        if (!inicio || !fin || inicio > fin) return [];

        const fechas = [];
        const cursor = new Date(inicio);

        while (cursor <= fin) {
            if (isoDiaSemana(cursor) === isoDay) {
                fechas.push(fechaAString(cursor));
            }
            cursor.setDate(cursor.getDate() + 1);
        }

        return fechas;
    }

    function agregarFechasPorDiaSemana(isoDay) {
        const fechas = obtenerFechasValidasPorDia(isoDay);
        let alcanzoLimite = false;

        fechas.forEach(fechaStr => {
            if (fechasGeneradasLote.includes(fechaStr)) return;
            if (fechasGeneradasLote.length >= limitePermitido) {
                alcanzoLimite = true;
                return;
            }
            fechasGeneradasLote.push(fechaStr);
        });

        fechasGeneradasLote.sort();
        if (alcanzoLimite) mostrarMensajeLimite();
    }

    function quitarFechasPorDiaSemana(isoDay) {
        fechasGeneradasLote = fechasGeneradasLote.filter(fechaStr => {
            const dateObj = crearFechaLocal(fechaStr);
            return !dateObj || isoDiaSemana(dateObj) !== isoDay;
        });
    }

    function regenerarFechasDesdeDiasSeleccionados() {
        if (diasSeleccionadosSemana.size === 0) return;

        fechasGeneradasLote = [];
        Array.from(diasSeleccionadosSemana)
            .sort((a, b) => a - b)
            .forEach(isoDay => agregarFechasPorDiaSemana(isoDay));
    }

    function renderDiasSemanaSeleccionados() {
        weekdayButtons.forEach(button => {
            const isoDay = parseInt(button.dataset.isoDay, 10);
            button.classList.toggle('is-active', diasSeleccionadosSemana.has(isoDay));
        });
    }

    function mostrarMensajeLimite() {
        if (!calendarLimitMsg) return;
        calendarLimitMsg.classList.add('show');
        window.clearTimeout(calendarLimitMsg._hideTimer);
        calendarLimitMsg._hideTimer = window.setTimeout(() => {
            calendarLimitMsg.classList.remove('show');
        }, 3500);
    }

    function actualizarContadorYEstado() {
        contadorGeneradas.textContent = fechasGeneradasLote.length;
        if (fechasGeneradasLote.length === limitePermitido) {
            contadorGeneradas.classList.add('text-danger');
        } else {
            contadorGeneradas.classList.remove('text-danger');
        }

        btnSubmit.disabled = fechasGeneradasLote.length === 0;
    }

    function alternarFechaSeleccionada(fechaStr) {
        const index = fechasGeneradasLote.indexOf(fechaStr);
        if (index >= 0) {
            fechasGeneradasLote.splice(index, 1);
            renderCalendarioFormacion();
            return;
        }

        if (fechasGeneradasLote.length >= limitePermitido) {
            mostrarMensajeLimite();
            return;
        }

        fechasGeneradasLote.push(fechaStr);
        fechasGeneradasLote.sort();
        renderCalendarioFormacion();
    }

    function quitarFechaSeleccionada(fechaStr) {
        fechasGeneradasLote = fechasGeneradasLote.filter(fecha => fecha !== fechaStr);
        renderCalendarioFormacion();
    }

    function renderCalendarioFormacion() {
        if (!calendarGrid || !calendarMonth) return;

        const mesesLargos = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        const mesesCortos = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
        const year = calendarViewDate.getFullYear();
        const month = calendarViewDate.getMonth();

        calendarMonth.innerHTML = `${mesesLargos[month]} ${year} <i class="fa-solid fa-chevron-down ms-2 small"></i>`;
        calendarGrid.innerHTML = '';

        const firstDay = new Date(year, month, 1);
        const firstIsoDay = firstDay.getDay() === 0 ? 7 : firstDay.getDay();
        const gridStart = new Date(year, month, 1 - (firstIsoDay - 1));
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        const totalCells = Math.ceil((firstIsoDay - 1 + daysInMonth) / 7) * 7;

        for (let i = 0; i < totalCells; i++) {
            const cellDate = new Date(gridStart);
            cellDate.setDate(gridStart.getDate() + i);

            const fechaStr = fechaAString(cellDate);
            const isOtherMonth = cellDate.getMonth() !== month;
            const isDisabled = !estaEnRango(cellDate);
            const isSelected = fechasGeneradasLote.includes(fechaStr);

            const cell = document.createElement('button');
            cell.type = 'button';
            cell.className = 'pm-calendar-cell';
            cell.dataset.date = fechaStr;
            cell.setAttribute('aria-label', `${cellDate.getDate()} ${mesesCortos[cellDate.getMonth()]} ${cellDate.getFullYear()}`);

            if (isOtherMonth) cell.classList.add('is-other-month');
            if (isDisabled) {
                cell.classList.add('is-disabled');
                cell.disabled = true;
            }
            if (isSelected) cell.classList.add('is-selected');

            cell.innerHTML = `
                <span class="pm-calendar-day">
                    <span class="pm-calendar-day-number">${cellDate.getDate()}</span>
                    <span class="pm-calendar-day-month">${mesesCortos[cellDate.getMonth()]}</span>
                </span>
                ${isSelected ? `
                    <span class="pm-session-chip">
                        <i class="fa-regular fa-circle-check"></i>
                        <span>Sesión de<br>Formación</span>
                        <span class="pm-session-remove" data-date="${fechaStr}" role="button" aria-label="Eliminar sesión">
                            <i class="fa-solid fa-xmark"></i>
                        </span>
                    </span>
                ` : ''}
            `;

            calendarGrid.appendChild(cell);
        }

        actualizarContadorYEstado();
        renderDiasSemanaSeleccionados();
    }

    // Al cerrar el modal, resetear formulario y fechas
    const modalEl = document.getElementById('modalAsignarHorario');
    if(modalEl) {
        modalEl.addEventListener('hidden.bs.modal', function () {
            fechasGeneradasLote = [];
            diasSeleccionadosSemana.clear();
            formCrear.reset();
            calendarViewDate = new Date(2026, 6, 1);
            limitePermitido = 999;
            contadorPermitidas.textContent = '∞';
            selectCompetencia.innerHTML = '<option value="">Selecciona primero una ficha...</option>';
            selectCompetencia.disabled = true;
            selectResultado.innerHTML = '<option value="">Selecciona primero una competencia...</option>';
            selectResultado.disabled = true;
            renderCalendarioFormacion();
        });
    }

    sincronizarMesConRango(true);
    renderCalendarioFormacion();

    formCrear.addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (fechasGeneradasLote.length === 0) {
            Swal.fire('Atención', 'Debes generar al menos una fecha para guardar.', 'warning');
            return;
        }

        const data = {
            numero_ficha: document.getElementById('modal_numero_ficha').value,
            id_usuario: document.getElementById('modal_id_usuario').value,
            id_ambiente: document.getElementById('modal_id_numero_ambiente').value,
            hora_inicio: document.getElementById('modal_hora_inicio').value,
            hora_fin: document.getElementById('modal_hora_fin').value,
            id_resultado: document.getElementById('modal_id_resultado_aprendizaje').value,
            fechas: fechasGeneradasLote
        };

        const btnHtml = btnSubmit.innerHTML;
        btnSubmit.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Guardando Lote...';
        btnSubmit.disabled = true;

        fetch(`<?= URLROOT; ?>/index.php?route=programacion/programarMasivo`, {
            method: 'POST',
            body: JSON.stringify(data),
            headers: { 'Content-Type': 'application/json' }
        })
        .then(res => res.json())
        .then(res => {
            btnSubmit.innerHTML = btnHtml;
            btnSubmit.disabled = false;

            if (res.status === 'success') {
                const modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
                if (modal) modal.hide();

                Swal.fire({
                    icon: 'success',
                    title: 'Lote Programado',
                    text: res.message,
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                }).then(() => {
                    window.location.reload();
                });
            } else {
                Swal.fire('Error en Lote', res.message, 'error');
            }
        })
        .catch(err => {
            console.error(err);
            btnSubmit.innerHTML = btnHtml;
            btnSubmit.disabled = false;
            Swal.fire('Error Critico', 'Hubo un problema de conexión con el servidor.', 'error');
        });
    });

}

document.addEventListener('DOMContentLoaded', function() {
    inicializarCalendario();
    
    const initialHash = window.location.hash;
    if (initialHash) {
        const initialTab = document.querySelector(`[data-bs-target="${initialHash}"]`);
        if (initialTab) {
            initialTab.click();
        }
    }

    // Auto-open reservation modal if reserve_amb parameter is present
    const hash = window.location.hash;
    let targetAmbId = null;
    
    if (hash && hash.includes('pills-programacion')) {
        const tabEl = document.getElementById('pills-programacion-tab');
        if (tabEl) {
            tabEl.click();
        }
        
        // Parse reserve_amb parameter from hash
        const parts = hash.split('&');
        parts.forEach(part => {
            if (part.startsWith('reserve_amb=')) {
                targetAmbId = part.split('=')[1];
            }
        });
    }
    
    if (!targetAmbId) {
        const urlParams = new URLSearchParams(window.location.search);
        targetAmbId = urlParams.get('reserve_amb');
        if (targetAmbId) {
            const tabEl = document.getElementById('pills-programacion-tab');
            if (tabEl) {
                tabEl.click();
            }
        }
    }
    
    if (targetAmbId) {
        setTimeout(() => {
            const modalEl = document.getElementById('modalAsignarHorario');
            if (modalEl) {
                const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
                modal.show();
                const selectAmbiente = document.getElementById('modal_id_numero_ambiente');
                if (selectAmbiente) {
                    selectAmbiente.value = targetAmbId;
                    selectAmbiente.dispatchEvent(new Event('change'));
                }
            }
        }, 600);
    }
    
    // Lógica para Carga Masiva de Usuarios
    const formMasivoUsuarios = document.querySelector("#modalCargaMasivaUsuarios form");
    if (formMasivoUsuarios) {
        formMasivoUsuarios.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const btnSubmit = this.querySelector('button[type="submit"]');
            const originalBtnHtml = btnSubmit.innerHTML;
            btnSubmit.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-2"></i> Procesando...';
            btnSubmit.disabled = true;

            const formData = new FormData(this);

            try {
                const response = await fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });
                
                const result = await response.json();
                
                if (result.status === 'success') {
                    const modalEl = this.closest('.modal');
                    if (modalEl) {
                        const modalInst = bootstrap.Modal.getInstance(modalEl);
                        if (modalInst) modalInst.hide();
                    }
                    
                    Swal.fire({
                        icon: 'success',
                        title: '¡Carga Exitosa!',
                        text: result.message,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.reload();
                    });
                    
                } else {
                    Swal.fire('Atención', result.message, 'warning');
                }
            } catch (error) {
                console.error("Fetch Error:", error);
                Swal.fire('Error Crítico', 'Hubo un error de conexión con el servidor.', 'error');
            } finally {
                btnSubmit.innerHTML = originalBtnHtml;
                btnSubmit.disabled = false;
                this.reset();
            }
        });
    }
});

function toggleFichaMasiva(rolId) {
    const contenedor = document.getElementById('contenedorFichaMasiva');
    const select = document.getElementById('ficha_carga');
    if (rolId == '3') {
        contenedor.style.display = 'block';
        select.setAttribute('required', 'required');
    } else {
        contenedor.style.display = 'none';
        select.removeAttribute('required');
    }
}

function renderizarLista() {
    const cardBody = document.querySelector('#cardListaCompleta .card-body');
    if (!cardBody) return;

    const year = calendarDate.getFullYear();
    const month = calendarDate.getMonth();

    const filtroDia = document.getElementById('filtroDiaSemana') ? document.getElementById('filtroDiaSemana').value : '';
    const fichaFiltro = document.getElementById('filtroFicha') ? document.getElementById('filtroFicha').value : '';
    const instructorFiltro = document.getElementById('filtroInstructor') ? document.getElementById('filtroInstructor').value : '';
    const ambienteFiltro = document.getElementById('filtroAmbiente') ? document.getElementById('filtroAmbiente').value : '';

    const filteredData = (window.programacionDataGlobal || []).filter(prog => {
        // Filtrar por Mes/Año
        const parts = prog.fecha_inicio.split('-');
        if (parts.length === 3) {
            const pYear = parseInt(parts[0], 10);
            const pMonth = parseInt(parts[1], 10) - 1;
            if (pYear !== year || pMonth !== month) {
                return false;
            }
        } else {
            return false;
        }

        // Filtrar por Ficha
        if (fichaFiltro && prog.numero_ficha.toString() !== fichaFiltro) {
            return false;
        }
        
        // Filtrar por Ambiente
        if (ambienteFiltro && prog.ambiente_nombre.toLowerCase() !== ambienteFiltro.toLowerCase()) {
            return false;
        }

        // Filtrar por Instructor
        if (instructorFiltro && prog.id_usuario.toString() !== instructorFiltro) {
            return false;
        }

        // Filtrar por Día de la semana
        if (filtroDia && prog.nombre_dia !== filtroDia) {
            return false;
        }

        return true;
    });

    if (!filteredData || filteredData.length === 0) {
        cardBody.innerHTML = `
            <div class="text-center py-5 text-muted">
                <i class="fa-solid fa-calendar-xmark fa-3x mb-3 text-secondary"></i>
                <h5 class="fw-bold">No hay sesiones de formación programadas que coincidan con los filtros</h5>
            </div>
        `;
        return;
    }

    let html = `
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light text-secondary small text-uppercase py-3" style="font-size: 0.78rem; font-weight: 700; letter-spacing: 0.5px;">
                    <tr>
                        <th class="ps-4 py-3">FICHA</th>
                        <th class="py-3">DÍA / HORAS</th>
                        <th class="py-3">INSTRUCTOR</th>
                        <th class="py-3">AMBIENTE</th>
                        <th class="py-3">RAP EVALUADO</th>
                        <th class="text-end pe-4 py-3">AVANCE SESIONES</th>
                        ${currentRole === 'Coordinador' ? '<th class="text-end pe-4 py-3">ACCIÓN</th>' : ''}
                    </tr>
                </thead>
                <tbody>
    `;

    filteredData.forEach(prog => {
        const pct = prog.total_sesiones > 0 ? Math.round((prog.sesiones_realizadas / prog.total_sesiones) * 100) : 75;
        const horaInicio = prog.hora_inicio.substring(0, 5);
        const horaFin = prog.hora_fin.substring(0, 5);
        
        html += `
            <tr>
                <td class="ps-4"><span class="badge-ficha-table">#${prog.numero_ficha}</span></td>
                <td>
                    <div class="fw-bold text-dark small"><i class="fa-regular fa-clock text-secondary me-1"></i> ${prog.nombre_dia}</div>
                    <div class="text-muted small">${horaInicio} - ${horaFin}</div>
                </td>
                <td class="text-dark small fw-medium">${prog.instructor_nombre} ${prog.instructor_apellido}</td>
                <td><span class="badge-ambiente-table">${prog.ambiente_nombre}</span></td>
                <td class="text-muted small" style="max-width: 320px;">${prog.ra_descripcion}</td>
                <td class="text-end pe-4">
                    <div class="fw-bold text-dark small mb-1">${prog.sesiones_realizadas} / ${prog.total_sesiones}</div>
                    <div class="progress-sena"><div class="progress-sena-bar" style="width: ${pct}%;"></div></div>
                </td>
                ${currentRole === 'Coordinador' ? `
                    <td class="text-end pe-4">
                        <a href="${urlRoot}/index.php?route=programacion/delete&id=${prog.id_programacion}" class="btn btn-outline-danger btn-sm shadow-sm" onclick="return confirm('¿Seguro que deseas eliminar esta programación?');" data-bs-toggle="tooltip" title="Eliminar Programación">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>
                    </td>
                ` : ''}
            </tr>
        `;
    });

    html += `
                </tbody>
            </table>
        </div>
    `;

    cardBody.innerHTML = html;
    
    // Inicializar tooltips de bootstrap si existen
    if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }
}

function iniciarMonitoreoProgramacion() {
    setInterval(() => {
        fetch(`${urlRoot}/index.php?route=programacion/get_programacion_ajax&role=${encodeURIComponent(currentRole)}`)
            .then(res => res.json())
            .then(res => {
                if (res.success) {
                    // Comparar los datos actuales con los nuevos
                    const serializadoActual = JSON.stringify(window.programacionDataGlobal);
                    const serializadoNuevo = JSON.stringify(res.data);
                    
                    const excepcionesActual = JSON.stringify(window.excepcionesGlobal);
                    const excepcionesNuevo = JSON.stringify(res.excepciones);

                    if (serializadoActual !== serializadoNuevo || excepcionesActual !== excepcionesNuevo) {
                        window.programacionDataGlobal = res.data;
                        window.excepcionesGlobal = res.excepciones || [];
                        cargarFiltrosDinamicos();
                        renderizarCalendario();
                        renderizarLista();
                    }
                }
            })
            .catch(err => console.error("Error al sincronizar la programación:", err));
    }, 5000); // Sincronizar cada 5 segundos
}
</script>
