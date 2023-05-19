<?php

  require_once('nav.php');

?>
  <form method="POST" class="text-center" action="class/InsertData.php">
    <div class="container">
      <div class="input-group flex-wrap mt-5 mb-2">
        <span class="input-group-text" id="addon-wrapping">Venue</span>
        <input type="text" name="venue" class="form-control" aria-label="Username" aria-describedby="addon-wrapping">
      </div>
      <div class="row">
        <div class="col-6">
          <div class="input-group flex-wrap my-2">
            <span class="input-group-text" id="addon-wrapping">First Team</span>
            <input type="text" name="team1" class="form-control" aria-label="Username" aria-describedby="addon-wrapping">
          </div>
        </div>
        <div class="col-6">
          <div class="input-group flex-wrap my-2">
            <span class="input-group-text" id="addon-wrapping">Second Team</span>
            <input type="text" name="team2" class="form-control" aria-label="Username" aria-describedby="addon-wrapping">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <div class="input-group flex-wrap my-2">
            <span class="input-group-text" id="addon-wrapping">Captain Of First Team</span>
            <input type="text" name="cap1" class="form-control" aria-label="Username" aria-describedby="addon-wrapping">
          </div>
        </div>
        <div class="col-6">
          <div class="input-group flex-wrap my-2">
            <span class="input-group-text" id="addon-wrapping">Captain Of Second Team</span>
            <input type="text" name="cap2" class="form-control" aria-label="Username" aria-describedby="addon-wrapping">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <div class="input-group flex-wrap my-2">
            <span class="input-group-text" id="addon-wrapping">Toss Won By</span>
            <input type="text" name="toss" class="form-control" aria-label="Username" aria-describedby="addon-wrapping">
          </div>
        </div>
        <div class="col-6">
          <div class="input-group flex-wrap my-2">
            <span class="input-group-text" id="addon-wrapping">Match Won By</span>
            <input type="text" name="match" class="form-control" aria-label="Username" aria-describedby="addon-wrapping">
          </div>
        </div>
      </div>
      <button type="submit" class="btn btn-dark btn-lg btn-block my-3" name="submit">Submit</button>
    </div>
  </form>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>
