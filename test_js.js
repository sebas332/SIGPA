const aprendicesPorProgramacion = {"1":[{"id_usuario":1,"nombre":"Jhon","apellido":"Doe"}]};
let currentAprendices = [];
const idProg = "1";
let dataAprendices = aprendicesPorProgramacion[idProg];
currentAprendices = Array.isArray(dataAprendices) ? dataAprendices : (typeof dataAprendices === 'object' && dataAprendices !== null ? Object.values(dataAprendices) : []);

function renderizarLista(aprendices) {
    if(aprendices.length === 0) {
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
    console.log(html);
}
renderizarLista(currentAprendices);
