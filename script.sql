create database contabilidade;
use contabilidade;
create table folhaDePagamento(
cd_folha int not null auto_increment,
nm_funcionario varchar(200),
qt_dependentes int,
vl_salario decimal(15,2),
vale_transporte decimal(15,2),
inss decimal(15,2),
irrf decimal(15,2),
vl_liquido decimal(15,2),
constraint pk_folhaDePagamento
		primary key (cd_folha));