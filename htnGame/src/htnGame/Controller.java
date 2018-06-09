package htnGame;
import java.awt.event.KeyEvent;
import java.awt.event.KeyListener;
import java.awt.Graphics;
import java.util.ArrayList;

public class Controller implements KeyListener{
	
	Character character;
	boolean left;
	boolean right;
	boolean jump;
	boolean fall;
	boolean grounded;
	boolean shoot;
	public String direction;
	int time = 0;
	public ArrayList<Bullet> bullets = new ArrayList<Bullet>();
	
	public Controller(Character c, Surface surf){
		character = c;
		left = false;
		right = false;
		jump = false;
		grounded = true;
	}

	@Override
	public void keyPressed(KeyEvent e) {
		 int key = e.getKeyCode();

		 if (key == KeyEvent.VK_LEFT) {
		     left = true;
		 }

		 if (key == KeyEvent.VK_RIGHT) {
			 right = true;
		 }

		 if (key == KeyEvent.VK_UP) {
			 jump = true;
		 }
		 
		 if (key == KeyEvent.VK_SPACE) {
		     shoot = true;
		 }
	}

	@Override
	public void keyReleased(KeyEvent e) {
		int key = e.getKeyCode();
		
		if (key == KeyEvent.VK_LEFT) {
	        left = false;
	    }

	    if (key == KeyEvent.VK_RIGHT) {
	    	right = false;
	    }

	    if (key == KeyEvent.VK_UP) {
	        
	    }
	    
	    if (key == KeyEvent.VK_SPACE) {
			shoot = false;
		}
		
	}

	@Override
	public void keyTyped(KeyEvent arg0) {
		// TODO Auto-generated method stub
		
	}
	
	public String updateCharacterPosition(){
		if (right){
			character.setX(character.getX()+2);
			direction = "right";
		}
		if (left){
			character.setX(character.getX()-2);
			direction = "left";
		}
		if (jump){
			grounded = false;
			jump = false;
			character.setVelocityY(-5);
		}
		
		if (!grounded){
			character.setVelocityY(character.getVelocityY() - character.getGravity() * time);
			character.setY((int)(character.getY()+character.getVelocityY()));
			time++;
				
				if (character.getY() >= 415 - character.getHeight()){
					character.setY(415 - character.getHeight());
					grounded = true;
					time = 0;
				}
		}
		else {
			character.setVelocityY(0);
			time = 0;
		}
		return direction;
	}
	
	public boolean updateBulletLocation(Graphics g, boolean CanShoot,String dir){
		boolean bulletShot = false;
		if(shoot && CanShoot){
			if(dir == "left"){
				bullets.add(new Bullet(character.getX()-5,character.getY(),g,dir));	
			}
			else{
				bullets.add(new Bullet(character.getX()+5,character.getY(),g,dir));
			}

			System.out.println(bullets.size());
			bulletShot = true;
		}
		
		int i = 0;
		boolean removeBullet = false;
		for(Bullet b: bullets){	
			
			b.moveBullet(g);
			
			if(b.outOfMap){			
				removeBullet = true;
				break;
			}
			if(b.hitEnemy){
				removeBullet = true;
				EnemyController.enemies.remove(b.enemyHit);
				EnemyController.enemyKilled();
				break;
			}
			
			i++;			
		} 	
		if(removeBullet){
			removeBullet(i);
		}
		return bulletShot;
	}
	public void removeBullet(int i){
		
		bullets.remove(i);
		
	}
	
}