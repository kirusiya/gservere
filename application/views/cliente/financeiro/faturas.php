<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
   <!--begin::Toolbar wrapper-->
   <div class="d-flex flex-grow-1 flex-stack flex-wrap gap-2" id="kt_toolbar">
      <!--begin::Page title-->
      <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
         <!--begin::Title-->
         <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Section: Invoices</h1>
         <!--end::Title-->
         <!--begin::Breadcrumb-->
         <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">
               <a href="<?php echo base_url('dashboard'); ?>" class="text-muted text-hover-primary">Home</a>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item">
               <span class="bullet bg-gray-500 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">Invoices</li>
            <!--end::Item-->
            
         </ul>
         <!--end::Breadcrumb-->
      </div>
      <!--end::Page title-->
      
      
   </div>
   <!--end::Toolbar wrapper-->
</div>
<!--end::Toolbar-->
<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">

   <!--begin::Row-->
   <div class="row g-5 g-xl-10">
      
      <!--begin::Col-->
      <div class="col-xl-12 mb-5 mb-xl-10">
         <!--begin::Timeline Widget 1-->
         <div class="card card-flush h-xl-100">
            <!--begin::Card header-->
            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
               <!--begin::Card title-->
               <h3 class="card-title align-items-start flex-column">
                  <span class="card-label fw-bold text-gray-900">My Invoices</span>
               </h3>
               <!--end::Card title-->
               <!--begin::Card title-->
                <div class="card-title">
                    <!--begin::Search-->
                    <div class="d-flex align-items-center position-relative my-1">
                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <input type="text" data-kt-ecommerce-category-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Search..." />
                    </div>
                    <!--end::Search-->
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pb-0">
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5 dataTablesHome" id="dataTablesHome">
                        <thead>
                          <th># Invoices</th>
                          <th>Plan</th>
                          <th>Price (USD)</th>
                          <!--<th>Check on Etherscan</th>-->
                          <th>State</th>
                          <th>Voucher</th>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                            
                          <?php

                          if ($faturas !== false) {

                            foreach ($faturas as $fatura) {

                          ?>
                              <tr>
                                <td>#<?php echo $fatura->id_fatura; ?></td>
                                <td><?php echo $fatura->nome; ?></td>
                                <td id="priceUsd">
                                  <p><?php echo $fatura->valor; ?></p>
                                </td>

                                <!--<td id="comprobanteInvoice">
                                <?php $comprobante = $fatura->comprovante; ?>

                                <a href="https://etherscan.io/tx/<?php //echo $comprobante?>" target="_blank">
                                <?php //echo $comprobante?>	
                                </a>	
                                </td>-->	

                                <td><span class="label v label-mini"><?php echo ($fatura->status == 0) ? 'Pending' : 'Released'; ?></span></td>

                                <td>
                                  <?php echo ($fatura->comprovante == '') ? '<button class="badge btn-primario" onclick="send(' . number_format($fatura->valor) . ')">MAKE THE PAYMENT</button>' : 'Confirmed payment'; ?>
                                </td>
                              </tr>
                          <?php
                            }
                          }
                          ?>

                            
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->

                </div>


            </div>
            <!--end::Card body-->
         </div>
         <!--end::Timeline Widget 1-->
      </div>
      <!--end::Col-->
   </div>
   <!--end::Row-->

</div>
<!--begin::Content-->




<!--main content start-->

<?php
//redirect('plans');
?>



<script src="https://cdn.ethers.io/lib/ethers-5.2.umd.min.js" type="application/javascript"></script>

<script src="https://unpkg.com/@metamask/detect-provider/dist/detect-provider.min.js"></script>







<?php

$url = "https://min-api.cryptocompare.com/data/price?fsym=USD&tsyms=ETH&api_key=2d7ace049cf4f13f3468b8e80e5b1ab8c7d7bf50abec7178570402e1e10445ba";
$data = json_decode(file_get_contents($url), true);
$latest_price = $data['ETH'];

?>
<input type="hidden" id="latestPrice-ETH" value="<?php echo $latest_price; ?>">

<?php
$url = "https://min-api.cryptocompare.com/data/price?fsym=USD&tsyms=BNB&api_key=2d7ace049cf4f13f3468b8e80e5b1ab8c7d7bf50abec7178570402e1e10445ba";
$data = json_decode(file_get_contents($url), true);
$latest_price = $data['BNB'];
?>
<input type="hidden" id="latestPrice-BNB" value="<?php echo $latest_price; ?>">

<script>
/*	
	
  async function connectWallet() {
    accounts = await window.ethereum.request({
      method: "eth_requestAccounts"
    }).catch((err) => {

      console.log(err.code);
      console.log(err.message);
      var msj = document.getElementById('msj');
      msj.innerHTML = err.message;
    });
    $('#cpf').val(accounts[0]);
    // console.log(accounts);
  }




  connectWallet();
  window.onload = function() {
    if (window.ethereum !== "undefined") {
      this.ethereum.on("accountsChanged", handleAccountsChanged)
    }
  }


  let accounts;

  const handleAccountsChanged = (a) => {
    accounts = a;
    // $('#cpf').val(accounts[0]);

  }













  async function ethTestnetNetwork() {
    try {
      await ethereum.request({
        method: 'wallet_switchEthereumChain',
        params: [{
          chainId: '0x4'
        }], // Hexadecimal version of 80001, prefixed with 0x
      });
    } catch (error) {
      if (error.code === 4902) {
        try {
          await ethereum.request({
            method: 'wallet_addEthereumChain',
            params: [{
              chainId: '0x4', // Hexadecimal version of 80001, prefixed with 0x
              chainName: "homestead",
              nativeCurrency: {
                name: "ETH",
                symbol: "ETH",
                decimals: 18,
              },
              rpcUrls: ["https://mainnet.infura.io/v3/9aa3d95b3bc440fa88ea12eaa4456161"],
              blockExplorerUrls: ["https://etherscan.io"],
              iconUrls: [""],

            }],
          });
        } catch (addError) {
          console.log('Did not add network');
        }
      }
    }
  }
  ethTestnetNetwork();





  async function send(valor) {



    let priceEth = document.getElementById('latestPrice-ETH').value;

    let resultado = priceEth * valor;


    const weiValue = resultado.toString();
    const ethValue = ethers.utils.parseEther(weiValue);
    let price = ethers.utils.hexlify(ethValue)






    let params = [{
      "from": accounts[0],
      "to": "0x63788f7F4D6a2c5d0A1fdb0E4977cdfF9C365004",
      "value": price,

    }]

    let result = await window.ethereum.request({
        method: "eth_sendTransaction",
        params


      })
      .then((txHash) =>


        $.ajax({
          type: "post",
          url: "<?php //echo  base_url() ?>pay",
          data: {
            "hash": txHash
          },

          success: function(response) {
            window.location.reload();
          }
        })


      )
      .catch((err) => {

        console.log(err.code);
      });


  }*/
</script>