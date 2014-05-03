create database mobly
use mobly

create table produto(
	id_produto int primary key auto_increment,
	nome_produto varchar(30) not null,
	descricao_produto varchar(400) not null,
	imagem_produto varchar(40),
	preco_produto float
)

insert into produto (nome_produto, descricao_produto,imagem_produto,preco_produto) VALUES 
("Celular Moto X","Celular com processador snap dragon de alta performance adquira o seu. ","celular.jpg","130.27"),
("Nootbook Acer","Computador portatil com um ano de garantia compre agora mesmo seu ACER","nootbookacer.jpg","240.20"),
("Nootbook Asus","Computador portatil com um ano de garantia compre agora mesmo seu ASUS","nootbookasus.jpg","40.51"),
("Geladeira Brastemp","Geladeira Super economica compre a asua agora","geladeirabrastemp.jpg","630.03"),
("Fogão Brastemp","Faça sua comida em alta velocidade com o super fogao brastemp","fogaobrastemp.jpg","230.10"),
("Panela Tramontina","Panelas descartaveis tramontina para você que nao gosta de lavar a louça ","panelatramontina.jpg","30.99")

create table categoria(
	id_categoria int primary key auto_increment,
	nome_categoria varchar(30) not null
)

insert into categoria (nome_categoria) VALUES 
("Geladeiras"),
("Fogões"),
("Nootbooks"),
("Celulares"),
("Eletronicos"),
("Utenciolio de Cozinha"),
("Tudo para cozinha")


create table rel_produto_categoria(
	id_relpc int primary key auto_increment,
	id_produto int,
	id_categoria int,
	constraint fk_produto foreign key (id_produto) references produto(id_produto),
	constraint fk_categoria foreign key (id_categoria) references categoria(id_categoria)
)

insert into rel_produto_categoria (id_produto,id_categoria) values 
(1,4),
(1,5),
(2,3),
(2,5),
(3,3),
(3,5),
(4,1),
(4,7),
(5,2),
(5,7),
(6,6),
(6,7)


create table pedido(
	id_pedido int primary key auto_increment,
	data_pedido datetime,
	valor_pedido float
)

create table detalhes_pedido(
	id_detalhes_p int primary key auto_increment,
	id_pedido int,
	id_produto int,
	constraint fk_detalhes_pedido foreign key (id_pedido) references pedido(id_pedido),
	constraint fk_detalhes_produto foreign key (id_produto) references produto(id_produto)
)



