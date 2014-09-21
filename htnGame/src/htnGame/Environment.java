package htnGame;

import java.awt.Graphics;
import java.awt.image.BufferedImage;
import java.io.File;
import java.io.IOException;

import javax.imageio.ImageIO;

public class Environment {
	
	BufferedImage groundTile;
	BufferedImage platMidTile;
	BufferedImage platLeftTile;
	BufferedImage platRightTile;
	BufferedImage datWaterfall;
	BufferedImage wallBase;
	BufferedImage wallMain;
	
	public Environment(){
		groundTile = loadImage("../res/Ground3.png");
		platMidTile = loadImage("../res/Platform1Middle.png");
		platLeftTile = loadImage("../res/Platform1Left.png");
		platRightTile = loadImage("../res/Platform1Right.png");
		datWaterfall = loadImage("../res/datWaterfall.jpg");
		wallBase = loadImage("../res/Wall2Base.png");
		wallMain = loadImage("../res/Wall2.png");
	}
	
	//function to return buffered image
	private BufferedImage loadImage(String imagePath){
		BufferedImage img = null;
		try {
			img = ImageIO.read(new File(imagePath));
		}catch(IOException e){}
		
		return img;
	}
	
	//function to draw tiles
	public void updateTiles(Graphics g){
		//drawing waterfall
		g.drawImage(datWaterfall, 0,0,null);
		//drawing ground tiles
		for (int i=0;i<640;i+=32){
			for (int j=416;j<480;j+=32){
				g.drawImage(groundTile,i,j,null);
			}
		}
		//drawing walls
		//g.drawImage(wallBase,-12,416,null);
		//g.drawImage(wallBase,608,416,null);
		for(int i=0;i<480;i+=32){
			g.drawImage(wallMain, -12,i,null);
			g.drawImage(wallMain, 614,i,null);
		}
		//drawing platforms
		g.drawImage(platLeftTile,32,320,null);
		g.drawImage(platLeftTile,416,214,null);
		
		g.drawImage(platRightTile,192,320,null);
		g.drawImage(platRightTile,576,214,null);
		
		for (int i=64;i<192;i+=32){
			g.drawImage(platMidTile,i,320,null);
		}
		for (int i=448;i<576;i+=32){
			g.drawImage(platMidTile,i,214,null);
		}
	}	
}
