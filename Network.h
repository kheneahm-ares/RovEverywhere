#ifndef NETWORK_H_
#define NETWORK_H_

#include<string>

using namespace std;

class Network
{
public:
	void ssidModifiy(const string ssid) { this->ssid.assign(ssid); }
	void key_mgmtModify(const string key_mgmt) { this->key_mgmt.assign(key_mgmt); }

	string ssidRetrieval() const { return ssid; }	
	string key_mgmtRetrieval() const { return key_mgmt; }
protected:
	string ssid;
	string key_mgmt;
private:
};

#endif
