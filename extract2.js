
                                <div id="listaAprendicesContainer" style="min-height: 250px;">
                                    <div class="text-center py-5 text-muted h-100 d-flex flex-column justify-content-center align-items-center">
                                        <i class="fa-solid fa-clipboard-list fa-3x mb-3 text-secondary opacity-50"></i>
                                        <p class="mb-1 fw-bold text-dark">No hay aprendices registrados en esta sesión</p>
                                        <p class="small">Los aprendices aparecerán aquí cuando la sesión tenga aprendices asignados.</p>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-center gap-4 mt-4 pt-3 border-top text-muted small fw-medium">
                                    <span><span class="asi-dot presente"></span> Asistió</span>
                                    <span><span class="asi-dot ausente"></span> No asistió</span>
                                    <span><span class="asi-dot pendiente"></span> Pendiente</span>
                                </div>
                            </div>
                        </div>

                        <!-- Columna Derecha: Sidebar (Acciones e Info) -->
                        <div class="col-12 col-lg-4">
                            
                            <!-- Acciones Rápidas -->
                            <div class="asi-sidebar-panel mb-4 shadow-sm">
                                <h6 class="fw-bold text-dark mb-3"><i class="fa-solid fa-bolt text-success me-2"></i> Acciones Rápidas</h6>
                                <div class="d-grid gap-2">
                                    <button type="button" class="btn btn-outline-asi-success" onclick="marcarTodos('presente')">
                                        <i class="fa-solid fa-check me-2"></i> Marcar todos como asistieron
                                    </button>
                                    <button type="button" class="btn btn-outline-asi-danger" onclick="marcarTodos('ausente')">
                                        <i class="fa-solid fa-xmark me-2"></i> Marcar todos como no asistieron
                                    </button>
                                    <button type="button" class="btn btn-outline-asi-secondary" onclick="marcarTodos('pendiente')">
                                        <i class="fa-solid fa-rotate-right me-2"></i> Limpiar planilla
                                    </button>
                                </div>
                            </div>

                            <!-- Información de la Sesión -->
                            <div class="asi-sidebar-panel shadow-sm mb-4">
                                <h6 class="fw-bold text-dark mb-3"><i class="fa-regular fa-calendar me-2 text-success"></i> Información de la Sesión</h6>
                                <table class="table table-sm table-borderless small mb-0">
                                    <tbody>
                                        <tr><td class="text-muted w-50">Programa:</td><td class="fw-medium text-dark text-end" id="info-prog">-</td></tr>
                                        <tr><td class="text-muted">Ambiente:</td><td class="fw-medium text-dark text-end" id="info-amb">-</td></tr>
                                        <tr><td class="text-muted">Hora:</td><td class="fw-medium text-dark text-end" id="info-hora">-</td></tr>
                                        <tr><td class="text-muted">Instructor:</td><td class="fw-medium text-dark text-end"><?= htmlspecialchars(explode(' ', $_SESSION['user_name'] ?? 'Instructor')[0]); ?></td></tr>
                                        <tr><td class="text-muted">Jornada:</td><td class="fw-medium text-end"><span class="badge bg-success-subtle text-success rounded-pill px-2" id="info-jor">-</span></td></tr>
                                    </tbody>
                                </table>
                            </div>

                            <button type="submit" class="btn btn-success w-100 py-3 rounded-3 fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2">
                                <i class="fa-regular fa-floppy-disk"></i> Guardar Planilla de Asistencia
                            </button>

                        </div>

                    </div>

                    <!-- Footer Info -->
                    <div class="alert alert-primary bg-primary-subtle border-0 text-primary d-flex align-items-center gap-2 shadow-sm rounded-3 py-2" role="alert" style="font-size: 0.85rem;">
                        <i class="fa-solid fa-circle-info"></i> Recuerda que puedes marcar la asistencia individualmente o usar las acciones rápidas para agilizar el proceso.
                    </div>

                    <script>
                        const aprendicesPorProgramacion = {"1":[]};
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
                                currentAprendices = [];
                                listaContainer.innerHTML = `
                                    <div class="text-center py-5 text-muted h-100 d-flex flex-column justify-content-center align-items-center">
                                        <i class="fa-solid fa-clipboard-list fa-3x mb-3 text-secondary opacity-50"></i>
                                        <p class="mb-1 fw-bold text-dark">No hay aprendices registrados en esta sesión</p>
                                        <p class="small">Los aprendices aparecerán aquí cuando la sesión tenga aprendices asignados.</p>
                                    </div>
                                `;
                                renderizarKPIs();
                                // Limpiar info
                                document.getElementById('info-prog').innerText = '-';
                                document.getElementById('info-amb').innerText = '-';
                                document.getElementById('info-hora').innerText = '-';
                                document.getElementById('info-jor').innerText = '-';
                                return;
                            }

                            // Info lateral
                            const option = this.options[this.selectedIndex];
                            document.getElementById('info-prog').innerText = option.getAttribute('data-desc') || 'Programa Técnico/Tecnológico';
                            document.getElementById('info-amb').innerText = option.getAttribute('data-amb') ? `Ambiente ${option.getAttribute('data-amb')}` : 'Sin Asignar';
                            document.getElementById('info-hora').innerText = option.getAttribute('data-hora') || '00:00 - 00:00';
                            document.getElementById('info-jor').innerText = option.getAttribute('data-jornada') || 'Diurna';

                            // Asegurarse de que sea un arreglo (si PHP lo codificó como objeto JSON)
                            let dataAprendices = aprendicesPorProgramacion[idProg];
                            currentAprendices = Array.isArray(dataAprendices) ? dataAprendices : (typeof dataAprendices === 'object' && dataAprendices !== null ? Object.values(dataAprendices) : []);
                            
                            renderizarLista(currentAprendices);
                        });

                        function renderizarLista(aprendices) {
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
