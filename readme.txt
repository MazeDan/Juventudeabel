📖 Juventude Abel – Gincana Bíblica

Este repositório contém o código-fonte do site e do sistema de inscrições da Gincana Bíblica da Juventude Abel, evento realizado em setembro para jovens da comunidade.

✨ Funcionalidades
🔹 Parte pública

Informações da gincana (atividades, datas, horários).

Sessão de doação com links diretos para apoio.

Galeria de fotos dinâmica (lida imagens de uma pasta automaticamente).

🔹 Área administrativa

Login seguro com senha criptografada.

Validação de acesso com sessões.

Gerenciamento de inscrições:

Lista resumida (nome, idade, email, comunidade).

Lista completa (telefone, alergias, medicamentos, data da inscrição).

Layout responsivo (tabelas viram cards no celular).

Confirmação por email enviada automaticamente ao inscrito.

🛠️ Tecnologias utilizadas

Frontend: HTML5, CSS3, Bootstrap 5, JavaScript (ES6).

Backend: PHP 7+ com MySQL.

Email: mail() com template HTML para confirmação de inscrição.

🚀 Como rodar o projeto

Clone o repositório:

git clone https://github.com/seu-usuario/juventude-abel-gincana.git


Configure o banco de dados MySQL com as tabelas:

CREATE TABLE admins (
  id INT AUTO_INCREMENT PRIMARY KEY,
  usuario VARCHAR(100) NOT NULL,
  senha VARCHAR(255) NOT NULL
);

CREATE TABLE juventude (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(150),
  idade INT,
  email VARCHAR(150),
  senha VARCHAR(255),
  telefone VARCHAR(50),
  comunidade VARCHAR(150),
  paroquia VARCHAR(150),
  alergias TEXT,
  medicamentos TEXT,
  data_inscricao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


Atualize as credenciais do banco nos arquivos PHP ($host, $user, $pass, $dbname).

Inicie um servidor local (XAMPP, WAMP ou Laragon).

Acesse no navegador:

Site público: http://localhost/index.php
Admin: http://localhost/login.php

📂 Estrutura do projeto
.
├── index.php                 # Página inicial (gincana, doações, galeria)
├── login.php                 # Tela de login admin
├── logout.php                # Logout admin
├── valida_login.php          # Validação de login
├── visualizar_inscricoes.php # Painel de inscrições
├── processar_inscricao.php   # Processa inscrição do formulário
├── menu.php                  # Cabeçalho e navegação
├── css/                      # Estilos
├── js/                       # Scripts
├── img/                      # Imagens do site
│   ├── galeria/              # Fotos para galeria dinâmica
│   └── atividades/           # Ícones das atividades
└── README.md

💖 Apoie a Juventude Abel

A Juventude Abel utiliza 100% das doações para promover a fé entre os jovens.
No site há botões de doação (R$ 5, R$ 10, R$ 20 e R$ 50) via Mercado Pago.