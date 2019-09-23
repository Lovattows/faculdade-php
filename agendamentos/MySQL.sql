/*--------------------------------------------------------------------------------------------------------------*/
/*----------------------------------- CRIAÇÃO DE DATABASE, TABELAS E INSERTS -----------------------------------*/
/*--------------------------------------------------------------------------------------------------------------*/
CREATE SCHEMA QUADRA;

USE QUADRA;

CREATE TABLE CLIENTES
(
    ID_CLI      int NOT NULL AUTO_INCREMENT,
    NOME        varchar(100),
    TELEFONE    varchar(10),
    DT_CADASTRO datetime,
    ATIVADO     int DEFAULT 1,
    DESATIVADO  int DEFAULT 0,
    OPERACAO    char,
    PRIMARY KEY (ID_CLI)
);

CREATE TABLE ESPORTES
(
    ID_ESPORTE int NOT NULL AUTO_INCREMENT,
    NOME       varchar(100),
    PRIMARY KEY (ID_ESPORTE)
);

CREATE TABLE QUADRAS
(
    ID_QUADRA int NOT NULL AUTO_INCREMENT,
    NOME      varchar(100),
    PRIMARY KEY (ID_QUADRA)
);

CREATE TABLE HORARIOS
(
    ID_HORARIO  int NOT NULL AUTO_INCREMENT,
    HORA_INICIO time,
    HORA_FIM    time,
    TURNO       varchar(5),
    PRIMARY KEY (ID_HORARIO)
);

