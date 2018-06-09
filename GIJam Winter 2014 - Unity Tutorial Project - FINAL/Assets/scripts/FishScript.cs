using UnityEngine;
using System.Collections;

public class FishScript : MonoBehaviour {

	public AudioClip stretchSound;
	public AudioClip popSound;
	public AudioClip explosionSound;
	public GameObject explosion;
	public GameObject youWin;

	bool isGrabbed = false;
	bool isFlying = false;
	public float launchFactor;

	Transform launchPoint;

	// Use this for initialization
	void Start () {
		launchPoint = GameObject.Find ("LaunchPoint").transform;
		ResetPosition();

		//launchFactor = 1f;
	}

	private void ResetPosition(){
		transform.position = launchPoint.position;
		rigidbody2D.velocity = Vector2.zero;
		isGrabbed = false;
		isFlying = false;
	}
	
	// Update is called once per frame
	void Update () {
		if(Input.GetKeyDown(KeyCode.R)){
			this.isGrabbed = false;
			this.isFlying = false;
			this.rigidbody2D.velocity = Vector2.zero;
			ResetPosition();
		}
	}

	void FixedUpdate(){

		if(isGrabbed){
			Vector3 worldPosition = Camera.main.ScreenToWorldPoint(Input.mousePosition);
			worldPosition.z = 0;
			//Debug.Log ("World Position: " + worldPosition.ToString());
			this.transform.position = worldPosition;
		}

		if(!isFlying){
			this.rigidbody2D.gravityScale = 0;
		} else {
			this.rigidbody2D.gravityScale = 1;

			Vector3 cameraPos = Camera.main.transform.position;

			Vector3 fishPos = this.transform.position;

//			Camera.main.transform.position = Camera.main.WorldToScreenPoint(fishPos);
		}

	}

	void OnMouseDown(){
		Debug.Log ("FishScript.OnMouseDown()");

		audio.PlayOneShot(stretchSound);

		isGrabbed = true;
	}

	void OnMouseUp(){
		if(isGrabbed){
			isGrabbed = false;
			isFlying = true;

			audio.Stop();
			audio.PlayOneShot(popSound);

			Vector3 diff = launchPoint.transform.position - this.transform.position;

			this.rigidbody2D.velocity = diff * launchFactor;
		}
	}

	void OnCollisionEnter2D(Collision2D coll){
		if(coll.gameObject.name == "Ganon" || coll.gameObject.name == "Pipe"){

			audio.PlayOneShot(explosionSound);
			Instantiate(explosion, coll.gameObject.transform.position, Quaternion.identity);
			GameObject.Destroy(coll.gameObject);

			ResetPosition();

		}

		if(coll.gameObject.name == "Ganon"){
			Vector3 cameraPosition = GameObject.Find("Main Camera").transform.position;
			cameraPosition.z = 0;
			Debug.Log (cameraPosition.ToString());
			Instantiate(youWin, cameraPosition, Quaternion.identity);
		}
	}
}
