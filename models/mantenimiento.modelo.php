<?php

// INCLUIMOS LA CONFIGURACIÓN Y LA CONEXION PARA EL FUNCIONAMIENTO DEL PROYECTO
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

    static public function mdlAgregarInventario($datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO m_inventario(
                                                                        idvehiculo,
                                                                        idconductor,
                                                                        tipovehi,
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
                                                                        Vidrios_entanas_ateral_izquierdo,
                                                                        Vidrios_puertas,
                                                                        Direccionalelantera_izquierda,
                                                                        Direccional_elantera_derecha,
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
                                                                        Cruceta__Copa,
                                                                        2Conos__Triangulos,
                                                                        Botiquin,
                                                                        Extintor,
                                                                        2Tacos_Bloques,
                                                                        1Alicate_destornillaodor,
                                                                        2PLlave_expancion_LLaves_fijas,
                                                                        LLanta_repuesto,
                                                                        Linterna_pila,
                                                                        Cinturon_conductor,
                                                                        Radioteléfono,
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
                                                                        Dispositivo_ velocidad,
                                                                        Salidas_emergencia_martillos,
                                                                        Brazo_limpiaparabrisas_izquierdo,
                                                                        Plumilla_limpiaparabrisas_izquierdo,
                                                                        7Brazo_limpiaparabrisas_derecho,
                                                                        Plumilla_limpiaparabrisas_derecho,
                                                                        Baterias,
                                                                        Botones_tableron_timon,
                                                                        Tapa_radiador,
                                                                        Tapa_deposito_hidráulico,
                                                                        Cojineria_general,
                                                                        Cinturon_sillas_calidad,
                                                                        Pasamanos,
                                                                        Claxon,
                                                                        Placas_reglamentarias,
                                                                        observaciones,
                                                                        escolar,
                                                                        num_parlantes
                                                                        )
                                                                VALUES( :idvehiculo,
                                                                        :idconductor,
                                                                        :tipovehi,
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
                                                                        :Vidrios_entanas_ateral_izquierdo,
                                                                        :Vidrios_puertas,
                                                                        :Direccionalelantera_izquierda,
                                                                        :Direccional_elantera_derecha,
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
                                                                        :Cruceta__Copa,
                                                                        :2Conos__Triangulos,
                                                                        :Botiquin,
                                                                        :Extintor,
                                                                        :2Tacos_Bloques,
                                                                        :1Alicate_destornillaodor,
                                                                        :2PLlave_expancion_LLaves_fijas,
                                                                        :LLanta_repuesto,
                                                                        :Linterna_pila,
                                                                        :Cinturon_conductor,
                                                                        :Radioteléfono,
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
                                                                        :7Brazo_limpiaparabrisas_derecho,
                                                                        :Plumilla_limpiaparabrisas_derecho,
                                                                        :Baterias,
                                                                        :Botones_tableron_timon,
                                                                        :Tapa_radiador,
                                                                        :Tapa_deposito_hidráulico,
                                                                        :Cojineria_general,
                                                                        :Cinturon_sillas_calidad,
                                                                        :Pasamanos,
                                                                        :Claxon,
                                                                        :Placas_reglamentarias,
                                                                        :observaciones,
                                                                        :escolar,
                                                                        :num_parlantes)");

        $stmt->bindParam(":idvehiculo", $datos["placa"], PDO::PARAM_INT);
        $stmt->bindParam(":idconductor", $datos["conductor"], PDO::PARAM_INT);
        $stmt->bindParam(":tipovehi", $datos["tipovel"], PDO::PARAM_INT);
        $stmt->bindParam(":fecha_inventario", $datos["fechai"], PDO::PARAM_INT);
        $stmt->bindParam(":kilometraje", $datos["kilom"], PDO::PARAM_INT);
        $stmt->bindParam(":recepcion_entrega_vehiculo", $datos["recep_entrega"], PDO::PARAM_INT);
        $stmt->bindParam(":Techo_exterior", $datos["techoext"], PDO::PARAM_INT);
        $stmt->bindParam(":Techo_interior", $datos["techoint"], PDO::PARAM_INT);
        $stmt->bindParam(":Frente", $datos["frente"], PDO::PARAM_INT);
        $stmt->bindParam(":numero_luces_internas", $datos["num_luces_in"], PDO::PARAM_INT);
        $stmt->bindParam(":Bomper_delantero", $datos["bomper_del"], PDO::PARAM_INT);
        $stmt->bindParam(":Bomper_trasero", $datos["bomper_tra"], PDO::PARAM_INT);
        $stmt->bindParam(":Lateral_derecho", $datos["lateral_der"], PDO::PARAM_INT);
        $stmt->bindParam(":Lateral_izquierdo", $datos["lateral_izq"], PDO::PARAM_INT);
        $stmt->bindParam(":Puerta_izquierda", $datos["puerta_izq"], PDO::PARAM_INT);
        $stmt->bindParam(":Parabrisas_izquierdo", $datos["parab_izq"], PDO::PARAM_INT);
        $stmt->bindParam(":Parabrisas_derecho", $datos["parab_der"], PDO::PARAM_INT);
        $stmt->bindParam(":parabrisas_trasero", $datos["parab_tra"], PDO::PARAM_INT);
        $stmt->bindParam(":Espejo_retrovisor_derecho", $datos["espejo_re_der"], PDO::PARAM_INT);
        $stmt->bindParam(":Espejo_retrovisor_izquierdo", $datos["espejo_re_izq"], PDO::PARAM_INT);
        $stmt->bindParam(":Vidrios_ventanas_lateral_derecho", $datos["vidrios_ven_der"], PDO::PARAM_INT);
        $stmt->bindParam(":Vidrios_entanas_ateral_izquierdo", $datos["vidrios_ven_izq"], PDO::PARAM_INT);
        $stmt->bindParam(":Vidrios_puertas", $datos["vidrios_puert"], PDO::PARAM_INT);
        $stmt->bindParam(":Direccionalelantera_izquierda", $datos["dir_del_izq"], PDO::PARAM_INT);
        $stmt->bindParam(":Direccional_elantera_derecha", $datos["dir_del_der"], PDO::PARAM_INT);
        $stmt->bindParam(":Stop_trasero_derecho", $datos["stop_tra_der"], PDO::PARAM_INT);
        $stmt->bindParam(":Stop_trasero_izquierdo", $datos["stop_tra_izq"], PDO::PARAM_INT);
        $stmt->bindParam(":Cucuyo_lateral_derecho", $datos["cucu_la_der"], PDO::PARAM_INT);
        $stmt->bindParam(":Cucuyo_lateral_izquierdo", $datos["cucu_la_izq"], PDO::PARAM_INT);
        $stmt->bindParam(":Luces_internas", $datos["luces_in"], PDO::PARAM_INT);
        $stmt->bindParam(":balizas", $datos["balizas"], PDO::PARAM_INT);
        $stmt->bindParam(":Delantera_izquierda_R1", $datos["delan_izq_r1"], PDO::PARAM_INT);
        $stmt->bindParam(":Delantera_derecha_R2", $datos["Delantera_izquierda_R2"], PDO::PARAM_INT);
        $stmt->bindParam(":Trasera_interior_izquierda_R3", $datos["tra_in_izq_r3"], PDO::PARAM_INT);
        $stmt->bindParam(":Trasera_exterior_izquierda_R4", $datos["tra_ex_izq_r4"], PDO::PARAM_INT);
        $stmt->bindParam(":Trasera_interior_derecha_R5", $datos["tra_in_der_r5"], PDO::PARAM_INT);
        $stmt->bindParam(":Trasera_exterior_derecha_R6", $datos["tra_ex_der_r6"], PDO::PARAM_INT);
        $stmt->bindParam(":Gato", $datos["gato"], PDO::PARAM_INT);
        $stmt->bindParam(":Cruceta__Copa", $datos["cru_copa"], PDO::PARAM_INT);
        $stmt->bindParam(":2Conos__Triangulos", $datos["conos_trian"], PDO::PARAM_INT);
        $stmt->bindParam(":Botiquin", $datos["botiquin"], PDO::PARAM_INT);
        $stmt->bindParam(":Extintor", $datos["extintor"], PDO::PARAM_INT);
        $stmt->bindParam(":2Tacos_Bloques", $datos["tacos_bloq"], PDO::PARAM_INT);
        $stmt->bindParam(":1Alicate_destornillaodor", $datos["alicate_destor"], PDO::PARAM_INT);
        $stmt->bindParam(":2PLlave_expancion_LLaves_fijas", $datos["llave_exp_fijas"], PDO::PARAM_INT);
        $stmt->bindParam(":LLanta_repuesto", $datos["llanta_repues"], PDO::PARAM_INT);
        $stmt->bindParam(":Linterna_pila", $datos["linterna_pila"], PDO::PARAM_INT);
        $stmt->bindParam(":Cinturon_conductor", $datos["cintu_cond"], PDO::PARAM_INT);
        $stmt->bindParam(":Radioteléfono", $datos["radiotele"], PDO::PARAM_INT);
        $stmt->bindParam(":Antena", $datos["antena"], PDO::PARAM_INT);
        $stmt->bindParam(":Equipo_Sonido", $datos["equipo_sonido"], PDO::PARAM_INT);
        $stmt->bindParam(":usb_cd", $datos["usb_cd"], PDO::PARAM_INT);
        $stmt->bindParam(":Parlantes", $datos["parlantes"], PDO::PARAM_INT);
        $stmt->bindParam(":Manguera_agua", $datos["mangue_agua"], PDO::PARAM_INT);
        $stmt->bindParam(":Manguera_aire", $datos["mangue_aire"], PDO::PARAM_INT);
        $stmt->bindParam(":Pantalla_Televisor", $datos["panta_tele"], PDO::PARAM_INT);
        $stmt->bindParam(":Reloj", $datos["reloj"], PDO::PARAM_INT);
        $stmt->bindParam(":Brazo_1_Izquierdo_R1", $datos["brazo_izq_r1"], PDO::PARAM_INT);
        $stmt->bindParam(":Brazo_2_Derecho_R2", $datos["brazo_der_r2"], PDO::PARAM_INT);
        $stmt->bindParam(":Brazo_3_Izquierdo_R3", $datos["brazo_izq_r3"], PDO::PARAM_INT);
        $stmt->bindParam(":Brazo_4_Derecho_R6", $datos["brazo_der_r6"], PDO::PARAM_INT);
        $stmt->bindParam(":Emblema_derecho_empresa", $datos["emble_der_empre"], PDO::PARAM_INT);
        $stmt->bindParam(":puerta_derecha", $datos["puerta_der"], PDO::PARAM_INT);
        $stmt->bindParam(":Logo_izquierdo", $datos["logo_izq"], PDO::PARAM_INT);
        $stmt->bindParam(":Logo_derecho", $datos["logo_der"], PDO::PARAM_INT);
        $stmt->bindParam(":Emblema_izquierdo_empresa", $datos["emble_izq_empre"], PDO::PARAM_INT);
        $stmt->bindParam(":escolar_delantero_trasero", $datos["escolar_del_tra"], PDO::PARAM_INT);
        $stmt->bindParam(":N_Interno_delantero", $datos["ninter_del"], PDO::PARAM_INT);
        $stmt->bindParam(":N_Interno_trasero", $datos["ninter_tra"], PDO::PARAM_INT);
        $stmt->bindParam(":N_Interno_izquierdo", $datos["ninter_izq"], PDO::PARAM_INT);
        $stmt->bindParam(":N_Interno_derecho", $datos["ninter_der"], PDO::PARAM_INT);
        $stmt->bindParam(":Nsalidas_martillos", $datos["num_salidas"], PDO::PARAM_INT);
        $stmt->bindParam(":interno_externo_comoConduzco", $datos["in_ext_conduzco"], PDO::PARAM_INT);
        $stmt->bindParam(":Av_Como_conduzco", $datos["como_conduzco"], PDO::PARAM_INT);
        $stmt->bindParam(":Dispositivo_velocidad", $datos["dispo_velo"], PDO::PARAM_INT);
        $stmt->bindParam(":Salidas_emergencia_martillos", $datos["salidas_emer"], PDO::PARAM_INT);
        $stmt->bindParam(":Brazo_limpiaparabrisas_izquierdo", $datos["brazo_limp_izq"], PDO::PARAM_INT);
        $stmt->bindParam(":Plumilla_limpiaparabrisas_izquierdo", $datos["plumilla_limp_izq"], PDO::PARAM_INT);
        $stmt->bindParam(":7Brazo_limpiaparabrisas_derecho", $datos["brazo_limp_der"], PDO::PARAM_INT);
        $stmt->bindParam(":Plumilla_limpiaparabrisas_derecho", $datos["plumilla_limp_der"], PDO::PARAM_INT);
        $stmt->bindParam(":Baterias", $datos["baterias"], PDO::PARAM_INT);
        $stmt->bindParam(":Botones_tableron_timon", $datos["boton_table_tim"], PDO::PARAM_INT);
        $stmt->bindParam(":Tapa_radiador", $datos["tapa_radia"], PDO::PARAM_INT);
        $stmt->bindParam(":Tapa_deposito_hidráulico", $datos["tapa_depo_hidra"], PDO::PARAM_INT);
        $stmt->bindParam(":Cojineria_general", $datos["cojin_general"], PDO::PARAM_INT);
        $stmt->bindParam(":Cinturon_sillas_calidad", $datos["cintu_sillas"], PDO::PARAM_INT);
        $stmt->bindParam(":Pasamanos", $datos["pasama"], PDO::PARAM_INT);
        $stmt->bindParam(":Claxon", $datos["claxon"], PDO::PARAM_INT);
        $stmt->bindParam(":Placas_reglamentarias", $datos["placa_regla"], PDO::PARAM_INT);
        $stmt->bindParam(":observaciones", $datos["observ"], PDO::PARAM_STR);
        $stmt->bindParam(":escolar", $datos["escolar"], PDO::PARAM_INT);
        $stmt->bindParam(":num_parlantes", $datos["num_parla"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }

    static public function mdlEditarInventario()
    {
    }

    static public function mdlListarInventario()
    {
    }
}
