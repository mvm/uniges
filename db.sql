drop database if exists uniges;
create database if not exists uniges;
use uniges;

drop user if exists uniges@localhost;
create user uniges@localhost identified by "uniges";
grant all privileges on uniges.* to uniges@localhost;

drop table if exists `action`;
create table `action` (
	id int not null,
	name varchar(255) not null,
	description text not null,
	deleted tinyint(1) not null default 0);

insert into action values (1, "list", "Mostrar todos", 0), (2, "add", "Añadir", 0),
	(3, "edit", "Editar", 0), (4, "delete", "Borrar", 0),
	(5, "login_end", "Iniciar sesión", 0), (6, "add_end", "Realizar añadir", 0),
	(7, "edit_end", "Realizar modificación", 0), (8, "logout", "Logout", 0),
	(9, "asistencia", "Indicar asistencia", 0);

drop table if exists `academicyear`;
create table `academicyear` (
	id int not null auto_increment primary key,
	name varchar(10) not null,
	deleted tinyint(1) not null default 0);

drop table if exists `subject`;
create table `subject` (
	id int not null auto_increment primary key,
	academicyear_id int not null,
	degree_id int not null,
	department_id int not null,
	professor_id int not null,
	code varchar(10) not null,
	name varchar(255) not null,
	content varchar(255) not null,
	credits int not null,
	type enum('OB', 'OP', 'FB') not null,
	hours int not null,
	semester enum('1','2') not null,
	deleted tinyint(1) not null default 0);

drop table if exists `asistencia`;
create table `asistencia` (
	id int not null,
	academicyear_id varchar(10) not null,
	professor_id varchar(10) not null,
	timetable_id int not null,
	group_id int not null,
	attendance enum('si','no') not null,
	deleted tinyint(1) not null default 0);

drop table if exists `centre`;
create table `centre` (
	id int not null auto_increment primary key,
	academicyear_id int not null,
	college_id int not null,
	name varchar(255) not null,
	city varchar(255) not null,
	overseer varchar(9) default null,
	deleted tinyint(1) not null default 0);

drop table if exists `department`;
create table `department` (
	id int not null auto_increment primary key,
	academicyear_id int not null,
	centre_id int not null,
	code varchar(255) not null,
	name varchar(255) not null,
	deleted tinyint(1) not null default 0);

drop table if exists `building`;
create table `building` (
	id int not null auto_increment primary key,
	academicyear_id int not null,
	college_id int not null,
	name varchar(255) not null,
	location varchar(255) not null,
	deleted tinyint(1) not null default 0);

drop table if exists `space`;
create table `space` (
	id int not null auto_increment primary key,
	academicyear_id int not null,
	building_id int not null,
	name varchar(255) not null,
	type enum('aula','despacho') not null,
	deleted tinyint(1) not null default 0);

drop table if exists `feature`;
create table `feature` (
	id int not null,
	name varchar(255) not null,
	description text not null,
	deleted tinyint(1) not null default 0);

insert into feature values (1, "user", "Gestion de usuarios", 0),
	(2, "professor", "Gestion de profesores", 0),
	(3, "tutoria", "Gestion de tutorias", 0),
	(4, "department", "Gestion de departamentos", 0),
	(5, "subject", "Gestión de asignaturas", 0),
	(6, "space", "Gestión de espacios", 0),
	(7, "building", "Gestión de edificios", 0),
	(8, "group", "Gestión de grupos", 0),
	(9, "college", "Gestión de universidades", 0),
	(10, "centre", "Gestión de centros", 0),
	(11, "degree", "Gestión de grados", 0),
	(12, "pda", "Gestión de PDAs", 0);

drop table if exists `group`;
create table `group` (
	id int not null auto_increment primary key,
	academicyear_id int not null,
	subject_id int not null,
	professor_id int default null,
	code varchar(255) not null,
	name varchar(255) not null,
	type enum('GA','GB','GC') not null,
	hours int not null,
	deleted tinyint(1) not null default 0);

