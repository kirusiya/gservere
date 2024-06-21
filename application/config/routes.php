<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'website';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/* Controllers Cliente */
$route['dashboard'] = 'cliente/dashboard';
$route['career'] = 'cliente/carreira';
$route['chave'] = 'cliente/chave';
$route['bill'] = 'cliente/comprovante';
$route['login'] = 'cliente/conta/login';
$route['logout'] = 'cliente/conta/logout';
$route['login/wallet-login'] = 'cliente/conta/mostrarcuentas';//beto
$route['settings'] = 'cliente/dashboard/configuracoes';
// $route['cadastrar/(:any)'] = 'cliente/conta/cadastrar/$1';
// $route['cadastrar'] = 'cliente/conta/cadastrar';

//coinbase
$route['checkout/(:num)'] = 'cliente/comprovante/checkout/$1';
$route['payment-handler'] = 'cliente/comprovante/payment';

$route['register/(:any)'] = 'cliente/conta/cadastrar/$1'; //Pedro 02_07_2022
$route['register'] = 'cliente/conta/cadastrar';  //Pedro 02_07_2022


//$route['registernew123/(:any)'] = 'cliente/conta/cadastrar/$1'; //ocultar registro
//$route['registernew123'] = 'cliente/conta/cadastrar';  //ocultar registro

//Christopher Flores
$route['two-factor-authentication'] = "website/twoFactor";
$route['valid-twofactor'] = "website/validTwoFactor";
$route['active-twofactor'] = "cliente/dashboard/activeTwoFactor";
//Christopher Flores

##### activacion #####
$route['activation'] = 'cliente/conta/activation';  //Jimmy Villegas 08_07_2022
##### activacion ##### 

$route['recover/(:any)'] = 'cliente/conta/recuperar_senha/$1';//edward 2022-07-07
$route['recover'] = 'cliente/conta/recuperar_senha';//edward 2022-07-07


$route['reports'] = 'cliente/extrato';
$route['invoices'] = 'cliente/faturas';
$route['payment'] = 'cliente/pagamento';
$route['pay'] = 'cliente/pay/pay';
$route['pending'] = 'cliente/pendentes';
$route['plans/comprar/(:num)'] = 'cliente/planos/comprar/$1';
$route['plans'] = 'cliente/planos';
$route['pontos'] = 'cliente/pontos';
$route['network'] = 'cliente/rede';  //Pedro 02_07_2022
$route['withdraw'] = 'cliente/saque';
$route['ticket/abrir'] = 'cliente/ticket/abrir';
$route['ticket/visualizar/(:num)'] = 'cliente/ticket/visualizar/$1';
$route['ticket/fechar/(:num)'] = 'cliente/ticket/fechar/$1';
$route['ticket'] = 'cliente/ticket';
$route['test'] = 'cliente/test';


$route['packages'] = 'cliente/packages';

/* Controllers Administrador */
$route['admin'] = 'admin/dashboard';
$route['admin/login'] = 'admin/conta/login';
$route['admin/logout'] = 'admin/conta/logout';
$route['admin/saques/visualizar/(:num)'] = 'admin/saques/visualizar/$1';
$route['admin/saques'] = 'admin/saques';
$route['admin/deposito/adicionar'] = 'admin/deposito/adicionar';
$route['admin/deposito/editar/(:num)'] = 'admin/deposito/editar/$1';
$route['admin/deposito/excluir/(:num)'] = 'admin/deposito/excluir/$1';
$route['admin/deposito'] = 'admin/deposito';

$route['admin/faturas/liberar/(:num)'] = 'admin/faturas/liberar/$1';

$route['admin/faturas/liberar'] = 'admin/faturas/liberar'; 


$route['admin/faturas/liberadas'] = 'admin/faturas/liberadas';
$route['admin/faturas/pendentes'] = 'admin/faturas/pendentes';
$route['admin/planos/adicionar'] = 'admin/planos/adicionar';
$route['admin/planos/editar/(:num)'] = 'admin/planos/editar/$1';
$route['admin/planos/excluir/(:num)'] = 'admin/planos/excluir/$1';
$route['admin/planos'] = 'admin/planos';
$route['admin/carreira/adicionar'] = 'admin/carreira/adicionar';
$route['admin/carreira/editar/(:num)'] = 'admin/carreira/editar/$1';
$route['admin/carreira/excluir/(:num)'] = 'admin/carreira/excluir/$1';
$route['admin/carreira'] = 'admin/carreira';
$route['admin/niveis/adicionar'] = 'admin/niveis/adicionar';
$route['admin/niveis/editar/(:num)'] = 'admin/niveis/editar/$1';
$route['admin/niveis/excluir/(:num)'] = 'admin/niveis/excluir/$1';
$route['admin/niveis'] = 'admin/niveis';
$route['admin/usuarios/visualizar/(:num)'] = 'admin/usuarios/visualizar/$1';
$route['admin/usuarios/excluir/(:num)'] = 'admin/usuarios/excluir/$1';
$route['admin/usuarios'] = 'admin/usuarios';
$route['admin/tickets/fechar/(:num)'] = 'admin/tickets/fechar/$1';
$route['admin/tickets/visualizar/(:num)'] = 'admin/tickets/visualizar/$1';
$route['admin/tickets'] = 'admin/tickets';
$route['admin/notificacoes'] = 'admin/notificacoes';
$route['admin/notificacoes/admin'] = 'admin/notificacoes/admin';
$route['admin/configuracoes/site'] = 'admin/configuracoes/site';
$route['admin/configuracoes/email'] = 'admin/configuracoes/email';
$route['admin/configuracoes/financeira'] = 'admin/configuracoes/financeira';

$route['admin/uploadqr'] = 'admin/uploadqr';//diego
$route['admin/uploadqr/adicionar'] = 'admin/uploadqr/adicionar';//diego
$route['admin/uploadqr/editar/(:num)'] = 'admin/uploadqr/editar/$1';//diego
$route['admin/uploadqr/excluir/(:num)'] = 'admin/uploadqr/excluir/$1';//diego

$route['admin/addplan'] = 'admin/addplan';//diego
$route['admin/addplan/adicionarPlan/(:num)'] = 'admin/addplan/adicionarPlan/$1';//diego


$route['admin/rangos/calcular'] = 'admin/rangos/calcular';//diego
$route['admin/puntos'] = 'admin/puntos';//diego
$route['admin/usuarios/bloquear/(:num)'] = 'admin/usuarios/bloquear/$1'; //DIEGO 
$route['admin/usuarios/desbloquear/(:num)'] = 'admin/usuarios/desbloquear/$1'; //DIEGO 
$route['admin/qualified'] = 'admin/qualified';//diego
$route['admin/qualified/editar/(:num)'] = 'admin/qualified/editar/$1';//diego

$route['admin/puntos/verPuntosUsuario/(:num)'] = 'admin/puntos/verPuntosUsuario/$1';//diego
