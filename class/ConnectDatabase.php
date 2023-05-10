<?php

require_once('./config/ConfigData.php');

/**
 * DatabaseConnect - This class inherits data from DataConfig class and
 * connects to database
 */
class ConnectDatabase extends ConfigData {
  private $conn;
  /**
   * Method __construct
   *
   * @return void
   *  Connects to mysql database and throws error if failed
   */
  public function __construct() {
    $this->conn = new mysqli($this->getHost(), $this->getUsername(), $this->getPassword(), $this->getName());
    if ($this->conn->connect_error) {
      die(" Connection Failed: " . $this->conn->connect_error);
    }
  }
  /**
   * Method createDatabase
   *
   * @return void
   *  Checks whether database already exists or not, and then creates database
   * and displays success/failure response in browser window
   */
  public function createDatabase() {
    $result = $this->conn->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '" . $this->getName() . "'");
    if ($result->num_rows > 0) {
      echo " Database already exists! ";
      return $this->createTable();
    } else {
      $sql = "CREATE DATABASE" . $this->getName();
      if ($this->conn->query($sql) === TRUE) {
        return $this->createTable();
      } else {
        echo " Error creating database: " . $this->conn->error;
      }
      $this->conn->close();
    }
  }
  /**
   * Method createTable
   *
   * @return void
   *  Creates table with all the input data from signup page inside the
   * database and displays success/failure response in browser window
   */
  public function createTable() {
    $result = $this->conn->query("SHOW TABLES LIKE 'IPL'");
    if ($result->num_rows > 0) {
      echo " Table already exists! ";
    } else {
      $sql = "CREATE TABLE IPL (
              userid INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
              venue VARCHAR(120) NOT NULL,
              team1 VARCHAR(50) NOT NULL,
              team2 VARCHAR(50) NOT NULL,
              captain1 VARCHAR(120) NOT NULL,
              captain2 VARCHAR(120) NOT NULL,
              tosswon VARCHAR(50) NOT NULL,
              matchwon VARCHAR(50) NOT NULL
          )";
      if ($this->conn->query($sql) === TRUE) {
        echo " Table created successfully ";
      } else {
        echo " Error creating table: " . $this->conn->error;
      }
      $this->conn->close();
    }
  }

  /**
   * Method insertData
   *
   * @param $venue $venue Name of venue - entered by user in form
   * @param $team1 $team1 Name of first team - entered by user in form
   * @param $team2 $team2 Name of second team - entered by user in form
   * @param $cap1 $cap1 Name of first team's captain - entered by user in form
   * @param $cap2 $cap2 Name of second team's captain - entered by user in form
   * @param $toss $toss Name of the team that won the toss - entered by user in
   * form
   * @param $match $match Name of the team that won the match - entered by user
   * in form
   *
   * @return void
   *  Inserts input data from form into the table "IPL"
   */
  public function insertData($venue, $team1, $team2, $cap1, $cap2, $toss, $match) {
    if (!empty($venue) || !empty($team1) || !empty($team2) || !empty($cap1) || !empty($cap2) || !empty($toss) || !empty($match)) {
      $stmt = $this->conn->prepare("INSERT INTO IPL (venue, team1, team2, captain1, captain2, tosswon, matchwon) VALUES (?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("sssssss", $venue, $team1, $team2, $cap1, $cap2, $toss, $match);
      $stmt->execute();
      $stmt->close();
    }
    else {
      $this->conn->close();
    }
  }

  /**
   * Method displayData
   *
   * @return void
   *  Fetches data from table IPL and displays the data in a html table format
   * in a new page - DisplayData.php
   */
  public function displayData() {
    $sql = "SELECT * FROM IPL";
    $result = $this->conn->query($sql);
    if ($result->num_rows > 0) {
    ?>
      <div class="container">
        <table class="table table-dark text-center my-5 mx-auto">
          <thead class="thead-dark text-center">
            <tr>
              <th scope="col">Venue</th>
              <th scope="col">First Team</th>
              <th scope="col">Second Team</th>
              <th scope="col">Captain Of First Team</th>
              <th scope="col">Captain Of Second Team</th>
              <th scope="col">Toss Won by</th>
              <th scope="col">Match Won By</th>
            </tr>
          </thead>
          <?php
          while ($row = $result->fetch_assoc()) {
          ?>
            <tbody>
              <tr>
                <td><?php echo $row['venue']; ?></td>
                <td><?php echo $row['team1']; ?></td>
                <td><?php echo $row['team2']; ?></td>
                <td><?php echo $row['captain1']; ?></td>
                <td><?php echo $row['captain2']; ?></td>
                <td><?php echo $row['tosswon']; ?></td>
                <td><?php echo $row['matchwon']; ?></td>
              </tr>
            <?php
          }
            ?>
            </tbody>
        </table>
      </div>
<?php
    } else {
      echo "No Data Found";
    }
  }
}
