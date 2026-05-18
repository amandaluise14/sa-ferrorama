CRUD vem do inglês e representa as quatro principais operações realizadas em um banco de dados: Create, Read, Update e Delete. Essas operações são fundamentais para que um sistema consiga:
 * Armazenar, 
 * Exibir, 
 * Editar,
 * Remover 

Informações do banco de dados.

### Create (Criar Dados):
 Responsável por adicionar novos registros na tabela do banco de dados. Para isso, normalmente utilizamos o comando SQL INSERT INTO, que insere as informações enviadas pelo usuário.

### Read (Ler Dados):
 Serve para consultar e visualizar os dados armazenados no banco. Utilizamos o comando SELECT, que permite selecionar tabelas, colunas ou registros específicos para serem exibidos no sistema.

### Update (Atualizar Dados):
 Tem a função de modificar informações já existentes na tabela. Geralmente buscamos o registro pelo seu ID, exibimos os dados atuais e depois atualizamos os valores usando o comando UPDATE.

### Delete (Deletar Dados):
 Responsável por remover registros do banco de dados. Para evitar apagar informações erradas, normalmente identificamos o registro pelo ID antes de utilizar o comando DELETE.

O CRUD é essencial em praticamente qualquer sistema que utilize banco de dados, pois é através dessas quatro operações que conseguimos realizar toda a interação com as informações armazenadas. Sem ele, não seria possível cadastrar, visualizar, editar ou excluir dados dentro de um sistema.

No contexto do nosso site, o CRUD será utilizado no sistema de gerenciamento, onde os administradores serão responsáveis por cadastrar usuários, sensores, trens e rotas no banco de dados. Além do cadastro, o sistema também permitirá visualizar, atualizar e excluir essas informações quando necessário, garantindo um controle organizado e eficiente de todos os dados da plataforma.