CREATE TABLE AGENDAMENTO
(
    ID_AGENDAMENTO int NOT NULL AUTO_INCREMENT,
    ID_CLI         int,
    ID_ESPORTE     int,
    ID_HORARIO     int,
    ID_QUADRA      int,
    DATA           date,
    VALOR          numeric(15, 2),
    PRESENTE       int,
    AUSENTE        int,
    DT_CADASTRO    datetime,
    PRIMARY KEY (ID_AGENDAMENTO),
    FOREIGN KEY (ID_CLI) REFERENCES CLIENTES
        (ID_CLI) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (ID_ESPORTE) REFERENCES ESPORTES
        (ID_ESPORTE) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (ID_QUADRA) REFERENCES QUADRAS
        (ID_QUADRA) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (ID_HORARIO) REFERENCES HORARIOS
        (ID_HORARIO) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE USUARIO
(
    ID_USUARIO int NOT NULL AUTO_INCREMENT,
    LOGIN      varchar(255),
    PASSWORD   varchar(255),
    PRIMARY KEY (ID_USUARIO)
);

INSERT INTO USUARIO(login, password)
values ('admin', md5('admin'));

INSERT INTO horarios(HORA_INICIO, HORA_FIM, TURNO)
VALUES ('08:00:00', '09:00:00', 'Manhã'),
       ('09:00:00', '10:00:00', 'Manhã'),
       ('10:00:00', '11:00:00', 'Manhã'),
       ('11:00:00', '12:00:00', 'Manhã'),
       ('14:00:00', '15:00:00', 'Tarde'),
       ('15:00:00', '16:00:00', 'Tarde'),
       ('16:00:00', '17:00:00', 'Tarde'),
       ('17:00:00', '18:00:00', 'Tarde'),
       ('18:00:00', '19:00:00', 'Tarde'),
       ('19:00:00', '20:00:00', 'Noite'),
       ('20:00:00', '21:00:00', 'Noite'),
       ('21:00:00', '22:00:00', 'Noite'),
       ('22:00:00', '23:00:00', 'Noite'),
       ('23:00:00', '00:00:00', 'Noite');

INSERT INTO esportes(NOME)
VALUES ('Futsal'),
       ('Basquete'),
       ('Vôlei');

INSERT INTO quadras(NOME)
VALUES ('A01'),
       ('A02'),
       ('A03'),
       ('B01'),
       ('B02'),
       ('B03'),
       ('C01'),
       ('C02'),
       ('C03');

/*--------------------------------------------------------------------------------------------------------------*/
/*---------------------------------------------- CRIAÇÃO DE VIEWS ----------------------------------------------*/
/*--------------------------------------------------------------------------------------------------------------*/
CREATE VIEW top_quadras as
SELECT q.nome,
       COUNT(id_agendamento)              as vezes,
       SUM(valor)                         as valor_total,
       SUM(valor) / COUNT(id_agendamento) as media_valor,
       SUM(presente)                      as presente,
       SUM(ausente)                       as ausente
FROM agendamento a
         INNER JOIN quadras q ON a.id_quadra = q.id_quadra
WHERE presente <> 0
   OR ausente <> 0
GROUP BY q.nome
ORDER BY vezes DESC;

/*--------------------------------------------------------------------------------------------------------------*/

CREATE VIEW top_esportes as
SELECT e.nome,
       COUNT(id_agendamento)              as vezes,
       SUM(valor)                         as valor_total,
       SUM(valor) / COUNT(id_agendamento) as media_valor,
       SUM(presente)                      as presente,
       SUM(ausente)                       as ausente
FROM agendamento a
         INNER JOIN esportes e ON a.id_esporte = e.id_esporte
WHERE presente <> 0
   OR ausente <> 0
GROUP BY e.nome
ORDER BY vezes DESC;

/*--------------------------------------------------------------------------------------------------------------*/

CREATE VIEW top_clientes as
SELECT c.nome,
       COUNT(id_agendamento)              as vezes,
       SUM(valor)                         as valor_total,
       SUM(valor) / COUNT(id_agendamento) as media_valor,
       SUM(presente)                      as presente,
       SUM(ausente)                       as ausente
FROM agendamento a
         INNER JOIN clientes c ON a.id_cli = c.id_cli
WHERE presente <> 0
   OR ausente <> 0
GROUP BY c.nome
ORDER BY vezes DESC;

/*--------------------------------------------------------------------------------------------------------------*/

CREATE VIEW top_horarios as
SELECT h.hora_inicio,
       h.hora_fim,
       COUNT(id_agendamento)              as vezes,
       SUM(valor)                         as valor_total,
       SUM(valor) / COUNT(id_agendamento) as media_valor,
       SUM(presente)                      as presente,
       SUM(ausente)                       as ausente
FROM agendamento a
         INNER JOIN horarios h ON a.id_horario = h.id_horario
WHERE presente <> 0
   OR ausente <> 0
GROUP BY h.hora_inicio
ORDER BY vezes DESC;

/*--------------------------------------------------------------------------------------------------------------*/

CREATE VIEW top_turnos as
SELECT h.turno,
       COUNT(id_agendamento)              as vezes,
       SUM(valor)                         as valor_total,
       SUM(valor) / COUNT(id_agendamento) as media_valor,
       SUM(presente)                      as presente,
       SUM(ausente)                       as ausente
FROM agendamento a
         INNER JOIN horarios h ON a.id_horario = h.id_horario
WHERE presente <> 0
   OR ausente <> 0
GROUP BY h.turno
ORDER BY vezes DESC;

/*--------------------------------------------------------------------------------------------------------------*/

CREATE VIEW top_agendamentos as
SELECT SUM(presente)       as presente,
       SUM(ausente)        as ausente,
       (SELECT COUNT(id_agendamento)
        FROM agendamento
        WHERE presente = 0
          AND ausente = 0) as agendados
FROM agendamento;

/*--------------------------------------------------------------------------------------------------------------*/
/*---------------------------------------- TRIGGERS e STORED PROCEDURES ----------------------------------------*/
/*--------------------------------------------------------------------------------------------------------------*/

delimiter //
CREATE TRIGGER t_set_presente_zero_insert
    BEFORE INSERT
    ON agendamento
    FOR EACH ROW
BEGIN
    IF new.presente IS NULL
    THEN
        SET new.presente = 0;
    END IF;
END;
//
DELIMITER ;

/*--------------------------------------------------------------------------------------------------------------*/

delimiter //
CREATE TRIGGER t_set_ausente_zero_insert
    BEFORE INSERT
    ON agendamento
    FOR EACH ROW
BEGIN
    IF new.ausente IS NULL
    THEN
        SET new.ausente = 0;
    END IF;
END;
//
DELIMITER ;

/*--------------------------------------------------------------------------------------------------------------*/

delimiter //
CREATE TRIGGER t_set_presente_zero_update
    BEFORE UPDATE
    ON agendamento
    FOR EACH ROW
BEGIN
    IF new.presente IS NULL
    THEN
        SET new.presente = 0;
    END IF;
END;
//
DELIMITER ;

/*--------------------------------------------------------------------------------------------------------------*/

delimiter //
CREATE TRIGGER t_set_ausente_zero_update
    BEFORE UPDATE
    ON agendamento
    FOR EACH ROW
BEGIN
    IF new.ausente IS NULL
    THEN
        SET new.ausente = 0;
    END IF;
END;
//
DELIMITER ;

/*--------------------------------------------------------------------------------------------------------------*/

DELIMITER //
CREATE PROCEDURE p_not_repeat_cliente_insert(IN telefone varchar(10))
BEGIN
    DECLARE msg varchar(100);
    IF (EXISTS(SELECT DISTINCT c.id_cli
               FROM CLIENTES c
               WHERE c.telefone = telefone))
    THEN
        SET msg = concat('Telefone já cadastrado');
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = msg;
    END IF;
END;
//
DELIMITER ;

DELIMITER //
CREATE TRIGGER t_not_repeat_cliente_insert
    BEFORE INSERT
    ON clientes
    FOR EACH ROW
BEGIN
    IF (new.operacao LIKE 'I')
    THEN
        CALL p_not_repeat_cliente_insert(new.telefone);
    END IF;
END;
//
DELIMITER ;

/*--------------------------------------------------------------------------------------------------------------*/

DELIMITER //
CREATE PROCEDURE p_not_repeat_cliente_update(IN telefone varchar(10), IN id_cli int)
BEGIN
    DECLARE msg varchar(100);
    IF (EXISTS(SELECT DISTINCT c.id_cli
               FROM CLIENTES c
               WHERE c.telefone = telefone
                 AND c.id_cli <> id_cli))
    THEN
        SET msg = concat('Telefone já cadastrado');
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = msg;
    END IF;
END;
//
DELIMITER ;

DELIMITER //
CREATE TRIGGER t_not_repeat_cliente_update
    BEFORE UPDATE
    ON clientes
    FOR EACH ROW
BEGIN
    IF (new.operacao LIKE 'U')
    THEN
        CALL p_not_repeat_cliente_update(new.telefone, new.id_cli);
    END IF;
END;
//
DELIMITER ;

/*--------------------------------------------------------------------------------------------------------------*/

DELIMITER //
CREATE PROCEDURE p_delete_agendamento_now()
BEGIN
    DELETE
    FROM agendamento
    WHERE data = CURDATE();
END;
//
DELIMITER ;

/*--------------------------------------------------------------------------------------------------------------*/

DELIMITER //
CREATE PROCEDURE p_delete_agendamento_month()
BEGIN
    DELETE
    FROM agendamento
    WHERE MONTH(data) = MONTH(CURRENT_DATE);
END;
//
DELIMITER ;

/*--------------------------------------------------------------------------------------------------------------*/

DELIMITER //
CREATE PROCEDURE p_delete_agendamento_year()
BEGIN
    DELETE
    FROM agendamento
    WHERE YEAR(data) = YEAR(CURRENT_DATE);
END;
//
DELIMITER ;

/*--------------------------------------------------------------------------------------------------------------*/

DELIMITER //
CREATE PROCEDURE p_delete_agendamento_past()
BEGIN
    DELETE
    FROM agendamento
    WHERE data < CURRENT_DATE;
END;
//
DELIMITER ;

/*--------------------------------------------------------------------------------------------------------------*/

DELIMITER //
CREATE PROCEDURE p_delete_agendamento_future()
BEGIN
    DELETE
    FROM agendamento
    WHERE data > CURRENT_DATE;
END;
//
DELIMITER ;

