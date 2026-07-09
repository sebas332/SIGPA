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
        const urlRoot = "<?= URLROOT; ?>";

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
            typeBadge.className = `env-detail-badge-type \${tipo.toLowerCase() === 'especializado' ? 'bg-info-subtle text-info' : 'bg-success-subtle text-success'}`;
            
            document.getElementById('detail-env-capacity').innerText = `\${capacidad} personas`;
            document.getElementById('detail-env-pcs').innerText = computadores;
            document.getElementById('detail-env-type').innerText = tipo;
            
            let fechaMantenimiento = 'No registrada';
            if (fecha_creacion) {
                const parts = fecha_creacion.split(' ')[0].split('-');
                if (parts.length === 3) {
                    fechaMantenimiento = `\${parts[2]}/\${parts[1]}/\${parts[0]}`;
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
                btnEdit.setAttribute('onclick', `editarAmbiente(\${id}, '\${nombre.replace(/'/g, "\\'")}', '\${tipo}', \${capacidad}, \${computadores}, '\${(especialidad || '').replace(/'/g, "\\'")}', \${aire}, \${ventilador}, \${tablero}, \${tv}, \${disponibilidad})`);
            }
            
            const btnToggle = document.getElementById('detail-btn-toggle-disp');
            if (btnToggle) {
                btnToggle.href = `\${urlRoot}/index.php?route=ambientes/toggleDisponibilidad&id=\${id}`;
                btnToggle.innerHTML = disponibilidad == 1 ? '<i class="fa-solid fa-power-off"></i> Desactivar Ambiente' : '<i class="fa-solid fa-power-off"></i> Activar Ambiente';
                btnToggle.className = disponibilidad == 1 ? 'env-detail-btn env-detail-btn-danger text-decoration-none' : 'env-detail-btn env-detail-btn-primary text-decoration-none';
            }
            
            const btnFicha = document.getElementById('detail-btn-view-ficha');
            if (btnFicha) {
                btnFicha.href = `\${urlRoot}/index.php?route=dashboard/index&novedades_ambiente=\${id}#pills-novedades`;
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
            
            // Redirect to dashboard with parameters
            window.location.href = `\${urlRoot}/index.php?route=dashboard/index#pills-programacion&reserve_amb=\${selectedAmbiente.id}`;
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
                        <p class="mb-2"><strong>Ficha:</strong> <span class="badge bg-secondary">#\${s.numero_ficha}</span></p>
                        <p class="mb-2"><strong>Instructor:</strong> \${instructor}</p>
                        <p class="mb-2"><strong>Ambiente:</strong> \${s.ambiente_nombre}</p>
                        <p class="mb-2"><strong>Horario:</strong> \${s.nombre_dia} (\${s.hora_inicio.substring(0, 5)} - \${s.hora_fin.substring(0, 5)})</p>
                        <p class="mb-2"><strong>Competencia:</strong> \${s.competencia_nombre || 'N/A'}</p>
                        <p class="mb-0"><strong>Resultado:</strong> [\${s.ra_codigo}] \${s.ra_descripcion}</p>
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
                const fechaFormat = `\${fechaParts[2]}/\${fechaParts[1]}`;
                
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
                proximaCardTime.innerText = `\${prox.hora_inicio.substring(0, 5)} - \${prox.hora_fin.substring(0, 5)}`;
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
