<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Facturación | PartyApp</title>
    <link rel="stylesheet" href="assets/styles/product.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <div class="container-main">
        
        <div class="top-nav">
            <a href="index.php?c=Home&a=index" class="btn-back">
                <i class="fas fa-arrow-left"></i> Volver al Inicio
            </a>
        </div>

        <div class="dashboard-layout">
            
            <aside class="sidebar-form" style="flex: 0 0 400px;">
                <div class="product-card">
                    <header class="card-header">
                        <h1>Nueva Factura</h1>
                        <p>Seleccione cliente y productos</p>
                    </header>

                    <?php if(isset($_SESSION['invoice_action'])): ?>
                        <div class="alert-box success">
                            <i class="fas fa-check"></i> <?= $_SESSION['invoice_action']; unset($_SESSION['invoice_action']); ?>
                        </div>
                    <?php endif; ?>

                    <form action="index.php?c=Invoice&a=save" method="POST">
                        <div class="form-section">
                            <label><i class="fas fa-user"></i> Cliente</label>
                            <select name="user_id" class="input-control" required>
                                <option value="">-- Seleccionar Cliente --</option>
                                <?php foreach($users as $u): ?>
                                    <option value="<?= $u->id ?>"><?= $u->nombre ?> <?= $u->apellido ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-section">
                            <label><i class="fas fa-box"></i> Productos Disponibles</label>
                            <div style="max-height: 300px; overflow-y: auto; border: 1px solid #eee; padding: 10px; border-radius: 8px;">
                                <?php foreach($products as $p): ?>
                                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px; padding-bottom: 5px; border-bottom: 1px solid #f9f9f9;">
                                        <div style="display: flex; align-items: center; gap: 10px;">
                                            <input type="checkbox" name="products_selected[]" value="<?= $p->id ?>">
                                            <div style="display: flex; flex-direction: column;">
                                                <span style="font-size: 0.85rem; font-weight: 500;"><?= $p->name ?></span>
                                                <small style="color: #666;">$<?= number_format($p->price, 2) ?></small>
                                                <input type="hidden" name="prices[<?= $p->id ?>]" value="<?= $p->price ?>">
                                            </div>
                                        </div>
                                        <input type="number" name="qty[<?= $p->id ?>]" value="1" min="1" max="<?= $p->stock ?>" 
                                               style="width: 50px; padding: 3px; border-radius: 4px; border: 1px solid #ddd;">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="btn-container">
                            <button type="submit" class="btn btn-primary" style="width: 100%;">
                                <i class="fas fa-file-invoice-dollar"></i> Generar Factura
                            </button>
                        </div>
                    </form>
                </div>
            </aside>

            <main class="main-table">
                <div class="product-card no-padding">
                    <header class="card-header padding-top">
                        <h2>Historial de Invoices</h2>
                    </header>

                    <div class="table-responsive">
                        <table class="styled-table">
                            <thead>
                                <tr>
                                    <th>Factura #</th>
                                    <th>Cliente</th>
                                    <th>Fecha</th>
                                    <th>Total</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($invoices)): ?>
                                    <?php foreach($invoices as $inv): ?>
                                    <tr>
                                        <td><strong>INV-00<?= $inv->id ?></strong></td>
                                        <td><?= $inv->user_name ?></td>
                                        <td><small><?= date("d/m/Y H:i", strtotime($inv->created_at)) ?></small></td>
                                        <td class="text-price">$<?= number_format($inv->total_amount, 2) ?></td>
                                        <td>
                                            <span class="badge bg-success">
                                                <?= ucfirst($inv->status) ?>
                                            </span>
                                        </td>
                                        <td class="actions-td">
                                            <a href="#" class="action-btn btn-edit" title="Ver Detalle">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="index.php?c=Invoice&a=delete&id=<?= $inv->id ?>" 
                                               class="action-btn btn-delete" 
                                               onclick="return confirm('¿Borrar registro de factura?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="6" class="text-center">No hay ventas registradas.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>

        </div> </div>

</body>
</html>