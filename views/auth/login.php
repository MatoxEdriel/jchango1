<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Party App</title>
    <link rel='stylesheet' href='assets/styles/style.css'>
</head>
<body>

    <div class="login-container">
        
        <div class="left-side">
            <div class="icon-party">🎉</div>
            <h1>¡Bienvenido!</h1>
            <p>Tu plataforma de confianza para organizar las mejores fiestas y eventos.</p>
        </div>

        <div class="right-side">
            <h2>Iniciar Sesión</h2>
            <p class="subtitle">Accede a tu cuenta para comenzar</p>

            <?php if(isset($_SESSION['login_error'])): ?>
                <div class="alert-error">
                    <?= $_SESSION['login_error']; ?>
                </div>
                <?php unset($_SESSION['login_error']); ?>
            <?php endif; ?>

            <form action="index.php?c=User&a=authenticate" method="POST">
                
                <label for="email">Correo Electrónico</label>
                <input type="email" name="email" placeholder="ejemplo@correo.com" required>

                <label for="password">Contraseña</label>
                <input type="password" name="password" placeholder="Ingresa tu contraseña" required>

                <button type="submit" class="btn-primary">Iniciar Sesión</button>
                
            </form>

            <div class="divider">o</div>

         <a href="index.php?c=User&a=register" class="btn-secondary">Crear nueva cuenta</a>        </div>

    </div>

</body>
</html>