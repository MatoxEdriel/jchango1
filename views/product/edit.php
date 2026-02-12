<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto | PartyApp</title>
    <link rel="stylesheet" href="assets/styles/product.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <div class="product-wrapper">
        <div class="product-card">
            
            <header class="card-header">
                <h1>Editar Producto</h1>
                <p>Modifica los detalles del artículo seleccionado</p>
            </header>

            <?php if(isset($prod) && is_object($prod)): ?>
                <form action="index.php?c=Product&a=update&id=<?= $prod->id ?>" method="POST" enctype="multipart/form-data">
                    
                    <input type="hidden" name="current_image" value="<?= $prod->image ?>">

                    <div class="form-section">
                        <label for="name">Nombre del Producto</label>
                        <input type="text" name="name" id="name" class="input-control" 
                               value="<?= $prod->name ?>" required>
                    </div>

                    <div class="form-section row-group">
                        <div class="col-half">
                            <label for="price">Precio ($)</label>
                            <input type="number" name="price" id="price" step="0.01" min="0" 
                                   class="input-control" value="<?= $prod->price ?>" required>
                        </div>

                        <div class="col-half">
                            <label for="stock">Stock</label>
                            <input type="number" name="stock" id="stock" min="0" 
                                   class="input-control" value="<?= $prod->stock ?>" required>
                        </div>
                    </div>

                    <div class="form-section">
                        <label for="description">Descripción</label>
                        <textarea name="description" id="description" class="input-control" rows="4"><?= $prod->description ?></textarea>
                    </div>

                    <div class="form-section">
                        <label>Imagen Actual</label>
                        <div class="image-preview-container">
                            <?php if($prod->image): ?>
                                <img src="uploads/images/<?= $prod->image ?>" class="img-edit-preview">
                                <p class="text-muted">¿Quieres cambiarla? Selecciona una nueva abajo:</p>
                            <?php else: ?>
                                <p class="text-muted">No tiene imagen asignada.</p>
                            <?php endif; ?>
                        </div>
                        <input type="file" name="image" id="image" accept="image/*" class="input-control">
                    </div>

                    <div class="btn-container">
                        <a href="index.php?c=Product&a=index" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Guardar Cambios
                        </button>
                    </div>

                </form>
            <?php else: ?>
                <div class="alert-box">
                    <p>Error: No se encontró el producto.</p>
                    <a href="index.php?c=Product&a=index" class="btn btn-secondary">Volver</a>
                </div>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>