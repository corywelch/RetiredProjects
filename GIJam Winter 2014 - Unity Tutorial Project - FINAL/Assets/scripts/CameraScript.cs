using UnityEngine;
using System.Collections;

public class CameraScript : MonoBehaviour {

	// Use this for initialization
	void Start () {
	
	}
	
	// Update is called once per frame
	void Update () {
	
	}

	void OnGUI(){
		if(GUI.Button(new Rect(10f, 10f, 100f, 25f), "Reset Scene")){
			Application.LoadLevel(0);
		}
	}
}
