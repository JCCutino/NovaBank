<?php
$modales= '<div class="modal fade" id="nombreModal" tabindex="-1" aria-labelledby="nombreModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="nombreModalLabel">Editar Nombre</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
      <form action="funcionalidades/updateDatos.php" method="post">
        <label for="nombreInput" class="form-label">Nuevo Nombre:</label>
        <input type="text" class="form-control" id="nombreInput" name="nuevoNombre" placeholder="Introduce el nuevo nombre">
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      <button type="submit" class="btn btn-primary">Guardar cambios</button>
      <input type="hidden" name="accion" value="actualizarNombre">
      </form>
    </div>
  </div>
</div>
</div>


<div class="modal fade" id="apellidosModal" tabindex="-1" aria-labelledby="apellidosModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="apellidosModalLabel">Editar Apellidos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="funcionalidades/updateDatos.php" method="post">
          <label for="apellidosInput" class="form-label">Nuevos Apellidos:</label>
          <input type="text" class="form-control" id="apellidosInput" name="nuevoApellido" placeholder="Introduce los nuevos apellidos">
          </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
        <input type="hidden" name="accion" value="actualizarApellido">
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="fechaNacimientoModal" tabindex="-1" aria-labelledby="fechaNacimientoModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="fechaNacimientoModalLabel">Editar Fecha de Nacimiento</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="funcionalidades/updateDatos.php" method="post">
          <label for="fechaNacimientoInput" class="form-label">Nueva Fecha de Nacimiento:</label>
          <input type="date" class="form-control" id="fechaNacimientoInput" name="nuevaFechaNacimiento">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
        <input type="hidden" name="accion" value="actualizarFechaNacimiento">
        </form>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="direccionModal" tabindex="-1" aria-labelledby="direccionModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="direccionModalLabel">Editar Dirección</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="funcionalidades/updateDatos.php" method="post">
          <label for="direccionInput" class="form-label">Nueva Dirección:</label>
          <input type="text" class="form-control" id="direccionInput" name="nuevaDireccion" placeholder="Introduce la nueva dirección">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
        <input type="hidden" name="accion" value="actualizarDireccion">
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="codigoPostalModal" tabindex="-1" aria-labelledby="codigoPostalModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="codigoPostalModalLabel">Editar Código Postal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="funcionalidades/updateDatos.php" method="post">
          <label for="codigoPostalInput" class="form-label">Nuevo Código Postal:</label>
          <input type="text" class="form-control" id="codigoPostalInput" name="nuevoCodigoPostal" placeholder="Introduce el nuevo código postal">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
        <input type="hidden" name="accion" value="actualizarCodigoPostal">
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="ciudadModal" tabindex="-1" aria-labelledby="ciudadModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ciudadModalLabel">Editar Ciudad</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="funcionalidades/updateDatos.php" method="post">
          <label for="ciudadInput" class="form-label">Nueva Ciudad:</label>
          <input type="text" class="form-control" id="ciudadInput" name="nuevaCiudad" placeholder="Introduce la nueva ciudad">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
        <input type="hidden" name="accion" value="actualizarCiudad">
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="provinciaModal" tabindex="-1" aria-labelledby="provinciaModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="provinciaModalLabel">Editar Provincia</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="funcionalidades/updateDatos.php" method="post">
          <label for="provinciaInput" class="form-label">Nueva Provincia:</label>
          <input type="text" class="form-control" id="provinciaInput" name="nuevaProvincia" placeholder="Introduce la nueva provincia">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
        <input type="hidden" name="accion" value="actualizarProvincia">
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="paisModal" tabindex="-1" aria-labelledby="paisModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="paisModalLabel">Editar País</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="funcionalidades/updateDatos.php" method="post">
          <label for="paisInput" class="form-label">Nuevo País:</label>
          <input type="text" class="form-control" id="paisInput" name="nuevoPais" placeholder="Introduce el nuevo país">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
        <input type="hidden" name="accion" value="actualizarPais">
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="contrasenaModal" tabindex="-1" aria-labelledby="contrasenaModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="contrasenaModalLabel">Editar Contraseña</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="funcionalidades/updateDatos.php" method="post">
          <label for="contrasenaInput" class="form-label">Nuevo Contraseña:</label>
          <input type="password" class="form-control" id="contrasenaInput" name="nuevaContrasena" placeholder="Introduce la nueva contraseña">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
        <input type="hidden" name="accion" value="actualizarContrasena">
        </form>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="urlFotoModal" tabindex="-1" aria-labelledby="urlFotoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="urlFotoModalLabel">Editar URL de Foto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="funcionalidades/subirFoto.php" method="post" enctype="multipart/form-data">
                    <label for="urlFotoInput" class="form-label">Seleccionar Foto:</label>
                    <input type="file" class="form-control" name="foto" id="urlFotoInput" accept="image/*">
                    <small class="text-muted">Selecciona un archivo de imagen (jpg, png, etc.)</small>

                    <!-- Puedes agregar otros campos del formulario aquí si es necesario -->

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


';

?>