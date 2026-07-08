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
                </form>
