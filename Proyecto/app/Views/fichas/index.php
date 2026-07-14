<?php
/**
 * Vista index.php (Fichas Académicas)
 * Renderiza la gestión general de Fichas con diseño moderno del SENA,
 * estadísticas en vivo, filtros combinados, buscador, y vista de tarjetas o tabla.
 */
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$current_role = $current_role ?? $_SESSION['current_role'] ?? 'Aprendiz';

// Obtener la cantidad de aprendices matriculados reales agrupados por ficha
$db = Database::getInstance();
$db->query("SELECT numero_ficha, COUNT(*) as total FROM ficha_aprendiz GROUP BY numero_ficha");
$matriculados_counts = [];
foreach ($db->resultSet() as $r) {
    $matriculados_counts[$r->numero_ficha] = (int) $r->total;
}
?>

<style>
    :root {
        --sena-primary: #39A900;
        --sena-primary-hover: #2e8800;
        --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
        --card-shadow-hover: 0 10px 30px rgba(0, 0, 0, 0.06);
        --border-radius-lg: 24px;
        --border-radius-md: 16px;
    }

    .fichas-container {
        font-family: 'Inter', sans-serif;
        background-color: #fafbfc;
        padding-bottom: 3rem;
    }

    /* Encabezado */
    .fichas-header {
        background: #ffffff;
        border-radius: 24px;
        box-shadow: 0 16px 45px rgba(15, 23, 42, 0.06);
        padding: 1.7rem 2.1rem;
        margin-bottom: 2rem;
        border: 1px solid rgba(15, 23, 42, 0.08);
        display: grid;
        grid-template-columns: auto minmax(0, 1fr) 1px auto;
        align-items: center;
        gap: 1.6rem;
    }
    .fichas-header-icon {
        width: 82px;
        height: 82px;
        border-radius: 50%;
        background: linear-gradient(145deg, #eef9f1 0%, #dff2e6 100%);
        color: #118a3b;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 2.35rem;
        flex: 0 0 auto;
    }
    .fichas-header h1 {
        font-size: clamp(1.35rem, 2vw, 1.85rem);
        font-weight: 800;
        color: #111827;
        letter-spacing: 0;
        margin-bottom: 0.55rem;
    }
    .fichas-header p {
        color: #6b7280;
        font-size: 0.98rem;
        line-height: 1.45;
        max-width: 760px;
    }
    .fichas-header-divider {
        width: 1px;
        height: 86px;
        background: #a8d8b6;
    }
    .btn-sena-success {
        background-color: var(--sena-primary);
        color: #ffffff;
        font-weight: 600;
        border: none;
        border-radius: 30px;
        padding: 0.6rem 1.5rem;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(57, 169, 0, 0.15);
    }
    .btn-sena-success:hover {
        background-color: var(--sena-primary-hover);
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(57, 169, 0, 0.25);
    }
    .fichas-hero-btn {
        min-width: 205px;
        justify-content: center;
        border-radius: 999px;
        padding: 0.85rem 1.25rem;
        background: #0f8f2f;
        box-shadow: 0 10px 22px rgba(15, 143, 47, 0.2);
        font-size: 0.95rem;
        font-weight: 800;
    }
    .fichas-hero-btn:hover {
        background: #087329;
    }
    .fichas-header-plus {
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

    @media (max-width: 1199.98px) {
        .fichas-header {
            grid-template-columns: auto minmax(0, 1fr);
        }
        .fichas-header-divider {
            display: none;
        }
        .fichas-hero-btn {
            grid-column: 1 / -1;
            width: 100%;
        }
    }

    @media (max-width: 767.98px) {
        .fichas-header {
            grid-template-columns: 1fr;
            padding: 1.4rem;
        }
        .fichas-header-icon {
            width: 70px;
            height: 70px;
            font-size: 2rem;
        }
    }

    /* Tarjetas de Estadísticas (Pixel Perfect) */
    .stat-card {
        background: #ffffff;
        border-radius: var(--border-radius-lg);
        box-shadow: var(--card-shadow);
        padding: 1.75rem;
        border: 1px solid rgba(0, 0, 0, 0.03);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        min-height: 142px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--card-shadow-hover);
    }
    .stat-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.5rem;
    }
    .stat-title {
        font-size: 0.72rem;
        font-weight: 700;
        color: #9ca3af;
        letter-spacing: 0.8px;
        text-transform: uppercase;
    }
    .stat-icon {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
    }
    .stat-icon-green { background-color: #e6f6df; color: #39A900; }
    .stat-icon-blue { background-color: #e0f2fe; color: #0284c7; }
    .stat-icon-purple { background-color: #f3e8ff; color: #7c3aed; }
    .stat-icon-orange { background-color: #ffedd5; color: #ea580c; }
    
    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: #111827;
        line-height: 1;
        margin-bottom: 0.25rem;
    }
    .stat-subtext {
        font-size: 0.78rem;
        color: #9ca3af;
    }

    /* Barra de herramientas / Filtros (Pixel Perfect Capsule) */
    .toolbar-container {
        background-color: #ffffff;
        border-radius: 30px;
        box-shadow: var(--card-shadow);
        border: 1px solid #cbd5e1;
        padding: 0.35rem 1rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: nowrap;
        gap: 0.6rem;
        overflow-x: auto;
    }
    .search-box {
        position: relative;
        flex-grow: 1;
        max-width: 200px;
        min-width: 140px;
        flex-shrink: 0;
    }
    .search-box i {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        font-size: 0.75rem;
    }
    .search-box input {
        width: 100%;
        border-radius: 20px;
        border: 1px solid #e2e8f0;
        padding: 0.35rem 0.8rem 0.35rem 2.2rem;
        font-size: 0.78rem;
        outline: none;
        transition: all 0.2s ease;
        background-color: #f8fafc;
    }
    .search-box input:focus {
        border-color: #94a3b8;
        background-color: #ffffff;
    }

    /* Grupo de Filtros Combinables */
    .filters-group {
        display: flex;
        align-items: center;
        gap: 0.45rem;
        flex-wrap: nowrap;
        flex-shrink: 0;
    }
    .custom-inline-select-wrapper {
        display: flex;
        align-items: center;
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        padding: 0.3rem 0.75rem;
        font-size: 0.76rem;
        font-weight: 500;
        color: #64748b;
        transition: all 0.15s ease;
        flex-shrink: 0;
    }
    .custom-inline-select-wrapper:hover {
        border-color: #cbd5e1;
    }
    .custom-inline-select-wrapper span {
        color: #94a3b8;
        font-size: 0.65rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        margin-right: 0.15rem;
    }
    .custom-inline-select-wrapper select {
        border: none;
        background: transparent;
        font-weight: 700;
        color: #334155;
        outline: none;
        cursor: pointer;
        appearance: none;
        -webkit-appearance: none;
        padding-right: 0.15rem;
        max-width: 105px;
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
        font-size: 0.76rem;
    }
    .custom-inline-select-wrapper select::-ms-expand {
        display: none;
    }
    .custom-inline-select-wrapper i {
        font-size: 0.62rem;
        color: #94a3b8;
        pointer-events: none;
    }

    /* Switcher de Vista */
    .view-switcher-wrapper {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 0.65rem;
        font-weight: 700;
        color: #94a3b8;
        letter-spacing: 0.5px;
        flex-shrink: 0;
    }
    .view-switcher-capsule {
        display: flex;
        background-color: #f1f5f9;
        padding: 2px;
        border-radius: 30px;
        border: 1px solid #e2e8f0;
    }
    .view-btn {
        border: none;
        background: transparent;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #64748b;
        transition: all 0.2s ease;
        cursor: pointer;
        padding: 0;
    }
    .view-btn svg {
        width: 12px;
        height: 12px;
    }
    .view-btn.active {
        background-color: #ffffff;
        color: var(--sena-primary);
        box-shadow: 0 2px 6px rgba(0,0,0,0.06);
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

    /* Tarjetas de Ficha */
    .ficha-card {
        background-color: #ffffff;
        border-radius: var(--border-radius-md);
        box-shadow: var(--card-shadow);
        border: 1px solid rgba(0,0,0,0.03);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        overflow: hidden;
        height: 100%;
        display: flex;
        flex-direction: column;
        border-top: 4px solid var(--sena-primary);
    }
    .ficha-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--card-shadow-hover);
    }
    .ficha-card.border-pendiente { border-top-color: #3f51b5; }
    .ficha-card.border-productiva { border-top-color: #b58100; }
    .ficha-card.border-finalizada { border-top-color: #6c757d; }
    .ficha-card.border-cancelada { border-top-color: #e53e3e; }

    .ficha-card-body {
        padding: 1.5rem;
        flex-grow: 1;
    }
    .ficha-card-num-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.8rem;
    }
    .ficha-card-number {
        font-size: 1.15rem;
        font-weight: 700;
        color: #1f2937;
    }
    .ficha-card-number span {
        color: #9ca3af;
        font-weight: 500;
        font-size: 0.68rem;
    }
    .ficha-card-title {
        font-size: 1.05rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 0.15rem;
        line-height: 1.25;
        min-height: 2.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .ficha-card-meta {
        font-size: 0.82rem;
        color: #6b7280;
        margin-bottom: 1.2rem;
    }
    
    /* Pequeño panel de Instructor Líder dentro de la tarjeta */
    .ficha-instructor-panel {
        background-color: #f9fafb;
        border-radius: 12px;
        padding: 0.65rem 0.9rem;
        margin-bottom: 1.2rem;
        display: flex;
        align-items: center;
        gap: 0.6rem;
        border: 1px solid #f3f4f6;
    }
    .avatar-initials {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background-color: #ede7f6;
        color: #6200ea;
        font-weight: 700;
        font-size: 0.8rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .instructor-info-text {
        line-height: 1.1;
    }
    .instructor-label {
        font-size: 0.65rem;
        font-weight: 700;
        color: #9ca3af;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }
    .instructor-name {
        font-size: 0.85rem;
        font-weight: 700;
        color: #374151;
    }

    /* Grid de Jornada y Alumnos */
    .ficha-info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.75rem;
        margin-bottom: 1.2rem;
    }
    .info-grid-item {
        background-color: #fcfdfe;
        border: 1px solid #f3f4f6;
        border-radius: 8px;
        padding: 0.5rem 0.75rem;
    }
    .info-grid-label {
        font-size: 0.65rem;
        font-weight: 700;
        color: #9ca3af;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        margin-bottom: 0.1rem;
    }
    .info-grid-val {
        font-size: 0.85rem;
        font-weight: 700;
        color: #1f2937;
    }

    /* Barra de progreso de Vigencia */
    .vigencia-progress-section {
        margin-bottom: 0.8rem;
    }
    .vigencia-label-row {
        display: flex;
        justify-content: space-between;
        font-size: 0.75rem;
        font-weight: 600;
        color: #4b5563;
        margin-bottom: 0.35rem;
    }
    .vigencia-progress-bar {
        height: 6px;
        background-color: #f3f4f6;
        border-radius: 4px;
        overflow: hidden;
    }
    .vigencia-progress-fill {
        height: 100%;
        background-color: var(--sena-primary);
        border-radius: 4px;
    }
    .vigencia-dates {
        display: flex;
        justify-content: space-between;
        font-size: 0.72rem;
        color: #9ca3af;
    }

    /* Footer de la Tarjeta */
    .ficha-card-footer {
        background-color: #ffffff;
        border-top: 1px solid #f3f4f6;
        padding: 0.9rem 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .view-details-link {
        font-size: 0.82rem;
        font-weight: 700;
        color: var(--sena-primary);
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.3rem;
        transition: color 0.15s ease;
    }
    .view-details-link:hover {
        color: var(--sena-primary-hover);
    }
    .actions-btn-group {
        display: flex;
        gap: 0.3rem;
    }
    .action-icon-btn {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        border: none;
        background: transparent;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.85rem;
        transition: all 0.15s ease;
        cursor: pointer;
    }
    .action-icon-btn:hover {
        background-color: #f3f4f6;
    }
    .action-icon-btn.btn-enroll:hover { background-color: #e6f6df; color: var(--sena-primary); }
    .action-icon-btn.btn-edit:hover { background-color: #eff6ff; color: #2563eb; }
    .action-icon-btn.btn-delete:hover { background-color: #fef2f2; color: #dc2626; }

    /* Tabla Estilizada */
    .fichas-table-card {
        background: #ffffff;
        border-radius: var(--border-radius-lg);
        box-shadow: var(--card-shadow);
        border: 1px solid rgba(0,0,0,0.04);
        overflow: hidden;
    }
    .table-fichas-custom th {
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        color: #6b7280;
        padding: 1.1rem 1rem;
        background-color: #f9fafb;
        border-bottom: 1px solid #f3f4f6;
    }
    .table-fichas-custom td {
        padding: 1rem 1rem;
        border-bottom: 1px solid #f3f4f6;
        vertical-align: middle;
        font-size: 0.88rem;
    }
    .table-fichas-custom tr:last-child td {
        border-bottom: none;
    }
    .table-ficha-number {
        font-weight: 700;
        color: var(--sena-primary);
        text-decoration: none;
    }
    .table-ficha-number:hover {
        text-decoration: underline;
    }
</style>

<div class="fichas-container container-fluid px-0">
    <!-- Encabezado -->
    <div class="fichas-header">
        <div class="fichas-header-icon" aria-hidden="true">
            <i class="fa-solid fa-users"></i>
        </div>
        <div class="fichas-header-copy">
            <h1>Gestión de Fichas Académicas</h1>
            <p class="mb-0">Visualiza, edita y registra las fichas de aprendices matriculados.</p>
        </div>
        <div class="fichas-header-divider" aria-hidden="true"></div>
        <?php if ($current_role === 'Coordinador'): ?>
            <button type="button" class="btn-sena-success fichas-hero-btn" data-bs-toggle="modal" data-bs-target="#modalCrearFicha">
                <span class="fichas-header-plus"><i class="fa-solid fa-plus"></i></span>
                <span>Matricular Ficha</span>
            </button>
        <?php endif; ?>
    </div>

    <!-- Panel de Estadísticas (Actualización dinámica vía JS) -->
    <div class="row g-4 mb-4">
        <!-- Fichas Registradas -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-card-header">
                    <span class="stat-title">Fichas Registradas</span>
                    <div class="stat-icon stat-icon-green"><i class="fa-solid fa-layer-group"></i></div>
                </div>
                <div>
                    <div class="stat-value" id="stat-fichas-count">0</div>
                    <div class="stat-subtext" id="stat-fichas-subtext">0 filtradas</div>
                </div>
            </div>
        </div>
        <!-- Aprendices Matriculados -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-card-header">
                    <span class="stat-title">Aprendices Matriculados</span>
                    <div class="stat-icon stat-icon-blue"><i class="fa-solid fa-user-group"></i></div>
                </div>
                <div>
                    <div class="stat-value" id="stat-aprendices-count">0</div>
                    <div class="stat-subtext" id="stat-aprendices-subtext">Promedio de 0 por ficha</div>
                </div>
            </div>
        </div>
        <!-- En Etapa Lectiva -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-card-header">
                    <span class="stat-title">En Etapa Lectiva</span>
                    <div class="stat-icon stat-icon-purple"><i class="fa-solid fa-circle-check"></i></div>
                </div>
                <div>
                    <div class="stat-value" id="stat-lectiva-count">0</div>
                    <div class="stat-subtext">Ejecutando currículo activo</div>
                </div>
            </div>
        </div>
        <!-- Por Iniciar -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-card-header">
                    <span class="stat-title">Por Iniciar</span>
                    <div class="stat-icon stat-icon-orange"><i class="fa-solid fa-clock"></i></div>
                </div>
                <div>
                    <div class="stat-value" id="stat-iniciar-count">0</div>
                    <div class="stat-subtext">Fichas matriculadas a futuro</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Barra de Herramientas (Buscador y Filtros Combinables) -->
    <div class="toolbar-container">
        <!-- Buscador -->
        <div class="search-box">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="search" id="fichas-search" placeholder="Buscar número o programa...">
        </div>

        <!-- Filtros Combinados -->
        <div class="filters-group">
            <!-- Filtro Jornada -->
            <div class="custom-inline-select-wrapper">
                <span>JORNADA:</span>
                <select id="filter-jornada">
                    <option value="">Todas</option>
                    <option value="Mañana">Mañana</option>
                    <option value="Tarde">Tarde</option>
                    <option value="Nocturna">Nocturna</option>
                </select>
                <i class="fa-solid fa-chevron-down"></i>
            </div>
            
            <!-- Filtro Instructor -->
            <div class="custom-inline-select-wrapper">
                <span>INSTRUCTOR:</span>
                <select id="filter-instructor">
                    <option value="">Todos</option>
                    <?php foreach ($instructores as $inst): ?>
                        <option value="<?= htmlspecialchars($inst->nombre . ' ' . $inst->apellido); ?>"><?= htmlspecialchars($inst->nombre . ' ' . $inst->apellido); ?></option>
                    <?php endforeach; ?>
                </select>
                <i class="fa-solid fa-chevron-down"></i>
            </div>

            <!-- Filtro Programa -->
            <div class="custom-inline-select-wrapper">
                <span>PROGRAMA:</span>
                <select id="filter-programa">
                    <option value="">Todos</option>
                    <?php foreach ($programas as $p): ?>
                        <option value="<?= htmlspecialchars($p->nombre); ?>"><?= htmlspecialchars($p->nombre); ?></option>
                    <?php endforeach; ?>
                </select>
                <i class="fa-solid fa-chevron-down"></i>
            </div>


        </div>

        <!-- Selector de Vista -->
        <div class="view-switcher-wrapper">
            <span>VISTA:</span>
            <div class="view-switcher-capsule">
                <button type="button" class="view-btn active" id="btn-view-cards" title="Vista de Tarjetas">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-grid-fill" viewBox="0 0 16 16">
                        <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5zm8 0A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5zm-8 8A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5zm8 0A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5z"/>
                    </svg>
                </button>
                <button type="button" class="view-btn" id="btn-view-table" title="Vista de Tabla">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-list-task" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M2 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5V3a.5.5 0 0 0-.5-.5zm1.5 1H10.5a.5.5 0 0 0 0-1H3.5a.5.5 0 0 0 0 1M2 7.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5V8a.5.5 0 0 0-.5-.5zm1.5 1H10.5a.5.5 0 0 0 0-1H3.5a.5.5 0 0 0 0 1M2 12.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm1.5 1H10.5a.5.5 0 0 0 0-1H3.5a.5.5 0 0 0 0 1"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Contenido General de Fichas (Vacío por defecto si no hay elementos) -->
    <div id="no-results-msg" class="p-5 text-center text-muted bg-white shadow-sm rounded-4 border d-none">
        <i class="fa-solid fa-users-slash fa-3x mb-3 text-secondary"></i>
        <h5 class="fw-bold">No se encontraron fichas</h5>
        <p class="small mb-0">Intenta modificando los criterios del buscador o de los filtros.</p>
    </div>

    <!-- SECCIÓN VISTA DE TARJETAS -->
    <div class="row g-4" id="view-cards-container">
        <?php foreach ($fichas as $f): 
            $matriculados = $matriculados_counts[$f->numero_ficha] ?? 0;
            
            // Determinar estado de la ficha
            $hoy = date('Y-m-d');
            $estado = 'Lectiva';
            $estado_class = 'status-lectiva';
            $border_class = '';
            
            if ($f->fecha_fin === '1970-01-01') {
                $estado = 'Cancelada';
                $estado_class = 'status-cancelada';
                $border_class = 'border-cancelada';
            } elseif ($hoy < $f->fecha_inicio) {
                $estado = 'Pendiente';
                $estado_class = 'status-pendiente';
                $border_class = 'border-pendiente';
            } elseif ($hoy >= $f->fecha_inicio && $hoy < $f->fecha_practicas) {
                $estado = 'Lectiva';
                $estado_class = 'status-lectiva';
                $border_class = '';
            } elseif ($hoy >= $f->fecha_practicas && $hoy <= $f->fecha_fin) {
                $estado = 'Productiva';
                $estado_class = 'status-productiva';
                $border_class = 'border-productiva';
            } else {
                $estado = 'Finalizada';
                $estado_class = 'status-finalizada';
                $border_class = 'border-finalizada';
            }

            // Barra de progreso de Vigencia Lectiva
            $porcentaje_vigencia = 0;
            if ($hoy >= $f->fecha_inicio) {
                $total_dias = (strtotime($f->fecha_practicas) - strtotime($f->fecha_inicio)) / (60 * 60 * 24);
                if ($total_dias > 0) {
                    $dias_transcurridos = (strtotime($hoy) - strtotime($f->fecha_inicio)) / (60 * 60 * 24);
                    $porcentaje_vigencia = min(100, max(0, round(($dias_transcurridos / $total_dias) * 100)));
                } else {
                    $porcentaje_vigencia = 100;
                }
            }
            
            // Buscar si es Técnico o Tecnólogo
            $tipo_programa = (stripos($f->programa_nombre, 'Técnico') !== false) ? 'Técnico' : 'Tecnólogo';
        ?>
            <div class="col-12 col-md-6 col-lg-4 card-item"
                 data-numero="<?= $f->numero_ficha; ?>"
                 data-programa="<?= htmlspecialchars($f->programa_nombre); ?>"
                 data-jornada="<?= htmlspecialchars($f->jornada_nombre); ?>"
                 data-instructor="<?= htmlspecialchars($f->instructor_nombre . ' ' . $f->instructor_apellido); ?>"
                 data-estado="<?= $estado; ?>"
                 data-matriculados="<?= $matriculados; ?>">
                 
                <div class="ficha-card <?= $border_class; ?>">
                    <div class="ficha-card-body">
                        <!-- Cabecera -->
                        <div class="ficha-card-num-row">
                            <div class="ficha-card-number"><span>NÚMERO DE FICHA</span> <br>#<?= $f->numero_ficha; ?></div>
                        </div>

                        <!-- Título del Programa -->
                        <div class="ficha-card-title"><?= htmlspecialchars($f->programa_nombre); ?></div>
                        <div class="ficha-card-meta">Cód: <?= $f->id_programa; ?> • <?= $tipo_programa; ?></div>

                        <!-- Instructor Líder -->
                        <div class="ficha-instructor-panel">
                            <div class="avatar-initials"><?= substr($f->instructor_nombre, 0, 1) . substr($f->instructor_apellido, 0, 1); ?></div>
                            <div class="instructor-info-text">
                                <div class="instructor-label">Instructor Líder</div>
                                <div class="instructor-name"><?= htmlspecialchars($f->instructor_nombre . ' ' . $f->instructor_apellido); ?></div>
                            </div>
                        </div>

                        <!-- Info Grid (Jornada y Alumnos) -->
                        <div class="ficha-info-grid">
                            <div class="info-grid-item">
                                <div class="info-grid-label">Jornada</div>
                                <div class="info-grid-val"><?= htmlspecialchars($f->jornada_nombre); ?></div>
                            </div>
                            <div class="info-grid-item">
                                <div class="info-grid-label">Aprendices</div>
                                <div class="info-grid-val"><?= $matriculados; ?> de <?= $f->cantidad_estudiantes; ?></div>
                            </div>
                        </div>

                        <!-- Progreso Vigencia Lectiva -->
                        <div class="vigencia-progress-section">
                            <div class="vigencia-label-row">
                                <span>Vigencia Lectiva</span>
                                <span><?= $porcentaje_vigencia; ?>% completado</span>
                            </div>
                            <div class="vigencia-progress-bar">
                                <div class="vigencia-progress-fill" style="width: <?= $porcentaje_vigencia; ?>%;"></div>
                            </div>
                        </div>

                        <!-- Fechas -->
                        <div class="vigencia-dates">
                            <span>Inició: <?= $f->fecha_inicio; ?></span>
                            <span>Finaliza: <?= $f->fecha_fin; ?></span>
                        </div>
                    </div>

                    <!-- Footer / Acciones -->
                    <div class="ficha-card-footer">
                        <a href="<?= URLROOT; ?>/index.php?route=fichas/show&id=<?= $f->numero_ficha; ?>" class="view-details-link">
                            <i class="fa-regular fa-eye"></i> Ver Ficha Completa
                        </a>
                        
                        <?php if ($current_role === 'Coordinador'): ?>
                            <div class="actions-btn-group">
                                <button type="button" class="action-icon-btn btn-enroll btn-gestionar-aprendices" 
                                        data-ficha="<?= $f->numero_ficha; ?>" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#modalGestionarAprendices" 
                                        title="Matricular Aprendiz">
                                    <i class="fa-solid fa-user-plus text-success"></i>
                                </button>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- SECCIÓN VISTA DE TABLA -->
    <div class="fichas-table-card d-none" id="view-table-container">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 table-fichas-custom">
                <thead>
                    <tr>
                        <th class="ps-4">FICHA</th>
                        <th>PROGRAMA FORMATIVO</th>
                        <th>INSTRUCTOR LÍDER</th>
                        <th>JORNADA</th>
                        <th>CUPOS</th>
                        <th>VIGENCIA LECTIVA</th>
                        <th class="text-end pe-4">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($fichas as $f): 
                        $matriculados = $matriculados_counts[$f->numero_ficha] ?? 0;
                        
                        $hoy = date('Y-m-d');
                        $estado = 'Lectiva';
                        $estado_class = 'status-lectiva';
                        
                        if ($f->fecha_fin === '1970-01-01') {
                            $estado = 'Cancelada';
                            $estado_class = 'status-cancelada';
                        } elseif ($hoy < $f->fecha_inicio) {
                            $estado = 'Pendiente';
                            $estado_class = 'status-pendiente';
                        } elseif ($hoy >= $f->fecha_inicio && $hoy < $f->fecha_practicas) {
                            $estado = 'Lectiva';
                            $estado_class = 'status-lectiva';
                        } elseif ($hoy >= $f->fecha_practicas && $hoy <= $f->fecha_fin) {
                            $estado = 'Productiva';
                            $estado_class = 'status-productiva';
                        } else {
                            $estado = 'Finalizada';
                            $estado_class = 'status-finalizada';
                        }
                    ?>
                        <tr class="table-row-item" 
                            data-numero="<?= $f->numero_ficha; ?>"
                            data-programa="<?= htmlspecialchars($f->programa_nombre); ?>"
                            data-jornada="<?= htmlspecialchars($f->jornada_nombre); ?>"
                            data-instructor="<?= htmlspecialchars($f->instructor_nombre . ' ' . $f->instructor_apellido); ?>"
                            data-estado="<?= $estado; ?>"
                            data-matriculados="<?= $matriculados; ?>">
                            
                            <td class="ps-4 fw-bold">
                                <a href="<?= URLROOT; ?>/index.php?route=fichas/show&id=<?= $f->numero_ficha; ?>" class="table-ficha-number">
                                    #<?= $f->numero_ficha; ?>
                                </a>
                            </td>
                            <td>
                                <div class="fw-bold text-dark"><?= htmlspecialchars($f->programa_nombre); ?></div>
                                <div class="text-muted small">Cód: <?= $f->id_programa; ?></div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar-initials" style="width:28px; height:28px; font-size:0.75rem;">
                                        <?= substr($f->instructor_nombre, 0, 1) . substr($f->instructor_apellido, 0, 1); ?>
                                    </div>
                                    <div>
                                        <div class="fw-semibold text-dark" style="font-size:0.85rem;"><?= htmlspecialchars($f->instructor_nombre . ' ' . $f->instructor_apellido); ?></div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge bg-light text-dark border px-3 py-2" style="font-size:0.75rem; border-radius:12px;"><?= htmlspecialchars($f->jornada_nombre); ?></span></td>
                            <td class="fw-bold"><?= $matriculados; ?>/<?= $f->cantidad_estudiantes; ?></td>
                            <td class="text-muted small" style="line-height: 1.25;">
                                <i class="fa-solid fa-calendar-day text-secondary me-1"></i> <?= $f->fecha_inicio; ?><br>
                                <i class="fa-solid fa-flag-checkered text-secondary me-1"></i> <?= $f->fecha_fin; ?>
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-1">
                                    <a href="<?= URLROOT; ?>/index.php?route=fichas/show&id=<?= $f->numero_ficha; ?>" class="action-icon-btn" title="Ver Ficha">
                                        <i class="fa-regular fa-eye text-success"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ==============================================
     MODALES (Definidos aquí de forma única)
     ============================================== -->

<?php if ($current_role === 'Coordinador'): ?>
<style>
    .ficha-create-dialog {
        max-width: 920px;
    }

    .ficha-create-content {
        border: 0;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 26px 70px rgba(15, 23, 42, 0.28);
    }

    .ficha-create-header {
        background: linear-gradient(135deg, #046b31 0%, #0b8e43 62%, #119b4d 100%);
        color: #ffffff;
        border: 0;
        min-height: 112px;
        padding: 1.45rem 1.9rem;
    }

    .ficha-create-header-icon {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background: #e3f7ea;
        color: #0b8e43;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.85rem;
        flex: 0 0 auto;
    }

    .ficha-create-title {
        font-size: 1.55rem;
        font-weight: 800;
        line-height: 1.15;
        letter-spacing: 0;
    }

    .ficha-create-subtitle {
        color: rgba(255, 255, 255, 0.86);
        font-size: 0.96rem;
        margin-top: 0.25rem;
    }

    .ficha-create-close {
        filter: invert(1) grayscale(100%) brightness(2);
        opacity: 0.95;
        box-shadow: none;
    }

    .ficha-create-body {
        padding: 1.75rem 1.9rem 1.55rem;
        background: #ffffff;
    }

    .ficha-create-grid {
        row-gap: 1.55rem;
    }

    .ficha-create-label {
        color: #374151;
        font-size: 0.92rem;
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 0.58rem;
        margin-bottom: 0.68rem;
    }

    .ficha-create-label i {
        color: #0b8e43;
        font-size: 1rem;
    }

    .ficha-create-input,
    .ficha-create-select {
        min-height: 54px;
        border: 1px solid #d8dee8;
        border-radius: 9px;
        color: #111827;
        font-size: 1rem;
        box-shadow: none;
        padding: 0.74rem 0.95rem;
    }

    .ficha-create-input::placeholder {
        color: #9ca3af;
    }

    .ficha-create-input:focus,
    .ficha-create-select:focus {
        border-color: #0b8e43;
        box-shadow: 0 0 0 3px rgba(11, 142, 67, 0.12);
    }

    .ficha-create-footer {
        background: #ffffff;
        border-top: 1px solid #e5e7eb;
        padding: 1.2rem 1.9rem;
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
    }

    .ficha-create-cancel,
    .ficha-create-save {
        min-width: 150px;
        min-height: 46px;
        border-radius: 999px;
        font-weight: 800;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.55rem;
    }

    .ficha-create-cancel {
        color: #4b5563;
        border: 1px solid #aeb7c4;
        background: #ffffff;
    }

    .ficha-create-cancel:hover {
        border-color: #6b7280;
        background: #f9fafb;
        color: #111827;
    }

    .ficha-create-save {
        border: 0;
        background: #0b8e43;
        color: #ffffff;
        box-shadow: 0 10px 22px rgba(11, 142, 67, 0.22);
    }

    .ficha-create-save:hover {
        background: #087638;
        color: #ffffff;
    }

    @media (max-width: 767.98px) {
        .ficha-create-dialog {
            margin: 0.75rem;
        }

        .ficha-create-body {
            padding: 1.2rem;
        }

        .ficha-create-footer {
            flex-direction: column-reverse;
            padding: 1rem 1.2rem;
        }

        .ficha-create-cancel,
        .ficha-create-save {
            width: 100%;
        }
    }
</style>

<!-- Modal Crear Ficha -->
<div class="modal fade" id="modalCrearFicha" tabindex="-1" aria-labelledby="modalCrearFichaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered ficha-create-dialog">
        <div class="modal-content ficha-create-content">
            <div class="modal-header ficha-create-header">
                <div class="d-flex align-items-center gap-3">
                    <span class="ficha-create-header-icon" aria-hidden="true">
                        <i class="fa-regular fa-calendar-plus"></i>
                    </span>
                    <div>
                        <h5 class="modal-title ficha-create-title" id="modalCrearFichaLabel">Registrar Nueva Ficha</h5>
                        <div class="ficha-create-subtitle">Crea una nueva ficha académica para los aprendices.</div>
                    </div>
                </div>
                <button type="button" class="btn-close ficha-create-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <form action="<?= URLROOT; ?>/index.php?route=fichas/create" method="POST" id="form-crear-ficha">
                <div class="modal-body ficha-create-body">
                    <div class="row ficha-create-grid">
                        <div class="col-md-6">
                            <label for="numero_ficha" class="ficha-create-label">
                                <i class="fa-regular fa-file-lines"></i> Número de Ficha
                            </label>
                            <input type="number" class="form-control ficha-create-input" id="numero_ficha" name="numero_ficha" placeholder="Ej. 2670003" required oninput="if(this.value.length > 10) this.value = this.value.slice(0, 10);" min="0">
                        </div>
                        <div class="col-md-6">
                            <label for="cantidad_estudiantes" class="ficha-create-label">
                                <i class="fa-solid fa-user-group"></i> Cupos Autorizados
                            </label>
                            <input type="number" class="form-control ficha-create-input" id="cantidad_estudiantes" name="cantidad_estudiantes" placeholder="Ej. 30" required oninput="if(this.value.length > 2) this.value = this.value.slice(0, 2);" min="0">
                        </div>
                        <div class="col-md-12">
                            <label for="id_programa" class="ficha-create-label">
                                <i class="fa-solid fa-book-open"></i> Programa de Formación
                            </label>
                            <select class="form-select ficha-create-select" id="id_programa" name="id_programa" required>
                                <option value="">Selecciona un programa...</option>
                                <?php foreach ($programas as $prog): ?>
                                    <option value="<?= $prog->id_programa; ?>" data-tipo="<?= htmlspecialchars($prog->tipo_nombre ?? ''); ?>"><?= htmlspecialchars($prog->nombre) . ' (' . $prog->codigo . ')'; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="id_usuario_instructor_lider" class="ficha-create-label">
                                <i class="fa-solid fa-user-plus"></i> Instructor Líder
                            </label>
                            <select class="form-select ficha-create-select" id="id_usuario_instructor_lider" name="id_usuario_instructor_lider" required>
                                <option value="">Selecciona un instructor...</option>
                                <?php foreach ($instructores as $inst): ?>
                                    <option value="<?= $inst->id_usuario; ?>"><?= htmlspecialchars($inst->nombre . ' ' . $inst->apellido); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="id_jornada" class="ficha-create-label">
                                <i class="fa-regular fa-clock"></i> Jornada
                            </label>
                            <select class="form-select ficha-create-select" id="id_jornada" name="id_jornada" required>
                                <option value="">Selecciona la jornada...</option>
                                <?php foreach ($jornadas as $jor): ?>
                                    <option value="<?= $jor->id_jornada; ?>"><?= htmlspecialchars($jor->nombre); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="fecha_inicio" class="ficha-create-label">
                                <i class="fa-regular fa-calendar-days"></i> Fecha Inicio
                            </label>
                            <input type="date" class="form-control ficha-create-input" id="fecha_inicio" name="fecha_inicio" required>
                        </div>
                        <div class="col-md-4">
                            <label for="fecha_practicas" class="ficha-create-label">
                                <i class="fa-regular fa-calendar"></i> Fecha Prácticas
                            </label>
                            <input type="date" class="form-control ficha-create-input" id="fecha_practicas" name="fecha_practicas" required>
                        </div>
                        <div class="col-md-4">
                            <label for="fecha_fin" class="ficha-create-label">
                                <i class="fa-regular fa-calendar-check"></i> Fecha Fin
                            </label>
                            <input type="date" class="form-control ficha-create-input" id="fecha_fin" name="fecha_fin" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer ficha-create-footer">
                    <button type="button" class="btn ficha-create-cancel" data-bs-dismiss="modal">
                        <i class="fa-regular fa-circle-xmark"></i> Cancelar
                    </button>
                    <button type="submit" class="btn ficha-create-save">
                        <i class="fa-regular fa-floppy-disk"></i> Guardar Ficha
                    </button>
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
            <form action="<?= URLROOT; ?>/index.php?route=fichas/update" method="POST" id="form-editar-ficha">
                <input type="hidden" name="numero_ficha_original" id="edit_numero_ficha_original">
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="edit_numero_ficha" class="form-label fw-semibold text-secondary">Número de Ficha</label>
                            <input type="number" class="form-control form-control-lg rounded-3 bg-light border-0 fw-bold" id="edit_numero_ficha" name="numero_ficha" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="edit_cantidad_estudiantes" class="form-label fw-semibold text-secondary">Cupos Autorizados</label>
                            <input type="number" class="form-control form-control-lg rounded-3" id="edit_cantidad_estudiantes" name="cantidad_estudiantes" required oninput="if(this.value.length > 2) this.value = this.value.slice(0, 2);" min="0">
                        </div>
                        <div class="col-md-12">
                            <label for="edit_id_programa" class="form-label fw-semibold text-secondary">Programa de Formación</label>
                            <select class="form-select form-select-lg rounded-3" id="edit_id_programa" name="id_programa" required>
                                <?php foreach ($programas as $prog): ?>
                                    <option value="<?= $prog->id_programa; ?>" data-tipo="<?= htmlspecialchars($prog->tipo_nombre ?? ''); ?>"><?= htmlspecialchars($prog->nombre) . ' (' . $prog->codigo . ')'; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="edit_instructor_lider" class="form-label fw-semibold text-secondary">Instructor Líder</label>
                            <select class="form-select form-select-lg rounded-3" id="edit_instructor_lider" name="id_usuario_instructor_lider" required>
                                <?php foreach ($instructores as $inst): ?>
                                    <option value="<?= $inst->id_usuario; ?>"><?= htmlspecialchars($inst->nombre . ' ' . $inst->apellido); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="edit_jornada" class="form-label fw-semibold text-secondary">Jornada</label>
                            <select class="form-select form-select-lg rounded-3" id="edit_jornada" name="id_jornada" required>
                                <?php foreach ($jornadas as $jor): ?>
                                    <option value="<?= $jor->id_jornada; ?>"><?= htmlspecialchars($jor->nombre); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="edit_fecha_inicio" class="form-label fw-semibold text-secondary">Fecha Inicio</label>
                            <input type="date" class="form-control form-control-lg rounded-3" id="edit_fecha_inicio" name="fecha_inicio" required>
                        </div>
                        <div class="col-md-4">
                            <label for="edit_fecha_practicas" class="form-label fw-semibold text-secondary">Fecha Prácticas</label>
                            <input type="date" class="form-control form-control-lg rounded-3" id="edit_fecha_practicas" name="fecha_practicas" required>
                        </div>
                        <div class="col-md-4">
                            <label for="edit_fecha_fin" class="form-label fw-semibold text-secondary">Fecha Fin</label>
                            <input type="date" class="form-control form-control-lg rounded-3" id="edit_fecha_fin" name="fecha_fin" required>
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

<!-- Modal Gestionar Aprendices -->
<div class="modal fade" id="modalGestionarAprendices" tabindex="-1" aria-labelledby="modalGestionarAprendicesLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header bg-success text-white p-4 border-0">
                <h5 class="modal-title fw-bold" id="modalGestionarAprendicesLabel">
                    <i class="fa-solid fa-user-graduate me-2"></i> Matricular Aprendiz en Ficha
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body p-0">
                <ul class="nav nav-tabs nav-fill bg-light border-bottom-0" id="gestionarTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active fw-bold py-3 text-secondary border-0" id="individual-tab" data-bs-toggle="tab" data-bs-target="#individual" type="button" role="tab" aria-controls="individual" aria-selected="true">
                            <i class="fa-solid fa-user-plus me-1 text-success"></i> Carga Individual
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-bold py-3 text-secondary border-0" id="masiva-tab" data-bs-toggle="tab" data-bs-target="#masiva" type="button" role="tab" aria-controls="masiva" aria-selected="false">
                            <i class="fa-solid fa-file-csv me-1 text-success"></i> Carga Masiva CSV
                        </button>
                    </li>
                </ul>
                <div class="tab-content p-4" id="gestionarTabsContent">
                    <!-- Tab Individual -->
                    <div class="tab-pane fade show active" id="individual" role="tabpanel" aria-labelledby="individual-tab">
                        <form action="<?= URLROOT; ?>/index.php?route=fichas/inscribirAprendizIndex" method="POST">
                            <input type="hidden" name="numero_ficha" class="input-ficha-id">
                            <div class="mb-3">
                                <label for="id_usuario_aprendiz" class="form-label fw-semibold text-secondary">Seleccionar Aprendiz</label>
                                <select class="form-select form-select-lg rounded-3" id="id_usuario_aprendiz" name="id_usuario_aprendiz" required style="max-height: 250px;">
                                    <option value="">Buscar o seleccionar aprendiz...</option>
                                    <?php if(isset($candidatos)): ?>
                                        <?php foreach ($candidatos as $cand): ?>
                                            <option value="<?= $cand->id_usuario; ?>" class="opcion-aprendiz-candidato"><?= htmlspecialchars($cand->documento . ' - ' . $cand->nombre . ' ' . $cand->apellido); ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-success fw-bold shadow-sm py-2 rounded-3">Matricular Aprendiz</button>
                            </div>
                        </form>
                    </div>
                    <!-- Tab Masiva -->
                    <div class="tab-pane fade" id="masiva" role="tabpanel" aria-labelledby="masiva-tab">
                        <form action="<?= URLROOT; ?>/index.php?route=fichas/inscribirMasivoCSV" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="numero_ficha" class="input-ficha-id">
                            <div class="alert alert-info small rounded-3 border-0" style="background-color:#eff6ff; color:#1e40af;">
                                <i class="fa-solid fa-circle-info me-2 text-primary"></i> El archivo CSV debe contener una única columna donde cada fila sea el <strong>Documento</strong> del aprendiz ya registrado en el sistema.
                            </div>
                            <div class="mb-3">
                                <label for="archivo_csv" class="form-label fw-semibold text-secondary">Subir Archivo CSV</label>
                                <input class="form-control form-control-lg rounded-3" type="file" id="archivo_csv" name="archivo_csv" accept=".csv" required>
                            </div>
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-dark fw-bold shadow-sm py-2 rounded-3"><i class="fa-solid fa-upload me-2"></i> Procesar CSV</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- ==============================================
     MOTOR DE FILTRADO Y ESTADÍSTICAS (JS CLIENT-SIDE)
     ============================================== -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('fichas-search');
    const filterJornada = document.getElementById('filter-jornada');
    const filterInstructor = document.getElementById('filter-instructor');
    const filterPrograma = document.getElementById('filter-programa');
    
    const cardItems = document.querySelectorAll('.card-item');
    const tableRows = document.querySelectorAll('.table-row-item');
    const noResultsMsg = document.getElementById('no-results-msg');
    
    // Vista togglers
    const btnViewCards = document.getElementById('btn-view-cards');
    const btnViewTable = document.getElementById('btn-view-table');
    const viewCardsContainer = document.getElementById('view-cards-container');
    const viewTableContainer = document.getElementById('view-table-container');

    // Cargar la última vista guardada en localStorage
    const activeView = localStorage.getItem('fichas_vista') || 'cards';
    setVista(activeView);

    btnViewCards.addEventListener('click', () => setVista('cards'));
    btnViewTable.addEventListener('click', () => setVista('table'));

    function setVista(vista) {
        localStorage.setItem('fichas_vista', vista);
        if (vista === 'cards') {
            btnViewCards.classList.add('active');
            btnViewTable.classList.remove('active');
            viewCardsContainer.classList.remove('d-none');
            viewTableContainer.classList.add('d-none');
        } else {
            btnViewCards.classList.remove('active');
            btnViewTable.classList.add('active');
            viewCardsContainer.classList.add('d-none');
            viewTableContainer.classList.remove('d-none');
        }
    }

    // Escuchar eventos de filtrado
    searchInput.addEventListener('input', runFilters);
    filterJornada.addEventListener('change', runFilters);
    filterInstructor.addEventListener('change', runFilters);
    filterPrograma.addEventListener('change', runFilters);

    function runFilters() {
        const query = searchInput.value.toLowerCase().trim();
        const jornadaVal = filterJornada.value;
        const instructorVal = filterInstructor.value;
        const programaVal = filterPrograma.value;

        let visibleCount = 0;
        let totalMatriculados = 0;
        let countLectiva = 0;
        let countPendiente = 0;
        let countProductiva = 0;
        let countEgresada = 0;

        const currentCardItems = document.querySelectorAll('.card-item');
        const currentTableRows = document.querySelectorAll('.table-row-item');

        // Filtrar tarjetas
        currentCardItems.forEach(card => {
            const numero = card.getAttribute('data-numero').toLowerCase();
            const programa = card.getAttribute('data-programa').toLowerCase();
            const jornada = card.getAttribute('data-jornada');
            const instructor = card.getAttribute('data-instructor');
            const estado = card.getAttribute('data-estado');
            const matriculados = parseInt(card.getAttribute('data-matriculados')) || 0;

            const matchesSearch = numero.includes(query) || programa.includes(query);
            const matchesJornada = !jornadaVal || jornada === jornadaVal;
            const matchesInstructor = !instructorVal || instructor === instructorVal;
            const matchesPrograma = !programaVal || card.getAttribute('data-programa') === programaVal;

            if (matchesSearch && matchesJornada && matchesInstructor && matchesPrograma) {
                card.classList.remove('d-none');
                visibleCount++;
                totalMatriculados += matriculados;
                
                if (estado === 'Lectiva') countLectiva++;
                else if (estado === 'Pendiente') countPendiente++;
                else if (estado === 'Productiva') countProductiva++;
                else if (estado === 'Finalizada') countEgresada++;
            } else {
                card.classList.add('d-none');
            }
        });

        // Filtrar tabla (manteniendo coherencia)
        currentTableRows.forEach(row => {
            const numero = row.getAttribute('data-numero').toLowerCase();
            const programa = row.getAttribute('data-programa').toLowerCase();
            const jornada = row.getAttribute('data-jornada');
            const instructor = row.getAttribute('data-instructor');
            const estado = row.getAttribute('data-estado');

            const matchesSearch = numero.includes(query) || programa.includes(query);
            const matchesJornada = !jornadaVal || jornada === jornadaVal;
            const matchesInstructor = !instructorVal || instructor === instructorVal;
            const matchesPrograma = !programaVal || row.getAttribute('data-programa') === programaVal;

            if (matchesSearch && matchesJornada && matchesInstructor && matchesPrograma) {
                row.classList.remove('d-none');
            } else {
                row.classList.add('d-none');
            }
        });

        // Mostrar / Ocultar mensaje de no resultados
        if (visibleCount === 0) {
            noResultsMsg.classList.remove('d-none');
            viewCardsContainer.classList.add('d-none');
            viewTableContainer.classList.add('d-none');
        } else {
            noResultsMsg.classList.add('d-none');
            setVista(localStorage.getItem('fichas_vista') || 'cards');
        }

        // Actualizar estadísticas dinámicamente
        document.getElementById('stat-fichas-count').innerText = visibleCount;
        document.getElementById('stat-fichas-subtext').innerText = `${visibleCount} filtradas`;
        
        document.getElementById('stat-aprendices-count').innerText = totalMatriculados;
        const promedio = visibleCount > 0 ? Math.round(totalMatriculados / visibleCount) : 0;
        document.getElementById('stat-aprendices-subtext').innerText = `Promedio de ${promedio} por ficha`;

        document.getElementById('stat-lectiva-count').innerText = countLectiva;
        document.getElementById('stat-iniciar-count').innerText = countPendiente;
    }

    function agregarFichaAlDOM(ficha) {
        const hoy = new Date().toISOString().split('T')[0];
        let estado = 'Lectiva';
        let border_class = '';
        
        if (ficha.fecha_fin === '1970-01-01') {
            estado = 'Cancelada'; border_class = 'border-cancelada';
        } else if (hoy < ficha.fecha_inicio) {
            estado = 'Pendiente'; border_class = 'border-pendiente';
        } else if (hoy >= ficha.fecha_inicio && hoy < ficha.fecha_practicas) {
            estado = 'Lectiva'; border_class = '';
        } else if (hoy >= ficha.fecha_practicas && hoy <= ficha.fecha_fin) {
            estado = 'Productiva'; border_class = 'border-productiva';
        } else {
            estado = 'Finalizada'; border_class = 'border-finalizada';
        }

        let porcentaje_vigencia = 0;
        if (hoy >= ficha.fecha_inicio) {
            const start = new Date(ficha.fecha_inicio).getTime();
            const practicas = new Date(ficha.fecha_practicas).getTime();
            const current = new Date(hoy).getTime();
            
            const total_dias = (practicas - start) / (1000 * 60 * 60 * 24);
            if (total_dias > 0) {
                const dias_transcurridos = (current - start) / (1000 * 60 * 60 * 24);
                porcentaje_vigencia = Math.min(100, Math.max(0, Math.round((dias_transcurridos / total_dias) * 100)));
            } else {
                porcentaje_vigencia = 100;
            }
        }
        
        const tipo_programa = ficha.programa_nombre.toLowerCase().includes('técnico') ? 'Técnico' : 'Tecnólogo';
        const inicialesInstructor = ficha.instructor_nombre.substring(0,1) + ficha.instructor_apellido.substring(0,1);
        const urlFicha = `<?= URLROOT; ?>/index.php?route=fichas/show&id=${ficha.numero_ficha}`;

        const cardHtml = `
            <div class="col-12 col-md-6 col-lg-4 card-item"
                 data-numero="${ficha.numero_ficha}"
                 data-programa="${ficha.programa_nombre}"
                 data-jornada="${ficha.jornada_nombre}"
                 data-instructor="${ficha.instructor_nombre} ${ficha.instructor_apellido}"
                 data-estado="${estado}"
                 data-matriculados="0">
                <div class="ficha-card ${border_class}">
                    <div class="ficha-card-body">
                        <div class="ficha-card-num-row">
                            <div class="ficha-card-number"><span>NÚMERO DE FICHA</span> <br>#${ficha.numero_ficha}</div>
                        </div>
                        <div class="ficha-card-title">${ficha.programa_nombre}</div>
                        <div class="ficha-card-meta">Cód: ${ficha.id_programa} • ${tipo_programa}</div>
                        <div class="ficha-instructor-panel">
                            <div class="avatar-initials">${inicialesInstructor}</div>
                            <div class="instructor-info-text">
                                <div class="instructor-label">Instructor Líder</div>
                                <div class="instructor-name">${ficha.instructor_nombre} ${ficha.instructor_apellido}</div>
                            </div>
                        </div>
                        <div class="ficha-info-grid">
                            <div class="info-grid-item">
                                <div class="info-grid-label">Jornada</div>
                                <div class="info-grid-val">${ficha.jornada_nombre}</div>
                            </div>
                            <div class="info-grid-item">
                                <div class="info-grid-label">Aprendices</div>
                                <div class="info-grid-val">0 de ${ficha.cantidad_estudiantes}</div>
                            </div>
                        </div>
                        <div class="vigencia-progress-section">
                            <div class="vigencia-label-row">
                                <span>Vigencia Lectiva</span>
                                <span>${porcentaje_vigencia}% completado</span>
                            </div>
                            <div class="vigencia-progress-bar">
                                <div class="vigencia-progress-fill" style="width: ${porcentaje_vigencia}%;"></div>
                            </div>
                        </div>
                        <div class="vigencia-dates">
                            <span>Inició: ${ficha.fecha_inicio}</span>
                            <span>Finaliza: ${ficha.fecha_fin}</span>
                        </div>
                    </div>
                    <div class="ficha-card-footer">
                        <a href="${urlFicha}" class="view-details-link">
                            <i class="fa-regular fa-eye"></i> Ver Ficha Completa
                        </a>
                        <div class="actions-btn-group">
                            <button type="button" class="action-icon-btn btn-enroll btn-gestionar-aprendices" 
                                    data-ficha="${ficha.numero_ficha}" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modalGestionarAprendices" 
                                    title="Matricular Aprendiz">
                                <i class="fa-solid fa-user-plus text-success"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>`;
            
        const tableRowHtml = `
            <tr class="table-row-item" 
                data-numero="${ficha.numero_ficha}"
                data-programa="${ficha.programa_nombre}"
                data-jornada="${ficha.jornada_nombre}"
                data-instructor="${ficha.instructor_nombre} ${ficha.instructor_apellido}"
                data-estado="${estado}"
                data-matriculados="0">
                <td class="ps-4 fw-bold">
                    <a href="${urlFicha}" class="table-ficha-number">#${ficha.numero_ficha}</a>
                </td>
                <td>
                    <div class="fw-bold text-dark">${ficha.programa_nombre}</div>
                    <div class="text-muted small">Cód: ${ficha.id_programa}</div>
                </td>
                <td>
                    <div class="d-flex align-items-center gap-2">
                        <div class="avatar-initials" style="width:28px; height:28px; font-size:0.75rem;">
                            ${inicialesInstructor}
                        </div>
                        <div>
                            <div class="fw-semibold text-dark" style="font-size:0.85rem;">${ficha.instructor_nombre} ${ficha.instructor_apellido}</div>
                        </div>
                    </div>
                </td>
                <td><span class="badge bg-light text-dark border px-3 py-2" style="font-size:0.75rem; border-radius:12px;">${ficha.jornada_nombre}</span></td>
                <td class="fw-bold">0/${ficha.cantidad_estudiantes}</td>
                <td class="text-muted small" style="line-height: 1.25;">
                    <i class="fa-solid fa-calendar-day text-secondary me-1"></i> ${ficha.fecha_inicio}<br>
                    <i class="fa-solid fa-flag-checkered text-secondary me-1"></i> ${ficha.fecha_fin}
                </td>
                <td class="text-end pe-4">
                    <div class="d-flex justify-content-end gap-1">
                        <a href="${urlFicha}" class="action-icon-btn" title="Ver Ficha">
                            <i class="fa-regular fa-eye text-success"></i>
                        </a>
                    </div>
                </td>
            </tr>`;

        document.getElementById('view-cards-container').insertAdjacentHTML('beforeend', cardHtml);
        const tbody = document.querySelector('#view-table-container tbody');
        if(tbody) tbody.insertAdjacentHTML('beforeend', tableRowHtml);
    }

    // Carga inicial de estadísticas
    runFilters();

    // Pasar el número de la ficha a los inputs del modal gestionar
    const modalGestionar = document.getElementById('modalGestionarAprendices');
    if (modalGestionar) {
        modalGestionar.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const fichaId = button.getAttribute('data-ficha');
            
            // Actualizar todos los inputs hidden
            const inputs = modalGestionar.querySelectorAll('.input-ficha-id');
            inputs.forEach(input => {
                input.value = fichaId;
            });
        });
    }

    // Escuchar el clic de eliminar y lanzar SweetAlert2
    document.querySelectorAll('.btn-delete-ficha-action').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const url = this.getAttribute('data-url');
            const numFicha = this.getAttribute('data-ficha');

            Swal.fire({
                title: `¿Eliminar Ficha #${numFicha}?`,
                text: "Esta acción no se puede deshacer y fallará si hay aprendices, horarios o registros de asistencia vinculados.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6b7280',
                confirmButtonText: '<i class="fa-solid fa-trash-can me-1"></i> Sí, eliminar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true,
                focusCancel: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        });
    });

    // Validar el formulario de creación asíncronamente
    const formCrearFicha = document.getElementById('form-crear-ficha');
    if (formCrearFicha) {
        formCrearFicha.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const btnSubmit = this.querySelector('button[type="submit"]');
            if (btnSubmit.disabled) return; // Evitar doble envío
            
            const formData = new FormData(this);
            formData.append('is_ajax', '1');

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
                    const modalInst = bootstrap.Modal.getInstance(document.getElementById('modalCrearFicha'));
                    if (modalInst) modalInst.hide();

                    agregarFichaAlDOM(result.data);
                    runFilters();
                    
                    formCrearFicha.reset();

                    Swal.fire({
                        icon: 'success',
                        title: 'Ficha Creada',
                        text: 'La ficha se ha registrado correctamente.',
                        timer: 2000,
                        showConfirmButton: false
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

    // Validar el formulario de edición asíncronamente
    const formEditarFicha = document.getElementById('form-editar-ficha');
    if (formEditarFicha) {
        formEditarFicha.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const btnSubmit = this.querySelector('button[type="submit"]');
            if (btnSubmit.disabled) return; // Evitar doble envío
            
            const formData = new FormData(this);
            formData.append('is_ajax', '1');

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

    // ==============================================
    // AUTO-CALCULAR FECHAS PARA TECNÓLOGOS EN CREACIÓN Y EDICIÓN
    // ==============================================
    function setupDateCalculator(idInicio, idPracticas, idFin, idPrograma) {
        const inputInicio = document.getElementById(idInicio);
        const inputPracticas = document.getElementById(idPracticas);
        const inputFin = document.getElementById(idFin);
        const selectPrograma = document.getElementById(idPrograma);

        if (!inputInicio || !inputPracticas || !inputFin || !selectPrograma) return;

        function calcularFechas() {
            const fechaInicio = inputInicio.value;
            const selectedOption = selectPrograma.options[selectPrograma.selectedIndex];
            
            if (!selectedOption || !fechaInicio) return;
            
            const tipoPrograma = selectedOption.getAttribute('data-tipo');

            if (tipoPrograma && tipoPrograma.includes('Tecnólogo')) {
                let fecha = new Date(fechaInicio);
                
                let fechaPracticas = new Date(fecha);
                fechaPracticas.setMonth(fechaPracticas.getMonth() + 21);
                
                let fechaFin = new Date(fecha);
                fechaFin.setMonth(fechaFin.getMonth() + 27);

                inputPracticas.value = fechaPracticas.toISOString().split('T')[0];
                inputFin.value = fechaFin.toISOString().split('T')[0];
            }
        }

        inputInicio.addEventListener('change', calcularFechas);
        selectPrograma.addEventListener('change', calcularFechas);
    }

    setupDateCalculator('fecha_inicio', 'fecha_practicas', 'fecha_fin', 'id_programa');
    setupDateCalculator('edit_fecha_inicio', 'edit_fecha_practicas', 'edit_fecha_fin', 'edit_id_programa');
});

// Función global que abre el modal de edición y carga la data
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
    
    const modal = new bootstrap.Modal(document.getElementById('modalEditarFicha'));
    modal.show();
}
</script>
