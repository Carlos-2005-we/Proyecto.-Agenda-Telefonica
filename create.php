<?php
require_once 'db.php';
require_once 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $telefono = trim($_POST['telefono']);
    $email = trim($_POST['email']);
    $direccion = trim($_POST['direccion']);
    $notas = trim($_POST['notas']);

    if ($nombre && $telefono) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($email)) {
            $error = 'El email no tiene un formato válido.';
        } elseif (!preg_match('/^[0-9+\s-]+$/', $telefono)) {
            $error = 'El teléfono solo puede contener números, espacios o símbolos + -';
        } else {
            $stmt = $pdo->prepare("INSERT INTO contactos (nombre, apellido, telefono, email, direccion, notas)
                                   VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$nombre, $apellido, $telefono, $email, $direccion, $notas]);
            header('Location: index.php?mensaje=Contacto agregado correctamente');
            exit;
        }
    } else {
        $error = 'Los campos Nombre y Teléfono son obligatorios.';
    }
}
?>

<div class="container mt-4">
    <h2>Agregar nuevo contacto</h2>

    <?php if (!empty($error)): ?>
        <div class='alert alert-danger'><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method='post' class='row g-3'>
        <div class='col-md-6'>
            <label class='form-label'>Nombre *</label>
            <input type='text' name='nombre' class='form-control' required>
        </div>
        <div class='col-md-6'>
            <label class='form-label'>Apellido</label>
            <input type='text' name='apellido' class='form-control'>
        </div>
        <div class='col-md-6'>
            <label class='form-label'>Teléfono *</label>
            <input type='text' name='telefono' class='form-control' required>
        </div>
        <div class='col-md-6'>
            <label class='form-label'>Email</label>
            <input type='email' name='email' class='form-control'>
        </div>
        <div class='col-md-12'>
            <label class='form-label'>Dirección</label>
            <textarea name='direccion' class='form-control'></textarea>
        </div>
        <div class='col-md-12'>
            <label class='form-label'>Notas</label>
            <textarea name='notas' class='form-control'></textarea>
        </div>
        <div class='col-12'>
            <button type='submit' class='btn btn-success'>Guardar</button>
            <a href='index.php' class='btn btn-secondary'>Cancelar</a>
        </div>
    </form>
</div>

<?php require_once 'includes/footer.php'; ?>
