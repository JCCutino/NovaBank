<?php

$modales_errores = '<!-- Modal de Error: Saldo Insuficiente -->
<div class="modal fade" id="saldoInsuficienteModal" tabindex="-1" role="dialog" aria-labelledby="saldoInsuficienteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="saldoInsuficienteModalLabel">Error: Saldo Insuficiente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                El saldo de la cuenta emisora no es suficiente para realizar la transferencia.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Error: IBAN no Encontrado (Emisor o Receptor) -->
<div class="modal fade" id="ibanNoEncontradoModal" tabindex="-1" role="dialog" aria-labelledby="ibanNoEncontradoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ibanNoEncontradoModalLabel">Error: IBAN no Encontrado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                El IBAN especificado no se encuentra en la base de datos.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Error: Error en la Base de Datos (Emisor o Receptor) -->
<div class="modal fade" id="errorBaseDatosModal" tabindex="-1" role="dialog" aria-labelledby="errorBaseDatosModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="errorBaseDatosModalLabel">Error: Error en la Base de Datos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Se ha producido un error al actualizar la base de datos. Por favor, inténtalo de nuevo más tarde.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Error: Cantidad Inválida -->
<div class="modal fade" id="cantidadInvalidaModal" tabindex="-1" role="dialog" aria-labelledby="cantidadInvalidaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cantidadInvalidaModalLabel">Error: Cantidad Inválida</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                La cantidad especificada para la transferencia no es válida. Asegúrate de ingresar un monto mayor que cero.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Éxito: Transferencia Enviada -->
<div class="modal fade" id="transferenciaExitosaModal" tabindex="-1" role="dialog" aria-labelledby="transferenciaExitosaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="transferenciaExitosaModalLabel">Éxito: Transferencia Enviada</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                La transferencia se ha realizado con éxito.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

';
echo $modales_errores;

?>