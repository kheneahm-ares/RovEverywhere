#ifndef READFILE_H_
#define READFILE_H_

#include<iostream>
#include<fstream>
#include<string>
#include<vector>
#include"stdio.h"
#include"stdlib.h"

using namespace std;

class ReadFile
{
public:
	ReadFile()
	{

	}	

	void determineConnection()
	{
		if (networkMatchUp()) system(runInternetAP.c_str());
		else system(runAP.c_str());
	}	
	void accessKnownNetworks()
	{
		fstream readKnownNetworks{filename};

		while (!readKnownNetworks.eof())
		{
			string network;	
			readKnownNetworks >> network;
			if (network=="") network.clear();
			else knownNetworks.push_back(network);
		}		
		printNetworks(knownNetworks);
	}	
	void accessAvailableNetworks()
	{
		fstream readAvailableNetworks{filename};

		while (!readAvailableNetworks.eof())
		{
			string network;
			readAvailableNetworks >> network;
			if (network=="") network.clear();
			else availableNetworks.push_back(network);
		}	
		printNetworks(availableNetworks);
	}	
	void accessKnownNetworks(const string filename)
	{
		fstream readKnownNetworks{filename};

		while (!readKnownNetworks.eof())
		{
			string network;	
			readKnownNetworks >> network;
			if (network=="") network.clear();
			else knownNetworks.push_back(network);
		}		
	}
	void accessAvailableNetworks(const string filename)
	{
		fstream readAvailableNetworks{filename};

		while (!readAvailableNetworks.eof())
		{
			string network;
			readAvailableNetworks >> network;
			if (network.compare("")==0) network.clear();
			else availableNetworks.push_back(network);
		}	
	}	
		
	void configureFilename(const string filename)
	{
		this->filename = filename;
	}	
	void printNetworks(const vector<string> network)
	{
		for (auto net : network) cout << net << endl;
	}	
	
	string retrieveFilename() const { return filename; }
	bool networkMatchUp()
	{
		for (auto network : knownNetworks)
		{
			cout << "comparator: " << network << endl;
			cout << "What is being compared: " << availableNetworks.at(0) << endl << endl;
			if (network.compare(availableNetworks.at(0))==0) return true;
			else continue;
		}	
		return false;
	}	
private:	
	const string runInternetAP{"create_ap wlan0 wlan1 akknetwork"};
	const string runAP{"create_ap wlan0 akknetwork"};
	string filename;
	vector<string> knownNetworks;
	vector<string> availableNetworks;
};

#endif
