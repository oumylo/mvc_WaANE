<?php

function saveProduct(){
    global $products;

    do {
        $errors = [];
        $libelle = saisie("Entrez le libellé: ");

        required($libelle,$errors,"Le libellé est obligatoire");
        unique($products,$libelle,$errors,"Ce libellé existe déjà");

        showError($errors);

    } while (count($errors)!= 0);

    $newProduct=[
        "ref"=>genererReference($products),
        "libele" => $libelle,
    ];

    $products[] = $newProduct;
    var_dump($products);
}

function genererReference( array $products):string{
    $taille=count($products)+1;
     if($taille<=9){
        $ref="REF00";
    }elseif ($taille<=99){
        $ref="REF0";
    }else{
        $ref="REF";
    }
    return $ref.$taille;
}

function getProductByLibele (array $products, string $value): int{
    foreach ($products as $index => $product) {
        if ($product["libele"] == $value){
            return $index;
        }
    }
    return -1 ;
}

function supprimerProduit (int $index, array &$products): array {
    return array_splice($products, $index, 1)[0];
}

function listerProduits(array $products) : void {
    foreach ($products as $product){
        echo "Libellé: {$product["libele"]}\n";
    }
}

function archiverProduit (): void {
    global $productsArchived , $products;

    $value = saisie ("Veuillez renseigner le libellé \n");
    $indexArchived = getProductByLibele($products, $value);

    if ($indexArchived !== -1){
        $productArchived = supprimerProduit($indexArchived, $products);
        $productsArchived[] = $productArchived;
    } else {
        echo "Produit non trouvé";
    }
}