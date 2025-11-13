<?php
require_once 'db.php';
require_once 'includes/header.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = (int) $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM contactos WHERE id = ?");
$stmt->execute([$id]);
$contacto = $stmt->fetch();

if (!$contacto) {
    exit('<div class="alert alert-danger">Contacto no encontrado.</div>');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $telefono = trim($_POST['telefono']);
    $email = trim($_POST['email']);
    $direccion = trim($_POST['direccion']);
    $notas = trim($_POST['notas']);

    if ($nombre && $telefono) {
        $stmt = $pdo->prepare("UPDATE contactos SET nombre=?, apellido=?, telefono=?, email=?, direccion=?, notas=? WHERE id=?");
        $stmt->execute([$nombre, $apellido, $telefono, $email, $direccion, $notas, $id]);
        header('Location: index.php?mensaje=Contacto actualizado correctamente');
        exit;
    } else {
        $error = 'Los campos Nombre y Teléfono son obligatorios.';
    }
}
?>

<div class="container mt-4">
    <h2>Editar contacto</h2>
    <?php if (!empty($error)): ?>
        <div class='alert alert-danger'><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method='post' class='row g-3'>
        <div class='col-md-6'>
            <label class='form-label'>Nombre *</label>
            <input type='text' name='nombre' class='form-control' value='<?= htmlspecialchars($contacto['nombre']) ?>' required>
        </div>
        <div class='col-md-6'>
            <label class='form-label'>Apellido</label>
            <input type='text' name='apellido' class='form-control' value='<?= htmlspecialchars($contacto['apellido']) ?>'>
        </div>
        <div class='col-md-6'>
            <label class='form-label'>Teléfono *</label>
            <input type='text' name='telefono' class='form-control' value='<?= htmlspecialchars($contacto['telefono']) ?>' required>
        </div>
        <div class='col-md-6'>
            <label class='form-label'>Email</label>
            <input type='email' name='email' class='form-control' value='<?= htmlspecialchars($contacto['email']) ?>'>
        </div>
        <div class='col-md-12'>
            <label class='form-label'>Dirección</label>
            <textarea name='direccion' class='form-control'><?= htmlspecialchars($contacto['direccion']) ?></textarea>
        </div>
        <div class='col-md-12'>
            <label class='form-label'>Notas</label>
            <textarea name='notas' class='form-control'><?= htmlspecialchars($contacto['notas']) ?></textarea>
        </div>
        <div class='col-12'>
            <button type='submit' class='btn btn-primary'>Actualizar</button>
            <a href='index.php' class='btn btn-secondary'>Cancelar</a>
        </div>
    </form>
</div>

<?php require_once 'includes/footer.php'; ?>
