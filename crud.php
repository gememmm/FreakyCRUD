<?php
require 'koneksi.php';

function getMakhluk(){
    global $conn;
    $result = $conn->query("SELECT * FROM makhluk");
    $freaky = [];
    if ($result->num_rows > 0){
        while ($row = $result->fetch_assoc()){
            $freaky[] = $row;
        }
    }
    return $freaky;
}

function createMakhluk($nama, $jumlah){
    global $conn;
    $stmt = $conn->prepare("INSERT INTO makhluk (nama, jumlah) VALUES (?, ?)");
    $stmt->bind_param("ss", $nama, $jumlah);
    $stmt->execute();
    $id = $stmt->insert_id;
    $stmt->close();
    return $id;
}

function deleteMakhluk($id){
    global $conn;
    $stmt = $conn->prepare("DELETE FROM makhluk WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

function updateMakhluk($id, $nama, $jumlah){
    global $conn;
    $stmt = $conn->prepare("UPDATE makhluk SET nama = ?, jumlah = ? WHERE id = ?");
    $stmt->bind_param("ssi", $nama, $jumlah, $id);
    $stmt->execute();
    $stmt->close();
}

function getMakhlukById($id){
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM makhluk WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    return $row;
}
?>

