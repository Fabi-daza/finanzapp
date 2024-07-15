<?php 
include("../db.php");

try {
    $consulta = "SELECT * FROM categorias";
    $stmt = $conn->query($consulta);
    $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $conn = null;

    header('Content-type:application/json');
    echo json_encode($categorias);

} catch (PDOException $e) {
    echo "Error en la consulta: " . $e->getMessage();
}

?>