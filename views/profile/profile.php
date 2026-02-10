<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Perfil - Party App</title>
    <link rel="stylesheet" href="assets/styles/home.css">
    <style>
¿        .profile-card {
            background: white;
            width: 400px;
            margin: 50px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            text-align: center;
        }

        .avatar-circle {
            width: 100px;
            height: 100px;
            background-color: #4a90e2;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            margin: 0 auto 20px;
            font-weight: bold;
        }

        .profile-info {
            text-align: left;
            margin-top: 20px;
        }

        .profile-label {
            font-size: 12px;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
            display: block;
        }

        .profile-value {
            font-size: 18px;
            color: #333;
            margin-bottom: 20px;
            font-weight: 500;
            border-bottom: 1px solid #eee;
            padding-bottom: 5px;
        }

        .badge-role {
            background-color: #e3f2fd;
            color: #1565c0;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: bold;
            display: inline-block;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="logo">PartyApp</div>
        
        <div class="menu-links">
            <a href="index.php?c=Home&a=index" class="menu-item">Inicio</a>
            <a href="javascript:history.back()" class="menu-item">⬅ Volver</a>
        </div>

        <div class="user-info">
            <span class="user-name">Hola, <?= $usuario->nombre; ?></span>
            <a href="index.php?c=User&a=logout" class="btn-logout">Salir</a>
        </div>
    </nav>

    <div class="profile-card">
        <div class="avatar-circle">
            <?= strtoupper(substr($usuario->nombre, 0, 1)); ?>
        </div>
        
        <h2><?= $usuario->nombre . ' ' . $usuario->apellido; ?></h2>
        <span class="badge-role"><?= strtoupper($usuario->rol); ?></span>

        <div class="profile-info">
            <span class="profile-label">Correo Electrónico</span>
            <div class="profile-value"><?= $usuario->email; ?></div>

            <span class="profile-label">Fecha de Registro</span>
            <div class="profile-value">---</div>
        </div>
        
        </div>

</body>
</html>