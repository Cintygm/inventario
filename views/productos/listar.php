<?php require __DIR__ . '/../partials/header.php'; ?>

<div class="container my-4 my-md-5">

  <!-- Estadísticas rápidas -->
  <div class="row g-3 mb-4">
    <div class="col-md-4">
      <div class="stat-card bg-navy">
        <div class="stat-label">Total de productos</div>
        <div class="stat-value"><?= count($productos) ?></div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="stat-card bg-teal">
        <div class="stat-label">Unidades en stock</div>
        <div class="stat-value"><?= $totalUnid ?></div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="stat-card bg-warning-custom">
        <div class="stat-label">Stock bajo (≤ 5)</div>
        <div class="stat-value"><?= $stockBajo ?></div>
      </div>
    </div>
  </div>

  <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <h2 class="fw-bold text-primary-custom mb-0"><i class="bi bi-box-seam"></i> Productos en inventario</h2>
    <a href="index.php?action=crear" class="btn btn-teal"><i class="bi bi-plus-circle"></i> Nuevo producto</a>
  </div>

  <?php if (isset($_GET['msg'])): ?>
    <?php
      $mensajes = [
        'creado'      => 'Producto creado correctamente.',
        'actualizado' => 'Producto actualizado correctamente.',
        'eliminado'   => 'Producto eliminado correctamente.'
      ];
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class="bi bi-check-circle"></i> <?= $mensajes[$_GET['msg']] ?? '' ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>
  <?php endif; ?>

  <form method="GET" action="index.php" class="row g-2 mb-4">
    <input type="hidden" name="action" value="listar">
    <div class="col-sm-8 col-md-6">
      <div class="input-group">
        <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
        <input type="text" name="q" class="form-control" placeholder="Buscar por nombre o categoría..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
      </div>
    </div>
    <div class="col-sm-4 col-md-auto">
      <button class="btn btn-outline-teal w-100" type="submit">Buscar</button>
      <?php if (!empty($_GET['q'])): ?>
        <a href="index.php?action=listar" class="btn btn-outline-secondary w-100 mt-2">Limpiar</a>
      <?php endif; ?>
    </div>
  </form>

  <div class="card shadow-sm border-0">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Categoría</th>
              <th>Precio</th>
              <th>Cantidad</th>
              <th>Descripción</th>
              <th class="text-end">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php if (count($productos) === 0): ?>
              <tr>
                <td colspan="7" class="text-center text-muted py-5">
                  <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                  No hay productos registrados<?= !empty($_GET['q']) ? ' para esta búsqueda' : '' ?>.
                </td>
              </tr>
            <?php else: foreach ($productos as $p): ?>
              <tr>
                <td class="text-muted">#<?= $p['id'] ?></td>
                <td class="fw-semibold"><?= htmlspecialchars($p['nombre']) ?></td>
                <td><span class="badge badge-categoria"><?= htmlspecialchars($p['categoria']) ?></span></td>
                <td>$<?= number_format((float)$p['precio'], 2) ?></td>
                <td>
                  <?php if ($p['cantidad'] <= 5): ?>
                    <span class="badge bg-danger"><?= $p['cantidad'] ?></span>
                  <?php else: ?>
                    <span class="badge bg-success"><?= $p['cantidad'] ?></span>
                  <?php endif; ?>
                </td>
                <td class="text-truncate d-none d-md-table-cell" style="max-width:220px;">
                  <?= htmlspecialchars($p['descripcion']) ?: '<span class="text-muted">—</span>' ?>
                </td>
                <td class="text-end">
                  <a href="index.php?action=editar&id=<?= $p['id'] ?>" class="btn btn-sm btn-outline-secondary" title="Editar">
                    <i class="bi bi-pencil-square"></i>
                  </a>
                  <a href="index.php?action=eliminar&id=<?= $p['id'] ?>"
                     class="btn btn-sm btn-outline-danger" title="Eliminar"
                     onclick="return confirmarEliminar('<?= htmlspecialchars(addslashes($p['nombre'])) ?>');">
                    <i class="bi bi-trash"></i>
                  </a>
                </td>
              </tr>
            <?php endforeach; endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>
