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
<<<<<<< HEAD
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
=======
>>>>>>> fd72bd524f7efb36f8b5409d84199ebd1b746b4d
