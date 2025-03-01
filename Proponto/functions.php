<?php
include('config.php');  // Inclusão da conexão com o banco de dados

// Função para criar um evento
function createEvent($data) {
    $conexao = getConnection();

    $sql = "INSERT INTO events (type, name, description, address, map_link, start_date, price) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conexao->prepare($sql);
    if ($stmt === false) {
        die('Erro na preparação da consulta: ' . $conexao->error);
    }

    $stmt->bind_param('sssssss', $data['type'], $data['name'], $data['description'], $data['address'], $data['map_link'], $data['start_date'], $data['price']);
    
    return $stmt->execute();  // Retorna true se a execução for bem-sucedida
}

// Função para atualizar um evento
function updateEvent($data) {
    $conexao = getConnection();

    $sql = "UPDATE events SET type = ?, name = ?, description = ?, address = ?, map_link = ?, start_date = ?, price = ? WHERE id = ?";
    
    $stmt = $conexao->prepare($sql);
    if ($stmt === false) {
        die('Erro na preparação da consulta: ' . $conexao->error);
    }

    $stmt->bind_param('sssssssi', $data['type'], $data['name'], $data['description'], $data['address'], $data['map_link'], $data['start_date'], $data['price'], $data['id']);
    
    return $stmt->execute();  // Retorna true se a execução for bem-sucedida
}

// Função para buscar eventos
function getEvents($filters = []) {
    $conexao = getConnection();

    $sql = "SELECT * FROM events WHERE 1";  // A cláusula WHERE 1 sempre é verdadeira

    // Adiciona filtros à consulta se fornecidos
    if (!empty($filters['id'])) {
        $sql .= " AND id = ?";
    }
    if (!empty($filters['type'])) {
        $sql .= " AND type = ?";
    }
    if (!empty($filters['name'])) {
        $sql .= " AND name LIKE ?";
    }

    $stmt = $conexao->prepare($sql);
    if ($stmt === false) {
        die('Erro na preparação da consulta: ' . $conexao->error);
    }

    // Adiciona parâmetros ao prepared statement
    $types = '';
    $params = [];
    if (!empty($filters['id'])) {
        $types .= 'i';
        $params[] = $filters['id'];
    }
    if (!empty($filters['type'])) {
        $types .= 's';
        $params[] = $filters['type'];
    }
    if (!empty($filters['name'])) {
        $types .= 's';
        $params[] = '%' . $filters['name'] . '%';
    }

    if ($types) {
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    
    return $result->fetch_all(MYSQLI_ASSOC);  // Retorna os eventos como um array associativo
}

// Função para excluir um evento
function deleteEvent($id) {
    $conexao = getConnection();

    $sql = "DELETE FROM events WHERE id = ?";
    
    $stmt = $conexao->prepare($sql);
    if ($stmt === false) {
        die('Erro na preparação da consulta: ' . $conexao->error);
    }

    $stmt->bind_param('i', $id);
    
    return $stmt->execute();  // Retorna true se a execução for bem-sucedida
}
?>
