<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido - Party App</title>
    <link rel="stylesheet" href="assets/styles/home.css">
 
</head>
<body>

    <nav class="navbar">
        <div class="logo"> PartyApp</div>
        
        <div class="menu-links">
            <a href="index.php?c=Home&a=index" class="menu-item">🏠 Inicio</a>
            
            <?php if(isset($menu_opciones)): ?>
                <?php foreach($menu_opciones as $opcion): ?>
                    <a href="<?= $opcion->url; ?>" class="menu-item">
                        <span><?= $opcion->icono; ?></span> 
                        <?= $opcion->titulo; ?>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="user-info">
            <?php if(isset($_SESSION['identity'])): ?>
                <span class="user-name">Hola, <?= $_SESSION['identity']->nombre; ?></span>
                <a href="index.php?c=User&a=logout" class="btn-logout">Log out</a>
            <?php else: ?>
                <a href="index.php?c=User&a=login" class="menu-item">Iniciar Sesión</a>
            <?php endif; ?>
        </div>
    </nav>

    <div class="container">
        <h1>¡Bienvenido al Panel Principal!</h1>
        <p>Selecciona una opción del menú de arriba para comenzar.</p>
    </div>

</body>
</html>