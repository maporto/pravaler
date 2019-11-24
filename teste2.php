<?php

$stdin = fopen('php://stdin', 'r');

function calculaVidaDoMaterial($massa)
{
    $tempo = 0;

    while ($massa >= 0.10) {
        $massa -= $massa / 100 * 25;
        $tempo += 30; 
    }

    return $tempo;
}

print("<DESAFIO/PRAVALER>\n\n");

print("Teste de Lógica 2.\n\n");

print("Digite a massa do material:");
fscanf($stdin, "%f", $massa);

$tempo = calculaVidaDoMaterial($massa);

print("\n-- Resultado --\n");
print("Um material de massa $massa demora $tempo segundos para ficar a baixo de  0.10\n");
?>