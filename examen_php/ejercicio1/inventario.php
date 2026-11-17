<?php
class Inventario
{
    private array $productos;

    public function __construct(array $productos)
    {
        $this->productos = $productos;
    }

    public function obtenerProductos(): array
    {
        return $this->productos;
    }

    public function obtenerDisponibles(): array
    {
        $disponibles = [];

        foreach ($this->productos as $producto) {
            if ($producto["stock"] > 0) {
                $disponibles[] = $producto;
            }
        }

        return $disponibles;
    }

    public function calcularValorStock(): float
    {
        $total = 0;

        foreach ($this->productos as $producto) {
            $total += $producto["precio"] * $producto["stock"];
        }

        return $total;
    }

    public function buscarPorId(int $id): ?array
    {
        foreach ($this->productos as $producto) {
            if ($producto["id"] == $id) {
                return $producto;
            }
        }

        return null;
    }

    public function obtenerNombres(): array
    {
        $nombres = [];

        foreach ($this->productos as $producto) {
            $nombres[] = $producto["nombre"];
        }

        return $nombres;
    }

    public function obtenerCategorias(): array
    {
        $categorias = [];

        foreach ($this->productos as $producto) {
            if (!in_array($producto["categoria"], $categorias)) {
                $categorias[] = $producto["categoria"];
            }
        }

        return $categorias;
    }

    public function obtenerEstado(int $stock): string
    {
        if ($stock == 0) {
            return "Agotado";
        } elseif ($stock <= 3) {
            return "Stock bajo";
        } else {
            return "Disponible";
        }
    }
}

$datosDeEntrada = [
    [
        "id" => 1,
        "nombre" => "Portátil Gaming",
        "precio" => 1199.99,
        "stock" => 10,
        "categoria" => "Electrónica"
    ],
    [
        "id" => 2,
        "nombre" => "Ratón Inalámbrico",
        "precio" => 45.50,
        "stock" => 3,
        "categoria" => "Electrónica"
    ],
    [
        "id" => 3,
        "nombre" => "Teclado Mecánico",
        "precio" => 89.90,
        "stock" => 0,
        "categoria" => "Electrónica"
    ],
    [
        "id" => 4,
        "nombre" => "Silla de Oficina",
        "precio" => 150.00,
        "stock" => 7,
        "categoria" => "Muebles"
    ],
    [
        "id" => 5,
        "nombre" => "Cafetera Express",
        "precio" => 79.95,
        "stock" => 12,
        "categoria" => "Electrodomésticos"
    ]
];

$inventario = new Inventario($datosDeEntrada);
$disponibles = $inventario->obtenerDisponibles();
$productoBuscado = $inventario->buscarPorId(2);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos.css">
    <title>Ejercicio 1</title>
</head>

<body>

    <h1>Inventario</h1>
    <p>
            <strong>Valor total del stock:</strong>
            <?= $inventario->calcularValorStock() ?> €
    </p>
    <p>
        <strong>Categorías:</strong>
        <?= implode(", ", $inventario->obtenerCategorias()) ?>
    </p>
    <h2>Productos</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Estado</th>
        </tr>
        <?php foreach ($inventario->obtenerProductos() as $producto): ?>

            <tr>
                <td><?= $producto["id"] ?></td>
                <td><?= $producto["nombre"] ?></td>
                <td><?= $producto["categoria"] ?></td>
                <td><?= $producto["precio"] ?> €</td>
                <td><?= $producto["stock"] ?></td>
                <td><?= $inventario->obtenerEstado($producto["stock"]) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>