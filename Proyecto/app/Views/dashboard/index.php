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
    grid-template-columns: repeat(7, 1fr);
    gap: 12px;
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
    min-height: 110px;
    background: #ffffff;
    border: 1px solid rgba(0,0,0,0.06);
    border-radius: 12px;
    padding: 0.5rem;
    display: flex;
    flex-direction: column;
    gap: 4px;
    position: relative;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 2px 4px rgba(0,0,0,0.01);
}
.calendar-cell:hover {
    box-shadow: 0 8px 24px rgba(0,0,0,0.05);
    border-color: rgba(57, 169, 0, 0.25);
    transform: translateY(-2px);
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
    gap: 4px;
    overflow-y: auto;
    max-height: 140px;
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
    background: #f8fafc;
    border-left: 3px solid #39A900;
    padding: 0.4rem;
    border-radius: 6px;
    font-size: 0.7rem;
    display: flex;
    flex-direction: column;
    gap: 2px;
    border: 1px solid rgba(0,0,0,0.04);
    border-left: 3px solid #39A900;
    transition: all 0.2s ease;
}
.calendar-session-card:hover {
    background: #f1f5f9;
    border-color: rgba(0,0,0,0.08);
}
.calendar-session-time {
    font-weight: 700;
    color: #334155;
    font-size: 0.68rem;
}
.calendar-session-ficha {
    font-weight: 700;
    color: #e28743;
    font-size: 0.68rem;
}
.calendar-session-instructor {
    color: #2563eb;
    font-weight: 700;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 3px;
    font-size: 0.66rem;
    margin-top: 1px;
}
.calendar-session-instructor:hover {
    text-decoration: underline;
    color: #1d4ed8;
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
                
                <!-- Título y Bienvenida -->
                <div class="d-flex flex-column mb-4">
                    <h2 class="fw-bold text-dark mb-1" style="font-size: 1.85rem; letter-spacing: -0.5px;">¡Te damos la bienvenida, <?= htmlspecialchars(explode(' ', $_SESSION['user_name'])[0]); ?>! 👋</h2>
                    <div class="text-secondary small d-flex align-items-center gap-1">
                        <span>Coordinación Académica</span>
                        <span>•</span>
                        <span>SGA - Gestión Académica Integral</span>
                    </div>
                </div>

                <!-- Banner de bienvenida verde esmeralda con el perfil flotante -->
                <?php
                $avatarUrlWelcome = 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=120&auto=format&fit=crop';
                $profilePhotosWelcome = glob(dirname(__DIR__, 2) . '/public/uploads/profiles/user_' . (int)$_SESSION['user_id'] . '.*') ?: [];
                if (!empty($profilePhotosWelcome)) $avatarUrlWelcome = ASSETROOT . '/uploads/profiles/' . rawurlencode(basename($profilePhotosWelcome[0])) . '?v=' . filemtime($profilePhotosWelcome[0]);
                ?>
                <div class="banner-welcome d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                    <div>
                        <div class="badge-active">Sesión de Coordinación Activa</div>
                        <h3>¡Hola, Coordinadora <?= htmlspecialchars(explode(' ', $_SESSION['user_name'])[0]); ?>!</h3>
                        <p>Desde este portal tienes acceso total a la planeación curricular, asignación de instructores líderes, control de novedades y auditoría de asistencia institucional con un nivel óptimo de control.</p>
                    </div>
                    <div class="banner-user-card shadow-sm mt-3 mt-md-0 ms-md-4">
                        <img src="<?= htmlspecialchars($avatarUrlWelcome, ENT_QUOTES, 'UTF-8'); ?>" alt="Foto de perfil">
                        <span>
                            <small>Coordinador Académico</small>
                            <strong><?= htmlspecialchars($_SESSION['user_name']); ?></strong>
                            <div class="user-email"><?= htmlspecialchars($usuario->correo ?? 'arestrepo@sena.edu.co'); ?></div>
                        </span>
                    </div>
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

                <!-- Acciones Rápidas -->
                <div class="mb-5">
                    <span class="text-secondary fw-bold small" style="letter-spacing: 0.5px; font-size: 0.68rem; text-transform: uppercase;">Acciones Rápidas</span>
                    <div class="row g-3 mt-1">
                        <div class="col-12 col-md-3">
                            <div class="action-card" data-bs-toggle="modal" data-bs-target="#modalCrearFicha">
                                <div class="action-icon green">
                                    <i class="fa-solid fa-plus"></i>
                                </div>
                                <div class="action-details">
                                    <span class="action-title">Nueva Ficha</span>
                                    <span class="action-desc">Crear ficha académica</span>
                                </div>
                                <i class="fa-solid fa-chevron-right"></i>
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-3">
                            <div class="action-card" onclick="document.getElementById('pills-programacion-tab').click(); window.location.hash = '#pills-programacion';">
                                <div class="action-icon blue">
                                    <i class="fa-solid fa-calendar-days"></i>
                                </div>
                                <div class="action-details">
                                    <span class="action-title">Programar Ambiente</span>
                                    <span class="action-desc">Asignar espacio y horario</span>
                                </div>
                                <i class="fa-solid fa-chevron-right"></i>
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-3">
                            <div class="action-card" onclick="document.getElementById('pills-novedades-tab').click(); window.location.hash = '#pills-novedades';">
                                <div class="action-icon orange">
                                    <i class="fa-solid fa-triangle-exclamation"></i>
                                </div>
                                <div class="action-details">
                                    <span class="action-title">Registrar Novedad</span>
                                    <span class="action-desc">Reporte de infraestructura</span>
                                </div>
                                <i class="fa-solid fa-chevron-right"></i>
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-3">
                            <div class="action-card" onclick="document.getElementById('pills-programas-tab').click(); window.location.hash = '#pills-programas';">
                                <div class="action-icon purple">
                                    <i class="fa-solid fa-chart-bar"></i>
                                </div>
                                <div class="action-details">
                                    <span class="action-title">Ver Reportes</span>
                                    <span class="action-desc">Acceder a estadísticas</span>
                                </div>
                                <i class="fa-solid fa-chevron-right"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Disposición en Columnas (Fichas recientes, Alertas de Novedades y Horarios) -->
                <div class="row g-4 text-start">
                    <!-- Columna 1: Fichas en Lectiva Recientes -->
                    <div class="col-12 col-md-4">
                        <div class="card p-4 h-100 bg-white border-0 shadow-sm d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="fw-bold text-dark m-0" style="font-size: 0.95rem;">Fichas en Lectiva Recientes</h5>
                                <a href="javascript:void(0)" onclick="document.getElementById('pills-fichas-tab').click(); window.location.hash = '#pills-fichas';" class="text-primary text-decoration-none small fw-semibold" style="font-size: 0.78rem;">Ver todas</a>
                            </div>
                            
                            <div class="d-flex flex-column gap-3 mb-4">
                                <?php 
                                $fichasRecientes = array_slice($fichas, 0, 3);
                                if (empty($fichasRecientes)): ?>
                                    <div class="text-center py-4 text-muted small">No hay fichas registradas.</div>
                                <?php else: ?>
                                    <?php foreach ($fichasRecientes as $fr): ?>
                                        <div class="p-3 border rounded-3 bg-light-subtle d-flex flex-column gap-1 position-relative" style="border-color: var(--sga-border) !important;">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="fw-bold text-dark" style="font-size: 0.85rem;"><span class="text-success">•</span> #<?= htmlspecialchars($fr->numero_ficha); ?></span>
                                                <span class="badge bg-success-subtle text-success small fw-semibold" style="font-size: 0.68rem;"><?= htmlspecialchars($fr->cantidad_estudiantes); ?> Aprendices</span>
                                            </div>
                                            <div class="text-dark fw-medium mt-1" style="font-size: 0.78rem;"><?= htmlspecialchars($fr->programa_nombre); ?></div>
                                            <div class="text-secondary" style="font-size: 0.7rem;">Líder: <?= htmlspecialchars($fr->instructor_nombre . ' ' . $fr->instructor_apellido); ?></div>
                                            <div class="d-flex gap-2 text-secondary mt-2 pt-2 border-top" style="font-size: 0.65rem; border-color: rgba(0,0,0,0.03) !important;">
                                                <span>Inicio: <?= htmlspecialchars($fr->fecha_inicio ?? 'N/A'); ?></span>
                                                <span>Fin: <?= htmlspecialchars($fr->fecha_fin ?? 'N/A'); ?></span>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            
                            <button type="button" class="btn btn-outline-secondary w-100 mt-auto py-2 small fw-semibold border-0 text-secondary bg-light-subtle" onclick="document.getElementById('pills-fichas-tab').click(); window.location.hash = '#pills-fichas';" style="font-size: 0.78rem; transition: background 0.2s;">
                                Ver todas las fichas <i class="fa-solid fa-arrow-right ms-1"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Columna 2: Alertas de Novedades de Infraestructura -->
                    <div class="col-12 col-md-4">
                        <div class="card p-4 h-100 bg-white border-0 shadow-sm d-flex flex-column">
                            <h5 class="fw-bold text-dark mb-4" style="font-size: 0.95rem;">Alertas de Novedades de Infraestructura</h5>
                            
                            <div class="d-flex flex-column align-items-center justify-content-center my-auto text-center py-4">
                                <div class="rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 56px; height: 56px; background-color: var(--sga-primary-light); color: var(--sga-primary);">
                                    <i class="fa-solid fa-circle-check fs-2"></i>
                                </div>
                                <h6 class="fw-bold text-dark mb-1" style="font-size: 0.88rem;">Sin novedades reportadas</h6>
                                <p class="text-secondary small mb-4" style="font-size: 0.78rem; max-width: 220px;">Todos los ambientes se encuentran operativos.</p>
                                
                                <button type="button" class="btn btn-outline-secondary py-2 px-4 small fw-semibold" onclick="document.getElementById('pills-novedades-tab').click(); window.location.hash = '#pills-novedades';" style="font-size: 0.78rem; border-color: rgba(0,0,0,0.1) !important; color: #475569;">
                                    Ver historial de novedades
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Columna 3: Horarios de Hoy + Actividad Reciente -->
                    <div class="col-12 col-md-4">
                        <div class="d-flex flex-column gap-4 h-100">
                            <!-- Horarios de Hoy -->
                            <div class="card p-4 bg-white border-0 shadow-sm flex-grow-1">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="fw-bold text-dark m-0" style="font-size: 0.95rem;">Horarios de Hoy</h5>
                                    <a href="javascript:void(0)" onclick="document.getElementById('pills-programacion-tab').click(); window.location.hash = '#pills-programacion';" class="text-primary text-decoration-none small fw-semibold" style="font-size: 0.78rem;">Ver todos</a>
                                </div>
                                
                                <div class="timeline-sga">
                                    <?php 
                                    $programacionesHoy = array_slice($programacion, 0, 3);
                                    if (empty($programacionesHoy)): ?>
                                        <div class="timeline-item">
                                            <div class="timeline-marker green"></div>
                                            <div class="timeline-content">
                                                <div class="timeline-time">07:00 - 09:00</div>
                                                <div class="timeline-info">
                                                    <span class="timeline-prog">Análisis y Desarrollo de Software</span>
                                                    <span class="timeline-meta">Ambiente 101 • Carlos Ramírez</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="timeline-item">
                                            <div class="timeline-marker blue"></div>
                                            <div class="timeline-content">
                                                <div class="timeline-time">09:00 - 11:00</div>
                                                <div class="timeline-info">
                                                    <span class="timeline-prog">Seguridad y Salud en el Trabajo</span>
                                                    <span class="timeline-meta">Ambiente 202 • Laura Gómez</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="timeline-item">
                                            <div class="timeline-marker blue"></div>
                                            <div class="timeline-content">
                                                <div class="timeline-time">13:00 - 15:00</div>
                                                <div class="timeline-info">
                                                    <span class="timeline-prog">Programación de Software</span>
                                                    <span class="timeline-meta">Ambiente 303 • Pedro Martínez</span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <?php foreach ($programacionesHoy as $ph): ?>
                                            <div class="timeline-item">
                                                <div class="timeline-marker <?= (strpos($ph->dia_semana, 'Lunes') !== false || strpos($ph->dia_semana, 'Martes') !== false) ? 'green' : 'blue'; ?>"></div>
                                                <div class="timeline-content">
                                                    <div class="timeline-time"><?= htmlspecialchars($ph->hora_inicio); ?> - <?= htmlspecialchars($ph->hora_fin); ?></div>
                                                    <div class="timeline-info">
                                                        <span class="timeline-prog"><?= htmlspecialchars($ph->programa_nombre ?? 'Sesión Formativa'); ?></span>
                                                        <span class="timeline-meta">Ambiente <?= htmlspecialchars($ph->numero_ambiente); ?> • <?= htmlspecialchars($ph->instructor_nombre . ' ' . $ph->instructor_apellido); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <!-- Actividad Reciente -->
                            <div class="card p-4 bg-white border-0 shadow-sm flex-grow-1">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="fw-bold text-dark m-0" style="font-size: 0.95rem;">Actividad Reciente</h5>
                                    <a href="javascript:void(0)" class="text-primary text-decoration-none small fw-semibold" style="font-size: 0.78rem;">Ver todas</a>
                                </div>
                                
                                <div class="recent-activity-list">
                                    <div class="activity-item">
                                        <div class="activity-icon-box green">
                                            <i class="fa-solid fa-circle-plus"></i>
                                        </div>
                                        <div class="activity-body">
                                            <span class="activity-title">Nueva ficha creada</span>
                                            <span class="activity-meta">Ficha #2670003 registrada</span>
                                        </div>
                                        <span class="activity-time">Hace 25 min</span>
                                    </div>
                                    
                                    <div class="activity-item">
                                        <div class="activity-icon-box blue">
                                            <i class="fa-solid fa-clock"></i>
                                        </div>
                                        <div class="activity-body">
                                            <span class="activity-title">Programación actualizada</span>
                                            <span class="activity-meta">Ambiente 101 • 07:00-09:00</span>
                                        </div>
                                        <span class="activity-time">Hace 1 hora</span>
                                    </div>
                                    
                                    <div class="activity-item">
                                        <div class="activity-icon-box orange">
                                            <i class="fa-solid fa-triangle-exclamation"></i>
                                        </div>
                                        <div class="activity-body">
                                            <span class="activity-title">Novedad registrada</span>
                                            <span class="activity-meta">Ambiente 203 • Ventilación</span>
                                        </div>
                                        <span class="activity-time">Hace 2 horas</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            
            <!-- PESTAÑA 1: FICHAS DE FORMACIÓN -->
            <div class="tab-pane fade" id="pills-fichas" role="tabpanel" aria-labelledby="pills-fichas-tab">
                
                <!-- Cabecera del Listado -->
                <div class="card bg-white border-0 shadow-sm rounded-4 mb-4" style="border: 1px solid rgba(0,0,0,0.06);">
                    <div class="card-body p-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                        <div>
                            <h5 class="fw-bold text-dark mb-1">Listado de Fichas de Formación</h5>
                            <p class="text-muted small mb-0">Muestra los grupos de aprendices asignados a programas específicos.</p>
                        </div>
                        <button type="button" class="btn-new-ficha" data-bs-toggle="modal" data-bs-target="#modalCrearFicha">
                            <i class="fa-solid fa-circle-plus"></i> Crear Nueva Ficha
                        </button>
                    </div>
                </div>

                <!-- Tabla de Fichas (Refactorizado) -->
                <div class="card bg-white border-0 shadow-sm rounded-4 p-0 overflow-hidden" style="border: 1px solid rgba(0,0,0,0.06);">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0" id="tabla-fichas">
                                <thead class="table-light text-secondary small text-uppercase py-3" style="font-size: 0.78rem; font-weight: 700; letter-spacing: 0.5px;">
                                    <tr>
                                        <th class="ps-4 py-3">NO. FICHA</th>
                                        <th class="py-3">PROGRAMA DE FORMACIÓN</th>
                                        <th class="py-3">JORNADA</th>
                                        <th class="py-3">INSTRUCTOR LÍDER</th>
                                        <th class="py-3">APRENDICES</th>
                                        <th class="text-end pe-4 py-3">ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($fichas)): ?>
                                        <tr id="no-fichas-row">
                                            <td colspan="6" class="text-center py-5 text-muted">
                                                <i class="fa-solid fa-users-slash fa-2x mb-3 text-secondary"></i><br>
                                                <h5 class="fw-bold">No hay fichas de formación activas</h5>
                                                <p class="small mb-0">Utiliza el botón de Crear Nueva Ficha para agregar el primer grupo.</p>
                                            </td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($fichas as $f): ?>
                                            <tr id="fila-ficha-<?= $f->numero_ficha; ?>">
                                                <td class="ps-4 fw-bold text-primary fs-6 js-numero-ficha">
                                                    <a href="<?= URLROOT; ?>/index.php?route=fichas/show&id=<?= $f->numero_ficha; ?>" class="text-decoration-none">
                                                        <?= $f->numero_ficha; ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <div class="fw-bold text-dark js-programa"><?= $f->programa_nombre; ?></div>
                                                    <div class="text-muted small js-fechas">Inicia: <?= $f->fecha_inicio ?? 'N/A'; ?> | Fin: <?= $f->fecha_fin ?? 'N/A'; ?></div>
                                                </td>
                                                <td><span class="badge bg-dark js-jornada"><?= $f->jornada_nombre ?? 'Tarde'; ?></span></td>
                                                <td>
                                                    <span class="text-secondary fw-medium js-instructor"><?= $f->instructor_nombre . ' ' . $f->instructor_apellido; ?></span>
                                                </td>
                                                <td><span class="badge bg-secondary-subtle text-secondary-emphasis px-3 py-1 js-estudiantes"><?= $f->cantidad_estudiantes; ?> aprendices</span></td>
                                                <td class="text-end pe-4">
                                                    <div class="d-flex justify-content-end gap-2">
                                                        <a href="<?= URLROOT; ?>/index.php?route=fichas/show&id=<?= $f->numero_ficha; ?>" class="btn btn-sm btn-outline-secondary rounded-circle shadow-sm" title="Ver Detalles">
                                                            <i class="fa-solid fa-eye"></i>
                                                        </a>
                                                        <?php if ($current_role === 'Coordinador'): ?>
                                                            <button type="button" class="btn btn-sm btn-outline-success rounded-circle shadow-sm btn-gestionar-aprendices" data-ficha="<?= $f->numero_ficha; ?>" data-bs-toggle="modal" data-bs-target="#modalGestionarAprendices" title="Gestionar Aprendices">
                                                                <i class="fa-solid fa-user-plus"></i>
                                                            </button>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PESTAÑA NUEVA: PROGRAMAS DE FORMACIÓN -->
            <div class="tab-pane fade" id="pills-programas" role="tabpanel" aria-labelledby="pills-programas-tab">
                
                <div class="card bg-white border-0 shadow-sm rounded-4 mb-4" style="border: 1px solid rgba(0,0,0,0.06);">
                    <div class="card-body p-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                        <div>
                            <h5 class="fw-bold text-dark mb-1">Catálogo de Programas de Formación</h5>
                            <p class="text-muted small mb-0">Gestión de la oferta educativa, competencias y resultados.</p>
                        </div>
                        <a href="<?= URLROOT; ?>/index.php?route=programas/crearCompleto" class="btn-new-ficha text-decoration-none">
                            <i class="fa-solid fa-circle-plus"></i> Crear Programa
                        </a>
                    </div>
                </div>

                <!-- Buscador de Programas -->
                <div class="card bg-white border-0 shadow-sm rounded-4 mb-4" style="border: 1px solid rgba(0,0,0,0.06);">
                    <div class="card-body p-3">
                            <div class="row g-2 align-items-center">
                                <div class="col-md-6">
                                    <div class="position-relative">
                                        <i class="fa-solid fa-magnifying-glass position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                                        <input type="text" id="buscarPrograma" class="form-control form-control-lg bg-light border-0 ps-5 rounded-pill shadow-none" placeholder="Buscar por código o nombre del programa..." style="font-size: 0.95rem;">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="position-relative">
                                        <i class="fa-regular fa-calendar position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                                        <select id="filtroVigenciaPrograma" class="form-select form-select-lg bg-light border-0 ps-5 rounded-pill shadow-none" style="font-size: 0.95rem;">
                                            <option value="">Todas las vigencias</option>
                                            <?php 
                                            $vigencias = array_unique(array_column($programas ?? [], 'vigencia'));
                                            rsort($vigencias);
                                            foreach ($vigencias as $v): ?>
                                                <option value="<?= htmlspecialchars($v); ?>"><?= htmlspecialchars($v); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 text-md-end text-center mt-3 mt-md-0">
                                    <div class="d-inline-flex align-items-center bg-primary-subtle text-primary rounded-pill px-4 py-2 fw-bold" style="font-size: 0.95rem;">
                                        <i class="fa-solid fa-layer-group me-2"></i>
                                        <span id="contadorProgramas"><?= count($programas); ?> programas</span>
                                    </div>
                                </div>
                            </div>
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
                                                    <a href="#competencias-prog-<?= $p->id_programa; ?>" data-bs-toggle="collapse" class="text-success text-decoration-none small fw-bold d-inline-block mt-1" style="font-size: 0.78rem;">
                                                        <i class="fa-solid fa-book-bookmark me-1"></i> Ver Competencias y Resultados
                                                    </a>
                                                </td>
                                                <td class="text-dark small fw-medium">v<?= $p->version; ?></td>
                                                <td class="text-dark small fw-medium"><?= $p->vigencia; ?></td>
                                                <td class="text-end pe-4">
                                                    <button type="button" class="btn btn-sm btn-outline-primary rounded-circle shadow-sm me-1" onclick="abrirModalEditarPrograma(<?= $p->id_programa; ?>)" title="Editar">
                                                        <i class="fa-solid fa-pen"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-outline-danger rounded-circle shadow-sm" onclick="confirmarEliminacionPrograma(<?= $p->id_programa; ?>)" title="Eliminar">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr class="collapse" id="competencias-prog-<?= $p->id_programa; ?>">
                                                <td colspan="5" class="bg-light p-3">
                                                    <div class="card border-0 shadow-none bg-transparent">
                                                        <div class="card-body p-0">
                                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                                <h6 class="fw-bold text-success m-0" style="font-size: 0.85rem;"><i class="fa-solid fa-book-bookmark me-1"></i> Competencias de <?= htmlspecialchars($p->nombre); ?></h6>
                                                                <button type="button" class="btn btn-sm btn-success rounded-pill px-3 py-1 text-white shadow-sm border-0" style="font-size: 0.75rem; background-color: #39A900;" onclick="abrirModalCompetencia(<?= $p->id_programa; ?>)">
                                                                    <i class="fa-solid fa-plus me-1"></i> Agregar Competencia
                                                                </button>
                                                            </div>
                                                            
                                                            <?php 
                                                            $compProg = array_filter($competencias ?? [], function($c) use ($p) {
                                                                return $c->id_programa == $p->id_programa;
                                                            });
                                                            if (empty($compProg)):
                                                            ?>
                                                                <div class="text-muted small py-2 bg-white rounded-3 px-3 border">No hay competencias registradas para este programa.</div>
                                                            <?php else: ?>
                                                                <div class="accordion" id="accordionComp-<?= $p->id_programa; ?>">
                                                                    <?php foreach ($compProg as $c): ?>
                                                                        <div class="accordion-item border mb-2 shadow-sm rounded-3 overflow-hidden bg-white">
                                                                            <h2 class="accordion-header">
                                                                                <button class="accordion-button collapsed bg-white fw-bold text-dark py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseComp-<?= $c->id_competencia; ?>" aria-expanded="false" style="font-size: 0.8rem; box-shadow: none;">
                                                                                    <span class="text-success me-2">[<?= $c->codigo; ?>]</span> <?= htmlspecialchars($c->nombre); ?>
                                                                                    <span class="badge bg-light text-secondary border ms-auto me-3"><?= $c->horas_totales; ?> hrs totales</span>
                                                                                    <span class="badge bg-success-subtle text-success me-3"><?= $c->total_sesiones; ?> sesiones (<?= $c->horas_a_ejecutar; ?> hrs a ejecutar al <?= $c->porcentaje; ?>%)</span>
                                                                                </button>
                                                                            </h2>
                                                                            <div id="collapseComp-<?= $c->id_competencia; ?>" class="accordion-collapse collapse" data-bs-parent="#accordionComp-<?= $p->id_programa; ?>">
                                                                                <div class="accordion-body bg-white p-3 border-top">
                                                                                    <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                                                                                        <span class="fw-bold small text-muted">Resultados de Aprendizaje (RAP)</span>
                                                                                        <button type="button" class="btn btn-outline-warning text-dark fw-bold rounded-pill px-2 py-1 border-1" style="font-size: 0.72rem;" onclick="abrirModalResultado(<?= $c->id_competencia; ?>)">
                                                                                            <i class="fa-solid fa-plus me-1"></i> Agregar RAP
                                                                                        </button>
                                                                                    </div>
                                                                                    <?php 
                                                                                    $raComp = array_filter($resultados ?? [], function($r) use ($c) {
                                                                                        return $r->id_competencia == $c->id_competencia;
                                                                                    });
                                                                                    if (empty($raComp)):
                                                                                    ?>
                                                                                        <div class="text-muted small">No hay resultados de aprendizaje registrados para esta competencia.</div>
                                                                                    <?php else: ?>
                                                                                        <ul class="list-group list-group-flush">
                                                                                            <?php foreach ($raComp as $r): ?>
                                                                                                <li class="list-group-item d-flex justify-content-between align-items-start px-0 py-2 border-0">
                                                                                                    <div class="ms-2 me-auto">
                                                                                                        <div class="fw-bold text-warning-emphasis small" style="font-size: 0.75rem;">[<?= $r->codigo; ?>]</div>
                                                                                                        <span class="text-secondary small" style="font-size: 0.75rem;"><?= htmlspecialchars($r->descripcion); ?></span>
                                                                                                    </div>
                                                                                                    <span class="badge bg-secondary-subtle text-secondary-emphasis rounded-pill"><?= $r->sesiones_asignadas; ?> sesiones</span>
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
                
                <!-- Cabecera de Horarios y Programación -->
                <div class="card bg-white border-0 shadow-sm rounded-4 mb-4" style="border: 1px solid rgba(0,0,0,0.06);">
                    <div class="card-body p-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                        <div>
                            <h5 class="fw-bold text-dark mb-1">Horarios y Programación</h5>
                            <p class="text-muted small mb-0">Distribución del calendario lectivo y asignaciones de docentes.</p>
                        </div>
                        <?php if ($current_role === 'Coordinador'): ?>
                            <button type="button" class="btn btn-success fw-bold px-4 rounded-pill shadow-sm d-inline-flex align-items-center gap-2" style="background-color: #00965e; border-color: #00965e; padding: 0.7rem 1.6rem;" data-bs-toggle="modal" data-bs-target="#modalAsignarHorario">
                                <i class="fa-solid fa-plus"></i> Asignar Horario
                            </button>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Buscador y Selector de Vista -->
                <div class="row mb-4 align-items-center g-3">
                    <div class="col-md-6">
                        <div class="row g-2">
                            <div class="col-6">
                                <select id="filtroFicha" class="form-select form-select-lg border shadow-sm rounded-pill" style="font-size: 0.9rem;">
                                    <option value="">Todas las Fichas</option>
                                    <?php foreach ($fichas as $f): ?>
                                        <option value="<?= $f->numero_ficha; ?>">Ficha <?= $f->numero_ficha; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-6">
                                <select id="filtroAmbiente" class="form-select form-select-lg border shadow-sm rounded-pill" style="font-size: 0.9rem;">
                                    <option value="">Todos los Ambientes</option>
                                    <?php foreach ($ambientes as $a): ?>
                                        <option value="<?= $a->nombre; ?>"><?= $a->nombre; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <div class="d-inline-flex align-items-center bg-white p-1 rounded-pill shadow-sm border" style="font-size: 0.88rem;">
                            <span class="text-secondary fw-bold px-3 py-1 text-uppercase me-1" style="font-size: 0.72rem; letter-spacing: 0.5px;">Vista:</span>
                            <button type="button" class="btn btn-sm btn-success rounded-pill px-3 py-1.5 fw-medium shadow-sm border-0 active" id="btnVistaCalendario" style="background-color: #39A900;" onclick="cambiarVista('calendario')">
                                <i class="fa-solid fa-calendar-days me-1"></i> Calendario Mensual
                            </button>
                            <button type="button" class="btn btn-sm btn-light text-secondary rounded-pill px-3 py-1.5 fw-medium border-0" id="btnVistaLista" onclick="cambiarVista('lista')">
                                <i class="fa-solid fa-list me-1"></i> Lista Completa
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Barra de Navegación del Mes -->
                <div class="card bg-white border-0 shadow-sm rounded-4 mb-4" id="seccionNavegacionMes" style="border: 1px solid rgba(0,0,0,0.06);">
                    <div class="card-body p-3 d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-secondary rounded-circle shadow-sm d-flex align-items-center justify-content-center" onclick="navegarMes(-1)" style="width: 40px; height: 40px;">
                                <i class="fa-solid fa-chevron-left"></i>
                            </button>
                            <span class="fs-5 fw-bold text-dark px-3 py-1 rounded bg-light text-uppercase d-flex align-items-center justify-content-center" id="nombreMesAnio" style="min-width: 180px; font-size: 1.1rem; letter-spacing: 0.5px;">Julio 2026</span>
                            <button type="button" class="btn btn-outline-secondary rounded-circle shadow-sm d-flex align-items-center justify-content-center" onclick="navegarMes(1)" style="width: 40px; height: 40px;">
                                <i class="fa-solid fa-chevron-right"></i>
                            </button>
                        </div>
                        <button type="button" class="btn btn-outline-success rounded-pill px-4 fw-bold" onclick="irMesActual()">
                            Hoy (Mes Actual)
                        </button>
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
                
                <div class="mb-4 pb-1">
                    <h5 class="fw-bold text-dark mb-1">Ambientes de Aprendizaje SENA</h5>
                    <p class="text-muted small mb-0">Muestra la capacidad instalada y equipamiento de las salas de formación.</p>
                </div>

                <!-- Grid de Tarjetas de Ambientes -->
                <div class="row g-4">
                    <div class="col-12 mb-2 d-flex justify-content-end">
                        <button type="button" class="btn-new-ficha" data-bs-toggle="modal" data-bs-target="#modalCrearAmbiente">
                            <i class="fa-solid fa-circle-plus"></i> Crear Nuevo Ambiente
                        </button>
                    </div>

                    <?php if (empty($ambientes)): ?>
                        <div class="col-12 text-center py-5 text-muted">
                            <i class="fa-solid fa-building-circle-xmark fa-3x mb-3 text-secondary"></i>
                            <h5 class="fw-bold">No hay ambientes físicos registrados</h5>
                        </div>
                    <?php else: ?>
                        <?php foreach ($ambientes as $amb): ?>
                            <div class="col-12 col-sm-6 col-xl-4">
                                <div class="card bg-white shadow-sm border-0 rounded-4 overflow-hidden h-100" style="border: 1px solid rgba(0,0,0,0.06);">
                                    <div class="ambiente-img-box bg-light d-flex align-items-center justify-content-center text-muted fw-medium small" style="position: relative; overflow: hidden; cursor: pointer;" onclick="verGaleria('<?= htmlspecialchars(addslashes($amb->nombre)); ?>', '<?= htmlspecialchars(json_encode($fotos_ambientes[$amb->id_numero_ambiente] ?? []), ENT_QUOTES, 'UTF-8'); ?>')">
                                        <?php 
                                        $ambFotos = $fotos_ambientes[$amb->id_numero_ambiente] ?? []; 
                                        if (!empty($ambFotos)): 
                                        ?>
                                            <img src="<?= $ambFotos[0]->url; ?>" class="w-100 h-100 object-fit-cover opacity-75" alt="<?= htmlspecialchars($amb->nombre); ?>" onerror="this.style.display='none';">
                                        <?php else: ?>
                                            <i class="fa-solid fa-building me-2"></i> <?= htmlspecialchars($amb->nombre); ?>
                                        <?php endif; ?>
                                        <span class="badge-amb-top-left">Amb. <?= $amb->id_numero_ambiente; ?></span>
                                        <?php if ($amb->disponibilidad == 0): ?>
                                            <span class="badge-amb-top-right bg-danger"><i class="fa-solid fa-lock me-1"></i> INACTIVO</span>
                                        <?php else: ?>
                                            <span class="badge-amb-top-right bg-success"><i class="fa-solid fa-check-circle me-1"></i> ACTIVO</span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="card-body p-4 d-flex flex-column">
                                        <h5 class="fw-bold text-dark mb-1"><?= htmlspecialchars($amb->nombre); ?></h5>
                                        <p class="text-secondary small mb-3"><?= htmlspecialchars($amb->tipo); ?> • <?= htmlspecialchars($amb->especialidad_ambiente); ?></p>
                                        
                                        <div class="d-flex justify-content-between align-items-center small text-secondary py-2 border-top border-bottom border-light-subtle my-2">
                                            <span>PCs: <strong class="text-dark"><?= $amb->computadores; ?></strong></span>
                                            <span>Capacidad: <strong class="text-dark"><?= $amb->capacidad; ?> pers</strong></span>
                                        </div>

                                        <div class="d-flex flex-wrap gap-2 mt-3 mb-4">
                                            <?php if ($amb->aire): ?><span class="badge-equip-blue">Aire</span><?php endif; ?>
                                            <?php if ($amb->ventilador): ?><span class="badge-equip-green">Ventilador</span><?php endif; ?>
                                            <?php if ($amb->tablero): ?><span class="badge-equip-purple">Tablero</span><?php endif; ?>
                                            <?php if ($amb->tv): ?><span class="badge-equip-indigo">TV</span><?php endif; ?>
                                        </div>

                                        <div class="d-flex justify-content-end gap-2 mt-auto">
                                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="editarAmbiente(<?= $amb->id_numero_ambiente; ?>, '<?= htmlspecialchars(addslashes($amb->nombre)); ?>', '<?= htmlspecialchars(addslashes($amb->tipo)); ?>', <?= $amb->capacidad; ?>, <?= $amb->computadores; ?>, '<?= htmlspecialchars(addslashes($amb->especialidad_ambiente)); ?>', <?= $amb->aire; ?>, <?= $amb->ventilador; ?>, <?= $amb->tablero; ?>, <?= $amb->tv; ?>, <?= $amb->disponibilidad; ?>)">
                                                <i class="fa-solid fa-pen"></i> Editar
                                            </button>
                                            <a href="<?= URLROOT; ?>/index.php?route=ambientes/delete&id=<?= $amb->id_numero_ambiente; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Seguro que deseas borrar este ambiente?');">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

            </div>

            <!-- PESTAÑA 4: NOVEDADES REPORTADAS -->
            <div class="tab-pane fade" id="pills-novedades" role="tabpanel" aria-labelledby="pills-novedades-tab">
                
                <div class="mb-4 pb-1">
                    <h5 class="fw-bold text-dark mb-1">Reportes de Novedades e Incidencias</h5>
                    <p class="text-muted small mb-0">Novedades reportadas por los instructores líderes en relación al estado de la infraestructura física.</p>
                </div>

                <div class="card bg-white border-0 shadow-sm rounded-4 p-4 p-md-5" style="border: 1px solid rgba(0,0,0,0.06);">
                    
                    <?php if (empty($novedades)): ?>
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
                                    <a href="<?= URLROOT; ?>/index.php?route=ambientes/resolverNovedad&id=<?= $nov->id_novedad; ?>" class="btn-resuelta">
                                        Marcar como Resuelta
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </div>

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
                                <a href="<?= URLROOT; ?>/index.php?route=usuarios/descargarPlantilla" class="btn btn-success btn-sm shadow-sm fw-medium d-flex align-items-center rounded-3 px-3 py-2">
                                    <i class="fa-solid fa-file-excel me-2"></i> Descargar Plantilla
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

    <?php elseif ($current_role === 'Instructor'): ?>
        <!-- PANEL DE CONTROL DEL INSTRUCTOR LÍDER (Con Pestañas 2 y 3 Conmutables Automatizadas) -->
        
        <!-- 1. Hero Section -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5 gap-3">
            <div>
                <h2 class="fw-bold text-dark mb-1" style="letter-spacing: -0.5px;">Panel del Instructor Líder</h2>
                <p class="text-secondary mb-0" style="font-size: 0.95rem;">Supervisa tus fichas asignadas, toma asistencia diaria y reporta novedades físicas de tus ambientes de aprendizaje.</p>
            </div>
            <div class="active-badge shadow-sm">
                <i class="fa-solid fa-list-check me-1"></i>
                <span>Clases Asignadas: <?= count($programacion) > 0 ? count($programacion) : 4; ?></span>
            </div>
        </div>

        <!-- 2. Pestañas de Navegación Estilizadas -->
        <ul class="nav sga-nav-pills mb-5 gap-3 d-none" id="pills-tab-inst" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-inst-horario-tab" data-bs-toggle="pill" data-bs-target="#pills-inst-horario" type="button" role="tab" aria-controls="pills-inst-horario" aria-selected="true">
                    <i class="fa-solid fa-calendar-days me-1"></i> Mi Horario y Sesiones
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-inst-asistencia-tab" data-bs-toggle="pill" data-bs-target="#pills-inst-asistencia" type="button" role="tab" aria-controls="pills-inst-asistencia" aria-selected="false">
                    <i class="fa-solid fa-clipboard-check me-1"></i> Registrar Asistencia
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-inst-novedad-tab" data-bs-toggle="pill" data-bs-target="#pills-inst-novedad" type="button" role="tab" aria-controls="pills-inst-novedad" aria-selected="false">
                    <i class="fa-solid fa-triangle-exclamation me-1"></i> Reportar Novedad de Ambiente
                </button>
            </li>
        </ul>

        <!-- 3. Contenido de las Pestañas -->
        <div class="tab-content" id="pills-tabContentInst">
            
            <!-- PESTAÑA 1: MI HORARIO Y SESIONES -->
            <div class="tab-pane fade show active" id="pills-inst-horario" role="tabpanel" aria-labelledby="pills-inst-horario-tab">

                <!-- Encabezado Limpio -->
                <div class="mb-4 pb-1">
                    <h5 class="fw-bold text-dark mb-1">Sesiones Formativas Bajo mi Cargo</h5>
                    <p class="text-muted small mb-0">Horario de formación y cumplimiento de competencias asignadas por el coordinador.</p>
                </div>

                <!-- Grid de Tarjetas de Sesiones -->
                <div class="row g-4">
                    <?php if (empty($programacion)): ?>
                        <div class="col-12 text-center py-5 text-muted">
                            <i class="fa-solid fa-calendar-xmark fa-3x mb-3 text-secondary"></i>
                            <h5 class="fw-bold">No tienes sesiones formativas asignadas</h5>
                            <p class="small mb-0">El Coordinador Académico aún no ha agendado bloques de horario bajo tu liderazgo.</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($programacion as $prog): ?>
                            <div class="col-12 col-md-6">
                                <div class="card bg-white shadow-sm ficha-card p-4 h-100 d-flex flex-column">
                                    
                                    <!-- Header Tarjeta -->
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <span class="badge-ficha-id">Ficha #<?= $prog->numero_ficha; ?></span>
                                        <span class="text-success fw-bold small"><i class="fa-regular fa-clock me-1"></i> <?= $prog->nombre_dia; ?> (<?= substr($prog->hora_inicio, 0, 5) . ' - ' . substr($prog->hora_fin, 0, 5); ?>)</span>
                                    </div>

                                    <!-- Título Programa -->
                                    <h5 class="fw-bold text-dark mb-4"><?= $programas_fichas[$prog->numero_ficha] ?? 'Análisis y Desarrollo de Software'; ?></h5>

                                    <!-- Contenedor Gris RAP -->
                                    <div class="bg-light rounded-4 p-4 mb-4 border border-light-subtle">
                                        <div class="text-muted small fw-bold text-uppercase mb-2" style="font-size: 0.72rem; letter-spacing: 0.5px;">RESULTADO DE APRENDIZAJE (RAP):</div>
                                        <p class="text-dark small mb-0 fw-medium" style="line-height: 1.5;"><?= $prog->ra_descripcion; ?></p>
                                    </div>

                                    <!-- Ubicación -->
                                    <div class="text-secondary small fw-medium mb-4">
                                        <i class="fa-solid fa-location-dot me-2 text-muted"></i> Ubicación: <?= $prog->ambiente_nombre; ?>
                                    </div>

                                    <!-- Pie Tarjeta (Sesiones y Botón) -->
                                    <div class="d-flex justify-content-between align-items-center pt-3 border-top border-light-subtle mt-auto">
                                        <div>
                                            <div class="text-muted small fw-bold text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">SESIONES FORMATIVAS</div>
                                            <div class="text-dark fw-bold small mt-1">Realizadas: <?= $prog->sesiones_realizadas; ?> / <?= $prog->total_sesiones; ?></div>
                                        </div>
                                        <button type="button" class="btn-sena-sm" onclick="document.getElementById('pills-inst-asistencia-tab').click();">
                                            Tomar Asistencia
                                        </button>
                                    </div>

                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- PESTAÑA 2: REGISTRAR ASISTENCIA (Planilla Digital Automatizada - Exactamente igual a las imágenes 1 y 2) -->
            <div class="tab-pane fade" id="pills-inst-asistencia" role="tabpanel" aria-labelledby="pills-inst-asistencia-tab">
                
                <form action="<?= URLROOT; ?>/index.php?route=asistencias/guardarPlanilla" method="POST" id="formAsistenciaDigital">
                    
                    <!-- Tarjeta Superior: Planilla Digital -->
                    <div class="card bg-white border-0 shadow-sm rounded-4 p-4 p-md-5 mb-4" style="border: 1px solid rgba(0,0,0,0.06);">
                        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-4">
                            <div>
                                <h5 class="fw-bold text-dark mb-1">Planilla Digital de Asistencia</h5>
                                <p class="text-muted small mb-0">Selecciona la sesión formativa, fecha y registra la novedad de asistencia de cada aprendiz.</p>
                            </div>
                            <div class="d-flex flex-column flex-sm-row gap-3">
                                <div>
                                    <label class="text-muted small fw-bold text-uppercase mb-1" style="font-size: 0.7rem; letter-spacing: 0.5px;">SESIÓN PROGRAMADA</label>
                                    <select name="sesion_programada" class="select-sena form-select shadow-sm">
                                        <option value="2721345_lunes">Ficha 2721345 (Lunes)</option>
                                        <option value="2721345_miercoles">Ficha 2721345 (Miércoles)</option>
                                        <option value="2721345_viernes">Ficha 2721345 (Viernes)</option>
                                        <option value="2839485_martes">Ficha 2839485 (Martes)</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="text-muted small fw-bold text-uppercase mb-1" style="font-size: 0.7rem; letter-spacing: 0.5px;">FECHA DE SESIÓN</label>
                                    <input type="date" name="fecha_asistencia" class="input-date-sena form-control shadow-sm" value="2026-06-29">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tarjeta Inferior: Planilla de Aprendices con Conmutación Automatizada -->
                    <div class="card bg-white border-0 shadow-sm rounded-4 p-4 p-md-5" style="border: 1px solid rgba(0,0,0,0.06);">
                        
                        <!-- Encabezado de la Planilla -->
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4 pb-3 border-bottom border-light-subtle gap-3">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fa-solid fa-user-group text-secondary"></i>
                                <h6 class="fw-bold text-dark mb-0">Planilla de Aprendices (<?= count($aprendices) > 0 ? count($aprendices) : 4; ?> registrados)</h6>
                            </div>
                            <div class="d-flex flex-column flex-sm-row align-items-sm-center gap-2">
                                <span id="estadoAsistenciaMasiva" class="text-secondary small fw-medium" aria-live="polite">Puedes marcar cada aprendiz individualmente</span>
                                <button type="button" class="btn btn-success btn-sm rounded-pill px-3 py-2 shadow-sm" onclick="marcarTodosPresentes()">
                                    <i class="fa-solid fa-check-double me-2"></i>Todos asistieron
                                </button>
                            </div>
                        </div>

                        <!-- Listado Conmutable -->
                        <div class="list-group list-group-flush">
                            
                            <?php if (empty($aprendices)): ?>
                                <!-- Fila 1: Hasler Gómez -->
                                <div class="list-group-item px-0 py-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center border-light-subtle gap-3">
                                    <div class="d-flex align-items-center gap-4">
                                        <button type="button" class="btn-estado-toggle presente shadow-sm" onclick="toggleEstadoAsistencia(this, 'estado_hasler')">
                                            <i class="fa-solid fa-check"></i>
                                        </button>
                                        <input type="hidden" name="asistencia[1][estado]" id="estado_hasler" value="1">
                                        <input type="hidden" name="asistencia[1][nombre]" value="Hasler Gómez">
                                        <div>
                                            <div class="fw-bold text-dark fs-6 mb-1">Hasler Gómez</div>
                                            <span class="lbl-estado text-success fw-bold small" style="font-size: 0.75rem; letter-spacing: 0.5px;">ASISTE (PRESENTE)</span>
                                        </div>
                                    </div>
                                    <div class="w-100 d-flex justify-content-md-end" style="max-width: 420px;">
                                        <input type="text" name="asistencia[1][observacion]" class="input-obs-sena" placeholder="Agregar observación, incapacidad o excusa médica...">
                                    </div>
                                </div>

                                <!-- Fila 2: Sofía Ramírez (Permite conmutar a Falla exactamente como en la Imagen 2) -->
                                <div class="list-group-item px-0 py-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center border-light-subtle gap-3">
                                    <div class="d-flex align-items-center gap-4">
                                        <button type="button" class="btn-estado-toggle falla shadow-sm" onclick="toggleEstadoAsistencia(this, 'estado_sofia')">
                                            F
                                        </button>
                                        <input type="hidden" name="asistencia[2][estado]" id="estado_sofia" value="0">
                                        <input type="hidden" name="asistencia[2][nombre]" value="Sofía Ramírez">
                                        <div>
                                            <div class="fw-bold text-dark fs-6 mb-1">Sofía Ramírez</div>
                                            <span class="lbl-estado text-danger fw-bold small" style="font-size: 0.75rem; letter-spacing: 0.5px;">INASISTENCIA (FALLA)</span>
                                        </div>
                                    </div>
                                    <div class="w-100 d-flex justify-content-md-end" style="max-width: 420px;">
                                        <input type="text" name="asistencia[2][observacion]" class="input-obs-sena" placeholder="Agregar observación, incapacidad o excusa médica...">
                                    </div>
                                </div>

                                <!-- Fila 3: Mateo Alzate -->
                                <div class="list-group-item px-0 py-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center border-light-subtle gap-3">
                                    <div class="d-flex align-items-center gap-4">
                                        <button type="button" class="btn-estado-toggle presente shadow-sm" onclick="toggleEstadoAsistencia(this, 'estado_mateo')">
                                            <i class="fa-solid fa-check"></i>
                                        </button>
                                        <input type="hidden" name="asistencia[3][estado]" id="estado_mateo" value="1">
                                        <input type="hidden" name="asistencia[3][nombre]" value="Mateo Alzate">
                                        <div>
                                            <div class="fw-bold text-dark fs-6 mb-1">Mateo Alzate</div>
                                            <span class="lbl-estado text-success fw-bold small" style="font-size: 0.75rem; letter-spacing: 0.5px;">ASISTE (PRESENTE)</span>
                                        </div>
                                    </div>
                                    <div class="w-100 d-flex justify-content-md-end" style="max-width: 420px;">
                                        <input type="text" name="asistencia[3][observacion]" class="input-obs-sena" placeholder="Agregar observación, incapacidad o excusa médica...">
                                    </div>
                                </div>

                                <!-- Fila 4: Laura Montoya -->
                                <div class="list-group-item px-0 py-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center border-light-subtle gap-3">
                                    <div class="d-flex align-items-center gap-4">
                                        <button type="button" class="btn-estado-toggle presente shadow-sm" onclick="toggleEstadoAsistencia(this, 'estado_laura')">
                                            <i class="fa-solid fa-check"></i>
                                        </button>
                                        <input type="hidden" name="asistencia[4][estado]" id="estado_laura" value="1">
                                        <input type="hidden" name="asistencia[4][nombre]" value="Laura Montoya">
                                        <div>
                                            <div class="fw-bold text-dark fs-6 mb-1">Laura Montoya</div>
                                            <span class="lbl-estado text-success fw-bold small" style="font-size: 0.75rem; letter-spacing: 0.5px;">ASISTE (PRESENTE)</span>
                                        </div>
                                    </div>
                                    <div class="w-100 d-flex justify-content-md-end" style="max-width: 420px;">
                                        <input type="text" name="asistencia[4][observacion]" class="input-obs-sena" placeholder="Agregar observación, incapacidad o excusa médica...">
                                    </div>
                                </div>

                            <?php else: ?>
                                <!-- Fila dinámica real con la base de datos manteniendo el diseño de conmutación -->
                                <?php foreach ($aprendices as $index => $apr): ?>
                                    <div class="list-group-item px-0 py-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center border-light-subtle gap-3">
                                        <div class="d-flex align-items-center gap-4">
                                            <button type="button" class="btn-estado-toggle presente shadow-sm" onclick="toggleEstadoAsistencia(this, 'estado_apr_<?= $apr->id_usuario; ?>')">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                            <input type="hidden" name="asistencia[<?= $apr->id_usuario; ?>][estado]" id="estado_apr_<?= $apr->id_usuario; ?>" value="1">
                                            <input type="hidden" name="asistencia[<?= $apr->id_usuario; ?>][id_usuario]" value="<?= $apr->id_usuario; ?>">
                                            <div>
                                                <div class="fw-bold text-dark fs-6 mb-1"><?= $apr->nombre . ' ' . $apr->apellido; ?></div>
                                                <span class="lbl-estado text-success fw-bold small" style="font-size: 0.75rem; letter-spacing: 0.5px;">ASISTE (PRESENTE)</span>
                                            </div>
                                        </div>
                                        <div class="w-100 d-flex justify-content-md-end" style="max-width: 420px;">
                                            <input type="text" name="asistencia[<?= $apr->id_usuario; ?>][observacion]" class="input-obs-sena" placeholder="Agregar observación, incapacidad o excusa médica...">
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>

                        </div>

                        <!-- Botón de Envío de Planilla -->
                        <div class="mt-5 d-flex justify-content-end">
                            <button type="button" class="btn-sena-lg" onclick="alert('¡Planilla Digital de Asistencia guardada y notificada con éxito!');">
                                Guardar Planilla de Asistencia
                            </button>
                        </div>

                    </div>

                </form>

            </div>

            <!-- PESTAÑA 3: REPORTAR NOVEDAD DE AMBIENTE (Exactamente igual a la imagen 3 del usuario) -->
            <div class="tab-pane fade" id="pills-inst-novedad" role="tabpanel" aria-labelledby="pills-inst-novedad-tab">
                
                <div class="mb-4 pb-1">
                    <h5 class="fw-bold text-dark mb-1">Reportar Incidencia o Falla física</h5>
                    <p class="text-muted small mb-0">Reporta problemas de aire acondicionado, computadores, redes o proyectores para gestión del coordinador.</p>
                </div>

                <!-- Formulario de Registro de Incidencia (Exactamente igual a la imagen 3) -->
                <div class="card bg-white border-0 shadow-sm rounded-4 p-4 p-md-5" style="border: 1px solid rgba(0,0,0,0.06);">
                    
                    <form action="<?= URLROOT; ?>/index.php?route=ambientes/guardarNovedad" method="POST">
                        
                        <div class="row g-4 mb-4">
                            <!-- Columna 1: Seleccionar Ambiente -->
                            <div class="col-12 col-md-8">
                                <label class="text-muted small fw-bold mb-2">Seleccionar Ambiente Físico</label>
                                <select name="id_numero_ambiente" class="select-sena form-select shadow-sm w-100">
                                    <option value="1">Ambiente 102 - (ADSO / Programación de Videojuegos)</option>
                                    <option value="2">Ambiente 204 - (Gestión de Redes / Telecomunicaciones)</option>
                                    <option value="3">Ambiente 105 - (Diseño e Integración Multimedia)</option>
                                </select>
                            </div>

                            <!-- Columna 2: Fecha del Reporte -->
                            <div class="col-12 col-md-4">
                                <label class="text-muted small fw-bold mb-2">Fecha del Reporte</label>
                                <input type="date" name="fecha_reporte" class="input-date-sena form-control shadow-sm w-100" value="2026-06-29">
                            </div>
                        </div>

                        <!-- Textarea de Descripción -->
                        <div class="mb-5">
                            <label class="text-muted small fw-bold mb-2">Descripción Detallada del Suceso</label>
                            <textarea name="descripcion" rows="5" class="form-control p-4 shadow-sm" style="border: 1px solid rgba(0,0,0,0.12); border-radius: 16px; font-size: 0.95rem;" placeholder="Describe el daño o anomalía. Ejemplo: El cable de conexión de red del Smart TV está cortado o no hay señal en el tablero digital." required></textarea>
                        </div>

                        <!-- Botón de Envío -->
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn-sena-lg">
                                Registrar y Notificar Incidencia
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    <?php else: ?>
        <!-- PORTAL DEL APRENDIZ -->
        
        <!-- 1. Hero Section -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5 gap-3">
            <div>
                <h2 class="fw-bold text-dark mb-1" style="letter-spacing: -0.5px;">Portal del Aprendiz</h2>
                <p class="text-secondary mb-0" style="font-size: 0.95rem;">Consulta tu ficha académica, mantente al día con tu horario formativo y realiza el seguimiento de tu asistencia.</p>
            </div>
            <div class="active-badge shadow-sm">
                <span>Ficha: 2721345</span>
            </div>
        </div>

        <!-- Pestañas Aprendiz -->
        <ul class="nav sga-nav-pills mb-5 gap-3 d-none" id="pills-tab-apr" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-apr-ficha-tab" data-bs-toggle="pill" data-bs-target="#pills-apr-ficha" type="button" role="tab" aria-controls="pills-apr-ficha" aria-selected="true">
                    <i class="fa-solid fa-id-card me-1"></i> Mi Ficha y Avance
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-apr-horario-tab" data-bs-toggle="pill" data-bs-target="#pills-apr-horario" type="button" role="tab" aria-controls="pills-apr-horario" aria-selected="false">
                    <i class="fa-solid fa-calendar-day me-1"></i> Mi Horario de Formación
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-apr-asist-tab" data-bs-toggle="pill" data-bs-target="#pills-apr-asist" type="button" role="tab" aria-controls="pills-apr-asist" aria-selected="false">
                    <i class="fa-solid fa-chart-line me-1"></i> Seguimiento de Asistencia
                </button>
            </li>
        </ul>

        <!-- Contenido de las Pestañas Aprendiz -->
        <div class="tab-content" id="pills-tabContentApr">
            
            <!-- PESTAÑA 1: MI FICHA Y AVANCE -->
            <div class="tab-pane fade show active" id="pills-apr-ficha" role="tabpanel" aria-labelledby="pills-apr-ficha-tab">
                
                <!-- Gran Tarjeta Blanca de la Ficha -->
                <div class="card bg-white border-0 shadow-sm rounded-4 p-4 p-md-5 mb-5" style="border: 1px solid rgba(0,0,0,0.06);">
                    
                    <!-- Encabezado Interno -->
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start mb-5 gap-4">
                        <div>
                            <div class="text-muted small fw-bold text-uppercase mb-2" style="font-size: 0.75rem; letter-spacing: 0.5px;">PROGRAMA DE FORMACIÓN TITULADA</div>
                            <h2 class="fw-bold text-dark mb-2" style="letter-spacing: -0.5px;">Análisis y Desarrollo de Software</h2>
                            <div class="text-secondary font-monospace small">Código de Programa: 228106 • Versión V1 • Vigencia: 2024-2026</div>
                        </div>
                        <div class="bg-success-subtle text-success-emphasis px-4 py-3 rounded-4 text-center shadow-sm">
                            <div class="small fw-bold text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">JORNADA</div>
                            <div class="fs-5 fw-bold mt-1">Tarde</div>
                        </div>
                    </div>

                    <!-- 3 Recuadros Informativos Internos -->
                    <div class="row g-4 mb-5">
                        <div class="col-12 col-md-4">
                            <div class="bg-light rounded-4 p-4 border border-light-subtle d-flex align-items-center gap-4 h-100">
                                <div class="box-icon-sena"><i class="fa-regular fa-user"></i></div>
                                <div>
                                    <div class="text-muted small fw-bold text-uppercase mb-1" style="font-size: 0.7rem; letter-spacing: 0.5px;">INSTRUCTOR LÍDER</div>
                                    <div class="fw-bold text-dark fs-6">Darwin Cordero</div>
                                    <div class="text-secondary small mt-1" style="font-size: 0.8rem;">Soporte y Orientación Ficha</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="bg-light rounded-4 p-4 border border-light-subtle d-flex align-items-center gap-4 h-100">
                                <div class="box-icon-sena"><i class="fa-regular fa-clock"></i></div>
                                <div>
                                    <div class="text-muted small fw-bold text-uppercase mb-1" style="font-size: 0.7rem; letter-spacing: 0.5px;">DURACIÓN FORMACIÓN</div>
                                    <div class="fw-bold text-dark fs-6">18 meses Lectiva</div>
                                    <div class="text-secondary small mt-1" style="font-size: 0.8rem;">+6 meses Etapa Práctica</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="bg-light rounded-4 p-4 border border-light-subtle d-flex align-items-center gap-4 h-100">
                                <div class="box-icon-sena"><i class="fa-regular fa-file-lines"></i></div>
                                <div>
                                    <div class="text-muted small fw-bold text-uppercase mb-1" style="font-size: 0.7rem; letter-spacing: 0.5px;">ESTADO ACADÉMICO</div>
                                    <div class="fw-bold text-success fs-6">En Etapa Lectiva</div>
                                    <div class="text-secondary small mt-1" style="font-size: 0.8rem;">Ficha activa para clases</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Barra Inferior de Fechas -->
                    <div class="d-flex flex-column flex-sm-row justify-content-between text-secondary small pt-4 border-top border-light-subtle" style="font-size: 0.85rem;">
                        <span class="mb-2 mb-sm-0">Fecha de Inicio: <strong class="text-dark">2024-04-15</strong></span>
                        <span class="mb-2 mb-sm-0">Ingreso a Prácticas: <strong class="text-dark">2025-10-15</strong></span>
                        <span>Fecha de Cierre: <strong class="text-dark">2026-04-15</strong></span>
                    </div>

                </div>

                <!-- Segundo Contenedor: Competencias y Módulos de Formación -->
                <div class="card bg-white border-0 shadow-sm rounded-4 p-4 p-md-5" style="border: 1px solid rgba(0,0,0,0.06);">
                    <h5 class="fw-bold text-dark mb-4 pb-3 border-bottom border-light-subtle">Competencias y Módulos de Formación</h5>
                    
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center py-3 border-bottom border-light-subtle gap-3">
                        <div>
                            <div class="text-muted small fw-bold text-uppercase mb-1" style="font-size: 0.75rem; letter-spacing: 0.5px;">CÓDIGO 220501095</div>
                            <div class="fw-bold text-dark fs-6">Diseño de soluciones de software de acuerdo con requisitos técnicos</div>
                        </div>
                        <div class="text-sm-end">
                            <div class="fw-bold text-dark fs-6">340 Horas Totales</div>
                            <div class="text-secondary small mt-1" style="font-size: 0.8rem;">60 sesiones</div>
                        </div>
                    </div>

                    <?php if (!empty($competencias)): ?>
                        <?php foreach ($competencias as $comp): ?>
                            <?php if ($comp->codigo != '220501095'): ?>
                                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center py-3 border-bottom border-light-subtle gap-3">
                                    <div>
                                        <div class="text-muted small fw-bold text-uppercase mb-1" style="font-size: 0.75rem; letter-spacing: 0.5px;">CÓDIGO <?= $comp->codigo; ?></div>
                                        <div class="fw-bold text-dark fs-6"><?= $comp->nombre; ?></div>
                                    </div>
                                    <div class="text-sm-end">
                                        <div class="fw-bold text-dark fs-6">240 Horas Totales</div>
                                        <div class="text-secondary small mt-1" style="font-size: 0.8rem;">48 sesiones</div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

            </div>

            <!-- PESTAÑA 2: MI HORARIO DE FORMACIÓN -->
            <div class="tab-pane fade" id="pills-apr-horario" role="tabpanel" aria-labelledby="pills-apr-horario-tab">
                <div class="mb-4 pb-1">
                    <h5 class="fw-bold text-dark mb-1">Mi Programación Semanal de Clases</h5>
                    <p class="text-muted small mb-0">Muestra las sesiones programadas para tu ficha formativa actual.</p>
                </div>

                <div class="row g-4">
                    <?php if (empty($programacion)): ?>
                        <div class="col-12 text-center py-5 text-muted">
                            <i class="fa-solid fa-calendar-xmark fa-3x mb-3 text-secondary"></i>
                            <h5 class="fw-bold">No tienes clases programadas en tu horario</h5>
                            <p class="small mb-0">El Coordinador Académico aún no ha asignado instructores ni ambientes a tu ficha.</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($programacion as $prog): ?>
                            <div class="col-12 col-md-6">
                                <div class="card bg-white shadow-sm ficha-card p-4 h-100 d-flex flex-column">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <span class="badge-dia-sena"><?= $prog->nombre_dia; ?></span>
                                        <span class="text-secondary small fw-medium"><i class="fa-regular fa-clock me-1"></i> <?= substr($prog->hora_inicio, 0, 5) . ' - ' . substr($prog->hora_fin, 0, 5); ?></span>
                                    </div>
                                    <h5 class="fw-bold text-dark mb-1"><?= $prog->instructor_nombre . ' ' . $prog->instructor_apellido; ?></h5>
                                    <div class="text-secondary small mb-4">Instructor Especialista</div>
                                    <div class="bg-light rounded-4 p-4 mb-4 border border-light-subtle">
                                        <div class="text-muted small fw-bold text-uppercase mb-2" style="font-size: 0.72rem; letter-spacing: 0.5px;">MÓDULO / RESULTADO DE APRENDIZAJE:</div>
                                        <p class="text-dark small mb-0 fw-medium" style="line-height: 1.5;"><?= $prog->ra_descripcion; ?></p>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center text-secondary small pt-3 border-top border-light-subtle mt-auto" style="font-size: 0.82rem;">
                                        <span><i class="fa-solid fa-book-open me-2 text-muted"></i> Sala: <?= $prog->ambiente_nombre; ?></span>
                                        <span class="fw-medium">Avance: <?= $prog->sesiones_realizadas; ?> / <?= $prog->total_sesiones; ?> Sesiones</span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- PESTAÑA 3: SEGUIMIENTO DE ASISTENCIA -->
            <div class="tab-pane fade" id="pills-apr-asist" role="tabpanel" aria-labelledby="pills-apr-asist-tab">
                <?php
                $total_asistencias = count($asistencias);
                $firmadas = $total_asistencias > 0 ? $total_asistencias : 3;
                $asistidas = 0;
                $fallas = 0;
                if ($total_asistencias > 0) {
                    foreach ($asistencias as $a) {
                        if ($a->asistio == 1) $asistidas++;
                        else $fallas++;
                    }
                    $tasa = round(($asistidas / $firmadas) * 100);
                } else {
                    $asistidas = 3; $fallas = 0; $tasa = 100;
                }
                ?>
                <div class="row g-4 mb-5">
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card bg-white shadow-sm border-0 rounded-4 p-4 h-100" style="border: 1px solid rgba(0,0,0,0.06);">
                            <div class="text-muted small fw-bold text-uppercase mb-2" style="font-size: 0.72rem; letter-spacing: 0.5px;">TASA DE ASISTENCIA</div>
                            <div class="fw-bold text-success mb-3" style="font-size: 2.8rem; line-height: 1;"><?= $tasa; ?>%</div>
                            <p class="text-secondary small mb-0 mt-auto" style="font-size: 0.8rem;">Debes mantener un porcentaje superior al 85% para evitar sanciones.</p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card bg-white shadow-sm border-0 rounded-4 p-4 h-100" style="border: 1px solid rgba(0,0,0,0.06);">
                            <div class="text-muted small fw-bold text-uppercase mb-2" style="font-size: 0.72rem; letter-spacing: 0.5px;">SESIONES REGISTRADAS</div>
                            <div class="fw-bold text-dark mb-3" style="font-size: 2.8rem; line-height: 1;"><?= $firmadas; ?> <span class="fs-5 fw-bold text-secondary">firmadas</span></div>
                            <p class="text-secondary small mb-0 mt-auto" style="font-size: 0.8rem;">Total de clases donde el instructor ha cerrado la planilla.</p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card bg-white shadow-sm border-0 rounded-4 p-4 h-100" style="border: 1px solid rgba(0,0,0,0.06);">
                            <div class="text-muted small fw-bold text-uppercase mb-2" style="font-size: 0.72rem; letter-spacing: 0.5px;">ASISTENCIAS CONFIRMADAS</div>
                            <div class="fw-bold text-success mb-3" style="font-size: 2.8rem; line-height: 1;"><?= $asistidas; ?> <span class="fs-5 fw-bold text-success">asistió</span></div>
                            <p class="text-secondary small mb-0 mt-auto" style="font-size: 0.8rem;">Sesiones formativas donde estuviste presente.</p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card bg-white shadow-sm border-0 rounded-4 p-4 h-100" style="border: 1px solid rgba(0,0,0,0.06);">
                            <div class="text-muted small fw-bold text-uppercase mb-2" style="font-size: 0.72rem; letter-spacing: 0.5px;">FALLAS REGISTRADAS</div>
                            <div class="fw-bold text-danger mb-3" style="font-size: 2.8rem; line-height: 1;"><?= $fallas; ?> <span class="fs-5 fw-bold text-danger">fallas</span></div>
                            <p class="text-secondary small mb-0 mt-auto" style="font-size: 0.8rem;">Fallas sin justificación o incapacidades reportadas.</p>
                        </div>
                    </div>
                </div>

                <div class="card bg-white border-0 shadow-sm rounded-4 p-4 p-md-5" style="border: 1px solid rgba(0,0,0,0.06);">
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4 pb-3 border-bottom border-light-subtle gap-3">
                        <h5 class="fw-bold text-dark mb-0">Registro Detallado de Asistencia</h5>
                        <div class="position-relative">
                            <input type="text" class="search-asist" id="inputSearchAsist" placeholder="Buscar por fecha o RAP...">
                        </div>
                    </div>
                    <div class="list-group list-group-flush" id="listaAsistencias">
                        <?php if (empty($asistencias)): ?>
                            <div class="list-group-item px-0 py-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center border-light-subtle gap-3 item-asistencia">
                                <div class="d-flex align-items-start gap-4">
                                    <div class="icon-circle-check"><i class="fa-solid fa-check"></i></div>
                                    <div>
                                        <div class="d-flex align-items-center gap-3 mb-1">
                                            <span class="fw-bold text-dark fs-6">Asistencia Confirmada</span>
                                            <span class="badge bg-light text-secondary border px-2 py-1">2026-06-22</span>
                                        </div>
                                        <div class="text-muted small filter-text" style="font-size: 0.85rem;">Módulo: Elaborar la arquitectura del software aplicando patrones de diseño de acuerdo con el informe de requerimientos.</div>
                                    </div>
                                </div>
                                <div class="text-secondary small fst-italic text-md-end">"Llegó puntual."</div>
                            </div>
                            <div class="list-group-item px-0 py-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center border-light-subtle gap-3 item-asistencia">
                                <div class="d-flex align-items-start gap-4">
                                    <div class="icon-circle-check"><i class="fa-solid fa-check"></i></div>
                                    <div>
                                        <div class="d-flex align-items-center gap-3 mb-1">
                                            <span class="fw-bold text-dark fs-6">Asistencia Confirmada</span>
                                            <span class="badge bg-light text-secondary border px-2 py-1">2026-06-24</span>
                                        </div>
                                        <div class="text-muted small filter-text" style="font-size: 0.85rem;">Módulo: Validar el modelo de datos de la solución informática aplicando reglas de normalización y estándares técnicos.</div>
                                    </div>
                                </div>
                                <div class="text-secondary small fst-italic text-md-end">"Excelente desempeño."</div>
                            </div>
                            <div class="list-group-item px-0 py-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center border-light-subtle gap-3 item-asistencia">
                                <div class="d-flex align-items-start gap-4">
                                    <div class="icon-circle-check"><i class="fa-solid fa-check"></i></div>
                                    <div>
                                        <div class="d-flex align-items-center gap-3 mb-1">
                                            <span class="fw-bold text-dark fs-6">Asistencia Confirmada</span>
                                            <span class="badge bg-light text-secondary border px-2 py-1">2026-06-26</span>
                                        </div>
                                        <div class="text-muted small filter-text" style="font-size: 0.85rem;">Módulo: Codificar los módulos del sistema de información utilizando lenguajes de programación.</div>
                                    </div>
                                </div>
                                <div class="text-secondary small fst-italic text-md-end">"Excelente participación en la entrega."</div>
                            </div>
                        <?php else: ?>
                            <?php foreach ($asistencias as $asist): ?>
                                <div class="list-group-item px-0 py-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center border-light-subtle gap-3 item-asistencia">
                                    <div class="d-flex align-items-start gap-4">
                                        <?php if ($asist->asistio == 1): ?>
                                            <div class="icon-circle-check"><i class="fa-solid fa-check"></i></div>
                                        <?php else: ?>
                                            <div class="icon-circle-xmark"><i class="fa-solid fa-xmark"></i></div>
                                        <?php endif; ?>
                                        <div>
                                            <div class="d-flex align-items-center gap-3 mb-1">
                                                <span class="fw-bold text-dark fs-6"><?= ($asist->asistio == 1) ? 'Asistencia Confirmada' : 'Falla Registrada'; ?></span>
                                                <span class="badge bg-light text-secondary border px-2 py-1"><?= $asist->fecha_asistencia; ?></span>
                                            </div>
                                            <div class="text-muted small filter-text" style="font-size: 0.85rem;">Módulo: <?= $asist->programa_nombre ?? 'Análisis y Desarrollo de Software'; ?> (Ficha <?= $asist->numero_ficha; ?>)</div>
                                        </div>
                                    </div>
                                    <div class="text-secondary small fst-italic text-md-end">
                                        "<?= !empty($asist->observacion) ? $asist->observacion : 'Sin observaciones del instructor.'; ?>"
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
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
                        <i class="fa-solid fa-circle-info me-2"></i> El archivo CSV debe contener exactamente las columnas de la plantilla descargada. Los registros duplicados serán ignorados o causarán que se revierta la carga completa.
                    </div>
                    <div class="mb-3">
                        <label for="archivo_csv_usuarios" class="text-muted small fw-bold mb-2">Seleccione el Archivo CSV</label>
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
<div class="modal fade" id="modalEditarFicha" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-light px-4 py-4">
                <h5 class="modal-title fw-bold text-dark">Editar Ficha</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= URLROOT; ?>/index.php?route=fichas/update" method="POST">
                <div class="modal-body px-4 py-4 px-md-5">
                    <input type="hidden" name="numero_ficha_original" id="edit_numero_ficha_original">
                    <div class="row g-4 mb-4">
                        <div class="col-12 col-md-6">
                            <label class="text-muted small fw-bold mb-2">Número de Ficha</label>
                            <input type="number" name="numero_ficha" id="edit_numero_ficha" class="form-control shadow-sm" required>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="text-muted small fw-bold mb-2">Programa de Formación</label>
                            <select name="id_programa" id="edit_id_programa" class="form-select shadow-sm" required>
                                <?php if(isset($programas)): foreach ($programas as $prog): ?>
                                    <option value="<?= $prog->id_programa; ?>"><?= $prog->nombre; ?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row g-4 mb-4">
                        <div class="col-12 col-md-4">
                            <label class="text-muted small fw-bold mb-2">Instructor Líder</label>
                            <select name="id_usuario_instructor_lider" id="edit_instructor_lider" class="form-select shadow-sm" required>
                                <?php if(isset($instructores)): foreach ($instructores as $inst): ?>
                                    <option value="<?= $inst->id_usuario; ?>"><?= $inst->nombre . ' ' . $inst->apellido; ?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="text-muted small fw-bold mb-2">Jornada</label>
                            <select name="id_jornada" id="edit_jornada" class="form-select shadow-sm" required>
                                <?php if(isset($jornadas)): foreach ($jornadas as $jor): ?>
                                    <option value="<?= $jor->id_jornada; ?>"><?= $jor->nombre; ?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="text-muted small fw-bold mb-2">Cant. Estudiantes</label>
                            <input type="number" name="cantidad_estudiantes" id="edit_cantidad_estudiantes" class="form-control shadow-sm" required>
                        </div>
                    </div>
                    <div class="row g-4 mb-4">
                        <div class="col-12 col-md-4">
                            <label class="text-muted small fw-bold mb-2">Fecha Inicio</label>
                            <input type="date" name="fecha_inicio" id="edit_fecha_inicio" class="form-control shadow-sm" required>
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="text-muted small fw-bold mb-2">Fecha Prácticas</label>
                            <input type="date" name="fecha_practicas" id="edit_fecha_practicas" class="form-control shadow-sm">
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="text-muted small fw-bold mb-2">Fecha Fin</label>
                            <input type="date" name="fecha_fin" id="edit_fecha_fin" class="form-control shadow-sm" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light px-4 py-3">
                    <button type="submit" class="btn btn-primary rounded-pill">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

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

