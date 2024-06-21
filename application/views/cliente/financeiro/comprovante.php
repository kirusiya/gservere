<?php

if(isset($_GET['product']) and $_GET['product']!=""){
	
	$id_plan = $_GET['product'];
	
	
	$datoPlan = userPlan($id_plan);
	
	$nombrePlan = $datoPlan[0]->nome;
	$pricePlan = number_format($datoPlan[0]->valor, 2, ",", ".");
	
	
}else{
	
	redirect('plans');
	
}

?>

<style>

.gallery-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    background-color: transparent;
    box-shadow: 0 0 3px 0 rgba(0, 0, 0, 0.3);
    width: 80%;
    margin: 0 auto;
    padding: 10px;
}
.gallery-item {
    flex-basis: 32.7%;
    margin-bottom: 6px;
    opacity: .85;
    cursor: pointer;
}
.gallery-item:hover {
    opacity: 1;
}
.gallery-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.gallery-content {
    font-size: .8em;
}

.lightbox {
    position: fixed;
    display: none;
    background-color: rgba(0, 0, 0, 0.8);
    width: 100%;
    height: 100%;              
    overflow: auto;
    top: 0;
    left: 0;
	z-index:99;
}
.lightbox-content {
    position: relative;
    width: 70%;
    height: 70%;
    margin: 5% auto;
}
.lightbox-content img {
    border-radius: 7px;
    /*box-shadow: 0 0 3px 0 rgba(225, 225, 225, .25);*/
    width: 100%;
    height: auto;
    object-fit: contain;
    max-height: 500px;
}
.lightbox-prev,
.lightbox-next {
    position: absolute;
    background-color: rgba(0, 0, 0, 0.8);
    color: #fff;
    padding: 7px;
    top: 45%;
    cursor: pointer;
}
.lightbox-prev {
    left: 0;
}
.lightbox-next {
    right: 0;
}
.lightbox-prev:hover,
.lightbox-next:hover {
    opacity: .8;
}

@media (max-width: 767px) {
    .gallery-container {
        width: 100%;
    }
    .gallery-item {
        flex-basis: 49.80%;
        margin-bottom: 3px;
		padding: 3px;
    }
    .lightbox-content {
        width: 80%;
        height: 60%;
        margin: 15% auto;
    }
	
	.lightbox-content img {
		max-height: 400px;
	}
	
	
}
@media (max-width: 480px) {
    .gallery-item {
        flex-basis: 49.80%;
        margin-bottom: 1px;
    }
    .lightbox-content {
        width: 90%;
        margin: 20% auto;
    }
	
	.lightbox-content img {
		max-height: 350px;
	}
	
}

</style>

<!--main content start-->
<section id="saque" class="d-flex justify-content-center align-items-center py-5 mt-3 my-auto">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-md-12 p-3">
                <div class="text-center position-relative d-flex align-items-center justify-content-center">
                    <img src="<?php echo base_url(); ?>/assets/template/images/arrow_orange.png" alt="flecha" class=" img-fluid position-absolute start-0" width="100">
                    <h1 class="display-5 text-white fw-bold w-50">Bill Form</h1>
                </div>
                <div id="msj" class="alert alert-bg-danger"></div>
				
                <div class="content py-4 px-4 position-relative">
                    
					
                    <div class="detalle w-100 position-relative  ">
                  	
						<?php if (isset($message)) echo $message; ?><br>
						
						<p><b>Instrucciones</b></p>
						  <p>Envie 2 imagenes como estan abajo para comprobar y verificar su pago.<br>Haga click en las imagenes para agrandarlas</p>
						
						<!--== instrucciones imagenes ==-->

<div class="gallery-container">
	
    <div class="gallery-item" data-index="1">
        <img src="<?php echo base_url();?>/assets/imgs/comprobante1.jpg">
    </div>
	
    <div class="gallery-item" data-index="2">
        <img src="<?php echo base_url();?>/assets/imgs/comprobante2.jpg">
    </div>
	
    
	