drop table if exists `timetable`;
create table `timetable` (
	id int not null auto_increment primary key,
	academicyear_id int not null,
	space_id int not null,
	group_id int default null,
	`date` date not null,
	hourbegin time not null,
	hourend time not null,
	day enum('lun','mar','mie','jue','vie') not null,
	deleted tinyint(1) not null default 0);


drop table if exists professor;
create table professor (
	id int not null auto_increment primary key,
	academicyear_id int not null,
	department_id int not null,
	dedication varchar(10) not null,
	user_id int not null,
	deleted tinyint(1) not null default 0);

drop table if exists role;
create table role (
	id int not null primary key,
	name varchar(255) not null,
	deleted tinyint(1) not null default 0);

insert into role values (1, "Administrador", 0), (2, "Usuario", 0);

drop table if exists role_permission;
create table role_permission (
	role_id int not null,
	feature_id int not null,
	action_id int not null);

insert into role_permission values (1, 1, 1),
(1, 1, 2),
(1, 1, 3),
(1, 1, 4),
(1, 1, 5),
(1, 1, 6),
(1, 1, 7),
(1, 1, 8),
(1, 2, 1),
(1, 2, 2),
(1, 2, 3),
(1, 2, 4),
(1, 2, 5),
(1, 2, 6),
(1, 2, 7),
(1, 3, 1),
(1, 3, 2),
(1, 3, 3),
(1, 3, 4),
(1, 3, 6),
(1, 3, 7),
(1, 3, 9),
(1, 4, 1),
(1, 4, 2),
(1, 4, 3),
(1, 4, 4),
(1, 4, 6),
(1, 4, 7),
(1, 5, 1),
(1, 5, 2),
(1, 5, 3),
(1, 5, 4),
(1, 5, 6),
(1, 5, 7),
(1, 6, 1),
(1, 6, 2),
(1, 6, 3),
(1, 6, 4),
(1, 6, 6),
(1, 6, 7),
(1, 7, 1),
(1, 7, 2),
(1, 7, 3),
(1, 7, 4),
(1, 7, 6),
(1, 7, 7),
(1, 8, 1),
(1, 8, 2),
(1, 8, 3),
(1, 8, 4),
(1, 8, 6),
(1, 8, 7),
(1, 9, 1),
(1, 9, 2),
(1, 9, 3),
(1, 9, 4),
(1, 9, 6),
(1, 9, 7),
(1, 10, 1),
(1, 10, 2),
(1, 10, 3),
(1, 10, 4),
(1, 10, 6),
(1, 10, 7),
(1, 11, 1),
(1, 11, 2),
(1, 11, 3),
(1, 11, 4),
(1, 11, 6),
(1, 11, 7),
(1, 12, 1),
(1, 12, 2),
(1, 12, 3),
(1, 12, 4),
(1, 12, 6),
(1, 12, 7),
(2, 1, 1),
(2, 1, 8),
(2, 2, 1),
(2, 3, 1),
(2, 3, 9),
(2, 4, 1),
(2, 5, 1),
(2, 6, 1),
(2, 7, 1),
(2, 8, 1),
(2, 9, 1),
(2, 10, 1),
(2, 11, 1),
(2, 12, 1);

drop table if exists degree;
create table degree (
	id int not null auto_increment primary key,
	academicyear_id int not null,
	centre_id int not null,
	code varchar(20) not null,
	name varchar(255) not null,
	supervisor int not null,
	deleted tinyint(1) not null default 0);

drop table if exists tutoria;
create table tutoria (
	id int not null auto_increment primary key,
	academicyear_id int,
	professor_id int,
	deleted tinyint(1) default 0);

drop table if exists college;
create table college (
	id int not null auto_increment primary key,
	academicyear_id int not null,
	name varchar(255),
	city varchar(255),
	supervisor int not null,
	deleted tinyint(1) not null default 0);

drop table if exists user;
create table user (
       id int not null auto_increment primary key,
	dni varchar(9) not null,
	name varchar(255) not null,
	surname varchar(255) not null,
	email varchar(255),
	password varchar(128),
	deleted tinyint(1) not null default 0);

