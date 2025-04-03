document.addEventListener('DOMContentLoaded', function() {
    const generateInvoiceCheckbox = document.getElementById('generateInvoice');
    const invoiceFormatDiv = document.getElementById('invoiceFormat');
    const totalAmountSpan = document.getElementById('totalAmount');
    const totalAfterDiscountSpan = document.getElementById('totalAfterDiscount');
    const discountInput = document.getElementById('discount');
    const venteTableBody = document.querySelector('#venteTable tbody');
    const produitGrid = document.getElementById('produitGrid');
    const searchInput = document.getElementById('searchProduct');
    const categorySelect = document.getElementById('categorySelect');
    const fournisseurSelect = document.getElementById('fournisseurSelect');
    const stockSelect = document.getElementById('stockSelect');
    const clientSelect = document.getElementById('clientSelect');
    const validerVendreACredit = document.getElementById('validerVendreACredit');
    const products = []; // Tableau pour stocker les produits

    // Afficher ou cacher le format de la facture
    generateInvoiceCheckbox.addEventListener('change', function() {
        invoiceFormatDiv.style.display = this.checked ? 'block' : 'none';
    });

    // Fonction pour filtrer les produits
    function filterProducts() {
        const searchValue = searchInput.value.toLowerCase();
        const selectedCategory = categorySelect.value;
        const selectedFournisseur = fournisseurSelect.value;
        const selectedStock = stockSelect.value;

        const produitCards = produitGrid.querySelectorAll('.produit-card');

        produitCards.forEach(card => {
            const produitNom = card.getAttribute('data-nom').toLowerCase();
            const produitCategorie = card.getAttribute('data-categories');
            const produitFournisseur = card.getAttribute('data-fournisseur');
            const produitStock = card.getAttribute('data-stock');

            const matchesSearch = produitNom.includes(searchValue);
            const matchesCategory = selectedCategory === "" || produitCategorie === selectedCategory;
            const matchesFournisseur = selectedFournisseur === "" || produitFournisseur === selectedFournisseur;
            const matchesStock = selectedStock === "" || (selectedStock === "1" && produitStock > 0) || (selectedStock === "0" && produitStock <= 0);

            card.style.display = (matchesSearch && matchesCategory && matchesFournisseur && matchesStock) ? 'block' : 'none';
        });
    }

    // Événements pour les champs de recherche et les sélecteurs
    searchInput.addEventListener('input', filterProducts);
    categorySelect.addEventListener('change', filterProducts);
    fournisseurSelect.addEventListener('change', filterProducts);
    stockSelect.addEventListener('change', filterProducts);

    // Ajouter un produit à la table
    document.querySelectorAll('.produit-card').forEach(card => {
        card.addEventListener('click', function() {
            const produitId = this.getAttribute('data-id');
            const produitNom = this.getAttribute('data-nom');
            const produitImage = this.getAttribute('data-image');
            const produitCategories = this.getAttribute('data-categories');
            const prixSimple = parseFloat(this.getAttribute('data-prix-simple'));
            const prixGrossiste = parseFloat(this.getAttribute('data-prix-grossiste'));

            // Récupérer le type de client sélectionné
            // const selectedClientType = clientSelect.options[clientSelect.selectedIndex].getAttribute('data-type');

            // Déterminer le prix en fonction du type de client
            const produitPrix = prixSimple;

            // Créer une nouvelle ligne dans la table
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>
                   <div class="flex items-center gap-4">
                      <img src="${produitImage}" alt="" class="w-12 h-12 rounded" />
                      <div>
                        <h3 class="text-base font-semibold">${produitNom}</h3>
                        <div>
                            <span>Catégorie : <span class="font-semibold text-white-dark">${produitCategories}</span></span>
                        </div>
                      </div>
                    </div>
                </td>
                <td>${produitPrix.toFixed(2)} FCFA</td>
                <td><input type="number" class="quantity border-0 border-l rounded-none focus:shadow-[0_0_5px_2px_rgb(194_213_255_/_62%)] dark:shadow-[#1b2e4b] placeholder:tracking-wider focus:outline-none" style="padding-bottom: 10px;padding-left: 20px; padding-top: 10px;background-color: #f1f1f1; width: 54px;" value="1" min="1"></td>
                <td class="total">${produitPrix.toFixed(2)} FCFA</td>
                <td><button class="removeRow" style="color: red; background: none; border: none; cursor: pointer; font-size: 26px;">✖</button></td>
            `;
            venteTableBody.appendChild(newRow);

            // Mettre à jour le tableau des produits
            products.push({ id: produitId, nom: produitNom, quantity: 1, price: produitPrix });

            // Mettre à jour le total
            updateTotal();

            // Événements pour la suppression de la ligne
            newRow.querySelector('.removeRow').addEventListener('click', function() {
                const index = products.findIndex(p => p.id === produitId);
                if (index !== -1) {
                    products.splice(index, 1); // Retirer le produit du tableau
                }
                venteTableBody.removeChild(newRow);
                updateTotal();
            });

            // Événements pour la quantité
            newRow.querySelector('.quantity').addEventListener('input', function() {
                const quantity = parseInt(this.value);
                const totalCell = newRow.querySelector('.total');
                totalCell.textContent = (produitPrix * quantity).toFixed(2) + ' FCFA';

                // Mettre à jour la quantité dans le tableau
                const index = products.findIndex(p => p.id === produitId);
                if (index !== -1) {
                    products[index].quantity = quantity; // Mettre à jour la quantité
                }
                updateTotal();
            });
        });
    });

    // Mettre à jour le total
    function updateTotal() {
        let total = 0;
        venteTableBody.querySelectorAll('tr').forEach(row => {
            const totalCell = row.querySelector('.total');
            total += parseFloat(totalCell.textContent);
        });
        totalAmountSpan.textContent = total.toFixed(2) + ' FCFA';

        // Calculer le total après réduction
        const discount = parseFloat(discountInput.value) || 0;
        const totalAfterDiscount = total - (total * (discount / 100));
        totalAfterDiscountSpan.textContent = totalAfterDiscount.toFixed(2) + ' FCFA';
    }

    // Événement pour le champ de réduction
    discountInput.addEventListener('input', updateTotal);
    
    // Événement pour valider la vente
    validerVendreACredit.addEventListener('click', function() {
        const clientId = clientSelect.value;
        const personnelId = id_personnels.value;
    
        if (!clientId) {
            alert("Veuillez sélectionner un client.");
            return;
        }
    
        // Ouvrir le modal de confirmation
        openConfirmationModal(products);
    });
    
    let totalGeneral = 0; // Initialiser le total général
let totalDiscount = 0; // Initialiser la réduction totale

function openConfirmationModal(products) {
    const confirmationModal = document.getElementById('confirmationModal');
    const confirmationTableBody = confirmationModal.querySelector('tbody');
    confirmationTableBody.innerHTML = ''; // Réinitialiser le contenu
    totalGeneral = 0; // Réinitialiser le total général à chaque ouverture

    products.forEach(product => {
        const row = document.createElement('tr');
        const totalProduct = product.price * product.quantity; // Calculer le total du produit
        totalGeneral += totalProduct; // Ajouter au total général

        row.innerHTML = `
            <td>${product.id}</td>
            <td>${product.nom}</td>
            <td>
                <input type="number" class="price-input" value="${product.price.toFixed(2)}" min="0" />
            </td>
            <td>${product.quantity}</td>
            <td class="total">${totalProduct.toFixed(2)} FCFA</td>
        `;

        confirmationTableBody.appendChild(row);
    });

    // Afficher le total général
    document.getElementById('totalGeneral').textContent = `${totalGeneral.toFixed(2)} FCFA`;

    // Ajouter un événement pour la réduction globale
    const globalDiscountInput = document.getElementById('globalDiscount');
    globalDiscountInput.value = 0; // Réinitialiser la réduction à chaque ouverture
    globalDiscountInput.removeEventListener('input', updateDiscountListener); // Retirer l'ancien écouteur
    globalDiscountInput.addEventListener('input', updateDiscountListener); // Ajouter un nouvel écouteur

    confirmationModal.style.display = 'block'; // Afficher le modal
}

// Fonction pour mettre à jour le total général avec la réduction
function updateTotalWithDiscount(totalGeneral) {
    const discountInput = document.getElementById('globalDiscount');
    const discount = parseFloat(discountInput.value) || 0;

    // Calculer le montant de la réduction
    const discountAmount = (totalGeneral * discount) / 100;
    const totalAfterDiscount = totalGeneral - discountAmount;

    // Mettre à jour le total général affiché
    document.getElementById('totalGeneral').textContent = `${totalAfterDiscount.toFixed(2)} FCFA`;

    return discountAmount; // Retourner la réduction calculée
}

function updateDiscountListener() {
    totalDiscount = updateTotalWithDiscount(totalGeneral);
}

// Événement pour confirmer la vente
document.getElementById('confirmSaleButton').addEventListener('click', function() {
    const confirmationTableBody = document.querySelector('#confirmationModal tbody');
    const rows = confirmationTableBody.querySelectorAll('tr');

    if (rows.length === 0) { // Vérifier si des produits sont présents
        alert('Veuillez sélectionner au moins un produit avant de conclure la vente.'); // Afficher le message d'alerte
        return; // Sortir de la fonction
    }

    const updatedProducts = Array.from(document.querySelectorAll('.price-input')).map((input, index) => {
        const price = parseFloat(input.value);
        return {
            id: products[index].id,
            price: price,
            nom: products[index].nom,
            quantity: products[index].quantity
        };
    });

    // Récupérer l'ID du client sélectionné
    const clientId = document.getElementById('clientSelect').value;
    const personnelId = document.getElementById('id_personnels').value;
    const finalTotalGeneral = totalGeneral - totalDiscount;

    // Envoyer les produits mis à jour ainsi que l'ID du client à conclure_la_vente.php
    fetch('conclure_la_vente.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ 
            clientId: clientId, // Inclure l'ID du client
            personnelId: personnelId, // Inclure l'ID du personnel
            totalDiscount: totalDiscount,
            finalTotalGeneral: finalTotalGeneral, // Ajouter le total général final
            products: updatedProducts 
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Vente validée avec succès. Numéro de facture : ' + data.invoiceNumber);
            // Réinitialiser le tableau et les totaux
            venteTableBody.innerHTML = '';
            products.length = 0;
            updateTotal();
        } else {
            alert('Erreur : ' + data.message);
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
    });
});

// Événement pour fermer le modal
document.getElementById('closeConfirmationModal').addEventListener('click', function() {
    document.getElementById('confirmationModal').style.display = 'none';
});
    
    // Gestion des événements pour les boutons
    document.getElementById('vendreACreditButton').addEventListener('click', function() {
        openModal('vendreACreditModal');
    });
    
    // Valider vente à crédit
    document.getElementById('validerVendreACredit').addEventListener('click', function() {
        const clientId = clientSearch.value;
        const produits = Array.from(venteTableBody.querySelectorAll('tr')).map(row => ({
            id: row.cells[0].getAttribute('data-id'),
            quantity: parseInt(row.querySelector('.quantity').value),
            price: parseFloat(row.querySelector('.total').textContent)
        }));
    
        fetch('conclure_la_vente.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ clientId, produits })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Vente à crédit enregistrée avec succès !');
                location.reload();
            } else {
                alert('Erreur : ' + data.message);
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Une erreur est survenue. Veuillez réessayers.');
        });
    
        closeModal('vendreACreditModal'); // Fermer le modal après validation
    });
    
    // Annuler la vente à crédit
    document.getElementById('annulerVendreACredit').addEventListener('click', function() {
        closeModal('vendreACreditModal');
    });

});