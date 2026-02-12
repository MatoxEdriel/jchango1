<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte General | PartyApp</title>
    <link rel="stylesheet" href="assets/styles/product.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .kpi-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 30px; }
        .kpi-card { background: white; padding: 20px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); text-align: center; border-bottom: 4px solid #6c63ff; }
        .kpi-card h3 { color: #64748b; font-size: 0.9rem; margin-bottom: 10px; }
        .kpi-card .value { font-size: 1.8rem; font-weight: 700; color: #1f2937; }
        .report-section { margin-bottom: 50px; }
        
        @media print {
            .top-nav, .btn-print { display: none !important; }
            body { background: white; }
            .product-card { box-shadow: none; border: 1px solid #eee; }
        }
    </style>
</head>
<body>

    <div class="container-main">
        <div class="top-nav" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <a href="index.php?c=Home&a=index" class="btn-back"><i class="fas fa-arrow-left"></i> Volver</a>
            <button onclick="window.print()" class="btn btn-primary btn-print">
                <i class="fas fa-file-pdf"></i> Imprimir Reporte
            </button>
        </div>

        <header class="card-header" style="text-align: left; margin-bottom: 30px;">
            <h1>Reporte de Gestión</h1>
            <p>Resumen detallado de la tienda al <?= date('d/m/Y') ?></p>
        </header>

        <div class="kpi-grid">
            <div class="kpi-card">
                <h3>Ventas Totales</h3>
                <div class="value">$<?= number_format($totalVentas, 2) ?></div>
            </div>
            <div class="kpi-card">
                <h3>Productos</h3>
                <div class="value"><?= count($products) ?></div>
            </div>
            <div class="kpi-card">
                <h3>Usuarios</h3>
                <div class="value"><?= count($users) ?></div>
            </div>
        </div>

        <div class="report-section">
            <div class="product-card no-padding">
                <header class="card-header padding-top">
                    <h2><i class="fas fa-box"></i> Inventario de Productos</h2>
                </header>
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($products as $p): ?>
                        <tr>
                            <td><strong><?= $p->name ?></strong></td>
                            <td>$<?= number_format($p->price, 2) ?></td>
                            <td><?= $p->stock ?> unids.</td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>