<!--main content start-->








<section id="saque" class="d-flex justify-content-center align-items-center py-5 mt-3 my-auto">
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-md-6 p-3">
        <div class="text-center position-relative d-flex align-items-center justify-content-center">
          <img src="<?php echo  base_url() ?>assets/template/images/arrow_orange.png" alt="flecha" class=" img-fluid position-absolute start-0" width="100">
          <h1 class="display-5 text-white fw-bold w-50">Tickets</h1>
        </div>
        <div class="content py-4 px-4 position-relative">

          <div class="detalle w-100 position-relative table-responsive">






            <form action="" method="post" class="form-horizontal form-variance">

              <div class="form-group ">
                <label class="col-sm-3 control-label">Subject</label>
                <div class="col-md-12 text-center">
                  <select name="assunto" class="form-control" required>
                    <option style="background: black;color: white" value="">Select the subject</option>
                    <option style="background: black;color: white" value="Finances">Finances</option>
                    <option style="background: black;color: white" value="Technical support">Technical support</option>
                    <option style="background: black;color: white" value="Registration">Registration</option>
                    <option style="background: black;color: white" value="Doubts">Doubts</option>
                    <option style="background: black;color: white" value="Others">Others</option>
                  </select>
                </div>
              </div>

              <div class="form-group mt-3">
                <label class="col-sm-3 control-label">Message</label>
                <div class="col-sm-12">
                  <textarea name="mensagem" class="form-control" cols="30" rows="5" required></textarea>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">&nbsp;</label>
                <div class="col-sm-12 mt-5">
                  <input type="submit" name="submit" class="btn btn-primario w-100" value="SEND">
                </div>
              </div>

            </form>






          </div>
        </div>

      </div>
    </div>
  </div>
</section>




<!--main content end-->