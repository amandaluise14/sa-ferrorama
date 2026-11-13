
const nomesTrens = window.dadosGraficos.nomesTrens;
const velocidadesTrens = window.dadosGraficos.velocidadesTrens;

const nomesModelos = window.dadosGraficos.nomesModelos;
const quantidadeModelos = window.dadosGraficos.quantidadeModelos;


// GRÁFICO DE VELOCIDADE DOS TRENS

const ctxVelocidade = document.getElementById('graficoVelocidade');

new Chart(ctxVelocidade, {

    type: 'bar',

    data: {

        labels: nomesTrens,

        datasets: [{

            label: 'Velocidade (km/h)',

            data: velocidadesTrens,

            backgroundColor: '#7b0000',

            borderRadius: 6

        }]

    },

    options: {

        responsive: true,

        maintainAspectRatio: false,

        plugins: {

            legend: {
                display: false
            }

        },

        scales: {

            y: {

                beginAtZero: true,

                title: {
                    display: true,
                    text: 'Velocidade (km/h)'
                }

            }

        }

    }

});


// GRÁFICO DE QUANTIDADE POR MODELO

const ctxModelo = document.getElementById('graficoModelo');

new Chart(ctxModelo, {

    type: 'pie',

    data: {

        labels: nomesModelos,

        datasets: [{

            label: 'Quantidade de trens',

            data: quantidadeModelos,

            backgroundColor: [
                '#7b0000',
                '#a52a2a',
                '#c75b5b',
                '#d99a9a',
                '#5c0000',
                '#e6bcbc',
                '#8b4513'
            ],

            borderWidth: 2,

            borderColor: '#ffffff'

        }]

    },

    options: {

        responsive: true,

        maintainAspectRatio: false,

        plugins: {

            legend: {
                position: 'bottom'
            }

        }

    }

});