</div>




						
						
						
						
						<!--== instrucciones imagenes ==-->
						
						
						
						
						<form action="" method="post" class="form-horizontal form-variance" enctype="multipart/form-data">
                          
                          	
							
							
							
							<div class="row mt-5">
								
								
								<!--== Plan form submit ==-->
								<div class="col-sm-6 formInputs text-start">
									
									<div class="form-group">

											<div class="mb-4  mt-3">
											  <label>Plan Name and Price</label>	
											  <input type="text" id="name_plan" name="name_plan" class="form-control u-rounded " value="<?php echo $nombrePlan." | Price in USD: ".$pricePlan;?>" disabled> 
												
											  <input type="hidden" name="id_plan" value="<?php echo $id_plan; ?>" required> 	
												
											</div>
										
											<div class="mb-4  mt-3">
												<label>Crypto Payed</label>
												<select name="coin"  class="timeSaque form-control u-rounded " required>
					
													<option value="usdt">Tether USDT (Red TRC20)</option>	

												</select>
											</div>
										
											<!--<div class="mb-4  mt-3">
											  <label>Txt Hash</label>	
											  <input type="text" id="hashtxt" name="hashtxt" class="form-control u-rounded " >
											</div>-->
										
											<input type="hidden" id="hashtxt" name="hashtxt" class="form-control u-rounded " >

											<div class="mb-4  mt-3">
												<label>Bill Picture No 1</label>
												<input class="form-control u-rounded" type="file" name="comprovante" required>
											</div>
										
											<div class="mb-4  mt-3">
												<label>Bill Picture No 2</label>
												<input class="form-control u-rounded" type="file" name="comprovante2" required>
											</div>
										
									</div>

									<div class="form-group">
											 
											<div class="mt-2">
												<input type="submit" name="submit" class="btn btn-primario" value="Send Plan Bill">
											</div>
									</div>
									
								</div>	
								
								
								<!--== Plan form submit ==-->
								
								
								
								<!--== qr and address ==-->
								<div class="col-sm-6 qrImage pt-3">
									
									
									<img src="<?php echo base_url(); ?>assets/imgs/qr-new.jpg" class="img-fluid mb-3">
									
									
									<input class="form-control u-rounded mb-3 text-center" type="text" id="valueQR" name="valueQR" value="TEUvUUQEoUbT3D68Sj3QcduYmJzzCkBEb4">
									
									<button class="btn btn-primario mb-3" onclick="kopiraj()" id="copiarQR" type="button"><i class="far fa-clone"></i> Copy Wallet</button>
								
									
									<div class="alert alert-success qrSuccess mt-20" style="display: none;" >

									  <strong><i class="fas fa-thumbs-up"></i> Wallet Copied!</strong>

									</div>
									
									
									
								</div>
								<!--== qr and address ==-->
							
							
							</div>
							
							 
							

                          
                    
                         
                        </form>



                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


<script>

const galleryItem = document.getElementsByClassName("gallery-item");
const lightBoxContainer = document.createElement("div");
const lightBoxContent = document.createElement("div");
const lightBoxImg = document.createElement("img");
const lightBoxPrev = document.createElement("div");
const lightBoxNext = document.createElement("div");

lightBoxContainer.classList.add("lightbox");
lightBoxContent.classList.add("lightbox-content");
lightBoxPrev.classList.add("fa", "fa-angle-left", "lightbox-prev");
lightBoxNext.classList.add("fa", "fa-angle-right", "lightbox-next");

lightBoxContainer.appendChild(lightBoxContent);
lightBoxContent.appendChild(lightBoxImg);
lightBoxContent.appendChild(lightBoxPrev);
lightBoxContent.appendChild(lightBoxNext);

document.body.appendChild(lightBoxContainer);

let index = 1;

function showLightBox(n) {
    if (n > galleryItem.length) {
        index = 1;
    } else if (n < 1) {
        index = galleryItem.length;
    }
    let imageLocation = galleryItem[index-1].children[0].getAttribute("src");
    lightBoxImg.setAttribute("src", imageLocation);
}

function currentImage() {
    lightBoxContainer.style.display = "block";

    let imageIndex = parseInt(this.getAttribute("data-index"));
    showLightBox(index = imageIndex);
}
for (let i = 0; i < galleryItem.length; i++) {
    galleryItem[i].addEventListener("click", currentImage);
}

function slideImage(n) {
    showLightBox(index += n);
}
function prevImage() {
    slideImage(-1);
}
function nextImage() {
    slideImage(1);
}
lightBoxPrev.addEventListener("click", prevImage);
lightBoxNext.addEventListener("click", nextImage);

function closeLightBox() {
    if (this === event.target) {
        lightBoxContainer.style.display = "none";
    }
}
lightBoxContainer.addEventListener("click", closeLightBox);
</script>

 






