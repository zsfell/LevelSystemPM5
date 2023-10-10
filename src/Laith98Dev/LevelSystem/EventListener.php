<?php

namespace Laith98Dev\LevelSystem;

use pocketmine\player\IPlayer;
use pocketmine\player\Player;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as TF;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\player\chat\LegacyRawChatFormatter;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\player\chat\ChatFormatter;
use pocketmine\event\entity\{EntityDamageEvent, EntityDamageByEntityEvent};

use _64FF00\PurePerms\event\PPGroupChangedEvent;

class EventListener implements Listener 
{
	public function __construct(
		private Main $plugin
		){
		// NOOP
	}
	
	public function getPlugin(){
		return $this->plugin;
	}
	
	public function getDataFolder(){
		return $this->plugin->getDataFolder();
	}
	private function shouldCancelEvent(Player $player) : void{
			}

	/**
	 * @param PPRankChangedEvent $event
	 * @priority HIGHEST
	 */
	public function onRankChanged(PPGroupChangedEvent $event)
    {
        /** @var IPlayer $player */
        $player = $event->getPlayer();
		if($player instanceof Player){
            if($this->getPlugin()->pureChat !== null){
				$lvl = LvlColor::getColorLevel($player);
				$WorldName = $this->getPlugin()->pureChat->getConfig()->get("enable-multiworld-chat") ? $player->getWorld()->getDisplayName() : null;
				$nametag = $this->getPlugin()->pureChat->getNametag($player, $WorldName);
				$nametag = str_replace("{lvl}", $lvl, $nametag);
				$player->setNameTag($nametag);
			}
		}
    }
	
	/**
	 * @param PlayerJoinEvent $event
	 * @priority HIGHEST
	 */
	public function onJoin(PlayerJoinEvent $event)
	{
		$player = $event->getPlayer();
		if($player instanceof Player){
			$this->getPlugin()->getDataManager()->checkAccount($player);

			if($this->getPlugin()->pureChat !== null){
				$lvl = LvlColor::getColorLevel($player);
				$WorldName = $this->getPlugin()->pureChat->getConfig()->get("enable-multiworld-chat") ? $player->getWorld()->getDisplayName() : null;
				$nametag = $this->getPlugin()->pureChat->getNametag($player, $WorldName);
				$nametag = str_replace("{lvl}", $lvl, $nametag);
				$player->setNameTag($nametag);
			}
		}
	}

	public function onScorehud(Main $event){
		$player = $event->getPlayer();
		if($player instanceof Player){
			$this->getPlugin()->getDataManager()->checkAccount($player);
		$lvl = LvlColor::getColorLevel($player);
			(new PlayerTagUpdateEvent($player, [
				new ScoreTag("{lvl}", $lvl, $player)]))->call();
		}
	}	

	/**
	 * @param BlockPlaceEvent $event
	 * @priority HIGHEST
	 */
	public function onPlace(BlockPlaceEvent $event): void
	{
		if($this->shouldCancelEvent($event->getPlayer())){
		    $event->cancel();
			return;
		
		if($player instanceof Player){
			$cfg = new Config($this->plugin->getDataFolder() . "settings.yml", Config::YAML);
			if($cfg->get("plugin-enable") === true){
				if($cfg->get("add-xp-by-build") === true && in_array($block->getTypeId(), $cfg->get("blocks-list", []))){
					if(mt_rand(0, 200) < 120 && mt_rand(0, 1) == 1 && mt_rand(0, 1) == 0 && mt_rand(0, 3) == 2){// random
						if($this->plugin->getDataManager()->addXP($player, $this->plugin->getDataManager()->getAddXpCount($player))){
							$player->sendPopup(TF::YELLOW . "+" . $this->plugin->getDataManager()->getAddXpCount($player) . " XP");
						}
					}
				}
			}
		}
	}
}
	
	/**
	 * @param BlockBreakEvent $event
	 * @priority HIGHEST
	 */
	public function onBreak(BlockBreakEvent $event): void
	{
		$player = $event->getPlayer();
		$block = $event->getBlock();
		if($event->isCancelled())
			return;
		
		if($player instanceof Player){
			$cfg = new Config($this->plugin->getDataFolder() . "settings.yml", Config::YAML);
			if($cfg->get("plugin-enable") && $cfg->get("plugin-enable") === true){
				if($cfg->get("add-xp-by-destroy") && $cfg->get("add-xp-by-destroy") === true && in_array($block->getTypeId(), $cfg->get("blocks-list", []))){
					if(mt_rand(0, 200) < 120 && mt_rand(0, 1) == 1 && mt_rand(0, 1) == 0 && mt_rand(0, 3) == 2){// random
						if($this->plugin->getDataManager()->addXP($player, $this->plugin->getDataManager()->getAddXpCount($player))){
							$player->sendPopup(TF::YELLOW . "+" . $this->plugin->getDataManager()->getAddXpCount($player) . " XP");
						}
					}
				}
			}
		}
	}
	
