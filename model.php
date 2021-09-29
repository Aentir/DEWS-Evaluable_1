<?php

    class Connection {

        private $server = "localhost";
        private $user = "root";
        private $password = "";
        private $dbname = "florida";
        
        public function __construct()
        {
            try {
                $this->db = new PDO("mysql:host=$this->server;dbname=$this->dbname", $this->user, $this->password);
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    //echo "He conectado con éxito" . "<br>";
            } catch (PDOException $e){
                echo "Error: " . $e->getMessage();
            }
            return $this->db;
        }
        public function getInfo($value = null)
        {
            if ($value) {
      
                $sql = "SELECT alum_dni, alum_nombre, alum_apellido1, alum_apellido2, alum_nota FROM t_alumnos WHERE alum_nombre = ?";
                $result = $this->db->prepare($sql);
                $result->execute(array($value));
                    $output = "";
                foreach ($result->fetchAll(PDO::FETCH_ASSOC) as $row) {
                    $output .= "<td>" . $row["alum_nombre"] . "</td>";
                    $output .= "<td>" . $row["alum_dni"] . "</td>";
                    $output .= "<td>" . $row["alum_apellido1"] . "</td>";
                    $output .= "<td>" . $row["alum_apellido2"] . "</td>";
                    if($row["alum_nota"] < 4) {
                        $output .= "<td style='background-color:salmon'>" . $row["alum_nota"] . "</td>";
                    } else {
                        $output .= "<td>" . $row["alum_nota"] . "</td>";
                    }
                    $output .= "</tr>";
                }
    
            } else {
                    $query = "SELECT alum_dni, alum_nombre, alum_apellido1, alum_apellido2, alum_nota FROM t_alumnos";
                    $result = $this->db->prepare($query);
                    $result->execute(array());
                    $output = "";
                    foreach ($result->fetchAll(PDO::FETCH_ASSOC) as $row) {
                        $output .= "<tr>";
                        $output .= "<td>" . $row["alum_nombre"] . "</td>";
                        $output .= "<td>" . $row["alum_dni"] . "</td>";
                        $output .= "<td>" . $row["alum_apellido1"] . "</td>";
                        $output .= "<td>" . $row["alum_apellido2"] . "</td>";
                        if($row["alum_nota"] < 4) {
                            $output .= "<td style='background-color:salmon'>" . $row["alum_nota"] . "</td>";
                        } else {
                            $output .= "<td>" . $row["alum_nota"] . "</td>";
                        }
                        $output .= "</tr>";
                    }
                
            }
                $this->db = null;
                return $output;
        }
}
?>