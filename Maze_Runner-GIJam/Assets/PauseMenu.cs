using UnityEngine;
using System.Collections;

public class PauseMenu : MonoBehaviour {

	public bool isPaused;
	public bool restartClicked;
	public bool isEasy;
	public bool isHard;
	// Use this for initialization
	void Start () {
		isPaused = false;
		restartClicked = false;
	}
	
	// Update is called once per frame
	void Update () {
		if (Input.GetKey (KeyCode.P) || Input.GetKey(KeyCode.Escape)){
			isPaused = true;
		}
	}
	void OnGUI(){
		if (isPaused && !restartClicked){
			GUI.Box(new Rect(200,Screen.height/2,(Screen.width - 400),150),"Maze Runner Menu");
			if(GUI.Button(new Rect(220,Screen.height/2+30,(Screen.width - 440),20), "Resume")) {
				isPaused = false;
			}
			if(GUI.Button(new Rect(220,Screen.height/2+60,(Screen.width - 440),20), "Restart")) {
				restartClicked = true;
			}
			if(GUI.Button(new Rect(220,Screen.height/2+90,(Screen.width - 440),20), "Exit")) {
				Application.LoadLevel("MainMenu");
			}
		}
		if(restartClicked){
			GUI.Box(new Rect(220,Screen.height/2+20,(Screen.width - 440),100),"Are You Sure?");
			if(GUI.Button(new Rect(240,Screen.height/2+50,(Screen.width-480),20),"No")){
				restartClicked = false;
			}
			if(GUI.Button(new Rect(240,Screen.height/2+90,(Screen.width-480),20),"Yes")){
				if(isHard){
					Application.LoadLevel("1");
				}
				else{
					Application.LoadLevel("EasyMaze");
				}
			}
		}
	}
}
