<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios | PartyApp</title>
    <link rel="stylesheet" href="assets/styles/product.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <div class="container-main">
        <div class="top-nav">
            <a href="index.php?c=Home&a=index" class="btn-back">
                <i class="fas fa-arrow-left"></i> Volver al Panel
            </a>
        </div>

        <div class="table-wrapper" style="margin-top: 0;">
            <div class="product-card no-padding">
                <header class="card-header padding-top">
                    <h1>Gestión de Usuarios</h1>
                    <p>Lista de clientes y personal registrados en el sistema</p>
                </header>

                <?php if(isset($_SESSION['user_action'])): ?>
                    <div class="alert-box success" style="margin: 0 2.5rem 1.5rem 2.5rem;">
                        <i class="fas fa-check-circle"></i> <?= $_SESSION['user_action']; unset($_SESSION['user_action']); ?>
                    </div>
                <?php endif; ?>

                <div class="table-responsive">
                    <table class="styled-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre Completo</th>
                                <th>Correo Electrónico</th>
                                <th>Rol</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($users as $u): ?>
                            <tr>
                                <td><span class="text-muted">#<?= $u->id ?></span></td>
                                <td>
                                    <strong><?= $u->nombre . " " . $u->apellido ?></strong>
                                </td>
                                <td><?= $u->email ?></td>
                                <td>
                                    <span class="badge <?= $u->rol == 'admin' ? 'bg-danger' : 'bg-success' ?>">
                                        <?= ucfirst($u->rol) ?>
                                    </span>
                                </td>
                                <td class="actions-td">
                                    <?php if($u->id != $_SESSION['identity']->id): ?>
                                        <a href="index.php?c=User&a=delete&id=<?= $u->id ?>" 
                                           class="action-btn btn-delete" 
                                           onclick="return confirm('¿Estás seguro de eliminar a este usuario? Esta acción no se puede deshacer.')">
                                            <i class="fas fa-user-minus"></i>
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted" style="font-size: 0.8rem;">(Tú)</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>