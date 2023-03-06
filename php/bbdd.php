<?php
    //PARA QUE MUESTRE ERRORES DETALLADO
    ini_set('display_errors', '1');

    //CONEXION
    function connectBBDD() {
        $conexion = oci_connect('potitos', 'Almi12345', '192.168.0.104/ORCLCDB', 'AL32UTF8');
        if (!$conexion) {
            $e = oci_error();
            trigger_error(htmlentities($e['message']), E_USER_ERROR);
        }
        return $conexion;
    }

    //LOGIN--------------------------------------
    function get_login_user($id_proveedor, $NIF, $password) {
        $conexion = connectBBDD();

        //SENTENCIA
        $sql = "SELECT id_proveedor, nombre, NIF FROM proveedor WHERE id_proveedor = :id_proveedor AND NIF = :NIF AND password = :password";
    
        //GUARDAMOS LOS DOS PARAMETROS QUE RECIBE PARA LA CONEXION Y PARA LA SENTENCIA SQL
        $sentencia = oci_parse($conexion, $sql);
    
        if (!$sentencia) {
            $e = oci_error($conexion);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            exit;
        }

        //ASIGNAR LOS VALORES A LOS PARAMETROS DE LA CONSULTA
        oci_bind_by_name($sentencia, ':id_proveedor', $id_proveedor);
        oci_bind_by_name($sentencia, ':NIF', $NIF);
        oci_bind_by_name($sentencia, ':password', $password);
    
        //EJECUTE LA SENTENCIA
        $ejecutar = oci_execute($sentencia);
        VAR_DUMP($ejecutar);
        //SI DA ERROR AL EJECUTAR MANDE UN MENSAJE DE ERROR
        if (!$ejecutar) {
            $e = oci_error($sentencia);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            exit;
        }
        
        //EN ESTA LINEA SE OBTIENEN LOS DATOS DE LA PRIMERA FILA Y SE ALMACENA EN EL ARRAY DATA_USER.
        $data_user = oci_fetch_assoc($sentencia);
    
        //CERRAR CONEXION
        oci_free_statement($sentencia);
        oci_close($conexion);
    
        return $data_user;
    }

    function validar_login_usuario($nif, $pass) {
        $conexion = connectBBDD();
    
        $sql = "SELECT id_proveedor, nombre, NIF FROM proveedor WHERE NIF = :nif AND password = :pass";
    
        $sentencia = oci_parse($conexion, $sql);
    
        if (!$sentencia) {
            $e = oci_error($conexion);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            exit;
        }
    
        oci_bind_by_name($sentencia, ':nif', $nif);
        oci_bind_by_name($sentencia, ':pass', $pass);
    
        $ejecutar = oci_execute($sentencia);
    
        if (!$ejecutar) {
            $e = oci_error($sentencia);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            exit;
        }
    
        // CREAMOS UN ARRAY PARA ALMACENAR LOS RESULTADOS
        $data_user = [];
    
        // INICIAMOS UN BUCLE WHILE QUE RECORRE TODAS LAS FILAS DE RESULTADO DEVUELTAS POR LA CONSULTA SQL.
        while ($row = oci_fetch_array($sentencia, OCI_ASSOC+OCI_RETURN_NULLS)) {
            $data_user['id_proveedor'] = $row['ID_PROVEEDOR'];
            $data_user['nombre'] = $row['NOMBRE'];
            $data_user['NIF'] = $row['NIF'];
        }
    
        // CERRAMOS LA CONEXIÓN
        oci_free_statement($sentencia);
        oci_close($conexion);
    
        return $data_user;
    }
    

    //FIN LOGIN--------------------------------------

    //VISUALIZAR DATOS DE EDITAR PERFIL--------------------------------------
    function get_data_user($id_proveedor) {

        $conexion = connectBBDD();
      
        $sql = "SELECT nombre, email, telefono, direccion, poblacion, pais FROM proveedor WHERE id_proveedor = :id_proveedor";
      
        $sentencia = oci_parse($conexion, $sql);
      
        if (!$sentencia) {
            $e = oci_error($conexion);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            exit;
        }
      
        oci_bind_by_name($sentencia, ':id_proveedor', $id_proveedor);
    
      
        $ejecutar = oci_execute($sentencia);
      
        if (!$ejecutar) {
            $e = oci_error($sentencia);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            exit;
        }
      
        $array_to_return = [
            'nombre' => '',
            'email' => '',
            'telefono' => '',
            'direccion' => '',
            'poblacion' => '',
            'pais' => ''
        ];
      
        while ($row = oci_fetch_array($sentencia, OCI_ASSOC+OCI_RETURN_NULLS)) {
            $array_to_return['nombre'] = $row['NOMBRE'];
            $array_to_return['email'] = $row['EMAIL'];
            $array_to_return['telefono'] = $row['TELEFONO'];
            $array_to_return['direccion'] = $row['DIRECCION'];
            $array_to_return['poblacion'] = $row['POBLACION'];
            $array_to_return['pais'] = $row['PAIS'];
        }

        //CERRAR CONEXION 
        oci_free_statement($sentencia);
        oci_close($conexion);
      
        return $array_to_return;
    }
    
    //FIN VISUALIZAR DATOS PERFIL--------------------------------------

    //MODIFICAR PROVEEDOR--------------------------------------
    function modify_user($id_proveedor, $name, $password, $email, $telefono, $direccion, $poblacion, $pais) {
        
        $conexion = connectBBDD();
        if($password!=""){
            $sql = "UPDATE proveedor SET nombre = :nombre, password = :password, email = :email, telefono = :telefono, direccion = :direccion, poblacion = :poblacion, pais = :pais WHERE id_proveedor = :id_proveedor";
        } else{
            $sql = "UPDATE proveedor SET nombre = :nombre, email = :email, telefono = :telefono, direccion = :direccion, poblacion = :poblacion, pais = :pais WHERE id_proveedor = :id_proveedor";

        }
        
        $sentencia = oci_parse($conexion, $sql);
    
        if (!$sentencia) {
            $e = oci_error($conexion);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            exit;
        }
        
        oci_bind_by_name($sentencia, ':nombre', $name);

        if($password!=""){
            oci_bind_by_name($sentencia, ':password', $password);
        }
        
        oci_bind_by_name($sentencia, ':email', $email);
        oci_bind_by_name($sentencia, ':telefono', $telefono);
        oci_bind_by_name($sentencia, ':direccion', $direccion);
        oci_bind_by_name($sentencia, ':poblacion', $poblacion);
        oci_bind_by_name($sentencia, ':pais', $pais);
        oci_bind_by_name($sentencia, ':id_proveedor', $id_proveedor);
    
        $data_to_return = false;
    
        $ejecutar = oci_execute($sentencia);
    
        if(!$ejecutar) {
            $e = oci_error($sentencia);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            exit;
        } else {
            $data_to_return = true;
        }

        //CERRAR CONEXION
        oci_free_statement($sentencia);
        oci_close($conexion);
    
        return $data_to_return;
    }    
    //FIN MODIFICAR PROVEEDOR--------------------------------------

    //------------------------------------------------------------------------------------------------------------------------------------------------------------------
    //MOSTRAR TODOS LOS COMPONENTES DEL PROVEEDOR--------------------------------------
    function get_componentes($id_proveedor) {

        $conexion = connectBBDD();
        
        $sql = "SELECT componente.id_componente, componente.nombre, precio, stock, imagen, tipo_componente.nombre AS nombre_componente FROM componente  
        INNER JOIN tipo_componente ON tipo_componente.id_tipo_componente = componente.id_tipo_componente 
        INNER JOIN proveedor_componente ON componente.id_componente = proveedor_componente.id_componente
        WHERE proveedor_componente.id_proveedor = :id_proveedor";
        
        $sentencia = oci_parse($conexion, $sql);
        
        if (!$sentencia) {
            $e = oci_error($conexion);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            exit;
        }

        oci_bind_by_name($sentencia, ':id_proveedor', $id_proveedor);
        
        $ejecutar = oci_execute($sentencia);
        
        if (!$ejecutar) {
            $e = oci_error($sentencia);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            exit;
        }
        
        $array_to_return = [];
        
        while ($row = oci_fetch_array($sentencia, OCI_ASSOC+OCI_RETURN_NULLS)) {
            $array_to_return[] = $row;
        }
        
        //CERRAR CONEXION
        oci_free_statement($sentencia);
        oci_close($conexion);
        
        return $array_to_return;        
    }
    //FIN MOSTRAR TODOS LOS COMPONENTES DEL PROVEEDOR--------------------------------------

    //REGISTRAR UN NUEVO COMPONENTES AL PROVEEDOR ASOCIADO--------------------------------------
    function registrar_componente($nombre, $precio, $stock, $id_tipo_componente, $imagen, $id_proveedor) {
        // Conexión a la base de datos
        $conexion = connectBBDD();
        
        if($imagen!=""){
            $sql = "INSERT INTO componente(nombre, precio, stock, imagen, id_tipo_componente) VALUES (:nombre, :precio, :stock, :imagen, :id_tipo_componente) RETURNING id_componente INTO :id";
        } else {
            $sql = "INSERT INTO componente(nombre, precio, stock, id_tipo_componente) VALUES (:nombre, :precio, :stock, :id_tipo_componente) RETURNING id_componente INTO :id";
        }

        $stmt = oci_parse($conexion, $sql);
        
        //ASIGNAR LOS VALORES A LOS PARAMETROS DE LA CONSULTA
        oci_bind_by_name($stmt, ':nombre', $nombre);
        oci_bind_by_name($stmt, ':precio', $precio);
        oci_bind_by_name($stmt, ':stock', $stock);
        oci_bind_by_name($stmt, ':id_tipo_componente', $id_tipo_componente);
        oci_bind_by_name($stmt, ':id', $id_componente, 10);

        if($imagen!=""){
            oci_bind_by_name($stmt, ':imagen', $imagen);
        }
        
        //EJECUTAR LA CONSULTA
        $result1 = oci_execute($stmt, OCI_COMMIT_ON_SUCCESS);
        
        //Si la sentencia se ejecuto correctamente que proceda a insertar en proveedor_componente para relacionarlo con el proveedor iniciado
        if ($result1) {

            $sql2="INSERT INTO proveedor_componente(id_proveedor, id_componente, fecha) VALUES (:id_proveedor, :id_componente, CURRENT_DATE)";

            $stmt2 = oci_parse($conexion, $sql2);

            oci_bind_by_name($stmt2, ':id_componente', $id_componente);
            oci_bind_by_name($stmt2, ':id_proveedor', $id_proveedor);

            $result2 = oci_execute($stmt2, OCI_COMMIT_ON_SUCCESS);
            //Si la sentencia se ejecuto correctamente devuelve un true sino false
            if($result2){
                return true;
            } else{
                return false;
            }

        } else {
            return false;
        }
    }
    //FIN REGISTRAR UN NUEVO COMPONENTES AL PROVEEDOR ASOCIADO--------------------------------------

    //TOMAR EL TIPO DE COMPONENTE--------------------------------------
    function get_tipo_componente() {

        $conexion = connectBBDD();
    
        $sql = "SELECT id_tipo_componente, nombre FROM tipo_componente ";
    
        $sentencia = oci_parse($conexion, $sql);
                      
        $ejecutar = oci_execute($sentencia);  

        $data_to_return = [];

        while ($row = oci_fetch_array($sentencia, OCI_ASSOC+OCI_RETURN_NULLS)) {
            $data_to_return[] = $row;
        }
            
        //CERRAR SESION
        oci_free_statement($sentencia);
        oci_close($conexion);
    
        return $data_to_return;
    }
    //FIN TOMAR EL TIPO DE COMPONENTE--------------------------------------

    //OBTENER LOS DATOS DE UN COMPONENTE EN ESPECIFICO--------------------------------------
    function get_componente($id_componente, $id_proveedor) {
        
        $conexion = connectBBDD();
        
        $sql = "SELECT componente.id_componente, componente.nombre, precio, stock, componente.id_tipo_componente, tipo_componente.nombre AS nombre_componente FROM componente  
        INNER JOIN tipo_componente ON tipo_componente.id_tipo_componente = componente.id_tipo_componente 
        INNER JOIN proveedor_componente ON componente.id_componente = proveedor_componente.id_componente
        WHERE proveedor_componente.id_proveedor = :id_proveedor AND componente.id_componente=:id_componente ";
        
        $sentencia = oci_parse($conexion, $sql);

        oci_bind_by_name($sentencia, ':id_proveedor', $id_proveedor);
        oci_bind_by_name($sentencia, ':id_componente', $id_componente);

        
        if (!$sentencia) {
            $e = oci_error($conexion);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            exit;
        }
        
        $ejecutar = oci_execute($sentencia);
        
        if (!$ejecutar) {
            $e = oci_error($sentencia);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            exit;
        }
        
        $array_to_return = [];
        
        $array_to_return = oci_fetch_array($sentencia, OCI_ASSOC+OCI_RETURN_NULLS);
        
        //CERRAR CONEXION
        oci_free_statement($sentencia);
        oci_close($conexion);

        return $array_to_return;        
    }
    //FIN DE OBTENER LOS DATOS DE UN COMPONENTE EN ESPECIFICO--------------------------------------

    //ACTUALIZAR PRODUCTO SIN FOTO
    function update_componente($nombre, $precio, $stock, $id_tipo_componente, $id_componente) {
        // Validar que los datos sean válidos
        if(empty($nombre) || !is_numeric($precio) || !is_numeric($stock) || !is_numeric($id_tipo_componente) || !is_numeric($id_componente)) {
            return false;
        }
    
        // Reemplazar los puntos por coma en el precio
        $precio = str_replace(".", ",", $precio);
    
        $conexion = connectBBDD();
    
        $sql = "UPDATE componente SET nombre = :nombre, precio = :precio, stock = :stock, id_tipo_componente = :id_tipo_componente WHERE id_componente = :id_componente";
    
        $sentencia = oci_parse($conexion, $sql);
    
        oci_bind_by_name($sentencia, ':nombre', $nombre);
        oci_bind_by_name($sentencia, ':precio', $precio);
        oci_bind_by_name($sentencia, ':stock', $stock);
        oci_bind_by_name($sentencia, ':id_tipo_componente', $id_tipo_componente);
        oci_bind_by_name($sentencia, ':id_componente', $id_componente);
    
        
        $ejecutar = oci_execute($sentencia);

        oci_free_statement($sentencia);
        oci_close($conexion);
    
        return $ejecutar;
    }

    function update_componente_con_foto($nombre, $precio, $stock, $id_tipo_componente, $image, $id_componente) {   
        $conexion = connectBBDD();

    
        $sql = "UPDATE componente SET nombre = :nombre, precio = :precio, imagen = :image, stock = :stock, id_tipo_componente = :id_tipo_componente WHERE id_componente = :id_componente";
    
        $sentencia = oci_parse($conexion, $sql);
    
        oci_bind_by_name($sentencia, ':nombre', $nombre);
        oci_bind_by_name($sentencia, ':precio', $precio);
        oci_bind_by_name($sentencia, ':image', $image);
        oci_bind_by_name($sentencia, ':stock', $stock);
        oci_bind_by_name($sentencia, ':id_tipo_componente', $id_tipo_componente);
        oci_bind_by_name($sentencia, ':id_componente', $id_componente);
    
        $ejecutar = oci_execute($sentencia); 
    
        oci_free_statement($sentencia);
        oci_close($conexion);
    
        return $ejecutar;
    }

    // BORRAR UN COMPONENTE EN ESPECIFICO--------------------------------------
    function delete_componente($id_componente){
        $conexion = connectBBDD();
        $success = false;
        $transaction = false;
        try {
            //Comenzar una transicion al haber 3 select por la estructura de nuestra base
            $transaction = oci_parse($conexion, 'BEGIN TRANSACTION;');
    
            //Borrar de la tabla proveedor_componente
            $sql1="DELETE FROM proveedor_componente WHERE id_componente = :id_componente";
            $stmt1 = oci_parse($conexion, $sql1);
            oci_bind_by_name($stmt1, ':id_componente', $id_componente);
            oci_execute($stmt1);
    
            //Borrar de la tabla componente_cliente
            $sql2="DELETE FROM componente_cliente WHERE id_componente = :id_componente";
            $stmt2 = oci_parse($conexion, $sql2);
            oci_bind_by_name($stmt2, ':id_componente', $id_componente);
            oci_execute($stmt2);
    
            //Borrar de la tabla componente
            $sql3="DELETE FROM componente WHERE id_componente= :id_componente";
            $stmt3 = oci_parse($conexion, $sql3);
            oci_bind_by_name($stmt3, ':id_componente', $id_componente);
            oci_execute($stmt3);
    
            $success = true;
            oci_parse($conexion, 'COMMIT;');
        } catch (Exception $e) {
            if ($transaction) {
                oci_parse($conexion, 'ROLLBACK;');
            }
            $success = false;
        }
        return $success;
    }
    //FIN BORRAR UN COMPONENTE EN ESPECIFICO--------------------------------------

    //DAR ALTA  UN PROVEEDOR--------------------------------------

    function registrar_proveedor($nif, $password, $name, $email, $telefono, $direccion, $poblacion, $pais) {
        
        $conexion = connectBBDD();

        $sql = "INSERT INTO proveedor (nif, password, nombre, email, telefono, direccion, poblacion, pais) VALUES (:nif, :password, :nombre, :email, :telefono, :direccion, :poblacion, :pais)";
        
        $sentencia = oci_parse($conexion, $sql);
    
        if (!$sentencia) {
            $e = oci_error($conexion);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            exit;
        }
        oci_bind_by_name($sentencia, ':nif', $nif);
        oci_bind_by_name($sentencia, ':password', $password);
        oci_bind_by_name($sentencia, ':nombre', $name);
        oci_bind_by_name($sentencia, ':email', $email);
        oci_bind_by_name($sentencia, ':telefono', $telefono);
        oci_bind_by_name($sentencia, ':direccion', $direccion);
        oci_bind_by_name($sentencia, ':poblacion', $poblacion);
        oci_bind_by_name($sentencia, ':pais', $pais);
    
        $data_to_return = false;
    
        $ejecutar = oci_execute($sentencia);
    
        if(!$ejecutar) {
            $e = oci_error($sentencia);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            exit;
        } else {
            $data_to_return = true;
        }

        //CERRAR CONEXION
        oci_free_statement($sentencia);
        oci_close($conexion);
    
        return $data_to_return;
    }
    //FIN DAR ALTA  UN PROVEEDOR--------------------------------------

    //NUEVO USUARIO PARA  TRABAJADOR QUE REALICE UN REGISTRO DE PROVEEDORES--------------------------------------
    function get_login_user_trabajador($id_trabajador, $DNI, $password) {
        $conexion = connectBBDD();

        $sql = "SELECT id_trabajador, nombre, DNI FROM trabajador WHERE id_trabajador = :id_proveedor AND NIF = :NIF AND password = :password";

        $sentencia = oci_parse($conexion, $sql);

        if (!$sentencia) {
            $e = oci_error($conexion);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            exit;
        }

        oci_bind_by_name($sentencia, ':id_trabajador', $id_trabajador);
        oci_bind_by_name($sentencia, ':DNI', $DNI);
        oci_bind_by_name($sentencia, ':password', $password);

        $ejecutar = oci_execute($sentencia);

        if (!$ejecutar) {
            $e = oci_error($sentencia);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            exit;
        }

        $data_user = oci_fetch_assoc($sentencia);

        //CERRAR CONEXION
        oci_free_statement($sentencia);
        oci_close($conexion);

        return $data_user;
    }
    //FIN NUEVO USUARIO PARA  TRABAJADOR QUE REALICE UN REGISTRO DE PROVEEDORES--------------------------------------
    
    //VALIDAR EL NUEVO USUARIO PARA  TRABAJADOR--------------------------------------
    function validar_login_usuario_trabajador($DNI, $pass) {
        $conexion = connectBBDD();
    
        $sql = "SELECT id_trabajador, nombre FROM trabajador WHERE DNI = :DNI AND password = :pass  AND admin = 1";
        
        $sentencia = oci_parse($conexion, $sql);
    
        if (!$sentencia) {
            $e = oci_error($conexion);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            exit;
        }
    
        oci_bind_by_name($sentencia, ':DNI', $DNI);
        oci_bind_by_name($sentencia, ':pass', $pass);
    
        $ejecutar = oci_execute($sentencia);
    
        if (!$ejecutar) {
            $e = oci_error($sentencia);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            exit;
        }
    
        $data_user = [];
    
        while ($row = oci_fetch_array($sentencia, OCI_ASSOC+OCI_RETURN_NULLS)) {
            $data_user['id_trabajador'] = $row['ID_TRABAJADOR'];
            $data_user['nombre'] = $row['NOMBRE'];
        }
        //Cerrar conexion
        oci_free_statement($sentencia);
        oci_close($conexion);
        return $data_user;
    }
    //FIN VALIDAR EL NUEVO USUARIO PARA  TRABAJADOR--------------------------------------


    //FUNCION/PROCEDIMIENTO--------------------------------------
    function componente_mas_vendido($id_proveedor) {
        $conexion = connectBBDD();
        
        $sql = "BEGIN :resultado := componente_mas_vendido(:id_proveedor); END;";
        $stmt = oci_parse($conexion, $sql);
        if (!$stmt) {
            $e = oci_error($conexion);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
        
        //guardo el proveedor en una variable para html
        $id_proveedor = $id_proveedor;
        oci_bind_by_name($stmt, ':id_proveedor', $id_proveedor);
        oci_bind_by_name($stmt, ':resultado', $resultado, 4000);
        oci_execute($stmt);


        //CERRAR SESION
        oci_free_statement($stmt);
        oci_close($conexion);

        return $resultado;
    }
    
    //FIN FUNCION/PROCEDIMIENTO--------------------------------------
?>
