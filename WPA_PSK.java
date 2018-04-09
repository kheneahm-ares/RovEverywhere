import java.util.*;

public class WPA_PSK extends Network {

	private String psk;

	public void pskModify(final String psk) {
		this.psk = psk;
	}

	public String pskRetrieval() {
		return psk;
	}
}	
