package htnGame;

import java.awt.Graphics;


public class Text {
	
	public void Text() {
		
	}
	
	public static void writeText(Graphics g){	
		
		g.drawString("Kill All The Shits!", 200, 30);
		
		g.drawString("Kills", 420, 20);
		g.drawString(Integer.toString(EnemyController.enemyKills), 420, 40);
		
		g.drawString("Enemies Remaining", 490, 20);
		g.drawString(Integer.toString(EnemyController.enemysLeft), 490, 40);
	}
	public static void writeLevel(Graphics g){
		
		g.drawString("Level "+Integer.toString(EnemyController.level),220,50);
		
	}
}
