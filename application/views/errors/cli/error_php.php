<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

Um erro com o PHP foi encontrado.

Gravidade:    <?php echo $severity, "\n"; ?>
Mensagem:     <?php echo $message, "\n"; ?>
Arquivo:    <?php echo $filepath, "\n"; ?>
Linha: <?php echo $line; ?>

<?php if (defined('SHOW_DEBUG_BACKTRACE') && SHOW_DEBUG_BACKTRACE === TRUE): ?>

Backtrace:
<?php	foreach (debug_backtrace() as $error): ?>
<?php		if (isset($error['file']) && strpos($error['file'], realpath(BASEPATH)) !== 0): ?>
	Arquivo: <?php echo $error['file'], "\n"; ?>
	Linha: <?php echo $error['line'], "\n"; ?>
	Função: <?php echo $error['function'], "\n\n"; ?>
<?php		endif ?>
<?php	endforeach ?>

<?php endif ?>
