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

