
<?php

$url = "https://api.open-meteo.com/v1/forecast?latitude=-26.3044&longitude=-48.8487&current=temperature_2m,relative_humidity_2m,weather_code&timezone=America%2FSao_Paulo";

$resposta = file_get_contents($url);

$clima = json_decode($resposta, true);

$temperatura = $clima['current']['temperature_2m'];
$umidade = $clima['current']['relative_humidity_2m'];
$codigo = $clima['current']['weather_code'];
$horario = $clima['current']['time'];

$condicao = "Condição não identificada";

if ($codigo == 0) {
    $condicao = "Céu limpo";
} elseif ($codigo == 1 || $codigo == 2) {
    $condicao = "Parcialmente nublado";
} elseif ($codigo == 3) {
    $condicao = "Nublado";
} elseif ($codigo >= 45 && $codigo <= 48) {
    $condicao = "Neblina";
} elseif ($codigo >= 51 && $codigo <= 67) {
    $condicao = "Chuva";
} elseif ($codigo >= 71 && $codigo <= 77) {
    $condicao = "Neve";
} elseif ($codigo >= 80 && $codigo <= 82) {
    $condicao = "Pancadas de chuva";
} elseif ($codigo >= 95) {
    $condicao = "Tempestade";
}

?>
