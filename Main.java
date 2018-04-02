import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.*;

public class Main {
	public static void main(String[] args) throws SQLException, ClassNotFoundException {

		DoWork dw = new DoWork();
		//dw.initStuff();
		if (args.length<1) {
			System.out.println("No additional arguments");
		}
		else if (args.length == 3) {
			String connectionAction = args[0];
			String connectionType = args[1];
			String ssid = args[2];
			System.out.println(connectionAction + " " + connectionType + " " + ssid);

			//dw.unsecuredConnectionNew(ssid);
		}
		else {
			System.out.println("Additional arguments provided");	
		}	

		FormatOutput fo = new FormatOutput();
		fo.outputiAllToFile();
	}
}	
