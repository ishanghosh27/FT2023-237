<?php

require_once('nav.php');

?>
<form method="POST" class="text-center" action="class/DataInsert.php" name="empform" id="empform">
  <div class="container">
    <div class="row mt-5">
      <div class="col-6">
        <div class="input-group flex-wrap my-2">
          <span class="input-group-text" id="addon-wrapping">Employee ID</span>
          <input type="text" name="id" class="form-control" aria-label="Username" aria-describedby="addon-wrapping">
        </div>
      </div>
      <div class="col-6">
        <div class="input-group flex-wrap my-2">
          <span class="input-group-text" id="addon-wrapping">Employee Code</span>
          <input type="text" name="code" class="form-control" aria-label="Username" aria-describedby="addon-wrapping">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-6">
        <div class="input-group flex-wrap my-2">
          <span class="input-group-text" id="addon-wrapping">Employee Code Name</span>
          <input type="text" name="codename" class="form-control" aria-label="Username" aria-describedby="addon-wrapping">
        </div>
      </div>
      <div class="col-6">
        <div class="input-group flex-wrap my-2">
          <span class="input-group-text" id="addon-wrapping">Employee Domain</span>
          <input type="text" name="domain" class="form-control" aria-label="Username" aria-describedby="addon-wrapping">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-6">
        <div class="input-group flex-wrap my-2">
          <span class="input-group-text" id="addon-wrapping">First Name</span>
          <input type="text" name="fname" class="form-control" aria-label="Username" aria-describedby="addon-wrapping">
        </div>
      </div>
      <div class="col-6">
        <div class="input-group flex-wrap my-2">
          <span class="input-group-text" id="addon-wrapping">Last Name</span>
          <input type="text" name="lname" class="form-control" aria-label="Username" aria-describedby="addon-wrapping">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-6">
        <div class="input-group my-3">
          <div class="input-group-prepend">
            <span class="input-group-text">Employee Salary</span>
          </div>
          <input type="text" class="form-control" name="salary" id="salary">
          <div class="input-group-append">
            <span class="input-group-text">k</span>
          </div>
        </div>
      </div>
      <div class="col-6">
        <div class="input-group my-3">
          <div class="input-group-prepend">
            <span class="input-group-text">Graduation Percentile</span>
          </div>
          <input type="text" class="form-control" name="grad" id="grad">
          <div class="input-group-append">
            <span class="input-group-text">%</span>
          </div>
        </div>
      </div>
    </div>
    <button type="submit" class="btn btn-dark btn-lg btn-block my-3" name="submit">Submit</button>
  </div>
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script src="js/script.js"></script>
</body>

</html>
