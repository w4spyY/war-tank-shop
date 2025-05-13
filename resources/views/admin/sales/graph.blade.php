@extends('layouts.app')

@section('content')
<div class="ms-10 me-10 mx-auto mt-10 mb-10 p-6 bg-[var(--primero)] rounded-xl shadow-lg border border-[var(--tercero)]">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-[var(--tercero)]">Gráfico de Ventas</h1>
    </div>

    <div class="bg-[var(--sexto)] rounded-lg shadow-md overflow-hidden border border-[var(--tercero)] p-6">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div class="flex justify-center">
                <canvas id="canvas" height="525" width="500"></canvas>
            </div>
            
            <div class="flex justify-center">
                <canvas id="canvas2" height="500" width="500"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {

    let dades = [];
    let colors = [];
    let nombres = [];

    const canvas = document.getElementById("canvas");
    const ctx = canvas.getContext("2d");
    canvas.height = 525;
    canvas.width = 500;

    const canvas2 = document.getElementById("canvas2");
    const ctx2 = canvas2.getContext("2d");
    canvas2.height = 500;
    canvas2.width = 500;

    function generarColores(cantidad) {
        const colores = [
            '#4CC9F0',
            '#4895EF',
            '#4361EE',
            '#3F37C9',
            '#7209B7',
            '#B5179E',
            '#F72585',
            '#560BAD',
            '#480CA8',
            '#3A0CA3'
        ];
        
        //usar diferentes colores
        let coloresFinal = [];
        for (let i = 0; i < cantidad; i++) {
            coloresFinal.push(colores[i % colores.length]);
        }
        return coloresFinal;
    }

    function fondo() {
        ctx.save();
        ctx.strokeStyle = '#A0AEC0';
        ctx.fillStyle = '#E2E8F0';

        let y = 500;
        let x = 0;
        for (let i = 0; i < veces; i++) {
            ctx.beginPath();
            ctx.lineTo(0, y);
            ctx.lineTo(500, y);
            ctx.fillText(x, 3, y - 3);
            ctx.stroke();

            y -= 25;
            x += 25;
        }
        ctx.restore();
    }

    function grafico() {
        fondo();
        titulo();

        ctx.save();
        ctx.strokeStyle = '#A0AEC0';

        ctx.beginPath();
        ctx.moveTo(0, 0);
        ctx.lineTo(500, 0);
        ctx.lineTo(500, 500);
        ctx.lineTo(0, 500);
        ctx.lineTo(0, 0);
        ctx.stroke();

        let contador = 0;
        let longitud = 25 * dades.length + 25;

        for (let i = 25; i < longitud; i += 25) {
            ctx.fillStyle = colors[contador];
            ctx.fillRect(i, 500, 25, -dades[contador]);
            contador += 1;
        }

        ctx.restore();
    }

    function titulo() {
        ctx.save();
        ctx.fillStyle = '#E2E8F0';
        ctx.font = 'bold 14px Arial';
        ctx.fillText("Ventas de Productos", canvas.width / 2 - 70, 520);
        ctx.restore();
    }

    function lista() {
        ctx2.save();

        let altura = 0;

        for (let i = 0; i < colors.length; i++) {

            ctx2.fillStyle = colors[i];
            ctx2.fillRect(10, altura, 10, 10);

            ctx2.fillStyle = '#E2E8F0';
            ctx2.font = '12px Arial';
            ctx2.fillText(`${nombres[i]} (${dades[i]} ventas)`, 25, altura + 9);

            altura += 15;
        }

        ctx2.restore();
    }

    function cargarDatosVentas() {
        fetch("/admin/api/sales-data")
            .then(response => response.json())
            .then(data => {
                data.tanks.forEach(tank => {
                    nombres.push(`Tanque: ${tank.name}`);
                    dades.push(tank.sells);
                });

                data.parts.forEach(part => {
                    nombres.push(`Pieza: ${part.name}`);
                    dades.push(part.sells);
                });

                colors = generarColores(dades.length);
                
                numMax = Math.max(...dades);
                veces = 1 + numMax / 25;

                grafico();
                lista();
            })
            .catch(error => {
                console.log("Error");
            });
    }

    cargarDatosVentas();
});
</script>
@endsection