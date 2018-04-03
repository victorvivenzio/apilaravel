@component('mail::message')
    # Hola {{ $user->name }}

    Por favor verificar el nuevo correo electrónico utilizando el siguiente enlace:

    @component('mail::button', ['url' => route('verify', $user->verification_token)])
        Confirmar Aqui
    @endcomponent

    Gracias,<br>
    {{ config('app.name') }}
@endcomponent
