# XAMPP

## Como realizar a instalação e configuração básica
### Baixar o XAMPP
Você entra no site oficial do XAMPP e baixa a versão do seu sistema operacional.(Windows, Linux ou macOS).

![alt text]('../assets/image/print_XAMPP')

### Instalar
Depois de baixar:
* Abre o instalador;
* Clica em Next algumas vezes;
* Deixa os componentes principais marcados: Apache, MySQL, phpMyAdmin, PHP. 
* Pasta de destino: Recomenda-se manter o caminho padrão (geralmente C:\xampp). Clique em Next.
* Escolha o idioma (Inglês ou Alemão) e avance até iniciar a instalação.
* Quando o Windows Firewall solicitar permissão de rede, clique em Permitir acesso para que os servidores funcionem corretamente.
* Finaliza a instalação.

### Abrir o painel de controle
Após instalar, abrimos o, abra o XAMPP Control Panel (Painel de Controle do XAMPP) através do menu Iniciar do seu computador. É nele que controlamos os serviços.

### Iniciar os serviços
Para iniciar o servidor web e o banco de dados, clique no botão Start ao lado de Apache e Start ao lado de MySQL.

No painel, clicamos em:
* Start no Apache
* Start no MySQL

Quando os módulos estiverem ativos, seus nomes ficarão destacados com a cor verde no painel, então, se tudo estiver certo, eles ficam verdes.

Isso significa:
* Apache = servidor funcionando
* MySQL = banco de dados funcionando

### Testar no navegador
* Abra o seu navegador de internet (como o Chrome ou Firefox).
* Digite http://localhost na barra de endereços e pressione Enter.
* Se a página de boas-vindas do painel do XAMPP carregar, a instalação e configuração básica foram um sucesso.

### Colocar os projetos
* Para que seus sites e projetos rodem no servidor local, você deve salvar todos os arquivos e pastas de código dentro da pasta htdocs, localizada no diretório onde o XAMPP foi instalado (ex: C:\xampp\htdocs).
* Para visualizar seus projetos no navegador, basta acessar http://localhost/sua-pasta-do-projeto.
Então: 
* Os arquivos do site/sistema ficam dentro da pasta: htdocs
* Exemplo: C:\xampp\htdocs\meusite

## Importância do ambiente para desenvolvimento local.
O ambiente de desenvolvimento local é importante porque permite criar, testar e corrigir sistemas diretamente no computador do desenvolvedor antes de publicar o projeto na internet.
Com ferramentas como o XAMPP, conseguimos simular um servidor real localmente, facilitando o desenvolvimento de sites e sistemas.

### Testes sem precisar publicar
O desenvolvedor consegue testar:
* telas,
* login,
* banco de dados,
* cadastros,
* funcionalidades do sistema.

sem precisar colocar o projeto online.

### Maior segurança

Os erros podem ser corrigidos localmente antes do sistema ser disponibilizado para usuários reais.

### Facilidade para usar banco de dados
O ambiente local permite utilizar ferramentas como: MySQL, phpMyAdmin, Apache, PHP de maneira integrada.

### Desenvolvimento mais rápido
Não depende de internet nem hospedagem para cada alteração feita no código.

O programador altera o código, salva e já consegue visualizar no navegador.

### Ajuda no aprendizado
Para estudantes e iniciantes, o ambiente local facilita muito a prática e os testes sem risco de afetar sistemas reais.
















