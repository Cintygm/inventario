<?php require __DIR__ . '/../partials/header.php'; ?>

<?php
$categorias = ['Tecnología', 'Oficina', 'Limpieza', 'Alimentos', 'Mobiliario', 'Otros'];
$producto = $producto ?? [];
$errores  = $errores ?? [];
?>

<div class="container my-4 my-md-5">
  <div class="form-card shadow-sm">
    <div class="form-header">
      <i class="bi bi-clipboard2-plus"></i>
      <h3 class="mb-0 fw-bold">Registrar nuevo producto</h3>
      <p class="mb-0 small opacity-75">Complete los datos para agregarlo al inventario</p>
    </div>

    <div class="form-body">
      <?php if (!empty($errores)): ?>
        <div class="alert alert-danger">
          <i class="bi bi-exclamation-triangle"></i> Revise los campos marcados en el formulario.
        </div>
      <?php endif; ?>

      <form id="formProducto" method="POST" action="index.php?action=guardar" novalidate>
        <div class="mb-3">
          <label for="nombre" class="form-label">Nombre del producto</label>
          <input type="text" class="form-control <?= isset($errores['nombre']) ? 'is-invalid' : '' ?>"
                 id="nombre" name="nombre" placeholder="Ej. Mouse inalámbrico"
                 value="<?= htmlspecialchars($producto['nombre'] ?? '') ?>" maxlength="100" required>
          <div class="invalid-feedback"><?= $errores['nombre'] ?? '' ?></div>
        </div>

        <div class="mb-3">
          <label for="categoria" class="form-label">Categoría</label>
          <select class="form-select <?= isset($errores['categoria']) ? 'is-invalid' : '' ?>" id="categoria" name="categoria" required>
            <option value="" disabled <?= empty($producto['categoria']) ? 'selected' : '' ?>>Seleccione una categoría...</option>
            <?php foreach ($categorias as $cat): ?>
              <option value="<?= $cat ?>" <?= (($producto['categoria'] ?? '') === $cat) ? 'selected' : '' ?>><?= $cat ?></option>
            <?php endforeach; ?>
          </select>
          <div class="invalid-feedback"><?= $errores['categoria'] ?? '' ?></div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="precio" class="form-label">Precio ($)</label>
            <input type="number" step="0.01" min="0" class="form-control <?= isset($errores['precio']) ? 'is-invalid' : '' ?>"
                   id="precio" name="precio" placeholder="0.00"
                   value="<?= htmlspecialchars($producto['precio'] ?? '') ?>" required>
            <div class="invalid-feedback"><?= $errores['precio'] ?? '' ?></div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="cantidad" class="form-label">Cantidad en stock</label>
            <input type="number" step="1" min="0" class="form-control <?= isset($errores['cantidad']) ? 'is-invalid' : '' ?>"
                   id="cantidad" name="cantidad" placeholder="0"
                   value="<?= htmlspecialchars($producto['cantidad'] ?? '') ?>" required>
            <div class="invalid-feedback"><?= $errores['cantidad'] ?? '' ?></div>
          </div>
        </div>

        <div class="mb-4">
          <label for="descripcion" class="form-label">Descripción</label>
          <textarea class="form-control <?= isset($errores['descripcion']) ? 'is-invalid' : '' ?>"
                    id="descripcion" name="descripcion" rows="3" maxlength="255"
                    placeholder="Detalles adicionales del producto..."><?= htmlspecialchars($producto['descripcion'] ?? '') ?></textarea>
          <div class="invalid-feedback"><?= $errores['descripcion'] ?? '' ?></div>
        </div>

        <div class="d-flex gap-2">
          <button type="submit" class="btn btn-teal flex-fill py-2">
            <i class="bi bi-save"></i> Guardar producto
          </button>
          <a href="index.php?action=listar" class="btn btn-outline-secondary py-2">Cancelar</a>
        </div>
      </form>
    </div>
  </div>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>
