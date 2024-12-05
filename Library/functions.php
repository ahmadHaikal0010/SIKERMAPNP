<?php

include_once "Database/koneksi.php";

function register($data)
{
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO tb_user (namaUser, emailUser, username, password, role) VALUES (:namaUser, :emailUser, :username, :password, :role)");
    return $stmt->execute([
        ":namaUser" => $data["namaUser"],
        ":emailUser" => $data["emailUser"],
        ":username" => $data["username"],
        ":password" => password_hash($data["password"], PASSWORD_DEFAULT),
        ":role" => $data["role"]
    ]);
}

function updateUser($id, $data)
{
    global $pdo;
    $stmt = $pdo->prepare("UPDATE tb_user SET namaUser = :namaUser, emailUser = :emailUser, username = :username, password = :password, role = :role WHERE id = :id");
    return $stmt->execute([
        ":id" => $id,
        ":namaUser" => $data["namaUser"],
        ":emailUser" => $data["emailUser"],
        ":username" => $data["username"],
        ":password" => password_hash($data["password"], PASSWORD_DEFAULT),
        ":role" => $data["role"]
    ]);
}

function deleteUser($id)
{
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM tb_user WHERE id = :id");
    return $stmt->execute([":id" => $id]);
}
