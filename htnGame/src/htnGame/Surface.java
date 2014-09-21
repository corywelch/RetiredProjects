package htnGame;

public class Surface {
	
	int posY, startX, endX;
	
	public Surface(int posY, int startX, int endX){
		this.posY = posY;
		this.startX = startX;
		this.endX = endX;
	}

	public int getPosY(){
		return this.posY;
	}
	
	public int getStartX(){
		return this.startX;
	}
	public int getEndX(){
		return this.endX;
	}
}