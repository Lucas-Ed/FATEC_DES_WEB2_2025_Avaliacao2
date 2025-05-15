<h1>💼 Sistema de Administração de produtos para Loja </h1>

## 📋 Descrição

Sistema em PHP Orientado a Objetos, para que um lojista possa cadastrar, visualizar e remover produtos de sua lojinha. desenvolvido em PHP, HTML e CSS e Bootstrap, e Sweet Alert. 

Sistema desenvolvido como parte [Avaliativa2](https://github.com/orlandosaraivajr/FATEC_2025_1SEM_DW2/blob/main/avaliacao2) da disciplina Desenvolvimento web II  do curso: <a href="https://fatecararas.cps.sp.gov.br/tecnologia-em-desenvolvimento-de-softwares-multiplataforma/">DSM- Desenvolvimento de software multiplataforma.</a>
<br>
<br>
Professor, <a href="https://github.com/orlandosaraivajr">Orlando Saraiva.</a>
<br>
Feedback do professor, veja <a href="https://github.com/Lucas-Ed/FATEC_DES_WEB2_2025_Avaliacao2/issues/1">aqui.</a>

<h3 align="center">✅ Concluído ✅</h3>

 Esse projeto foi desenvolvido com as seguintes tecnologias:

<p align="center">
  <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white"/>
  <img src="https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white"/>
  <img src="https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white"/>
  <img src="https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white"/>
  <a href="https://badge.fury.io/js/sweetalert"><img src="https://badge.fury.io/js/sweetalert.svg" alt="npm version" height="18"></a>
</p>

### Para rodar o sistema localmente, siga os passos abaixo:
1. Clone o repositório
2. Coloque a pasta `FATEC_DES_WEB2_2025_Avaliacao2`, na pasta `htdocs` do XAMPP ou WAMP.
3. ligue o servidor local, e PHP MY ADMIN (XAMPP ou WAMP).
4. Importe o arquivo `loja.sql` no PHP My Admin, para criar o banco de dados e as tabelas necessárias.
   - **Banco de dados**: `loja.sql`
    - **Tabela**: `produtos_artesanais`
5. Acesse o sistema pelo navegador, no endereço: `http://localhost/FATEC_DES_WEB2_2025_Avaliacao2/code`.
6. Faça o login com as credenciais de Login: **admin**, password: **admin**.
7. Pronto! Agora você pode cadastrar, visualizar, editar e remover produtos da sua loja.

## 💻 Layout do Projeto
<p> Páginas principais apenas:</p>

![](/img/index.JPG)

![](/img/welcome.JPG)

![](/img/registro.JPG)

![](/img/listagem.JPG)

![](/img/edicao.JPG)

![](/img/remover.JPG)


## 📂 Funcionalidades & Estrutura do Projeto

```bash
📂/Sistema do Lojista
│── 📂/ code
│     └── 📂/ classes                 (Pasta com as classes do projeto)
│     |    ├── 📄 DB.php               (Página com a classe DB e CRUD)
│     |    └── 📄 login.php             (autenticação de login com a classe Usuario)
|     |
│     └──📂/ img                     (Pasta de imagem do background da página index.php)
│     |
│     |── 📄 home.php                 (Painel principal após login)
│     |── 📄 index.php                (Página inicial com login)
│     |── 📄 list_products.php        (Página de produtos listados)
│     └─  📄 login.php                (Script com a lógica de login)
│     
|── 📂/ img                     (Pasta de imagens do Readme.md)
|
│── 📄 loja.sql                 (Arquivo de backup do banco de dados)    
└── 📄 readme.md                (Arquivo de documentação do projeto)
```

## ⚠️ Observações

- O sistema foi desenvolvido para fins acadêmicos, não é recomendado para uso em produção.

## 📝 Licença

Este projeto está sob a licença MIT.

Feito com 💜 por [Lucas Eduardo.](https://linktr.ee/lucas.007)

---


