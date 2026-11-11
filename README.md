# sa-ferrorama
# Sistema de Gerenciamento Ferroviário

## Proposta do Sistema

O projeto tem como proposta o desenvolvimento de um sistema de gerenciamento ferroviário, denominado SA Ferrorama, voltado para o controle, organização e monitoramento de uma malha ferroviária. O sistema será responsável por centralizar informações relacionadas aos trens, linhas, rotas, sensores e demais elementos envolvidos na operação ferroviária, facilitando o acompanhamento e a gestão dos dados.

A plataforma contará com diferentes níveis de acesso. Os administradores poderão realizar o cadastro, alteração, consulta e exclusão de informações, mantendo os dados do sistema sempre atualizados. Já os usuários terão acesso a uma interface de visualização, na qual poderão acompanhar as informações disponíveis sobre os trens, linhas, rotas e monitoramentos realizados pelo sistema.

Um dos principais objetivos da SA Ferrorama é utilizar a Internet das Coisas (IoT) para auxiliar no monitoramento dos trens. Para isso, sensores poderão coletar informações importantes durante o funcionamento da operação, como velocidade, localização, desempenho, presença ou passagem do trem e possíveis situações anormais ou falhas. Esses dados poderão ser enviados para o sistema em tempo real, permitindo que sejam acompanhados por meio de um painel de monitoramento.

A utilização dos sensores possibilita uma visão mais precisa das condições de funcionamento dos trens e da malha ferroviária. A partir dos dados coletados, o sistema poderá auxiliar na identificação de problemas, acompanhamento do desempenho dos veículos, prevenção de falhas e tomada de decisões pelos responsáveis pela operação.

Dessa forma, a SA Ferrorama busca integrar gerenciamento de dados, monitoramento e tecnologia IoT em uma única plataforma. O projeto tem como finalidade tornar o acompanhamento da operação ferroviária mais organizado, eficiente e seguro, proporcionando aos administradores informações que auxiliem no controle da malha e aos usuários uma visualização clara dos dados e monitoramentos disponíveis.

---

## Objetivos do Projeto

* Desenvolver um sistema organizado para gerenciamento ferroviário;
* Permitir o cadastro e controle de trens, rotas e sensores;
* Monitorar informações em tempo real relacionadas ao desempenho dos trens;
* Facilitar a visualização de dados pelos usuários;
* Gerar relatórios para análise de desempenho e funcionamento do sistema.

---

## Funcionalidades Previstas

* Cadastro de usuários realizado pelos administradores;
* Cadastro de trens;
* Cadastro de rotas;
* Cadastro e gerenciamento de sensores;
* Monitoramento das linhas ferroviárias;
* Visualização das informações do sistema;
* Visualização de cadastros de administrador e usuários;
* Geração de relatórios analíticos.

## Requisitos Funcionais

RF Descrição

RF01 O sistema deve permitir cadastrar usuário.

RF02 O sistema deve permitir excluir usuário.

RF03 O sistema deve permitir atualizar usuário.

RF04 O sistema deve permitir cadastrar sensor.

RF05 O sistema deve permitir excluir sensor.

RF06 O sistema deve permitir atualizar sensor.

RF07 O sistema deve permitir cadastrar trem.

RF08 O sistema deve permitir excluir trem.

RF09 O sistema deve permitir atualizar trem.

RF10 O sistema deve permitir cadastrar rota.

RF11 O sistema deve permitir excluir rota.

RF11 O sistema deve permitir atualizar rota.

RF13 O sistema deve exibir status operacional do trem monitorado.

RF14 O sistema deve permitir visualizar informações de localização em quilômetros.

RF15 O sistema deve permitir visualizar quantidade de passageiros por horário.

RF16 O sistema deve permitir visualizar quantidade de atrasos por dia da semana.

RF17 O sistema deve exibir último acesso dos usuários cadastrados.

RF18 O sistema deve permitir visualizar sensores cadastrados.

RF19 O sistema deve impedir a exclusão de sensores que possuam dados registrados.

RF20 O sistema deve permitir pesquisar usuários cadastrados.

RF21 O sistema deve apresentar gráficos de velocidade, atrasos e passageiros.

RF22 O sistema deve permitir visualizar mapas de localização das linhas ferroviárias.

RF23 O sistema deve permitir pesquisar linhas ferroviárias.

