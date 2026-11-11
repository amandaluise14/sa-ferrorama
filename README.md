# SA Ferrorama

## Sistema de Gerenciamento Ferroviário

## Proposta do Sistema

O **SA Ferrorama** é um sistema de gerenciamento ferroviário desenvolvido com o objetivo de facilitar o controle, a organização e o monitoramento de uma malha ferroviária. A plataforma centraliza informações relacionadas aos trens, linhas, rotas, sensores e usuários, permitindo um acompanhamento mais organizado das operações ferroviárias.

O sistema possui diferentes níveis de acesso, permitindo que administradores gerenciem os cadastros e que usuários visualizem as informações disponibilizadas pela plataforma.

Além disso, o projeto propõe a utilização da Internet das Coisas (IoT) para auxiliar no monitoramento ferroviário, por meio de sensores capazes de coletar informações relacionadas à velocidade, localização, desempenho e possíveis falhas nos trens.

Dessa forma, o SA Ferrorama busca integrar tecnologia, gerenciamento de informações e monitoramento em uma única plataforma, contribuindo para uma operação ferroviária mais organizada, eficiente e segura.

## Problema que o Sistema Busca Resolver

O gerenciamento de uma malha ferroviária envolve diversas informações, como cadastros de trens, rotas, sensores, usuários e dados de monitoramento. Quando essas informações não estão centralizadas, o acompanhamento das operações pode se tornar mais difícil, prejudicando a organização e a identificação de possíveis problemas.

O SA Ferrorama busca solucionar essa dificuldade por meio de uma plataforma que reúne essas informações em um único ambiente, facilitando o gerenciamento dos dados, a consulta dos registros e o acompanhamento das condições operacionais.

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

# Requisitos Funcionais

Os requisitos funcionais descrevem as funcionalidades e operações que o sistema SA Ferrorama deve disponibilizar aos seus usuários.

**Descrição de RF**

**RF01** O sistema deve permitir cadastrar usuários.

**RF02** O sistema deve permitir excluir usuários.

**RF03** O sistema deve permitir atualizar os dados dos usuários.

**RF04** O sistema deve permitir cadastrar sensores.

**RF05** O sistema deve permitir excluir sensores.

**RF06** O sistema deve permitir atualizar os dados dos sensores.

**RF07** O sistema deve permitir cadastrar trens.

**RF08** O sistema deve permitir excluir trens.

**RF09** O sistema deve permitir atualizar os dados dos trens.

**RF10** O sistema deve permitir cadastrar rotas ferroviárias.

**RF11** O sistema deve permitir excluir rotas.

**RF12** O sistema deve permitir atualizar os dados das rotas.

**RF13** O sistema deve exibir o status operacional do trem monitorado.

**RF14** O sistema deve permitir visualizar informações de localização em quilômetros.

**RF15** O sistema deve permitir visualizar a quantidade de passageiros por viagem.

**RF16** O sistema deve permitir visualizar a quantidade de atrasos por dia da semana.

**RF17** O sistema deve exibir o último acesso dos usuários cadastrados.

**RF18** O sistema deve permitir visualizar os sensores cadastrados.

**RF19** O sistema deve impedir a exclusão de sensores que possuam dados registrados.

**RF20** O sistema deve permitir consultar os usuários cadastrados.

**RF21** O sistema deve apresentar gráficos de velocidade, atrasos e passageiros.

**RF22** O sistema deve permitir visualizar mapas de localização das linhas ferroviárias.

**RF23** O sistema deve permitir realizar pesquisas sobre linhas ferroviárias.

**RF24** O sistema deve exibir alertas e notícias recentes do sistema ferroviário.

**RF25** O sistema deve permitir gerar relatórios.

**RF26** O sistema deve permitir filtrar relatórios por tipo e dados.

**RF27** O sistema deve permitir visualizar relatórios gerados.

**RF28** O sistema deve permitir a recuperação de senha por meio da opção "Esqueceu a senha".

**RF29** O sistema deve permitir definir o tipo de conta (Administrador ou Usuário).

**RF30** O sistema deve permitir definir o status da conta (Ativo/Inativo).

**RF31** O sistema deve validar os campos obrigatórios no cadastro de usuários.

**RF32** O sistema deve exibir uma mensagem de sucesso ao cadastrar um usuário.

