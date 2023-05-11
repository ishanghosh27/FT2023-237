<?php

/**
 * DataConfig - This class stores all the data of the mysql database.
 */
class RefConfigData
{

  private $dBHost = "";
  private $dBUsername = "";
  private $dBPassword = "";
  private $dBName = "";
  /**
   * Method getHost
   *
   * @return string
   *  Returns name of host
   */
  public function getHost()
  {
    return $this->dBHost;
  }
  /**
   * Method getUsername
   *
   * @return string
   *  Returns username of mysql
   */
  public function getUsername()
  {
    return $this->dBUsername;
  }
  /**
   * Method getPassword
   *
   * @return string
   *  Returns corresponding password of mysql
   */
  public function getPassword()
  {
    return $this->dBPassword;
  }
  /**
   * Method getName
   *
   * @return string
   *  Returns name of database
   */
  public function getName()
  {
    return $this->dBName;
  }
}
