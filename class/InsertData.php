<?php

  require_once('ConnectDatabase.php');

  /**
   * InsertData - Class to insert AND display data from form into the table IPL
   * in database IPL_fixture.
   */
  class InsertData extends ConnectDatabase {
    public function insertFormData($venue, $team1, $team2, $cap1, $cap2, $toss, $match) {
      $this->insertData($venue, $team1, $team2, $cap1, $cap2, $toss, $match);
      echo "Data Entered Successfully";
    }

    public function displayFormData() {
      $this->displayData();
    }

}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $venue = $_POST['venue'];
  $team1 = $_POST['team1'];
  $team2 = $_POST['team2'];
  $cap1 = $_POST['cap1'];
  $cap2 = $_POST['cap2'];
  $toss = $_POST['toss'];
  $match = $_POST['match'];

  $insert = new InsertData();
  $insert->insertFormData($venue, $team1, $team2, $cap1, $cap2, $toss, $match);

  header('location: ../DisplayData.php');
  exit();
}
?>
