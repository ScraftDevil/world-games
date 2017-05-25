create database academia;
go

use academia;

drop table if exists cursos;
create table cursos(
id int identity(1,1) PRIMARY KEY,
nombre varchar(50),
descripcion varchar(200),
horas int);

drop table if exists alumnos;
create table alumnos(
id int identity(1,1) PRIMARY KEY,
nombre varchar(100),
dni varchar(20) unique,
email varchar(100),
telefono varchar(50),
fecha_nacimiento date
);

drop table if exists ordenadores;
create table ordenadores(
id int identity(1,1) PRIMARY KEY,
modelo varchar(50),
marca varchar(20),
tipo varchar(20));

drop table if exists profesores;
create table profesores(
id int identity(1,1) PRIMARY KEY,
nombre varchar(100),
dni varchar(20) unique);

drop table if exists tutores;
create table tutores(
id int identity(1,1) PRIMARY KEY,
nombre varchar(100),
dni varchar(20) unique);

drop table if exists aulas;
create table aulas(
id int identity(1,1) PRIMARY KEY,
nombre varchar(100),
capacidad int);

drop table if exists ediciones;
create table ediciones(
id int identity(1,1) PRIMARY KEY,
nombre varchar(100),
turno varchar(50),
fecha_inicio date,
fecha_fin date,
curso_id int FOREIGN KEY references cursos (id),
profesor_id int FOREIGN KEY references profesores (id),
tutor_id int FOREIGN KEY references tutores (id),
aula_id int FOREIGN KEY references aulas (id));

drop table if exists matriculas;
create table matriculas(
id int identity(1,1) PRIMARY KEY,
nota_final float,
alumno_id int FOREIGN KEY references alumnos (id),
edicion_id int FOREIGN KEY references ediciones (id),
ordenador_id int FOREIGN KEY references ordenadores (id));

drop table if exists examenes;
create table examenes(
id int identity(1,1) PRIMARY KEY,
fecha date,
nota int,
comentario text,
matricula_id int FOREIGN KEY references matriculas (id));

drop table if exists dias_lectivos;
create table dias_lectivos(
id int identity(1,1) PRIMARY KEY,
fecha date,
edicion_id int FOREIGN KEY references ediciones (id));

drop table if exists asistencias;
create table asistencias(
id int identity(1,1) PRIMARY KEY,
asistido bit,
tarde bit,
justificado bit,
dia_lectivo_id int FOREIGN KEY references dias_lectivos (id),
matricula_id int FOREIGN KEY references matriculas (id));

insert into profesores (nombre,dni) values ('ricard','432874556F');
insert into profesores (nombre,dni) values ('alex','41876453D');
insert into profesores (nombre,dni) values ('pau','46758742C');

insert into tutores (nombre,dni) values ('eric','43239876C');
insert into tutores (nombre,dni) values ('marti','45678923F');

insert into cursos (nombre, horas) values ('Java básico',100);
insert into cursos (nombre, horas) values ('Java avanzado',250);
insert into cursos (nombre, horas) values ('C# .NET básico',100);
insert into cursos (nombre, horas) values ('C# .NET avanzado',250);

insert into alumnos (nombre,dni,email,telefono,fecha_nacimiento) values ('david','12345678F','david@gmail.com','938403322','1994-05-30');
insert into alumnos (nombre,dni,email,telefono,fecha_nacimiento) values ('alex','33256954Z','alex@gmail.com','932459187','1990-03-30');
insert into alumnos (nombre,dni,email,telefono,fecha_nacimiento) values ('dani','87956432D','dani@gmail.com','937658922','1990-03-11');
insert into alumnos (nombre,dni,email,telefono,fecha_nacimiento) values ('borja','33667788C','borja@gmail.com','935647382','1991-03-23');
insert into alumnos (nombre,dni,email,telefono,fecha_nacimiento) values ('marc','12398754D','marc@gmail.com','9312387677','1997-03-15');
insert into alumnos (nombre,dni,email,telefono,fecha_nacimiento) values ('sam','14327689C','sam@gmail.com','938403322','1996-08-26');

insert into ordenadores (modelo,marca,tipo) values ('3322','acer','portatil');
insert into ordenadores (modelo,marca,tipo) values ('1245','apple','portatil');
insert into ordenadores (modelo,marca,tipo) values ('8876','hp','portatil');
insert into ordenadores (modelo,marca,tipo) values ('4453','acer','portatil');
insert into ordenadores (modelo,marca,tipo) values ('9865','lenovo','portatil');
insert into ordenadores (modelo,marca,tipo) values ('7634','hp','portatil');
go

insert into aulas (nombre,capacidad) values ('Aula 1', 15);
insert into aulas (nombre,capacidad) values ('Aula 2', 20);
insert into aulas (nombre,capacidad) values ('Aula 3', 20);
insert into aulas (nombre,capacidad) values ('Aula 4', 15);

insert into ediciones (nombre,turno,fecha_inicio,fecha_fin,curso_id,profesor_id,tutor_id,aula_id) values ('Mayo 2017','M','2017-05-01','2017-07-31',1,1,1,1);
insert into ediciones (nombre,turno,fecha_inicio,fecha_fin,curso_id,profesor_id,tutor_id,aula_id) values ('Abril 2017','T','2017-06-01','2017-08-31',2,2,1,1);
insert into ediciones (nombre,turno,fecha_inicio,fecha_fin,curso_id,profesor_id,tutor_id,aula_id) values ('Agosto 2017','M','2017-08-01','2017-10-31',3,3,2,2);

insert into matriculas (nota_final,alumno_id,edicion_id,ordenador_id) values (5.7,1,1,1);
insert into matriculas (nota_final,alumno_id,edicion_id,ordenador_id) values (7.6,2,2,2);
insert into matriculas (nota_final,alumno_id,edicion_id,ordenador_id) values (9.5,3,3,3);
insert into matriculas (nota_final,alumno_id,edicion_id,ordenador_id) values (5.5,4,3,4);
insert into matriculas (nota_final,alumno_id,edicion_id,ordenador_id) values (6.7,5,2,5);
insert into matriculas (nota_final,alumno_id,edicion_id,ordenador_id) values (8.1,6,1,6);

insert into examenes (nota,comentario,fecha,matricula_id) values (7.5,'muy bien','2017-03-25',3);
insert into examenes (nota,comentario,fecha,matricula_id) values (8.1,'mejor','2017-04-23',4);

insert into dias_lectivos (fecha,edicion_id) values('2015-03-23',1);
insert into dias_lectivos (fecha,edicion_id) values('2016-05-13',2);

insert into asistencias (asistido,tarde,justificado,dia_lectivo_id,matricula_id) values (1,0,0,1,1);
insert into asistencias (asistido,tarde,justificado,dia_lectivo_id,matricula_id) values (1,0,0,2,2);