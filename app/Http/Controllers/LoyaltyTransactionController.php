<?php

namespace App\Http\Controllers;

use App\Mail\SendPromoCodeMail;
use App\Models\CodePromo;
use App\Models\LoyaltyTransaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LoyaltyTransactionController extends Controller
{
    public function addPoint(Request $request){
        $user = User::find($request->user_id);
        $amount = $request->amount;

        //Exemple 50000FCFA = 1point

        if ($amount >= 50000) {
            $points = floor($amount / 50000) * 100;

            $user->points += $points;
            $user->save();

            LoyaltyTransaction::create([
                'user_id' => $user->id,
                'points' => $points,
                'type' => 'gain',
                'description' => 'Points gagnés pour un paiement de ' . $amount . ' FCFA',
            ]);

            return response()->json([
                'message' => 'Points ajoutés avec succès',
                'points_gagnes' => $points,
                'total_points' => $user->points
            ]);

        }

        return response()->json([
            'message' => 'Aucun point ajouté. Le montant doit être au moins 50 000 FCFA.',
            'points_gagnes' => 0,
            'total_points' => $user->points
        ]);

    }

    public function sendPromoCodeManually(Request $request){

        $user = User::findOrFail($request->user_id);

        // Vérifier que le client a au moins 20 000 points
        if ($user->points < 20000) {
            return response()->json([
                'message' => 'Vous devez avoir au moins 20 000 points pour recevoir un code promo.',
                'points_actuels' => $user->points,
            ], 403);
        }

        // Calcul du pourcentage : 5% tous les 20 000 points (max 50%)
        $multiple = floor($user->points / 20000);
        $pourcentage = min($multiple * 5, 50);

        // Générer un code unique RS-XXXXXX
        do {
            $code = 'RS-' . str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        } while (CodePromo::where('code', $code)->exists());

        // Créer le code promo
        $promo = CodePromo::create([
            'code' => $code,
            'pourcentage' => $pourcentage,
            'expire' => now()->addDays(15),
            'used' => false,
        ]);

        // Envoyer le mail
        Mail::to($user->email)->send(new SendPromoCodeMail($promo, $user));

        // Réinitialiser les points du client
        $user->points = 0;
        $user->save();

        return response()->json([
            'message' => 'Code promo envoyé avec succès',
            'code' => $promo->code,
            'pourcentage' => $promo->pourcentage,
            'expire' => $promo->expire->toDateString(),
            'points_apres_envoi' => $user->points,
        ]);
    }


}
