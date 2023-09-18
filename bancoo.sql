create database jtec;
use jtec;

create table tb_noticia(
id INT PRIMARY KEY NOT NULL,
nm_noticia varchar(100),
ds_noticia text not null,
img_1 VARCHAR(50) NOT NULL,
img_2 VARCHAR(50) NOT NULL,
nr_curtidas INT NOT NULL,
data_post DATE NOT NULL,
hora_post TIME NOT NULL,
id_categoria INT
);

create table tb_users(
id int primary key auto_increment not null,
ds_login VARCHAR(20) NOT NULL,
ds_senha VARCHAR(20) NOT NULL,
nm_user VARCHAR(80) NOT NULL,
ds_img VARCHAR(50) NOT NULL,
id_nivel INT
);

CREATE TABLE tb_nivel (
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
nm_nivel VARCHAR(10)
);

CREATE TABLE tb_seguidores (
id_user_seguido INT,
id_user_seguidor INT);

CREATE TABLE tb_comentario (
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
comentario VARCHAR(100) NOT NULL,
id_noticia INT);

CREATE TABLE tb_categoria (
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
nm_categoria VARCHAR(45));

ALTER TABLE `jtec`.`tb_noticia` 
CHANGE COLUMN `id` `id` INT(11) NOT NULL AUTO_INCREMENT ;

ALTER TABLE `jtec`.`tb_comentario_noticia` 
ADD COLUMN `data` DATE NULL AFTER `comentario`;


ALTER TABLE tb_users ADD CONSTRAINT tb_users_id_nivel_tb_nivel_id FOREIGN KEY (id_nivel) REFERENCES tb_nivel(id);
ALTER TABLE tb_noticia ADD CONSTRAINT tb_noticia_id_categoria_tb_categoria_id FOREIGN KEY (id_categoria) REFERENCES tb_categoria(id);
ALTER TABLE tb_seguidores ADD CONSTRAINT tb_seguidores_id_user_seguido_tb_users_id FOREIGN KEY (id_user_seguido) REFERENCES tb_users(id);
ALTER TABLE tb_seguidores ADD CONSTRAINT tb_seguidores_id_user_seguidor_tb_users_id FOREIGN KEY (id_user_seguidor) REFERENCES tb_users(id);
ALTER TABLE tb_comentario ADD CONSTRAINT tb_comentario_id_user_tb_users_id FOREIGN KEY (id_user) REFERENCES tb_users(id);