import java.util.*;

public class MSCHAPv2 extends Network {
	private String eap;
	private String identity;
	private String password;
	private String phase1;
	private String phase2;

	public MSCHAPv2() {
		key_mgmt = "WPA-EAP";
	}

	public void eapModify(String eap) {
		this.eap = eap;
	}
	public void identityModify(String identity) {
		this.identity = identity;
	}
	public void passwordModify(String password) {
		this.password = password;
	}
	public void phase1Modify(String phase1) {
		this.phase1 = phase1;
	}
	public void phase2Modify(String phase2) {
		this.phase2 = phase2;
	}

	public String eapRetrieval() {
		return eap;
	}
	public String identityRetrieval() {
		return identity;
	}
	public String passwordRetrieval() {
		return password;
	}
	public String phase1Retrieval() {
		return phase1;
	}
	public String phase2Retrieval() {
		return phase2;
	}
}
