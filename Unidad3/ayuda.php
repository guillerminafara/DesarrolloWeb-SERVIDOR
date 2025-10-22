<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generador de Horario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background: #f4f4f4;
        }
        h2 {
            color: #333;
        }
        form {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
            width: 300px;
        }
        label {
            display: block;
            margin: 8px 0;
        }
        button {
            margin-top: 15px;
            padding: 10px 15px;
            border: none;
            background: #0078d7;
            color: white;
            border-radius: 6px;
            cursor: pointer;
        }
        button:hover {
            background: #005fa3;
        }
        table {
            margin-top: 25px;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 0 8px rgba(0,0,0,0.2);
        }
        td, th {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Generador de horario</h2>

    <form id="formHorario">
        <label><b>Selecciona el curso:</b></label>
        <label><input type="radio" name="curso" value="Curso 1" required> Curso 1</label>
        <label><input type="radio" name="curso" value="Curso 2" required> Curso 2</label>

        <label><b>Módulo:</b></label>
        <select id="modulo" required>
            <option value="">--Selecciona--</option>
            <option value="Programación">Programación</option>
            <option value="Base de Datos">Base de Datos</option>
            <option value="Sistemas">Sistemas</option>
            <option value="Lenguajes">Lenguajes</option>
        </select>

        <label><b>Horas disponibles:</b></label>
        <label><input type="checkbox" name="horas" value="8:00 - 9:00"> 8:00 - 9:00</label>
        <label><input type="checkbox" name="horas" value="9:00 - 10:00"> 9:00 - 10:00</label>
        <label><input type="checkbox" name="horas" value="10:00 - 11:00"> 10:00 - 11:00</label>
        <label><input type="checkbox" name="horas" value="11:00 - 12:00"> 11:00 - 12:00</label>

        <button type="submit">Generar horario</button>
    </form>

    <div id="resultado"></div>

    <script>
        const form = document.getElementById("formHorario");
        const resultado = document.getElementById("resultado");

        form.addEventListener("submit", (e) => {
            e.preventDefault();

            const curso = document.querySelector('input[name="curso"]:checked')?.value;
            const modulo = document.getElementById("modulo").value;
            const horasSeleccionadas = Array.from(document.querySelectorAll('input[name="horas"]:checked'))
                                            .map(h => h.value);

            if (!curso || !modulo || horasSeleccionadas.length === 0) {
                alert("Por favor selecciona curso, módulo y al menos una hora.");
                return;
            }

            // Crear tabla
            let tabla = `<h3>Horario de ${curso}</h3>`;
            tabla += `<table><tr><th>Hora</th><th>Módulo</th></tr>`;

            horasSeleccionadas.forEach(hora => {
                tabla += `<tr><td>${hora}</td><td>${modulo}</td></tr>`;
            });

            tabla += `</table>`;

            resultado.innerHTML = tabla;
        });
    </script>
</body>
</html>
