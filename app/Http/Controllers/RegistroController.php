<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registro;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\RegistroConfirmacion;

class RegistroController extends Controller
{
    public function index()
    {
        return view('registro.index');
    }

    public function store(Request $request)
    {
        // Validar los datos
        $validated = $request->validate([
            'codigo_socio' => 'required|string|max:255|unique:registros,codigo_socio',
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'correo' => 'required|email|max:255|unique:registros,correo',
            'telefono' => 'required|string|max:20',
            'edad' => 'required|integer|min:1|max:120',
        ], [
            'codigo_socio.unique' => 'Este código de socio ya ha sido registrado anteriormente.',
            'correo.unique' => 'Este correo electrónico ya ha sido registrado anteriormente.',
            'codigo_socio.required' => 'El código de socio es obligatorio.',
            'nombres.required' => 'Los nombres son obligatorios.',
            'apellidos.required' => 'Los apellidos son obligatorios.',
            'correo.required' => 'El correo electrónico es obligatorio.',
            'correo.email' => 'Debe ingresar un correo electrónico válido.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'edad.required' => 'La edad es obligatoria.',
            'edad.integer' => 'La edad debe ser un número.',
            'edad.min' => 'La edad debe ser al menos 1.',
            'edad.max' => 'La edad no puede ser mayor a 120.',
        ]);

        // Crear el registro
        $registro = Registro::create($validated);

        // Enviar correo de confirmación
        try {
            Mail::to($registro->correo)->send(new RegistroConfirmacion($registro));
        } catch (\Exception $e) {
            // Si falla el envío del correo, registrar el error pero continuar
            Log::error('Error al enviar correo: ' . $e->getMessage());
        }

        // Redirigir con mensaje de éxito
        return redirect()->back()->with('success', '¡Registro exitoso! Se ha enviado un correo de confirmación a ' . $registro->correo);
    }
}
