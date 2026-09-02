<?php
session_start();
// Mock de base de datos usando PDO
$pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=gestion_productos', 'root', 'root');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

require_once __DIR__ . '/mock_laravel.php';

use Controllers\ProductoController;
use Services\ProductoService;
use Illuminate\Http\Request;

// Routing básico (Mock de Route::get y Route::post)
$method = $_SERVER['REQUEST_METHOD'];
$service = new ProductoService();
$controller = new ProductoController($service);

// Quitar sintaxis blade de la vista
$vista = file_get_contents(__DIR__ . '/resources/views/productos/index.blade.php');
$vista = str_replace(['@csrf', '{{ route(\'productos.store\') }}', '{{ session(\'success\') }}', '{{ $producto->id }}', '{{ $producto->nombre }}', '{{ $producto->descripcion }}', '${{ number_format($producto->precio, 2) }}', '{{ $producto->stock }}'], 
                     ['', '', '<?php echo $_SESSION[\'success\'] ?? \'\'; unset($_SESSION[\'success\']); ?>', '<?= $producto->id ?>', '<?= $producto->nombre ?>', '<?= $producto->descripcion ?>', '$<?= number_format($producto->precio, 2) ?>', '<?= $producto->stock ?>'], $vista);
$vista = preg_replace('/@if\(session\(\'success\'\)\)(.*?)@endif/s', '<?php if(isset($_SESSION[\'success\'])): ?>$1<?php endif; ?>', $vista);
$vista = preg_replace('/@forelse\(\$productos as \$producto\)(.*?)@empty(.*?)@endforelse/s', '<?php if(count($productos) > 0): foreach($productos as $producto): ?>$1<?php endforeach; else: ?>$2<?php endif; ?>', $vista);
file_put_contents(__DIR__ . '/resources/views/productos/index.php', $vista);


if ($method === 'POST') {
    $request = new Request();
    $_POST['precio'] = $_POST['precio'] ?? 0;
    $_POST['stock'] = $_POST['stock'] ?? 0;
    $controller->store($request);
    header('Location: /index.php');
    exit;
} else {
    $controller->index();
}
