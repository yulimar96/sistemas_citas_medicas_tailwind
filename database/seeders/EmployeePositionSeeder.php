<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EmployeePosition;

class EmployeePositionSeeder extends Seeder
{
    public function run()
    {
        EmployeePosition::create(['name' => 'Presidente', 'description' => 'Responsable de la dirección estratégica y la gestión general de la organización. Representa a la empresa ante terceros y toma decisiones clave.']);
        EmployeePosition::create(['name' => 'Vicepresidente', 'description' => 'Asiste al presidente y supervisa las operaciones de la organización, actuando como su reemplazo en su ausencia.']);
        EmployeePosition::create(['name' => 'Secretario', 'description' => 'Encargado de la documentación y actas de las reuniones de la junta, así como de la gestión administrativa.']);
        EmployeePosition::create(['name' => 'Tesorero', 'description' => 'Responsable de la gestión financiera, incluyendo la contabilidad, presupuestos y reportes financieros.']);
        EmployeePosition::create(['name' => 'Gerente', 'description' => 'Supervisa las operaciones de un departamento específico y es responsable de alcanzar los objetivos establecidos.']);
        EmployeePosition::create(['name' => 'Coordinador', 'description' => 'Coordina proyectos y actividades dentro de un departamento, asegurando la comunicación y colaboración entre equipos.']);
        EmployeePosition::create(['name' => 'Analista', 'description' => 'Realiza análisis de datos y proporciona informes para la toma de decisiones estratégicas.']);
        EmployeePosition::create(['name' => 'Director', 'description' => 'Dirige un área específica de la organización, estableciendo objetivos estratégicos y supervisando su cumplimiento.']);
        EmployeePosition::create(['name' => 'Subdirector', 'description' => 'Asiste al director en la gestión de su área y supervisa las operaciones diarias.']);
        EmployeePosition::create(['name' => 'Jefe de Departamento', 'description' => 'Lidera un departamento y es responsable de su rendimiento y desarrollo.']);
        EmployeePosition::create(['name' => 'Supervisor', 'description' => 'Supervisa el trabajo de un equipo, asegurando el cumplimiento de objetivos y estándares de calidad.']);
        EmployeePosition::create(['name' => 'Asistente', 'description' => 'Brinda apoyo administrativo y operativo a un departamento o ejecutivo, gestionando tareas diarias.']);
        EmployeePosition::create(['name' => 'Consultor', 'description' => 'Proporciona asesoría experta en un área específica, ayudando a la organización a mejorar su rendimiento.']);
        EmployeePosition::create(['name' => 'Representante', 'description' => 'Actúa como enlace entre la organización y sus clientes o socios, gestionando relaciones y ventas.']);
        EmployeePosition::create(['name' => 'Administrativo', 'description' => 'Realiza tareas administrativas y de soporte en la organización, asegurando el funcionamiento eficiente de las operaciones.']);
        EmployeePosition::create(['name' => 'Responsable de Proyectos', 'description' => 'Gestiona y coordina proyectos desde su inicio hasta su finalización, asegurando el cumplimiento de plazos y objetivos.']);
        EmployeePosition::create(['name' => 'Desarrollador', 'description' => 'Diseña y desarrolla software y aplicaciones, trabajando en colaboración con otros equipos técnicos.']);
        EmployeePosition::create(['name' => 'Diseñador', 'description' => 'Crea y desarrolla conceptos visuales y gráficos para proyectos, asegurando la coherencia de la marca.']);
        EmployeePosition::create(['name' => 'Investigador', 'description' => 'Realiza investigaciones para recopilar datos y análisis que apoyen la toma de decisiones estratégicas.']);
        EmployeePosition::create(['name' => 'Operador', 'description' => 'Maneja y opera maquinaria o equipos, asegurando su correcto funcionamiento y mantenimiento.']);
        EmployeePosition::create(['name' => 'Vendedor', 'description' => 'Responsable de la venta de productos o servicios, gestionando relaciones con clientes y alcanzando objetivos de ventas.']);
        EmployeePosition::create(['name' => 'Promotor', 'description' => 'Promociona productos o servicios, generando interés y atrayendo clientes potenciales.']);
        EmployeePosition::create(['name' => 'Auditor', 'description' => 'Realiza auditorías internas y externas para evaluar la conformidad y eficiencia de los procesos.']);
        EmployeePosition::create(['name' => 'Analista', 'description' => 'Realiza análisis detallados y proporciona recomendaciones basadas en datos para mejorar procesos y decisiones.']);
    }
}
