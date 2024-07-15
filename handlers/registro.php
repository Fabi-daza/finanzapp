<?php 
    include("../db.php");

    $name = $_POST['name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password1 = md5($_POST['password']);
    $password2 = md5($_POST['password2']);


    try {
        if(!$name || !$last_name || !$email || !$password1 || !$password2){
            echo json_encode(['success' => false, 'message' => 'Todos los campos son requeridos']);
            exit();
        }
        
        if($password1 == $password2){
            $consulta = "INSERT INTO users (name, last_name, email, password) VALUES (:name, :last_name, :email, :password)";
            $stmt = $conn->prepare($consulta);
            $stmt -> bindParam(':name', $name);
            $stmt -> bindParam(':last_name', $last_name);
            $stmt -> bindParam(':email', $email);
            $stmt -> bindParam(':password', $password1);
        }else{
            echo json_encode(['success' => false, 'message' => 'Las contraseñas no coinciden']);
            exit();
        }

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Registro exitoso.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error en el registro.']);
        }
        
        ;

    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Connection failed: ' . $e->getMessage()]);
    }