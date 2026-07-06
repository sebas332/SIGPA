<div class="container-fluid px-0">
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

    <!-- Cabecera -->
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center mb-4 gap-3">
        <div class="d-flex align-items-center gap-3">
            <div style="width: 48px; height: 48px; background-color: #e8f5e9; color: #39A900; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                <i class="fa-solid fa-building"></i>
            </div>
            <div>
                <h4 class="fw-bold text-dark mb-0">Catálogo e Infraestructura de Ambientes</h4>
                <p class="text-muted small mb-0">Gestión de aulas, dotación técnica y disponibilidad en tiempo real.</p>
            </div>
        </div>
        <?php if ($current_role === 'Coordinador'): ?>
            <button type="button" class="btn btn-success fw-semibold px-4 py-2 shadow-sm d-flex align-items-center gap-2" style="background-color: #39A900; border-color: #39A900; border-radius: 25px;" data-bs-toggle="modal" data-bs-target="#modalCrearAmbiente">
                <i class="fa-solid fa-circle-plus fs-5"></i> Registrar Ambiente
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
                <h5 class="fw-bold">No hay ambientes registrados en el sistema</h5>
            </div>
        <?php else: ?>
            <?php foreach ($ambientes as $amb): ?>
                <?php 
                $fotos_key = isset($fotos) ? $fotos : ($fotos_ambientes ?? []);
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
                            <div class="col-12 col-sm-5 position-relative env-card-img-container" style="height: 180px;">
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
                                                <a class="dropdown-item small d-flex align-items-center gap-2" href="<?= URLROOT; ?>/index.php?route=ambientes/novedad&id=<?= $amb->id_numero_ambiente; ?>">
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
                            <div class="col-12 col-sm-7 p-3 d-flex flex-column justify-content-between">
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
                                            <button class="btn env-action-btn-edit d-flex align-items-center gap-1" onclick="editarAmbiente(<?= $amb->id_numero_ambiente; ?>, '<?= htmlspecialchars(addslashes($amb->nombre)); ?>', '<?= htmlspecialchars(addslashes($amb->tipo)); ?>', <?= $amb->capacidad; ?>, <?= $amb->computadores; ?>, '<?= htmlspecialchars(addslashes($amb->especialidad_ambiente)); ?>', <?= $amb->aire; ?>, <?= $amb->ventilador; ?>, <?= $amb->tablero; ?>, <?= $amb->tv; ?>, <?= $amb->disponibilidad; ?>)">
                                                <i class="fa-solid fa-pen"></i> Editar
                                            </button>
                                            <a href="<?= URLROOT; ?>/index.php?route=ambientes/delete&id=<?= $amb->id_numero_ambiente; ?>" class="btn env-action-btn-delete d-flex align-items-center justify-content-center" onclick="return confirm('¿Seguro que deseas borrar este ambiente?');">
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

    <!-- Script del motor de filtros de ambientes -->
    <script>
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

            const wrappers = Array.from(document.querySelectorAll(".env-card-wrapper"));

            function applyFilters() {
                const query = searchInput.value.trim().toLowerCase();
                const estado = filterEstado.value;
                const tipo = filterTipo.value;

                let visibleCount = 0;
                let activeCount = 0;
                let totalPcs = 0;
                let totalCapacidad = 0;

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
                        wrapper.classList.remove("d-none");
                        visibleCount++;
                        if (isAvailable === "1") {
                            activeCount++;
                        }
                        totalPcs += pcs;
                        totalCapacidad += cap;
                    } else {
                        wrapper.classList.add("d-none");
                    }
                });

                if (kpiTotal) kpiTotal.textContent = visibleCount;
                if (kpiPcs) kpiPcs.textContent = totalPcs;
                if (kpiCapacidad) kpiCapacidad.textContent = totalCapacidad;
                if (kpiActivos) {
                    const pct = visibleCount > 0 ? Math.round((activeCount / visibleCount) * 100) : 0;
                    kpiActivos.textContent = pct + "%";
                }

                if (paginationInfo) {
                    paginationInfo.textContent = `Mostrando 1 a ${visibleCount} de ${visibleCount} ambientes`;
                }
            }

            if (searchInput) searchInput.addEventListener("input", applyFilters);
            if (filterEstado) filterEstado.addEventListener("change", applyFilters);
            if (filterTipo) filterTipo.addEventListener("change", applyFilters);
            if (filterSede) filterSede.addEventListener("change", applyFilters);

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
        });
    </script>
