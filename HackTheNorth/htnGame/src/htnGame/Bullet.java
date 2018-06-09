package htnGame;

import java.awt.Graphics;
import java.awt.image.BufferedImage;
import java.io.File;
import java.io.IOException;
import java.util.ArrayList;

import javax.imageio.ImageIO;

public class Bullet {	
	
	private BufferedImage bulletIm;
	
	private int xLoc;
	private int yLoc;
	private String direction;
	
	public boolean outOfMap;
	public boolean hitEnemy;
	public int enemyHit;
	
	
	
	public Bullet(){
			
	}
	
	public Bullet(int CharX, int CharY,Graphics g,String dir){
		
		this.direction = dir;
		if(dir == "right"){
			setX(CharX - 16);
		}
		else{
			setX(CharX + 16);
		}
		setY(CharY + 32);
		drawBullet(g);
		
	}
	//public void
	
	public void setX(int x) {
		this.xLoc = x;
		if(x >= 612 || x <= 20){
			outOfMap = true;		
		}
	}
	
	public void setY(int y) {
		this.yLoc = y;
	}
	
	public void drawBullet(Graphics g){
		bulletIm = loadImage("../res/Bullet.png");
		g.drawImage(bulletIm,this.xLoc,this.yLoc,null);
	}
	
	private BufferedImage loadImage(String imagePath){
		BufferedImage img = null;
		try {
			img = ImageIO.read(new File(imagePath));
		}catch(IOException e){}
		
		return img;
	}
	
	public void moveBullet(Graphics g){
		int moveFactor = 4;
		if(direction == "left"){
			setX(this.xLoc - moveFactor);
		}
		else if(direction == "right"){
			setX(this.xLoc + moveFactor);
		}
		
		int i = 0;
		
		drawBullet(g);
		
		for(Enemy en: EnemyController.enemies){
			int enX = en.getX();
			int enY = en.getY();
			
			//if((this.xLoc+12 >= enX || this.xLoc <= enX+32)&&(this.yLoc+12 >= enY || this.yLoc <= enY+25)){
			if(this.xLoc+12 >= enX && this.xLoc <= enX +32 && this.yLoc+12 >= enY){
				this.hitEnemy = true;
				this.enemyHit = i;
				break;
			}
			i++;
		}
		
		
		
	}
	

}