**RF33** O sistema deve permitir visualizar a lista de administradores e usuários.

**RF34** O sistema deve permitir filtrar usuários por tipo de conta e status.

**RF35** O sistema deve manter a navegação lateral entre os módulos do sistema.

**RF36** O sistema deve permitir realizar logout.

**RF37** O sistema deve solicitar confirmação antes de encerrar a sessão.

**RF38** O sistema deve permitir visualizar detalhes completos dos relatórios.

**RF39** O sistema deve apresentar a quantidade de atrasos do dia.

**RF40** O sistema deve apresentar o percentual de pontualidade.

**RF41** O sistema deve apresentar a quantidade de falhas registradas.

**RF42** O sistema deve solicitar confirmação antes de excluir registros.

---

# Regras de Negócio

As regras de negócio estabelecem as condições e restrições que devem ser respeitadas durante a utilização do sistema, garantindo a organização, a segurança e o funcionamento adequado das operações.

**Descrição de RN**

**RN01** O sistema deve exibir os dados de monitoramento em tempo real, quando houver integração e disponibilidade dos dados dos sensores.

**RN02** Apenas usuários com credenciais válidas podem acessar o sistema.

**RN03** O login é obrigatório para acessar as funcionalidades internas.

**RN04** Cada sensor deve possuir nome, localização e tipo de dado monitorado.

**RN05** Todo sensor deve estar relacionado a um trem.

**RN06** Sensores que possuam dados registrados não podem ser excluídos.

**RN07** Ao tentar excluir um sensor que possua dados registrados, o sistema deve exibir uma mensagem de erro.

**RN08** A exclusão de sensores deve exigir confirmação prévia do usuário.

**RN09** O status operacional dos trens deve ser classificado como: Normal, Alerta ou Falha.

**RN10** Os relatórios devem ser gerados com base nos dados registrados no sistema.

**RN11** Os relatórios devem apresentar gráficos para facilitar a análise das informações.

**RN12** Os relatórios devem permitir filtros por período.

**RN13** Os relatórios devem permitir filtros por tipo de falha.

**RN14** Ao realizar logout, a sessão do usuário deve ser encerrada.

**RN15** O acesso às páginas internas deve ser bloqueado para usuários não autenticados.

**RN16** O sistema deve exibir uma mensagem de erro quando o login for realizado com credenciais inválidas.

**RN17** O sistema deve validar o e-mail e a senha informados no momento do login.

**RN18** O sistema deve impedir o acesso de contas inativas.

**RN19** O sistema deve permitir vincular sensores às rotas e aos trens.

# Utilização de Inteligência Artificial

# Ferramenta utilizada
Durante o desenvolvimento do projeto SA Ferrorama, utilizamos o ChatGPT, uma ferramenta de Inteligência Artificial desenvolvida pela OpenAI, como apoio em diferentes etapas do projeto.
A IA foi utilizada principalmente para tirar dúvidas, buscar ideias, entender códigos, encontrar soluções para erros e melhorar algumas partes do sistema. Ela não foi responsável por desenvolver o projeto inteiro, mas serviu como uma ferramenta de ajuda durante o processo de criação.

# Como utilizamos a IA
Ao longo do desenvolvimento, utilizamos o ChatGPT em praticamente todas as etapas, desde o planejamento até os ajustes finais do sistema.

**Planejamento e organização**
Ajuda na organização das ideias e funcionalidades do sistema.
Sugestões sobre a estrutura das páginas.
Orientações sobre como organizar os elementos e informações do projeto.
Ajuda na definição de algumas soluções para o funcionamento do sistema.

**Criação e melhoria das interfaces**
Sugestões para a criação e organização dos mockups.
Ajuda na escolha e combinação de cores.
Sugestões de CSS para melhorar o visual das páginas.
Ajustes de espaçamento, alinhamento, tamanhos, fontes e botões.
Ajuda na organização de tabelas, formulários, menus e outros elementos.
Análise de imagens das telas para identificar o que poderia ser melhorado.

**Programação**
Explicações sobre códigos em PHP, HTML, CSS e SQL.
Ajuda na compreensão de comandos e estruturas da programação.
Sugestões para implementar novas funcionalidades.
Auxílio na adaptação de códigos que já existiam.
Explicações sobre como os arquivos do sistema se comunicam.
Ajuda na organização e utilização das variáveis e funções.

