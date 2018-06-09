using UnityEngine;
using System.Collections;

public class StartButton : MonoBehaviour {

	// Use this for initialization
	void Start () {
	
	}
	
	// Update is called once per frame
	void Update () {
	
	}
	void OnGUI (){
		//GUI.Box(new Rect(10,10,100,90), "Play Game");
		
		// Make the first button. If it is pressed, Application.Loadlevel (1) will be executed
		if(GUI.Button(new Rect(100,Screen.height/2,(Screen.width - 200),30), "Start Easy Maze")) {
			Application.LoadLevel("EasyMaze");
		}
		if(GUI.Button(new Rect(100,Screen.height/2+50,(Screen.width - 200),30), "Start Hard Maze")) {
			Application.LoadLevel("1");
		}
	}
}