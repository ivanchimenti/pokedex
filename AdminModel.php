<?php

Class AdminModel{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getAdminByUsernamePassword($username,$password)
    {
        $stmt = $this->database->prepare("SELECT 1 FROM admin WHERE User = :username AND Password = :password");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener el resultado
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si se encontró un registro
        return $result !== false;
//        $result = $this->database->query( "SELECT 1 FROM admin WHERE User = '$username' AND Password = '$password'");
//
//        if($result->num_rows > 0) {
//            return true;
//        } else {
//            return false;
//        }
    }
}
