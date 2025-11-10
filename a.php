<?php
// Datos de entrada: comunidades (municipios) y su infraestructura de agua
$comunidades = [
    ["nombre" => "Paiporta", "poblacion" => 5000, "pozos" => 8, "acueducto" => true],
    ["nombre" => "Picanya",  "poblacion" => 3000, "pozos" => 3, "acueducto" => false],
    ["nombre" => "Sedavi",   "poblacion" => 7000, "pozos" => 12, "acueducto" => true]
];

// Función lambda para calcular el acceso a agua potable
$calcularAcceso = function ($comunidad) {
    // Acceso base: 90% si tiene acueducto, 40% si no.
    $accesoBase = $comunidad["acueducto"] ? 0.90 : 0.40; // (OK)

    // Bono por pozos: se calcula como (pozos por cada 1000 habitantes) * 10% (0.10)
    // Ej: 1 pozo/1000 hab -> 0.10 (10%). 
    $pozosPorMil = ($comunidad["pozos"] / max(1, $comunidad["poblacion"])) * 1000; // evitar división por 0

    // Error 2 corregido: limitar el bono máximo al 30% (0.30)
    $bonoPozos = $pozosPorMil * 0.10;
    $bonoPozos = min(0.30, $bonoPozos);

    // Error 3 corregido: asegurar que el resultado no sea negativo (aunque no debería con la lógica actual)
    $totalAcceso = $accesoBase + $bonoPozos;
    $totalAcceso = max(0, $totalAcceso);

    // Error 1 corregido: limitar el acceso a 1 (100%)
    $totalAcceso = min(1, $totalAcceso);

    return $totalAcceso;
};

// Calcular población total y con acceso
$poblacionTotal = 0;
$poblacionConAcceso = 0;

echo "<h3>Resultados por comunidad</h3>";
echo "<ul>";

foreach ($comunidades as $comunidad) {
    $poblacionTotal += $comunidad["poblacion"];

    $acceso = $calcularAcceso($comunidad);

    // Error 4 corregido: redondear porcentaje para legibilidad
    $porcentaje = round($acceso * 100, 2);

    // Error 5 corregido: mostrar resultado del cálculo por comunidad
    echo "<li><strong>{$comunidad['nombre']}</strong>: acceso estimado = {$porcentaje}%</li>";

    // Acumular población con acceso (en número de personas)
    $poblacionConAcceso += $comunidad["poblacion"] * $acceso;
}
echo "</ul>";

// Mostrar totales (con redondeo)
$porcentajeGlobal = $poblacionTotal > 0 ? round(($poblacionConAcceso / $poblacionTotal) * 100, 2) : 0;

echo "<hr>";
echo "<p><strong>Población total:</strong> {$poblacionTotal}</p>";
echo "<p><strong>Población con acceso (estimada):</strong> " . round($poblacionConAcceso) . " personas</p>";
echo "<p><strong>Porcentaje global de acceso:</strong> {$porcentajeGlobal}%</p>";

echo "<p>Cálculo completado.</p>";
?>
