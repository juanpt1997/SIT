<?php

//INCLUIMOS LA CONFIGURACIÓN Y LA CONEXION PARA EL FUNCIONAMIENTO DEL PROYECTO
include_once DIR_APP . 'config/conexion.php';

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

            $stmt = Conexion::conectar()->prepare("SELECT v.placa, v.numinterno, v.modelo, v.fechamatricula, t.tipovehiculo, m.marca, p.Nombre AS conductor, i.*
                                                    FROM m_inventario i
                                                    INNER JOIN v_vehiculos v ON v.idvehiculo = i.idvehiculo
                                                    INNER JOIN v_marcas m ON m.idmarca = v.idmarca
                                                    INNER JOIN v_tipovehiculos t ON t.idtipovehiculo = v.idtipovehiculo
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

    /* ===========================================
        REVISION POR ID 
        =========================================== */

    static public function mdlRevisionxid($idrevision)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM m_revisiontm WHERE idtm = :idrevision");

        $stmt->bindParam(":idrevision", $idrevision, PDO::PARAM_INT);
        $stmt->execute();
        $respuesta = $stmt->fetch();
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
                `cant_martillos`,
                `dispositivo_velocidad`,
                `avisos`,
                `cant_internos`,
                `cant_externos`,
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
                :cant_martillos,
                :dispositivo_velocidad,
                :avisos,
                :cant_internos,
                :cant_externos,
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
        $stmt->bindParam(":cant_martillos", $datos['cant_martillos'], PDO::PARAM_INT);
        $stmt->bindParam(":dispositivo_velocidad", $datos['dispositivo_velocidad'], PDO::PARAM_INT);
        $stmt->bindParam(":avisos", $datos['avisos'], PDO::PARAM_INT);
        $stmt->bindParam(":cant_internos", $datos['cant_internos'], PDO::PARAM_INT);
        $stmt->bindParam(":cant_externos", $datos['cant_externos'], PDO::PARAM_INT);
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
        $stmt->bindParam(":observacion", $datos['observacion'], PDO::PARAM_STR);

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }






    /* =============================================
        EDITAR REVISION
    ================================================ */

    static public function mdlEditarRevision($datos)
    {
        $stmt = Conexion::conectar()->prepare(
            "UPDATE `m_revisiontm` SET
        `idvehiculo`= :idvehiculo, 
        `kilometraje`= :kilometraje,
        `nivelrefrigerante`= :nivelrefrigerante,
        `nivelaceite`= :nivelaceite,
        `radiador`= :radiador,
        `mangueras`= :mangueras,
        `correas`= :correas,
        `motor`= :motor,
        `freno_ahogo`= :freno_ahogo,
        `exosto`= :exosto,
        `guaya`= :guaya,
        `turbo`= :turbo,
        `tapa_radiador`= :tapa_radiador,
        `fuga_aceite`= :fuga_aceite,
        `fuga_combustible`= :fuga_combustible,
        `nivel_aceite_transmision`= :nivel_aceite_transmision,
        `transmision`= :transmision,
        `tapon_transmision`= :tapon_transmision,
        `palanca_cambios`= :palanca_cambios,
        `embrague`= :embrague,
        `pedal_embrague`= :pedal_embrague,
        `cruceta_cardan`= :cruceta_cardan,
        `cojinete_cardan`= :cojinete_cardan,
        `cadena_cardan`= :cadena_cardan,
        `aceite_diferencial`= :aceite_diferencial,
        `drenaje_diferencial`= :drenaje_diferencial,
        `fuga_transmision`= :fuga_transmision,
        `fuga_diferencial`= :fuga_diferencial,
        `muelle_delantero_derecho`= :muelle_delantero_derecho,
        `amortiguador_delantero_derecho`= :amortiguador_delantero_derecho,
        `muelle_delantero_izquierdo`= :muelle_delantero_izquierdo,
        `amortiguador_delantero_izquierdo`= :amortiguador_delantero_izquierdo,
        `muelle_trasero_derecho`= :muelle_trasero_derecho,
        `amortiguador_trasero_derecho`= :amortiguador_trasero_derecho,
        `muelle_trasero_izquierdo`= :muelle_trasero_izquierdo,
        `amortiguador_trasero_izquierdo`= :amortiguador_trasero_izquierdo,
        `barra_estabilizadora`= :barra_estabilizadora,
        `tornillo_pasador_central`= :tornillo_pasador_central,
        `aceite_hidraulico`= :aceite_hidraulico,
        `lineas`= :lineas,
        `pitman`= :pitman,
        `barra_ejes`= :barra_ejes,
        `tijeras`= :tijeras,
        `splinders`= :splinders,
        `timon`= :timon, 
        `caja_direccion`= :caja_direccion,
        `cruceta_direccion`= :cruceta_direccion,
        `fuga_caja`= :fuga_caja,
        `nivel_fluido`= :nivel_fluido,
        `tuberias`= :tuberias,
        `freno_parqueo`= :freno_parqueo,
        `frenos`= :frenos,
        `pedal_freno`= :pedal_freno,
        `compresor`= :compresor,
        `fuga_aire`= :fuga_aire,
        `banda_delantera_derecha`= :banda_delantera_derecha,
        `banda_delantera_izquierda`= :banda_delantera_izquierda,
        `banda_trasera_derecha`= :banda_trasera_derecha,
        `banda_trasera_izquierda`= :banda_trasera_izquierda,
        `rachets`= :rachets,
        `discos_delanteros`= :discos_delanteros,
        `discos_traseros`= :discos_traseros,
        `pastillas_freno`= :pastillas_freno,
        `rines`= :rines,
        `llantar1`= :llantar1,
        `llantar2`= :llantar2,
        `llantar3`= :llantar3,
        `llantar4`= :llantar4,
        `llantar5`= :llantar5,
        `llantar6`= :llantar6,
        `llanta_repuesto`= :llanta_repuesto,
        `tanques_aire`= :tanques_aire,
        `luces_altas`= :luces_altas,
        `luces_bajas`= :luces_bajas,
        `luces_direccionales`= :luces_direccionales,
        `luces_estacionarias`= :luces_estacionarias,
        `luces_laterales`= :luces_laterales,
        `luz_reversa`= :luz_reversa,
        `luces_internas`= :luces_internas,
        `luces_delimitadoras`= :luces_delimitadoras,
        `alarma_reversa`= :alarma_reversa,
        `motor_arranque`= :motor_arranque,
        `alternador`= :alternador,
        `baterias`= :baterias,
        `pito`= :pito,
        `rutero`= :rutero,
        `cables_conexiones`= :cables_conexiones,
        `fusibles`= :fusibles,
        `presion_aceite`= :presion_aceite,
        `temperatura_motor`= :temperatura_motor,
        `velocimetro`= :velocimetro,
        `nivel_combustible`= :nivel_combustible,
        `presion_aire`= :presion_aire,
        `carga_bateria`= :carga_bateria,
        `techo_exterior`= :techo_exterior,
        `techo_interior`= :techo_interior,
        `bomper_delantero`= :bomper_delantero,
        `bomper_trasero`= :bomper_trasero,
        `frente`= :frente,
        `lamina_lateral_derecho`= :lamina_lateral_derecho,
        `lamina_lateral_izquierdo`= :lamina_lateral_izquierdo,
        `puerta_principal`= :puerta_principal,
        `puerta_lateral`= :puerta_lateral,
        `estribos_puerta`= :estribos_puerta,
        `sillas`= :sillas,
        `descansa_brazos`= :descansa_brazos,
        `bocallanta`= :bocallanta,
        `guardapolvos`= :guardapolvos,
        `piso`= :piso,
        `parabrisas_derecho`= :parabrisas_derecho,
        `brazo_limpiaparabrisas_derecho`= :brazo_limpiaparabrisas_derecho,
        `plumillas_limpiaparabrisas_derecho`= :plumillas_limpiaparabrisas_derecho,
        `parabrisas_izquierdo`= :parabrisas_izquierdo,
        `brazo_limpiaparabrisas_izquierdo`= :brazo_limpiaparabrisas_izquierdo,
        `plumillas_limpiaparabrisas_izquierdo`= :plumillas_limpiaparabrisas_izquierdo,
        `espejo_retrovisor_derecho`= :espejo_retrovisor_derecho,
        `espejo_retrovisor_izquierdo`= :espejo_retrovisor_izquierdo,
        `espejo_central`= :espejo_central,
        `ventanas_lado_derecho`= :ventanas_lado_derecho,
        `ventanas_lado_izquierdo`= :ventanas_lado_izquierdo,
        `parabrisas_trasero`= :parabrisas_trasero,
        `vidrio_puerta_principal`= :vidrio_puerta_principal,
        `vidrio_segunda_puerta`= :vidrio_segunda_puerta,
        `manijas`= :manijas,
        `claraboyas`= :claraboyas,
        `airbag`= :airbag,
        `aire_acondicionado`= :aire_acondicionado,
        `limpieza`= :limpieza,
        `chapas`= :chapas,
        `parales`= :parales,
        `booster_puertas`= :booster_puertas,
        `reloj_vigia`= :reloj_vigia,
        `vigia_delantera_derecha`= :vigia_delantera_derecha,
        `vigia_delantera_izquierda`= :vigia_delantera_izquierda,
        `vigia_trasera_derecha`= :vigia_trasera_derecha,
        `vigia_trasera_izquierda`= :vigia_trasera_izquierda,
        `tapa_motor`= :tapa_motor,
        `tapa_bodegas`= :tapa_bodegas,
        `parasol`= :parasol,
        `cenefas`= :cenefas,
        `emblema_izquierdo`= :emblema_izquierdo,
        `emblema_derecho`= :emblema_derecho,
        `emblema_trasero`= :emblema_trasero,
        `equipo_audio`= :equipo_audio,
        `parlantes`= :parlantes,
        `cinturon_usuario`= :cinturon_usuario,
        `martillo_emergencia`= :martillo_emergencia, 
        `cant_martillos`= :cant_martillos, 
        `dispositivo_velocidad`= :dispositivo_velocidad,
        `avisos`= :avisos,
        `cant_internos` =:cant_internos,
        `cant_externos` =:cant_externos,
        `placa_trasera`= :placa_trasera,
        `placa_delantera`= :placa_delantera,
        `placa_lateral_derecha`= :placa_lateral_derecha,
        `placa_lateral_izquierda`= :placa_lateral_izquierda,
        `balizas`= :balizas,
        `cinturon`= :cinturon,
        `gato`= :gato,
        `copa`= :copa,
        `senales_carretera`= :senales_carretera,
        `botiquin`= :botiquin,
        `extintor`= :extintor,
        `tacos`= :tacos,
        `alicate`= :alicate,
        `destornilladores`= :destornilladores,
        `llave_expansion`= :llave_expansion,
        `llaves_fijas`= :llaves_fijas,
        `linterna`= :linterna,
        `observacion`= :observacion
        WHERE idtm = :idrevision"
        );


        $stmt->bindParam(":idrevision", $datos['idrevision'], PDO::PARAM_INT);
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
        $stmt->bindParam(":cant_martillos", $datos['cant_martillos'], PDO::PARAM_INT);
        $stmt->bindParam(":dispositivo_velocidad", $datos['dispositivo_velocidad'], PDO::PARAM_INT);
        $stmt->bindParam(":avisos", $datos['avisos'], PDO::PARAM_INT);
        $stmt->bindParam(":cant_internos", $datos['cant_internos'], PDO::PARAM_INT);
        $stmt->bindParam(":cant_externos", $datos['cant_externos'], PDO::PARAM_INT);
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
        $stmt->bindParam(":observacion", $datos['observacion'], PDO::PARAM_STR);

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }

    static public function mdlEliminarRevision($idrevision)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE `m_revisiontm` SET
        `estado`= 0
        WHERE idtm = :idrevision");

        $stmt->bindParam(":idrevision", $idrevision, PDO::PARAM_INT);

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