**Desenvolvimento dos CRUDs**
Utilizamos a IA para auxiliar no desenvolvimento das funcionalidades de cadastro, consulta, edição e exclusão de informações.
Entre as principais ajudas, estão:
Criação e organização de formulários.
Consultas para buscar informações no banco de dados.
Exibição dos registros em tabelas.
Envio e recebimento de dados entre as páginas.
Correção de problemas durante os cadastros, edições e exclusões.
Relacionamento entre informações de usuários, trens, rotas e sensores.

**Banco de dados**
Explicações sobre comandos SQL.
Ajuda na criação e alteração de tabelas.
Orientações sobre chaves primárias e estrangeiras.
Ajuda na conexão entre PHP e MySQL.
Consultas envolvendo mais de uma tabela.
Identificação de erros relacionados ao banco de dados.

**Login e controle de acesso**
Explicações sobre sessões em PHP.
Ajuda na verificação de login e senha.
Orientações sobre controle de acesso de administradores e usuários comuns.
Sugestões para proteger páginas que possuem acesso restrito.
Ajuda na organização das funcionalidades de entrada e saída do sistema.

**Correção de erros**
Essa foi uma das partes em que mais utilizamos a IA durante o projeto.
Quando apareciam erros, enviávamos prints, mensagens do navegador e trechos dos códigos para tentar entender o que estava acontecendo.
A ferramenta ajudava a identificar possíveis causas e apresentava sugestões de correção. Nem sempre a primeira solução funcionava, então precisávamos explicar novamente o problema, fazer alterações e testar outras possibilidades.

**Landing Page**
Sugestões para organizar as seções da página.
Ajuda na elaboração dos textos de apresentação do Ferrorama.
Ideias para destacar as funcionalidades e os benefícios do sistema.
Sugestões de organização visual.
Ajuda para integrar a apresentação do projeto à página de login.

**Integração com APIs**
Explicações sobre o funcionamento de APIs externas.
Ajuda na realização de consultas e no recebimento de informações.
Orientações sobre como apresentar os dados recebidos no sistema.
Auxílio nas integrações relacionadas à consulta meteorológica e ao CEP.

**Documentação**
Ajuda na organização de informações do projeto.
Sugestões para melhorar textos e explicações.
Auxílio na elaboração de descrições das funcionalidades.
Organização de informações para o README.

**Como utilizamos as sugestões**
As respostas do ChatGPT eram utilizadas como orientação para o desenvolvimento. A equipe precisava adaptar os códigos e as sugestões de acordo com a estrutura do Ferrorama, considerando os nomes das variáveis, tabelas, arquivos e funcionalidades já existentes.
Em vários momentos, algumas sugestões precisaram ser modificadas porque não funcionavam exatamente como esperávamos. Por isso, fazíamos testes, analisávamos os resultados e procurávamos outras soluções quando necessário.

**Contribuições da IA**
A utilização da Inteligência Artificial ajudou bastante durante o desenvolvimento do projeto, principalmente porque permitiu tirar dúvidas e entender melhor assuntos que ainda estávamos aprendendo.
Também facilitou a busca por soluções, ajudou a melhorar a aparência das páginas e contribuiu para a identificação de problemas na programação.

**Limitações**
Apesar de ajudar em várias etapas, percebemos que nem todas as respostas da IA estavam corretas ou funcionavam diretamente no nosso projeto.
Algumas sugestões utilizavam nomes de campos diferentes dos nossos, não consideravam a estrutura dos arquivos ou acabavam causando problemas em outras partes do sistema.
Por isso, foi necessário analisar, adaptar e testar as respostas antes de utilizá-las.

**Conclusão**
O ChatGPT foi uma ferramenta de apoio muito utilizada durante o desenvolvimento do SA Ferrorama. Recorremos a ele em diferentes situações, desde dúvidas simples sobre programação até problemas mais específicos envolvendo o funcionamento do sistema.
Com essa experiência, conseguimos aprender mais sobre as tecnologias utilizadas, encontrar soluções para dificuldades e melhorar algumas partes do projeto.
A IA facilitou o processo de desenvolvimento, mas não substituiu o trabalho da equipe, que continuou responsável pelas alterações, adaptações, decisões e testes realizados no sistema.



