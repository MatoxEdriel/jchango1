<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos | PartyApp</title>
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
            
            <aside class="sidebar-form">
                <div class="product-card">
                    <header class="card-header">
                        <h1>Nuevo Producto</h1>
                        <p>Agregue artículos al inventario</p>
                    </header>

                    <?php if(isset($_SESSION['product_action'])): ?>
                        <div class="alert-box success">
                            <i class="fas fa-check-circle"></i> <?= $_SESSION['product_action']; unset($_SESSION['product_action']); ?>
                        </div>
                    <?php endif; ?>

                    <form action="index.php?c=Product&a=save" method="POST" enctype="multipart/form-data">
                        <div class="form-section">
                            <label>Nombre del Producto</label>
                            <input type="text" name="name" class="input-control" required placeholder="Ej: Pack Globos Helio">
                        </div>

                        <div class="form-section row-group">
                            <div class="col-half">
                                <label>Precio ($)</label>
                                <input type="number" name="price" step="0.01" min="0" class="input-control" required placeholder="0.00">
                            </div>
                            <div class="col-half">
                                <label>Stock</label>
                                <input type="number" name="stock" min="0" class="input-control" required placeholder="0">
                            </div>
                        </div>

                        <div class="form-section">
                            <label>Descripción</label>
                            <textarea name="description" class="input-control" rows="2" placeholder="Breve descripción..."></textarea>
                        </div>

                        <div class="form-section">
                            <label>Imagen</label>
                            <input type="file" name="image" accept="image/*" class="input-control">
                        </div>

                        <div class="btn-container">
                            <button type="submit" class="btn btn-primary" style="width: 100%;">
                                <i class="fas fa-plus"></i> Registrar Producto
                            </button>
                        </div>
                    </form>
                </div>
            </aside>

            <main class="main-table">
                <div class="product-card no-padding">
                    <header class="card-header padding-top">
                        <h2>Inventario Actual</h2>
                    </header>
                    
                    <div class="table-responsive">
                        <table class="styled-table">
                            <thead>
                                <tr>
                                    <th>Imagen</th>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>Stock</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($products)): ?>
                                    <?php foreach($products as $prod): ?>
                                    <tr>
                                        <td>
                                            <?php if($prod->image): ?>
                                                <img src="uploads/images/<?= $prod->image ?>" class="img-thumb">
                                            <?php else: ?>
                                                <div class="no-img">S/I</div>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="prod-info">
                                                <strong><?= $prod->name ?></strong>
                                                <small><?= substr($prod->description, 0, 30) ?>...</small>
                                            </div>
                                        </td>
                                        <td class="text-price">$<?= number_format($prod->price, 2) ?></td>
                                        <td>
                                            <span class="badge <?= $prod->stock > 0 ? 'bg-success' : 'bg-danger' ?>">
                                                <?= $prod->stock ?> unids.
                                            </span>
                                        </td>
                                        <td class="actions-td">
                                            <a href="index.php?c=Product&a=edit&id=<?= $prod->id ?>" class="action-btn btn-edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="index.php?c=Product&a=delete&id=<?= $prod->id ?>" 
                                               class="action-btn btn-delete" 
                                               onclick="return confirm('¿Eliminar este producto?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center">No hay productos.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>

        </div> </div>

</body>
</html>