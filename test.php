<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche des Réglages</title>
    <style>
        /* Styles de la page */
body {
    font-family: Arial, sans-serif;
    margin: 20px;
    background-color: #f8f9fa;
}

/* Conteneur principal */
.container {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    border: 2px solid #ccc;
    padding: 20px;
    background: white;
}

/* Style des colonnes */
.column {
    flex: 1;
    padding: 20px;
    border-left: 2px solid #ccc;
}

.column:first-child {
    border-left: none;
}

/* Style des titres */
h2, h3 {
    font-size: 18px;
    margin-bottom: 10px;
    text-transform: uppercase;
    color: #333;
}

/* Style des paragraphes */
p {
    margin: 8px 0;
    font-size: 14px;
}

/* Bouton Modifier */
.modify-button {
    background: #007bff;
    color: white;
    padding: 8px 12px;
    border: none;
    cursor: pointer;
    border-radius: 5px;
    font-size: 14px;
}

.modify-button:hover {
    background: #0056b3;
}

/* Style des boutons toggle */
.toggle-button {
    display: inline-block;
    width: 20px;
    height: 20px;
    background: green;
    border-radius: 50%;
    margin-left: 10px;
    border: 2px solid black;
}

/* Style des listes */
ul {
    list-style: none;
    padding: 0;
}

ul li {
    display: flex;
    justify-content: space-between;
    margin-bottom: 5px;
    font-size: 14px;
}

    </style>
</head>
<body>

    <div class="container">
        <!-- Colonne Société -->
        <div class="column">
            <h2>Société</h2>
            <p><strong>Identifiant:</strong> __________</p>
            <p><strong>Mot de passe:</strong> __________</p>
            <p><strong>Nom:</strong> __________</p>
            <p><strong>Prénom:</strong> __________</p>
            <p><strong>Privilèges:</strong> <span class="toggle-button"></span></p>
            
            <h3>Données entreprise</h3>
            <p><strong>Nom de l'établissement:</strong> __________</p>
            <p><strong>Logo:</strong> __________</p>
            <p><strong>Siret:</strong> __________</p>
            <p><strong>Adresse:</strong> __________</p>
            <p><strong>CP Ville:</strong> __________</p>
            <p><strong>Pays:</strong> __________</p>
            <p><strong>Portable:</strong> __________</p>
            <p><strong>Fixe:</strong> __________</p>
            <p><strong>Mail:</strong> __________</p>
            <p><strong>Rib:</strong> __________</p>
            <button class="modify-button">Modifier les données</button>
        </div>

        <!-- Colonne Objectif & TVA -->
        <div class="column">
            <h2>OBJECTIF</h2>
            <p><strong>Objectif Annuel:</strong> __________</p>
            <p><strong>Objectif Mensuel:</strong> __________</p>

            <h2>TVA</h2>
            <p><strong>Seuil de TVA base:</strong> __________</p>
            <p><strong>Seuil de TVA majoré:</strong> __________</p>

            <h2>CHARGE SOCIALES</h2>
            <p><strong>Charge sociale BIC:</strong> __________ %</p>
            <p><strong>Charge sociale Marchandises:</strong> __________ %</p>
            <p><strong>Formation artisan obligatoire:</strong> __________ %</p>
            <p><strong>Taxe CMA vente:</strong> __________ %</p>
            <p><strong>Taxe CMA prestations:</strong> __________ %</p>
            <p><strong>Charges sociales:</strong> __________ %</p>
            <p><strong>Charges variables:</strong> __________ %</p>
            <p><strong>Charges fixes:</strong> __________ %</p>
            <p><input type="checkbox"> Non assujetti : TVA non applicable, article 293B du CGI</p>
            <p><input type="checkbox"> En cas de retard de paiement, indemnité 12,21 %</p>
        </div>

        <!-- Colonne Icônes barre de tâche -->
        <div class="column">
            <h2>Icônes barre de tâche</h2>
            <ul>
                <li>Planning <span class="toggle-button"></span></li>
                <li>Caisse <span class="toggle-button"></span></li>
                <li>Tarifs <span class="toggle-button"></span></li>
                <li>Forfait <span class="toggle-button"></span></li>
                <li>Clients <span class="toggle-button"></span></li>
                <li>Technique <span class="toggle-button"></span></li>
                <li>Produit <span class="toggle-button"></span></li>
                <li>SMS <span class="toggle-button"></span></li>
                <li>Stock <span class="toggle-button"></span></li>
                <li>Carte de fidélité <span class="toggle-button"></span></li>
                <li>Chèque cadeaux <span class="toggle-button"></span></li>
                <li>Abonnement <span class="toggle-button"></span></li>
                <li>Recette - Dépenses <span class="toggle-button"></span></li>
                <li>Achats <span class="toggle-button"></span></li>
                <li>Clôture de caisse <span class="toggle-button"></span></li>
                <li>Statistique <span class="toggle-button"></span></li>
                <li>Paramètre <span class="toggle-button"></span></li>
                <li>Devis <span class="toggle-button"></span></li>
                <li>Avoir <span class="toggle-button"></span></li>
                <li>Mailing <span class="toggle-button"></span></li>
            </ul>
        </div>
    </div>

</body>
</html>
