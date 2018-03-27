#ifndef WPA_PSK_H_
#define WPA_PSK_H_

#include"Network.h"

class WPA_PSK : public Network
{
public:

	void pskModify(const string psk) { this->psk.assign(psk); }

	string pskRetrieval() const { return psk; }
private:
	string psk;
};

#endif
