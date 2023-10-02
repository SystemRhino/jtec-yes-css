create database jtec;
use jtec;

create table tb_noticia(
id INT PRIMARY key auto_increment NOT NULL,
nm_noticia varchar(100),
ds_noticia text not null,
img_1 VARCHAR(50) NOT NULL,
img_2 VARCHAR(50) NOT NULL,
nr_curtidas INT NOT NULL,
data_post DATE NOT NULL,
hora_post TIME NOT NULL,
id_categoria INT,
id_comentario int,
id_user int
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
id_user INT);

CREATE TABLE tb_categoria (
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
nm_categoria VARCHAR(45));

ALTER TABLE tb_users ADD CONSTRAINT tb_users_id_nivel_tb_nivel_id FOREIGN KEY (id_nivel) REFERENCES tb_nivel(id);
ALTER TABLE tb_noticia ADD CONSTRAINT tb_noticia_id_categoria_tb_categoria_id FOREIGN KEY (id_categoria) REFERENCES tb_categoria(id);
ALTER TABLE tb_seguidores ADD CONSTRAINT tb_seguidores_id_user_seguido_tb_users_id FOREIGN KEY (id_user_seguido) REFERENCES tb_users(id);
ALTER TABLE tb_seguidores ADD CONSTRAINT tb_seguidores_id_user_seguidor_tb_users_id FOREIGN KEY (id_user_seguidor) REFERENCES tb_users(id);
ALTER TABLE tb_comentario ADD CONSTRAINT tb_comentario_id_user_tb_users_id FOREIGN KEY (id_user) REFERENCES tb_users(id);
alter table tb_noticia add constraint tb_noticia_id_user_tb_users_id foreign key (id_user) references tb_users(id);
alter table tb_noticia add constraint tb_noticia_id_comentario_tb_comentario_id foreign key (id_comentario) references tb_comentario(id);

INSERT INTO tb_nivel (id, nm_nivel) 
VALUES (1, 'Adm');
INSERT INTO tb_users (id, ds_login, ds_senha, nm_user, ds_img, id_nivel) 
VALUES (2, 'Ane', '123', 'Anita', '16961865196519c097a1eda.jpeg', 1);
INSERT INTO tb_categoria (id, nm_categoria) 
VALUES (1, 'Felicidade');

