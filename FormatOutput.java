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
	}	

	public void outputUnsecured() {
		collectUnsecured();
		try {
			//System.out.println("Size of array list: " + ucList.size());
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
	public void collectUnsecured() {
		try {
			Connection cn = DriverManager.getConnection(dw.urlRetrieval(), dw.usernameRetrieval(), dw.passwordRetrieval());
			stm = cn.createStatement();
			String query = "select SSID, KEY_MGMT from UNSECUREDCONNECTION";

			ResultSet rs = stm.executeQuery(query);

			for (int i = 0;rs.next(); ++i) {
				UnsecuredConnection uc = new UnsecuredConnection();
				uc.ssidModifiy(rs.getString(1));
				ucList.add(uc);
				//System.out.println("run through: " + i + " ssid: " + uc.ssidRetrieval() + " size: " + ucList.size());
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
