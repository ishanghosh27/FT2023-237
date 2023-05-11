<?php

require_once('./ConfigData.php');

/**
 * DatabaseConnect - This class inherits data from DataConfig class and
 * connects to database
 */
class ConnectToDatabase extends ConfigData
{
  private $conn;
  /**
   * Method __construct
   *
   * @return void
   *  Connects to mysql database and throws error if failed
   */
  public function __construct()
  {
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
  public function createDatabase()
  {
    $result = $this->conn->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '" . $this->getName() . "'");
    if ($result->num_rows > 0) {
      echo " Database already exists! ";
      return $this->createTable1();
    } else {
      $sql = "CREATE DATABASE" . $this->getName();
      if ($this->conn->query($sql) === TRUE) {
        echo " Database created ";
        return $this->createTable1();
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
   *  Creates table 1 with all the input data from signup page inside the
   * database and displays success/failure response in browser window
   */
  public function createTable1()
  {
    $result = $this->conn->query("SHOW TABLES LIKE 'employee_code_table'");
    if (($result->num_rows > 0)) {
      echo " Table 1 already exists! ";
    } else {
      $sql_code = "CREATE TABLE employee_code_table (
              userid INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
              empcode VARCHAR(60) NOT NULL,
              empcodename VARCHAR(60) NOT NULL,
              empdomain VARCHAR(60) NOT NULL
          )";
      if ($this->conn->query($sql_code) === TRUE) {
        echo " Table 1 created successfully ";
      } else {
        echo " Error creating table 1 " . $this->conn->error;
      }
    }
    return $this->createTable2();
  }

  /**
   * Method createTable2
   *
   * @return void
   *  Creates table 2 with all the input data from signup page inside the
   * database and displays success/failure response in browser window
   */
  public function createTable2()
  {
    $result = $this->conn->query("SHOW TABLES LIKE 'employee_salary_table'");
    if (($result->num_rows > 0)) {
      echo " Table 2 already exists! ";
    } else {
      $sql_salary = "CREATE TABLE employee_salary_table (
              userid INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
              empid VARCHAR(120) NOT NULL,
              empsal VARCHAR(60) NOT NULL,
              empcode VARCHAR(60) NOT NULL
          )";
      if ($this->conn->query($sql_salary) === TRUE) {
        echo " Table 2 created successfully ";
      } else {
        echo " Error creating table 2 " . $this->conn->error;
      }
    }
    return $this->createTable3();
  }

  /**
   * Method createTable3
   *
   * @return void
   *  Creates table 3 with all the input data from signup page inside the
   * database and displays success/failure response in browser window
   */
  public function createTable3()
  {
    $result = $this->conn->query("SHOW TABLES LIKE 'employee_details_table'");
    if (($result->num_rows > 0)) {
      echo " Table 3 already exists! ";
    } else {
      $sql_details = "CREATE TABLE employee_details_table (
              userid INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
              empid VARCHAR(120) NOT NULL,
              fname VARCHAR(80) NOT NULL,
              lname VARCHAR(80) NOT NULL,
              empgrad VARCHAR(60) NOT NULL
          )";
      if ($this->conn->query($sql_details) === TRUE) {
        echo " Table 3 created successfully ";
      } else {
        echo " Error creating table 3 " . $this->conn->error;
      }
      $this->conn->close();
    }
  }

  /**
   * Method insertData1
   *
   * @param $empcode $empcode user input for employee code
   * @param $empcodename $empcodename user input for employee code name
   * @param $empdomain $empdomain user input for employee domain
   *
   * @return void
   *  Inserts input data in table 1
   */
  public function insertData1($empcode, $empcodename, $empdomain)
  {
    if (!empty($empcode) || !empty($empcodename) || !empty($empdomain)) {
      $stmt = $this->conn->prepare("INSERT INTO employee_code_table (empcode, empcodename, empdomain) VALUES (?, ?, ?)");
      $stmt->bind_param("sss", $empcode, $empcodename, $empdomain);
      $stmt->execute();
      $stmt->close();
    } else {
      $this->conn->close();
    }
  }

  /**
   * Method insertData2
   *
   * @param $empid $empid user input for employee id
   * @param $empsal $empsal user input for employee salary
   * @param $empcode $empcode user input for employee code
   *
   * @return void
   *  Inserts input data in table 2
   */
  public function insertData2($empid, $empsal, $empcode)
  {
    if (!empty($empid) || !empty($empsal) || !empty($empcode)) {
      $stmt = $this->conn->prepare("INSERT INTO employee_salary_table (empid, empsal, empcode) VALUES (?, ?, ?)");
      $stmt->bind_param("sis", $empid, $empsal, $empcode);
      $stmt->execute();
      $stmt->close();
    } else {
      $this->conn->close();
    }
  }

  /**
   * Method insertData3
   *
   * @param $empid $empid user input for employee id
   * @param $empfname $empfname user input for employee's first name
   * @param $emplname $emplname user input for employee's last name
   * @param $empgrad $empgrad user input for employee's graduation percentile
   *
   * @return void
   *  Inserts input data in table 3
   */
  public function insertData3($empid, $empfname, $emplname, $empgrad)
  {
    if (!empty($empid) || !empty($empfname) || !empty($emplname) || !empty($empgrad)) {
      $stmt = $this->conn->prepare("INSERT INTO employee_details_table (empid, fname, lname, empgrad) VALUES (?, ?, ?, ?)");
      $stmt->bind_param("sssi", $empid, $empfname, $emplname, $empgrad);
      $stmt->execute();
      $stmt->close();
    } else {
      $this->conn->close();
    }
  }

  /**
   * Method displayData1
   *
   * @return void
   *  Displays table 1
   */
  public function displayData1()
  {
    $sql_code = "SELECT * FROM employee_code_table";
    $result = $this->conn->query($sql_code);
    if ($result->num_rows > 0) {
?>
      <div class="container">
        <table class="table table-dark text-center my-5 mx-auto">
          <thead class="thead-dark text-center">
            <tr>
              <th scope="col">employee_code</th>
              <th scope="col">employee_code_name</th>
              <th scope="col">employee_domain</th>
            </tr>
          </thead>
          <?php
          while ($row = $result->fetch_assoc()) {
          ?>
            <tbody>
              <tr>
                <td><?php echo $row['empcode']; ?></td>
                <td><?php echo $row['empcodename']; ?></td>
                <td><?php echo $row['empdomain']; ?></td>
              </tr>
            <?php
          }
            ?>
            </tbody>
        </table>
      </div>
    <?php
    } else {
      echo "No Data Found For Table 1";
    }
  }

  /**
   * Method displayData2
   *
   * @return void
   *  Displays table 2
   */
  public function displayData2()
  {
    $sql_salary = "SELECT * FROM employee_salary_table";
    $result = $this->conn->query($sql_salary);
    if ($result->num_rows > 0) {
    ?>
      <div class="container">
        <table class="table table-dark text-center my-5 mx-auto">
          <thead class="thead-dark text-center">
            <tr>
              <th scope="col">employee_id</th>
              <th scope="col">employee_salary</th>
              <th scope="col">employee_code</th>
            </tr>
          </thead>
          <?php
          while ($row = $result->fetch_assoc()) {
          ?>
            <tbody>
              <tr>
                <td><?php echo $row['empid']; ?></td>
                <td><?php echo $row['empsal']; ?></td>
                <td><?php echo $row['empcode']; ?></td>
              </tr>
            <?php
          }
            ?>
            </tbody>
        </table>
      </div>
    <?php
    } else {
      echo "No Data Found For Table 2";
    }
  }

  /**
   * Method displayData3
   *
   * @return void
   *  Displays table 3
   */
  public function displayData3()
  {
    $sql_details = "SELECT * FROM employee_details_table";
    $result = $this->conn->query($sql_details);
    if ($result->num_rows > 0) {
    ?>
      <div class="container">
        <table class="table table-dark text-center my-5 mx-auto">
          <thead class="thead-dark text-center">
            <tr>
              <th scope="col">employee_id</th>
              <th scope="col">employee_first_name</th>
              <th scope="col">employee_last_name</th>
              <th scope="col">graduation_percentile</th>
            </tr>
          </thead>
          <?php
          while ($row = $result->fetch_assoc()) {
          ?>
            <tbody>
              <tr>
                <td><?php echo $row['empid']; ?></td>
                <td><?php echo $row['fname']; ?></td>
                <td><?php echo $row['lname']; ?></td>
                <td><?php echo $row['empgrad']; ?></td>
              </tr>
            <?php
          }
            ?>
            </tbody>
        </table>
      </div>
    <?php
    } else {
      echo "No Data Found For Table 3";
    }
  }

  /**
   * Method joinTable
   *
   * @return void
   *  Joins the 3 tables into a single table - joined_table to be used for the
   * 7 queries.
   */
  public function joinTable()
  {
    $sqldel = "DROP TABLE IF EXISTS joined_table;";
    $sqlj = "CREATE TABLE joined_table AS
            SELECT c.empcode, c.empcodename, s.empid, s.empsal, c.empdomain, d.fname, d.lname, d.empgrad
            FROM employee_code_table c
            JOIN employee_salary_table s ON c.empcode = s.empcode
            JOIN employee_details_table d ON s.empid = d.empid;";
    $result = $this->conn->query($sqldel);
    $result = $this->conn->query($sqlj);
    if ($result === FALSE) {
      echo "Error: " . $this->conn->error;
    }
    if (mysqli_affected_rows($this->conn) > 0) {
      return $this->queryOne();
    } else {
      echo " Failed To Join Tables " . $this->conn->error;
    }
  }

  /**
   * Method queryOne
   *
   * @return void
   *  Displays the result of first query
   */
  public function queryOne()
  {
    $sql1 = "SELECT fname, empsal FROM joined_table WHERE empsal>50";
    $result = $this->conn->query($sql1);
    if ($result->num_rows > 0) {
    ?>
      <div class="container">
        <h4>Query One</h4>
        <table class="table table-dark text-center my-2 mx-auto">
          <thead class="thead-dark text-center">
            <tr>
              <th scope="col">employee_first_name</th>
              <th scope="col">employee_salary</th>
            </tr>
          </thead>
          <?php
          while ($row = $result->fetch_assoc()) {
          ?>
            <tbody>
              <tr>
                <td><?php echo $row['fname']; ?></td>
                <td><?php echo $row['empsal']; ?></td>
              </tr>
            <?php
          }
            ?>
            </tbody>
        </table>
      </div>
    <?php
    } else {
    ?>
      <div class="container">
        <h4>Query One - No Employee With Salary Greater Than 50k</h4>
      </div>
<?php
    }
    return $this->queryTwo();
  }

  /**
   * Method queryTwo
   *
   * @return void
   *  Displays the result of second query
   */
  public function queryTwo()
  {
    $sql1 = "SELECT lname, empgrad FROM joined_table WHERE empgrad>70";
    $result = $this->conn->query($sql1);
    if ($result->num_rows > 0) {
    ?>
      <div class="container">
        <h4>Query Two</h4>
        <table class="table table-dark text-center my-2 mx-auto">
          <thead class="thead-dark text-center">
            <tr>
              <th scope="col">employee_last_name</th>
              <th scope="col">graduation_percentile</th>
            </tr>
          </thead>
          <?php
          while ($row = $result->fetch_assoc()) {
          ?>
            <tbody>
              <tr>
                <td><?php echo $row['lname']; ?></td>
                <td><?php echo $row['empgrad']; ?></td>
              </tr>
            <?php
          }
            ?>
            </tbody>
        </table>
      </div>
    <?php
    } else {
    ?>
      <div class="container">
        <h4>Query Two - No Employee With Graduation Percentile Greater Than 70%</h4>
      </div>
<?php
    }
    return $this->queryThree();
  }

  /**
   * Method queryThree
   *
   * @return void
   *  Displays the result of third query
   */
  public function queryThree()
  {
    $sql1 = "SELECT empcodename, empgrad FROM joined_table WHERE empgrad<70";
    $result = $this->conn->query($sql1);
    if ($result->num_rows > 0) {
    ?>
      <div class="container">
        <h4>Query Three</h4>
        <table class="table table-dark text-center my-2 mx-auto">
          <thead class="thead-dark text-center">
            <tr>
              <th scope="col">employee_last_name</th>
              <th scope="col">graduation_percentile</th>
            </tr>
          </thead>
          <?php
          while ($row = $result->fetch_assoc()) {
          ?>
            <tbody>
              <tr>
                <td><?php echo $row['empcodename']; ?></td>
                <td><?php echo $row['empgrad']; ?></td>
              </tr>
            <?php
          }
            ?>
            </tbody>
        </table>
      </div>
    <?php
    } else {
    ?>
      <div class="container">
        <h4>Query Three - No Employee With Graduation Percentile Less Than 70%</h4>
      </div>
<?php
    }
    return $this->queryFour();
  }

  /**
   * Method queryFour
   *
   * @return void
   *  Displays result of fourth query
   */
  public function queryFour()
  {
    $sql1 = "SELECT CONCAT(fname, ' ', lname) as FullName, empdomain FROM joined_table WHERE empdomain!='PHP'";
    $result = $this->conn->query($sql1);
    if ($result->num_rows > 0) {
    ?>
      <div class="container">
        <h4>Query Four</h4>
        <table class="table table-dark text-center my-2 mx-auto">
          <thead class="thead-dark text-center">
            <tr>
              <th scope="col">employee_full_name</th>
              <th scope="col">employee_domain</th>
            </tr>
          </thead>
          <?php
          while ($row = $result->fetch_assoc()) {
          ?>
            <tbody>
              <tr>
                <td><?php echo $row['FullName']; ?></td>
                <td><?php echo $row['empdomain']; ?></td>
              </tr>
            <?php
          }
            ?>
            </tbody>
        </table>
      </div>
    <?php
    } else {
    ?>
      <div class="container">
        <h4>Query Four - No Employee That Are Of Domain Other Than PHP</h4>
      </div>
<?php
    }
    return $this->queryFive();
  }

  /**
   * Method queryFive
   *
   * @return void
   *  Displays result of fifth query
   */
  public function queryFive()
  {
    $sql1 = "SELECT SUM(empsal) as totalsal, empdomain FROM joined_table GROUP BY empdomain";
    $result = $this->conn->query($sql1);
    if ($result->num_rows > 0) {
    ?>
      <div class="container">
        <h4>Query Five</h4>
        <table class="table table-dark text-center my-2 mx-auto">
          <thead class="thead-dark text-center">
            <tr>
              <th scope="col">employee_domain</th>
              <th scope="col">employee_salary</th>
            </tr>
          </thead>
          <?php
          while ($row = $result->fetch_assoc()) {
          ?>
            <tbody>
              <tr>
                <td><?php echo $row['empdomain']; ?></td>
                <td><?php echo $row['totalsal']; ?></td>
              </tr>
            <?php
          }
            ?>
            </tbody>
        </table>
      </div>
    <?php
    } else {
    ?>
      <div class="container">
        <h4>Query Five - No Employee Records Found</h4>
      </div>
<?php
    }
    return $this->querySix();
  }
  /**
   * Method querySix
   *
   * @return void
   *  Displays result of sixth query
   */
  public function querySix()
  {
    $sql1 = "SELECT SUM(empsal) as totalsal, empdomain FROM joined_table WHERE empsal>30 GROUP BY empdomain";
    $result = $this->conn->query($sql1);
    if ($result->num_rows > 0) {
    ?>
      <div class="container">
        <h4>Query Six</h4>
        <table class="table table-dark text-center my-2 mx-auto">
          <thead class="thead-dark text-center">
            <tr>
              <th scope="col">employee_domain</th>
              <th scope="col">employee_salary</th>
            </tr>
          </thead>
          <?php
          while ($row = $result->fetch_assoc()) {
          ?>
            <tbody>
              <tr>
                <td><?php echo $row['empdomain']; ?></td>
                <td><?php echo $row['totalsal']; ?></td>
              </tr>
            <?php
          }
            ?>
            </tbody>
        </table>
      </div>
    <?php
    } else {
    ?>
      <div class="container">
        <h4>Query Six - No Employee Records Found</h4>
      </div>
<?php
    }
    return $this->querySeven();
  }
  /**
   * Method querySeven
   *
   * @return void
   *  Displays result of seventh query
   */
  public function querySeven()
  {
    $sql1 = "SELECT empid, empcode FROM joined_table WHERE empcode=''";
    $result = $this->conn->query($sql1);
    if ($result->num_rows > 0) {
    ?>
      <div class="container">
        <h4>Query Seven</h4>
        <table class="table table-dark text-center my-2 mx-auto">
          <thead class="thead-dark text-center">
            <tr>
              <th scope="col">employee_id</th>
              <th scope="col">employee_code</th>
            </tr>
          </thead>
          <?php
          while ($row = $result->fetch_assoc()) {
          ?>
            <tbody>
              <tr>
                <td><?php echo $row['empid']; ?></td>
                <td><?php echo $row['empcode']; ?></td>
              </tr>
            <?php
          }
            ?>
            </tbody>
        </table>
      </div>
    <?php
    } else {
    ?>
      <div class="container">
        <h4>Query Seven - No Employee Without Assigned Employee Code</h4>
      </div>
<?php
    }
    $this->conn->close();
  }

}
