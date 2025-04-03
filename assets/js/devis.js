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
    const conlcureLaVente = document.getElementById('conlcureLaVente');
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
            const produitUnite = this.getAttribute('data-unite');
            const produitImage = this.getAttribute('data-image');
            const produitCategories = this.getAttribute('data-categories');
            const prixSimple = parseFloat(this.getAttribute('data-prix-simple'));
            const prixGrossiste = parseFloat(this.getAttribute('data-prix-grossiste'));

            
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
                <td>${produitUnite}</td>
                <td>${produitPrix.toFixed(2)} FCFA</td>
                <td><input type="number" class="quantity border-0 border-l rounded-none focus:shadow-[0_0_5px_2px_rgb(194_213_255_/_62%)] dark:shadow-[#1b2e4b] placeholder:tracking-wider focus:outline-none" style="padding-bottom: 10px;padding-left: 13px; padding-top: 10px;background-color: #f1f1f1; width: 50px;" value="1" min="1"></td>
                <td class="total">${produitPrix.toFixed(2)} FCFA</td>
                <td><button class="removeRow" style="color: red; background: none; border: none; cursor: pointer; font-size: 26px;">✖</button></td>
            `;
            venteTableBody.appendChild(newRow);

            // Mettre à jour le tableau des produits
            products.push({ id: produitId, image: produitImage, unite: produitUnite, nom: produitNom, quantity: 1, price: produitPrix });

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
    conlcureLaVente.addEventListener('click', function() {
        const clientId = clientSelect.value;
        const personnelId = id_personnels.value;
    
        if (!clientId) {
            showMessage("Veuillez sélectionner un client.", 'top');
            return;
        }
        // Vérifier si des produits sont sélectionnés avant d'ouvrir le modal
        if (products.length === 0) {
            showMessage1("Veuillez sélectionner au moins un produit avant de conclure la vente.", 'top');
            return;
        }
    
        // Ouvrir le modal de confirmation
        openCloclureLaVenteModal(products);
    });
    
    let totalGeneral = 0; 
    let totalDiscount = 0; 
    
    function openCloclureLaVenteModal(products) {
        const cloclureLaVenteModal = document.getElementById('cloclureLaVenteModal');
        const confirmationTableBody = cloclureLaVenteModal.querySelector('tbody');
        confirmationTableBody.innerHTML = ''; 
        totalGeneral = 0; 
        totalDiscount = 0;
    
        products.forEach(product => {
            const row = document.createElement('tr');
            const totalProduct = product.price * product.quantity;
            totalGeneral += totalProduct; 
    
            row.innerHTML = `
                <td>
                   <div class="flex items-center gap-4">
                      <img src="${product.image}" alt="" class="w-12 h-12 rounded" />
                      <div>
                        <h3 class="text-base font-semibold">${product.nom}</h3>
                      </div>
                    </div>
                </td>
                <td>${product.unite}</td>
                <td>
                    <input type="number" class="price-input border-0 border-l rounded-none focus:shadow-[0_0_5px_2px_rgb(194_213_255_/_62%)] dark:shadow-[#1b2e4b] placeholder:tracking-wider focus:outline-none" style="padding-bottom: 10px;padding-left: 13px; padding-top: 10px;background-color: #f1f1f1; width: 100px;" value="${product.price.toFixed(2)}" min="0" />
                </td>
                <td>
                    <input type="number" class="quantity-input border-0 border-l rounded-none focus:shadow-[0_0_5px_2px_rgb(194_213_255_/_62%)] dark:shadow-[#1b2e4b] placeholder:tracking-wider focus:outline-none" style="padding-bottom: 10px;padding-left: 13px; padding-top: 10px;background-color: #f1f1f1; width: 50px;" value="${product.quantity}" min="1" />
                </td>
                <td class="total">${totalProduct.toFixed(2)} FCFA</td>
            `;
    
            confirmationTableBody.appendChild(row);
    
            // Écouteurs pour le prix et la quantité
            const priceInput = row.querySelector('.price-input');
            const quantityInput = row.querySelector('.quantity-input');
    
            priceInput.addEventListener('input', function() {
                const price = parseFloat(this.value) || 0;
                const quantity = parseInt(quantityInput.value) || 1;
                const totalCell = row.querySelector('.total');
                totalCell.textContent = (price * quantity).toFixed(2) + ' FCFA';
                updateTotalGeneral();
            });
    
            quantityInput.addEventListener('input', function() {
                const quantity = parseInt(this.value) || 1;
                const price = parseFloat(priceInput.value) || 0;
                const totalCell = row.querySelector('.total');
                totalCell.textContent = (price * quantity).toFixed(2) + ' FCFA';
                updateTotalGeneral(); 
            });
        });
    
        // Afficher le total général
        document.getElementById('totalGeneral').textContent = `${totalGeneral.toFixed(2)} FCFA`;
    
        // Ajouter un événement pour la réduction globale
        const globalDiscountInput = document.getElementById('globalDiscount');
        globalDiscountInput.value = 0; // Réinitialiser la réduction à chaque ouverture
        globalDiscountInput.removeEventListener('input', updateDiscountListener); // Retirer l'ancien écouteur
        globalDiscountInput.addEventListener('input', updateDiscountListener); // Ajouter un nouvel écouteur
    
        cloclureLaVenteModal.style.display = 'block'; // Afficher le modal
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
    
        return discountAmount; 
    }
    
    // Fonction pour mettre à jour le total général
    function updateTotalGeneral() {
        totalGeneral = 0; // Réinitialiser le total général
        const confirmationTableBody = document.querySelector('#cloclureLaVenteModal tbody');
        confirmationTableBody.querySelectorAll('tr').forEach(row => {
            const totalCell = row.querySelector('.total');
            totalGeneral += parseFloat(totalCell.textContent);
        });
    
        totalDiscount = updateTotalWithDiscount(totalGeneral);
    }
    
    function updateDiscountListener() {
        totalDiscount = updateTotalWithDiscount(totalGeneral); 
    }
    
    // Événement pour cloturer la vente
    document.getElementById('confirmConlcureLaVente').addEventListener('click', function() {
        const confirmationTableBody = document.querySelector('#cloclureLaVenteModal tbody');
        const rows = confirmationTableBody.querySelectorAll('tr');
        
        const updatedProducts = Array.from(document.querySelectorAll('.price-input')).map((input, index) => {
            const price = parseFloat(input.value);
            const quantityInput = confirmationTableBody.querySelectorAll('.quantity-input')[index];
            return {
                id: products[index].id,
                unite: products[index].unite,
                price: price,
                nom: products[index].nom,
                quantity: parseInt(quantityInput.value) || 1 
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
                clientId: clientId, 
                personnelId: personnelId, 
                totalDiscount: totalDiscount,
                finalTotalGeneral: finalTotalGeneral,
                products: updatedProducts 
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showMessage2("Vente validée avec succès", 'top');
                if (data.invoiceUrl) {
                    window.open(data.invoiceUrl, '_blank'); 
                }
                setTimeout(() => {
                    location.reload();
                }, 1000);
                // Générer la facture si la case est cochée
                const checkbox = document.getElementById("generateInvoice");
                if (checkbox.checked) {
                    generateInvoice(data.invoiceNumber, updatedProducts);
                }
              // Réinitialiser le tableau et les totaux
                venteTableBody.innerHTML = '';
                products.length = 0;
                updateTotal(); 
            } else {
                showMessage3("Erreur : " + data.message, 'top');
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
        });
    });
    
    // Événement pour fermer le modal
    document.getElementById('closeCloclureLaVenteModal').addEventListener('click', function() {
        document.getElementById('cloclureLaVenteModal').style.display = 'none';
    });
    
    // Annuler la vente à crédit
    document.getElementById('annulerVendreACredit').addEventListener('click', function() {
        closeModal('vendreACreditModal');
    });

    function numberToWords(amount) {
        if (isNaN(amount) || amount <= 0) {
            return "Zéro";  // Retourne "Zéro" si le montant est invalide ou nul
        }
    
        const units = ["", "un", "deux", "trois", "quatre", "cinq", "six", "sept", "huit", "neuf", "dix", "onze", "douze", "treize", "quatorze", "quinze", "seize", "dix-sept", "dix-huit", "dix-neuf"];
        const tens = ["", "", "vingt", "trente", "quarante", "cinquante", "soixante", "septante", "huitante", "nonante"];
        const hundreds = ["", "cent", "deux cents", "trois cents", "quatre cents", "cinq cents", "six cents", "sept cents", "huit cents", "neuf cents"];
        const largeUnits = ["", "mille", "million", "milliard", "billion"]; // Pour les grands nombres
        
        let num = Math.floor(amount); // Utilise seulement la partie entière du montant
        let result = '';
        
        // Conversion des milliers, millions, etc.
        let unitIndex = 0;
        
        while (num > 0) {
            if (num % 1000 != 0) {
                let segment = convertSegment(num % 1000);
                result = segment + (largeUnits[unitIndex] ? ' ' + largeUnits[unitIndex] : '') + (result ? ' ' + result : '');
            }
            num = Math.floor(num / 1000);
            unitIndex++;
        }
    
        return result.charAt(0).toUpperCase() + result.slice(1); // Mettre en majuscule la première lettre
    }
    
    function convertSegment(segment) {
        const units = ["", "un", "deux", "trois", "quatre", "cinq", "six", "sept", "huit", "neuf", "dix", "onze", "douze", "treize", "quatorze", "quinze", "seize", "dix-sept", "dix-huit", "dix-neuf"];
        const tens = ["", "", "vingt", "trente", "quarante", "cinquante", "soixante", "septante", "huitante", "nonante"];
        const hundreds = ["", "cent", "deux cents", "trois cents", "quatre cents", "cinq cents", "six cents", "sept cents", "huit cents", "neuf cents"];
        
        let result = '';
        let hundredsPlace = Math.floor(segment / 100);
        let tensPlace = Math.floor((segment % 100) / 10);
        let onesPlace = segment % 10;
    
        if (hundredsPlace > 0) {
            result += hundreds[hundredsPlace] + ' ';
        }
        if (tensPlace > 1) {
            result += tens[tensPlace] + (onesPlace > 0 ? '-' : '') + (onesPlace > 0 ? units[onesPlace] : '');
        } else if (tensPlace === 1) {
            result += units[10 + onesPlace]; 
        } else if (onesPlace > 0) {
            result += units[onesPlace];
        }
    
        return result.trim();
    }
    
    function generateInvoice(invoiceNumber, products) {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();
    
        // En-tête
        doc.setFontSize(36); 
        doc.setFont("helvetica", "bold"); // Police en gras
        const headerText = 'ETS ROCKY';
        const headerWidth = doc.getTextWidth(headerText);
        doc.text(headerText, 105 - headerWidth / 2, 15); 
    
        doc.setFontSize(12);
        doc.setFont("helvetica", "normal"); 
    
        // Détails en bas de l'en-tête
        let y = 25; // Position de départ réduite
        doc.setFontSize(14);
        doc.setFont("helvetica", "bold");
        doc.text('COMMERCE GENERAL, PRESTATION DE SERVICE, LIBRAIRIE PAPETERIE', 105, y, { align: 'center' }); 
        y += 7; // Réduire l'interligne
        doc.setFont("helvetica", "normal"); // Police normale
        doc.text('secrétariat bureautique, sis monté GMI n°8 ebolowa', 105, y, { align: 'center' }); 
        y += 7; // Réduire l'interligne
    
        // Contribuable
        doc.setFontSize(12); // Taille plus grande
        doc.setFont("helvetica", "bold");
        doc.text('CONTRIBUTABLE N°: P087312174798W; RC/EBW/2020/A/82', 105, y, { align: 'center' });
        y += 7; // Réduire l'interligne
    
        // Téléphone et Email
        doc.setFontSize(12);
        doc.setFont("helvetica", "normal");
        doc.text('Tel : 670 27 27 03 / 696 84 80 84 / E-mail : raymontegue02@yahoo.com', 105, y, { align: 'center' }); 
        y += 7; // Plus d'espace avant le trait
    
        // Trait horizontal
        doc.setDrawColor(0, 0, 0);
        doc.setLineWidth(1.5); 
        doc.line(20, y, 190, y); 
        y += 10; 
    
        // Date et Numéro de la facture
        const currentDate = new Date().toLocaleDateString(); // Date actuelle
        doc.setFontSize(12);
        doc.setFont("helvetica", "normal");
        doc.text(`Ebolowa, le ${currentDate}`, 190, y, { align: 'right' }); // Date à droite
        y += 10; // Plus d'espace avant le numéro de facture
        doc.text(`Facture N° ${invoiceNumber}`, 105, y, { align: 'center' }); // Numéro de facture centré
        y += 20; 
    
        // Calculer le total général
        const totalGeneral = products.reduce((acc, product) => acc + product.price * product.quantity, 0);
    
        // Générer le tableau des produits
        doc.autoTable({
            startY: y - 12,
            head: [[
                'N°',
                'Désignation',
                'Unité',
                'Qte',
                'P.Unitaire',
                'Total',
            ]],
            body: products.map((product, index) => [
                index + 1, // N°
                product.nom, // Produit
                product.unite, // Unité
                product.quantity, // Quantité
                product.price.toFixed(2), // Prix Unitaire
                (product.price * product.quantity).toFixed(2), // Total
            ]),
            styles: {
                font: 'helvetica',
                fontSize: 12, // Réduction de la taille de la police
                textColor: [0, 0, 0],
                lineColor: [0, 0, 0],
                lineWidth: 0.2,
                halign: 'center', // Centrer le contenu du tableau
            },
            headStyles: {
                fillColor: [34, 139, 34], 
                textColor: [255, 255, 255], 
                fontStyle: 'bold',
                halign: 'center', 
            },
            alternateRowStyles: {
                fillColor: [245, 245, 245], // Gris clair pour les lignes impaires
            },
            columnStyles: {
                0: { halign: 'center', cellWidth: 10 }, // N° centré
                1: { halign: 'left', cellWidth: 60 },  // Produit aligné à gauche
                2: { halign: 'center', cellWidth: 22 }, // Unité centrée
                3: { halign: 'center', cellWidth: 20 }, // Quantité centrée
                4: { halign: 'right', cellWidth: 35 }, // Prix Unitaire aligné à droite
                5: { halign: 'right', cellWidth: 35 }, // Total aligné à droite
            },
            margin: { top: 10, left: 14, right: 14 }, 
            tableWidth: 'wrap', 
            didDrawPage: (data) => {
                // Recréer l'en-tête sur chaque page
                doc.setFontSize(36); 
                doc.setFont("helvetica", "bold"); // Police en gras
                const headerText = 'ETS ROCKY';
                const headerWidth = doc.getTextWidth(headerText);
                doc.text(headerText, 105 - headerWidth / 2, 15); 
    
                doc.setFontSize(12);
                doc.setFont("helvetica", "normal"); // Retour à la police normale
    
                
                let y = 25; // Position de départ réduite
                doc.setFontSize(14);
                doc.setFont("helvetica", "bold");
                doc.text('COMMERCE GENERAL, PRESTATION DE SERVICE, LIBRAIRIE PAPETERIE', 105, y, { align: 'center' }); 
                y += 7; // Réduire l'interligne
                doc.setFont("helvetica", "normal"); // Police normale
                doc.text('secrétariat bureautique, sis monté GMI n°8 ebolowa', 105, y, { align: 'center' }); 
                y += 7; // Réduire l'interligne
    
                doc.setFontSize(12); // Taille plus grande
                doc.setFont("helvetica", "bold");
                doc.text('CONTRIBUTABLE N°: P087312174798W; RC/EBW/2020/A/82', 105, y, { align: 'center' }); // Centrer
                y += 7; // Réduire l'interligne
    
                // Téléphone et Email
                doc.setFontSize(12);
                doc.setFont("helvetica", "normal");
                doc.text('Tel : 670 27 27 03 / 696 84 80 84 / E-mail : raymontegue02@yahoo.com', 105, y, { align: 'center' }); // Centrer
                y += 7; // Plus d'espace avant le trait
    
                // Trait horizontal
                doc.setDrawColor(0, 0, 0); 
                doc.setLineWidth(1.5); 
                doc.line(20, y, 190, y); 
                y += 10; 
    
                // Date et Numéro de la facture
                const currentDate = new Date().toLocaleDateString(); 
                doc.setFontSize(12);
                doc.setFont("helvetica", "normal");
                doc.text(`Ebolowa, le ${currentDate}`, 190, y, { align: 'right' }); 
                y += 10; // Plus d'espace avant le numéro de facture
                doc.text(`Facture N° ${invoiceNumber}`, 105, y, { align: 'center' }); 
                y += 20; 
            },
        });
    
        // Calculer le total général
        const totalGenerale = products.reduce((acc, product) => acc + product.price * product.quantity, 0);
    
        const finalY = doc.lastAutoTable.finalY + 7 ;
        doc.setFontSize(14);
        doc.setFont("helvetica", "bold");
        doc.setFillColor(34, 139, 34); 
        doc.setTextColor(255, 255, 255); 
        doc.rect(20, finalY, 170, 10, 'F'); 
        doc.text('TOTAL ', 25, finalY + 7);
        doc.text(`${totalGenerale.toFixed(2)} FCFA`, 185, finalY + 7, { align: 'right' }); 

        const amountInWords = numberToWords(totalGeneral);
        doc.setFontSize(12);
        doc.setFont("helvetica", "bold");
        doc.setTextColor(0, 0, 0); // Texte en noir
        doc.text(`Arrêté la présente facture à la somme de ${amountInWords} FCFA`, 20, finalY + 20);
    
        // Sauvegarder le PDF
        doc.save(`facture_${invoiceNumber}.pdf`);
    }
    
});