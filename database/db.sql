----------------
-- TABLA ROLES
----------------
    CREATE TABLE roles(
        id_rol      INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        nombres_rol VARCHAR(255) NOT NULL UNIQUE KEY,
        estado      VARCHAR(255),

        fyh_creacion        DATETIME NULL,
        fyh_actualizacion   DATETIME NULL

    ) ENGINE=InnoDB;

    -- AGREGAMOS UN ROL POR DEFECTO
    INSERT INTO roles (nombres_rol, estado, fyh_creacion)
    VALUE ('ADMINISTRADOR', '1', '24-12-28 18:19:00');

    INSERT INTO roles (nombres_rol, estado, fyh_creacion)
    VALUE ('DIRECCTOR ADMINISTRATIVO', '1', '24-12-28 18:19:00');

    INSERT INTO roles (nombres_rol, estado, fyh_creacion)
    VALUE ('DIRECCTOR ACADEMICO', '1', '24-12-28 18:19:00');

    INSERT INTO roles (nombres_rol, estado, fyh_creacion)
    VALUE ('DOCENTE', '1', '24-12-28 18:19:00');

    INSERT INTO roles (nombres_rol, estado, fyh_creacion)
    VALUE ('SECRETARIA', '1', '24-12-28 18:19:00');

    INSERT INTO roles (nombres_rol, estado, fyh_creacion)
    VALUE ('ESTUDIANTE', '1', '24-12-28 18:19:00');
----------------
-- TABLA USUARIOS
----------------
    CREATE TABLE usuarios(
        id_usuario  INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        rol_id      INT(11) NOT NULL,
        email       VARCHAR(255) NOT NULL UNIQUE KEY,
        password    TEXT NOT NULL,
        estado      VARCHAR(255),

        fyh_creacion        DATETIME NULL,
        fyh_actualizacion   DATETIME NULL,

        --CREAMOS LA RELACION CON LA TABLA ROLES
        FOREIGN KEY (rol_id) REFERENCES roles (id_rol)  on delete cascade 
                                                        on update cascade

    ) ENGINE=InnoDB;

    -- AGREGAMOS UN USUARIO POR DEFECTO
    INSERT INTO usuarios ( rol_id, email, password, estado, fyh_creacion)
    VALUE ('1', 'admin@admin.com', '$2y$10$DA9p2iGpI0x/g84ZtmtZw.fIMRtSjcm5FbXwoZW.ZZv8zZ92fB48S', '1', '24-12-28 18:19:00');

----------------
-- TABLA CONFIGURACION
----------------
    CREATE TABLE configuracion_instituciones(
        id_config_institucion   INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        nombre_institucion      VARCHAR(255) NOT NULL UNIQUE KEY,
        logo                    VARCHAR(255) NULL,
        direccion               VARCHAR(255) NOT NULL,
        telefono                VARCHAR(255) NULL,
        celular                 VARCHAR(255) NULL,
        correo                  VARCHAR(255) NULL,
        estado                  VARCHAR(255),

        fyh_creacion        DATETIME NULL,
        fyh_actualizacion   DATETIME NULL

    ) ENGINE=InnoDB;

----------------
-- TABLA GESTION
----------------
    CREATE TABLE gestiones(
        id_gestion   INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        gestion      VARCHAR(255) NOT NULL UNIQUE KEY,
        estado       VARCHAR(255) NULL,

        fyh_creacion        DATETIME NULL,
        fyh_actualizacion   DATETIME NULL
    ) ENGINE=InnoDB;

----------------
-- TABLA NIVELES
----------------
    CREATE TABLE niveles(
        id_nivel    INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        gestion_id  INT(11) NOT NULL,
        nivel       VARCHAR(255) NOT NULL,
        turno       VARCHAR(255) NOT NULL,
        estado      VARCHAR(255) NULL,

        fyh_creacion        DATETIME NULL,
        fyh_actualizacion   DATETIME NULL,

        --CREAMOS LA RELACION CON LA TABLA GESTIONES
        FOREIGN KEY (gestion_id) REFERENCES gestiones (id_gestion)  on delete no action 
                                                                    on update cascade

    ) ENGINE=InnoDB;

----------------
-- TABLA GRADOS
----------------
    CREATE TABLE grados(
        id_grado    INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        nivel_id    INT(11) NOT NULL,
        curso       VARCHAR(255) NOT NULL,
        paralelo    VARCHAR(255) NOT NULL,
        estado      VARCHAR(255) NULL,

        fyh_creacion        DATETIME NULL,
        fyh_actualizacion   DATETIME NULL,

        --CREAMOS LA RELACION CON LA TABLA NIVELES
        FOREIGN KEY (nivel_id) REFERENCES niveles (id_nivel)    on delete no action 
                                                                on update cascade
    ) ENGINE=InnoDB;

----------------
-- TABLA MATERIAS
----------------
    CREATE TABLE materias(
        id_materia     INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        nombre_materia VARCHAR(255) NOT NULL,
        estado      VARCHAR(255) NULL,

        fyh_creacion        DATETIME NULL,
        fyh_actualizacion   DATETIME NULL

    ) ENGINE=InnoDB;

