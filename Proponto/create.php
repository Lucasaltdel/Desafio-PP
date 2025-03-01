<?php
include('functions.php');

// Inicializa a variável $event como nula
$event = null;

// Se o ID do evento for passado na URL, busca o evento para editar
if (isset($_GET['id'])) {
    $event = getEvents(['id' => $_GET['id']])[0];  // Obtém o evento pelo ID
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura os dados do formulário
    $data = [
        'type' => $_POST['type'],
        'name' => $_POST['name'],
        'description' => $_POST['description'],
        'address' => $_POST['address'],
        'map_link' => $_POST['map_link'],
        'start_date' => $_POST['start_date'],
        'price' => $_POST['price']
    ];

    if (isset($_POST['id'])) {
        // Se o ID estiver presente, é uma atualização
        $data['id'] = $_POST['id'];
        updateEvent($data);
    } else {
        // Se não, é uma criação
        createEvent($data);
    }

    // Redireciona para a página inicial
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar/Editar Evento</title>
</head>
<body>
    <h1><?= isset($event) ? 'Editar Evento' : 'Adicionar Novo Evento' ?></h1>

    <form method="POST">
        <input type="hidden" name="id" value="<?= $event['id'] ?? '' ?>">

        <label for="type">Tipo</label>
        <select name="type" required>
            <option value="social" <?= $event['type'] == 'social' ? 'selected' : '' ?>>Social</option>
            <option value="cultural" <?= $event['type'] == 'cultural' ? 'selected' : '' ?>>Cultural</option>
            <option value="esportivo" <?= $event['type'] == 'esportivo' ? 'selected' : '' ?>>Esportivo</option>
            <option value="corporativo" <?= $event['type'] == 'corporativo' ? 'selected' : '' ?>>Corporativo</option>
            <option value="religioso" <?= $event['type'] == 'religioso' ? 'selected' : '' ?>>Religioso</option>
            <option value="entretenimento" <?= $event['type'] == 'entretenimento' ? 'selected' : '' ?>>Entretenimento</option>
            <option value="outros" <?= $event['type'] == 'outros' ? 'selected' : '' ?>>Outros</option>
        </select>

        <label for="name">Nome</label>
        <input type="text" name="name" value="<?= $event['name'] ?? '' ?>" required>

        <label for="description">Descrição</label>
        <textarea name="description"><?= $event['description'] ?? '' ?></textarea>

        <label for="address">Endereço</label>
        <input type="text"
