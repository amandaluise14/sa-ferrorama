# SA Ferrorama

## Sistema de Gerenciamento Ferroviário

## Proposta do Sistema

A **SA Ferrorama** é um sistema de gerenciamento ferroviário desenvolvido com o objetivo de facilitar o controle, a organização e o monitoramento de uma malha ferroviária. A plataforma centraliza informações relacionadas aos trens, linhas, rotas, sensores e usuários, permitindo um acompanhamento mais organizado das operações ferroviárias.

O sistema possui diferentes níveis de acesso, permitindo que administradores gerenciem os cadastros e que usuários visualizem as informações disponibilizadas pela plataforma.

Além disso, o projeto propõe a utilização da Internet das Coisas (IoT) para auxiliar no monitoramento ferroviário, por meio de sensores capazes de coletar informações relacionadas à velocidade, localização, desempenho e possíveis falhas nos trens.

Dessa forma, o SA Ferrorama busca integrar tecnologia, gerenciamento de informações e monitoramento em uma única plataforma, contribuindo para uma operação ferroviária mais organizada, eficiente e segura.

## Problema que o Sistema Busca Resolver

O gerenciamento de uma malha ferroviária envolve diversas informações, como cadastros de trens, rotas, sensores, usuários e dados de monitoramento. Quando essas informações não estão centralizadas, o acompanhamento das operações pode se tornar mais difícil, prejudicando a organização e a identificação de possíveis problemas.

A SA Ferrorama busca solucionar essa dificuldade por meio de uma plataforma que reúne essas informações em um único ambiente, facilitando o gerenciamento dos dados, a consulta dos registros e o acompanhamento das condições operacionais.

## Objetivos do Projeto

- Desenvolver um sistema organizado para gerenciamento ferroviário;
- Permitir o cadastro e o controle de trens, rotas e sensores;
- Facilitar o gerenciamento de usuários e seus respectivos níveis de acesso;
- Possibilitar o acompanhamento de informações relacionadas ao funcionamento dos trens;
- Facilitar a visualização dos dados pelos usuários;
- Disponibilizar relatórios para análise das informações do sistema;
- Propor a integração de tecnologias IoT para o monitoramento ferroviário.

## Principais Funcionalidades

O sistema possui módulos destinados ao gerenciamento das principais informações ferroviárias.

### Gerenciamento de Usuários

- Cadastro de usuários;
- Edição de informações cadastradas;
- Exclusão de usuários;
- Consulta e visualização de usuários;
- Definição de perfil de acesso;
- Controle de status da conta (Ativo/Inativo).

### Gerenciamento de Trens

- Cadastro de trens;
- Edição das informações dos trens;
- Exclusão de registros;
- Consulta dos trens cadastrados;
- Armazenamento de informações como modelo, velocidade, linha e carga.

### Gerenciamento de Rotas

- Cadastro de rotas ferroviárias;
- Edição das informações das rotas;
- Exclusão de rotas;
- Consulta das rotas cadastradas;
- Registro de estações de origem e destino;
- Associação de sensores às rotas.

### Gerenciamento de Sensores

- Cadastro de sensores;
- Edição das informações;
- Exclusão de sensores;
- Consulta dos sensores cadastrados;
- Armazenamento de localização e tipo de dado monitorado.

### Monitoramento

- Visualização das informações relacionadas ao funcionamento ferroviário;
- Acompanhamento dos dados disponibilizados pelo sistema;
- Apresentação de informações de monitoramento;
- Possibilidade de integração com sensores IoT.

### Relatórios

- Página destinada à apresentação de relatórios;
- Organização de informações para análise;
- Visualização de indicadores relacionados à operação ferroviária.

## 5. Tecnologias Utilizadas

O desenvolvimento do SA Ferrorama utiliza as seguintes tecnologias:

| Tecnologia | Utilização |
|---|---|
| HTML5 | Estruturação das páginas |
| CSS3 | Estilização e organização visual |
| JavaScript | Interações e funcionalidades da interface |
| PHP | Processamento e comunicação com o servidor |
| MySQL | Armazenamento e gerenciamento dos dados |
| Bootstrap | Componentes e organização da interface |
| XAMPP | Ambiente de desenvolvimento local |
| phpMyAdmin | Administração do banco de dados |
| Visual Studio Code | Editor de código utilizado no desenvolvimento |

## Requisitos para Executar o Sistema

Para executar o SA Ferrorama em ambiente local, são necessários:

- Computador com Windows, Linux ou macOS;
- Navegador atualizado, como Google Chrome;
- XAMPP instalado e configurado;
- PHP e MySQL disponibilizados pelo XAMPP;
- phpMyAdmin para administração do banco de dados;
- Visual Studio Code ou outro editor de código (opcional, para alterações no projeto).

## Instalação e Configuração

Para executar o projeto localmente, siga as etapas:

1. Instale o XAMPP no computador.
2. Inicie os serviços Apache e MySQL pelo painel de controle do XAMPP.
3. Localize a pasta de instalação do XAMPP.
4. Acesse a pasta `htdocs`.
5. Copie a pasta do projeto SA Ferrorama para dentro de `htdocs`.
6. Abra o projeto no Visual Studio Code.
7. Verifique as configurações de conexão com o banco de dados no arquivo `infra/conexao.php`.
8. Configure o banco de dados conforme as orientações da próxima seção.

## Configuração e Importação do Banco de Dados

O sistema utiliza o MySQL para armazenar as informações de usuários, trens, sensores e rotas.

Para configurar o banco de dados:

1. Inicie o Apache e o MySQL no XAMPP.
2. Abra o navegador e acesse `http://localhost/phpmyadmin`.
3. Crie um banco de dados com o nome `sa_ferrorama1`.
4. Acesse a opção **Importar** no phpMyAdmin.
5. Selecione o arquivo SQL do projeto.
6. Execute a importação e aguarde a criação das tabelas.

