# Oficina AutoMais

## Sobre o sistema

O **Oficina AutoMais** é um sistema de gerenciamento desenvolvido para auxiliar no controle e na organização de uma oficina mecânica.

O sistema permite cadastrar e consultar informações relacionadas a **clientes, veículos, usuários, mecânicos, serviços e ordens de serviço**, centralizando os dados em um banco de dados.

A proposta é facilitar o gerenciamento das atividades da oficina, permitindo que as informações sejam registradas e consultadas de forma organizada.

## Funcionalidades

O sistema possui funcionalidades relacionadas a:

* Cadastro de clientes;
* Cadastro de veículos;
* Cadastro de usuários;
* Cadastro de mecânicos;
* Cadastro de serviços;
* Criação e gerenciamento de ordens de serviço;
* Associação de mecânicos às ordens de serviço;
* Associação de serviços às ordens de serviço;
* Consulta das informações armazenadas no banco de dados;
* Listagem das ordens de serviço.

## Banco de dados

O sistema utiliza o **MySQL** para armazenar e organizar os dados da oficina.

As informações são divididas em diferentes tabelas, permitindo relacionar clientes, veículos, ordens de serviço, mecânicos e serviços.

Também é utilizada uma **VIEW** para reunir informações de diferentes tabelas e facilitar a consulta das ordens de serviço pelo sistema.

A estrutura segue o fluxo:

```text
Banco de Dados
      ↓
     VIEW
      ↓
     PHP
      ↓
     CRUD
      ↓
     Tela
```

## Tecnologias utilizadas

* **PHP** — desenvolvimento da aplicação;
* **MySQL** — armazenamento dos dados;
* **MySQL Workbench** — criação e gerenciamento do banco de dados;
* **HTML** — estrutura das páginas;
* **CSS** — estilização das páginas;
* **XAMPP** — ambiente de desenvolvimento local.

## Ordens de Serviço

A tela de ordens de serviço permite visualizar informações importantes de cada atendimento, como:

* Número da OS;
* Cliente;
* Veículo;
* Placa;
* Marca;
* Modelo;
* Data de entrada;
* Status;
* Informações relacionadas ao atendimento.

Para facilitar essa consulta, o sistema utiliza a `vw_ordens_servico`, que reúne os dados necessários de diferentes tabelas do banco.

## Objetivo

O principal objetivo do Oficina AutoMais é criar uma solução simples para **organizar os dados e os processos de uma oficina mecânica**, facilitando o cadastro, gerenciamento e consulta das informações.

O projeto também demonstra a integração entre **banco de dados MySQL, VIEWs e uma aplicação PHP**, aplicando esses conceitos em uma situação prática.

## Projeto acadêmico

Este projeto foi desenvolvido como atividade prática de desenvolvimento de sistemas e banco de dados, utilizando a Oficina AutoMais como cenário para aplicação dos conceitos de **CRUD, relacionamentos entre tabelas, VIEWs e integração com PHP**.