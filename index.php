<?php
require_once 'db.php';
session_start();

// Mensaje si existe
if (!empty($_SESSION['mensaje'])) {
    echo '<div class="alert alert-info text-center">'.htmlspecialchars($_SESSION['mensaje']).'</div>';
    unset($_SESSION['mensaje']);
}

// Obtener todos los contactos
$stmt = $pdo->query("SELECT * FROM contactos ORDER BY id DESC");
$contactos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include 'includes/header.php'; ?>

<div class="container mt-4">
    <h2 class="text-center mb-4">Agenda de Contactos</h2>

    <div class="text-end mb-3">
        <a href="create.php" class="btn btn-success">+ Nuevo Contacto</a>
    </div>

    <table class="table table-bordered table-striped text-center">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($contactos)): ?>
                <?php foreach ($contactos as $contacto): ?>
                    <tr>
                        <td><?= htmlspecialchars($contacto['id'] ?? '') ?></td>
                        <td><?= htmlspecialchars($contacto['nombre'] ?? '') ?></td>
                        <td><?= htmlspecialchars($contacto['telefono'] ?? '') ?></td>
                        <td><?= htmlspecialchars($contacto['email'] ?? '') ?></td>
                        <td>
                            <a href="view.php?id=<?= $contacto['id'] ?>" class="btn btn-info btn-sm">Ver</a>
                            <a href="edit.php?id=<?= $contacto['id'] ?>" class="btn btn-warning btn-sm">Editar</a>

                            <form action="delete.php" method="POST" style="display:inline;" 
                                  onsubmit="return confirm('¿Seguro que deseas eliminar este contacto?');">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($contacto['id']) ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">No hay contactos registrados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>
