<?php

// INCLUIMOS LA CONFIGURACIÓN Y LA CONEXION PARA EL FUNCIONAMIENTO DEL PROYECTO
include_once DIR_APP . 'config/conexion.php';

class ModeloGH
{
    /* ===================================================
        PERSONAL
    ===================================================*/
    static public function mdlPersonal($value)
    {   
        # todo el personal
        if ($value == null){
            $sql = "SELECT p.*, e.municipio AS lugarExpedicion, n.municipio AS lugarNacimiento, r.municipio AS lugarResidencia, c.cargo AS Cargo, pr.proceso AS Proceso, eps.eps AS Eps, fp.fondo AS Afp, ar.arl AS Arl, m.municipio AS Ciudad, s.sucursal AS Sucursal
                        FROM gh_personal p
                        INNER JOIN gh_municipios e ON e.idmunicipio = p.lugar_expedicion
                        INNER JOIN gh_municipios n ON n.idmunicipio = p.lugar_nacimiento
                        INNER JOIN gh_municipios r ON r.idmunicipio = p.lugar_residencia
                        INNER JOIN gh_cargos c ON c.idCargo = p.cargo
                        INNER JOIN gh_procesos pr ON pr.idProceso = p.proceso
                        INNER JOIN gh_eps eps ON eps.ideps = p.eps
                        INNER JOIN gh_fondospension fp ON fp.idfondo = p.afp
                        INNER JOIN gh_arl ar ON ar.idarl = p.arl
                        INNER JOIN gh_municipios m ON m.idmunicipio = p.ciudad
                        INNER JOIN gh_sucursales s ON s.ids = p.sucursal
                        ORDER BY idPersonal";
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->execute();
            $retorno =  $stmt->fetchAll();
        }
        # unicamente los datos de un empleado
        else{
            $sql = "SELECT p.*, e.municipio AS lugarExpedicion, n.municipio AS lugarNacimiento, r.municipio AS lugarResidencia, c.cargo AS Cargo, pr.proceso AS Proceso, eps.eps AS Eps, fp.fondo AS Afp, ar.arl AS Arl, m.municipio AS Ciudad, s.sucursal AS Sucursal
                        FROM gh_personal p
                        INNER JOIN gh_municipios e ON e.idmunicipio = p.lugar_expedicion
                        INNER JOIN gh_municipios n ON n.idmunicipio = p.lugar_nacimiento
                        INNER JOIN gh_municipios r ON r.idmunicipio = p.lugar_residencia
                        INNER JOIN gh_cargos c ON c.idCargo = p.cargo
                        INNER JOIN gh_procesos pr ON pr.idProceso = p.proceso
                        INNER JOIN gh_eps eps ON eps.ideps = p.eps
                        INNER JOIN gh_fondospension fp ON fp.idfondo = p.afp
                        INNER JOIN gh_arl ar ON ar.idarl = p.arl
                        INNER JOIN gh_municipios m ON m.idmunicipio = p.ciudad
                        INNER JOIN gh_sucursales s ON s.ids = p.sucursal
                        WHERE p.Documento = $value";
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->execute();
            $retorno =  $stmt->fetch();
        }
        


        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================================================
       SUCURSALES
    ===================================================*/
    static public function mdlSucursales()
    {
        $stmt = Conexion::conectar()->prepare("SELECT *
                                                FROM gh_sucursales");

        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================================================
       DEPARTAMENTOS/MUNICIPIOS
    ===================================================*/
    static public function mdlDeparMunicipios()
    {
        $stmt = Conexion::conectar()->prepare("SELECT m.idmunicipio, m.municipio, d.nombre AS departamento, CONCAT(d.nombre, ' - ', m.municipio) AS DeparMunic
                                                FROM gh_municipios m
                                                INNER JOIN gh_departamentos d ON m.iddepartamento = d.iddepartamento
                                                ORDER BY d.nombre, m.municipio");

        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================================================
       CARGOS
    ===================================================*/
    static public function mdlCargos()
    {
        $stmt = Conexion::conectar()->prepare("SELECT *
                                                FROM gh_cargos");

        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================================================
       PROCESOS
    ===================================================*/
    static public function mdlProcesos()
    {
        $stmt = Conexion::conectar()->prepare("SELECT *
                                                FROM gh_procesos");

        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================================================
       LISTADO EPS
    ===================================================*/
    static public function mdlListadoEPS()
    {
        $stmt = Conexion::conectar()->prepare("SELECT *
                                                FROM gh_eps");

        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================================================
       LISTADO AFP
    ===================================================*/
    static public function mdlListadoAFP()
    {
        $stmt = Conexion::conectar()->prepare("SELECT *
                                                FROM gh_fondospension");

        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================================================
       LISTADO ARL
    ===================================================*/
    static public function mdlListadoARL()
    {
        $stmt = Conexion::conectar()->prepare("SELECT *
                                                FROM gh_arl");

        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================================================
       AGREGAR PERSONAL
    ===================================================*/
    static public function mdlAgregarPersonal($datos)
    {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("INSERT INTO gh_personal (Documento, tipo_doc, lugar_expedicion, Nombre, consentimiento_informado, fecha_nacimiento, lugar_nacimiento, edad, lugar_residencia, direccion, barrio, estrato_social, tipo_vivienda, telefono1, telefono2, estado_civil, genero, tipo_sangre, raza, correo, nivel_escolaridad, cargo, area, proceso, antiguedad, turno_trabajo, tipo_contrato, tipo_vinculacion, pago_seguridadsocial, anios_experiencia, dependientes, eps, afp, arl, salario_basico, beneficio_fijo, bonificacion_variable, ciudad, sucursal, activo, fecha_ingreso, empresa) 
                                    VALUES (:Documento, :tipo_doc, :lugar_expedicion, :Nombre, :consentimiento_informado, :fecha_nacimiento, :lugar_nacimiento, :edad, :lugar_residencia, :direccion, :barrio, :estrato_social, :tipo_vivienda, :telefono1, :telefono2, :estado_civil, :genero, :tipo_sangre, :raza, :correo, :nivel_escolaridad, :cargo, :area, :proceso, :antiguedad, :turno_trabajo, :tipo_contrato, :tipo_vinculacion, :pago_seguridadsocial, :anios_experiencia, :dependientes, :eps, :afp, :arl, :salario_basico, :beneficio_fijo, :bonificacion_variable, :ciudad, :sucursal, :activo, :fecha_ingreso, :empresa)");
        
        $stmt->bindParam(":Documento", $datos['Documento'], PDO::PARAM_INT);
        $stmt->bindParam(":tipo_doc", $datos['tipo_doc'], PDO::PARAM_STR);
        $stmt->bindParam(":lugar_expedicion", $datos['lugar_expedicion'], PDO::PARAM_INT);
        $stmt->bindParam(":Nombre", $datos['Nombre'], PDO::PARAM_STR);
        $stmt->bindParam(":consentimiento_informado", $datos['consentimiento_informado'], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_nacimiento", $datos['fecha_nacimiento'], PDO::PARAM_STR);
        $stmt->bindParam(":lugar_nacimiento", $datos['lugar_nacimiento'], PDO::PARAM_INT);
        $stmt->bindParam(":edad", $datos['edad'], PDO::PARAM_STR);
        $stmt->bindParam(":lugar_residencia", $datos['lugar_residencia'], PDO::PARAM_INT);
        $stmt->bindParam(":direccion", $datos['direccion'], PDO::PARAM_STR);
        $stmt->bindParam(":barrio", $datos['barrio'], PDO::PARAM_STR);
        $stmt->bindParam(":estrato_social", $datos['estrato_social'], PDO::PARAM_INT);
        $stmt->bindParam(":tipo_vivienda", $datos['tipo_vivienda'], PDO::PARAM_STR);
        $stmt->bindParam(":telefono1", $datos['telefono1'], PDO::PARAM_STR);
        $stmt->bindParam(":telefono2", $datos['telefono2'], PDO::PARAM_STR);
        $stmt->bindParam(":estado_civil", $datos['estado_civil'], PDO::PARAM_STR);
        $stmt->bindParam(":genero", $datos['genero'], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_sangre", $datos['tipo_sangre'], PDO::PARAM_STR);
        $stmt->bindParam(":raza", $datos['raza'], PDO::PARAM_STR);
        $stmt->bindParam(":correo", $datos['correo'], PDO::PARAM_STR);
        $stmt->bindParam(":nivel_escolaridad", $datos['nivel_escolaridad'], PDO::PARAM_STR);
        $stmt->bindParam(":cargo", $datos['cargo'], PDO::PARAM_INT);
        $stmt->bindParam(":area", $datos['area'], PDO::PARAM_STR);
        $stmt->bindParam(":proceso", $datos['proceso'], PDO::PARAM_INT);
        $stmt->bindParam(":antiguedad", $datos['antiguedad'], PDO::PARAM_STR);
        $stmt->bindParam(":turno_trabajo", $datos['turno_trabajo'], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_contrato", $datos['tipo_contrato'], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_vinculacion", $datos['tipo_vinculacion'], PDO::PARAM_STR);
        $stmt->bindParam(":pago_seguridadsocial", $datos['pago_seguridadsocial'], PDO::PARAM_STR);
        $stmt->bindParam(":anios_experiencia", $datos['anios_experiencia'], PDO::PARAM_INT);
        $stmt->bindParam(":dependientes", $datos['dependientes'], PDO::PARAM_STR);
        $stmt->bindParam(":eps", $datos['eps'], PDO::PARAM_INT);
        $stmt->bindParam(":afp", $datos['afp'], PDO::PARAM_INT);
        $stmt->bindParam(":arl", $datos['arl'], PDO::PARAM_INT);
        $stmt->bindParam(":salario_basico", $datos['salario_basico'], PDO::PARAM_INT);
        $stmt->bindParam(":beneficio_fijo", $datos['beneficio_fijo'], PDO::PARAM_INT);
        $stmt->bindParam(":bonificacion_variable", $datos['bonificacion_variable'], PDO::PARAM_INT);
        $stmt->bindParam(":ciudad", $datos['ciudad'], PDO::PARAM_INT);
        $stmt->bindParam(":sucursal", $datos['sucursal'], PDO::PARAM_INT);
        $stmt->bindParam(":activo", $datos['activo'], PDO::PARAM_STR);
        $fecha_ingreso = $datos['fecha_ingreso'] == null ? null : $datos['fecha_ingreso'];
        $stmt->bindParam(":fecha_ingreso", $fecha_ingreso, PDO::PARAM_STR);
        $stmt->bindParam(":empresa", $datos['empresa'], PDO::PARAM_STR);

        if ($stmt->execute()) {
            $id = $conexion->lastInsertId();
        } else {
            $id = "error";
        }
        $stmt->closeCursor();
        $conexion = null;
        return $id;
    }

    /* ===================================================
        EDITAR PERSONAL
    ===================================================*/
    static public function mdlEditarPersonal($datos)
    {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("UPDATE gh_personal SET Documento = :Documento, tipo_doc = :tipo_doc, lugar_expedicion = :lugar_expedicion, Nombre = :Nombre, consentimiento_informado = :consentimiento_informado, fecha_nacimiento = :fecha_nacimiento, lugar_nacimiento = :lugar_nacimiento, edad = :edad, lugar_residencia = :lugar_residencia, direccion = :direccion, barrio = :barrio, estrato_social = :estrato_social, tipo_vivienda = :tipo_vivienda, telefono1 = :telefono1, telefono2 = :telefono2, estado_civil = :estado_civil, genero = :genero, tipo_sangre = :tipo_sangre, raza = :raza, correo = :correo, nivel_escolaridad = :nivel_escolaridad, cargo = :cargo, area = :area, proceso = :proceso, antiguedad = :antiguedad, turno_trabajo = :turno_trabajo, tipo_contrato = :tipo_contrato, tipo_vinculacion = :tipo_vinculacion, pago_seguridadsocial = :pago_seguridadsocial, anios_experiencia = :anios_experiencia, dependientes = :dependientes, eps = :eps, afp = :afp, arl = :arl, salario_basico = :salario_basico, beneficio_fijo = :beneficio_fijo, bonificacion_variable = :bonificacion_variable, ciudad = :ciudad, sucursal = :sucursal, activo = :activo, fecha_ingreso = :fecha_ingreso, empresa = :empresa
                                    WHERE idPersonal = :idPersonal");
        
        $stmt->bindParam(":idPersonal", $datos['idPersonal'], PDO::PARAM_INT);
        $stmt->bindParam(":Documento", $datos['Documento'], PDO::PARAM_INT);
        $stmt->bindParam(":tipo_doc", $datos['tipo_doc'], PDO::PARAM_STR);
        $stmt->bindParam(":lugar_expedicion", $datos['lugar_expedicion'], PDO::PARAM_INT);
        $stmt->bindParam(":Nombre", $datos['Nombre'], PDO::PARAM_STR);
        $stmt->bindParam(":consentimiento_informado", $datos['consentimiento_informado'], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_nacimiento", $datos['fecha_nacimiento'], PDO::PARAM_STR);
        $stmt->bindParam(":lugar_nacimiento", $datos['lugar_nacimiento'], PDO::PARAM_INT);
        $stmt->bindParam(":edad", $datos['edad'], PDO::PARAM_STR);
        $stmt->bindParam(":lugar_residencia", $datos['lugar_residencia'], PDO::PARAM_INT);
        $stmt->bindParam(":direccion", $datos['direccion'], PDO::PARAM_STR);
        $stmt->bindParam(":barrio", $datos['barrio'], PDO::PARAM_STR);
        $stmt->bindParam(":estrato_social", $datos['estrato_social'], PDO::PARAM_INT);
        $stmt->bindParam(":tipo_vivienda", $datos['tipo_vivienda'], PDO::PARAM_STR);
        $stmt->bindParam(":telefono1", $datos['telefono1'], PDO::PARAM_STR);
        $stmt->bindParam(":telefono2", $datos['telefono2'], PDO::PARAM_STR);
        $stmt->bindParam(":estado_civil", $datos['estado_civil'], PDO::PARAM_STR);
        $stmt->bindParam(":genero", $datos['genero'], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_sangre", $datos['tipo_sangre'], PDO::PARAM_STR);
        $stmt->bindParam(":raza", $datos['raza'], PDO::PARAM_STR);
        $stmt->bindParam(":correo", $datos['correo'], PDO::PARAM_STR);
        $stmt->bindParam(":nivel_escolaridad", $datos['nivel_escolaridad'], PDO::PARAM_STR);
        $stmt->bindParam(":cargo", $datos['cargo'], PDO::PARAM_INT);
        $stmt->bindParam(":area", $datos['area'], PDO::PARAM_STR);
        $stmt->bindParam(":proceso", $datos['proceso'], PDO::PARAM_INT);
        $stmt->bindParam(":antiguedad", $datos['antiguedad'], PDO::PARAM_STR);
        $stmt->bindParam(":turno_trabajo", $datos['turno_trabajo'], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_contrato", $datos['tipo_contrato'], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_vinculacion", $datos['tipo_vinculacion'], PDO::PARAM_STR);
        $stmt->bindParam(":pago_seguridadsocial", $datos['pago_seguridadsocial'], PDO::PARAM_STR);
        $stmt->bindParam(":anios_experiencia", $datos['anios_experiencia'], PDO::PARAM_INT);
        $stmt->bindParam(":dependientes", $datos['dependientes'], PDO::PARAM_STR);
        $stmt->bindParam(":eps", $datos['eps'], PDO::PARAM_INT);
        $stmt->bindParam(":afp", $datos['afp'], PDO::PARAM_INT);
        $stmt->bindParam(":arl", $datos['arl'], PDO::PARAM_INT);
        $stmt->bindParam(":salario_basico", $datos['salario_basico'], PDO::PARAM_INT);
        $stmt->bindParam(":beneficio_fijo", $datos['beneficio_fijo'], PDO::PARAM_INT);
        $stmt->bindParam(":bonificacion_variable", $datos['bonificacion_variable'], PDO::PARAM_INT);
        $stmt->bindParam(":ciudad", $datos['ciudad'], PDO::PARAM_INT);
        $stmt->bindParam(":sucursal", $datos['sucursal'], PDO::PARAM_INT);
        $stmt->bindParam(":activo", $datos['activo'], PDO::PARAM_STR);
        $fecha_ingreso = $datos['fecha_ingreso'] == null ? null : $datos['fecha_ingreso'];
        $stmt->bindParam(":fecha_ingreso", $fecha_ingreso, PDO::PARAM_STR);
        $stmt->bindParam(":empresa", $datos['empresa'], PDO::PARAM_STR);

        if ($stmt->execute()) {
            $respuesta = $datos['idPersonal'];
        } else {
            $respuesta = "error";
        }
        $stmt->closeCursor();
        $conexion = null;
        return $respuesta;
    }

    /* ===================================================
       DATOS EMPLEADO
    ===================================================*/
    static public function mdlDatosEmpleado($idPersonal)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM gh_personal WHERE idPersonal = :idPersonal");

        $stmt->bindParam(":idPersonal", $idPersonal, PDO::PARAM_INT);
        $stmt->execute();
        $retorno = $stmt->fetch();
        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================== 
        ACTUALIZAR UN UNICO CAMPO DEL EMPLEADO
	========================= */
    static public function mdlActualizarEmpleado($datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE {$datos['tabla']} SET {$datos['item1']} = :{$datos['item1']} WHERE {$datos['item2']} = :{$datos['item2']}");

        $stmt->bindParam(":" . $datos['item1'], $datos['valor1'], PDO::PARAM_STR);
        $stmt->bindParam(":" . $datos['item2'], $datos['valor2'], PDO::PARAM_STR);

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;
        
        return $retorno;
    }

    /* ===================================================
       ? HIJOS
    ===================================================*/
    /* ===================================================
       GUARDAR HIJOS
    ===================================================*/
    static public function mdlGuardarHijos($datos)
    {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("INSERT INTO gh_re_personalhijos (idPersonal, Nombre, fecha_nacimiento, edad, genero) 
                                    VALUES (:idPersonal, :Nombre, :fecha_nacimiento, :edad, :genero)");
        
        $stmt->bindParam(":idPersonal", $datos['idPersonal'], PDO::PARAM_INT);
        $stmt->bindParam(":Nombre", $datos['Nombre'], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_nacimiento", $datos['fecha_nacimiento'], PDO::PARAM_STR);
        $stmt->bindParam(":edad", $datos['edad'], PDO::PARAM_STR);
        $stmt->bindParam(":genero", $datos['genero'], PDO::PARAM_STR);

        if ($stmt->execute()) {
            $respuesta = "ok";
        } else {
            $respuesta = "error";
        }
        $stmt->closeCursor();
        $conexion = null;
        return $respuesta;
    }

    /* ===================================================
       MOSTRAR HIJOS
    ===================================================*/
    static public function mdlMostrarHijos($idPersonal)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM gh_re_personalhijos WHERE idPersonal = :idPersonal");

        $stmt->bindParam(":idPersonal", $idPersonal, PDO::PARAM_INT);

        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================================================
       ? CONTRATOS Y PRORROGAS
    ===================================================*/
    /* ===================================================
       GUARDAR PRORROGAS
    ===================================================*/
    static public function mdlGuardarProrrogas($datos)
    {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("INSERT INTO gh_re_personalprorrogas (idPersonal, contrato, fecha_inicial, fecha_fin, meses_prorroga) 
                                    VALUES (:idPersonal, :contrato, :fecha_inicial, :fecha_fin, :meses_prorroga)");
        
        $stmt->bindParam(":idPersonal", $datos['idPersonal'], PDO::PARAM_INT);
        $stmt->bindParam(":contrato", $datos['contrato'], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_inicial", $datos['fecha_inicial'], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_fin", $datos['fecha_fin'], PDO::PARAM_STR);
        $stmt->bindParam(":meses_prorroga", $datos['meses_prorroga'], PDO::PARAM_STR);

        if ($stmt->execute()) {
            $id = $conexion->lastInsertId();
        } else {
            $id = "error";
        }
        $stmt->closeCursor();
        $conexion = null;
        return $id;
    }

    /* ===================================================
       MOSTRAR PRORROGAS
    ===================================================*/
    static public function mdlMostrarProrrogas($idPersonal)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM gh_re_personalprorrogas WHERE idPersonal = :idPersonal");

        $stmt->bindParam(":idPersonal", $idPersonal, PDO::PARAM_INT);

        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================================================
       ? LICENCIAS DE CONDUCCION
    ===================================================*/
    /* ===================================================
       GUARDAR LICENCIAS
    ===================================================*/
    static public function mdlGuardarLicencias($datos)
    {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("INSERT INTO gh_re_personallicencias (idPersonal, nro_licencia, fecha_expedicion, fecha_vencimiento, categoria) 
                                    VALUES (:idPersonal, :nro_licencia, :fecha_expedicion, :fecha_vencimiento, :categoria)");
        
        $stmt->bindParam(":idPersonal", $datos['idPersonal'], PDO::PARAM_INT);
        $stmt->bindParam(":nro_licencia", $datos['nro_licencia'], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_expedicion", $datos['fecha_expedicion'], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_vencimiento", $datos['fecha_vencimiento'], PDO::PARAM_STR);
        $stmt->bindParam(":categoria", $datos['categoria'], PDO::PARAM_STR);

        if ($stmt->execute()) {
            $id = $conexion->lastInsertId();
        } else {
            $id = "error";
        }
        $stmt->closeCursor();
        $conexion = null;
        return $id;
    }

    /* ===================================================
       MOSTRAR LICENCIAS
    ===================================================*/
    static public function mdlMostrarLicencias($idPersonal)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM gh_re_personallicencias WHERE idPersonal = :idPersonal");

        $stmt->bindParam(":idPersonal", $idPersonal, PDO::PARAM_INT);

        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================================================
       ? EXÁMENES MÉDICOS
    ===================================================*/
    /* ===================================================
       GUARDAR EXAMENES
    ===================================================*/
    static public function mdlGuardarExamenes($datos)
    {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("INSERT INTO gh_re_personalexamenes (idPersonal, tipo_examen, fecha_inicial, fecha_final) 
                                    VALUES (:idPersonal, :tipo_examen, :fecha_inicial, :fecha_final)");
        
        $stmt->bindParam(":idPersonal", $datos['idPersonal'], PDO::PARAM_INT);
        $stmt->bindParam(":tipo_examen", $datos['tipo_examen'], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_inicial", $datos['fecha_inicial'], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_final", $datos['fecha_final'], PDO::PARAM_STR);

        if ($stmt->execute()) {
            $id = $conexion->lastInsertId();
        } else {
            $id = "error";
        }
        $stmt->closeCursor();
        $conexion = null;
        return $id;
    }

    /* ===================================================
       MOSTRAR EXAMENES
    ===================================================*/
    static public function mdlMostrarExamenes($idPersonal)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM gh_re_personalexamenes WHERE idPersonal = :idPersonal");

        $stmt->bindParam(":idPersonal", $idPersonal, PDO::PARAM_INT);

        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================================================
       ! ELIMINAR REGISTRO
    ===================================================*/
    static public function mdlEliminarRegistro($datos)
    {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("DELETE
                                    FROM {$datos['tabla']}
                                    WHERE {$datos['item']} = :{$datos['item']}");
        $stmt->bindParam(":" . $datos['item'], $datos['valor'], PDO::PARAM_INT);

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }
        $stmt->closeCursor();
        $conexion = null;
        return $retorno;
    }
}