Após a importação, verifique se as tabelas foram criadas corretamente.

O arquivo `infra/conexao.php` deve estar configurado com as informações correspondentes ao banco de dados local.

**Observação:** O nome do arquivo SQL e seu caminho devem ser atualizados nesta documentação conforme a localização real do arquivo no projeto.

## Como Iniciar a Aplicação

Depois de configurar o ambiente e o banco de dados:

1. Abra o painel do XAMPP.
2. Inicie os serviços Apache e MySQL.
3. Abra o navegador.
4. Digite o endereço local do projeto:

`http://localhost/NOME_DA_PASTA/public/login.php`

5. Realize o login utilizando uma conta cadastrada no banco de dados.
6. Após a autenticação, o usuário será direcionado às páginas disponíveis conforme seu perfil de acesso.

Substitua `NOME_DA_PASTA` pelo nome da pasta utilizada dentro de `htdocs`.

## Perfis de Acesso e Permissões

O SA Ferrorama possui dois perfis de acesso:

### Administrador

O administrador possui permissões de gerenciamento do sistema, podendo:

- Cadastrar, consultar, editar e excluir usuários;
- Gerenciar trens;
- Gerenciar rotas;
- Gerenciar sensores;
- Acessar os módulos administrativos;
- Consultar as informações disponibilizadas pelo sistema.

### Usuário

O usuário possui acesso às funcionalidades de visualização disponibilizadas pela plataforma, podendo:

- Acessar a página inicial;
- Consultar informações dos trens;
- Visualizar informações das rotas;
- Acompanhar os dados de monitoramento disponíveis;
- Consultar as informações e os relatórios liberados para seu perfil.

## Integrantes e Contribuições

O projeto SA Ferrorama foi desenvolvido em equipe, com a participação dos seguintes integrantes:

| Integrante | Contribuição |
|---|---|
| [Nome do integrante 1] | [Descrever contribuição] |
| [Nome do integrante 2] | [Descrever contribuição] |
| [Nome do integrante 3] | [Descrever contribuição] |
| [Nome do integrante 4] | [Descrever contribuição] |
| [Nome do integrante 5] | [Descrever contribuição] |

## Segurança e Credenciais

O acesso às funcionalidades internas é protegido por autenticação e controle de permissões.

As credenciais utilizadas durante o desenvolvimento devem ser mantidas em ambiente local ou em arquivos de configuração apropriados.

**Não devem ser publicadas senhas reais, dados pessoais ou credenciais de acesso no repositório.**

Caso sejam disponibilizadas contas de demonstração, deverão ser utilizadas exclusivamente para fins de apresentação do projeto.

---
## Requisitos Funcionais

RF01 O sistema deve permitir cadastrar usuários.

RF02 O sistema deve permitir excluir usuários.

RF03 O sistema deve permitir atualizar os dados dos usuários.

RF04 O sistema deve permitir cadastrar sensores.

RF05 O sistema deve permitir excluir sensores.

RF06 O sistema deve permitir atualizar os dados dos sensores.

RF07 O sistema deve permitir cadastrar trens.

RF08 O sistema deve permitir excluir trens.

RF09 O sistema deve permitir atualizar os dados dos trens.

RF10 O sistema deve permitir cadastrar rotas ferroviárias.

RF11 O sistema deve permitir excluir rotas.

RF12 O sistema deve permitir atualizar os dados das rotas.

RF13 O sistema deve exibir o status operacional do trem monitorado.

RF14 O sistema deve permitir visualizar os sensores cadastrados.

RF15 O sistema deve impedir a exclusão de sensores que possuam dados registrados.

RF16 O sistema deve permitir consultar os usuários cadastrados.

RF17 O sistema deve permitir visualizar mapas de localização das linhas ferroviárias.

RF18 O sistema deve permitir realizar pesquisas sobre linhas ferroviárias.

RF19 O sistema deve exibir alertas e notícias recentes do sistema ferroviário.

RF20 O sistema deve permitir definir o tipo de conta (Administrador ou Usuário).

RF21 O sistema deve permitir definir o status da conta (Ativo/Inativo).

RF22 O sistema deve validar os campos obrigatórios no cadastro de usuários.

RF23 O sistema deve exibir uma mensagem de sucesso ao cadastrar um usuário.

RF24 O sistema deve permitir visualizar a lista de administradores e usuários.

RF25 O sistema deve permitir filtrar usuários por tipo de conta e status.

RF26 O sistema deve manter a navegação lateral entre os módulos do sistema.

RF27 O sistema deve permitir realizar logout.

RF28 O sistema deve solicitar confirmação antes de encerrar a sessão.

RF29 O sistema deve solicitar confirmação antes de excluir registros.

## Regras de Negócio

RN01 Apenas usuários com credenciais válidas podem acessar o sistema.

RN02 O login é obrigatório para acessar as funcionalidades internas.

RN03 Cada sensor deve possuir nome, localização e tipo de dado monitorado.

RN04 Ao tentar excluir um sensor que possua dados registrados, o sistema deve exibir uma mensagem de erro.

RN05 A exclusão de sensores deve exigir confirmação prévia do usuário.

RN06 Os relatórios devem apresentar gráficos para facilitar a análise das informações.

RN07 Ao realizar logout, a sessão do usuário deve ser encerrada.

RN08 O acesso às páginas internas deve ser bloqueado para usuários não autenticados.

RN09 O sistema deve exibir uma mensagem de erro quando o login for realizado com credenciais inválidas.

RN10 O sistema deve validar o e-mail e a senha informados no momento do login.

RN11 O sistema deve impedir o acesso de contas inativas.