#ifndef MSCHAPV2_H_
#define MSCHAPV2_H_

#include"Network.h"

class MSCHAPv2 : public Network
{
public:
	MSCHAPv2()
	{
		key_mgmt.assign("WPA-EAP");
	}

	void eapModify(const string eap) { this->eap.assign(eap); }
	void identityModify(const string identity) { this->identity.assign(identity); }
	void passwordModify(const string password) { this->password.assign(password); }
	void phase1Modify(const string phase1) { this->phase1.assign(phase1); }
	void phase2Modify(const string phase2) { this->phase2.assign(phase2); }

	string eapRetrieval() const { return eap; }
	string identityRetrieval() const { return identity; }
	string passwordRetrieval() const { return password; }
	string phase1Retrieval() const { return phase1; }
	string phase2Retrieval() const { return phase2; }
private:	
	string eap;
	string identity;
	string password;
	string phase1;
	string phase2;
};

#endif
