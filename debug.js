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
                            btnFicha.href = `${urlRoot}/index.php?route=ambientes/novedad&id=${id}`;
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
                <script>
                    function mostrarEvidencia(url) {
                        document.getElementById('imagenEvidenciaModal').src = url;
                        var evidenciaModal = new bootstrap.Modal(document.getElementById('modalVerEvidencia'));
                        evidenciaModal.show();
                    }
                </script>
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
                                        <button class="inst-btn-call" onclick="window.location.hash = '#pills-inst-asistencia'; document.getElementById('id_programacion_select').value = '${s.id_programacion}'; const evt = new Event('change'); document.getElementById('id_programacion_select').dispatchEvent(evt); return false;">
                                            <i class="fa-solid fa-clipboard-user me-2"></i> Llamar Asistencia
                                        </button>
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
                    <script>
                        const aprendicesPorProgramacion = <?= isset($aprendicesPorProgramacion) ? $aprendicesPorProgramacion : '{}'; ?>;
                        const listaContainer = document.getElementById('listaAprendicesContainer');
                        const selectProgramacion = document.getElementById('id_programacion_select');
                        const buscador = document.getElementById('buscadorAprendices');
                        let currentAprendices = [];

                        function renderizarKPIs() {
                            const total = currentAprendices.length;
                            document.getElementById('kpi-total-val').innerText = total;
                            document.getElementById('kpi-total-val').nextElementSibling.innerText = `/ ${total}`;
                            
                            if(total === 0) {
                                document.getElementById('kpi-presentes-val').innerText = '0';
                                document.getElementById('kpi-presentes-pct').innerText = '0';
                                document.getElementById('kpi-ausentes-val').innerText = '0';
                                document.getElementById('kpi-ausentes-pct').innerText = '0';
                                document.getElementById('kpi-pendientes-val').innerText = '-';
                                return;
                            }

                            const btns = listaContainer.querySelectorAll('.asi-btn-estado');
                            let presentes = 0, ausentes = 0, pendientes = 0;

                            btns.forEach(btn => {
                                if(btn.classList.contains('presente')) presentes++;
                                else if(btn.classList.contains('falla') || btn.classList.contains('ausente')) ausentes++;
                                else pendientes++;
                            });

                            document.getElementById('kpi-presentes-val').innerText = presentes;
                            document.getElementById('kpi-presentes-pct').innerText = Math.round((presentes/total)*100);
                            
                            document.getElementById('kpi-ausentes-val').innerText = ausentes;
                            document.getElementById('kpi-ausentes-pct').innerText = Math.round((ausentes/total)*100);
                            
                            document.getElementById('kpi-pendientes-val').innerText = pendientes > 0 ? pendientes : '-';
                        }

                        selectProgramacion.addEventListener('change', function() {
                            const idProg = this.value;
                            listaContainer.innerHTML = '';
                            
                            if (!idProg || !aprendicesPorProgramacion[idProg] || aprendicesPorProgramacion[idProg].length === 0) {
                            try {
                                const idProg = this.value;
                                if(!idProg || !aprendicesPorProgramacion[idProg] || aprendicesPorProgramacion[idProg].length === 0) {
                                    currentAprendices = [];
                                    renderizarLista([]);
                                    document.getElementById('info-prog').innerText = '-';
                                    document.getElementById('info-amb').innerText = '-';
                                    document.getElementById('info-hora').innerText = '-';
                                    document.getElementById('info-jor').innerText = '-';
                                    return;
                                }

                                const option = this.options[this.selectedIndex];
                                document.getElementById('info-prog').innerText = option.getAttribute('data-desc') || 'Programa Técnico/Tecnológico';
                                document.getElementById('info-amb').innerText = option.getAttribute('data-amb') ? `Ambiente ${option.getAttribute('data-amb')}` : 'Sin Asignar';
                                document.getElementById('info-hora').innerText = option.getAttribute('data-hora') || '00:00 - 00:00';
                                document.getElementById('info-jor').innerText = option.getAttribute('data-jornada') || 'Diurna';

                                let dataAprendices = aprendicesPorProgramacion[idProg];
                                currentAprendices = Array.isArray(dataAprendices) ? dataAprendices : (typeof dataAprendices === 'object' && dataAprendices !== null ? Object.values(dataAprendices) : []);
                                
                                renderizarLista(currentAprendices);
                            } catch (error) {
                                document.getElementById('listaAprendicesContainer').innerHTML = `<div class="alert alert-danger">JS ERROR: ${error.message} - Stack: ${error.stack}</div>`;
                            }
                        });

                        function renderizarLista(aprendices) {
                            try {
                                if(aprendices.length === 0) {
                                    listaContainer.innerHTML = `
                                        <div class="text-center py-5 text-muted">
                                            <p class="mb-0 fw-medium">No se encontraron aprendices con ese criterio.</p>
                                        </div>
                                    `;
                                    return;
                                }

                                let html = '';
                                aprendices.forEach((apr, index) => {
                                    html += `
                                        <div class="list-group-item d-flex align-items-center border-0 mb-2 shadow-sm rounded-4 asi-list-item" style="padding: 1.25rem; background-color: #fff;" data-nombre="${apr.nombre} ${apr.apellido}">
                                            <button type="button" class="btn btn-success text-white rounded-circle me-3 d-flex justify-content-center align-items-center asi-btn-estado presente" 
                                                    style="width: 45px; height: 45px; flex-shrink: 0;"
                                                    onclick="toggleEstadoAsistencia(this, 'estado_apr_${apr.id_usuario}')">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                            <input type="hidden" name="asistencia[${apr.id_usuario}][estado]" id="estado_apr_${apr.id_usuario}" value="1">
                                            
                                            <div class="flex-grow-1">
                                                <div class="fw-bold text-dark fs-6">${apr.nombre} ${apr.apellido}</div>
                                                <div class="small fw-bold lbl-estado text-success mt-1" style="font-size: 0.75rem;">ASISTE (PRESENTE)</div>
                                            </div>
                                            
                                            <div style="width: 40%;" class="d-none d-md-block">
                                                <input type="text" name="asistencia[${apr.id_usuario}][observacion]" 
                                                    class="form-control bg-light border-0 shadow-none rounded-3" 
                                                    placeholder="Agregar observación, incapacidad o excusa médica...">
                                            </div>
                                        </div>
                                    `;
                                });
                                listaContainer.innerHTML = html;
                                renderizarKPIs();
                            } catch(error) {
                                listaContainer.innerHTML = `<div class="alert alert-danger">RENDER ERROR: ${error.message}</div>`;
                            }
                        }

                        // Buscador
                        buscador.addEventListener('input', function(e) {
                            const term = e.target.value.toLowerCase();
                            const items = listaContainer.querySelectorAll('.asi-list-item');
                            items.forEach(item => {
                                const name = item.getAttribute('data-nombre').toLowerCase();
                                if(name.includes(term)) item.style.display = 'flex';
                                else item.style.display = 'none';
                            });
                        });

                        function toggleEstadoAsistencia(btn, hiddenId) {
                            const hiddenInput = document.getElementById(hiddenId);
                            const container = btn.closest('.asi-list-item');
                            const label = container.querySelector('.lbl-estado');

                            if (btn.classList.contains('presente')) {
                                btn.classList.remove('presente', 'btn-success');
                                btn.classList.add('falla', 'btn-danger');
                                btn.innerHTML = 'F';
                                hiddenInput.value = '0';
                                
                                label.classList.remove('text-success');
                                label.classList.add('text-danger');
                                label.textContent = 'INASISTENCIA (FALLA)';
                            } else {
                                btn.classList.remove('falla', 'btn-danger');
                                btn.classList.add('presente', 'btn-success');
                                btn.innerHTML = '<i class="fa-solid fa-check"></i>';
                                hiddenInput.value = '1';
                                
                                label.classList.remove('text-danger');
                                label.classList.add('text-success');
                                label.textContent = 'ASISTE (PRESENTE)';
                            }
                            renderizarKPIs();
                        }

                        function marcarTodos(estado) {
                            if(currentAprendices.length === 0) return;
                            const btns = listaContainer.querySelectorAll('.asi-btn-estado');
                            btns.forEach(btn => {
                                const container = btn.closest('.asi-list-item');
                                const hiddenInput = container.querySelector('input[type="hidden"]');
                                const label = container.querySelector('.lbl-estado');

                                if(estado === 'presente' || estado === 'pendiente') {
                                    hiddenInput.value = "1";
                                    btn.className = "btn btn-success text-white rounded-circle me-3 d-flex justify-content-center align-items-center asi-btn-estado presente";
                                    btn.innerHTML = '<i class="fa-solid fa-check"></i>';
                                    label.className = "small fw-bold lbl-estado text-success mt-1";
                                    label.textContent = "ASISTE (PRESENTE)";
                                } else if (estado === 'ausente') {
                                    hiddenInput.value = "0";
                                    btn.className = "btn btn-danger text-white rounded-circle me-3 d-flex justify-content-center align-items-center asi-btn-estado falla";
                                    btn.innerHTML = 'F';
                                    label.className = "small fw-bold lbl-estado text-danger mt-1";
                                    label.textContent = "INASISTENCIA (FALLA)";
                                }
                            });
                            renderizarKPIs();
                        }
                        
                        // Prevent form submission if there are pending students
                        document.getElementById('formAsistenciaDigital').addEventListener('submit', function(e) {
                            if(currentAprendices.length === 0) {
                                e.preventDefault();
                                alert("No hay aprendices registrados para enviar la planilla.");
                                return;
                            }
                            const pendings = listaContainer.querySelectorAll('.asi-btn-estado.pendiente');
                            if(pendings.length > 0) {
                                if(!confirm("Hay " + pendings.length + " aprendiz/ces marcados como 'Pendiente'. El sistema los guardará por defecto como 'Falla'. ¿Deseas continuar?")) {
                                    e.preventDefault();
                                } else {
                                    // Change value of pending inputs to 0
                                    pendings.forEach(btn => {
                                        const hiddenInput = btn.previousElementSibling;
                                        if(hiddenInput) hiddenInput.value = "0";
                                    });
                                }
                            }
                        });
                    </script>
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
                    fetch(`${urlRoot}/index.php?route=programacion/get_programacion_ajax`)
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

                cargarFiltrosDinamicos();
                renderizarCalendario();
                renderizarLista();
                if (typeof selectedAmbiente !== 'undefined' && selectedAmbiente !== null) {
                    cargarProgramacionAmbiente(selectedAmbiente.id);
                }
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
        fetch(`${urlRoot}/index.php?route=programacion/get_programacion_ajax`)
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
function cambiarVistaInst(vista) {
    const btnCal = document.getElementById('btnVistaCalendarioInst');
    const btnList = document.getElementById('btnVistaListaInst');
    const cardCal = document.getElementById('cardCalendarioInst');
    const navMes = document.getElementById('seccionNavegacionMesInst');
    const cardList = document.getElementById('cardListaCompletaInst');
    
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

function cambiarVistaApr(vista) {
    const btnCal = document.getElementById('btnVistaCalendarioApr');
    const btnList = document.getElementById('btnVistaListaApr');
    const cardCal = document.getElementById('cardCalendarioApr');
    const navMes = document.getElementById('seccionNavegacionMesApr');
    const cardList = document.getElementById('cardListaCompletaApr');
    
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
</script>
