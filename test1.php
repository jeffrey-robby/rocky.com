SELECT 
        id_produits, 
        produits.nom_produits,
        quantite_historique_transfert, 
        id_stocks, 
        de_stock_historique_transfert, 
        date_historique_transfert 
        FROM 
        historique_transfert 
        JOIN produits ON produits.id_produits = historique_transfert.id_produits
        WHERE date_historique_transfert BETWEEN ? AND ?