alter table professor add constraint professor_user_id foreign key (user_id) references user(id);

drop table if exists user_role;
create table user_role (
	user_id int not null,
	role_id int not null,
	foreign key (user_id) references user(id),
	foreign key (role_id) references role(id),
	primary key (user_id));

drop table if exists pda;
create table pda (
	id int not null auto_increment primary key,
	title varchar(20) not null,
	file varchar(50) not null,
	academicyear_id int,
	college_id int,
	centre_id int,
	degree_id int,
	deleted tinyint(1) not null default 0);

drop table if exists subject_pda;
create table subject_pda (
	id int not null,
	code varchar(255),
	content varchar(255),
	type varchar(255),
	department varchar(255),
	area varchar(255),
	docencia varchar(255),
	Cuadr varchar(255),
	Cred varchar(255),
	NNv varchar(255),
	NRep varchar(255),
	NEf varchar(255),
	NLE varchar(255),
	HA varchar(255),
	HB varchar(255),
	HC varchar(255),
	GA varchar(255),
	GB varchar(255),
	GC varchar(255),
	HMatric varchar(255),
	HImpart varchar(255),
	PODA varchar(255),
	PODB varchar(255),
	PODC varchar(255),
	TMG varchar(255),
	Presen varchar(255),
	pda_id int);

drop table if exists department_pda;
create table department_pda (
	id int not null,
	code varchar(255),
	name varchar(255),
	hours varchar(255),
	percent varchar(255),
	pda_id int);

drop table if exists area_pda;
create table area_pda (
	id int not null,
	code varchar(255),
	name varchar(255),
	hours varchar(255),
	percent varchar(255),
	department_id int,
	pda_id int);

drop table if exists pod;
create table pod (
	id int not null,
	title varchar(40),
	file varchar(50),
	college varchar(40),
	centre varchar(40),
	deleted tinyint(1) not null default 0);

drop table if exists asistenciatutoria;
create table asistenciatutoria (
	tutoria_id int not null,
	timetable_id int not null,
	attendance enum('si','no') not null default 'no',
	deleted tinyint(1) not null default 0,
	primary key (tutoria_id, timetable_id)
);

drop table if exists professor_pod;
create table professor_pod (
	id int not null,
	documento varchar(255),
	nombre varchar(255),
	adicacion varchar(255),
	titulacion varchar(255),
	cod varchar(255),
	contido varchar(255),
	horas varchar(255),
	alumnos varchar(255),
	departamento varchar(255),
	pod_id int not null);

drop table if exists grupo_pda;
create table grupo_pda (
	id int not null,
	codigo varchar(255),
	tipo varchar(255),
	horas varchar(255),
	G varchar(255),
	pod varchar(255),
	pda_id int default null);

alter table user_role add constraint role_user_id foreign key (user_id) references user(id);
alter table user_role add constraint role_role_id foreign key (role_id) references role(id);
alter table tutoria add constraint tutoria_academicyear_id foreign key (academicyear_id) references academicyear(id);
alter table tutoria add constraint tutoria_professor_id foreign key (professor_id) references professor(id);

alter table timetable add constraint timetable_academicyear_id foreign key (academicyear_id) references academicyear(id);
alter table asistenciatutoria add constraint asistenciatutoria_tutoria_id foreign key (tutoria_id) references tutoria(id);
alter table asistenciatutoria add constraint asistenciatutoria_timetable_id foreign key (timetable_id) references timetable(id);
alter table department add constraint department_academicyear_id foreign key (academicyear_id) references academicyear(id);

alter table subject add constraint subject_academicyear_id foreign key (academicyear_id) references academicyear(id);
alter table subject add constraint subject_department_id foreign key (department_id) references department(id);
alter table subject add constraint subject_professor_id foreign key (professor_id) references professor(id);

alter table space add constraint space_academicyear_id foreign key (academicyear_id) references academicyear(id);

