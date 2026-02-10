<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta</title>
 <link rel='stylesheet' href='assets/styles/style.css'>  
</head>
<body>
    <div class="login-container">
        <div class="left-side">
            <div class="icon-party">🎈</div>
            <h1>Únete a la fiesta</h1>
            <p>Crea tu cuenta y empieza a gestionar tus eventos de forma profesional.</p>
        </div>
        <div class="right-side">
            <h2>Crear Cuenta</h2>
            <p class="subtitle">Rellena tus datos para registrarte</p>
            <form action="index.php?c=User&a=save" method="POST">
                <label for="nombre">Nombre Completo</label>
                <input type="text" name="nombre" placeholder="Tu nombre" required>
                <label for="email">Correo Electrónico</label>
                <input type="email" name="email" placeholder="ejemplo@correo.com" required>
                <label for="password">Contraseña</label>
                <input type="password" name="password" placeholder="Crea una contraseña segura" required>
                <button type="submit" class="btn-primary">Registrarse</button>
            </form>
            <div class="divider">¿Ya tienes cuenta?</div>
            <a href="index.php?c=User&a=login" class="btn-secondary">Iniciar Sesión</a>
        </div>
    </div>
</body>
</html>