//
//  GameScene.swift
//  GIJamTowerDefenseGame
//
//  Created by Cory Welch on 2015-01-24.
//  Copyright (c) 2015 Cory Welch. All rights reserved.
//

import SpriteKit

class GameScene: SKScene {
    
    let numEnemies = [1,2,3,4,5,6]
    var curLevel = 0
    var alive = true
    
    override func didMoveToView(view: SKView) {
        
        backgroundColor = SKColor.whiteColor()
        
        //Load Background Image
        let background = SKSpriteNode(imageNamed: "GeneralMap.png")
        background.position = CGPoint(x: size.width/2,y:size.height/2)
        addChild(background)

        println("Background Added")

        let tower = SKSpriteNode(imageNamed: "GeneralTower.png")
        tower.position = CGPoint(x: size.width/2+120, y: size.height/2+40)
        
        addChild(tower)
        println("Tower Placed")
        
        runAction(SKAction.repeatAction(
            SKAction.sequence([
                SKAction.runBlock(level),
                SKAction.waitForDuration(3)
                ]), count: 5
            ))
        
    }
    func level(){
        println("Level: \(curLevel)")
        runAction(SKAction.repeatAction(
            SKAction.sequence([
                SKAction.runBlock(addEnemy),
                SKAction.waitForDuration(0.5)
                ]), count: numEnemies[curLevel]
        ))
        curLevel++

    }
    
    func addEnemy() {
        
        let enemy = SKSpriteNode(imageNamed: "GeneralEnemy.png")
        enemy.position = CGPoint(x: size.width, y: 3*size.height/4)
        
        
        addChild(enemy)
        println("Enemy Spawned")
        
        let move = SKAction.moveTo(CGPoint(x: 10, y: 10), duration: NSTimeInterval(CGFloat(15.0)))
        let delete = SKAction.removeFromParent()
        
        enemy.runAction(SKAction.sequence([move,delete]))
        
        println("Enemy Done")
        
    }
}