	/**
	 * @param PlayerDeathEvent $event
	 */
	public function onDeath(PlayerDeathEvent $event)
	{
		$player = $event->getPlayer();
		if($player instanceof Player){
			$cfg = new Config($this->getDataFolder() . "settings.yml", Config::YAML);
			if($cfg->get("plugin-enable") === true){
				if($cfg->get("add-xp-by-kill") === true){
					if($cfg->get("kill-with-death-screen") === true){
						if(mt_rand(0, 200) < 120 && mt_rand(0, 1) == 1 && mt_rand(0, 1) == 0 && mt_rand(0, 3) == 2){// random
							if($this->getPlugin()->getDataManager()->addXP($player, $this->getPlugin()->getDataManager()->getAddXpCount($player))){
								$player->sendPopup(TF::YELLOW . "+" . $this->getPlugin()->getDataManager()->getAddXpCount($player) . " XP");
							}
						}
					}
				}
			}
		}
	}
	
	/**
	 * @param EntityDamageEvent $event
	 * @priority HIGHEST
	 */
	public function onDamage(EntityDamageEvent $event)
	{
		$entity = $event->getEntity();

		if($event->isCancelled())
			return;
		
		if($entity instanceof Player){
			if($event instanceof EntityDamageByEntityEvent && ($damager = $event->getDamager()) instanceof Player){
				$cfg = new Config($this->getDataFolder() . "settings.yml", Config::YAML);
				if($cfg->get("plugin-enable") === true){
					if($cfg->get("add-xp-by-kill") === true){
						if($cfg->get("kill-with-death-screen") === false){
							if($entity->getHealth() <= $event->getFinalDamage()){
								if(mt_rand(0, 200) < 120 && mt_rand(0, 1) == 1 && mt_rand(0, 1) == 0 && mt_rand(0, 3) == 2){// random
									if($this->getPlugin()->getDataManager()->addXP($damager, $this->getPlugin()->getDataManager()->getAddXpCount($damager))){
										$damager->sendPopup(TF::YELLOW . "+" . $this->getPlugin()->getDataManager()->getAddXpCount($damager) . " XP");
									}
								}
							}
						}
					}
				}
			}
		}
	}




	
	/**
	 * @param PlayerChatEvent $event
	 * @priority HIGHEST
	 */
	public function onChat(PlayerChatEvent $event)
	{
		$player = $event->getPlayer();
		$message = $event->getMessage();

		if($event->isCancelled())
			return;

		if($player instanceof Player){
			$cfg = new Config($this->getDataFolder() . "settings.yml", Config::YAML);
			if($cfg->get("plugin-enable") === true){
				if($cfg->get("add-xp-by-chat") === true){
					if(mt_rand(0, 200) < 120 && mt_rand(0, 1) == 1 && mt_rand(0, 1) == 0 && mt_rand(0, 3) == 2){// random
						if($this->getPlugin()->getDataManager()->addXP($player, $this->getPlugin()->getDataManager()->getAddXpCount($player))){
							$player->sendPopup(TF::YELLOW . "+" . $this->getPlugin()->getDataManager()->getAddXpCount($player) . " XP");
						}
					}
				}
				
				// chat format
				$lvl = LvlColor::getColorLevel($player);
				if($cfg->get("edit-chat-format") === true){
					if($this->getPlugin()->pureChat !== null){
						$WorldName = $this->getPlugin()->pureChat->getConfig()->get("enable-multiworld-chat") ? $player->getWorld()->getDisplayName() : null;
						$chatFormat = $this->getPlugin()->pureChat->getChatFormat($player, $message, $WorldName);
						$chatFormat = str_replace("{lvl}", $lvl, $chatFormat);
						$event->setFormatter(new LegacyRawChatFormatter($chatFormat));
						// $event->cancel();
					} 
					/* else {
						if($cfg->get("chatFormat") && $cfg->get("chatFormat") !== ""){
							$chatFormat = str_replace(["{name}", "{lvl}", "{msg}", "&"], [$player->getName(), $lvl, $message, TF::ESCAPE], $cfg->get("chatFormat"));
							//$event->setFormat($chatFormat);
							$event->cancel();
							$this->getPlugin()->getServer()->broadcastMessage($chatFormat);
						}
					} */
				}
			}
		}
	}
}
