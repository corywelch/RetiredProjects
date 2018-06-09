package htnGame;

public class Character {
	
	private int coordX;
	private int coordY;
	private int width;
	private int height;
	private double velocityY;
	private double g = -0.01;
	
	public Character (int x, int y, int width, int height){
		setX(x);
		setY(y);
		this.width = width;
		this.height = height;
	}
	
	public int getX (){
		return this.coordX;
	}
	
	public int getY (){
		return this.coordY;
	}
	
	public int getWidth(){
		return this.width;
	}
	
	public int getHeight(){
		return this.height;
	}
	
	public double getVelocityY(){
		return velocityY;
	}
	
	public double getGravity(){
		return g;
	}
	
	public void setVelocityY(double v){
		this.velocityY = v;
	}
	
	public void setX(int x) {
		
		if(x < 19){
			x = 20;
		}else if(x > 587){
			x = 587;
		}
		
		this.coordX = x;
	}
	
	public void setY(int y) {
		
		this.coordY = y;
	}
	
	public void moveCoordX (String direction, int speed){
		
	}
	
	public void jump (){
		
	}
}
