<?php

  require_once('ConnectToDatabase.php');

  /**
   * DataInsert - Calls the functions to insert input data into the 3 tables, as
   * well as display them. Also, calls the function which joins the 3 tables
   * into a single table and then runs the 7 queries provided.
   */
  class DataInsert extends ConnectToDatabase {
  /**
   * Method insertFormData1
   *
   * @param $empcode $empcode user input for employee code
   * @param $empcodename $empcodename user input for employee code name
   * @param $empdomain $empdomain user input for employee domain
   *
   * @return void
   *  Inserts input data into table 1
   */
    public function insertFormData1($empcode, $empcodename, $empdomain) {
      $this->insertData1($empcode, $empcodename, $empdomain);
      echo " All Table 1 Data Entered Successfully ";
    }
  /**
   * Method insertFormData2
   *
   * @param $empid $empid user input for employee id
   * @param $empsal $empsal user input for employee's salary
   * @param $empcode $empcode user input for employee code
   *
   * @return void
   *  Inserts input data into table 2
   */
    public function insertFormData2($empid, $empsal, $empcode) {
      $this->insertData2($empid, $empsal, $empcode);
      echo " All Table 2 Data Entered Successfully ";
    }
  /**
   * Method insertFormData3
   *
   * @param $empid $empid user input for employee id
   * @param $empfname $empfname user input for employee's first name
   * @param $emplname $emplname user input for employee's last name
   * @param $empgrad $empgrad user input for employee's graduation percentile
   *
   * @return void
   *  Inserts input data into table 3
   */
    public function insertFormData3($empid, $empfname, $emplname, $empgrad) {
      $this->insertData3($empid, $empfname, $emplname, $empgrad);
      echo " All Table 3 Data Entered Successfully ";
    }

    /**
     * Method displayFormData
     *
     * @return void
     *  Calls the 3 functions which displays the 3 tables after user input
     */
    public function displayFormData() {
      $this->displayData1();
      $this->displayData2();
      $this->displayData3();
    }

    /**
     * Method displayQueryData
     *
     * @return void
     *  Calls the function which joins the above 3 tables into a single table
     * and runs the 7 queries provided
     */
    public function displayQueryData() {
      $this->joinTable();
    }

}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $empcode = $_POST['code'];
  $empcodename = $_POST['codename'];
  $empdomain = $_POST['domain'];
  $empid = $_POST['id'];
  $empsal = $_POST['salary'];
  $empfname = $_POST['fname'];
  $emplname = $_POST['lname'];
  $empgrad = $_POST['grad'];

  $insert = new DataInsert();
  $insert->insertFormData1($empcode, $empcodename, $empdomain);
  $insert->insertFormData2($empid, $empsal, $empcode);
  $insert->insertFormData3($empid, $empfname, $emplname, $empgrad);

  header('location: ../DataDisplay.php');
  exit();
}
