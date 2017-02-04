<?php
/**
 * Created by Martin Slavov
 */
namespace App\Inteface;

interface IDatabaseConnectionable
{   
   
	public function __construct();

	public function closeConnection();

}
