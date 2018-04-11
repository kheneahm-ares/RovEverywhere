import java.io.IOException;
import java.io.FileWriter;
import java.io.PrintWriter;
import java.util.*;
import java.sql.*;

public class FormatOutput {
	private ArrayList<UnsecuredConnection> ucList;
	private ArrayList<WPA_PSK> wpa_pskList;
	private ArrayList<MSCHAPv2> mv2List;
	private Statement stm;
	private	DoWork dw = new DoWork();
	private String filename = "/tmp/runup.conf";
	public FormatOutput() {
		initList();
	}	

	public void outputiAllToFile() {
		outputUnsecured();
		outputWPA_PSK();
		outputMSCHAPv2();
	}	

	public void outputUnsecured() {
		collectUnsecured();
		try {
			for (int index = 0; index < ucList.size(); ++index) {
				FileWriter fw;
				if (index!=0) {
					fw = new FileWriter(filename, true);
				}
				else {
					fw = new FileWriter(filename);
				}	
				PrintWriter pw = new PrintWriter(fw);
				pw.println("network={");
				pw.println("\tssid=\"" + ucList.get(index).ssidRetrieval() + "\"");
				pw.println("\tkey_mgmt=\"" + ucList.get(index).key_mgmtRetrieval() + "\"");
				pw.println("}");
				pw.close();
			}	
		}
		catch (IOException e) {
			e.printStackTrace();
		}	
	}
	public void outputWPA_PSK() {
		collectWPA_PSK();
		try {
			for (int index = 0; index < ucList.size(); ++index) {
				FileWriter fw = new FileWriter(filename, true);
					 
				PrintWriter pw = new PrintWriter(fw);
				pw.println("network={");
				pw.println("\tssid=\"" + wpa_pskList.get(index).ssidRetrieval() + "\"");
				pw.println("\tpsk=\"" + wpa_pskList.get(index).pskRetrieval() + "\"");
				pw.println("}");
				pw.close();
				System.out.println("out this bitch");
			}	
		}
		catch (IOException e) {
			e.printStackTrace();
		}	

	}
	public void outputMSCHAPv2() {
		collectMSCHAPv2();
		try {
			for (int index = 0; index < ucList.size(); ++index) {
				FileWriter fw = new FileWriter(filename, true);
					 
				PrintWriter pw = new PrintWriter(fw);
				pw.println("network={");
				pw.println("\tssid=\"" + mv2List.get(index).ssidRetrieval() + "\"");
				pw.println("\tkey_mgmt=" + mv2List.get(index).key_mgmtRetrieval());
				pw.println("\teap=" + mv2List.get(index).eapRetrieval());
				pw.println("\tidentity=\"" + mv2List.get(index).identityRetrieval() + "\"");
				pw.println("\tpassword=\"" + mv2List.get(index).passwordRetrieval() + "\"");
				pw.println("\tphase1=\"" + mv2List.get(index).phase1Retrieval() + "\"");
				pw.println("\tphase2=\"" + mv2List.get(index).phase2Retrieval() + "\"");
				pw.println("}");
				pw.close();
				System.out.println("out this bitch");
			}	
		}
		catch (IOException e) {
			e.printStackTrace();
		}	
	}
	public void collectUnsecured() {
		ucList = new ArrayList<UnsecuredConnection>();
		try {
			Connection cn = DriverManager.getConnection(dw.urlRetrieval(), dw.usernameRetrieval(), dw.passwordRetrieval());
			stm = cn.createStatement();
			String query = "select SSID, KEY_MGMT from UNSECUREDCONNECTION";

			ResultSet rs = stm.executeQuery(query);

			for (int i = 0;rs.next(); ++i) {
				UnsecuredConnection uc = new UnsecuredConnection();
				uc.ssidModifiy(rs.getString(1));
				ucList.add(uc);
			}
		}
		catch (SQLException e) {
			e.printStackTrace();
		}	
	}	
	public void collectWPA_PSK() {
		wpa_pskList = new ArrayList<WPA_PSK>();
		try {
			Connection cn = DriverManager.getConnection(dw.urlRetrieval(), dw.usernameRetrieval(), dw.passwordRetrieval());
			stm = cn.createStatement();
			String query = "select SSID, PSK from WPA_PSK";

			ResultSet rs = stm.executeQuery(query);

			for (int i = 0; rs.next(); ++i) {
				WPA_PSK wpa = new WPA_PSK();
				wpa.ssidModifiy(rs.getString(1));
				wpa.pskModify(rs.getString(2));
				wpa_pskList.add(wpa);
			}
		}
		catch (SQLException e) {
			e.printStackTrace();
		}	
	}
	public void collectMSCHAPv2() {
		mv2List = new ArrayList<MSCHAPv2>();
		try {
			Connection cn = DriverManager.getConnection(dw.urlRetrieval(), dw.usernameRetrieval(), dw.passwordRetrieval());
			stm = cn.createStatement();

			String query = "select SSID, KEY_MGMT, EAP, IDENTITY, PASSWORD, PHASE1, PHASE2 from MSCHAPv2";

			ResultSet rs = stm.executeQuery(query);

			for (int i = 0; rs.next(); ++i) {
				MSCHAPv2 mv2 = new MSCHAPv2();
				mv2.ssidModifiy(rs.getString(1));
				mv2.eapModify(rs.getString(3));
				mv2.identityModify(rs.getString(4));
				mv2.passwordModify(rs.getString(5));
				mv2.phase1Modify(rs.getString(6));
				mv2.phase2Modify(rs.getString(7));
				mv2List.add(mv2);
			}	
		}
		catch (SQLException e) {
			e.printStackTrace();
		}	
	}
	private void initList() {
		ucList = new ArrayList<UnsecuredConnection>();
		wpa_pskList = new ArrayList();
		mv2List = new ArrayList();
	}	
}	