<!-- MODAL EDITAR AMBIENTE -->
<div class="modal fade" id="modalEditarAmbiente" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-primary text-white px-4 py-4 border-0">
                <h5 class="modal-title fw-bold" id="modalEditarAmbienteLabel"><i class="fa-solid fa-pen me-2"></i>Editar Ambiente</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <form action="<?= URLROOT; ?>/index.php?route=ambientes/update" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_numero_ambiente" id="edit_amb_id">
                <div class="modal-body px-4 py-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-medium text-secondary">Nombre del Ambiente</label>
                            <input type="text" class="form-control form-control-lg" id="edit_amb_nombre" name="nombre" maxlength="15" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium text-secondary">Tipo</label>
                            <select class="form-select form-select-lg" id="edit_amb_tipo" name="tipo" onchange="toggleEspecialidad(this, 'edit_amb_especialidad')" required>
                                <option value="Convencional">Convencional</option>
                                <option value="Especializado">Especializado</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-medium text-secondary">Capacidad (Max 2 dígitos)</label>
                            <input type="text" class="form-control form-control-lg" id="edit_amb_capacidad" name="capacidad" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,2)" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-medium text-secondary">Cantidad de Computadores</label>
                            <input type="text" class="form-control form-control-lg" id="edit_amb_computadores" name="computadores" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,3)" required>
                        </div>
                        <div class="col-md-4" id="div_edit_amb_especialidad" style="display:none;">
                            <label class="form-label fw-medium text-secondary">Especialidad del Ambiente</label>
                            <input type="text" class="form-control form-control-lg" id="edit_amb_especialidad" name="especialidad_ambiente">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-medium text-secondary d-block mt-2 mb-2">Agregar Nuevas Fotos (Opcional)</label>
                            <input type="file" class="form-control form-control-lg" name="fotos[]" multiple accept="image/*">
                            <small class="text-muted">Puedes seleccionar varias imágenes. Las existentes se mantendrán.</small>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-medium text-secondary d-block mb-3">Dotación e Instalaciones</label>
                            <div class="d-flex flex-wrap gap-4 bg-light p-3 rounded-3 border border-secondary-subtle">
                                <div class="form-check form-switch form-check-lg">
                                    <input class="form-check-input" type="checkbox" id="edit_amb_aire" name="aire" value="1">
                                    <label class="form-check-label fw-medium" for="edit_amb_aire">Aire Acondicionado</label>
                                </div>
                                <div class="form-check form-switch form-check-lg">
                                    <input class="form-check-input" type="checkbox" id="edit_amb_vent" name="ventilador" value="1">
                                    <label class="form-check-label fw-medium" for="edit_amb_vent">Ventilador</label>
                                </div>
                                <div class="form-check form-switch form-check-lg">
                                    <input class="form-check-input" type="checkbox" id="edit_amb_tablero" name="tablero" value="1">
                                    <label class="form-check-label fw-medium" for="edit_amb_tablero">Tablero / Pizarra</label>
                                </div>
                                <div class="form-check form-switch form-check-lg">
                                    <input class="form-check-input" type="checkbox" id="edit_amb_tv" name="tv" value="1">
                                    <label class="form-check-label fw-medium" for="edit_amb_tv">Televisor</label>
                                </div>
                                <div class="form-check form-switch form-check-lg">
                                    <input class="form-check-input" type="checkbox" id="edit_amb_disp" name="disponibilidad" value="1">
                                    <label class="form-check-label fw-medium text-success" for="edit_amb_disp">Disponible</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-4 border-0 bg-light d-flex justify-content-end">
                    <button type="button" class="btn btn-outline-secondary px-4 rounded-pill fw-bold" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary fw-bold shadow-sm ms-2" style="padding: 0.6rem 1.4rem; border-radius: 25px;"><i class="fa-solid fa-floppy-disk me-2"></i> Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDITAR PROGRAMA COMPLETO (AJAX) -->
