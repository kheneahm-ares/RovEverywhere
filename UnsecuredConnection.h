#ifndef UNSECUREDCONNECTION_H_
#define UNSECUREDCONNECTION_H_

#include<iostream>
#include"Network.h"


class UnsecuredConnection : public Network
{	
public:
	UnsecuredConnection()
	{
		key_mgmt.assign("NONE");
	}	
	~UnsecuredConnection() = default;

private:
};

#endif