</div>

<?php if ($current_role === 'Coordinador'): ?>
<!-- Modal Crear Ambiente -->
<div class="modal fade" id="modalCrearAmbiente" tabindex="-1" aria-labelledby="modalCrearAmbienteLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header bg-dark text-white p-4 border-0">
                <h5 class="modal-title fw-bold" id="modalCrearAmbienteLabel"><i class="fa-solid fa-building me-2 text-success"></i>Registrar Nuevo Ambiente</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <form action="<?= URLROOT; ?>/index.php?route=ambientes/create" method="POST" enctype="multipart/form-data">
                <div class="modal-body p-4">
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
                            <input type="text" class="form-control form-control-lg" id="capacidad" name="capacidad" placeholder="Ej. 35" oninput="validarNumeros(this, 2)" required>
                        </div>
                        <div class="col-md-4">
                            <label for="computadores" class="form-label fw-medium text-secondary">Cantidad de Computadores</label>
                            <input type="text" class="form-control form-control-lg" id="computadores" name="computadores" placeholder="Ej. 35" oninput="validarNumeros(this, 3)" required>
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
                <div class="modal-footer p-4 border-0 bg-light">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary fw-bold shadow-sm"><i class="fa-solid fa-floppy-disk me-2"></i> Guardar Ambiente</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Editar Ambiente -->
<div class="modal fade" id="modalEditarAmbiente" tabindex="-1" aria-labelledby="modalEditarAmbienteLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header bg-primary text-white p-4 border-0">
                <h5 class="modal-title fw-bold" id="modalEditarAmbienteLabel"><i class="fa-solid fa-pen me-2"></i>Editar Ambiente</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <form action="<?= URLROOT; ?>/index.php?route=ambientes/update" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_numero_ambiente" id="edit_amb_id">
                <div class="modal-body p-4">
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
                            <input type="text" class="form-control form-control-lg" id="edit_amb_capacidad" name="capacidad" oninput="validarNumeros(this, 2)" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-medium text-secondary">Cantidad de Computadores</label>
                            <input type="text" class="form-control form-control-lg" id="edit_amb_computadores" name="computadores" oninput="validarNumeros(this, 3)" required>
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
                <div class="modal-footer p-4 border-0 bg-light">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary fw-bold shadow-sm"><i class="fa-solid fa-floppy-disk me-2"></i> Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function toggleEspecialidad(selectElement, targetId) {
    var target = document.getElementById(targetId);
    var divTarget = document.getElementById('div_' + targetId);
    if (selectElement.value === 'Especializado') {
        divTarget.style.display = 'block';
        target.setAttribute('required', 'required');
    } else {
        divTarget.style.display = 'none';
        target.removeAttribute('required');
        target.value = '';
    }
}

function validarLetras(input) {
    input.value = input.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúñÑ\s]/g, '');
}

function validarNumeros(input, maxLen) {
    input.value = input.value.replace(/[^0-9]/g, '');
    if (input.value.length > maxLen) {
        input.value = input.value.slice(0, maxLen);
    }
}

function editarAmbiente(id, nombre, tipo, cap, comp, esp, aire, vent, tab, tv, disp) {
    document.getElementById('edit_amb_id').value = id;
    document.getElementById('edit_amb_nombre').value = nombre;
    document.getElementById('edit_amb_tipo').value = tipo;
    
    // Disparar toggle de especialidad
    toggleEspecialidad(document.getElementById('edit_amb_tipo'), 'edit_amb_especialidad');
    
    document.getElementById('edit_amb_capacidad').value = cap;
    document.getElementById('edit_amb_computadores').value = comp;
    document.getElementById('edit_amb_especialidad').value = esp;
    document.getElementById('edit_amb_aire').checked = (aire == 1);
    document.getElementById('edit_amb_vent').checked = (vent == 1);
    document.getElementById('edit_amb_tablero').checked = (tab == 1);
    document.getElementById('edit_amb_tv').checked = (tv == 1);
    document.getElementById('edit_amb_disp').checked = (disp == 1);
    
    var modal = new bootstrap.Modal(document.getElementById('modalEditarAmbiente'));
    modal.show();
}

function eliminarAmbiente(id) {
    if(confirm('¿Está seguro de eliminar este ambiente? Esta acción no se puede deshacer.')) {
        window.location.href = '<?= URLROOT; ?>/index.php?route=ambientes/delete&id=' + id;
    }
}
</script>
<?php endif; ?>
