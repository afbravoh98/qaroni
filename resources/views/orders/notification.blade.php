<!DOCTYPE html>
<html lang="es">
<head>
    <title>Notificacion de Orden</title>
</head>
<body>

<center>
    <h2 style="padding: 23px;border: 6px red solid;">
        <p>Reserva de evento: {{ $event->translation('es')->name }}</p>
    </h2>
</center>

<center>
    <h2 style="padding: 23px;border: 6px red solid;">
        <p>Fecha y Hora de compra: {{ $order->buy_at }}</p>
    </h2>
</center>

<center>
    <h2 style="padding: 23px;border: 6px red solid;">
        <p>Cantidad de Tickets: {{ $order->quantity }}</p>
    </h2>
</center>

<center>
    <h2 style="padding: 23px;border: 6px red solid;">
        <p>Email: {{ $order->email }}</p>
    </h2>
</center>

</body>
</html>
