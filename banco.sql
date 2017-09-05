create database mercado;

create table produtos(
	ID int(6) unsigned primary key auto_increment,
	Nome varchar(50) not null,
	Tipo int(6) not null,
	Valor decimal(15,2) not null,
	Estoque int(6) unsigned not null 
)

create table tipos(
	ID int(6) unsigned primary key auto_increment,
	Nome varchar(50) not null
)

alter table produtos add foreign key (Tipo) references tipos(ID);