RF24 O sistema deve exibir alertas e notícias recentes do sistema ferroviário.

RF25 O sistema deve permitir gerar relatórios.

RF26 O sistema deve permitir filtrar relatórios por tipo e data.

RF27 O sistema deve permitir visualizar relatórios gerados.

RF28 O sistema deve permitir recuperação de senha através da opção “Esqueceu a senha”.

RF29 O sistema deve permitir definir tipo de conta (Administrador ou Usuário).

RF30 O sistema deve permitir definir o status da conta (Ativo/Inativo).

RF31 O sistema deve validar os campos obrigatórios no cadastro de usuários.

RF32 O sistema deve exibir mensagem de sucesso ao cadastrar um usuário.

RF33 O sistema deve permitir visualizar a lista de administradores e usuários.

RF34 O sistema deve permitir filtrar usuários por tipo de conta e status.

RF35 O sistema deve manter navegação lateral entre os módulos do sistema

RF36 O sistema deve permitir realizar logout do sistema.

RF37 O sistema deve solicitar confirmação antes de sair do sistema.

RF38 O sistema deve permitir visualizar detalhes completos de relatórios.

RF39 O sistema deve apresentar a quantidade de atrasos do dia.

RF40 O sistema deve apresentar percentual de pontualidade.

RF41 O sistema deve apresentar quantidade de falhas registradas.

RF42 O sistema deve permitir confirmação de exclusão antes de remover registros.

## Regras de Negócio

RN Descrição

RN1 O sistema deve exibir dados de monitoramento em tempo real.

RN2 Apenas usuários com credenciais válidas podem acessar o sistema.

RN3 O login é obrigatório para acesso às funcionalidades internas.

RN4 Cada sensor deve possuir nome, localização e tipo de dado.

RN5 Todo sensor deve estar vinculado a um trem.

RN6 Sensores com dados registrados não podem ser excluídos.

RN7 Ao tentar excluir, deve ser exibida uma mensagem de erro.

RN8 A exclusão de sensores exige confirmação prévia do usuário.

RN9 O status operacional é classificado como:Normal,Alerta,Falha

RN10 Os relatórios devem ser gerados com base em dados reais.

RN11 Os relatórios devem conter gráficos para análise.

RN12 É permitido filtrar relatórios por período.

RN13 É permitido filtrar relatórios por tipo de falha.

RN14 Ao realizar logout, a sessão do usuário é encerrada.

RN15 O acesso ao sistema é bloqueado sem autenticação.

RN16 O sistema deve exibir mensagem de erro para login inválido.

RN17 O sistema deve validar e-mail e senha no momento do login.

RN18 O sistema deve exibir mensagem de erro para login inválido.

RN19 O sistema deve permitir vincular sensores às rotas e trens.

# Utilização de Inteligência Artificial

# Ferramenta utilizada
Durante o desenvolvimento do projeto SA Ferrorama, utilizamos o ChatGPT, uma ferramenta de Inteligência Artificial desenvolvida pela OpenAI, como apoio em diferentes etapas do projeto.
A IA foi utilizada principalmente para tirar dúvidas, buscar ideias, entender códigos, encontrar soluções para erros e melhorar algumas partes do sistema. Ela não foi responsável por desenvolver o projeto inteiro, mas serviu como uma ferramenta de ajuda durante o processo de criação.

# Como utilizamos a IA
Ao longo do desenvolvimento, utilizamos o ChatGPT em praticamente todas as etapas, desde o planejamento até os ajustes finais do sistema.

# Planejamento e organização
Ajuda na organização das ideias e funcionalidades do sistema.
Sugestões sobre a estrutura das páginas.
Orientações sobre como organizar os elementos e informações do projeto.
Ajuda na definição de algumas soluções para o funcionamento do sistema.

# Criação e melhoria das interfaces
Sugestões para a criação e organização dos mockups.
Ajuda na escolha e combinação de cores.
Sugestões de CSS para melhorar o visual das páginas.
Ajustes de espaçamento, alinhamento, tamanhos, fontes e botões.
Ajuda na organização de tabelas, formulários, menus e outros elementos.
Análise de imagens das telas para identificar o que poderia ser melhorado.

# Programação
Explicações sobre códigos em PHP, HTML, CSS e SQL.
Ajuda na compreensão de comandos e estruturas da programação.
Sugestões para implementar novas funcionalidades.
Auxílio na adaptação de códigos que já existiam.
Explicações sobre como os arquivos do sistema se comunicam.
Ajuda na organização e utilização das variáveis e funções.

