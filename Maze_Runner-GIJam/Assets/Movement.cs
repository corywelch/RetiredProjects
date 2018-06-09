using UnityEngine;
using System.Collections;

public class Movement : MonoBehaviour {
	
	Vector3 PlayerPos;
	public Vector3 CamPos;
	
	// Use this for initialization
	void Start () {
		PlayerPos = this.transform.position;
		CamPos = this.transform.localEulerAngles;
	}
	
	// Update is called once per frame
	void Update () {
		if (Input.GetKey(KeyCode.W)) {
			PlayerPos = this.transform.position;
			PlayerPos.x += -0.3f*Mathf.Sin((CamPos.y * Mathf.PI)/180f);
			PlayerPos.z += -0.3f*Mathf.Cos((CamPos.y * Mathf.PI)/180f);
			this.transform.position = PlayerPos;
		}
		if (Input.GetKey(KeyCode.S)) {
			PlayerPos = this.transform.position;
			PlayerPos.x += 0.3f*Mathf.Sin((CamPos.y * Mathf.PI)/180f);
			PlayerPos.z += 0.3f*Mathf.Cos((CamPos.y * Mathf.PI)/180f);
			this.transform.position = PlayerPos;
		}
		if (Input.GetKey(KeyCode.A)) {
			PlayerPos = this.transform.position;
			PlayerPos.x += 0.3f*Mathf.Cos((CamPos.y * Mathf.PI)/180f);
			PlayerPos.z += -0.3f*Mathf.Sin((CamPos.y * Mathf.PI)/180f);
			this.transform.position = PlayerPos;
		}
		if (Input.GetKey(KeyCode.D)) {
			PlayerPos = this.transform.position;
			PlayerPos.x += -0.3f*Mathf.Cos((CamPos.y * Mathf.PI)/180f);
			PlayerPos.z += 0.3f*Mathf.Sin((CamPos.y * Mathf.PI)/180f);
			this.transform.position = PlayerPos;
		}
		if (Input.GetKey("right")) {
			this.transform.Rotate(transform.up * 50 * Time.deltaTime);
			CamPos = this.transform.localEulerAngles;
			Debug.Log("Angle relative to Boxman is: " + CamPos.y);
		}
		if (Input.GetKey("left")) {
			this.transform.Rotate(transform.up * -50 * Time.deltaTime);
			CamPos = this.transform.localEulerAngles;
			Debug.Log("Angle relative to Boxman is: " + CamPos.y);
		}
		if (Input.GetKey (KeyCode.E)) {
			Debug.Log("Angles");
			Debug.Log("X: " + transform.eulerAngles.x);
			Debug.Log("Y: " + transform.eulerAngles.y);
			Debug.Log("Z: " + transform.eulerAngles.z);
		}
	}
	void OnCollision(){
		Debug.Log ("Colliding");
	}
}

