## O que é o PDO
 O PDO é uma extensão da linguagem php para acesso a banco de dados, ele é orientado a objetos ele possui diversos recursos importantes, além de suportar diversoso mecanismos de banco de dados 

 ## Para que ele é utilizado no PHP
O PDO fornece uma camada de abstração de acesso a dados, o que significa que, independente de qual banco de dados estiver sendo usado, as mesmas funções serão usadas para realizar consultas e buscar dados. Ele não fornece uma abstração de banco de dados, ele não reescreve o sql nem emula os recursos ausentes. 

## Como funciona uma conexão utilizando PDO
Você precisa instanciar um objeto do tipo pdo, utilizando para isso a classe pdo. Em seu construtor, essa classe recebe três parâmetros. O primeiro deles é o dsn que contem informações sobre como se conectar com o banco de dados.


## Diferenças entre PDO e MySQLi;

A  principal diferença que podemos ver é que o PDO funciona com vários tipos de bancos de dados, enquanto o MySQLi funciona apenas com o MySQL, o PDO suporta 12 tipos diferentes de bancos de dados. 
Quando você precisa migrar seu projeto para usar outro banco de dados, o PDO simplifica o processo. Basta alterar a string de conexão e, no máximo, algumas consultas, caso utilizem alguma sintaxe não suportada pelo novo banco de dados. Já com o MySQLi não é possível pois não aceita migrar para outro. 

Há alguns anos, Jonathan Robson e Radu Potop realizaram alguns testes de desempenho do PHP com o MySQL . Basicamente, eles mostram que, para consultas SELECT usando instruções preparadas, o MySQLi é um pouco mais rápido. Mesmo assim, isso pode não ser significativo dependendo dos seus objetivos.

PDO: Usa apenas o modelo de Orientação a Objetos.

MySQLi: Oferece duas formas de uso: Orientação a Objetos e o estilo Procedural (com funções tradicionais do PHP)

Ambos oferecem suporte a Prepared Statements, contribuindo para a segurança contra SQL Injection.


### Exemplo de Conexão com PDO e MYSQLi:
```bash
PDO: 

 try {

    $pdo = new 
    PDO('mysql:host=localhost;dbname=exemplo', 'usuario', 'senha');

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexão bem-sucedida!";
}
 catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
 

```

```bash
MySQLi:

{

$mysqli = new mysqli("localhost", "usuario", "senha", "exemplo");

if ($mysqli->connect_error) {
    die("Erro de conexão: " . $mysqli->connect_error);
}

echo "Conexão bem-sucedida!"; 

}
```
### Comparação entre PDO e MySQLi

| Característica | PDO | MySQLi |
|---|---|---|
| **Compatibilidade** | Múltiplos bancos de dados | Apenas MySQL |
| **Orientação a Objetos** | Totalmente orientado a objetos | Objetos e procedural |
| **Segurança (SQL Injection)** | Suporte a Prepared Statements | Suporte a Prepared Statements |
| **Facilidade de Portabilidade** | Alta | Baixa |
| **Performance** | Similar (para MySQL) | Otimizada para MySQL |
| **Suporte a Recursos Específicos** | Menor foco em MySQL | Suporte exclusivo ao MySQL |

fonte: https://blog.grancursosonline.com.br/php-pdo-vs-mysqli/


### Quando escolher cada um? 
Escolha PDO se:

* Você planeja ou tem a possibilidade de mudar o banco de dados no futuro.
* Deseja um código mais genérico e flexível para diferentes plataformas.
* Precisa trabalhar com diversos bancos de dados na mesma aplicação.


Escolha MySQLi se:
* Sua aplicação utiliza exclusivamente MySQL.
* Você busca o máximo de desempenho e quer aproveitar recursos específicos do MySQL.
* Prefere a opção de usar estilo procedural ou orientado a objetos.

# Vantagens e desvantagens de utilizar PDO;

## Vantagens do PDO;

Como vantagens, podemos citar principalmente o suporte a múltiplos bancos, pois ele funciona com MySQL, PostgreSQL, SQLite, Oracle e SQL Server, usando quase o mesmo código. Com o uso de Prepared Statements, facilita a utilização de consultas preparadas e aumenta a segurança, ajudando a evitar invasões por SQL Injection. Além disso, o try/catch (é uma estrutura usada para executar um código e, caso aconteça algum erro, capturá-lo e tratá-lo sem interromper o sistema) ele é muito utilizado para tratar erros de conexão ou de comandos SQL. Por fim, temos a portabilidade, que facilita a migração de um sistema para outro quando necessário.

## Desvantagens do PDO
Como desvantagens podemos citar principalmente a perda de recursos específicos, pois algumas funções exclusivas de determinados bancos de dados não são totalmente aproveitadas pelo PDO. A curva de aprendizado também pode ser uma dificuldade, já que é necessário entender a estrutura da API e alguns conceitos de programação orientada a objetos. Além disso, existe uma falsa ideia de troca fácil, pois mudar de banco de dados não significa apenas alterar a conexão, já que comandos SQL específicos podem precisar ser modificados. Por fim, pode existir uma pequena perda de desempenho em comparação com extensões nativas, mas essa diferença geralmente é muito pequena e pouco relevante na maioria dos sistemas. 

## Em quais situações o PDO pode ser uma boa escolha; 

O PDO pode ser uma boa escolha em projetos PHP que precisam de mais segurança e organização. Ele é útil quando o sistema trabalha com banco de dados e pode precisar mudar de banco no futuro. Também é uma boa opção quando queremos evitar problemas como SQL Injection e ter um melhor tratamento dos erros.

### Fontes:
https://dev.to/mega6382/mysql-vs-mysqli-vs-pdo-performance-benchmark-difference-and-security-comparison-565o
https://blog.grancursosonline.com.br/php-pdo-vs-mysqli/
https://www.devmedia.com.br/introducao-ao-php-data-objects-pdo/25318
https://pt.quora.com/Em-quais-cen%C3%A1rios-%C3%A9-melhor-usar-PDO-PHP-em-vez-das-fun%C3%A7%C3%B5es-espec%C3%ADficas-do-SGBD-que-ser%C3%A1-utilizado