# Desenvolvimento dos CRUDs
Utilizamos a IA para auxiliar no desenvolvimento das funcionalidades de cadastro, consulta, edição e exclusão de informações.
Entre as principais ajudas, estão:
Criação e organização de formulários.
Consultas para buscar informações no banco de dados.
Exibição dos registros em tabelas.
Envio e recebimento de dados entre as páginas.
Correção de problemas durante os cadastros, edições e exclusões.
Relacionamento entre informações de usuários, trens, rotas e sensores.

# Banco de dados
Explicações sobre comandos SQL.
Ajuda na criação e alteração de tabelas.
Orientações sobre chaves primárias e estrangeiras.
Ajuda na conexão entre PHP e MySQL.
Consultas envolvendo mais de uma tabela.
Identificação de erros relacionados ao banco de dados.

# Login e controle de acesso
Explicações sobre sessões em PHP.
Ajuda na verificação de login e senha.
Orientações sobre controle de acesso de administradores e usuários comuns.
Sugestões para proteger páginas que possuem acesso restrito.
Ajuda na organização das funcionalidades de entrada e saída do sistema.

# Correção de erros
Essa foi uma das partes em que mais utilizamos a IA durante o projeto.
Quando apareciam erros, enviávamos prints, mensagens do navegador e trechos dos códigos para tentar entender o que estava acontecendo.
A ferramenta ajudava a identificar possíveis causas e apresentava sugestões de correção. Nem sempre a primeira solução funcionava, então precisávamos explicar novamente o problema, fazer alterações e testar outras possibilidades.

# Landing Page
Sugestões para organizar as seções da página.
Ajuda na elaboração dos textos de apresentação do Ferrorama.
Ideias para destacar as funcionalidades e os benefícios do sistema.
Sugestões de organização visual.
Ajuda para integrar a apresentação do projeto à página de login.

# Integração com APIs
Explicações sobre o funcionamento de APIs externas.
Ajuda na realização de consultas e no recebimento de informações.
Orientações sobre como apresentar os dados recebidos no sistema.
Auxílio nas integrações relacionadas à consulta meteorológica e ao CEP.

# Documentação
Ajuda na organização de informações do projeto.
Sugestões para melhorar textos e explicações.
Auxílio na elaboração de descrições das funcionalidades.
Organização de informações para o README.

# Como utilizamos as sugestões
As respostas do ChatGPT eram utilizadas como orientação para o desenvolvimento. A equipe precisava adaptar os códigos e as sugestões de acordo com a estrutura do Ferrorama, considerando os nomes das variáveis, tabelas, arquivos e funcionalidades já existentes.
Em vários momentos, algumas sugestões precisaram ser modificadas porque não funcionavam exatamente como esperávamos. Por isso, fazíamos testes, analisávamos os resultados e procurávamos outras soluções quando necessário.

# Contribuições da IA
A utilização da Inteligência Artificial ajudou bastante durante o desenvolvimento do projeto, principalmente porque permitiu tirar dúvidas e entender melhor assuntos que ainda estávamos aprendendo.
Também facilitou a busca por soluções, ajudou a melhorar a aparência das páginas e contribuiu para a identificação de problemas na programação.

# Limitações
Apesar de ajudar em várias etapas, percebemos que nem todas as respostas da IA estavam corretas ou funcionavam diretamente no nosso projeto.
Algumas sugestões utilizavam nomes de campos diferentes dos nossos, não consideravam a estrutura dos arquivos ou acabavam causando problemas em outras partes do sistema.
Por isso, foi necessário analisar, adaptar e testar as respostas antes de utilizá-las.

# Conclusão
O ChatGPT foi uma ferramenta de apoio muito utilizada durante o desenvolvimento do SA Ferrorama. Recorremos a ele em diferentes situações, desde dúvidas simples sobre programação até problemas mais específicos envolvendo o funcionamento do sistema.
Com essa experiência, conseguimos aprender mais sobre as tecnologias utilizadas, encontrar soluções para dificuldades e melhorar algumas partes do projeto.
A IA facilitou o processo de desenvolvimento, mas não substituiu o trabalho da equipe, que continuou responsável pelas alterações, adaptações, decisões e testes realizados no sistema.


