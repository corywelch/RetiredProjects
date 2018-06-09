using UnityEngine;
using System.Collections;

public class EasyWin : MonoBehaviour {

	// Use this for initialization
	void Start () {
	
	}
	
	// Update is called once per frame
	void Update () {
	
	}
	void OnTriggerEnter(Collider collider){
		if(collider.tag == "Finish"){
			Debug.Log ("Win!");
			Application.LoadLevel("YouWonEasy");
		}
	}
}
