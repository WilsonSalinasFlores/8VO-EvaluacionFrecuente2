<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos</title>
    <!-- CSS mínimo simulando Tailwind / Bootstrap -->
    <style>
        body { font-family: sans-serif; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input, textarea { width: 100%; padding: 8px; }
        button { padding: 10px 15px; background-color: #007bff; color: #fff; border: none; cursor: pointer; }
    </style>
</head>
<body>

    <h1>Gestión de Productos</h1>

    <?php if(isset($_SESSION['success'])): ?>
        <div style="color: green; margin-bottom: 20px;">
            <?php echo $_SESSION['success'] ?? ''; unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>

    <div style="max-width: 500px;">
        <h2>Añadir Producto</h2>
        <form action="" method="POST">
            
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion"></textarea>
            </div>
            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number" step="0.01" id="precio" name="precio" required>
            </div>
            <div class="form-group">
                <label for="stock">Stock:</label>
                <input type="number" id="stock" name="stock" required>
            </div>
            <button type="submit">Guardar Producto</button>
        </form>
    </div>

    <h2>Listado de Productos</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
            <?php if(count($productos) > 0): foreach($productos as $producto): ?>
            <tr>
                <td><?= $producto->id ?></td>
                <td><?= $producto->nombre ?></td>
                <td><?= $producto->descripcion ?></td>
                <td>$<?= number_format($producto->precio, 2) ?></td>
                <td><?= $producto->stock ?></td>
            </tr>
            <?php endforeach; else: ?>
            <tr>
                <td colspan="5">No hay productos registrados.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>