alter table college add constraint college_academicyear_id foreign key (academicyear_id) references academicyear(id);
alter table college add constraint college_supervisor_id foreign key (supervisor) references professor(id);
alter table building add constraint building_academicyear_id foreign key (academicyear_id) references academicyear(id);
alter table building add constraint building_college_id foreign key (college_id) references college(id);
alter table `group` add constraint group_academicyear_id foreign key (academicyear_id) references academicyear(id);
alter table `group` add constraint group_subject_id foreign key (subject_id) references subject(id);
alter table `group` add constraint group_professor_id foreign key (professor_id) references professor(id);

alter table `pda` add constraint pda_academicyear_id foreign key (academicyear_id) references academicyear(id);
alter table pda add constraint pda_college foreign key (college_id) references college(id);
alter table pda add constraint pda_centre_id foreign key (centre_id) references centre(id);
alter table pda add constraint pda_degree_id foreign key (degree_id) references degree(id);

alter table `degree` add constraint degree_academicyear_id foreign key (academicyear_id) references academicyear(id);
alter table `degree` add constraint degree_centre_id foreign key (centre_id) references centre(id);
alter table `degree` add constraint degree_supervisor foreign key (supervisor) references professor(id);

alter table centre add constraint centre_academicyear_id foreign key (academicyear_id) references academicyear(id);
alter table centre add constraint centre_college_id foreign key (college_id) references college(id);

INSERT INTO `user` VALUES (1,'12345Q','Test','Prueba','test@gmail.com','$2y$10$4fGCqHANKZwS90hNpGOzWOOpW32m.xdrYnITZJnMaLmewIBRIZrKe',0),
(6,'1234L','Prueba','Probador','test@test.com','$2y$10$1AjuLEZA4Zu6uA2OvZHGpufCwixrKICFefgR05kxXvDGV9W9ZSrnC',1),
(7,'1234L','Prueba','Probador','test@test.com','$2y$10$dAeQyTbL/HY8/sqmjizrEOTqtiFUGJD5JJLL/luUd/DWVT25dRqLi',1),
(8,'1234567P','Pobrecito','Probador','prueba2@gmail.com','$2y$10$QwlZHWSi29eTR8KWCZor9uixFEIdifvpvX4pBudlqIWp4XjP2AEJW',0),
(9, "12345678L", "Admin", "Admin", "root@test.com", "$2y$10$QwlZHWSi29eTR8KWCZor9uixFEIdifvpvX4pBudlqIWp4XjP2AEJW", 0);

insert into user_role values (1, 1), (8, 2), (9, 1);

INSERT INTO academicyear VALUES (1, '2021/22', 0);
INSERT INTO academicyear VALUES (0, '2020/21', 0);
INSERT INTO department VALUES (1, 1, 0, 'ABC1', 'Ingeniería Informática', 0);
INSERT INTO professor VALUES (1, 0, 1, 'Completa', 1, 0);
insert into tutoria values (1, 1, 1, 0);

insert into timetable values (0, 1, 1, 1, "2021-12-1", "10:00", "11:00", 'mie', 0);
insert into timetable values (0, 1, 1, 1, "2021-12-2", "09:00", "10:00", 'jue', 0);
insert into asistenciatutoria values (1, 1, 'no', 0), (1, 2, 'no', 0);
insert into subject values (1, 1, 0, 1, 1, 'BDI', "Bases de Datos I", "Descripción de Bases de Datos", 6, 'OB', 80, '1', 0);
insert into space values (1, 1, 0, "Aula Magna", "aula", 0);
insert into college values (1, 1, "Campus Ourense", "Ourense", 1, 0);
insert into building values (1, 1, 1, "Facultad de Informática", "Ourense", 0);
insert into `group` values (1, 1, 1, 1, 'GP1', 'Grupo 1', 'GA', 120, 0);
insert into centre values (1, 2, 1, "Facultad de Informática", "Ourense", 1, 0);
insert into `degree` values (1, 1, 1, "GII", "Grado en Ingeniería Informática", 1, 0);
insert into pda values (1, "PDA Ejemplo", "test.txt", 1, 1, 1, 1, 0);
