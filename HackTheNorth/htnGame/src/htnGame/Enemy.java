package htnGame;

import java.util.Random;

public class Enemy {
	
	Random random = new Random();
	private int x;
	private int y;
	private int width;
	private int height;
	private int speed;
	private int direction = 0;
	
	public Enemy(int init_width, int init_height, int init_speed){
		x = random.nextInt(640);
		y = random.nextInt(416);
		width = init_width;
		height = init_height;
		speed = init_speed;
	}
	
	public Enemy(int init_x, int init_y, int init_width, int init_height, int init_speed){
		x = init_x;
		y = init_y;
		width = init_width;
		height = init_height;
		speed = init_speed;
	}
	
	public int getDirection(){
		return direction;
	}
	
	public int getX(){
		return x;
	}
	
	public int getY(){
		return y;
	}
	
	public int getHeight(){
		return height;
	}
	
	public int getWidth(){
		return width;
	}
	
	public void setX(int new_x){
		x = new_x;
	}
	
	public void setY(int new_y){
		y = new_y;
	}
	
	public void updatePosition(int follow_x, int follow_y){
		if(follow_x > x){
			x += speed;
			direction = 1;
		}
		else{
			x-= speed;
			direction = 0;
		}
		
		if (follow_y > y){
			y += speed;
		}
		else{
			y -= speed;
		}
	}
}