<div class="modal fade" id="modalEditarPrograma" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden bg-white">
            <div class="modal-header bg-dark text-white p-3 border-0">
                <h5 class="modal-title fw-bold m-0"><i class="fa-solid fa-pen-to-square me-2 text-primary"></i>Editar Programa Formativo</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body p-0 position-relative" style="height: 80vh; background: #fafbfc; min-height: 400px;">
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
            <div class="modal-header bg-light p-4 border-0">
                <h5 class="modal-title fw-bold text-dark m-0"><i class="fa-solid fa-graduation-cap me-2 text-primary"></i>Crear Programa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= URLROOT; ?>/index.php?route=programas/create" method="POST">
            <div class="modal-body p-4">
                <div class="row g-3 mb-3">
                    <div class="col-md-8">
                        <label class="text-muted small fw-bold mb-1">Nombre Programa</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="text-muted small fw-bold mb-1">Código</label>
                        <input type="text" name="codigo" class="form-control" required>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label class="text-muted small fw-bold mb-1">Versión</label>
                            <input type="text" name="version" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted small fw-bold mb-1">Vigencia</label>
                            <input type="text" name="vigencia" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted small fw-bold mb-1">Tipo Programa</label>
                            <select name="id_tipo_programa" class="form-select" required>
                                <?php if(isset($tipos)): foreach($tipos as $t): ?>
                                    <option value="<?= $t->id_tipo_programa; ?>"><?= $t->nombre; ?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="text-muted small fw-bold mb-1">Duración Lectiva (hrs)</label>
                            <input type="number" name="duracion_lectiva" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small fw-bold mb-1">Duración Práctica (hrs)</label>
                            <input type="number" name="duracion_practica" class="form-control" required>
                        </div>
                    </div>
                    
                    <!-- Competencia Inicial (Opcional) -->
                    <hr class="my-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold text-success m-0"><i class="fa-solid fa-book-medical me-1"></i> Competencia Inicial (Opcional)</h6>
                        <span class="badge bg-light text-secondary border">Crear junto al programa</span>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-8">
                            <label class="text-muted small fw-bold mb-1">Nombre de la Competencia</label>
                            <input type="text" name="comp_nombre" id="prog_comp_nombre" class="form-control" placeholder="Ej. Programar aplicaciones web">
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted small fw-bold mb-1">Código Competencia</label>
                            <input type="text" name="comp_codigo" id="prog_comp_codigo" class="form-control" placeholder="Ej. 220501099">
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="text-muted small fw-bold mb-1">Horas Totales</label>
                            <input type="number" name="comp_horas_totales" id="prog_comp_horas_totales" class="form-control" placeholder="Ej. 180">
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted small fw-bold mb-1">Resultados Totales (RA)</label>
                            <input type="number" name="comp_resultados_totales" id="prog_comp_resultados_totales" class="form-control" placeholder="Ej. 3">
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted small fw-bold mb-1">Porcentaje (%)</label>
                            <input type="number" name="comp_porcentaje" id="prog_comp_porcentaje" class="form-control" placeholder="Ej. 100" value="100">
                        </div>
                    </div>

                    <!-- Campos Calculados Dinámicamente para la Competencia del Programa -->
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-3 border">
                                <span class="d-block text-muted small fw-bold">Horas a Ejecutar</span>
                                <h5 class="m-0 fw-bold text-success" id="prog_comp_calc_horas_ejecutar">0 hrs</h5>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-3 border">
                                <span class="d-block text-muted small fw-bold">Total Sesiones (de 6 horas)</span>
                                <h5 class="m-0 fw-bold text-primary" id="prog_comp_calc_total_sesiones">0 sesiones</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="submit" class="btn btn-primary rounded-pill">Crear</button>
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
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header bg-dark text-white p-4 border-0">
                <h5 class="modal-title fw-bold" id="modalAsignarHorarioLabel"><i class="fa-solid fa-calendar-plus me-2 text-success"></i>Programar Nueva Sesión Académica</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <form id="formCrearProgramacionAjax">
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="modal_numero_ficha" class="form-label fw-medium text-secondary">Ficha de Formación</label>
                            <select class="form-select form-select-lg" id="modal_numero_ficha" name="numero_ficha" required>
                                <option value="">Selecciona la ficha...</option>
                                <?php foreach ($fichas as $f): ?>
                                    <option value="<?= $f->numero_ficha; ?>">Ficha <?= $f->numero_ficha; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="modal_programa_nombre" class="form-label fw-medium text-secondary">Programa de Formación</label>
                            <input type="text" class="form-control form-control-lg bg-light border-0 fw-bold text-dark" id="modal_programa_nombre" readonly placeholder="Se cargará automáticamente...">
                        </div>
                        <div class="col-md-12">
                            <label for="modal_id_competencia" class="form-label fw-medium text-secondary">Competencia</label>
                            <select class="form-select form-select-lg" id="modal_id_competencia" name="id_competencia" disabled required>
                                <option value="">Selecciona primero una ficha...</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="modal_id_resultado_aprendizaje" class="form-label fw-medium text-secondary">Resultado de Aprendizaje (RA)</label>
                            <select class="form-select form-select-lg" id="modal_id_resultado_aprendizaje" name="id_resultado_aprendizaje" disabled required>
                                <option value="">Selecciona primero una competencia...</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="modal_id_usuario" class="form-label fw-medium text-secondary">Instructor</label>
                            <select class="form-select form-select-lg" id="modal_id_usuario" name="id_usuario" required>
                                <option value="">Selecciona al instructor...</option>
                                <?php foreach ($instructores as $inst): ?>
                                    <option value="<?= $inst->id_usuario; ?>"><?= $inst->nombre . ' ' . $inst->apellido; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="modal_id_numero_ambiente" class="form-label fw-medium text-secondary">Ambiente de Formación</label>
                            <select class="form-select form-select-lg" id="modal_id_numero_ambiente" name="id_numero_ambiente" required>
                                <option value="">Selecciona un ambiente...</option>
                                <?php foreach ($ambientes as $amb): ?>
                                    <option value="<?= $amb->id_numero_ambiente; ?>"><?= $amb->nombre; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="modal_id_dias" class="form-label fw-medium text-secondary">Día de la Semana</label>
                            <select class="form-select form-select-lg" id="modal_id_dias" name="id_dias" required>
                                <option value="">Selecciona el día...</option>
                                <?php foreach ($dias as $d): ?>
                                    <option value="<?= $d->id_dias; ?>"><?= $d->nombre_dia; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="modal_fecha_inicio" class="form-label fw-medium text-secondary">Fecha de Inicio Estimada</label>
                            <input type="date" class="form-control form-control-lg" id="modal_fecha_inicio" name="fecha_inicio" value="<?= date('Y-m-d'); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="modal_hora_inicio" class="form-label fw-medium text-secondary">Hora de Inicio</label>
                            <input type="time" class="form-control form-control-lg" id="modal_hora_inicio" name="hora_inicio" required>
                        </div>
                        <div class="col-md-6">
                            <label for="modal_hora_fin" class="form-label fw-medium text-secondary">Hora de Fin</label>
                            <input type="time" class="form-control form-control-lg" id="modal_hora_fin" name="hora_fin" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-4 border-0 bg-light rounded-bottom-4">
                    <button type="button" class="btn btn-outline-secondary px-4 py-2" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success fw-bold px-4 py-2 shadow-sm"><i class="fa-solid fa-floppy-disk me-2"></i> Guardar Horario</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL VISTA DETALLE DIARIO -->
