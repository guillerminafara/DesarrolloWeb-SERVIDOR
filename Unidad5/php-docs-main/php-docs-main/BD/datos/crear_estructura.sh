#!/bin/bash

# Crear directorios
mkdir -p examen/app/controllers
mkdir -p examen/app/database
mkdir -p examen/app/models
mkdir -p examen/app/views
mkdir -p examen/public/uploads

# Crear archivos
touch examen/app/controllers/aprendizcontrollers.php
touch examen/app/database/database.php
touch examen/app/models/aprendiz.php
touch examen/app/views/form.php

touch examen/validaciones.php

touch examen/public/index.php
touch examen/public/resultado.php
touch examen/public/volver.php
echo "Estructura creada correctamente."
