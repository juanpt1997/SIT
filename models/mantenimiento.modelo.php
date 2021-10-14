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

        $stmt->bindParam( ":id", $idvehiculo, PDO::PARAM_INT);

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
