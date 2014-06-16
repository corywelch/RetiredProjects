using UnityEngine;
using System.Collections;

public class YouWinSceneScriptEasy : MonoBehaviour {

	// Use this for initialization
	void Start () {
		Debug.Log ("Starting YouWinSceneScriptEasy");
	}
	
	// Update is called once per frame
	void Update () {
	
	}
	void OnGUI(){
		GUI.Box(new Rect(200,Screen.height/2,(Screen.width - 400),90),"You Have Won!!: Choose an Option");
		if(GUI.Button(new Rect(220,Screen.height/2+30,(Screen.width - 440),20), "Restart Level")) {
			Application.LoadLevel("EasyMaze");
		}
		if(GUI.Button(new Rect(220,Screen.height/2+60,(Screen.width - 440),20), "Main Menu")) {
			Application.LoadLevel("MainMenu");
		}
	}

}
