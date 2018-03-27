#include<iostream>
#include"mysql_connection.h"
#include"cppconn/driver.h"
#include"UnsecuredConnection.h"

int main()
{
	//sql::mysql::MySQL_Driver *driver;
	sql::Driver *driver;
	sql::Connection *con;

	driver = sql::mysql::get_driver_instance();
	//con = driver->connect("tcp://108.255.70.130:3306", "hm", "panther");

	delete con;


	return 0;
}	
