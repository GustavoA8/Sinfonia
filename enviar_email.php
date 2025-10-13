<?php
// --- Configuração ---
$destinatario = "contato@sinfoniaimusicais.com"; // seu e-mail de destino
$assunto = "Solicitação de Manutenção";

// --- Pega os dados do formulário ---
$email = $_POST['email'] ?? '';
$celular = $_POST['cell'] ?? '';
$mensagem = $_POST['text'] ?? '';

// --- Monta o corpo do e-mail ---
$corpo = "
<h2>Nova solicitação de manutenção</h2>
<p><strong>Email:</strong> {$email}</p>
<p><strong>Celular:</strong> {$celular}</p>
<p><strong>Mensagem:</strong><br>{$mensagem}</p>
";

// --- Cabeçalhos do e-mail ---
$cabecalhos  = "MIME-Version: 1.0\r\n";
$cabecalhos .= "Content-type: text/html; charset=UTF-8\r\n";
$cabecalhos .= "From: {$email}\r\n";

// --- Envia ---
if (mail($destinatario, $assunto, $corpo, $cabecalhos)) {
    echo "<script>alert('Mensagem enviada com sucesso!'); window.location.href='manutencao.html';</script>";
} else {
    echo "<script>alert('Erro ao enviar o e-mail. Tente novamente.'); window.history.back();</script>";
}
?>
