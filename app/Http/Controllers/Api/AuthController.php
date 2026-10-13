<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthCambiarContrasenaRequest;
use App\Http\Requests\AuthContrasenaRestablecerRequest;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Http\Requests\AuthRestablecerContrasenaRequest;
use App\Models\User;
use Dedoc\Scramble\Attributes\BodyParameter;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth:api', except: ['login', 'registro', 'restablecerContrasena', 'contrasenaRestablecer']),
        ];
    }

    #[BodyParameter('email', 'Correo del usuario.', required: true, type: 'string', format: 'email', example: 'juan.perez@example.com')]
    #[BodyParameter('password', 'Contraseña.', required: true, type: 'string', format: 'password', example: 'secret123')]
    public function login(AuthLoginRequest $request): JsonResponse
    {
        if (! $token = Auth::attempt($request->validated())) {
            return response()->json(['error' => 'No autorizado'], 401);
        }

        return $this->respondWithToken($token);
    }

    #[BodyParameter('nombre', 'Nombre del usuario (3 a 30 caracteres).', required: true, type: 'string', example: 'Juan')]
    #[BodyParameter('apellido', 'Apellido del usuario (3 a 40 caracteres).', required: true, type: 'string', example: 'Pérez')]
    #[BodyParameter('email', 'Correo electrónico único (10 a 40 caracteres).', required: true, type: 'string', format: 'email', example: 'juan.perez@example.com')]
    #[BodyParameter('direccion', 'Dirección de domicilio (10 a 200 caracteres).', required: true, type: 'string', example: 'Av. Siempre Viva 742')]
    #[BodyParameter('telefono', 'Número de teléfono, opcional (máx. 50 caracteres).', required: false, type: 'string', example: '+240 555 0000')]
    #[BodyParameter('empresa', 'Nombre de empresa, único (3 a 150 caracteres).', required: true, type: 'string', example: 'GE S.A.')]
    #[BodyParameter('numero_documento', 'Número de documento, único (5 a 15 caracteres).', required: true, type: 'string', example: '1000000')]
    #[BodyParameter('tipo_documento', 'Tipo de documento.', required: true, type: 'string', example: 'dip, nif, nie')]
    #[BodyParameter('es_activo', 'Indica si el usuario está activo.', required: true, type: 'boolean', example: true)]
    #[BodyParameter('ciudad_id', 'ID de la ciudad a la que pertenece el usuario.', required: true, type: 'integer', example: 1)]
    #[BodyParameter('password', 'Contraseña (8 a 20 caracteres).', required: true, type: 'string', format: 'password', example: 'secret123')]
    public function registro(AuthRegisterRequest $request): JsonResponse
    {
        User::create($request->validated());

        return $this->login($request);
    }

    public function me(): JsonResponse
    {
        Gate::authorize('auth.me', 'api');

        return response()->json(Auth::user());
    }

    public function logout(): JsonResponse
    {
        Gate::authorize('auth.logout', 'api');
        Auth::logout();

        return response()->json(['mensaje' => 'Cierre de sesión exitoso']);
    }

    #[BodyParameter('password_actual', 'Contraseña actual.', required: true, type: 'string', format: 'password', example: 'secret123')]
    #[BodyParameter('password_nuevo', 'Nueva contraseña (8 a 20 caracteres, distinta a la actual).', required: true, type: 'string', format: 'password', example: 'nuevaClave123')]
    public function cambiarContrasena(AuthCambiarContrasenaRequest $request): JsonResponse
    {
        $datos = $request->validated();
        $user = Auth::user();

        if (! Hash::check($datos['password_actual'], $user->password)) {
            return response()->json(['error' => 'Credenciales inválidas'], 401);
        }

        $user->update(['password' => $datos['password_nuevo']]);

        return response()->json(['mensaje' => 'Contraseña actualizada correctamente'], 200);
    }

    #[BodyParameter('email', 'Correo del usuario registrado.', required: true, type: 'string', format: 'email', example: 'juan.perez@example.com')]
    public function restablecerContrasena(AuthRestablecerContrasenaRequest $request): JsonResponse
    {
        Password::sendResetLink($request->only('email'));

        return response()->json([
            'mensaje' => 'Si el correo está registrado, recibirás un enlace para restablecer tu contraseña.',
        ]);
    }

    #[BodyParameter('email', 'Correo del usuario.', required: true, type: 'string', format: 'email', example: 'juan.perez@example.com')]
    #[BodyParameter('token', 'Token recibido por correo.', required: true, type: 'string', example: 'abc123...')]
    #[BodyParameter('password', 'Nueva contraseña (8 a 20 caracteres).', required: true, type: 'string', format: 'password', example: 'nuevaClave123')]
    #[BodyParameter('password_confirmation', 'Confirmación de la nueva contraseña.', required: true, type: 'string', format: 'password', example: 'nuevaClave123')]
    public function contrasenaRestablecer(AuthContrasenaRestablecerRequest $request): JsonResponse
    {
        $estado = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password): void {
                $user->update(['password' => $password]);
            }
        );

        if ($estado === Password::PASSWORD_RESET) {
            return response()->json(['mensaje' => __($estado)]);
        }

        return response()->json(['error' => __($estado)], 400);
    }

    /* public function refresh()
    {
        Gate::authorize('auth.refresh', 'api');
        return $this->respondWithToken(Auth::refresh());
    } */

    protected function respondWithToken(string $token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
        ]);
    }
}
