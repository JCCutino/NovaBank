// Obtener el contexto del lienzo (canvas)
var ctx = document.getElementById('saldoChart').getContext('2d');

// Datos de muestra para la gráfica de saldo bancario
var data = {
    labels: ['1 Ene', '2 Ene', '3 Ene', '4 Ene', '5 Ene', '6 Ene', '7 Ene', '8 Ene', '9 Ene', '10 Ene', '11 Ene', '12 Ene', '13 Ene', '14 Ene', '15 Ene', '16 Ene', '17 Ene', '18 Ene', '19 Ene', '20 Ene', '21 Ene', '22 Ene', '23 Ene', '24 Ene', '25 Ene', '26 Ene', '27 Ene', '28 Ene', '29 Ene', '30 Ene', '31 Ene'],
    datasets: [{
        label: 'Saldo Bancario',
        borderColor: '#A669E3',
        borderWidth: 2,
        fill: false,
        data: [1000, 1200, 900, 1500, 2000, 1800, 1300, 1700, 2200, 2000, 2400, 2600, 3000, 2800, 2500, 2800, 3200, 3500, 3000, 3300, 3800, 3400, 3700, 4000, 4200, 3800, 4100, 4500, 4800, 5200, 5000],
    }]
};

// Configuración de la gráfica
var options = {
    scales: {
        y: {
            beginAtZero: false
        }
    }
};

// Crear la gráfica lineal
var saldoChart = new Chart(ctx, {
    type: 'line',
    data: data,
    options: options
});

// Función para filtrar por mes
function filtrarPorMes(mes) {
    // Filtrar datos por mes
    var dataFiltrada = obtenerDatosFiltradosPorMes(mes);

    // Actualizar datos y etiquetas de la gráfica
    saldoChart.data.labels = dataFiltrada.labels;
    saldoChart.data.datasets[0].data = dataFiltrada.data;

    // Actualizar la gráfica
    saldoChart.update();
}


// Función para obtener datos filtrados por mes
function obtenerDatosFiltradosPorMes(mes) {
    var ultimoDia;

    switch (mes) {
        case 'Enero':
        case 'Marzo':
        case 'Mayo':
        case 'Julio':
        case 'Agosto':
        case 'Octubre':
        case 'Diciembre':
            ultimoDia = 31;
            break;
        case 'Abril':
        case 'Junio':
        case 'Septiembre':
        case 'Noviembre':
            ultimoDia = 30;
            break;
        case 'Febrero':
            ultimoDia = 28;
            break;
        default:
            console.error('Mes no válido');
            return;
    }

    // Generar etiquetas para cada día del mes
    var labels = Array.from({ length: ultimoDia }, (_, i) => `${i + 1} ${mes}`);

    var data = Array.from({ length: ultimoDia }, () => Math.floor(Math.random() * 2000) + 1000);

    return { labels: labels, data: data };
}