----------------
-- NORMALIZACION DE TABLAS 
----------------
-- TABLA PERSONAS
    CREATE TABLE personas(
        id_persona        INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        usuario_id        INT(11) NOT NULL,
        nombres           VARCHAR(55) NULL,
        apellidos         VARCHAR(55) NULL,
        dni               VARCHAR(55) NULL,
        fecha_nacimiento  VARCHAR(55) NULL,
        profesion         VARCHAR(55) NULL,
        direccion         VARCHAR(255) NULL,
        celular           VARCHAR(55) NULL,
        estado            VARCHAR(55) NULL,

        fyh_creacion        DATETIME NULL,
        fyh_actualizacion   DATETIME NULL,

        --CREAMOS LA RELACION CON LA TABLA USUARIOS
        FOREIGN KEY (usuario_id) REFERENCES usuarios (id_usuario)   on delete no action 
                                                                    on update cascade

    ) ENGINE=InnoDB;

----------------
-- TABLA ADMINISTRATIVOS
----------------
    CREATE TABLE administrativos(
        id_administrativo   INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        persona_id          INT(11) NOT NULL,
        estado              VARCHAR(255) NULL,

        fyh_creacion        DATETIME NULL,
        fyh_actualizacion   DATETIME NULL,

        --CREAMOS LA RELACION CON LA TABLA PERSONAS
        FOREIGN KEY (persona_id) REFERENCES personas (id_persona)   on delete no action 
                                                                    on update cascade

    ) ENGINE=InnoDB;

----------------
-- TABLA DOCENTES
----------------
    CREATE TABLE docentes(
        id_docente    INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        persona_id    INT(11) NOT NULL,
        especialidad  VARCHAR(55) NULL,
        antiguedad    VARCHAR(255) NULL,
        estado        VARCHAR(55) NULL,

        fyh_creacion        DATETIME NULL,
        fyh_actualizacion   DATETIME NULL,

        --CREAMOS LA RELACION CON LA TABLA PERSONAS
        FOREIGN KEY (persona_id) REFERENCES personas (id_persona)   on delete no action 
                                                                    on update cascade

    ) ENGINE=InnoDB;

----------------
-- TABLA ESTUDIANTE
----------------
    CREATE TABLE estudiantes(
        id_estudiante   INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        persona_id      INT(11) NOT NULL,
        legajo          INT(50) NOT NULL UNIQUE KEY,
        nivel_id        INT(11) NOT NULL,
        grado_id        INT(11) NOT NULL,
        estado          VARCHAR(255) NULL,

        fyh_creacion        DATETIME NULL,
        fyh_actualizacion   DATETIME NULL,

        --CREAMOS LA RELACION CON LA TABLA PERSONAS
        FOREIGN KEY (persona_id) REFERENCES personas (id_persona)   on delete no action 
                                                                    on update cascade,
        --CREAMOS LA RELACION CON LA TABLA NIVELES
        FOREIGN KEY (nivel_id) REFERENCES niveles (id_nivel) on delete no action 
                                                                on update cascade,
        --CREAMOS LA RELACION CON LA TABLA GRADOS
        FOREIGN KEY (grado_id) REFERENCES grados (id_grado) on delete no action 
                                                            on update cascade

    ) ENGINE=InnoDB;

----------------
-- TABLA PPFF
----------------
    CREATE TABLE ppffs(
        id_ppff          INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        estudiante_id    INT(11) NOT NULL,
        nombre_apellidos VARCHAR(55) NULL,
        dni_ppff         VARCHAR(55) NULL UNIQUE KEY,
        celular_ppff     VARCHAR(55) NULL,
        ocupacion        VARCHAR(55) NULL,
        ref_nombre       VARCHAR(55) NULL,
        ref_parentezco   VARCHAR(55) NULL,
        ref_celular      VARCHAR(55) NULL,
        estado           VARCHAR(55) NULL,

        fyh_creacion        DATETIME NULL,
        fyh_actualizacion   DATETIME NULL,

        --CREAMOS LA RELACION CON LA TABLA ESTUDIANTES
        FOREIGN KEY (estudiante_id) REFERENCES estudiantes (id_estudiante)  on delete no action 
                                                                            on update cascade

    ) ENGINE=InnoDB;

----------------
-- TABLA PAGOS
----------------
    CREATE TABLE pagos(
        id_pago          INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        estudiante_id    INT(11) NOT NULL,
        mes_pagado       VARCHAR(55) NULL,
        monto_pagado     VARCHAR(55) NULL,
        fecha_pagado     VARCHAR(55) NULL,        
        estado           VARCHAR(55) NULL,

        fyh_creacion        DATETIME NULL,
        fyh_actualizacion   DATETIME NULL,

        --CREAMOS LA RELACION CON LA TABLA ESTUDIANTES
        FOREIGN KEY (estudiante_id) REFERENCES estudiantes (id_estudiante)  on delete no action 
                                                                            on update cascade

    ) ENGINE=InnoDB;