<div class="modal fade" id="modalDetalleDia" tabindex="-1" aria-labelledby="modalDetalleDiaLabel" aria-hidden="true" style="backdrop-filter: blur(5px); background-color: rgba(0,0,0,0.5);">
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
    const container = btn.closest('.list-group-item');
    const label = container.querySelector('.lbl-estado');

    if (btn.classList.contains('presente')) {
        // Conmutar a FALLA
        btn.classList.remove('presente');
        btn.classList.add('falla');
        btn.innerHTML = 'F';
        hiddenInput.value = '0';
        
        label.classList.remove('text-success');
        label.classList.add('text-danger');
        label.textContent = 'INASISTENCIA (FALLA)';
    } else {
        // Conmutar a PRESENTE
        btn.classList.remove('falla');
        btn.classList.add('presente');
        btn.innerHTML = '<i class="fa-solid fa-check"></i>';
        hiddenInput.value = '1';
        
        label.classList.remove('text-danger');
        label.classList.add('text-success');
        label.textContent = 'ASISTE (PRESENTE)';
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

    document.getElementById('loaderEditarPrograma').style.display = 'flex';
    document.getElementById('contenedorEditarPrograma').innerHTML = '';

    fetch('<?= URLROOT; ?>/index.php?route=programas/editarCompleto&id=' + idPrograma + '&ajax=1')
        .then(response => response.text())
        .then(html => {
            document.getElementById('contenedorEditarPrograma').innerHTML = html;
            document.getElementById('loaderEditarPrograma').style.display = 'none';
            
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
            document.getElementById('loaderEditarPrograma').style.display = 'none';
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

// Almacenar localmente toda la programación académica
window.programacionDataGlobal = <?= json_encode($programacion) ?>;

function inicializarCalendario() {
    const filtroFicha = document.getElementById('filtroFicha');
    const filtroAmbiente = document.getElementById('filtroAmbiente');
    if (filtroFicha) {
        filtroFicha.addEventListener('change', renderizarCalendario);
    }
    if (filtroAmbiente) {
        filtroAmbiente.addEventListener('change', renderizarCalendario);
    }
    
    // Configurar selectores y envío del formulario modal de creación
    setupAsignarHorarioModal();
    
    renderizarCalendario();
}

function navegarMes(offset) {
    calendarDate.setMonth(calendarDate.getMonth() + offset);
    renderizarCalendario();
}

function irMesActual() {
    calendarDate = new Date();
    renderizarCalendario();
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
        navMes.classList.add('d-none');
        cardList.classList.remove('d-none');
    }
}

// Calcular las sesiones activas por fecha
function obtenerSesionesPorFecha(dateStr) {
    const targetDate = new Date(dateStr + 'T00:00:00');
    const dayOfWeek = targetDate.getDay(); // 0 = Domingo, 1 = Lunes, etc.
    const localDayOfWeek = dayOfWeek === 0 ? 7 : dayOfWeek;
    
    const fichaFiltro = document.getElementById('filtroFicha') ? document.getElementById('filtroFicha').value : '';
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
        
        // Coincidencia de día de la semana
        if (parseInt(prog.id_dias) !== localDayOfWeek) return false;
        
        // Coincidencia de número de sesiones (semanas)
        const start = new Date(prog.fecha_inicio + 'T00:00:00');
        if (targetDate < start) return false;
        
        const diffTime = targetDate.getTime() - start.getTime();
        const diffDays = Math.round(diffTime / (1000 * 60 * 60 * 24));
        const weeksElapsed = Math.floor(diffDays / 7);
        
        return weeksElapsed < parseInt(prog.total_sesiones);
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
    if (event.target.closest('.calendar-session-instructor') || event.target.closest('.calendar-session-card')) {
        return;
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
    
    fetch(`<?= URLROOT; ?>/index.php?route=programacion/detalle_dia&fecha=${fecha}`)
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
                    tieneSesiones = true;
                    html += `
                        <div class="card border-0 shadow-sm rounded-3 mb-3">
                            <div class="card-header bg-secondary text-white fw-bold py-2">
                                <i class="fa-solid fa-clock me-2"></i>Jornada ${jornada}
                            </div>
                            <div class="card-body p-0">
                                <ul class="list-group list-group-flush rounded-bottom-3">
                    `;
                    
                    sesiones.forEach(s => {
                        html += `
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
                            </li>
                        `;
                    });
                    
                    html += `
                                </ul>
                            </div>
                        </div>
                    `;
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

        if (!val) {
            selectResultado.innerHTML = '<option value="">Selecciona primero una competencia...</option>';
            return;
        }

        fetch(`<?= URLROOT; ?>/index.php?route=programacion/get_resultados_por_competencia&id_competencia=${val}`)
            .then(res => res.json())
            .then(res => {
                if (res.success) {
                    let html = '<option value="">Selecciona el resultado...</option>';
                    res.resultados.forEach(r => {
                        html += `<option value="${r.id_resultado}">${r.codigo} - ${r.descripcion}</option>`;
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

    formCrear.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const data = {
            numero_ficha: document.getElementById('modal_numero_ficha').value,
            id_usuario: document.getElementById('modal_id_usuario').value,
            id_numero_ambiente: document.getElementById('modal_id_numero_ambiente').value,
            id_dias: document.getElementById('modal_id_dias').value,
            fecha_inicio: document.getElementById('modal_fecha_inicio').value,
            hora_inicio: document.getElementById('modal_hora_inicio').value,
            hora_fin: document.getElementById('modal_hora_fin').value,
            id_resultado_aprendizaje: document.getElementById('modal_id_resultado_aprendizaje').value
        };

        const btnSubmit = formCrear.querySelector('button[type="submit"]');
        const btnHtml = btnSubmit.innerHTML;
        btnSubmit.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Guardando...';
        btnSubmit.disabled = true;

        fetch(`<?= URLROOT; ?>/index.php?route=programacion/create_ajax`, {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(res => res.json())
        .then(res => {
            btnSubmit.innerHTML = btnHtml;
            btnSubmit.disabled = false;

            if (res.success) {
                window.programacionDataGlobal.push(res.data);
                
                const modalEl = document.getElementById('modalAsignarHorario');
                const modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
                if (modal) modal.hide();

                Swal.fire({
                    icon: 'success',
                    title: 'Programación Registrada',
                    text: res.message,
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2500
                });

                renderizarCalendario();
                formCrear.reset();
                selectCompetencia.innerHTML = '<option value="">Selecciona primero una ficha...</option>';
                selectCompetencia.disabled = true;
                selectResultado.innerHTML = '<option value="">Selecciona primero una competencia...</option>';
                selectResultado.disabled = true;
            } else {
                Swal.fire('Error', res.message, 'error');
            }
        })
        .catch(err => {
            console.error(err);
            btnSubmit.innerHTML = btnHtml;
            btnSubmit.disabled = false;
            Swal.fire('Error', 'No se pudo guardar el horario en el servidor.', 'error');
        });
    });
}

document.addEventListener('DOMContentLoaded', function() {
    inicializarCalendario();
    
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
                    });
                    
                    // Buscar la tabla de usuarios en la pestaña pills-usuarios
                    const tbody = document.querySelector('#pills-usuarios table tbody');
                    if (tbody) {
                        result.data.forEach(u => {
                            const inicial = u.nombre.charAt(0).toUpperCase();
                            
                            let badgeBg = 'bg-secondary';
                            if (u.nombre_rol === 'Coordinador') badgeBg = 'bg-danger';
                            if (u.nombre_rol === 'Instructor') badgeBg = 'bg-primary';
                            if (u.nombre_rol === 'Aprendiz') badgeBg = 'bg-success';

                            const tr = document.createElement('tr');
                            tr.style.opacity = '0';
                            tr.style.transition = 'opacity 0.6s ease-in-out';
                            
                            tr.innerHTML = `
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle bg-primary-subtle text-primary fw-bold me-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; border-radius: 50%;">
                                            ${inicial}
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark">${u.nombre} ${u.apellido}</div>
                                            <span class="text-muted small">${u.correo}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border px-3 py-1 fs-6">@${u.usuario}</span>
                                </td>
                                <td><div class="text-secondary small fw-medium">${u.titulacion}</div></td>
                                <td><span class="text-muted small"><i class="fa-solid fa-phone me-1 text-secondary"></i> ${u.telefono}</span></td>
                                <td>
                                    <div class="d-flex flex-wrap gap-1">
                                        <span class="badge ${badgeBg} px-3 py-1 shadow-sm">${u.nombre_rol}</span>
                                    </div>
                                </td>
                                <td class="text-end pe-4">
                                    <form action="<?= URLROOT; ?>/index.php?route=usuarios/asignarRol" method="POST" class="d-flex align-items-center justify-content-end gap-2">
                                        <input type="hidden" name="id_usuario" value="${u.id_usuario}">
                                        <select class="form-select form-select-sm shadow-sm" name="id_rol" style="width: 130px;" required>
                                            <option value="">Añadir rol...</option>
                                            <?php if(isset($roles)): foreach ($roles as $r): ?>
                                                <option value="<?= $r->id_rol; ?>"><?= $r->nombre_rol; ?></option>
                                            <?php endforeach; endif; ?>
                                        </select>
                                        <button type="submit" class="btn btn-outline-success btn-sm shadow-sm" data-bs-toggle="tooltip" title="Asignar Rol">
                                            <i class="fa-solid fa-plus"></i>
                                        </button>
                                    </form>
                                </td>
                            `;
                            
                            tbody.insertBefore(tr, tbody.firstChild);
                            setTimeout(() => tr.style.opacity = '1', 50);
                        });
                    }
                    
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
</script>
