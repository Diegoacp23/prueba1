document.addEventListener('DOMContentLoaded', () => {
    const showFormBtn = document.getElementById('show-form-btn');
    const consultBtn = document.getElementById('consult-btn');
    const initialState = document.getElementById('initial-state');
    const contentContainer = document.getElementById('content-container');
    const accountDetailsSection = document.getElementById('account-details');
    const paymentTabsSection = document.getElementById('payment-tabs');
    const contractCheckbox = document.getElementById('contractCheckbox');
    const chargeDetailsDiv = document.getElementById('charge-details');
    const chargeDetailsTable = document.getElementById('charge-details-table');
    const totalToPaySpan = document.getElementById('total-to-pay');
    
    // Simular datos de clientes
    const clientes = {
        'V12345678': {
            deuda: '5.611,18 BsD',
            contrato: '0000377305',
            detalles: [{
                nroContrato: '0000377305',
                estatus: 'ACTIVO',
                concepto: 'MENS. FTTH-RES-600MB-THE END - SEPTIEMBRE 2025',
                cantidad: '1 Mes',
                monto: '5.611,18'
            }]
        },
        'J98765432': {
            deuda: '10.500,00 BsD',
            contrato: '0000998877',
            detalles: [{
                nroContrato: '0000998877',
                estatus: 'ACTIVO',
                concepto: 'PLAN EMPRESARIAL 1GB',
                cantidad: '1 Mes',
                monto: '10.500,00'
            }]
        }
    };

    // Datos para los select de bancos
    const bancos = [
        "Banco de Venezuela",
        "Banesco",
        "Mercantil",
        "BOD",
        "BBVA Provincial"
    ];

    // Función para llenar un select específico
    const fillSelect = (selectId, options) => {
        const selectElement = document.getElementById(selectId);
        if (selectElement) {
            selectElement.innerHTML = '<option value="">Seleccione un banco</option>';
            options.forEach(optionText => {
                const option = document.createElement('option');
                option.textContent = optionText;
                option.value = optionText;
                selectElement.appendChild(option);
            });
        }
    };

    // Llama a las funciones para llenar cada select individualmente
    fillSelect('banco-destino-transferencia', bancos);
    fillSelect('banco-origen-pagomovil', bancos);
    fillSelect('banco-destino-pagomovil', bancos);
    fillSelect('banco-destino-c2p', bancos);

    showFormBtn.addEventListener('click', () => {
        initialState.classList.add('hidden');
        contentContainer.classList.remove('hidden');
    });

    consultBtn.addEventListener('click', () => {
        const docType = document.getElementById('document-type').value;
        const docNumber = document.getElementById('document-number').value.trim();
        const fullDoc = `${docType}${docNumber}`;
        
        if (clientes[fullDoc]) {
            const cliente = clientes[fullDoc];
            document.getElementById('contract-number').textContent = cliente.contrato;
            totalToPaySpan.textContent = cliente.deuda;
            accountDetailsSection.classList.remove('hidden');
            paymentTabsSection.classList.add('hidden');
            chargeDetailsDiv.classList.add('hidden');
            contractCheckbox.checked = false;
        } else {
            alert('Usuario no encontrado.');
            accountDetailsSection.classList.add('hidden');
            paymentTabsSection.classList.add('hidden');
            chargeDetailsDiv.classList.add('hidden');
        }
    });

    contractCheckbox.addEventListener('change', () => {
        if (contractCheckbox.checked) {
            const docType = document.getElementById('document-type').value;
            const docNumber = document.getElementById('document-number').value.trim();
            const fullDoc = `${docType}${docNumber}`;
            const cliente = clientes[fullDoc];
            
            chargeDetailsTable.innerHTML = '';
            cliente.detalles.forEach(detalle => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${detalle.nroContrato}</td>
                    <td>${detalle.estatus}</td>
                    <td>${detalle.concepto}</td>
                    <td>${detalle.cantidad}</td>
                    <td>${detalle.monto} BsD</td>
                `;
                chargeDetailsTable.appendChild(row);
            });
            
            chargeDetailsDiv.classList.remove('hidden');
            paymentTabsSection.classList.remove('hidden');
        } else {
            chargeDetailsDiv.classList.add('hidden');
            paymentTabsSection.classList.add('hidden');
        }
    });

    // Código para mostrar el modal automáticamente al cargar la página
    var myModal = new bootstrap.Modal(document.getElementById('promotionModal'));
    myModal.show();
});