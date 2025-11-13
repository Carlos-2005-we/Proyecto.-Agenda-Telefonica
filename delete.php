<?php
require_once 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = (int) $_POST['id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM contactos WHERE id = ?");
        $stmt->execute([$id]);

        if ($stmt->rowCount() > 0) {
            $_SESSION['mensaje'] = 'Contacto eliminado correctamente.';
        } else {
            $_SESSION['mensaje'] = 'No se encontró el contacto o ya fue eliminado.';
        }
    } catch (PDOException $e) {
        error_log('Error al eliminar contacto: ' . $e->getMessage());
        $_SESSION['mensaje'] = 'Ocurrió un error al eliminar el contacto.';
    }

    header('Location: index.php');
    exit;
} else {
    $_SESSION['mensaje'] = 'Acción no permitida.';
    header('Location: index.php');
    exit;
}
?>
