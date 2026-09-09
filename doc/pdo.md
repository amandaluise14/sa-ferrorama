## O que é o PDO
 O PDO é uma extensão da linguagem php para acesso a banco de dados, ele é orientado a objetos ele possui diversos recursos importantes, além de suportar diversoso mecanismos de banco de dados 

 ## Para que ele é utilizado no PHP
O PDO fornece uma camada de abstração de acesso a dados, o que significa que, independente de qual banco de dados estiver sendo usado, as mesmas funções serão usadas para realizar consultas e buscar dados. Ele não fornece uma abstração de banco de dados, ele não reescreve o sql nem emula os recursos ausentes. 


## Diferenças entre PDO e MySQLi;

A  principal diferença que podemos ver é que o PDO funciona com vários tipos de bancos de dados, enquanto o MySQLi funciona apenas com o MySQL.O PDO suporta 12 tipos diferentes de bancos de dados, enquanto o MySQLi suporta apenas MySQL.
Quando você precisa migrar seu projeto para usar outro banco de dados, o PDO simplifica o processo. Basta alterar a string de conexão e, no máximo, algumas consultas, caso utilizem alguma sintaxe não suportada pelo novo banco de dados.

Há alguns anos, Jonathan Robson e Radu Potop realizaram alguns testes de desempenho do PHP com o MySQL . Basicamente, eles mostram que, para consultas SELECT usando instruções preparadas, o MySQLi é um pouco mais rápido. Mesmo assim, isso pode não ser significativo dependendo dos seus objetivos.

* PDO: Usa apenas o modelo de Orientação a Objetos.
* MySQLi: Oferece duas formas de uso: Orientação a Objetos e o estilo Procedural (com funções tradicionais do PHP)



Exemplo de Conexão com PDO e MYSQLi:
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
