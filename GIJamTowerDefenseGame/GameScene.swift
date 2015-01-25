//
//  GameScene.swift
//  GIJamTowerDefenseGame
//
//  Created by Cory Welch on 2015-01-24.
//  Copyright (c) 2015 Cory Welch. All rights reserved.
//

import SpriteKit
import UIKit

struct PhysicsCategory {
    static let None      : UInt32 = 0
    static let All       : UInt32 = UInt32.max
    static let Enemy     : UInt32 = 0b1       // 1
    static let Projectile: UInt32 = 0b10
    static let Tower     : UInt32 = 0b11
}

class GameScene: SKScene {
    
    let numEnemies = [1,2,3,4,5,6]
    var curLevel = 0
    var alive = true
    var levelComplete = true
    var enemiesOnScreen = 0;
    
    var enemiesInRange = [SKSpriteNode?](count:64, repeatedValue: nil)
    
    override func didMoveToView(view: SKView) {
        
        backgroundColor = SKColor.whiteColor()
        
        //Load Background Image
        let background = SKSpriteNode(imageNamed: "GeneralMap.png")
        background.position = CGPoint(x: size.width/2,y:size.height/2)
        addChild(background)

        println("Background Added")

        let tower = SKSpriteNode(imageNamed: "GeneralTower.png")
        tower.position = CGPoint(x: size.width/2+120, y: size.height/2+40)
        
        tower.physicsBody = SKPhysicsBody(circleOfRadius: 200)
        tower.physicsBody?.dynamic = true
        tower.physicsBody?.categoryBitMask = PhysicsCategory.Tower
        tower.physicsBody?.contactTestBitMask = PhysicsCategory.Enemy
        tower.physicsBody?.collisionBitMask = PhysicsCategory.None
        
        addChild(tower)
        println("Tower Placed")
        
        runAction(SKAction.repeatActionForever(
            SKAction.sequence([
                SKAction.runBlock(level),
                SKAction.waitForDuration(3)
                ])
            ))
        
    }
    func level(){
        if(levelComplete && curLevel <= 5){
            println("Level: \(curLevel)")
            runAction(SKAction.repeatAction(
                SKAction.sequence([
                    SKAction.runBlock(addEnemy),
                    SKAction.waitForDuration(0.5)
                    ]), count: numEnemies[curLevel]
                ))
            curLevel++
        }

    }
    
    func addEnemy() {
        
        let startX = size.width;
        let startY = 3*size.height/4;
        
        let enemy = SKSpriteNode(imageNamed: "GeneralEnemy.png")
        enemy.position = CGPoint(x: startX, y: startY)
        
        enemy.physicsBody = SKPhysicsBody(rectangleOfSize: enemy.size)
        enemy.physicsBody?.dynamic = true
        enemy.physicsBody?.categoryBitMask = PhysicsCategory.Enemy
        enemy.physicsBody?.contactTestBitMask = PhysicsCategory.Projectile
        enemy.physicsBody?.contactTestBitMask = PhysicsCategory.Tower
        enemy.physicsBody?.collisionBitMask = PhysicsCategory.None
        
        
        addChild(enemy)
        //println("Enemy Spawned at x:\(enemy.position.x) y:\(enemy.position.y)")
        enemyOnScreen()
        
        var bezierPath = UIBezierPath()
        bezierPath.moveToPoint(CGPoint(x: 0, y: 0))
        
        bezierPath.addLineToPoint(CGPointMake(-470, 25))
        bezierPath.addCurveToPoint(CGPoint(x:-550,y:-180), controlPoint1: CGPoint(x:-670,y:15), controlPoint2: CGPoint(x:-620,y:-160))
        bezierPath.addCurveToPoint(CGPoint(x:-215,y:-180), controlPoint1: CGPoint(x: -415,y:-250), controlPoint2: CGPoint(x:-335,y:100))
        bezierPath.addCurveToPoint(CGPoint(x: -660, y: -265), controlPoint1:CGPoint(x: -250, y: -315), controlPoint2:CGPoint(x: -430, y: -235))
        
        let actionMoveOne = SKAction.followPath(bezierPath.CGPath, speed: 100.0)

        let delete = SKAction.sequence([SKAction.runBlock(enemyOffScreen),SKAction.removeFromParent()])
        
        enemy.runAction(SKAction.sequence([actionMoveOne,delete]))
        
    }
    
    func enemyOnScreen(){
        enemiesOnScreen++
        levelComplete = false
        println("\(enemiesOnScreen)")
    }
    
    func enemyOffScreen(){
        enemiesOnScreen = enemiesOnScreen - 1
        println("\(enemiesOnScreen)")
        if(enemiesOnScreen==0){
            levelComplete = true
            println("Level Complete")
        }
    }
    
    func enemyInTowerRange(tower:SKSpriteNode, enemy:SKSpriteNode) {
        
        for var i = 0; i < 64; i++ {
            enemiesInRange.extend(enemy)
        }
        
    }
    
    func didBeginContact(contact: SKPhysicsContact) {
        
        // 1
        var firstBody: SKPhysicsBody
        var secondBody: SKPhysicsBody
        if contact.bodyA.categoryBitMask < contact.bodyB.categoryBitMask {
            firstBody = contact.bodyA
            secondBody = contact.bodyB
        } else {
            firstBody = contact.bodyB
            secondBody = contact.bodyA
        }
        
        // 2
        if ((firstBody.categoryBitMask & PhysicsCategory.Enemy != 0) &&
            (secondBody.categoryBitMask & PhysicsCategory.Tower != 0)) {
                enemyInTowerRange(firstBody.node as SKSpriteNode, enemy: secondBody.node as SKSpriteNode)
        }
        
    }
}
