// logique div total panier row dans commande.html, répéter les éléments du panier:

const nombreDeBilletsAchetes = 0;

const panier = document.getElementsByClassName("panier");
    for (let i = 0; i < nombreDeBilletsAchetes; i++) {
        const panierItemDiv = document.createElement("div");
        panierItemDiv.className = "total panier-row";

        const panierItemP = document.createElement("p");
        panierItemP.className = "panier-item";
        panierItemP.textContent = "Blablabalablaba - 35€";

        const montantTotalP = document.createElement("p");
        montantTotalP.innerHTML = `<strong>Montant total :</strong> le montant total`;

        panierItemDiv.appendChild(panierItemP);
        panierItemDiv.appendChild(montantTotalP);

        panier.appendChild(panierItemDiv);
}