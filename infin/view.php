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
$c = $stmt->fetch();

if (!$c) {
    exit('<div class="alert alert-danger">Contacto no encontrado.</div>');
}
?>

<div class="container mt-4">
    <h2>Detalles del contacto</h2>
    <table class="table table-bordered">
        <tr><th>ID</th><td><?= htmlspecialchars($c['id']) ?></td></tr>
        <tr><th>Nombre</th><td><?= htmlspecialchars($c['nombre']) ?></td></tr>
        <tr><th>Apellido</th><td><?= htmlspecialchars($c['apellido']) ?></td></tr>
        <tr><th>Teléfono</th><td><?= htmlspecialchars($c['telefono']) ?></td></tr>
        <tr><th>Email</th><td><?= htmlspecialchars($c['email']) ?></td></tr>
        <tr><th>Dirección</th><td><?= htmlspecialchars($c['direccion']) ?></td></tr>
        <tr><th>Notas</th><td><?= htmlspecialchars($c['notas']) ?></td></tr>
    </table>
    <a href="index.php" class="btn btn-secondary">Volver</a>
</div>

<?php require_once 'includes/footer.php'; ?>
