<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message</title>
</head>
<body>

    <h2>Bonjour {{ $user->username }},</h2>

    <p>🎁 Félicitations ! Grâce à votre fidélité, vous avez reçu un code promo.</p>

    <p><strong>Code :</strong> {{ $promo->code }}</p>
    <p><strong>Réduction :</strong> {{ $promo->pourcentage }}%</p>
    <p><strong>Date d'expiration :</strong> {{ \Carbon\Carbon::parse($promo->expire)->format('d/m/Y') }}</p>

    <p>Utilisez ce code lors de votre prochaine commande pour bénéficier de votre remise.</p>

    <br>
    <p>Merci pour votre confiance,<br>
    L'équipe</p>


</body>
</html>
