<?php

$stdin = fopen('php://stdin', 'r');

function calculaDesconto($quantidade)
{
    if ($quantidade <= 5) {
        return 2;
    } else if ($quantidade > 5 && $quantidade <= 10) {
        return 3;
    } else {
        return 5;
    }
}

print("<DESAFIO/PRAVALER>\n\n");

print("Teste de Lógica 1.\n\n");

print("Digite o nome do produto:");
fscanf($stdin, "%s", $nome);

print("Digite a quantidade:");
fscanf($stdin, "%d", $quantidade);

print("Digite o preço unitário:");
fscanf($stdin, "%f", $preco);

$total = $preco * $quantidade;
$desconto = calculaDesconto($quantidade);
$totalPagar = $total - ($total / 100 * $desconto);

print("\n-- Resultado --\n");
print("Total -> R$$total \n");
print("Desconto -> $desconto% \n");
print("Total a Pagar -> R$$totalPagar \n");

?>