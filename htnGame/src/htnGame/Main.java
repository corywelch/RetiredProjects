package htnGame;

import java.applet.Applet;
import java.awt.Color;
import java.awt.Graphics;
import java.awt.Image;

import acm.program.*;

public class Main extends Applet implements Runnable
{
	   Thread gameLoop;
	   int height, width, characterHeight, characterWidth;
	   Character character;
	   Controller controller;
	   Text text;
	   Environment environment;
	   Surface surface;
	   EnemyController enemyController;
	   Bullet bullet;
	   int timeFromLastBullet = 100;
	   boolean CanShoot = false;
	   public String direction;
	   
	   Image doubleBufferImage;
	   Graphics doubleBufferGraphic;
	   
	   public void init (){
		   this.setSize(640,480);
		   width = this.getWidth();
		   height = this.getHeight();
		   characterWidth = 32;
		   characterHeight = 64;
		   //setBackground(new Color(52, 152, 219));
		   
		   surface  = new Surface(416, 0, width);
		   character = new Character(width/5,surface.getPosY() - characterHeight, characterWidth, characterHeight);
		   System.out.println("character position y: " + character.getY());System.out.println("surface Y: " + surface.getPosY());System.out.println("character height: " + character.getHeight());
		   controller = new Controller(character, surface);
		   addKeyListener(controller);
		   environment = new Environment();
		   enemyController = new EnemyController();
	   }
	   
	   //function to run game loop
	   @Override
	   public void run() {
		   while (true){
			   repaint(); //update graphics
			   try{
				   Thread.sleep(10); //sleep milliseconds
			   }catch (InterruptedException e){
					   e.printStackTrace();
			   }
		   }
	   }
	   
	   //function to start game loop
	   public void start(){
		   if (gameLoop==null){
			   gameLoop = new Thread(this);
			   gameLoop.start();
		   }
	   }
	   
	   //function to stop game loop
	   public void stop(){
		   if (gameLoop != null){
			   gameLoop = null;
		   }
	   }

	   //game drawing loop
	   public void paint(Graphics g){
		  
		   environment.updateTiles(g);
		   
		  if(timeFromLastBullet >= 30){
			  CanShoot = true;
		  } else{
			  CanShoot = false;
			  timeFromLastBullet += 3;
		  }
		  direction = controller.updateCharacterPosition();
		  if(controller.updateBulletLocation(g,CanShoot,direction)){
			  timeFromLastBullet = 0;
		  }
		  enemyController.updateEnemies(g, character.getX(), character.getY());
		  
		  controller.updateCharacterPosition();
		  
		  g.drawRect(character.getX(),character.getY(),character.getWidth(),character.getHeight());
		  //temporary
	      g.setColor(Color.white);   
	      g.fillRect(character.getX(),character.getY(),character.getWidth()+1,character.getHeight()+1);
		  enemyController.updateEnemies(g, character.getX(), character.getY());
		  
		  if(enemyController.enemysLeft == 0){
			  
			  enemyController.level++;
			  enemyController.createEnemies();
		  }
		  text.writeText(g);
		  text.writeLevel(g);
	   }
	   
	   //double buffering
	   public void update(Graphics g){
		   doubleBufferImage = createImage(getWidth(),getHeight());
		   doubleBufferGraphic = doubleBufferImage.getGraphics();
		   paint(doubleBufferGraphic);
		   g.drawImage(doubleBufferImage, 0,0, this);
	   }
	   
}
