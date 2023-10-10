<?php

namespace Laith98Dev\LevelSystem;

use pocketmine\utils\TextFormat;
use pocketmine\player\Player;

class LvlColor {
  
  public static function getLevel(Player $player): float{
      return Main::getInstance()->getDataManager()->getLevel($player);
  }
  
	/**
     * @param Player $player
     * @return string
     */
	public static function getColorLevel(Player $player) :string{
		$result = "";
		$level = self::getLevel($player);
		if($level >= 0){
			$result = TextFormat::WHITE.$level;
	        }
	        if($level >= 5){
			$result = TextFormat::GRAY.$level;
		}
		if($level >= 10){
			$result = TextFormat::DARK_GRAY.$level;	
		}
		if($level >= 15){
			$result = TextFormat::YELLOW.$level;
		}
		if($level >= 20){
			$result = TextFormat::GOLD.$level;
		}
		if($level >= 30){
			$result = TextFormat::AQUA.$level;
		}
		if($level >= 40){
			$result = TextFormat::LIGHT_PURPLE.$level;
		}
                if($level >= 50){
                        $result = TextFormat::DARK_PURPLE.$level;
		}
		if($level >= 60){
			$result = TextFormat::GREEN.$level;
		}
		if($level >= 70){
			$result = TextFormat::DARK_GREEN.$level;
		}
		if($level >= 80){
			$result = TextFormat::RED.$level;	
		}
		if($level >= 90){
			$result = TextFormat::BLUE.$level;
		}
		if($level >= 100){
			$result = TextFormat::DARK_BLUE.$level;
		}
		if($level >= 120){
			$result = TextFormat::DARK_RED.$level;
		}
		if($level >= 140){
			$result = TextFormat::DARK_AQUA.$level;
		}
                if($level >= 160){
                        $result = TextFormat::BLACK.$level;
		}
		if($level >= 180){
			$result = TextFormat::WHITE.$level;
	        }
	        if($level >= 200){
			$result = TextFormat::GRAY.$level;
		}
		if($level >= 220){
			$result = TextFormat::DARK_GRAY.$level;	
		}
		if($level >= 240){
			$result = TextFormat::YELLOW.$level;
		}
		if($level >= 260){
			$result = TextFormat::GOLD.$level;
		}
		if($level >= 280){
			$result = TextFormat::AQUA.$level;
		}
		if($level >= 300){
			$result = TextFormat::LIGHT_PURPLE.$level;
		}
                if($level >= 325){
                        $result = TextFormat::DARK_PURPLE.$level;
		}
		if($level >= 350){
			$result = TextFormat::GREEN.$level;
		}
		if($level >= 400){
			$result = TextFormat::DARK_GREEN.$level;
		}
		if($level >= 450){
			$result = TextFormat::RED.$level;	
		}
		if($level >= 500){
			$result = TextFormat::BLUE.$level;
		}
		if($level >= 550){
			$result = TextFormat::DARK_BLUE.$level;
		}
		if($level >= 600){
			$result = TextFormat::DARK_RED.$level;

		}
		if($level >= 750){
			$result = TextFormat::DARK_AQUA.$level;
		}
                if($level >= 800){
                        $result = TextFormat::BLACK.$level;
		}
		if($level >= 850){
			$result = TextFormat::WHITE.$level;
		}
		if($level >= 900){
			$result =  TextFormat::GRAY.$level;
		}
		if($level >= 950){
			$result =  TextFormat::DARK_GRAY.$level;	
		}
		if($level >= 1000){
			$result = TextFormat::ITALIC . TextFormat::YELLOW.$level . "§r";
		}
		if($level >= 1050){
			$result = TextFormat::ITALIC . TextFormat::GOLD.$level . "§r";
		}
		if($level >= 1125){
			$result = TextFormat::ITALIC . TextFormat::AQUA.$level . "§r";
		}
		if($level >= 1200){
			$result = TextFormat::ITALIC . TextFormat::LIGHT_PURPLE.$level . "§r";
		}
                if($level >= 1275){
                        $result = TextFormat::ITALIC . TextFormat::DARK_PURPLE.$level . "§r";
		}
		if($level >= 1350){
			$result = TextFormat::ITALIC . TextFormat::GREEN.$level . "§r";
		}
		if($level >= 1425){
			$result = TextFormat::ITALIC . TextFormat::DARK_GREEN.$level . "§r";
		}
		if($level >= 1500){
			$result = TextFormat::ITALIC . TextFormat::RED.$level . "§r";	
		}
		if($level >= 1600){
			$result = TextFormat::ITALIC . TextFormat::BLUE.$level . "§r";
		}
		if($level >= 1700){
			$result = TextFormat::ITALIC . TextFormat::DARK_BLUE.$level . "§r";
		}
		if($level >= 1800){
			$result = TextFormat::ITALIC . TextFormat::DARK_RED.$level . "§r";
		}
		if($level >= 1900){
			$result = TextFormat::ITALIC . TextFormat::DARK_AQUA.$level . "§r";
		}
                if($level >= 2000){
                        $result = TextFormat::ITALIC . TextFormat::BLACK.$level . "§r";
		}
		return $result;
	}
}
