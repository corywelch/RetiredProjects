using UnityEngine;
using System.Collections;

public class LookUpDown : MonoBehaviour {	
	
	// Use this for initialization
	void Start () {
	}
	
	// Update is called once per frame
	void Update () {
		if (Input.GetKey("up")&& (transform.eulerAngles.x >300 || transform.eulerAngles.x < 55)) {
			this.transform.Rotate(Vector3.right * -50 * Time.deltaTime);
		}
		if (Input.GetKey("down")&& (transform.eulerAngles.x < 50 || transform.eulerAngles.x > 295)) {
			this.transform.Rotate(Vector3.right * 50 * Time.deltaTime);
		}
		if (Input.GetKey (KeyCode.R)) {
			Debug.Log("Angles");
			Debug.Log("X: " + transform.eulerAngles.x);
			Debug.Log("Y: " + transform.eulerAngles.y);
			Debug.Log("Z: " + transform.eulerAngles.z);
		}
	}
}

