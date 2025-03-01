<?php
include('functions.php');

// Recupera todos os eventos
$events = getEvents([]);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Gerenciador de Eventos</title>
</head>
<body>
    <h1>Lista de Eventos</h1>
    <a href="create_edit.php">Adicionar Evento</a>

    <table border="1">
        <thead>
            <tr>
                <th>Tipo</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Data</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($events as $event): ?>
                <tr>
                    <td><?= $event['type'] ?></td>
                    <td><?= $event['name'] ?></td>
                    <td><?= $event['description'] ?></td>
                    <td><?= $event['start_date'] ?></td>
                    <td>
                        <a href="create_edit.php?id=<?= $event['id'] ?>">Editar</a>
                        <a href="delete.php?id=<?= $event['id'] ?>">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <script src="script.js"></script>
</body>
</html>