----------------
-- TABLA ASIGNACIONES
----------------
    CREATE TABLE asignaciones(
        id_asignacion  INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        docente_id     INT(11) NOT NULL,
        nivel_id       INT(11) NOT NULL,
        grado_id       INT(11) NOT NULL,
        materia_id     INT(11) NOT NULL,
        estado         VARCHAR(55) NULL,

        fyh_creacion        DATETIME NULL,
        fyh_actualizacion   DATETIME NULL,

        --CREAMOS LA RELACION CON LA TABLA DOCENTES
        FOREIGN KEY (docente_id) REFERENCES docentes (id_docente)   on delete no action 
                                                                    on update cascade,

        --CREAMOS LA RELACION CON LA TABLA NIVELES
        FOREIGN KEY (nivel_id) REFERENCES  niveles (id_nivel)   on delete no action 
                                                                on update cascade,

        --CREAMOS LA RELACION CON LA TABLA GRADOS
        FOREIGN KEY (grado_id) REFERENCES grados (id_grado)  on delete no action 
                                                                            on update cascade

        --CREAMOS LA RELACION CON LA TABLA MATERIAS
        FOREIGN KEY (materia_id) REFERENCES materias (id_materia)  on delete no action 
                                                                    on update cascade
    ) ENGINE=InnoDB;

----------------
-- TABLA CALIFICACIONES
----------------
    CREATE TABLE calificaciones(
        id_calificacion  INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        docente_id       INT(11) NOT NULL,
        estudiante_id    INT(11) NOT NULL,
        materia_id    INT(11) NOT NULL,
        nota1            VARCHAR(55) NULL,
        nota2            VARCHAR(55) NULL,
        nota3            VARCHAR(55) NULL,        
        estado         VARCHAR(55) NULL,

        fyh_creacion        DATETIME NULL,
        fyh_actualizacion   DATETIME NULL,

        --CREAMOS LA RELACION CON LA TABLA DOCENTES
        FOREIGN KEY (docente_id) REFERENCES docentes (id_docente)   on delete no action 
                                                                    on update cascade,

        --CREAMOS LA RELACION CON LA TABLA ESTUDIANTES
        FOREIGN KEY (estudiante_id) REFERENCES estudiantes (id_estudiante)  on delete no action 
                                                                            on update cascade,

        --CREAMOS LA RELACION CON LA TABLA MATERIAS
        FOREIGN KEY (materia_id) REFERENCES materias (id_materia)  on delete no action 
                                                                            on update cascade


    ) ENGINE=InnoDB;

----------------
-- TABLA KARDEX
----------------
    CREATE TABLE kardexs(
        id_kardex  INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        docente_id       INT(11) NOT NULL,
        estudiante_id    INT(11) NOT NULL,
        materia_id       INT(11) NOT NULL,

        observacion      VARCHAR(255) NOT NULL,
        fecha            VARCHAR(255) NULL,
        nota             TEXT NOT NULL,        
        estado         VARCHAR(55) NULL,

        fyh_creacion        DATETIME NULL,
        fyh_actualizacion   DATETIME NULL,

        --CREAMOS LA RELACION CON LA TABLA DOCENTES
        FOREIGN KEY (docente_id) REFERENCES docentes (id_docente)   on delete no action 
                                                                    on update cascade,

        --CREAMOS LA RELACION CON LA TABLA ESTUDIANTES
        FOREIGN KEY (estudiante_id) REFERENCES estudiantes (id_estudiante)  on delete no action 
                                                                            on update cascade,

        --CREAMOS LA RELACION CON LA TABLA MATERIAS
        FOREIGN KEY (materia_id) REFERENCES materias (id_materia)  on delete no action 
                                                                            on update cascade


    ) ENGINE=InnoDB;

----------------
-- TABLA PERMISOS
----------------
    CREATE TABLE permisos(
        id_permiso  INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,

        nombre_url    VARCHAR(255) NOT NULL,
        url           TEXT NOT NULL,
        estado        VARCHAR(55) NULL,

        fyh_creacion        DATETIME NULL,
        fyh_actualizacion   DATETIME NULL

    ) ENGINE=InnoDB;

----------------
-- TABLA ROLES_PERMISOS
----------------
    CREATE TABLE roles_permisos(
        id_rol_permiso  INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,

        rol_id          INT(11) NOT NULL,
        permiso_id      INT(11) NOT NULL,
        estado          VARCHAR(55) NULL,

        fyh_creacion        DATETIME NULL,
        fyh_actualizacion   DATETIME NULL,

        --CREAMOS LA RELACION CON LA TABLA ROLES
        FOREIGN KEY (rol_id) REFERENCES roles (id_rol)  on delete no action 
                                                        on update cascade,

        --CREAMOS LA RELACION CON LA TABLA PERMISOS
        FOREIGN KEY (permiso_id) REFERENCES permisos (id_permiso)   on delete no action 
                                                                    on update cascade

    ) ENGINE=InnoDB;