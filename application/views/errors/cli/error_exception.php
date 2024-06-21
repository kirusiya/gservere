<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

Uma excessão foi encontrada

Tipo:        <?php echo get_class($exception), "\n"; ?>
Mensagem:     <?php echo $message, "\n"; ?>
Arquivo:    <?php echo $exception->getFile(), "\n"; ?>
Linha: <?php echo $exception->getLine(); ?>

<?php if (defined('SHOW_DEBUG_BACKTRACE') && SHOW_DEBUG_BACKTRACE === TRUE): ?>

Backtrace:
<?php	foreach ($exception->getTrace() as $error): ?>
<?php		if (isset($error['file']) && strpos($error['file'], realpath(BASEPATH)) !== 0): ?>
	Arquivo: <?php echo $error['file'], "\n"; ?>
	Linha: <?php echo $error['line'], "\n"; ?>
	Função: <?php echo $error['function'], "\n\n"; ?>
<?php		endif ?>
<?php	endforeach ?>

<?php endif ?>