class ModeloMantenimientos
{

    /* ===================================================
        AGREGAR SOLICITUD DE SERVICIO    
    ===================================================*/

    static public function mdlAgregarSolicitud($datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO m_solicitudservicio(idvehiculo,fecha,idservicio_externo, idrepuesto, cantidad) VALUES(:idvehiculo,:fecha,:idservicio_externo, :idrepuesto, :cantidad)");
        $stmt->bindParam(":idvehiculo", $datos['idvehiculo_repuestos'], PDO::PARAM_INT);
        $stmt->bindParam(":fecha", $datos['fecha_repuestos'], PDO::PARAM_STR);
        $stmt->bindParam(":idservicio_externo", $datos['servicioexterno_1'], PDO::PARAM_STR);
        $stmt->bindParam(":idrepuesto", $datos['repuesto'], PDO::PARAM_INT);
        $stmt->bindParam(":cantidad", $datos['cantidad_repuesto'], PDO::PARAM_INT);

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
        LISTADO SERVICIOS EXTERNOS
    ===================================================*/

    static public function mdlListadoServiciosExternos()
    {
        $stmt = Conexion::conectar()->prepare("SELECT s.* FROM m_serviciosexternos s WHERE s.estado = 1");
        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    static public function mdlServicioExternoxId()
    {
        $stmt = Conexion::conectar()->prepare("SELECT s.* FROM m_serviciosexternos s");
        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================================================
        LISTADO PRODUCTOS
    ===================================================*/
    static public function mdlListadoProductos()
    {
        //     $stmt = Conexion::conectar()->prepare("SELECT i.*, s.sucursal, p.*, m.medida, mc.marca, ct.categoria, 
        //     (
        //    SELECT mi.preciocompra
        //    FROM a_re_movimientoinven mi
        //    WHERE mi.idinventario = i.idinventario AND mi.tipo_movimiento = 'ENTRADA' AND mi.preciocompra IS NOT NULL
        //    ORDER BY mi.fecha DESC
        //    LIMIT 1) AS precio_compra, 
        //             (
        //    SELECT mi.idproveedor
        //    FROM a_re_movimientoinven mi
        //    WHERE mi.idinventario = i.idinventario AND mi.tipo_movimiento = 'ENTRADA' AND mi.idproveedor IS NOT NULL
        //    ORDER BY mi.fecha DESC
        //    LIMIT 1) AS idproveedor,
        //     (
        //    SELECT cp.nombre_contacto
        //    FROM a_re_movimientoinven mi
        //    INNER JOIN c_proveedores cp ON mi.idproveedor = cp.id
        //    WHERE mi.idinventario = i.idinventario AND mi.tipo_movimiento = 'ENTRADA' AND mi.idproveedor IS NOT NULL
        //    ORDER BY mi.fecha DESC 
        //    LIMIT 1) AS nombre_proveedor
        //    FROM a_re_inventario i
        //    INNER JOIN gh_sucursales s ON i.idsucursal = s.ids
        //    INNER JOIN a_productos p ON i.idproducto = p.idproducto
        //    LEFT JOIN a_medidas m ON p.idmedida = m.idmedidas
        //    LEFT JOIN a_marcas mc ON p.idmarca = mc.idmarca
        //    LEFT JOIN a_categorias ct ON p.idcategoria = ct.idcategorias


        //   ");

        $stmt = Conexion::conectar()->prepare("SELECT i.*, s.sucursal, p.*, m.medida, mc.marca, ct.categoria,
                                                mi.preciocompra AS precio_compra, mi.idproveedor,
                                                prov.razon_social AS nombre_proveedor
                                                FROM a_re_inventario i
                                                INNER JOIN gh_sucursales s ON i.idsucursal = s.ids
                                                INNER JOIN a_productos p ON i.idproducto = p.idproducto
                                                LEFT JOIN a_medidas m ON p.idmedida = m.idmedidas
                                                LEFT JOIN a_marcas mc ON p.idmarca = mc.idmarca
                                                LEFT JOIN a_categorias ct ON p.idcategoria = ct.idcategorias
                                                LEFT JOIN a_re_movimientoinven mi ON mi.idinventario = i.idinventario
                                                LEFT JOIN c_proveedores prov ON prov.id = mi.idproveedor
                                                WHERE (mi.idmovimiento, mi.idinventario) 
                                                        IN (
                                                            SELECT MAX(mi1.idmovimiento), mi1.idinventario
                                                            FROM a_re_movimientoinven mi1
                                                            WHERE mi1.tipo_movimiento = 'ENTRADA' AND mi1.preciocompra IS NOT NULL
                                                            GROUP BY mi1.idinventario
                                                            )
                                                GROUP BY mi.idinventario");
        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================================================
        LISTADO DE ORDENES DE SERVICIO
    ===================================================*/
    static public function mdlListadoOrdenesServicio()
    {
        $stmt = Conexion::conectar()->prepare("SELECT o.*, v.*, m.municipio,u.Nombre, DATE_FORMAT(o.fecha_entrada, '%d/%m/%Y') AS Ffecha_entrada, DATE_FORMAT(o.fecha_trabajos, '%d/%m/%Y') AS Ffecha_trabajos, 
        DATE_FORMAT(o.fecha_aprobacion, '%d/%m/%Y') AS Ffecha_aprobacion FROM m_ordenservicio o 
        INNER JOIN v_vehiculos v ON o.idvehiculo = v.idvehiculo
        LEFT JOIN gh_municipios m ON o.ciudad = m.idmunicipio 
        INNER JOIN l_usuarios u ON o.cedula = u.Cedula
        ");

        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================================================
        LISTADO DE SERVICIOS     
    ===================================================*/

    static public function mdlServicios()
    {

        /* ===================================================
           ALTERNATIVA DE CONSULTA, ESTO PARA TRAER AUTOMATICAMENTE EL REGISTRO MÁS RECIENTE (NO BORRAR PORQUE HAY QUE ANALIZAR ESTO PRIMERO)
           ================================================================


           
           SELECT v.placa, v.kilometraje AS kilometraje_actual, sm.idserviciovehiculo AS idserviciovehiculo, 
                sm.idvehiculo, 
                sm.idservicio,s.kilometraje_cambio AS kilometraje_servicio, 
                (s.kilometraje_cambio + sm.kilometraje) AS kilometraje_cambio, sm.fecha AS fecha, DATE_FORMAT(sm.fecha, '%d/%m/%y') AS Ffecha, 
                s.servicio, DATE_FORMAT(DATE_ADD(sm.fecha, INTERVAL s.dias_cambio DAY), '%d/%m/%Y') AS fecha_cambio, DATE_ADD(sm.fecha, INTERVAL s.dias_cambio DAY) AS fecha_comparar
            FROM m_re_serviciosvehiculos sm
            INNER JOIN m_serviciosmenores s ON sm.idservicio = s.idservicio
            INNER JOIN v_vehiculos v ON sm.idvehiculo = v.idvehiculo
            WHERE (sm.idserviciovehiculo, sm.idvehiculo, sm.idservicio) 
                    IN (
                        SELECT MAX(sm1.idserviciovehiculo), sm1.idvehiculo, sm1.idservicio
                        FROM 
                        m_re_serviciosvehiculos sm1
                        GROUP BY sm1.idvehiculo, sm1.idservicio
                        )
            GROUP BY sm.idvehiculo, sm.idservicio
            ORDER BY sm.fecha DESC;
        ===================================================*/
        $stmt = Conexion::conectar()->prepare(
            //     "SELECT v.placa, v.kilometraje AS kilometraje_actual, MAX(sm.idserviciovehiculo) AS idserviciovehiculo, sm.idvehiculo, sm.idservicio,s.kilometraje_cambio AS kilometraje_servicio, (s.kilometraje_cambio + MAX(sm.kilometraje)) AS kilometraje_cambio,
            // MAX(sm.fecha) AS fecha, DATE_FORMAT(MAX(sm.fecha), '%d/%m/%y') AS Ffecha, s.servicio, DATE_FORMAT(date_add(sm.fecha, INTERVAL s.dias_cambio DAY), '%d/%m/%Y') AS fecha_cambio, date_add(sm.fecha, INTERVAL s.dias_cambio DAY) AS fecha_comparar 
            // FROM m_re_serviciosvehiculos sm
            // INNER JOIN m_serviciosmenores s ON sm.idservicio = s.idservicio
            // INNER JOIN v_vehiculos v ON sm.idvehiculo = v.idvehiculo
            // GROUP BY sm.idvehiculo, sm.idservicio
            // ORDER BY sm.fecha DESC"

            "SELECT v.placa, v.kilometraje AS kilometraje_actual, MAX(sm.idserviciovehiculo) AS idserviciovehiculo, sm.idvehiculo, sm.idservicio,s.kilometraje_cambio AS kilometraje_servicio, (s.kilometraje_cambio + MAX(sm.kilometraje)) AS kilometraje_cambio,
        MAX(sm.fecha) AS fecha, DATE_FORMAT(MAX(sm.fecha), '%d/%m/%y') AS Ffecha, s.servicio, DATE_FORMAT(date_add(sm.fecha, INTERVAL s.dias_cambio DAY), '%d/%m/%Y') AS fecha_cambio, date_add(sm.fecha, INTERVAL s.dias_cambio DAY) AS fecha_comparar 
        FROM m_re_serviciosvehiculos sm
        INNER JOIN m_serviciosmenores s ON sm.idservicio = s.idservicio
        INNER JOIN v_vehiculos v ON sm.idvehiculo = v.idvehiculo
        WHERE s.estado = 1 AND date_add(sm.fecha, INTERVAL s.dias_cambio DAY)  <= DATE_ADD(NOW(),INTERVAL 30 DAY) 
        GROUP BY sm.idvehiculo, sm.idservicio
        ORDER BY sm.fecha DESC"
        );

        $stmt->execute();
        $respuesta = $stmt->fetchAll();
        $stmt->closeCursor();
        return $respuesta;
    }

    /* ===================================================
        LISTADO DE SERVICIOS RECIENTES POR ID VEHICULO
    ===================================================*/

    static public function mdlServiciosRecientesxVehiculo($idvehiculo)
    {
        $stmt = Conexion::conectar()->prepare(
            // "SELECT v.placa, v.kilometraje AS kilometraje_actual, MAX(sm.idserviciovehiculo) AS idserviciovehiculo, sm.idvehiculo, sm.idservicio,s.kilometraje_cambio AS kilometraje_servicio, (s.kilometraje_cambio + MAX(sm.kilometraje)) AS kilometraje_cambio,
            // MAX(sm.fecha) AS fecha, DATE_FORMAT(MAX(sm.fecha), '%d/%m/%y') AS Ffecha, s.servicio, DATE_FORMAT(date_add(sm.fecha, INTERVAL s.dias_cambio DAY), '%d/%m/%Y') AS fecha_cambio, date_add(sm.fecha, INTERVAL s.dias_cambio DAY) AS fecha_comparar 
            // FROM m_re_serviciosvehiculos sm
            // INNER JOIN m_serviciosmenores s ON sm.idservicio = s.idservicio
            // INNER JOIN v_vehiculos v ON sm.idvehiculo = v.idvehiculo
            // WHERE sm.idvehiculo = :idvehiculo
            // GROUP BY sm.idvehiculo, sm.idservicio
            // ORDER BY sm.fecha DESC"

            "SELECT v.placa, v.kilometraje AS kilometraje_actual, MAX(sm.idserviciovehiculo) AS idserviciovehiculo, sm.idvehiculo, sm.idservicio,s.kilometraje_cambio AS kilometraje_servicio, (s.kilometraje_cambio + MAX(sm.kilometraje)) AS kilometraje_cambio,
        MAX(sm.fecha) AS fecha, DATE_FORMAT(MAX(sm.fecha), '%d/%m/%y') AS Ffecha, s.servicio, DATE_FORMAT(date_add(sm.fecha, INTERVAL s.dias_cambio DAY), '%d/%m/%Y') AS fecha_cambio, date_add(sm.fecha, INTERVAL s.dias_cambio DAY) AS fecha_comparar 
        FROM m_re_serviciosvehiculos sm
        INNER JOIN m_serviciosmenores s ON sm.idservicio = s.idservicio
        INNER JOIN v_vehiculos v ON sm.idvehiculo = v.idvehiculo
        WHERE sm.idvehiculo = :idvehiculo AND s.estado = 1 AND date_add(sm.fecha, INTERVAL s.dias_cambio DAY)  <= DATE_ADD(NOW(),INTERVAL 30 DAY) 
        GROUP BY sm.idvehiculo, sm.idservicio
        ORDER BY sm.fecha DESC"

        );

        $stmt->bindParam(":idvehiculo", $idvehiculo, PDO::PARAM_INT);
        $stmt->execute();
        $respuesta = $stmt->fetchAll();
        $stmt->closeCursor();
        return $respuesta;
    }

    /* ===================================================
    LISTADO DE SERVICIOS RECIENTES POR ID DEL SERVICIO    
    ===================================================*/

    static public function mdlServiciosRecientes($idservicio)
    {
        $stmt = Conexion::conectar()->prepare(
            // "SELECT v.placa, v.kilometraje AS kilometraje_actual, 
            // MAX(sm.idserviciovehiculo) AS idserviciovehiculo, sm.idvehiculo, sm.idservicio,
            // s.kilometraje_cambio AS kilometraje_servicio, (s.kilometraje_cambio + MAX(sm.kilometraje)) AS kilometraje_cambio,
            // MAX(sm.fecha) AS fecha, DATE_FORMAT(MAX(sm.fecha), '%d/%m/%y') AS Ffecha, s.servicio, 
            //   DATE_FORMAT(date_add(sm.fecha, INTERVAL s.dias_cambio DAY), '%d/%m/%Y') AS fecha_cambio, date_add(sm.fecha, INTERVAL s.dias_cambio DAY) AS fecha_comparar 
            // FROM m_re_serviciosvehiculos sm
            // INNER JOIN m_serviciosmenores s ON sm.idservicio = s.idservicio
            // INNER JOIN v_vehiculos v ON sm.idvehiculo = v.idvehiculo
            // WHERE sm.idservicio = :idservicio AND YEAR(date_add(sm.fecha, INTERVAL s.dias_cambio DAY)) = YEAR(CURRENT_DATE()) AND MONTH(date_add(sm.fecha, INTERVAL s.dias_cambio DAY)) BETWEEN MONTH(CURRENT_DATE()) AND (MONTH(CURRENT_DATE()) + 1) AND (v.kilometraje - kilometraje_cambio) <= 1000   
            // GROUP BY sm.idvehiculo, sm.idservicio
            // ORDER BY sm.fecha DESC"

            "SELECT v.placa, v.kilometraje AS kilometraje_actual, MAX(sm.idserviciovehiculo) AS idserviciovehiculo, sm.idvehiculo, sm.idservicio,s.kilometraje_cambio AS kilometraje_servicio, (s.kilometraje_cambio + MAX(sm.kilometraje)) AS kilometraje_cambio,
        MAX(sm.fecha) AS fecha, DATE_FORMAT(MAX(sm.fecha), '%d/%m/%y') AS Ffecha, s.servicio, DATE_FORMAT(date_add(sm.fecha, INTERVAL s.dias_cambio DAY), '%d/%m/%Y') AS fecha_cambio, date_add(sm.fecha, INTERVAL s.dias_cambio DAY) AS fecha_comparar 
        FROM m_re_serviciosvehiculos sm
        INNER JOIN m_serviciosmenores s ON sm.idservicio = s.idservicio
        INNER JOIN v_vehiculos v ON sm.idvehiculo = v.idvehiculo
        WHERE sm.idservicio = :idservicio AND s.estado = 1 AND date_add(sm.fecha, INTERVAL s.dias_cambio DAY)  <= DATE_ADD(NOW(),INTERVAL 30 DAY) 
        GROUP BY sm.idvehiculo, sm.idservicio
        ORDER BY sm.fecha DESC"
        );

        $stmt->bindParam(":idservicio", $idservicio, PDO::PARAM_INT);
        $stmt->execute();
        $respuesta = $stmt->fetchAll();
        $stmt->closeCursor();
        return $respuesta;
    }

    /* ===================================================
        CARGAR DATOS ORDEN DE SERVICIO
    ===================================================*/
    static public function mdlCargarOrdenServicio($idorden)
    {
        $stmt = Conexion::conectar()->prepare("SELECT o.*, m.marca,tv.tipovehiculo, c.idmunicipio , DATE_FORMAT(o.fecha_entrada, '%d-%m-%Y') AS Ffecha_entrada, DATE_FORMAT(o.fecha_trabajos, '%d-%m-%Y') as Ffecha_trabajos,  v.* FROM m_ordenservicio o
        INNER JOIN v_vehiculos v ON o.idvehiculo = v.idvehiculo
        INNER JOIN v_marcas m ON v.idmarca = m.idmarca
        INNER JOIN gh_municipios c ON o.ciudad = c.idmunicipio
        LEFT JOIN v_tipovehiculos tv ON v.idtipovehiculo = tv.idtipovehiculo
        WHERE o.idorden = :idorden");

        $stmt->bindParam(":idorden", $idorden, PDO::PARAM_INT);
        $stmt->execute();
        $respuesta = $stmt->fetch();
        $stmt->closeCursor();
        return $respuesta;
    }

    /* ===================================================
        LISTADO DE REPUESTOS DE UNA ORDEN DE SERVICIO
    ===================================================*/
    static public function mdlRepuestosOrden($idorden)
    {
        $stmt = Conexion::conectar()->prepare("SELECT r.*, i.idproducto, p.*, sm.servicio, cp.nombre_contacto, cp.id, cp.razon_social, cc.num_cuenta, cc.nombre_cuenta
        FROM m_re_repuestoordenservicio r
        INNER JOIN a_re_inventario i ON r.idinventario = i.idinventario
        INNER JOIN a_productos p ON i.idproducto = p.idproducto
        INNER JOIN m_serviciosmenores sm ON r.idservicio = sm.idservicio
        LEFT JOIN c_proveedores cp ON r.idproveedor = cp.id
        LEFT JOIN li_cuentas_contables cc ON r.idcuenta = cc.id
        WHERE r.idorden = :idorden");

        $stmt->bindParam(":idorden", $idorden, PDO::PARAM_INT);
        $stmt->execute();
        $respuesta = $stmt->fetchAll();
        $stmt->closeCursor();
        return $respuesta;
    }

    /* ===================================================
        LISTADO DE MANO DE OBRA DE UNA ORDEN DE SERVICIO
    ===================================================*/
    static public function mdlManoObraOrden($idorden)
    {
        $stmt = Conexion::conectar()->prepare("SELECT m.*, p.*, sm.*, cc.num_cuenta, cc.nombre_cuenta FROM m_re_proveedorordenservicio m
        INNER JOIN c_proveedores p ON m.idproveedor = p.id 
        INNER JOIN m_serviciosmenores sm ON m.idservicio = sm.idservicio
        LEFT JOIN li_cuentas_contables cc ON m.idcuenta = cc.id
        WHERE m.idorden = :idorden");

        $stmt->bindParam(":idorden", $idorden, PDO::PARAM_INT);
        $stmt->execute();
        $respuesta = $stmt->fetchAll();
        $stmt->closeCursor();
        return $respuesta;
    }

    /* ===================================================
    LISTADO DE SERVICIOS EXTERNOS DE UNA ORDEN DE SERVICIO
    ===================================================*/
    static public function mdlServicosExternosOrden($idorden)
    {
        $stmt = Conexion::conectar()->prepare("SELECT sm.*, s.nombre
                                                FROM m_re_serviciosexternosordenservicio sm
                                                LEFT JOIN m_serviciosexternos s ON s.idservicio_externo = sm.idservicio_externo
                                                WHERE sm.idorden = :idorden");

        $stmt->bindParam(":idorden", $idorden, PDO::PARAM_INT);
        $stmt->execute();
        $respuesta = $stmt->fetchAll();
        $stmt->closeCursor();
        return $respuesta;
    }

    /* ===================================================
        AGREGAR ORDEN DE SERVICIO
    ===================================================*/

    static public function mdlAgregarOrdenServicio($datos)
    {

        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("INSERT INTO m_ordenservicio(idvehiculo,hora_entrada,fecha_trabajos,diagnostico,observacion, estado, ciudad, factura, kilometraje_orden, fecha_aprobacion, cedula)
                                                VALUES(:idvehiculo_OrdServ, :horaentra_ordSer, :fechaInic_ordSer, :diagnostico, :observacion, :estado, :ciudad, :factura, :kilometraje_orden, :fecha_aprobacion, :cedula)");

        $stmt->bindParam(":idvehiculo_OrdServ", $datos['idvehiculo_OrdServ'], PDO::PARAM_INT);
        // $stmt->bindParam(":fechaentrada_OrdSer", $datos['fechaentrada_OrdSer'], PDO::PARAM_STR);
        $stmt->bindParam(":horaentra_ordSer", $datos['horaentra_ordSer'], PDO::PARAM_STR);
        $stmt->bindParam(":fechaInic_ordSer", $datos['fechaInic_ordSer'], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_aprobacion", $datos['fecha_aprobacion'], PDO::PARAM_STR);
        $stmt->bindParam(":diagnostico", $datos['diagnostico'], PDO::PARAM_STR);
        $stmt->bindParam(":observacion", $datos['observacion'], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos['estado'], PDO::PARAM_INT);
        $stmt->bindParam(":ciudad", $datos['ciudad_OrdServ'], PDO::PARAM_INT);
        $stmt->bindParam(":factura", $datos['numFactura_ordSer'], PDO::PARAM_STR);
        $stmt->bindParam(":kilometraje_orden", $datos['kilome_ordSer'], PDO::PARAM_INT);
        $stmt->bindParam(":cedula", $datos['cedula'], PDO::PARAM_STR);

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
        ACTUALIZAR ORDEN DE SERVICIO
    ===================================================*/

    static public function mdlActualizarOrden($datos)
    {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("UPDATE `m_ordenservicio` SET 
            `idvehiculo` = :idvehiculo,
            `fecha_entrada` = :fecha_entrada,
            `hora_entrada` = :hora_entrada,
            `fecha_trabajos` = :fecha_trabajos,
            `fecha_aprobacion` = :fecha_aprobacion,
            `diagnostico` = :diagnostico,
            `observacion` = :observacion,
            `estado` = :estado,
            `ciudad` = :ciudad,
            `factura` = :factura,
            `kilometraje_orden` = :kilometraje_orden
            WHERE `idorden`= :idorden");

        $stmt->bindParam(":idorden", $datos['numOrden_ordSer'], PDO::PARAM_INT);
        $stmt->bindParam(":idvehiculo", $datos['idvehiculo_OrdServ'], PDO::PARAM_INT);
        $stmt->bindParam(":fecha_entrada", $datos['fechaentrada_OrdSer'], PDO::PARAM_STR);
        $stmt->bindParam(":hora_entrada", $datos['horaentra_ordSer'], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_trabajos", $datos['fechaInic_ordSer'], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_aprobacion", $datos['fecha_aprobacion'], PDO::PARAM_STR);
        $stmt->bindParam(":diagnostico", $datos['diagnostico'], PDO::PARAM_STR);
        $stmt->bindParam(":observacion", $datos['observacion'], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos['estado'], PDO::PARAM_INT);
        $stmt->bindParam(":ciudad", $datos['ciudad_OrdServ'], PDO::PARAM_INT);
        $stmt->bindParam(":factura", $datos['numFactura_ordSer'], PDO::PARAM_STR);
        $stmt->bindParam(":kilometraje_orden", $datos['kilome_ordSer'], PDO::PARAM_INT);


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
        ELIMINAR REPUESTO DE UNA ORDEN DE SERVICIO
    ===================================================*/
    static public function mdlEliminarRepuesto($idorden)
    {
        $stmt = Conexion::conectar()->prepare("DELETE FROM m_re_repuestoordenservicio
        WHERE idorden = :idorden ");

        $stmt->bindParam(":idorden", $idorden, PDO::PARAM_INT);

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
        ELIMINAR MANO DE OBRA DE UNA ORDEN DE SERVICIO
    ===================================================*/
    static public function mdlEliminarManoObra($idorden)
    {
        $stmt = Conexion::conectar()->prepare("DELETE FROM m_re_proveedorordenservicio
        WHERE idorden = :idorden ");

        $stmt->bindParam(":idorden", $idorden, PDO::PARAM_INT);

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
        ELIMINAR SERVICIOS EXTERNOS DE UNA ORDEN DE SERVICIO
    ===================================================*/
    static public function mdlEliminarServiciosExternosOrden($idorden)
    {
        $stmt = Conexion::conectar()->prepare("DELETE FROM m_re_serviciosexternosordenservicio
        WHERE idorden = :idorden ");

        $stmt->bindParam(":idorden", $idorden, PDO::PARAM_INT);

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
        AGREGAR MANTENIMIENTO PREVENTIVO A ORDEN SERVICIO
    ===================================================*/

    static public function mdlAgregarPreventivo($idorden, $servicio, $kilometraje, $vehiculo, $fecha)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO m_re_serviciosvehiculos(idorden, idservicio, kilometraje, idvehiculo, fecha)
                                            VALUES(:idorden, :servicio, :kilometraje, :vehiculo , :fecha)");

        $stmt->bindParam(":idorden", $idorden, PDO::PARAM_INT);
        $stmt->bindParam(":servicio", $servicio, PDO::PARAM_INT);
        $stmt->bindParam(":kilometraje", $kilometraje, PDO::PARAM_INT);
        $stmt->bindParam(":vehiculo", $vehiculo, PDO::PARAM_INT);
        $stmt->bindParam(":fecha", $fecha, PDO::PARAM_STR);

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
        AGREGAR MANTENIMIENTO CORRECTIVO A ORDEN DE SERVICIO
    ===================================================*/
    static public function mdlAgregarCorrectivo($idorden, $servicio)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO m_re_correctivosordenservicio(idorden, idservicio)
                                            VALUES(:idorden, :servicio)");

        $stmt->bindParam(":idorden", $idorden, PDO::PARAM_INT);
        $stmt->bindParam(":servicio", $servicio, PDO::PARAM_INT);
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
        AGREGAR SERVICIOS EXTERNOS A ORDEN SERVICIO
    ===================================================*/

    static public function mdlAgregarServiciosExternosOrdenServicio($idorden, $dato)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO m_re_serviciosexternosordenservicio(idorden,idservicio_externo)
                                                VALUES(:idorden, :dato)");

        $stmt->bindParam(":idorden", $idorden, PDO::PARAM_INT);
        $stmt->bindParam(":dato", $dato, PDO::PARAM_INT);
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
        AGREGAR REPUESTO EN ORDEN DE SERVICIO
    ===================================================*/

    static public function mdlAgregarRepuestoOrdenServicio($idorden, $idinventario, $cantidad, $idservicio, $sistema, $mantenimiento, $iva, $total, $idproveedor, $valor)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO m_re_repuestoordenservicio(idorden,idinventario, cantidad,idservicio,sistema,mantenimiento,iva,total, idproveedor, valor )
                                                VALUES(:idorden,:idinventario, :cantidad, :idservicio, :sistema, :mantenimiento,:iva,:total, :idproveedor, :valor)");

        $stmt->bindParam(":idorden", $idorden, PDO::PARAM_INT);
        $stmt->bindParam(":idinventario", $idinventario, PDO::PARAM_INT);
        $stmt->bindParam(":cantidad", $cantidad, PDO::PARAM_INT);
        $stmt->bindParam(":idservicio", $idservicio, PDO::PARAM_INT);
        $stmt->bindParam(":sistema", $sistema, PDO::PARAM_STR);
        $stmt->bindParam(":mantenimiento", $mantenimiento, PDO::PARAM_STR);
        $stmt->bindParam(":iva", $iva, PDO::PARAM_INT);
        $stmt->bindParam(":total", $total, PDO::PARAM_INT);
        $stmt->bindParam(":idproveedor", $idproveedor, PDO::PARAM_INT);
        $stmt->bindParam(":valor", $valor, PDO::PARAM_INT);

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
        AGREGAR MANO DE OBRA / PROVEEDOR
    ===================================================*/

    static public function mdlAgregarManoObra($idorden, $idproveedor, $descrip, $valor, $cantidad, $idservicio, $sistema, $mantenimiento, $iva, $total)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO m_re_proveedorordenservicio(idorden,idproveedor,descripcion,valor, cantidad, idservicio,sistema,mantenimiento,iva,total)
                                            VALUES(:idorden, :idproveedor, :descripcion, :valor, :cantidad, :idservicio, :sistema, :mantenimiento,:iva,:total )");

        $stmt->bindParam(":idorden", $idorden, PDO::PARAM_INT);
        $stmt->bindParam(":idproveedor", $idproveedor, PDO::PARAM_INT);
        $stmt->bindParam(":descripcion", $descrip, PDO::PARAM_STR);
        $stmt->bindParam(":valor", $valor, PDO::PARAM_INT);
        $stmt->bindParam(":cantidad", $cantidad, PDO::PARAM_INT);
        $stmt->bindParam(":idservicio", $idservicio, PDO::PARAM_INT);
        $stmt->bindParam(":sistema", $sistema, PDO::PARAM_STR);
        $stmt->bindParam(":mantenimiento", $mantenimiento, PDO::PARAM_STR);
        $stmt->bindParam(":iva", $iva, PDO::PARAM_INT);
        $stmt->bindParam(":total", $total, PDO::PARAM_INT);
        // $stmt->bindParam(":idcuenta", $idcuenta, PDO::PARAM_INT);

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
        AGREGAR SERVICIO [PROGRAMACIÓN]
    ===================================================*/
    static public function mdlAgregarServicio($datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO m_re_serviciosvehiculos(idvehiculo,idservicio,kilometraje,fecha, idorden) 
                                                VALUES (:idvehiculo_serv, :idservicio, :kilometraje_serv, :fecha, :idorden)");
        $stmt->bindParam(":idvehiculo_serv", $datos["idvehiculo_serv"], PDO::PARAM_INT);
        $stmt->bindParam(":idservicio", $datos["idservicio"], PDO::PARAM_INT);
        $stmt->bindParam(":kilometraje_serv", $datos["kilometraje_serv"], PDO::PARAM_INT);
        $stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
        $stmt->bindParam(":idorden", $datos['idorden'], PDO::PARAM_INT);

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
        ELIMINAR SERVICIO [PROGRAMACIÓN]
    ===================================================*/

    static public function mdlEliminarProgramacion($idserviciovehiculo)
    {
        $stmt = Conexion::conectar()->prepare("DELETE s.* from  m_re_serviciosvehiculos s WHERE s.idserviciovehiculo = :idserviciovehiculo");
        $stmt->bindParam(":idserviciovehiculo", $idserviciovehiculo, PDO::PARAM_INT);

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
        ELIMINAR SERVICIO DE LA ORDEN [PROGRAMACION]
    ===================================================*/
    static public function mdlEliminarServicioxOrden($idorden)
    {
        $stmt = Conexion::conectar()->prepare("DELETE s.* from  m_re_serviciosvehiculos s WHERE s.idorden = :idorden");
        $stmt->bindParam(":idorden", $idorden, PDO::PARAM_INT);

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
        LISTADO DE CUENTAS CONTABLES
    ===================================================*/
    static public function mdlListaCuentasContables()
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM li_cuentas_contables cc WHERE cc.estado = 1 ");

        $stmt->execute();
        $respuesta = $stmt->fetchAll();
        $stmt->closeCursor();
        return $respuesta;
    }

    /* ===================================================
        ID VEHICULO DE UNA ORDEN DE SERVICIO
    ===================================================*/
    static public function mdlVehiculoxOrden($idorden)
    {
        $stmt = Conexion::conectar()->prepare("SELECT o.idvehiculo FROM m_ordenservicio o
        WHERE o.idorden = :idorden");

        $stmt->bindParam(":idorden", $idorden, PDO::PARAM_INT);

        $stmt->execute();
        $respuesta = $stmt->fetch();
        $stmt->closeCursor();
        return $respuesta;
    }

    /* ===================================================
        LISTADO DE CONTROL DE ACTIVIDADES ORDEN DE SERVICIO
    ===================================================*/
    static public function mdlListadoControlActividades()
    {
        $stmt = Conexion::conectar()->prepare("SELECT r.repuestoOrden AS id,r.idorden,
        o.idvehiculo,o.kilometraje_orden, 
        cc.num_cuenta, cc.nombre_cuenta, 
        v.placa,
        c.idcliente,c.nombre AS cliente, 
        o.fecha_entrada, o.factura, o.ciudad, 
        gm.municipio, 
        o.fecha_trabajos, 
        o.fecha_aprobacion, 
        r.mantenimiento, 
        p.nombre_contacto,         
        CONCAT(prod.referencia, ' - ', prod.descripcion) AS item,
        -- prod.descripcion AS item, 
        r.sistema, r.cantidad, r.valor, r.iva, r.total, 
        DATE_FORMAT(o.fecha_entrada, '%d/%m/%Y') AS Ffecha_entrada,
        DATE_FORMAT(o.fecha_trabajos, '%d/%m/%Y') AS Ffecha_trabajos, 
        DATE_FORMAT(o.fecha_aprobacion, '%d/%m/%Y') AS Ffecha_aprobacion, 
        sm.servicio,
        'REPUESTO' AS descripcion,
        r.cliente_asume, r.porcentaje_cliente, r.empresa_asume, r.porcentaje_empresa,r.contratista_asume,r.porcentaje_contratista, r.idcuenta
        FROM m_re_repuestoordenservicio r 
        LEFT JOIN m_ordenservicio o ON r.idorden = o.idorden
        LEFT JOIN li_cuentas_contables cc ON r.idcuenta = cc.id
        INNER JOIN v_vehiculos v ON o.idvehiculo = v.idvehiculo
        LEFT JOIN cont_clientesvehiculos ccv ON o.idvehiculo = ccv.idvehiculo
        LEFT JOIN cont_clientes c ON ccv.idcliente = c.idcliente
        LEFT JOIN gh_municipios gm ON o.ciudad = gm.idmunicipio
        LEFT JOIN c_proveedores p ON r.idproveedor = p.id
        LEFT JOIN m_serviciosmenores sm ON r.idservicio = sm.idservicio
        INNER JOIN a_re_inventario i ON i.idinventario = r.idinventario
        INNER JOIN a_productos prod ON prod.idproducto = i.idproducto
        
        
        UNION
        
        SELECT m.proveedorOrden ,  m.idorden, 
        o.idvehiculo, o.kilometraje_orden, 
        cc.num_cuenta, cc.nombre_cuenta, 
        v.placa,
        c.idcliente, c.nombre AS cliente, 
        o.fecha_entrada, o.factura, o.ciudad, 
        gm.municipio, 
        o.fecha_trabajos,
        o.fecha_aprobacion, 
        m.mantenimiento, 
        p.nombre_contacto, 
        m.descripcion AS item, 
        m.sistema, m.cantidad, m.valor, m.iva, m.total, 
        DATE_FORMAT(o.fecha_entrada, '%d/%m/%Y') AS Ffecha_entrada, 
        DATE_FORMAT(o.fecha_trabajos, '%d/%m/%Y') AS Ffecha_trabajos, 
        DATE_FORMAT(o.fecha_aprobacion, '%d/%m/%Y') AS Ffecha_aprobacion, 
        sm.servicio,
        'MANO DE OBRA' AS descripcion,
        m.cliente_asume, m.porcentaje_cliente, m.empresa_asume, m.porcentaje_empresa,m.contratista_asume,m.porcentaje_contratista, m.idcuenta
        FROM m_re_proveedorordenservicio m
        LEFT JOIN m_ordenservicio o ON m.idorden = o.idorden
        LEFT JOIN li_cuentas_contables cc ON m.idcuenta = cc.id
        INNER JOIN v_vehiculos v ON o.idvehiculo = v.idvehiculo
        LEFT JOIN cont_clientesvehiculos ccv ON o.idvehiculo = ccv.idvehiculo
        LEFT JOIN cont_clientes c ON ccv.idcliente = c.idcliente
        LEFT JOIN gh_municipios gm ON o.ciudad = gm.idmunicipio
        LEFT JOIN c_proveedores p ON m.idproveedor = p.id
        LEFT JOIN m_serviciosmenores sm ON m.idservicio = sm.idservicio
        
        
        ORDER BY idorden
        ");

        $stmt->execute();
        $respuesta = $stmt->fetchAll();
        $stmt->closeCursor();
        return $respuesta;
    }

    /* ===================================================
        GUARDAR QUIEN ASUME REPUESTO 
    ===================================================*/
    static public function mdlGuardaAsumeRepuesto($datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE m_re_repuestoordenservicio 
        SET cliente_asume = :cliente_asume, porcentaje_cliente = :porcentaje_cliente,
             empresa_asume = :empresa_asume, porcentaje_empresa = :porcentaje_empresa,
             contratista_asume = :contratista_asume, porcentaje_contratista = :porcentaje_contratista,
             idcuenta = :idcuenta
             WHERE repuestoOrden = :idcontrol
        ");


        $stmt->bindParam(":cliente_asume", $datos['cliente_asume'], PDO::PARAM_STR);
        $stmt->bindParam(":porcentaje_cliente", $datos['porcentaje_cliente'], PDO::PARAM_INT);
        $stmt->bindParam(":empresa_asume", $datos['empresa_asume'], PDO::PARAM_STR);
        $stmt->bindParam(":porcentaje_empresa", $datos['porcentaje_empresa'], PDO::PARAM_INT);
        $stmt->bindParam(":contratista_asume", $datos['contratista_asume'], PDO::PARAM_STR);
        $stmt->bindParam(":porcentaje_contratista", $datos['porcentaje_contratista'], PDO::PARAM_INT);
        $stmt->bindParam(":idcuenta", $datos['codigo_cuenta'], PDO::PARAM_INT);
        $stmt->bindParam(":idcontrol", $datos['idcontrol'], PDO::PARAM_INT);

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
        GUARDAR QUIÉN ASUME MANO DE OBRA 
    ===================================================*/
    static public function mdlGuardaAsumeManoObra($datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE m_re_proveedorordenservicio 
            SET cliente_asume = :cliente_asume, porcentaje_cliente = :porcentaje_cliente,
             empresa_asume = :empresa_asume, porcentaje_empresa = :porcentaje_empresa,
             contratista_asume = :contratista_asume, porcentaje_contratista = :porcentaje_contratista,
             idcuenta = :idcuenta
             WHERE proveedorOrden = :idcontrol
        ");


        $stmt->bindParam(":cliente_asume", $datos['cliente_asume'], PDO::PARAM_STR);
        $stmt->bindParam(":porcentaje_cliente", $datos['porcentaje_cliente'], PDO::PARAM_INT);
        $stmt->bindParam(":empresa_asume", $datos['empresa_asume'], PDO::PARAM_STR);
        $stmt->bindParam(":porcentaje_empresa", $datos['porcentaje_empresa'], PDO::PARAM_INT);
        $stmt->bindParam(":contratista_asume", $datos['contratista_asume'], PDO::PARAM_STR);
        $stmt->bindParam(":porcentaje_contratista", $datos['porcentaje_contratista'], PDO::PARAM_INT);
        $stmt->bindParam(":idcuenta", $datos['codigo_cuenta'], PDO::PARAM_INT);
        $stmt->bindParam(":idcontrol", $datos['idcontrol'], PDO::PARAM_INT);

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
        CARGAR DATOS DE QUIÉN ASUME 
    ===================================================*/
    static public function mdlDatosAsume($idcontrol)
    {
        $stmt = Conexion::conectar()->prepare("SELECT r.repuestoOrden AS id,r.idorden,
        o.idvehiculo,o.kilometraje_orden, 
        cc.num_cuenta, cc.nombre_cuenta, 
        v.placa,
        c.idcliente,c.nombre AS cliente, 
        o.fecha_entrada, o.factura, o.ciudad, 
        gm.municipio, 
        o.fecha_trabajos, 
        o.fecha_aprobacion, 
        r.mantenimiento, 
        p.nombre_contacto,         
        CONCAT(prod.referencia, ' - ', prod.descripcion) AS item,
        -- prod.descripcion AS item, 
        r.sistema, r.cantidad, r.valor, r.iva, r.total, 
        DATE_FORMAT(o.fecha_entrada, '%d/%m/%Y') AS Ffecha_entrada,
        DATE_FORMAT(o.fecha_trabajos, '%d/%m/%Y') AS Ffecha_trabajos, 
        DATE_FORMAT(o.fecha_aprobacion, '%d/%m/%Y') AS Ffecha_aprobacion, 
        sm.servicio,
        'REPUESTO' AS descripcion,
        r.cliente_asume, r.porcentaje_cliente, r.empresa_asume, r.porcentaje_empresa,r.contratista_asume,r.porcentaje_contratista
        FROM m_re_repuestoordenservicio r 
        LEFT JOIN m_ordenservicio o ON r.idorden = o.idorden
        LEFT JOIN li_cuentas_contables cc ON r.idcuenta = cc.id
        INNER JOIN v_vehiculos v ON o.idvehiculo = v.idvehiculo
        LEFT JOIN cont_clientesvehiculos ccv ON o.idvehiculo = ccv.idvehiculo
        LEFT JOIN cont_clientes c ON ccv.idcliente = c.idcliente
        LEFT JOIN gh_municipios gm ON o.ciudad = gm.idmunicipio
        LEFT JOIN c_proveedores p ON r.idproveedor = p.id
        LEFT JOIN m_serviciosmenores sm ON r.idservicio = sm.idservicio
        INNER JOIN a_re_inventario i ON i.idinventario = r.idinventario
        INNER JOIN a_productos prod ON prod.idproducto = i.idproducto
        WHERE r.repuestoOrden = :idcontrol
        
        UNION
        
        SELECT m.proveedorOrden ,  m.idorden, 
        o.idvehiculo, o.kilometraje_orden, 
        cc.num_cuenta, cc.nombre_cuenta, 
        v.placa,
        c.idcliente, c.nombre AS cliente, 
        o.fecha_entrada, o.factura, o.ciudad, 
        gm.municipio, 
        o.fecha_trabajos,
        o.fecha_aprobacion, 
        m.mantenimiento, 
        p.nombre_contacto, 
        m.descripcion AS item, 
        m.sistema, m.cantidad, m.valor, m.iva, m.total, 
        DATE_FORMAT(o.fecha_entrada, '%d/%m/%Y') AS Ffecha_entrada, 
        DATE_FORMAT(o.fecha_trabajos, '%d/%m/%Y') AS Ffecha_trabajos, 
        DATE_FORMAT(o.fecha_aprobacion, '%d/%m/%Y') AS Ffecha_aprobacion, 
        sm.servicio,
        'MANO DE OBRA' AS descripcion,
        m.cliente_asume, m.porcentaje_cliente, m.empresa_asume, m.porcentaje_empresa,m.contratista_asume,m.porcentaje_contratista
        FROM m_re_proveedorordenservicio m
        LEFT JOIN m_ordenservicio o ON m.idorden = o.idorden
        LEFT JOIN li_cuentas_contables cc ON m.idcuenta = cc.id
        INNER JOIN v_vehiculos v ON o.idvehiculo = v.idvehiculo
        LEFT JOIN cont_clientesvehiculos ccv ON o.idvehiculo = ccv.idvehiculo
        LEFT JOIN cont_clientes c ON ccv.idcliente = c.idcliente
        LEFT JOIN gh_municipios gm ON o.ciudad = gm.idmunicipio
        LEFT JOIN c_proveedores p ON m.idproveedor = p.id
        LEFT JOIN m_serviciosmenores sm ON m.idservicio = sm.idservicio
        WHERE m.proveedorOrden = :idcontrol
      
      
      
		
        
        ORDER BY idorden
        
      
        ");

        $stmt->bindParam(":idcontrol", $idcontrol, PDO::PARAM_INT);

        $stmt->execute();
        $respuesta = $stmt->fetch();
        $stmt->closeCursor();
        return $respuesta;
    }


    /* ===================================================
        CARGAR DATOS DE UNA CUENTA CONTABLE
    ===================================================*/
    static public function mdlDatosCuenta($idcuenta)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM li_cuentas_contables cc WHERE cc.estado = 1 AND cc.id = :idcuenta");

        $stmt->bindParam(":idcuenta", $idcuenta, PDO::PARAM_INT);
        $stmt->execute();
        $respuesta = $stmt->fetch();
        $stmt->closeCursor();
        return $respuesta;
    }

    /* ===================================================
        LISTADO DE PROGRAMACIONES A REALIZAR 
    ===================================================*/
    static public function mdlListaProgramacion()
    {
        $stmt = Conexion::conectar()->prepare("SELECT v.*, sv.idsolicitud, sv.fecha_programacion, DATE_FORMAT(sv.fecha_programacion, '%d/%m/%Y') AS Ffecha_programacion, sv.tiempo_mantenimiento, sv.estado AS estadoSolicitud, sv.fecha_solicitud, DATE_FORMAT(sv.fecha_solicitud, '%d/%m/%Y') AS Ffecha_solicitud, sv.observacion FROM view_m_programacionvehiculos v
        LEFT JOIN m_re_solicitudesvehiculo sv ON sv.idvehiculo = v.idvehiculo
        WHERE (sv.idsolicitud, v.idvehiculo, v.item)
                IN (select MAX(sv1.idsolicitud), v1.idvehiculo, v1.item FROM
                view_m_programacionvehiculos v1
                LEFT JOIN m_re_solicitudesvehiculo sv1 ON sv1.idvehiculo = v1.idvehiculo
                GROUP BY v1.idvehiculo, v1.item
                ) OR sv.idsolicitud IS NULL
        ORDER BY v.placa ASC, v.fecha_comparar DESC");

        $stmt->execute();
        $respuesta = $stmt->fetchAll();
        $stmt->closeCursor();
        return $respuesta;
    }

    /* ===================================================
        LISTADO DE PROGRAMACIONES PENDIENTES POR IDVEHICULO
    ===================================================*/
    static public function mdlProgramacionxVehiculo($idvehiculo)
    {
        $stmt = Conexion::conectar()->prepare("SELECT v.*, sv.idsolicitud, sv.fecha_programacion, sv.tiempo_mantenimiento, sv.estado AS estadoSolicitud, sv.fecha_solicitud, sv.observacion FROM view_m_programacionvehiculos v
        LEFT JOIN m_re_solicitudesvehiculo sv ON sv.idvehiculo = v.idvehiculo
        WHERE (sv.idsolicitud, v.idvehiculo, v.item)
                IN (select MAX(sv1.idsolicitud), v1.idvehiculo, v1.item FROM
                view_m_programacionvehiculos v1
                LEFT JOIN m_re_solicitudesvehiculo sv1 ON sv1.idvehiculo = v1.idvehiculo
                WHERE v.idvehiculo = :idvehiculo
                GROUP BY v1.idvehiculo, v1.item
                ) OR (sv.idsolicitud IS NULL AND v.idvehiculo = :idvehiculo)
        ORDER BY v.placa ASC, v.fecha_comparar DESC");

        $stmt->bindParam(":idvehiculo", $idvehiculo, PDO::PARAM_INT);
        $stmt->execute();
        $respuesta = $stmt->fetchAll();
        $stmt->closeCursor();
        return $respuesta;
    }

    /* ===================================================
        GUARDAR SOLICITUD DE PROGRAMACIÓN
    ===================================================*/
    static public function mdlGuardarSolicitudProgramacion($datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO m_re_solicitudesvehiculo(idvehiculo,descripcion,fecha_programacion,tiempo_mantenimiento,estado,observacion )
        VALUES(:idvehiculo,:descripcion, :fecha_programacion, :tiempo_mantenimiento, :estado, :observacion)");

        $stmt->bindParam(":idvehiculo", $datos['placa_programacion'], PDO::PARAM_INT);
        $stmt->bindParam(":descripcion", $datos['descripcion_progra'], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_programacion", $datos['fecha_progra'], PDO::PARAM_STR);
        $stmt->bindParam(":tiempo_mantenimiento", $datos['tiempo_progra'], PDO::PARAM_INT);
        $stmt->bindParam(":estado", $datos['estado_programacion'], PDO::PARAM_STR);
        $stmt->bindParam(":observacion", $datos['observacion_progra'], PDO::PARAM_STR);

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
        DATOS DE SOLICITUD DE PROGRAMACION POR ID SOLICITUD
    ===================================================*/
    static public function mdlDatosSolicitudProgramacion($idsolicitud)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM m_re_solicitudesvehiculo WHERE idsolicitud = :idsolicitud");

        $stmt->bindParam(":idsolicitud", $idsolicitud, PDO::PARAM_INT);
        $stmt->execute();
        $respuesta = $stmt->fetch();
        $stmt->closeCursor();
        return $respuesta;
    }

    /* ===================================================
        ACTUALIZAR ESTADO SOLICITUD PROGRAMACION
    ===================================================*/
    static public function mdlActualizarEstadoSolicitudProgramacion($datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE m_re_solicitudesvehiculo SET 
        estado = :estado
        WHERE idsolicitud =:idsolicitud");

        $stmt->bindParam(":idsolicitud", $datos['idsolicitud'], PDO::PARAM_INT);
        $stmt->bindParam(":estado", $datos['estado'], PDO::PARAM_STR);

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
        HISTORIAL DE SOLICITUDES PROGRAMACIÓN 
    ===================================================*/
    static public function mdlHistorialSolicitudesProgramacion()
    {
        $stmt = Conexion::conectar()->prepare("SELECT s.*, v.*, DATE_FORMAT(s.fecha_solicitud, '%d/%m/%Y') AS Ffecha_solicitud, DATE_FORMAT(s.fecha_programacion, '%d/%m/%Y') AS Ffecha_programacion FROM m_re_solicitudesvehiculo s
        INNER JOIN v_vehiculos v ON s.idvehiculo = v.idvehiculo");

        $stmt->execute();
        $respuesta = $stmt->fetchAll();
        $stmt->closeCursor();
        return $respuesta;
    }
}

class ModeloControlLlantas
{
    static public function mdlAgregarllanta($datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO m_control_llantas(idvehiculo,vida,fecha_montaje,kilom_montaje,lonas,estado_actual,fecha_factura,num_factura,idalmacen)
                                                VALUES(:idvehiculo,:vida,:fecha_montaje,:kilom_montaje,:lonas,:estado_actual,:fecha_factura,:num_factura,:idalmacen)");

        $stmt->bindParam(":idvehiculo", $datos["placa"], PDO::PARAM_INT);
        $stmt->bindParam(":idalmacen", $datos["idproducto"], PDO::PARAM_INT);
        $stmt->bindParam(":vida", $datos["vida"], PDO::PARAM_INT);
        $stmt->bindParam(":fecha_montaje", $datos["fecha_montaje"], PDO::PARAM_STR);
        $stmt->bindParam(":kilom_montaje", $datos["kilo_montaje"], PDO::PARAM_INT);
        $stmt->bindParam(":lonas", $datos["lonas"], PDO::PARAM_INT);
        $stmt->bindParam(":estado_actual", $datos["estado_actual"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_factura", $datos["fecha_factura"], PDO::PARAM_STR);
        $stmt->bindParam(":num_factura", $datos["num_factura"], PDO::PARAM_STR);


        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }

    static public function mdlEliminarLlanta($id_llanta)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE m_control_llantas set estado = 0
                                               WHERE idllanta = :idllanta");

        $stmt->bindParam(":idllanta", $id_llanta, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }

    static public function mdlTablaLlantas()
    {
        $stmt = Conexion::conectar()->prepare("SELECT cl.*, p.*, ma.marca, me.medida, ca.categoria, i.idsucursal, i.stock, s.sucursal, m.preciocompra, m.idproveedor, m.observaciones FROM m_control_llantas cl
        INNER JOIN a_productos p ON p.idproducto = cl.idalmacen
        INNER JOIN a_marcas ma ON ma.idmarca = p.idmarca
        INNER JOIN a_categorias ca ON ca.idcategorias = p.idcategoria
        INNER JOIN a_medidas me ON me.idmedidas = p.idmedida
        INNER JOIN a_re_inventario i ON i.idproducto = p.idproducto
        INNER JOIN gh_sucursales s ON s.ids = i.idsucursal
        INNER JOIN a_re_movimientoinven m ON m.idinventario = i.idinventario
        WHERE cl.estado = 1 AND m.tipo_movimiento = 'ENTRADA'");

        $stmt->execute();
        $retorno =  $stmt->fetchAll();

        $stmt->closeCursor();
        return $retorno;
    }

    static public function mdlDatosLLanta($id_llanta)
    {
        $stmt = Conexion::conectar()->prepare("SELECT cl.*, p.*, ma.marca, me.medida, ca.categoria, i.idsucursal, i.stock, s.sucursal, m.preciocompra, m.idproveedor, m.observaciones FROM m_control_llantas cl
        INNER JOIN a_productos p ON p.idproducto = cl.idalmacen
        INNER JOIN a_marcas ma ON ma.idmarca = p.idmarca
        INNER JOIN a_categorias ca ON ca.idcategorias = p.idcategoria
        INNER JOIN a_medidas me ON me.idmedidas = p.idmedida
        INNER JOIN a_re_inventario i ON i.idproducto = p.idproducto
        INNER JOIN gh_sucursales s ON s.ids = i.idsucursal
        INNER JOIN a_re_movimientoinven m ON m.idinventario = i.idinventario
        WHERE cl.idllanta = :idllanta");

        $stmt->bindParam(":idllanta", $id_llanta, PDO::PARAM_INT);

        $stmt->execute();
        $retorno =  $stmt->fetch();

        $stmt->closeCursor();
        return $retorno;
    }

    static public function mdlEditarControl($datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE m_control_llantas set vida=:vida, fecha_montaje=:fecha_montaje, kilom_montaje=:kilom_montaje,lonas=:lonas,estado_actual=:estado_actual
                                               WHERE idllanta = :idllanta");

        $stmt->bindParam(":idllanta", $datos["idllanta"], PDO::PARAM_INT);
        $stmt->bindParam(":vida", $datos["vida_util"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_montaje", $datos["fecha_montaje"], PDO::PARAM_STR);
        $stmt->bindParam(":kilom_montaje", $datos["kilo_montaje"], PDO::PARAM_INT);
        $stmt->bindParam(":lonas", $datos["lonas"], PDO::PARAM_INT);
        $stmt->bindParam(":estado_actual", $datos["estado"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }

    static public function mdlListarSelectLlantas()
    {
        $stmt = Conexion::conectar()->prepare("SELECT p.*, c.categoria, ma.marca, me.medida FROM a_productos p
        INNER JOIN a_categorias c ON p.idcategoria = c.idcategorias
        INNER JOIN a_marcas ma ON p.idmarca = ma.idmarca
        INNER JOIN a_medidas me ON p.idmedida = me.idmedidas
        WHERE p.descripcion LIKE '%lanta%'");

        $stmt->execute();
        $retorno =  $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }
}
