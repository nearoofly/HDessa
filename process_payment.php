<?php
<?php
// process_payment.php
require_once('chemin_vers/config.php');
\Stripe\Stripe::setApiKey($stripeSecretKey);

require 'vendor/autoload.php'; // Assurez-vous d'inclure la bibliothèque Stripe (ou utilisez Composer)

\Stripe\Stripe::setApiKey('pk_live_51NID2BAGHCS2IVlyKTnlpEsDpVM20wph80XFEG24VnSlh2JSp1OqHFlutrBHiPxcoOIhYAQdoklbBMRQws3cRC3U00tsrEOTxW'); // Remplacez par votre clé API secrète Stripe

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérez le montant du paiement en centimes
    $amount = $_POST['amount'];

    // Créez une nouvelle charge Stripe
    try {
        $charge = \Stripe\Charge::create([
            'amount' => $amount,
            'currency' => 'EUR', // Changez la devise si nécessaire
            'description' => 'Paiement pour la vidéo',
            'source' => $_POST['stripeToken'],
        ]);

        // Le paiement a réussi, enregistrez ici la confirmation du paiement dans votre base de données ou effectuez d'autres actions requises.
        // Par exemple, vous pouvez mettre à jour l'accès à la vidéo pour l'utilisateur.

        // Redirigez l'utilisateur vers une page de confirmation
        header('Location: confirmation.php');
        exit;
    } catch (\Stripe\Error\Card $e) {
        // Le paiement a échoué à cause d'une erreur de carte
        echo "Le paiement a échoué. Veuillez réessayer.";
    }
}
?>


















<?php
require_once('vendor/autoload.php'); // Inclure la bibliothèque Stripe PHP

\Stripe\Stripe::setApiKey('pk_live_51NID2BAGHCS2IVlyKTnlpEsDpVM20wph80XFEG24VnSlh2JSp1OqHFlutrBHiPxcoOIhYAQdoklbBMRQws3cRC3U00tsrEOTxW'); // Remplacez par votre clé API Stripe secrète

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['stripeToken'];
    $amount = $_POST['amount'];

    try {
        \Stripe\Charge::create(array(
            'amount' => $amount,
            'currency' => 'EUR',
            'source' => $token,
        ));

        // Le paiement a réussi, vous pouvez rediriger l'utilisateur vers une page de confirmation.
        header('Location: confirmation.php');
    } catch (\Stripe\Error\Card $e) {
        // Gestion des erreurs liées à la carte
        echo 'Erreur de carte : ' . $e->getMessage();
    } catch (Exception $e) {
        // Gestion des autres erreurs
        echo 'Une erreur est survenue : ' . $e->getMessage();
    }
}
?>
