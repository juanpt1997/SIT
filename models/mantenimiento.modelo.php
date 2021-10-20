<?php

//INCLUIMOS LA CONFIGURACIÓN Y LA CONEXION PARA EL FUNCIONAMIENTO DEL PROYECTO
include_once DIR_APP . 'config/conexion.php';




class ModeloProveedores
{
    static public function mdlListarProveedores($value)
    {
        if ($value != null) {

            $stmt = Conexion::conectar()->prepare("SELECT pro.*, m.municipio AS ciudad
                                                   FROM m_proveedores pro
                                                   INNER JOIN gh_municipios m ON pro.idciudad = m.idmunicipio
                                                   WHERE pro.documento = :documento");

            $stmt->bindParam(":documento",  $value, PDO::PARAM_STR);
            $stmt->execute();
            $retorno =  $stmt->fetch();
        } else {

            $stmt = Conexion::conectar()->prepare("SELECT pro.*, m.municipio AS ciudad
                                                   FROM m_proveedores pro
                                                   INNER JOIN gh_municipios m ON pro.idciudad = m.idmunicipio
                                                   WHERE pro.estado = 1");
            $stmt->execute();
            $retorno =  $stmt->fetchAll();
        }

        $stmt->closeCursor();
        return $retorno;
    }

    static public function mdlAgregarProveedor($datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO m_proveedores(documento,nombre_contacto,razon_social,direccion,correo,telefono,idciudad)
                                                VALUES(:documento,:nombre_contacto,:razon_social,:direccion,:correo,:telefono,:idciudad)");

        $stmt->bindParam(":documento", $datos["nit"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre_contacto", $datos["cont"], PDO::PARAM_STR);
        $stmt->bindParam(":razon_social", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["dir"], PDO::PARAM_STR);
        $stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $datos["tel"], PDO::PARAM_STR);
        $stmt->bindParam(":idciudad", $datos["ciudad"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }

    static public function mdlEditarProveedor($datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE m_proveedores set documento=:documento, nombre_contacto=:nombre_contacto, razon_social=:razon_social, direccion=:direccion,
                                                      correo=:correo, telefono=:telefono ,idciudad=:idciudad
                                               WHERE id = :id");

        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
        $stmt->bindParam(":documento", $datos["nit"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre_contacto", $datos["cont"], PDO::PARAM_STR);
        $stmt->bindParam(":razon_social", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["dir"], PDO::PARAM_STR);
        $stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $datos["tel"], PDO::PARAM_STR);
        $stmt->bindParam(":idciudad", $datos["ciudad"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }

    static public function mdlEliminarProveedor($datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE m_proveedores set estado = 0
                                               WHERE id = :id");

        $stmt->bindParam(":id", $datos[""], PDO::PARAM_INT);

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }
}

class ModeloInventario
{
    /* ===================================================
       VER LICENCIAS 
    ===================================================*/
    static public function mdlLicenciaConductor($idconductor)
    {
        $stmt = Conexion::conectar()->prepare("SELECT pl.*, v.numinterno, v.modelo, v.idmarca, v.idtipovehiculo, v.idvehiculo FROM gh_re_personallicencias pl
                                                INNER JOIN v_re_conductoresvehiculos cv ON pl.idPersonal = cv.idconductor
                                                INNER JOIN v_vehiculos v ON cv.idvehiculo = v.idvehiculo
                                                WHERE cv.idconductor = :idconductor");

        $stmt->bindParam(":idconductor",  $idconductor, PDO::PARAM_STR);
        $stmt->execute();
        $retorno =  $stmt->fetch();
        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================================================
       AGREGAR INVENTARIO
    ===================================================*/
    static public function mdlAgregarInventario($datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO m_inventario(
                                                            idvehiculo,
                                                            idconductor,
                                                            fecha_inventario,
                                                            kilometraje,
                                                            recepcion_entrega_vehiculo,
                                                            Techo_exterior,
                                                            Techo_interior,
                                                            Frente,
                                                            numero_luces_internas,
                                                            Bomper_delantero,
                                                            Bomper_trasero,
                                                            Lateral_derecho,
                                                            Lateral_izquierdo,
                                                            Puerta_izquierda,
                                                            Parabrisas_izquierdo,
                                                            Parabrisas_derecho,
                                                            parabrisas_trasero,
                                                            Espejo_retrovisor_derecho,
                                                            Espejo_retrovisor_izquierdo,
                                                            Vidrios_ventanas_lateral_derecho,
                                                            Vidrios_ventanas_lateral_izquierdo,
                                                            Vidrios_puertas,
                                                            Direccional_delantera_izquierda,
                                                            Direccional_delantera_derecha,
                                                            Stop_trasero_derecho,
                                                            Stop_trasero_izquierdo,
                                                            Cucuyo_lateral_derecho,
                                                            Cucuyo_lateral_izquierdo,
                                                            Luces_internas,
                                                            balizas,
                                                            Delantera_izquierda_R1,
                                                            Delantera_derecha_R2,
                                                            Trasera_interior_izquierda_R3,
                                                            Trasera_exterior_izquierda_R4,
                                                            Trasera_interior_derecha_R5,
                                                            Trasera_exterior_derecha_R6,
                                                            Gato,
                                                            Cruceta_Copa,
                                                            num_parlantes,
                                                            2Conos_Triangulos,
                                                            Botiquin,
                                                            Extintor,
                                                            2Tacos_Bloques,
                                                            Alicate_destornillador,
                                                            Llave_expancion_Llaves_fijas,
                                                            Llanta_repuesto,
                                                            Linterna_pila,
                                                            Cinturon_conductor,
                                                            Radiotelefono,
                                                            Antena,
                                                            Equipo_Sonido,
                                                            usb_cd,
                                                            Parlantes,
                                                            Manguera_agua,
                                                            Manguera_aire,
                                                            Pantalla_Televisor,
                                                            Reloj,
                                                            Brazo_1_Izquierdo_R1,
                                                            Brazo_2_Derecho_R2,
                                                            Brazo_3_Izquierdo_R3,
                                                            Brazo_4_Derecho_R6,
                                                            Emblema_derecho_empresa,
                                                            puerta_derecha,
                                                            Logo_izquierdo,
                                                            Logo_derecho,
                                                            Emblema_izquierdo_empresa,
                                                            escolar_delantero_trasero,
                                                            N_Interno_delantero,
                                                            N_Interno_trasero,
                                                            N_Interno_izquierdo,
                                                            N_Interno_derecho,
                                                            Nsalidas_martillos,
                                                            interno_externo_comoConduzco,
                                                            Av_Como_conduzco,
                                                            Dispositivo_velocidad,
                                                            Salidas_emergencia_martillos,
                                                            Brazo_limpiaparabrisas_izquierdo,
                                                            Plumilla_limpiaparabrisas_izquierdo,
                                                            Brazo_limpiaparabrisas_derecho,
                                                            Plumilla_limpiaparabrisas_derecho,
                                                            Baterias,
                                                            Botones_tablero_timon,
                                                            Tapa_radiador,
                                                            Tapa_deposito_hidraulico,
                                                            Cojineria_general,
                                                            Cinturon_sillas_calidad,
                                                            Pasamanos,
                                                            Claxon,
                                                            Placas_reglamentarias,
                                                            escolar)
                                                VALUES(
                                                    :idvehiculo,
                                                    :idconductor,
                                                    :fecha_inventario,
                                                    :kilometraje,
                                                    :recepcion_entrega_vehiculo,
                                                    :Techo_exterior,
                                                    :Techo_interior,
                                                    :Frente,
                                                    :numero_luces_internas,
                                                    :Bomper_delantero,
                                                    :Bomper_trasero,
                                                    :Lateral_derecho,
                                                    :Lateral_izquierdo,
                                                    :Puerta_izquierda,
                                                    :Parabrisas_izquierdo,
                                                    :Parabrisas_derecho,
                                                    :parabrisas_trasero,
                                                    :Espejo_retrovisor_derecho,
                                                    :Espejo_retrovisor_izquierdo,
                                                    :Vidrios_ventanas_lateral_derecho,
                                                    :Vidrios_ventanas_lateral_izquierdo,
                                                    :Vidrios_puertas,
                                                    :Direccional_delantera_izquierda,
                                                    :Direccional_delantera_derecha,
                                                    :Stop_trasero_derecho,
                                                    :Stop_trasero_izquierdo,
                                                    :Cucuyo_lateral_derecho,
                                                    :Cucuyo_lateral_izquierdo,
                                                    :Luces_internas,
                                                    :balizas,
                                                    :Delantera_izquierda_R1,
                                                    :Delantera_derecha_R2,
                                                    :Trasera_interior_izquierda_R3,
                                                    :Trasera_exterior_izquierda_R4,
                                                    :Trasera_interior_derecha_R5,
                                                    :Trasera_exterior_derecha_R6,
                                                    :Gato,
                                                    :Cruceta_Copa,
                                                    :num_parlantes,
                                                    :2Conos_Triangulos,
                                                    :Botiquin,
                                                    :Extintor,
                                                    :2Tacos_Bloques,
                                                    :Alicate_destornillador,
                                                    :Llave_expancion_Llaves_fijas,
                                                    :Llanta_repuesto,
                                                    :Linterna_pila,
                                                    :Cinturon_conductor,
                                                    :Radiotelefono,
                                                    :Antena,
                                                    :Equipo_Sonido,
                                                    :usb_cd,
                                                    :Parlantes,
                                                    :Manguera_agua,
                                                    :Manguera_aire,
                                                    :Pantalla_Televisor,
                                                    :Reloj,
                                                    :Brazo_1_Izquierdo_R1,
                                                    :Brazo_2_Derecho_R2,
                                                    :Brazo_3_Izquierdo_R3,
                                                    :Brazo_4_Derecho_R6,
                                                    :Emblema_derecho_empresa,
                                                    :puerta_derecha,
                                                    :Logo_izquierdo,
                                                    :Logo_derecho,
                                                    :Emblema_izquierdo_empresa,
                                                    :escolar_delantero_trasero,
                                                    :N_Interno_delantero,
                                                    :N_Interno_trasero,
                                                    :N_Interno_izquierdo,
                                                    :N_Interno_derecho,
                                                    :Nsalidas_martillos,
                                                    :interno_externo_comoConduzco,
                                                    :Av_Como_conduzco,
                                                    :Dispositivo_velocidad,
                                                    :Salidas_emergencia_martillos,
                                                    :Brazo_limpiaparabrisas_izquierdo,
                                                    :Plumilla_limpiaparabrisas_izquierdo,
                                                    :Brazo_limpiaparabrisas_derecho,
                                                    :Plumilla_limpiaparabrisas_derecho,
                                                   :Baterias,
                                                   :Botones_tablero_timon,
                                                   :Tapa_radiador,
                                                    :Tapa_deposito_hidraulico,
                                                    :Cojineria_general,
                                                    :Cinturon_sillas_calidad,
                                                    :Pasamanos,
                                                    :Claxon,
                                                    :Placas_reglamentarias,
                                                    :escolar
                                                    )");

        $stmt->bindParam(":idvehiculo", $datos["idvehiculo"], PDO::PARAM_INT);
        $stmt->bindParam(":idconductor", $datos["idconductor"], PDO::PARAM_INT);
        $stmt->bindParam(":fecha_inventario", $datos["fecha_inventario"], PDO::PARAM_STR);
        $stmt->bindParam(":kilometraje", $datos["kilometraje"], PDO::PARAM_INT);
        $stmt->bindParam(":recepcion_entrega_vehiculo", $datos["recepcion_entrega_vehiculo"], PDO::PARAM_INT);
        $stmt->bindParam(":Techo_exterior", $datos["Techo_exterior"], PDO::PARAM_INT);
        $stmt->bindParam(":Techo_interior", $datos["Techo_interior"], PDO::PARAM_INT);
        $stmt->bindParam(":Frente", $datos["Frente"], PDO::PARAM_INT);
        $stmt->bindParam(":numero_luces_internas", $datos["numero_luces_internas"], PDO::PARAM_INT);
        $stmt->bindParam(":Bomper_delantero", $datos["Bomper_delantero"], PDO::PARAM_INT);
        $stmt->bindParam(":Bomper_trasero", $datos["Bomper_trasero"], PDO::PARAM_INT);
        $stmt->bindParam(":Lateral_derecho", $datos["Lateral_derecho"], PDO::PARAM_INT);
        $stmt->bindParam(":Lateral_izquierdo", $datos["Lateral_izquierdo"], PDO::PARAM_INT);
        $stmt->bindParam(":Puerta_izquierda", $datos["Puerta_izquierda"], PDO::PARAM_INT);
        $stmt->bindParam(":Parabrisas_izquierdo", $datos["Parabrisas_izquierdo"], PDO::PARAM_INT);
        $stmt->bindParam(":Parabrisas_derecho", $datos["Parabrisas_derecho"], PDO::PARAM_INT);
        $stmt->bindParam(":parabrisas_trasero", $datos["parabrisas_trasero"], PDO::PARAM_INT);
        $stmt->bindParam(":Espejo_retrovisor_derecho", $datos["Espejo_retrovisor_derecho"], PDO::PARAM_INT);
        $stmt->bindParam(":Espejo_retrovisor_izquierdo", $datos["Espejo_retrovisor_izquierdo"], PDO::PARAM_INT);
        $stmt->bindParam(":Vidrios_ventanas_lateral_derecho", $datos["Vidrios_ventanas_lateral_derecho"], PDO::PARAM_INT);
        $stmt->bindParam(":Vidrios_ventanas_lateral_izquierdo", $datos["Vidrios_ventanas_lateral_izquierdo"], PDO::PARAM_INT);
        $stmt->bindParam(":Vidrios_puertas", $datos["Vidrios_puertas"], PDO::PARAM_INT);
        $stmt->bindParam(":Direccional_delantera_izquierda", $datos["Direccional_delantera_izquierda"], PDO::PARAM_INT);
        $stmt->bindParam(":Direccional_delantera_derecha", $datos["Direccional_delantera_derecha"], PDO::PARAM_INT);
        $stmt->bindParam(":Stop_trasero_derecho", $datos["Stop_trasero_derecho"], PDO::PARAM_INT);
        $stmt->bindParam(":Stop_trasero_izquierdo", $datos["Stop_trasero_izquierdo"], PDO::PARAM_INT);
        $stmt->bindParam(":Cucuyo_lateral_derecho", $datos["Cucuyo_lateral_derecho"], PDO::PARAM_INT);
        $stmt->bindParam(":Cucuyo_lateral_izquierdo", $datos["Cucuyo_lateral_izquierdo"], PDO::PARAM_INT);
        $stmt->bindParam(":Luces_internas", $datos["Luces_internas"], PDO::PARAM_INT);
        $stmt->bindParam(":balizas", $datos["balizas"], PDO::PARAM_INT);
        $stmt->bindParam(":Delantera_izquierda_R1", $datos["Delantera_izquierda_R1"], PDO::PARAM_INT);
        $stmt->bindParam(":Delantera_derecha_R2", $datos["Delantera_derecha_R2"], PDO::PARAM_INT);
        $stmt->bindParam(":Trasera_interior_izquierda_R3", $datos["Trasera_interior_izquierda_R3"], PDO::PARAM_INT);
        $stmt->bindParam(":Trasera_exterior_izquierda_R4", $datos["Trasera_exterior_izquierda_R4"], PDO::PARAM_INT);
        $stmt->bindParam(":Trasera_interior_derecha_R5", $datos["Trasera_interior_derecha_R5"], PDO::PARAM_INT);
        $stmt->bindParam(":Trasera_exterior_derecha_R6", $datos["Trasera_exterior_derecha_R6"], PDO::PARAM_INT);
        $stmt->bindParam(":Gato", $datos["Gato"], PDO::PARAM_INT);
        $stmt->bindParam(":Cruceta_Copa", $datos["Cruceta_Copa"], PDO::PARAM_INT);
        $stmt->bindParam(":num_parlantes", $datos["num_parlantes"], PDO::PARAM_INT);
        $stmt->bindParam(":2Conos_Triangulos", $datos["2Conos_Triangulos"], PDO::PARAM_INT);
        $stmt->bindParam(":Botiquin", $datos["Botiquin"], PDO::PARAM_INT);
        $stmt->bindParam(":Extintor", $datos["Extintor"], PDO::PARAM_INT);
        $stmt->bindParam(":2Tacos_Bloques", $datos["2Tacos_Bloques"], PDO::PARAM_INT);
        $stmt->bindParam(":Alicate_destornillador", $datos["Alicate_destornillador"], PDO::PARAM_INT);
        $stmt->bindParam(":Llave_expancion_Llaves_fijas", $datos["Llave_expancion_Llaves_fijas"], PDO::PARAM_INT);
        $stmt->bindParam(":Llanta_repuesto", $datos["Llanta_repuesto"], PDO::PARAM_INT);
        $stmt->bindParam(":Linterna_pila", $datos["Linterna_pila"], PDO::PARAM_INT);
        $stmt->bindParam(":Cinturon_conductor", $datos["Cinturon_conductor"], PDO::PARAM_INT);
        $stmt->bindParam(":Radiotelefono", $datos["Radiotelefono"], PDO::PARAM_INT);
        $stmt->bindParam(":Antena", $datos["Antena"], PDO::PARAM_INT);
        $stmt->bindParam(":Equipo_Sonido", $datos["Equipo_Sonido"], PDO::PARAM_INT);
        $stmt->bindParam(":usb_cd", $datos["usb_cd"], PDO::PARAM_INT);
        $stmt->bindParam(":Parlantes", $datos["Parlantes"], PDO::PARAM_INT);
        $stmt->bindParam(":Manguera_agua", $datos["Manguera_agua"], PDO::PARAM_INT);
        $stmt->bindParam(":Manguera_aire", $datos["Manguera_aire"], PDO::PARAM_INT);
        $stmt->bindParam(":Pantalla_Televisor", $datos["Pantalla_Televisor"], PDO::PARAM_INT);
        $stmt->bindParam(":Reloj", $datos["Reloj"], PDO::PARAM_INT);
        $stmt->bindParam(":Brazo_1_Izquierdo_R1", $datos["Brazo_1_Izquierdo_R1"], PDO::PARAM_INT);
        $stmt->bindParam(":Brazo_2_Derecho_R2", $datos["Brazo_2_Derecho_R2"], PDO::PARAM_INT);
        $stmt->bindParam(":Brazo_3_Izquierdo_R3", $datos["Brazo_3_Izquierdo_R3"], PDO::PARAM_INT);
        $stmt->bindParam(":Brazo_4_Derecho_R6", $datos["Brazo_4_Derecho_R6"], PDO::PARAM_INT);
        $stmt->bindParam(":Emblema_derecho_empresa", $datos["Emblema_derecho_empresa"], PDO::PARAM_INT);
        $stmt->bindParam(":puerta_derecha", $datos["puerta_derecha"], PDO::PARAM_INT);
        $stmt->bindParam(":Logo_izquierdo", $datos["Logo_izquierdo"], PDO::PARAM_INT);
        $stmt->bindParam(":Logo_derecho", $datos["Logo_derecho"], PDO::PARAM_INT);
        $stmt->bindParam(":Emblema_izquierdo_empresa", $datos["Emblema_izquierdo_empresa"], PDO::PARAM_INT);
        $stmt->bindParam(":escolar_delantero_trasero", $datos["escolar_delantero_trasero"], PDO::PARAM_INT);
        $stmt->bindParam(":N_Interno_delantero", $datos["N_Interno_delantero"], PDO::PARAM_INT);
        $stmt->bindParam(":N_Interno_trasero", $datos["N_Interno_trasero"], PDO::PARAM_INT);
        $stmt->bindParam(":N_Interno_izquierdo", $datos["N_Interno_izquierdo"], PDO::PARAM_INT);
        $stmt->bindParam(":N_Interno_derecho", $datos["N_Interno_derecho"], PDO::PARAM_INT);
        $stmt->bindParam(":Nsalidas_martillos", $datos["Nsalidas_martillos"], PDO::PARAM_INT);
        $stmt->bindParam(":interno_externo_comoConduzco", $datos["interno_externo_comoConduzco"], PDO::PARAM_INT);
        $stmt->bindParam(":Av_Como_conduzco", $datos["Av_Como_conduzco"], PDO::PARAM_INT);
        $stmt->bindParam(":Dispositivo_velocidad", $datos["Dispositivo_velocidad"], PDO::PARAM_INT);
        $stmt->bindParam(":Salidas_emergencia_martillos", $datos["Salidas_emergencia_martillos"], PDO::PARAM_INT);
        $stmt->bindParam(":Brazo_limpiaparabrisas_izquierdo", $datos["Brazo_limpiaparabrisas_izquierdo"], PDO::PARAM_INT);
        $stmt->bindParam(":Plumilla_limpiaparabrisas_izquierdo", $datos["Plumilla_limpiaparabrisas_izquierdo"], PDO::PARAM_INT);
        $stmt->bindParam(":Brazo_limpiaparabrisas_derecho", $datos["Brazo_limpiaparabrisas_derecho"], PDO::PARAM_INT);
        $stmt->bindParam(":Plumilla_limpiaparabrisas_derecho", $datos["Plumilla_limpiaparabrisas_derecho"], PDO::PARAM_INT);
        $stmt->bindParam(":Baterias", $datos["Baterias"], PDO::PARAM_INT);
        $stmt->bindParam(":Botones_tablero_timon", $datos["Botones_tablero_timon"], PDO::PARAM_INT);
        $stmt->bindParam(":Tapa_radiador", $datos["Tapa_radiador"], PDO::PARAM_INT);
        $stmt->bindParam(":Tapa_deposito_hidraulico", $datos["Tapa_deposito_hidraulico"], PDO::PARAM_INT);
        $stmt->bindParam(":Cojineria_general", $datos["Cojineria_general"], PDO::PARAM_INT);
        $stmt->bindParam(":Cinturon_sillas_calidad", $datos["Cinturon_sillas_calidad"], PDO::PARAM_INT);
        $stmt->bindParam(":Pasamanos", $datos["Pasamanos"], PDO::PARAM_INT);
        $stmt->bindParam(":Claxon", $datos["Claxon"], PDO::PARAM_INT);
        $stmt->bindParam(":Placas_reglamentarias", $datos["Placas_reglamentarias"], PDO::PARAM_INT);
        $stmt->bindParam(":escolar", $datos["escolar"], PDO::PARAM_INT);
        //$stmt->bindParam(":tipo_vel_inven", $datos["inventario_tipo_vel"], PDO::PARAM_STR);

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
       ACTUALIZAR INVENTARIO
    ===================================================*/
    static public function mdlEditarInventario($datos)
    {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("UPDATE 
                                            m_inventario SET 
                                                            idvehiculo=:idvehiculo,
                                                            idconductor=:idconductor,
                                                            fecha_inventario=:fecha_inventario,
                                                            kilometraje=:kilometraje,
                                                            recepcion_entrega_vehiculo=:recepcion_entrega_vehiculo,
                                                            Techo_exterior=:Techo_exterior,
                                                            Techo_interior=:Techo_interior,
                                                            Frente=:Frente,
                                                            numero_luces_internas=:numero_luces_internas,
                                                            Bomper_delantero=:Bomper_delantero,
                                                            Bomper_trasero=:Bomper_trasero,
                                                            Lateral_derecho=:Lateral_derecho,
                                                            Lateral_izquierdo=:Lateral_izquierdo,
                                                            Puerta_izquierda=:Puerta_izquierda,
                                                            Parabrisas_izquierdo=:Parabrisas_izquierdo,
                                                            Parabrisas_derecho=:Parabrisas_derecho,
                                                            parabrisas_trasero=:parabrisas_trasero,
                                                            Espejo_retrovisor_derecho=:Espejo_retrovisor_derecho,
                                                            Espejo_retrovisor_izquierdo=:Espejo_retrovisor_izquierdo,
                                                            Vidrios_ventanas_lateral_derecho=:Vidrios_ventanas_lateral_derecho,
                                                            Vidrios_ventanas_lateral_izquierdo=:Vidrios_ventanas_lateral_izquierdo,
                                                            Vidrios_puertas=:Vidrios_puertas,
                                                            Direccional_delantera_izquierda=:Direccional_delantera_izquierda,
                                                            Direccional_delantera_derecha=:Direccional_delantera_derecha,
                                                            Stop_trasero_derecho=:Stop_trasero_derecho,
                                                            Stop_trasero_izquierdo=:Stop_trasero_izquierdo,
                                                            Cucuyo_lateral_derecho=:Cucuyo_lateral_derecho,
                                                            Cucuyo_lateral_izquierdo=:Cucuyo_lateral_izquierdo,
                                                            Luces_internas=:Luces_internas,
                                                            balizas=:balizas,
                                                            Delantera_izquierda_R1=:Delantera_izquierda_R1,
                                                            Delantera_derecha_R2=:Delantera_derecha_R2,
                                                            Trasera_interior_izquierda_R3=:Trasera_interior_izquierda_R3,
                                                            Trasera_exterior_izquierda_R4=:Trasera_exterior_izquierda_R4,
                                                            Trasera_interior_derecha_R5=:Trasera_interior_derecha_R5,
                                                            Trasera_exterior_derecha_R6=:Trasera_exterior_derecha_R6,
                                                            Gato=:Gato,
                                                            Cruceta_Copa=:Cruceta_Copa,
                                                            num_parlantes=:num_parlantes,
                                                            2Conos_Triangulos=:2Conos_Triangulos,
                                                            Botiquin=:Botiquin,
                                                            Extintor=:Extintor,
                                                            2Tacos_Bloques=:2Tacos_Bloques,
                                                            Alicate_destornillador=:Alicate_destornillador,
                                                            Llave_expancion_Llaves_fijas=:Llave_expancion_Llaves_fijas,
                                                            Llanta_repuesto=:Llanta_repuesto,
                                                            Linterna_pila=:Linterna_pila,
                                                            Cinturon_conductor=:Cinturon_conductor,
                                                            Radiotelefono=:Radiotelefono,
                                                            Antena=:Antena,
                                                            Equipo_Sonido=:Equipo_Sonido,
                                                            usb_cd=:usb_cd,
                                                            Parlantes=:Parlantes,
                                                            Manguera_agua=:Manguera_agua,
                                                            Manguera_aire=:Manguera_aire,
                                                            Pantalla_Televisor=:Pantalla_Televisor,
                                                            Reloj=:Reloj,
                                                            Brazo_1_Izquierdo_R1=:Brazo_1_Izquierdo_R1,
                                                            Brazo_2_Derecho_R2=:Brazo_2_Derecho_R2,
                                                            Brazo_3_Izquierdo_R3=:Brazo_3_Izquierdo_R3,
                                                            Brazo_4_Derecho_R6=:Brazo_4_Derecho_R6,
                                                            Emblema_derecho_empresa=:Emblema_derecho_empresa,
                                                            puerta_derecha=:puerta_derecha,
                                                            Logo_izquierdo=:Logo_izquierdo,
                                                            Logo_derecho=:Logo_derecho,
                                                            Emblema_izquierdo_empresa=:Emblema_izquierdo_empresa,
                                                            escolar_delantero_trasero=:escolar_delantero_trasero,
                                                            N_Interno_delantero=:N_Interno_delantero,
                                                            N_Interno_trasero=:N_Interno_trasero,
                                                            N_Interno_izquierdo=:N_Interno_izquierdo,
                                                            N_Interno_derecho=:N_Interno_derecho,
                                                            Nsalidas_martillos=:Nsalidas_martillos,
                                                            interno_externo_comoConduzco=:interno_externo_comoConduzco,
                                                            Av_Como_conduzco=:Av_Como_conduzco,
                                                            Dispositivo_velocidad=:Dispositivo_velocidad,
                                                            Salidas_emergencia_martillos=:Salidas_emergencia_martillos,
                                                            Brazo_limpiaparabrisas_izquierdo=:Brazo_limpiaparabrisas_izquierdo,
                                                            Plumilla_limpiaparabrisas_izquierdo=:Plumilla_limpiaparabrisas_izquierdo,
                                                            Brazo_limpiaparabrisas_derecho=:Brazo_limpiaparabrisas_derecho,
                                                            Plumilla_limpiaparabrisas_derecho=:Plumilla_limpiaparabrisas_derecho,
                                                            Baterias=:Baterias,
                                                            Botones_tablero_timon=:Botones_tablero_timon,
                                                            Tapa_radiador=:Tapa_radiador,
                                                            Tapa_deposito_hidraulico=:Tapa_deposito_hidraulico,
                                                            Cojineria_general=:Cojineria_general,
                                                            Cinturon_sillas_calidad=:Cinturon_sillas_calidad,
                                                            Pasamanos=:Pasamanos,
                                                            Claxon=:Claxon,
                                                            Placas_reglamentarias=:Placas_reglamentarias,
                                                            escolar=:escolar
                                                            WHERE id=:id ");

        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
        $stmt->bindParam(":idvehiculo", $datos["idvehiculo"], PDO::PARAM_INT);
        $stmt->bindParam(":idconductor", $datos["idconductor"], PDO::PARAM_INT);
        $stmt->bindParam(":fecha_inventario", $datos["fecha_inventario"], PDO::PARAM_STR);
        $stmt->bindParam(":kilometraje", $datos["kilometraje"], PDO::PARAM_INT);
        $stmt->bindParam(":recepcion_entrega_vehiculo", $datos["recepcion_entrega_vehiculo"], PDO::PARAM_INT);
        $stmt->bindParam(":Techo_exterior", $datos["Techo_exterior"], PDO::PARAM_INT);
        $stmt->bindParam(":Techo_interior", $datos["Techo_interior"], PDO::PARAM_INT);
        $stmt->bindParam(":Frente", $datos["Frente"], PDO::PARAM_INT);
        $stmt->bindParam(":numero_luces_internas", $datos["numero_luces_internas"], PDO::PARAM_INT);
        $stmt->bindParam(":Bomper_delantero", $datos["Bomper_delantero"], PDO::PARAM_INT);
        $stmt->bindParam(":Bomper_trasero", $datos["Bomper_trasero"], PDO::PARAM_INT);
        $stmt->bindParam(":Lateral_derecho", $datos["Lateral_derecho"], PDO::PARAM_INT);
        $stmt->bindParam(":Lateral_izquierdo", $datos["Lateral_izquierdo"], PDO::PARAM_INT);
        $stmt->bindParam(":Puerta_izquierda", $datos["Puerta_izquierda"], PDO::PARAM_INT);
        $stmt->bindParam(":Parabrisas_izquierdo", $datos["Parabrisas_izquierdo"], PDO::PARAM_INT);
        $stmt->bindParam(":Parabrisas_derecho", $datos["Parabrisas_derecho"], PDO::PARAM_INT);
        $stmt->bindParam(":parabrisas_trasero", $datos["parabrisas_trasero"], PDO::PARAM_INT);
        $stmt->bindParam(":Espejo_retrovisor_derecho", $datos["Espejo_retrovisor_derecho"], PDO::PARAM_INT);
        $stmt->bindParam(":Espejo_retrovisor_izquierdo", $datos["Espejo_retrovisor_izquierdo"], PDO::PARAM_INT);
        $stmt->bindParam(":Vidrios_ventanas_lateral_derecho", $datos["Vidrios_ventanas_lateral_derecho"], PDO::PARAM_INT);
        $stmt->bindParam(":Vidrios_ventanas_lateral_izquierdo", $datos["Vidrios_ventanas_lateral_izquierdo"], PDO::PARAM_INT);
        $stmt->bindParam(":Vidrios_puertas", $datos["Vidrios_puertas"], PDO::PARAM_INT);
        $stmt->bindParam(":Direccional_delantera_izquierda", $datos["Direccional_delantera_izquierda"], PDO::PARAM_INT);
        $stmt->bindParam(":Direccional_delantera_derecha", $datos["Direccional_delantera_derecha"], PDO::PARAM_INT);
        $stmt->bindParam(":Stop_trasero_derecho", $datos["Stop_trasero_derecho"], PDO::PARAM_INT);
        $stmt->bindParam(":Stop_trasero_izquierdo", $datos["Stop_trasero_izquierdo"], PDO::PARAM_INT);
        $stmt->bindParam(":Cucuyo_lateral_derecho", $datos["Cucuyo_lateral_derecho"], PDO::PARAM_INT);
        $stmt->bindParam(":Cucuyo_lateral_izquierdo", $datos["Cucuyo_lateral_izquierdo"], PDO::PARAM_INT);
        $stmt->bindParam(":Luces_internas", $datos["Luces_internas"], PDO::PARAM_INT);
        $stmt->bindParam(":balizas", $datos["balizas"], PDO::PARAM_INT);
        $stmt->bindParam(":Delantera_izquierda_R1", $datos["Delantera_izquierda_R1"], PDO::PARAM_INT);
        $stmt->bindParam(":Delantera_derecha_R2", $datos["Delantera_derecha_R2"], PDO::PARAM_INT);
        $stmt->bindParam(":Trasera_interior_izquierda_R3", $datos["Trasera_interior_izquierda_R3"], PDO::PARAM_INT);
        $stmt->bindParam(":Trasera_exterior_izquierda_R4", $datos["Trasera_exterior_izquierda_R4"], PDO::PARAM_INT);
        $stmt->bindParam(":Trasera_interior_derecha_R5", $datos["Trasera_interior_derecha_R5"], PDO::PARAM_INT);
        $stmt->bindParam(":Trasera_exterior_derecha_R6", $datos["Trasera_exterior_derecha_R6"], PDO::PARAM_INT);
        $stmt->bindParam(":Gato", $datos["Gato"], PDO::PARAM_INT);
        $stmt->bindParam(":Cruceta_Copa", $datos["Cruceta_Copa"], PDO::PARAM_INT);
        $stmt->bindParam(":num_parlantes", $datos["num_parlantes"], PDO::PARAM_INT);
        $stmt->bindParam(":2Conos_Triangulos", $datos["2Conos_Triangulos"], PDO::PARAM_INT);
        $stmt->bindParam(":Botiquin", $datos["Botiquin"], PDO::PARAM_INT);
        $stmt->bindParam(":Extintor", $datos["Extintor"], PDO::PARAM_INT);
        $stmt->bindParam(":2Tacos_Bloques", $datos["2Tacos_Bloques"], PDO::PARAM_INT);
        $stmt->bindParam(":Alicate_destornillador", $datos["Alicate_destornillador"], PDO::PARAM_INT);
        $stmt->bindParam(":Llave_expancion_Llaves_fijas", $datos["Llave_expancion_Llaves_fijas"], PDO::PARAM_INT);
        $stmt->bindParam(":Llanta_repuesto", $datos["Llanta_repuesto"], PDO::PARAM_INT);
        $stmt->bindParam(":Linterna_pila", $datos["Linterna_pila"], PDO::PARAM_INT);
        $stmt->bindParam(":Cinturon_conductor", $datos["Cinturon_conductor"], PDO::PARAM_INT);
        $stmt->bindParam(":Radiotelefono", $datos["Radiotelefono"], PDO::PARAM_INT);
        $stmt->bindParam(":Antena", $datos["Antena"], PDO::PARAM_INT);
        $stmt->bindParam(":Equipo_Sonido", $datos["Equipo_Sonido"], PDO::PARAM_INT);
        $stmt->bindParam(":usb_cd", $datos["usb_cd"], PDO::PARAM_INT);
        $stmt->bindParam(":Parlantes", $datos["Parlantes"], PDO::PARAM_INT);
        $stmt->bindParam(":Manguera_agua", $datos["Manguera_agua"], PDO::PARAM_INT);
        $stmt->bindParam(":Manguera_aire", $datos["Manguera_aire"], PDO::PARAM_INT);
        $stmt->bindParam(":Pantalla_Televisor", $datos["Pantalla_Televisor"], PDO::PARAM_INT);
        $stmt->bindParam(":Reloj", $datos["Reloj"], PDO::PARAM_INT);
        $stmt->bindParam(":Brazo_1_Izquierdo_R1", $datos["Brazo_1_Izquierdo_R1"], PDO::PARAM_INT);
        $stmt->bindParam(":Brazo_2_Derecho_R2", $datos["Brazo_2_Derecho_R2"], PDO::PARAM_INT);
        $stmt->bindParam(":Brazo_3_Izquierdo_R3", $datos["Brazo_3_Izquierdo_R3"], PDO::PARAM_INT);
        $stmt->bindParam(":Brazo_4_Derecho_R6", $datos["Brazo_4_Derecho_R6"], PDO::PARAM_INT);
        $stmt->bindParam(":Emblema_derecho_empresa", $datos["Emblema_derecho_empresa"], PDO::PARAM_INT);
        $stmt->bindParam(":puerta_derecha", $datos["puerta_derecha"], PDO::PARAM_INT);
        $stmt->bindParam(":Logo_izquierdo", $datos["Logo_izquierdo"], PDO::PARAM_INT);
        $stmt->bindParam(":Logo_derecho", $datos["Logo_derecho"], PDO::PARAM_INT);
        $stmt->bindParam(":Emblema_izquierdo_empresa", $datos["Emblema_izquierdo_empresa"], PDO::PARAM_INT);
        $stmt->bindParam(":escolar_delantero_trasero", $datos["escolar_delantero_trasero"], PDO::PARAM_INT);
        $stmt->bindParam(":N_Interno_delantero", $datos["N_Interno_delantero"], PDO::PARAM_INT);
        $stmt->bindParam(":N_Interno_trasero", $datos["N_Interno_trasero"], PDO::PARAM_INT);
        $stmt->bindParam(":N_Interno_izquierdo", $datos["N_Interno_izquierdo"], PDO::PARAM_INT);
        $stmt->bindParam(":N_Interno_derecho", $datos["N_Interno_derecho"], PDO::PARAM_INT);
        $stmt->bindParam(":Nsalidas_martillos", $datos["Nsalidas_martillos"], PDO::PARAM_INT);
        $stmt->bindParam(":interno_externo_comoConduzco", $datos["interno_externo_comoConduzco"], PDO::PARAM_INT);
        $stmt->bindParam(":Av_Como_conduzco", $datos["Av_Como_conduzco"], PDO::PARAM_INT);
        $stmt->bindParam(":Dispositivo_velocidad", $datos["Dispositivo_velocidad"], PDO::PARAM_INT);
        $stmt->bindParam(":Salidas_emergencia_martillos", $datos["Salidas_emergencia_martillos"], PDO::PARAM_INT);
        $stmt->bindParam(":Brazo_limpiaparabrisas_izquierdo", $datos["Brazo_limpiaparabrisas_izquierdo"], PDO::PARAM_INT);
        $stmt->bindParam(":Plumilla_limpiaparabrisas_izquierdo", $datos["Plumilla_limpiaparabrisas_izquierdo"], PDO::PARAM_INT);
        $stmt->bindParam(":Brazo_limpiaparabrisas_derecho", $datos["Brazo_limpiaparabrisas_derecho"], PDO::PARAM_INT);
        $stmt->bindParam(":Plumilla_limpiaparabrisas_derecho", $datos["Plumilla_limpiaparabrisas_derecho"], PDO::PARAM_INT);
        $stmt->bindParam(":Baterias", $datos["Baterias"], PDO::PARAM_INT);
        $stmt->bindParam(":Botones_tablero_timon", $datos["Botones_tablero_timon"], PDO::PARAM_INT);
        $stmt->bindParam(":Tapa_radiador", $datos["Tapa_radiador"], PDO::PARAM_INT);
        $stmt->bindParam(":Tapa_deposito_hidraulico", $datos["Tapa_deposito_hidraulico"], PDO::PARAM_INT);
        $stmt->bindParam(":Cojineria_general", $datos["Cojineria_general"], PDO::PARAM_INT);
        $stmt->bindParam(":Cinturon_sillas_calidad", $datos["Cinturon_sillas_calidad"], PDO::PARAM_INT);
        $stmt->bindParam(":Pasamanos", $datos["Pasamanos"], PDO::PARAM_INT);
        $stmt->bindParam(":Claxon", $datos["Claxon"], PDO::PARAM_INT);
        $stmt->bindParam(":Placas_reglamentarias", $datos["Placas_reglamentarias"], PDO::PARAM_INT);
        $stmt->bindParam(":escolar", $datos["escolar"], PDO::PARAM_INT);
        //$stmt->bindParam(":tipo_vel_inven", $datos["inventario_tipo_vel"], PDO::PARAM_STR);

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
       LISTAR INVENTARIO
    ===================================================*/
    static public function mdlListarInventario($valor)
    {
        if ($valor != null) {

            $stmt = Conexion::conectar()->prepare("SELECT v.placa, v.numinterno, p.Nombre AS conductor, i.*
                                                FROM m_inventario i
                                                INNER JOIN v_vehiculos v ON v.idvehiculo = i.idvehiculo
                                                LEFT JOIN gh_personal p ON p.idPersonal = i.idconductor
                                                WHERE i.id = :id");

            $stmt->bindParam(":id", $valor, PDO::PARAM_INT);
            $stmt->execute();
            $retorno = $stmt->fetch();
        } else {

            $stmt = Conexion::conectar()->prepare("SELECT v.placa, v.numinterno, p.Nombre AS conductor, i.*
                                                FROM m_inventario i
                                                INNER JOIN v_vehiculos v ON v.idvehiculo = i.idvehiculo
                                                LEFT JOIN gh_personal p ON p.idPersonal = i.idconductor
                                                WHERE i.estado = 1");
            $stmt->execute();
            $retorno = $stmt->fetchAll();
        }

        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================================================
       LISTAR EVIDENCIAS
    ===================================================*/
    static public function mdlListaEvidencias($idvehiculo)
    {
        $stmt = Conexion::conectar()->prepare("SELECT e.idevidencia, e.idvehiculo, e.fecha, e.ruta_foto, e.observaciones, e.estado, e.autor AS idautor, u.Nombre AS autor
                                                FROM m_re_inventarioevidencias e
                                                INNER JOIN v_vehiculos v ON e.idvehiculo = v.idvehiculo
                                                LEFT JOIN l_usuarios u ON u.Cedula = e.autor
                                                WHERE v.idvehiculo = :idvehiculo
                                                ORDER BY e.estado ASC, e.fecha DESC, e.idevidencia DESC");

        $stmt->bindParam(":idvehiculo", $idvehiculo, PDO::PARAM_INT);
        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================================================
       GUARDAR EVIDENCIA
    ===================================================*/
    static public function mdlGuardarEvidencia($datos)
    {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("INSERT INTO `m_re_inventarioevidencias`(
                                    `idvehiculo`,
                                    `fecha`,
                                    `ruta_foto`,
                                    `observaciones`,
                                    `autor`) 
                                    VALUES (
                                    :idvehiculo,
                                    curdate(),
                                    :ruta_foto,
                                    :observaciones,
                                    :autor)
        ");

        $stmt->bindParam(":idvehiculo", $datos['idvehiculo'], PDO::PARAM_INT);
        $stmt->bindParam(":ruta_foto", $datos['ruta_foto'], PDO::PARAM_STR);
        $stmt->bindParam(":observaciones", $datos['observaciones'], PDO::PARAM_STR);
        $stmt->bindParam(":autor", $datos['autor'], PDO::PARAM_INT);

        if ($stmt->execute()) {
            $respuesta = "ok";
        } else {
            $respuesta = "error";
        }
        $stmt->closeCursor();
        $conexion = null;
        return $respuesta;
    }

    /*===================================================
       CAMBIAR ESTADO EVIDENCIA
    ===================================================*/
    static public function mdlActualizarEstado($datos)
    {

        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("UPDATE `m_re_inventarioevidencias` SET 
            `estado` = :estado,
            `observaciones` = :observaciones
            WHERE `idevidencia`=:idevidencia");

        $stmt->bindParam(":idevidencia", $datos['idevidencia'], PDO::PARAM_INT);
        $stmt->bindParam(":observaciones", $datos['observaciones'], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos['estado'], PDO::PARAM_STR);

        if ($stmt->execute()) {
            $respuesta = "ok";
        } else {
            $respuesta = "error";
        }
        $stmt->closeCursor();
        $conexion = null;
        return $respuesta;
    }

    /* ====================================================
       ELIMINAR UN REGISTRO DEL INVENTARIO (borrado logico)
    ====================================================*/
    static public function mdlEliminarInventario($idvehiculo)
    {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("UPDATE m_inventario  SET estado = 0
                                    WHERE id = :id");

        $stmt->bindParam(":id", $idvehiculo, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;
        return $retorno;
    }
}

class ModeloRevision
{
    /*=======================================
        LISTADO DE REVISIONES TECNICOMECÁNICAS
        ====================================== */
    static public function mdlListadoRevision()
    {
        $stmt = Conexion::conectar()->prepare("SELECT vh.placa AS placa, vh.numinterno AS numinterno, vh.modelo AS modelo, vh.idvehiculo AS idvehiculo,
		                                        tm.*, 
		                                        tv.tipovehiculo AS tipovehiculo
	 	                                        FROM m_revisiontm tm 
		                                        INNER JOIN v_vehiculos vh ON tm.idvehiculo = vh.idvehiculo
		                                        INNER JOIN v_tipovehiculos tv ON vh.idtipovehiculo = tv.idtipovehiculo
		                                        WHERE tm.estado = 1");

        $stmt->execute();
        $respuesta = $stmt->fetchAll();
        $stmt->closeCursor();
        return $respuesta;
    }

    

    /* ==========================================
        INSERTAR REVISION
        ========================================== */
    static public function mdlAgregarRevision($datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO `m_revisiontm` (
                `idvehiculo`, 
                `kilometraje`,
                `nivelrefrigerante`,
                `nivelaceite`,
                `radiador`,
                `mangueras`,
                `correas`,
                `motor`,
                `freno_ahogo`,
                `exosto`,
                `guaya`,
                `turbo`,
                `tapa_radiador`,
                `fuga_aceite`,
                `fuga_combustible`,
                `nivel_aceite_transmision`,
                `transmision`,
                `tapon_transmision`,
                `palanca_cambios`,
                `embrague`,
                `pedal_embrague`,
                `cruceta_cardan`,
                `cojinete_cardan`,
                `cadena_cardan`,
                `aceite_diferencial`,
                `drenaje_diferencial`,
                `fuga_transmision`,
                `fuga_diferencial`,
                `muelle_delantero_derecho`,
                `amortiguador_delantero_derecho`,
                `muelle_delantero_izquierdo`,
                `amortiguador_delantero_izquierdo`,
                `muelle_trasero_derecho`,
                `amortiguador_trasero_derecho`,
                `muelle_trasero_izquierdo`,
                `amortiguador_trasero_izquierdo`,
                `barra_estabilizadora`,
                `tornillo_pasador_central`,
                `aceite_hidraulico`,
                `lineas`,
                `pitman`,
                `barra_ejes`,
                `tijeras`,
                `splinders`,
                `timon`, 
                `caja_direccion`,
                `cruceta_direccion`,
                `fuga_caja`,
                `nivel_fluido`,
                `tuberias`,
                `freno_parqueo`,
                `frenos`,
                `pedal_freno`,
                `compresor`,
                `fuga_aire`,
                `banda_delantera_derecha`,
                `banda_delantera_izquierda`,
                `banda_trasera_derecha`,
                `banda_trasera_izquierda`,
                `rachets`,
                `discos_delanteros`,
                `discos_traseros`,
                `pastillas_freno`,
                `rines`,
                `llantar1`,
                `llantar2`,
                `llantar3`,
                `llantar4`,
                `llantar5`,
                `llantar6`,
                `llanta_repuesto`,
                `tanques_aire`,
                `luces_altas`,
                `luces_bajas`,
                `luces_direccionales`,
                `luces_estacionarias`,
                `luces_laterales`,
                `luz_reversa`,
                `luces_internas`,
                `luces_delimitadoras`,
                `alarma_reversa`,
                `motor_arranque`,
                `alternador`,
                `baterias`,
                `pito`,
                `rutero`,
                `cables_conexiones`,
                `fusibles`,
                `presion_aceite`,
                `temperatura_motor`,
                `velocimetro`,
                `nivel_combustible`,
                `presion_aire`,
                `carga_bateria`,
                `techo_exterior`,
                `techo_interior`,
                `bomper_delantero`,
                `bomper_trasero`,
                `frente`,
                `lamina_lateral_derecho`,
                `lamina_lateral_izquierdo`,
                `puerta_principal`,
                `puerta_lateral`,
                `estribos_puerta`,
                `sillas`,
                `descansa_brazos`,
                `bocallanta`,
                `guardapolvos`,
                `piso`,
                `parabrisas_derecho`,
                `brazo_limpiaparabrisas_derecho`,
                `plumillas_limpiaparabrisas_derecho`,
                `parabrisas_izquierdo`,
                `brazo_limpiaparabrisas_izquierdo`,
                `plumillas_limpiaparabrisas_izquierdo`,
                `espejo_retrovisor_derecho`,
                `espejo_retrovisor_izquierdo`,
                `espejo_central`,
                `ventanas_lado_derecho`,
                `ventanas_lado_izquierdo`,
                `parabrisas_trasero`,
                `vidrio_puerta_principal`,
                `vidrio_segunda_puerta`,
                `manijas`,
                `claraboyas`,
                `airbag`,
                `aire_acondicionado`,
                `limpieza`,
                `chapas`,
                `parales`,
                `booster_puertas`,
                `reloj_vigia`,
                `vigia_delantera_derecha`,
                `vigia_delantera_izquierda`,
                `vigia_trasera_derecha`,
                `vigia_trasera_izquierda`,
                `tapa_motor`,
                `tapa_bodegas`,
                `parasol`,
                `cenefas`,
                `emblema_izquierdo`,
                `emblema_derecho`,
                `emblema_trasero`,
                `equipo_audio`,
                `parlantes`,
                `cinturon_usuario`,
                `martillo_emergencia`,
                `dispositivo_velocidad`,
                `avisos`,
                `placa_trasera`,
                `placa_delantera`,
                `placa_lateral_derecha`,
                `placa_lateral_izquierda`,
                `balizas`,
                `cinturon`,
                `gato`,
                `copa`,
                `senales_carretera`,
                `botiquin`,
                `extintor`,
                `tacos`,
                `alicate`,
                `destornilladores`,
                `llave_expansion`,
                `llaves_fijas`,
                `linterna`,
                `observacion`
                ) 
                VALUES (
                :idvehiculo,
                :kilometraje,
                :nivelrefrigerante,
                :nivelaceite,
                :radiador,
                :mangueras,
                :correas,
                :motor,
                :freno_ahogo,
                :exosto,
                :guaya,
                :turbo,
                :tapa_radiador,
                :fuga_aceite,
                :fuga_combustible,
                :nivel_aceite_transmision,
                :transmision,
                :tapon_transmision,
                :palanca_cambios,
                :embrague,
                :pedal_embrague,
                :cruceta_cardan,
                :cojinete_cardan,
                :cadena_cardan,
                :aceite_diferencial,
                :drenaje_diferencial,
                :fuga_transmision,
                :fuga_diferencial,
                :muelle_delantero_derecho,
                :amortiguador_delantero_derecho,
                :muelle_delantero_izquierdo,
                :amortiguador_delantero_izquierdo,
                :muelle_trasero_derecho,
                :amortiguador_trasero_derecho,
                :muelle_trasero_izquierdo,
                :amortiguador_trasero_izquierdo,
                :barra_estabilizadora,
                :tornillo_pasador_central,
                :aceite_hidraulico,
                :lineas,
                :pitman,
                :barra_ejes,
                :tijeras,
                :splinders,
                :timon,
                :caja_direccion,
                :cruceta_direccion,
                :fuga_caja,
                :nivel_fluido,
                :tuberias,
                :freno_parqueo,
                :frenos,
                :pedal_freno,
                :compresor,
                :fuga_aire,
                :banda_delantera_derecha,
                :banda_delantera_izquierda,
                :banda_trasera_derecha,
                :banda_trasera_izquierda,
                :rachets,
                :discos_delanteros,
                :discos_traseros,
                :pastillas_freno,
                :rines,
                :llantar1,
                :llantar2,
                :llantar3,
                :llantar4,
                :llantar5,
                :llantar6,
                :llanta_repuesto,
                :tanques_aire,
                :luces_altas,
                :luces_bajas,
                :luces_direccionales,
                :luces_estacionarias,
                :luces_laterales,
                :luz_reversa,
                :luces_internas,
                :luces_delimitadoras,
                :alarma_reversa,
                :motor_arranque,
                :alternador,
                :baterias,
                :pito,
                :rutero,
                :cables_conexiones,
                :fusibles,
                :presion_aceite,
                :temperatura_motor,
                :velocimetro,
                :nivel_combustible,
                :presion_aire,
                :carga_bateria,
                :techo_exterior,
                :techo_interior,
                :bomper_delantero,
                :bomper_trasero,
                :frente,
                :lamina_lateral_derecho,
                :lamina_lateral_izquierdo,
                :puerta_principal,
                :puerta_lateral,
                :estribos_puerta,
                :sillas,
                :descansa_brazos,
                :bocallanta,
                :guardapolvos,
                :piso,
                :parabrisas_derecho,
                :brazo_limpiaparabrisas_derecho,
                :plumillas_limpiaparabrisas_derecho,
                :parabrisas_izquierdo,
                :brazo_limpiaparabrisas_izquierdo,
                :plumillas_limpiaparabrisas_izquierdo,
                :espejo_retrovisor_derecho,
                :espejo_retrovisor_izquierdo,
                :espejo_central,
                :ventanas_lado_derecho,
                :ventanas_lado_izquierdo,
                :parabrisas_trasero,
                :vidrio_puerta_principal,
                :vidrio_segunda_puerta,
                :manijas,
                :claraboyas,
                :airbag,
                :aire_acondicionado,
                :limpieza,
                :chapas,
                :parales,
                :booster_puertas,
                :reloj_vigia,
                :vigia_delantera_derecha,
                :vigia_delantera_izquierda,
                :vigia_trasera_derecha,
                :vigia_trasera_izquierda,
                :tapa_motor,
                :tapa_bodegas,
                :parasol,
                :cenefas,
                :emblema_izquierdo,
                :emblema_derecho,
                :emblema_trasero,
                :equipo_audio,
                :parlantes,
                :cinturon_usuario,
                :martillo_emergencia,
                :dispositivo_velocidad,
                :avisos,
                :placa_trasera,
                :placa_delantera,
                :placa_lateral_derecha,
                :placa_lateral_izquierda,
                :balizas,
                :cinturon,
                :gato,
                :copa,
                :senales_carretera,
                :botiquin,
                :extintor,
                :tacos,
                :alicate,
                :destornilladores,
                :llave_expansion,
                :llaves_fijas,
                :linterna,
                :observacion
                )");

        // $stmt = Conexion::conectar()->prepare("INSERT INTO `m_revisiontm` (
        //         `idvehiculo`, 
        //         `kilometraje`,
        //         `nivelrefrigerante`,
        //         `nivelaceite`,
        //         `radiador`,
        //         `mangueras`,
        //         `correas`,
        //         `motor`,
        //         `freno_ahogo`,
        //         `exosto`,
        //         `guaya`,
        //         `turbo`,
        //         `tapa_radiador`,
        //         `fuga_aceite`,
        //         `fuga_combustible`,
        //         `nivel_aceite_transmision`,
        //         `transmision`,
        //         `tapon_transmision`,
        //         `palanca_cambios`,
        //         `embrague`,
        //         `pedal_embrague`,
        //         `cruceta_cardan`,
        //         `cojinete_cardan`,
        //         `cadena_cardan`,
        //         `aceite_diferencial`,
        //         `drenaje_diferencial`,
        //         `fuga_transmision`,
        //         `fuga_diferencial`,
        //         `muelle_delantero_derecho`,
        //         `amortiguador_delantero_derecho`,
        //         `muelle_delantero_izquierdo`,
        //         `amortiguador_delantero_izquierdo`,
        //         `muelle_trasero_derecho`,
        //         `amortiguador_trasero_derecho`,
        //         `muelle_trasero_izquierdo`,
        //         `amortiguador_trasero_izquierdo`,
        //         `barra_estabilizadora`,
        //         `tornillo_pasador_central`,
        //         `aceite_hidraulico`,
        //         `lineas`,
        //         `pitman`,
        //         `barra_ejes`,
        //         `tijeras`,
        //         `splinders`,
        //         `timon`, 
        //         `caja_direccion`,
        //         `cruceta_direccion`,
        //         `fuga_caja`,
        //         `nivel_fluido`,
        //         `tuberias`,
        //         `freno_parqueo`,
        //         `frenos`,
        //         `pedal_freno`,
        //         `compresor`,
        //         `fuga_aire`,
        //         `banda_delantera_derecha`,
        //         `banda_delantera_izquierda`,
        //         `banda_trasera_derecha`,
        //         `banda_trasera_izquierda`,
        //         `rachets`,
        //         `discos_delanteros`,
        //         `discos_traseros`,
        //         `pastillas_freno`,
        //         `rines`,
        //         `llantar1`,
        //         `llantar2`,
        //         `llantar3`,
        //         `llantar4`,
        //         `llantar5`,
        //         `llantar6`,
        //         `llanta_repuesto`,
        //         `tanques_aire`,
        //         `luces_altas`,
        //         `luces_bajas`,
        //         `luces_direccionales`,
        //         `luces_estacionarias`,
        //         `luces_laterales`,
        //         `luz_reversa`,
        //         `luces_internas`,
        //         `luces_delimitadoras`,
        //         `alarma_reversa`,
        //         `motor_arranque`,
        //         `alternador`,
        //         `baterias`,
        //         `pito`,
        //         `rutero`,
        //         `cables_conexiones`,
        //         `fusibles`,
        //         `presion_aceite`,
        //         `temperatura_motor`,
        //         `velocimetro`,
        //         `nivel_combustible`,
        //         `presion_aire`,
        //         `carga_bateria`,
        //         `techo_exterior`,
        //         `techo_interior`,
        //         `bomper_delantero`,
        //         `bomper_trasero`,
        //         `frente`,
        //         `lamina_lateral_derecho`,
        //         `lamina_lateral_izquierdo`,
        //         `puerta_principal`,
        //         `puerta_lateral`,
        //         `estribos_puerta`,
        //         `sillas`,
        //         `descansa_brazos`,
        //         `bocallanta`,
        //         `guardapolvos`,
        //         `piso`,
        //         `parabrisas_derecho`,
        //         `brazo_limpiaparabrisas_derecho`,
        //         `plumillas_limpiaparabrisas_derecho`,
        //         `parabrisas_izquierdo`,
        //         `brazo_limpiaparabrisas_izquierdo`,
        //         `plumillas_limpiaparabrisas_izquierdo`,
        //         `espejo_retrovisor_derecho`,
        //         `espejo_retrovisor_izquierdo`,
        //         `espejo_central`,
        //         `ventanas_lado_derecho`,
        //         `ventanas_lado_izquierdo`,
        //         `parabrisas_trasero`,
        //         `vidrio_puerta_principal`,
        //         `vidrio_segunda_puerta`,
        //         `manijas`,
        //         `claraboyas`,
        //         `airbag`,
        //         `aire_acondicionado`,
        //         `limpieza`,
        //         `chapas`,
        //         `parales`,
        //         `booster_puertas`,
        //         `reloj_vigia`,
        //         `vigia_delantera_derecha`,
        //         `vigia_delantera_izquierda`,
        //         `vigia_trasera_derecha`,
        //         `vigia_trasera_izquierda`,
        //         `tapa_motor`,
        //         `tapa_bodegas`,
        //         `parasol`,
        //         `cenefas`,
        //         `emblema_izquierdo`,
        //         `emblema_derecho`,
        //         `emblema_trasero`,
        //         `equipo_audio`,
        //         `parlantes`,
        //         `cinturon_usuario`,
        //         `martillo_emergencia`,
        //         `dispositivo_velocidad`,
        //         `avisos`,
        //         `placa_trasera`,
        //         `placa_delantera`,
        //         `placa_lateral_derecha`,
        //         `placa_lateral_izquierda`,
        //         `balizas`,
        //         `cinturon`,
        //         `gato`,
        //         `copa`,
        //         `señales_carretera`,
        //         `botiquin`,
        //         `extintor`,
        //         `tacos`,
        //         `alicate`,
        //         `destornilladores`,
        //         `llave_expansion`,
        //         `llaves_fijas`,
        //         `linterna`,
        //         `observacion`
        //         ) 
        //         VALUES (
        //         " . $datos['idvehiculo'] . ",
        //         " . $datos['kilometraje'] . ",
        //         " . $datos['nivelrefrigerante'] . ",
        //         " . $datos['nivelaceite'] . ",
        //         " . $datos['radiador'] . ",
        //         " . $datos['mangueras'] . ",
        //         " . $datos['correas'] . ",
        //         " . $datos['motor'] . ",
        //         " . $datos['freno_ahogo'] . ",
        //         " . $datos['exosto'] . ",
        //         " . $datos['guaya'] . ",
        //         " . $datos['turbo'] . ",
        //         " . $datos['tapa_radiador'] . ",
        //         " . $datos['fuga_aceite'] . ",
        //         " . $datos['fuga_combustible'] . ",
        //         " . $datos['nivel_aceite_transmision'] . ",
        //         " . $datos['transmision'] . ",
        //         " . $datos['tapon_transmision'] . ",
        //         " . $datos['palanca_cambios'] . ",
        //         " . $datos['embrague'] . ",
        //         " . $datos['pedal_embrague'] . ",
        //         " . $datos['cruceta_cardan'] . ",
        //         " . $datos['cojinete_cardan'] . ",
        //         " . $datos['cadena_cardan'] . ",
        //         " . $datos['aceite_diferencial'] . ",
        //         " . $datos['drenaje_diferencial'] . ",
        //         " . $datos['fuga_transmision'] . ",
        //         " . $datos['fuga_diferencial'] . ",
        //         " . $datos['muelle_delantero_derecho'] . ",
        //         " . $datos['amortiguador_delantero_derecho'] . ",
        //         " . $datos['muelle_delantero_izquierdo'] . ",
        //         " . $datos['amortiguador_delantero_izquierdo'] . ",
        //         " . $datos['muelle_trasero_derecho'] . ",
        //         " . $datos['amortiguador_trasero_derecho'] . ",
        //         " . $datos['muelle_trasero_izquierdo'] . ",
        //         " . $datos['amortiguador_trasero_izquierdo'] . ",
        //         " . $datos['barra_estabilizadora'] . ",
        //         " . $datos['tornillo_pasador_central'] . ",
        //         " . $datos['aceite_hidraulico'] . ",
        //         " . $datos['lineas'] . ",
        //         " . $datos['pitman'] . ",
        //         " . $datos['barra_ejes'] . ",
        //         " . $datos['tijeras'] . ",
        //         " . $datos['splinders'] . ",
        //         " . $datos['timon'] . ",
        //         " . $datos['caja_direccion'] . ",
        //         " . $datos['cruceta_direccion'] . ",
        //         " . $datos['fuga_caja'] . ",
        //         " . $datos['nivel_fluido'] . ",
        //         " . $datos['tuberias'] . ",
        //         " . $datos['freno_parqueo'] . ",
        //         " . $datos['frenos'] . ",
        //         " . $datos['pedal_freno'] . ",
        //         " . $datos['compresor'] . ",
        //         " . $datos['fuga_aire'] . ",
        //         " . $datos['banda_delantera_derecha'] . ",
        //         " . $datos['banda_delantera_izquierda'] . ",
        //         " . $datos['banda_trasera_derecha'] . ",
        //         " . $datos['banda_trasera_izquierda'] . ",
        //         " . $datos['rachets'] . ",
        //         " . $datos['discos_delanteros'] . ",
        //         " . $datos['discos_traseros'] . ",
        //         " . $datos['pastillas_freno'] . ",
        //         " . $datos['rines'] . ",
        //         " . $datos['llantar1'] . ",
        //         " . $datos['llantar2'] . ",
        //         " . $datos['llantar3'] . ",
        //         " . $datos['llantar4'] . ",
        //         " . $datos['llantar5'] . ",
        //         " . $datos['llantar6'] . ",
        //         " . $datos['llanta_repuesto'] . ",
        //         " . $datos['tanques_aire'] . ",
        //         " . $datos['luces_altas'] . ",
        //         " . $datos['luces_bajas'] . ",
        //         " . $datos['luces_direccionales'] . ",
        //         " . $datos['luces_estacionarias'] . ",
        //         " . $datos['luces_laterales'] . ",
        //         " . $datos['luz_reversa'] . ",
        //         " . $datos['luces_internas'] . ",
        //         " . $datos['luces_delimitadoras'] . ",
        //         " . $datos['alarma_reversa'] . ",
        //         " . $datos['motor_arranque'] . ",
        //         " . $datos['alternador'] . ",
        //         " . $datos['baterias'] . ",
        //         " . $datos['pito'] . ",
        //         " . $datos['rutero'] . ",
        //         " . $datos['cables_conexiones'] . ",
        //         " . $datos['fusibles'] . ",
        //         " . $datos['presion_aceite'] . ",
        //         " . $datos['temperatura_motor'] . ",
        //         " . $datos['velocimetro'] . ",
        //         " . $datos['nivel_combustible'] . ",
        //         " . $datos['presion_aire'] . ",
        //         " . $datos['carga_bateria'] . ",
        //         " . $datos['techo_exterior'] . ",
        //         " . $datos['techo_interior'] . ",
        //         " . $datos['bomper_delantero'] . ",
        //         " . $datos['bomper_trasero'] . ",
        //         " . $datos['frente'] . ",
        //         " . $datos['lamina_lateral_derecho'] . ",
        //         " . $datos['lamina_lateral_izquierdo'] . ",
        //         " . $datos['puerta_principal'] . ",
        //         " . $datos['puerta_lateral'] . ",
        //         " . $datos['estribos_puerta'] . ",
        //         " . $datos['sillas'] . ",
        //         " . $datos['descansa_brazos'] . ",
        //         " . $datos['bocallanta'] . ",
        //         " . $datos['guardapolvos'] . ",
        //         " . $datos['piso'] . ",
        //         " . $datos['parabrisas_derecho'] . ",
        //         " . $datos['brazo_limpiaparabrisas_derecho'] . ",
        //         " . $datos['plumillas_limpiaparabrisas_derecho'] . ",
        //         " . $datos['parabrisas_izquierdo'] . ",
        //         " . $datos['brazo_limpiaparabrisas_izquierdo'] . ",
        //         " . $datos['plumillas_limpiaparabrisas_izquierdo'] . ",
        //         " . $datos['espejo_retrovisor_derecho'] . ",
        //         " . $datos['espejo_retrovisor_izquierdo'] . ",
        //         " . $datos['espejo_central'] . ",
        //         " . $datos['ventanas_lado_derecho'] . ",
        //         " . $datos['ventanas_lado_izquierdo'] . ",
        //         " . $datos['parabrisas_trasero'] . ",
        //         " . $datos['vidrio_puerta_principal'] . ",
        //         " . $datos['vidrio_segunda_puerta'] . ",
        //         " . $datos['manijas'] . ",
        //         " . $datos['claraboyas'] . ",
        //         " . $datos['airbag'] . ",
        //         " . $datos['aire_acondicionado'] . ",
        //         " . $datos['limpieza'] . ",
        //         " . $datos['chapas'] . ",
        //         " . $datos['parales'] . ",
        //         " . $datos['booster_puertas'] . ",
        //         " . $datos['reloj_vigia'] . ",
        //         " . $datos['vigia_delantera_derecha'] . ",
        //         " . $datos['vigia_delantera_izquierda'] . ",
        //         " . $datos['vigia_trasera_derecha'] . ",
        //         " . $datos['vigia_trasera_izquierda'] . ",
        //         " . $datos['tapa_motor'] . ",
        //         " . $datos['tapa_bodegas'] . ",
        //         " . $datos['parasol'] . ",
        //         " . $datos['cenefas'] . ",
        //         " . $datos['emblema_izquierdo'] . ",
        //         " . $datos['emblema_derecho'] . ",
        //         " . $datos['emblema_trasero'] . ",
        //         " . $datos['equipo_audio'] . ",
        //         " . $datos['parlantes'] . ",
        //         " . $datos['cinturon_usuario'] . ",
        //         " . $datos['martillo_emergencia'] . ",
        //         " . $datos['dispositivo_velocidad'] . ",
        //         " . $datos['avisos'] . ",
        //         " . $datos['placa_trasera'] . ",
        //         " . $datos['placa_delantera'] . ",
        //         " . $datos['placa_lateral_derecha'] . ",
        //         " . $datos['placa_lateral_izquierda'] . ",
        //         " . $datos['balizas'] . ",
        //         " . $datos['cinturon'] . ",
        //         " . $datos['gato'] . ",
        //         " . $datos['copa'] . ",
        //         " . $datos['señales_carretera'] . ",
        //         " . $datos['botiquin'] . ",
        //         " . $datos['extintor'] . ",
        //         " . $datos['tacos'] . ",
        //         " . $datos['alicate'] . ",
        //         " . $datos['destornilladores'] . ",
        //         " . $datos['llave_expansion'] . ",
        //         " . $datos['llaves_fijas'] . ",
        //         " . $datos['linterna'] . ",
        //         '" . $datos['observacion'] . "'
        //         )");

        $stmt->bindParam(":idvehiculo", $datos['idvehiculo'], PDO::PARAM_INT);
        $stmt->bindParam(":kilometraje", $datos['kilometraje'], PDO::PARAM_INT);
        $stmt->bindParam(":nivelrefrigerante", $datos['nivelrefrigerante'], PDO::PARAM_INT);
        $stmt->bindParam(":nivelaceite", $datos['nivelaceite'], PDO::PARAM_INT);
        $stmt->bindParam(":radiador", $datos['radiador'], PDO::PARAM_INT);
        $stmt->bindParam(":mangueras", $datos['mangueras'], PDO::PARAM_INT);
        $stmt->bindParam(":correas", $datos['correas'], PDO::PARAM_INT);
        $stmt->bindParam(":motor", $datos['motor'], PDO::PARAM_INT);
        $stmt->bindParam(":freno_ahogo", $datos['freno_ahogo'], PDO::PARAM_INT);
        $stmt->bindParam(":exosto", $datos['exosto'], PDO::PARAM_INT);
        $stmt->bindParam(":guaya", $datos['guaya'], PDO::PARAM_INT);
        $stmt->bindParam(":turbo", $datos['turbo'], PDO::PARAM_INT);
        $stmt->bindParam(":tapa_radiador", $datos['tapa_radiador'], PDO::PARAM_INT);
        $stmt->bindParam(":fuga_aceite", $datos['fuga_aceite'], PDO::PARAM_INT);
        $stmt->bindParam(":fuga_combustible", $datos['fuga_combustible'], PDO::PARAM_INT);
        $stmt->bindParam(":nivel_aceite_transmision", $datos['nivel_aceite_transmision'], PDO::PARAM_INT);
        $stmt->bindParam(":transmision", $datos['transmision'], PDO::PARAM_INT);
        $stmt->bindParam(":tapon_transmision", $datos['tapon_transmision'], PDO::PARAM_INT);
        $stmt->bindParam(":palanca_cambios", $datos['palanca_cambios'], PDO::PARAM_INT);
        $stmt->bindParam(":embrague", $datos['embrague'], PDO::PARAM_INT);
        $stmt->bindParam(":pedal_embrague", $datos['pedal_embrague'], PDO::PARAM_INT);
        $stmt->bindParam(":cruceta_cardan", $datos['cruceta_cardan'], PDO::PARAM_INT);
        $stmt->bindParam(":cojinete_cardan", $datos['cojinete_cardan'], PDO::PARAM_INT);
        $stmt->bindParam(":cadena_cardan", $datos['cadena_cardan'], PDO::PARAM_INT);
        $stmt->bindParam(":aceite_diferencial", $datos['aceite_diferencial'], PDO::PARAM_INT);
        $stmt->bindParam(":drenaje_diferencial", $datos['drenaje_diferencial'], PDO::PARAM_INT);
        $stmt->bindParam(":fuga_transmision", $datos['fuga_transmision'], PDO::PARAM_INT);
        $stmt->bindParam(":fuga_diferencial", $datos['fuga_diferencial'], PDO::PARAM_INT);
        $stmt->bindParam(":muelle_delantero_derecho", $datos['muelle_delantero_derecho'], PDO::PARAM_INT);
        $stmt->bindParam(":amortiguador_delantero_derecho", $datos['amortiguador_delantero_derecho'], PDO::PARAM_INT);
        $stmt->bindParam(":muelle_delantero_izquierdo", $datos['muelle_delantero_izquierdo'], PDO::PARAM_INT);
        $stmt->bindParam(":amortiguador_delantero_izquierdo", $datos['amortiguador_delantero_izquierdo'], PDO::PARAM_INT);
        $stmt->bindParam(":muelle_trasero_derecho", $datos['muelle_trasero_derecho'], PDO::PARAM_INT);
        $stmt->bindParam(":amortiguador_trasero_derecho", $datos['amortiguador_trasero_derecho'], PDO::PARAM_INT);
        $stmt->bindParam(":muelle_trasero_izquierdo", $datos['muelle_trasero_izquierdo'], PDO::PARAM_INT);
        $stmt->bindParam(":amortiguador_trasero_izquierdo", $datos['amortiguador_trasero_izquierdo'], PDO::PARAM_INT);
        $stmt->bindParam(":barra_estabilizadora", $datos['barra_estabilizadora'], PDO::PARAM_INT);
        $stmt->bindParam(":tornillo_pasador_central", $datos['tornillo_pasador_central'], PDO::PARAM_INT);
        $stmt->bindParam(":aceite_hidraulico", $datos['aceite_hidraulico'], PDO::PARAM_INT);
        $stmt->bindParam(":lineas", $datos['lineas'], PDO::PARAM_INT);
        $stmt->bindParam(":pitman", $datos['pitman'], PDO::PARAM_INT);
        $stmt->bindParam(":barra_ejes", $datos['barra_ejes'], PDO::PARAM_INT);
        $stmt->bindParam(":tijeras", $datos['tijeras'], PDO::PARAM_INT);
        $stmt->bindParam(":splinders", $datos['splinders'], PDO::PARAM_INT);
        $stmt->bindParam(":timon", $datos['timon'], PDO::PARAM_INT);
        $stmt->bindParam(":caja_direccion", $datos['caja_direccion'], PDO::PARAM_INT);
        $stmt->bindParam(":cruceta_direccion", $datos['cruceta_direccion'], PDO::PARAM_INT);
        $stmt->bindParam(":fuga_caja", $datos['fuga_caja'], PDO::PARAM_INT);
        $stmt->bindParam(":nivel_fluido", $datos['nivel_fluido'], PDO::PARAM_INT);
        $stmt->bindParam(":tuberias", $datos['tuberias'], PDO::PARAM_INT);
        $stmt->bindParam(":freno_parqueo", $datos['freno_parqueo'], PDO::PARAM_INT);
        $stmt->bindParam(":frenos", $datos['frenos'], PDO::PARAM_INT);
        $stmt->bindParam(":pedal_freno", $datos['pedal_freno'], PDO::PARAM_INT);
        $stmt->bindParam(":compresor", $datos['compresor'], PDO::PARAM_INT);
        $stmt->bindParam(":fuga_aire", $datos['fuga_aire'], PDO::PARAM_INT);
        $stmt->bindParam(":banda_delantera_derecha", $datos['banda_delantera_derecha'], PDO::PARAM_INT);
        $stmt->bindParam(":banda_delantera_izquierda", $datos['banda_delantera_izquierda'], PDO::PARAM_INT);
        $stmt->bindParam(":banda_trasera_derecha", $datos['banda_trasera_derecha'], PDO::PARAM_INT);
        $stmt->bindParam(":banda_trasera_izquierda", $datos['banda_trasera_izquierda'], PDO::PARAM_INT);
        $stmt->bindParam(":rachets", $datos['rachets'], PDO::PARAM_INT);
        $stmt->bindParam(":discos_delanteros", $datos['discos_delanteros'], PDO::PARAM_INT);
        $stmt->bindParam(":discos_traseros", $datos['discos_traseros'], PDO::PARAM_INT);
        $stmt->bindParam(":pastillas_freno", $datos['pastillas_freno'], PDO::PARAM_INT);
        $stmt->bindParam(":rines", $datos['rines'], PDO::PARAM_INT);
        $stmt->bindParam(":llantar1", $datos['llantar1'], PDO::PARAM_INT);
        $stmt->bindParam(":llantar2", $datos['llantar2'], PDO::PARAM_INT);
        $stmt->bindParam(":llantar3", $datos['llantar3'], PDO::PARAM_INT);
        $stmt->bindParam(":llantar4", $datos['llantar4'], PDO::PARAM_INT);
        $stmt->bindParam(":llantar5", $datos['llantar5'], PDO::PARAM_INT);
        $stmt->bindParam(":llantar6", $datos['llantar6'], PDO::PARAM_INT);
        $stmt->bindParam(":llanta_repuesto", $datos['llanta_repuesto'], PDO::PARAM_INT);
        $stmt->bindParam(":tanques_aire", $datos['tanques_aire'], PDO::PARAM_INT);
        $stmt->bindParam(":luces_altas", $datos['luces_altas'], PDO::PARAM_INT);
        $stmt->bindParam(":luces_bajas", $datos['luces_bajas'], PDO::PARAM_INT);
        $stmt->bindParam(":luces_direccionales", $datos['luces_direccionales'], PDO::PARAM_INT);
        $stmt->bindParam(":luces_estacionarias", $datos['luces_estacionarias'], PDO::PARAM_INT);
        $stmt->bindParam(":luces_laterales", $datos['luces_laterales'], PDO::PARAM_INT);
        $stmt->bindParam(":luz_reversa", $datos['luz_reversa'], PDO::PARAM_INT);
        $stmt->bindParam(":luces_internas", $datos['luces_internas'], PDO::PARAM_INT);
        $stmt->bindParam(":luces_delimitadoras", $datos['luces_delimitadoras'], PDO::PARAM_INT);
        $stmt->bindParam(":alarma_reversa", $datos['alarma_reversa'], PDO::PARAM_INT);
        $stmt->bindParam(":motor_arranque", $datos['motor_arranque'], PDO::PARAM_INT);
        $stmt->bindParam(":alternador", $datos['alternador'], PDO::PARAM_INT);
        $stmt->bindParam(":baterias", $datos['baterias'], PDO::PARAM_INT);
        $stmt->bindParam(":pito", $datos['pito'], PDO::PARAM_INT);
        $stmt->bindParam(":rutero", $datos['rutero'], PDO::PARAM_INT);
        $stmt->bindParam(":cables_conexiones", $datos['cables_conexiones'], PDO::PARAM_INT);
        $stmt->bindParam(":fusibles", $datos['fusibles'], PDO::PARAM_INT);
        $stmt->bindParam(":presion_aceite", $datos['presion_aceite'], PDO::PARAM_INT);
        $stmt->bindParam(":temperatura_motor", $datos['temperatura_motor'], PDO::PARAM_INT);
        $stmt->bindParam(":velocimetro", $datos['velocimetro'], PDO::PARAM_INT);
        $stmt->bindParam(":nivel_combustible", $datos['nivel_combustible'], PDO::PARAM_INT);
        $stmt->bindParam(":presion_aire", $datos['presion_aire'], PDO::PARAM_INT);
        $stmt->bindParam(":carga_bateria", $datos['carga_bateria'], PDO::PARAM_INT);
        $stmt->bindParam(":techo_exterior", $datos['techo_exterior'], PDO::PARAM_INT);
        $stmt->bindParam(":techo_interior", $datos['techo_interior'], PDO::PARAM_INT);
        $stmt->bindParam(":bomper_delantero", $datos['bomper_delantero'], PDO::PARAM_INT);
        $stmt->bindParam(":bomper_trasero", $datos['bomper_trasero'], PDO::PARAM_INT);
        $stmt->bindParam(":frente", $datos['frente'], PDO::PARAM_INT);
        $stmt->bindParam(":lamina_lateral_derecho", $datos['lamina_lateral_derecho'], PDO::PARAM_INT);
        $stmt->bindParam(":lamina_lateral_izquierdo", $datos['lamina_lateral_izquierdo'], PDO::PARAM_INT);
        $stmt->bindParam(":puerta_principal", $datos['puerta_principal'], PDO::PARAM_INT);
        $stmt->bindParam(":puerta_lateral", $datos['puerta_lateral'], PDO::PARAM_INT);
        $stmt->bindParam(":estribos_puerta", $datos['estribos_puerta'], PDO::PARAM_INT);
        $stmt->bindParam(":sillas", $datos['sillas'], PDO::PARAM_INT);
        $stmt->bindParam(":descansa_brazos", $datos['descansa_brazos'], PDO::PARAM_INT);
        $stmt->bindParam(":bocallanta", $datos['bocallanta'], PDO::PARAM_INT);
        $stmt->bindParam(":guardapolvos", $datos['guardapolvos'], PDO::PARAM_INT);
        $stmt->bindParam(":piso", $datos['piso'], PDO::PARAM_INT);
        $stmt->bindParam(":parabrisas_derecho", $datos['parabrisas_derecho'], PDO::PARAM_INT);
        $stmt->bindParam(":brazo_limpiaparabrisas_derecho", $datos['brazo_limpiaparabrisas_derecho'], PDO::PARAM_INT);
        $stmt->bindParam(":plumillas_limpiaparabrisas_derecho", $datos['plumillas_limpiaparabrisas_derecho'], PDO::PARAM_INT);
        $stmt->bindParam(":parabrisas_izquierdo", $datos['parabrisas_izquierdo'], PDO::PARAM_INT);
        $stmt->bindParam(":brazo_limpiaparabrisas_izquierdo", $datos['brazo_limpiaparabrisas_izquierdo'], PDO::PARAM_INT);
        $stmt->bindParam(":plumillas_limpiaparabrisas_izquierdo", $datos['plumillas_limpiaparabrisas_izquierdo'], PDO::PARAM_INT);
        $stmt->bindParam(":espejo_retrovisor_derecho", $datos['espejo_retrovisor_derecho'], PDO::PARAM_INT);
        $stmt->bindParam(":espejo_retrovisor_izquierdo", $datos['espejo_retrovisor_izquierdo'], PDO::PARAM_INT);
        $stmt->bindParam(":espejo_central", $datos['espejo_central'], PDO::PARAM_INT);
        $stmt->bindParam(":ventanas_lado_derecho", $datos['ventanas_lado_derecho'], PDO::PARAM_INT);
        $stmt->bindParam(":ventanas_lado_izquierdo", $datos['ventanas_lado_izquierdo'], PDO::PARAM_INT);
        $stmt->bindParam(":parabrisas_trasero", $datos['parabrisas_trasero'], PDO::PARAM_INT);
        $stmt->bindParam(":vidrio_puerta_principal", $datos['vidrio_puerta_principal'], PDO::PARAM_INT);
        $stmt->bindParam(":vidrio_segunda_puerta", $datos['vidrio_segunda_puerta'], PDO::PARAM_INT);
        $stmt->bindParam(":manijas", $datos['manijas'], PDO::PARAM_INT);
        $stmt->bindParam(":claraboyas", $datos['claraboyas'], PDO::PARAM_INT);
        $stmt->bindParam(":airbag", $datos['airbag'], PDO::PARAM_INT);
        $stmt->bindParam(":aire_acondicionado", $datos['aire_acondicionado'], PDO::PARAM_INT);
        $stmt->bindParam(":limpieza", $datos['limpieza'], PDO::PARAM_INT);
        $stmt->bindParam(":chapas", $datos['chapas'], PDO::PARAM_INT);
        $stmt->bindParam(":parales", $datos['parales'], PDO::PARAM_INT);
        $stmt->bindParam(":booster_puertas", $datos['booster_puertas'], PDO::PARAM_INT);
        $stmt->bindParam(":reloj_vigia", $datos['reloj_vigia'], PDO::PARAM_INT);
        $stmt->bindParam(":vigia_delantera_derecha", $datos['vigia_delantera_derecha'], PDO::PARAM_INT);
        $stmt->bindParam(":vigia_delantera_izquierda", $datos['vigia_delantera_izquierda'], PDO::PARAM_INT);
        $stmt->bindParam(":vigia_trasera_derecha", $datos['vigia_trasera_derecha'], PDO::PARAM_INT);
        $stmt->bindParam(":vigia_trasera_izquierda", $datos['vigia_trasera_izquierda'], PDO::PARAM_INT);
        $stmt->bindParam(":tapa_motor", $datos['tapa_motor'], PDO::PARAM_INT);
        $stmt->bindParam(":tapa_bodegas", $datos['tapa_bodegas'], PDO::PARAM_INT);
        $stmt->bindParam(":parasol", $datos['parasol'], PDO::PARAM_INT);
        $stmt->bindParam(":cenefas", $datos['cenefas'], PDO::PARAM_INT);
        $stmt->bindParam(":emblema_izquierdo", $datos['emblema_izquierdo'], PDO::PARAM_INT);
        $stmt->bindParam(":emblema_derecho", $datos['emblema_derecho'], PDO::PARAM_INT);
        $stmt->bindParam(":emblema_trasero", $datos['emblema_trasero'], PDO::PARAM_INT);
        $stmt->bindParam(":equipo_audio", $datos['equipo_audio'], PDO::PARAM_INT);
        $stmt->bindParam(":parlantes", $datos['parlantes'], PDO::PARAM_INT);
        $stmt->bindParam(":cinturon_usuario", $datos['cinturon_usuario'], PDO::PARAM_INT);
        $stmt->bindParam(":martillo_emergencia", $datos['martillo_emergencia'], PDO::PARAM_INT);
        $stmt->bindParam(":dispositivo_velocidad", $datos['dispositivo_velocidad'], PDO::PARAM_INT);
        $stmt->bindParam(":avisos", $datos['avisos'], PDO::PARAM_INT);
        $stmt->bindParam(":placa_trasera", $datos['placa_trasera'], PDO::PARAM_INT);
        $stmt->bindParam(":placa_delantera", $datos['placa_delantera'], PDO::PARAM_INT);
        $stmt->bindParam(":placa_lateral_derecha", $datos['placa_lateral_derecha'], PDO::PARAM_INT);
        $stmt->bindParam(":placa_lateral_izquierda", $datos['placa_lateral_izquierda'], PDO::PARAM_INT);
        $stmt->bindParam(":balizas", $datos['balizas'], PDO::PARAM_INT);
        $stmt->bindParam(":cinturon", $datos['cinturon'], PDO::PARAM_INT);
        $stmt->bindParam(":gato", $datos['gato'], PDO::PARAM_INT);
        $stmt->bindParam(":copa", $datos['copa'], PDO::PARAM_INT);
        $stmt->bindParam(":senales_carretera", $datos['senales_carretera'], PDO::PARAM_INT);
        $stmt->bindParam(":botiquin", $datos['botiquin'], PDO::PARAM_INT);
        $stmt->bindParam(":extintor", $datos['extintor'], PDO::PARAM_INT);
        $stmt->bindParam(":tacos", $datos['tacos'], PDO::PARAM_INT);
        $stmt->bindParam(":alicate", $datos['alicate'], PDO::PARAM_INT);
        $stmt->bindParam(":destornilladores", $datos['destornilladores'], PDO::PARAM_INT);
        $stmt->bindParam(":llave_expansion", $datos['llave_expansion'], PDO::PARAM_INT);
        $stmt->bindParam(":llaves_fijas", $datos['llaves_fijas'], PDO::PARAM_INT);
        $stmt->bindParam(":linterna", $datos['linterna'], PDO::PARAM_INT);
        $stmt->bindParam(":observacion",$datos['observacion'], PDO::PARAM_STR);

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }
}
