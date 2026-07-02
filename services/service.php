<?php

function saisie(string $message):string{
    return readline($message);
}

function genererReference(array $products):string{
    $taille=count($products)+1;

    if($taille<=9){
        $ref="REF00";
    }elseif($taille<=99){
        $ref="REF0";
    }else{
        $ref="REF";
    }

    return $ref.$taille;
}
function showError(array $errors){
    foreach($errors as $errorField){
        foreach($errorField as $error)
            echo "$error \n";
    }
}

function required(string $value,array &$errors,string $errorRequired,string $fieledName="libele"):void{

   if(empty($value)){
        $errors[$fieledName]['required']=$errorRequired;
   }
}

function unique(array $datas,string $value,array &$errors,string $errorUnique,string $key='libele'):void{

    foreach($datas as $data){
        if($data[$key]===$value){
            $errors[$key]['unique']=$errorUnique;
        }
    }
}