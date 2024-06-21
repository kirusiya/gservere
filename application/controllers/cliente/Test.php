<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Test extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

    }



   public function index()
    {


    //     $mensajes = array(
    //         'Titulo'     => 'Bienvenido a Metabiz',
    //         'Subtitulo'  => 'Eres parte de nuestra familia',
    //         'Mensaje'    => 'Gracias por formar parte de nuestra comunidad',
    //         'Footer'     => 'Revisa nuestras redes sociales',
    //         "Footer-msj" => 'Explora y encuentra todos los servicios que Metabiz te puede ofrecer: Meta-Games, Meta-NFT, Meta-Coin, etc.',
    //         "Url-Link"   => 'https://app.themetabiz.io/',
    //         "Btn-Link"   => 'GET START'
    //     );


    
    
    
            
    //  $mensagem =  '<!DOCTYPE html
    //         PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    //        <html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office"
    //         style="font-family:"Raleway", "helvetica neue", helvetica, arial, sans-serif">
           
    //        <head>
    //         <meta charset="UTF-8">
    //         <meta content="width=device-width, initial-scale=1" name="viewport">
    //         <meta name="x-apple-disable-message-reformatting">
    //         <meta http-equiv="X-UA-Compatible" content="IE=edge">
    //         <meta content="telephone=no" name="format-detection">
    //         <title>Nueva plantilla de correo electrC3B3nico 2022-06-26</title>
           
    //         <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,700,700i" rel="stylesheet">
    //         <link
    //           href="https://fonts.googleapis.com/css?family=Martel:200,300,400,600,700,800,900%7CRaleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i%7CRoboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i"
    //           rel="stylesheet">
           
    //         <style type="text/css">
    //         *{
    //            color:white !important;
    //         }
    //           #outlook a {
    //             padding: 0;
    //           }
           
    //           .es-button {
    //             mso-style-priority: 100 !important;
    //             text-decoration: none !important;
    //           }
           
    //           a[x-apple-data-detectors] {
    //             color: inherit !important;
    //             text-decoration: none !important;
    //             font-size: inherit !important;
    //             font-family: inherit !important;
    //             font-weight: inherit !important;
    //             line-height: inherit !important;
    //           }
           
    //           .es-desk-hidden {
    //             display: none;
    //             float: left;
    //             overflow: hidden;
    //             width: 0;
    //             max-height: 0;
    //             line-height: 0;
    //             mso-hide: all;
    //           }
           
    //           [data-ogsb] .es-button {
    //             border-width: 0 !important;
    //             padding: 15px 40px 15px 40px !important;
    //           }
           
    //           [data-ogsb] .es-button.es-button-1 {
    //             padding: 15px 40px !important;
    //           }
           
    //           @media only screen and (max-width:600px) {
           
    //             p,
    //             ul li,
    //             ol li,
    //             a {
    //               line-height: 150% !important
    //             }
           
    //             h1,
    //             h2,
    //             h3,
    //             h1 a,
    //             h2 a,
    //             h3 a {
    //               line-height: 120%
    //             }
           
    //             h1 {
    //               font-size: 25px !important;
    //               text-align: center
    //             }
           
    //             h2 {
    //               font-size: 26px !important;
    //               text-align: center
    //             }
           
    //             h3 {
    //               font-size: 20px !important;
    //               text-align: center
    //             }
           
    //             .es-header-body h1 a,
    //             .es-content-body h1 a,
    //             .es-footer-body h1 a {
    //               font-size: 30px !important
    //             }
           
    //             .es-header-body h2 a,
    //             .es-content-body h2 a,
    //             .es-footer-body h2 a {
    //               font-size: 26px !important
    //             }
           
    //             .es-header-body h3 a,
    //             .es-content-body h3 a,
    //             .es-footer-body h3 a {
    //               font-size: 20px !important
    //             }
           
    //             .es-menu td a {
    //               font-size: 12px !important
    //             }
           
    //             .es-header-body p,
    //             .es-header-body ul li,
    //             .es-header-body ol li,
    //             .es-header-body a {
    //               font-size: 16px !important
    //             }
           
    //             .es-content-body p,
    //             .es-content-body ul li,
    //             .es-content-body ol li,
    //             .es-content-body a {
    //               font-size: 16px !important
    //             }
           
    //             .es-footer-body p,
    //             .es-footer-body ul li,
    //             .es-footer-body ol li,
    //             .es-footer-body a {
    //               font-size: 16px !important
    //             }
           
    //             .es-infoblock p,
    //             .es-infoblock ul li,
    //             .es-infoblock ol li,
    //             .es-infoblock a {
    //               font-size: 12px !important
    //             }
           
    //             *[class="gmail-fix"] {
    //               display: none !important
    //             }
           
    //             .es-m-txt-c,
    //             .es-m-txt-c h1,
    //             .es-m-txt-c h2,
    //             .es-m-txt-c h3 {
    //               text-align: center !important
    //             }
           
    //             .es-m-txt-r,
    //             .es-m-txt-r h1,
    //             .es-m-txt-r h2,
    //             .es-m-txt-r h3 {
    //               text-align: right !important
    //             }
           
    //             .es-m-txt-l,
    //             .es-m-txt-l h1,
    //             .es-m-txt-l h2,
    //             .es-m-txt-l h3 {
    //               text-align: left !important
    //             }
           
    //             .es-m-txt-r img,
    //             .es-m-txt-c img,
    //             .es-m-txt-l img {
    //               display: inline !important
    //             }
           
    //             .es-button-border {
    //               display: block !important
    //             }
           
    //             a.es-button,
    //             button.es-button {
    //               font-size: 20px !important;
    //               display: block !important;
    //               border-left-width: 0px !important;
    //               border-right-width: 0px !important
    //             }
           
    //             .es-adaptive table,
    //             .es-left,
    //             .es-right {
    //               width: 100% !important
    //             }
           
    //             .es-content table,
    //             .es-header table,
    //             .es-footer table,
    //             .es-content,
    //             .es-footer,
    //             .es-header {
    //               width: 100% !important;
    //               max-width: 600px !important
    //             }
           
    //             .es-adapt-td {
    //               display: block !important;
    //               width: 100% !important
    //             }
           
    //             .adapt-img {
    //               width: 100% !important;
    //               height: auto !important
    //             }
           
    //             .es-m-p0 {
    //               padding: 0 !important
    //             }
           
    //             .es-m-p0r {
    //               padding-right: 0 !important
    //             }
           
    //             .es-m-p0l {
    //               padding-left: 0 !important
    //             }
           
    //             .es-m-p0t {
    //               padding-top: 0 !important
    //             }
           
    //             .es-m-p0b {
    //               padding-bottom: 0 !important
    //             }
           
    //             .es-m-p20b {
    //               padding-bottom: 20px !important
    //             }
           
    //             .es-mobile-hidden,
    //             .es-hidden {
    //               display: none !important
    //             }
           
    //             tr.es-desk-hidden,
    //             td.es-desk-hidden,
    //             table.es-desk-hidden {
    //               width: auto !important;
    //               overflow: visible !important;
    //               float: none !important;
    //               max-height: inherit !important;
    //               line-height: inherit !important
    //             }
           
    //             tr.es-desk-hidden {
    //               display: table-row !important
    //             }
           
    //             table.es-desk-hidden {
    //               display: table !important
    //             }
           
    //             td.es-desk-menu-hidden {
    //               display: table-cell !important
    //             }
           
    //             .es-menu td {
    //               width: 1% !important
    //             }
           
    //             table.es-table-not-adapt,
    //             .esd-block-html table {
    //               width: auto !important
    //             }
           
    //             table.es-social {
    //               display: inline-block !important
    //             }
           
    //             table.es-social td {
    //               display: inline-block !important
    //             }
           
    //             .es-m-p5 {
    //               padding: 5px !important
    //             }
           
    //             .es-m-p5t {
    //               padding-top: 5px !important
    //             }
           
    //             .es-m-p5b {
    //               padding-bottom: 5px !important
    //             }
           
    //             .es-m-p5r {
    //               padding-right: 5px !important
    //             }
           
    //             .es-m-p5l {
    //               padding-left: 5px !important
    //             }
           
    //             .es-m-p10 {
    //               padding: 10px !important
    //             }
           
    //             .es-m-p10t {
    //               padding-top: 10px !important
    //             }
           
    //             .es-m-p10b {
    //               padding-bottom: 10px !important
    //             }
           
    //             .es-m-p10r {
    //               padding-right: 10px !important
    //             }
           
    //             .es-m-p10l {
    //               padding-left: 10px !important
    //             }
           
    //             .es-m-p15 {
    //               padding: 15px !important
    //             }
           
    //             .es-m-p15t {
    //               padding-top: 15px !important
    //             }
           
    //             .es-m-p15b {
    //               padding-bottom: 15px !important
    //             }
           
    //             .es-m-p15r {
    //               padding-right: 15px !important
    //             }
           
    //             .es-m-p15l {
    //               padding-left: 15px !important
    //             }
           
    //             .es-m-p20 {
    //               padding: 20px !important
    //             }
           
    //             .es-m-p20t {
    //               padding-top: 20px !important
    //             }
           
    //             .es-m-p20r {
    //               padding-right: 20px !important
    //             }
           
    //             .es-m-p20l {
    //               padding-left: 20px !important
    //             }
           
    //             .es-m-p25 {
    //               padding: 25px !important
    //             }
           
    //             .es-m-p25t {
    //               padding-top: 25px !important
    //             }
           
    //             .es-m-p25b {
    //               padding-bottom: 25px !important
    //             }
           
    //             .es-m-p25r {
    //               padding-right: 25px !important
    //             }
           
    //             .es-m-p25l {
    //               padding-left: 25px !important
    //             }
           
    //             .es-m-p30 {
    //               padding: 30px !important
    //             }
           
    //             .es-m-p30t {
    //               padding-top: 30px !important
    //             }
           
    //             .es-m-p30b {
    //               padding-bottom: 30px !important
    //             }
           
    //             .es-m-p30r {
    //               padding-right: 30px !important
    //             }
           
    //             .es-m-p30l {
    //               padding-left: 30px !important
    //             }
           
    //             .es-m-p35 {
    //               padding: 35px !important
    //             }
           
    //             .es-m-p35t {
    //               padding-top: 35px !important
    //             }
           
    //             .es-m-p35b {
    //               padding-bottom: 35px !important
    //             }
           
    //             .es-m-p35r {
    //               padding-right: 35px !important
    //             }
           
    //             .es-m-p35l {
    //               padding-left: 35px !important
    //             }
           
    //             .es-m-p40 {
    //               padding: 40px !important
    //             }
           
    //             .es-m-p40t {
    //               padding-top: 40px !important
    //             }
           
    //             .es-m-p40b {
    //               padding-bottom: 40px !important
    //             }
           
    //             .es-m-p40r {
    //               padding-right: 40px !important
    //             }
           
    //             .es-m-p40l {
    //               padding-left: 40px !important
    //             }
           
    //             .es-desk-hidden {
    //               display: table-row !important;
    //               width: auto !important;
    //               overflow: visible !important;
    //               max-height: inherit !important
    //             }
           
    //             .h-auto {
    //               height: auto !important
    //             }
    //           }
    //         </style>
    //        </head>
           
    //        <body
    //         style="width:100%;font-family:"Raleway", "helvetica neue", helvetica, arial, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0">
    //         <div class="es-wrapper-color" style="background-color:#EFEFEF">
           
    //           <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0"
    //             style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;background-color:#EFEFEF">
    //             <tr>
    //               <td valign="top" style="padding:0;Margin:0">
    //                 <table cellpadding="0" cellspacing="0" class="es-content" align="center"
    //                   style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
    //                   <tr>
    //                     <td align="center"
    //                       style="padding:0;Margin:0;background-image:url(http://imgfz.com/i/36K8RxS.jpeg);background-repeat:no-repeat;background-position:left top"
    //                       background="http://imgfz.com/i/36K8RxS.jpeg">
    //                       <table class="es-content-body" align="center" cellpadding="0" cellspacing="0"
    //                         style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px">
    //                         <tr>
    //                           <td align="left" style="padding:0;Margin:0">
    //                             <table cellpadding="0" cellspacing="0" width="100%"
    //                               style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
    //                               <tr>
    //                                 <td align="center" valign="top" style="padding:0;Margin:0;width:600px">
    //                                   <table cellpadding="0" cellspacing="0" width="100%" role="presentation"
    //                                     style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
    //                                     <tr>
    //                                       <td align="center" class="es-m-p40r es-m-p40l"
    //                                         style="padding:0;Margin:0;padding-top:20px;font-size:0px"><a target="_blank"
    //                                           href="https://viewstripo.email"
    //                                           style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#2CB543;font-size:16px"><img
    //                                             class="adapt-img"
    //                                             src="https://jpcqbe.stripocdn.email/content/guids/CABINET_0bc6157fafad352735ad3c712c5c8f00/images/logometabizlarge.png"
    //                                             alt
    //                                             style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"
    //                                             width="250"></a></td>
    //                                     </tr>
    //                                     <tr>
    //                                       <td align="center" class="es-m-txt-c es-m-p10t"
    //                                         style="Margin:0;padding-top:20px;padding-bottom:20px;padding-left:30px;padding-right:30px">
    //                                         <h1
    //                                           style="color: white;Margin:0;line-height:46px;mso-line-height-rule:exactly;font-family:"Raleway", "marker felt-thin", arial, sans-serif;font-size:30px;font-style:normal;font-weight:bold;color:#ff6e00">
    //                                           ///  '. $mensajes['Titulo'].' ///</h1>
    //                                       </td>
    //                                     </tr>
    //                                   </table>
    //                                 </td>
    //                               </tr>
    //                             </table>
    //                           </td>
    //                         </tr>
    //                         <tr>
    //                           <td align="left" style="padding:0;Margin:0">
                                
    //                             <table cellpadding="0" cellspacing="0" class="es-left" align="left"
    //                               style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
    //                               <tr>
    //                                 <td class="es-m-p20b" align="left" style="padding:0;Margin:0;width:290px">
    //                                   <table cellpadding="0" cellspacing="0" width="100%" role="presentation"
    //                                     style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
    //                                     <tr>
    //                                       <td align="center" style="padding:0;Margin:0;font-size:0px"><img class="adapt-img"
    //                                           src="http://imgfz.com/i/MuOevrS.png" alt
    //                                           style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"
    //                                           width="290"></td>
    //                                     </tr>
    //                                   </table>
    //                                 </td>
    //                               </tr>
    //                             </table>
    //                             <table cellpadding="0" cellspacing="0" class="es-right" align="right"
    //                               style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
    //                               <tr>
    //                                 <td align="center" valign="top" style="padding:0;Margin:0;width:290px">
    //                                   <table cellpadding="0" cellspacing="0" width="100%" role="presentation"
    //                                     style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
    //                                     <tr>
    //                                       <td align="left" class="es-m-p10t"
    //                                         style="padding:0;Margin:0;padding-bottom:10px;padding-top:30px">
    //                                         <h2
    //                                           style="color: white;Margin:0;line-height:34px;mso-line-height-rule:exactly;font-family:"Raleway", "marker felt-thin", arial, sans-serif;font-size:28px;font-style:normal;font-weight:bold;color:#ffffff">
    //                                           '. $mensajes['Subtitulo'].'</h2>
    //                                       </td>
    //                                     </tr>
    //                                     <tr>
    //                                       <td align="left" class="es-m-txt-c" style="padding:0;Margin:0">
    //                                         <p
    //                                           style="color: white;Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:"Raleway", "helvetica neue", helvetica, arial, sans-serif;line-height:24px;color:#ffffff;font-size:16px">
    //                                           '. $mensajes['Mensaje'].'</p>
    //                                       </td>
    //                                     </tr>
    //                                   </table>
    //                                 </td>
    //                               </tr>
    //                             </table>
    //                           </td>
    //                         </tr>
    //                         <tr>
           
                    
    //                           <td align="left"
    //                             style="Margin:0;padding-left:20px;padding-right:20px;padding-top:30px;padding-bottom:30px">
    //                             <table cellpadding="0" cellspacing="0" width="100%"
    //                               style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
    //                               <tr>
    //                                 <td align="center" valign="top" style="padding:0;Margin:0;width:560px">
    //                                   <table cellpadding="0" cellspacing="0" width="100%" role="presentation"
    //                                     style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
    //                                     <tr>
    //                                       <td align="center" style="padding:0;Margin:0;padding-bottom:5px;padding-top:10px">
    //                                         <h2
    //                                           style="color: white;Margin:0;line-height:34px;mso-line-height-rule:exactly;font-family:"Raleway", "marker felt-thin", arial, sans-serif;font-size:28px;font-style:normal;font-weight:bold;color:#ffffff">
    //                                           '. $mensajes['Footer'].'</h2>
    //                                       </td>
    //                                     </tr>
    //                                     <tr>
    //                                       <td align="center" style="color: white;padding:0;Margin:0;padding-top:5px;padding-bottom:5px">
    //                                         <p
    //                                         '. $mensajes['Footer-msj'].'</p>
    //                                       </td>
    //                                     </tr>
    //                                     <tr>
    //                                       <td align="center" class="es-m-txt-c"
    //                                         style="padding:0;Margin:0;padding-top:5px;padding-bottom:30px"><span
    //                                           class="es-button-border"
    //                                           style="border-style:solid;border-color:#2CB543;background:#ff6e00;border-width:0px;display:inline-block;border-radius:12px;width:auto"><a
    //                                             href="https://metabizfinal.netlify.app" class="es-button es-button-1"
    //                                             target="_blank"
    //                                             style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;color:#FFFFFF;font-size:20px;border-style:solid;border-color:#ff6e00;border-width:15px 40px;display:inline-block;background:#ff6e00;border-radius:12px;font-family:arial, "helvetica neue", helvetica, sans-serif;font-weight:bold;font-style:normal;line-height:24px;width:auto;text-align:center">Iniciemos</a></span>
    //                                       </td>
    //                                     </tr>
    //                                     <tr>
    //                                       <td align="center"
    //                                         style="padding:0;Margin:0;padding-top:10px;padding-bottom:20px;font-size:0px"><img
    //                                           src="https://jpcqbe.stripocdn.email/content/guids/CABINET_0bc6157fafad352735ad3c712c5c8f00/images/logometabizlarge.png"
    //                                           alt
    //                                           style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"
    //                                           width="150"></td>
    //                                     </tr>
    //                                     <tr>
    //                                       <td align="center" style="padding:0;Margin:0;font-size:0">
    //                                         <table cellpadding="0" cellspacing="0" class="es-table-not-adapt es-social"
    //                                           role="presentation"
    //                                           style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
    //                                           <tr>
    //                                             <td align="center" valign="top" style="padding:0;Margin:0;padding-right:10px"><img
    //                                                 title="Facebook"
    //                                                 src="https://jpcqbe.stripocdn.email/content/assets/img/social-icons/circle-colored/facebook-circle-colored.png"
    //                                                 alt="Fb" height="32"
    //                                                 style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic">
    //                                             </td>
    //                                             <td align="center" valign="top" style="padding:0;Margin:0;padding-right:10px"><img
    //                                                 title="Twitter"
    //                                                 src="https://jpcqbe.stripocdn.email/content/assets/img/social-icons/circle-colored/twitter-circle-colored.png"
    //                                                 alt="Tw" height="32"
    //                                                 style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic">
    //                                             </td>
    //                                             <td align="center" valign="top" style="padding:0;Margin:0;padding-right:10px"><img
    //                                                 title="Instagram"
    //                                                 src="https://jpcqbe.stripocdn.email/content/assets/img/social-icons/circle-colored/instagram-circle-colored.png"
    //                                                 alt="Inst" height="32"
    //                                                 style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic">
    //                                             </td>
    //                                             <td align="center" valign="top" style="padding:0;Margin:0"><img title="Youtube"
    //                                                 src="https://jpcqbe.stripocdn.email/content/assets/img/social-icons/circle-colored/youtube-circle-colored.png"
    //                                                 alt="Yt" height="32"
    //                                                 style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic">
    //                                             </td>
    //                                           </tr>
    //                                         </table>
    //                                       </td>
    //                                     </tr>
    //                                   </table>
    //                                 </td>
    //                               </tr>
    //                             </table>
    //                           </td>
    //                         </tr>
    //                       </table>
    //                     </td>
    //                   </tr>
    //                 </table>
    //               </td>
    //             </tr>
    //           </table>
    //         </div>
    //        </body>
           
    //  </html>';
            
    
    
    
    
     $this->template->load('cliente/templates/template', 'cliente/test');
    }
}
