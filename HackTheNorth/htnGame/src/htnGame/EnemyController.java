package htnGame;

import java.awt.Color;
import java.awt.Graphics;
import java.awt.image.BufferedImage;
import java.io.File;
import java.io.IOException;
import java.util.ArrayList;

import javax.imageio.ImageIO;

public class EnemyController {
	public static int level;
	private int enemies_per_wave;
	BufferedImage orangeenemyL;
	BufferedImage orangeenemyR;
	Text text;
	
	public static int enemyKills = 0;
	public static int enemysLeft = 0;
	
	public static ArrayList<Enemy> enemies = new ArrayList<Enemy>();
	
	public EnemyController(){
		level = 1;
		enemies_per_wave = 5;
		createEnemies();
		orangeenemyL = loadImage("../res/orangeenemyL.png");
		orangeenemyR = loadImage("../res/orangeenemyR.png");
	}
	
	//function to return buffered image
	private BufferedImage loadImage(String imagePath){
		BufferedImage img = null;
		try {
			img = ImageIO.read(new File(imagePath));
		}catch(IOException e){}
			
		return img;
	}
	
	public void createEnemies(){
		//level 1 enemies
		enemies_per_wave = (level*level + 4)/2 * level +3;
		for (int i = 0; i < enemies_per_wave; i++){

			enemies.add(new Enemy(32,32,1));
			enemysLeft++;
		}
	}
	
	public void updateEnemies(Graphics g, int characterX, int characterY){
			for (Enemy en: enemies){
				
				en.updatePosition(characterX,characterY);
				if (en.getDirection()==0){
					g.drawImage(orangeenemyL,en.getX(),en.getY()+33,null);
				}
				else{
					g.drawImage(orangeenemyR,en.getX(),en.getY()+33,null);
				}
			}
	}
	
	public static void enemyKilled(){
		
		enemyKills++;
		enemysLeft--;

	}
}
