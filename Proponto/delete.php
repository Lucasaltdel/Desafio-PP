<?php
include('functions.php');

// Verifica se o ID do evento foi passado na URL
if (isset($_GET['id'])) {
    deleteEvent($_GET['id']);
    header('Location: index.php');  // Redireciona de volta para a lista de eventos
    exit;
}
?>

