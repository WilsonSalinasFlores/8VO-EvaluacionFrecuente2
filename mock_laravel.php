<?php
namespace Illuminate\Database\Eloquent {
    class Model {
        public static function all() {
            global $pdo;
            $stmt = $pdo->query("SELECT * FROM productos");
            $results = $stmt->fetchAll(\PDO::FETCH_OBJ);
            return \Illuminate\Support\collect($results);
        }
        public static function create($data) {
            global $pdo;
            $stmt = $pdo->prepare("INSERT INTO productos (nombre, descripcion, precio, stock, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())");
            $stmt->execute([$data['nombre'], $data['descripcion'] ?? '', $data['precio'], $data['stock']]);
            return new static;
        }
    }
}
namespace Illuminate\Http {
    class Request {
        public function validate($rules) { return $_POST; }
    }
}
namespace App\Http\Controllers {
    class Controller {}
}
namespace Illuminate\Support {
    function collect($items) { return new Collection($items); }
    class Collection implements \IteratorAggregate, \Countable {
        protected $items;
        public function __construct($items = []) { $this->items = $items; }
        public function getIterator(): \Traversable { return new \ArrayIterator($this->items); }
        public function count(): int { return count($this->items); }
    }
}
namespace {
    function view($name, $data = []) {
        extract($data);
        require __DIR__ . '/resources/views/' . str_replace('.', '/', $name) . '.php';
    }
    function redirect() {
        return new class {
            public function back() { return $this; }
            public function with($key, $msg) { $_SESSION[$key] = $msg; return $this; }
        };
    }
    // Autoloader para las clases Src
    spl_autoload_register(function ($class) {
        $prefix = 'Src\\';
        $base_dir = __DIR__ . '/src/';
        $len = strlen($prefix);
        if (strncmp($prefix, $class, $len) !== 0) return;
        $relative_class = substr($class, $len);
        $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
        if (file_exists($file)) require $file;
    });
}
